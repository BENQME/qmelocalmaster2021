<?php
	if($spotlight['spotlight_type'] == 'Spotit Spotlight') $haha = 'General Spotlight'; else $haha = '';
 if(isset($col_size)){

 $col_size =4;
  $style ='fixx_img';
 
}else {
$col_size = 4;
 $style ='';
 $bandage="";
 if($haha) $bandage ='<span class="badge badge-primary">'. $haha.'</span>';
}

if($spotlight['status'] ==2){
	 $bandage2 ='<span class="badge badge-primary">DRAFT</span>';
}else{
	$bandage2 ='';
}?>
 <?php
	 $icon="";
	 
	  if (strpos($spotlight['postContent'], 'youtube.com/embed/') !== false) { 
	 
	 $icon = ' <span title="This spotlight also have video content featured in it" class="iconn_fix badge badge-primary" data-toggle="tooltip" data-placement="top" style="background:red"><i class="icon-md" data-feather="video"></i></span>';
	 }
	  if (strpos($spotlight['postContent'], 'embed.podcasts') !== false) { 
	 
	 $icon .= ' <span class="iconn_fix badge badge-primary" data-toggle="tooltip" data-placement="top" title="This spotlight also have podcast content featured in it" style="background:orange"><i class="icon-md" data-feather="mic"></i></span>';
	 }
	 
	 
	  ?>
<?php $user_info = $this->db->get_where('users',array('userID'=>$spotlight['userid']))->row(); //print_r($user_level) ?>
<div class="eq_height_wrapper post_loop col-md-<?php echo $col_size ?> grid-margin <?php echo $style  ?>">
  <?php //print_r($spotlight) ?>
 <div class="eq_hight card rounded" style="box-shadow:none !important; border:none !important;">
	 <div class="card-header">
		 <div class="d-flex align-items-center justify-content-between">
			  <a href="<?php echo base_url('publicprofile/'.$spotlight['userid']) ?>">
             <div class="d-flex align-items-center">
				<img class="img-xs rounded-circle" src="<?php echo base_url().'uploads/profile_img/'.$spotlight['photo']; ?>" alt="">												

				 <div class="ml-2">
				
					 <p style="color: #686868;"> 
					 <?php 
					 $full_name =$spotlight['first_name'].' '.$spotlight['last_name'];
					 if (strlen($full_name) > 30)
						{
							echo substr($full_name, 0, 20)."...";
						}
						else
						{
							echo $full_name;
						}
?>
					 <?php echo $bandage2 ?>
                     
                     </p>
					 
					 <p class="tx-11 text-muted"><?php echo timeAgo($spotlight['created_at']); ?></p>
				 </div>
			 </div>
              </a>
			 <div class="dropdown">
             <?php echo $icon ?>
				 <button class="btn p-0" type="button" id="dropdownMenuButton<?php echo $spotlight['postID'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					 
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-lg pb-3px"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
				 </button>
				 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton<?php echo $spotlight['postID'] ?>">
				 	 <?php if(isset($type) && $type == 'my_spotlight'){
						 if(isset($spotlight['region']) && $spotlight['region']){
							 $rg ='?region=1';
						 }else{
							  $rg ='';
						 }
						 
						  ?>
                     <a class="dropdown-item d-flex align-items-center" href="<?php 
					 echo base_url('dashboard/create_new_spotlight/'.$spotlight['postID']).$rg ?>"><i data-feather="edit" class="icon-sm mr-2"></i> <span class="">Edit</span></a>
                      <a class="dropdown-item d-flex align-items-center" data-toggle="modal" data-target="#confirm-delete_<?php echo $spotlight['postID'] ?>" href="<?php //echo base_url('dashboard/delete_spotlight/'.$spotlight['postID']) ?>"><i data-feather="trash" class="icon-sm mr-2"></i> <span class="">Delete </span></a>
                     <?php }else{ ?>
                     <?php $user_id = $this->session->userdata('user_id'); ?>
                     <?php  if($user_id  != $spotlight['userid']): ?>
					 <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('publicprofile/'.$spotlight['userid']) ?>"><i data-feather="meh" class="icon-sm mr-2"></i> <span class=""><?php if(!is_following($spotlight['userid'])) echo 'Follow'; else echo 'UnFollow'?></span></a>
					 <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('publicprofile/'.$spotlight['userid']) ?>"><i data-feather="corner-right-up" class="icon-sm mr-2"></i> <span class="">View Profile</span></a>

<?php endif ?>
					 <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('detail/'.$spotlight['postSlug']) ?>"><i data-feather="info" class="icon-sm mr-2"></i> <span class="">Go to post</span></a>
                     <?php if($this->session->userdata('user_id') != $spotlight['userid']): ?>
					 <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('dashboard/messages/'.$spotlight['userid']) ?>"><i data-feather="send" class="icon-sm mr-2"></i> <span class="">Send Message</span></a>
                     <?php endif;?>

					 <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('detail/'.$spotlight['postSlug']) ?>"><i data-feather="share-2" class="icon-sm mr-2"></i> <span class="">Share</span></a>
                     <?php $url =  base_url('detail/'.$spotlight['postSlug'])?>
                     <a class="copy_to_clipboard dropdown-item d-flex align-items-center" data-clipboard-text="<?php echo $url ?>"><i data-feather="copy" class="icon-sm mr-2"></i> <span class="">Copy Link</span></a>
                     <?php } ?>
					 
				 </div>
			 </div>
		 </div>
	 </div>
     <div class="card-body">
     
					<?php if($spotlight['em_video']):?>
                    
					
					<?php //echo convertYoutube($spotlight['em_video']) ?>
                     <a href="<?php echo base_url('detail/'.$spotlight['postSlug']) ?>">
                                <div class="v_box">
                                <img class="img-fluid v_thumb" src="<?php echo base_url('uploads/cover_photo/'.$spotlight['cover_photo']) ?>">
                                <span class="play_icon"><img src="<?php echo base_url() ?>landing_file/style2/you/youtube.svg"></span>
                                </div>
                            </a>
                    <?php else: ?>
                    <?php // print_r($spotlight) ?>
                    <a href="<?php echo base_url('detail/'.$spotlight['postSlug']) ?>"><?php if(!empty($spotlight['cover_photo'])):?>
                            <img class="img-fluid" src="<?php echo base_url('uploads/cover_photo/'.$spotlight['cover_photo']); ?>" />
                        <?php else: ?>
                            <img class="img-fluid" src="<?php echo base_url('assets/images/placeholder.jpg')?>" />
                        <?php endif;?> </a>
                    
                    <?php endif ?>
                     <div class="card_content set_eq_h mb-2">
                     <?php if(isset($user_info->level) && ($user_info->level == 1 || $user_info->level == 3)): ?>
                     <span class="badge badge-primary"><?php if($user_info->level == 3){
						  echo 'Digital Biz Center';
					 }else{
						  
					 $text22 = str_replace('Dayton Business Center',"Dayton Biz Center", site_info_by_id($user_info->site_id));
					  $text22 = str_replace('Steelton',"Steelton Admin", $text22);
					 echo $text22;
					 }
					 ?></span>
                     <?php endif ?>
                     <?php echo '<span class="badge badge-success" style="
    color: #727cf5;
    background-color: #f1f1f1;
">'.$spotlight['category'].'</span>' ?>
                     <p><strong class="post_titlee"><a style="display:block" href="<?php echo base_url('detail/'.$spotlight['postSlug']) ?>" class="spotlight-title"><?php echo $spotlight['postTitle']; ?></a> <?php if($spotlight['status'] == 2) echo ' <span class="badge badge-primary">DRAFT</span>' ?></strong></p></div>
					 <div class="card_content mb-3 tx-14">
					    <?php if(!empty($spotlight['postContent'])){echo substr(strip_tags($spotlight['postContent']), 0,100); } ?>...</div>
						
				 </div>
	 <div class="card-footer">
		 <div class="d-flex post-actions">
          <?php if($spotlight['likecount']>0){ 
                                $already_like= 'heartfill';
                             }else{ 
                                $already_like= '';
                             } ?>
                        <a href="javascript:;" class="like_count <?php echo $already_like; ?> d-flex align-items-center text-muted mr-4 " data-post-id="<?php echo trim($spotlight['postID']) ?>">
                            
                                <i class="icon-md" data-feather="heart"></i>
                            
                            <p class="d-none d-md-block ml-2"><span class="like_count_data"><?php if(isset($spotlight['likes']))
							 echo $spotlight['likes']; else echo 0 ?></span> Like</p>
                        </a>
			<!-- <a href="javascript:;" class="d-flex align-items-center text-muted mr-4">
				 <i class="icon-md" data-feather="heart"></i>
				 <p class="d-none d-md-block ml-2">Like</p>
			 </a>-->
			 <a href="<?php echo base_url('detail/'.$spotlight['postSlug']) ?>?show_comment=1#comment" class="d-flex align-items-center text-muted mr-4">
				 <i class="icon-md" data-feather="message-square"></i>
				 <p class="d-none d-md-block ml-2">Comment</p>
			 </a>
			 <a href="<?php echo base_url('detail/'.$spotlight['postSlug']) ?>" class="d-flex align-items-center text-muted">
				 <i class="icon-md" data-feather="share"></i>
				 <p class="d-none d-md-block ml-2">Share</p>
			 </a>
		 </div>
	 </div>
 </div>
</div>
<div class="modal fade" id="confirm-delete_<?php echo  $spotlight['postID'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
            </div>
        
            <div class="modal-body">
                <p>You are about to delete one spotlight, this procedure is irreversible.</p>
                <p>Do you want to proceed?</p>
                <p class="debug-url"></p>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="<?php echo base_url('dashboard/delete_spotlight/'.$spotlight['postID']) ?>" class="btn btn-danger btn-ok" style="color:#fff">Delete</a>
            </div>
        </div>
    </div>
</div>