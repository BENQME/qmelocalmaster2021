<div class="page-content">
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div>
          <h4 class="mb-3 mb-md-0"> Settings</h4>
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
                   
                <?php if( $email_templates = $this->db->get('email_template')->result()): ?>
                <?php foreach($email_templates as $template): ?>
                    <div class="col-md-12 grid-margin ">
                    
                        <div class="card rounded">
                            <div class="card-header">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                                                                
                                         <div class="ml-2">
                                            <h5><?php echo $template->admin_title ?></h5>
                                         </div>
                                    </div>
                                </div>
                            </div>
                            <form method="post" action="<?php echo base_url('settings') ?>">
                                <div class="card-body">
                                    <div class="form-group card_content mb-2">
                                    <label>Subject</label>
                                   		<input type="text" required="required" name="subject" class="form-control" value="<?php echo $template->subject ?>" />
                                    </div>
                                    <div class="form-group card_content mb-2">
                                    <label>Body</label>
                                   		<textarea type="text" required="required" name="body" rows="10" class="form-control"><?php echo $template->template ?></textarea>
                                        <p><br />
                                        <strong>Available Shortcodes</strong><br />
										<?php echo $template->shortcode ?>
                                        </p>
                                    </div>
                                      <div class="card_content mb-2" style="margin-bottom: 30px !important;">
                                        <input type="hidden"  name="template_id" value="<?php echo $template->id ?>" />
                                         <button class="btn btn-primary" type="submit" name="submit" value="1">Update</button>
                                    </div>
                                 </div>
                                
                            </form>
                        </div>
                     
                    </div>
                     <?php endforeach;?>
                   <?php endif;?>
                </div> <!-- row -->
            </div> <!-- tab 1 -->
        </div>		
    </div>
</div>