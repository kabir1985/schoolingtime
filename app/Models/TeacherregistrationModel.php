<?php
 namespace App\Models;
 use CodeIgniter\Model;

class TeacherregistrationModel extends Model
 {
    protected $table = 'teacher_registration';

    protected $primaryKey = 'ID';

    protected $allowedFields = ['teacher_id','teacher_name','teacher_email','teacher_mobile','teacher_password'];

 } 

