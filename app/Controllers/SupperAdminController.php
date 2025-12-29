<?php

namespace App\Controllers;

class SupperAdminController extends BaseController
{

    protected $db;

    public function __construct()
    {
        $this->db = db_connect();
    }

    public function index()
    {

        return view('supperadmin/loginSupperAdmin');
    }

    public function create()
    {

        $data = [
            'supperadmin_email' => $this->request->getVar('email'),
            'supperadmin_pw' => $this->request->getVar('pswd'),
        ];

        $builder = $this->db->table('supper_admin_login');
        $builder->where('user_id', $data['supperadmin_email']);
        $builder->where('password', $data['supperadmin_pw']);
        $query = $builder->get();
        $results = $query->getResult();

        if (sizeof($results) == 1) {
            // $_SESSION['name'] = $results[0]->teacher_name;
            // $_SESSION['id'] = $results[0]->teacher_id;
            // $_SESSION['isLoggedIn'] = true;
            // $_SESSION['message'] = "Successfully Logedin!";
            return redirect()->to(base_url() . '/supperadminview');
        } else {
           // $_SESSION['message'] = "Unable to Login!";
            return redirect()->to(base_url() . '/loginSupperAdmin');
        }

    }

    public function supperAdminView()
    {
        return view('supperAdminView');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        // return redirect()->to('/loginView');
        return redirect()->to(base_url() . '');
    }

}