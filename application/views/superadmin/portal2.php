<div class="page-content">
		<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
          <div>
            <h4 class="mb-3 mb-md-0">Add Content to Portal</h4>
          </div>
          <div class="d-flex align-items-center flex-wrap text-nowrap">

          </div>
        </div>
		
		<?php /*?><div class="row">
			<div class="col-md-12 stretch-card">
			  <div class="card">
				<div class="card-body">
					<h4 class="card-title">Create New Portal</h4>
                       <?php if(validation_errors()){ ?>
                      <div class="alert alert-danger"><?php echo validation_errors(); ?></div>
                     <?php } ?>
                         <?php if($sucesess = $this->session->flashdata('sucesess')): ?>
                    <div class="alert alert-success" role="alert">
                     <?php echo $sucesess ?>
                    </div>
                <?php endif ?>
					<form id="portal" action="<?php echo base_url('superadmin/add_portal') ?>" method="post">
                        <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label class="control-label">First Name </label>
                                <input type="text" class="form-control" name="f_name" value="<?php echo set_value('f_name') ?>" required="required" placeholder="Enter First Name ">
                              </div>
                              
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label class="control-label">Last Name </label>
                                <input type="text" class="form-control" name="l_name" value="<?php echo set_value('l_name') ?>" required="required" placeholder="Enter Last Name ">
                              </div>
                              
                            </div>
                        </div>
					  <div class="row">
						<div class="col-sm-4">
						  <div class="form-group">
							<label class="control-label">Portal Title </label>
							<input type="text" class="form-control" name="portal_name" value="<?php echo set_value('portal_name') ?>" required="required" placeholder="Enter Portal Title">
						  </div>
						</div><!-- Col -->
						<div class="col-sm-4">
						  <div class="form-group">
							<label class="control-label">Region </label>
							<input type="text" class="form-control" name="region" value="<?php echo set_value('region') ?>" required="required" placeholder="Enter Region ">
						  </div>
						</div><!-- Col -->
                        <div class="col-sm-4">
						  <div class="form-group">
							<label class="control-label">Zipcode </label>
							<input type="text" class="form-control" name="zip_code" value="<?php echo set_value('zip_code') ?>" required="required" placeholder="Enter Zipcode ">
						  </div>
						</div>
					  </div><!-- Row -->
					  <div class="row">
						<!-- Col -->
						<div class="col-sm-4">
						  <div class="form-group">
							<label class="control-label">Username of the portal </label>
							<input type="email" class="form-control" name="email" value="<?php echo set_value('email') ?>" required="required" placeholder="Enter Email Address">
						  </div>
						</div><!-- Col -->
                        <div class="col-sm-4">
						  <div class="form-group">
							<label class="control-label">Domain name </label>
							<input type="url" name="domain" class="form-control" value="<?php echo set_value('domain') ?>" placeholder="Enter URL ">
						  </div>
						</div><!-- Col -->
						<div class="col-sm-4">
						  <div class="form-group">
							<label class="control-label">URL (subdomain in case of no domain)</label>
							<input type="url" class="form-control" name="url" value="<?php echo set_value('url') ?>"  placeholder="Enter URL ">
						  </div>
						</div><!-- Col -->
                       
					  </div><!-- Row -->
                      
					  	<button type="submit" name="submit" value="1" class="btn btn-primary submit">CREATE</button>
					</form>
				
				</div>
			  </div>
			</div>
  
		</div> <!-- row --><?php */?>


		  <div class="row">
			<div class="col-md-12 stretch-card">
			  <div class="card">
				<div class="card-body">
                <h4 class="card-title">Create New Portal</h4>
                       <?php if(validation_errors()){ ?>
                      <div class="alert alert-danger"><?php echo validation_errors(); ?></div>
                     <?php } ?>
                         <?php if($sucesess = $this->session->flashdata('sucesess')): ?>
                    <div class="alert alert-success" role="alert">
                     <?php echo $sucesess ?>
                    </div>
                <?php endif ?>
					<form id="portal" action="<?php echo base_url('superadmin/add_portal_step2') ?>" method="post">
					<h4 class="card-title">The Portal seems very empty, would you like to share the global content/spotlights to the this portal?</h4>
					<?php $portal_id = $this->uri->segment(3) ?>
					 <a  href="<?php echo base_url('superadmin/add_content/'.$portal_id) ?>" class="btn btn-success submit">Yes, Do it.</a>
                     <a href="<?php echo base_url('superadmin/portal_list') ?>" class="btn btn-danger submit">No, Not at the moment </a>
                    </form>
				</div>
			  </div>
			</div>
  
		</div> <!-- row -->	



		
	</div>
    
<script>
$("#portal").validate(
);
</script>
