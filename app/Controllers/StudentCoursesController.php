<?php
namespace App\Controllers;

class StudentCoursesController extends BaseController
{
    public function coursewiseEnrolledStudents()
    {
        $course_id = $this->request->getVar('id');
    
        $db = \Config\Database::connect();
    
        // Safe query using binding
        $query = $db->query(
            "SELECT 
                purchase_course.student_or_buyer_id,
                purchase_course.course_id, 
                purchase_course.batch_id,
                student_profile.stu_profile_id, 
                student_profile.stu_edu_level_class,
                student_profile.stu_last_edu_institute,
                student_profile.stu_city,
                student_registration.student_name, 
                student_registration.student_email,
                student_registration.student_mobile
             FROM purchase_course
             LEFT JOIN student_profile 
                ON purchase_course.student_or_buyer_id = student_profile.stu_profile_id
             INNER JOIN student_registration 
                ON purchase_course.student_or_buyer_id = student_registration.student_id
             WHERE purchase_course.course_id = ?",
            [$course_id]
        );
    
        $enrolledStudentsList = $query->getResult();
    
        $returnData = "";
    
        if ($enrolledStudentsList) {
    
            // Group students by batch_id
            $studentsByBatch = [];
            foreach ($enrolledStudentsList as $stu) {
                $studentsByBatch[$stu->batch_id][] = $stu;
            }
    
            // Loop over each batch
            foreach ($studentsByBatch as $batch_id => $students) {
    
                // Optional: show batch header
                $returnData .= '<tr style="background:#f2f2f2;">
                                    <td colspan="8"><strong>Batch ID: ' . $batch_id . '</strong></td>
                                </tr>';
    
                // Loop over students in this batch
                foreach ($students as $enrolledStudent) {
                    $returnData .= '<tr>
                                       <td>' . $enrolledStudent->batch_id . '</td>
                                       <td>' . $enrolledStudent->student_or_buyer_id . '</td>
                                       <td>' . esc($enrolledStudent->student_name) . '</td>
                                       <td>' . esc($enrolledStudent->student_email) . '</td>
                                       <td>' . esc($enrolledStudent->student_mobile) . '</td>
                                       <td>' . esc($enrolledStudent->stu_city) . '</td>
                                       <td>' . esc($enrolledStudent->stu_edu_level_class) . '</td>
                                       <td>' . esc($enrolledStudent->stu_last_edu_institute) . '</td>
                                    </tr>';
                }
            }
        } else {
            $returnData = '<tr><td class="text-center" colspan="8">No Data Found</td></tr>';
        }
    
        echo $returnData;
    }
}
