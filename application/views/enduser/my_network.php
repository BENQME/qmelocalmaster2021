<style>
.img-fluid {
    width: 100%;
}
</style>
    <div class="page-content">
   <?php if(isset($persons) && $persons): ?> 
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
              <h4 class="mb-3 mb-md-0">My Network </h4>
              <p class="text-muted mt-0">These are the people/businesses you follow on <?php echo site_info() ?> Portal</p>
            </div>
            <div class="d-flex align-items-center flex-wrap text-nowrap">
     
          
                
                
            </div>
          </div>
    
    
          <?php $counter=0; foreach($persons as $person): //print_r($person) ?>
         	<?php if($counter%4==0) echo '<div class="row set-card-spacing">'; $counter++  ?>
            <div class="col-md-3 grid-margin">
                <div class="card rounded">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                
                                <div class="ml-2">
                                   <strong><a style="color:#686868;" href="<?php echo base_url('publicprofile/'.$person['is_following']);?>"> 
                                   
                                   <?php 
					 $full_name =$person['first_name'].' '.$person['last_name'];
					 if (strlen($full_name) > 20)
						{
							echo substr($full_name, 0, 20)."...";
						}
						else
						{
							echo $full_name;
						}
?>
                                   
                                   </a></strong>
                                   <?php $userprofile_info =$this->db->get_where('user_profile', array('user_id'=>$person['is_following']))->row() ?>
                                   <?php $user_info =$this->db->get_where('users', array('userID'=>$person['is_following']))->row() ?>
                                   <?php //print_r($userprofile_info) ?>
                                    <p class="tx-11 text-muted"><?php if($designation = $userprofile_info->designation) echo $designation; elseif($user_info->title)echo $user_info->title;  ?></p>
                                    <p class="tx-11 text-muted"><?php echo timeAgo($person['timestamp']); ?></p>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-lg pb-3px" data-feather="more-horizontal"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                    <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('dashboard/unfollow/'.$person['is_following']);?>"><i data-feather="meh" class="icon-sm mr-2"></i> <span class="">Unfollow</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('dashboard/messages/'.$person['is_following']);?>"><i data-feather="meh" class="icon-sm mr-2"></i> <span class="">Send a Message</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('publicprofile/'.$person['is_following']);?>"><i data-feather="corner-right-up" class="icon-sm mr-2"></i> <span class="">Go to Profile</span></a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <a href="<?php echo base_url('publicprofile/'.$person['is_following']);?>">
                        
                        <?php if($person['photo']): ?>
                        	<img class="img-fluid" src="<?php echo base_url().'uploads/profile_img/'.$person['photo']; ?>" alt="">
                        <?php else: ?>
                        	<img class="img-fluid" src="<?php echo base_url().'uploads/profile_img/def.jpg'; ?>" alt="">
                        <?php endif;?>
                        </a>
                    </div>
                
                </div>
            </div> <!-- col -->
    
           <?php if($counter%4==0 ||  count($persons) == $counter) echo '</div>';  ?>
    
            <?php endforeach; ?>
            
             <div class="pager_boxxx text-center">
             <div class="col-md-12"><?php echo $links; ?></div>
            </div>
 
 
 <?php endif;?>
 <?php if(isset($other_person) && $other_person): ?> 
 
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin" style="margin-top:30px">
    <div>
      <h4 class="mb-3 mb-md-0">Connections you may know</h4>
      <p class="text-muted mt-0">Find and connect with local members</p>
    </div>
    <div class="d-flex align-items-center flex-wrap text-nowrap">
    
    
        
        
    </div>
</div>
 
 
 
 <?php $counter=0; foreach($other_person as $person): //echo $person['userID'] ?>
         	<?php if($counter%4==0) echo '<div class="row set-card-spacing">'; $counter++  ?>
            <div class="col-md-3 grid-margin">
                <div class="card rounded">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                
                                <div class="ml-2">
                                   <p><a style="color:#686868;" href="<?php echo base_url('publicprofile/'.$person['userID']);?>"> 
                                     <?php 
					 $full_name =$person['first_name'].' '.$person['last_name'];
					 if (strlen($full_name) > 20)
						{
							echo substr($full_name, 0, 20)."...";
						}
						else
						{
							echo $full_name;
						}
?>
                                   
                                   </a></p>
                                   <?php $userprofile_info =$this->db->get_where('user_profile', array('user_id'=>$person['userID']))->row() ?>
                                   <?php $user_info =$this->db->get_where('users', array('userID'=>$person['userID']))->row() ?>
                                   <?php //print_r($userprofile_info) ?>
                                    <p class="tx-11 text-muted"><?php if($designation = $userprofile_info->designation) echo $designation; elseif($user_info->title)echo $user_info->title;  ?></p>
                                  
                                </div>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-lg pb-3px" data-feather="more-horizontal"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                    <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('dashboard/follow/'.$person['userID']);?>"><i data-feather="meh" class="icon-sm mr-2"></i> <span class="">Follow</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('dashboard/messages/'.$person['userID']);?>"><i data-feather="meh" class="icon-sm mr-2"></i> <span class="">Send a Message</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('publicprofile/'.$person['userID']);?>"><i data-feather="corner-right-up" class="icon-sm mr-2"></i> <span class="">Go to Profile</span></a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <a href="<?php echo base_url('publicprofile/'.$person['userID']);?>"> 
                        <?php if($person['photo']): ?>
                        	<img class="img-fluid" src="<?php echo base_url().'uploads/profile_img/'.$person['photo']; ?>" alt="">
                        <?php else: ?>
                        	<img class="img-fluid" src="<?php echo base_url().'uploads/profile_img/def.jpg'; ?>" alt="">
                        <?php endif;?>
                       
                        </a>
                    </div>
                     <a class="btn btn-primary" href="<?php echo base_url('dashboard/follow/'.$person['userID']);?>" style="border-radius:0;">FOLLOW</a>
                
                </div>
            </div> <!-- col -->
    
           <?php if($counter%4==0 ||  count($other_person) == $counter) echo '</div>';  ?>
    
            <?php endforeach; ?>
            
             <div class="pager_boxxx text-center">
             <div class="col-md-12"><?php echo $links; ?></div>
            </div>
  <?php endif;?>
    </div>
