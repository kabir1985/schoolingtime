<?php
namespace App\Controllers;
use App\Models\CourseStatusUpdateModel;
use Google\Service\Adsense\Alert;

class CourseActiveInactiveController extends BaseController
{
    private $db;
    private $CourseStatusUpadteObject;
    public function __construct()
    {
       $this->CourseStatusUpadteObject = new CourseStatusUpdateModel();
        $this->db = db_connect();
    }

    public function index()
    {

        // $query = $this->db->query("SELECT teacher_profile.last_educational_institute, teacher_profile.teacher_edu_his,
        //           teacher_profile.teacher_pro_his, teacher_profile.teacher_certi_award, teacher_profile.teacher_pic,
        //          teacher_course.coures_title, teacher_course.course_level,
        //          teacher_course.course_note,teacher_course.course_pic,
        //          teacher_course.course_teacher_id,teacher_course.course_id,teacher_course.course_status,
        //          teacher_course.course_type_name
        //          FROM teacher_course
        //          LEFT JOIN teacher_profile ON teacher_profile.teacher_id = teacher_course.course_teacher_id");

      
        $query = $this->db->query
                        (" SELECT 
                            teacher_profile.last_educational_institute, 
                            teacher_profile.teacher_edu_his,
                            teacher_profile.teacher_pro_his, 
                            teacher_profile.teacher_certi_award, 
                            teacher_profile.teacher_pic,
                            teacher_course.coures_title, 
                            teacher_course.course_level,
                            teacher_course.course_note,
                            teacher_course.course_pic,
                            teacher_course.course_teacher_id,
                            teacher_course.course_id,
                            teacher_course.course_status,
                            teacher_course.course_type_name,
                            course_batch.course_id AS batch_course_id  -- Alias for clarity
                        FROM 
                            teacher_course
                        LEFT JOIN 
                            teacher_profile ON teacher_profile.teacher_id = teacher_course.course_teacher_id
                        LEFT JOIN 
                            course_batch ON course_batch.course_id = teacher_course.course_id
                            GROUP BY 
                               teacher_course.course_id
                    ");
    
      
        $data['results'] = $query->getResult();

        return view('supperadmin/courseActiveInactiveView',$data);
    }

public function courseStatusUpdate()
{
    // Retrieve data from the POST request
    $course_id = $this->request->getVar('course_id');
    $course_status = $this->request->getVar('course_status');
    $batch_id = $this->request->getVar('batch_id');

    // Validate that required fields are present
    if (empty($course_id) || empty($batch_id)) {
        // If course_id or batch_id is missing, set an error message and redirect back
        $_SESSION['message'] = "Update Failed! Missing course or batch ID.";
        return redirect()->to(base_url('supperadmin/courseStatus'));
    }

    // Toggle the course status (assuming "pending" -> "active" or vice versa)
    $new_status = ($course_status == 'pending') ? 'approved' : 'pending';

    // Prepare the data to be updated in the database
            $data = [
            'teacher_id'    => $course_id,
            'course_status' => $new_status
            //'course_start_date' => $this->request->getVar('course_start_date')
         ];

    // Try updating the course status in the database
    try {
        // Assuming you have a model that handles updating course status    
         $this->CourseStatusUpadteObject->where('course_id', $course_id)->set($data)->update();
        // Set success message and redirect back to the course status page
        $_SESSION['message'] = "Course status updated successfully.";
        return redirect()->to(base_url('supperadmin/courseStatus'));
    } catch (\Exception $e) {
        // If there's any issue, set an error message and redirect back
        $_SESSION['message'] = "Update Failed! Error: " . $e->getMessage();
        return redirect()->to(base_url('supperadmin/courseStatus'));
    }
}








}