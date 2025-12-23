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

                <div class="col-lg-9 entries">

                    <!-----##########################This is content space which will change in every page-##################################-------------->

                    <div class="container bg-light " data-aos="fade-up">
                        <header class="section-header" style="padding-bottom: 2px !important;">
                            <p><?php echo isset($_SESSION['student_name']) ?> Profile Update </p>
                            <hr>
                        </header>


                        <form action="<?php echo site_url('student/profile-update') ?>" method="post" class="was-validated" accept-charset="utf-8" enctype="multipart/form-data">

                            <div class="row">
                                <!-- <input type="text" id="stu_profile_id" name="stu_profile_id" placeholder="<?php //echo $_SESSION['student_id'];
                                                                                                                ?>" value="<?php echo $_SESSION['student_id']; ?>" hidden> -->
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label for="stu_date_of_birth" class="form-label">Date of Birth:</label>
                                        <input type="text" class="form-control" id="stu_date_of_birth" value="<?php echo $results->stu_date_of_birth; ?>" name="stu_date_of_birth" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="stu_present_edu_level" class="form-label">Present Education Level/Class:</label>
                                        <input type="text" class="form-control" id="stu_present_edu_level" value="<?php echo $results->stu_edu_level_class; ?>" name="stu_present_edu_level" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="stu_last_current_edu_institute" class="form-label">Current/Last Educational Institute Name:</label>
                                        <input type="text" class="form-control" id="stu_last_current_edu_institute" value="<?php echo $results->stu_last_edu_institute; ?>" name="stu_last_current_edu_institute" required>
                                    </div>

                                    <div class="mb-2">
                                        <label for="stu_male_female" class="form-label">Male/Female:</label>
                                        <input type="text" class="form-control" id="stu_male_female" value="<?php echo $results->stu_male_female; ?>" name="stu_male_female" required>
                                    </div>

                                    <div class="mb-2">
                                        <label for="stu_pic" class="form-label">Profile Picture:</label>
                                        <input type="file" class="form-control" name="file" id="file" required>
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="mb-2">
                                        <label for="stu_bangla_english_medium" class="form-label">BanglaEnglish Medium:</label>
                                        <input type="text" class="form-control" id="stu_bangla_english_medium" value="<?php echo $results->stu_bangla_english_medium; ?>" name="stu_bangla_english_medium" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="stu_city" class="form-label">City:</label>
                                        <input type="text" class="form-control" id="stu_city" value="<?php echo $results->stu_city; ?>" name="stu_city" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="stu_guardian_name" class="form-label">Guardian Name:</label>
                                        <input type="text" class="form-control" id="stu_guardian_name" value="<?php echo $results->stu_guirdian_name; ?>" name="stu_guardian_name" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="stu_guardian_mobile" class="form-label">Guardian Mobile:</label>
                                        <input type="text" class="form-control" id="stu_guardian_mobile" value="<?php echo $results->stu_guirdian_mobile; ?>" name="stu_guardian_mobile" required>
                                    </div>

                                    <div class="mb-2">
                                        <label for="stu_address" class="form-label">Address:</label>
                                        <input type="text" class="form-control" id="stu_address" value="<?php echo $results->stu_guirdian_address; ?>" name="stu_address" required>
                                    </div>


                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="term_condition" name="term_condition" required>
                                        <label class="form-check-label" for="myCheck">I agree on Term & Condition.</label>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Check this checkbox to continue.</div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>

                        </form>

                    </div>

                    <!-----##########################This is content space which will change in every page-##################################-------------->




                </div><!-- End blog entries list -->
            </div>
        </div>
    </section>
</main>

<?= $this->endSection() ?>