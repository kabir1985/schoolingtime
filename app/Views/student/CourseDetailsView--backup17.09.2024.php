<?= $this->extend('homepage/layout') ?>

<?= $this->section('page_title') ?>
  <?php echo $metaData['title']."-বিস্তারিত...";?>
  <?= $this->endSection() ?>

<?php
 $this->section('meta_data');

if(isset($metaData)){
?>

<meta property="og:url" content="<?=$metaData['url']?>" />
<meta property="og:title" content="<?=$metaData['title']?>" />
<meta property="og:description" content="<?=$metaData['description']?>" />
<meta property="og:image" content="<?=$metaData['image']?>" />
<?php
}
 $this->endSection();
 ?>


<?= $this->section('content') ?>
<main id="main" class="my-5">

  <!-- ======= content Section ======= -->
  <section id="blog" class="blog">
    <div class="container-fluid" data-aos="fade-up">
      <div class="row">
        <!------Left Menu Column---------------------------------------->
        <?php
        if (isset($_SESSION['student_id'])) {
        ?>
          <div class="col-lg-3">
            <?php echo $this->include("student/student_dashboard_left_menu"); ?>
          </div>
          <!----------Left Menu Column End----------------------------------------->

          <!---------------Main Content Column------------------------------------------>
          <div class="col-lg-9">
          <?php
        } else {
          ?>
            <div class="col-lg-12">
            <?php
          }
            ?>
            <!-----------1st Row Start------------------------------------------------>
            <?php
            if (isset($course_info)) {
              $course_title = $course_info->coures_title;
              $course_id = $course_info->course_id;
              $course_teacher_id = $course_info->course_teacher_id;
              $what_will_learn = $course_info->what_you_will_learn;
              $course_start_date = $course_info->course_start_date;
              $course_price = $course_info->course_price;
              $demo_class_link = $course_info->demo_class_link;
              // $course_schedule = $course_info->course_schedule;
              $course_note = $course_info->course_note;
            }
            ?>
            <div class="container">
              <div class="row">
                <div class="col-lg-8 entries">

                  <article class="entry entry-single">

                    <h2 class="entry-title">
                      <a href="#"><?php echo $course_title; ?></a>
                    </h2>
                    <hr>
                    <!-- <div class="entry-meta">
                      <ul>
                        <li class="d-flex align-items-center"><i class="bi bi-twitter"></i> <a href="blog-single.html">John Doe</a></li>
                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-single.html"><time datetime="2020-01-01">Jan 1, 2020</time></a></li>
                        <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-single.html">12 Comments</a></li>
                      </ul>
                    </div> -->

                    <div class="entry-content">
                      <p style="text-align: justify;">
                        <?php echo $course_note; ?>
                      </p>
                    </div>

                    <div class="entry-footer">
                      <i class="bi bi-watch"></i>
                      <ul class="cats">
                        <li><a href="#">কোর্সটি শুরু:</a></li>
                        <li><a href="#"><?php echo $course_start_date; ?></a></li>
                      </ul>
                      <i class="bi bi-person-plus-fill"></i>
                      <ul class="cats">
                        <li><a href="#">শিক্ষার্থী:</a></li>
                        <li><a href="#">১৫-২০ জন</a></li>
                      </ul>
                      <i class="bi bi-tags"></i>
                      <ul class="tags">
                        <li><a href="#">কোর্স ফি:</a></li>
                        <li><a href="#"><?php echo $course_price." টাকা"; ?></a></li>
                      </ul>
                      <!-- 
                <i class="bi bi-tags"></i>
                <ul class="tags">
                  <li><a href="#">Creative</a></li>
                  <li><a href="#">Tips</a></li>
                  <li><a href="#">Marketing</a></li>
                </ul> -->
                    </div>

                  </article><!-- End blog entry -->
                  <!---------------------------->

                  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-body">
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></span>
                          </button>
                          <!-- 16:9 aspect ratio -->
                          <div class="ratio ratio-16x9 text-center">
                            <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always" allow="autoplay"></iframe>
                            <h1 id="no_video">No Video Found !</h1>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-------------------------------->

                  <article class="entry entry-single">
                    <!-- <h5 class="entry-title">-->
                    <h5><a href="#"> কোর্সের মাধ্যমে যা শিখবেন -</a></h5>
                    <hr>
                    <!-- </h5>-->
                    <div class="entry-content">
                      <ul>
                        <?php
                        $what_you_will_learn = $what_will_learn;
                        $str_arr = explode(",", $what_you_will_learn);
                        for ($i = 0; $i < count($str_arr); $i++) {
                        ?>
                          <li>
                            <?php echo $str_arr[$i]; ?>
                          </li>
                        <?php } ?>
                      </ul>
                    </div>
                  </article><!-- End blog entry -->

                  <!-- End blog author bio -->
                </div><!-- End blog entries list -->
                <!------------------Demo class video section start---------------------------------------------->
                <div class="col-lg-4">

                  <div class="sidebar sidbar_fixed">
                    <!-------------Join Course-------------------------------------->
                    <div class="sidebar-title">

                      <!--------------------------Add to cart option -------------------------------------------->
                      <button type="button" class="btn btn-secondary video-btn" data-bs-toggle="modal" data-src="<?php echo $demo_class_link; ?>" data-bs-target="#myModal">
                        <i class="bi bi-youtube">&nbsp;কোর্সের ডেমো ভিডিও</i>
                      </button>
                      <!------------------------------------------->
                    </div>
                    <!-------------Join Course-------------------------------------->
                    <div class="sidebar-title">
                      <a data-course_id="<?php echo $course_id; ?>" data-student_session_id="<?php echo isset($_SESSION['student_id']); ?>" class="course_add_to_cart btn btn-outline-info btn-sm">কোর্সে ভর্তির জন্য ক্লিক করুন</a>
                    </div>
                    <!------------------------------------------------------------->
                    <?php
                    if (isset($course_include)) {
                    ?>
                      <h3 class="sidebar-title">কোর্সে আরো পাবেন:</h3>

                      <div class="sidebar-item categories">
                        <ul>
                          <li><a href="#"><i class="fa fa-chevron-right" aria-hidden="true"></i>
                              &nbsp;<?php echo $course_include->course_duration; ?></a></li>

                          <li><a href="#"><i class="fa fa-chevron-right" aria-hidden="true"></i>
                              &nbsp;<?php echo $course_include->live_class; ?></a></li>

                          <li><a href="#"><i class="fa fa-chevron-right" aria-hidden="true"></i>
                              &nbsp;<?php echo $course_include->course_exam; ?></a></li>

                          <li><a href="#"><i class="fa fa-chevron-right" aria-hidden="true"></i>
                              &nbsp;<?php echo $course_include->course_model_test; ?></a></li>

                          <li><a href="#">
                              <i class="fa fa-chevron-right" aria-hidden="true"></i>
                              &nbsp;<?php echo $course_include->class_time; ?></a></li>
                        </ul>
                      </div><!-- End sidebar tags-->
                    <?php
                    }
                    ?>
                    <h3 class="sidebar-title" style="padding-top: 20px;"> কোর্সটি শেয়ার করুন</h3>
                    <div class="sidebar-item tags">
                      <ul>
                        <li>
                          <div id="demo"></div>
                        </li>
                      </ul>
                    </div><!-- End sidebar tags-->


<!------------------------------------------>

<!----------------------------------------->


                  </div><!-- End sidebar -->
                </div>
                <!-- Right demo class video section end -->
              </div>
              <!-------1st Row End--------------------------------------------------------------------->

              <!-------##########################--2nd Row--##############----------------->

              <div class="row">
                <div class="col-sm-8">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                          <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#index">সিলেবাস</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#teacher">শিক্ষক </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#exam">পরীক্ষা</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#question">জিজ্ঞাসা </a>
                          </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                          <div class="tab-pane container active" id="index">
                            <p>
                              <!--------------------------সিলেবাস/ সূচীপ্ত্র--------------------->
                            <section id="faq" class="faq">
                              <div class="container" data-aos="fade-up">
                                <div class="row">
                                  <div class="col-lg-12">
                                    <div class="accordion accordion-flush" id="faqlist1">
                                      <?php
                                      $serial_no = 1;
                                      foreach ($course_contents as $row) {
                                      ?>
                                        <div class="accordion-item">
                                          <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-<?php echo $serial_no; ?>">
                                              <?php
                                              $chapter_id = $row->chapter_id;
                                              echo $row->chapter_name; ?>
                                            </button>
                                          </h2>
                                          <div id="faq-content-<?php echo $serial_no; ?>" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                                            <div class="accordion-body">
                                              <?php
                                              $db = \Config\Database::connect();
                                              $query = $db->query("SELECT video_title, pdf_file_path, video_link FROM  course_content 
                                                            WHERE chapter_id = '$row->chapter_id'");
                                              $results = $query->getResult();
                                              $i = 1;
                                              foreach ($results as $row) {
                                                $url = $row->video_link;
                                                $pattern = '/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';
                                                if (preg_match($pattern, $url, $matches)) { //if course is video
                                              ?>
                                                  <div class="row">
                                                    <div class="col-md-9">
                                                      <span style="background-color: #3c4852; color: white" class="numberCircle"><?php echo $i; ?></span>
                                                      <?php echo $row->video_title;
                                                      ?>
                                                      <span class="not-allowed" style="float: right; padding-right: 10px; color: grey">
                                                    </div>
                                                    <div class="col-md-2">
                                                      <!-- <span class="btn-sm video-btn" data-bs-toggle="modal" data-src="<?php echo $row->video_link; ?>" data-bs-target="#myModal">
                                                         <i class="fa fa-play-circle">Video</i>
                                                        <i class='fas fa-play-circle' style='font-size:22px;color:red'></i>
                                                     </span> -->
                                                    </div>

                                                    <div class="col-md-1">
                                                      <!-- <p><i class='fas fa-lock'></i></p> -->
                                                    </div>
                                                  </div>

                                                  <div class="row">
                                                  <div class="col-md-1"></div>
                                                    <div class="col-md-8">
                                                      <span class="btn-sm video-btn" data-bs-toggle="modal" data-src="<?php echo $row->video_link; ?>" data-bs-target="#myModal">
                                                      &nbsp; <i class='fa-solid fa-video' style='font-size:18px;color: #465FAB  ; '></i> &nbsp;&nbsp; ভিডিও লেকচার দেখুন
                                                      </span>
                                                    </div>
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-1">
                                                      <p><i class='fas fa-lock'></i></p>
                                                    </div>
                                                  </div>

                                                  <!--////////////////////////////pdf file display////////////////////////////////////////////////////-->
                                                  <?php if (isset($row->pdf_file_path)) { ?>
                                                    <div class="row">
                                                    <div class="col-md-1"></div>
                                                      <div class="col-md-8">
                                                        <a href="<?php echo base_url('public/notes/' . $row->pdf_file_path); ?>" target="_blank" style= "padding: .25rem .5rem !important; font-size: .875rem !important; border-radius: .2rem !important;">
                                                        &nbsp;&nbsp;&nbsp;<i class="far fa-file-pdf" style="font-size:18px; color:tomato;"></i>&nbsp;&nbsp;পিডিএফ নোট পড়ুন</a>
                                                      </div>
                                                      <div class="col-md-2"></div>
                                                      <div class="col-md-1">
                                                        <p><i class='fas fa-lock'></i></p>
                                                      </div>
                                                    </div>
                                                  <?php } ?>
                                                  <!--////////////////////////////////////////////////////////////////////////////////////-->

                                                  <!-- </div> -->
                                                <?php
                                                  $i++;
                                                } else //if course content not video then 
                                                {
                                                ?>
                                                  <div class="row">
                                                    <div class="col-md-9 mb-1">
                                                      <span style="background-color: #3c4852; color: white" class="numberCircle"><?php echo $i; ?></span>
                                                      <?php echo $row->video_title . ":"; ?>
                                                    </div>
                                                    <div class="col-md-2"></div>
                                                      <div class="col-md-1">
                                                        <p><i class='fas fa-lock'></i></p>
                                                      </div>
                                                  </div>
                                                  <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-10"><?php echo $row->video_link; ?></div>
                                                      <div class="col-md-1">
                                                        <p><i class='fas fa-lock'></i></p>
                                                      </div>
                                                  </div>
                                                  <!-------------pdf file display------------------------->
                                                  <?php if ($row->pdf_file_path != null) { ?>
                                                    <div class="row">
                                                    <div class="col-md-1"></div>
                                                      <div class="col-md-10">
                                                        <a href="<?php echo base_url('public/notes/' . $row->pdf_file_path); ?>" target="_blank" style= "padding: .25rem .5rem !important; font-size: .875rem !important; border-radius: .2rem !important;">
                                                        &nbsp;&nbsp;&nbsp;<i class="far fa-file-pdf" style="font-size:18px; color:tomato;"></i>&nbsp;&nbsp;পিডিএফ নোট পড়ুন</a>
                                                      </div>
                                                      <div class="col-md-1">
                                                        <p><i class='fas fa-lock'></i></p>
                                                      </div>
                                                    </div>
                                                  <?php } ?>
                                                  <!--------------------------------------------------->
                                              <?php
                                                }
                                                $i++;
                                              }
                                              ?>
                                              <?php
                                              $query = $db->query("SELECT * FROM  exam_setup Where subject_chapter_id = '$chapter_id' AND exam_subject_course_id = '$course_id' ");
                                              $exam_show = $query->getResult();
                                              foreach ($exam_show as $row) {
                                              ?>
                                                <div class="row">
                                                <div class="col-md-1"></div>
                                                  <div class="col-md-8">
                                                    <a href="<?php echo site_url('exam/question-set-exam-start') . '/' . $row->exam_setup_id; ?>" style= "padding: .25rem .5rem !important; font-size: .875rem !important; border-radius: .2rem !important;">
                                                    &nbsp;&nbsp; <i class='fas fa-user-graduate' style="font-size:18px;"></i>
                                                    &nbsp;<?php echo  "  পরীক্ষা দিন  | " . $row->exam_name . isset($_SESSION['student_id']); ?></a>
                                                  </div>
                                                  <div class="col-md-2"></div>
                                                  <div class="col-md-1">
                                                    <p><i class='fas fa-lock'></i></p>
                                                  </div>
                                                </div>
                                              <?php
                                              }
                                              ?>
                                            </div>
                                          </div>
                                          <div id="faq-content-<?php echo $serial_no; ?>" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                                          </div>
                                        </div>
                                      <?php
                                        $serial_no++;
                                      }
                                      ?>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </section>
                            <!--------------------------সিলেবাস/ সূচীপ্ত্র  END--------------------->
                            </p>
                          </div>
                          <div class="tab-pane container fade mt-3" id="teacher">
                            <div class="cotainter">
                              <?php
                              if (isset($teacher_info)) {
                                $teacher_pic = $teacher_info->teacher_pic;
                                $teacher_edu_his = $teacher_info->teacher_edu_his;
                                $last_educational_institute = $teacher_info->last_educational_institute;
                                $teacher_pro_his = $teacher_info->teacher_pro_his;
                                $teacher_certi_award = $teacher_info->teacher_certi_award;
                              }
                              ?>
                              <div class="row">
                                <div class="col-4">
                                  <img src="<?= base_url() ?>/public/TeacherUploads/<?= $teacher_pic; ?>" alt="teacher" class="card-img">
                                </div>
                                <div class="col-8">
                                  <p class="card-text"><?php echo $teacher_edu_his . "<br>";
                                                        echo $last_educational_institute . "<br>";
                                                        echo $teacher_pro_his . "<br>";
                                                        echo $teacher_certi_award;
                                                        ?></p>
                                  <a href="#" class="btn btn-outline-secondary">View Profile</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!---------------------------Exam Start----------------------------------->
                          <div class="tab-pane container fade mt-3" id="exam">
                            <div class="cotainter">
                              <?php
                              $db = \Config\Database::connect();
                              $query = $db->query("SELECT * FROM  exam_setup Where subject_chapter_id = 'others' AND  exam_subject_course_id = '$course_id' ");
                              $question_set_show = $query->getResult();
                              ?>
                              <?php
                              foreach ($question_set_show as $row) {
                              ?>
                                <div class="row">
                                  <div class="col-md-1">1</div>
                                  <div class="col-md-8"><?php echo $row->exam_name; ?></div>
                                  <div class="col-md-3"><a href="<?php
                                                                  if (isset($_SESSION['student_id'])) {
                                                                    echo site_url('exam/question-set-exam-start') . '/' . $row->exam_setup_id;
                                                                  } else {
                                                                    echo site_url('student/login') . '/' . "exam";
                                                                  } ?>" class="btn btn-outline-info">
                                      পরীক্ষা দিন</a>
                                  </div>
                                </div>
                              <?php } ?>
                            </div>
                          </div>
                          <!---------------------------------Exam End--------------------------------------------------------->

                          <!---------------------------Course Question/ ASK Start-------------------------------------------------------->
                          <div class="tab-pane container fade mt-3" id="question">
                            <div class="cotainter">
                              <div class="row">
                                <div class="col-4"></div>
                                <div class="col-8"></div>
                              </div>
                            </div>
                          </div>
                          <!---------------------------Course Question/ ASK End-------------------------------------------------------->
                        </div>
                    </div>
                  </div>
                </div>
                <div class="col-4">
                <div class="sidebar sidbar_fixed">
                    <!-------------Join Course-------------------------------------->
                    <div class="sidebar-title">
                <h3 class="sidebar-title"> কমিউনিটিতে জয়েন করুন</h3>
                    <div class="sidebar-item tags">
                      <ul>
                        <li>
                          <div class="social-links mt-0">
                            <a href="https://www.facebook.com/schoolingtime" class="facebook" target="_blank"><i class="fab fa-facebook-f fa-2x" style="color: #3b5998;"></i></a>
                            <a href="#" class="linkedin"><i class="fab fa-linkedin-in fa-2x" style="color: #0082ca;"></i></a>
                            <a href="https://www.youtube.com/@SchoolingTime" class="youtube" target="_blank"><i class="fab fa-youtube fa-2x" style="color: #ed302f;"></i></a>
                          </div>
                        </li>
                      </ul>
                    </div><!-- End sidebar tags-->
                  </div></div>
                </div>
              </div>





           <!------------------Student Feedback Section Start----------------------------->
              <div class="row">
                <section id="testimonials" class="testimonials">

                  <div class="container" data-aos="fade-up">

                    <header class="section-header">
                      <!-- <h2>Testimonials</h2> -->
                      <p style="font-size:24px;">কোর্স সম্পর্কে শিক্ষার্থীদের মন্তব্য</p>
                    </header>

                    <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="200">
                      <div class="swiper-wrapper">
                        <?php
                        $query = $db->query("SELECT * FROM  course_feedback Where teacher_course_id = '$course_teacher_id' ");
                        $coursefeedbackList = $query->getResult();

                        foreach ($coursefeedbackList as $row) {
                        ?>
                          <div class="swiper-slide">
                            <div class="testimonial-item">
                              <div class="star-rating">
                                <?php
                                $rating_number = $row->feedback_rating;
                                for ($i = 0; $i < 5; $i++) {
                                ?>
                                  <span class="star <?php if ($i < $rating_number) echo 'filled'; ?>">&#9733;</span>
                                <?php
                                }
                                ?>
                              </div>
                              <p>
                                <?php echo $row->feedback; ?>
                              </p>
                              <div class="profile mt-auto">
                                <h3><?php echo $row->student_name; ?></h3>
                              </div>
                            </div>
                          </div>
                        <?php
                        }
                        ?>
                        <!-- End testimonial item -->

                      </div>
                      <div class="swiper-pagination"></div>
                    </div>

                  </div>

                </section>
              </div>

              <!-------------------Student Feedback Section End-------------------------->




            </div>

            <!------###############################----2nd Row End------------------>
            </div>
          </div>
          <!------Main Content End here----------------------------------------------->
      </div><!----Main row end------>
    </div> <!-----COntainer End-------------->
  </section>
  <!-- End Blog Section -->
  <!--------------------------------------------->

</main>
<?= $this->endSection() ?>


<?= $this->section('custom-script') ?>
<script type="text/javascript">
  $(document).ready(function() {

    $('.course_add_to_cart').click(function() {

      var course_id = $(this).data("course_id");
      var student_session_id = $(this).data("student_session_id"); // if session id != "" then already loged in
      let requestUrl = '<?= base_url("student/manage-cart") ?>';

      $.ajax({
          type: "GET",
          url: requestUrl,
          data: {
            course_id: course_id,
          },
          dataType: 'json',
        })
        .done(function(data) {

          let cartView = '<?= base_url("student/cart-view") ?>'

          if (data == 1 && student_session_id != "") {
            window.location.replace(cartView);
          } else if (data == 1 && student_session_id == "") {
            window.location = "<?= base_url("student/login/course-buy") ?>";
            //window.location.replace(login);
          } else if (data == 2) {
            Toastify({
              text: "Item Already Exists in cart!",
              duration: 2000
            }).showToast();
          }
        });


    });


    ///////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////////////////

    // Gets the video src from the data-src on each button

    var $videoSrc;
    $('.video-btn').click(function() {
      $videoSrc = $(this).data("src");
    });
    // console.log($videoSrc);

    // when the modal is opened autoplay it  
    $('#myModal').on('shown.bs.modal', function(e) {
      // console.log($videoSrc.trim());
      // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
      if ($videoSrc.trim() != "#") {
        $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
        $("#no_video").hide();
        $("#video").show();
      } else {
        $("#video").hide();
        $("#no_video").show();
      }

    })

    // stop playing the youtube video when I close the modal
    $('#myModal').on('hide.bs.modal', function(e) {
      // a poor man's stop video
      $("#video").attr('src', $videoSrc);
    })

    // document ready  
  });

  function genericSocialShare(url) {
    window.open(url, 'sharer', 'toolbar=0,status=0,width=648,height=395');
    return true;
  }

  ///////Social Media//////////////////////////
  $('#demo').socialSharingPlugin({
    url: window.location.href,
    title: $('meta[property="og:title"]').attr('content'),
    description: $('meta[property="og:description"]').attr('content'),
    img: $('meta[property="og:image"]').attr('content'),
    enable: ['facebook', 'linkedin', 'email', 'whatsapp']
  });
</script>
<?= $this->endSection() ?>


<?= $this->section('custom-style') ?>
<style type="text/css">
  .h5,
  h5 {
    font-size: 1rem !important;
  }

  .modal-dialog {
    max-width: 800px;
    margin: 30px auto;
  }

  .modal-body {
    position: relative;
    padding: 0px;
  }

  .btn-close {
    position: absolute;
    right: 10px;
    top: 10px;
    border: 1px solid red;
    background-color: #fff;
    z-index: 1700;
  }

  /* .entry {
  margin-bottom: 0px !important;
}

.blog .entry-single {
  margin-bottom: 5px !important;
} */

  .star-rating {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .star {
    font-size: 2rem;
    color: #ccc;
  }

  .star.filled {
    color: #f0a500;
  }

</style>
<?= $this->endSection() ?>