<!DOCTYPE html>
<html lang="en">
   <?php $this->load->view('enduser/layouts/partials/header'); ?>
   <body>
      <div class="main-wrapper">
      	<?php
		$current_user = $this->db->get_where('users',array('userID'=> $this->session->userdata('user_id')))->row();
			if(isset($current_user) && $current_user->level==1){
				$this->load->view('admin/layouts/partials/dheader');
			}elseif(isset($current_user) && $current_user->level==3){
				$this->load->view('superadmin/layouts/partials/dheader');
			}else{
			$this->load->view('enduser/layouts/partials/dheader');
			}
		
		
		  ?>	
      	<?php //$this->load->view('enduser/layouts/partials/dheader'); ?>
      	<div class="page-wrapper">
        <?php echo $page_content ?>
        <?php $this->load->view('enduser/layouts/partials/dfooter'); ?>
        </div>
      </div>
      <?php $this->load->view('enduser/layouts/partials/footer'); ?>
   </body>
</html>