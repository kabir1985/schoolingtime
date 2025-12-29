<div class="sidebar sidbar_fixed">
  <!-------------Join Course-------------------------------------->
  <div class="sidebar-title">
    <!--------------------------Add to cart option -------------------------------------------->
    <button type="button" class="btn btn-info video-btn" style="width: 100%; background-color:#465FAB !important; color:white !important;" data-bs-toggle="modal" data-src="<?php echo $demo_class_link; ?>" data-bs-target="#myModal" style="width: 100%;">
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
  <div class="sidebar-item tags" style="padding-left: 25px;">
    <ul>
      <li>
        <div id="demo"></div>
      </li>
    </ul>
  </div><!-- End sidebar tags-->
  <!----------------------------------------------->
  <div class="sidebar-title">
    <h3 class="sidebar-title"> কমিউনিটিতে জয়েন করুন</h3>
    <div class="sidebar-item tags" style="padding-left: 25px;">
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

<style>

.video-btn {
    font-weight: 600;
    letter-spacing: 0.3px;
    border-radius: 12px;
    padding: 4px 10px;
    font-size: 15px;
    box-shadow: 0 6px 14px rgba(70, 95, 171, 0.25);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.video-btn i {
    font-size: 18px;
}

.video-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 22px rgba(70, 95, 171, 0.35);
    filter: brightness(1.1);
}

.video-btn:active {
    transform: scale(0.97);
    box-shadow: 0 4px 10px rgba(70, 95, 171, 0.2);
}
/* Keep list centered but text left aligned */
.sidebar-item.categories ul {
    padding-left: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.sidebar-item.categories li {
    list-style: none;
    width: 100%;
    margin-bottom: 8px;
    display: flex;
    justify-content: center;
}

/* Pill style but text left */
.sidebar-item.categories a {
    display: flex;
    align-items: center;
    justify-content: flex-start; /* left text */
    gap: 8px;
    padding: 8px 14px;
    width: 90%;
    background: #f5f7ff;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 500;
    color: #2c3e50;
    text-align: left; /* left text */
    transition: all 0.25s ease;
}

/* Icon */
.sidebar-item.categories i {
    font-size: 12px;
    color: #465FAB;
}

/* Hover effect */
.sidebar-item.categories a:hover {
    background: #465FAB;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(70,95,171,0.25);
}

.sidebar-item.categories a:hover i {
    color: #fff;
}
/* Smoky white hover effect */
.sidebar-item.categories a:hover {
    background: #f2f2f2; /* smoky white */
    color: #2c3e50;
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(0,0,0,0.08);
}

/* Icon color on hover */
.sidebar-item.categories a:hover i {
    color: #465FAB;
}

  </style>
