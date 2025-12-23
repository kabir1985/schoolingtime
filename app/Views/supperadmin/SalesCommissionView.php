<?php echo $this->include("supperadmin/header"); ?>


<main class="app-content">
    <!------------------------------------------------------------------->
    <div class="app-title">
        <div>
            <h1><i class="fa fa-plus"></i>Sales Commission Add & Edit Here</h1>
            <!-- <p>Sample forms</p> -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="tile">
                <!-- <h3 class="tile-title">Select Course Type</h3> -->

                <form action="<?php echo site_url('supperadmin/sales-commission-insert') ?>" method="post">
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label"></label>
                            <input class="form-control" type="text" name="sales_commission_percent" placeholder="Percent Example: 20%" required>
                        </div>

                        <div class="form-group mt-2">
                            <select class="form-select" name="sales_commission_type" aria-label="Default select example" required>
                                <option selected disabled value="">Select Commission Method</option>
                                <?php
                               // foreach ($results1 as $row)
                                 {
                                  //  $course_section_id = $row->course_section_id;
                                   // $course_section_name = $row->course_section_name;
                                    ?>
                                    <option value="straight_commission"><?php  echo "Straight Commission %" ?></option>

                                <?php
                                }
                                ?>
                            </select>

                        </div>


                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>

                </form>

            </div>
        </div>

        <div class="col-md-8">
            <div class="tile">
                <!-- <h3 class="tile-title">Category Edit</h3> -->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Commission %</th>
                                <th>Method Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($results as $row) {
                            ?>
                                <tr>
                                    <form action="<?php echo site_url('supperadmin/sales-commission-update') ?>" method="post">
                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="sales_commission_id" value="<?php echo $row->sales_commission_id; ?>" hidden>
                                                <input class="form-control" type="text" name="sales_commission_percent" value="<?php echo $row->sales_commission_percent; ?>" placeholder="<?php echo $row->sales_commission_percent; ?>">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="sales_commission_type" value="<?php echo $row->sales_commission_type; ?>" placeholder="<?php echo $row->sales_commission_type; ?>" disabled>
                                            </div>
                                        </td>
                                        <td><button type="submit" class="btn btn-secondary"><i class="bi bi-pencil-square"></i>Edit </button></td>
                                    </form>
                                </tr>

                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>

    <!---------------------------------------------------------------------->




</main>


<?php echo $this->include("supperadmin/footer"); ?>