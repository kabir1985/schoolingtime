<?= $this->extend('homepage/layout') ?>

<?= $this->section('content') ?>
<main id="main" class="mt-5">

  <section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

      <div class="row">
        <div class="col-lg-3">
          <div class="sidebar">
            <h3 class="sidebar-title">Course Categories</h3>
            <hr>
            <div class="sidebar-item categories">
              <ul>
                <?php
                foreach ($results as $row) {
                ?>
                  <li>
                    <a href="<?php echo site_url('course-show-skill-development') . '/' . $row->course_category_id; ?>"><?php echo $row->course_category_name; ?><!--<span class="float-end">(25)</span>--></a>
                  </li>
                <?php
                } ?>
              </ul>
            </div>
          </div>
        </div>


        <div class="col-lg-9 entries">

          <!-- ======= Services Section ======= -->
          <section id="services" class="services">

            <div class="container" data-aos="fade-up">

              <div class="row gy-4">
                <?php
                foreach ($skill_development_course_show as $row) {
                  $course_id = $row->course_id;
                  $course_status = $row->course_status;
                ?>
                    <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <a href="<?php echo site_url('/course-details-page') . '/' . $row->course_id; ?>">
                      <!-- <div class="service-box blue">
                        <img src="<?= base_url() ?>/public/CourseUploads/<?= $row->course_pic; ?>" alt="avatar" class="img-fluid img-thumbnail" style="width:316px; height:200px">
                        <h4><?php echo $row->coures_title; ?></h4>
                        <p>
                          <?php echo strlen($row->course_note) >= 70 ? substr($row->course_note, 0, 69) : $row->course_note; ?>
                        </p>
                        <button type="button" class="btn btn-outline-secondary">কোর্স ফি:&nbsp;<?php echo $row->course_price; ?></button>

                      </div> -->

                      <div class="service-box blue" >
                                                        <img src="<?= base_url() ?>/public/CourseUploads/<?= $row->course_pic; ?>" alt="avatar" class="img-fluid img-thumbnail" style="width:316px; height:200px">
                                                        <h5 class="pt-3"> <?php echo $row->coures_title; ?> </h5>
                                                        <p class="teacher-info" >
                                                            <?php
                                                            $db = \Config\Database::connect();
                                                            $query = $db->query("SELECT teacher_registration.teacher_name,
                                                                                        teacher_profile.last_educational_institute,teacher_profile.teacher_pro_his 
                                                                                        From teacher_registration 
                                                                                        LEFT JOIN teacher_profile ON teacher_registration.teacher_id = teacher_profile.teacher_id
                                                                                        WHERE teacher_registration.teacher_id = '$row->course_teacher_id';");
                                                            //echo strlen($row->course_note) >= 100 ? substr($row->course_note, 0, 99) : $row->course_note;
                                                            $results1 = $query->getRow();
                                                            echo $results1->teacher_name ."&nbsp;(".$results1->last_educational_institute.")"."<br>";
                                                           // echo $results1->last_educational_institute."<br>";
                                                            echo $results1->teacher_pro_his;
                                                            ?>
                                                        </p>
                                                        <div class="flex-container bg-light ">
                                                            <div>কোর্স ফি:&nbsp;<?php echo $row->course_price; ?>&nbsp;টাকা</div>
                                                            <div>শুরুঃ&nbsp;<?php echo $row->course_start_date; ?></div>
                                                        </div>
                                                    </div>


                    </a>
                    </div>
                <?php }?>
              </div>
            </div>

          </section>
          <!-- End Services Section -->

          <!-- <div class="blog-pagination">
            <ul class="justify-content-center">
              <li><a href="#">1</a></li>
              <li class="active"><a href="#">2</a></li>
              <li><a href="#">3</a></li>
            </ul>
          </div> -->

        </div><!-- End blog entries list -->



      </div>

    </div>
  </section><!-- End Blog Section -->

</main>
<?= $this->endSection() ?>

<?= $this->section('custom-style')?>
<style type="text/css">
    .flex-container {
        display: flex;
        justify-content: space-between;
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
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
  color: black !important;
  background-color: #f6f9ff !important;
}
</style>
<?= $this->endSection() ?>