<div class="page-content">
		<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
          <div>
            <h4 class="mb-3 mb-md-0"><?php if(isset($portal_info)) echo 'Update Portal';else echo 'New Portal' ?></h4>
          </div>
          <div class="d-flex align-items-center flex-wrap text-nowrap">

          </div>
        </div>
		
		<div class="row">
			<div class="col-md-12 stretch-card">
			  <div class="card">
				<div class="card-body">
                <?php //print_r($portal_info) ?>
					<h4 class="card-title"><?php if(isset($portal_info)) echo 'Update Portal';else echo 'Create New Portal' ?></h4>
                       <?php if(validation_errors()){ ?>
                      <div class="alert alert-danger"><?php echo validation_errors(); ?></div>
                     <?php } ?>
                         <?php if($sucesess = $this->session->flashdata('sucesess')): ?>
                    <div class="alert alert-success" role="alert">
                     <?php echo $sucesess ?>
                    </div>
                <?php endif ?>
                <?php //print_r($portal_info) ?>
					<form id="portal" action="<?php echo base_url('superadmin/add_portal') ?>" method="post">
                        <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label class="control-label">First Name </label>
                                <input type="text" class="form-control" name="f_name" value="<?php
								
								if(isset($portal_info->first_name)) echo $portal_info->first_name;else
								 echo set_value('f_name') ?>" required="required" placeholder="Enter First Name ">
                              </div>
                              
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label class="control-label">Last Name </label>
                                <input type="text" class="form-control" name="l_name" value="<?php 
								if(isset($portal_info->last_name)) echo $portal_info->last_name;else
								
								
								echo set_value('l_name') ?>" required="required" placeholder="Enter Last Name ">
                              </div>
                              
                            </div>
                        </div>
					  <div class="row">
						<div class="col-sm-4">
						  <div class="form-group">
							<label class="control-label">Portal Title </label>
							<input type="text" class="form-control" name="portal_name" value="<?php 
							
							
							if(isset($portal_info->site_name)) echo $portal_info->site_name;else
							
							echo set_value('portal_name') ?>" required="required" placeholder="Enter Portal Title">
						  </div>
						</div><!-- Col -->
						<div class="col-sm-4">
						  <div class="form-group">
							<label class="control-label">Region </label>
							<input type="text" class="form-control" name="region" value="<?php
							
							if(isset($portal_info->site_name)) echo $portal_info->site_name;else
							
							 echo set_value('region') ?>" required="required" placeholder="Enter Region ">
						  </div>
						</div><!-- Col -->
                        <div class="col-sm-4">
						  <div class="form-group">
							<label class="control-label">Zipcode </label>
							<input type="text" class="form-control" name="zip_code" value="<?php
							
							if(isset($portal_info->zip_code)) echo $portal_info->zip_code;else
							
							 echo set_value('zip_code') ?>" required="required" placeholder="Enter Zipcode ">
						  </div>
						</div>
					  </div><!-- Row -->
					  <div class="row">
						<!-- Col -->
						<div class="col-sm-4">
						  <div class="form-group">
							<label class="control-label">Username of the portal </label>
							<input type="email" class="form-control" name="email" value="<?php
							
							if(isset($portal_info->email)) echo $portal_info->email;else
							 echo set_value('email') ?>" required="required" <?php  if(isset($portal_info)) echo 'disabled="disabled"' ?>  placeholder="Enter Email Address">
						  </div>
						</div><!-- Col -->
                        <div class="col-sm-4">
						  <div class="form-group">
							<label class="control-label">Domain name </label>
							<input type="url" name="domain" class="form-control" value="<?php
							if(isset($portal_info->domain)) echo $portal_info->domain;else
							
							 echo set_value('domain') ?>" placeholder="Enter URL ">
						  </div>
						</div><!-- Col -->
						<div class="col-sm-4">
						  <div class="form-group">
							<label class="control-label">URL (subdomain in case of no domain)</label>
							<input type="url" class="form-control" name="url" value="<?php
							if(isset($portal_info->url)) echo $portal_info->url;else
							 echo set_value('url') ?>"  placeholder="Enter URL ">
						  </div>
						</div><!-- Col -->
                       
					  </div><!-- Row -->
                      <?php if(isset($portal_info)): ?>
                      <input type="hidden" name="user_idd" value="<?php echo $portal_info->userID; ?>" />
                      <input type="hidden" name="web_id" value="<?php echo $portal_info->site_id; ?>" />
                      <?php endif;?>
					  	<button type="submit" name="submit" value="1" class="btn btn-primary submit">
                        <?php if(isset($portal_info)) echo 'UPDATE';else echo 'CREATE' ?>
                        </button>
					</form>
				
				</div>
			  </div>
			</div>
  
		</div>
        
        
        
        
        <?php if(isset($portal_info)): ?>
        <div class="row" style="margin-top:20px">
			<div class="col-md-12 stretch-card">
			  <div class="card">
				<div class="card-body">
                <?php //print_r($portal_info) ?>
					<h4 class="card-title"><?php  echo 'Add New Admin User' ?></h4>
            
                         <?php if($success44 = $this->session->flashdata('success44')): ?>
                    <div id="success44" class="alert alert-success" role="alert">
                     Added Successfully
                    </div>
                <?php endif ?>
                <?php //print_r($portal_info) ?>
					<form id="portal" action="<?php echo base_url('superadmin/add_adminuser') ?>" method="post">
                            <div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label class="control-label">First Name</label>
                                    <input type="text" class="form-control" name="first_name" required="required" placeholder="Enter First Name">
                                  </div>
                                  
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label class="control-label">Last Name </label>
                                    <input type="text" class="form-control" name="last_name" required="required" placeholder="Enter Last Name">
                                  </div>
                                  
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label class="control-label">User Email </label>
                                <input type="email" class="form-control" name="user_email" required="required" placeholder="Enter User Email">
                              </div>
                              
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label class="control-label">User Password </label>
                                <input type="password" class="form-control" name="user_password" required="required" placeholder="Enter User Password">
                              </div>
                              
                            </div>
                        </div>
                      <input type="hidden" name="web_id" value="<?php echo $portal_info->site_id; ?>" />
					  	<button type="submit" name="submit_user" value="1" class="btn btn-primary submit">
                     Add Admin User
                        </button>
					</form>
				
				</div>
			  </div>
			</div>
            
            <div class="col-md-12 stretch-card" style="margin-top:20px">
			  <div class="card">
				<div class="card-body">
                <h4 class="card-title"><?php  echo 'Admin Users' ?></h4>
                  <?php if($success55 = $this->session->flashdata('success55')): ?>
                    <div id="success55" class="alert alert-success" role="alert">
                     Deleted Sucessfully
                    </div>
                <?php endif ?>
                <?php $users = $this->db->get_where('users',array('user_type'=>2, 'level'=>1, 'site_id'=>$portal_info->site_id))->result() ?>
               <?php if($users): //print_r($users)?>
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($users as $user): ?>
                          <tr>
                            <td><?php echo $user->userID ?></td>
                             <td><?php echo $user->first_name ?> <?php echo $user->last_name ?></td>
                            <td><?php echo $user->email ?></td>
                            
                            <td>
                             
                           
                         
                         
         
<button style="margin-top:10px; color:#fff" class="btn btn-sm btn-danger" data-toggle="modal" 
data-target="#confirm-delete2_<?php echo $user->userID ?>">
 Delete
</button>
                            
                            
                            </td>
                          </tr>
                      <?php endforeach;?>
                      
                    </tbody>
                  </table>
                </div>
                <?php else: ?>
                <h5> No Admin Users added yet</h5>
                <?php endif;?>				
				</div>
			  </div>
			</div>
  
		</div>
        
        
        <div class="row" style="margin-top:20px">
			<div class="col-md-12 stretch-card">
			  <div class="card">
				<div class="card-body">
                <?php //print_r($portal_info) ?>
					<h4 class="card-title"><?php  echo 'Add New Zip Code' ?></h4>
            
                         <?php if($success2 = $this->session->flashdata('success2')): ?>
                    <div id="success2" class="alert alert-success" role="alert">
                     <?php echo $success2 ?>
                    </div>
                <?php endif ?>
                <?php //print_r($portal_info) ?>
					<form id="portal" action="<?php echo base_url('superadmin/add_zip') ?>" method="post">
                        <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label class="control-label">Zip Code </label>
                                <input type="text" class="form-control" name="zip_code" required="required" placeholder="Enter Zipcode">
                              </div>
                              
                            </div>
                            
                        </div>
                      <input type="hidden" name="web_id" value="<?php echo $portal_info->site_id; ?>" />
					  	<button type="submit" name="submit_zip" value="1" class="btn btn-primary submit">
                     Add ZipCode
                        </button>
					</form>
				
				</div>
			  </div>
			</div>
            
            <div class="col-md-12 stretch-card" style="margin-top:20px">
			  <div class="card">
				<div class="card-body">
                <h4 class="card-title"><?php  echo 'Zip Codes' ?></h4>
                  <?php if($success3 = $this->session->flashdata('success3')): ?>
                    <div id="success3" class="alert alert-success" role="alert">
                     <?php echo $success3 ?>
                    </div>
                <?php endif ?>
                <?php $zipcodes = $this->db->get_where('zip_codes',array('site_id'=>$portal_info->site_id))->result() ?>
               <?php if($zipcodes): //print_r($users)?>
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>Zip Code</th>
                      
                        <th>Region</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($zipcodes as $zipcode): ?>
                          <tr>
                            <td>
							<?php echo $zipcode->zip_code ?></td>
                            <td><?php print_r($portal_info->site_name) ?></td>
                            
                            <td>
                             
                           
                         
                         
         
<button style="margin-top:10px; color:#fff" class="btn btn-sm btn-danger" data-toggle="modal" 
data-target="#confirm-delete_<?php echo $zipcode->id ?>">
 Delete
</button>
                            
                            
                            </td>
                          </tr>
                      <?php endforeach;?>
                      
                    </tbody>
                  </table>
                </div>
                <?php else: ?>
                <h5> No Zipcode added yet</h5>
                <?php endif;?>				
				</div>
			  </div>
			</div>
  
		</div>
		<?php endif ?>
	</div>
     <?php if($users): //print_r($users)?>
    <?php foreach($users as $user): ?>
        <div class="modal fade" id="confirm-delete2_<?php echo $user->userID ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <div class="modal-body">
                       <h4> Are You Sure?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a href="<?php echo base_url('superadmin/delete_adminuser/'.$user->userID .'?site_id='.$portal_info->id) ?>" style="color:#fff" class="btn btn-danger btn-ok">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach;?>
     <?php endif;?>
     
      <?php if($zipcodes): //print_r($users)?>
    <?php foreach($zipcodes as $zipcode): ?>
        <div class="modal fade" id="confirm-delete_<?php echo $zipcode->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <div class="modal-body">
                       <h4> Are You Sure?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a href="<?php echo base_url('superadmin/delete_zip/'.$zipcode->id.'?site_id='.$portal_info->id) ?>" style="color:#fff" class="btn btn-danger btn-ok">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach;?>
     <?php endif;?>
     
     
<script>
$("#portal").validate(
);
</script>
