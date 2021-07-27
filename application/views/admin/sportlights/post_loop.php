<?php if(isset($col_size)){
 $col_size =$col_size;
  $style ='fixx_img';
}else {
$col_size = 4;
 $style ='';
}?>
<div class="col-md-<?php echo $col_size ?> grid-margin <?php echo $style  ?>">
  <?php //print_r($spotlight) ?>
 <div class="card rounded">
	 <div class="card-header">
		 <div class="d-flex align-items-center justify-content-between">
			 <div class="d-flex align-items-center">
				 <img class="img-xs rounded-circle" src="<?php echo base_url().'uploads/profile_img/'.$spotlight['photo']; ?>" alt="">												
				 <div class="ml-2">
					 <p><?php echo $spotlight['first_name'].' '.$spotlight['last_name']; ?></p>
					 <p class="tx-11 text-muted"><?php echo timeAgo($spotlight['created_at']); ?></p>
				 </div>
			 </div>
			 <div class="dropdown">
				 <button class="btn p-0" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					 <i class="icon-lg pb-3px" data-feather="more-horizontal"></i>
				 </button>
				 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
				 	 <?php if(isset($type) && $type == 'my_spotlight'){ ?>
                     <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url().'dashboard/create_new_spotlight/'.$spotlight['postID'] ?>"><i data-feather="edit" class="icon-sm mr-2"></i> <span class="">Edit</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url().'admin/delete_spotlight/'.$spotlight['postID'] ?>"><i data-feather="trash" class="icon-sm mr-2"></i> <span class="">Delete</span></a>
                     <?php }else{ ?>
					 <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url().'publicprofile/'.$spotlight['userid'] ?>"><i data-feather="meh" class="icon-sm mr-2"></i> <span class=""><?php if(!is_following($spotlight['userid'])) echo 'Follow'; else echo 'UnFollow'?></span></a>
					 <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url().'publicprofile/'.$spotlight['userid'] ?>"><i data-feather="corner-right-up" class="icon-sm mr-2"></i> <span class="">Give a Review</span></a>

					 <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url().'detail/'.$spotlight['postSlug'] ?>"><i data-feather="info" class="icon-sm mr-2"></i> <span class="">Go to post</span></a>
                     <?php if($this->session->userdata('user_id') != $spotlight['userid']): ?>
					 <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url().'dashboard/messages/'.$spotlight['userid'] ?>"><i data-feather="send" class="icon-sm mr-2"></i> <span class="">Send Message</span></a>
                     <?php endif;?>

					 <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url().'detail/'.$spotlight['postSlug'] ?>"><i data-feather="share-2" class="icon-sm mr-2"></i> <span class="">Share</span></a>
                     <?php $url =  base_url().'/detail/'.$spotlight['postSlug']?>
                     <a class="copy_to_clipboard dropdown-item d-flex align-items-center" data-clipboard-text="<?php echo $url ?>"><i data-feather="copy" class="icon-sm mr-2"></i> <span class="">Copy Link</span></a>
                     <?php } ?>
					 
				 </div>
			 </div>
		 </div>
	 </div>
     <div class="card-body">
     <?php // print_r($spotlight) ?>
					 <div class="card_content mb-2"><p><strong class="post_titlee"><a href="<?php echo base_url('detail/'.$spotlight['postSlug']) ?>" class="spotlight-title"><?php echo $spotlight['postTitle']; ?></a> <?php if($spotlight['status'] == 2) echo ' <span class="badge badge-primary">DRAFT</span>' ?></strong></p></div>
					 <div class="card_content mb-3 tx-14"><?php if(!empty($spotlight['postContent'])){echo substr(strip_tags($spotlight['postContent']), 0,100); } ?></div>
						<a href="<?php echo base_url().'detail/'.$spotlight['postSlug'] ?>"><?php if(!empty($spotlight['cover_photo'])):?>
							<img class="img-fluid" src="<?php echo base_url('uploads/cover_photo/'.$spotlight['cover_photo']); ?>" />
						<?php else: ?>
							<img class="img-fluid" src="<?php echo base_url('assets/images/placeholder.jpg')?>" />
						<?php endif;?> </a>
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
			 <a href="<?php echo base_url().'detail/'.$spotlight['postSlug'] ?>#comment" class="d-flex align-items-center text-muted mr-4">
				 <i class="icon-md" data-feather="message-square"></i>
				 <p class="d-none d-md-block ml-2">Comment</p>
			 </a>
			 <a href="<?php echo base_url().'detail/'.$spotlight['postSlug'] ?>" class="d-flex align-items-center text-muted">
				 <i class="icon-md" data-feather="share"></i>
				 <p class="d-none d-md-block ml-2">Share</p>
			 </a>
		 </div>
	 </div>
 </div>
</div>