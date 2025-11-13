<?php

namespace App\Controllers;
use App\Models\studentModel;
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
}