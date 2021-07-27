
<div class="page-content">

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
        	<h4 class="mb-3 mb-md-0">Notifications</h4>
        </div>
    </div>
    <?php 
	$user_id = $this->session->userdata('user_id');
	$user_notification =$this->db->order_by('timestamp','desc')->get_where('notifications',array('notify_to'=>$user_id))->result();
	if(isset($user_notification) && $user_notification): ?>
    <?php foreach($user_notification as $data){ ?>
    <div class="row" style="margin-bottom:10px">
        <div class="col-md-12">
            <div class="card rounded">
            	<div class="row d-flex align-items-center"> 
                  <div class="col-md-10">
                    <a href="<?php echo $data->targetURL ?>" class="dropdown-item" style="padding:10px">
                        <div class="content">
                            <p><?php echo $data->description ?></p>
                            <p class="sub-text text-muted"><?php echo timeAgo($data->timestamp) ?></p>
                        </div>
                    </a>
                  </div>
                   <div class="col-md-2">
                    <a href="<?php echo base_url().'dashboard/notifications/'.$data->notifyID ?>" class="btn btn-danger" style="padding:10px">Delete</a>
                   </div>
                </div>
            </div>
        </div>
    </div>
    <?php } endif;?>

</div>
