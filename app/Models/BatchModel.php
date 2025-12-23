<?php
 namespace App\Models;
 use CodeIgniter\Model;

class BatchModel extends Model
 {
    protected $table = 'course_batch';

    protected $primaryKey = 'batch_id';

    protected $allowedFields = [ 'batch_id','course_id','start_date','end_date','time_slot','weekly_days','max_seats','booked_seats','status'];

 } 

