<?php
 namespace App\Models;
 use CodeIgniter\Model;

class TeacherCourseContentStoreDbModel extends Model
 {
    protected $table = 'course_content';

    protected $primaryKey = 'course_content_id';

    protected $allowedFields = ['course_id','chapter_id','chapter_name','video_title','video_link','pdf_file_path'];

 } 

