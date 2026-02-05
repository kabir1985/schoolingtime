<?= $this->extend('homepage/layout') ?>

<?= $this->section('content') ?>
 <main id="main" class="my-5">
   <!------------------------------------------------>
   <?php echo $this->include("teacher/teacherDashboard_menu"); ?>
   <div class="col-lg-9 entries">
     <!-----##########################This is content space which will change in every page-##################################-------------->
     <div class="container bg-light " data-aos="fade-up">
       <header class="section-header" style="padding-bottom: 2px !important;">
         <p>Course Include/ কোর্সে আরো পাবেন Creation</p>
         <hr>
       </header>
       <div class="container">
         <form action="<?php echo site_url('teacher/course-include-insert') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
           <div class="row mb-2">
             <div class="col-md-1"></div>

             <div class="col-md-10">
               <select class="form-select select_course" name="course_id" aria-label="Default select example" required>
                 <option selected disabled>Please Select Course</option>
                 <?php
                  foreach ($results as $row) {
                    $course_id = $row->course_id;
                    $coures_title = $row->coures_title;
                  ?>
                   <option value="<?php echo $course_id; ?>"><?php echo $coures_title; ?></option>
                 <?php
                  }
                  ?>
               </select>
             </div>
             <div class="col-md-1"></div>
           </div>
           <div class="row">
             <div class="col-md-1"></div>
             <div class="col-md-10 ">
               <div class="form-group">
                 <table class="table table-bordered table-hover">
                   <tr>
                     <td colspan="2">
                       <div class="row mt-2">
                         <div class="col-4">Course Duration</div>
                         <div class="col-8"><input type="text" class="form-control" name="course_duration" placeholder="Example: কোর্সের মেয়াদ ৪ মাস" required></div>
                       </div>
                       <div class="row mt-2">
                         <div class="col-4">Number of Live Class</div>
                         <div class="col-8"><input type="text" name="live_class" class="form-control" placeholder="Example: লাইভ ক্লাস ২০ টি" required></div>
                       </div>
                       <div class="row mt-2">
                         <div class="col-4">Number of Course Exam</div>
                         <div class="col-8"><input type="text" name="course_exam" class="form-control" placeholder="Example: পরীক্ষা ২০ টির অধিক" required></div>
                       </div>
                       <div class="row mt-2">
                         <div class="col-4">Number of Model Test</div>
                         <div class="col-8"><input type="text" name="course_model_test" class="form-control" placeholder="Example: মডেল টেস্ট ১০+" required></div>
                       </div>
                       <div class="row mt-2">
                         <div class="col-4">Class Time Per Class</div>
                         <div class="col-8"><input type="text" name="class_time" class="form-control" placeholder="Example: প্রতি ক্লাস ২ ঘণ্টা করে" required></div>
                       </div>
                     </td>
                   </tr>

                 </table>
                 <div class="row">
                   <div class="col-4"></div>
                   <div class="col-8"> <input type="submit" class="btn btn-success" name="submit" id="submit" value="Submit">
                   </div>
                 </div>
               </div>
             </div>
             <div class="col-md-1"></div>
           </div>
         </form>
<!-- /////////////////////////////////////////////////////////////////////////////////////// -->
<div class="row mt-2">
           <div class="container table-responsive">
             <table class="table table-sm table-striped">
               <thead class="table-light">
                 <tr class="bg-secondary">
                   <th>মেয়াদ</th>
                   <th>ক্লাস</th>
                   <th>কুইজ</th>
                   <th>টেস্ট</th>
                   <th>ক্লাস টাইম</th>
                   <th>Action</th>
                 </tr>
               </thead>
               <tbody id="result_data">
               </tbody>
             </table>
           </div>
         </div>
<!-- ///////////////////////////////////////////////////////////////////////////////////////// -->
       </div>
     </div><!-- End blog entries list -->
   </div>

   </div>
   <!-- End Blog Section -->
   <!----------------------------------------------->
 </main>
  <!---------------------------------------------------------------------------------------------->
   <!--Course Content Update Modal -->
   <div class="modal fade" id="course_include_edit_modal" tabindex="-1" aria-labelledby="course_content_edit_modal" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">কোর্সে আরো পাবেন আপডেট করুন</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
           <input type="text" class="form-control" id="course_include_id" hidden>
           <div class="mb-3">
             <label for="exampleFormControlInput1" class="form-label">কোর্সের সময়</label>
             <input type="text" class="form-control" id="course_duration">
           </div>
           <div class="mb-3">
             <label for="exampleFormControlInput1" class="form-label">ক্লাস</label>
             <input type="text" class="form-control" id="live_class">
           </div>
           <div class="mb-3">
             <label for="exampleFormControlInput1" class="form-label">পরীক্ষা</label>
             <input type="text" class="form-control" id="course_exam">
           </div>

           <div class="mb-3">
             <label for="exampleFormControlInput1" class="form-label">মডেল টেস্ট</label>
             <input type="text" class="form-control" id="course_model_test">
           </div>

           <div class="mb-3">
             <label for="exampleFormControlInput1" class="form-label">ক্লাসের সময়</label>
             <input type="text" class="form-control" id="class_time">
           </div>

         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বাতিল করুন</button>
           <button type="button" class="btn btn-success content_update">আপডেট করুন</button>
         </div>
       </div>
     </div>
   </div>
   <!----------------------------------------------------------------------->
 <!-- End #main -->
 <?= $this->endSection() ?>

 <?= $this->section('custom-script') ?>
 <script type="text/javascript">
  $(document).ready(function(){
   ///////////////////////////////////////////////////////////////////////////////
       $('.select_course').on('change', function() {
       var courseId = $(this).find(":selected").val();
       //alert(courseId);
        $.ajax({
          type: 'GET',
          url: '<?= site_url("/teacher/course-include-from-db"); ?>',
         data: {
           id: courseId,
         },
         dataType: 'json',
         success: function(data) {

           $('#result_data').empty();

             data.forEach(function(item) {
               $('#result_data').append(`
             <tr>
             <td>${item.course_duration}</td>
            <td>${item.live_class}</td>
             <td>${item.course_exam}</td>

             <td>${item.course_model_test}</td>
             <td>${item.class_time}</td>
             <td>
            <button class="btn btn-secondary btn-sm edit_item"  data-course_include_id = "${item.course_include_id}" data-course_duration="${item.course_duration}" data-live_class = "${item.live_class}" data-course_exam = "${item.course_exam}" data-course_model_test = "${item.course_model_test}" data-class_time="${item.class_time}">Edit</button>
             </td>
             </tr>
             `);
             });

            }
       });
     });
     ///////////////////////////////////////////////////////////


   ///////////////////////////////////////////////////////////

$('body').on('click', '.edit_item', function() {
  // get data from button edit
  const course_include_id = $(this).data('course_include_id');
  const course_duration = $(this).data('course_duration');
  const live_class = $(this).data('live_class');
  const course_exam = $(this).data('course_exam');
  const course_model_test = $(this).data('course_model_test');
  const class_time = $(this).data('class_time');

  $("#course_include_id").val(course_include_id);
  $("#course_duration").val(course_duration);
  $("#live_class").val(live_class);
  $("#course_exam").val(course_exam);
  $("#course_model_test").val(course_model_test);
  $("#class_time").val(class_time);

  $('#course_include_edit_modal').modal('show');

});
////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////
$('.content_update').on('click', function() {
  var course_include_id = $("#course_include_id").val();
  var course_duration = $("#course_duration").val();
  var live_class = $("#live_class").val();
  var course_exam = $("#course_exam").val();
  var course_model_test = $("#course_model_test").val();
  var class_time = $("#class_time").val();

  //alert(course_include_id);

$.ajax({
   type: 'GET',
  url: '<?= site_url("/teacher/course-include-update"); ?>',
   data: { 
         "course_include_id":course_include_id,
         "course_duration": course_duration,
         "live_class": live_class,
         "course_exam": course_exam,
         "course_model_test":course_model_test,
         "class_time":class_time,
         },
  // dataType: 'json',
   success: function(data) {
alert(data);
     $('#course_include_edit_modal').modal('hide');
  }
   });

});

//////////////////////////////////////////////////////////// 

  });
 </script>
  <?= $this->endSection() ?>