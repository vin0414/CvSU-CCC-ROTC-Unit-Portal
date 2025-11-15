<?php

namespace App\Models;

use CodeIgniter\Model;

class subjectModel extends Model
{
    protected $table            = 'subjects';
    protected $primaryKey       = 'subject_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['school_year','semester','code','subjectName','subjectDetails','account_id','status'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}