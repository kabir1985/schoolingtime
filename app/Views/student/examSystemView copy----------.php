<?= $this->extend('homepage/layout') ?>

<?= $this->section('content') ?>
<main id="main" class="my-5">
  <!-- ======= content Section ======= -->
  <section id="blog" class="blog">
    <div class="container-fluid" data-aos="fade-up">

      <div class="row">
        <!------Left Menu Column---------------------------------------->
        <div class="col-lg-3">
          <?php echo $this->include("student/student_dashboard_left_menu"); ?>
        </div>
        <div class="col-lg-9">

          <!------------------Content area--------------------------------------------->
          <section style="background-color: #eee;">
            <div class="container py-2">

              <div class="row">
                <div class="col-lg-12">
                  <div class="card mb-4">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-2"><label for="course_section_id" class="form-label text-right">কোর্স নির্বাচন</label></div>
                        <div class="col-md-4">
                          <select id="courseId" class="form-select select_subject" name="courseId" aria-label="Default select example" required>
                            <option selected disabled value="">Select Exam Subject</option>
                            <?php
                            foreach ($purchaseCourseList as $row) {
                              $course_id = $row->course_id;
                              $coures_title = $row->coures_title;
                            ?>
                              <option value="<?php echo $course_id; ?>"><?php echo $coures_title; ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>

                        <div class="col-md-2">সিলেবাস নির্বাচন</div>
                        <div class="col-md-4">
                          <select id="course_chapter_id" class="form-select" name="course_chapter_id" aria-label="Default select example" required>
                            <option selected disabled value="">পরীক্ষার সিলেবাস বাছাই করুন </option>
                            <?php
                            $db = \Config\Database::connect();
                            $query = $db->query("SELECT * From course_content  Where course_id ='$course_id' ");
                            $chapter_info = $query->getResult();
                            foreach ($chapter_info as $row) {
                            ?>
                              <option value="<?php echo $row->chapter_id; ?>"><?php echo $row->chapter_name; ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                        
                      </div>
                    </div>
                  </div>

                  <div class="row questionList">
                  </div>
                  <!-- <div class="row">
                    <div class="col-sm-6 mb-1">
                      <div class="card text-center">
                        <div class="card-body">
                          <h5 class="card-title"></h5>
                          <p class="card-text">sfsdfsdf</p>
                           <p class="card-text">dsdsfs</p> 
                          <a href="#" class="btn btn-outline-secondary btn-sm d-grid gap-2 mx-auto feedback_submit">পরীক্ষা দিন</a>
                        </div>
                      </div>
                    </div>
                  </div> -->

                </div>
              </div>
            </div>
          </section>
          <!---------------------------------------------------------------------------->
        </div><!-- End blog entries list -->
      </div>
    </div>
  </section><!-- End Blog Section -->
  <!--------------------------------------------->

  <!-- Modal -->
</main>
<?= $this->endSection() ?>

<?= $this->section('custom-script') ?>
<script type="text/javascript">
  $(document).ready(function() {
    var courseId = null;
    var chapterId = null;
    $('.select_subject').on('change', function() {
      courseId = $(".select_subject option:selected").val();
      chapterId = null;
      loadData()
    });

    $('#course_chapter_id').on('change', function() {
      chapterId = $(this).val();
      loadData()
    });

    function loadData() {
      $.ajax({
        type: 'GET',
        url: '<?= site_url("/exam/exam-show"); ?>',
        data: {
          course_id: courseId,
          chapter_id: chapterId
        },
        dataType: 'json',
        success: function(jsonData) {

          $('.questionList').empty();
          jsonData.forEach(item => {
            $('.questionList').append(`
             <div class="col-4">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">${item.exam_name}</h5>
                        <p class="card-text">Time:${item.exam_duration}</p>
                        <p class="card-text">Questions:${item.total_question}</p>
                        <!-- <a href="#" class="btn btn-info">Button</a> -->
                        <a href="<?php echo site_url('exam/question-set-exam-start') . '/' . '${item.exam_setup_id}' ?>" class="btn btn-outline-info justify-content-center readmore stretched-link mt-auto"><span>পরীক্ষার সেট বাছাই</span></a>
                      </div>
                    </div>
                  </div>`);
          });




          courseContent.forEach(item => {
              $('.questionList').append(`
                <div class="col-4">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Chapter: ${item.chapter_name}</h5>
                      <p class="card-text">Course ID: ${item.course_id}</p>
                    </div>
                  </div>
                </div>
              `);
            });


        }
      });
    }

  });
</script>
<?= $this->endSection() ?>