<?= $this->extend('homepage/layout') ?>

<?= $this->section('content') ?>
<main id="main" class="pt-1">
  <!-- Section: Design Block -->
  <section>
    <!-- Jumbotron -->
    <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
      <div class="container">
        <div class="row gx-lg-5 align-items-center">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <h2 class="my-3 display-6 fw-bold ls-tight">
               নিজের উপর বিশ্বাস রাখ<br />
              <span class="text-primary">স্বপ্ন জয় তোমারই হবে</span>
            </h2>
            <p style="color: hsl(217, 10%, 50.8%); text-align:justify;">
            <i class="fa fa-paper-plane" aria-hidden="true"></i>
 তোমার জীবনের প্রতিটি ছোট ছোট ক্ষেত্রের বিশ্বাসকে একত্রিত করো। কাজ করার জন্য তোমার হৃদয়কে তৈরি করো এবং অন্যদের জীবনের সবচেয়ে ভালো দিকগুলো জানতে চেষ্টা করো।
             তোমার বিশেষ বৈশিষ্ট্য ও মূল্যবোধ, তোমার সততা, তোমার গোপনীয়তা—এগুলোকে কখনো নিঃশেষ হতে দিয়ো না।<br /><br />
             <i class="fa fa-paper-plane" aria-hidden="true"></i>
 'ভিন্নভাবে চিন্তা করার ও উদ্ভাবনের সাহস থাকতে হবে, অপরিচিত পথে চলার ও অসম্ভব জিনিস আবিষ্কারের সাহস থাকতে হবে এবং সমস্যাকে জয় করে সফল হতে হবে। এ সকল মহানগুণের দ্বারা তরুণদের চালিত হতে হবে।'
            </p>
          </div>

          <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="card">
              <div class="card-body py-5 px-md-5">
                <form action="<?php echo site_url('student/login-insert') ?>" method="get">

                  <!-- Email input -->
                  <div class="form-outline mb-2">
                    <input type="email" class="form-control" name="email" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" placeholder="Your Email" required>
                  </div>

                  <!-- Password input -->
                  <div class="form-outline mb-2">
                    <input type="password" class="form-control" name="password" placeholder="Your Password" required>
                  </div>
                  <!-- Checkbox -->
                  <!-- <div class="form-check d-flex justify-content-center mb-4">
                  <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33" checked />
                  <label class="form-check-label" for="form2Example33">
                    Subscribe to our newsletter
                  </label>
                </div> -->

                  <!-- Submit button -->
                  <div class="d-flex justify-content-center align-items-center">

                    <button type="submit" class="btn btn-primary btn-block align-self-center mb-3" style="background-color: #0099cc !important;">
                      Student Login
                    </button>
                  </div>
                </form>

                <div class="text-center">
                  <p>Don't have an account? <a href="<?php echo site_url('student/registration'); ?>">Register here</a></p>
                </div>


                <div class="divider d-flex align-items-center my-4">
                  <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
                </div>


                <div class="form-group my-2">
                  <a href="<?= site_url('googlelogin') ?>" class="google btn btn-danger form-control">
                    <i class="fab fa-google"></i> Login with Google Account
                  </a>
                </div>

              </div>
            </div>
          </div>
        </div>


      </div>
    </div>
    </div>
    <!-- Jumbotron -->
  </section>
  <!-- Section: Design Block -->

</main>
<?= $this->endSection() ?>

<?= $this->section('custom-style') ?>
<style type = "text/css">
  .divider:after,
  .divider:before {
    content: "";
    flex: 1;
    height: 1px;
    background: #eee;
  }

  .text-primary {
    color: #0099cc !important;
  }

  .py-5 {
    padding-bottom: 1rem !important;
  }
</style>
<?= $this->endSection() ?>