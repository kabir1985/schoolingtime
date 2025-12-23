<?php
 namespace App\Models;
 use CodeIgniter\Model;

class QuestionSetInsertModel extends Model
 {
    protected $table = 'question_set';

    protected $primaryKey = 'id';

    protected $allowedFields = ['subject_id','question_set_id','question_id'];


   //  public function upsertBatch($data)
   //  {
   //      // Use the insertBatch method with the onDuplicateKeyUpdate option
   //      $this->insertBatch($data, true);
   //  }

 } 

