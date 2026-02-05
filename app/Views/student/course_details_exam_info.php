<div class="container mt-3">
    <?php
    $db = \Config\Database::connect();
    $query = $db->query("SELECT * FROM exam_setup WHERE subject_chapter_id = 'others' AND exam_subject_course_id = '$course_id'");
    $question_set_show = $query->getResult();
    ?>

    <?php if(!empty($question_set_show)): ?>
    <?php $counter = 1; ?>
    <?php foreach ($question_set_show as $row): ?>
    <div class="row align-items-center py-2 border-bottom">
        <div class="col-md-1 fw-bold text-primary">
            <?= $counter++; ?>
        </div>
        <div class="col-md-7">
            <?= esc($row->exam_name); ?>
        </div>
        <div class="col-md-4 text-end">
            <a href="<?php
                        if (isset($_SESSION['student_id'])) {
                            echo site_url('exam/question-set-exam-start') . '/' . $row->exam_setup_id;
                        } else {
                            echo site_url('student/login') . '/' . "exam";
                        } ?>" class="btn btn-outline-info btn-sm">
                পরীক্ষা দিন
            </a>
        </div>
    </div>
    <?php endforeach; ?>
    <?php else: ?>
    <div class="alert alert-warning text-center">
        পরীক্ষা দেয়ার জন্য আপনাকে কোর্সটি কিনে তারপর লগিন করে লাইভ পরীক্ষা মেনুতে গিয়ে দিতে হবে।
    </div>
    <?php endif; ?>
</div>