<?php

namespace App\Controllers;
use Config\App;
use \App\Models\cadetTrainingModel;
use \App\Models\performanceModel;
use \App\Models\classModel;
use \App\Models\scheduleModel;

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
                        'class_id'=>$classID['class_id'],
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
        $classModel = new classModel();
        $validation = $this->validate([
            'year'=>'required',
            'semester'=>'required',
            'subject'=>'required|numeric',
            'className'=>['rules'=>'required','errors'=>[
                'required'=>'Name of class is required'
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
                    'subject_id'=>$this->request->getPost('subject'),
                    'className'=>$this->request->getPost('className'),
                    'section'=>$this->request->getPost('section'),
                    'status'=>1
                ];
            $classModel->save($data);
            //logs  
            date_default_timezone_set('Asia/Manila');
            $logModel = new \App\Models\logModel();
            $data = ['account_id'=>session()->get('loggedAdmin'),
                    'activities'=>'Add new class',
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
        $classModel = new classModel();
        $class = $classModel->where('subject_id',$val)->findAll();
        foreach($class as $row)
        {
            $output.='<tr>
                        <td>'.$row['school_year'].'</td>
                        <td>'.$row['semester'].'</td>
                        <td>'.$row['className'].'</td>
                        <td>'.$row['section'].'</td>
                     </tr>';
        }
        echo $output;
    }

    public function fetchSubjectClass()
    {
        $model = new classModel();
        $semester = $this->request->getGet('semester');
        $year = $this->request->getGet('year');
        $subject = $this->request->getGet('subject');
        $class = $model->where('school_year',$year)
                        ->where('semester',$semester)
                        ->where('subject_id',$subject)
                        ->findAll();
        return $this->response->setJSON(['class'=>$class]);
    }

    public function fetchList()
    {
        $model = new classModel();
        $semester = $this->request->getGet('semester');
        $year = $this->request->getGet('year');
        $class = $model->where('school_year',$year)
                        ->where('semester',$semester)
                        ->findAll();
        return $this->response->setJSON(['class'=>$class]);
    }

    public function listAttendance()
    {
        $className = $this->request->getGet('className');
        $output="";
        $result = $this->db->table('trainings a')
                    ->select('b.course,b.year,b.section,c.firstname,c.middlename,c.lastname,c.school_id')
                    ->join('cadets b','b.student_id=a.student_id','LEFT')
                    ->join('students c','c.student_id=a.student_id','LEFT')
                    ->where('a.class_id',$className)->groupBy('a.student_id')->get()->getResult();
        foreach($result as $row)
        {
            $output.='<tr>
                        <td>'.$row->school_id.'</td>
                        <td>'.$row->firstname.' '.$row->middlename.' '.$row->lastname.'</td>
                        <td>'.$row->course.'</td>
                        <td>'.$row->year.'</td>
                        <td>'.$row->section.'</td>
                     </tr>';
        }
        echo $output;
    }

    public function fetchGrades()
    {
       $className = $this->request->getGet('className'); 
       $output="";
        $result = $this->db->table('trainings a')
                    ->select('b.firstname,b.middlename,b.lastname,c.finalScore,c.finalGrade,c.remarks,c.status')
                    ->join('students b','b.student_id=a.student_id','LEFT')
                    ->join('student_performance c','c.student_id=a.student_id','LEFT')
                    ->where('a.class_id',$className)->groupBy('a.student_id')->get()->getResult();
        foreach($result as $row)
        {
            $output.='<tr>
                        <td>'.$row->firstname.' '.$row->middlename.' '.$row->lastname.'</td>
                        <td><input type="number" class="form-control" name="score[]" value="'.$row->finalScore.'"/></td>
                        <td><input type="number" class="form-control" name="grade[]" value="'.$row->finalGrade.'"/></td>
                        <td><input type="text" class="form-control" name="remarks[]" value="'.$row->remarks.'"/></td>
                        <td>
                            <select class="form-select" name="status[]">
                                <option value="">Choose</option>
                                <option value="1">Final</option>
                                <option value="0">Draft</option>
                            </select>
                        </td>
                     </tr>';
        }
        echo $output;
    }
}