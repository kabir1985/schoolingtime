<?= $this->extend('homepage/layout') ?>

<?= $this->section('content') ?>
<main id="main" class="my-5">

  <!--------------------------------->
  <?php echo $this->include("teacher/teacherDashboard_menu"); ?>

  <div class="col-lg-8">
    <!-----##########################This is content space which will change in every page-##################################-------------->
    <div class="container bg-light " data-aos="fade-up">
      <header class="section-header" style="padding-bottom: 1px !important;">
        <p>
          Exam Setup Section
        </p>
        <hr>
      </header>
      <!-----##########################This is content space which will change in every page-##################################-------------->
      <form action="<?php echo site_url('exam/exam-setup-insert'); ?>" method="post">
        <div class="row mb-2">
          <div class="col-md-4"><label for="course_title" class="form-label">Exam Name:</label></div>
          <div class="col-md-8">
            <input type="text" class="form-control" placeholder="Example: DU A Unit 2024" name="exam_name" required>
          </div>
        </div>
        <!-- data-request_url="<?= site_url("/exam/chapter-info"); ?>" -->
        <div class="row mb-2">
          <div class="col-md-4"><label for="course_level" class="form-label">Exam Subject / Course:</label></div>
          <div class="col-md-8">
            <select id="exam_subject" class="form-select select_subject" name="exam_subject" aria-label="Default select example" required>
              <option selected disabled value="">Select Exam Subject</option>
              <?php
              foreach ($courseList as $row) {
                $course_id = $row->course_id;
                $coures_title = $row->coures_title;
                $course_type_name = $row->course_type_name;
              ?>
                <option value="<?php echo $course_id; ?>"><?php echo $coures_title . "-->" . $course_type_name; ?></option>
              <?php
              }
              ?>

            </select>
          </div>
        </div>

        <!-- <div id="hide_course_or_chapter"> -->

        <div class="row mb-2">
          <div class="col-md-4"><label for="course_level" class="form-label">Exam Chapter / Course:</label></div>
          <div class="col-md-8">
            <select class="form-select chapter_name" id="course_chapter" name="chapter_name_id" aria-label="Default select example">
              <!-- <option selected disabled value="">Select Chapter / Course Name</option> -->
            </select>
          </div>
        </div>
        <!-- </div> -->





        <div class="row mb-2">
          <div class="col-md-4"><label for="course_level" class="form-label">Exam Duration in Minutes:</label></div>
          <div class="col-md-8">
            <input type="number" class="form-control" placeholder="Exam Duration" name="exam_duration" onkeypress="return isNumberKey(event)" required>
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-md-4"><label for="course_level" class="form-label">Total Questions:</label></div>
          <div class="col-md-8">
            <input type="number" class="form-control" placeholder="Total Questions" name="total_question" onkeypress="return isNumberKey(event)" required>
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-md-4"><label for="course_level" class="form-label">Marks Per Right Answer:</label></div>
          <div class="col-md-8">
            <input type="number" class="form-control" placeholder="Marks Per Right Answer" name="marks_per_right_answer" onkeypress="return isNumberKey(event)" required>
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-md-4"><label for="course_level" class="form-label">Marks Per Wrong Answer:</label></div>
          <div class="col-md-8">
            <input type="number" class="form-control" placeholder="Marks Per Wrong Answer" name="marks_per_wrong_answer" onkeypress="return isNumberKey(event)" required>
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-md-8"></div>
          <div class="col-md-4"><button type="submit" class="btn btn-success mt-1">Submit</button></div>
        </div>

      </form>
    </div>

    <!---------------------------------------------------------------------------------------->

    <!--------------------------------------------------------------------->
  </div><!-- End blog entries list -->
  </div>
  </div>
  </section>
  <!-- End Blog Section -->
  <!----------------------------------------------->
</main>
<?= $this->endSection() ?>

<?= $this->section('custom-script') ?>
<script type="text/javascript">
  $(document).ready(function() {
    ///////////////////////////////////////////////
    $('.select_subject').on('change', function() {
      // var courseId = $(this).find(":selected").val();
      var courseId = $(".select_subject option:selected").val();
      $.ajax({
        type: 'GET',
        url: '<?= site_url("exam/chapter-info"); ?>',
        data: {
          id: courseId
        },
        success: function(result) {
          $('.chapter_name').html(result);
        }
      });
    });
    ////////////////////////////////////////////////
  });
</script>
<?= $this->endSection() ?>