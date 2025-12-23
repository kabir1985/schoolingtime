<?= $this->extend('homepage/layout') ?>

<?= $this->section('content') ?>
<main id="main" class="pt-1">
    <!-- Section: Design Block -->
    <section>
        <!-- Jumbotron -->
        <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
            <div class="container">
                <div class="row gx-lg-5 align-items-center">
                    <div class="col-lg-6 mb-0 mb-lg-0">
                        <h3 class="mb-4 display-6 fw-bold ls-tight">
                            এখানে রেজিস্ট্রেশন করার মাধ্যমে <br />
                            <span class="text-primary"> অনলাইন শিক্ষাসেবা গ্রহন করুন।</span>
                        </h3>
                        <hr>
                        <p style="color: hsl(217, 10%, 50.8%); text-align:justify;">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                            বাংলা ভাষায় নির্মিত একটি অনলাইন লার্নিং প্ল্যাটফর্ম, শিক্ষার্থীরা এখানে রেজিস্ট্রেশন এর মাধ্যমে যে কোন সময় যে কোন জায়গায় বসে আমাদের শিক্ষা সেবা গ্রহণ পারবে। আমাদের সাথে থাকার জন্য আপনাকে অনেক ধন্যবাদ।
                        </p>
                        <p style="color: hsl(217, 10%, 50.8%); text-align:justify;">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                            পৃথিবীর যেকোন প্রান্তে বসে ইন্টারনেটের কল্যাণে ভিডিও রেকর্ডিং কোর্স, সরাসরি কোচিং ক্লাস, কুইজ, ভাষা কোর্স, ফ্রিল্যান্সিং জব ইত্যাদির মাধ্যমে নিজেকে একুশ শতকের চ্যালেঞ্জ মোকাবেলার যোগ্য নাগরিক হিসেবে গড়ে তোলার প্রত্যয়ে স্কুলিং টাইমের সংগেই থাকুন। নিজেকে প্রতিষ্ঠার মাধ্যমে অন্যদের থেকে এগিয়ে থাকুন।
                        </p>
                    </div>

                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="card">
                            <div class="card-body py-5 px-md-5">
                                <!-- Display error message if available -->
                                <?php if (session()->getFlashdata('error')): ?>
                                    <div class="alert alert-danger">
                                        <?= session()->getFlashdata('error') ?>
                                    </div>
                                <?php endif; ?>

                                <form action="<?php echo site_url('student/registration-insert') ?>" method="post">
                                    <!-- Name input -->
                                    <div class="form-outline mb-2">
                                        <input type="text" name="name" minlength="4" class="form-control" placeholder="Your Name" required>
                                    </div>
                                    <!-- Email input -->
                                    <div class="form-outline mb-2">
                                        <input type="email" class="form-control" name="email" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" title="Input Valid Email Address" placeholder="Your Email">
                                    </div>
                                    <!-- Mobile input -->
                                    <div class="form-outline mb-2">
                                        <input type="text" class="form-control" minlength="10" name="mobile" placeholder="Your Mobile" required>
                                    </div>

                                    <!-- Password input -->
                                    <div class="form-outline mb-2">
                                        <input type="password" class="form-control" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Your Password">
                                    </div>

                                    <!-- Captcha question -->
                                    <div class="form-outline mb-2">
                                        <label class="captcha-label"><?= esc($captchaQuestion) ?></label>
                                        <input type="text" name="captcha" class="form-control" placeholder="Your Answer" required>
                                    </div>

                                    <div class="form-group my-2">
                                        <button type="submit" class="btn btn-info form-control" style="color:white;">
                                            <i class="fa fa-user-plus"></i> Student Registration
                                        </button>
                                    </div>
                                </form>
                                <div class="text-center">
                                    <p>Already have an account? <a href="<?php echo site_url('student/login'); ?>">Login here</a></p>
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
<style type="text/css">
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

    /* Custom styles for captcha label */
    .captcha-label {
        background-color: #EEEDEB; /* Set background color to green */
        color: tomato; /* Optional: change text color for better contrast */
        padding: 8px; /* Add some padding */
        width: 100%; /* Make the label width 100% */
        display: block; /* Ensures the label behaves like a block element */
        border-radius: 4px; /* Optional: add rounded corners */
    }
</style>
<?= $this->endSection() ?>
