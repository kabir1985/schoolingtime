<?= $this->extend('homepage/layout') ?>

<?= $this->section('content') ?>
<main id="main" class="my-5">
  <!------------------------------------------------>
  <?php echo $this->include("teacher/teacherDashboard_menu"); ?>
  <div class="col-lg-9 entries">
    <!-----##########################This is content space which will change in every page-##################################-------------->
    <div class="container bg-light " data-aos="fade-up">
      <header class="section-header" style="padding-bottom: 2px !important;">
        <p>Teacher Profile Update Section</p>
        <hr>
      </header>
      <?php
      foreach ($teacher_profile_show as $row) {
        $row['last_educational_institute'];
        $row['teacher_edu_his'];
        $row['teacher_pro_his'];
        $row['teacher_certi_award'];
        $row['teacher_pic'];
        $row['term_condition'];
      }
      ?>
      <form action="<?php echo site_url('teacher/profile-update') ?>" method="post" class="was-validated" accept-charset="utf-8" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-6">
            <div class="mb-2">
              <label for="last_educational_institute" class="form-label">Last Edutaional Institute</label>
              <input type="text" class="form-control" id="last_educational_institute" value="<?php echo $row['last_educational_institute']; ?>" name="last_educational_institute" required>
            </div>
            <div class="mb-2">
              <label for="teacher_edu_his" class="form-label">Education History:</label>
              <input type="text" class="form-control" id="teacher_edu_his" value="<?php echo  $row['teacher_edu_his']; ?>" name="teacher_edu_his" required>
            </div>
            <div class="mb-2">
              <label for="teacher_pro_his" class="form-label">Professional History:</label>
              <input type="text" class="form-control" id="teacher_pro_his" value="<?php echo $row['teacher_pro_his']; ?>" name="teacher_pro_his" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-2">
              <label for="teacher_certi_award" class="form-label">Certificate & Awards:</label>
              <input type="text" class="form-control" id="teacher_certi_award" value="<?php echo $row['teacher_certi_award']; ?>" name="teacher_certi_award" required>
            </div>
            <div class="mb-2">
              <label for="teacher_pic" class="form-label">Teacher Picture:</label>
              <input type="file" class="form-control" id="file" name="file" required>
            </div>
            <div class="form-check mb-2">
              <input class="form-check-input" type="checkbox" id="term_condition" value="<?php echo $row['term_condition']; ?>" name="term_condition" required>
              <label class="form-check-label" for="myCheck">I agree on Term & Condition.</label>
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Check this checkbox to continue.</div>
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
          </div>
      </form>
    </div>
    <!-----##########################This is content space which will change in every page-##################################-------------->
  </div><!-- End blog entries list -->
  </div>
  </div>
  </section>
  <!-- End Blog Section -->
  <!----------------------------------------------->
</main>
<?= $this->endSection() ?>

