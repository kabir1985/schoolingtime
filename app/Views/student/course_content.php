               <style type="text/css">
                 .h5,
                 h5 {
                   font-size: 1rem;
                 }
               </style>

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
                             <!----------------------FAQ ------------------------->
                           <section id="faq" class="faq">

                             <div class="container" data-aos="fade-up">
                               <div class="row">
                                 <div class="col-lg-12">
                                   <!-- F.A.Q List 1-->

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
                                              $query = $db->query("SELECT video_title, video_link FROM  course_content 
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
                                                     <button type="button" class="btn btn-secondary btn-sm video-btn" data-bs-toggle="modal" data-src="<?php echo $row->video_link; ?>" data-bs-target="#myModal">
                                                       <i class="fa fa-play-circle">Video</i>
                                                     </button>
                                                   </div>

                                                   <div class="col-md-1">
                                                     <p><i class='fas fa-lock'></i></p>
                                                   </div>
                                                 </div>
                                               <?php
                                                  $i++;
                                                } else //if course content not video then 
                                                {
                                                ?>
                                                 <div class="row">
                                                   <div class="col-md-12 mb-2">
                                                     <span style="background-color: #3c4852; color: white" class="numberCircle"><?php echo $i; ?></span>

                                                     <?php echo $row->video_title . ":"; ?>
                                                   </div>
                                                 </div>

                                                 <div class="row">
                                                   <div class="col-md-1"></div>
                                                   <div class="col-md-11"><?php echo $row->video_link; ?></div>
                                                 </div>

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
                                                 <div class="col-md-10">
                                                   <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
                                                     <g fill="#37474f">
                                                       <path d="M9 20h30v13H9z" />
                                                       <ellipse cx="24" cy="33" rx="15" ry="6" />
                                                     </g>
                                                     <path fill="#78909c" d="M23.1 8.2L.6 18.1c-.8.4-.8 1.5 0 1.9l22.5 9.9c.6.2 1.2.2 1.8 0L47.4 20c.8-.4.8-1.5 0-1.9L24.9 8.2c-.6-.3-1.2-.3-1.8 0" />
                                                     <g fill="#37474f">
                                                       <path d="m43.2 20.4l-20-3.4c-.5-.1-1.1.3-1.2.8c-.1.5.3 1.1.8 1.2L42 22.2V37c0 .6.4 1 1 1s1-.4 1-1V21.4c0-.5-.4-.9-.8-1" />
                                                       <circle cx="43" cy="37" r="2" />
                                                       <path d="M46 40c0 1.7-3 6-3 6s-3-4.3-3-6s1.3-3 3-3s3 1.3 3 3" />
                                                     </g>
                                                   </svg>

                                                   <a href="<?php
                                                            echo site_url('exam/question-set-exam-start') . '/' . $row->exam_setup_id; ?>" class="btn btn-outline-secondary btn-sm ">
                                                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 32 32">
                                                       <path fill="black" d="M16 3c-1.26 0-2.152.89-2.594 2H6v23h20V5h-7.406C18.152 3.89 17.26 3 16 3m0 2c.555 0 1 .445 1 1v1h3v2h-8V7h3V6c0-.555.445-1 1-1M8 7h2v4h12V7h2v19H8z" />
                                                     </svg>
                                                     <?php echo $row->exam_name . isset($_SESSION['student_id']) . " |  পরীক্ষা দিন"; ?></a>
                                                 </div>
                                                 <div class="col-md-2"></div>
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
                           <!----------------------FAQ END--------------------------->
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


                         <!---------------------------Exam ----------------------------------->

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
                         <!------------------------------------------------------------------------------------------>

                         <!---------------------------Course Question-------------------------------------------------------->
                         <div class="tab-pane container fade mt-3" id="question">

                           <div class="cotainter">
                             <div class="row">
                               <div class="col-4"></div>
                               <div class="col-8"></div>
                             </div>
                           </div>

                         </div>
                         <!-------------------------------------------------------------------------------------------------->

                       </div>

                   </div>
                 </div>
               </div>