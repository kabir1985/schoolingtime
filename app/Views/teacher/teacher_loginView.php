<?= $this->extend('homepage/layout') ?>

<?= $this->section('content') ?>
<main id="main">
  <section id="contact" class="contact my-5">

    <div class="container" data-aos="fade-up">

      <header class="section-header">
        <p>শিক্ষক লগইন</p>
      </header>

      <div class="row gy-4">

        <div class="col-lg-6">

          <div class="row gy-4">
            <div class="col-md-12">
              <div class="info-box">
                <!-- <i class="bi bi-clock"></i> -->
                <h3>আপনি যে বিষয়ে অভিজ্ঞ সেটা শেয়ার করুণ, আমরা আপনাকে পেমেন্টের বিষয়ে নিশ্চয়তা দিচ্ছি।</h3>
                <p>SchoolingTime helps creators engage their online audiences and get paid on
                  their own terms with video courses, online coaching, note sale content</p>
              </div>
            </div>
          </div>

        </div>

        <div class="col-lg-6 bg-light pt-5">
          <form action="<?php echo site_url('/teacher/login') ?>" method="get" accept-charset="utf-8">
            <div class="row gy-4">

              <div class="col-md-12 ">
                <input type="email" class="form-control" name="teacher_email" placeholder="Your Email" required>
              </div>
              <div class="col-md-12 ">
                <input type="password" class="form-control" name="teacher_password" placeholder="Your Password" required>
              </div>

              <!-- <div class="col-md-12">
            <input type="text" class="form-control" name="subject" placeholder="Subject" required>
          </div> -->

              <div class="col-md-12 text-center">
                <!--<button type="submit">Send Message</button>-->
                <button type="submit" class="btn btn-primary">Login</button>
                <a href="<?php echo site_url('teacher/register'); ?>"> <button type="button" class="btn btn-warning">Sign Up</button></a>
          </form>

        </div>

      </div>


    </div>

    </div>

    </div>

  </section>
</main>
<?= $this->endSection() ?>