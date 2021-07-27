<?php // print_r($users) ?>
<style>
.item_list{margin-bottom:10px}
</style>
<link type="text/css" href="<?php echo base_url('assets/editor.css')?>" rel="stylesheet"/>
    <div class="page-content">
        <div class="steelton_home_section">
         <?php include('nav_links.php') ?>
             <div class="tab-content">
                <div class="row">
                
                    <div class="col-md-12 grid-margin stretch-card">
                   
                        <div class="card">
                          <div class="card-body">
                            <h4 class="mb-15">Team Members <a href="<?php echo base_url('mbncms/team') ?>" class="btn btn-primary"> back to list</a></h4>
                            <?php if(isset($page_data->b_id)) $id = $page_data->b_id; else $id=""; ?>
                             <?php if($sucesess = $this->session->flashdata('sucesess')): ?>
                        <div class="alert alert-success" role="alert">
                         <?php echo $sucesess ?>
                        </div>
                    <?php endif ?>
                            <form action="<?php echo base_url('mbncms/add_edit_team/').$id  ?>" id="create_page"  method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                           <label class="control-label">Title</label>
                                           <input type="text" name="title" class="form-control" placeholder="title" value="<?php if(isset($page_data->title)) echo $page_data->title ?>" required="required">
                                        </div>
                                        
                                        
                                         
                                        
                                    </div>
                                    
                                 </div>
                                 <?php $fields = $page_data->custom_fields; 
											  $fields = json_decode($fields); ?>
                                 <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                           <label class="control-label">Short Description</label>
                                           <textarea name="field[short_info]" class="form-control" required="required" style="min-height:110px"><?php if(isset($fields->short_info)) echo $fields->short_info ?></textarea>
                                        </div>
                                        
                                        
                                         
                                        
                                    </div>
                                    
                                 </div>
                                 <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                           <label class="control-label">Full Description</label>
                                           <textarea id="txtEditor" name="field[full_info]" class="form-control" required="required"><?php if(isset($fields->full_info)) echo $fields->full_info ?></textarea>
                                        </div>
                                        
                                        
                                         
                                        
                                    </div>
                                    
                                 </div>
                                    <div class="row" style="align-items: center;">
                                            <div class="col-md-6">
                                            <div class="form-group">
                                               <label for="category">Thumbnail(400x300)</label>
                                               
                                               <input type="file" class="form-control" name="thumbnail" accept="image/*" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 ">
                                          <?php if($page_data->thumbnail): ?>
                                               <img style="height:150px" src="<?php echo base_url('uploads/team/'.$page_data->thumbnail)	 ?>" class="img-thumbnail pull-right" />
                                               <?php endif;?> 
                                          </div>
                                        </div>
                                        
                                        
                                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                           <label class="control-label">Linkedin Profile URL</label>
                                           <input type="url" name="field[linkedin]" class="form-control" placeholder="URL" value=" <?php if(isset($fields->linkedin)) echo $fields->linkedin ?>" required="required">
                                        </div>
                                        
                                        
                                         
                                        
                                    </div>
                                    
                                 </div>
                                <div class="row">
                                     <div class="col-md-12">
                                    <p class="text-right">
                                    <br />
                                        <button type="submit" name="submit" value="1" class="btn btn-primary contentBTn">Submit</button>
                                         <!-- <a href="create_a_spotlight-two.html" class="btn btn-primary contentBTn">Next</a> -->
                                      </p>
                                      </div>
                              </div>
                              
                            </form>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});

</script>
<script>
	$("#create_page").validate(
	);
</script>
