<div class="cotainter">
						<div class="row">
						<div class="col-4">
						<img src="<?= base_url() ?>/public/TeacherUploads/<?= esc($course_info->teacher_pic); ?>" alt="teacher" class="card-img">
						</div>
						<div class="col-8">
						<p class="card-text"><?php echo esc($course_info->teacher_edu_his) . "<br>";
									echo esc($course_info->last_educational_institute) . "<br>";
									echo esc($course_info->teacher_pro_his) . "<br>";
									echo esc($course_info->teacher_certi_award);
									?></p>
						<a href="#" class="btn btn-outline-secondary">View Profile</a>
						</div>
						</div>
					  </div>