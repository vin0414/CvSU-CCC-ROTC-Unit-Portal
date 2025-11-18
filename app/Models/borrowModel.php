<?php

namespace App\Models;

use CodeIgniter\Model;

class borrowModel extends Model
{
    protected $table            = 'borrow_item';
    protected $primaryKey       = 'borrow_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['inventory_id','qty','borrower','date_expected','status'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}