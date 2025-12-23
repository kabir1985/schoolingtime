<?php
 namespace App\Models;
 use CodeIgniter\Model;

class CourseCategoryAddModel extends Model
 {
    protected $table = 'course_category';

    protected $primaryKey = 'course_category_id';

    protected $allowedFields = ['course_category_name','course_section_id'];

 } 