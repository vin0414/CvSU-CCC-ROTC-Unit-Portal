<?php

namespace App\Models;

use CodeIgniter\Model;

class assignmentModel extends Model
{
    protected $table            = 'assignments';
    protected $primaryKey       = 'assignment_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['account_id','schedule_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}