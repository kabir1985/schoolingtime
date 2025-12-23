<?php
 namespace App\Models;
 use CodeIgniter\Model;

class TeacherProfileUpdateModel extends Model
 {
    protected $table = 'teacher_profile';

    protected $primaryKey = 'teacher_profile_id';

    protected $allowedFields = ['teacher_id','last_educational_institute','teacher_edu_his','teacher_pro_his','teacher_certi_award','teacher_pic','term_condition'];

 } 

