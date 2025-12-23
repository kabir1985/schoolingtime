<?php
 namespace App\Models;
 use CodeIgniter\Model;

class QuestionOptionModel extends Model
 {
    protected $table = 'question_option'; 

    protected $primaryKey = 'id';

    protected $allowedFields = ['question_id','question_answer_id','question_option','correct_answer'];

 } 

