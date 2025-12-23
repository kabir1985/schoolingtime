<?php
 namespace App\Models;
 use CodeIgniter\Model;

class ExamStartProcessModel extends Model
 {
    protected $table = 'exam_start_process';

    protected $primaryKey = 'id';

    protected $allowedFields = ['unique_test_id','student_id','exam_setup_id','question_set_id','exam_start_at','exam_duration','exam_end_at','status'];

 } 

