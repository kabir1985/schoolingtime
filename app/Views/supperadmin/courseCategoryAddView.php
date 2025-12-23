<?php echo $this->include("supperadmin/header"); ?>


<main class="app-content">
    <!------------------------------------------------------------------->
    <div class="app-title">
        <div>
            <h1><i class="fa fa-plus"></i>Course Category Add & Edit Here</h1>
            <!-- <p>Sample forms</p> -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="tile">
                <!-- <h3 class="tile-title">Select Course Type</h3> -->

                <form action="<?php echo site_url('supperadmin/coursecategoryinsert') ?>" method="post">
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label"></label>
                            <input class="form-control" type="text" name="course_category_name" placeholder="Enter category name" required>
                        </div>

                        <div class="form-group mt-2">
                            <select class="form-select course_section" name="course_section_id" aria-label="Default select example" required>
                                <option selected disabled value="">Select Course Section</option>
                                <?php
                                foreach ($results1 as $row)
                                 {
                                    $course_section_id = $row->course_section_id;
                                    $course_section_name = $row->course_section_name;
                                    ?>
                                    <option value="<?php echo $course_section_id; ?>"><?php echo $course_section_name; ?></option>

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
                                <th>Category Name</th>
                                <th>Section Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($results as $row) {
                            ?>
                                <tr>
                                    <form action="<?php echo site_url('supperadmin/coursecategoryupdate') ?>" method="post">
                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="course_category_id" value="<?php echo $row->course_category_id; ?>" hidden>
                                                <input class="form-control" type="text" name="course_categroy_name" value="<?php echo $row->course_category_name; ?>" placeholder="<?php echo $row->course_category_name; ?>">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input class="form-control" type="text"  placeholder="<?php
                                                 $course_section_id = $row->course_section_id; 
                                                 $db = \Config\Database::connect();
                                                 $sql = "SELECT * FROM  course_section Where course_section_id = '$course_section_id' ";
                                                 $course_section_result = $db->query($sql)->getRow();

                                                 echo $course_section_result->course_section_name;


                                                 ?>" disabled>
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