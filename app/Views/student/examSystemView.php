<?= $this->extend('homepage/layout') ?>
<?= $this->section('content') ?>
<main id="main" class="my-5">
  <!-- ======= content Section ======= -->
  <section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

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
                            <option selected disabled value="">কোর্স বাছাই করুন</option>
                            <?php foreach ($purchaseCourseList as $row) : ?>
                              <option value="<?= $row->course_id; ?>"><?= $row->coures_title; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>

                        <div class="col-md-2">সিলেবাস নির্বাচন</div>

                        <div class="col-md-4">
                          <select id="course_chapter_id" class="form-select chapter_name_show" name="course_chapter_id" aria-label="Default select example" required>
                            <!-- This option will be added dynamically -->
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row questionList">
                  </div>
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
      //alert(courseId);
     // console.log("ok _id")
    });

    $('#course_chapter_id').on('change', function() {
      chapterId = $(this).val();
      loadData()
     // console.log("ok ch_id")
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
        success: function(data) {
          $('.questionList').empty();
          $('.chapter_name_show').empty();
          var examInfo = data.exam_info || [];
          var chapterInfo = data.chapter_info || [];

          //$('.questionList').empty();
          examInfo.forEach(item => {
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
          // Add the placeholder option for chapter selection if it doesn't already exist
          var $chapterSelect = $('.chapter_name_show');
          if ($chapterSelect.find('option[value=""]').length === 0) {
            $chapterSelect.append('<option selected disabled value="">পরীক্ষার সিলেবাস বাছাই করুন </option>');
          }
          chapterInfo.forEach(chapter => {
             $('.chapter_name_show').append(`
                <option value="${chapter.chapter_id}">Chapter: ${chapter.chapter_name}</option>
              `);
          });
        },
        error: function(xhr, status, error) {
          console.log("Error: " + error);
          // Optionally, show an error message on the page
        }
      });
    }
  });
</script>
<?= $this->endSection() ?>