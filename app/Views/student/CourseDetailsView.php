<?= $this->extend('homepage/layout') ?>

<?= $this->section('page_title') ?>
<?php echo $metaData['title'] . "-বিস্তারিত..."; ?>
<?= $this->endSection() ?>

<?php
$this->section('meta_data');

if (isset($metaData)) {
?>

  <meta property="og:url" content="<?= $metaData['url'] ?>" />
  <meta property="og:title" content="<?= $metaData['title'] ?>" />
  <meta property="og:description" content="<?= $metaData['description'] ?>" />
  <meta property="og:image" content="<?= $metaData['image'] ?>" />
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

            //print_r($course_info);
           // exit();

            if (isset($course_info)) {
            $course_title =  esc($course_info->coures_title);
            $course_id = esc($course_info->course_id);
            $course_teacher_id = esc($course_info->course_teacher_id);
            $what_will_learn = esc($course_info->what_you_will_learn);
           // $course_start_date = esc($course_info->course_start_date);
            $course_price = esc($course_info->course_price);
            $demo_class_link = esc($course_info->demo_class_link);
            // $course_schedule = $course_info->course_schedule;
            $course_note = esc($course_info->course_note);
             }
//echo $course_id;
//exit();

            // In CodeIgniter 4, the esc() function is used to escape potentially harmful characters in strings to prevent XSS (Cross-Site Scripting) attacks
            ?>
            <div class="container">
              <!-----------------------------1st Row Start----------------------------->
              <div class="row">
                <div class="col-lg-8 entries">
                  <?php include_once("course_details_left_contain.php"); ?>
                </div>
                <div class="col-lg-4">
                  <?php include_once("course_details_sidebar.php"); ?>
                </div>
              </div>
              <!-----------------------------1st Row End----------------------------->
              <!----------------------------2nd Row Start--------------------------------->
              <!------------------Student Feedback Section Start----------------------------->
              <div class="row">
                <?php include_once("course_details_student_feedback.php"); ?>
              </div>
              <!-------------------Student Feedback Section End-------------------------->
            </div>
            <!-------------------------------2nd Row End------------------------------------>
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



    $('.socialJS a i').addClass('fa-2x');

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
    enable: ['facebook', 'linkedin', 'whatsapp']
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

  .fa-2x {
    font-size: 1.2em !important;
  }

  .btn-close {
    position: absolute;
    right: 10px;
    top: 10px;
    border: 1px solid red;
    background-color: #fff;
    z-index: 1700;
  }

  .entry {
    margin-bottom: 0px !important;
  }

  .blog .entry-single {
    margin-bottom: 5px !important;
  }

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