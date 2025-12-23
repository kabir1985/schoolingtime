<?php
 namespace App\Models;
 use CodeIgniter\Model;

class CourseIncludeModel extends Model
 {
    protected $table = 'course_include';

    protected $primaryKey = 'course_include_id';

    protected $allowedFields = [ 'course_id','course_duration','live_class','course_exam','course_model_test','class_time'];

 } 

