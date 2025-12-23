<?php
 namespace App\Models;
 use CodeIgniter\Model;

class ExamSetupModel extends Model
 {
    protected $table = 'exam_setup';

    protected $primaryKey = 'id';

    protected $allowedFields = [ 'exam_setup_id','course_teacher_id','exam_name','exam_subject_course_id','subject_chapter_id','exam_duration','total_question','marks_per_right_answer','marks_per_wrong_answer'];

 } 

