<div class="page-content">
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div>
          <h4 class="mb-3 mb-md-0"> MBN CMS</h4>
        </div>
        
      </div>

    <br />
    <div class="steelton_home_section">
		
		
		<?php include('nav_links.php') ?>
        
        <?php if($sucesess = $this->session->flashdata('sucesess')): ?>
                        <div class="alert alert-success" role="alert">
                         <?php echo $sucesess ?>
                        </div>
                    <?php endif ?>
        <div class="tab-content">
            
            <div class="tab-pane22" style="display:block">
            
                <div class="row set-card-spacing">
                    
                <?php if( $email_settings = $this->db->get('email_settings')->row()): ?>
                    <div class="col-md-12 grid-margin ">
                    
                        <div class="card rounded">
                            <div class="card-header">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                                                                
                                         <div class="ml-2">
                                            <h5>SMTP Settings</h5>
                                         </div>
                                    </div>
                                </div>
                            </div>
                            <form method="post" action="<?php echo base_url('settings/smtp') ?>">
                                <div class="card-body">
                                    <div class="form-group card_content mb-2">
                                    <label>Host</label>
                                   		<input required="required" type="text" name="host" class="form-control" value="<?php echo $email_settings->host ?>" />
                                    </div>
                                    <div class="form-group card_content mb-2">
                                    <label>Port</label>
                                   		<input required="required" type="text" name="port" class="form-control" value="<?php echo $email_settings->port ?>" />
                                    </div>
                                    <div class="form-group card_content mb-2">
                                    <label>username</label>
                                   		<input required="required" type="text" name="username" class="form-control" value="<?php echo $email_settings->username ?>" />
                                    </div>
                                    <div class="form-group card_content mb-2">
                                    <label>password</label>
                                   		<input required="required" type="text" name="password" class="form-control" value="<?php echo $email_settings->password ?>" />
                                    </div>
                                     <div class="form-group card_content mb-2">
                                    <label>From Email</label>
                                   		<input required="required" type="text" name="from_mail" class="form-control" value="<?php echo $email_settings->from_mail ?>" />
                                    </div>
                                    
                                      <div class="card_content mb-2" style="margin-bottom: 30px !important;">
                                         <button class="btn btn-primary" type="submit" name="submit" value="1">Update</button>
                                    </div>
                                 </div>
                                
                            </form>
                        </div>
                     
                    </div>
                   <?php endif;?>
                </div> <!-- row -->
            </div> <!-- tab 1 -->
        </div>		
    </div>
</div>