<?php

namespace App\Controllers;

use App\Models\QuestionAnswerModel;
use App\Models\ExamStartProcessModel;
use CodeIgniter\I18n\Time;

class QuestionAnswerController extends BaseController
{
    private $QuestionAnswerModelObject;
    private $ExamStartProcessModelObject;
    private $db;

    public function __construct()
    {
        $this->QuestionAnswerModelObject = new QuestionAnswerModel();
        $this->ExamStartProcessModelObject = new ExamStartProcessModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('examsystem/questionAllView');
    }

    public function exam_result_show($user_id, $questionAnsBatchInsertionID)
    {
        $query = $this->db->query("SELECT * FROM question_answer 
                          WHERE id IN ($questionAnsBatchInsertionID) AND user_id = '$user_id' ");
        $data['exam_result_info'] = $query->getResult();

        return view('examsystem/result_show_View', $data);
    }

    public function question_set_subject_wise($course_category_id)
    {
        $query = $this->db->query("SELECT exam_setup.exam_subject_course_id, exam_setup.exam_name,
        teacher_course.course_category_id,teacher_course.coures_title,teacher_course.course_id
        FROM exam_setup LEFT JOIN teacher_course
        ON exam_setup.exam_subject_course_id = teacher_course.course_id
        WHERE teacher_course.course_category_id = '$course_category_id' 
        GROUP BY exam_setup.exam_subject_course_id ");

        $data['question_set'] = $query->getResult();
        return view('examsystem/questionSubjectWiseView', $data);
    }

    public function question_set_exam_start($exam_set_id)
    {
        // $query = $this->db->query("SELECT question_set_setup.question_set_title,question_set.subject_id,question_set.question_set_id 
        //                            FROM question_set_setup LEFT JOIN question_set 
        //                            ON question_set_setup.question_set_id = question_set.question_set_id 
        //                            WHERE question_set.subject_id = '$exam_set_id'
        //                            GROUP BY question_set.question_set_id; ");

            $query = $this->db->query("SELECT 
            qss.question_set_title,
            qs.subject_id,
            qss.question_set_id
                            FROM 
                                question_set_setup AS qss
                            LEFT JOIN 
                                question_set AS qs 
                                    ON qss.question_set_id = qs.question_set_id
                            WHERE 
                                qs.subject_id = '$exam_set_id'
                            ORDER BY 
                                RAND()
                            LIMIT 1; ");




        $data['question_set_selection'] = $query->getResult();
        return view('examsystem/question_set_for_exam_start_View', $data);
    }

    public function question_set_show($course_id)
    {
        $query = $this->db->query("SELECT * FROM  exam_setup Where exam_subject_course_id = '$course_id' ");
        $data['question_set_show'] = $query->getResult();
        return view('examsystem/question_show_setwiseView', $data);
    }

    public function question_show_for_selection($question_set_id, $exam_setup_id, $exam_duration)
    {
        if (isset($_SESSION['student_id'])) {
            $unique_test_id = hash('sha256', uniqid(rand(), true));
            $unique_test_id = implode("-", str_split($unique_test_id, 15));

            date_default_timezone_set("Asia/Dhaka");
            $current_time = date('h:i:s A');
            $EndTime = date('h:i:s A', strtotime('+' . $exam_duration . "minutes"));

            $builder = $this->db->table('exam_start_process');
            $builder->where('student_id', $_SESSION['student_id']);
            $builder->where('exam_setup_id', $exam_setup_id);
            $builder->where('question_set_id', $question_set_id);
            $builder->where('status', '1');
            $query   = $builder->get();
            $results = $query->getResult();

            // echo "output:".sizeof($results);

            //  exit();

            if (sizeof($results) != 1) {

                $data = [
                    'unique_test_id' => $unique_test_id,
                    'student_id'     => $_SESSION['student_id'],
                    'exam_setup_id'  =>  $exam_setup_id,
                    'question_set_id' => $question_set_id,
                    'exam_start_at'  => $current_time,
                    'exam_duration'  => $exam_duration,
                    'exam_end_at'    => $EndTime
                ];
                $insert_data = $this->ExamStartProcessModelObject->insert($data);

                if ($insert_data > 0) {
                    return redirect()->to(base_url() . "exam/current-test/{$data['unique_test_id']}");
                }
            } else {
                $_SESSION['message'] = "already you did this exam so back from exam hall";
                return redirect()->to(base_url() . "student/exam-system");
            }
        } else {
            echo "you are not student";
        }
    }
    public function currentTest($testId)
    {
        $sql = "SELECT qs.* , esp.*
        FROM question_set AS qs, 
             exam_start_process AS esp
        WHERE qs.question_set_id  = esp.question_set_id
        AND qs.subject_id = esp.exam_setup_id
        AND esp.unique_test_id = '{$testId}'";

        $query = $this->db->query($sql);
        $data['show_question'] = $query->getResult();
        return view('examsystem/question_ready_exam_view', $data);
    }

public function question_answer_insert()
{
    $user_or_student_id = $_REQUEST['student_id'];
    $subject_id = $_REQUEST['subject_id'];
    $question_set_id = $_REQUEST['question_set_id'];
    $questions = $_REQUEST['question_answer'] ?? []; // submitted answers
    $question_ids = $_REQUEST['question_ids'] ?? []; // all displayed question IDs

    $builder = $this->db->table('exam_start_process');
    $builder->where('student_id', $user_or_student_id);
    $builder->where('exam_setup_id', $subject_id);
    $builder->where('question_set_id', $question_set_id);
    $builder->where('status', '0');
    $query = $builder->get();
    $results = $query->getResult();

    if (sizeof($results) == 1) {

        // Mark exam as completed
        $builder->update(['status' => '1']);

        $dataToSave = [];

        // 1. Save answered questions
        $answered_ids = [];

        foreach ($questions as $q_id => $values) {
            $answered_ids[] = $q_id;

            foreach ($values as $value) {
                $answer_part = explode(",", $value);
                $item = [
                    "question_id"     => $q_id,
                    "subject_id"      => $subject_id,
                    "your_answer_id"  => $answer_part[0],
                    "user_id"         => $user_or_student_id
                ];
                array_push($dataToSave, $item);
            }
        }

        // 2. Detect and save unanswered questions
        foreach ($question_ids as $qid) {
            if (!in_array($qid, $answered_ids)) {
                $dataToSave[] = [
                    "question_id"     => $qid,
                    "subject_id"      => $subject_id,
                    "your_answer_id"  => null,
                    "user_id"         => $user_or_student_id
                ];
            }
        }

        // 3. Insert all
        if (count($dataToSave) > 0) {
            $this->QuestionAnswerModelObject->insertBatch($dataToSave);

            $FirstInsertIdBatch = $this->QuestionAnswerModelObject->insertID();
            $maxIdQuery = $this->QuestionAnswerModelObject->db->query("SELECT MAX(id) AS max_id FROM question_answer WHERE user_id = '$user_or_student_id'");
            $maxIdResult = $maxIdQuery->getRow();
            $LastInsertIdBatch = $maxIdResult->max_id;

            $id_list = range($FirstInsertIdBatch, $LastInsertIdBatch);
            $id_list_str = implode(',', $id_list);

            echo json_encode(['status' => 'আপনি সফলভাবে পরিক্ষা দিয়েছেন, আপনাকে ধন্যবাদ']);
        } else {
            $_SESSION['message'] = "No answers submitted!";
            return redirect()->to(base_url() . 'student/dashboard');
        }

    } else {
        echo json_encode(['status' => 'আপনি ইতোমধ্যে এই পরিক্ষা দিয়েছেন, সুতরাং আর দেয়া যাবে না']);
    }
}

    public function exam_show_subject_wise()
    {
        $courseId = $this->request->getGet('course_id');
        $chapterId = $this->request->getGet('chapter_id');
    
        // Prepare the base SQL for exam setup
        $sql = "SELECT id, exam_setup_id, exam_name, exam_duration, total_question 
                FROM exam_setup 
                WHERE exam_subject_course_id = ?";
        
        $params = [$courseId];
    
        // Add chapter filter if provided
        if (!empty($chapterId)) {
            $sql .= " AND subject_chapter_id = ?";
            $params[] = $chapterId;
        }
    
        // Execute the query with parameter binding
        $query = $this->db->query($sql, $params);
        $examInfo = $query->getResult();
    
        // Fetch chapter information related to the course
        $queryChapters = $this->db->query("SELECT chapter_id, chapter_name 
                                         FROM course_content 
                                         WHERE course_id = ?", [$courseId]);
        $chapterInfo = $queryChapters->getResult();
    
        // Combine both arrays into a single response array
        $combinedResponse = [
            "exam_info" => $examInfo ?? null,
            "chapter_info" => $chapterInfo ?? null
        ];
    
        // Encode as JSON and output
        return $this->response->setJSON($combinedResponse);
    }
    

}