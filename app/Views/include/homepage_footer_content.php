<style>
  #showMoreBtn {
    display: inline-block;
    /* Make the button fit its content */
    margin: 5px auto;
    /* Add a bit of margin */
    padding: 5px 10px;
    /* Smaller padding for a compact look */
    background-color: #f9f9f9;
    /* Light background color */
    color: #333;
    /* Darker text color for contrast */
    border: 1px solid #ccc;
    /* Light border */
    border-radius: 4px;
    /* Slightly rounded corners */
    cursor: pointer;
    /* Pointer cursor on hover */
    font-size: 14px;
    /* Smaller font size */
    transition: background-color 0.3s ease, color 0.3s ease;
    /* Smooth transitions */
  }

  #showMoreBtn:hover {
    background-color: #eaeaea;
    /* Slightly darker on hover */
    color: #000;
    /* Darker text on hover */
  }

  #showMoreBtn:focus {
    outline: none;
    /* Remove default focus outline */
  }

  #showMoreBtn:active {
    background-color: #dcdcdc;
    /* Darker shade on click */
    transform: scale(0.96);
    /* Slightly shrink on click */
  }


  #showMoreCompanyBtn {
    display: inline-block;
    margin: 10px 0;
    padding: 5px 10px;
    background-color: #f1f1f1;
    color: #555;
    border: 1px solid #ccc;
    border-radius: 3px;
    cursor: pointer;
    font-size: 13px;
    transition: background-color 0.3s ease, color 0.3s ease;
  }

  #showMoreCompanyBtn:hover {
    background-color: #e0e0e0;
    color: #333;
  }

  #showMoreCompanyBtn:focus {
    outline: none;
  }

  #showMoreCompanyBtn:active {
    background-color: #d0d0d0;
    transform: scale(0.98);
  }
</style>
<footer id="footer" class="footer">
  <div class="footer-top">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-info">
          <a href="<?php echo site_url('/') ?>" class="logo d-flex align-items-center">
            <!-- <img src="homepage_assets/img/logo.png" alt=""> -->
            <span class="mb-2">SchoolingTime</span>
          </a>
          <p style="text-align: justify;">
            পৃথিবীর যেকোন প্রান্তে বসে ইন্টারনেটের কল্যাণে ভিডিও রেকর্ডিং কোর্স, সরাসরি কোচিং ক্লাস, কুইজ , ভাষা কোর্স, ফ্রিল্যান্সিং জব ইত্যাদির মাধ্যমে
            নিজেকে একুশ শতকের চ্যালেঞ্জ মোকাবেলার যোগ্য নাগরিক হিসেবে গড়ে তোলার প্রত্যয়ে স্কুলিং টাইমের সংগেই থাকুন। নিজেকে প্রতিষ্ঠার মাধ্যমে অন্যদের থেকে এগিয়ে থাকুন।
          </p>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>কোর্সসমূহ</h4>
          <ul id="categoryList">
            <?php
            $db = \Config\Database::connect();
            $query = $db->query("SELECT course_category_name, course_category_id FROM course_category");
            $results = $query->getResult();
            $counter = 0;
            foreach ($results as $row) {
              $counter++;
            ?>
              <li class="category-item" <?php if ($counter > 3) echo 'style="display: none;"'; ?>>
                <i class="bi bi-chevron-right" style="color:#000;"></i>
                <a href="<?php echo site_url('course-show-categorywise') . '/' . $row->course_category_id; ?>">
                  <?php echo $row->course_category_name; ?>
                </a>
              </li>
            <?php } ?>
          </ul>
          <button id="showMoreBtn">আরও কোর্স দেখুন</button>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>কোম্পানি</h4>
          <ul id="companyList">
            <!-- <li><i class="bi bi-chevron-right" style="color:#000;"></i> <a href="#">ব্লগ সেকশন</a></li> -->
            <li class="company-item"><i class="bi bi-chevron-right" style="color:#000;"></i> <a href="<?php echo site_url('student/student-guide'); ?>">স্টুডেন্ট নির্দেশিকা</a></li>
            <li class="company-item"><i class="bi bi-chevron-right" style="color:#000;"></i> <a href="<?php echo site_url('teacher/login-view'); ?>">শিক্ষক লগইন</a></li>
            <li class="company-item"><i class="bi bi-chevron-right" style="color:#000;"></i> <a href="<?php echo site_url('teacher/register'); ?>">শিক্ষক রেজিস্ট্রেশন</a></li>
            <!-- <li><i class="bi bi-chevron-right"></i> <a href="<?php echo site_url('/affiliate') ?>">অ্যাফিলিয়েট হতে চাইলে</a></li> -->
            <li class="company-item" style="display: none;"><i class="bi bi-chevron-right" style="color:#000;"></i> <a href="<?php echo site_url('teacher/teacher-guide'); ?>">শিক্ষক নির্দেশিকা</a></li>
            <li class="company-item" style="display: none;"><i class="bi bi-chevron-right" style="color:#000;"></i> <a href="<?php echo site_url('copyright'); ?>">কপিরাইট</a></li>
            <!-- <li><i class="bi bi-chevron-right"></i><a href="#">ব্যবহারকারীর শর্তাবলি</a></li> -->
          </ul>
          <button id="showMoreCompanyBtn">আরও দেখুন...</button>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>যোগাযোগ</h4>
          <p>
            <b>মোবাইল</b>: ০১৯১৩ ৬৯ ১১ ৮৫ <br>
            <b>হোয়াটসঅ্যাপ</b>: ০১৯১৩ ৬৯ ১১ ৮৫ <br>
            <b>ইমেইল</b>: SchoolingTimeinfo@gmail.com<br>
          </p>
          <div class="social-links mt-3">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="https://www.facebook.com/schoolingtime" class="facebook" target="_blank"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            <a href="https://www.youtube.com/@SchoolingTime" class="youtube" target="_blank"><i class="bi bi-youtube"></i></a>
          </div>

        </div>

      </div>
    </div>
  </div>

  <div class="container">
    <div class="copyright">
      &copy; Copyright <strong><span>SchoolingTime</span></strong>. All Rights Reserved
    </div>
    <!-- <div class="credits">
        Designed by <a href="#">Kabir</a>
      </div> -->
  </div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $("#showMoreBtn").click(function() {
      $(".category-item").slideDown(); // Show all hidden items
      $(this).hide(); // Hide the Show More button
    });


    $("#showMoreCompanyBtn").click(function() {
      $(".company-item").slideDown(); // Show all hidden company items
      $(this).hide(); // Hide the Show More button
    });

  });
</script>