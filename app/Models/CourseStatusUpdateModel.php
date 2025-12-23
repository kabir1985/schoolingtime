<?php
 namespace App\Models;
 use CodeIgniter\Model;

class CourseStatusUpdateModel extends Model
 {
    protected $table = 'teacher_course';

    protected $primaryKey = 'course_id';

    protected $allowedFields = ['course_status','course_start_date'];

 } 

