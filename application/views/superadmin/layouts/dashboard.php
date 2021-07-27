<!DOCTYPE html>
<html lang="en">
   <?php $this->load->view('superadmin/layouts/partials/header'); ?>
   <body>
      <div class="main-wrapper">	
      	<?php $this->load->view('superadmin/layouts/partials/dheader'); ?>
      	<div class="page-wrapper">
        <?php echo $page_content ?>
        <?php $this->load->view('superadmin/layouts/partials/dfooter'); ?>
        </div>
      </div>
      <?php $this->load->view('superadmin/layouts/partials/footer'); ?>
   </body>
</html>