<div class="page-content">

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h4 class="mb-3 mb-md-0">Welcome to <?php echo site_info()?> Spotlight</h4>
    
  </div>
  <!-- <div class="d-flex align-items-center flex-wrap text-nowrap">
    <div class="input-group date datepicker dashboard-date mr-2 mb-2 mb-md-0 d-md-none d-xl-flex" id="dashboardDate">
      <span class="input-group-addon bg-transparent"><i data-feather="calendar" class=" text-primary"></i></span>
      <input type="text" class="form-control">
    </div>
    <button type="button" class="btn btn-outline-info btn-icon-text mr-2 d-none d-md-block">
      <i class="btn-icon-prepend" data-feather="download"></i>
      Import
    </button>
    <button type="button" class="btn btn-outline-primary btn-icon-text mr-2 mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="printer"></i>
      Print
    </button>
    <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="download-cloud"></i>
      Download Report
    </button>
  </div> -->
</div>

<div class="row dash_boxes">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow ">
    <?php //print_r($current_week); ?>
      <div class="col-md-3 grid-margin stretch-card">
        <div class="card link_boxx">
          <a href="<?php echo base_url('dashboard/activities/events') ?>">
          <div class="card-body">
          
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Local Events</h6>
              
            </div>
            <h3 class="mb-2"><?php if(isset($events))echo count($events);else echo 0; ?></h3>
            <div class="d-flex align-items-baseline">
            <?php $value = sportlights_stats($events) ?>
            
              <?php if($value > 0): ?>
              <p class="text-success">
                <span><?php echo $value  ?>%</span>
                <i data-feather="arrow-up" class="icon-sm mb-1"></i>
              </p>
              <?php else: ?>
              <p class="text-danger">
                <span><?php echo $value  ?>%</span>
                <i data-feather="arrow-down" class="icon-sm mb-1"></i>
              </p>
              <?php endif;?>
            </div>
          
              
          </div>
           </a>
        </div>
      </div>
      <div class="col-md-3 grid-margin stretch-card">
        <div class="card link_boxx">
          <a href="<?php echo base_url('dashboard/activities/spotit') ?>">
          <div class="card-body">
           
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0"><?php echo site_info()?> Promotions</h6>
              
            </div>
            
                <h3 class="mb-2"><?php if(isset($promotions))echo count($promotions);else echo 0; ?></h3>
                <div class="d-flex align-items-baseline">
                  <?php $p_value = sportlights_stats($promotions) ?>
                  <?php if($p_value > 0): ?>
                  <p class="text-success">
                    <span><?php echo $p_value  ?>%</span>
                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                  </p>
                  <?php else: ?>
                  <p class="text-danger">
                    <span><?php echo $p_value  ?>%</span>
                    <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                  </p>
                  <?php endif;?>
                </div>
              
             
          </div>
           </a>
        </div>
      </div>
      <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Posted Reviews</h6>
              
            </div>
            <?php $user_id = $this->session->userdata('user_id'); ?>
            <?php $count_review = $this->db->get_where('reviews',array('user_id'=>$user_id,'type'=>'review'))->num_rows() ?>
                <h3 class="mb-2"><?php echo $count_review ?></h3>
                <?php /*?><div class="d-flex align-items-baseline">
                  <p class="text-success">
                    <span>+2.8%</span>
                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                  </p>
                </div><?php */?>
              
            
          </div>
        </div>
      </div>

      <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Recommendations </h6>
              
            </div>
            
                <h3 class="mb-2"><?php 
				 $user_id = $this->session->userdata('user_id');
				
				 echo $this->db->get_where('reviews',array('user_id'=>$user_id,'type'=>'recommend'))->num_rows(); ?></h3>
                
              
          </div>
        </div>
      </div>

    </div> <!-- row -->
  </div>
</div>

<div class="row dash_boxes">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow">
      
      <div class="col-md-3 grid-margin stretch-card">
        <div class="card link_boxx">
        <a href="<?php echo base_url('dashboard/activities/all') ?>">
          <div class="card-body">
           
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Relevant Spotlights</h6>
              
            </div>
            
                <h3 class="mb-2"><?php if(isset($relevant))echo count($relevant);else echo 0; ?></h3>
                <div class="d-flex align-items-baseline">
                   <?php $r_value = sportlights_stats($relevant) ?>
                  <?php if($r_value > 0): ?>
                  <p class="text-success">
                    <span><?php echo $r_value  ?>%</span>
                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                  </p>
                  <?php else: ?>
                  <p class="text-danger">
                    <span><?php echo $r_value  ?>%</span>
                    <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                  </p>
                  <?php endif;?>
                </div>
              
          </div>
          </a>
        </div>
      </div>
      <div class="col-md-3 grid-margin stretch-card">
        <div class="card link_boxx">
           <a href="<?php echo base_url('dashboard/admin_activities') ?>">
          <div class="card-body">
          
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Support Contents</h6>
              
            </div>
          
                <h3 class="mb-2"><?php if(isset($admin_spotlights))echo count($admin_spotlights);else echo 0; ?></h3>
                <div class="d-flex align-items-baseline">
                 <?php $r_value = sportlights_stats($admin_spotlights) ?>
                  <?php if($r_value > 0): ?>
                  <p class="text-success">
                    <span><?php echo $r_value  ?>%</span>
                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                  </p>
                  <?php else: ?>
                  <p class="text-danger">
                    <span><?php echo $r_value  ?>%</span>
                    <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                  </p>
                  <?php endif;?>
                </div>
            
          </div>
          </a>
        </div>
      </div>
      <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Topics Covered</h6>
              
            </div>
           
                <h3 class="mb-2"><?php echo $topic_cover ?></h3>
               
             
          </div>
        </div>
      </div>
      <div class="col-md-3 grid-margin stretch-card">
     
        <div class="card link_boxx">
        <a href="<?php echo base_url('dashboard/activities/jobs') ?>">
          <div class="card-body">
          
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Total Job Postings</h6>
              
            </div>
              <h3 class="mb-2"><?php if(isset($jobs))echo count($jobs);else echo 0; ?></h3>
                <div class="d-flex align-items-baseline">
                 <?php $j_value = sportlights_stats($jobs) ?>
                  <?php if($j_value > 0): ?>
                  <p class="text-success">
                    <span><?php echo $j_value  ?>%</span>
                    <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                  </p>
                  <?php else: ?>
                  <p class="text-danger">
                    <span><?php echo $j_value  ?>%</span>
                    <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                  </p>
                  <?php endif;?>
                </div>
              
              
          </div>
          </a>
        </div>
      </div>

    </div> <!-- row -->
  </div>
</div>




<div class="row">
  <div class="col-lg-7 col-xl-8 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-2">
          <h6 class="card-title mb-0">Content Engagement</h6>
          <?php /*?><div class="dropdown mb-2">
            <button class="btn p-0" type="button" id="dropdownMenuButton4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton4">
              <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
              <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="edit-2" class="icon-sm mr-2"></i> <span class="">Edit</span></a>
              <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="trash" class="icon-sm mr-2"></i> <span class="">Delete</span></a>
              <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="printer" class="icon-sm mr-2"></i> <span class="">Print</span></a>
              <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="download" class="icon-sm mr-2"></i> <span class="">Download</span></a>
            </div>
          </div><?php */?>
        </div>
        <p class="text-muted mb-4">Sales are activities related to selling or the number of goods or services sold in a given time period.</p>
        <div class="monthly-sales-chart-wrapper">
          <canvas id="monthly-sales-chart2"></canvas>
        </div>
      </div> 
    </div>
  </div>
  <div class="col-lg-5 col-xl-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-2">
          <h6 class="card-title mb-0">Inbox</h6>
          <div class="dropdown mb-2">
            <button class="btn p-0" type="button" id="dropdownMenuButton6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton6">
              <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('dashboard/messages') ?>"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
             <?php /*?> <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="edit-2" class="icon-sm mr-2"></i> <span class="">Edit</span></a>
              <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="trash" class="icon-sm mr-2"></i> <span class="">Delete</span></a>
              <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="printer" class="icon-sm mr-2"></i> <span class="">Print</span></a>
              <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="download" class="icon-sm mr-2"></i> <span class="">Download</span></a><?php */?>
            </div>
          </div>
        </div>
        <?php if($user_msg = user_msg(false,10) ){ ?>
        <div class="d-flex flex-column">
          <?php foreach($user_msg as $data): ?>
           <?php $user_data = $this->db->get_where('users',array('userID'=>$data->by_user))->row(); ?>
          
          <a href="<?php echo $data->target_url ?>" class="d-flex align-items-center border-bottom pb-3 mb-2">
            <div class="mr-3">
              <img src="<?php echo base_url('uploads/profile_img/'.$user_data->photo)?>" class="rounded-circle wd-35" alt="user">
            </div>
            <div class="w-100">
              <div class="d-flex justify-content-between">
                <h6 class="text-body mb-2"><?php echo $user_data->first_name.' '.$user_data->last_name ?></h6>
                <p class="text-muted tx-12"><?php echo timeAgo($data->date_time) ?></p>
              </div>
              <p class="text-muted tx-13">New message</p>
            </div>
          </a>
          <?php endforeach ?>
        </div>
        <?php }?>
      </div>
    </div>
  </div>
</div> <!-- row -->






    </div>

    

