<?= $this->extend('homepage/layout') ?>

<?= $this->section('content') ?>
  <main id="main" class="pt-5">
    <section class="testimonial py-5">
      <div class="container">
        <div class="row ">
          <div class="col-md-4 py-5 bg-secondary text-white text-center ">
            <div class=" ">
              <div class="card-body">
                <img src="<?= base_url() ?>/homepage_assets/img/teacher_registration.png" style="width:40%">
                <h2 class="py-3">শিক্ষক রেজিস্ট্রেশন</h2>
                <p> স্কুলিং টাইম এ শিক্ষক হওয়ার মাধ্যমে দেশ সেবায় অংশ নিন।

                </p>
              </div>
            </div>
          </div>
          <div class="col-md-8 py-5 border">
            <h4 class="pb-4">শিক্ষক হওয়ার জন্য বিস্তারিত তথ্য প্রদান করুন</h4>
            <form action="<?php echo site_url('teacher/create') ?>" method="get">
              <div class="form-row">
                <div class="form-group col-md-12 mb-2">
                  <input type="text" name="teacher_name" class="form-control" placeholder="Teacher's Name" required>
                </div>
                <div class="form-group col-md-12 mb-2">
                  <input type="email" class="form-control" name="teacher_email" placeholder="Teacher's Email" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-12 mb-2">
                  <input type="text" class="form-control" name="teacher_mobile" placeholder="Teacehr's Mobile" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-12 mb-2">
                  <input type="password" class="form-control" name="teacher_password" placeholder="Teacher's Password" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group mb-2">
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                      <label class="form-check-label" for="invalidCheck2">
                        <small>By clicking Submit, you agree to our Terms & Conditions, Visitor Agreement and Privacy Policy.</small>
                      </label>
                    </div>
                  </div>

                </div>
              </div>

              <div class="form-row">
                <button type="submit" class="btn btn-danger">Submit</button>
              </div>
            </form>
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