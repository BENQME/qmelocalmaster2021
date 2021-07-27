<?php // print_r($users) ?>
<style>
.item_list{margin-bottom:10px}
 .select2-container--default .select2-selection--multiple .select2-selection__choice{width:100%;     font-size: 14px;}
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
                            <h4 class="mb-15">Other Settings</h4>
                             <?php if($sucesess = $this->session->flashdata('sucesess')): ?>
                        <div class="alert alert-success" role="alert">
                         <?php echo $sucesess ?>
                        </div>
                    <?php endif ?>
                            <form action="<?php echo base_url('mbncms/home_category/')  ?>" id="create_page"  method="post">
                                
                                    <div class="row">
      
                                        <div class="col-md-12">
                                            <div class="form-group">
                                               <label for="category">Home Page Spotlights</label>
                                               <?php $top_spotlights = json_decode($top_spotlights); 
											   //print_r($top_spotlights);
											   //$admin_email22 =$p_category->admin_email;
											   //$top_spotlights =$top_spotlights->top_spotlights;
											 
											   
											   
											 ?>
                                               <select class="js-example-basic-multiple w-100" name="top_posts[]" required="required" multiple>
                                                     <?php  $option22 ="" ?>
                                               <?php if($spotlight_all): ?>
												  <?php if($top_spotlights): ?> 
                                                  
                                                       <?php foreach($top_spotlights as $sp):?>
                                                       <?php // print_r($sp);?>
                                                       <?php //if(in_array($cat->categoryTitle,$p_category)){
                                                           $option22 .= '<option selected="selected" value="'.$sp.'">'.$sp.'</option>';
                                                           //unset($categores2[$key]);
                                                      //} ?>
                                                       <?php endforeach;?>
                                                   <?php  endif ?>
                                              <?php echo $option22 ?>
                                               <?php foreach($spotlight_all as $spotlight): ?>
                                              		<option value="<?php echo $spotlight['postTitle'] ?>"><?php echo $spotlight['postTitle'] ?></option>
                                              <?php endforeach;?>
                                              <?php endif;?>
                                                  
                                               </select>
                                            </div>
                                        </div>
                                          <div class="col-md-12">
                                            <div class="form-group">
                                               <label for="category">MBN In Motion News Categories</label>
                                               <?php $p_category = json_decode($home_categories); 
											   $admin_email22 =$p_category->admin_email;
											   $p_category =$p_category->f_spotlights_cats;
											 //  print_r($p_category);
											   
											   
											 ?>
                                               <select class="js-example-basic-multiple w-100" name="spot_category[]" required="required" multiple="multiple">
                                                    <?php $categores2 = $this->db->get('spotlights_category')->result() ?>
                                                     <?php  $option ="" ?>
                                               <?php if($categores2): ?>
                                               <?php foreach($p_category as $key=>$cat): ?>
                                               <?php //if(in_array($cat->categoryTitle,$p_category)){
												   $option .= '<option selected="selected" value="'.$cat.'">'.$cat.'</option>';
												   //unset($categores2[$key]);
											  //} ?>
                                               <?php endforeach;?>
                                              <?php echo $option ?>
                                               <?php foreach($categores2 as $key=>$cat): ?>
                                              		<option value="<?php echo $cat->categoryTitle ?>"><?php echo $cat->categoryTitle ?></option>
                                              <?php endforeach;?>
                                              <?php endif;?>
                                                  
                                               </select>
                                            </div>
                                        </div>
                                         <div class="col-md-12">
                                          <div class="form-group"><label for="category">Admin Email</label>
                                          <input type="text" class="form-control" name="admin_email" value="<?php echo $admin_email22 ?>" /></div>
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
	$("#create_page").validate(
	);
</script>
