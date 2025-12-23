  <?php echo $this->include("include/homepage_header"); ?>

  <main id="main" class="mt-5">

    <section id="blog" class="blog">
      <div class="container-fluid">

        <div class="row">
          <!------Left Menu------------------------------------------------------------------->
          <div class="col-lg-3">
          <?php echo $this->include("examsystem/exam_category_left_menu_view"); ?>
          </div>
          <!----------Left Menu End------------------------------------------------------------------------------->
          <!--##################Content Area-#############################################---------->
          <div class="col-lg-9 bg-light entries">
            <article class="entry">
              <div class="row">

                <?php
                foreach ($question_set as $row) {
                ?>
                  <div class="col-3">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title"><?php echo $row->coures_title; ?></h5>
                        <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
                        <!-- <a href="#" class="btn btn-info">Button</a> -->
                        <a href="<?php echo site_url('exam/questionsetshow') . '/' . $row->course_id; ?>" class="btn btn-outline-info justify-content-center readmore stretched-link mt-auto"><span>পরীক্ষা হলে প্রবেশ</span></a>
                      </div>
                    </div>
                  </div>
                <?php } ?>

              </div>
            </article>

          </div>
          <!---#################Content Area end##################################--------------->

        </div>

      </div>
    </section>

  </main>
  <!-- End #main -->




  <!-- ======= Footer ======= -->

  <footer id="footer" class="footer">
    <?php //echo $this->include("include/homepage_newsletter"); 
    ?>

    <?php echo $this->include("include/homepage_footer"); ?>

  </footer><!-- End Footer -->