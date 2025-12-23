<?php
 namespace App\Models;
 use CodeIgniter\Model;

class CoursePurchaseModel extends Model
 {
    protected $table = 'selected_course_by_student';

    protected $primaryKey = 'ID';

    protected $allowedFields = [ 'course_id','selected_teacher_id','selected_student_id'];

 } 

