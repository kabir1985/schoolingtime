<!-- Essential javascripts for application to work-->
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.7.0.min.js') ?>"></script>
<script type="text/javascript" src=" <?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/main.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('homepage_assets/js/popper.min.js') ?>"></script>
<!-- Data table plugin-->
<script type="text/javascript" src="<?php echo base_url('homepage_assets/js/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('homepage_assets/js/dataTables.bootstrap.min.js') ?>"></script>

<!-- Select 2 -->
<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script> -->


<!--------Data Table------>
<script type="text/javascript"> $('#sampleTable').DataTable();</script>
<!------------Toast--------------->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
  $(document).ready(function() {
    const message = '<?php echo $_SESSION["message"];
                      $_SESSION["message"] = ""; ?>';
    if (message != "") {
      Toastify({
        text: message,
        duration: 2000
      }).showToast();

    }

  });
</script>


<?= $this->renderSection("scripts"); ?>

</body>


<script type="text/javascript">
  $(document).ready(function() {
    // alert("LN"+$('select').length);

    //$('select').select2();

    // $("select").select2({
    //   theme: "bootstrap-5",
    //   selectionCssClass: "select2--small",
    //   dropdownCssClass: "select2--small",
    // });

    // get Edit Product
    $(document.body).on('click', '.details-button', function() {
      const course_id = $(this).data('course_id');
      const course_status = $(this).data('course_status');
      //alert(course_status);
      if (course_status == 'approved') {
        $('#course_status').val('pending');
      } else {
        $('#course_status').val('approved');
      }

      $('#course_id').val(course_id);

      $('#DetailsOfCourse').modal('show');
    });


  });
</script>



</html>