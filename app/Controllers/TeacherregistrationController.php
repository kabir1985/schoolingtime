<?php

namespace App\Controllers;

use App\Models\TeacherIdforProfileModel;
use App\Models\TeacherregistrationModel;

class TeacherregistrationController extends BaseController
{
    private $TeacherregistrationModelObject;
    private $TeacherIdforProfileModelObject;
    private $db;

    public function __construct()
    {
        $this->TeacherregistrationModelObject = new TeacherregistrationModel();
        $this->TeacherIdforProfileModelObject = new TeacherIdforProfileModel();
        $this->db = db_connect();
    }

    public function index()
    {
        $session = \Config\Services::session();
        $formType = 'teacher'; // student / teacher
        // Generate a simple number CAPTCHA
        $captchaCode = rand(100, 999);
        $session->set($formType . '_captcha_answer', $captchaCode);
        $data['captchaQuestion'] = "Enter this number: " . $captchaCode;
        return view('teacher/teacher_registrationView', $data);
    }

    public function teacher_guide()
    {
        return view('teacher/teacherGuideView');
    }

    //Data insert into db
    public function store()
    {

        $session = \Config\Services::session();
        $formType = $this->request->getPost('form_type'); // student / teacher
        $captchaKey = $formType . '_captcha_answer';
        $correctAnswer = $session->get($captchaKey);
        $userAnswer = $this->request->getPost('captcha');
        if (!$correctAnswer || $userAnswer != $correctAnswer) {
            return redirect()->back()->with('error', 'Incorrect CAPTCHA answer. Please try again.')->withInput();
        }
     // validation passed, remove captcha from session
        $session->remove($captchaKey);


        $day_no = date('z') + 1;
        $unique_text = substr(md5(microtime(true) . mt_Rand()), -5);
        $teacher_id = strtoupper('Tea' . date('y') . str_pad($day_no, 3, '0', STR_PAD_LEFT) . '' . $unique_text);

        $data = [
            'teacher_id' => $teacher_id,
            'teacher_name' => $this->request->getVar('teacher_name'),
            'teacher_email' => $this->request->getVar('teacher_email'),
            'teacher_mobile' => $this->request->getVar('teacher_mobile'),
            'teacher_password' => $this->request->getVar('teacher_password'),
        ];

        ///////Teacher Already registered kina check kora////////////
        $teacher_email = $this->request->getVar('teacher_email');

        $builder = $this->db->table('teacher_registration');
        //$builder->where('student_id', $id);
        $builder->where('teacher_email', $teacher_email);
        $query = $builder->get();
        $results = $query->getNumRows();

        if ($results > 0) {

            $_SESSION['message'] = "This Teacher Already Registered!";
            return redirect()->to(base_url() . 'teachers/loginView');
        }
        //////////////////////////////////////////
        $teacher_id_array = ['teacher_id' => $teacher_id];

        $d = $this->TeacherregistrationModelObject->insert($data);
        $this->TeacherIdforProfileModelObject->insert($teacher_id_array);
        if ($d > 0) {
            $_SESSION['message'] = "Teacher Registration Successfully Done";
            return redirect()->to(base_url() . 'teacher/login-view');
        } else {
            $_SESSION['message'] = "Teacher Registration Fail !!!";
            return redirect()->to(base_url() . 'teacher/register');
        }

    }
}
