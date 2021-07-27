<div class="page-content">
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div>
          <h4 class="mb-3 mb-md-0">My Spotlight</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
<?php if(!empty($this->input->get('search'))) $s_query = '?search='.$this->input->get('search');else $s_query =""; ?>
        <div id="the-basics">
            <form id="search_feed" method="get" action="<?php echo base_url() ?>admin/myspotlight/<?php echo $this->uri->segment(4); ?>">
                <input class="typeahead" name="search" type="text" value="<?php if(isset($_GET['search']) && $_GET['search']) echo $_GET['search'] ?>" placeholder="Search">
            </form>
        </div>
        </div>
      </div>

    <br />
    <div class="steelton_home_section">

    <ul class="nav nav-tabs " role="tablist">
        <?php 
		
		$current =  $this->uri->segment(3);
		
		 ?>
        <li class="nav-item">
            <a class="nav-link<?php if(!isset($current)||(isset($current) && $current =='all')) echo ' active' ?>"  href="<?php echo base_url().'admin/myspotlight/all'.$s_query ?>" role="tab">All</a>
        </li>
        <li class="nav-item">
            <a class="nav-link<?php if(isset($current) && $current =='news') echo ' active' ?>" href="<?php echo base_url().'dashboard/myspotlight/news'.$s_query?>" role="tab">News & Blog <span class="badge badge-primary">
			<?php echo str_pad($news_total, 2, '0', STR_PAD_LEFT); ?></span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if(isset($current) && $current =='jobs') echo ' active' ?>"  href="<?php echo base_url().'dashboard/myspotlight/jobs'.$s_query ?>" role="tab">Jobs <span class="badge badge-primary"><?php echo str_pad($job_total, 2, '0', STR_PAD_LEFT); ?></span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link<?php if(isset($current) && $current =='events') echo ' active' ?>" href="<?php echo base_url().'dashboard/myspotlight/events'.$s_query?>" role="tab">Events <span class="badge badge-primary"><?php echo str_pad($event_total, 2, '0', STR_PAD_LEFT); ?></span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link<?php if(isset($current) && $current =='spotit') echo ' active' ?>"  href="<?php echo base_url().'dashboard/myspotlight/spotit'.$s_query ?>" role="tab">General Spotlights <span class="badge badge-primary"><?php echo str_pad($spotit_total, 2, '0', STR_PAD_LEFT); ?></span></a>
        </li>
         <li class="nav-item">
            <a class="nav-link<?php if(isset($current) && $current =='media') echo ' active' ?>"  href="<?php echo base_url().'dashboard/myspotlight/media'.$s_query ?>" role="tab">Media/Podcast <span class="badge badge-primary"><?php echo str_pad($media_total, 2, '0', STR_PAD_LEFT); ?></span></a>
        </li>
        <?php $user_level = $this->session->userdata('user_level'); ?>
        <?php if(special_cms() && $user_level): ?>
         <li class="nav-item">
            <a class="nav-link<?php if(isset($current) && $current =='hbcu') echo ' active' ?>"  href="<?php echo base_url().'dashboard/myspotlight/hbcu'.$s_query ?>" role="tab">HBCU News <span class="badge badge-primary"><?php echo str_pad($hbsu_total, 2, '0', STR_PAD_LEFT); ?></span></a>
        </li>
        <?php endif;?>
    </ul><!-- Tab panes -->
    <div class="tab-content">
        
        <div class="tab-pane22" style="display:block">

            <div class="row set-card-spacing">
	
				<?php if($spotlight_posts):
	foreach ($spotlight_posts as $spotlight) { 
	
	$type = 'my_spotlight' ?>
                    <?php include(FCPATH .'application/views/enduser/sportlights/post_loop.php') ?>  
                <?php }?>
               
                    <div class="pager_boxxx text-center">
                     <div class="col-md-12"><?php echo $links; ?></div>
                    </div>
                <?php endif ?>
  
            </div> <!-- row -->
        </div> <!-- tab 1 -->
    </div>		
</div>
</div>



<?php /*?><div class="page-content">
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
<div>
<h4 class="mb-3 mb-md-0">My Spotlight</h4>
</div>
<div class="d-flex align-items-center flex-wrap text-nowrap">

<div id="the-basics">
<form id="search_spotlight" method="post" action="<?php echo base_url('dashboard/myspotlight/'); ?>">
	<input class="typeahead" name="search" type="text" value="<?php echo $search_text; ?>" placeholder="Search">
</form>
</div>
</div>


<ul class="nav nav-tabs " role="tablist">
        <?php 
		
		$current =  $this->uri->segment(3);
		
		 ?>
        <li class="nav-item">
            <a class="nav-link<?php if(!isset($current)||(isset($current) && $current =='all')) echo ' active' ?>"  href="<?php echo base_url().'admin/activities/all'.$s_query ?>" role="tab">All</a>
        </li>
        <li class="nav-item">
            <a class="nav-link<?php if(isset($current) && $current =='news') echo ' active' ?>" href="<?php echo base_url().'admin/activities/news'.$s_query?>" role="tab">News & Blog <span class="badge badge-primary">
			<?php echo str_pad($news_total, 2, '0', STR_PAD_LEFT); ?></span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if(isset($current) && $current =='jobs') echo ' active' ?>"  href="<?php echo base_url().'admin/activities/jobs'.$s_query ?>" role="tab">Jobs <span class="badge badge-primary"><?php echo str_pad($job_total, 2, '0', STR_PAD_LEFT); ?></span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link<?php if(isset($current) && $current =='events') echo ' active' ?>" href="<?php echo base_url().'admin/activities/events'.$s_query?>" role="tab">Events <span class="badge badge-primary"><?php echo str_pad($event_total, 2, '0', STR_PAD_LEFT); ?></span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link<?php if(isset($current) && $current =='spotit') echo ' active' ?>"  href="<?php echo base_url().'admin/activities/spotit'.$s_query ?>" role="tab">General Spotlights <span class="badge badge-primary"><?php echo str_pad($spotit_total, 2, '0', STR_PAD_LEFT); ?></span></a>
        </li>
    </ul>


</div>
<div class="row set-card-spacing">
	<?php 
	foreach ($spotlight_posts as $spotlight) { 
	
	$type = 'my_spotlight' ?>
     <?php include(FCPATH .'application/views/enduser/sportlights/post_loop.php') ?>  
<?php } ?>

</div><?php */?>