<?php

namespace App\Models;

use CodeIgniter\Model;

class SearchCourseModel extends Model
{
    protected $table = 'teacher_course'; // The name of your table
    protected $primaryKey = 'course_id';

        // Function to search for courses by keyword 
        public function searchCourses($query)
        {
            return $this->groupStart('coures_title', $query)// Start a group for the like conditions
                        ->orLike('course_note', $query)
                        ->orLike('course_level', $query)
                        ->orLike('course_type_name', $query)
                        ->orLike('course_pic', $query)
                        ->groupEnd() // End the group
                        ->where('course_status !=', 'pending') // Exclude pending courses
                        ->findAll();// Retrieve all matching results
        }
}
