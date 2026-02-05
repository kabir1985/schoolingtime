<?= $this->extend('homepage/layout') ?>

<?= $this->section('content') ?>
<main id="main" class="my-5">

    <!------Left Menu--------------->
    <?php echo $this->include("teacher/teacherDashboard_menu"); ?>
    <!-------------------------------->

    <div class="col-lg-9 entries">
        <!---------------------------------------------------------------------------->
        <section style="background-color: #eee;">
            <div class="container py-2">
                <!-- <div class="row">
          <div class="col">
            <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
              <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item active" aria-current="page"><?php echo "Welcome To " . $_SESSION['name'] . "  at Teacher Dashboard"; ?></li>
              </ol>
            </nav>
          </div>
        </div> -->

                <div class="row">
                    <div class="col-lg-12 bg-success ">
                        <div class="card  m-1">
                            <ul class="list-group list-group-flush">
                            <?php
                            $course_ids = [];   // ✅ MUST initialize
                            foreach($myCourse as $course)
                            {
                                $course_ids[] = $course->course_id; // ✅ correct
                            ?>
                                <li class="list-group-item d-flex justify-content-center">
                                    <h5><?php echo $course->coures_title; ?></h5>
                                </li>
                                <?php
                            }

                                                 // Remove duplicates if needed
                    $course_ids = array_unique($course_ids);

                    // Store in session
                    $_SESSION['course_ids'] = $course_ids;

                    // echo "<pre>";
                    // print_r($_SESSION['course_ids']);
                    // echo "</pre>";
                    // exit();
                ?>
                            </ul>
                        </div>
                    </div>
                </div>



                <div class="row my-1">
                    <div class="col-lg-4">
                        <?php
            foreach ($results as $row) {
            }
            ?>
                        <div class="card mb-2">
                            <div class="card-body text-center">
                                <img src="<?= base_url() ?>/public/TeacherUploads/<?= $row->teacher_pic; ?>"
                                    alt="teacher" class="rounded-circle img-fluid" style="width: 150px;">
                                <h5 class="my-3"><?php echo $_SESSION['name']; ?>
                                </h5>
                                <div class="d-flex justify-content-center mb-2">
                                    <a type="button" href="<?php echo site_url('/teacher/profile') ?>"
                                        class="btn btn-primary btn-sm">Profile Update</a>
                                    <!-- <button type="button" class="btn btn-outline-primary ms-1">Message</button> -->
                                </div>
                                <h5 style="color: tomato;">আপনার প্রোফাইল আপডেট করা থাকলে কোর্স তিরীর সুযোগ পাবেন</h5>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-8">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="mb-0"><b>কোর্স</b></p>
                                    </div>
                                    <div class="col-sm-3">
                                        <p class="text-muted mb-0"><b>ছাত্র-ছাত্রী</b></p>
                                    </div>
                                    <div class="col-sm-3">
                                        <p class="text-muted mb-0"><b>বিস্তারিত</b></p>
                                    </div>
                                </div>
                                <hr>


                                <?php
                               
                foreach ($student_list_show as $row) {
                  //echo "Student ID".$row['selected_student_id'];
                  $course_id = $row['course_id'];
                             ?>
                                <?php
                  $db = \Config\Database::connect();
                  $query   = $db->query("SELECT * FROM  teacher_course WHERE course_id = '$course_id'");
                  $results = $query->getResult();
                  ?>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="mb-0"><?php echo $results[0]->coures_title; ?></p>
                                    </div>
                                    <div class="col-sm-3">
                                        <p class="text-muted mb-0"><?php echo $row['Course_enrolled_student_number']; ?>
                                        </p>
                                    </div>
                                    <div class="col-sm-3">
                                        <p class="mb-1">
                                            <button type="button" data-course_id=<?php echo $course_id; ?>
                                                class="btn btn-outline-secondary btn-sm details-button">
                                                View</button>
                                        </p>
                                    </div>
                                </div>
                                <hr>

                                <?php }
                                                               
                                ?>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- //////////////////////////////////////////////////// -->
                <style> li {color:green !important;}</style>
                    <div><h2>শিক্ষক এর জন্য নির্দেশনা</h2></div>
                    <ol class="list-group list-group-numbered">
                    <li class="list-group-item">
                        শিক্ষক লগইন করার পর প্রথমে --> প্রোফাইল সেটআপ --> কোর্স তৈরি করুন-->ব্যাচ তৈরি করুন
                    </li>
                    <li class="list-group-item">
                        ওয়েবসাইট এডমিন কে কল করে তিরী করা কোর্স পাবলিশ করে নিতে হবে।
                    </li>
                    <li class="list-group-item">
                        কোর্স পাবলিশ হওয়ার পর অন্যান্য মেনুগুলো কাজ করবে
                    </li>
                    </ol>

                  <!-- //////////////////////////////////////////////////////// -->
            </div>
        </section>





        <!---------------------------------------------------------------------------->

    </div><!-- End blog entries list -->


    </div>

    </div>
    </section><!-- End Blog Section -->


    <!--################# Modal Boby######################################-->
    <!-- The Modal -->
    <div class="modal fade" id="modaldatashow" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Enrolled Student List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Batch ID</th>
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>City</th>
                                    <th>Edu Level</th>
                                    <th>Last Edu</th>
                                </tr>
                            </thead>
                            <tbody id="result_data">
                                <!-- Dynamic rows from AJAX/PHP -->
                            </tbody>
                        </table>
                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!---##################################################################-->




</main><!-- End #main -->
<?= $this->endSection() ?>

<?= $this->section('custom-script') ?>
<script type="text/javascript">
$(document).ready(function() {
    // get Edit Product
    $('.details-button').on('click', function() {
        // get data from button edit
        const course_id = $(this).data('course_id');
        $.post('<?= site_url("/teacher/course-enrolled") ?>', {
                id: course_id
            })
            .done(function(data) {
                $("#result_data").html(data);
                $('#modaldatashow').modal('show');
            });
    });
});
</script>
<?= $this->endSection() ?>