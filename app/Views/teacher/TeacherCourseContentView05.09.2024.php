<?= $this->extend('homepage/layout') ?>

<?= $this->section('content') ?>
 <main id="main" class="my-5">
   <!------------------------------------------------>
   <?php echo $this->include("teacher/teacherDashboard_menu"); ?>
   <div class="col-lg-9 entries">
     <!-----##########################This is content space which will change in every page-##################################-------------->
     <div class="container bg-light " data-aos="fade-up">
       <header class="section-header" style="padding-bottom: 1px !important;">
         <p>শিক্ষক কোর্স চ্যাপ্টার/সিলেবাস/কনটেন্ট তিরী
           <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title=" ১.আপনি যদি Online Live Coaching তিরী করেন তাহলে Chapter Name এর জায়গায় চাপ্টার এর নাম Video Title এর জায়গায় টপিক এর নাম এবং Video Link এর জায়গায় চাপ্টার এর ডিটেলস লিখলেই হবে।
                  ২.যদি কয়েকটা সাবজেক্ট মিলে একটা কোর্স তিরী করেন তাহলে Chapter Name এর জায়গায় Subject Name এবং Video title এর জায়গায় অধ্যায়ের নাম এবং Video Link এর জায়গায় অধ্যায়ের বিস্তারিত লিখলেই হবে।
                   যেমনঃ 
                      পদার্থ বিজ্ঞান 
                      রসায়ন বিজ্ঞান
                      গণিত
         ">
             হেল্প এখানে
           </button>
         </p>
         <hr>
       </header>


       <div class="container">
         <form action="<?php echo site_url('teacher/course-content-insert') ?>" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
           <div class="row mb-1">
             <div class="col-md-3">কোর্স বাছাই করুন</div>
             <div class="col-md-9">
               <select class="form-select select_course" name="course_id" aria-label="Default select example" required>
                 <option selected disabled value="">Please Select Course </option>
                 <?php
                  foreach ($courseContents as $row) {
                    $course_id = $row->course_id;
                    $coures_title = $row->coures_title;
                    $course_type_name = $row->course_type_name;
                  ?>
                   <option value="<?php echo $course_id; ?>"><?php echo $coures_title . "-->" . $course_type_name; ?></option>
                 <?php
                  }
                  ?>
               </select>
             </div>
           </div>

           <div class="row">
             <div class="col-md-12">
               <div class="form-group">
                 <table class="table table-bordered table-hover" id="dynamic_field">
                   <tr class="parent_group">
                     <td colspan="2">
                       <div class="row">
                         <div class="col-3">অধ্যায়ের নাম</div>
                         <div class="col-9"><input type="text" class="form-control" name="chapter_name[0][]" placeholder="Chapter Name" required></div>
                         <div class="row mt-1">
                           <div class="col-3">ভিডিও টাইটেল/টপিক</div>
                           <div class="col-9"><input type="text" name="video_title[0][]" class="form-control" placeholder="Video Title" required></div>
                         </div>
                         <div class="row mt-1">
                           <div class="col-3">ভিডিও লিঙ্ক/অধ্যায়ের বিস্তারিত</div>
                           <div class="col-8"><input type="text" name="video_link[0][]" class="form-control" placeholder="Video Link" required></div>
                           <div class="col-1"><button type="button" class="btn btn-sm btn-secondary add_chapter_row_child"><i class='fas fa-plus-circle' style='font-size:20px'></i></button></div>
                         </div>

                         <!-- https://www.geeksforgeeks.org/upload-pdf-file-to-mysql-database-for-multiple-records-using-php/ -->


                         <div class="row mt-1">
                            <div class="col-3">পিডিএফ নোট আপলোড</div>
                            <div class="col-9"><input class="form-control rounded-0" name="file" type="file" id="formFile"></div>
                          </div>



                     </td>
                     <td><button type="button" id="add" class="btn btn-success "><i class='fas fa-plus' style='font-size:24px'></i></button></td>
                   </tr>

                 </table>
                 <div class="text-center">
                   <input type="submit" class="btn btn-secondary" name="submit" id="submit" value="সাবমিট কোর্স">
                 </div>
               </div>
             </div>
           </div>
         </form>
         <!------------------------------------------------->
         <div class="row mt-2">
           <div class="container table-responsive">
             <table class="table table-sm table-striped">
               <thead class="table-light">
                 <tr class="bg-secondary">
                   <th>Chapter</th>
                   <th>Topics</th>
                   <th>Link/details</th>
                   <th>Note</th>
                   <th>Action</th>
                 </tr>
               </thead>
               <tbody id="result_data">
               </tbody>
             </table>
           </div>
         </div>
         <!-------------------------------------------------->
       </div>
     </div><!-- End blog entries list -->
   </div>
   <!---------------------------------------------------------------------------------------------->
   <!--Course Content Update Modal -->
   <div class="modal fade" id="course_content_edit_modal" tabindex="-1" aria-labelledby="course_content_edit_modal" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">কোর্স কনটেন্ট আপডেট করুন</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
           <input type="text" class="form-control" id="course_content_id" hidden>
           <div class="mb-3">
             <label for="exampleFormControlInput1" class="form-label">অধ্যায়ের নাম</label>
             <input type="text" class="form-control" id="chapter_name">
           </div>
           <div class="mb-3">
             <label for="exampleFormControlInput1" class="form-label">ভিডিও টাইটেল বা টপিকের নাম</label>
             <input type="text" class="form-control" id="video_title">
           </div>
           <div class="mb-3">
             <label for="exampleFormControlInput1" class="form-label">ভিডিও লিঙ্ক বা টপিক বিস্তারিত</label>
             <input type="text" class="form-control" id="video_link">
           </div>

           <div class="mb-3">
             <label for="exampleFormControlInput1" class="form-label">পিডিএফ নোট</label>
             <input type="text" class="form-control" id="pdf_file_path">
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
   </div>
 </main>
 <?= $this->endSection() ?>
 
 <?= $this->section('custom-script') ?>
 <script type="text/javascript">
   $(document).ready(function() {

     var i = 1;

     $("#add").click(function() {

       var newRow = '<tr class="parent_group"><td colspan="2">' +
         '<div class="row mt-2"><div class="col-12"><input type="text" name="chapter_name[' + i + '][]" class="form-control" placeholder="Chapter Name" required></div>' +
         '<div class="row mt-2"><div class="col-11"><input type="text" name="video_title[' + i + '][]" class="form-control" placeholder="Video Title" required>' +
         '</div><div class="col-1"></div></div>' +
         '<div class="row mt-2"><div class="col-11"><input type="text" name="video_link[' + i + '][]" class="form-control" placeholder="Video Link" required></div>' +
         '<div class="col-1"><button type="button" class="btn btn-sm btn-secondary add_chapter_row_child" ><i class="fas fa-plus-circle" style="font-size:20px"></i></button></div></div>' +
         '</td><td><button type="button"  class="btn btn-danger btn_remove remoeve_parent"><i class="far fa-trash-alt" style="font-size:24px"></i></button></td></tr>';

       $('#dynamic_field').append(newRow);
     });

     $(document).on('click', '.remoeve_parent', function() {
       //if (confirm("Really Want to Delete ?")) {
       $(this).closest(".parent_group").remove();
       //}
     });

     $(document).on('click', '.delete_chapter_row_child', function() {
       //if (confirm("Really Want to Delete ?")) {
       // $(this).closest(".child_group").remove();
       $(this).parent().parent().parent().remove();
       //}
     });

     $(document).on('click', '.add_chapter_row_child', function() {
       //var i = 0;
       //  if ($(this).hasClass('description')) {
       var descriptionAdd = '<div class="delete_child"><div class="row mt-2 "><div class="col-11">' +
         '<input type="text" name="video_title[0][]" class="form-control" placeholder="Video Title" required>' +
         '</div><div class="col-1"><!--<button type="button" class="btn btn-sm btn-danger delete_chapter_row_child"></button>-->' +
         '</div></div>' +
         '<div class="row mt-2 "><div class="col-11">' +
         '<input type="text" name="video_link[0][]" class="form-control" placeholder="Video Link" required>' +
         '</div><div class="col-1"><button type="button" class="btn btn-sm btn-danger delete_chapter_row_child"><i class="far fa-trash-alt" style="font-size:24px"></i></button>' +
         '</div></div></div>';
       $(this).parent().parent().append(descriptionAdd);
     });

     let responseData = [];

     function updateTableRows() {
       $('#result_data').empty();

       responseData.forEach(function(item, i) {
         $('#result_data').append(`
  <tr>
       <td>${item.chapter_name}</td>
       <td>${item.video_title}</td>
       <td>${item.video_link}</td>
       <td>${item.pdf_file_path}</td>
       <td>
       <button class="btn btn-secondary btn-sm edit_item" data-row_id="${i}" data-course_content_id="${item.course_content_id}" data-chapter_name = "${item.chapter_name}" data-video_title = "${item.video_title}" data-video_link = "${item.video_link}" data-pdf_file_path = " ${item.pdf_file_path}">Edit</button>
       </td>
       </tr>
  `);
       });
     }

     ////////////////////////////////////////////////////////////////////////////
     $('.select_course').on('change', function() {
       var courseId = $(this).find(":selected").val();
       $.ajax({
         type: 'GET',
         url: '<?= site_url("/teacher/course-content-from-db"); ?>',
         data: {
           id: courseId
         },
         dataType: 'json',
         success: function(jsonData) {
           responseData = jsonData;
           updateTableRows();
         }
       });
     });
     ///////////////////////////////////////////////////////////

     let seletedRow = null;

     $('body').on('click', '.edit_item', function() {
       // get data from button edit
       const course_content_id = $(this).data('course_content_id');
       const chapter_name = $(this).data('chapter_name');
       const video_title = $(this).data('video_title');
       const video_link = $(this).data('video_link');
 const pdf_file_path = $(this).data('pdf_file_path');

       seletedRow = $(this).data('row_id');

       $("#course_content_id").val(course_content_id);
       $("#chapter_name").val(chapter_name);
       $("#video_title").val(video_title);
       $("#video_link").val(video_link);
       $("#pdf_file_path").val(pdf_file_path);

       $('#course_content_edit_modal').modal('show');

     });
     ////////////////////////////////////////////////////////////
     $('.content_update').on('click', function() {

       let updatedData = {
         "chapter_name": $("#chapter_name").val(),
         "video_title": $("#video_title").val(),
         "video_link":  $("#video_link").val(),
         "pdf_file_path":  $("#pdf_file_path").val(),
         "course_content_id":  $("#course_content_id").val()
       };

       $.ajax({
         type: 'GET',
         url: '<?= site_url("/teacher/course-content-update"); ?>',
         data: updatedData,
         // dataType: 'json',
         success: function(data) {
           responseData[seletedRow] = updatedData;
           updateTableRows();
           $('#course_content_edit_modal').modal('hide');
         }
       });

     });

     //////////////////////////////////////////////////////////// 
   });
 </script>
 <?= $this->endSection() ?>