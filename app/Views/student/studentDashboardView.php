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
        <!----------Left Menu Column End----------------------------------------->

        <?php

// Start the session service
$session = \Config\Services::session();
        foreach ($student_list_show as $row) {
          $student_pic = $row['stu_pic'];
          $name = $row['student_name'];
          $email = $row['student_email'];
          $student_id = $row['student_id'];

        // Store in session
         $session->set([
                       'student_name' => $name,
                       'student_id' => $student_id
                       ]);
        }
        ?>
        <div class="col-lg-9">

          <!------------------Content area--------------------------------------------->
          <section style="background-color: #eee;">
            <div class="container py-2">
              <!-- <div class="row">
                <div class="col">
                  <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                      <li class="breadcrumb-item active" aria-current="page"><?php echo "Welcome: " . $name . "--" . $student_id; ?></li>
                    </ol>
                  </nav>
                </div>
              </div> -->

              <div class="row">
                <div class="col-lg-4">
                  <div class="card mb-4">
                    <div class="card-body text-center">
                      <img src="<?= base_url() ?>/public/uploads/<?= $student_pic; ?>" alt="your picture" class="rounded-circle img-fluid" style="width: 150px;">
                      <!-- <h5 class="my-3"><?php echo $name; ?></h5> -->
                      <p class="text-muted mb-1"><?php echo $name; ?></p>
                      <!-- <p class="text-muted mb-4">Bay Area, San Francisco, CA</p> -->
                      <div class="d-flex justify-content-center mb-2">
                        <!--  <button type="button" class="btn btn-primary">Follow</button>-->
                        <a href="<?php echo site_url('student/profile') ?>" type="button" class="btn btn-outline-primary btn-sm ms-1">প্রোফাইল আপডেট</a>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-8">
                  <div class="card mb-4">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-3">
                          <!-- <p class="mb-0">Address</p> -->
                        </div>
                        <div class="col-sm-9">
                          <h5 class="mb-0">আপনার ক্রয়কৃত কোর্স সমুহ</h5>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <?php foreach ($course_purchase_info as $row) {
                    ?>
                      <div class="col-sm-6 mb-1">
                        <div class="card text-center">
                          <div class="card-body">
                            <h5 class="card-title"><?php
                                                    $db = \Config\Database::connect();
                                                   $row->course_id;
                                                  ///////////////purchased course session e set kora//////////////////
                                                  $session = session();
                                                  $session->set('purchased_courses', array_column($course_purchase_info, 'course_id'));
                                                  //////////////////////////////////
                                                    $builder = $db->table('teacher_course');
                                                    $builder->where('course_id', $row->course_id);
                                                    $query   = $builder->get();
                                                    $results = $query->getRow();
                                                    echo $results->coures_title;
                                                    ?></h5>
                            <p class="card-text"><?= "ক্রয়ের তাং&nbsp;" . $row->purchase_date; ?></p>
                            <!-- <p class="card-text"><?= "কোর্স ফি &nbsp;" . $row->course_price; ?></p> -->
                            <a href="#" class="btn btn-outline-secondary btn-sm d-grid gap-2 mx-auto feedback_submit" data-course_id="<?php echo $row->course_id;?>" data-teacher_course_id="<?php echo $row->course_teacher_id; ?>" data-student_name="<?php echo $name; ?>" data-student_id="<?php echo $student_id;?>">কোর্স ফিডব্যাক</a>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
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
  <div class="modal fade " id="modal_form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_form" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="rating-form" method="post" action="<?php echo site_url('student/feedback') ?>">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">
                    কোর্স সম্পর্কে আপনার মতামত আমাদের কাছে অনেক মূল্যবান
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

                        <!---------------Feedback Star------------------------->
 
              <div class="star-rating">
              <label>আপনার রেটিং বাছাই &nbsp;&nbsp; </label>
                <span class="star"  data-value="1" aria-required="require">&#9733;</span>
                <span class="star"  data-value="2">&#9733;</span>
                <span class="star"  data-value="3">&#9733;</span>
                <span class="star"  data-value="4">&#9733;</span>
                <span class="star"  data-value="5">&#9733;</span>
              </div>
              <!------------------FeedBack Star End------------------------------>
            <!-- <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                </div> -->
            <input type="hidden" id="rating" name="rating" required>
            <input type="hidden" id="course_id" name="course_id" required>
            <input type="text" id="teacher_course_id" name="teacher_course_id" hidden>
            <input type="text" id="student_id" name="student_id" hidden>
            <input type="text" id="student_name" name="student_name" hidden>
            <div class="mb-3">
              <label for="student_feedback" class="form-label">আপনার মতামত লিখুন</label>
              <textarea class="form-control" id="student_feedback" name="student_feedback" rows="3" required></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বাতিল করুন</button>
            <button type="submit" class="btn btn-primary">সাবমিট করুন</button>
          </div>
        </form>
      </div>
    </div>
  </div>



</main>
<?= $this->endSection() ?>

<?= $this->section('custom-script') ?>
<script type="text/javascript">
  $(document).ready(function() {
    $(".feedback_submit").click(function() {
      var teacher_course_id = $(this).data("teacher_course_id");
      var student_name = $(this).data("student_name");
      var student_id = $(this).data("student_id");
      var course_id = $(this).data("course_id");
     
      $("#course_id").val(course_id);
      $('#teacher_course_id').val(teacher_course_id);
      $("#student_id").val(student_id);
      $('#student_name').val(student_name);

      $('#modal_form').modal('show');
    });

    //////////////Feedback Star Rating////////////////////////////////

    $('.star').on('mouseover', function() {
      var rating = $(this).data('value');
      highlightStars(rating);
    });

    $('.star').on('mouseout', function() {
      resetStars();
    });

    $('.star').on('click', function() {
      var rating = $(this).data('value');
      $("#rating").val(rating);
     // $('#rating-form').submit();

      $('.star').removeClass('selected');
      highlightStars(rating);
      $(this).addClass('selected').prevAll().addClass('selected');
    });

    $('#rating-form').on('submit', function(event) {
                var rating = $('#rating').val();
                if (rating === '' || rating < 1 || rating > 5) {
                    alert('Please select a valid rating between 1 and 5.');
                    event.preventDefault();
                }
            });

    function highlightStars(rating) {
      $('.star').each(function(index, element) {
        if (index < rating) {
          $(element).addClass('hover');
        } else {
          $(element).removeClass('hover');
        }
      });
    }

    function resetStars() {
      $('.star').removeClass('hover');
    }


    /////////////////////////////////////////////////


  });
</script>
<?= $this->endSection() ?>

<?= $this->section('custom-style') ?>
<style type = "text/css">
  .star-rating {
    display: flex;
    justify-content: left;
    align-items: center;
  }

  .star {
    font-size: 2rem;
    cursor: pointer;
    color: #ccc;
  }

  .star.selected,
  .star:hover,
  .star:hover~.star {
    color: #f0a500;
  }
</style>
<?= $this->endSection() ?>

