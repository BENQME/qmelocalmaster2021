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
                            <h4 class="mb-15">Sponsored Businesses <a href="<?php echo base_url('mbncms/sponsers') ?>" class="btn btn-primary"> back to list</a></h4>
                            <?php if(isset($page_data->s_id)) $id = $page_data->s_id; else $id=""; ?>
                             <?php if($sucesess = $this->session->flashdata('sucesess')): ?>
                        <div class="alert alert-success" role="alert">
                         <?php echo $sucesess ?>
                        </div>
                    <?php endif ?>
                            <form action="<?php echo base_url('mbncms/add_edit_sponsers/').$id  ?>" id="create_page" enctype="multipart/form-data"  method="post">
                                <div class="row">
                                        <div class="col-md-12">
                                        <?php $url_array =  (array)json_decode($page_data->url);
										//print_r($url_array); die;
										 ?>
                                        
                                        <div class="form-group">
                                        <label class="control-label">Add Business Name</label>
                                        <input type="text" name="title" class="form-control" placeholder="Enter Title" value="<?php if(isset($page_data->title)) echo $page_data->title ?>" required="required">
                                        </div>
                                        <div class="form-group">
                                        <label class="control-label">Add Bussiness Short Copy</label>
                                        <textarea id="txtEditor" name="content"><?php if(isset($page_data->content)) echo $page_data->content ?></textarea>
                                        </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                               <label for="website">Wesbite</label>
                                              <input type="url" name="website" class="form-control" placeholder="Enter URL" value="<?php if(isset($url_array['website'])) echo $url_array['website'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="form-group">
                                           <label for="category">Spotlight URL </label>
                                          <input type="url" name="spot_url" class="form-control" placeholder="Enter URL" value="<?php if(isset($url_array['spot_url'])) echo $url_array['spot_url'] ?>">
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="form-group">
                                           <label for="category">Profile </label>
                                          <input type="url" name="profile" class="form-control" placeholder="Enter URL" value="<?php if(isset($url_array['profile'])) echo $url_array['profile'] ?>">
                                        </div>
                                        </div>
                              </div>
                                        <div class="row" style="align-items: center;">
                                            <div class="col-md-6">
                                            <div class="form-group">
                                               <label for="category">Bussiness Image</label>
                                               
                                               <input type="file" name="thumbnail" accept="image/*" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 ">
                                          <?php if($page_data->thumbnail): ?>
                                               <img style="height:150px" src="<?php echo base_url('uploads/sponsors/'.$page_data->thumbnail)	 ?>" class="img-thumbnail pull-right" />
                                               <?php endif;?> 
                                          </div>
                                        </div>
                                  
                                  
                                  <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <label for="category">Parent Category</label>
                                           <select class="form-control" name="sponser_category" required="required">
                                              <?php $p_category = $this->db->get_where('pages',array('template'=>'sponsors'))->result() ?>
                                               <?php if($p_category): ?>
                                               <?php foreach($p_category as $cat): ?>
                                              <option<?php if($page_data->sponser_category == $cat->pageID) echo ' selected="selected"' ?>  
                                              value="<?php echo $cat->pageID ?>"><?php echo $cat->pageTitle ?></option>
                                              <?php endforeach;?>
                                              <?php endif;?>
                                              
                                              
                                           </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <label for="category">Select a Industry</label>
                                           <select class="form-control" id="category" name="category" required="required">
                                              <?php $categores = $this->db->get_where('sponsors_category',array('site_id'=>site_id() ))->result() ?>
                                               <?php if($categores): ?>
                                               <?php foreach($categores as $cat): ?>
                                              <option<?php if($page_data->category == $cat->categoryTitle) echo ' selected="selected"' ?>  
                                              value="<?php echo $cat->categoryTitle ?>"><?php echo $cat->categoryTitle ?></option>
                                              <?php endforeach;?>
                                              <?php endif;?>
                                              
                                           </select>
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
</script>
<script>
	$("#create_page").validate(
	);
</script>
