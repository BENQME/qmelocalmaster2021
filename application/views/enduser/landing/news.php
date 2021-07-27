
  <div class="trending-activites">
	 <div class="container">
		<div class="row activities-content">
		   <div class="col-sm-12">
			  <h4 class="wow fadeInUp"><?php echo site_info() ?></h4>
			  <h1 class="wow fadeInDown" data-wow-delay="0.1s"><?php echo $page_title ?></h1>
		   </div>
		   
		</div>
		<!-- row -->
		<br />
        <?php if($spotlight_all): ?>
		<div class="row flexx_boxx">
        
		   <?php foreach($spotlight_all as $spotlight): //print_r($spotlight) ?>
			   <div class="col-sm-4 filter  <?php echo createSlug($spotlight['spotlight_type']) ?>">
				  <div class="thumbnail ">
                  <?php if($spotlight['em_video']):?><?php echo convertYoutube($spotlight['em_video'],$spotlight) ?>
          <?php else: ?>
					<a href="<?php echo base_url('detail/'.$spotlight['postSlug']) ?>" class="" > 
                     <?php if(!empty($spotlight['cover_photo'])):?>
					<img class="img-fluid" src="<?php echo base_url('uploads/cover_photo/'.$spotlight['cover_photo']); ?>" />
				<?php else: ?>
					<img class="img-fluid" src="<?php echo base_url('assets/images/placeholder.jpg')?>" />
				<?php endif;?> 
                </a>
                <?php endif;?>
					 <div class="caption">
						<h5><?php echo $spotlight['spotlight_type'] ?></h5>
						<h4 class="ellipsis"><?php echo $spotlight['postTitle']; ?></h4>
						<p><a href="<?php echo base_url('detail/'.$spotlight['postSlug']) ?>" class="" >READ MORE</a></p>
					 </div>
				  </div>
				  <!-- blog-box -->
			   </div>
		   <?php endforeach;?>
		</div>
		<!-- row -->
		<p class="text-center wow fadeInUp">
		   <a href="<?php echo base_url('login') ?>" class="show-more">SHOW MORE</a>
		</p>
        <?php else: ?>
        <p class="text-center wow fadeInUp">
		   <p>no Spotlights added yet</p>
		</p>
        <?php endif;?>
	 </div>
  </div>
