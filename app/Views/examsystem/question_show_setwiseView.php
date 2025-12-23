<?= $this->extend('homepage/layout') ?>

<?= $this->section('content') ?>
  <main id="main" class="mt-5">

    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-3">
          <?php echo $this->include("examsystem/exam_category_left_menu_view"); ?>
          </div><!-- End first column -->

          <div class="col-lg-9 bg-light entries">

            <article class="entry">

              <div class="row">

                <?php
                foreach ($question_set_show as $row) {
                ?>
                  <div class="col-3">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title"><?php echo $row->exam_name; ?></h5>
                        <p class="card-text">Time:<?php echo $row->exam_duration;?></p>
                        <p class="card-text">Questions:<?php echo $row->total_question;?></p>
                        <!-- <a href="#" class="btn btn-info">Button</a> -->
                        <a href="<?php echo site_url('exam/question-set-exam-start').'/'. $row->exam_setup_id ; ?>" class="btn btn-outline-info justify-content-center readmore stretched-link mt-auto"><span>পরীক্ষার সেট বাছাই</span></a>
                      </div>
                    </div>
                  </div>
                <?php } ?>

              </div>

            </article>

            <!-- <article class="entry">
            <form method="post" action="<?php //echo site_url('exam/questionanswer');
                                        ?>">

            <div class="row">
         
                  <?php
                  //  $i=1;
                  // foreach($results as $row)
                  //{
                  // $question_id = $row['id'];
                  // $subject_id = $row['subject_id'];
                  // $question_title = $row['question_title'];

                  // $db = \Config\Database::connect();
                  // $query = $db->query("Select * FROM question_bank  Where question_id = '$question_id' ");
                  //$data = $query->getResult('array');

                  // echo $i++ .". ".$question_title."<hr>";

                  // echo '<fieldset class="col-6"  style="padding:10px"><legend>'.$i++ .': '.$question_title.'</legend><hr>';

                  // $opn = 0;
                  //  foreach($data as $num_rows)
                  // {

                  ?>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox"  name="question_answer[<?php //echo $question_id ;
                                                                                                ?>][<?php //echo $opn++ ;
                                                                                                    ?>]"
                                  >
                        <label class="form-check-label" for="flexCheckDefault">
                        <?php //echo $num_rows['question_option'];
                        ?>
                        </label>
                      </div>
                  

                  <?php
                  // }
                  // echo '</fieldset>';
                  // }
                  ?>
            </div>  

            </article>End blog entry -->

          </div>

          <!-- End blog entries list -->

          <!-- <button type="submit" class="btn btn-info">Submit Answer</button> -->
          <!-- </form> -->

        </div>

      </div>
    </section><!-- End Blog Section -->

  </main>
  <?= $this->endSection() ?>