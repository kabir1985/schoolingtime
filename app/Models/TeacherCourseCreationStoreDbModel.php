<?php
 namespace App\Models;
 use CodeIgniter\Model;

class TeacherCourseCreationStoreDbModel extends Model
 {
    protected $table = 'teacher_course';

    protected $primaryKey = 'course_id';

    protected $allowedFields = ['course_teacher_id','coures_title','course_type_name','course_section_id','course_category_id','course_level','what_you_will_learn','course_price','demo_class_link','course_prerequisite','course_note','course_pic','course_status'];

 } 

