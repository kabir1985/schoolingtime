<?php

namespace App\Models;

use CodeIgniter\Model;

class Google_login_model extends Model
{
   function Is_already_register($id)
   {

      $builder = $this->db->table('student_registration');
      //$builder->where('student_id', $id);
      $builder->where('third_party_id', $id);
      $query   = $builder->get();
      $results = $query->getNumRows();

      if ($results > 0) {
         return $query->getRow();
      } else {
         return false;
      }
   }

   function Update_user_data($data, $id)
   {
      $builder = $this->db->table('student_registration');
      $builder->where("student_id", $id);
      $builder->update($data);
   }

   function Insert_user_data($data)
   {
      $builder = $this->db->table('student_registration');
      $builder->insert($data);
   }
}
?>



<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentIDforProfileModel extends Model
{
   protected $table = 'student_profile';

   protected $primaryKey = 'ID';

   protected $allowedFields = ['stu_profile_id'];
}
