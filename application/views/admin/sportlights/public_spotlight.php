<div class="page-content">
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
<div>
<h4 class="mb-3 mb-md-0">Public Spotlight</h4>
</div>
<div class="d-flex align-items-center flex-wrap text-nowrap">

<div id="the-basics">
<input class="typeahead" type="text" placeholder="Search by Region">
</div>
</div>
</div>
<div class="row set-card-spacing">
	<?php 
	foreach ($spotlight_posts as $spotlight) { ?>
      <?php include('sportlights/post_loop.php') ?>  
<?php /*?><div class="col-md-4 grid-margin">
 <div class="card rounded">
	 <div class="card-header">
		 <div class="d-flex align-items-center justify-content-between">
			 <div class="d-flex align-items-center">
				 <img class="img-xs rounded-circle" src="<?php echo base_url().'uploads/profile_img/'.$userinfo->photo; ?>" alt="">														
				 <div class="ml-2">
					 <p><?php echo $userinfo->first_name.' '.$userinfo->last_name; ?></p>
					 <p class="tx-11 text-muted"><?php echo timeAgo($spotlight['created_at']); ?></p>
				 </div>
			 </div>
			 <div class="dropdown">
				 <button class="btn p-0" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					 <i class="icon-lg pb-3px" data-feather="more-horizontal"></i>
				 </button>
				 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
				 	 
					 <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="meh" class="icon-sm mr-2"></i> <span class="">Follow</span></a>
					 <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="corner-right-up" class="icon-sm mr-2"></i> <span class="">Give a Review</span></a>

					 <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="info" class="icon-sm mr-2"></i> <span class="">Details</span></a>

					 <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="copy" class="icon-sm mr-2"></i> <span class="">Copy link</span></a>

					 <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="send" class="icon-sm mr-2"></i> <span class="">Send Message</span></a>

					 <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="share" class="icon-sm mr-2"></i> <span class="">Share</span></a>
					 
				 </div>
			 </div>
		 </div>
	 </div>
     <div class="card-body">
					 <div class="card_content mb-2"><p><strong class="post_titlee"><a href="" class="spotlight-title"><?php echo $spotlight['postTitle']; ?></a></strong></p></div>
					 <div class="card_content mb-3 tx-14"><?php if(!empty($spotlight['postContent'])){echo substr($spotlight['postContent'], 0,100); } ?></div>
						<?php if(!empty($spotlight['cover_photo'])):?>
							<img class="img-fluid" src="<?php echo base_url('uploads/cover_photo/'.$spotlight['cover_photo']); ?>" />
						<?php else: ?>
							<img class="img-fluid" src="<?php echo base_url('assets/images/placeholder.jpg')?>" />
						<?php endif;?> 
				 </div>
	 <div class="card-footer">
		 <div class="d-flex post-actions">
			 <a href="javascript:;" class="d-flex align-items-center text-muted mr-4">
				 <i class="icon-md" data-feather="heart"></i>
				 <p class="d-none d-md-block ml-2">Like</p>
			 </a>
			 <a href="javascript:;" class="d-flex align-items-center text-muted mr-4">
				 <i class="icon-md" data-feather="message-square"></i>
				 <p class="d-none d-md-block ml-2">Comment</p>
			 </a>
			 <a href="javascript:;" class="d-flex align-items-center text-muted">
				 <i class="icon-md" data-feather="share"></i>
				 <p class="d-none d-md-block ml-2">Share</p>
			 </a>
		 </div>
	 </div>
 </div>
</div><?php */?>
<?php } ?>

</div>