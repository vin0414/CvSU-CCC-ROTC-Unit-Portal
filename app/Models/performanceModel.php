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
                                    'batch_id','student_id',
                                    'present','attendanceScore','attendanceValue','attendancePercentage',
                                    'physicalScore','physicalValue','physicalPercentage',
                                    'rawScore','appearanceScore','appearanceValue','appearancePercentage',
                                    'disciplineScore','disciplineValue','disciplinePercentage',
                                    'knowledge','dependability','unselfishness','decisive','qualitiesRawScore','qualitiesScore','qualitiesValue','qualitiesPercentage',
                                    'rawLeadershipScore','leadershipScore','leadershipValue','leadershipPercentage',
                                    'workRawScore','workScore','workValue','workPercentage',
                                    'finalScore','finalGrade','remarks','status'
                                  ];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}