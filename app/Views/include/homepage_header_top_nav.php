<header id="header" class="header fixed-top" style="background-color:#465FAB;">
  <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

    <a href="<?php echo site_url('/') ?>" class="logo d-flex align-items-center">
<i class="fa fa-paper-plane" aria-hidden="true" style="font-size:23px;color:tomato"></i>
      <img src="<?= base_url('homepage_assets/img/logo.png')?>" alt="">
      <!-- <span>SchoolingTime</span> -->
    </a>
    <nav id="navbar" class="navbar">
      <ul>
        <li>
        <form id="searchForm" action="<?php  echo site_url('category-wise-course'); ?>" method="get">
          <div class="input-group">
             <input class="form-control border-end-0 border" type="search" placeholder="search" name="query" required>
            <span class="input-group-append">
              <button class="btn btn-outline-info bg-light border-start-0 border-bottom-0 border ms-n5" type="button">
                <i class="bi bi-search"></i>
              </button>
            </span>
          </div>
          </form> 
        </li>
        <li><a class="nav-link scrollto active" href="<?php echo site_url('/') ?>">হোম</a></li>
        <li class="dropdown"><a href="<?php echo site_url('/category-wise-course') ?>"><span>সকল কোর্স</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <?php
            $db = \Config\Database::connect();
            $query = $db->query("SELECT course_category_name,course_category_id
                                                               From course_category");
            $results = $query->getResult();
            foreach ($results as $row) {
            ?>
              <li>
                <a href="<?php echo site_url('course-show-categorywise') . '/' . $row->course_category_id; ?>"><?php echo $row->course_category_name; ?><!--<span class="float-end">(25)</span>--></a>
              </li>
            <?php
            } ?>

          </ul>
        </li>
        <li><a class="nav-link scrollto" href="<?php echo site_url('/academic-course'); ?>">একাডেমিক</a></li>
        <li><a class="nav-link scrollto" href="<?php echo site_url('/skill-development-course'); ?>">স্কিল ডেভেলপমেন্ট</a></li>
        <li><a class="nav-link scrollto" href="<?php echo site_url('/job-admission-course'); ?>">পরীক্ষা কেন্দ্র</a>
        </li>

        <?php
        if (isset($_SESSION['student_id'])) { //student
        ?>
          <li class="dropdown"> <a href="#"> <button type="button" class="btn btn-light"> <span><?php if (isset($_SESSION['student_name'])) {
                                                                                                  echo $_SESSION['student_name'];
                                                                                                } ?></span> <i class="bi bi-chevron-down"></i></button></a>
            <ul>
              <li><a href="<?php echo site_url('student/dashboard'); ?>">ড্যাশবোর্ড</a></li>
              <li><a href="<?php echo site_url('student/profile'); ?>">প্রোফাইল</a></li>
              <li><a href="#">পাসওয়ার্ড পরিবর্তন</a></li>
              <li><a href="<?php echo site_url('student/student-logout'); ?>">লগ-আউট</a></li>
            </ul>
          </li>
        <?php } else if (isset($_SESSION['id'])) { //teacher
        ?>
          <li class="dropdown"><a href="<?php echo site_url('teacher/teacher-logout'); ?>"> <button type="button" class="btn btn-light"><span><?php if (isset($_SESSION['name'])) {
                                                                                                                                                echo $_SESSION['name'];
                                                                                                                                              } ?></span> <i class="bi bi-chevron-down"></i></button></a>
            <ul>
              <li><a href="<?php echo site_url('teacher/dashboard'); ?>">ড্যাশবোর্ড</a></li>
              <li><a href="<?php echo site_url('teacher/profile'); ?>">প্রোফাইল</a></li>
              <li><a href="#">পাসওয়ার্ড পরিবর্তন</a></li>
              <li><a href="<?php echo site_url('teacher/teacher-logout'); ?>">লগ-আউট</a></li>
            </ul>
          </li>
        <?php } else {
        ?>
          <li> <a href="<?php echo site_url('student/login'); ?>"> <button type="button" class="btn btn-light">স্টুডেন্ট লগ-ইন</button></a></li>
        <?php } ?>

      </ul>

      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->
  </div>
</header><!-- End Header -->

