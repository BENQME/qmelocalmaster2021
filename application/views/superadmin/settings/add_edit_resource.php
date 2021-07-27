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
                            <h4 class="mb-15"> Contributors Resource Onboarding <a href="<?php echo base_url('settings/site_resource') ?>" class="btn btn-primary"> back to list</a></h4>
                            <?php if(isset($page_data->b_id)) $id = $page_data->b_id; else $id=""; ?>
                             <?php if($sucesess = $this->session->flashdata('sucesess')): ?>
                        <div class="alert alert-success" role="alert">
                         <?php echo $sucesess ?>
                        </div>
                    <?php endif ?>
                            <form action="<?php echo base_url('settings/add_edit_resource/'.$id)  ?>" id="create_page"  method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                     <div class="form-group">
                                           <label class="control-label">CheckBox Label</label>
                                            <input type="text" name="title" required="required" class="form-control" placeholder="Enter Title" value="<?php if(isset($page_data->title)) echo $page_data->title ?>">
                                        </div>
                                        <?php   $p_category ="";
											  $p_category = $page_data->custom_fields; 
											  $p_category = json_decode($p_category);
											  
											 $short_info = $p_category->short_info;
											 $page_title = $p_category->page_title;
											   ?>
                                               <div class="form-group">
                                           <label class="control-label">Page Title</label>
                                            <input type="text" name="field_val[page_title]" class="form-control" required="required" placeholder="Enter Title" value="<?php echo $page_title ?>">
                                        </div>
                                       <div class="form-group">
                                           <label class="control-label">short Info</label>
                                           <textarea style="min-height:150px" id="txtEditor"  name="field_val[short_info]" class="form-control" placeholder="Enter Sort Description" value=""><?php echo $short_info; ?></textarea>
                                        </div>
                                    </div>
                                    
                                    
                                 </div>
                                <div class="row">
                                     <div class="col-md-12">
                                    <p class="text-right">
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
