<?= $this->extend('homepage/layout') ?>

<?= $this->section('content') ?>
<main id="main" class="my-5">
    <!-- ======= content Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <!------Left Menu Column---------------------------------------->
                <div class="col-lg-3">
                    <?php echo $this->include("student/student_dashboard_left_menu"); ?>
                </div>
                <!----------Left Menu Column End----------------------------------------->
                <div class="col-lg-9">
                    <!------------------Content area--------------------------------------------->
                    <section style="background-color: #eee;">
                        <div class="container py-2">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-1">
                                                </div>
                                                <div class="col-sm-10">
                                                    <h6 class="mb-0">আপনার অংশগ্রহণ করা পরীক্ষার ফলাফল দেখুন</h6>
                                                    <hr>
                                                    <table class="table table-hover">
                                                        <tr>
                                                            <th>Exam Setup id</th>
                                                            <th>Exam name</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                        <?php foreach ($results  as $result): ?>
                                                            <tr>
                                                                <td><?= $result->exam_setup_id; ?></td>
                                                                <td><?= $result->exam_name; ?></td>
                                                                <td>
                                                                    <a href="<?= site_url('exam/report-generate/' . $result->exam_setup_id."/".$result->student_id); ?>" target="_blank">রেজাল্ট দেখুন</a>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </table>
                                                </div>
                                                <div class="col-sm-1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!---------------------------------------------------------------------------->
                </div><!-- End blog entries list -->
            </div>
        </div>
    </section><!-- End Blog Section -->
    <!--------------------------------------------->
</main>
<?= $this->endSection() ?>

<?= $this->section('custom-script') ?>

<?= $this->endSection() ?>

<?= $this->section('custom-style') ?>

<?= $this->endSection() ?>