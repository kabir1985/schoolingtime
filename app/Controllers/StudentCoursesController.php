<?php
namespace App\Controllers;

class StudentCoursesController extends BaseController
{
    function coursewiseEnrolledStudents()
    {
        $course_id = $this->request->getVar('id');

        $db = \Config\Database::connect();

        $query = $db->query("Select purchase_course.student_or_buyer_id, purchase_course.course_id,
             student_profile.stu_profile_id, student_profile.stu_edu_level_class,
             student_profile.stu_last_edu_institute,student_profile.stu_city,
             student_registration.student_name, student_registration.student_email,
             student_registration.student_mobile
             FROM (purchase_course LEFT JOIN student_profile ON purchase_course.student_or_buyer_id = student_profile.stu_profile_id)
             INNER JOIN student_registration ON purchase_course.student_or_buyer_id = student_registration.student_id
             WHERE purchase_course.course_id ='$course_id'");

        $enrolledStudentsList = $query->getResult();

        $returnData = "";

        if ($enrolledStudentsList) {

            foreach ($enrolledStudentsList as $enrolledStudent) {
                $returnData .= '<tr>
                               <td>' . $enrolledStudent->student_or_buyer_id . '</td>
                               <td>' . $enrolledStudent->student_name . '</td>
                               <td>' . $enrolledStudent->student_email . '</td>
                               <td>' . $enrolledStudent->student_mobile . '</td>
                               <td>' . $enrolledStudent->stu_city . '</td>
                               <td>' . $enrolledStudent->stu_edu_level_class . '</td>
                               <td>' . $enrolledStudent->stu_last_edu_institute . '</td>
                            </tr>';
            }
        } else {
            $returnData = '<tr><td class="text-center" colspan="3">No Data Found</td></tr>';
        }

        echo $returnData;

    }
}
