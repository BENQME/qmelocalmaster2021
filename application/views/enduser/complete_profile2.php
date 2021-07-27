<div class="page-wrapper mob-mt30 main-pageprofile">
            <div class="page-content register-form login_step">
               <h4 class="text-center">Perfect! You've Successfully logged in</h4>
               <p class="text-center desktoponly">Please take a moment to upload your Profile Photo, add a Short Description of yourself,<br> and set your Content Preferences.</p>
               <p class="onlymob text-center mt10">Upload your Profile Photo, About and Content Preferences.</p>
               
               <div class="offset-lg-2 col-lg-8 mx-auto profile-page_tabs" id="tab-ids">

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
                        <li>
                           <a href="#" class="thumbnailBtn desktoponly">
                           3. Content Preferences </a>
                           <a href="#" class="thumbnailBtn onlymob">
                            3. Preferences </a>
                        </li>
                       </ul>
                   <div class="">
                    <div class="tabContent" id="">
                    <form id="about" method="post" action="<?php echo base_url('login/complete_profile2') ?>">
                          <div class="card">
                              <div class="card-body">
                                 <h5 class="text-center">A short description about you <span style="color:red">*</span>
                                 </h5>
                                 <br>
                                 <div class="form-group">
                                    <textarea class="form-control" name="about" rows="12" required="required" placeholder="A short description about you (e.g. I am happy)"><?php if(isset($about))echo $about ?></textarea>
                                 </div>

                                
                     
                          <br>
                                <p class="text-center mt10">
                                 <a href="<?php echo base_url('login/complete_profile?page=1') ?>" class="btn btn-primary thumbnailBtn">Previous</a>
                                 <button type="submit" class="btn btn-primary contentBTn">Next</button>
                                 <a href="<?php echo base_url('login/complete_profile3') ?>" class="btn btn-primary thumbnailBtn">Skip</a>
                              </p>

                              </div>
                          </div>
                    </form>
                    </div>
                    </div>
                    </div>
                    </div>
              
              </div>

               </div> <!-- tab-id-->

  
            </div>
         </div>
         
           <script>
	$("#about").validate(
	);
</script>