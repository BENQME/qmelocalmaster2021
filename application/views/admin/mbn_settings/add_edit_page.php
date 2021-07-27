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
                            <h4 class="mb-15">CMS Pages <a href="<?php echo base_url('mbncms') ?>" class="btn btn-primary"> back to list</a></h4>
                            <?php if(isset($page_data->pageID)) $id = $page_data->pageID; else $id=""; ?>
                             <?php if($sucesess = $this->session->flashdata('sucesess')): ?>
                        <div class="alert alert-success" role="alert">
                         <?php echo $sucesess ?>
                        </div>
                    <?php endif ?>
                    <?php   $p_category ="";
											  $p_category = $page_data->custom_fields; 
											  $p_category = json_decode($p_category);
											  
											 $emails = $p_category->emails;
											   ?>
                            <form action="<?php echo base_url('mbncms/add_edit_page/').$id  ?>" id="create_page"  method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                           <label class="control-label">Title</label>
                                           <input type="text" name="pageTitle" class="form-control" placeholder="Enter Title" value="<?php if(isset($page_data->pageTitle)) echo $page_data->pageTitle ?>" required="required">
                                        </div>
                                        <div class="form-group">
                                           <label class="control-label">Content</label>
                                           <textarea id="txtEditor" name="pageContent"><?php if(isset($page_data->pageContent)) echo $page_data->pageContent ?></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                           <label for="category">Page Template</label>
                                           <select class="form-control" id="template_name" name="page_template">
                                              <option value="">default</option>
                                              <option<?php if($page_data->template =='about_us') echo ' selected="selected"' ?>  value="about_us">about us</option>
                                              <option<?php if($page_data->template =='sponsors') echo ' selected="selected"' ?>  value="sponsors">Sponsors</option>
                                              <option<?php if($page_data->template =='supplier_signup_thanks') echo ' selected="selected"' ?>  value="supplier_signup_thanks">Supplier Signup Thank You</option>
                                              
                                              <option<?php if($page_data->template =='magazine') echo ' selected="selected"' ?>  value="magazine">Magazine</option>
                                              <option<?php if($page_data->template =='supplier_signup') echo ' selected="selected"' ?>  value="supplier_signup">Supplier Signup</option>
                                              <option<?php if($page_data->template =='contact') echo ' selected="selected"' ?>  value="contact">Contact Us</option>
                                                   <option<?php if($page_data->template =='mbe_supplier') echo ' selected="selected"' ?> 
                                                    value="mbe_supplier">Rigisteration Page</option>
        
                                           </select>
                                        </div>
                                    </div>
                                 </div>
                                  <?php if(($page_data->template =='supplier_signup') || ($page_data->template =='sponser')){ ?>
                                    <div class="row hide_soda2" id="group_sponsors22" data-id="sponser">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                               <label for="category">Spotlights categories</label>
                                               <?php $p_category = json_decode($page_data->spot_category); //print_r($p_category) ?>
                                               <select class="js-example-basic-multiple w-100" name="spot_category[]" multiple="multiple">
                                                    <?php $categores2 = $this->db->order_by("categoryTitle", "asc")->get('spotlights_category')->result() ?>
                                                    
                                               <?php if($categores2): ?>
                                               <?php foreach($categores2 as $cat): ?>
                                              <option<?php if(in_array($cat->categoryTitle,$p_category)) echo ' selected="selected"' ?>  
                                              value="<?php echo $cat->categoryTitle ?>"><?php echo $cat->categoryTitle ?></option>
                                              <?php endforeach;?>
                                              <?php endif;?>
                                                  
                                               </select>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php if(($page_data->template =='supplier_signup')){ ?>
                                     <div class="row">
                                     <div class="col-md-12">
                                          <div class="form-group">
                                     <label for="category">Email Addresses</label>
                                           <input type="text" class="form-control" name="field_val[emails]" value="<?php echo $emails ?>" />
                                           </div>
                                      </div>
                                    </div>
                                    <?php } ?>
                                     <div class="row hide_soda" id="group_magazine" data-id="sponser">
                                     <div class="col-md-12">
                                            <div class="form-group">
                                               <label for="category">Magazine category</label>
                                               <?php 
											   $p_category ="";
											   $p_category = $page_data->magazine_cat; //print_r($p_category) ?>
                                               <select class="form-control" name="magazine_cat">
                                                    <?php $categores222 = $this->db->order_by("categoryTitle", "asc")->get('magazine_cat')->result() ?>
                                                    
                                               <?php if($categores222): ?>
                                               <?php foreach($categores222 as $cat): ?>
                                              <option<?php if($cat->categoryTitle == $p_category) echo ' selected="selected"' ?>  
                                              value="<?php echo $cat->categoryTitle ?>"><?php echo $cat->categoryTitle ?></option>
                                              <?php endforeach;?>
                                              <?php endif;?>
                                                  
                                               </select>
                                            </div>
                                        </div>
                                     
                                     </div>
                                     
                                     <?php if($page_data->template =='mbe_supplier'){
									 ?>
                                     <div class="row hide_soda">
                                     <div class="col-md-12">
                                            <div class="form-group">
                                               <label for="category">Select Parent Category</label>
                                               <?php 
											
											   
											    /*$p_category = json_decode($p_category);
											    $p_category = $p_category; // print_r($p_category) ?>
                                               
                                                    <?php $sponsors_category = $this->db->order_by("categoryTitle", "asc")
													   ->get_where('sponser_category',array('site_id'=>site_id()))->result()*/
													   
													   $sponsors_category = array('supplier','corporate')
													    ?>
                                                    
                                               <?php if($sponsors_category): 
											   ?>
                                               <select class="form-control" name="field_val[sponsors_cat]">
                                               <?php foreach($sponsors_category as $cat): ?>
                                              <option<?php if($cat == $p_category->sponsors_cat) echo ' selected="selected"' ?>  value="<?php echo $cat ?>"><?php echo $cat ?></option>
                                              <?php endforeach;?>
                                              <?php endif;?>
                                                  
                                               </select>
                                            </div>
                                            <div class="form-group">
                                           <label for="category">Price in USD</label>
                                           <input type="number" class="form-control" name="field_val[price]" value="<?php echo $p_category->price ?>" />
                                           </div>
                                        </div>
                                     
                                     </div>
                                     <?php } ?>
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
	  $('#create_page #group_magazine').hide();
	 var def = $('#template_name').find('option:selected').val();
	   id2 = "#create_page #group_"+def;
	   //alert(id2);
	 $(id2).show();
   $('#template_name').change(function(e){
	  var val = $(this).find('option:selected').val();
	 id = "#create_page #group_"+val;
	if(val == 'sponsors'){
	 $("#create_page #group_sponsors").show();
	}else if(val == 'magazine'){
	 $("#create_page #group_magazine").show();
	}else{
		 $("#create_page #group_sponsors").hide();
		  $("#create_page #group_magazine").hide();
	}
   });
});
</script>
<script>
	$("#create_page").validate(
	);
</script>
