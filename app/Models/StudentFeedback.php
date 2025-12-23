<?php
 namespace App\Models;
 use CodeIgniter\Model;

class StudentFeedback extends Model
 {
    protected $table = 'course_feedback';

    protected $primaryKey = 'feedback_id';

    protected $allowedFields = [ 'teacher_course_id','course_id','feedback_rating','feedback','student_id','student_name'];

 } 

