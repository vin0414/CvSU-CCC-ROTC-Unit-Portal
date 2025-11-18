<?php

namespace App\Controllers;
use Config\App;
use \App\Models\categoryModel;
use \App\Models\inventoryModel;
use \App\Models\damageModel;
use \App\Models\borrowModel;

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
        
    }
}