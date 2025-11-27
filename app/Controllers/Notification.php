<?php

namespace App\Controllers;
use App\Models\accountModel;
use Config\Email;
use \App\Models\requestModel;
use \App\Models\studentModel;

class Notification extends BaseController
{   

    public function sendEmail()
    {
        $emailConfig = new Email();
        $fromEmail = $emailConfig->fromEmail;
        $fromName  = $emailConfig->fromName;
        $email = \Config\Services::email();
        $requestModel = new requestModel();
        $model = $requestModel->where('status',1)
                ->where('date_return',date('Y-m-d'))->findAll();
        foreach($model as $row)
        {
            $studentModel = new studentModel();
            $student = $studentModel->where('student_id',$row['student_id'])->first();
            $fullname = $student['firstname']." ".$student['middlename']." ".$student['lastname'];

            $email->setTo($this->request->getPost('email'));
            $email->setFrom($fromEmail, $fromName); 
            $imgURL = "assets/images/logo.jpg";
            $email->attach($imgURL);
            $cid = $email->setAttachmentCID($imgURL);
            $template = "<center>
            <img src='cid:". $cid ."' width='100'/>
            <table style='padding:20px;background-color:#ffffff;' border='0'><tbody>
            <tr><td><center><h1>Reminder: Borrowed Item Due for Return</h1></center></td></tr>
            <tr><td><center>Hi, Mr/Ms ".$fullname."</center></td></tr>
            <tr><td><p><center>This is a reminder that the item you borrowed is now past its due date. Please return it as soon as possible.</center></p></td><tr>
            <tr><td><p><center>If you already return the item(s),<br/> please ignore this message or contact us @ cvsu-ccc-rotc-portal@gmail.com</center></p></td></tr>
            <tr><td><center>IT Support</center></td></tr></tbody></table></center>";
            $subject = "Reminder: Borrowed Item Due for Return | CVSU CC ROTC PORTAL";
            $email->setSubject($subject);
            $email->setMessage($template);
            $email->send();
        }
    }
}