<?php

namespace App\Controllers;

use App\Models\ExamSetupModel;
use App\Models\QuestionOptionModel;
use App\Models\QuestionBankModel;
use Google\Service\Classroom\Course;

class ExamController extends BaseController
{
    private $ExamSetupModelObject;
    private $QuestionOptionModelObject;
    private $QuestionBankModelObject;
    private $db;
    public function __construct()
    {
        $this->ExamSetupModelObject = new ExamSetupModel();
        $this->QuestionOptionModelObject = new QuestionOptionModel();
        $this->QuestionBankModelObject = new QuestionBankModel();
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        if (isset($_SESSION['id'])) {
           $teacher_id = $_SESSION['id'];  
           $query   = $this->db->query("SELECT * FROM  teacher_course 
                        Where course_teacher_id = '$teacher_id' AND course_status = 'approved' ");
           $data['courseList'] = $query->getResult();

            return view('examsystem/examsetupView', $data);
        } else {
            $_SESSION['message'] = "Your Session is Expired";
            return redirect()->to(base_url() . 'teachers/loginView');
        }
    }

    public function question_bank_View()
    {
        if (isset($_SESSION['id'])) {
            $teacher_id = $_SESSION['id'];
            $query = $this->db->query("Select exam_setup.exam_name, exam_setup.exam_subject_course_id, exam_setup.subject_chapter_id,
                  exam_setup.exam_setup_id, exam_setup.total_question, teacher_course.coures_title
                  From exam_setup
                  LEFT Join teacher_course
                  ON exam_setup.exam_subject_course_id = teacher_course.course_id
                  Where exam_setup.course_teacher_id = '$teacher_id' AND teacher_course.course_status = 'approved' ");
            $data['exam_info'] = $query->getResult();
            return view('examsystem/questionBankView', $data);
        } else {
            $_SESSION['message'] = "Your Session is Expired";
            return redirect()->to(base_url() . 'teacher/login-view');
        }
    }

    public function question_bank_insert_db()
    {
        // $this->db->trans_start();
        $this->db->transStart();

        $dataList =  $_REQUEST;

        $main_question_array = isset($dataList['item']) ? $dataList['item'] : [];

        $subject_id = $this->request->getVar('exam_name_id');

        $dataTosave = [];
        // $questionIdList = [];
        foreach ($main_question_array as $key => $value) {

            $data = [
                "subject_id"  => $subject_id,
                "question_title" => $main_question_array[$key]['question'][0]
            ];
            $this->QuestionBankModelObject->insert($data);
            $last_insert_id = $this->QuestionBankModelObject->getInsertID();

            for ($k = 0; $k < count($main_question_array[$key]['option']); $k++) {
                $day_no = date('z') + 2;
                $unique_text = substr(md5(microtime(true) . mt_Rand()), -3);
                $question_ans_id = strtoupper('ans' . date('m') . str_pad($day_no, 2, '0', STR_PAD_LEFT) . '' . $unique_text);

                $item = [
                    "question_id" => $last_insert_id,
                    "question_answer_id" => $last_insert_id . "-" . $question_ans_id,
                    "question_option" => $main_question_array[$key]['option'][$k],
                    "correct_answer" => $main_question_array[$key]['answers'][$k]
                ];
                array_push($dataTosave, $item);
            }
        }

        if (count($dataTosave)) {
            $this->QuestionOptionModelObject->insertBatch($dataTosave);
            $this->db->transComplete();

            $_SESSION['isLoggedIn'] = true;
            $_SESSION['message'] = "Question Creation Successful ";
            return redirect()->to(base_url() . 'exam/question-bank-view');
        } else {
            $_SESSION['message'] = "Question Creation Fail!";
            return redirect()->to(base_url() . 'teacher/dashboard');
        }
    }

    public function exam_setup_insert()
    {
        if (isset($_SESSION['id'])) {
            $teacher_id = $_SESSION['id'];

            // $chapter_id = $this->request->getVar('chapter_name_id');

            $day_no = date('z') + 1;
            $unique_text = substr(md5(microtime(true) . mt_Rand()), -5);
            $exam_setup_id = strtoupper('Exam-' . date('y') . str_pad($day_no, 3, '0', STR_PAD_LEFT) . '' . $unique_text);

            $data = [
                'exam_setup_id'          => $exam_setup_id,
                'course_teacher_id'      => $teacher_id,
                'exam_name'              => $this->request->getVar('exam_name'),
                'exam_subject_course_id' => $this->request->getVar('exam_subject'),
                //'course_section_id'      => $this->request->getVar('course_section_id'),
               // 'exam_category_id'       => $this->request->getVar('exam_category_id'),
                'subject_chapter_id'     => $this->request->getVar('chapter_name_id'),
                'exam_duration'          => $this->request->getVar('exam_duration'),
                'total_question'         => $this->request->getVar('total_question'),
                'marks_per_right_answer' => $this->request->getVar('marks_per_right_answer'),
                'marks_per_wrong_answer' => $this->request->getVar('marks_per_wrong_answer')
            ];

            $insertion = $this->ExamSetupModelObject->insert($data);

            if ($insertion) {
                $_SESSION['message'] = "Exam Setup Creation Successful ";
                return redirect()->to(base_url() . 'exam/exam-setup-view');
            } else {
                $_SESSION['message'] = "Exam Setup Creation Fail!";
                return redirect()->to(base_url() . 'teacher/dashboard');
            }
        } else {
            $_SESSION['message'] = "Your Session is Expired";
            return redirect()->to(base_url() . 'teacher/login-view');
        }
    }

    public function examCourseInfo()
    {
        $course_category_id = $_GET['id'];

        $builder = $this->db->table('teacher_course');
        $builder->where('course_category_id', $course_category_id);
        $query = $builder->get();
        $course_info = $query->getResult();
        echo '<option value="">Select Category</option>';
        foreach ($course_info as $row) {
            $course_title = $row->coures_title;
            $course_id = $row->course_id;

            echo '<option value=' . $course_id . '>' . $course_title . '</option>';
        }
    }

    public function courseChapterInfo()
    {
        $course_id = $_GET['id'];

        $builder = $this->db->table('course_content');
        $builder->where('course_id', $course_id);
        $builder->groupBy('chapter_id');
        $builder->orderBy('course_content_id', 'ASC');
        $query = $builder->get();
        $chapter_info = $query->getResult();

         echo " <option  disabled >সিলেক্ট চ্যাপ্টার / মডেল টেস্ট বা পুরো কোর্স</option>";
        foreach ($chapter_info as $row) {
            $chapter_name = $row->chapter_name;
            $chapter_id = $row->chapter_id;

            echo '<option value=' . $chapter_id . '>' . $chapter_name . '</option>';
        }
        echo '<option value=' . "Model-Test_or_Full-Course_Exam" . '>' . "মডেল টেস্ট / পুরো কোর্স" . '</option>';

    }
}
