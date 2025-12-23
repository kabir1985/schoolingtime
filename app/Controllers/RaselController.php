<?php

namespace App\Controllers;

class RaselController extends BaseController
{
    private $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function index()
    {


        $data['content'] = $this->section("kabir");

        return view('rasel/home', $data);
    }


    private function section($txt)
    {
        return strtoupper($txt);
    }


    public function about()
    {

        return view('rasel/about');
    }
}
