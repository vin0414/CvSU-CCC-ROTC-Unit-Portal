<?php

namespace App\Models;

use CodeIgniter\Model;

class performanceModel extends Model
{
    protected $table            = 'student_performance';
    protected $primaryKey       = 'performance_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['year','semester','subject_id','schedule_id','student_id','total'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}