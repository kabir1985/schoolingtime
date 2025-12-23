<?= $this->extend('homepage/layout') ?>

<?= $this->section('content') ?>
<main id="main" class="mt-5">
    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
        <div class="container">
            <div class="row">
                <!----------------Left menu Start---------------------------------------------->
                <div class="col-lg-3">
                    <?php echo $this->include("student/student_dashboard_left_menu"); ?>
                </div>
                <!------------------------Left menu End--------------------------------------------------->
                <div class="col-lg-9 bg-light entries">
                    <article class="entry">
                        <div class="row">
                            <div class="col-md-6 "></div>
                            <div class="col-md-6 bg-secondary text-white text-center p-1">
                                <div id="timer">Time Remaining: </div>
                            </div>
                        </div>
                        <div class="row">
                            <form id="question_form">
                                <?php
                                $exam_duration = 1;
                                $db = \Config\Database::connect();
                                $i = 1;
                                foreach ($show_question as $num_rows) {
                                    $subject_id = htmlspecialchars($num_rows->subject_id, ENT_QUOTES, 'UTF-8');
                                    $question_id = htmlspecialchars($num_rows->question_id, ENT_QUOTES, 'UTF-8');
                                    $exam_duration = htmlspecialchars($num_rows->exam_duration, ENT_QUOTES, 'UTF-8');
                                    $student_id = htmlspecialchars($num_rows->student_id, ENT_QUOTES, 'UTF-8');
                                    $question_set_id = htmlspecialchars($num_rows->question_set_id, ENT_QUOTES, 'UTF-8');
                                    $exam_status = htmlspecialchars($num_rows->status, ENT_QUOTES, 'UTF-8');

                                    // Prepared statements for security
                                    $query = $db->query("SELECT * FROM question_option WHERE question_id = ?", [$question_id]);
                                    $data = $query->getResult('array');

                                    $query1 = $db->query("SELECT question_title FROM question_bank WHERE id = ?", [$question_id]);
                                    $results = $query1->getRow();

                                    echo '<fieldset class="col-12" style="padding:10px"><legend>' . $i++ . ': ' . htmlspecialchars($results->question_title, ENT_QUOTES, 'UTF-8') . '</legend><hr>';
                                    echo '<input type="hidden" name="question_ids[]" value="' . $question_id . '">'; // <--- Added for unanswered question
                                    
                                    foreach ($data as $num_rows) {
                                        $correct_answer_0_OR_1 = htmlspecialchars($num_rows['correct_answer'], ENT_QUOTES, 'UTF-8');
                                        $question_right_answer = $correct_answer_0_OR_1 == 1 ? htmlspecialchars($num_rows['question_answer_id'], ENT_QUOTES, 'UTF-8') : "wrong-answer";
                                ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="question_answer[<?php echo $question_id; ?>][]" value="<?php echo htmlspecialchars($num_rows['question_answer_id'], ENT_QUOTES, 'UTF-8') . "," . $question_right_answer; ?>">
                                            <label class="form-check-label" for="question_answer[<?php echo $question_id; ?>][]">
                                                <?php
                                                $question_option_value = htmlspecialchars($num_rows['question_option'], ENT_QUOTES, 'UTF-8');
                                                echo $question_option_value;
                                                ?>
                                            </label>
                                        </div>
                                <?php
                                    }
                                    echo '</fieldset>';
                                }
                                ?>
                                <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
                                <input type="hidden" name="subject_id" value="<?php echo $subject_id; ?>">
                                <input type="hidden" name="exam_status" value="<?php echo $exam_status; ?>">
                                <input type="hidden" name="question_set_id" value="<?php echo $question_set_id; ?>">
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4"><button type="button" id="submit_button" class="btn btn-secondary">Submit Answer</button></div>
                            <div class="col-4"></div>
                        </div>
                        </form>
                    </article>
                </div>
            </div>
        </div>
    </section>
    <?php
    helper('uri');
    $parameter = service('request')->uri->getSegment(3);
    ?>
</main>
<?= $this->endSection() ?>


<?= $this->section('custom-script') ?>
<script type="text/javascript">
    const timerDisplay = document.getElementById('timer');
    const duration = <?= intval($exam_duration) * 60; ?>;

    // Check if initial time is stored in session storage, if not, set it to the duration

    var parameter = '<?= $parameter; ?>';
    var x = sessionStorage.getItem(parameter);
    if (x === null) {
        x = duration;
        sessionStorage.setItem(parameter, x);
    } else {
        x = parseInt(x); // Convert stored time to integer
    }

    function updateTimer() {
        if (x > 0) {
            x = x - 1;

            var minutes = Math.floor(x / 60);
            var seconds = x % 60;

            var te = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

            timerDisplay.textContent = "Time Remaining: " + te;
            sessionStorage.setItem(parameter, x); // Update the stored time
            setTimeout(updateTimer, 1000);
        } else {
            // Clear the initial time when timer reaches 0
            alert("Time is up!");
            sessionStorage.removeItem(parameter);
        }
    }
    updateTimer();
    $(document).ready(function() {
        $('#submit_button').on('click', function() {
        var answered = $('input[name^="question_answer"]:checked').length;
         if (answered === 0) 
           {
           alert("You must answer at least one question before submitting.");
           return; // Stop form submission
            }

            var formData = $('#question_form').serializeArray();
            var queryString = $.param(formData);
            $.ajax({
                type: 'POST',
                url: '<?= site_url("/exam/question-answer-insert"); ?>',
                data: queryString,
                dataType: 'json',
                success: function(response) {
                   // if (response.status) {
                        alert(response.status);
                        setTimeout(function() { window.location.href = '<?= site_url("student/dashboard"); ?>'; }, 1000);
                    //} else {
                       // alert('Failed to submit answers: ' + response.status);
                   // }
                },
                error: function(xhr, status, error) {
                    // Handle any errors
                    console.error(xhr);
                    alert('An error occurred while submitting your answers.');
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>