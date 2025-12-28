<p>
<section id="faq" class="faq">
<div class="container" data-aos="fade-up">
<div class="row">
<div class="col-lg-12">
<div class="accordion accordion-flush" id="faqlist1">
<?php $serial_no = 1; ?>
<?php foreach ($course_contents as $content) : ?>
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-<?= $serial_no; ?>">
                <?php echo $content->chapter_name;?>
            </button>
        </h2>
        <div id="faq-content-<?= $serial_no; ?>" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
            <div class="accordion-body">
                <?php
                $db = \Config\Database::connect();
                $contentQuery = $db->query("SELECT video_title, pdf_file_path, video_link FROM course_content WHERE chapter_id = '$content->chapter_id'");
                $videos = $contentQuery->getResult();

                foreach ($videos as $index => $video) :
                    $isYouTube = preg_match('/youtu\.be|youtube\.com/', $video->video_link);
                ?>
                    <div class="row mb-0">
                        <div class="col-md-9">
                            <span class="numberCircle"><?= $index + 1; ?></span>
                            <?= esc($video->video_title); ?>
                        </div>
                        <?php if ($isYouTube) : ?>
                            <div class="col-md-3 text-end">
                                <button class="btn-sm video-btn" data-bs-toggle="modal" data-src="<?= esc($video->video_link); ?>" data-bs-target="#myModal">
                                    <i class="fa-solid fa-video" style="color: #465FAB;"></i> ভিডিও 
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
                                <a href="<?= base_url('public/notes/' . esc($video->pdf_file_path)); ?>" target="_blank" class="btn btn-link">
                                    <i class="far fa-file-pdf" style="color:tomato;"></i> পিডিএফ নোট পড়ুন
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                <?php endforeach; ?>

                <?php
                // Fetch and display exams related to this chapter
                $examQuery = $db->query("SELECT * FROM exam_setup WHERE subject_chapter_id = ? AND exam_subject_course_id = ?", [$content->chapter_id, $course_id]);
                $exams = $examQuery->getResult();
                foreach ($exams as $exam) :
                ?>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- <a href="<?//= site_url('exam/question-set-exam-start/' . esc($exam->exam_setup_id)); ?>" class="btn btn-link"> -->
                            <a href="<?= site_url('student/exam-system/'); ?>" class="btn btn-link">   
                            <i class="fas fa-user-graduate"></i> পরীক্ষা দিন | <?= esc($exam->exam_name); ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php $serial_no++; ?>
<?php endforeach; //exit('sdfdsfdsfs'); ?>
</div>
</div>
</div>
</div>
</section>				
</p>

<style>
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