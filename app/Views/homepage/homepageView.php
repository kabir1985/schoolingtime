  <?= $this->extend('homepage/layout') ?>

  <?= $this->section('page_title') ?>
  SchoolingTime - Online Learning Platform in Bangladesh.
  <?= $this->endSection() ?>


  <?= $this->section('content') ?>

  <main id="main" class="container-fluid p-0">
    <!-- ======= About Section ======= -->
    <?php include_once("part/about.php"); ?>
    <!-- End About Section -->

    <!-- ======= Course Section ======= -->
    <?php include_once("part/course.php"); ?>
    <!-- End About Section -->

    <!-- ======= Count Section ======= -->
    <?php include_once("part/count.php"); ?>
    <!-- End About Section -->

    <!-- ======= Count Section ======= -->
    <?php include_once("part/faq.php"); ?>
    <!-- End About Section -->
  </main>

  <?= $this->endSection() ?>