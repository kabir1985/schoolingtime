<?php
 namespace App\Models;
 use CodeIgniter\Model;

class PurchaseCourseModel extends Model
 {
    protected $table = 'purchase_course';

    protected $primaryKey = 'purchase_id';

    protected $allowedFields = [ 'course_id','batch_id','student_or_buyer_id','course_teacher_id','course_price','company_commission_percent','company_amount','saler_or_teacher_amount'];

 } 

