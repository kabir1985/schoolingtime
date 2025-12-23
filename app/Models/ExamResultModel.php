<?php

namespace App\Models;

use CodeIgniter\Model;

class ExamResultModel extends Model
{
    protected $table = 'exam_start_process'; // Base table for the model
    protected $primaryKey = 'id'; // Primary key of the base table

    // Define which fields you want to retrieve
    protected $allowedFields = ['id', 'student_id', 'exam_setup_id', 'question_set_id', 'status'];

    // Function to get exam details by joining question_answer with exam_setup
    public function getExamResults($studentId)
    {
        // Build the query using the Query Builder
        $builder = $this->db->table($this->table . ' esp') // Set the base table 'exam_start_process' with alias 'esp'
            ->distinct() // Apply DISTINCT to the entire query
            ->join('exam_setup es', 'esp.exam_setup_id = es.exam_setup_id', 'right') // Perform the right join
            ->select('es.exam_name, esp.exam_setup_id, esp.student_id') // Specify the fields to retrieve
            ->where('esp.status', '1') // Add the WHERE condition for esp.status = 1
            ->where('esp.student_id', $studentId); // Add the WHERE condition for esp.student_id dynamically

        $query = $builder->get(); // Execute the query

        // Return the results as an array of objects
        return $query->getResult();
    }
}
