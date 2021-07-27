<div class="page-content">

	<div class="profile-page tx-13">
	  <div class="row">
		<div class="col-12 grid-margin">
						<div class="profile-header">
							<div class="cover">
								
								<figure>
                                <?php //print_r($userinfo) ?>
                                <?php if(isset($userinfo) && ($userinfo->userID = $this->session->userdata('user_id'))) { ?>
                                <div class="loader cover_loader" style="display:none"></div>
                                    <form id="photoUpload" action="<?php echo base_url('dashboard/uploads?type=cover'); ?>" method="post" enctype="multipart/form-data">
                                        <div data-provides="fileupload" class="btn btn-file fileupload fileupload-new userImage" style="padding:0">
                                            <div class="fileupload-new" style="overflow:hidden">
                                               
                                                    <div class="rounded" style="width:100%;overflow:hidden">
                                                        <img id="userfile_preview" src="
														<?php if($userinfo->cover)echo base_url('uploads/covers/' .$userinfo->
cover);else echo 'https://via.placeholder.com/1148x272' ?>" class="img-fluid"/>
                                                        <input onchange="readPhoto(this, 'userfile_preview');" type="file" name="userfile" accept="image/*" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="gray-shade2"></div>
                                    </form>
                                    
                                    <?php } else { ?>
                                    
                                    <img src="https://via.placeholder.com/1148x272" class="img-fluid" alt="profile cover">
                                
                                <?php } ?>
									
								</figure>
								<div class="cover-body d-flex justify-content-between align-items-center">
									<div>
                                      <?php if(isset($userinfo) && ($userinfo->userID = $this->session->userdata('user_id'))) { ?>
                                       <div class="img_box">
                                      <img class="profile-pic" src="<?php echo base_url().'uploads/profile_img/'.$userinfo->photo; ?>" alt="profile">
                                       <a class="abs_icon" data-toggle="modal" data-target="#profile_pic" href="#"><i class="fa fa-pencil"></i></a>
                                       </div>
                                    <?php } else { ?>
										<img class="profile-pic" src="<?php echo base_url().'uploads/profile_img/'.$userinfo->photo; ?>" alt="profile">
                                        <?php } ?>
										<span class="profile-name"><?php echo $userinfo->first_name.' '.$userinfo->last_name; ?></span>
									</div>
									<div class="d-none d-md-block">
										<button class="btn btn-primary btn-icon-text btn-edit-profile btn-white">
											<i data-feather="user-check" class="btn-icon-prepend"></i> 324
									   </button>
										
										<button class="btn btn-primary btn-recommended_business btn-icon-text btn-edit-profile">
											 Recommend this business
										</button>

										<button class="btn btn-primary btn-icon-text btn-edit-profile">
											<i data-feather="edit" class="btn-icon-prepend"></i> Edit profile
										</button>
									</div>
								</div>
							</div>
							<div class="header-links">
								<ul class="links d-flex align-items-center mt-3 mt-md-0">
									<li class="header-link-item d-flex align-items-center active">
										<i class="mr-1 icon-md" data-feather="columns"></i>
										<a class="pt-1px d-none d-md-block" href="#">About my Business</a>
									</li>
									
									<li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
										<i class="mr-1 icon-md" data-feather="briefcase"></i>
										<a class="pt-1px d-none d-md-block" href="#">Jobs <span class="text-muted tx-12">(02)</span></a>
									</li>
									<li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
										<i class="mr-1 icon-md" data-feather="calendar"></i>
										<a class="pt-1px d-none d-md-block" href="#">Events <span class="text-muted tx-12">(04)</span></a>
									</li>
									<li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
										<i class="mr-1 icon-md" data-feather="bookmark"></i>
										<a class="pt-1px d-none d-md-block" href="#">Promotion <span class="text-muted tx-12">(06)</span></a>
									</li>

									<li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
										<i class="mr-1 icon-md" data-feather="archive"></i>
										<a class="pt-1px d-none d-md-block" href="#">My Activities <span class="text-muted tx-12">(34)</span></a>
									</li>

									
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="row profile-body">
					<!-- left wrapper start -->
					<div class="d-none d-md-block col-md-4 col-xl-3 left-wrapper">
						<div class="card rounded">
							<div class="card-body">
								
								<div class="">
									<label class="tx-11 font-weight-bold mb-0 text-uppercase">About <?php echo $userinfo->first_name; ?>:</label>
									<p class="text-muted"><?php echo $userprofileinfo->about; ?></p>
								</div>
								<div class="mt-3">
									<label class="tx-11 font-weight-bold mb-0 text-uppercase">Preference:</label>
									<p class="text-muted"><?php  $preference_arr = json_decode($userprofileinfo->preferences); echo implode(', ', $preference_arr) ?></p>
								</div>
								<div class="mt-3">
									<label class="tx-11 font-weight-bold mb-0 text-uppercase">Reviews:</label>
									<p class="text-muted">09</p>
								</div>
								<div class="mt-3">
									<label class="tx-11 font-weight-bold mb-0 text-uppercase">Recommandations:</label>
									<p class="text-muted">032</p>
								</div>
								<div class="mt-3">
									<label class="tx-11 font-weight-bold mb-0 text-uppercase">Business Email:</label>
									<p class="text-muted"><?php echo $userprofileinfo->business_email; ?></p>
								</div>
								<div class="mt-3">
									<label class="tx-11 font-weight-bold mb-0 text-uppercase">Website:</label>
									<p class="text-muted"><?php echo $userprofileinfo->website; ?></p>
								</div>
								<div class="mt-3 d-flex social-links">
									
									<a href="<?php echo $userprofileinfo->twitter; ?>" class="btn d-flex align-items-center justify-content-center border mr-2 btn-icon twitter">
										<i data-feather="twitter" data-toggle="tooltip" title="<?php echo $userprofileinfo->twitter; ?>"></i>
									</a>
									<a href="<?php echo $userprofileinfo->instagram; ?>" class="btn d-flex align-items-center justify-content-center border mr-2 btn-icon instagram">
										<i data-feather="instagram" data-toggle="tooltip" title="<?php echo $userprofileinfo->instagram; ?>"></i>
									</a>
									<a href="<?php echo $userprofileinfo->facebook; ?>" class="btn d-flex align-items-center justify-content-center border mr-2 btn-icon facebook">
										<i data-feather="facebook" data-toggle="tooltip" title="<?php echo $userprofileinfo->facebook; ?>"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
					<!-- left wrapper end -->
					<!-- middle wrapper start -->
					<div class="col-md-8 col-xl-6 middle-wrapper">
						
						<div class="row set-card-spacing">
							
							<div class="col-md-12 grid-margin">
									  <div class="card rounded">
										
										<div class="card-body business_profile">
										  <p class="mb-2"><strong>Business Name:</strong></p>
										  <p class="mb-3 tx-14"><?php echo $userprofileinfo->business_name; ?></p>

										  <p class="pt0"><strong>Business Address:</strong></p>
										  <p class="mb-3 tx-14"><?php echo $userprofileinfo->b_address; ?></p>

										  <p class="pt0"><strong>Business Phone Number:</strong></p>
										  <p class="mb-3 tx-14"><a href="tel:<?php echo $userprofileinfo->phone; ?>"><?php echo $userprofileinfo->phone; ?></a></p>

										  <p class="pt0"><strong>Website:</strong></p>
										  <p class="mb-3 tx-14">
											  <a href="<?php echo $userprofileinfo->website; ?>"><?php echo $userprofileinfo->website; ?></a>
										  </p>

										  <p class="pt0"><strong>Business contact email address:</strong></p>
										  <p class="mb-3 tx-14">
											  <a href="mailto:<?php echo $userprofileinfo->business_email; ?>"><?php echo $userprofileinfo->business_email; ?></a>
										  </p>


										  <p class="pt0"><strong>Number of years in business:</strong></p>
										  <p class="mb-3 tx-14"><?php echo $userprofileinfo->years; ?></p>


										  <p class="pt0"><strong>About, Mission & Vision:</strong></p>
										  <p class="mb-3 tx-14">sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
										  
										  <p class="pt0"><strong>Business Industry:</strong></p>
										  <p class="mb-3 tx-14"><?php echo $userprofileinfo->industry; ?></p>

										  <p class="pt0"><strong>Business Services:</strong></p>
										  <p class="mb-3 tx-14"><?php echo $userprofileinfo->b_services; ?></p>

										  <p class="pt0"><strong>Business Certifications & Awards:</strong></p>
										  <p class="mb-3 tx-14">tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>

										  <p class="pt0"><strong>Dun and Bradstreet Number:</strong></p>
										  <p class="mb-3 tx-14">exercitation ullamco laboris nisi ut aliquip ex ea commodo
											consequat.</p>

										  <p class="pt0"><strong>NAICS Codes:</strong></p>
										  <p class="mb-3 tx-14">cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non</p>

										  <p class="pt0"><strong>Basic description of your business services and offerings:</strong></p>
										  <p class="mb-3 tx-14"><?php  $service_arr = json_decode($userprofileinfo->services); 
										  echo implode(', ', $service_arr); ?>

										</p>



										  
										</div>
									
									  </div>
							</div>
						  </div>

					</div>
					<!-- middle wrapper end -->
					<!-- right wrapper start -->
					<div class="d-none d-xl-block col-xl-3 right-wrapper">
						<div class="row">
							<div class="col-md-12 grid-margin">
								<div class="card rounded">
									<div class="card-body">
										<h6 class="card-title">Engagements</h6>
										<div id="apexPie"></div>
									</div>
								</div>
							</div>	
							
							<div class="col-md-12 grid-margin">
								<div class="card rounded">
									<div class="card-body">
										<h6 class="card-title">latest photos</h6>
										<div class="latest-photos">
											<div class="row">
												<div class="col-md-4">
													<figure>
														<img class="img-fluid" src="https://via.placeholder.com/67x67" alt="">
													</figure>
												</div>
												<div class="col-md-4">
													<figure>
														<img class="img-fluid" src="https://via.placeholder.com/67x67" alt="">
													</figure>
												</div>
												<div class="col-md-4">
													<figure>
														<img class="img-fluid" src="https://via.placeholder.com/67x67" alt="">
													</figure>
												</div>
												<div class="col-md-4">
													<figure>
														<img class="img-fluid" src="https://via.placeholder.com/67x67" alt="">
													</figure>
												</div>
												<div class="col-md-4">
													<figure>
														<img class="img-fluid" src="https://via.placeholder.com/67x67" alt="">
													</figure>
												</div>
												<div class="col-md-4">
													<figure>
														<img class="img-fluid" src="https://via.placeholder.com/67x67" alt="">
													</figure>
												</div>
												<div class="col-md-4">
													<figure class="mb-0">
														<img class="img-fluid" src="https://via.placeholder.com/67x67" alt="">
													</figure>
												</div>
												<div class="col-md-4">
													<figure class="mb-0">
														<img class="img-fluid" src="https://via.placeholder.com/67x67" alt="">
													</figure>
												</div>
												<div class="col-md-4">
													<figure class="mb-0">
														<img class="img-fluid" src="https://via.placeholder.com/67x67" alt="">
													</figure>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12 grid-margin">
								<div class="card rounded">
									<div class="card-body">
										<h6 class="card-title">suggestions for you</h6>
										<div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
											<div class="d-flex align-items-center hover-pointer">
												<img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">													
												<div class="ml-2">
													<p>Mike Popescu</p>
													<p class="tx-11 text-muted">12 Mutual Friends</p>
												</div>
											</div>
											<button class="btn btn-icon"><i data-feather="user-plus" data-toggle="tooltip" title="Connect"></i></button>
										</div>
										<div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
											<div class="d-flex align-items-center hover-pointer">
												<img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">													
												<div class="ml-2">
													<p>Mike Popescu</p>
													<p class="tx-11 text-muted">12 Mutual Friends</p>
												</div>
											</div>
											<button class="btn btn-icon"><i data-feather="user-plus" data-toggle="tooltip" title="Connect"></i></button>
										</div>
										<div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
											<div class="d-flex align-items-center hover-pointer">
												<img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">													
												<div class="ml-2">
													<p>Mike Popescu</p>
													<p class="tx-11 text-muted">12 Mutual Friends</p>
												</div>
											</div>
											<button class="btn btn-icon"><i data-feather="user-plus" data-toggle="tooltip" title="Connect"></i></button>
										</div>
										<div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
											<div class="d-flex align-items-center hover-pointer">
												<img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">													
												<div class="ml-2">
													<p>Mike Popescu</p>
													<p class="tx-11 text-muted">12 Mutual Friends</p>
												</div>
											</div>
											<button class="btn btn-icon"><i data-feather="user-plus" data-toggle="tooltip" title="Connect"></i></button>
										</div>
										<div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
											<div class="d-flex align-items-center hover-pointer">
												<img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">													
												<div class="ml-2">
													<p>Mike Popescu</p>
													<p class="tx-11 text-muted">12 Mutual Friends</p>
												</div>
											</div>
											<button class="btn btn-icon"><i data-feather="user-plus" data-toggle="tooltip" title="Connect"></i></button>
										</div>
										<div class="d-flex justify-content-between">
											<div class="d-flex align-items-center hover-pointer">
												<img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">													
												<div class="ml-2">
													<p>Mike Popescu</p>
													<p class="tx-11 text-muted">12 Mutual Friends</p>
												</div>
											</div>
											<button class="btn btn-icon"><i data-feather="user-plus" data-toggle="tooltip" title="Connect"></i></button>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- right wrapper end -->
				</div>
		</div>

</div>
<div id="profile_pic" class="modal fade" role="dialog">
  <div class="modal-dialog model-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <div class="card2">
            <div class="card-body">
             <h5 class="text-center">Edit your profile photo
        
                </h5>
        
                <br />
            <div class="row"> 
                <div class="col-md-8 text-center">
                    <img id="upload-demo" class="img-responsive" src="
                    
                     <?php if($userinfo->photo):?>
                    <?php echo base_url('uploads/profile_img/'.$userinfo->photo) ?>
                        <?php elseif($facebookUID = $userinfo->facebookUID): ?>
                        <?php echo $facebookUID ?>
                        <?php else: ?>
                    <?php echo base_url('assets/images/placeholder.jpg')?>
                    <?php endif;?>" />
                </div>
               
                <div class="col-md-4" style="">
                    <div id="upload-demo-i" style=""><?php if($userinfo->photo):?>
                    <img class="img-responsive" src="<?php echo base_url('uploads/profile_img/'.$userinfo->photo) ?>" />
                    <?php endif ?>
                     </div>
                </div>
                
                 <div class="col-md-12">
                    <strong>Select Image:</strong>
                    <div class="row"> 
                       <div class="form-group col-md-6">
                            <input type="file" id="upload" class="form-control">
                            </div>
                        <div class="form-group col-md-6">
                            <button class="btn btn-primary btn-success upload-result">Crop Image</button>
                        </div>
                       
                        
                        
               <div class="form-group">         
        <div id="loading" style="display:block"></div>
        </div>
        <br />
              
                    </div>
                </div>
                  
            </div>
            
            </div>
        
        
        
                     
        
                   </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<script type="text/javascript">
$uploadCrop = $('#profile_pic #upload-demo').croppie({
    enableExif: false,
    viewport: {
        width: 250,
        height: 250,
    },
    boundary: {
        height: 300
    }
});
     
$('#profile_pic #upload').on('change', function () { 
	var reader = new FileReader();
    reader.onload = function (e) {
    	$uploadCrop.croppie('bind', {
    		url: e.target.result
    	}).then(function(){
    		console.log('jQuery bind complete');
    	});
    	    
    }
    reader.readAsDataURL(this.files[0]);
});
     
$('#profile_pic .upload-result').on('click', function (ev) {
	ev.preventDefault();
	$uploadCrop.croppie('result', {
		type: 'canvas',
		size: 'viewport'
	}).then(function (resp) {
     
		$.ajax({
			url: "<?php echo base_url() ?>login/ajax_img_upload",
			type: "POST",
			data: {"image":resp},
			 beforeSend: function(){
				 $('#loading').html('Uploading....');
				 $('.upload-result').hide();
				
			},
			success: function (data) {
				//location.reload();
				 $('#loading').hide();
				  $('.upload-result').show();
				html = '<img src="' + resp + '" />';
				$("#upload-demo-i").html(html);
			}
		});
	});
});
    
</script>
