<?= $this->extend('homepage/layout') ?>

<?= $this->section('content') ?>
<main id="main" class="pt-5">
    <section class="testimonial py-5">
      <div class="container">
        <div class="row text-muted mb-3">
          <div class="col text-center">
            <h2>৪ সহজ ধাপ =  একাডেমিক লক্ষ্য অর্জন</h2>
            <hr>
          </div>
        </div>
        <div class="row ">
          <div class="col-md-3">
            <h5>১/ একাউন্ট তিরী </h5>
          </div>
          <div class="col-md-3">
          <h5>২/ কোর্স এনরোল</h5>
          </div>
          <div class="col-md-4">
          <h5>৩/ লার্ন এন্ড প্র্যাকটিস যেকোন সময়</h5>
          </div>
          <div class="col-md-2">
          <h5>৩/ লক্ষ্য অর্জন</h5>
          </div>
        </div>
      </div>
    </section>

  </main>
  <?= $this->endSection() ?>

  <?= $this->section('custom-style') ?>
  <style type="text/css">
    img {
      width: 100%;
    }
  </style>
  <?= $this->endSection() ?>