<div class="page-content">

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
<div>
<h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
</div>
<?php /*?><div class="d-flex align-items-center flex-wrap text-nowrap">
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
</div><?php */?>
</div>

<div class="row">
<div class="col-12 col-xl-12 stretch-card">
<div class="row flex-grow">
  <div class="col-md-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline">
          <h6 class="card-title mb-0">New Sign Ups</h6>
          <?php /*?><div class="dropdown mb-2">
            <button class="btn p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
              <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="edit-2" class="icon-sm mr-2"></i> <span class="">Edit</span></a>
              <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="trash" class="icon-sm mr-2"></i> <span class="">Delete</span></a>
              <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="printer" class="icon-sm mr-2"></i> <span class="">Print</span></a>
              <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="download" class="icon-sm mr-2"></i> <span class="">Download</span></a>
            </div>
          </div><?php */?>
        </div>
        <div class="row">
          <div class="col-6 col-md-12 col-xl-5">
            <h3 class="mb-2"><?php echo count($signup) ?></h3>
            
             <div class="d-flex align-items-baseline">
                <?php $value = sportlights_stats($signup) ?>
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
            
             <?php  //echo mothly_graph_signup() ?>
            </div>
          </div>
          <div class="col-6 col-md-12 col-xl-7">
            <div id="apexChart1" data-values="<?php echo mothly_graph_signup() ?>" class="mt-md-3 mt-xl-0"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline">
          <h6 class="card-title mb-0">New Subscriptions</h6>
          <?php /*?><div class="dropdown mb-2">
            <button class="btn p-0" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton1">
              <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
              <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="edit-2" class="icon-sm mr-2"></i> <span class="">Edit</span></a>
              <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="trash" class="icon-sm mr-2"></i> <span class="">Delete</span></a>
              <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="printer" class="icon-sm mr-2"></i> <span class="">Print</span></a>
              <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="download" class="icon-sm mr-2"></i> <span class="">Download</span></a>
            </div>
          </div><?php */?>
        </div>
        <div class="row">
          <div class="col-6 col-md-12 col-xl-5">
            <h3 class="mb-2">35,084</h3>
            <div class="d-flex align-items-baseline">
              <p class="text-danger">
                <span>-2.8%</span>
                <i data-feather="arrow-down" class="icon-sm mb-1"></i>
              </p>
            </div>
          </div>
          <div class="col-6 col-md-12 col-xl-7">
            <div id="apexChart2" class="mt-md-3 mt-xl-0"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline">
          <h6 class="card-title mb-0">Content Engagement</h6>
          <?php /*?><div class="dropdown mb-2">
            <button class="btn p-0" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton2">
              <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
              <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="edit-2" class="icon-sm mr-2"></i> <span class="">Edit</span></a>
              <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="trash" class="icon-sm mr-2"></i> <span class="">Delete</span></a>
              <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="printer" class="icon-sm mr-2"></i> <span class="">Print</span></a>
              <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="download" class="icon-sm mr-2"></i> <span class="">Download</span></a>
            </div>
          </div><?php */?>
        </div>
        <div class="row">
          <div class="col-6 col-md-12 col-xl-5">
            <h3 class="mb-2"><?php echo count($all) ?></h3>
            
            
            
            <?php $value = sportlights_stats($all) ?>
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
            
            
            <?php /*?><div class="d-flex align-items-baseline">
              <p class="text-success">
                <span>+2.8%</span>
                <i data-feather="arrow-up" class="icon-sm mb-1"></i>
              </p>
            </div><?php */?>
          </div>
          <div class="col-6 col-md-12 col-xl-7">
          
            <div id="apexChart3" data-values="<?php echo content_mothly_graph_admin() ?>" class="mt-md-3 mt-xl-0"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div> <!-- row -->



<div class="row">
<div class="col-lg-7 col-xl-8 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-baseline mb-2">
      <h6 class="card-title mb-0">Monthly Spotlights</h6>
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
    <p class="text-muted mb-4">Spotlights insert to site in a given time period.</p>
    <div class="monthly-sales-chart-wrapper">
      <canvas id="monthly-sales-chart2" data-values="<?php echo content_mothly_graph_admin() ?>"></canvas>
    </div>
  </div> 
</div>
</div>
<div class="col-lg-5 col-xl-4 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-baseline mb-2">
      <h6 class="card-title mb-0">Cloud storage</h6>
      <div class="dropdown mb-2">
        <button class="btn p-0" type="button" id="dropdownMenuButton5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton5">
          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="edit-2" class="icon-sm mr-2"></i> <span class="">Edit</span></a>
          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="trash" class="icon-sm mr-2"></i> <span class="">Delete</span></a>
          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="printer" class="icon-sm mr-2"></i> <span class="">Print</span></a>
          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="download" class="icon-sm mr-2"></i> <span class="">Download</span></a>
        </div>
      </div>
    </div>
    <div id="progressbar1" data-val1="<?php echo folderSize() ?>" data-val2="100" class="mx-auto"></div>
    <div class="row mt-4 mb-3">
      <div class="col-6 d-flex justify-content-end">
        <div>
          <label class="d-flex align-items-center justify-content-end tx-10 text-uppercase font-weight-medium">Total storage <span class="p-1 ml-1 rounded-circle bg-primary-muted"></span></label>
          <h5 class="font-weight-bold mb-0 text-right"><?php echo folderSize() ?> GB</h5>
        </div>
      </div>
      <div class="col-6">
        <div>
          <label class="d-flex align-items-center tx-10 text-uppercase font-weight-medium"><span class="p-1 mr-1 rounded-circle bg-primary"></span> Used storage</label>
          <h5 class="font-weight-bold mb-0">100GB</h5>
        </div>
      </div>
    </div>
    <button class="btn btn-primary btn-block">Upgrade storage</button>
  </div>
</div>
</div>
</div> <!-- row -->

<div class="row">

<div class="col-lg-12 stretch-card">
<div class="card">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-baseline mb-2">
      <h6 class="card-title mb-0">Recent Local Business Registerations</h6>
      <div class="dropdown mb-2">
        <button class="btn p-0" type="button" id="dropdownMenuButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton7">
          <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('superadmin/portal_list') ?>"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
          
        </div>
      </div>
    </div>
    <div class="table-responsive">
    
   <table class="table table-hover mb-0">
                    <thead>
                      <tr>
                      <th>#</th>
                        <th>Site Name</th>
                        <th>Admin User Name</th>
                        <th>Admin User Email</th>
                        <th>Region</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $counter=1; foreach($users as $user): ?>
                          <tr>
                          <td><?php echo $counter; $counter++ ?></td>
                            <td>
							<?php if(isset($user->domain)){
							$url =$user->domain;
							}else{
								$url =$user->url;
							}?>
							
							<a target="_blank" href="<?php echo $url ?>/publicprofile/<?php echo $user->userID ?>"><?php echo $user->site_name ?></a></td>
                            <td><?php echo $user->first_name ?> <?php echo $user->last_name ?></td>
                            <td><?php echo $user->email ?> </td>
                            <td><?php echo $user->site_name ?></td>
                            
                            <td>
                             <a style="margin-top:10px" class="btn btn-sm btn-success" href="<?php echo base_url('superadmin/add_portal/').$user->site_id ?>">Edit</a>
                            
                            
                            <a style="margin-top:10px" data-userid="<?php echo $user->userID  ?>" class="btn btn_block btn-sm btn-danger" href=""><?php if($user->status==1) echo 'Block';else echo 'Blocked' ?></a>
                            
                         
                         
         
<button style="margin-top:10px; color:#fff" class="btn btn-sm btn-danger" data-href="/delete.php?id=54" data-toggle="modal" data-target="#confirm-delete_<?php echo $user->userID ?>">
 Delete User
</button>
                            
                            
                            </td>
                          </tr>
                      <?php endforeach;?>
                      
                    </tbody>
                  </table>
    
      
    </div>
  </div> 
</div>
</div>
</div> <!-- row -->


<?php /*?><div class="row">
<div class="col-12 col-xl-12 grid-margin stretch-card">
<div class="card overflow-hidden">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
      <h6 class="card-title mb-0">Qmelocal yearly engagement</h6>
      <div class="dropdown">
        <button class="btn p-0" type="button" id="dropdownMenuButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton3">
          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="edit-2" class="icon-sm mr-2"></i> <span class="">Edit</span></a>
          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="trash" class="icon-sm mr-2"></i> <span class="">Delete</span></a>
          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="printer" class="icon-sm mr-2"></i> <span class="">Print</span></a>
          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="download" class="icon-sm mr-2"></i> <span class="">Download</span></a>
        </div>
      </div>
    </div>
    <div class="row align-items-start mb-2">
      <div class="col-md-7">
        <p class="text-muted tx-13 mb-3 mb-md-0">Revenue is the income that a business has from its normal business activities, usually from the sale of goods and services to customers.</p>
      </div>
      <div class="col-md-5 d-flex justify-content-md-end">
        <div class="btn-group mb-3 mb-md-0" role="group" aria-label="Basic example">
          <button type="button" class="btn btn-outline-primary">Today</button>
          <button type="button" class="btn btn-outline-primary d-none d-md-block">Week</button>
          <button type="button" class="btn btn-primary">Month</button>
          <button type="button" class="btn btn-outline-primary">Year</button>
        </div>
      </div>
    </div>
    <div class="flot-wrapper">
      <div id="flotChart1" class="flot-chart"></div>
    </div>
  </div>
</div>
</div>
</div><?php */?> <!-- row -->

</div>
