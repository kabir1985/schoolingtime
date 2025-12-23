<?php

namespace App\Controllers;

error_reporting(0);

class StudentloginController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
    }
    public function index()
    {
        return view('student/student_loginView');
    }

    public function student_login_check_view()
    {
        $current_url = $_SERVER['HTTP_REFERER'];
        $uri_login_or_admission = new \CodeIgniter\HTTP\URI($current_url);
        $segment_current_page = $uri_login_or_admission->getSegments();

        // echo "segment-1:".$segments[1];
        // echo "segment-3:". $segment_current_page[3];
        // echo "<pre>";
        // print_r($segment_current_page[1] . "/" . $segment_current_page[2] . '/' . $segment_current_page[3]);
         //echo "</pre>";
        
        // echo "kabir   : ". $segment_current_page[1]."/".$segment_current_page[2];
        // exit();

        $data = [
            'student_email' => $this->request->getVar('email'),
            'student_pw'    => $this->request->getVar('password')
        ];

        $builder = $this->db->table('student_registration');
        $builder->where('student_email',  $data['student_email']);
        $builder->where('student_password', $data['student_pw']);
        $query   = $builder->get();
        $results = $query->getResult();

        if (sizeof($results) == 1) {
            $_SESSION['student_name'] = $results[0]->student_name;
            $_SESSION['student_id'] = $results[0]->student_id;
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['message'] = "Successfully Logedin!";
                         
                        // if comes from course buy link
                            if ($segment_current_page[3] == 'course-buy')
                            {
                                return redirect()->to(base_url() . 'student/cart-view');
                            } 
                          // if comes from course exam link
                           // elseif ($segment_current_page[3] == 'exam')
                            //{
                               // return redirect()->to(base_url() . 'student/exam-system');
                           // }

                            //if comes from Student Login page
                            elseif ($segment_current_page[1] == 'login') 
                            {
                                return redirect()->to(base_url() . 'student/dashboard');
                            } 
                            
                            else //$segment_current_page[2] === 'admission-test'
                            {
                                return redirect()->to(base_url() . 'student/login');
                            }


       } else {
            $_SESSION['message'] = "Invalid Login ID or Password";
            return redirect()->to(base_url() . 'student/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url() . 'student/login');
    }
}
