<?php

namespace App\Controllers;

use App\Models\ExamResultModel;
//use Dompdf\Dompdf;
//use Dompdf\Options;

//use Mpdf\Mpdf;

class ExamResultController extends BaseController
{
    public function index()
    {
        if (isset($_SESSION['student_id'])) {
            $studentId = $_SESSION['student_id']; // This can come from user input, session, etc.
           // Create an instance of the ExamModel
            $examModel = new ExamResultModel();
            // Call the model method to get exam results
            $data['results'] = $examModel->getExamResults($studentId);
            return view('examsystem/studentResultView', $data); // Create this view
        }
    }

    public function generateReport($exam_setup_id, $student_id)
    {
        $db = \Config\Database::connect();
        $sql = "
                SELECT
                qb.id AS question_id,
                qb.subject_id,
                qb.question_title,
                    CONCAT('[', GROUP_CONCAT(
                        CONCAT(
                            '{\"question_id\":\"', qo.question_id, '\",',
                                '\"question_answer_id\":\"', qo.question_answer_id, '\",',
                            '\"question_option\":\"', qo.question_option, '\",',
                            '\"correct_answer\":\"', qo.correct_answer, '\",',
                            '\"your_answer_id\":\"', qa.your_answer_id, '\",',
                                '\"your_answer_option\":\"', qoa.question_option, '\"}'
                            )
                ORDER BY qo.id
                ), ']') AS options
                FROM
                question_bank AS qb
                LEFT JOIN
                question_option AS qo ON qo.question_id = qb.id
                LEFT JOIN
                question_answer AS qa ON qa.question_id = qb.id AND qa.user_id = '$student_id'
                LEFT JOIN
                question_option AS qoa ON qoa.question_answer_id = qa.your_answer_id
                WHERE
                qb.subject_id = '$exam_setup_id'
                GROUP BY
                qb.id, qb.subject_id, qb.question_title";

        try {
            $query = $db->query($sql, [$student_id, $exam_setup_id]);
            $questions = $query->getResultArray();

          
            $html = view('examsystem/pdf_student_result', ['questions' => $questions]);

            $mpdf = new  \Mpdf\Mpdf();

            $mpdf->WriteHTML($html);
           
            $mpdf->Output("questions_report.pdf", "I"); // "I" for inline, "D" for download

        } catch (\Exception $e) {
            return $this->response->setStatusCode(500, $e->getMessage());
        }
    }
}
