<?php // print_r($users) ?>
<style>
.item_list{margin-bottom:10px}
.table td img {
    width: 100%;
    height: auto;
    border-radius: 0;
}
</style>
 <?php $widgets = 
 $this->db->from('sponsers');
$this->db->order_by("s_id", "desc");
$widgets = $this->db->get()->result() ?>
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
                            <h4 class="mb-15">Sponsored Businesses <a href="<?php echo base_url('mbncms/add_edit_sponsers') ?>" class="btn btn-primary"> Add New Sponsored Businesses</a></h4>
                           
                            <?php if($widgets): //print_r($users)?>
                            <div class="table-responsive">
                              <table id="dataTableExample" class="table">
                                <thead>
                                  <tr>
                                    <th>ID</th>
                                    <th>Bussiness Name</th>
                                    <th>Bussiness Image</th>
                                    <th>Industry</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach($widgets as $page): ?>
                                      <tr>
                                        <td><?php echo $page->s_id ?> </td>
                                        <td><?php echo $page->title ?></td>
                                        <td><?php if($page->thumbnail) echo '<img style="height:150px; width:auto" src="'.base_url('uploads/sponsors/'.$page->thumbnail).'" class="img-thumbnail">' ?></td>
                                        <td><?php echo $page->category ?></td>
                                        <td><a style="margin-top:10px" class="btn btn-sm btn-primary" href="<?php echo base_url('mbncms/add_edit_sponsers/') .$page->s_id?>">Edit</a>
                                        
                                     
                                     
                     
            <button style="margin-top:10px; color:#fff" class="btn btn-sm btn-danger"  data-toggle="modal" data-target="#confirm-delete_<?php echo $page->s_id ?>">
             Delete
            </button>
                                        
                                        
                                        </td>
                                      </tr>
                                  <?php endforeach;?>
                                  
                                </tbody>
                              </table>
                            </div>
                            <?php else: ?>
                            <h5> No Sponsers added yet</h5>
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
        
    
        <div class="modal fade" id="confirm-delete_<?php echo $page->s_id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <div class="modal-body">
                       <h4> Are You Sure?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a href="<?php echo base_url('mbncms/delete_sponsers/'.$page->s_id) ?>" style="color:#fff" class="btn btn-danger btn-ok">Delete</a>
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