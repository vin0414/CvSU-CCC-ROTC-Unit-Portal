<?php

namespace App\Models;

use CodeIgniter\Model;

class batchModel extends Model
{
    protected $table            = 'batches';
    protected $primaryKey       = 'batch_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['school_year','semester','batchName','section','details','account_id','status'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}