<?php

namespace App\Controllers;

use App\Models\PurchaseCourseModel;

class CheckoutController extends BaseController
{
    private $db;
    private $PurchaseCourseModelObject;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->PurchaseCourseModelObject = new PurchaseCourseModel();
    }

    public function checkoutCart()
    {
       // session_start();
       if (isset($_SESSION["cartItems"])) 
       {
        // Retrieve cart items from the session
        $cartItems = $_SESSION["cartItems"];        
        // Retrieve selected batch IDs from the form
        $selectedBatchIds = $this->request->getPost('batch_ids');  // Array of selected batch IDs
        $weekly_days = isset($_POST['weekly_days']) ? $_POST['weekly_days'] : null;
        $time_slots = isset($_POST['time_slot']) ? $_POST['time_slot'] : null;

        // Update each cart item with the selected batch ID
        foreach ($cartItems as $index => $item) {
            if (isset($selectedBatchIds[$index])) {
                $cartItems[$index]['batch_id'] = $selectedBatchIds[$index];  // Add batch_id to cart item
                $cartItems[$index]['weekly_days'] = htmlspecialchars($weekly_days[$index]);  // Add weekly_days to cart item
                $cartItems[$index]['time_slot'] = htmlspecialchars($time_slots[$index]);  // Add time_slots to cart item

            }
        }

        // Update the session with the modified cart items
        $_SESSION["cartItems"] = $cartItems;

        // Fetch student details from the database
        $student_id = $_SESSION['student_id'];
        $builder = $this->db->table('student_registration');
        $builder->where("student_id", $student_id);
        $query = $builder->get();
        $studentDetails = $query->getResult();  // Retrieve student details

        // Prepare data for checkout page
        $data = [
            'cartItems' => $cartItems,
            'studentDetails' => $studentDetails,
            'totalPrice' => $this->calculateTotalPrice($cartItems)
        ];
        // Load the checkout page view with the cart data
        return view('student/checkout', $data);
       } 
       else
        {
        // Handle the case where 'cartItems' is not set
        $cartItems = [];
        }

    }

    private function calculateTotalPrice($cartItems)
    {
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += preg_replace("/[^0-9.]+|(?<=\\d\\.)\\.|^\\.|\\.$/", "", $item["course_price"]);
        }
        return $totalPrice;
    }

    public function purchase_course()
    {
        $commission = $_POST['sales_commission_percent'] / 100;
        $cartItems = $_SESSION["cartItems"];

        $dataTosave = [];
        $dataTosavecourse_batchTable = [];
        // Start the transaction
        $this->db->transStart();

        foreach ($cartItems as $kye => $values) {
            $data = [
                "course_id"                  => $cartItems[$kye]['course_id'],
                "batch_id"                   => $cartItems[$kye]['batch_id'],
                "student_or_buyer_id"        => $_POST['student_id'],
                "course_teacher_id"          => $cartItems[$kye]['course_teacher_id'],
                "course_price"               => $cartItems[$kye]['course_price'],
                "company_commission_percent" => $_POST['sales_commission_percent'],
                "company_amount"             => $cartItems[$kye]['course_price'] * $commission,
                "saler_or_teacher_amount"    => $cartItems[$kye]['course_price'] - ($cartItems[$kye]['course_price'] * $commission)
            ];
            array_push($dataTosave, $data);

            $builder = $this->db->table('course_batch');
            $builder->set('booked_seats', 'booked_seats + 1', FALSE);
            $builder->where('batch_id', $cartItems[$kye]['batch_id']);
            $builder->where('course_id', $cartItems[$kye]['course_id']);
            $builder->update(); // Execute the update
        }
        if (count($dataTosave)) {
            $this->PurchaseCourseModelObject->insertBatch($dataTosave);
            
            // Complete the transaction (commit or rollback)
            $this->db->transComplete();
            unset($_SESSION["cartItems"]);

            // Check transaction status
            if ($this->db->transStatus() === FALSE) {
                // Rollback transaction
                $response = ["message" => "Purchase failed", "toast_message" => "Purchase failed. Data was not inserted."];
                echo json_encode($response);
            } else {
                // Commit transaction
                $response = ["message" => "Purchse Successfully Done", "toast_message" => "Successfully Paid"];
                echo json_encode($response);
            }
        }
    }
}
