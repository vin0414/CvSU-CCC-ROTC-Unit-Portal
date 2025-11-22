<?php

namespace App\Controllers;
use App\Models\attendanceModel;
use App\Models\studentModel;
use Config\App;
use \App\Models\cadetTrainingModel;
use \App\Models\performanceModel;
use \App\Models\scheduleModel;
use \App\Models\reportModel;
use \App\Models\batchModel;
use \App\Models\scheduleFileModel;
use DateTime;
use DatePeriod;
use DateInterval;

class Enrolment extends BaseController
{   
    private $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        helper(['url', 'form']);
    }

    public function fetchTraining()
    {
        $semester = $this->request->getGet('semester');
        $year = $this->request->getGet('year');
        $cadet = $this->request->getGet('cadet');
        $output="";
        $query = "SELECT a.* FROM schedules a
                WHERE NOT EXISTS (
                    SELECT 1 FROM trainings b
                    WHERE a.schedule_id = b.schedule_id AND b.student_id = :cadet:
                )
                AND a.school_year = :year:
                AND a.semester = :semester:
                AND a.status = 1";

        $data = $this->db->query($query, [
            'cadet' => $cadet,
            'year' => $year,
            'semester' => $semester
        ])->getResult();
        foreach($data as $row)
        {
            $output.='<tr>
                        <td><input type="checkbox" name="schedule[]" style="width:20px;height:20px;" value="'.$row->schedule_id.'"/></td>
                        <td>'.$row->name.'<br/>'.$row->details.'</td>
                        <td>'.$row->from_date.' - '.$row->to_date.'</td>
                        <td>'.$row->from_time.' - '.$row->to_time.'</td>
                        <td>'.$row->day.'</td>
                     </tr>';
        }
        echo $output;
    }

    public function saveTraining()
    {
        $trainingModel = new cadetTrainingModel();
        $model = new scheduleModel();
        $validation = $this->validate([
            'cadet'=>'required|numeric',
        ]);
        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            $schedule = array_map('strip_tags', (array) $this->request->getPost('schedule'));
            $errors = [];
            if(empty($schedule))
            {
                $errors = ['cadet'=>'Please select at least one to continue'];
            }

            if(!empty($errors))
            {
                return $this->response->setJSON(['errors'=>$errors]);
            }
            else
            {
                for($i=0;$i<count($schedule);$i++)
                {
                    //get the class ID
                    $classID = $model->where('schedule_id',$schedule[$i])->first();
                    $data = [
                        'student_id'=>$this->request->getPost('cadet'),
                        'schedule_id'=>$schedule[$i],
                        'batch_id'=>$classID['batch_id'],
                        'status'=>1,
                        'remarks'=>'N/A'
                    ];
                    $trainingModel->save($data);
                }
                //logs  
                date_default_timezone_set('Asia/Manila');
                $logModel = new \App\Models\logModel();
                $data = ['account_id'=>session()->get('loggedAdmin'),
                        'activities'=>'Add schedule for cadet #:  '.$this->request->getPost('cadet'),
                        'page'=>'Cadets',
                        'datetime'=>date('Y-m-d h:i:s a')
                        ];      
                $logModel->save($data);
                return $this->response->setJSON(['success'=>'Successfully added']);
            }
        }
    }

    public function removeTraining()
    {
        
    }

    public function saveGrades()
    {
        $performanceModel = new performanceModel();
        $student = array_map('strip_tags', (array) $this->request->getPost('student'));
        $total = array_map('strip_tags', (array) $this->request->getPost('total'));
        $errors = [];
        if (empty($total) || count(array_filter($total, 'strlen')) === 0) {
            $errors['total'] = 'Please enter at least one score.';
        }
        if(!empty($errors))
        {
            return $this->response->setJSON(['errors'=>$errors]);
        }
        else
        {
            for ($i = 0; $i < count($student); $i++) {
                $year = $this->request->getPost('year');
                $semester = $this->request->getPost('semester');
                $subject_id = $this->request->getPost('subject');
                $schedule_id = $this->request->getPost('schedule');
                $student_id = $student[$i];
                $total_score = $total[$i];

                // Check if record exists
                $existing = $performanceModel->where([
                    'year' => $year,
                    'semester' => $semester,
                    'subject_id' => $subject_id,
                    'schedule_id' => $schedule_id,
                    'student_id' => $student_id
                ])->first();

                $data = [
                    'year' => $year,
                    'semester' => $semester,
                    'subject_id' => $subject_id,
                    'schedule_id' => $schedule_id,
                    'student_id' => $student_id,
                    'total' => $total_score
                ];

                if ($existing) {
                    // Update existing record
                    $performanceModel->update($existing['performance_id'], $data);
                } else {
                    // Insert new record
                    $performanceModel->insert($data);
                }
            }
            //logs  
            date_default_timezone_set('Asia/Manila');
            $logModel = new \App\Models\logModel();
            $data = ['account_id'=>session()->get('loggedAdmin'),
                    'activities'=>'Add grades for task # '.$this->request->getPost('schedule'),
                    'page'=>'Gradebook',
                    'datetime'=>date('Y-m-d h:i:s a')
                    ];      
            $logModel->save($data);
            return $this->response->setJSON(['success'=>'Successfully submitted']);
        }
    }

    public function saveClass()
    {
        $batchModel = new batchModel();
        $validation = $this->validate([
            'year'=>'required',
            'semester'=>'required',
            'batchName'=>['rules'=>'required','errors'=>[
                'required'=>'Name of batch is required'
            ]],
            'section'=>['rules'=>'required','errors'=>[
                'required'=>'Section is required'
            ]],
        ]);
        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            $data = [
                    'school_year'=>$this->request->getPost('year'),
                    'semester'=>$this->request->getPost('semester'),
                    'batchName'=>$this->request->getPost('className'),
                    'section'=>$this->request->getPost('section'),
                    'status'=>1
                ];
            $batchModel->save($data);
            //logs  
            date_default_timezone_set('Asia/Manila');
            $logModel = new \App\Models\logModel();
            $data = ['account_id'=>session()->get('loggedAdmin'),
                    'activities'=>'Add new batch',
                    'page'=>'Gradebook',
                    'datetime'=>date('Y-m-d h:i:s a')
                    ];      
            $logModel->save($data);
            return $this->response->setJSON(['success'=>'Successfully saved']);
        }
    }

    public function fetchClass()
    {
        $val = $this->request->getGet('value');
        $output="";
        $classModel = new batchModel();
        $class = $classModel->where('subject_id',$val)->findAll();
        foreach($class as $row)
        {
            $output.='<tr>
                        <td>'.$row['school_year'].'</td>
                        <td>'.$row['semester'].'</td>
                        <td>'.$row['batchName'].'</td>
                        <td>'.$row['section'].'</td>
                     </tr>';
        }
        echo $output;
    }

    public function fetchSubjectClass()
    {
        $model = new batchModel();
        $semester = $this->request->getGet('semester');
        $year = $this->request->getGet('year');
        $class = $model->where('school_year',$year)
                        ->where('semester',$semester)
                        ->findAll();
        return $this->response->setJSON(['class'=>$class]);
    }

    public function fetchList()
    {
        $model = new batchModel();
        $semester = $this->request->getGet('semester');
        $year = $this->request->getGet('year');
        $batch = $model->where('school_year',$year)
                        ->where('semester',$semester)
                        ->findAll();
        return $this->response->setJSON(['batch'=>$batch]);
    }

    public function listAttendance()
    {
        $batchName = $this->request->getGet('batchName');
        $output="";
        $result = $this->db->table('trainings a')
                    ->select('b.course,b.year,b.section,c.student_id,c.firstname,c.middlename,c.lastname,c.school_id,d.company,d.platoon_type,d.designation,d.others')
                    ->join('cadets b','b.student_id=a.student_id','LEFT')
                    ->join('students c','c.student_id=b.student_id','LEFT')
                    ->join('cadet_roles d','d.student_id=c.student_id','LEFT')
                    ->where('a.batch_id',$batchName)
                    ->groupBy('a.student_id')->get()->getResult();
        foreach($result as $row)
        {
            $output.='<tr>
                        <td>'.$row->school_id.'</td>
                        <td>'.$row->firstname.' '.$row->middlename.' '.$row->lastname.'</td>
                        <td>'.$row->course.'</td>
                        <td>'.$row->year.'</td>
                        <td>'.$row->section.'</td>
                        <td>'.$row->company.'<br/><small>'.$row->others.'</small></td>
                        <td>'.$row->platoon_type.'</td>
                        <td>'.$row->designation.'</td>';
                    if(empty($row->company)){
            $output.='  <td>
                            <button type="button" class="btn btn-default add" value='.$row->student_id.'>
                                <i class="ti ti-plus"></i>&nbsp;More
                            </button>
                        </td>';
                    }
                    else
                    {
                        $output.='<td>-</td>';
                    }
            $output.='</tr>';
        }
        echo $output;
    }

    public function saveCompany()
    {
        $cadetRoleModel = new \App\Models\cadetRoleModel();
        $validation = $this->validate([
            'company'=>'required',
            'platoon'=>'required',
            'designation'=>'required'
        ]);

        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            $data = [
                'student_id'=>$this->request->getPost('student'),
                'company'=>$this->request->getPost('company'),
                'platoon_type'=>$this->request->getPost('platoon'),
                'designation'=>$this->request->getPost('designation'),
                'others'=>$this->request->getPost('others')
                ];
            $cadetRoleModel->save($data);
            return $this->response->setJSON(['success'=>'Successfully saved']);
        }
    }

    public function fetchGrades()
    {
        $batchName = $this->request->getGet('batchName'); 
        $output="";
        $result = $this->db->table('trainings a')
                    ->select('b.school_id,b.firstname,b.middlename,b.lastname,c.finalScore,c.finalGrade,c.remarks,c.status,c.performance_id')
                    ->join('students b','b.student_id=a.student_id','LEFT')
                    ->join('student_performance c','c.student_id=a.student_id','LEFT')
                    ->where('a.batch_id',$batchName)->groupBy('a.student_id')->get()->getResult();
        foreach($result as $row)
        {
            $output .= '<tr>
                            <td><input type="checkbox" name="student[]" style="width:20px;height:20px;" value="'.$row->performance_id.'" checked/></td>
                            <td>'.$row->school_id.'</td>
                            <td>'.$row->firstname.' '.$row->middlename.' '.$row->lastname.'</td>
                            <td><input type="number" class="form-control" name="score[]" value="'.$row->finalScore.'"/></td>
                            <td><input type="number" class="form-control" name="grade[]" value="'.$row->finalGrade.'"/></td>
                            <td><input type="text" class="form-control" name="remarks[]" value="'.$row->remarks.'"/></td>
                            <td>
                                <select class="form-select" name="status[]">
                                    <option value="">Choose</option>
                                    <option value="1" '.(($row->status == "1") ? "selected" : "").'>Final</option>
                                    <option value="0" '.(($row->status == "0") ? "selected" : "").'>Draft</option>
                                </select>
                            </td>
                        </tr>';
        }
        echo $output;
    }

    public function updateGrades()
    {
        $performance = new performanceModel();
        $student = array_map('strip_tags', (array) $this->request->getPost('student'));
        $score = array_map(fn($q) => (float) strip_tags($q), (array) $this->request->getPost('score')); 
        $grade = array_map(fn($q) => (float) strip_tags($q), (array) $this->request->getPost('grade'));
        $remarks =  array_map('strip_tags', (array) $this->request->getPost('remarks'));
        $status= array_map('strip_tags', (array) $this->request->getPost('status'));

        for($i=0;$i<count($student);$i++)
        {
            $data = [
                'finalScore'=>$score[$i],
                'finalGrade'=>$grade[$i],
                'remarks'=>$remarks[$i],
                'status'=>$status[$i]
                ];
            $performance->update($student[$i],$data);
        }
        //logs  
        date_default_timezone_set('Asia/Manila');
        $logModel = new \App\Models\logModel();
        $data = ['account_id'=>session()->get('loggedAdmin'),
                'activities'=>'Update grades',
                'page'=>'Report',
                'datetime'=>date('Y-m-d h:i:s a')
                ];      
        $logModel->save($data);
        return $this->response->setJSON(['success'=>'Successfully updated']);
    }

    public function saveReport()
    {
        $reportModel = new reportModel();
        $validation = $this->validate([
            'title'=>'required',
            'category'=>'required',
            'report'=>'required',
            'student'=>'required',
            'details'=>'required'
        ]);  
        
        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            $data = [
                    'violation'=>$this->request->getPost('title'),
                    'category'=>$this->request->getPost('category'),
                    'type_report'=>$this->request->getPost('report'),
                    'student_id'=>$this->request->getPost('student'),
                    'details'=>$this->request->getPost('details'),
                    'points'=>0,
                    'status'=>0
                ];
            $reportModel->save($data);
            return $this->response->setJSON(['success'=>'Successfully submitted']);
        }
    }

    public function uploadFile()
    {
        $validation = $this->validate([
            'file'=>[
                'rules' => 'uploaded[file]|mime_in[file,application/zip,application/x-zip-compressed,application/pdf]|max_size[file,25600]',
                'errors' => [
                    'uploaded' => 'You must choose a file to upload.',
                    'mime_in' => 'The file must be either a PDF document.',
                    'max_size' => 'The file size must not exceed 25MB.',
                ]
            ]
        ]);

        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            $fileModel = new scheduleFileModel();
            $file = $this->request->getFile('file');
            if ($file && $file->isValid() && !$file->hasMoved()) 
            {
                $extension = $file->getExtension();
                $originalname = pathinfo($file->getClientName(), PATHINFO_FILENAME);
                $safeName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $originalname);
                $newName = date('YmdHis') . '_' . $safeName . '.' . $extension;
                //create folder
                $folderName = "assets/attachment";
                if (!is_dir($folderName)) {
                    mkdir($folderName, 0755, true);
                }
                $file->move($folderName.'/',$newName);
                $data = [
                    'schedule_id'=>$this->request->getPost('schedule'),
                    'filename'=>$newName
                ];
                $fileModel->save($data);
                return $this->response->setJSON(['success'=>'Successfully uploaded']);
            }
            else
            {
                $errors = ['file'=>'File upload failed or no file selected.'];
                return $this->response->setJSON(['errors'=>$errors]);
            }
        }
    }

    public function viewReport()
    {
        $val = $this->request->getGet('value');
        $model = new reportModel();
        $data = $model->where('report_id',$val)->first();
        return response()->setJSON(['report'=>$data]);
    }

    public function updateReport()
    {
        $model = new reportModel();
        $validation = $this->validate([
            'points'=>'required|numeric|min_length[1]|max_length[5]'
        ]);

        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            $id = $this->request->getPost('reportID');
            $data = ['points'=>$this->request->getPost('points'),'status'=>1];
            $model->update($id,$data);
            return $this->response->setJSON(['success'=>'Successfully submitted']);
        }
    }

    public function generateAttendance()
    {
        $startDate = $this->request->getGet('from');
        $endDate = $this->request->getGet('to');
        $val = $this->request->getGet('batchName');

        $students = $this->db->table('trainings a')
                    ->select('b.school_id,b.firstname,b.middlename,b.lastname,b.student_id')
                    ->join('students b','b.student_id=a.student_id','LEFT')
                    ->where('a.batch_id',$val)->groupBy('a.student_id')->get()->getResult();

        $attendanceModel = new attendanceModel();

        $saturdays = [];
        $period = new DatePeriod(
            new DateTime($startDate),
            new DateInterval('P1D'),
            (new DateTime($endDate))->modify('+1 day')
        );

        foreach ($period as $date) {
            if ($date->format('N') == 6) { 
                $saturdays[] = $date->format('Y-m-d');
            }
        }

        $rows = $attendanceModel->where('date >=', $startDate)
                            ->where('date <=', $endDate)
                            ->findAll();

        $attendance = [];

        foreach ($rows as $row) 
        {
            $attendance[$row['student_id']][$row['date']][$row['remarks']] = $row['time'];
        }

        $html = "";

        foreach ($students as $stu) {

            $html .= "<tr>";
            $html .= "<td>{$stu->lastname},{$stu->firstname} {$stu->middlename}</td>";

            foreach ($saturdays as $sat) 
            {

                $in  = $attendance[$stu->student_id][$sat]['IN']  ?? null ;
                $out = $attendance[$stu->student_id][$sat]['OUT'] ?? null ;

                
                if (!$in && !$out) {
                    $status = "A"; // Absent
                    $class  = "absent";
                } else {
                    $timeIn  = strtotime($in);
                    $timeOut = strtotime($out);

                    if ($timeIn > strtotime("08:00:00")) {
                        $status = "L"; // Late
                        $class  = "late";
                    } elseif ($timeIn <= strtotime("08:00:00") && $timeOut >= strtotime("17:00:00")) {
                        $status = "P"; // Present
                        $class  = "present";
                    } else {
                        $status = "L"; // Any deviation considered Late
                        $class  = "late";
                    }
                }
                $html .= "<td class='{$class}' title='In: {$in}, Out: {$out}'>{$status}</td>";
            }

            $html .= "</tr>";
        }

        return $html;
    }
}