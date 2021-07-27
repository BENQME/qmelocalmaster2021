
<div class="page-content">
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div>
          <h4 class="mb-3 mb-md-0"><?php echo urldecode($this->uri->segment(3)) ?></h4>
        </div>
        
      </div>

    <br />
    <div class="steelton_home_section">

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
         <li class="nav-item">
            <a class="nav-link<?php if(isset($current) && $current =='media') echo ' active' ?>"  href="<?php echo base_url().'admin/activities/media'.$s_query ?>" role="tab">Media Podcast <span class="badge badge-primary"><?php echo str_pad($media_total, 2, '0', STR_PAD_LEFT); ?></span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link<?php if(isset($current) && $current =='media') echo ' active' ?>"  href="<?php echo base_url().'admin/activities/top_categories' ?>" role="tab">Top Categories</a>
        </li>
    </ul><!-- Tab panes -->
    <div class="tab-content">
    <?php if($categories): ?>
    yyyyyyyyyyyyyyyyy
		<?php foreach($categories as $cat){ //print_r($cat) ?>
        <a class="btn btn-primary" href="<?php echo base_url('admin/category/'.$cat['category']) ?>"><?php echo $cat['category'] ?>(<?php echo $cat['category_count'] ?>)</a>
        <?php } ?>
    <?php else: ?>
        <?php /*?><div class="tab-pane active" id="tabs-all" role="tabpanel">
            <div class="row set-card-spacing">
			<?php if($spotlight_all):
           	  foreach ($spotlight_all as $spotlight) { ?>
               <?php include('sportlights/post_loop.php') ?>  
            <?php } endif ?>
            </div> <!-- row -->

        </div><?php */?>
        
        <div class="tab-pane22" style="display:block">

            <div class="row set-card-spacing">
	
				<?php if($spotlight_all):
                foreach ($spotlight_all as $spotlight) { ?>
                    <?php include(FCPATH .'application/views/enduser/sportlights/post_loop.php') ?>  
                <?php }?>
               
                    <div class="pager_boxxx text-center">
                     <div class="col-md-12"><?php echo $links; ?></div>
                    </div>
                <?php endif ?>
  
            </div> <!-- row -->
        </div> <!-- tab 1 -->
        <?php endif;?>
    </div>		
</div>
</div>