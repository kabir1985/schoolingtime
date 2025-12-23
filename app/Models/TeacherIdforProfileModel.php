<?php
 namespace App\Models;
 use CodeIgniter\Model;

class TeacherIdforProfileModel extends Model
 {
    protected $table = 'teacher_profile';

    protected $primaryKey = 'teacher_profile_id';

    protected $allowedFields = ['teacher_id'];

 } 

