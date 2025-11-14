<?php

namespace App\Controllers;
use Config\App;
use \App\Models\cadetTrainingModel;

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
                    $data = [
                        'student_id'=>$this->request->getPost('cadet'),
                        'schedule_id'=>$schedule[$i],
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
}