<?php
 namespace App\Models;
 use CodeIgniter\Model;

class QuestionAnswerModel extends Model
 {
    protected $table = 'question_answer';

    protected $primaryKey = 'id';

    protected $allowedFields = [ 'question_id','subject_id','your_answer_id','user_id'];

 } 

