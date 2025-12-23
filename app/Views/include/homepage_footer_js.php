   <!-- Vendor JS Files -->
   <script type="text/javascript" src="<?php echo base_url('homepage_assets/vendor/purecounter/purecounter_vanilla.js') ?>"></script>
   <script type="text/javascript" src="<?php echo base_url('homepage_assets/vendor/aos/aos.js') ?>"></script>
   <script type="text/javascript" src="<?php echo base_url('homepage_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
   <script type="text/javascript" src="<?php echo base_url('homepage_assets/vendor/glightbox/js/glightbox.min.js') ?>"></script>
   <script type="text/javascript" src="<?php echo base_url('homepage_assets/vendor/isotope-layout/isotope.pkgd.min.js') ?>"></script>
   <script type="text/javascript" src="<?php echo base_url('homepage_assets/vendor/swiper/swiper-bundle.min.js') ?>"></script>

   <script type="text/javascript" src="<?php echo base_url('homepage_assets/js/jquery3.6.4.min.js') ?>"></script>
   <!-- Template Main JS File -->
   <script type="text/javascript" src="<?php echo base_url('homepage_assets/js/main.js') ?>"></script>

   <!-- Data table plugin-->
   <script type="text/javascript" src="<?php echo base_url('homepage_assets/js/jquery.dataTables.min.js') ?>"></script>
   <script type="text/javascript" src="<?php echo base_url('homepage_assets/js/dataTables.bootstrap.min.js') ?>"></script>
   <!--------Data Table------>
   <script type="text/javascript">
     $('#sampleTable').DataTable();
   </script>

   <!------------------------Social Button---------------------------->
   <script type="text/javascript" src="<?php echo base_url('homepage_assets/js/socialSharing.js') ?>"></script>

   <!-- Select 2 -->
   <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
   <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>

   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>  
 <!------------Toast--------------->
   <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
   <script type="text/javascript">
     $(document).ready(function() {
       /////Select2 strat ////
       $("select").select2({
         theme: "bootstrap-5",
         selectionCssClass: "select2--small",
         dropdownCssClass: "select2--small",
         minimumResultsForSearch: 0, // always allow search
         placeholder: "Select an option",
         allowClear: true // ❌ disables clearing the selection
       });
       //////////select2 end
       const message = '<?= isset($_SESSION["message"]) ? $_SESSION["message"] : '';  $_SESSION["message"] = ''; ?>';

       if (message != "") {
         Toastify({
           text: message,
           duration: 2000
         }).showToast();

      }

     });

     function isNumberKey(evt) {
       var charCode = (evt.which) ? evt.which : evt.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
         return false;
       return true;
     }
   </script>