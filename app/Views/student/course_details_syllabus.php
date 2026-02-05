<p>
<section id="faq" class="faq">
<div class="container" data-aos="fade-up">
<div class="row">
<div class="col-lg-12">

<?php
// ================= SESSION & DB =================
$session = session();
$db = \Config\Database::connect();

// ================= SESSION DATA =================
// টিচার লগিন করলে
$teacher_id         = $session->get('id');
$teacher_course_ids = $session->get('course_ids') ?? []; //TeacherDashboardController.php controller AND //teacher/teacherDashboardView.php
// echo $teacher_id;
// //echo $teacher_course_ids;
// echo "<pre>";
//  print_r($teacher_course_ids);
//  echo "</pre>";
//  exit();


//স্টুডেন্ট লগিন করলে
$studentId        = $session->get('student_id');
$purchasedCourses = $session->get('purchased_courses') ?? [];

// ================= DEFAULT =================
$limit = 3; // default only 3 chapters
$isTeacherAllowed = false;
$isStudentAllowed = false;

// ================= STUDENT CHECK =================
if (!empty($studentId) && in_array($course_id, $purchasedCourses)) {
    $limit = count($course_contents);
    $isStudentAllowed = true;
}

// ================= TEACHER CHECK =================
if (!empty($teacher_id) && !empty($teacher_course_ids)) {

    $builder = $db->table('teacher_course');
    $builder->where('course_teacher_id', $teacher_id);
    $builder->where('course_id', $course_id);
    $builder->where('course_status', 'approved');
    $builder->whereIn('course_id', $teacher_course_ids);
  

    $teacherCourse = $builder->get()->getRow();

    if ($teacherCourse) {
        $limit = count($course_contents);
        $isTeacherAllowed = true;
    }
}
?>

<div class="accordion accordion-flush" id="faqlist1">

<?php $serial_no = 1; ?>
<?php foreach ($course_contents as $content) : ?>

    <?php if ($serial_no > $limit) break; ?>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#faq-content-<?= $serial_no; ?>">
                <?= esc($content->chapter_name); ?>
            </button>
        </h2>

        <div id="faq-content-<?= $serial_no; ?>"
             class="accordion-collapse collapse"
             data-bs-parent="#faqlist1">

            <div class="accordion-body">

                <?php
                // ================= CONTENT =================
                $contentQuery = $db->query(
                    "SELECT video_title, pdf_file_path, video_link
                     FROM course_content
                     WHERE chapter_id = ?",
                    [$content->chapter_id]
                );
                $videos = $contentQuery->getResult();

                foreach ($videos as $index => $video) :
                    $isYouTube = preg_match('/youtu\.be|youtube\.com/', $video->video_link);
                ?>
                <div class="row mb-0">
                    <div class="col-md-10 video-item">
                        <span class="numberCircle"><?= $index + 1; ?></span>
                        <span class="video-title"><?= esc($video->video_title); ?></span>
                    </div>

                    <?php if ($isYouTube) : ?>
                    <div class="col-md-2 text-end">
                        <button class="btn-sm video-btn"
                                data-bs-toggle="modal"
                                data-src="<?= esc($video->video_link); ?>"
                                data-bs-target="#myModal">
                            <i class="fa-solid fa-video"></i> ভিডিও
                        </button>
                    </div>
                    <?php else : ?>
                    <div class="col-md-12">
                        <?= esc($video->video_link); ?>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if (!empty($video->pdf_file_path)) : ?>
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?= base_url('public/notes/' . esc($video->pdf_file_path)); ?>"
                           target="_blank"
                           class="btn btn-link">
                            <i class="far fa-file-pdf" style="color:tomato;"></i>
                            পিডিএফ নোট পড়ুন
                        </a>
                    </div>
                </div>
                <?php endif; ?>
                <?php endforeach; ?>

                <?php
                // ================= EXAM =================
                $examQuery = $db->query(
                    "SELECT * FROM exam_setup
                     WHERE subject_chapter_id = ?
                     AND exam_subject_course_id = ?",
                    [$content->chapter_id, $course_id]
                );
                $exams = $examQuery->getResult();

                foreach ($exams as $exam) :
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?= site_url('student/exam-system'); ?>"
                           class="btn btn-link">
                            <i class="fas fa-user-graduate"></i>
                            পরীক্ষা দিন | <?= esc($exam->exam_name); ?>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>

<?php $serial_no++; endforeach; ?>

</div>

<?php if (!$isTeacherAllowed && !$isStudentAllowed) : ?>
<div class="alert alert-warning text-center mt-3">
    🔒 সম্পূর্ণ কোর্স দেখতে লগইন করে কোর্সটি কিনুন
</div>
<?php endif; ?>

</div>
</div>
</div>
</section>			
</p>


<style>
.video-item {
    display: flex;
    align-items: center;
    gap: 10px;                 /* spacing between circle and text */
}

.numberCircle {
    min-width: 28px;
    min-height: 28px;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background-color: #0099cc;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 600;
    line-height: 1;
    flex-shrink: 0;           /* prevents shrinking in flex */
}

.video-title {
    font-size: 15px;
    line-height: 1.4;
}




   /* Light container spacing */
#faq {
    padding: 30px 0;
}

/* Accordion item: just a soft border + radius */
#faq .accordion-item {
    border: 1px solid #e6e9f2;
    border-radius: 10px;
    margin-bottom: 10px;
    overflow: hidden;
}

/* Accordion header */
#faq .accordion-button {
    background: #f5f7ff;
    color: #2c3e50;
    font-weight: 600;
    padding: 14px 18px;
}

#faq .accordion-button:not(.collapsed) {
    background: #e9edff;
}

/* Accordion body */
#faq .accordion-body {
    background: #ffffff;
    padding: 16px 18px;
}

/* List row spacing */
#faq .row.mb-0 {
    padding: 6px 0;
}

/* Number circle: smaller & softer */
.numberCircle {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 22px;
    height: 22px;
    background: #465FAB;
    color: #fff;
    border-radius: 50%;
    font-size: 12px;
    font-weight: 600;
    margin-right: 6px;
}

/* Video button: subtle */
.video-btn {
    background: #f0f2ff;
    border: 1px solid #d8dcff;
    border-radius: 14px;
    padding: 3px 12px;
    font-size: 12px;
    color: #465FAB;
}

.video-btn:hover {
    background: #465FAB;
    color: #fff;
}

/* PDF link: light emphasis */
#faq a.btn-link {
    color: #465FAB;
    font-weight: 500;
    padding-left: 0;
}

/* Exam link */
#faq .fa-user-graduate {
    color: #2f9e62;
}

    </style>