<style>
.support_services .card img {
    height: 140px;
    max-width: 100%;
    max-height: 150px;
    object-fit: contain;
}
</style>

<div class="page-content support_services">

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Explore our Support Services 
        <?php $user_level = $this->session->userdata('user_level'); 
		if($user_level ==1){		
		?>
        <a href="<?php echo base_url('admin/add_resources') ?>" class="btn btn-primary" style="margin-left:5px"> Add New Service</a>
        <?php } ?>
        </h4>
    </div>
    </div>
        <?php if($resources): ?>
        <?php $i=0; foreach($resources as $rs): ?>
        <?php if($i%3==0) echo '<div class="row">'; $i++; ?>
       
            <div class="col-md-4 grid-margin">

                <div class="card">
                    
                    <div class="card-body">
                        <p class="text-center">	
                          <?php if($rs->img){ ?>
                          <img src="<?php echo base_url('uploads/res/'.$rs->img) ?>" class="" alt="<?php echo $rs->title ?>">
                          <?php }else{ ?>
                            <img src="<?php echo base_url('assets/images/support_services1.png') ?>" class="" alt="<?php echo $rs->title ?>">
                            <?php }?>
                        </p>
                        <hr>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                                                                    
                              <div class="mt-2">
                                <h6><?php echo $rs->title  ?></h6>
                                <p class="tx-14 text-muted"><?php echo $rs->description  ?></p>
                              </div>
                            </div>
                            <div class="dropdown">
                              <a target="_blank" href="<?php echo $rs->link ?>" class="btn btn-primary" type="button">
                                Explore
                              </a>
                              
                            </div>
                            
                          </div>
                          <?php if($user_level ==1){?>
                          <hr>
                          <div class="clearfix">
                            
                              	<a class="btn btn-success btn-sm" href="<?php echo base_url('admin/add_resources/'.$rs->id) ?>">Edit</a>
                                <a style="color:#FFFFFF" class="btn btn-danger  btn-sm" data-toggle="modal" data-target="#confirm-delete_<?php echo $rs->id ?>">
 Delete
</a>
                              </div>
                               <?php } ?>
                    </div>
                </div>

            </div>
            
            
          <?php if($i%3==0 || count($resources) == $i) echo '</div>'; ?>
          
        <div class="modal fade" id="confirm-delete_<?php echo $rs->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <div class="modal-body">
                       <h4> Are You Sure?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a href="<?php echo base_url('admin/delete_resources/'.$rs->id) ?>" style="color:#fff" class="btn btn-danger btn-ok">Delete</a>
                    </div>
                </div>
            </div>
        </div>
   <?php endforeach;?>
  <?php endif;?>
     





</div>