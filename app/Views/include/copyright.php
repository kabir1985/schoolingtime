<?= $this->extend('homepage/layout') ?>

<?= $this->section('content') ?>

<style>
/* ===== Modern Corporate Legal Page ===== */

.legal-page{
    background: linear-gradient(135deg, #f4f7fb, #eef2f7);
    min-height: 100vh;
}

.legal-card{
    background: #ffffff;
    border-radius: 16px;
    padding: 45px 50px;
    box-shadow: 0 18px 45px rgba(0,0,0,0.08);
    position: relative;
    overflow: hidden;
}

/* Top gradient bar */
.legal-card::before{
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    height: 6px;
    width: 100%;
    background: linear-gradient(90deg, #0099cc, #00d4b1);
}

/* Watermark */
.legal-card::after{
    content: "SchoolingTime";
    position: absolute;
    bottom: 20px;
    right: 30px;
    font-size: 70px;
    font-weight: 800;
    color: rgba(0,0,0,0.03);
    pointer-events: none;
}

.legal-title{
    font-weight: 700;
    color: #2d3436;
}

.legal-subtitle{
    font-size: 15px;
    color: #636e72;
}

.legal-content{
    font-family: 'Noto Sans Bengali', kalpurush, sans-serif;
    font-size: 16px;
    line-height: 1.9;
    color: #2d3436;
}

.legal-content ul{
    margin-left: 20px;
}

.legal-content li{
    margin-bottom: 8px;
}

.legal-content strong{
    color: #0099cc;
}

/* Mobile */
@media (max-width: 768px){
    .legal-card{
        padding: 25px;
    }

    .legal-card::after{
        font-size: 42px;
        right: 15px;
    }

    .legal-content{
        font-size: 14.8px;
    }
}
</style>

<main id="main" class="legal-page py-5">
    <section class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="legal-card">

                    <h4 class="legal-title mb-2">
                        বাংলাদেশ কপিরাইট আইন ও ডিজিটাল নিরাপত্তা আইন অনুযায়ী
                    </h4>
                    <h5 class="legal-subtitle mb-4">
                        SchoolingTime-এর শর্তাবলী
                    </h5>

                    <div class="legal-content">

                        এই ওয়েবসাইটে প্রকাশিত সকল কনটেন্ট (টেক্সট, ছবি, অডিও, ভিডিও,
                        গ্রাফিক্স, লোগো, ডিজাইন, সোর্স কোড ও HTML কোডসহ)
                        <strong>SchoolingTime</strong> কর্তৃক কপিরাইট সুরক্ষিত।
                        বাংলাদেশ কপিরাইট আইন, ২০০০ (সংশোধিত) এবং
                        ডিজিটাল নিরাপত্তা আইন, ২০১৮ অনুযায়ী সকল অধিকার সংরক্ষিত।
                        <br><br>

                        <strong>SchoolingTime-এর পূর্বানুমতি ব্যতীত</strong>
                        এই ওয়েবসাইটের কোনো তথ্য বা কনটেন্ট সম্পূর্ণ বা আংশিকভাবে—
                        <br><br>

                        <ul>
                            <li>কপি করা</li>
                            <li>পুনরুৎপাদন করা</li>
                            <li>সংরক্ষণ করা</li>
                            <li>প্রকাশ করা</li>
                            <li>সম্প্রচার বা প্রেরণ করা</li>
                            <li>বাণিজ্যিক বা অ-বাণিজ্যিক উদ্দেশ্যে ব্যবহার করা</li>
                        </ul>

                        <br>
                        <strong>আইনত দণ্ডনীয় অপরাধ হিসেবে গণ্য হবে।</strong>
                        <br><br>

                        যেকোনো অননুমোদিত ব্যবহার, নকল বা অপব্যবহারের ক্ষেত্রে
                        <strong>SchoolingTime</strong> আইনগত ব্যবস্থা গ্রহণের পূর্ণ
                        অধিকার সংরক্ষণ করে।

                    </div>

                </div>

            </div>
        </div>
    </section>
</main>

<?= $this->endSection() ?>
