<?= $this->extend('homepage/layout') ?>

<?= $this->section('content') ?>
  <main id="main" class="pt-5">
    <section class="testimonial py-5">
      <div class="container">
        <div class="row text-muted mb-3">
          <div class="col text-center">
            <h2>কোর্স কিভাবে শুরু করবেন?</h2>
            <hr>
          </div>
        </div>
        <div class="row ">
          <div class="col-md-3">
            <h5>১/ কারিকুলাম প্ল্যান করুন </h5>
          </div>
          <div class="col-md-5">
          <h5>২/ ভিডিও রেকর্ডিং / লাইভ কোর্স রেডি করুন</h5>
          </div>
          <div class="col-md-4">
          <h5>৩/ কোর্স শুরু করুন</h5>
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
