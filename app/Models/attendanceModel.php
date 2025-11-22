<?php

namespace App\Models;

use CodeIgniter\Model;

class attendanceModel extends Model
{
    protected $table            = 'attendance';
    protected $primaryKey       = 'attendance_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['student_id','date','time','remarks','token'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getAttendanceRange($start, $end)
    {
        return $this->where('date >=', $start)
                    ->where('date <=', $end)
                    ->findAll();
    }
}