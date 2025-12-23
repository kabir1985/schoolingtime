<?php
namespace App\Controllers;

use App\Models\ExamResultModel;

class ExamResultController extends BaseController
{
    public function index()
    {
        if (isset($_SESSION['student_id'])) {
            $studentId = $_SESSION['student_id']; // Get student ID from session
            $examModel = new ExamResultModel();
            $data['results'] = $examModel->getExamResults($studentId);
            return view('examsystem/studentResultView', $data);
        }
    }

    public function generateReport($exam_setup_id, $student_id)
    {
        $db = \Config\Database::connect();

        // 1️⃣ Get the question_set_id for this exam/subject
        $question_set = $db->table('question_set')
                           ->select('question_set_id')
                           ->where('subject_id', $exam_setup_id)
                           ->limit(1)
                           ->get()
                           ->getRowArray();
    
        $question_set_id = $question_set['question_set_id'] ?? null;
    
        // If no question set found, return empty view
        if (!$question_set_id) {
            return view('examsystem/html_student_result', ['questions' => []]);
        }
    
        // 2️⃣ Main query
        $sql = "
            SELECT
                qb.id AS question_id,
                qb.subject_id,
                qb.question_title,
                qs.question_set_id,
    
                -- Aggregate all options as JSON
                JSON_ARRAYAGG(
                    JSON_OBJECT(
                        'question_id', qo.question_id,
                        'question_answer_id', qo.question_answer_id,
                        'question_option', qo.question_option,
                        'correct_answer', qo.correct_answer
                    )
                ) AS options,
    
                -- Student's selected answer ID (NULL if not answered)
                qa.your_answer_id,
    
                -- Student's answer text (NULL if not answered)
                (SELECT question_option
                 FROM question_option
                 WHERE question_answer_id = qa.your_answer_id
                 LIMIT 1) AS your_answer_text,
    
                -- Correct answer text
                (SELECT question_option
                 FROM question_option
                 WHERE question_id = qb.id AND correct_answer = '1'
                 LIMIT 1) AS correct_answer_text
    
            FROM question_set qs
            INNER JOIN question_bank qb ON qb.id = qs.question_id
            LEFT JOIN question_option qo ON qo.question_id = qb.id
            LEFT JOIN question_answer qa ON qa.question_id = qb.id AND qa.user_id = ?
    
            WHERE qs.subject_id = ?
            AND qs.question_set_id = ?
    
            GROUP BY qb.id, qb.subject_id, qb.question_title, qs.question_set_id
            ORDER BY qb.id
        ";
    
        $query = $db->query($sql, [$student_id, $exam_setup_id, $question_set_id]);
        $questions = $query->getResultArray();
    
        // 3️⃣ Decode JSON options and determine status
        foreach ($questions as &$q) {
            $q['options'] = json_decode($q['options'], true) ?? [];
            usort($q['options'], fn($a, $b) => $a['question_answer_id'] <=> $b['question_answer_id']);
    
            if ($q['your_answer_id'] == null) {
                $q['status'] = 'not_answered';
            } elseif ($q['your_answer_text'] == $q['correct_answer_text']) {
                $q['status'] = 'correct';
            } else {
                $q['status'] = 'incorrect';
            }
        }
    
        // 4️⃣ Return the view
        return view('examsystem/html_student_result', ['questions' => $questions]);
    }
}
