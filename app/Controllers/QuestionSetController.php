<?php

namespace App\Controllers;

use App\Models\QuestionSetInsertModel;

class QuestionSetController extends BaseController
{
  private $db;
  private $QuestionSetInsertModelObject;
  public function __construct()
  {

    $this->db = \Config\Database::connect();
    $this->QuestionSetInsertModelObject = new QuestionSetInsertModel();
  }

  public function index()
  {

    // if (isset($_SESSION['id'])) {
    //   $teacher_id = $_SESSION['id'];
    //   $builder = $this->db->table('exam_setup');
    //   $builder->where('course_teacher_id', $teacher_id);
    //   $query = $builder->get();
    //   $data['exam_setup_info'] = $query->getResult();
    //   return view('examsystem/questionSetView', $data);
    // }


    if (isset($_SESSION['id'])) {
      $teacher_id = $_SESSION['id'];
  
      $builder = $this->db->table('exam_setup');
      $builder->select('exam_setup.*, teacher_course.course_status, teacher_course.coures_title ');
      $builder->join('teacher_course', 'teacher_course.course_id = exam_setup.exam_subject_course_id', 'left');
      $builder->where('exam_setup.course_teacher_id', $teacher_id);
      $builder->where('teacher_course.course_status', 'approved');
  
      $query = $builder->get();
      $data['exam_setup_info'] = $query->getResult();
  
      return view('examsystem/questionSetView', $data);
  }

  }


  public function question_show_for_set_creation()
  {
    $course_id = $this->request->getVar('course_id');
    $question_set_id = $this->request->getVar('question_set_id');

    //////////////////////////IF Question Set Already Exist then have to update////////////////////////
    $builder = $this->db->table('question_set');
    $builder->where('subject_id', $course_id);
    $builder->where('question_set_id', $question_set_id);
    $query   = $builder->get();
    $num_of_rows = $query->getNumRows();

    if ($num_of_rows > 0 and ($course_id && $question_set_id) != "") {

      // $sql = "SELECT qb.id AS question_bank_id, qb.subject_id AS question_bank_subject_id,". 
      // "qb.question_title, qs.question_set_id,". 
      // "CASE WHEN qs.question_id = qb.id AND qs.subject_id='".$course_id."' AND qs.question_set_id='".$question_set_id."'
      // THEN '1' ELSE '0' END AS 'is_exist' ". 
      // "FROM question_bank qb ".
      // "LEFT JOIN question_set qs ON qb.id = qs.question_id ";


      $sql = "SELECT qb.id AS question_bank_id, qb.subject_id AS question_bank_subject_id," .
        "qb.question_title, qs.question_set_id," .
        "CASE WHEN (qs.subject_id='" . $course_id . "' AND qs.question_set_id='" . $question_set_id . "')
      THEN '1' ELSE '0' END AS 'is_exist' " .
        "FROM question_bank qb " .
        "LEFT JOIN question_set qs ON (qb.id = qs.question_id AND qs.question_set_id='" . $question_set_id . "') where qb.subject_id='" . $course_id . "'";


      $query = $this->db->query($sql);

      $results['results'] = $query->getResult();

      echo json_encode($results);
    }

    //////////////////If Question Set is New then entry into database/////////////////////////
    else {
      $query = $this->db->query("SELECT id AS 'question_bank_id', question_title, '' AS 'is_exist'
                                   FROM question_bank
                                    WHERE subject_id ='$course_id'");

      $results['results'] = $query->getResult();

      echo json_encode($results);
    }
  }


  public function question_set_insert_db()
  {
    $dataList = $_REQUEST;

    $course_id = $dataList['course_id'];
    $question_set_id = $dataList['question_set_id'];

    $num_of_questions = count($dataList['id']);

    $this->db->transStart();
    //////Exisitng Question Id will be delete first then insert/////
    $db  = \Config\Database::connect();
    $builder = $db->table('question_set');
    $builder->where(['subject_id' => $course_id, 'question_set_id' => $question_set_id]);
    $builder->delete();
    /////////////////////////////////////////////////////////////
    $dataTosave = [];

    for ($k = 0; $k < $num_of_questions; $k++) {
      $item = [
        "subject_id"      => $course_id,
        "question_set_id" => $question_set_id,
        "question_id"     => $_REQUEST['id'][$k]
      ];

      array_push($dataTosave, $item);
    }

    $this->QuestionSetInsertModelObject->insertBatch($dataTosave);

    $this->db->transComplete();
    echo "Question Insert Successfull";
  }

}
