<?php // print_r($users) ?>
<style>
.item_list{margin-bottom:10px}
.table td img {
    width: 150px;
    height: auto;
    border-radius: 0;
	display:block;
}


</style>
 <?php $widgets =$this->db->order_by("w_id", "desc")->get('widgets')->result();
//$this->db->order_by("w_id", "desc");
//$widgets = $this->db->get()->result() ?>
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
                            <h4 class="mb-15">Widgets <a href="<?php echo base_url('mbncms/add_edit_widget') ?>" class="btn btn-primary"> Add New Widget</a></h4>
                           
                            <?php if($widgets): //print_r($users)?>
                            <div class="table-responsive">
                              <table id="dataTableExample" class="table">
                                <thead>
                                  <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>content</th>
                                    <th>Order</th>
                                    <th>Position</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach($widgets as $page): ?>
                                      <tr>
                                        <td><?php echo $page->w_id ?> </td>
                                        <td style="white-space: normal"><?php echo $page->title ?></td>
                                        <td><?php echo $page->content ?></td>
                                        <td><?php echo $page->order_index ?></td>
                                        <td style="white-space: normal">
										<?php //print_r($page) ?>
										<?php
										if($page->widget_area  == 'social') echo 'Header & Footer Social Links';
										if($page->widget_area  == 'home_bottom') echo 'MBN Advertised Scroll Ads 1920x350';
										elseif($page->widget_area  == 'home_bottom2') echo 'MBN In Motion Ads 1600x270';
										elseif($page->widget_area  == 'home_page') echo 'Main Home Page Ads 1600x270';
										elseif($page->widget_area  == 'home_page2') echo 'MBN TV Ads 1600x270';
										elseif($page->widget_area  == 'TrendingNews') echo 'Trending News (Ad position & size 900X100)';
										elseif($page->widget_area  == 'AffiliateNews') echo 'Affiliate News (Ad position & size 900X100)';
										
										else echo $page->widget_area ?></td>
                                        <td><a style="margin-top:10px" class="btn btn-sm btn-primary" href="<?php echo base_url('mbncms/add_edit_widget/') .$page->w_id?>">Edit</a>
                                        
                                     
                                     
                     
            <button style="margin-top:10px; color:#fff" class="btn btn-sm btn-danger"  data-toggle="modal" data-target="#confirm-delete_<?php echo $page->w_id ?>">
             Delete
            </button>
                                        
                                        
                                        </td>
                                      </tr>
                                  <?php endforeach;?>
                                  
                                </tbody>
                              </table>
                            </div>
                            <?php else: ?>
                            <h5> No widgets added yet</h5>
                            <?php endif;?>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php if($widgets): //print_r($users)?>
   <?php foreach($widgets as $page): ?>
        
    
        <div class="modal fade" id="confirm-delete_<?php echo $page->w_id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <div class="modal-body">
                       <h4> Are You Sure?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a href="<?php echo base_url('mbncms/delete_widget/'.$page->w_id) ?>" style="color:#fff" class="btn btn-danger btn-ok">Delete</a>
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