<?php
//error_reporting('0');
//#########Checking here Student Profile update kora ase kina? ##################//
$db = \Config\Database::connect();

$student_id = isset($_SESSION['student_id']);

$builder = $db->table('student_profile');
$builder->where('stu_profile_id', $student_id);
//$builder->where('stu_profile_id', $_SESSION['student_id']);
//$builder->where('student_password', $data['student_pw']);
$query   = $builder->get();
$results = $query->getResult();

foreach ($results as $row) {
    $student_birth_day = $row->stu_date_of_birth;
    $stu_edu_level_class = $row->stu_edu_level_class;

    // echo $student_birth_day;
    // $stu_last_edu_institute = $row->stu_last_edu_institute;
}
?>



<div class="sidebar">
    <!-- <h3 class="sidebar-title">Search</h3>
    <div class="sidebar-item search-form">
        <form action="">
            <input type="text">
            <button type="submit"><i class="bi bi-search"></i></button>
        </form>
    </div>End sidebar search formn -->
    <h3 class="sidebar-title"><?php //echo $_SESSION['name'];
                                ?></h3>
    <div class="sidebar-item categories">
        <ul>
            <li><a href="<?php echo site_url('student/dashboard'); ?>"><i class='far fa-address-card'></i>&nbsp;&nbsp;ড্যাশবোর্ড <span><i class='fas fa-chevron-right'></i></span></a></li>
            <li><a href="<?php echo site_url('student/course-selection'); ?>"><i class='fas fa-book-reader'></i>&nbsp;কোর্স বাছাই করুন<span><i class='fas fa-chevron-right'></i></span></a></li>
            <li><a href="<?php echo site_url('student/cart-view'); ?>"><i class='fa fa-shopping-cart'></i>&nbsp; আপনার অর্ডার<span><i class='fas fa-chevron-right'></i></span></a></li>
            <li><a href="#"><i class='far fa-bell'></i>&nbsp; নোটিশ বোর্ড <span><i class='fas fa-chevron-right'></i></span></a></li>
            <li><a href="<?php echo site_url('student/exam-system'); ?>"><i class='fa fa-desktop'></i>&nbsp;লাইভ পরীক্ষা<span><i class='fas fa-chevron-right'></i></span></a></li>
            <li><a href="<?php echo site_url('exam/exam-result'); ?>"><i class='fa fa-desktop'></i>&nbsp;পরীক্ষার রেজাল্ট<span><i class='fas fa-chevron-right'></i></span></a></li>
            <!-- <li><a href="<?php echo site_url('student/exam-system'); ?>"><i class='fa fa-desktop'></i>&nbsp;পরীক্ষা প্র্যাকটিস<span><i class='fas fa-chevron-right'></i></span></a></li> -->
            <li><a href="<?php echo site_url('student/student-logout'); ?>"><i class='far fa-user-circle'></i>&nbsp; লগ-আউট <span><i class='fas fa-chevron-right'></i></span></a></li>
        </ul>
    </div><!-- End sidebar categories-->

</div>
