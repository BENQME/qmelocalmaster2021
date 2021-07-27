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
 $this->db->from('magazine');
$this->db->order_by("m_id", "desc");
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
                            <h4 class="mb-15">Digital Magazine <a href="<?php echo base_url('mbncms/add_edit_magazine') ?>" class="btn btn-primary"> Add New Digital Magazine</a></h4>
                           
                            <?php if($widgets): //print_r($users)?>
                            <div class="table-responsive">
                              <table id="dataTableExample" class="table">
                                <thead>
                                  <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Pdf</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach($widgets as $page): ?>
                                      <tr>
                                      
                                        <td><?php echo $page->m_id ?> </td>
                                        <td><?php echo $page->title ?> </td>
                                        <td><a target="_blank" href="<?php echo $page->pdf; ?>">View PDF</a></td>
                                        <td><?php echo $page->category ?></td>
                                        <td><a style="margin-top:10px" class="btn btn-sm btn-primary" href="<?php echo base_url('mbncms/add_edit_magazine/') .$page->m_id?>">Edit</a>
                                        
                                     
                                     
                     
            <button style="margin-top:10px; color:#fff" class="btn btn-sm btn-danger"  data-toggle="modal" data-target="#confirm-delete_<?php echo $page->m_id ?>">
             Delete
            </button>
                                        
                                        
                                        </td>
                                      </tr>
                                  <?php endforeach;?>
                                  
                                </tbody>
                              </table>
                            </div>
                            
                            <?php else: ?>
                            <h5> No digital magazine added yet</h5>
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
        
    
        <div class="modal fade" id="confirm-delete_<?php echo $page->m_id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <div class="modal-body">
                       <h4> Are You Sure?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a href="<?php echo base_url('mbncms/delete_magazine/'.$page->m_id) ?>" style="color:#fff" class="btn btn-danger btn-ok">Delete</a>
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