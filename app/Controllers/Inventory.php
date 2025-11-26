<?php

namespace App\Controllers;
use App\Models\studentModel;
use Config\App;
use \App\Models\categoryModel;
use \App\Models\inventoryModel;
use \App\Models\damageModel;
use \App\Models\borrowModel;
use \App\Models\returnModel;
use \App\Models\purchaseModel;

class Inventory extends BaseController
{   
    private $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        helper(['url', 'form']);
    }

    public function addCategory()
    {
        $categoryModel = new categoryModel();
        $validation = $this->validate([
            'category'=>'required',
        ]);
        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            $data = [
                'categoryName'=>$this->request->getPost('category'),
                'account_id'=>session()->get('loggedAdmin')
            ];
            $categoryModel->save($data);
            //logs  
            date_default_timezone_set('Asia/Manila');
            $logModel = new \App\Models\logModel();
            $data = ['account_id'=>session()->get('loggedAdmin'),
                    'activities'=>'Add new category',
                    'page'=>'Inventory',
                    'datetime'=>date('Y-m-d h:i:s a')
                    ];      
            $logModel->save($data);
            return $this->response->setJSON(['success'=>'Successfully saved']);
        }
    }

    public function editCategory()
    {
        $categoryModel = new categoryModel();
        $val = $this->request->getPost('value');
        $name = $this->request->getPost('name');
        $data = [
                'categoryName'=>$name,
            ];
        $categoryModel->update($val,$data);
        //logs  
        date_default_timezone_set('Asia/Manila');
        $logModel = new \App\Models\logModel();
        $data = ['account_id'=>session()->get('loggedAdmin'),
                'activities'=>'Edit category',
                'page'=>'Inventory',
                'datetime'=>date('Y-m-d h:i:s a')
                ];      
        $logModel->save($data);
        return $this->response->setJSON(['success'=>'Successfully saved']);
    }

    public function fetchCategory()
    {
        $model = new categoryModel();
        $searchTerm = $_GET['search']['value'] ?? '';
        if ($searchTerm) {
            $model->like('categoryName', $searchTerm);
        }
        $limit = $_GET['length'] ?? 10;
        $offset = $_GET['start'] ?? 0; 
        $filteredmodel = clone $model;
        if ($searchTerm) {
            $filteredmodel->like('categoryName', $searchTerm);
        }
        $students = $model->findAll($limit, $offset);  
        $totalRecords = $model->countAllResults();
        $filteredRecords = $filteredmodel->countAllResults();
        $response = [
            "draw" => $_GET['draw'],
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            'data' => [] 
        ];
        foreach ($students as $row) {
            $response['data'][] = [
                'date'=>date('M d, Y h:i:s a',strtotime($row['created_at'])),
                'category' => $row['categoryName'],
                'action'=>'<button type="button" class="btn btn-primary edit" value="'.$row['category_id'].'"><i class="ti ti-edit"></i>&nbsp;Edit</button>'
            ];
        }
        return $this->response->setJSON($response);
    }

    public function saveItem()
    {
        $model = new inventoryModel();
        $validation = $this->validate([
            'category'=>'required',
            'item'=>'required',
            'units'=>'required',
            'quantity'=>'required|numeric',
            'price'=>'required',
            'minimum'=>'required|numeric',
            'maximum'=>'required|numeric',
            'details'=>'required'
        ]);

        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            $amount = str_replace(",","",$this->request->getPost('price'));
            $data = [
                'category_id'=>$this->request->getPost('category'),
                'item'=>$this->request->getPost('item'),
                'units'=>$this->request->getPost('units'),
                'quantity'=>$this->request->getPost('quantity'),
                'price'=>$amount,
                'details'=>$this->request->getPost('details'),
                'min'=>$this->request->getPost('minimum'),
                'max'=>$this->request->getPost('maximum'),
                'status'=>1
            ];
            $model->save($data);
            //logs  
            date_default_timezone_set('Asia/Manila');
            $logModel = new \App\Models\logModel();
            $data = ['account_id'=>session()->get('loggedAdmin'),
                    'activities'=>'Add new item',
                    'page'=>'Inventory',
                    'datetime'=>date('Y-m-d h:i:s a')
                    ];      
            $logModel->save($data);
            return $this->response->setJSON(['success'=>'Successfully saved']);
        }
    }

    public function editItem()
    {
        $model = new inventoryModel();
        $validation = $this->validate([
            'category'=>'required',
            'item'=>'required',
            'units'=>'required',
            'quantity'=>'required|numeric',
            'price'=>'required',
            'minimum'=>'required|numeric',
            'maximum'=>'required|numeric',
            'details'=>'required'
        ]);

        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            $id = $this->request->getPost('id');
            $amount = str_replace(",","",$this->request->getPost('price'));
            $data = [
                'category_id'=>$this->request->getPost('category'),
                'item'=>$this->request->getPost('item'),
                'units'=>$this->request->getPost('units'),
                'quantity'=>$this->request->getPost('quantity'),
                'price'=>$amount,
                'details'=>$this->request->getPost('details'),
                'min'=>$this->request->getPost('minimum'),
                'max'=>$this->request->getPost('maximum'),
                'status'=>1
            ];
            $model->update($id,$data);
            //logs  
            date_default_timezone_set('Asia/Manila');
            $logModel = new \App\Models\logModel();
            $data = ['account_id'=>session()->get('loggedAdmin'),
                    'activities'=>'modify the selected item',
                    'page'=>'Inventory',
                    'datetime'=>date('Y-m-d h:i:s a')
                    ];      
            $logModel->save($data);
            return $this->response->setJSON(['success'=>'Successfully saved']);
        }
    }

    public function damageItem()
    {
        $model = new inventoryModel();
        $damage = new damageModel();
        $validation = $this->validate([
            'quantity'=>'required|numeric',
            'reason'=>'required'
        ]);
        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            $data = [
                    'inventory_id'=>$this->request->getPost('damageID'),
                    'qty'=>$this->request->getPost('quantity'),
                    'reason'=>$this->request->getPost('reason'),
                    'status'=>0
                ];
            $damage->save($data);
            //deduct the items
            $inventory = $model->where('inventory_id',$this->request->getPost('damageID'))->first();
            $oldQty = $inventory['quantity'];
            $newQty = $oldQty-$this->request->getPost('quantity');
            $records = ['quantity'=>$newQty];
            $model->update($this->request->getPost('damageID'),$records);
            //logs  
            date_default_timezone_set('Asia/Manila');
            $logModel = new \App\Models\logModel();
            $data = ['account_id'=>session()->get('loggedAdmin'),
                    'activities'=>'Tag item as damaged. Qty :'.$this->request->getPost('quantity'),
                    'page'=>'Inventory',
                    'datetime'=>date('Y-m-d h:i:s a')
                    ];      
            $logModel->save($data);
            return $this->response->setJSON(['success'=>'Successfully saved']);
        }
    }

    public function restoreItem()
    {
        $model = new inventoryModel();
        $damageModel = new damageModel();
        $val = $this->request->getPost('value');
        $damage = $damageModel->where('damaged_id',$val)->first();
        //restore the quantity
        $inventory = $model->where('inventory_id',$damage['inventory_id'])->first();
        $newQty = $inventory['quantity'] + $damage['qty'];
        $data = ['quantity'=>$newQty];
        $model->update($inventory['inventory_id'],$data);
        //close the issue
        $records = ['status'=>1];
        $damageModel->update($val,$records);
        echo "success";
    }

    public function borrowItem()
    {
        $model = new inventoryModel();
        $borrowModel = new borrowModel();
        $validation = $this->validate([
            'qty'=>'required|numeric',
            'borrower'=>['rules'=>'required','errors'=>['required'=>'Enter the name of the borrower']],
            'details'=>['rules'=>'required','errors'=>['required'=>'Please enter other details']],
            'date_return'=>['rules'=>'required','errors'=>['required'=>'Enter the return date of the item']]
        ]);

        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            $data = [
                'inventory_id'=>$this->request->getPost('borrowID'),
                'qty'=>$this->request->getPost('qty'),
                'borrower'=>$this->request->getPost('borrower'),
                'date_expected'=>$this->request->getPost('date_return'),
                'details'=>$this->request->getPost('details'),
                'status'=>0
            ];
            $borrowModel->save($data);
            //deduct the items
            $inventory = $model->where('inventory_id',$this->request->getPost('borrowID'))->first();
            $oldQty = $inventory['quantity'];
            $newQty = $oldQty-$this->request->getPost('qty');
            $records = ['quantity'=>$newQty];
            $model->update($this->request->getPost('borrowID'),$records);
            //logs  
            date_default_timezone_set('Asia/Manila');
            $logModel = new \App\Models\logModel();
            $data = ['account_id'=>session()->get('loggedAdmin'),
                    'activities'=>'Borrowed item  total of :'.$this->request->getPost('qty'),
                    'page'=>'Inventory',
                    'datetime'=>date('Y-m-d h:i:s a')
                    ];      
            $logModel->save($data);
            return $this->response->setJSON(['success'=>'Successfully saved']);
        }
    }

    public function returnItem()
    {
        $model = new inventoryModel();
        $borrowModel = new borrowModel();
        $returnModel = new returnModel();
        $validation = $this->validate([
            'return_qty'=>['rules'=>'required|numeric','errors'=>['required'=>'Quantity is required','numeric'=>'Enter valid value']],
            'return_by'=>['rules'=>'required','errors'=>['required'=>'Enter the name of the borrower']],
            'status'=>'required'
        ]);

        if(!$validation)
        {
            return $this->response->setJSON(['errors'=>$this->validator->getErrors()]);
        }
        else
        {
            //update the borrow status 
            $borrow = $borrowModel->where('inventory_id',$this->request->getPost('returnID'))
                                  ->first();
            $record = ['status'=>1];
            $borrowModel->update($borrow['borrow_id'],$record);
            //save the data
            $data = [
                'borrow_id'=>$borrow['borrow_id'],
                'inventory_id'=>$this->request->getPost('returnID'),
                'qty'=>$this->request->getPost('return_qty'),
                'borrower'=>$this->request->getPost('return_by'),
                'status'=>$this->request->getPost('status')
            ];
            $returnModel->save($data);
            //return the stocks
            $inventory = $model->where('inventory_id',$this->request->getPost('returnID'))->first();
            $oldQty = $inventory['quantity'];
            $newQty = $oldQty+$this->request->getPost('return_qty');
            $newData = ['quantity'=>$newQty];
            $model->update($inventory['inventory_id'],$newData);
            //logs 
            date_default_timezone_set('Asia/Manila');
            $logModel = new \App\Models\logModel();
            $data = ['account_id'=>session()->get('loggedAdmin'),
                    'activities'=>'Return items  total of :'.$this->request->getPost('return_qty'),
                    'page'=>'Inventory',
                    'datetime'=>date('Y-m-d h:i:s a')
                    ];      
            $logModel->save($data);
            return $this->response->setJSON(['success'=>'Successfully saved']);
        }
    }

    public function releaseItem()
    {
        $purchase = new purchaseModel();
        $model = new inventoryModel();
        $item = array_map(fn($q) => (int) strip_tags($q), (array) $this->request->getPost('item')); 
        $qty = array_map(fn($q) => (int) strip_tags($q), (array) $this->request->getPost('qty'));
        $status = $this->request->getPost('status');
        for($i = 0; $i < count($item); $i++)
        {
            if(!empty($qty[$i]))
            {
                $invent = $model->where('inventory_id',$item[$i])->first();
                $total = (int) $qty[$i] * (int) $invent['price'];
                $data = [
                    'inventory_id'=>$item[$i],
                    'qty'=>$qty[$i],
                    'price'=>(int) $invent['price'],
                    'total'=>$total,
                    'status'=>$status
                ];
                $purchase->save($data);
                //deduct the quantity of inventory
                $newQty = $invent['quantity']-$qty[$i];
                $record = ['quantity'=>$newQty];
                $model->update($invent['inventory_id'],$record);
            }
        }
        //logs  
        date_default_timezone_set('Asia/Manila');
        $logModel = new \App\Models\logModel();
        $data = ['account_id'=>session()->get('loggedAdmin'),
                'activities'=>'Released Items',
                'page'=>'Inventory',
                'datetime'=>date('Y-m-d h:i:s a')
                ];      
        $logModel->save($data);
        return $this->response->setJSON(['success'=>'Successfully saved']);
    }

    public function acceptRequest()
    {
        $inventory = new inventoryModel();
        $model = new \App\Models\requestModel();
        $borrowModel = new borrowModel();
        $studentModel = new studentModel();

        $val = $this->request->getPost('value');
        $data = ['status'=>1];
        $model->update($val,$data);
        //get the data
        $records = $model->where('request_id',$val)->first();
        $stock = $inventory->where('item',$records['item'])->first();
        //update the inventory
        $newQty = $stock['quantity'] - $records['qty'];
        $newData = ['quantity'=>$newQty];
        $inventory->update($stock['inventory_id'],$newData);
        //get the name of the borrower
        $student = $studentModel->where('student_id',$records['student_id'])->first();
        $fullname = $student['firstname'].' '.$student['middlename']." ".$student['lastname'];
        //save the request in borrow table
        $newRecord = [
                'inventory_id'=>$stock['inventory_id'],
                'qty'=>$records['qty'],
                'borrower'=>$fullname,
                'date_expected'=>$records['date_return'],
                'details'=>'N/A',
                'status'=>0
        ];
        $borrowModel->save($newRecord);
        return $this->response->setJSON(['success'=>'Successfully accepted']);
    }

    public function declineRequest()
    {
        $model = new \App\Models\requestModel();
        $val = $this->request->getPost('value');
        $data = ['status'=>2];
        $model->update($val,$data);
        return $this->response->setJSON(['success'=>'Successfully declined']);
    }
}