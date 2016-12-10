<!DOCTYPE html>
<html lang="en">
  <?php $this->load->view("seller/component/head") ?>
  <body class="nav-md footer_fixed">
    <div class="container body">
      <div class="main_container">
        <?php $this->load->view("seller/component/main-nav") ?>
        

        <!-- top navigation -->
        <?php $this->load->view("seller/component/top-nav") ?>
        <!-- /top navigation -->

        <!-- page content -->
        <?php $this->load->view($page) ?>
        <!-- /page content -->

        <!-- footer content -->
        <?php // $this->load->view("seller/component/footer") ?>
        <!-- /footer content -->
      </div>
    </div>
    <!-- confirm modal -->
    <?php $this->load->view("seller/component/confirm-modal") ?>
    <!-- /confirm modal -->

    <!-- notify wrapper -->
    <div id="custom_notifications" class="custom-notifications dsp_none">
      <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
      </ul>
      <div class="clearfix"></div>
      <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <!-- /compose -->
    
    <!-- jQuery -->
    <script src="/public/admin/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="/public/admin/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- NProgress -->
    <script src="/public/admin/vendors/nprogress/nprogress.js"></script>
    <!-- validator -->
    <!-- <script src="/public/admin/assets/js/validator.js"></script> -->
    <script src="/public/admin/vendors/validator/validator.js"></script>
    
    <!-- bootstrap-wysiwyg -->
    <script src="/public/admin/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <!-- jQuery Tags Input -->
    <script src="/public/admin/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    
    <!-- Jquery Form -->
    <script src="/public/admin/assets/js/jquery.form.js"></script>
    
    <!-- Tiny MCE Scripts -->
    <script src="/public/admin/assets/js/tinymce/tinymce.min.js"></script>
    
    <!-- Select2 -->
    <script src="/public/admin/vendors/select2/dist/js/select2.full.min.js"></script>
    <script src="/public/admin/vendors/select2/dist/js/i18n/vi.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="/public/admin/assets/js/custom.js"></script>
    
    <!-- UI Scripts -->
    <script src="/public/admin/assets/js/ui.js"></script>
    
    <!-- Hook Scripts -->
    <script src="/public/admin/assets/js/CF.js"></script>

  </body>
</html>