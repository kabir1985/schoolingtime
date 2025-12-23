<?= $this->extend('homepage/layout') ?>

<?= $this->section('content') ?>
<main id="main" class="my-5">

  <!------------------------------------------------>
  <?php echo $this->include("teacher/teacherDashboard_menu"); ?>
  <div class="col-lg-9 entries">
    <!-----##########################This is content space which will change in every page-##################################-------------->
    <div class="container bg-light " data-aos="fade-up">
      <header class="section-header" style="padding-bottom: 2px !important;">
        <p>Add Questions</p>
        <hr>
      </header>
      <div class="container">
        <form autocomplete="off" id="questionbank_form" action="<?php echo site_url('exam/question-bank-insert') ?>" method="post">

          <div class="row mb-2">
            <div class="col-md-12">
              <select id="exam_name_id" class="form-select exam_name" name="exam_name_id" aria-label="Default select example" required>
                <option selected disabled value="">Please Select Exam Name</option>
                <?php
                foreach ($exam_info as $row) {
                  $exam_name = $row->exam_name;
                  $course_title = $row->coures_title;
                  $exam_setup_id = $row->exam_setup_id;
                  $total_question = $row->total_question;
                  $subject_chapter_id = $row->subject_chapter_id;
                ?>
                  <option data-noq="<?= $total_question ?>" value="<?php echo $exam_setup_id; ?>"><?php echo $course_title . "-->" . $exam_name . "-->" . $subject_chapter_id; ?></option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <table class="table table-bordered table-striped table-hover" id="dynamic_field">
                  <tr data-colid="0" class="parent_group">
                    <td colspan="2">


                      <div class="row mt-1">
                        <div class="col-3"><b>Question No: 1</b></div>
                        <div class="col-8">
                          <!-- Required -->
                          <input type="text" class="form-control question" name="item[0][question][] " placeholder="Main Question">
                        </div>
                        <div class="col-1"></div>



                        <div class="row mt-1">
                          <div class="option_group d-inline-flex">
                            <div class="col-3">
                              <div class="form-check form-switch">
                                <!-- Required -->
                                <input class="check_option_hidden" value="0" type="hidden" name="item[0][answers][]">
                                <!-- Required -->
                                <input class="form-check-input check_option" type="checkbox">
                                <label class="form-check-label" for="flexSwitchCheckDefault">is correct?</label>
                              </div>
                            </div>
                            <div class="col-8">
                              <!-- Required -->
                              <input type="text" name="item[0][option][]" class="form-control ans_item" placeholder="Question Choise">
                            </div>&nbsp;
                            <div class="col-1">
                              <button type="button" class="btn btn-sm btn-secondary add_chapter_row_child">
                                <i class='fas fa-plus-circle' style='font-size:20px'></i>
                              </button>
                            </div>
                          </div>
                        </div>
                    </td>

                    <td>
                      <button type="button" id="add" class="btn btn-success ">
                        <i class='fas fa-plus' style='font-size:24px'></i>
                      </button>
                    </td>

                  </tr>
                </table>

                <div class="row">
                  <div class="col-3"></div>
                  <div class="col-8"><input type="submit" class="btn btn-success" name="submit" id="submit" value="Submit">
                  </div>
                  <div class="col-1"></div>
                </div>
              </div>
            </div>
          </div>
        </form>

      </div>
      <!-----##########################This is content space which will change in every page-##################################-------------->
    </div><!-- End blog entries list -->
  </div>

  </div>
  <!-- End Blog Section -->
  <!----------------------------------------------->


</main>
<?= $this->endSection() ?>

<?= $this->section('custom-script') ?>
<script type="text/javascript">
  $(document).ready(function() {

    var questionLength = 0;
    $("#exam_name_id").on("change", function() {
      questionLength = parseInt($(this).find(':selected').attr('data-noq'));
    });


    var i = 1;
    var q_no = 2;

    $("#add").click(function() {

      var numberOfQuestionRows = $('#dynamic_field tr').length;

      if (numberOfQuestionRows < questionLength) {
        var newRow = '<tr data-colid="' + i + '" class="parent_group"><td colspan="2">' +
          '<div class="row mt-1"><div class="col-3"><b>Question No: ' + q_no + '</b>' +
          '</div><div class="col-8"><input type="text" name="item[' + i + '][question][]" class="form-control question" placeholder="Main Question 11"></div>' +
          '<div class="col-1"></div></div></div>' +
          '<div class="row mt-1"><div class="option_group d-inline-flex"><div class="col-3">' +
          '<div class="form-check form-switch">' +
          '<input class="check_option_hidden" value="0" type="hidden"  name="item[' + i + '][answers][]">' +
          '<input class="form-check-input check_option" type="checkbox" >' +
          '<label class="form-check-label" for="flexSwitchCheckDefault">is correct?</label>' +
          '</div></div>' +
          '<div class="col-8"><input type="text" name="item[' + i + '][option][]" class="form-control ans_item" placeholder="Question Choice"></div>&nbsp;' +
          '<div class="col-1"><button type="button" class="btn btn-sm btn-secondary add_chapter_row_child" ><i class="fas fa-plus-circle" style="font-size:20px"></i></button></div></div></div>' +
          '</td><td><button type="button"  class="btn btn-danger btn_remove remoeve_parent"><i class="far fa-trash-alt" style="font-size:24px"></i></button></td></tr>';
        i++;
        q_no++;

        $('#dynamic_field').append(newRow);
      }

    });

    $(document).on('click', '.remoeve_parent', function() {
      $(this).closest(".parent_group").remove();
    });

    $(document).on('click', '.delete_chapter_row_child', function() {
      $(this).parent().parent().parent().remove();
    });


    $(document).on('input', '.ans_item', function() {
      var answerText = $(this).val();
      if (answerText === null || answerText === "") {
        $(this).closest('.option_group').find('.check_option').prop('checked', false);
      }
    });


    $(document).on("change", ".check_option", function() {
      var cv = $(this).prev();
      var ischecked = $(this).prop('checked');
      cv.val(ischecked ? 1 : 0)
    });


    var questionListWithAnswer = [];

    function manageTableData() {
      questionListWithAnswer = [];
      var totalRows = $('#dynamic_field tr');

      $(totalRows).each(function(index, element) {
        let question = $(element).find('.question').val();
        let options = $(element).find('.option_group');

        let answerOption = []
        var isvalid = false;

        $(options).each(function(ind, opt) {
          let inputList = $(opt).find('input');
          if (inputList.length === 3) {

            let optionItem = {
              'isCorrect': $(inputList[0]).val(),
              'ansItem': $(inputList[2]).val()
            };

            if (question != "" && optionItem.isCorrect > 0) {
              if (!isvalid) {
                isvalid = true;
              }
            }
            answerOption.push(optionItem);
          }
        });

        var questionItem = {
          'question': question,
          'options': answerOption,
          'validate': isvalid
        }

        questionListWithAnswer.push(questionItem)
        answerOption = [];
      });
      isvalid = false;

      let response = questionListWithAnswer.map(item => {
        let questionValid = item.question != null && item.question !== "";
        let optionValid = item.options.some(option => option.isCorrect === "1" && option.ansItem != null && option.ansItem !== "");
        let validateFlag = item.validate;
        return questionValid && optionValid && validateFlag;
      });
      return response;
    }


    // $("#questionbank_form").submit(function(e) {
    $('#questionbank_form').on('submit', function(e) {


      $('#dynamic_field tr').removeClass("validationError");

      let validationResults = manageTableData();

      var questionRows = $('#dynamic_field tr');
      $(questionRows).each(function(index, element) {
        if (validationResults[index] == false) {
          $(element).addClass("validationError");
        }
      });

      let allValid = validationResults.every(item => item === true);


      if (allValid) {
        return true;
      } else {
        e.preventDefault();
      }

    });

    $(document).on('click', '.add_chapter_row_child', function() {
      var i = $(this).closest(".parent_group").data("colid");

      var questionChoiceAdd = '<div class="delete_child option_group"><div class="row mt-0 "><div class="col-11">' +
        '</div></div>' +
        '<div class="row mt-1 "><div class="col-3">' +
        '<div class="form-check form-switch">' +
        '<input class="check_option_hidden" value="0" type="hidden"  name="item[' + i + '][answers][]">' +
        '<input class="form-check-input check_option" type="checkbox" >' +
        '<label class="form-check-label" for="flexSwitchCheckDefault">is correct?</label>' +
        '</div>' +
        '</div><div class="col-8">' +
        '<input type="text" name="item[' + i + '][option][]" class="form-control ans_item" placeholder="Question Choice">' +
        '</div><div class="col-1"><button type="button" class="btn btn-sm btn-danger delete_chapter_row_child"><i class="far fa-trash-alt" style="font-size:24px"></i></button>' +
        '</div></div></div>';
      $(this).parent().parent().parent().append(questionChoiceAdd);
    });

  });
</script>
<?= $this->endSection() ?>