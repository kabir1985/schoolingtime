<?= $this->extend('homepage/layout') ?>

<?= $this->section('content') ?>
<style>
  .table> :not(caption)>*>* {
    padding: .3rem .3rem !important;
  }
</style>


<main id="main" class="my-5">
  <!-- ======= content Section ======= -->
  <section id="blog" class="blog">
    <div class="container" data-aos="fade-up">
      <div class="row">
        <!------Left Menu Column---------------------------------------->
        <div class="col-lg-3">
          <?php echo $this->include("student/student_dashboard_left_menu"); ?>
        </div>
        <!----------Left Menu Column End----------------------------------------->

        <div class="col-lg-9">
          <div class="container px-2 clearfix">
            <!-- Shopping cart table -->
            <div class="card">
              <div class="card-header">
                <h5>Shopping Cart</h5>
              </div>
              <div class="card-body">
                <form action="<?php echo site_url('student/checkout'); ?>" method="post">
                  <table class="table table-bordered">
                    <thead>
                      <tr class="table-secondary">
                        <th scope="col">কোর্সের নাম</th>
                        <th scope="col">ব্যাচ এবং সময়</th>
                        <th scope="col">কোর্স ফি</th>
                        <th scope="col">একশন</th>
                      </tr>
                    </thead>
                    <tbody id="cartTable">
                      <?php
                      if (isset($_SESSION["cartItems"])) {
                        $total_course_price = 0;

 //var_dump($_SESSION["cartItems"]);
 //exit("cart_view.php page");
                        foreach ($_SESSION["cartItems"] as $index => $item) { // Added index to track each item
                      ?>
                          <tr>
                            <td scope="row"><?php echo $item["course_title"]; ?></td>
                            <td>
                              <!-- Dropdown for batch selection -->
                              <select name="batch_ids[<?php echo $index; ?>]" style="max-width: 15rem;" class="form-select form-select-sm" aria-label=".form-select-sm example" onchange="setBatchDetails(this, <?php echo $index; ?>)" required>
                                <option selected disabled value="">ব্যাচ ও সময় নির্বাচন</option>
                                <?php
                                $courseID = $item["course_id"];
                                $db = \Config\Database::connect();
                                $query = $db->query("SELECT batch_id, weekly_days, max_seats, booked_seats, time_slot FROM course_batch WHERE course_id ='$courseID'");
                                $batch_info = $query->getResult();
                                $batchAvailable = false; // Track whether a batch with available seats exists
                                foreach ($batch_info as $row) {
                                  // Check if seats are available
                                  if ($row->max_seats > $row->booked_seats) {
                                    $batchAvailable = true; // Mark that at least one batch is available
                                ?>
                                    <option value="<?= htmlspecialchars($row->batch_id); ?>"
                                      data-weekly-days="<?= htmlspecialchars($row->weekly_days); ?>"
                                      data-time-slot="<?= htmlspecialchars($row->time_slot); ?>">
                                      <?= htmlspecialchars($row->weekly_days) . " (" . htmlspecialchars($row->time_slot) . ")"; ?>
                                    </option>
                                  <?php
                                  }
                                }
                                // If no batch has available seats, show this message
                                if (!$batchAvailable) {
                                  ?>
                                  <option value="" disabled>এই কোর্সে কোন সিট খালি নাই</option>
                                <?php } ?>
                              </select>
                              <!-- Hidden inputs to store weekly_days and time_slot -->
                              <input type="hidden" name="weekly_days[<?php echo $index; ?>]" id="weekly_days_<?php echo $index; ?>" />
                              <input type="hidden" name="time_slot[<?php echo $index; ?>]" id="time_slot_<?php echo $index; ?>" />
                            </td>
                            <td>
                              <?php
                              $course_price = preg_replace("/[^0-9.]+|(?<=\\d\\.)\\.|^\\.|\\.$/", "", $item["course_price"]);
                              echo number_format((float)$course_price, 2, '.', '');
                              ?>
                            </td>
                            <td>
                              <i class="cart_item_delete fa fa-trash" style="font-size:20px;color:red"></i>
                            </td>
                          </tr>
                      <?php
                          $total_course_price += preg_replace("/[^0-9.]+|(?<=\\d\\.)\\.|^\\.|\\.$/", "", $item["course_price"]);
                        }

                        echo '<tr class="bg-light">
                        <td><b>Total Amount:</b></td>
                        <td></td>
                        <td id="totalBillAmount">' . number_format((float)$total_course_price, 2, ".", "") . '</td>
                        <td></td>
                      </tr>';
                      } else {
                        echo '<tr><td colspan="4" class="text-center">No items in cart</td></tr>';
                      }
                      ?>
                    </tbody>
                  </table>
                  <div class="position-relative pt-5">
                    <button type="submit" class="btn btn-secondary position-absolute bottom-0 end-0">পেমেন্ট করতে এগিয়ে যান</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div><!-- End blog entries list -->
    </div>
    </div>
  </section><!-- End Blog Section -->
  <!--------------------------------------------->

</main>
<?= $this->endSection() ?>
<?= $this->section('custom-script') ?>
<script type='text/javascript'>
  $(document).ready(function() {
    let requestUrl = '<?= base_url("student/update-cart") ?>';
    $('.cart_item_delete').click(function() {
      var tableRow = $(this).closest("tr");
      var sum = 0;
      $.ajax({
          type: "POST",
          url: requestUrl,
          data: {
            index: tableRow.index()
          }
        })
        .done(function(data) {
          if (data == 1) {
            tableRow.remove();
            var tableCartItems = $('#cartTable tr');
            tableCartItems.each(function(index, element) {
              if (index < tableCartItems.length - 1) {
                var thirdColumnValue = parseFloat($(element).find('td:eq(2)').text());
                if (!isNaN(thirdColumnValue)) {
                  sum += thirdColumnValue;
                }
              }
            });
            $("#totalBillAmount").html(sum.toFixed(2));
          }
        });
    });
  });

  function setBatchDetails(select, index) {
    // Get the selected option
    const selectedOption = select.options[select.selectedIndex];

    // Extract weekly_days and time_slot from data attributes
    const weeklyDays = selectedOption.getAttribute('data-weekly-days');
    const timeSlot = selectedOption.getAttribute('data-time-slot');

    // Set the hidden inputs with the selected values
    document.getElementById('weekly_days_' + index).value = weeklyDays;
    document.getElementById('time_slot_' + index).value = timeSlot;
  }
</script>
<?= $this->endSection() ?>