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
                    <!-- Display error message if available -->
                    <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                    <?php endif; ?>

                    <form action="<?php echo site_url('teacher/create') ?>" method="post">
                        <?= csrf_field() ?>



                        <div class="mb-3 row">
                            <label for="teacher_name" class="col-sm-2 col-form-label">Teacher Name</label>
                            <div class="col-sm-10">
                                <input type="hidden" name="form_type" value="teacher">
                                <input type="text" name="teacher_name" id="teacher_name" class="form-control"
                                    required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="teacher_email" class="form-control" id="email" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="teacher_mobile" class="col-sm-2 col-form-label"> Mobile</label>
                            <div class="col-sm-10">
                                <input type="text" name="teacher_mobile" class="form-control" id="teacher_mobile" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="teacher_password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="teacher_password" class="form-control" id="teacher_password">
                            </div>
                        </div>

<!-- 
                        <div class="mb-3 row">
                            <label for="TEST" class="col-sm-2 col-form-label">TEST</label>
                            <div class="col-sm-10">
                                <input type="TEST" class="form-control" id="TEST">
                            </div>
                        </div> -->



                        <!-- Captcha question -->
                        <div class="form-row">
                            <label class="form-group captcha-label"><?= esc($captchaQuestion) ?></label>
                            <input type="text" name="captcha" class="form-control" placeholder="Your Answer" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group mb-2">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck2"
                                            required>
                                        <label class="form-check-label" for="invalidCheck2">
                                            <small>By clicking Submit, you agree to our Terms & Conditions, Visitor
                                                Agreement and Privacy Policy.</small>
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