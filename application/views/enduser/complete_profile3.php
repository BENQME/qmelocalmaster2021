<div class="page-wrapper mob-mt30 main-pageprofile">
    <div class="page-content register-form login_step">
    <h4 class="text-center">Perfect! You've Successfully logged in</h4>
    <p class="text-center desktoponly">Please take a moment to upload your Profile Photo, add a Short Description of yourself,<br> and set your Content Preferences.</p>
    <p class="onlymob text-center mt10">Upload your Profile Photo, About and Content Preferences.</p>
    
        <div class="offset-lg-1 col-lg-10 mx-auto profile-page_tabs" id="tab-ids">
        
        <div class="custom-tabbox">
            <div class="tabbable-panel">
                <div class="tabbable-line">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#" class="contentBTn desktoponly">
                            1. Upload your profile photo </a>
                            <a href="#" class="contentBTn onlymob">
                            1. Photo </a>
                            </li>
                            <li class="active">
                            <a href="" class="mediaBTn">
                            2. About </a>
                            </li>
                            <li class="active">
                            <a href="#" class="thumbnailBtn desktoponly">
                            3. Content Preferences </a>
                            <a href="#" class="thumbnailBtn onlymob">
                        3. Preferences </a>
                    </li>
                    </ul>
                <div class="">
                <div class="tabContent" id="">
               

                 <form method="post" action="<?php echo base_url('login/complete_profile3') ?>">
                    <div class="card">
                      <div class="card-body">
                        
                         <h5 class="text-center mb-20">Please set your preferences <span style="color:red">*</span></h5>
                    <p class="text-center">Select your preferences by clicking on the preferences you want to add, such as interests, news, industry, business, etc. Our platform matches relevant content with your preferences. You can always edit your preferences later.
</p>
                    <br>
                    <div class="new-checkbox-style">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                    <input type="search" class="form-control" id="search" placeholder="Search Keywords">
                    </div>
                    <?php /*?><?php $check_box_array = array('Aerospace','Agriculture','Business Education','Community','Computers','Construction',
                    'Education','Energy','Entertainment','Finance','Government','Healthcare','Healthcare','Home and Garden','Hospitality','Law','Manufacturing','Marketing','Mining','Music / Film Production','My Life / My Journal','News','Professional Business Services','Publishing','Religion','Services Industry',
                    'Technology','Telecommunications','Transportation') ?><?php */?>
                    <?php $check_box_array = $this->db->order_by('categoryTitle','asc')->get('spotlights_category')->result(); ?>
                    <div class="row">
                    <div class="searchable-container d-flex justify-content-between">
                    
                    <div class="row">
                       <?php 
					   $pre_selected = array('Advocacy Champions','Automotive','Business News','Business Education','Corporate Spotlight','Corporate / Supplier Diversity','Education','Government Agency','Technology','Trailblazers and Leaders');
					   $p_array = array();
					   if(isset($preferences)) $p_array = json_decode($preferences);   ?>
                        <?php foreach($check_box_array  as $data): 
						$category = $data->categoryTitle;
						?>
                          <div class="col-lg-3">
                         <div class="items">
                            <div data-toggle="buttons" class="bizmoduleselect">
                               <label class="btn btn-default <?php
							   
							   if(special_cms() && (!$p_array &&  in_array($category,$pre_selected))){
								   echo 'active';
							   }elseif(is_array($p_array) && in_array($category,$p_array)) echo 'active' ?>">
                                  <div class="bizcontent">
                                     <input type="checkbox"<?php 
									  if(special_cms() && (!$p_array &&  in_array($category,$pre_selected))){
										  echo ' checked="checked"';
									  }
									 
									 elseif(is_array($p_array) && in_array($category,$p_array)) echo ' checked="checked"' ?>  name="preferences[]" autocomplete="off" value="<?php echo $category ?>">
                                     <span class="fa fa-check"></span>
                                     <h5><?php echo $category ?></h5>
                                  </div>
                               </label>
                            </div>
                         </div>
                        </div> 
                        <?php endforeach;?>
                    
                    </div> <!-- row -->
                    
                    </div><!-- searchable-container -->
                    </div> <!--row -->
                    </div> 
                    <!-- new-checkbox-style -->
                    <?php echo validation_errors(); ?>
                        <br>
                        
                        <p class="text-center mt10">
                         <a href="<?php echo base_url('login/complete_profile2?page=2') ?>" class="btn btn-primary thumbnailBtn">Previous</a>
                         <button type="submit" name="submit" value="1" class="btn btn-primary contentBTn">Save</button>
                      </p>
                    
                    
                      </div>
                    </div>
                </form>
                 
                </div>
                </div>
                </div>
            </div>
        
        </div>
        
        </div>
    
    
    </div>
</div>