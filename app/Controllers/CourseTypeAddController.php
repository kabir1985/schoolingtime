<?php

namespace App\Controllers;

class CourseTypeAddController extends BaseController
{
    public function index()
    {
        return view('supperadmin/courseTypeAddView');
    }
    public function course_section_add()
    {
        return view('supperadmin/courseSectionAddView');
    }
}
