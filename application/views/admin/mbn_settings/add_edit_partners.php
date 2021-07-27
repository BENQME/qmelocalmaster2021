<?php // print_r($users) ?>
<style>
.item_list{margin-bottom:10px}
</style>

    <div class="page-content">
        <div class="steelton_home_section">
         <?php include('nav_links.php') ?>
             <div class="tab-content">
                <div class="row">
                
                    <div class="col-md-12 grid-margin stretch-card">
                   
                        <div class="card">
                          <div class="card-body">
                            <h4 class="mb-15">Partners <a href="<?php echo base_url('mbncms/partners') ?>" class="btn btn-primary"> back to list</a></h4>
                            <?php if(isset($page_data->b_id)) $id = $page_data->b_id; else $id=""; ?>
                             <?php if($sucesess = $this->session->flashdata('sucesess')): ?>
                        <div class="alert alert-success" role="alert">
                         <?php echo $sucesess ?>
                        </div>
                    <?php endif ?>
                            <form action="<?php echo base_url('mbncms/add_edit_partners/').$id  ?>" id="create_page"  method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                           <label class="control-label">URL</label>
                                           <input type="text" name="title" class="form-control" placeholder="URL" value="<?php if(isset($page_data->title)) echo $page_data->title ?>" required="required">
                                        </div>
                                        
                                        
                                         
                                        
                                    </div>
                                    
                                 </div>
                                    <div class="row" style="align-items: center;">
                                            <div class="col-md-6">
                                            <div class="form-group">
                                               <label for="category">Thumbnail(291x174)</label>
                                               
                                               <input type="file" class="form-control" name="thumbnail" accept="image/*" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 ">
                                          <?php if($page_data->thumbnail): ?>
                                               <img style="height:150px" src="<?php echo base_url('uploads/home_sponsors/'.$page_data->thumbnail)	 ?>" class="img-thumbnail pull-right" />
                                               <?php endif;?> 
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
$( document ).ready(function() {
	 $('#create_page #group_sponsors').hide();
	 var def = $('#template_name').find('option:selected').val();
	   id2 = "#create_page #group_"+def;
	   //alert(id2);
	 $(id2).show();
   $('#template_name').change(function(e){
	  var val = $(this).find('option:selected').val();
	 id = "#create_page #group_"+val;
	if(val == 'sponsors'){
	 $("#create_page #group_sponsors").show();
	}else{
		 $("#create_page #group_sponsors").hide();
	}
   });
});
</script>
<script>
	$("#create_page").validate(
	);
</script>
