<?= $this->extend('homepage/layout') ?>

<?= $this->section('content') ?>
 <main id="main" class="my-5">
   <!------------------------------------------------>
   <?php echo $this->include("teacher/teacherDashboard_menu"); ?>
   <div class="col-lg-9">
     <!-----##########################This is content space which will change in every page-##################################-------------->
     <div class="container bg-light " data-aos="fade-up">
       <header class="section-header" style="padding-bottom: 1px !important;">
         <p>আপনার কোর্স তিরী করুন</p>
         <hr>
       </header>

       <!-----##########################This is content space which will change in every page-##################################-------------->
       <form action="<?php echo site_url('teacher/course-create') ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">

         <div class="row mb-2">
           <div class="col-md-4"><label for="course_title" class="form-label">Course Title</label></div>
           <div class="col-md-6">
             <input type="text" class="form-control" id="course_title" placeholder="কোর্স টাইটেল লিখুন" name="course_title" required>
           </div>
           <div class="col-md-2"></div>
         </div>

         <div class="row mb-2">
           <div class="col-md-4"><label for="course_code" class="form-label">Course Type </label></div>
           <div class="col-md-6">
             <select class="form-select course_type" name="course_type_name" aria-label="Default select example" required>
               <option selected disabled value="">সিলেক্ট কোর্স টাইপ</option>
               <?php
                foreach ($courseTypeList as $row) {
                  $course_type_name = $row->course_type_name;
                  $course_type_name_bangla = $row->course_type_name_bangla;
                ?>
                 <option value="<?php echo $course_type_name; ?>"><?php echo $course_type_name_bangla; ?></option>

               <?php
                }
                ?>
             </select>
           </div>
           <div class="col-md-2"></div>
         </div>

         <div class="row mb-2">
           <div class="col-md-4"><label for="course_section_id" class="form-label">Course Section</label></div>
           <div class="col-md-6">
             <select class="form-select course_section" name="course_section_id" aria-label="Default select example" required>
               <option selected disabled value="">সিলেক্ট কোর্স সেকশন</option>
               <?php
                foreach ($courseSectionList as $row) {
                  $course_section_id = $row->course_section_id;
                  $course_section_name = $row->course_section_name;
                  $course_section_name_bangla = $row->course_section_name_bangla;
                ?>
                 <option value="<?php echo $course_section_id; ?>" ><?php echo $course_section_name_bangla; ?></option>

               <?php
                }
                ?>
             </select>
           </div>
           <div class="col-md-2"></div>
         </div>

         <div class="row mb-2">
           <div class="col-md-4"><label for="course_code" class="form-label">Course Category</label></div>
           <div class="col-md-6">
             <select class="form-select course_category" name="course_category_id" aria-label="Default select example" required>
             </select>
           </div>
           <div class="col-md-2"></div>
         </div>


         <div class="row mb-2">
           <div class="col-md-4"><label for="course_level" class="form-label">Course Class/Level:</label></div>
           <div class="col-md-6">
             <select class="form-select" name="course_level" aria-label="Default select example" required>
               <option selected disabled value="">সিলেক্ট ক্লাস লেভেল</option>
               <option value="primary_level">Primary Level</option>
               <option value="high_school_level">High School Level</option>
               <option value="college_level">College Level</option>
               <option value="university_level">University Level</option>
             </select>
           </div>
           <div class="col-md-2"></div>
         </div>
         <div class="row mb-2">
           <div class="col-md-4"><label for="course_level" class="form-label">Course/Video/Content Price:</label></div>
           <div class="col-md-6">
             <input type="text" class="form-control" id="course_price" placeholder="কোর্স প্রাইস" name="course_price" required />
           </div>
           <div class="col-md-2"></div>
         </div>


         <!-------------Conditionally Open----------------------------------------------->

         <!-- <div id="hide_for_question_exam"> -->

           <div class="row mb-2">
             <div class="col-md-4"><label for="course_level" class="form-label">what you will learn(Give comma , after each paragraph):</label></div>
             <div class="col-md-6">
               <textarea class="form-control" id="what_you_will_learn" name="what_you_will_learn" rows="2"></textarea>
             </div>
             <div class="col-md-2"></div>
           <!-- </div> -->

           <!-- <div class="result"></div> -->


           <div class="row mb-2">
             <div class="col-md-4"><label for="course_level" class="form-label">Course Pre-requisite:</label></div>
             <div class="col-md-6">
               <input type="text" class="form-control" id="course_prerequisite" placeholder="কোর্স করার পুর্ব শর্ত" name="course_prerequisite">
             </div>
             <div class="col-md-2"></div>
           </div>
           <div class="row mb-2">
             <div class="col-md-4"><label for="course_level" class="form-label">Demo Video Class Link:</label></div>
             <div class="col-md-6">
               <input type="text" class="form-control" id="demo_video_class_link" placeholder="ডেমো ভিডিও লিঙ্ক" name="demo_video_class_link">
             </div>
             <div class="col-md-2"></div>
           </div>

           <div class="row mb-2">
             <div class="col-md-4"><label for="course_level" class="form-label">Course Intro Picture:</label></div>
             <div class="col-md-6">
               <input type="file" class="form-control" id="file" name="file">
             </div>
             <div class="col-md-2"></div>
           </div>

           <div class="row mb-2">
             <div class="col-md-4"><label for="course_note" class="form-label">Course Short Note:</label></div>
             <div class="col-md-6">
               <textarea class="form-control" id="course_note" name="course_note" rows="4"></textarea>
             </div>
             <div class="col-md-2"></div>
           </div>

         </div>
         <!-----------------Conditionally Open End here----------------------------------->


         <div class="row mb-2">
           <div class="col-md-4"></div>
           <div class="col-md-6"><button type="submit" class="btn btn-success mt-1 submit_button">কোর্স সাবমিট করুন</button></div>
           <div class="col-md-2"></div>
         </div>

       </form>
     </div>


   </div><!-- End blog entries list -->

    <!-- <div class="col-lg-1 mt-5">
     <div class="col-md-12">
       <p>১) যদি ভর্তি পরীক্ষার জন্য মডেল টেস্ট হয়,
         তাহলে Course Title: Dhaka University Admission, Chittagong University Admission, BCS Exam ইত্যাদি</p>
       <hr>
       <p>
         ২) যদি মডেল টেস্ট, ভার্সিটি ভর্তি পরীক্ষা মডেল টেস্ট, কলেজ ভর্তি , বিসিএস মডেল টেস্ট ইত্যাদি পরীক্ষা তিরী করতে চান,
         তাহলে course_type: Question_And_Exam
       </p>
       <p>
         ৩) যদি Online এ Video তিরী করে ভিডিও ক্লাস করাতে চান তাহলে Course Type: Online_Video_Course<br>
         যদি Online এ Coaching ক্লাস করাতে চান তাহলে Course Type: Online_Live_Coaching<br>

       </p>

     </div> 
   </div> -->




   </div>

   </div>
   </section>
   <!-- End Blog Section -->
   <!----------------------------------------------->
 </main>
 <?= $this->endSection() ?>
 
 <?= $this->section('custom-script') ?>
<script type="text/javascript">
   $(document).ready(function() {
     var sections = <?= json_encode($courseSectionList) ?>;
     ///////////////////////////////////////////////
     $('.course_type').on('change', function() {

       var courseType = $(this).find(":selected").val();
      //  if (courseType == 'Question_And_Exam') {
      //    $("#hide_for_question_exam").hide();
      //  } else {
      //    $("#hide_for_question_exam").show();
      //  }

       //  ----------------------------------Implemented By RZR------------------------------------------------>>

       $('.course_section').empty();
       $('.course_section').append('<option value="">সিলেক্ট কোর্স সেকশন</option>')

       const filteredSections = sections.filter(section => {
         if (courseType === "Question_And_Exam") {
           return section.course_section_name === "Exam_Course";
         } else {
           return section.course_section_name !== "Exam_Course";
         }
       });

       filteredSections.forEach(section => {
         $('.course_section').append(`<option value="${section.course_section_id}">${section.course_section_name_bangla}</option>`);
       });
       //  ----------------------------------Implemented By RZR------------------------------------------------||
     });


     $('.course_section').on('change', function() {
       var course_section_id = $(".course_section option:selected").val();
       $.ajax({
         type: 'GET',
         url: '<?= site_url("/supperadmin/showcourse-category"); ?>',
         data: {
           id: course_section_id
         },
         dataType: 'json',
         success: function(jsonData) {
           $('.course_category').empty();
           jsonData.forEach(item => {
             $('.course_category').append(`<option value="${item.id}">${item.name}</option>`);
           });
         }
       });
     });

   });
 </script>
 <?= $this->endSection() ?>