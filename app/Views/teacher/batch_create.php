<?=$this->extend('homepage/layout')?>

<?=$this->section('content')?>
<main id="main" class="my-5">
    <!------------------------------------------------>
    <?php echo $this->include("teacher/teacherDashboard_menu"); ?>
    <div class="col-lg-9 entries">
        <!-----##########################This is content space which will change in every page-##################################-------------->
        <div class="container mt-4 bg-light " data-aos="fade-up">

            <h3 class="mb-3">Add Batch</h3>
            <form action="<?php echo site_url('teacher/batch-store') ?>" method="post">
                <div class="row mb-2">
                    <div class="col-md-6"> <select class="form-select select_batch" name="course_id" id="course_id"
                            aria-label="Default select example" required>
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
                        </select></div>
                    <div class="col-md-6 mb-2">
                        <select name="timeslot" class="form-select" id="timeslot" required>
                            <option selected disabled>Select a time slot</option>
                            <option value="09:00 AM - 10:00 AM">09:00 AM - 10:00 AM</option>
                            <option value="10:00 AM - 11:00 AM">10:00 AM - 11:00 AM</option>
                            <option value="11:00 AM - 12:00 PM">11:00 AM - 12:00 PM</option>
                            <option value="01:00 PM - 02:00 PM">01:00 PM - 02:00 PM</option>
                            <option value="02:00 PM - 03:00 PM">02:00 PM - 03:00 PM</option>
                            <option value="03:00 PM - 04:00 PM">03:00 PM - 04:00 PM</option>
                            <option value="04:00 PM - 05:00 PM">04:00 PM - 05:00 PM</option>
                        </select>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6"><input type="date" name="start_date" class="form-control" id="start_date"
                                required></div>
                        <div class="col-md-6"> <input type="date" name="end_date" class="form-control" id="end_date"
                                required></div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-3"> <label for="weekly_days" class="form-label">Select Days</label><br></div>
                    <div class="col-md-9">
                        <!-- Weekly Days (Checkboxes) -->
                        <div class="mb-2">

                            <?php
//$daysOfWeek = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
$daysOfWeek = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
foreach ($daysOfWeek as $day) {
    ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="weekly_days[]" value="<?=$day?>"
                                    id="<?=strtolower($day)?>">
                                <label class="form-check-label" for="<?=strtolower($day)?>"><?=$day?></label>
                            </div>
                            <?php
}
?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">Max Seats</div>
                    <div class="col-md-9">
                        <input type="number" name="max_seat" class="form-control" id="max_seat" min="1" step="1"
                            placeholder="Enter maximum seats" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Create Batch</button>
            </form>

            <!-- /////////////////////////////////////////////////////////////////////////////////////// -->
            <div class="row mt-2">
                <div class="container table-responsive">
                    <table class="table table-sm table-striped">
                        <thead class="table-light">
                            <tr class="bg-secondary">
                                <th>শুরু তারিখ</th>
                                <th>শেষ তারিখ</th>
                                <th>সময়</th>
                                <th>দিন</th>
                                <th>সর্বোচ্চ স্টুডেন্ট</th>
                                <th>Status</th>
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
<!---------------------------------------------------------------------------------------------->
<!--Course Content Update Modal -->
<div class="modal fade" id="batch_edit_modal" tabindex="-1" aria-labelledby="course_content_edit_modal"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ব্যাচ আপডেট করুন</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="batch_id" hidden>
                <div class="mb-1">
                    <label for="exampleFormControlInput1" class="form-label">কোর্স শুরুর তারিখ</label>
                    <input type="date" class="form-control" id="start_date_edit" min="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="mb-1">
                    <label for="exampleFormControlInput1" class="form-label">কোর্স শেষের তারিখ</label>
                    <input type="date" class="form-control" id="end_date_edit">
                </div>
                <div class="mb-1">
                    <label for="exampleFormControlInput1" class="form-label">কোর্সের সময়</label>
                    <input type="text" class="form-control" id="time_slot">
                </div>

                <div class="mb-1">
                    <label for="exampleFormControlInput1" class="form-label">কোর্সের দিন</label>
                    <!-- <input type="text" class="form-control" id="weekly_days"> -->
                    <div class="mb-2" id="weekly_days">

                    </div>

                </div>

                <div>
                    <label for="exampleFormControlInput1" class="form-label"> কোর্সে সর্বোচ্চ স্টুডেন্ট</label>
                    <input type="text" class="form-control" id="max_seats">
                </div>

                <div>
                    <!-- <input type="text" id="batch_status"> -->
                <label class="form-label fw-bold">ব্যাচ স্ট্যাটাস</label>
<select class="form-select" id="batch_status" required>
    <option value="">স্ট্যাটাস নির্বাচন করুন</option>
    <option value="active">Active</option>
    <option value="inactive">Inactive</option>
</select>
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
<!----------------------------------------------------------------------->
<!-- End #main -->
<?=$this->endSection()?>
<?=$this->section('custom-script')?>
<script type="text/javascript">
$(document).ready(function() {

// ===============================
        // Create Batch date validation
        // ===============================
        $('form').on('submit', function (e) {
            const startDate = new Date($('#start_date').val());
            const endDate   = new Date($('#end_date').val());

            if (!$('#start_date').val() || !$('#end_date').val()) {
                return true; // HTML required handle করবে
            }

            // start < end
            if (startDate >= endDate) {
                alert('শুরুর তারিখ শেষ তারিখের আগে হতে হবে');
                e.preventDefault();
                return false;
            }

            // gap at least 7 days
            const diffTime = endDate - startDate;
            const diffDays = diffTime / (1000 * 60 * 60 * 24);

            if (diffDays < 7) {
                alert('শুরু ও শেষ তারিখের মধ্যে কমপক্ষে ৭ দিনের ব্যবধান থাকতে হবে');
                e.preventDefault();
                return false;
            }
        });

    ///////////////////////////////////////////////////////////////////////////////
    $('.select_batch').on('change', function() {
        var courseId = $(this).find(":selected").val();
        $.ajax({
            type: 'GET',
            url: '<?=site_url("/teacher/batch-data-from-db");?>',
            data: {
                id: courseId,
            },
            dataType: 'json',
            success: function(data) {
                $('#result_data').empty();
                data.forEach(function(item) {
                    $('#result_data').append(`
                            <tr>
                            <td>${item.start_date}</td>
                            <td>${item.end_date}</td>
                            <td>${item.time_slot}</td>
                            <td>${item.weekly_days}</td>
                            <td>${item.max_seats}</td>
                            <td>${item.status}</td>
                            <td>
                              <button class="btn btn-secondary btn-sm edit_item"  data-batch_id = "${item.batch_id}" data-start_date="${item.start_date}" data-end_date = "${item.end_date}" data-time_slot = "${item.time_slot}" data-weekly_days = "${item.weekly_days}" data-max_seats="${item.max_seats}" data-batch_status= "${item.status}" >Edit</button>
                            </td>
                            </tr>
                            `);
                });
            }
        });
    });
    ///////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////

    var selectedRow;
    var selectedDays;
    var slcetedItem;

    $('body').on('click', '.edit_item', function() {
        // get data from button edit
        selectedRow = $(this).closest('tr');

        slcetedItem = $(this);


        // alert(  $(selectedRow).find('td:eq(3)').text());

        const batch_id = $(this).data('batch_id');
        const start_date = $(this).data('start_date');
        const end_date = $(this).data('end_date');
        const time_slot = $(this).data('time_slot');
        const weekly_days = $(this).data('weekly_days');
        const max_seats = $(this).data('max_seats');
        const batch_status = $(this).data('batch_status');

        $("#batch_id").val(batch_id);
        $("#start_date_edit").val(start_date);
        $("#end_date_edit").val(end_date);
        $("#time_slot").val(time_slot);
        $("#batch_status").val(batch_status);

        //const selectedDays = weekly_days.split(',');
        selectedDays = weekly_days.split(',').map(day => day.trim());

        const daysOfWeek = [{
                day: "Mon"
            }, {
                day: "Tue"
            },
            {
                day: "Wed"
            },
            {
                day: "Thu"
            },
            {
                day: "Fri"
            },
            {
                day: "Sat"
            },
            {
                day: "Sun"
            }
        ];

        const updatedDaysOfWeek = daysOfWeek.map(dayObj => ({
            ...dayObj,
            selected: selectedDays.includes(dayObj.day)
        }));


        let daysContent = updatedDaysOfWeek.map(dayObj => {
            const isChecked = dayObj.selected ? 'checked' :
            ''; // Add checked attribute if selected

            // Return the HTML for each checkbox
            return `
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="weekly_days[]"  value="${dayObj.day}" id="${dayObj.day.toLowerCase()}" ${isChecked}>
            <label class="form-check-label" for="${dayObj.day.toLowerCase()}">${dayObj.day}</label>
        </div>
    `;
        }).join('');

        // console.log(checkboxContainer);

        $("#weekly_days").html(daysContent);
        $("#max_seats").val(max_seats);
        $('#batch_edit_modal').modal('show');

    });
    ////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////
    $('.content_update').on('click', function() {

        const startDate = new Date($('#start_date_edit').val());
        const endDate = new Date($('#end_date_edit').val());

        if (startDate >= endDate) {
            alert('শুরুর তারিখ শেষ তারিখের আগে হতে হবে');
            return false;
        }

        const diffTime = endDate - startDate;
        const diffDays = diffTime / (1000 * 60 * 60 * 24);

        if (diffDays < 7) {
            alert('শুরু ও শেষ তারিখের মধ্যে কমপক্ষে ৭ দিনের ব্যবধান থাকতে হবে');
            return false;
        }



        var batch_id = $("#batch_id").val();
        var start_date_edit = $("#start_date_edit").val();
        var end_date_edit = $("#end_date_edit").val();
        var time_slot = $("#time_slot").val();

        var batch_status = $("#batch_status").val(); // ✅ select value

if(batch_status === "") {
    alert('ব্যাচ স্ট্যাটাস নির্বাচন করুন');
    return false;
}

        // var weekly_days = $("#weekly_days").val();
        var choosedDays = Array.from(document.querySelectorAll('input[name="weekly_days[]"]:checked'))
            .map(checkbox => checkbox.value);
        const queryString = choosedDays.join(',');

        selectedDays = queryString.split(',').map(day => day.trim());



        var max_seats = $("#max_seats").val();
        $($(slcetedItem)[0]).data('weekly_days', queryString);
        // alert(JSON.stringify($(slcetedItem)[0]));
        $.ajax({
            type: 'GET',
            url: '<?=site_url("/teacher/batch-update");?>',
            data: {
                "batch_id": batch_id,
                "start_date_edit": start_date_edit,
                "end_date_edit": end_date_edit,
                "time_slot": time_slot,
                "selectedDays": queryString,
                // weekly_days: weekly_days.join(','), // Send the array as a comma-separated string
                "max_seats": max_seats,
                "batch_status": batch_status
            },
            // dataType: 'json',
            success: function(data) {
                // alert(queryString);

                $(selectedRow).find('td:eq(3)').text(queryString);

  // Update status column
  let statusText = batch_status.charAt(0).toUpperCase() + batch_status.slice(1); // Capitalize first letter
    $(selectedRow).find('td:eq(5)').text(statusText);

                $('#batch_edit_modal').modal('hide');
            }
        });

    });
    ////////////////////////////////////////////////////////////
});


document.getElementById('max_seat').addEventListener('input', function() {
    if (this.value < 1) {
        this.value = 1;
    }
});
</script>
<?=$this->endSection()?>