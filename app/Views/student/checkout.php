<?= $this->extend('homepage/layout') ?>

<?= $this->section('content') ?>
<main id="main" class="my-5">
  <!-- ======= Checkout Section ======= -->
  <section id="checkout blog" class="checkout blog">
    <div class="container" data-aos="fade-up">
      <div class="row">
        <!------Left Menu Column---------------------------------------->
        <div class="col-lg-3">
          <?php echo $this->include("student/student_dashboard_left_menu"); ?>
        </div>

        <div class="col-lg-9">
          <h3 class="text-center mb-3" style="font-size: 20px !important;">
            Checkout
            <!-- Display student information -->
            <?php if (isset($studentDetails) && !empty($studentDetails)): ?>
              <?php foreach ($studentDetails as $student): ?>
                <p style="font-size: 16px !important;">Name: <?= $student->student_name; ?></p>
                <!-- <p>Email: <?php //echo $student->student_email; ?></p> -->
                 <!-- <p>ID: <?php //echo $student->student_id; ?></p> -->
                <input type="text" id="student_id" name="student_id" value="<?= $student->student_id; ?>" hidden>
              <?php endforeach; ?>
            <?php endif; ?>

          </h3>
          <div class="card">
            <div class="card-header">
              <h6>Your Cart Items</h6>
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr class="table-secondary">
                    <th scope="col">কোর্সের নাম</th>
                    <th scope="col"> দিন এবং সময়</th>
                    <th scope="col">কোর্স ফি</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($cartItems)) {
                    foreach ($cartItems as $item) { ?>
                      <tr>
                        <td><?php echo $item["course_title"]; ?></td>
                        <td><?php //$item["batch_id"]; // Assuming batch_id is being passed 
                              echo $item['weekly_days']." "."(".$item['time_slot'].")";
                            ?>
                            </td>
                        <td>
                          <?php
                          $course_price = preg_replace("/[^0-9.]+|(?<=\\d\\.)\\.|^\\.|\\.$/", "", $item["course_price"]);
                          echo number_format((float)$course_price, 2, '.', '');
                          ?>
                        </td>
                      </tr>
                    <?php }
                  } else { ?>
                    <tr>
                      <td colspan="3" class="text-center">No items in your cart.</td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
              <?php
              $db = \Config\Database::connect();
              $query = $db->query("Select * FROM sales_commission");
              $results = $query->getRow();
              //echo $results->sales_commission_percent;
              ?>
              <input type="text" id="sales_commission_percent" value="<?php echo $results->sales_commission_percent; ?>" hidden>
              <div class="text-right">
                <h6>মোট টাকা: <span id="totalPrice"><?php echo number_format((float)$totalPrice, 2, '.', '')."/-"; ?></span></h6>
              </div>
            </div>
          </div>

          <div class="position-relative pt-5">
            <!-- <form action="<?php //echo site_url('student/process-payment'); ?>" method="POST"> -->
            <input type="hidden" name="total_price" value="<?php echo $totalPrice; ?>">
            <button type="submit" class="btn btn-secondary position-absolute bottom-0 end-0 payment">পেমেন্ট করুন</button>
            <!-- </form> -->
          </div>
        </div>
      </div>
    </div>
  </section><!-- End Checkout Section -->
</main>
<?= $this->endSection() ?>

<?= $this->section('custom-script') ?>
<script type="text/javascript">
  $(document).ready(function() {

    $('.payment').on('click', function() {

      var student_id = $("#student_id").val();
      var sales_commission_percent = $("#sales_commission_percent").val();

      $.post('<?= site_url("/student/purchase-course"); ?>', {
          student_id: student_id,
          sales_commission_percent: sales_commission_percent,
        })
        .done(function(data) {

    // Check if response is empty or null
    if (!data || data.trim() === '') {
        alert('No response from server. Please try again later.');
        return;
    }

    try {
        var response = jQuery.parseJSON(data);
    } catch (e) {
        console.error('Invalid JSON response:', e);
        alert('Failed to parse server response.');
        return;
    }
          //alert(data);
          var response = jQuery.parseJSON(data);
          const messageDuration = 2000;
          Toastify({
            text: response.toast_message,
            duration: messageDuration,
            // destination: "https://github.com/apvarun/toastify-js",
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
              background: "linear-gradient(to right, #00b09b, #96c93d)",
            }
          }).showToast();

          function myFunction() {
            window.location.href = "<?php echo base_url(); ?>student/course-selection";
          }
          setTimeout(myFunction, messageDuration);
        });
    });
  });
</script>
<?= $this->endSection() ?>