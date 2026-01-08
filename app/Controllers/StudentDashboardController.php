<?php

namespace App\Controllers;

use CodeIgniter\HTTP\IncomingRequest;
use App\Models\CoursePurchaseModel;
use App\Models\StudentFeedback;

class StudentDashboardController extends BaseController
{
    private $db;
    private $CoursePurchaseModelObject;
    private $StudentFeedbackObject;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->CoursePurchaseModelObject = new CoursePurchaseModel();
        $this->StudentFeedbackObject = new StudentFeedback();
    }
    public function index()
    {
        if (!isset($_SESSION['student_id'])) {
            echo "You are not logged in!";
        } else {
            $student_id = $_SESSION['student_id'];
            $sql = "SELECT student_registration.student_name, student_registration.student_email,student_registration.student_id,
                student_profile.stu_pic 
                FROM student_registration
                LEFT JOIN student_profile ON student_registration.student_id = student_profile.stu_profile_id
                WHERE student_registration.student_id ='$student_id'";

            $builder = $this->db->table('purchase_course');
            $builder->where("student_or_buyer_id", $student_id);
            $query = $builder->get();
            $data['course_purchase_info'] = $query->getResult();


            $data['student_list_show'] = $this->db->query($sql)->getResult('array');

            return view('student/studentDashboardView', $data);
        }
    }
    public function exam_system_view()
    {
        if (isset($_SESSION['student_id'])) {
            $student_id = $_SESSION['student_id'];
            
            $query = $this->db->table('purchase_course')
            ->select('purchase_course.course_id, purchase_course.student_or_buyer_id, teacher_course.coures_title')
            ->join('teacher_course', 'purchase_course.course_id = teacher_course.course_id', 'left')
            ->where('purchase_course.student_or_buyer_id', $student_id)
            ->distinct()
            ->get();
            $data['purchaseCourseList'] = $query->getResult();

            return view('student/examSystemView', $data);
        } 
        
        else {
            $_SESSION['message'] = "পরীক্ষার জন্য প্রথমে লগইন করতে হবে এবং কোর্সটি কিনতে হবে";
            return redirect()->to(base_url() . 'student/login');
        }
    }

    public function feedback_submission()
    {

        $data = [
            'teacher_course_id' => $this->request->getVar('teacher_course_id'),
            'course_id'         => $this->request->getVar('course_id'),
            'feedback_rating'   => $this->request->getVar('rating'),
            'feedback'          => $this->request->getVar('student_feedback'),
            'student_id'       => $this->request->getVar('student_id'),
            'student_name'      => $this->request->getVar('student_name')
        ];

        $teacher_course_id = $this->request->getVar('teacher_course_id');
        $student_id = $this->request->getVar('student_id');
        $builder = $this->db->table('course_feedback');
        $builder->where('teacher_course_id', $teacher_course_id);
        $builder->where('student_id', $student_id);
        $query   = $builder->get();
        $results = $query->getNumRows();

        if ($results > 0) {

            $_SESSION['message'] = "You already provided feedback";
            return redirect()->to(base_url() . 'student/dashboard');
        }



        $insertion =  $this->StudentFeedbackObject->insert($data);
        if ($insertion) {
            $_SESSION['message'] = "কোর্স সম্পর্কে আপনার মতামতের জন্য আপনাকে ধন্যবাদ";
            return redirect()->to(base_url() . 'student/dashboard');
        }
    }

    public function student_profile_create()
    {
        if (isset($_SESSION['student_id'])) {
            $student_id = $_SESSION['student_id'];
            $builder = $this->db->table('student_profile');
            $builder->where("stu_profile_id", $student_id);
            $query = $builder->get();
            $data['results'] = $query->getRow();

            return view('student/profile_createView', $data);
        }
    }
    public function course_selection()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * From teacher_course 
                      Where course_status !='pending' ");
        $data['results'] = $query->getResult();
        return view('student/CourseSelectionView', $data);
    }
    public function manageCart()
    {
        $course_id = $_GET['course_id'];

        $builder = $this->db->table('teacher_course');
        $builder->where('course_id', $course_id);
        $query   = $builder->get();
        $results = $query->getResult();

        $data['course'] = [];
        if (count($results) > 0) {
            $data['course'] = [
                "course_id" => $course_id,
                "course_title" => $results[0]->coures_title,
                "course_price" => $results[0]->course_price,
                "course_teacher_id" => $results[0]->course_teacher_id,
                //"batch_id" => $results11[0]->batch_id
            ];
        }

        $response = 0;

        if (!isset($_SESSION["cartItems"])) {
            $_SESSION["cartItems"][] = $data['course'];
            $response = 1; // Added to the Cart
        } else {
            // Remove the first item if it's empty
            if (empty($_SESSION["cartItems"][0])) {
                array_shift($_SESSION["cartItems"]);
            }

            // Check if the course is already in the cart
            $exist = false;
            foreach ($_SESSION["cartItems"] as $item) {
                if ($item["course_id"] == $data['course']['course_id']) {
                    $exist = true;
                    break;
                }
            }

            if (!$exist) {
                $_SESSION["cartItems"][] = $data['course'];
                $response = 1; // Added to the Cart
            } else {
                $response = 2; // Already Exist
            }
        }

        echo $response;
    }

    public function cartView()
    {
  
        return view('student/cart_view.php');
       
    }
    public function updateCart()
    {
        $index = $_POST['index'];
        $cartItems =  $_SESSION["cartItems"];
        $cartItems = array_values($cartItems);

        if (isset($_SESSION['course_id']) && $_SESSION['course_id'] == $cartItems[$index]['course_id']) {
            $_SESSION['course_id'] = null;
        }
        unset($cartItems[$index]);
        $_SESSION["cartItems"] = $cartItems;
        echo 1;
    }

    public function student_profile_update($profile_id = 0)
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
            $avatar->move(ROOTPATH . 'public/uploads/');
        }

        ////////////////////////////////////////////////////////////////////////

        $profile_id = $_SESSION['student_id'];
        $data = [
            'stu_date_of_birth'         => $this->request->getVar('stu_date_of_birth'),
            'stu_edu_level_class'       => $this->request->getVar('stu_present_edu_level'),
            'stu_last_edu_institute'    => $this->request->getVar('stu_last_current_edu_institute'),
            'stu_male_female'           => $this->request->getVar('stu_male_female'),
            'stu_pic'                   => $this->request->getVar('stu_pic'),
            'stu_bangla_english_medium' => $this->request->getVar('stu_bangla_english_medium'),
            'stu_city'                  => $this->request->getVar('stu_city'),
            'stu_guirdian_name'         => $this->request->getVar('stu_guardian_name'),
            'stu_guirdian_mobile'       => $this->request->getVar('stu_guardian_mobile'),
            'stu_guirdian_address'      => $this->request->getVar('stu_address'),
            'stu_pic'                   =>  $avatar->getClientName()

        ];
        //#################Student Profile table update kora###############################
        //$db = \Config\Database::connect();
        $builder = $this->db->table('student_profile');

        $builder->where("stu_profile_id", $profile_id);
        $results = $builder->update($data);
        //#################################################################################
        if ($results > 0) {
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['message'] = "Successfully Udated";
            return redirect()->to(base_url() . 'student/profile');
        } else {
            $_SESSION['message'] = "Update Fail!";
            return redirect()->to(base_url() . 'student/dashboard');
        }
    }
}
