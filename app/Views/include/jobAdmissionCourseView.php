<?= $this->extend('homepage/layout') ?>

<?= $this->section('content') ?>
<main id="main" class="mt-5">

  <section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

      <div class="row">
        <div class="col-lg-3">
          <div class="sidebar">
            <h5>চাকুরী ও ভর্তি পরীক্ষা</h5>
            <hr>
            <div class="sidebar-item categories">
              <ul>
                <?php if (!empty($results)): ?>
                  <?php foreach ($results as $row): ?>
                    <li>
                      <a href="<?php echo site_url('course-show-skill-development') . '/' . $row->course_category_id; ?>">
                        <?= htmlspecialchars($row->course_category_name); ?>
                      </a>
                    </li>
                  <?php endforeach; ?>
                <?php else: ?>
                  <li><span>কোনো ক্যাটাগরি নেই</span></li>
                <?php endif; ?>
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
                $coursesFound = false; // Flag to track if any courses are found
                if (!empty($results)): ?>
                  <?php foreach ($results as $row): ?>
                    <?php
                    $course_category_id = $row->course_category_id;
                    $db = \Config\Database::connect();
                    try {
                      $query = $db->query("SELECT * FROM teacher_course WHERE course_status != 'pending' AND course_category_id = ?", [$course_category_id]);
                      $course_info = $query->getResult();

                      if (!empty($course_info)): // Check if there are courses
                        $coursesFound = true; // Set flag to true
                        foreach ($course_info as $row1):
                    ?>
                          <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="200">
                            <a href="<?php echo site_url('/course-details-page') . '/' . $row1->course_id; ?>">
                              <div class="service-box blue">
                                <img src="<?= base_url() ?>/public/CourseUploads/<?= htmlspecialchars($row1->course_pic); ?>" alt="avatar" class="img-fluid img-thumbnail" style="width:316px; height:200px">
                                <h5 class="pt-3"><?= htmlspecialchars($row1->coures_title); ?></h5>
                                <p class="teacher-info">
                                  <?php
                                  $query = $db->query("SELECT teacher_registration.teacher_name, teacher_profile.last_educational_institute, teacher_profile.teacher_pro_his 
                                                        FROM teacher_registration 
                                                        LEFT JOIN teacher_profile ON teacher_registration.teacher_id = teacher_profile.teacher_id
                                                        WHERE teacher_registration.teacher_id = ?", [$row1->course_teacher_id]);
                                  $results1 = $query->getRow();
                                  echo htmlspecialchars($results1->teacher_name) . "&nbsp;(" . htmlspecialchars($results1->last_educational_institute) . ")" . "<br>";
                                  echo htmlspecialchars($results1->teacher_pro_his);
                                  ?>
                                </p>
                                <div class="flex-container bg-light">
                                  <div>কোর্স ফি:&nbsp;<?= htmlspecialchars($row1->course_price); ?>&nbsp;টাকা</div>
                                </div>
                              </div>
                            </a>
                          </div>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    <?php } catch (\Exception $e) {
                      // Handle error
                      echo '<div class="col-12 text-center"><h5>ডেটাবেজ ত্রুটি: ' . htmlspecialchars($e->getMessage()) . '</h5></div>';
                    } ?>
                  <?php endforeach; ?>
                <?php endif; ?>

                <?php if (!$coursesFound): // Check if no courses were found ?>
                  <div class="col-12 text-center">
                    <h5>কোর্স পাওয়া যায়নি</h5>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </section>
          <!-- End Services Section -->

        </div><!-- End blog entries list -->
      </div>
    </div>
  </section><!-- End Blog Section -->

</main>
<?= $this->endSection() ?>

<?= $this->section('custom-style') ?>
<style type="text/css">
  .flex-container {
    display: flex;
    justify-content: center; /* Change to space-between for better layout */
  }

  .flex-container > div {
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
