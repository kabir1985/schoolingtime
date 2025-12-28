<?php

namespace App\Controllers;

class HomepageController extends BaseController
{
    private $db;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        $sql = " SELECT 
                            tc.course_type_name,
                            tc.*, 
                            rt.feedback_rating, 
                            rt.number_of_student,
                            tr.teacher_name,
                            tr.last_educational_institute,
                            tr.teacher_pro_his,
                            MIN(cb.start_date)
                        FROM 
                            teacher_course AS tc
                        LEFT JOIN (
                            SELECT 
                                AVG(feedback_rating) AS feedback_rating, 
                                COUNT(student_id) AS number_of_student, 
                                course_id,
                                teacher_course_id
                            FROM 
                                course_feedback 
                            GROUP BY 
                                teacher_course_id, course_id
                        ) AS rt
                        ON rt.course_id = tc.course_id 
                        LEFT JOIN (
                            SELECT 
                                teacher_registration.teacher_name, 
                                teacher_profile.last_educational_institute, 
                                teacher_profile.teacher_pro_his, 
                                teacher_registration.teacher_id 
                            FROM 
                                teacher_registration 
                            LEFT JOIN 
                                teacher_profile 
                            ON 
                                teacher_registration.teacher_id = teacher_profile.teacher_id 
                        ) AS tr
                        ON tr.teacher_id = tc.course_teacher_id
                        LEFT JOIN course_batch AS cb 
                        ON cb.course_id = tc.course_id
                        WHERE 
                            tc.course_status != 'pending'
                            GROUP BY 
                                            tc.course_type_name, 
                                                tc.course_id,
                                                rt.feedback_rating,
                                            rt.number_of_student,
                                                tr.teacher_name, 
                                                tr.last_educational_institute, 
                                            tr.teacher_pro_his ";

        $query = $this->db->query($sql);
        $data['courseList'] = $query->getResult();

        return view('homepage/homepageView', $data);
    }


    public function Course_details_view($course_id)
    {

      //  echo $course_id;
       // exit();
       //*************************************************************************************************** */
        //         $course_info_query = $this->db->query("SELECT tc.*, tp.*, ci.*
        //                      FROM teacher_course tc 
        //                      LEFT JOIN teacher_profile tp ON tc.course_teacher_id = tp.teacher_id
        //                      LEFT JOIN course_include ci ON tc.course_id = ci.course_id
        //                      WHERE tc.course_id = '$course_id' AND tc.course_status = 'approved'");
        // $data['course_info'] = $course_info_query->getRow();

        $sql = "SELECT 
                    tc.*, 
                    tp.*, 
                    ci.*,
                    COALESCE(ci.course_id, '') AS ci_course_id
                    FROM teacher_course tc
                    LEFT JOIN teacher_profile tp ON tc.course_teacher_id = tp.teacher_id
                    LEFT JOIN course_include ci ON tc.course_id = ci.course_id
                    WHERE tc.course_id = ? 
                    AND tc.course_status = 'approved'";

                    $course_info_query = $this->db->query($sql, [$course_id]);
                    $data['course_info'] = $course_info_query->getRow();



        //**************************************************************************************************** */

        // Fetch course contents separately for better organization

        //     $course_contents_query = $this->db->query("SELECT chapter_id, chapter_name, course_content_id, video_title, pdf_file_path, video_link 
        //                                 FROM course_content 
        //                                 WHERE course_id = '$course_id' 
        //                                 GROUP BY chapter_id, chapter_name 
        //                                 ORDER BY course_content_id");


        // $data['course_contents'] = $course_contents_query->getResult();



        $course_contents_query = $this->db->query("
        SELECT chapter_id, chapter_name, course_content_id, video_title, pdf_file_path, video_link
        FROM course_content
        WHERE course_id = '$course_id'
        ORDER BY chapter_id, course_content_id
    ");
    $data['course_contents'] = $course_contents_query->getResult();



        $course_batch_query = $this->db->query(" SELECT *  FROM course_batch
                                WHERE course_id = $course_id");
        $data['course_batch'] = $course_batch_query->getResult();

        // Check if course information exists before setting up metadata
        if ($data['course_info']) {
            // Metadata setup
            $data['metaData'] = [
                'url' => current_url(),
                'title' => $data['course_info']->coures_title,
                'description' => $data['course_info']->course_note,
                'image' => base_url() . 'public/CourseUploads/' . $data['course_info']->course_pic
            ];
        } else {
            // Handle the case where no course information is found
            $data['metaData'] = [
                'url' => current_url(),
                'title' => 'Course Not Found',
                'description' => 'The requested course could not be found.',
                'image' => base_url() . 'public/CourseUploads/default.jpg'
            ];
        }

        return view('student/CourseDetailsView', $data);
    }


    public function copyright()
    {
        return view('include/copyright');
    }

    public function course_affiliate()
    {
        return view('teacher/courseaffiliateView');
    }
}