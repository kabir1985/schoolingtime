<?php echo $this->include("supperadmin/header"); ?>


<main class="app-content">
    <!------------------------------------------------------------------->
    <div class="app-title">
        <div>
            <h1><i class="fa fa-plus"></i>Course Type Add Here</h1>
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
                                <option selected disabled>Select Course Type</option>
                                <option value="Online_Video_Course">Online_Video_Course</option>
                                <option value="Online_Live_Coaching">Online_Live_Coaching</option>
                                <option value="Share_Your_Notes">Share_Your_Notes</option>
                                <option value="Question_And_Answer">Question_And_Exam</option>
                            </select>
                        </div>
                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary" type="button">Add Course</button>
                </div>

                </form>

            </div>
        </div>

        <div class="col-md-3"></div>
    </div>

    <!---------------------------------------------------------------------->
</main>


<?php echo $this->include("supperadmin/footer"); ?>