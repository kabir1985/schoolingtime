<section id="testimonials" class="testimonials">

<div class="container" data-aos="fade-up">

  <header class="section-header">
    <!-- <h2>Testimonials</h2> -->
    <p>কোর্স সম্পর্কে শিক্ষার্থীদের মন্তব্য</p>
  </header>

  <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="200">
    <div class="swiper-wrapper">
      <?php
      //$db = \Config\Database::connect();
      $query = $db->query("SELECT * FROM  course_feedback Where teacher_course_id = '$course_teacher_id' ");
      $coursefeedbackList = $query->getResult();


      //   $stmt = $db->query("SELECT feedback_rating FROM course_feedback WHERE feedback_rating IN (1, 2, 3, 4, 5)");
      //   $ratings = $stmt->getResult();
      //   if (count($ratings) > 0) {
      //     $average = array_sum($ratings) / count($ratings);
      //     echo "Average Feedback Score: " . round($average, 2);
      // } else {
      //     echo "No feedback scores available.";
      // }




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
              <!-- <img src="homepage_assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt=""> -->
              <h3><?php echo $row->student_name; ?></h3>
              <!-- <h4>Ceo &amp; Founder</h4> -->
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