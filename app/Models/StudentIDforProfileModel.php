<?php
 namespace App\Models;
 use CodeIgniter\Model;

class StudentIDforProfileModel extends Model
 {
    protected $table = 'student_profile';

    protected $primaryKey = 'ID';

    protected $allowedFields = ['stu_profile_id'];

 } 

