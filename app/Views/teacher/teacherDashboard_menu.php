<!-- ======= content Section ======= -->
<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

        <div class="row">
            <div class="col-lg-3">

                <div class="sidebar">

                    <?php
                    if (isset($_SESSION['id'])) {
                        $teacher_id = $_SESSION['id'];
                        $db = \Config\Database::connect();
                        $builder = $db->table('teacher_profile');
                        $builder->where('teacher_id',  $teacher_id);
                        $query   = $builder->get();
                        $results = $query->getRow();

                        $last_edu = $results->last_educational_institute;
                        $edu_his = $results->teacher_edu_his;
                        $pro_edu = $results->teacher_pro_his;

                    ?>

                        <a href="<?php echo site_url('teacher/dashboard'); ?>">
                            <h5>শিক্ষক হোম পেইজ</h5>
                        </a>
                        <div class="sidebar-item categories">
                            <ul>
                                <!-- <li><a href="<?php //echo site_url('teacher/dashboard'); ?>"> <i class='fas fa-clone'></i>&nbsp;ড্যাশবোর্ড<span><i class='fas fa-chevron-right'></i></span></a></li> -->
                                <li><a href="<?php echo site_url('teacher/profile'); ?>"><i class="fas fa-user-graduate"></i>&nbsp;প্রোফাইল সেটআপ<span><i class="fas fa-chevron-right"></i></span></a></li>

                                <?php if (($last_edu != "") && ($edu_his != "") && ($pro_edu != "")) { ?>
                                    <li> <a href="<?php echo site_url('teacher/course-view'); ?>"> <i class="fas fa-chalkboard-teacher"></i>&nbsp;কোর্স তৈরি করুন<span><i class='fas fa-chevron-right'></i></span></a> </li>
                                    <li> <a href="<?php echo site_url('teacher/batch-create'); ?>"> <i class="fas fa-chalkboard-teacher"></i>&nbsp; ব্যাচ তৈরি করুন<span><i class='fas fa-chevron-right'></i></span></a> </li>
                            <?php }
                            } ?>
                            <li><a href="<?php echo site_url('teacher/course-include'); ?>"><i class='fas fa-book-reader'></i>&nbsp;কোর্সে আরো পাবেন<span><i class='fas fa-chevron-right'></i></span></a></li>
                            <li><a href="<?php echo site_url('teacher/course-content-view'); ?>"><i class='fas fa-book-open'></i>&nbsp;কোর্স চ্যাপ্টার তৈরি<span><i class='fas fa-chevron-right'></i></span></a></li>
                            <li><a href="#"><i class='fas fa-money-check-alt'></i>&nbsp;পেমেন্ট রিপোর্ট<span><i class='fas fa-chevron-right'></i></span></a></li>
                            <li><a href="#"> <i class="fas fa-video"></i>&nbsp;ক্লাস লিংক<span><i class='fas fa-chevron-right'></i></span></a></li>
                            <li></li>
                            </ul>
                        </div><!-- End sidebar categories-->
                        <hr>

                        <h5>পরীক্ষা / কুইজ তৈরি</h5>
                        <div class="sidebar-item categories">
                            <ul>
                                <li><a href="<?php echo site_url('exam/exam-setup-view'); ?>"><i class="fas fa-school"></i>&nbsp;পরীক্ষা সেটআপ<span><i class='fas fa-chevron-right'></i></span></a></li>
                                <li><a href="<?php echo site_url('exam/question-bank-view'); ?>"><i class="fas fa-chalkboard"></i>&nbsp;প্রশ্ন ব্যাংক তৈরি<span><i class='fas fa-chevron-right'></i></span></a></li>
                                <li><a href="<?php echo site_url('exam/question-set'); ?>"><i class="fas fa-award"></i>&nbsp;প্রশ্ন সেট তৈরি<span><i class='fas fa-chevron-right'></i></span></a></li>
                            </ul>
                        </div><!-- End sidebar categories-->
                        <hr>

                        <h5><a href="<?php echo site_url('teacher/teacher-logout'); ?>">&nbsp;লগ আউট &nbsp;<i class="fas fa-sign-out-alt"></i></a></h5>

                        <!---------------------------------------------------------->

                        <!--------------------------------------------------------->

                </div><!-- End sidebar -->

            </div>

            <!-- End blog sidebar -->