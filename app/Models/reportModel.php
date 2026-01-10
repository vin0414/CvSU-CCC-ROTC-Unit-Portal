<?php

namespace App\Models;

use CodeIgniter\Model;

class reportModel extends Model
{
    protected $table            = 'reports';
    protected $primaryKey       = 'report_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['violation','category','type_report','student_id','details','points','status','user','approver'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}