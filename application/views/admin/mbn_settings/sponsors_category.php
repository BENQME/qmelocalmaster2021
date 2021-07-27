<?php // print_r($users) ?>
<style>
.item_list{margin-bottom:10px}
</style>

    <div class="page-content">
        <div class="steelton_home_section">
         <?php include('nav_links.php') ?>
             <div class="tab-content">
                <div class="row">
                 <?php if($sucesess = $this->session->flashdata('sucesess')): ?>
                        <div class="alert alert-success" role="alert">
                         <?php echo $sucesess ?>
                        </div>
                    <?php endif ?>
                    <div class="col-md-12 grid-margin stretch-card">
                   
                        <div class="card">
                          <div class="card-body">
                            <h4 class="mb-15">Categories <a data-toggle="modal" data-target="#add_cat" href="#" class="btn btn-primary"> Add Category</a></h4>
                            <?php $categories =  $this->db->get('sponsors_category')->result() ?>
                            <?php if($categories): //print_r($users)?>
                            <div class="table-responsive">
                              <table id="dataTableExample" class="table">
                                <thead>
                                  <tr>
                                    <th>ID</th>
                                    <th>Name</th>
    
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach($categories as $cat): ?>
                                      <tr>
                                        <td><?php echo $cat->categoryID ?> </td>
                                        <td><?php echo $cat->categoryTitle ?></td>
                                      
                                        <td><a style="margin-top:10px" data-toggle="modal" data-target="#edit_<?php echo $cat->categoryID ?>" class="btn btn-sm btn-primary" href="">Edit</a>
                                        
                                     
                                     
                     
            <button style="margin-top:10px; color:#fff" class="btn btn-sm btn-danger"  data-toggle="modal" data-target="#confirm-delete_<?php echo $cat->categoryID ?>">
             Delete
            </button>
                                        
                                        
                                        </td>
                                      </tr>
                                  <?php endforeach;?>
                                  
                                </tbody>
                              </table>
                            </div>
                            <?php else: ?>
                            <h5> No Categories added yet</h5>
                            <?php endif;?>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_cat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5>Add Category:</h5>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="<?php echo base_url('mbncms/categories') ?>">
                          <div class="form-group">
                                <input class="form-control" required="required" type="text" name="category_name" />
                          </div>
                          <div class="form-group">
                                <button class="btn btn-primary" type="submit" name="submit" value="2">Submit</button>
                          </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        
                    </div>
                </div>
            </div>
        </div>
    <?php if($categories): //print_r($users)?>
    <?php foreach($categories as $cat): ?>
        <div class="modal fade" id="edit_<?php echo $cat->categoryID ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5>Edit Category: <?php echo $cat->categoryTitle ?></h5>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="<?php echo base_url('mbncms/categories') ?>">
                          <input type="hidden" name="cat_id" value="<?php echo $cat->categoryID ?>" />
                          <div class="form-group">
                                <input class="form-control" required="required" type="text" name="category_name" value="<?php echo $cat->categoryTitle ?>" />
                          </div>
                          
                          <?php $child_cats = $this->db->get_where('sponsors_category',array('is_parent'=>1,'site_id'=>site_id()))->result() ?>
                          <?php if($child_cats){ ?>
                          <div class="form-group" id="parent_box_<?php echo $cat->categoryID ?>">
                              <label>Parent Category</label>
                                <select class="form-control" name="parent">
                                <?php foreach($child_cats as $child_cat){ ?>
                                <option<?php if($cat->parent == $child_cat->categoryID ) echo ' selected="selected"' ?>  value="<?php echo $child_cat->categoryID  ?>"><?php echo $child_cat->categoryTitle  ?></option>
                                <?php } ?>
                                </select>
                            </div>
                          <?php } ?>
                          <div class="form-group">
                                <button class="btn btn-primary" type="submit" name="submit" value="1">Submit</button>
                          </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        
                    </div>
                </div>
            </div>
        </div>
    
        <div class="modal fade" id="confirm-delete_<?php echo $cat->categoryID ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <div class="modal-body">
                       <h4> Are You Sure?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a href="<?php echo base_url('mbncms/delete_category/'.$cat->categoryID) ?>" style="color:#fff" class="btn btn-danger btn-ok">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        <script>
		$(document).ready(function(e) {
			 if($("#is_parent_<?php echo $cat->categoryID ?>").prop('checked') == true){
				 $('#parent_box_<?php echo $cat->categoryID ?>').hide();
			 }
			$('#is_parent_<?php echo $cat->categoryID ?>').change(function() {
				if(this.checked) {
					$('#parent_box_<?php echo $cat->categoryID ?>').hide();
				}else{
				 $('#parent_box_<?php echo $cat->categoryID ?>').show();
				}
			});
			
		});
		</script>
    <?php endforeach;?>
     <?php endif;?>
<script>

$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
</script>