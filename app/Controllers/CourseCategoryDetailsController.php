<?php

namespace App\Controllers;

use App\Models\SearchCourseModel;

class CourseCategoryDetailsController extends BaseController
{
    private $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        $query = $this->db->query("SELECT * From course_category");
        $data['courseCategoryList'] = $query->getResult();

        $sql = " SELECT tc.*, rt.feedback_rating,rt.number_of_student,tr.teacher_name,tr.last_educational_institute,tr.teacher_pro_his
        FROM teacher_course AS tc
        LEFT JOIN (SELECT AVG(feedback_rating) AS feedback_rating, COUNT(student_id) AS number_of_student,course_id FROM course_feedback GROUP BY teacher_course_id
        ) AS rt
        ON  rt.course_id = tc.course_id 
        LEFT JOIN ( SELECT teacher_registration.teacher_name, teacher_profile.last_educational_institute,teacher_profile.teacher_pro_his, teacher_registration.teacher_id FROM teacher_registration 
            LEFT JOIN teacher_profile ON teacher_registration.teacher_id = teacher_profile.teacher_id 
        ) AS tr
        ON  tr.teacher_id = tc.course_teacher_id
        WHERE tc.course_status !='pending'";
        $query = $this->db->query($sql);
        $data['courseList'] = $query->getResult();
        ////////////////////////Coruse Serach option///////////////////////////////////////
        // Load the model
        $model = new SearchCourseModel();
        // Get the search query from AJAX request
        $searchQuery = $this->request->getGet('query');
        // Fetch courses from the database that match the search query
        // $data = [];
        if ($searchQuery) {
            $data['searchQuery'] = $searchQuery;
            $data['search'] = $model->searchCourses($searchQuery);
        }
        /////////////////////////////////////////////////////////////////////
        return view('include/coursecategorydetailsView', $data);
    }


    public function academicCourse()
    {
        $query = $this->db->query("SELECT course_category.course_category_name ,course_category.course_category_id
                    From course_category LEFT JOIN course_section ON course_section.course_section_id = course_category.course_section_id
                    WHERE course_section.course_section_name = 'Academic_Course'");
        $data['academicCosurseList'] = $query->getResult();
        return view('include/academicCourseView', $data);
    }
    public function skillDevelopmentCourse()
    {
        $query = $this->db->query("SELECT course_category.course_category_name ,course_category.course_category_id
                    From course_category LEFT JOIN course_section ON course_section.course_section_id = course_category.course_section_id
                    WHERE course_section.course_section_name = 'Skill_Development'");
        $data['results'] = $query->getResult();
        return view('include/skillDevelopmentCourseView', $data);
    }
    public function job_admission_course()
    {

        $query = $this->db->query("SELECT course_category.course_category_name ,course_category.course_category_id
                     From course_category LEFT JOIN course_section ON course_section.course_section_id = course_category.course_section_id
                    WHERE course_section.course_section_name = 'Exam_Course'");
        $data['results'] = $query->getResult();
        return view('include/jobAdmissionCourseView', $data);
    }

    public function CourseShowSkillDevelopment($CourseCategoryID)
    {
        $query = $this->db->query("SELECT * FROM  teacher_course Where course_status !='pending' AND course_category_id = '$CourseCategoryID' ");
        $data['skill_development_course_show'] = $query->getResult();

        $query = $this->db->query("SELECT course_category.course_category_name ,course_category.course_category_id
        From course_category LEFT JOIN course_section ON course_section.course_section_id = course_category.course_section_id
        WHERE course_section.course_section_name = 'Skill_Development'");
        $data['results'] = $query->getResult();

        return view('include/CourseShowSkillDevelopmentView', $data);
    }

    public function CourseShowAcademic($CourseCategoryID)
    {
        $query = $this->db->query("SELECT * FROM  teacher_course Where course_status !='pending' AND course_category_id = '$CourseCategoryID' ");
        $data['academic_course_show'] = $query->getResult();

        $query = $this->db->query("SELECT course_category.course_category_name ,course_category.course_category_id
        From course_category LEFT JOIN course_section ON course_section.course_section_id = course_category.course_section_id
        WHERE course_section.course_section_name = 'Academic_Course'");
        $data['results'] = $query->getResult();

        return view('include/CourseShowAcademicView', $data);
    }
    public function CourseShowCateryWise($CourseCategoryID)
    {
        //$db = \Config\Database::connect();
        // $query = $this->db->query("SELECT course_category.course_category_name ,course_category.course_category_id
        //                                 From course_category LEFT JOIN course_section ON course_section.course_section_id = course_category.course_section_id
        //                                 WHERE course_section.course_section_name != 'Admission_Course'");
        // $data['results'] = $query->getResult();

        $query = $this->db->query("SELECT * From course_category");
        $data['courseCategoryList'] = $query->getResult();

        // $query = $this->db->query("SELECT * FROM  teacher_course Where course_status !='pending' AND  course_category_id = '$CourseCategoryID' ");
        // $data['category_wise_course_show'] = $query->getResult();


        $sql = " SELECT tc.*, rt.feedback_rating,rt.number_of_student,tr.teacher_name,tr.last_educational_institute,tr.teacher_pro_his
        FROM teacher_course AS tc
        LEFT JOIN (SELECT AVG(feedback_rating) AS feedback_rating, COUNT(student_id) AS number_of_student,course_id FROM course_feedback GROUP BY teacher_course_id
        ) AS rt
        ON  rt.course_id = tc.course_id 
        LEFT JOIN ( SELECT teacher_registration.teacher_name, teacher_profile.last_educational_institute,teacher_profile.teacher_pro_his, teacher_registration.teacher_id FROM teacher_registration 
            LEFT JOIN teacher_profile ON teacher_registration.teacher_id = teacher_profile.teacher_id 
        ) AS tr
        ON  tr.teacher_id = tc.course_teacher_id
        WHERE tc.course_status !='pending'
        AND tc.course_category_id = '$CourseCategoryID' ";
        $query = $this->db->query($sql);
        $data['courseList'] = $query->getResult();


        return view('include/CourseShowCategoryWiseView', $data);
    }
}
