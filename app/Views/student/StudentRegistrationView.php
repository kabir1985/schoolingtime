<?= $this->extend('homepage/layout') ?>

<?= $this->section('content') ?>
<main id="main" class="pt-1">
    <section>
        <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
            <div class="container">
                <div class="row gx-lg-5 align-items-left pt-2">

                    <!-- LEFT CONTENT -->
                    <div class="col-lg-6 mb-0 mb-lg-0">
                        <h3 class="mb-4 display-6 fw-bold ls-tight">
                            এখানে রেজিস্ট্রেশন করার মাধ্যমে <br />
                            <span class="text-primary"> অনলাইন শিক্ষাসেবা গ্রহন করুন।</span>
                        </h3>
                        <hr>
                        <p style="color: hsl(217, 10%, 50.8%); text-align:justify;">
                            <i class="fa fa-paper-plane"></i>
                            বাংলা ভাষায় নির্মিত একটি অনলাইন লার্নিং প্ল্যাটফর্ম, শিক্ষার্থীরা এখানে রেজিস্ট্রেশন এর মাধ্যমে যে কোন সময় যে কোন জায়গায় বসে আমাদের শিক্ষা সেবা গ্রহণ পারবে।
                        </p>
                        <p style="color: hsl(217, 10%, 50.8%); text-align:justify;">
                            <i class="fa fa-paper-plane"></i>
                            ভিডিও কোর্স, লাইভ ক্লাস, কুইজ ও আধুনিক শিক্ষাসেবার মাধ্যমে নিজেকে দক্ষ করে তুলুন।
                        </p>
                    </div>

                    <!-- RIGHT FORM -->
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <div class="card">
                            <div class="card-body py-5 px-md-5">

                                <!-- ERROR MESSAGE -->
                                <?php if (session()->getFlashdata('error')): ?>
                                    <div class="alert alert-danger">
                                        <?= session()->getFlashdata('error') ?>
                                    </div>
                                <?php endif; ?>

                                <form action="<?= site_url('student/registration-insert') ?>" method="post">

                                    <!-- NAME -->
                                    <div class="form-floating mb-2">
                                        <input type="text" class="form-control"
                                               id="name" name="name"
                                               minlength="4"
                                               placeholder="নাম লিখুন" required>
                                        <label for="name">নাম <span class="text-danger">*</span></label>
                                    </div>

                                    <!-- EMAIL -->
                                    <div class="form-floating mb-2">
                                        <input type="email" class="form-control"
                                               id="email" name="email"
                                               pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$"
                                               title="সঠিক ইমেইল ঠিকানা লিখুন"
                                               placeholder="ইমেইল লিখুন" required>
                                        <label for="email">ইমেইল ঠিকানা <span class="text-danger">*</span></label>
                                    </div>

                                    <!-- MOBILE -->
                                    <div class="form-floating mb-2">
                                        <input type="text" class="form-control"
                                               id="mobile" name="mobile"
                                               minlength="10"
                                               placeholder="মোবাইল নাম্বার লিখুন" required>
                                        <label for="mobile">মোবাইল নাম্বার <span class="text-danger">*</span></label>
                                    </div>

                                    <!-- PASSWORD -->
                                    <div class="form-floating mb-2">
                                        <input type="password" class="form-control"
                                               id="password" name="password"
                                               pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"
                                               title="কমপক্ষে ১টি বড়, ১টি ছোট হাতের অক্ষর ও সংখ্যা থাকতে হবে"
                                               placeholder="পাসওয়ার্ড লিখুন" required>
                                        <label for="password">পাসওয়ার্ড <span class="text-danger">*</span></label>
                                    </div>

                                    <!-- CAPTCHA -->
                                    <label class="captcha-label mb-1">
                                        <?= esc($captchaQuestion) ?> <span class="text-danger">*</span>
                                    </label>
                                    <div class="form-outline mb-3">
                                        <input type="text" name="captcha"
                                               class="form-control"
                                               placeholder="উত্তর লিখুন" required>
                                    </div>

                                    <!-- SUBMIT -->
                                    <div class="form-group my-2">
                                        <button type="submit" class="btn btn-info form-control text-white">
                                            <i class="fa fa-user-plus"></i> স্টুডেন্ট রেজিস্ট্রেশন
                                        </button>
                                    </div>
                                </form>

                                <div class="text-center">
                                    <p>আগেই একাউন্ট আছে?
                                        <a href="<?= site_url('student/login'); ?>">লগইন করুন</a>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</main>
<?= $this->endSection() ?>

<?= $this->section('custom-style') ?>
<style>
    .text-primary {
        color: #0099cc !important;
    }

    .form-floating label {
        font-size: 14px;
    }

    .captcha-label {
        background-color: #EEEDEB;
        color: tomato;
        padding: 8px;
        display: block;
        border-radius: 4px;
    }

    .text-danger {
        font-weight: bold;
    }

/* ===== Card Enhancement ===== */
.card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
}

/* ===== Headline Styling ===== */
h3 {
    line-height: 1.4;
}

/* ===== Paragraph Readability ===== */
p {
    font-size: 16px;
    line-height: 1.7;
}

/* ===== Floating Input Enhancement ===== */
.form-floating > .form-control {
    border-radius: 10px;
    border: 1px solid #ddd;
}

.form-floating > .form-control:focus {
    border-color: #0099cc;
    box-shadow: 0 0 0 0.15rem rgba(0, 153, 204, 0.25);
}

/* ===== Floating Label Color ===== */
.form-floating label {
    color: #6c757d;
}

.form-floating > .form-control:focus + label {
    color: #0099cc;
}

/* ===== Required Star Highlight ===== */
.text-danger {
    font-weight: bold;
    font-size: 14px;
}

/* ===== Button Upgrade ===== */
.btn-info {
    background: linear-gradient(135deg, #0099cc, #007fa6);
    border: none;
    border-radius: 10px;
    padding: 10px;
    font-size: 16px;
    transition: all 0.3s ease;
}

.btn-info:hover {
    background: linear-gradient(135deg, #007fa6, #006b8c);
    transform: translateY(-1px);
}

/* ===== Captcha Box Improvement ===== */
.captcha-label {
    font-size: 15px;
    background: linear-gradient(135deg, #f7f7f7, #ececec);
    border-left: 4px solid #0099cc;
}

/* ===== Mobile Optimization ===== */
@media (max-width: 768px) {
    .px-md-5 {
        padding-left: 1.5rem !important;
        padding-right: 1.5rem !important;
    }

    h3 {
        font-size: 26px;
    }
}


</style>
<?= $this->endSection() ?>
