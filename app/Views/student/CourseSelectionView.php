<?= $this->extend('homepage/layout') ?>

<?= $this->section('content') ?>
<?php 
  // Define the convertToBangla function here if not already defined
  function convertToBangla($number) {
    $banglaDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
    return str_replace(range(0, 9), $banglaDigits, $number);
}
?>
  <main id="main" class="my-5">
    <!-- ======= content Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <!------Left Menu Column---------------------------------------->
          <div class="col-lg-3">
            <?php echo $this->include("student/student_dashboard_left_menu"); ?>
          </div>
          <!----------Left Menu Column End----------------------------------------->
          <div class="col-lg-9">
            <section id="services" class="services">
              <div class="container" data-aos="fade-up">
                <div class="row mb-5">
                  <?php foreach ($results as $row) {
                  ?>

                    <div class="col-lg-6 col-md-6 mb-1" data-aos="fade-up" data-aos-delay="300">
                      <a href="<?php echo site_url('/course-details-page') . '/' . $row->course_id; ?>">
                        <div class="service-box blue">
                          <img src="<?= base_url() ?>/public/CourseUploads/<?= $row->course_pic; ?>" alt="avatar" class="img-fluid img-thumbnail" style="width:316px; height:200px">
                          <h4 class="pt-3"> <?php echo $row->coures_title; ?> </h4>
                          <p class="teacher-info">
                            <?php
                            $db = \Config\Database::connect();
                            $query = $db->query("SELECT teacher_registration.teacher_name,
                                                        teacher_profile.last_educational_institute
                                                        From teacher_registration 
                                                        LEFT JOIN teacher_profile ON teacher_registration.teacher_id = teacher_profile.teacher_id
                                                        WHERE teacher_registration.teacher_id = '$row->course_teacher_id';");
                            //echo strlen($row->course_note) >= 100 ? substr($row->course_note, 0, 99) : $row->course_note;
                            $results1 = $query->getRow();
                            echo $results1->teacher_name . "<br>";
                            echo $results1->last_educational_institute;
                            ?>
                          </p>
                          <div class="flex-container bg-light">
                            <div>কোর্স ফি:&nbsp;<?php echo convertToBangla($row->course_price); ?>&nbsp;টাকা</div>
                            <!-- <div>শুরুঃ&nbsp;<?php //echo $row->course_start_date; ?></div> -->
                          </div>
                        </div>
                      </a>
                    </div>


                  <?php
                  }
                  ?>
                </div>
              </div>
            </section><!-- End Services Section -->

          </div><!-- End blog entries list -->


        </div>

      </div>
    </section><!-- End Blog Section -->
    <!--------------------------------------------->

  </main>
  <?= $this->endSection() ?>

  <?= $this->section('custom-style') ?>
  <style type = "text/css">
    .flex-container {
      display: flex;
      justify-content: center;
      
      /*background-color: DodgerBlue;*/
    }

    .flex-container>div {
      background-color: #f1f1f1;
      margin: 3px;
      padding: 3px;
      font-size: 14px;
    }

    .teacher-info {
      border-top: 1px solid #dcdcdc !important;
      color: black;
      margin-top: 0 !important;
    }

    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
      color: white !important;
      background-color: #465FAB !important;
    }
  </style>
  <?= $this->endSection() ?>
