<?php

namespace App\Models;

use CodeIgniter\Model;

class inventoryModel extends Model
{
    protected $table            = 'inventory';
    protected $primaryKey       = 'inventory_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['category_id','item','units','quantity','price','details','min','max','status'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}