<?php
 namespace App\Models;
 use CodeIgniter\Model;

class StudentregistrationModel extends Model
 {
    protected $table = 'student_registration';

    protected $primaryKey = 'ID';

    protected $allowedFields = ['student_id','student_name','student_email','student_mobile','student_password'];

 } 

