<style>
  .dash_boxes .card a:hover{background:#C1C6FF; display:block}
	 /* .dash_boxes .link_boxx{background:#fff}*/
	  .dash_boxes .card a h3{color:#000}
</style>
<div class="page-content dash_boxes">

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h4 class="mb-3 mb-md-0">Welcome to <?php echo site_info() ?> Stats</h4>
  </div>
 
</div>

<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow">
    <?php //print_r($current_week); ?>
      <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
        <a href="<?php echo base_url('admin/activities/events') ?>">
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
        <div class="card">
        <a href="<?php echo base_url('admin/activities/spotit') ?>">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0"><?php site_info() ?> Promotions</h6>
              
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
              <h6 class="card-title mb-0">Reviews</h6>
              
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
              <h6 class="card-title mb-0">RECOMMENDATIONS</h6>
              
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

<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow">
      
      <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
        <a href="<?php echo base_url('admin/activities/all') ?>">
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
        <div class="card">
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
        <div class="card">
        <a href="<?php echo base_url('admin/activities/jobs') ?>">
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



        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
          <div>
            <h4 class="mb-3 mb-md-0">Top Activities</h4>
          </div>
          
        </div>

        <div class="row">
          <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow">
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Top Topics</h6>
                      
                    </div>
                        <h3 class="mb-2">15</h3>
                      
                  </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Top Keyword Search</h6>
                      
                    </div>
                    
                        <h3 class="mb-2">20</h3>
                        
                  </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Top Reviews</h6>
                      
                    </div>
                    
                        <h3 class="mb-2">55</h3>
                        
                    
                  </div>
                </div>
              </div>

              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Top Events Engagements</h6>
                      
                    </div>
                    
                        <h3 class="mb-2">23</h3>
                        
                      
                  </div>
                </div>
              </div>

            </div> <!-- row -->
          </div>
        </div>

        <div class="row">
          <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow">
              
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Top Active Business</h6>
                      
                    </div>
                    <?php
					$b_users_c = $non_b_users = 0;
					 $b_users = $this->db->get_where('users',array('level'=>0,'is_email_verified'=>1,'site_id'=>site_id()))->result();
					if($b_users){
						foreach($b_users as $user){
							$user_profile = $this->db->get_where('user_profile',array('user_id'=>$user->userID))->row();
							if($user_profile->has_business  == 1){
								$b_users_c++ ;
							}else{
								$non_b_users++;
							}
						}
					}
					 ?>
                        <h3 class="mb-2"><?php echo $b_users_c?></h3>
                        
                      
                  </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Top Active none biz members</h6>
                      
                    </div>
                  
                        <h3 class="mb-2"><?php echo $non_b_users ?></h3>
                        
                    
                  </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Top Resource Request</h6>
                      
                    </div>
                   
                        <h3 class="mb-2">35</h3>
                        
                     
                  </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Top Engaged Promotions</h6>
                      
                    </div>
                      <h3 class="mb-2">150</h3>
                        
                      
                      
                  </div>
                </div>
              </div>

            </div> <!-- row -->
          </div>
        </div>

     

        <div class="row">
          <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
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
          
        </div> <!-- row -->


        	<div class="row">
        			<div class="col-md-6">
        					
        					<div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                  <h6 class="card-title mb-0">Content Engagement</h6>
                  <div class="dropdown mb-2">
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
                  </div>
                </div>
                <p class="text-muted mb-4">Sales are activities related to selling or the number of goods or services sold in a given time period.</p>
              
								<div id="apexDonut_Alt"></div>
						

              </div> 
            </div>	

        			</div>
        			<div class="col-md-6">
        					<div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                  <h6 class="card-title mb-0">Content Engagement</h6>
                  <div class="dropdown mb-2">
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
                  </div>
                </div>
                <p class="text-muted mb-4">Sales are activities related to selling or the number of goods or services sold in a given time period.</p>
                
								<div id="apexLine_alt"></div>
							


              </div> 
            </div>
        			</div>
        	</div><!-- row -->
        


    </div>

    

