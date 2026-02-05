<?=$this->extend('homepage/layout')?>

<?=$this->section('content')?>
<main id="main" class="my-5">
    <!------------------------------------------------>
    <?php echo $this->include("teacher/teacherDashboard_menu"); ?>
    <div class="col-lg-9 entries">
        <!-----##########################This is content space which will change in every page-##################################-------------->

        <div class="container bg-light " data-aos="fade-up">
            <header class="section-header" style="padding-bottom: 2px !important;">
                <p>প্রশ্নের সেট তৈরী করুন এখানে</p>
                <hr>
            </header>
        </div>

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3"> বিষয় নির্বাচন করুন</div>
            <div class="col-md-7">
                <select class="form-select" name="exam_name_id" id="exam_name_id" aria-label="Default select example">
                    <option selected disabled>Please Select Subject</option>
                    <?php
foreach ($exam_setup_info as $row) {
    ?>
                    <option data-course_id=<?php echo $row->exam_setup_id; ?>>
                        <?php echo $row->coures_title . "--->" . $row->exam_name; ?></option>
                    <?php
}
?>
                </select>
            </div>
            <div class="col-md-1"></div>
        </div>

        <div class="row mt-2">
            <div class="col-md-1"></div>
            <div class="col-md-3"><label for="course_level" class="form-label">সেট নির্বাচন করুন :</label></div>
            <div class="col-md-7">
                <select class="form-select" name="question_set_name" id="question_set_name"
                    aria-label="Default select example">
                    <option selected disabled>Please Select Question Set</option>
                    <?php

                  $db = \Config\Database::connect();
                  $builder = $db->table('question_set_setup');
                  $results = $builder->get()->getResult();

                  foreach ($results as $row) {

                      ?>
                    <option data-question_set_id=<?=$row->question_set_id;?>><?=$row->question_set_title;?>
                    </option>
                    <?php
                      }
                      ?>
                </select>
            </div>
            <div class="col-md-1"></div>
        </div>

        <!--------------------------------------------------------------------------------------------------------->

        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="questionDataTable">
                                <thead>
                                    <tr>
                                        <th style="display: none;">ID</th>
                                        <th style="width: 90% !important;">Question Title</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary click_checkbox"
                style="background-color: #465FAB !important;">Submit</button>
        </div>

        <!--------------------------------------------------------------------------------------------------------->

    </div>
    <!-- End Blog Section -->
    <!----------------------------------------------->

</main>
<?=$this->endSection()?>

<?=$this->section('custom-script')?>
<script type="text/javascript">
$(document).ready(function() {

    $('.form-select').on("change", function() {

        var course_id = $("#exam_name_id option:selected").attr('data-course_id');
        var question_set_id = $("#question_set_name option:selected").attr('data-question_set_id');

        var question_insert_url = "<?=site_url('/exam/question-set-creation')?>";

        var targetTable = $('#questionDataTable').DataTable({
            paging: false,
            scrollY: "500px",
            scrollCollapse: true,
            "bDestroy": true,

            ajax: {
                url: question_insert_url,
                type: "POST",
                data: {
                    course_id: course_id,
                    question_set_id: question_set_id
                },
                dataSrc: 'results'
            },
            columns: [{
                    data: 'question_bank_id'
                },
                {
                    data: 'question_title'
                },
                {
                    data: 'is_exist'
                }
            ],
            columnDefs: [{
                    targets: [0],
                    visible: false
                },
                {
                    render: (data, type, row) => '<input  ' + ((data == '1') ? 'checked' :
                            '') + ' type="checkbox"  value="' + row.question_bank_id +
                        '" />',
                    targets: 2
                },
            ]
        });

    });

    // -----------------------------
    // Click submit with front-end validation
    // -----------------------------
    $('.click_checkbox').on('click', function() {

        var course_id = $("#exam_name_id option:selected").attr('data-course_id');
        var question_set_id = $("#question_set_name option:selected").attr('data-question_set_id');

        if (!course_id) {
            alert("দয়া করে বিষয় নির্বাচন করুন!");
            return false;
        }

        if (!question_set_id) {
            alert("দয়া করে সেট নির্বাচন করুন!");
            return false;
        }

        var question_id_array = [];
        $.each($('#questionDataTable :checkbox:checked'), function() {
            question_id_array.push(this.value);
        });

        if (question_id_array.length === 0) {
            alert("দয়া করে অন্তত একটি প্রশ্ন সিলেক্ট করুন!");
            return false;
        }

        // AJAX POST
        $.post('<?=site_url("/exam/question-insert-into-set");?>', {
                id: question_id_array,
                question_set_id,
                course_id,
            })
            .done(function(data) {
                alert("চমৎকার : " + data);
                location.reload();
            });
    });

});
</script>
<?=$this->endSection()?>
