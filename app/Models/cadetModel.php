<?php

namespace App\Models;

use CodeIgniter\Model;

class cadetModel extends Model
{
    protected $table            = 'cadets';
    protected $primaryKey       = 'cadet_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['student_id','house_no','street','village','municipality','province','course',
                                    'year','section','school_attended','birthdate','height','weight',
                                    'blood_type','gender','religion','contact_no','fb_account','email',
                                    'mother_sname','mother_fname','mother_mname','mother_contact','mother_work',
                                    'father_sname','father_fname','father_mname','father_contact','father_work',
                                    'emergency_address','relationship',
                                    'contact_firstname','contact_middlename','contact_lastname',
                                    'emergency_number','token'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}