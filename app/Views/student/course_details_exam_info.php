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
								  <div class="col-md-3">
								        <a href="<?php
													if (isset($_SESSION['student_id'])) {
														echo site_url('exam/question-set-exam-start') . '/' . $row->exam_setup_id;
													} else {
														echo site_url('student/login') . '/' . "exam";
													} ?>" class="btn btn-outline-info"> পরীক্ষা দিন
										  </a>
								  </div>
							  </div>
						  <?php } ?>
					  </div>