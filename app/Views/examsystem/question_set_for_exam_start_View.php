<?=$this->extend('homepage/layout')?>

<?=$this->section('content')?>
<main id="main" class="my-5">
    <!-- ======= content Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <!------Left Menu Column---------------------------------------->
                <div class="col-lg-3">
                    <?php echo $this->include("student/student_dashboard_left_menu"); ?>
                </div>
                <div class="col-lg-9 bg-light entries mt-2">

                    <?php
                        foreach ($question_set_selection as $row) {
                            $question_set_title = $row->question_set_title;
                            $question_set_id = $row->question_set_id;
                            $exam_setup_id = $row->subject_id;

                            $db = \Config\Database::connect();
                            $query = $db->query("SELECT exam_duration, total_question, marks_per_right_answer, marks_per_wrong_answer
                                        From exam_setup
                                        WHERE exam_setup_id = '$exam_setup_id'");
                            $exam_info = $query->getRow();
                            if (isset($exam_info)) {
                    ?>
                    <article class="entry">

                        <div class="row">
                            <div class="col-md-4">

                                <p>
                                    <a href="#"><?php echo "<b>প্রশ্ন সেট </b>: " . $question_set_title; ?></a>
                                </p>

                                <div class="entry-content">
                                    <ul>
                                        <li class="d-flex align-items-center"> <i class="fa fa-chevron-right"
                                                aria-hidden="true"></i>&nbsp;<?php echo " মোট প্রশ্নঃ " . $exam_info->total_question . "&nbsp;টি"; ?>
                                        </li>
                                        <li class="d-flex align-items-center"> <i class="fa fa-chevron-right"
                                                aria-hidden="true"></i>&nbsp;<?php echo "সময়: " . $exam_info->exam_duration . "&nbsp;মিনিট"; ?>
                                        </li>
                                        <li class="d-flex align-items-center"> <i class="fa fa-chevron-right"
                                                aria-hidden="true"></i>
                                            &nbsp;<?php echo " সঠিক উত্তরঃ " . $exam_info->marks_per_right_answer . "&nbsp;মার্ক"; ?>
                                        </li>
                                        <li class="d-flex align-items-center"> <i class="fa fa-chevron-right"
                                                aria-hidden="true"></i>
                                            &nbsp;<?php echo " ভূল উত্তরঃ " . $exam_info->marks_per_wrong_answer . "&nbsp;মার্ক"; ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>


                            <!-- <div class="col-md-3">
                    <div class="entry-content">
                        <p>পরীক্ষা সিলেবাস</p>

                        <p>
                            Aspernatur rerum perferendis et enim et autem. Saepe atque cum eligendi eaque iste omnis a qui.
                        </p>

                    </div>
                </div> -->


                            <div class="col-md-8">
                                <div class="entry-content">
                                    <p>পরীক্ষা নির্দেশনা</p>
                                    <ul>
                                        <li>পরীক্ষায় পাস করার জন্য কমপক্ষে ৪০% মার্কস পেতে হবে।</li>
                                        <li>পুনরায় পরীক্ষা অর্থাৎ রিটেক পরীক্ষার জন্য কমপক্ষে ১ দিন অপেক্ষা করতে হবে।
                                        </li>
                                    </ul>
                                    <div class="read-more d-flex align-text-center">
                                        <a href="<?php echo site_url('exam/exam-question-show') . '/' . $question_set_id . '/' . $exam_setup_id . '/' . $exam_info->exam_duration; ?>"
                                            class="btn btn-primary">পরীক্ষা শুরু করুন</a>
                                    </div>
                                </div>
                            </div>


                        </div>


                    </article><!-- End blog entry -->
                    <?php
}
}
?>

                </div>
            </div>
        </div>
    </section><!-- End Blog Section -->
    <!--------------------------------------------->


    <!-- Modal -->
</main>
<?=$this->endSection()?>