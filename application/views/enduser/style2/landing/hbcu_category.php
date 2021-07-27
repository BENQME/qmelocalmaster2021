<?php /*?><div class="header-banner2">
     <div class="container">
        <div class="registarArea wow fadeInUp" data-wow-delay="0.3s">
           <form class="form-inline" action="<?php base_url() ?>/home/main_search">
              <div class="form-group">
                 <input type="text" name="search" class="form-control customInput" id="email" 
                 value="<?php if(isset($_GET['search'])) echo $_GET['search'] ?>" placeholder="Enter a keyword">
              </div>
              <div class="form-group">
                 <div class="styled-select">
                    <select name="spotlight_type">
                       <option value="">Select a main category</option>
                       <option <?php if(isset($_GET['spotlight_type']) && $_GET['spotlight_type'] =='news') echo 'selected="selected" '  ?> value="news">Media/News</option>
                       <option <?php if(isset($_GET['spotlight_type']) && $_GET['spotlight_type'] =='jobs') echo 'selected="selected" '  ?> value="jobs">Jobs</option>
                       <option <?php if(isset($_GET['spotlight_type']) && $_GET['spotlight_type'] =='events') echo 'selected="selected" '  ?> value="events">Events</option>
                        <option <?php if(isset($_GET['spotlight_type']) && $_GET['spotlight_type'] =='spotit') echo 'selected="selected" '  ?> value="spotit">General Spotlight</option>
                    </select>
                    <span class="fa fa-sort-desc"></span>
                 </div>
              </div>
              <button type="submit" class="btn nextBtn">Search</button>
           </form>
        </div>
        <!--register-->
       
     </div>
     <!-- container -->
  </div><?php */?>

<section class="content-section" style="padding:30px 0">
  <div class="container">
    <div class="row align-items-center">
    <div class="col-6 col-md-4">
      <h2>HBCU/PBI</h2>
       <h2 class="section-title"><?php echo $page_title ?></h2>
      </div>
      <div class="col-6 col-md-8">
      <?php echo sidebar_by_url(current_url()) ?>
      </div>
     <?php /*?> <div class="col-12">
      <h2>HBCU/PBI</h2>
        <h2 class="section-title"><?php echo $page_title ?></h2>
      </div><?php */?>
      <!-- end col-12--> 
    </div>
    <?php if($spotlight_all): ?>
    <div class="row">
    <?php foreach($spotlight_all as $spotlight): //print_r($spotlight) ?>
      <div class="col-lg-4 col-md-6">
        <div class="blog-post kansas">
          <figure class="post-image">
          <?php if($spotlight['em_video']):?>
          
          <?php echo convertYoutube($spotlight['em_video'],$spotlight) ?>
          
          <?php else: ?>
          <a href="<?php echo base_url('detail/'.$spotlight['postSlug']) ?>" class="bookmark"><i class="fal fa-bookmark"></i></a> 
          <?php if(!empty($spotlight['cover_photo'])):?>
					<img class="img-fluid" src="<?php echo base_url('uploads/cover_photo/'.$spotlight['cover_photo']); ?>" />
				<?php else: ?>
					<img class="img-fluid" src="<?php echo base_url('assets/images/placeholder.jpg')?>" />
				<?php endif;?> 
          <?php endif;?>
          </figure>
          <div class="post-content">
             <ul class="post-categories">
                 <?php /*?> <?php if($spotlight['spotlight_type'] == 'Spotit Spotlight') $haha = 'General Spotlight'; else $haha = $spotlight['spotlight_type']; ?>
                    <li><a><?php echo $haha ?></a></li><?php */?>
                    <li><a><?php echo $spotlight['category'] ?></a></li>
                  </ul>
            <h3 class="post-title"><a href="<?php echo base_url('detail/'.$spotlight['postSlug']) ?>"><?php echo $spotlight['postTitle']; ?></a></h3>
            <div class="metas"> 
            
            <span class="date"><?php echo date('F jS Y',strtotime($spotlight['created_at'])); ?></span>
              <div class="dot"></div>
              <span class="author">
              
                <a href="<?php echo base_url('publicprofile/'.$spotlight['userid']) ?>"><?php 
					 $full_name =$spotlight['first_name'].' '.$spotlight['last_name'];
					 if (strlen($full_name) > 30)
						{
							echo substr($full_name, 0, 30)."...";
						}
						else
						{
							echo $full_name;
						}
?>
					 <?php // echo $bandage ?></a>
              
              </span> </div>
            <!-- end metas --> 
          </div>
          <!-- end post-content --> 
        </div>
       </div>
       <?php endforeach;?>

    </div>
      <p class="text-center wow fadeInUp">
        
        <a href="<?php echo base_url('login') ?>" class="show-more">SHOW MORE</a>
        </p>
    <?php else: ?>
    <h4> No  News Found</h4>
    <?php endif;?>
      
  </div>
  <!-- end container --> 
</section>
