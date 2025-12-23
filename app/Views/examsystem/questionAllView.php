<?= $this->extend('homepage/layout') ?>

<?= $this->section('content') ?>
  <main id="main" class="mt-5">

    <section id="blog" class="blog">
      <div class="container">

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
                Welcome Dashboard
              </div>
            </article>

          </div>
          <!---#################Content Area end##################################--------------->

        </div>

      </div>
    </section>

  </main>
  <?= $this->endSection() ?>
