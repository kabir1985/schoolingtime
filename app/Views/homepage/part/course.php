<?php 
  // Define the convertToBangla function here if not already defined
  function convertToBangla($number) {
    $banglaDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
    return str_replace(range(0, 9), $banglaDigits, $number);
}
?>

<section class="content-title content-header">
    <div class="row justify-content-center text-center">
        <div class="col">
            <h5 class="text-muted"><b>আমাদের কোর্সসমূহ</b></h5>
            <div class="container">
                <p class="text-muted">প্রয়োজনীয় কোর্স বাছাই করুন, দক্ষতা অর্জনের মাধ্যমে নিজেকে অন্যদের থেকে এগিয়ে রাখুন।</p> 
            </div>
        </div>
    </div>
</section>

<section id="about" class="about mt-0">
    <div class="container">
        <div class="row gx-0">
            <div class="col">
                <div class="nav-align-top">
                    <ul class="nav nav-tabs" role="tablist">
                        <?php
                        $tabIndex = 0;
                        $courseTypes = array_unique(array_column($courseList, 'course_type_name'));
                        $tabNames = [
                            'Online_Video_Course' => 'রেকর্ডেট ভিডিও কোর্স',
                            'Online_Live_Coaching' => 'অনলাইন লাইভ কোচিং',
                            'Share_Your_Notes' => 'শেয়ার নোট',
                            'Question_And_Exam' => 'পরীক্ষা কোর্স'
                        ];
                        foreach ($courseTypes as $courseType): ?>
                            <li class="nav-item">
                                <button type="button" class="nav-link <?= ($tabIndex === 0) ? 'active' : ''; ?> text-muted" role="tab" data-bs-toggle="tab" data-bs-target="#<?= strtolower(str_replace(' ', '-', $courseType)); ?>" aria-controls="<?= strtolower(str_replace(' ', '-', $courseType)); ?>" aria-selected="<?= ($tabIndex === 0) ? 'true' : 'false'; ?>">
                                    <?= isset($tabNames[$courseType]) ? $tabNames[$courseType] : $courseType; ?>
                                </button>
                            </li>
                        <?php $tabIndex++;
                        endforeach; ?>
                    </ul>

                    <div class="tab-content">
                        <?php $contentIndex = 0; ?>
                        <?php foreach ($courseTypes as $courseType): ?>
                            <div class="tab-pane fade <?= ($contentIndex === 0) ? 'show active' : ''; ?>" id="<?= strtolower(str_replace(' ', '-', $courseType)); ?>" role="tabpanel">
                                <section id="services" class="services mb-0">
                                    <div class="container p-0">
                                        <div class="row p-0">
                                            <?php foreach ($courseList as $course): ?>
                                                <?php if ($course->course_type_name == $courseType): ?>
                                                    <div class="col-lg-4 col-md-6">
                                                        <a href="<?= site_url('/course-details-page/' . $course->course_id); ?>">
                                                            <div class="service-box blue">
                                                                <img src="<?= base_url('public/CourseUploads/' . $course->course_pic); ?>" alt="avatar" class="img-fluid img-thumbnail" style="width:374px; height:220px">
                                                                <h5 class="pt-3"><?= $course->coures_title; ?></h5>
                                                                <p class="teacher-info">
                                                                    <span>
                                                                        <?php for ($i = 0; $i < 5; $i++): ?>
                                                                            <span class="star <?= ($i < $course->feedback_rating) ? 'filled' : ''; ?>">&#9733;</span>
                                                                        <?php endfor; ?>
                                                                    </span>
                                                                    <br>
                                                                    <?= $course->teacher_name . "&nbsp;(" . $course->last_educational_institute . ")<br>" . $course->teacher_pro_his; ?>
                                                                </p>
                                                                <div class="flex-container bg-light">
                                                                    <div>কোর্স ফি:&nbsp;<?= convertToBangla($course->course_price); ?>&nbsp;টাকা</div>
                                                                    <!-- <div>শুরুঃ&nbsp;<?= !empty($course->start_date) ? date('d-m-Y', strtotime($course->start_date)) : ''; ?>
                                                                        </div> -->
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        <?php $contentIndex++;
                        endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->section('custom-style') ?>
<style type="text/css">
    .flex-container {
        justify-content: center;
    }


 /* Add border to course card */
 .service-box {
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        padding: 10px;
        background: #ffffff;
        transition: 0.3s;
    }

    /* Optional: Add hover effect */
    .service-box:hover {
        box-shadow: 0px 4px 18px rgba(0,0,0,0.12);
        transform: translateY(-3px);
    }


      /* Star styling (no change) */
      .star {
        color: #bfbfbf;
    }
    .star.filled {
        color: #f7c600;
    }




</style>
<?= $this->endSection() ?>