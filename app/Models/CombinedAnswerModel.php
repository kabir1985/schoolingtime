<?php

namespace App\Models;

use CodeIgniter\Model;

class CombinedAnswerModel extends Model
{
    protected $table = 'question_answer'; // Base table
    protected $primaryKey = 'id'; // Primary key

    // Function to get user answers along with questions and options
    public function getCombinedAnswers($exam_setup_id, $userId)
    {
        return $this->select('qa.*, qb.question_title, qo.question_option, qo.correct_answer')
                    ->from('question_answer qa') // Explicitly specify the base table with alias
                    ->join('question_bank qb', 'qb.id = qa.question_id') // Join with question_bank using alias
                    ->join('question_option qo', 'qo.question_id = qb.id') // Join with question_option using alias
                    ->where('qa.subject_id', $exam_setup_id) // Filter by subject_id
                   // ->where('qa.user_id', $userId) // Filter by user_id
                    ->findAll(); // Execute the query and return results
    }
}
