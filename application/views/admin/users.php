<?php // print_r($users) ?>
<style>
.item_list{margin-bottom:10px}
</style>
<?php if($users): //print_r($users)?>
    <div class="page-content">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="mb-15"><?php  echo strtoupper(site_info()) ?> USERS </h4>
              
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Register Date</th>
                        <th>Business Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($users as $user): ?>
                          <tr>
                            <td><?php echo $user->first_name ?> <?php echo $user->last_name ?></td>
                            <td><?php echo $user->email ?></td>
                             <td><?php echo date('F,d Y',strtotime($user->created_at)) ?></td>
                            <td><?php echo $user->business_name ?></td>
                           
                             <td><?php echo $user->phone ?></td>
                            <td><button class="btn  btn-sm btn-primary" data-toggle="modal" data-target="#detail_<?php echo $user->userID ?>">Detail</button><br />                           <a style="margin-top:10px" data-userid="<?php echo $user->userID  ?>" class="btn btn_block btn-sm 
							<?php if($user->status==2) echo ' btn-danger'; else echo ' btn-success' ?>" href="">
								<?php if($user->status==2) echo 'Blocked';else echo 'Block' ?></a>
                                
                                </td>
                          </tr>
                      <?php endforeach;?>
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>
    </div>

 <?php foreach($users as $user): ?>
    <div class="modal fade" id="detail_<?php echo $user->userID ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"><?php echo $user->first_name ?> <?php echo $user->last_name ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                  
                  <img src="<?php if($user->photo)echo base_url('uploads/profile_img/').$user->photo; else echo base_url('uploads/profile_img/def.jpg');  ?>" class="img-responsive" style="max-width:100%" />
                  </div>
                  <div class="col-md-6"> 
                    <div class="item_list">
                    <?php //print_r($user) ?>
                        <p><strong>Full Name: </strong><br /><?php echo $user->first_name ?> <?php echo $user->last_name ?></p>
                    </div>
                    <div class="item_list">
                        <p><strong>Join Date: </strong><br /><?php echo date('F,d Y',strtotime($user->created_at)) ?></p>
                    </div>
                    <div class="item_list">
                        <p><strong>Email: </strong><br /><?php echo $user->email ?></p>
                    </div>
                    <div class="item_list">
                        <a target="_blank" class="btn btn-success" href="<?php echo base_url('dashboard/messages/'.$user->userID) ?>">Send Massage</a>
                    </div>
                    <div class="item_list">
                        <a target="_blank" class="btn btn-primary" href="<?php echo base_url('publicprofile/'.$user->userID) ?>">View Profile</a>
                    </div>
                    </div>
               </div>
               
                <div class="item_list" style="margin-top:20px">
                	<p><strong>About: </strong><br /><?php echo $user->about ?></p>
                </div>
                <?php if(isset($user->preferences)  && $user->preferences): ?>
                 <div class="item_list">
                	<p><strong>Preferences: </strong><br /><?php echo implode(', ',json_decode($user->preferences)) ?></p>
                </div>
                <?php endif;?>
                <?php if(isset($user->business_name)  && $user->business_name): ?>
                 <div class="item_list">
                	<p><strong>Buessines Name: </strong><?php echo $user->business_name ?></p>
                </div>
                <?php endif;?>
               
                <div class="item_list">
                	<p><strong>Buessines Email: </strong><?php echo $user->business_email ?></p>
                </div>
                <div class="item_list">
                 <p><strong>Buessines Phone #: </strong><?php echo $user->phone ?></p>
              </div>
               <?php if(isset($user->about_bussiness)  && $user->about_bussiness): ?>
                <div class="item_list">
                	<p><strong>About Buessines: </strong><br /><?php echo $user->about_bussiness ?></p>
                </div>
                <?php endif;?>
                 <?php if(isset($user->b_mission)  && $user->b_mission): ?>
                    <div class="item_list">
                        <p><strong>Mission: </strong><br /><?php echo $user->b_mission ?></p>
                    </div>
                <?php endif;?>
                <?php if(isset($user->b_address)  && $user->b_address): ?>
                    <div class="item_list">
                        <p><strong>Buessines Address: </strong><br /><?php echo $user->b_address ?></p>
                    </div>
                <?php endif;?>
                <?php if(isset($user->website)  && $user->website): ?>
                    <div class="item_list">
                        <p><strong>Buessines Website: </strong><br /><?php echo $user->website ?></p>
                    </div>
                <?php endif;?>
                 <?php if(isset($user->industry)  && $user->industry): ?>
                    <div class="item_list">
                        <p><strong>Buessines Industry: </strong><br /><?php echo $user->industry ?></p>
                    </div>
                <?php endif;?>
                 <?php if(isset($user->services)  && $user->services): ?>
                    <div class="item_list">
                        <p><strong>Buessines services: </strong><br /><?php echo implode('<br> ',json_decode($user->services)) ?></p>
                    </div>
                <?php endif;?>
                <?php if(isset($user->employees_num)  && $user->employees_num): ?>
                    <div class="item_list">
                        <p><strong>Number of Employees </strong><br /><?php echo $user->employees_num?></p>
                    </div>
                <?php endif;?>
                <?php if(isset($user->sell_products)  && $user->sell_products): ?>
                    <div class="item_list">
                        <p><strong>Products </strong><br /><?php echo $user->sell_products?></p>
                    </div>
                <?php endif;?>
                 <?php if(isset($user->expand_area)  && $user->expand_area): ?>
                    <div class="item_list">
                        <p><strong>Expand Area </strong><br /><?php echo implode(', ',json_decode($user->expand_area)) ?></p>
                    </div>
                <?php endif;?>
                <?php if(isset($user->years)  && $user->years): ?>
                    <div class="item_list">
                        <p><strong>Years in  Buessines </strong><br /><?php echo $user->years?></p>
                    </div>
                <?php endif;?>
                 <?php if(isset($user->revenue)  && $user->revenue): ?>
                    <div class="item_list">
                        <p><strong>Revenue </strong><br /><?php echo $user->revenue?></p>
                    </div>
                <?php endif;?>
                <?php if(isset($user->revenue)  && $user->revenue): ?>
                    <div class="item_list">
                        <p><strong>Revenue </strong><br /><?php echo $user->revenue?></p>
                    </div>
                <?php endif;?>
                <?php if(isset($user->certified)  && $user->certified): ?>
                    <div class="item_list">
                        <p><strong>Certified </strong><br /><?php echo implode(', ',json_decode($user->certified)) ?></p>
                    </div>
                <?php endif;?>
                <?php if(isset($user->certifications)  && $user->certifications): ?>
                    <div class="item_list">
                        <p><strong>Certifications </strong><br /><?php echo $user->certifications?></p>
                    </div>
                <?php endif;?>
                 <?php if(isset($user->awards)  && $user->awards): ?>
                    <div class="item_list">
                        <p><strong>awards </strong><br /><?php echo $user->awards ?></p>
                    </div>
                <?php endif;?>
                <?php if(isset($user->NAICS)  && $user->NAICS): ?>
                    <div class="item_list">
                        <p><strong>NAICS </strong><br /><?php echo $user->NAICS ?></p>
                    </div>
                <?php endif;?>
                <?php if(isset($user->EIN)  && $user->EIN): ?>
                    <div class="item_list">
                        <p><strong>EIN </strong><br /><?php echo $user->EIN ?></p>
                    </div>
                <?php endif;?>
                <?php if(isset($user->DUNS)  && $user->DUNS): ?>
                    <div class="item_list">
                        <p><strong>DUNS </strong><br /><?php echo $user->DUNS ?></p>
                    </div>
                <?php endif;?>
                <?php if(isset($user->SAM)  && $user->SAM): ?>
                    <div class="item_list">
                        <p><strong>SAM </strong><br /><?php echo $user->SAM ?></p>
                    </div>
                <?php endif;?>
                 <?php if(isset($user->cage)  && $user->cage): ?>
                    <div class="item_list">
                        <p><strong>Cage </strong><br /><?php echo $user->cage ?></p>
                    </div>
                <?php endif;?>
                
                
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-primary">Close</button>
          </div>
        </div>
      </div>
    </div>
<?php endforeach;?>
<?php endif;?>