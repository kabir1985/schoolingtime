<?php

namespace App\Controllers;

class TeacherloginController extends BaseController
{
    protected $db;

    public function __construct()
    {
        
        $this->db = db_connect();
    }

    public function index()
    {
        return view('teacher/teacher_loginView');
    }

    public function login_store()
    {

        $data = [
            'teacher_email'     => $this->request->getVar('teacher_email'),
            'teacher_password' => $this->request->getVar('teacher_password')
        ];
        
        $builder = $this->db->table('teacher_registration');
        $builder->where('teacher_email',  $data['teacher_email']);
        $builder->where('teacher_password', $data['teacher_password']);
        $query   = $builder->get();
        $results = $query->getResult();

        if (sizeof($results) == 1)
         {
            $_SESSION['name'] = $results[0]->teacher_name;
            $_SESSION['id'] = $results[0]->teacher_id;
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['message'] = "Successfully Logedin!";
            return redirect()->to(base_url() . 'teacher/dashboard');
        } 
        else {
            $_SESSION['message'] = "Unable to Login!";
             return redirect()->to(base_url().'teacher/login-view');  
        }
       // $session->markAsFlashdata("message");
    }


    public function logout()
    {
        $session = session();
        $session->destroy();
        // return redirect()->to('/loginView');
        return redirect()->to(base_url() . '');
    }
}
