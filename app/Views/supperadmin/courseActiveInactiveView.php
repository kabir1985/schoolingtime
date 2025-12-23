<?php echo $this->include("supperadmin/header"); ?>

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-th-list"></i> কোর্স এক্টিভ / ইনএক্টিভ সেকশন</h1>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="tile-body">
          <div class="table-responsive">
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <th>কোর্সের নাম</th>
                  <th>কোর্স ক্যাটাগরি</th>
                  <th>বর্তমান অবস্থা</th>
                  <th>একশন</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($results as $row): ?>
                  <tr>
                    <td><?php echo $row->coures_title; ?></td>
                    <td><?php echo $row->course_type_name; ?></td>
                    <td>
                      <span style="background-color: <?php echo $row->course_status == 'pending' ? 'tomato' : 'green'; ?>; padding:8px; border:1px solid white; color:white;">
                        <?php echo $row->course_status; ?>
                      </span>
                    </td>
                    <td>
                      <button class="btn btn-<?php echo $row->course_status == 'pending' ? 'secondary' : 'danger'; ?> details-button"
                              data-course_id="<?php echo $row->course_id; ?>"
                              data-course_status="<?php echo $row->course_status; ?>"
                              data-batch_id="<?php echo $row->batch_course_id; ?>"
                              data-course_title="<?php echo $row->coures_title; ?>"
                              data-bs-toggle="modal"
                              data-bs-target="#DetailsOfCourse">
                        <?php echo $row->course_status == 'pending' ? 'Enable' : 'Disable'; ?>
                      </button>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="DetailsOfCourse" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="course_title"></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="<?php echo site_url('/courseStatusUpdate') ?>" method="post">
          <div class="modal-body">
            <h3>আপনি কি কোর্সের স্ট্যাটাস আপডেট করতে চাচ্ছেন?</h3>
            <input type="hidden" id="course_id" name="course_id">
            <input type="text" id="course_status" name="course_status">
            <input type="hidden" id="batch_id" name="batch_id">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <button type="submit" class="btn btn-primary">Yes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>

<!-- Script Section -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  // When the details button is clicked, populate the modal with the course data
  $(document).on('click', '.details-button', function() {
      // Set the course details in the modal
      $('#course_id').val($(this).data('course_id'));
      $('#course_status').val($(this).data('course_status'));
      $('#batch_id').val($(this).data('batch_id'));
      $('#course_title').text($(this).data('course_title'));

      // Enable or disable the 'Yes' button based on the existence of batch_id
      const batchId = $(this).data('batch_id');

      // Disable the 'Yes' button and show a message if batch_id is missing
      if (!batchId) {
          $('#DetailsOfCourse .btn-primary').prop('disabled', true); // Disable button
          
          // Show message
          $('#DetailsOfCourse .modal-body').append('<h3 id="batch-warning" style="color: red; margin-top: 10px;">Hello Teacher,You should create a batch first</h3>');
      } else {
          $('#DetailsOfCourse .btn-primary').prop('disabled', false); // Enable button

          // Remove the warning message if present
          $('#batch-warning').remove();
      }
  });

  // Before form submission, check if batch_id exists
  $('form').on('submit', function(e) {
      const batchId = $('#batch_id').val();
      if (!batchId) {
          e.preventDefault(); // Prevent form submission
          alert('Batch ID not found. Unable to update course status.');
      }
  });
</script>

<?php echo $this->include("supperadmin/footer"); ?>
