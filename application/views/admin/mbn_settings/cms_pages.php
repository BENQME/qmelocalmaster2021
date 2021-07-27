<?php // print_r($users) ?>
<style>
.item_list{margin-bottom:10px}
</style>
 <?php $pages =  $this->db->order_by('pageID','desc')->get('pages')->result() ?>
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
                            <h4 class="mb-15">CMS Pages <a href="<?php echo base_url('mbncms/add_edit_page') ?>" class="btn btn-primary"> Add New Page</a></h4>
                           
                            <?php if($pages): //print_r($users)?>
                            <div class="table-responsive">
                              <table id="dataTableExample" class="table">
                                <thead>
                                  <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>URL</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach($pages as $page): ?>
                                      <tr>
                                        <td><?php echo $page->pageID ?> </td>
                                        <td><?php echo $page->pageTitle ?></td>
                                        <td><?php echo date('F jS, Y',$page->timestamp) ?></td>
                                         <td><?php echo base_url('page/'.$page->pageSlug) ?></td>
                                        <td><a style="margin-top:10px" class="btn btn-sm btn-primary" href="<?php echo base_url('mbncms/add_edit_page/') .$page->pageID?>">Edit</a>
                                        
                                     
                                     
                     
            <button style="margin-top:10px; color:#fff" class="btn btn-sm btn-danger"  data-toggle="modal" data-target="#confirm-delete_<?php echo $page->pageID ?>">
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
                      <form method="post" action="<?php echo base_url('settings/categories') ?>">
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
    <?php if($pages): //print_r($users)?>
   <?php foreach($pages as $page): ?>
        <div class="modal fade" id="edit_<?php echo $cat->categoryID ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5>Edit Category: <?php echo $cat->categoryTitle ?></h5>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="<?php echo base_url('settings/categories') ?>">
                          <input type="hidden" name="cat_id" value="<?php echo $cat->categoryID ?>" />
                          <div class="form-group">
                                <input class="form-control" required="required" type="text" name="category_name" value="<?php echo $cat->categoryTitle ?>" />
                          </div>
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
    
        <div class="modal fade" id="confirm-delete_<?php echo $page->pageID ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <div class="modal-body">
                       <h4> Are You Sure?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a href="<?php echo base_url('mbncms/delete_page/'.$page->pageID) ?>" style="color:#fff" class="btn btn-danger btn-ok">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach;?>
     <?php endif;?>
<script>
$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
</script>