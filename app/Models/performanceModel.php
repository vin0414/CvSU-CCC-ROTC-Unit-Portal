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
    protected $allowedFields    = [
                                    'subject_id','student_id',
                                    'attendanceScore','attendanceValue','attendancePercentage',
                                    'physicalScore','physicalValue','physicalPercentage',
                                    'appearanceScore','appearanceValue','appearancePercentage',
                                    'disciplineScore','disciplineValue','disciplinePercentage',
                                    'qualitiesScore','qualitiesValue','qualitiesPercentage',
                                    'leadershipScore','leadershipValue','leadershipPercentage',
                                    'workScore','workValue','workPercentage',
                                    'finalScore','finalGrade','remarks','status'
                                  ];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}