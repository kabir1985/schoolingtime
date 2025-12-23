            <div class="sidebar">
              <h3 class="sidebar-title"> <a href="<?php echo site_url('student/dashboard'); ?>">Go Dashboard <i class="bi bi-arrow-right"></i></a></h3>
              <hr>
              <div class="sidebar-item categories">
                <p><b><i class="bi bi-arrow-return-right"></i>&nbsp;ভর্তি পরীক্ষা</b></p>
                <ul>
                  <?php
                  $db = \Config\Database::connect();
                  $query = $db->query("SELECT course_category.course_category_name, course_category.course_category_id 
                                    From course_category
                                    LEFT JOIN course_section 
                                    ON course_section.course_section_id = course_category.course_section_id
                                    WHERE course_section.course_section_name = 'Exam_Course'");
                  $exam_category = $query->getResult();
                  foreach ($exam_category as $row) {
                  ?>
                    <li>
                      <a href="<?php echo site_url('exam/question-show-subject-wise') . '/' . $row->course_category_id; ?>"><i class="bi bi-chevron-right"></i><?php echo $row->course_category_name; ?> <span class="float-end"></span></a>
                    </li>
                  <?php
                  } ?>
                </ul>
              </div>



              <div class="sidebar-item categories">
                <p><b><i class="bi bi-arrow-return-right"></i>&nbsp;একাডেমিক পরীক্ষা</b></p>
                <ul>
                  <?php
                  $db = \Config\Database::connect();
                  $query = $db->query("SELECT course_category.course_category_name, course_category.course_category_id 
                                    From course_category
                                    LEFT JOIN course_section 
                                    ON course_section.course_section_id = course_category.course_section_id
                                    WHERE course_section.course_section_name = 'Academic_Course'");
                  $exam_category = $query->getResult();
                  foreach ($exam_category as $row) {
                  ?>
                    <li>
                      <a href="<?php echo site_url('exam/question-show-subject-wise') . '/' . $row->course_category_id; ?>"><i class="bi bi-chevron-right"></i><?php echo $row->course_category_name; ?> <span class="float-end"></span></a>
                    </li>
                  <?php
                  } ?>
                </ul>
              </div>


              <div class="sidebar-item categories">
                <p><b><i class="bi bi-arrow-return-right"></i>&nbsp;স্কিল ডেভেলপ পরীক্ষা</b></p>
                <ul>
                  <?php
                  $db = \Config\Database::connect();
                  $query = $db->query("SELECT course_category.course_category_name, course_category.course_category_id 
                                    From course_category
                                    LEFT JOIN course_section 
                                    ON course_section.course_section_id = course_category.course_section_id
                                    WHERE course_section.course_section_name = 'Skill_Development'");
                  $exam_category = $query->getResult();
                  foreach ($exam_category as $row) {
                  ?>
                    <li>
                      <a href="<?php echo site_url('exam/question-show-subject-wise') . '/' . $row->course_category_id; ?>"><i class="bi bi-chevron-right"></i><?php echo $row->course_category_name; ?> <span class="float-end"></span></a>
                    </li>
                  <?php
                  } ?>
                </ul>
              </div>

            </div>