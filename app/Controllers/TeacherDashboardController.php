<?php

namespace App\Controllers;

use App\Models\TeacherProfileUpdateModel;
use App\Models\TeacherCourseCreationStoreDbModel;
use App\Models\TeacherCourseContentStoreDbModel;
use App\Models\CourseIncludeModel;
use App\Models\BatchModel;
use CodeIgniter\HTTP\IncomingRequest;

class TeacherDashboardController extends BaseController
{
    private $teacherProfileUpdateModelObject;
    private $teacherCourseCreationStoreDbModelObject;
    private $TeacherCourseContentStoreDbModelObject;
    private $CourseIncludeModelObject;
    private $BatchModelObject;
    private $db;
    public function __construct()
    {
        $this->teacherProfileUpdateModelObject = new TeacherProfileUpdateModel();
        $this->teacherCourseCreationStoreDbModelObject = new TeacherCourseCreationStoreDbModel();
        $this->TeacherCourseContentStoreDbModelObject = new TeacherCourseContentStoreDbModel();
        $this->CourseIncludeModelObject = new CourseIncludeModel();
        $this->BatchModelObject = new BatchModel();
        $this->db = db_connect();
    }

    public function index()
    {
        if (isset($_SESSION['id'])) {
            $teacher_id = $_SESSION['id'];
            $sql = "SELECT course_id, COUNT(student_or_buyer_id) AS Course_enrolled_student_number
                    FROM purchase_course
                    WHERE course_teacher_id = '$teacher_id'
                    GROUP BY course_id ";
            $data['student_list_show'] = $this->db->query($sql)->getResult('array');

            $query   = $this->db->query("SELECT * FROM teacher_profile WHERE teacher_id = '$teacher_id'");
            $data['results'] = $query->getResult();

            $query   = $this->db->query("SELECT coures_title FROM  teacher_course  WHERE course_teacher_id = '$teacher_id' AND course_status = 'approved' ");
            $data['myCourse'] = $query->getResult();

            return view('teacher/teacherDashboardView', $data);
        }
    }
    public function profileview()
    {
        if (isset($_SESSION['id'])) {
            $teacher_id = $_SESSION['id'];
            $data['teacher_profile_show'] = $this->teacherProfileUpdateModelObject->where('teacher_id', $teacher_id)->findAll();
            return view('teacher/teacherProfileView', $data);
        }
    }

    public function TeacherCourseCreateView()
    {
        $sql = "SELECT * FROM  course_type";
        $data['courseTypeList'] = $this->db->query($sql)->getResult();

        $sql = "SELECT * FROM  course_section";
        $data['courseSectionList'] = $this->db->query($sql)->getResult();
        return view('teacher/TeacherCourseCreateView', $data);
    }

    public function teacher_course_insert_db()
    {
        /////////////////////For Image Upload////////////////////////////////

        if ($this->request->getFile('file') != '') {
            helper(['form', 'url']);

            $validated = $this->validate([
                'file' => [
                    'uploaded[file]',
                    'mime_in[file,image/jpg,image/jpeg,image/gif,image/png]',
                    'max_size[file,4096]',
                ],
            ]);

            $msg = 'Please select a valid file';
            //exit(WRITEPATH);
            if ($validated) {
                $avatar = $this->request->getFile('file');
                // $avatar->move(WRITEPATH . 'uploads');

                //$avatar->move(WRITEPATH . 'assets/images');
                $avatar->move(ROOTPATH . 'public/CourseUploads/');
            }

            $teacher_pic = $avatar->getClientName();
        } else {
            $teacher_pic = '';
        }
        ////////////////////////////////////////////////////////////////////////
        $teacher_id = $_SESSION['id'];
        $data = [
            'course_teacher_id'     => $teacher_id,
            'coures_title'          => $this->request->getVar('course_title'),
            'course_type_name'      => $this->request->getVar('course_type_name'),
            'course_section_id'    => $this->request->getVar('course_section_id'),
            'course_category_id'    => $this->request->getVar('course_category_id'),
            'course_level'          => $this->request->getVar('course_level'),
            'course_note'           => $this->request->getVar('course_note'),
            'what_you_will_learn'   => $this->request->getVar('what_you_will_learn'),
            'course_price'          => $this->request->getVar('course_price'),
            'demo_class_link'       => $this->request->getVar('demo_video_class_link'),
            'course_pic'            =>  $teacher_pic,
            'course_prerequisite'   => $this->request->getVar('course_prerequisite'),
            'course_status'         => 'pending'
        ];
        $course_insert = $this->teacherCourseCreationStoreDbModelObject->insert($data);
        if ($course_insert > 0) {
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['message'] = "Course Creation Successful ";
            return redirect()->to(base_url() . 'teacher/course-view');
        } else {
            $_SESSION['message'] = "Unable to Create Course!";
            return redirect()->to(base_url() . 'teacher/dashboard');
        }
    }

    public function TeacherCourseContentCreate()
    {
        $teacher_id = $_SESSION['id'];
        //$db = \Config\Database::connect();

        $query   = $this->db->query("SELECT * FROM  teacher_course 
                     Where course_teacher_id = '$teacher_id' AND course_type_name != 'Question_And_Exam' AND course_status = 'approved' ");
        $data['courseContents'] = $query->getResult();
        return view('teacher/TeacherCourseContentView', $data);
    }

    public function TeacherCourseContentInsert()
    {
        /////////pdf file insertion///////////////////////////

        if ($this->request->getFile('file') != '') {
            helper(['form', 'url']);

            $validated = $this->validate([
                'file' => [
                    'uploaded[file]',
                    // 'mime_in[file,image/jpg,image/jpeg,image/gif,image/png,application/pdf]',
                    'mime_in[file,application/pdf]',
                    'max_size[file,4096]',
                ],
            ]);

            $msg = 'Please select a valid file';
            //exit(WRITEPATH);
            if ($validated) {
                $avatar = $this->request->getFile('file');
                // $avatar->move(WRITEPATH . 'uploads');

                //$avatar->move(WRITEPATH . 'assets/images');
                $avatar->move(ROOTPATH . 'public/notes/');
            }

            $pdf_file = $avatar->getClientName();
        } else {
            $pdf_file = '';
        }
        ///////////////////////////////////////////////////////////////
        $dataList =  $_REQUEST;

        $chapter_name_array = isset($dataList['chapter_name']) ? $dataList['chapter_name'] : [];

        $dataTosave = [];
        foreach ($chapter_name_array as $key => $value) {

            $day_no = date('z');
            $unique_text = substr(md5(microtime(true) . mt_Rand()), -5);
            $chapter_id = strtoupper('Chap' . date('y') . str_pad($day_no, 2, '0', STR_PAD_LEFT) . '' . $unique_text);
            for ($k = 0; $k < count($dataList['video_title'][$key]); $k++) {

                $item = [
                    "course_id" => $dataList['course_id'],
                    "chapter_id" => $chapter_id,
                    "chapter_name" => $value[0],
                    "video_title" => $dataList['video_title'][$key][$k],
                    "video_link" => $dataList['video_link'][$key][$k],
                    "pdf_file_path" => $pdf_file
                ];
                array_push($dataTosave, $item);
            }
        }

        if (count($dataTosave)) {
            $this->TeacherCourseContentStoreDbModelObject->insertBatch($dataTosave);

            $_SESSION['isLoggedIn'] = true;
            $_SESSION['message'] = "Course Content Creation Successful ";
            return redirect()->to(base_url() . 'teacher/course-content-view');
        } else {
            $_SESSION['message'] = "Course Content Creation Fail!";
            return redirect()->to(base_url() . 'teacher/course-content-view');
        }
    }
    public function TeacherCourseContentFromDb()
    {
        $course_id = $_GET['id'];
        $query   = $this->db->query("SELECT * FROM  course_content  
                                  Where course_id = '$course_id'");
        $courseContentList = $query->getResult();
        $response = [];
        foreach ($courseContentList as $courseChapterList) {

            $item = [
                'chapter_name' => $courseChapterList->chapter_name,
                "video_title" => $courseChapterList->video_title,
                "video_link" => $courseChapterList->video_link,
                "course_content_id" => $courseChapterList->course_content_id,
                "pdf_file_path" => $courseChapterList->pdf_file_path
            ];
            array_push($response, $item);
        }
        echo json_encode($response);
    }
    public function TeacherCourseContentUpdate()
    {
        $course_content_id = $_POST['course_content_id'];
        $pdf_file = '';
        if ($this->request->getFile('pdf_file_path') != '') {
            helper(['form', 'url']);

            $validated = $this->validate([
                'pdf_file_path' => [
                    'uploaded[pdf_file_path]',
                    // 'mime_in[file,image/jpg,image/jpeg,image/gif,image/png,application/pdf]',
                    'mime_in[pdf_file_path,application/pdf]',
                    'max_size[pdf_file_path,4096]',
                ],
            ]);

            $msg = 'Please select a valid file';
            //exit(WRITEPATH);
            if ($validated) {
                $note = $this->request->getFile('pdf_file_path');
                //$note->move(ROOTPATH . 'public/notes/');
                //$pdf_file = $note->getClientName();


                $newName = bin2hex(random_bytes(4)) . '_' . bin2hex(random_bytes(2)) . '_' . bin2hex(random_bytes(4)); // Generates a 12-character hexadecimal string
                $extension = $note->getClientExtension();
                $pdf_file = $newName . '.' . $extension;

                $note->move(ROOTPATH . 'public/notes/', $pdf_file);
            }
        }

        $data = [
            'chapter_name' => $_POST['chapter_name'],
            'video_title' => $_POST['video_title'],
            'video_link'  => $_POST['video_link']
        ];

        if ($pdf_file != "") {
            $data['pdf_file_path'] = $pdf_file;

            $query = $this->db->query('SELECT pdf_file_path FROM course_content WHERE course_content_id=' . $course_content_id);
            $row = $query->getRow();

            if (isset($row)) {
                $old_file = $row->pdf_file_path;
                $file_path = ROOTPATH . 'public/notes/' . $old_file;

                if (file_exists($file_path)  && $old_file != null) {
                    unlink($file_path);
                }
            }
        }

         $update =  $this->TeacherCourseContentStoreDbModelObject
            ->where('course_content_id', $course_content_id)
            ->set($data)
            ->update();

        if ($update) {
            echo  $pdf_file;
        }
    }
    public function course_include_view()
    {
        if (isset($_SESSION['id'])) {
            $teacher_id = $_SESSION['id'];
            $query   = $this->db->query("SELECT * FROM  teacher_course 
                        Where course_teacher_id = '$teacher_id' AND course_type_name != 'Question_And_Exam' AND course_status = 'approved'");
            $data['results'] = $query->getResult();
            return view('teacher/TeacherCourseIncludeView', $data);
        }
    }
    public function batchCreate()
    {

        if (isset($_SESSION['id'])) {
            $teacher_id = $_SESSION['id'];
            $query   = $this->db->query("SELECT course_id,coures_title FROM  teacher_course 
                        Where course_teacher_id = '$teacher_id' AND course_status = 'approved' ");
            $data['results'] = $query->getResult();
            return view('teacher/batch_create', $data);
        }
    }
    public function batchStore()
    {
        $data = [
            'course_id' => $this->request->getPost('course_id'),
            'start_date' => $this->request->getPost('start_date'),
            'end_date' => $this->request->getPost('end_date'),
            'time_slot' => $this->request->getPost('timeslot'),
            'weekly_days' => implode(',', $this->request->getPost('weekly_days')), // convert days array to string
            'max_seats' => $this->request->getPost('max_seat'),
            'booked_seats' => 0,
            'status' => 'active'
        ];
        $bath_insert =  $this->BatchModelObject->insert($data);
        if ($bath_insert > 0) {
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['message'] = "Batch Creation Successful ";
            return redirect()->to(base_url() . 'teacher/batch-create');
        }
    }

    ////////////////////////kaj korte hobe ekane//////////////////////////////////////////////

    public function TeacherCourseIncludeFromDb()
    {
        $course_id = $_GET['id'];
        $query   = $this->db->query("SELECT * FROM course_include  
                                  Where course_id = '$course_id'");
        $courseIncludeList = $query->getResult();
        $response = [];
        foreach ($courseIncludeList as $IncludeList) {
            $item = [
                "course_include_id" => $IncludeList->course_include_id,
                "course_duration" => $IncludeList->course_duration,
                "live_class" => $IncludeList->live_class,
                "course_exam" => $IncludeList->course_exam,
                "course_model_test" => $IncludeList->course_model_test,
                "class_time" => $IncludeList->class_time
            ];
            array_push($response, $item);
        }
        echo json_encode($response);
    }
    ////////////////////////////////////////////////////////////////////////////
    public function batchDataFromDb()
    {
        $courseID = $_GET['id'];
        $builder = $this->db->table('course_batch');
        $builder->where('course_id', $courseID);
        $query   = $builder->get();
        $results = $query->getResult();
        $response = [];
        foreach ($results as $batchInfo) {
            $item = [
                "batch_id"  => $batchInfo->batch_id,
                "start_date" => $batchInfo->start_date,
                "end_date" => $batchInfo->end_date,
                "time_slot" => $batchInfo->time_slot,
                "weekly_days" => $batchInfo->weekly_days,
                "max_seats" => $batchInfo->max_seats
            ];
            array_push($response, $item);
        }
        echo json_encode($response);
    }
    ////////////////////////////////////////////////////////////////////////////
    public function batchUpdate()
    {
        $batch_id = $_GET['batch_id'];
        // $start_date = $_GET['start_date'];
        //$end_date = $_GET['end_date'];
        // $time_slot = $_GET['time_slot'];
        // $weekly_days = $_GET['weekly_days'];
        $weekly_days = $_GET['selectedDays'];

        // Convert the string into an array
        $daysArray = explode(',', $weekly_days);


        // echo "dfgfdgfd". $selectedDays;
        // exit();
        $data = [
            'batch_id' => $_GET['batch_id'],
            'start_date' => $_GET['start_date_edit'],
            'end_date'  => $_GET['end_date_edit'],
            'time_slot' => $_GET['time_slot'],
            'weekly_days' => implode(', ', $daysArray), // convert days array to string
            'max_seats' => $_GET['max_seats']
        ];
        $update =  $this->BatchModelObject->where('batch_id', $batch_id)->set($data)->update();
        if ($update) {
            echo "update done";
        }
    }
    ////////////////////////////////////////////////////////////////////////////
    public function TeacherCourseIncludeUpdate()
    {
        $course_include_id = $_GET['course_include_id'];
        $course_duration = $_GET['course_duration'];
        $live_class = $_GET['live_class'];
        $course_exam = $_GET['course_exam'];
        $course_model_test = $_GET['course_model_test'];
        $class_time = $_GET['class_time'];

        $data = [
            'course_duration' => $_GET['course_duration'],
            'live_class' => $_GET['live_class'],
            'course_exam'  => $_GET['course_exam'],
            'course_model_test' => $_GET['course_model_test'],
            'class_time' => $_GET['class_time']
        ];
        $update =  $this->CourseIncludeModelObject->where('course_include_id', $course_include_id)->set($data)->update();
        if ($update) {
            echo "update done";
        }
    }
    ////////////////////////////////////////////////////////////////////////
    public function teacherCourseContentDelete()
    {
        $course_content_id = $_GET['id'];
        $response =  $this->db->table('course_content')->where(['course_content_id' => $course_content_id])->delete();
        echo $response;
    }
    ///////////////////////////////////////////////////////////////////////////
    public function courseInclude_insert_db()
    {
        // $teacher_id = $_SESSION['id'];
        $data = [
            'course_id'  => $this->request->getVar('course_id'),
            'course_duration'       => $this->request->getVar('course_duration'),
            'live_class'        => $this->request->getVar('live_class'),
            'course_exam'       => $this->request->getVar('course_exam'),
            'course_model_test'    => $this->request->getVar('course_model_test'),
            'class_time'    => $this->request->getVar('class_time')
        ];
        $course_include_section = $this->CourseIncludeModelObject->insert($data);
        if ($course_include_section > 0) {
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['message'] = "Course Include Section Data Creation Successful ";
            return redirect()->to(base_url() . 'teacher/course-view');
        } else {
            $_SESSION['message'] = "Unable to Create Course!";
            return redirect()->to(base_url() . 'teacher/course-include');
        }
    }

    public function teacher_profile_update($teacher_id = 0)
    {
        /////////////////////For Image Upload////////////////////////////////
        helper(['form', 'url']);

        $validated = $this->validate([
            'file' => [
                'uploaded[file]',
                'mime_in[file,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[file,4096]',
            ],
        ]);
        $msg = 'Please select a valid file';
        //exit(WRITEPATH);
        if ($validated) {
            $avatar = $this->request->getFile('file');
            // $avatar->move(WRITEPATH . 'uploads');
            //$avatar->move(WRITEPATH . 'assets/images');
            $avatar->move(ROOTPATH . 'public/TeacherUploads/');
        }
        ////////////////////////////////////////////////////////////////////////
        $teacher_id = $_SESSION['id'];
        $data = [
            'teacher_id'                => $teacher_id,
            'last_educational_institute' => $this->request->getVar('last_educational_institute'),
            'teacher_edu_his'           => $this->request->getVar('teacher_edu_his'),
            'teacher_pro_his'           => $this->request->getVar('teacher_pro_his'),
            'teacher_certi_award'       => $this->request->getVar('teacher_certi_award'),
            'teacher_pic'               => $this->request->getVar('teacher_pic'),
            'teacher_pic'               => $avatar->getClientName(),
            'term_condition'            => $this->request->getVar('term_condition')
        ];
        $update =  $this->teacherProfileUpdateModelObject->where('teacher_id', $teacher_id)->set($data)->update();
        if ($update > 0) {
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['message'] = "Successfully Udated";
            return redirect()->to(base_url() . 'teacher/profile');
        } else {
            $_SESSION['message'] = "Update Fail!";
            return redirect()->to(base_url() . 'teacher/profile');
        }
    }
}
