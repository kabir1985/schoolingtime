<?php echo $this->include("supperadmin/header"); ?>


<main class="app-content">
    <!------------------------------------------------------------------->
    <div class="app-title">
        <div>
            <h1><i class="fa fa-plus"></i>Course Section Add Here</h1>
            <!-- <p>Sample forms</p> -->
        </div>
        <!-- <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item"><a href="#">Sample Forms</a></li>
        </ul> -->
    </div>

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="tile">
                <!-- <h3 class="tile-title">Select Course Type</h3> -->
                <div class="tile-body">
                    <form>
                        <div class="form-group">
                            <select class="form-control" id="exampleSelect1">
                                <option selected disabled>Select Course Section</option>
                                <option value="Academic_Course">Academic_Course</option>
                                <option value="Skill_Development">Skill_Development</option>
                                <option value="Exam_Course">Exam_Course</option>
                            </select>
                        </div>
                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary" type="button">Add Course Section</button>
                </div>

                </form>

            </div>
        </div>

        <div class="col-md-3"></div>
    </div>

    <!---------------------------------------------------------------------->
</main>


<?php echo $this->include("supperadmin/footer"); ?>