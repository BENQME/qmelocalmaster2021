<?php // print_r($users) ?>
<style>
.item_list{margin-bottom:10px}
</style>

    <div class="page-content">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="mb-15"><?php  echo strtoupper(site_info()) ?> STAFF USERS <a href="<?php echo base_url('superadmin/add_staff') ?>" class="btn btn-primary"> Add Staff User</a></h4>
                
                <?php if($users): //print_r($users)?>
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email Address</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($users as $user): ?>
                          <tr>
                            <td><?php echo $user->first_name ?> </td>
                            <td><?php echo $user->last_name ?></td>
                            <td><?php echo $user->email ?></td>
                            <td><a style="margin-top:10px" data-userid="<?php echo $user->userID  ?>" class="btn btn_block btn-sm btn-danger" href=""><?php if($user->status==2) echo 'Blocked';else echo 'Block' ?></a>
                            
                         
                         
         
<button style="margin-top:10px; color:#fff" class="btn btn-sm btn-danger" data-href="/delete.php?id=54" data-toggle="modal" data-target="#confirm-delete_<?php echo $user->userID ?>">
 Delete User
</button>
                            
                            
                            </td>
                          </tr>
                      <?php endforeach;?>
                      
                    </tbody>
                  </table>
                </div>
                <?php else: ?>
                <h5> No users added yet</h5>
                <?php endif;?>
              </div>
            </div>
        </div>
    </div>
    </div>
    <?php if($users): //print_r($users)?>
    <?php foreach($users as $user): ?>
        <div class="modal fade" id="confirm-delete_<?php echo $user->userID ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <div class="modal-body">
                       <h4> Are You Sure?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a href="<?php echo base_url('superadmin/delete_user/'.$user->userID) ?>" style="color:#fff" class="btn btn-danger btn-ok">Delete</a>
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