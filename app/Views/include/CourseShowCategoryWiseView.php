<?= $this->extend('homepage/layout') ?>

<?php 
  // Define the convertToBangla function here if not already defined
  function convertToBangla($number) {
    $banglaDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
    return str_replace(range(0, 9), $banglaDigits, $number);
}
?>

<?= $this->section('content') ?>
<main id="main" class="mt-5">
  <section id="blog" class="blog">
    <div class="container-fluid" data-aos="fade-up">
      <div class="row">
        <div class="col-lg-3">
          <div class="sidebar">
            <h3 class="sidebar-title">কোর্স ক্যাটাগরি</h3>
            <hr>
            <div class="sidebar-item categories">
              <ul>
                <?php
                foreach ($courseCategoryList as $row) {
                ?>
                  <li>
                    <a href="<?php echo site_url('course-show-categorywise') . '/' . $row->course_category_id; ?>"><?php echo $row->course_category_name; ?><span class="float-end">(25)</span></a>
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
                foreach ($courseList as $row) {
                  // if ($row->course_type_name = "Online_Video_Course") {
                ?>
                  <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <a href="<?php echo site_url('/course-details-page') . '/' . $row->course_id; ?>">
                      <div class="service-box blue">
                        <img src="<?= base_url() ?>/public/CourseUploads/<?= $row->course_pic; ?>" alt="avatar" class="img-fluid img-thumbnail" style="width:316px; height:200px">
                        <h5 class="pt-3"> <?php echo $row->coures_title; ?> </h5>
                        <p class="teacher-info">
                          <span>
                            <?php
                            $rating_number = $row->feedback_rating;
                            for ($i = 0; $i < 5; $i++) {
                            ?>
                              <span class="star <?php if ($i < $rating_number) echo 'filled'; ?>">&#9733;</span>
                            <?php
                            }
                            ?>
                          </span>
                          <br>
                          <?php
                          echo $row->teacher_name . "<br>";
                          echo $row->last_educational_institute;
                          ?>
                        </p>
                        <div class="flex-container bg-light">
                          <div>কোর্স ফি:&nbsp;<?= convertToBangla($row->course_price); ?>&nbsp;টাকা</div>
                        </div>
                      </div>
                    </a>
                  </div>
                <?php
                }
                //}
                ?>
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
    color: black !important;
    background-color: #f6f9ff !important;
  }
</style>
<?= $this->endSection() ?>