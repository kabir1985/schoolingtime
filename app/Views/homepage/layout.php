<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="h5NSzUiTH8keQ6RIkdjd2suswHofrFjAlVTCZ9rag8A" />
    <title><?= $this->renderSection('page_title', true) ?></title>
    <meta name="description" content="SchoolingTime is the best e-learning platform in Bangladesh. Offering skill development course, academic course, language course and programming course through online.">
    <meta name="keywords" content="online edu, e-Learning, digital education, edtech, online school, one-stop learning, remote learning, bangladesh, school, elearning course, digital edu, online training, spoken English, programming, hand writing, online drawing, French Language, Math, BCS, skill development, be skill, exam, question,  LMS, Classroom, Online Class, Online Classroom, Online Video Course, Online Coaching, Live Coaching, Remote Learning">
    <meta name="author" content="schoolingtime.com">

    <?= $this->renderSection('meta_data', true) ?>

    <!-- Favicons -->
    <link href="homepage_assets/img/favicon.png" rel="icon">
    <link href="homepage_assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Style Zone -->
    <?= $this->include("include/homepage_header_css"); ?>
    <?= $this->renderSection('custom-style') ?>


</head>

<body>
    <!-- Content Zone -->
    <div class="container-fluid px-0">
        <?= $this->include("include/homepage_header_top_nav"); ?>
        <?= $this->renderSection('content') ?>
    </div>

    <div class="container-fluid px-0 ">
        <?= $this->include("include/homepage_footer_content");?>
    </div>

    <!-- Script Zone -->
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>-->
    <?= $this->include("include/homepage_footer_js"); ?>
    <?= $this->renderSection('custom-script') ?>
    <!--RenderSection can only be called from a layout page.--> 
</body>

</html>
