<?php echo $this->include("include/homepage_header"); ?>

<main id="main" class="mt-5">

    <section id="blog" class="blog">
        <div class="container-fluid">

            <div class="row">
                <!------Left Menu------------------------------------------------------------------->
                <div class="col-lg-3">
                <?php echo $this->include("student/student_dashboard_left_menu"); ?>
                </div>
                <!----------Left Menu End------------------------------------------------------------------------------->

                <!--##################Content Area-#############################################---------->
                <div class="col-lg-9 bg-light entries">
                    <article class="entry">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-border">
                                    <thead>
                                        <tr>
                                            <th>Question Title</th>
                                            <th>Your Answer </th>
                                            <th>Right Answer</th>
                                            <th>Result</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($exam_result_info as $row) {

                                            $db = \Config\Database::connect();
                                            $query = $db->query("SELECT * FROM question_bank
                                            WHERE id = '$row->question_id' ");
                                            $result = $query->getRow();

                                            $query1 = $db->query("SELECT * FROM question_option
                                             WHERE  question_answer_id = '$row->your_answer_id' ");
                                            $data = $query1->getRow();

                                            $right_ans_query = $db->query("SELECT * From question_option
                                            Where question_id = '$row->question_id' AND correct_answer = '1' ");
                                            $data11 = $right_ans_query->getRow();
                                        ?>
                                            <tr>
                                                <td><?= $result->question_title; ?></td>
                                                <td><?= $data->question_option; ?></td>
                                                <td><?= $data11->question_option; ?></td>
                                                <?php if ($data->question_option == $data11->question_option) { ?>
                                                    <td><i class="bi bi-check2" style="color:green;"></i></td>
                                                <?php } else { ?>
                                                    <td><i class="bi bi-x-lg" style="color:red;"></i></td>
                                                <?php } ?>

                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                            </div>
                            <!-- <div class="col-md-3" style=" border-left: 2px solid green; height: 150px;">
                                Your Score: 2/10 <br>
                                Total Questions: <br>
                                Correct: <br>
                                Incorrect: <br>
                            </div> -->
                        </div>
                    </article>

                </div>
                <!---#################Content Area end##################################--------------->

            </div>

        </div>
    </section>

</main>
<!-- End #main -->

<!-- ======= Footer ======= -->

<footer id="footer" class="footer">
    <?php //echo $this->include("include/homepage_newsletter"); 
    ?>

    <?php echo $this->include("include/homepage_footer"); ?>

</footer><!-- End Footer -->