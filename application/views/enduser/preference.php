<div class="page-wrapper mob-mt30 main-pageprofile">
    <div class="page-content register-form login_step">
    <h4 class="text-center">Your Preferences</h4>
    <br />
    <br />
        <div class="offset-lg-1 col-lg-10 mx-auto profile-page_tabs" id="tab-ids">
        
        <div class="custom-tabbox">
            <div class="tabbable-panel">
                <div class="tabbable-line">
                    
                <div class="">
                <div class="tabContent" id="">
                <?php if($sucesess = $this->session->flashdata('sucesess')): ?>
                    <div class="alert alert-success" role="alert">
                     <?php echo $sucesess ?>
                    </div>
                <?php endif ?>
                 <form method="post" action="<?php echo base_url('dashboard/preference') ?>">
                    <div class="card">
                      <div class="card-body">
                        
                         <h5 class="text-center mb-20">Please set your preferences</h5>
                    <p class="text-center">Select all that applies, choose preferences you would like to learn about, Interests, News, Industry, Business, etc. Our platform matches relevant content with your preferences. You can always edit your preferences later.</p>
                    <br>
                    <div class="new-checkbox-style">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                    <input type="search" class="form-control" id="search" placeholder="Search Keywords">
                    </div>
                    <?php 
					
					$check_box_array = $this->db->order_by('categoryTitle','asc')->get('spotlights_category')->result();
					//print_r($check_box_array);
					
					/*$check_box_array = array('Aerospace','Agriculture','Business Education','Community','Computers','Construction',
                    'Education','Energy','Entertainment','Finance','Government','Healthcare','Healthcare','Home and Garden','Hospitality','Law','Manufacturing','Marketing','Mining','Music / Film Production','My Life / My Journal','News','Professional Business Services','Publishing','Religion','Services Industry',
                    'Technology','Telecommunications','Transportation')*/ ?>
                    <div class="row">
                    <div class="searchable-container d-flex justify-content-between">
                    
                    <div class="row">
                       <?php 
					   $p_array = array();
					   if(isset($preferences)) $p_array = json_decode($preferences);   ?>
                        <?php foreach($check_box_array  as $data): 
						$category = $data->categoryTitle;
						?>
                          <div class="col-lg-3">
                         <div class="items">
                            <div data-toggle="buttons" class="bizmoduleselect">
                               <label class="btn btn-default <?php if(is_array($p_array) && in_array($category,$p_array)) echo 'active' ?>">
                                  <div class="bizcontent">
                                     <input type="checkbox"<?php if(is_array($p_array) && in_array($category,$p_array)) echo ' checked="checked"' ?>  name="preferences[]" autocomplete="off" value="<?php echo $category ?>">
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
                    
                        <br>
                        
                        <p class="text-center mt10">
                        
                         <button type="submit" name="submit" value="1" class="btn btn-primary contentBTn">Update</button>
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