<?php

namespace App\Controllers;
use App\Models\inventoryModel;
use App\Models\studentModel;
use App\Libraries\Hash;
use Config\App;

class Cadet extends BaseController
{   
    private $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        helper(['url', 'form']);
    }

    public function newlyRegistered()
    {
        $searchTerm = $_GET['search']['value'] ?? '';
        $studentModel = new studentModel();
        // Apply the search filter for the main query
        if ($searchTerm) {
            $studentModel->like('surname', $searchTerm)
                         ->orLike('first_name',$searchTerm);   
        }
        // Pagination: Get the 'start' and 'length' from the request (these are sent by DataTables)
        $limit = $_GET['length'] ?? 10;  // Number of records per page, default is 10
        $offset = $_GET['start'] ?? 0;   // Starting record for pagination, default is 0
        // Clone the model for counting filtered records, while keeping the original for data fetching
        $filteredStudentModel = clone $studentModel;
        if ($searchTerm) {
            $filteredStudentModel->like('surname', $searchTerm)
                                ->orLike('first_name',$searchTerm);
        }
        // Fetch filtered records based on limit and offset
        $students = $studentModel->findAll($limit, $offset);  
        // Count total records (without filter)
        $totalRecords = $studentModel->countAllResults();
        // Count filtered records (with filter)
        $filteredRecords = $filteredStudentModel->countAllResults();
        $response = [
            "draw" => $_GET['draw'],
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            'data' => [] 
        ];
        foreach ($students as $row) {
            $response['data'][] = [
            ];
        }
        return $this->response->setJSON($response);
    }

    public function qrCode()
    {
        $qrcodeModel = new \App\Models\qrcodeModel();
        //count the number of request
        $query = $this->db->table('qrcodes')->select('COUNT(*)+1 as total')->get()->getRow();
        $code = "CN-" . str_pad($query->total, 7, '0', STR_PAD_LEFT);
        function generateRandomString($length = 64) {
            // Generate random bytes and convert them to hexadecimal
            $bytes = random_bytes($length);
            return substr(bin2hex($bytes), 0, $length);
        }
        $token = generateRandomString();
        $data = [
            'student_id'=>session()->get('loggedUser'),
            'control_number'=>$code,
            'token'=>$token
        ];
        $qrcodeModel->save($data);
        return $this->response->setJSON(['success'=>'Successfully generated']);
    }

    public function sendItems()
    {
        $model = new \App\Models\requestModel();
        $inventoryModel = new inventoryModel();
        $validation = $this->validate([
            'item'=>'required',
            'qty'=>'required|numeric',
            'date'=>'required'
        ]);

        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            $item = $this->request->getPost('item');
            $qty = $this->request->getPost('qty');
            $inventory = $inventoryModel->where('inventory_id',$item)->first();
            if($qty>$inventory['quantity'])
            {
                $errors = ['item'=>'Your request exceeds the available stock'];
                return $this->response->setJSON(['errors'=>$errors]);
            }
            else
            {
                $data = [
                        'student_id'=>session()->get('loggedUser'),
                        'item'=>$inventory['item'],
                        'qty'=>$qty,
                        'date_return'=>$this->request->getPost('date'),
                        'status'=>0
                        ] ;
                $model->save($data);
                return $this->response->setJSON(['success'=>'Successfully sent']);
            }
        }
    }

    public function cancelItems()
    {
        $model = new \App\Models\requestModel();
        $val = $this->request->getPost('value');
        $data = ['status'=>2];
        $model->update($val,$data);
        return $this->response->setJSON(['success'=>'Successfully applied changes']);
    }

    public function changePassword()
    {
        $studentModel = new studentModel();
        $user = session()->get('loggedUser');
        $validation = $this->validate([
            'current' => [
                'rules' => 'required|min_length[8]|max_length[20]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/]',
                'errors' => [
                    'required' => 'Password is required',
                    'min_length' => 'Password must be at least 8 characters long',
                    'max_length' => 'Password cannot exceed 20 characters',
                    'regex_match' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character'
                ]
            ],
            'new_password' => [
                'rules' => 'required|min_length[8]|max_length[20]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/]',
                'errors' => [
                    'required' => 'New Password is required',
                    'min_length' => 'Password must be at least 8 characters long',
                    'max_length' => 'Password cannot exceed 20 characters',
                    'regex_match' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character'
                ]
            ],
            'confirm_password'=>[
                'rules'=>'required|matches[new_password]',
                'errors'=>[
                    'required'=>'Re-type your password',
                    'matches'=>'Password do not match'
                ]
            ],
        ]);
        if(!$validation)
        {
            return $this->response->SetJSON(['error' => $this->validator->getErrors()]);
        }
        else
        {
            $oldpassword = $this->request->getPost('current');
            $newpassword = $this->request->getPost('new_password');

            $account = $studentModel->WHERE('student_id',$user)->first();
            $checkPassword = Hash::check($oldpassword,$account['password']);
            if(!$checkPassword||empty($checkPassword))
            {
                $error = ['current'=>'Password mismatched. Please try again'];
                return $this->response->SetJSON(['error' => $error]);
            }
            else
            {
                if(($oldpassword==$newpassword))
                {
                    $error = ['new_password'=>'The new password cannot be the same as the current password.'];
                    return $this->response->SetJSON(['error' => $error]);
                }
                else
                {
                    $HashPassword = Hash::make($newpassword);
                    $data = ['password'=>$HashPassword];
                    $studentModel->update($user,$data);
                    return $this->response->setJSON(['success' => 'Successfully submitted']);
                }
            }
        }
    }
}