<div class="page-content">



    <!-- <h3><i class="link-icon" data-feather="home"></i> Steelton Spotlight</h3> -->
    
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div>
          <h4 class="mb-3 mb-md-0"><i class="link-icon" data-feather="home"></i> My Feed</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">

        <div id="the-basics">
        <?php if(!empty($this->input->get('search'))) $s_query = '?search='.$this->input->get('search');else $s_query =""; ?>
            <form id="search_feed" method="get" action="<?php echo base_url('dashboard/myfeed/'.$this->uri->segment(3)); ?>">
                <input class="typeahead" name="search" type="text" value="<?php if(isset($_GET['search']) && $_GET['search']) echo $_GET['search'] ?>" placeholder="Search">
            </form>
        </div>
        </div>
      </div>

    <br />
       <div class="steelton_home_section">
        
            <ul class="nav nav-tabs " role="tablist">
                <?php $current =  $this->uri->segment(3); ?>
                <li class="nav-item">
                    <a class="nav-link<?php if(!isset($current)||(isset($current) && $current =='all')) echo ' active' ?>"  href="<?php echo base_url('dashboard/myfeed/all'.$s_query) ?>" role="tab">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?php if(isset($current) && $current =='news') echo ' active' ?>" href="<?php echo base_url('dashboard/myfeed/news'.$s_query) ?>" role="tab">News & Blog <span class="badge badge-primary">
                    <?php echo str_pad($news_total, 2, '0', STR_PAD_LEFT); ?></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if(isset($current) && $current =='jobs') echo ' active' ?>"  href="<?php echo base_url('dashboard/myfeed/jobs'.$s_query) ?>" role="tab">Jobs <span class="badge badge-primary"><?php echo str_pad($job_total, 2, '0', STR_PAD_LEFT); ?></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?php if(isset($current) && $current =='events') echo ' active' ?>" href="<?php echo base_url('dashboard/myfeed/events'.$s_query) ?>" role="tab">Events <span class="badge badge-primary"><?php echo str_pad($event_total, 2, '0', STR_PAD_LEFT); ?></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?php if(isset($current) && $current =='spotit') echo ' active' ?>"  href="<?php echo base_url('dashboard/myfeed/spotit'.$s_query) ?>" role="tab">General Spotlights <span class="badge badge-primary"><?php echo str_pad($spotit_total, 2, '0', STR_PAD_LEFT); ?></span></a>
                </li>
                
            </ul><!-- Tab panes -->
            <div class="tab-content">
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
                            <?php include('sportlights/post_loop.php') ?>  
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