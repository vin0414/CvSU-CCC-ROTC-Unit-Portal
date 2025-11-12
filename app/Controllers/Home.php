<?php

namespace App\Controllers;
use App\Libraries\Hash;
use Config\Email;
use \App\Models\cadetModel;
use \App\Models\favoriteModel;
use \App\Models\qrcodeModel;
use \App\Models\attendanceModel;

class Home extends BaseController
{
    private $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        helper(['url', 'form','text']);
    }

    public function scanner()
    {
        $data['title']='Scan QRCode';
        return view('scanner',$data);
    }

    public function signUp()
    {
        return view('sign-up',['validation' => \Config\Services::validation()]);
    }

    public function register()
    {
        $validation = $this->validate([
            'name'=>'required|is_unique[students.fullname]',
            'school_id'=>'required|is_unique[students.school_id]',
            'email'=>'required|valid_email|is_unique[students.email]',
            'password' => [
                'rules' => 'required|min_length[8]|max_length[20]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password must be at least 8 characters long',
                    'max_length' => 'Password cannot exceed 20 characters',
                    'regex_match' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character'
                ]
            ],
            'confirm_password'=>[
                'rules'=>'required|matches[password]',
                'errors'=>[
                    'required'=>'Re-type your password',
                    'matches'=>'Password do not match'
                ]
            ],
            'agreement'=>'required'
        ]);
        if(!$validation)
        {
            return view('sign-up',['validation'=>$this->validator]);
        }
        else
        {
            $hash_password = Hash::make($this->request->getPost('password'));
            function generateRandomString($length = 64) {
                // Generate random bytes and convert them to hexadecimal
                $bytes = random_bytes($length);
                return substr(bin2hex($bytes), 0, $length);
            }
            $token_code = generateRandomString();
            //save
            $userModel = new \App\Models\studentModel();
            $data = [
                    'school_id'=>$this->request->getPost('school_id'), 
                    'password'=>$hash_password,
                    'fullname'=>$this->request->getPost('name'),
                    'email'=>$this->request->getPost('email'),
                    'status'=>0,
                    'is_enroll'=>0,
                    'photo'=>'',
                    'token'=>$token_code,
                    ];
            $userModel->save($data);
            //send email activation link
            $emailConfig = new Email();
            $fromEmail = $emailConfig->fromEmail;
            $fromName  = $emailConfig->fromName;
            $email = \Config\Services::email();
            $email->setTo($this->request->getPost('email'));
            $email->setFrom($fromEmail, $fromName); 
            $imgURL = "assets/images/logo.jpg";
            $email->attach($imgURL);
            $cid = $email->setAttachmentCID($imgURL);
            $template = "<center>
            <img src='cid:". $cid ."' width='100'/>
            <table style='padding:20px;background-color:#ffffff;' border='0'><tbody>
            <tr><td><center><h1>Account Activation</h1></center></td></tr>
            <tr><td><center>Hi, ".$this->request->getPost('name')."</center></td></tr>
            <tr><td><p><center>Please click the link below to activate your account.</center></p></td><tr>
            <tr><td><center><b>".anchor('activate/'.$token_code,'Activate Account')."</b></center></td></tr>
            <tr><td><p><center>If you did not sign-up in CVSU-CCC ROTC PORTAL,<br/> please ignore this message or contact us @ cvsu-ccc-rotc-portal@gmail.com</center></p></td></tr>
            <tr><td><center>IT Support</center></td></tr></tbody></table></center>";
            $subject = "Account Activation | CVSU-CCC ROTC PORTAL";
            $email->setSubject($subject);
            $email->setMessage($template);
            $email->send();
            session()->setFlashdata('success','Great! Successfully sent activation link');
            return redirect()->to('success/'.$token_code)->withInput();
        }
    }

    public function successLink($id)
    {
        $data = ['token'=>$id];
        return view('success',$data);
    }

    public function resend($id)
    {
        $userModel = new \App\Models\studentModel();
        $user = $userModel->WHERE('token',$id)->first();
        //send email activation link
        $emailConfig = new Email();
        $fromEmail = $emailConfig->fromEmail;
        $fromName  = $emailConfig->fromName;
        $email = \Config\Services::email();
        $email->setTo($user['email']);
        $email->setFrom($fromEmail, $fromName); 
        $imgURL = "assets/images/logo.jpg";
        $email->attach($imgURL);
        $cid = $email->setAttachmentCID($imgURL);
        $template = "<center>
        <img src='cid:". $cid ."' width='100'/>
        <table style='padding:20px;background-color:#ffffff;' border='0'><tbody>
        <tr><td><center><h1>Account Activation</h1></center></td></tr>
        <tr><td><center>Hi, ".$user['fullname']."</center></td></tr>
        <tr><td><p><center>Please click the link below to activate your account.</center></p></td><tr>
        <tr><td><center><b>".anchor('activate/'.$id,'Activate Account')."</b></center></td></tr>
        <tr><td><p><center>If you did not sign-up in CVSU-CCC ROTCL PORTAL Website,<br/> please ignore this message or contact us @ cvsu-ccc-rotc-portalb@gmail.com</center></p></td></tr>
        <tr><td><center>IT Support</center></td></tr></tbody></table></center>";
        $subject = "Account Activation | CVSU-CCC ROTC PORTAL";
        $email->setSubject($subject);
        $email->setMessage($template);
        $email->send();
        session()->setFlashdata('success','Great! Successfully sent activation link');
        return redirect()->to('success/'.$id)->withInput();
    }

    public function activateAccount($id)
    {
        $userModel = new \App\Models\studentModel();
        $student = $userModel->WHERE('token',$id)->first();
        $values = ['status'=>1];
        $userModel->update($student['student_id'],$values);
        session()->set('loggedUser', $student['student_id']);
        session()->set('fullname',$student['fullname']);
        session()->set('student_number',$student['school_id']);
        return $this->response->redirect(site_url('cadet/dashboard'));
    }

    public function index(): string
    {
        return view('welcome_message',['validation' => \Config\Services::validation()]);
    }

    public function validateUser()
    {
        $studentModel = new \App\Models\studentModel();
        $validation = $this->validate([
            'student_number' => [
                'rules' => 'required|is_not_unique[students.school_id]',
                'errors' => [
                    'required' => 'Student Number is required',
                    'is_not_unique' => 'Student Number does not exist'
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
            return view('welcome_message', [
                'validation' => $this->validator
            ]); 
        }
        else
        {
            $student_number = $this->request->getPost('student_number');
            $password = $this->request->getPost('password');

            $student = $studentModel->where('school_id', $student_number)->where('status',1)->first();

            if($student)
            {
                if(Hash::check($password, $student['password']))
                {
                    session()->set('loggedUser', $student['student_id']);
                    session()->set('fullname',$student['fullname']);
                    session()->set('student_number',$student['school_id']);
                    return redirect()->to(base_url('cadet/dashboard'));
                }
                else 
                {
                    session()->setFlashdata('fail','Invalid Password');
                    return redirect()->to('/')->withInput();
                }
            }
            else
            {
                session()->setFlashdata('fail','Student Number does not exist');
                return redirect()->to('/')->withInput();
            }
        }
    }

    public function logout()
    {
        if(session()->has('loggedUser'))
        {
            session()->remove('loggedUser');
            session()->destroy();
            return redirect()->to('/?access=out')->with('fail', 'You are logged out!');
        }
    }

    public function forgotPassword()
    {
       return view('forgot-password',['validation' => \Config\Services::validation()]);
    }
    public function newPassword()
    {
        $validation = $this->validate([
            'email' => [
                'rules' => 'required|valid_email|is_not_unique[students.email]',
                'errors' => [
                    'required' => 'Email is required',
                    'valid_email' => 'Please enter a valid email address',
                    'is_not_unique' => 'Email does not exist'
                ]
            ]
        ]);

        if(!$validation)
        {
            return view('forgot-password', [
                'validation' => $this->validator
            ]); 
        }
        else
        {
            $email = $this->request->getPost('email');
            $studentModel = new \App\Models\StudentModel();
            $student = $studentModel->where('email', $email)->first();
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ?!@#$%^&*()_+';
                function generate_string($input, $strength = 16) {
                    $input_length = strlen($input);
                    $random_string = '';
                    for($i = 0; $i < $strength; $i++) {
                        $random_character = $input[random_int(0, $input_length - 1)];
                        $random_string .= $random_character;
                    }
                    return $random_string;
                }

            $newPassword = generate_string($permitted_chars, 16);
            $hashedPassword = Hash::make($newPassword);
            $studentModel->update($student['student_id'], ['password' => $hashedPassword]); 
            $fullname = $student['first_name'] . ' ' . $student['middle_name'] . ' ' . $student['surname'];
            // Send email with new password       
            $emailConfig = new Email();
            $fromEmail = $emailConfig->fromEmail;
            $fromName  = $emailConfig->fromName;  
            $email = \Config\Services::email();
            $email->setTo($student['email']);
            $email->setFrom($fromEmail,$fromName);
            $imgURL = "assets/images/logo.png";
            $email->attach($imgURL);
            $cid = $email->setAttachmentCID($imgURL);
            $template = "<center>
            <img src='cid:". $cid ."' width='100'/>
            <table style='padding:20px;background-color:#ffffff;' border='0'><tbody>
            <tr><td><center><h1>New Password</h1></center></td></tr>
            <tr><td><center>Hi, ".$fullname."</center></td></tr>
            <tr><td><p><center>We hope this email finds you well. This message is to inform you that your password has been successfully reset. Your new password is: </center></p></td><tr>
            <tr><td><center><b>".$newPassword."</b></center></td></tr>
            <tr><td><p><center>For security purposes, we strongly advise you to change this password once you log in to our website.</center></p></td></tr>
            <tr><td><p><center>If you did not request in CvSU CCC ROTC Unit Portal,<br/> please ignore this message or contact us @ division.gentri@deped.gov.ph</center></p></td></tr>
            <tr><td><center>IT Support</center></td></tr></tbody></table></center>";
            $subject = "New Password | CvSU-CCC ROTC Unit Portal";
            $email->setSubject($subject);
            $email->setMessage($template);
            if (!$email->send()) {
                session()->setFlashdata('fail','Failed to send email');
                return redirect()->to('/forgot-password');
            }
            log_message('info', 'Email sent to: ' . $student['email']);
            log_message('info', 'New password: ' . $newPassword);
            session()->setFlashdata('success','New password has been sent to your email');
            return redirect()->to('/forgot-password');
        }
    }

    public function studentDashboard()
    {
        $session = session();
        if($session->get('loggedUser') == null)
        {
            return redirect()->to(base_url('/'));
        }
        else
        {
            //check if cadets is empty
            $cadetModel = new cadetModel();
            $cadet = $cadetModel->where('student_id',session()->get('loggedUser'))->first();
            if(empty($cadet))
            {
                return redirect()->to(base_url('cadet/profile'));
            }
            $data['fullname'] = $session->get('fullname');
            $data['title']= 'Dashboard';
            //announcement
            $model = new \App\Models\announcementModel();
            $data['announcement'] = $model->orderBy('announcement_id','DESC')->limit(5)->findAll();
            //favorites
            $favorite = new favoriteModel();
            $data['favorite'] = $favorite->where('student_id',session()->get('loggedUser'))->findAll();
            return view('cadet/dashboard', $data);
        }
    }

    public function studentProfile()
    {
        $data['title'] = "Cadet Profile";
        $cadetModel = new cadetModel();
        $data['cadet'] = $cadetModel->where('student_id',session()->get('loggedUser'))->first();
        return view('cadet/profile',$data);
    }

    public function qrCode()
    {
        $data['title'] = "My QR Code";
        //check if cadets is empty
        $studentModel = new \App\Models\studentModel();
        $qrcodeModel = new qrcodeModel();
        $qrcode = $qrcodeModel->where('student_id',session()->get('loggedUser'))->first();
        $student = $studentModel->where('student_id',session()->get('loggedUser'))->first();
        if(empty($student))
        {
            return redirect()->to(base_url('cadet/profile'));
        }

        $data['student']=$student;
        $data['qrcode'] = $qrcode;
        return view('cadet/qrcode',$data);
    }

    public function upload()
    {
        $data['title']="Upload File";
        $attachmentModel = new \App\Models\attachmentModel();
        $data['attachment'] = $attachmentModel->where('student_id',session()->get('loggedUser'))->first();
        return view('cadet/upload',$data);
    }
    

    public function removeFile()
    {
        $val = $this->request->getPost('value');
        $attachmentModel = new \App\Models\attachmentModel();
        //delete the file
        $attachment = $attachmentModel->WHERE('attachment_id',$val)->first();
        $filePath = FCPATH . 'assets/files/' . $attachment['file'];
        if (file_exists($filePath)) 
        {
            if (unlink($filePath)) {
                // echo "success";
            } else {
                echo "Failed to delete the file.";
            }
        }
        $data = ['student_id'=>0];
        $attachmentModel->update($val,$data);
        echo "success";
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
            $errors = $this->validator->getErrors();
            session()->setFlashdata('fail',implode('<br>',$errors));
            return redirect()->back()->withInput();
        }
        else
        {
            $attachmentModel = new \App\Models\attachmentModel();
            //uploading
            $file = $this->request->getFile('file');
            if ($file && $file->isValid() && !$file->hasMoved()) 
            {
                $extension = $file->getExtension();
                $originalname = pathinfo($file->getClientName(), PATHINFO_FILENAME);
                $safeName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $originalname);
                $newName = date('YmdHis') . '_' . $safeName . '.' . $extension;
                //create folder
                $folderName = "assets/files";
                if (!is_dir($folderName)) {
                    mkdir($folderName, 0755, true);
                }
                $file->move($folderName.'/',$newName);
                $attachment = $attachmentModel->WHERE('student_id',session()->get('loggedUser'))->first();
                $data = ['student_id'=>session()->get('loggedUser'),'file'=>$newName];
                if(empty($attachment))
                {
                    $attachmentModel->save($data);
                }
                else
                {
                    
                    $attachmentModel->update($attachment['attachment_id'],$data);
                }
                session()->setFlashdata('success','Successfully uploaded');
                return redirect()->back()->withInput();
            }
            else
            {
                session()->setFlashdata('fail','File upload failed or no file selected.');
                return redirect()->back()->withInput();
            }
        }
    }

    public function studentTrainings()
    {
        $data['title'] = "My Trainings";
        //check if cadets is empty
        $cadetModel = new cadetModel();
        $cadet = $cadetModel->where('student_id',session()->get('loggedUser'))->first();
        if(empty($cadet))
        {
            return redirect()->to(base_url('cadet/profile'));
        }
        return view('cadet/trainings',$data);
    }

    public function studentAttendance()
    {
        $data['title'] = "My Attendance";
        //check if cadets is empty
        $cadetModel = new cadetModel();
        $cadet = $cadetModel->where('student_id',session()->get('loggedUser'))->first();
        if(empty($cadet))
        {
            return redirect()->to(base_url('cadet/profile'));
        }
        $qrcodeModel = new qrcodeModel();
        $attendanceModel = new attendanceModel();
        //total attendance
        $data['totalAttendance'] = $attendanceModel->where('student_id',session()->get('loggedUser'))
                        ->whereIn('remarks',['In','Out'])
                        ->groupBy('date')
                        ->countAllResults();
        //late attendance
        $data['late'] = $attendanceModel->where('student_id',session()->get('loggedUser'))
                        ->where('remarks','In')
                        ->where('time >','08:00')
                        ->countAllResults();
        $data['qrcode'] = $qrcodeModel->where('student_id',session()->get('loggedUser'))->first();
        $data['attendance'] = $attendanceModel->where('student_id',session()->get('loggedUser'))
                                ->orderBy('attendance_id','DESC')->limit(10)
                                ->findAll();
        $summary = $this->db->table('attendance a')
                    ->select('a.date,b.school_id,
                    MAX(CASE WHEN a.remarks = "Out" THEN a.time END) timeOut,
                    MIN(CASE WHEN a.remarks = "In" THEN a.time END) timeIn,
                    SEC_TO_TIME(TIME_TO_SEC(TIMEDIFF(
                            MAX(CASE WHEN a.remarks = "Out" THEN a.time END),
                            MIN(CASE WHEN a.remarks = "In" THEN a.time END)
                        ))) AS hours,a.token')
                    ->join('students b','b.student_id=a.student_id','LEFT')
                    ->where('a.student_id',session()->get('loggedUser'))
                    ->groupBy('a.date,a.student_id')
                    ->get()->getResult();
        $data['summary']=$summary;
        return view('cadet/attendance',$data);
    }

    public function studentPerformance()
    {
        $data['title'] = "My Performance";
        //check if cadets is empty
        $cadetModel = new cadetModel();
        $cadet = $cadetModel->where('student_id',session()->get('loggedUser'))->first();
        if(empty($cadet))
        {
            return redirect()->to(base_url('cadet/profile'));
        }
        return view('cadet/performance',$data);
    }

    public function accountSecurity()
    {
        $data['title'] = "Account Security";
        return view('cadet/account',$data);
    }

    //functions for cadet
    public function saveProfile()
    {
        $cadetModel = new cadetModel();
        $validation = $this->validate([
            'birth_date'=>['rules'=>'required','errors'=>['required'=>'Birth Date is required']],
            'height'=>['rules'=>'required','errors'=>['required'=>'Height is required']],
            'weight'=>['rules'=>'required','errors'=>['required'=>'Weight is required']],
            'blood_type'=>['rules'=>'required','errors'=>['required'=>'Enter blood type']],
            'gender'=>['rules'=>'required','errors'=>['required'=>'Select gender']],
            'religion'=>['rules'=>'required','errors'=>['required'=>'Enter your religion']],
            'house_no'=>['rules'=>'required','errors'=>['required'=>'House Number is required']],
            'street'=>['rules'=>'required','errors'=>['required'=>'Street is required']],
            'village'=>['rules'=>'required','errors'=>['required'=>'Village is required']],
            'municipality'=>['rules'=>'required','errors'=>['required'=>'Municipality is required']],
            'province'=>['rules'=>'required','errors'=>['required'=>'Province is required']],
            'course'=>['rules'=>'required','errors'=>['required'=>'Enter your course']],
            'year'=>['rules'=>'required','errors'=>['required'=>'Year is required']],
            'section'=>['rules'=>'required','errors'=>['required'=>'Enter your section']],
            'school'=>['rules'=>'required','errors'=>['required'=>'Enter the name of school attended']],
            'contact_no'=>['rules'=>'required','errors'=>['required'=>'Enter your contact number']],
            'fb_account'=>['rules'=>'required','errors'=>['required'=>'Enter your facebook account URL']],
            'email'=>['rules'=>'required|valid_email','errors'=>['required'=>'Email is required','valid_email'=>'Enter valid email address']],
            'm_surname'=>['rules'=>'required','errors'=>['required'=>"Enter your mother's surname"]],
            'm_firstname'=>['rules'=>'required','errors'=>['required'=>"Enter your mother's first name"]],
            'm_middlename'=>['rules'=>'required','errors'=>['required'=>"Enter your mother's middle name"]],
            'm_contact_no'=>['rules'=>'required','errors'=>['required'=>"Enter your mother's contact number"]],
            'm_occupation'=>['rules'=>'required','errors'=>['required'=>"Enter your mother's occupation"]],
            'f_surname'=>['rules'=>'required','errors'=>['required'=>"Enter your father's surname"]],
            'f_firstname'=>['rules'=>'required','errors'=>['required'=>"Enter your father's first name"]],
            'f_middlename'=>['rules'=>'required','errors'=>['required'=>"Enter your father's middle name"]],
            'f_contact_no'=>['rules'=>'required','errors'=>['required'=>"Enter your father's contact number"]],
            'f_occupation'=>['rules'=>'required','errors'=>['required'=>"Enter your father's occupation"]],
            'address'=>['rules'=>'required','errors'=>['required'=>"Address is required"]],
            'relationship'=>['rules'=>'required','errors'=>['required'=>"Relationship is required"]],
            'contact_person'=>['rules'=>'required','errors'=>['required'=>"Contact Person is required"]],
            'contact_email'=>['rules'=>'required|valid_email','errors'=>['required'=>"Contact email is required",'valid_email'=>'Enter valid email address']],
        ]);

        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            //generate token
            function generateRandomString($length = 64) {
                // Generate random bytes and convert them to hexadecimal
                $bytes = random_bytes($length);
                return substr(bin2hex($bytes), 0, $length);
            }
            $token = generateRandomString();
            $data = [
                'student_id'=>session()->get('loggedUser'),
                'house_no'=>$this->request->getPost('house_no'),
                'street'=>$this->request->getPost('street'),
                'village'=>$this->request->getPost('village'),
                'municipality'=>$this->request->getPost('municipality'),
                'province'=>$this->request->getPost('province'),
                'course'=>$this->request->getPost('course'),
                'year'=>$this->request->getPost('year'),
                'section'=>$this->request->getPost('section'),
                'school_attended'=>$this->request->getPost('school'),
                'birthdate'=>$this->request->getPost('birth_date'),
                'height'=>$this->request->getPost('height'),
                'weight'=>$this->request->getPost('weight'),
                'blood_type'=>$this->request->getPost('blood_type'),
                'gender'=>$this->request->getPost('gender'),
                'religion'=>$this->request->getPost('religion'),
                'contact_no'=>$this->request->getPost('contact_no'),
                'fb_account'=>$this->request->getPost('fb_account'),
                'email'=>$this->request->getPost('email'),
                'mother_sname'=>$this->request->getPost('m_surname'),
                'mother_fname'=>$this->request->getPost('m_firstname'),
                'mother_mname'=>$this->request->getPost('m_middlename'),
                'mother_contact'=>$this->request->getPost('m_contact_no'),
                'mother_work'=>$this->request->getPost('m_occupation'),
                'father_sname'=>$this->request->getPost('f_surname'),
                'father_fname'=>$this->request->getPost('f_firstname'),
                'father_mname'=>$this->request->getPost('f_middlename'),
                'father_contact'=>$this->request->getPost('f_contact_no'),
                'father_work'=>$this->request->getPost('f_occupation'),
                'emergency_address'=>$this->request->getPost('address'),
                'relationship'=>$this->request->getPost('relationship'),
                'emergency_contact'=>$this->request->getPost('contact_person'),
                'emergency_email'=>$this->request->getPost('contact_email'),
                'token'=>$token
            ];
            if(empty($this->request->getPost('cadet_id')))
            {
                $cadetModel->save($data);
            }
            else
            {
                $cadetModel->update($this->request->getPost('cadet_id'),$data);
            }
            return $this->response->setJSON(['success'=>"Success"]);
        }
    }
}