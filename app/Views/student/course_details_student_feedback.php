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
                      </div>
                      <div class="swiper-pagination"></div>
                    </div>
                  </div>
                </section>