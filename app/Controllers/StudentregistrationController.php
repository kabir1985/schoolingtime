<?php

namespace App\Controllers;

use App\Models\StudentregistrationModel;
use App\Models\StudentIDforProfileModel;

use CodeIgniter\HTTP\IncomingRequest;

class StudentregistrationController extends BaseController
{
    private $StudentregistrationModelObject;
    private $StudentIDforProfileModelObject;
    private $db;

    public function __construct()
    {
        $this->StudentregistrationModelObject = new StudentregistrationModel();
        $this->StudentIDforProfileModelObject = new StudentIDforProfileModel();
        $this->db = db_connect();
    }
    public function index()
    {
        // Load the session service
        $session = \Config\Services::session();
        // Generate a simple math question
        $number1 = rand(1, 10);
        $number2 = rand(1, 10);
        $captchaQuestion = "$number1 + $number2 = ?";
        // Store the correct answer in the session
        $session->set('captcha_answer', $number1 + $number2);
        // Pass the question to the view
        return view('student/StudentRegistrationView', ['captchaQuestion' => $captchaQuestion]);
        // return view('student/StudentRegistrationView');
    }

    public function student_guide()
    {
        return view('student/studentGuideView');
    }

    //Data insert into db
    public function store()
    {
        // Load the session service
        $session = \Config\Services::session();
        // Get the correct answer from the session
        $correctAnswer = $session->get('captcha_answer');
        // Get the user input
        $userAnswer = $this->request->getPost('captcha');
        // Validate the CAPTCHA answer
        if ($userAnswer != $correctAnswer) {
            // Handle incorrect CAPTCHA response
            return redirect()->back()->with('error', 'Incorrect CAPTCHA answer. Please try again.')->withInput();
        }

        $day_no = date('z') + 1;
        $unique_text = substr(md5(microtime(true) . mt_Rand()), -5);
        $student_id = strtoupper('STD' . date('y') . str_pad($day_no, 3, '0', STR_PAD_LEFT) . '' . $unique_text);

        $data = [
            'student_id'        => $student_id,
            'student_name'      => $this->request->getVar('name'),
            'student_email'     => $this->request->getVar('email'),
            'student_mobile'    => $this->request->getVar('mobile'),
            'student_password'  => $this->request->getVar('password')
        ];

        ////////////////////////////////////////////////////For Email Verification
        // $email = \Config\Services::email();

        // $email->setFrom('skabir@com', 'Your Name');
        // $email->setTo($data['student_email']);
        // $email->setCC('another@another-example.com');
        // $email->setBCC('them@their-example.com');

        // $email->setSubject('Email Test');
        // $email->setMessage('Testing the email class.');

        // $email->send();

        ////////////////////////////////////////////////////

        ///////Student Already registered kina check kora////////////
        $student_email = $this->request->getVar('email');

        $builder = $this->db->table('student_registration');
        //$builder->where('student_id', $id);
        $builder->where('student_email', $student_email);
        $query   = $builder->get();
        $results = $query->getNumRows();

        if ($results > 0) {

            $_SESSION['message'] = "You Already Registered!";
            return redirect()->to(base_url() . 'student/login');
        }
        //////////////////////////////////////////

        $stu_in_insert = ['stu_profile_id' => $student_id];
        //Student Registrtion Insert
        $d = $this->StudentregistrationModelObject->insert($data);
        //Student ID insertion in Student Profile Table e
        $this->StudentIDforProfileModelObject->insert($stu_in_insert);
        if ($d > 0) {
            //echo "success";
            $_SESSION['message'] = "Successfully Registration Completed";
            return redirect()->to(base_url() . 'student/login');
        } else {
            //echo "Data insertion fail";
            return redirect()->to(base_url() . 'student/registration');
        }

        // return $this->response->redirect(site_url('/Studentregistration'));
    }
}
