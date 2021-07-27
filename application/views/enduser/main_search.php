<div class="page-content">

<?php if(!empty($this->input->get('search'))) $s_query = '?search='.$this->input->get('search');else $s_query =""; ?>

    <!-- <h3><i class="link-icon" data-feather="home"></i> Steelton Spotlight</h3> -->
    
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div>
          <h4 class="mb-3 mb-md-0">Search Result for "<?php echo $_GET['search'] ?>"</h4>
        </div>
        <?php /*?><div class="d-flex align-items-center flex-wrap text-nowrap">
<?php if(!empty($this->input->get('search'))) $s_query = '?search='.$this->input->get('search');else $s_query =""; ?>
        <div id="the-basics">
            <form id="search_feed" method="get" action="<?php echo base_url('dashboard/activities/'.$this->uri->segment(3)); ?>">
                <input class="typeahead" name="search" type="text" value="<?php if(isset($_GET['search']) && $_GET['search']) echo $_GET['search'] ?>" placeholder="Search">
            </form>
        </div>
        </div><?php */?>
      </div>

    <br />
    <div class="steelton_home_section">

    <ul class="nav nav-tabs " role="tablist">
        <?php $current =  $this->uri->segment(3); ?>
      <li class="nav-item">
            <a class="nav-link<?php if(!isset($current)||(isset($current) && $current =='all')) echo ' active' ?>"  href="<?php echo base_url('dashboard/main_search/all'.$s_query) ?>" role="tab">All</a>
        </li>
        <li class="nav-item">
            <a class="nav-link<?php if(isset($current) && $current =='news') echo ' active' ?>" href="<?php echo base_url('dashboard/main_search/news'.$s_query) ?>" role="tab">News & Blog <span class="badge badge-primary">
			<?php echo str_pad($news_total, 2, '0', STR_PAD_LEFT); ?></span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if(isset($current) && $current =='jobs') echo ' active' ?>"  href="<?php echo base_url('dashboard/main_search/jobs'.$s_query) ?>" role="tab">Jobs <span class="badge badge-primary"><?php echo str_pad($job_total, 2, '0', STR_PAD_LEFT); ?></span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link<?php if(isset($current) && $current =='events') echo ' active' ?>" href="<?php echo base_url('dashboard/main_search/events'.$s_query) ?>" role="tab">Events <span class="badge badge-primary"><?php echo str_pad($event_total, 2, '0', STR_PAD_LEFT); ?></span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link<?php if(isset($current) && $current =='spotit') echo ' active' ?>"  href="<?php echo base_url('dashboard/main_search/spotit'.$s_query) ?>" role="tab">General Spotlights <span class="badge badge-primary"><?php echo str_pad($spotit_total, 2, '0', STR_PAD_LEFT); ?></span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link<?php if(isset($current) && $current =='user') echo ' active' ?>"  href="<?php echo base_url('dashboard/main_search/users'.$s_query) ?>" role="tab">Users <span class="badge badge-primary"><?php echo str_pad($user_total, 2, '0', STR_PAD_LEFT); ?></span></a>
        </li>
    </ul><!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane22" style="display:block">
            <div class="row set-card-spacing">	
					<?php 
					if($spotlight_all):
					if($current =='users'){ ?>
                    <?php if($spotlight_all): // print_r($spotlight_all) ?>
						 <?php $counter=0; foreach($spotlight_all as $person): //print_r($person) ?>
                        <?php //if($counter%4==0) echo '<div class="row set-card-spacing">'; $counter++  ?>
                            <div class="col-md-3 grid-margin">
                                <div class="card rounded">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                
                                                <div class="ml-2">
                                                    <p><?php echo $person['first_name'] ?> <?php echo $person['last_name'] ?> </p>
                                                 
                                                </div>
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn p-0" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="icon-lg pb-3px" data-feather="more-horizontal"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                    <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('dashboard/messages/'.$person['userID']);?>"><i data-feather="meh" class="icon-sm mr-2"></i> <span class="">Send a Message</span></a>
                                                    <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('publicprofile/'.$person['userID']);?>"><i data-feather="corner-right-up" class="icon-sm mr-2"></i> <span class="">Go to Profile</span></a>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <a href="<?php echo base_url('publicprofile/'.$person['userID']);?>"> 
                                        <img class="img-fluid" src="<?php if($person['photo']) echo base_url().'uploads/profile_img/'.$person['photo']; else echo 'https://via.placeholder.com/513x513' ?>" alt="">
                                        </a>
                                    </div>
                                
                                </div>
                            </div> <!-- col -->
                
                       <?php //if($counter%4==0 ||  count($spotlight_all) == $counter) echo '</div>';  ?>
                
                        <?php endforeach; ?>
                        <?php endif ?>
					<?php }else{
					
					
                        foreach ($spotlight_all as $spotlight) { ?>
							<?php include('sportlights/post_loop.php') ?>  
                    <?php }?>
                    
                    <?php } ?>
                    <div class="pager_boxxx text-center">
                     <div class="col-md-12"><?php echo $links; ?></div>
                    </div>
                  <?php endif ?>
  
            </div> <!-- row -->
        </div> <!-- tab 1 -->
    </div>		
</div>
</div>