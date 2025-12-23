<div class="sidebar sidbar_fixed">
  <!-------------Join Course-------------------------------------->
  <div class="sidebar-title">
    <!--------------------------Add to cart option -------------------------------------------->
    <button type="button" class="btn btn-secondary video-btn" data-bs-toggle="modal" data-src="<?php echo $demo_class_link; ?>" data-bs-target="#myModal" style="width: 100%;">
      <i class="bi bi-youtube">&nbsp;কোর্সের ডেমো ভিডিও</i>
    </button>
    <!------------------------------------------->
  </div>
  <!-------------Join Course-------------------------------------->
  <div class="sidebar-title">
    <a data-course_id="<?php echo $course_id; ?>" data-student_session_id="<?php echo isset($_SESSION['student_id']); ?>" class="course_add_to_cart btn btn-info" style="width: 100%; background-color:#465FAB !important; color:white !important;">কোর্সে ভর্তির জন্য ক্লিক করুন</a>
  </div>
  <!------------------------------------------------------------->
  <div class="sidebar-title">
    <a class="btn btn-outline-danger btn-sm" style="width: 100%;"><?= "কোর্স ফি ".convertToBangla($course_price) . " টাকা"; ?></a>
  </div>
 
  <h3 class="sidebar-title">কোর্সে আরো পাবেন:</h3>
  <div class="sidebar-item categories">
    <ul>
      <li>
        <a href="#"><i class="fa fa-chevron-right" aria-hidden="true"></i>&nbsp;
          <?php if (!empty($course_info->course_duration)): ?>
            <?= esc($course_info->course_duration); ?>
        </a>
      </li>
    <?php endif; ?>
    <li><a href="#"><i class="fa fa-chevron-right" aria-hidden="true"></i> &nbsp;
        <?php if (!empty($course_info->live_class)): ?>
          <?= esc($course_info->live_class); ?>
        <?php endif; ?>
      </a>
    </li>

    <li><a href="#"><i class="fa fa-chevron-right" aria-hidden="true"></i> &nbsp;
        <?php if (!empty($course_info->course_exam)): ?>
          <?= esc($course_info->course_exam); ?>
        <?php endif; ?>
      </a>
    </li>

    <li><a href="#"><i class="fa fa-chevron-right" aria-hidden="true"></i> &nbsp;
        <?php if (!empty($course_info->course_model_test)): ?>
          <?= esc($course_info->course_model_test); ?>
        <?php endif; ?>
      </a>
    </li>

    <li><a href="#"><i class="fa fa-chevron-right" aria-hidden="true"></i> &nbsp;
        <?php if (!empty($course_info->class_time)): ?>
          <?= esc($course_info->class_time); ?>
        <?php endif; ?>
      </a>
    </li>
    </ul>
  </div><!-- End sidebar tags-->
  <h3 class="sidebar-title"> কোর্সটি শেয়ার করুন</h3>
  <div class="sidebar-item tags">
    <ul>
      <li>
        <div id="demo"></div>
      </li>
    </ul>
  </div><!-- End sidebar tags-->
  <!----------------------------------------------->
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
  </div>
  <!-------------------------------------------------->
</div><!-- End sidebar -->
