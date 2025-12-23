<?php

namespace App\Controllers;

use App\Models\CourseCategoryAddModel;
use App\Models\SalesCommissionAddModel;

class CourseCategoryController extends BaseController
{
    private $CourseCategoryAddModelObject;
    private $SalesCommissionAddModelObject;
    public function __construct()
    {
        $this->CourseCategoryAddModelObject = new CourseCategoryAddModel();
        $this->SalesCommissionAddModelObject = new SalesCommissionAddModel();
    }
    public function index()
    {
        $db = \Config\Database::connect();
        $query = $db->query("Select * FROM course_category");

        $data['results'] = $query->getResult();

        $sql = "SELECT * FROM  course_section";
        $data['results1'] = $db->query($sql)->getResult();

        return view('supperadmin/courseCategoryAddView', $data);
    }

    public function sales_commission()
    {
        $db = \Config\Database::connect();
        $query = $db->query("Select * FROM sales_commission");

        $data['results'] = $query->getResult();
       return view('supperadmin/SalesCommissionView', $data);
    }

    public function sales_commission_insert()
    {
        $sales_commission_entry = [
            'sales_commission_percent' => $this->request->getVar('sales_commission_percent'),
            'sales_commission_type'    => $this->request->getVar('sales_commission_type')
        ];

      $d = $this->SalesCommissionAddModelObject->insert($sales_commission_entry);  
      if ($d > 0) {
       $_SESSION['message'] = "Sales Commission Insertion Successful";
       return redirect()->to(base_url() . 'supperadmin/sales-commission-view');
      }
    }

    public function sales_commission_update()
    {
        $type = $this->request->getVar('sales_commission_type');

        $sales_commission_id = $this->request->getVar('sales_commission_id');
        $data = [
            'sales_commission_percent' => $this->request->getVar('sales_commission_percent')
        ];

        $update =  $this->SalesCommissionAddModelObject->where('sales_commission_id', $sales_commission_id)->set($data)->update();

         if ($update > 0) {
             $_SESSION['message'] = "Successfully Udated";
             return redirect()->to(base_url() . 'supperadmin/sales-commission-view');
         }
    }

    public function insert()
    {
        $category_entry = [
                            'course_category_name' => $this->request->getVar('course_category_name'),
                            'course_section_id'    => $this->request->getVar('course_section_id')
                        ];

        $d = $this->CourseCategoryAddModelObject->insert($category_entry);

        if ($d > 0) {
            //echo "success";
            $_SESSION['message'] = "Course Category Insertion Successful";
            return redirect()->to(base_url() . 'supperadmin/coursecategoryadd');
        } else {
            $_SESSION['message'] = "Insertion Fail!";
            return redirect()->to(base_url() . 'supperadmin/coursecategoryadd');
        }
    }

    public function update()
    {
        $course_category_id = $this->request->getVar('course_category_id');
        $data = [
            'course_category_name' => $this->request->getVar('course_categroy_name')
        ];

        $update =  $this->CourseCategoryAddModelObject->where('course_category_id', $course_category_id)->set($data)->update();

        if ($update > 0) {
            $_SESSION['message'] = "Successfully Udated";
            return redirect()->to(base_url() . 'supperadmin/coursecategoryadd');
        }
    }

    public function coursecategory_show()
    {
        $course_section_id = $_GET['id'];

        $db = \Config\Database::connect();
        $builder = $db->table('course_category');
        $builder->where('course_section_id', $course_section_id);
        // $builder->groupBy('chapter_id');
        $query = $builder->get();
        $category_info = $query->getResult();

        // echo '<option value="">Select Category</option>';

        $response = [['id'=>"","name"=>"সিলেক্ট কোর্স ক্যাটাগরি"]];
        

        foreach ($category_info as $row) {

            $item = ['id'=>$row->course_category_id,"name"=>$row->course_category_name];
            array_push($response,$item);

            // echo '<option value="' . $course_category_id . '">' . $course_category_name . '</option>';
        }
        echo json_encode($response);
    }


    // public function course_chapter_show()
    // {
    //     $courseId = $_GET['id'];

    //     $db = \Config\Database::connect();
    //     $builder = $db->table('course_content');
    //     $builder->where('course_id', $courseId);
    //     $builder->groupBy('chapter_id');
    //     $query = $builder->get();
    //     $chapterList = $query->getResult();

    //      echo '<option value="">Select Category</option>';

    //     //$response = [['id'=>"","name"=>"সিলেক্ট কোর্স চ্যাপ্টার"]];
        

    //     foreach ($chapterList as $row) {

    //       //  $item = ['id'=>$row->chapter_id,"name"=>$row->chapter_name];
    //        // array_push($response,$item);

    //          echo '<option value="' . $row->chapter_id . '">' . $row->chapter_name . '</option>';
    //     }
    //    // echo json_encode($response);
    // }

    public function coursecategory_show_examsetup()
    {
        $course_section_id = $_GET['id'];

        $db = \Config\Database::connect();
        $builder = $db->table('course_category');
        $builder->where('course_section_id', $course_section_id);
        $query = $builder->get();
        $category_info = $query->getResult();

         echo '<option value="">Select Category</option>';

        foreach ($category_info as $row) {

             echo '<option value="' . $row->course_category_id . '">' . $row->course_category_name . '</option>';
        }
    }

}
