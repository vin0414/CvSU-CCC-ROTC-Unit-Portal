<?php

namespace App\Controllers;
use App\Libraries\Hash;
use App\Models\accountModel;
use App\Models\studentModel;
use App\Models\cadetModel;
use App\Models\attendanceModel;
use App\Models\qrcodeModel;
use App\Models\scheduleModel;
use App\Models\assignmentModel;

class Administrator extends BaseController
{
    private $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        helper(['url', 'form','text']);
    }

    public function auth()
    {
        return view('auth/login',['validation' => \Config\Services::validation()]);
    }

    public function checkAuth()
    {
        $validation = $this->validate([
            'employee_id' => [
                'rules' => 'required|is_not_unique[accounts.employee_id]',
                'errors' => [
                    'required' => 'Employee ID is required',
                    'is_not_unique' => 'Employee ID does not exist'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]|max_length[20]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password must be at least 8 characters long',
                    'max_length' => 'Password cannot exceed 20 characters',
                    'regex_match' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character'
                ]
            ]
        ]);
        if(!$validation)
        {
            return view('auth/login', [
                'validation' => $this->validator
            ]); 
        }
        else
        {
            $accountModel = new \App\Models\accountModel();
            $account = $accountModel->where('employee_id', $this->request->getPost('employee_id'))
                                    ->where('status', 1)
                                    ->first();
            if($account)
            {
                if(Hash::check($this->request->getPost('password'), $account['password']))
                {
                    session()->set('loggedAdmin', $account['account_id']);
                    session()->set('fullname', $account['fullname']);
                    session()->set('role', $account['role_id']);
                    //logs
                    date_default_timezone_set('Asia/Manila');
                    $logModel = new \App\Models\logModel();
                    $data = ['account_id'=>$account['account_id'],
                            'activities'=>'Logged On',
                            'page'=>'Login page',
                            'datetime'=>date('Y-m-d h:i:s a')
                            ];      
                    $logModel->save($data);
                    return redirect()->to('/dashboard');
                }
                else
                {
                    return redirect()->to('/auth')->with('fail', 'Incorrect password!');
                }
            }
            else
            {
                return redirect()->to('/auth')->with('fail', 'Account is inactive!');
            }
        }
    }

    public function logout()
    {
        //logs
        date_default_timezone_set('Asia/Manila');
        $logModel = new \App\Models\logModel();
        $data = ['account_id'=>session()->get('loggedAdmin'),
                'activities'=>'Logged Out',
                'page'=>'Login page',
                'datetime'=>date('Y-m-d h:i:s a')
                ];      
        $logModel->save($data);
        if(session()->has('loggedAdmin'))
        {
            session()->remove('loggedAdmin');
            session()->destroy();
            return redirect()->to('/auth?access=out')->with('fail', 'You are logged out!');
        }
    }

    public function resetPassword()
    {
        return view('auth/forgot-password',['validation' => \Config\Services::validation()]);
    }

    //validate the permission
    public function hasPermission($page)
    {
        $roleModel = new \App\Models\roleModel();
        $accountModel = new accountModel();
        $account = $accountModel->WHERE('account_id',session()->get('loggedAdmin'))->first();
        $role = $roleModel->WHERE('role_id',$account['role_id'])->first();
        if($role[$page] != 1)
        {
            //no access
            return false;
        }
        else
        {
            return true;
        }
    }

    public function index()
    {
        $title = 'Overview';
        //announcement
        $announcementModel = new \App\Models\announcementModel();
        $announcement = $announcementModel->orderBy('announcement_id','DESC')->limit(5)->findAll();
        //attendance chart
        $currentDate = date('Y-m-d'); // Get today's date

        $sql = "
            SELECT status, COUNT(*) AS total
            FROM (
                SELECT 
                    s.student_id,
                    CASE 
                        WHEN COUNT(a.attendance_id) = 0 THEN 'Absent'
                        WHEN MAX(CASE WHEN a.remarks = 'IN' THEN a.time END) IS NOT NULL 
                             AND MAX(CASE WHEN a.remarks = 'OUT' THEN a.time END) IS NOT NULL 
                        THEN 'Present'
                        ELSE 'Incomplete'
                    END AS status
                FROM students s
                LEFT JOIN attendance a 
                    ON s.student_id = a.student_id AND a.date = ?
                GROUP BY s.student_id
            ) AS sub
            GROUP BY status
        ";

        $query = $this->db->query($sql, [$currentDate]);

        $attendance = $query->getResultArray();
        //count the total cadet
        $studentModel = new studentModel();
        $total = $studentModel->countAllResults();
        //count the total enrolled cadet
        $totalEnrolled = $studentModel->where('is_enroll',1)->countAllResults();
        //total training
        $scheduleModel = new scheduleModel();
        $training = $scheduleModel->countAllResults();
        //staff
        $assignmentModel = new assignmentModel();
        $staff = $assignmentModel->where('account_id<>',0)->countAllResults();
        //assignment
        $assignment = $this->db->table('assignments a')
                    ->select('b.name,b.details,b.day,b.from_time,b.to_time,a.schedule_id')
                    ->join('schedules b','b.schedule_id=a.schedule_id','LEFT')
                    ->where('a.account_id',session()->get('loggedAdmin'))
                    ->groupBy('a.assignment_id')
                    ->orderBy('a.assignment_id','DESC')->limit(5)
                    ->get()->getResult();

        $data = ['title'=>$title,'announcement'=>$announcement,'assignment'=>$assignment,
                'attendance'=>$attendance,'total'=>$total,'staff'=>$staff,
                'enrolled'=>$totalEnrolled,'training'=>$training];
        return view('admin/dashboard',$data);
    }

    public function cadetInformation()
    {
        if(!$this->hasPermission('cadet'))
        {
            return redirect()->to('/dashboard')->with('fail', 'You do not have permission to access that page!');
        }
        else
        {
            $title = 'Cadets';
            $data['title'] = $title;
            return view('admin/cadets/cadet-list',$data);
        }
    }

    public function editCadet($id)
    {
        if(!$this->hasPermission('cadet'))
        {
            return redirect()->to('/dashboard')->with('fail', 'You do not have permission to access that page!');
        }
        else
        {
            $title = 'Cadets';
            $student = new studentModel();
            $data['student'] = $student->where('token',$id)->first();
            $data['title'] = $title;
            return view('admin/cadets/edit',$data);
        }
    }

    public function cadetInfo($id)
    {
        if(!$this->hasPermission('cadet'))
        {
            return redirect()->to('/dashboard')->with('fail', 'You do not have permission to access that page!');
        }
        else
        {
            $data['title'] = 'View Cadet';
            $studentModel = new studentModel();
            $infoModel = new cadetModel();
            $attachment = new \App\Models\attachmentModel();
            $student = $studentModel->where('token',$id)->first();
            $data['cadet'] = $student;
            $info = $infoModel->where('student_id',$student['student_id'])->first();
            if(empty($info))
            {
                return redirect()->to('/cadets')->with('fail', 'Cadet information not found!');
            }
            $data['info'] = $info;
            $data['attachment'] = $attachment->where('student_id',$student['student_id'])->first();
            //all training
            $data['training'] = $this->db->table('trainings a')
                        ->select('b.name,b.details')
                        ->join('schedules b','b.schedule_id=a.schedule_id','LEFT')
                        ->where('a.student_id',$student['student_id'])
                        ->where('a.status',1)
                        ->groupBy('a.training_id')->get()->getResult();
            return view('admin/cadets/view',$data);
        }
    }

    public function modifyCadet()
    {
        $studentModel = new studentModel();
        $validation = $this->validate([
            'fullname'=>'required',
            'school_id'=>'required',
            'email'=>'required|valid_email',
            'status'=>'required',
            'id'=>'required|numeric'
        ]);
        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            $data = [
                    'school_id'=>$this->request->getPost('school_id'),
                    'fullname'=>$this->request->getPost('fullname'),
                    'email'=>$this->request->getPost('email'),
                    'status'=>$this->request->getPost('status')
                ];
            $studentModel->update($this->request->getPost('id'),$data);
            return $this->response->setJSON(['success'=>'Successfully applied changes']);
        }
    }

    public function registeredUser()
    {
        $studentModel = new studentModel();
        $searchTerm = $_GET['search']['value'] ?? '';
        if ($searchTerm) {
            $studentModel->like('school_id', $searchTerm)
                        ->orLike('fullname',$searchTerm);  
        }
        $limit = $_GET['length'] ?? 10;
        $offset = $_GET['start'] ?? 0; 
        $filteredStudentModel = clone $studentModel;
        if ($searchTerm) {
            $filteredStudentModel->like('school_id', $searchTerm)
                        ->orLike('fullname',$searchTerm);
        }
        $students = $studentModel->where('is_enroll',0)->findAll($limit, $offset);  
        $totalRecords = $studentModel->where('is_enroll',0)->countAllResults();
        $filteredRecords = $filteredStudentModel->where('is_enroll',0)->countAllResults();
        $response = [
            "draw" => $_GET['draw'],
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            'data' => [] 
        ];
        foreach ($students as $row) {
            $response['data'][] = [
                'image'=>'<img src="assets/images/profile/'.$row['photo'].'" width="30px;"/>',
                'id' => htmlspecialchars($row['school_id'], ENT_QUOTES),
                'fullname' => htmlspecialchars($row['fullname'], ENT_QUOTES),
                'email' => htmlspecialchars($row['email'], ENT_QUOTES),
                'status' => ($row['status']==1) ? '<i class="ti ti-check"></i>&nbsp;Active' : '<i class="ti ti-x"></i>&nbsp;Inactive',
                'action'=>'<button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button">
                            <span>More</span>
                        </button>
                        <div class="dropdown-menu">
                            <a href="cadets/edit/'.$row['token'].'" class="dropdown-item">
                                <i class="ti ti-edit"></i>&nbsp;Edit
                            </a>
                            <a href="cadets/info/'.$row['token'].'" class="dropdown-item">
                                <i class="ti ti-list"></i>&nbsp;View Info
                            </a>
                            <button type="button" value="'.$row['student_id'].'" class="dropdown-item enroll">
                                <i class="ti ti-pencil-plus"></i>&nbsp;Enroll
                            </button>
                        </div>
                    '
            ];
        }
        return $this->response->setJSON($response);
    }

    public function enrolledCadet()
    {
        $searchTerm = $_GET['search']['value'] ?? '';
        $builder = $this->db->table('students a');
        $builder->select('a.student_id,a.school_id,a.fullname,a.token,a.photo,b.course,b.year,b.section');
        $builder->join('cadets b','b.student_id=a.student_id','LEFT');
        $builder->where('a.is_enroll',1)->groupBy('a.student_id');
        if ($searchTerm) {
            $builder->groupStart()
                    ->like('a.fullname', $searchTerm)
                    ->orLike('a.school_id', $searchTerm)
                    ->orLike('b.course', $searchTerm)
                    ->groupEnd();  
        }
        $limit = $_GET['length'] ?? 10;  
        $offset = $_GET['start'] ?? 0;  
        $builder->limit($limit, $offset);
        $students = $builder->get()->getResult();  
        $totalRecords = count($students);
        $filteredRecords = count($students);
        $response = [
            "draw" => $_GET['draw'],
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            'data' => [] 
        ];
        foreach ($students as $row) {
            $response['data'][] = [
                'image'=>'<img src="assets/images/profile/'.$row->photo.'" width="30px;"/>',
                'id' => htmlspecialchars($row->school_id, ENT_QUOTES),
                'fullname' => htmlspecialchars($row->fullname, ENT_QUOTES),
                'course' => htmlspecialchars($row->course, ENT_QUOTES).'-'.htmlspecialchars($row->year, ENT_QUOTES),
                'section' => htmlspecialchars($row->section, ENT_QUOTES),
                'action'=>'<button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button">
                            <span>More</span>
                        </button>
                        <div class="dropdown-menu">
                            <a href="cadets/edit/'.$row->token.'" class="dropdown-item">
                                <i class="ti ti-edit"></i>&nbsp;Edit
                            </a>
                            <a href="cadets/info/'.$row->token.'" class="dropdown-item">
                                <i class="ti ti-list"></i>&nbsp;View Info
                            </a>
                        </div>
                    '
            ];
        }
        return $this->response->setJSON($response);
    }

    public function enrollCadet()
    {
        $studentModel = new studentModel();
        $val = $this->request->getPost('value');
        if(!is_numeric($val))
        {
            return $this->response->setJSON(['errors'=>'Invalid Request']);
        }
        else
        {
            $data = ['is_enroll'=>1];
            $studentModel->update($val,$data);
            return $this->response->setJSON(['success'=>'Success']);
        }
    }

    public function trainingSchedule()
    {
        if(!$this->hasPermission('schedule'))
        {
            return redirect()->to('/dashboard')->with('fail', 'You do not have permission to access that page!');
        }
        else
        {
            $title = 'Schedules';
            $data = ['title'=>$title];
            return view('admin/schedules/all-schedules',$data);
        }
    }

    public function manageSchedule()
    {
        if(!$this->hasPermission('schedule'))
        {
            return redirect()->to('/dashboard')->with('fail', 'You do not have permission to access that page!');
        }
        else
        {
            $title = 'Manage Schedules';
            //accounts
            $accountModel = new accountModel();
            $account = $accountModel->where('status',1)->findAll();
            $data = ['title'=>$title,'account'=>$account];
            return view('admin/schedules/manage-schedules',$data);
        }
    }

    public function fetchSchedule()
    {
        $scheduleModel = new scheduleModel();
        $searchTerm = $_GET['search']['value'] ?? '';
        if ($searchTerm) {
            $scheduleModel->like('name', $searchTerm)
                        ->orLike('school_year',$searchTerm);  
        }
        $limit = $_GET['length'] ?? 10; 
        $offset = $_GET['start'] ?? 0; 
        $filteredScheduleModel = clone $scheduleModel;
        if ($searchTerm) {
            $filteredScheduleModel->like('name', $searchTerm)
                        ->orLike('school_year',$searchTerm);
        }
        $schedule = $scheduleModel->findAll($limit, $offset);  
        $totalRecords = $scheduleModel->countAllResults();
        $filteredRecords = $filteredScheduleModel->countAllResults();
        $response = [
            "draw" => $_GET['draw'],
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            'data' => [] 
        ];
        foreach ($schedule as $row) {
            $response['data'][] = [
                'year' => htmlspecialchars($row['semester']." | ".$row['school_year'],ENT_QUOTES),
                'name' => htmlspecialchars($row['name'], ENT_QUOTES),
                'details' => htmlspecialchars(substr($row['details'],0,50).'...', ENT_QUOTES),
                'date' => 'From: ' . date('F d, Y', strtotime($row['from_date'])) . 
                           '<br>' . 
                           'To: ' . date('F d,  Y', strtotime($row['to_date'])),
                'time' => 'Start: ' . date('h:i:s a', strtotime($row['from_time'])) . 
                           '<br>' . 
                           'End: ' . date('h:i:s a', strtotime($row['to_time'])),
                'status'=>($row['status']==1) ? 'Active' : 'Archive',
                'action'=>'<button type="button" class="btn dropdown-toggle"
                            data-bs-toggle="dropdown" data-bs-auto-close="outside"
                            role="button">
                            <span>Action</span>
                        </button>
                        <div class="dropdown-menu">
                            <a href="edit/'.$row['schedule_id'].'" class="dropdown-item"><i class="ti ti-edit"></i>&nbsp;Edit Schedule</a>
                            <button type="button" value="'.$row['schedule_id'].'" class="dropdown-item assign"><i class="ti ti-user-plus"></i>&nbsp;Assign</button>
                        </div>
                        '
            ];
        }
        return $this->response->setJSON($response);
    }

    public function assignment()
    {
        $assignmentModel = new assignmentModel();
        $searchTerm = $_GET['search']['value'] ?? '';
        $start = intval($_GET['start'] ?? 0);      // Offset
        $length = intval($_GET['length'] ?? 10);   // Limit per page
        $builder = $this->db->table('assignments a');
        $builder->select('a.assignment_id,a.created_at,b.fullname,c.name,c.details');
        $builder->join('accounts b','b.account_id=a.account_id','INNER');
        $builder->join('schedules c','c.schedule_id=a.schedule_id','INNER');
        $builder->groupBy('a.assignment_id');
        if ($searchTerm) {
            // Add a LIKE condition to filter based on school name or address or any other column you wish to search
            $builder->groupStart()
                    ->like('b.fullname', $searchTerm)
                    ->orLike('c.name', $searchTerm)
                    ->groupEnd();
        }
        $builder->limit($length, $start);
        $assignment = $builder->get()->getResult();

        // Total number of filtered records (with search filter applied)
        $filteredRecords = count($assignment);

        $totalRecords = $assignmentModel->countAllResults();
        $response = [
            "draw" => $_GET['draw'],
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            'data' => [] 
        ];
        foreach ($assignment as $row) {
            $response['data'][] = [
                'date' => date('M d, Y h:i:s a',strtotime($row->created_at)),
                'name' => $row->name,
                'details' => $row->details,
                'fullname' => $row->fullname,
                'action'=>'<button type="button" class="btn btn-danger remove" value="'.$row->assignment_id.'">
                            <i class="ti ti-trash"></i>&nbsp;Remove
                           </button>'
            ];
        }
        // Return the response as JSON
        return $this->response->setJSON($response);
    }

    public function removeAssignment()
    {
        $assignmentModel = new assignmentModel();
        $val = $this->request->getPost('value');
        if(!is_numeric($val))
        {
            return $this->response->setJSON(['errors'=>'Invalid Request']);
        }
        else
        {
            $data = ['account_id'=>0,'schedule_id'=>0];
            $assignmentModel->update($val,$data);
            //logs  
            date_default_timezone_set('Asia/Manila');
            $logModel = new \App\Models\logModel();
            $data = ['account_id'=>session()->get('loggedAdmin'),
                    'activities'=>'Removed the assigned task',
                    'page'=>'Schedules',
                    'datetime'=>date('Y-m-d h:i:s a')
                    ];      
            $logModel->save($data);
            return $this->response->setJSON(['success' => 'Account removed successfully!']);
        }
    }

    public function saveAssignment()
    {
        $assignmentModel = new assignmentModel();
        $validation = $this->validate([
            'assignID'=>'required|numeric',
            'account'=>'required|numeric'
        ]);
        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            $data = ['account_id'=>$this->request->getPost('account'),
                    'schedule_id'=>$this->request->getPost('assignID')];
            $assignmentModel->save($data);
            //logs  
            date_default_timezone_set('Asia/Manila');
            $logModel = new \App\Models\logModel();
            $data = ['account_id'=>session()->get('loggedAdmin'),
                    'activities'=>'Assigned officer with task # '.$this->request->getPost('assignID'),
                    'page'=>'Schedules',
                    'datetime'=>date('Y-m-d h:i:s a')
                    ];      
            $logModel->save($data);
            return $this->response->setJSON(['success' => 'Account assigned successfully!']);
        }
    }

    public function createSchedule()
    {
        if(!$this->hasPermission('schedule'))
        {
            return redirect()->to('/dashboard')->with('fail', 'You do not have permission to access that page!');
        }
        else
        {
            $title = 'Create Schedule';
            $data = ['title'=>$title];
            return view('admin/schedules/create-schedule',$data);
        }
    }

    public function storeSchedule()
    {
        $scheduleModel = new scheduleModel();
        $validation = $this->validate([
            'school_year'=>['rules'=>'required','errors'=>['required'=>'School Year is required']],
            'semester'=>['rules'=>'required','errors'=>['required'=>'Semester is required']],
            'name'=>['rules'=>'required','errors'=>['required'=>'Name/Title is required']],
            'code'=>['rules'=>'required','errors'=>['required'=>'Code is required']],
            'day'=>['rules'=>'required','errors'=>['required'=>'Select day of the month']],
            'from_date'=>['rules'=>'required|valid_date','errors'=>['required'=>'Select start date','valid_date'=>'Invalid date format']],
            'from_time'=>['rules'=>'required','errors'=>['required'=>'Select start time']],
            'to_date'=>['rules'=>'required|valid_date','errors'=>['required'=>'Select end date','valid_date'=>'Invalid date format']],
            'to_time'=>['rules'=>'required','errors'=>['required'=>'Select end time']],
            'details'=>['rules'=>'required','errors'=>['required'=>'Details is required']],
        ]);
        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            $data = [
                'school_year'=>$this->request->getPost('school_year'),
                'semester'=>$this->request->getPost('semester'),
                'name'=>$this->request->getPost('name'),
                'details'=>$this->request->getPost('details'),
                'day'=>$this->request->getPost('day'),
                'code'=>$this->request->getPost('code'),
                'from_date'=>$this->request->getPost('from_date'),
                'to_date'=>$this->request->getPost('to_date'),
                'from_time'=>$this->request->getPost('from_time'),
                'to_time'=>$this->request->getPost('to_time'),
                'status'=>1
            ];
            $scheduleModel->save($data);
            //logs  
            date_default_timezone_set('Asia/Manila');
            $logModel = new \App\Models\logModel();
            $data = ['account_id'=>session()->get('loggedAdmin'),
                    'activities'=>'Create a new schedule for '.$this->request->getPost('code'),
                    'page'=>'Schedules',
                    'datetime'=>date('Y-m-d h:i:s a')
                    ];      
            $logModel->save($data);
            return $this->response->setJSON(['success'=>'Successfully created schedule']);
        }
    }

    public function editSchedule($id)
    {
        if(!$this->hasPermission('schedule'))
        {
            return redirect()->to('/dashboard')->with('fail', 'You do not have permission to access that page!');
        }
        else
        {
            $data['title'] = 'Edit Schedule';
            $scheduleModel = new scheduleModel();
            $schedule = $scheduleModel->where('schedule_id',$id)->first();
            if(empty($schedule))
            {
                return redirect()->to('/schedules/manage')->with('fail', 'Data not found! Please try again');
            }
            $data['schedule'] = $schedule;
            return view('admin/schedules/edit-schedule',$data);
        }
    }

    public function updateSchedule()
    {
        $scheduleModel = new scheduleModel();
        $validation = $this->validate([
            'id'=>['rules'=>'required|numeric','errors'=>['required'=>'Schedule ID is required','numeric'=>'Invalid']],
            'school_year'=>['rules'=>'required','errors'=>['required'=>'School Year is required']],
            'semester'=>['rules'=>'required','errors'=>['required'=>'Semester is required']],
            'name'=>['rules'=>'required','errors'=>['required'=>'Name/Title is required']],
            'code'=>['rules'=>'required','errors'=>['required'=>'Code is required']],
            'day'=>['rules'=>'required','errors'=>['required'=>'Select day of the month']],
            'from_date'=>['rules'=>'required|valid_date','errors'=>['required'=>'Select start date','valid_date'=>'Invalid date format']],
            'from_time'=>['rules'=>'required','errors'=>['required'=>'Select start time']],
            'to_date'=>['rules'=>'required|valid_date','errors'=>['required'=>'Select end date','valid_date'=>'Invalid date format']],
            'to_time'=>['rules'=>'required','errors'=>['required'=>'Select end time']],
            'details'=>['rules'=>'required','errors'=>['required'=>'Details is required']],
            'status'=>['rules'=>'required','errors'=>['required'=>'Status is required']],
        ]);
        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            $data = [
                'school_year'=>$this->request->getPost('school_year'),
                'semester'=>$this->request->getPost('semester'),
                'name'=>$this->request->getPost('name'),
                'details'=>$this->request->getPost('details'),
                'day'=>$this->request->getPost('day'),
                'code'=>$this->request->getPost('code'),
                'from_date'=>$this->request->getPost('from_date'),
                'to_date'=>$this->request->getPost('to_date'),
                'from_time'=>$this->request->getPost('from_time'),
                'to_time'=>$this->request->getPost('to_time'),
                'status'=>$this->request->getPost('status')
            ];
            $scheduleModel->update($this->request->getPost('id'),$data);
            //logs  
            date_default_timezone_set('Asia/Manila');
            $logModel = new \App\Models\logModel();
            $data = ['account_id'=>session()->get('loggedAdmin'),
                    'activities'=>'Modify schedule for '.$this->request->getPost('code'),
                    'page'=>'Schedules',
                    'datetime'=>date('Y-m-d h:i:s a')
                    ];      
            $logModel->save($data);
            return $this->response->setJSON(['success'=>'Successfully applied changes']);
        }
    }

    public function attendance()
    {
        if(!$this->hasPermission('attendance'))
        {
            return redirect()->to('/dashboard')->with('fail', 'You do not have permission to access that page!');
        }
        else
        {
            $data['title']="Attendance";
            $attendance = $this->db->table('attendance a')
                          ->select('a.*,b.fullname,b.school_id')
                          ->join('students b','b.student_id=a.student_id','LEFT')
                          ->groupBy('a.attendance_id')
                          ->get()->getResult();
            $data['attendance']=$attendance;
            //summary
            $summary = $this->db->table('attendance a')
                       ->select('a.date,b.fullname,b.school_id,
                        SEC_TO_TIME(TIME_TO_SEC(TIMEDIFF(
                                MAX(CASE WHEN a.remarks = "Out" THEN a.time END),
                                MIN(CASE WHEN a.remarks = "In" THEN a.time END)
                            ))) AS hours,a.token')
                       ->join('students b','b.student_id=a.student_id','LEFT')
                       ->groupBy('a.date,a.student_id')
                       ->get()->getResult();
            $data['summary']=$summary;
            return view('admin/attendance/all-attendance',$data);
        }
    }

    public function saveAttendance()
    {
        $attendanceModel = new attendanceModel();
        $qrcodeModel = new qrcodeModel();
        $validation = $this->validate([
            'date'=>'required',
            'time'=>'required',
            'status'=>'required'
        ]);
        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>'Invalid Request']);
        }
        else
        {
            //check if the qr code exist
            $code = $this->request->getPost('code');
            $qrcode = $qrcodeModel->where('token',$code)->first();
            if(empty($qrcode))
            {
                return $this->response->setJSON(['errors'=>'Records not found! Please try again.']);
            }
            else
            {
                //check if already scanned
                $check = $attendanceModel->where('token',$code)
                                        ->where('date',$this->request->getPost('date'))
                                        ->where('remarks',$this->request->getPost('status'))
                                        ->first();
                if($check)
                {
                    return $this->response->setJSON(['errors'=>'You have already scanned your QR Code for today.']);
                }
                else
                {
                    $data = [
                        'student_id'=>$qrcode['student_id'],
                        'date'=>$this->request->getPost('date'),
                        'time'=>$this->request->getPost('time'),
                        'remarks'=>$this->request->getPost('status'),
                        'token'=>$code
                    ];
                    $attendanceModel->save($data);
                    return $this->response->setJSON(['success'=>['message'=>'Successfully scanned']]);
                }
            }
        }
    }

    public function viewAttendance()
    {
        $uri = $this->request->getUri();
        $date = $uri->getSegment(3);   // attendance/view/{date}
        $token = $uri->getSegment(4);  // attendance/view/{date}/{token}
        $data['title'] = "View Attendance";
        $attendanceModel = new attendanceModel();
        $data['attendance'] = $attendanceModel->where('date',$date)
                    ->where('token',$token)
                    ->findAll();
        //get student
        $user = $attendanceModel->where('date',$date)
                    ->where('token',$token)->first();
        //student
        $studentModel = new studentModel();
        $data['student'] = $studentModel->where('student_id',$user['student_id'])->first();
        return view('admin/attendance/view-attendance',$data);
    }

    public function gradingSystem()
    {
        if(!$this->hasPermission('grading_system'))
        {
            return redirect()->to('/dashboard')->with('fail', 'You do not have permission to access that page!');
        }
        else
        {
            $title = 'Gradebook';
            //get all the schedules and total cadet
            $schedules = $this->db->table('schedules a')
                        ->select('a.schedule_id,a.code,a.school_year,a.name,a.status,c.fullname,d.total')
                        ->join('assignments b','b.schedule_id=a.schedule_id','LEFT')
                        ->join('accounts c','c.account_id=b.account_id','LEFT')
                        ->join('(Select schedule_id,count(*)total from trainings group by schedule_id) d','d.schedule_id=a.schedule_id','LEFT')
                        ->groupBy('a.schedule_id')
                        ->get()->getResult();

            $data = ['title'=>$title,'schedules'=>$schedules];
            return view('admin/grades/index',$data);
        }
    }

    public function uploadGradeBook()
    {
        if(!$this->hasPermission('grading_system'))
        {
            return redirect()->to('/dashboard')->with('fail', 'You do not have permission to access that page!');
        }
        else
        {
            $title = 'Upload Gradebook';
            $data = ['title'=>$title];
            return view('admin/grades/upload',$data);
        }
    }

    public function viewGradeBook($id)
    {
        if(!$this->hasPermission('grading_system'))
        {
            return redirect()->to('/dashboard')->with('fail', 'You do not have permission to access that page!');
        }
        else
        {
            $title = 'Gradebook';
            //schedule
            $scheduleModel = new scheduleModel();
            $schedule = $scheduleModel->where('schedule_id',$id)->first();
            if(empty($schedule))
            {
                return redirect()->to('/dashboard')->with('fail', 'No Record(s) found! Please try again');
            }
            //get the assign staff
            $model = new assignmentModel();
            $assignment = $model->where('schedule_id',$id)->first();
            $accountModel = new accountModel();
            $account = $accountModel->where('account_id',$assignment['account_id'])->first();
            //students
            $students = $this->db->table('trainings a')
                        ->select('a.student_id,b.fullname,b.school_id,c.course,c.year,c.section')
                        ->join('students b','b.student_id=a.student_id')
                        ->join('cadets c','c.student_id=b.student_id','LEFT')
                        ->where('a.schedule_id',$id)
                        ->groupBy('a.training_id')
                        ->get()->getResult();
            $data = ['title'=>$title,'schedule'=>$schedule,'account'=>$account,'students'=>$students];
            return view('admin/grades/view',$data);
        }
    }

    public function createSubject()
    {
        if(!$this->hasPermission('grading_system'))
        {
            return redirect()->to('/dashboard')->with('fail', 'You do not have permission to access that page!');
        }
        else
        {
            $data['title']="Gradebook";
            return view('admin/grades/subjects/create',$data);
        }   
    }

    public function announcement()
    {
        if(!$this->hasPermission('announcement'))
        {
            return redirect()->to('/dashboard')->with('fail', 'You do not have permission to access that page!');
        }
        else
        {
            $data['title']='Announcement';
            $val = $this->request->getGet('search');
            $announcement = new \App\Models\announcementModel();
            $page = (int) ($this->request->getGet('page') ?? 1);
            $perPage = 6;

            // Build query
            if ($val) {
                if ($val) $announcement->like('title', $val);
            }

            $announcement->orderBy('announcement_id', 'DESC');
            $list = $announcement->paginate($perPage, 'default', $page);
            $total = $announcement->countAllResults();       
            $pager = $announcement->pager;
            $data['list']=$list;
            $data['page']=$page;
            $data['perPage']=$perPage;
            $data['total']=$total;
            $data['pager']=$pager;
            return view('admin/announcement/index',$data);
        }
    }

    public function createAnnouncement()
    {
        if(!$this->hasPermission('announcement'))
        {
            return redirect()->to('/dashboard')->with('fail', 'You do not have permission to access that page!');
        }
        else
        {
            $title = 'New Announcement';
            $data = ['title'=>$title];
            return view('admin/announcement/create',$data);
        }
    }

    public function saveAnnouncement()
    {
        // Get raw HTML from Quill editor
        $rawDetails = $this->request->getPost('details');

        // Sanitize: remove whitespace and check for empty Quill output
        $cleanDetails = trim($rawDetails);

        $validation = $this->validate([
            'title'=>[
                'rules'=>'required|is_unique[announcement.title]',
                'errors'=>[
                    'required'=>'Title is required',
                    'is_unique'=>'Title already exist. Please try again'
                ]
            ],
            'details'=>['rules'=>'required','errors'=>['required'=>'Details is required']],
            'file' => [
                'rules' => 'uploaded[file]|mime_in[file,image/jpg,image/jpeg,image/png]|max_size[file,10240]',
                'errors' => [
                    'uploaded' => 'Please upload a file before submitting.',
                    'mime_in' => 'Only JPG, JPEG, and PNG image formats are allowed.',
                    'max_size' => 'The file size must not exceed 10MB.',
                ]
            ],
        ]);

        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            if ($cleanDetails === '<p><br></p>' || $cleanDetails === '') 
            {
                $error = ['details'=>'Details is required'];
                return $this->response->setJSON(['errors'=>$error]);
            }
            else
            {
                $file = $this->request->getFile('file');
                if ($file && $file->isValid() && !$file->hasMoved()) 
                {
                    $extension = $file->getExtension();
                    $originalname  = pathinfo($file->getClientName(), PATHINFO_FILENAME);
                    $safeName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $originalname);
                    $newName = date('YmdHis') . '_' . $safeName . '.' . $extension;
                    //create folder
                    $folderName = "assets/images/announcement";
                    if (!is_dir($folderName)) {
                        mkdir($folderName, 0755, true);
                    }
                    $file->move($folderName.'/',$newName);
                    $announcementModel = new \App\Models\announcementModel();
                    //save to the database
                    $data = [
                            'title'=>$this->request->getPost('title'),
                            'details'=>$this->request->getPost('details'),
                            'image'=>$newName,
                            'account_id'=>session()->get('loggedAdmin'),
                            ];
                    $announcementModel->save($data);
                    return $this->response->setJSON(['success'=>'Successfully uploaded']);
                }
                else
                {
                    $errors = ['file'=>'File upload failed or no file selected.'];
                    return $this->response->setJSON(['errors'=>$errors]);
                }
            }
        }
    }

    public function modifyAnnouncement()
    {
        // Get raw HTML from Quill editor
        $rawDetails = $this->request->getPost('details');

        // Sanitize: remove whitespace and check for empty Quill output
        $cleanDetails = trim($rawDetails);

        $validation = $this->validate([
            'id'=>[
                'rules'=>'required|numeric',
                'errors'=>[
                    'required'=>'Announcement ID is required',
                    'numeric'=>'Invalid ID'
                ]
            ],
            'title'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Title is required',
                ]
            ],
            'details'=>['rules'=>'required','errors'=>['required'=>'Details is required']],
        ]);

        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            if ($cleanDetails === '<p><br></p>' || $cleanDetails === '') 
            {
                $error = ['details'=>'Details is required'];
                return $this->response->setJSON(['errors'=>$error]);
            }
            else
            {
                $file = $this->request->getFile('file');
                $originalname  = pathinfo($file->getClientName(), PATHINFO_FILENAME);
                if(empty($originalname))
                {
                    $announcementModel = new \App\Models\announcementModel();
                    //save to the database
                    $data = [
                            'title'=>$this->request->getPost('title'),
                            'details'=>$this->request->getPost('details'),
                            ];
                    $announcementModel->update($this->request->getPost('id'),$data);
                    return $this->response->setJSON(['success'=>'Successfully applied changes']);
                }
                else
                {
                    if ($file && $file->isValid() && !$file->hasMoved()) 
                    {
                        $extension = $file->getExtension();
                        $safeName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $originalname);
                        $newName = date('YmdHis') . '_' . $safeName . '.' . $extension;
                        //create folder
                        $folderName = "assets/images/announcement";
                        if (!is_dir($folderName)) {
                            mkdir($folderName, 0755, true);
                        }
                        $file->move($folderName.'/',$newName);
                        $announcementModel = new \App\Models\announcementModel();
                        //save to the database
                        $data = [
                                'title'=>$this->request->getPost('title'),
                                'details'=>$this->request->getPost('details'),
                                'image'=>$newName,
                                ];
                        $announcementModel->update($this->request->getPost('id'),$data);
                        return $this->response->setJSON(['success'=>'Successfully applied changes']);
                    }
                    else
                    {
                        $errors = ['file'=>'File upload failed or no file selected.'];
                        return $this->response->setJSON(['errors'=>$errors]);
                    }
                }
            }
        }
    }

    public function editAnnouncement($id)
    {
        if(!$this->hasPermission('announcement'))
        {
            return redirect()->to('/dashboard')->with('fail', 'You do not have permission to access that page!');
        }
        else
        {
            $title = 'Edit Announcement';
            $data = ['title'=>$title];
            $announcementModel = new \App\Models\announcementModel();
            $announcement = $announcementModel->where('announcement_id',$id)->first();
            if(empty($announcement))
            {
                return redirect()->to('/announcement')->with('fail', 'Data not found! Please try again');
            }
            $data['announcement'] = $announcement;
            return view('admin/announcement/edit',$data);
        }
    }

    public function report()
    {
        $title = 'Reports';
        $data = ['title'=>$title];
        return view('admin/reports/index',$data);
    }

    public function createReport()
    {
        $title = 'Reports';
        $data = ['title'=>$title];
        return view('admin/reports/create',$data);
    }

    public function accounts()
    {
        if(!$this->hasPermission('maintenance'))
        {
            return redirect()->to('/dashboard')->with('fail', 'You do not have permission to access that page!');
        }
        else
        {
            $title = 'Accounts';
            $data = ['title'=>$title];
            return view('admin/maintenance/accounts/manage-user',$data);
        }
    }

    public function createAccount()
    {
        if(!$this->hasPermission('maintenance'))
        {
            return redirect()->to('/dashboard')->with('fail', 'You do not have permission to access that page!');
        }
        else
        {
            $title = 'Create Account';
            $roleModel = new \App\Models\roleModel();
            $role = $roleModel->findAll();
            $data = ['title'=>$title,'role'=>$role];
            return view('admin/maintenance/accounts/create-account',$data);
        }
    }

    public function editAccount($id)
    {
        if(!$this->hasPermission('maintenance'))
        {
            return redirect()->to('/dashboard')->with('fail', 'You do not have permission to access that page!');
        }
        else
        {
            $title = 'Edit Account';
            $roleModel = new \App\Models\roleModel();
            $role = $roleModel->findAll();
            //account
            $accountModel = new accountModel();
            $account = $accountModel->where('account_id',$id)->first();
            $data = ['title'=>$title,'role'=>$role,'account'=>$account];
            return view('admin/maintenance/accounts/edit-account',$data);
        }
    }

    public function recovery()
    {
        if(!$this->hasPermission('maintenance'))
        {
            return redirect()->to('/dashboard')->with('fail', 'You do not have permission to access that page!');
        }
        else
        {
            $title = 'Back-up and Recovery';
            $data = ['title'=>$title];
            return view('admin/maintenance/others/recovery',$data);
        }
    }

    public function fetchPermission()
    {
        $searchTerm = $_GET['search']['value'] ?? '';
        $permissionModel = new \App\Models\roleModel();
        // Apply the search filter for the main query
        if ($searchTerm) {
            $permissionModel->like('role_name', $searchTerm);   
        }
        // Pagination: Get the 'start' and 'length' from the request (these are sent by DataTables)
        $limit = $_GET['length'] ?? 10;  // Number of records per page, default is 10
        $offset = $_GET['start'] ?? 0;   // Starting record for pagination, default is 0
        // Clone the model for counting filtered records, while keeping the original for data fetching
        $filteredPermissionModel = clone $permissionModel;
        if ($searchTerm) {
            $filteredPermissionModel->like('role_name', $searchTerm);
        }
        // Fetch filtered records based on limit and offset
        $permissions = $permissionModel->findAll($limit, $offset);  
        // Count total records (without filter)
        $totalRecords = $permissionModel->countAllResults();
        // Count filtered records (with filter)
        $filteredRecords = $filteredPermissionModel->countAllResults();
        $response = [
            "draw" => $_GET['draw'],
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            'data' => [] 
        ];
        foreach ($permissions as $row) {
            $response['data'][] = [
                'role_name' => htmlspecialchars($row['role_name'], ENT_QUOTES),
                'cadet' => ($row['cadet']==1) ? '<i class="ti ti-check"></i>&nbsp;Active' : '<i class="ti ti-x"></i>&nbsp;Inactive',
                'schedule' => ($row['schedule']==1) ? '<i class="ti ti-check"></i>&nbsp;Active' : '<i class="ti ti-x"></i>&nbsp;Inactive',
                'attendance' => ($row['attendance']==1) ? '<i class="ti ti-check"></i>&nbsp;Active' : '<i class="ti ti-x"></i>&nbsp;Inactive',
                'grading_system' => ($row['grading_system']==1) ? '<i class="ti ti-check"></i>&nbsp;Active' : '<i class="ti ti-x"></i>&nbsp;Inactive',       
                'announcement' => ($row['announcement']==1) ? '<i class="ti ti-check"></i>&nbsp;Active' : '<i class="ti ti-x"></i>&nbsp;Inactive',
                'maintenance' => ($row['maintenance']==1) ? '<i class="ti ti-check"></i>&nbsp;Active' : '<i class="ti ti-x"></i>&nbsp;Inactive',
                'action' => '<a class="btn btn-primary edit_permission" href="/maintenance/permission/edit/' . $row['role_id'] . '"><i class="ti ti-edit"></i> Edit </a>'
            ];
        }
        return $this->response->setJSON($response);
        
    }

    public function savePermission()
    {
        $validation = $this->validate([
            'role'=>['rules'=>'required|is_unique[roles.role_name]','errors'=>['required'=>'Role is required.','is_unique'=>'Role already exist. Please try again']],
            'cadet'=>['rules'=>'required','errors'=>['required'=>'Cadet Module is required']],
            'schedule'=>['rules'=>'required','errors'=>['required'=>'Schedule Module is required']],
            'attendance'=>['rules'=>'required','errors'=>['required'=>'Attendance Module is required']],
            'grade'=>['rules'=>'required','errors'=>['required'=>'Evaluation Module is required']],
            'announcement'=>['rules'=>'required','errors'=>['required'=>'Announcement Module is required']],
            'maintenance'=>['rules'=>'required','errors'=>['required'=>'Maintenance Module is required']],
        ]);

        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            $roleModel = new \App\Models\roleModel();
            $data = [
                    'role_name'=>$this->request->getPost('role'),
                    'cadet'=>$this->request->getPost('cadet'),
                    'schedule'=>$this->request->getPost('schedule'),
                    'attendance'=>$this->request->getPost('attendance'),
                    'grading_system'=>$this->request->getPost('grade'),
                    'announcement'=>$this->request->getPost('announcement'),
                    'maintenance'=>$this->request->getPost('maintenance')
                ];
            $roleModel->save($data);
            //logs  
            date_default_timezone_set('Asia/Manila');
            $logModel = new \App\Models\logModel();
            $data = ['account_id'=>session()->get('loggedAdmin'),
                    'activities'=>'Created new permission',
                    'page'=>'Settings page',
                    'datetime'=>date('Y-m-d h:i:s a')
                    ];      
            $logModel->save($data);
            return $this->response->setJSON(['success'=>'Successfully added']);
        }
    }

    public function modifyPermission()
    {
        $validation = $this->validate([
            'id'=>['rules'=>'required','errors'=>['Role ID is required']],
            'role'=>['rules'=>'required','errors'=>['required'=>'Role is required.']],
            'cadet'=>['rules'=>'required','errors'=>['required'=>'Cadet Module is required']],
            'schedule'=>['rules'=>'required','errors'=>['required'=>'Schedule Module is required']],
            'attendance'=>['rules'=>'required','errors'=>['required'=>'Attendance Module is required']],
            'grade'=>['rules'=>'required','errors'=>['required'=>'Evaluation Module is required']],
            'announcement'=>['rules'=>'required','errors'=>['required'=>'Announcement Module is required']],
            'maintenance'=>['rules'=>'required','errors'=>['required'=>'Maintenance Module is required']],
        ]);

        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            $roleModel = new \App\Models\roleModel();
            $data = [
                    'role_name'=>$this->request->getPost('role'),
                    'cadet'=>$this->request->getPost('cadet'),
                    'schedule'=>$this->request->getPost('schedule'),
                    'attendance'=>$this->request->getPost('attendance'),
                    'grading_system'=>$this->request->getPost('grade'),
                    'announcement'=>$this->request->getPost('announcement'),
                    'maintenance'=>$this->request->getPost('maintenance')
                ];
            $roleModel->update($this->request->getPost('id'),$data);
            //logs  
            date_default_timezone_set('Asia/Manila');
            $logModel = new \App\Models\logModel();
            $data = ['account_id'=>session()->get('loggedAdmin'),
                    'activities'=>'Modify permission',
                    'page'=>'Settings page',
                    'datetime'=>date('Y-m-d h:i:s a')
                    ];      
            $logModel->save($data);
            return $this->response->setJSON(['success'=>'Successfully saved changes']);
        }
    }

    public function settings()
    {
        if(!$this->hasPermission('maintenance'))
        {
            return redirect()->to('/dashboard')->with('fail', 'You do not have permission to access that page!');
        }
        else
        {
            $title = 'Settings';
            //logs
            $builder = $this->db->table('logs a');
            $builder->select('a.*,b.fullname');
            $builder->join('accounts b','b.account_id=a.account_id','LEFT');
            $logs = $builder->get()->getResult();

            $data = ['title'=>$title,'logs'=>$logs];
            return view('admin/maintenance/others/settings',$data);
        }
    }

    public function createPermission()
    {
        if(!$this->hasPermission('maintenance'))
        {
            return redirect()->to('/dashboard')->with('fail', 'You do not have permission to access that page!');
        }
        else
        {
            $data['title'] = 'Create Permission';
            return view('admin/maintenance/others/add-permission',$data);
        }
    }

    public function editPermission($id)
    {
        if(!$this->hasPermission('maintenance') || !is_numeric($id))
        {
            return redirect()->to('/dashboard')->with('fail', 'You do not have permission to access that page!');
        }
        else
        {
            $data['title'] = 'Edit Permission';
            $permission = (new \App\Models\roleModel())->WHERE('role_id',$id)->first();
            if(!$permission)
            {
                return redirect()->to('/maintenance/settings')->with('fail', 'Permission not found!');
            }
            $data['permission'] = $permission;
            return view('admin/maintenance/others/edit-permission',$data);
        }
    }

    public function myAccount()
    {
        $title = 'My Account';
        $data = ['title'=>$title];
        return view('admin/account',$data);
    }


    //ajax
    public function fetchAccount()
    {
        $searchTerm = $_GET['search']['value'] ?? ''; 
        $builder = $this->db->table('accounts a');
        $builder->select('a.*,b.role_name as role'); 
        $builder->join('roles b','b.role_id=a.role_id','LEFT');
        if(!empty($searchTerm))
        {
            $builder->like('a.fullname', $searchTerm);
            $builder->orLike('a.employee_id', $searchTerm);
            $builder->orLike('a.email', $searchTerm);
            $builder->orLike('b.role', $searchTerm);
        }
        $query = $builder->get();
        $data = $query->getResult();
        $totalRecords = $query->getNumRows();
        $response = [
            "draw" => intval($_GET['draw']),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $data
        ];
        return $this->response->setJSON($response);
    }

    public function saveAccount()
    {
        $accountModel = new accountModel();
        $validation = $this->validate([
            'fullname' => [
                'rules' => 'required|is_unique[accounts.fullname]',
                'errors' => [
                    'required' => 'Fullname is required',
                    'is_unique' => 'Fullname already exists'
                ]
            ],
            'employee_id' => [
                'rules' => 'required|is_unique[accounts.employee_id]',
                'errors' => [
                    'required' => 'Employee ID is required',
                    'is_unique' => 'Employee ID already exists'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[accounts.email]',
                'errors' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Email is not valid',
                    'is_unique' => 'Email already exists'
                ]
            ],
            'role'=>[
                'rules'=>'required',
                'errors'=>['Role is required']
            ],
        ]);
        if(!$validation)
        {
            return $this->response->SetJSON(['error' => $this->validator->getErrors()]);
        }
        else
        {
            $data = [
                "employee_id"  =>$this->request->getPost('employee_id'),
                "password"     =>Hash::make('Abc12345?'),
                "fullname"     =>$this->request->getPost('fullname'),
                "email"        =>$this->request->getPost('email'),  
                "role_id"         =>$this->request->getPost('role'),
                "status"       =>$this->request->getPost('status'),
                "token"        =>md5(uniqid(rand(), true)),
                "date_created" =>date('Y-m-d h:i:s a')
            ];
            $accountModel->save($data);
            //logs  
            date_default_timezone_set('Asia/Manila');
            $logModel = new \App\Models\logModel();
            $data = ['account_id'=>session()->get('loggedAdmin'),
                    'activities'=>'Created Account',
                    'page'=>'Create Account page',
                    'datetime'=>date('Y-m-d h:i:s a')
                    ];      
            $logModel->save($data);
            return $this->response->setJSON(['success' => 'Account created successfully!']);
        }
    }

    public function modifyAccount()
    {
        $accountModel = new accountModel();
        $validation = $this->validate([
            'id'=>[
                'rules'=>'required|numeric',
                'errors'=>[
                    'required'=>'Account ID is required',
                    'numeric'=>'Account ID is numeric'
                ]
            ],
            'fullname' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Fullname is required',
                ]
            ],
            'employee_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Employee ID is required',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Email is not valid',
                ]
            ],
            'role'=>[
                'rules'=>'required',
                'errors'=>['Role is required']
            ],
        ]);
        if(!$validation)
        {
            return $this->response->SetJSON(['error' => $this->validator->getErrors()]);
        }
        else
        {
            $data = [
                "employee_id"  =>$this->request->getPost('employee_id'),
                "password"     =>Hash::make('Abc12345?'),
                "fullname"     =>$this->request->getPost('fullname'),
                "email"        =>$this->request->getPost('email'),  
                "role_id"         =>$this->request->getPost('role'),
                "status"       =>$this->request->getPost('status'),
            ];
            $accountModel->update($this->request->getPost('id'),$data);
            //logs  
            date_default_timezone_set('Asia/Manila');
            $logModel = new \App\Models\logModel();
            $data = ['account_id'=>session()->get('loggedAdmin'),
                    'activities'=>'Modify Account',
                    'page'=>'Create Account page',
                    'datetime'=>date('Y-m-d h:i:s a')
                    ];      
            $logModel->save($data);
            return $this->response->setJSON(['success' => 'Account modified successfully!']);
        }
    }
}