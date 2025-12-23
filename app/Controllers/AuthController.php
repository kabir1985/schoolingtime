<?php
namespace App\Controllers;
use App\Models\StudentIDforProfileModel;
use CodeIgniter\Controller;
use App\Models\Google_login_model;

use Google_Client;
use Google_Service_Oauth2;

class AuthController extends BaseController
{
    private $Google_login_modelObject;
    private $StudentIDforProfileModelObject;
    public function __construct()
    {
        $this->Google_login_modelObject = new Google_login_model();
        $this->StudentIDforProfileModelObject = new StudentIDforProfileModel();
    }

    public function index()
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(base_url('/auth/callback'));
        $client->addScope("email");
        $client->addScope("profile");

        $authUrl = $client->createAuthUrl();
        return redirect()->to($authUrl);
    }

    public function callback()
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(base_url('auth/callback'));
        $client->addScope("email");
        $client->addScope("profile");

        if ($this->request->getVar('code')) {
            $client->authenticate($this->request->getVar('code'));
            $token = $client->getAccessToken();

            // Use the access token to fetch user data from Google
            $oauth2 = new Google_Service_Oauth2($client);
            $data = $oauth2->userinfo->get();

            $current_datetime = date('Y-m-d H:i:s');


            $studentData = $this->Google_login_modelObject->Is_already_register($data['id']);
            if ($studentData != false) {
                $_SESSION['student_id'] = $studentData->student_id;
                $_SESSION['name'] = $studentData->student_name;
                $_SESSION['isLoggedIn'] = true;
            } else {
                //insert data

                $day_no = date('z') + 1;
                $unique_text = substr(md5(microtime(true) . mt_Rand()), -5);
                $student_id = strtoupper('STD' . date('y') . str_pad($day_no, 3, '0', STR_PAD_LEFT) . '' . $unique_text);


                $user_data = array(
                    'student_id' => $student_id,
                    'student_name'  => $data['given_name'],
                    'student_email '  => $data['email'],
                    'third_party_id' => $data['id'],
                    'created_at'  => $current_datetime
                );
                //student_registration Table e Entry
                $this->Google_login_modelObject->Insert_user_data($user_data);
                     
                //Student ID insertion in Student Profile Table e
                $stu_in_insert =['stu_profile_id' => $student_id];
                $this->StudentIDforProfileModelObject->insert($stu_in_insert); 

                // student_id set this in session
                $_SESSION['student_id'] = $student_id;
                $_SESSION['name'] = $data['given_name'];
                $_SESSION['isLoggedIn'] = true;
            }





            //  echo $user_data['email_address']."<br>";  
            //  echo $user_data['login_oauth_uid'];
            //  exit();

            // Process user data and create a user session
            // Example: Save user data to the session
            //session()->set('user', $user_data);

            // Get user info from session 

            //  echo "<pre>";
            //  print_r($userData);
            // echo "</pre>";


            // Redirect to the desired page after successful login
            // return redirect()->to('students/studentdashboard');
            return redirect()->to(base_url() . 'student/dashboard');
        }
    }
}
