<?php

function renderCourseTabItem($course) {
    ob_start();
    ?>
    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
        <a href="<?php echo site_url('/course-details-page') . '/' . $course->course_id; ?>">
            <div class="service-box blue">
                <img src="<?= base_url() ?>/public/CourseUploads/<?= $course->course_pic; ?>" alt="avatar" class="img-fluid img-thumbnail" style="width:316px; height:200px">
                <h5 class="pt-3"> <?php echo $course->coures_title; ?> </h5>
                <p class="teacher-info">
                    <span>
                        <?php
                        $rating_number = $course->feedback_rating;
                        for ($i = 0; $i < 5; $i++) {
                        ?>
                            <span class="star <?php if ($i < $rating_number) echo 'filled'; ?>">&#9733;</span>
                        <?php
                        }
                        ?>
                    </span>
                    <br>
                    <?php
                    echo $course->teacher_name . "&nbsp;(" . $course->last_educational_institute . ")" . "<br>";
                    echo $course->teacher_pro_his;
                    ?>
                </p>
                <div class="flex-container bg-light ">
                    <div>কোর্স ফি:&nbsp;<?php echo $course->course_price; ?>&nbsp;টাকা</div>
                    <div>শুরুঃ&nbsp;<?php echo $course->course_start_date; ?></div>
                </div>
            </div>
        </a>
    </div>
    <?php
    return ob_get_clean();

}
