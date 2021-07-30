<div class="page-wrapper">
    <div class="page-content register-form login_step">

        <h4 class="text-center">Edit Your Profile</h4>
       
        
        <br />
        <br />
        
  <form id="bussiness_register" action="<?php echo base_url('dashboard/edit_profile') ?>" method="post">
    <div class="row w-100 mx-0 auth-page">

  <div class="offset-2 col-md-8 mx-auto">


              
                    <div class="card">
                         <?php if($sucesess = $this->session->flashdata('sucesess')): ?>
                    <div class="alert alert-success" role="alert">
                     <?php echo $sucesess ?>
                    </div>
                <?php endif ?>
                        <div class="auth-form-wrapper px-4 py-4">
                        
                        <div class="row">
                            <div class="col-md-6">
                               <div class="form-group">
                                  <label class="control-label">First Name <span class="redstar">*</span></label>
                                  <input type="text" required="required" class="form-control" name="first_name"
                                   value="<?php if(isset($userinfo->first_name)) echo $userinfo->first_name ?>" placeholder="First Name">
                                  
                               </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb5">
                                    <label class="control-label">Last Name <span class="redstar">*</span></label>
                                    <input type="text" required="required" name="last_name" value="<?php if(isset($userinfo->last_name)) echo $userinfo->last_name ?>" class="form-control" placeholder="Last Name">
                                 </div>
                            </div>
                        </div> <!-- row -->
                        <div class="row">
                        <div class="col-md-12">
                                <div class="form-group mb5">
                                    <label class="control-label">Add Your Title <span class="redstar">*</span></label>
                                    <input type="text" required="required" name="title" value="<?php if(isset($userinfo->title)) echo $userinfo->title ?>" class="form-control" placeholder="I am a Accountant">
                                 </div>
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-md-12">
                               <div class="form-group">
                                  <label class="control-label">A short description about you <span class="redstar">*</span></label>
                                  <textarea class="form-control" name="about" rows="4" required="required"><?php if(isset($userprofileinfo->about)) echo $userprofileinfo->about ?></textarea>
                               </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                           <div class="thumbnail thumb_boxxx">
                              <label class="control-label">Profile Picture</label>
                              <div>
							  <?php if(isset($userinfo) && ($userinfo->userID = $this->session->userdata('user_id'))) { ?>
                               <div class="img_box">
                              <img class="profile-pic" src="<?php echo base_url().'uploads/profile_img/'.$userinfo->photo; ?>" alt="profile">
                              
                               </div>
                            <?php } else { ?>
                                <img class="profile-pic" src="<?php echo base_url().'uploads/profile_img/'.$userinfo->photo; ?>" alt="profile">
                                <?php } ?>
                            
                            </div>
                           </div>
                            <a class="abs_icon2" data-toggle="modal" data-target="#profile_pic" href="#"><i class="fa fa-pencil"></i> Update Picture</a>
                        </div>
                        
                        </div>
                        
        <?php /*?>               
                        
                        
                        <div class="row">
                            <div class="col-md-6">
                               <div class="form-group">
                                  <label class="control-label">Enter your business email <span class="redstar">*</span></label>
                                  <input type="email" required="required" class="form-control" name="business_email"
                                   value="<?php if(isset($userprofileinfo->business_email)) echo $userprofileinfo->business_email ?>" placeholder="Email">
                                  
                               </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb5">
                                    <label class="control-label">Name of your business <span class="redstar">*</span></label>
                                    <input type="text" required="required" name="business_name" value="<?php if(isset($userprofileinfo->business_name)) echo $userprofileinfo->business_name ?>" class="form-control" placeholder="Business Name">
                                 </div>
                            </div>
                        </div> 

                        
                        <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="control-label">Tell us about your business <span class="redstar">*</span></label>
                              <textarea class="form-control" name="about_bussiness" rows="4" required="required"><?php if(isset($userprofileinfo->about_bussiness)) echo $userprofileinfo->about_bussiness ?></textarea>
                           </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Your Business Mission, and Vision? <span class="redstar">*</span></label>
                                <textarea class="form-control" rows="4" required="required" name="b_mission"><?php if(isset($userprofileinfo->b_mission)) echo $userprofileinfo->b_mission ?></textarea>
                             </div>
                        
                        </div>
                        </div> 
                        
                        <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="control-label">What is your business address? <span class="redstar">*</span></label>
                              <input type="text" class="form-control" required="required" name="b_address" value="<?php if(isset($userprofileinfo->b_address)) echo $userprofileinfo->b_address ?>" placeholder="Business address">
                           </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Your business phone number? <span class="redstar">*</span></label>
                                <!-- <input type="text" class="form-control" placeholder="Business Name"> -->
                                <input type="tel" class="form-control mb-4 mb-md-0" required="required" name="phone" value="<?php if(isset($userprofileinfo->phone)) echo $userprofileinfo->phone ?>" data-inputmask-alias="(+99) 9999-9999"/>
                             </div>
                        
                        </div>
                        </div> <!-- row -->
                        
                        <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="control-label">What is your business website url address?</label>
                              <input type="url" class="form-control" required="required" name="website" value="<?php if(isset($userprofileinfo->website)) echo $userprofileinfo->website ?>"  placeholder="Business address">
                           </div>
                        </div>
                        
                        </div> <!-- row --><?php */?>
                        
                        <label class="control-label">Link your social media accounts</label>
                        
                        <div class="row socail_roww">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">
                                      <i class="feather icon-facebook"></i>
                                  </span>
                                </div>
                                <input type="url" class="form-control" name="facebook" placeholder="Facebook URL" value="<?php if(isset($userprofileinfo->facebook)) echo $userprofileinfo->facebook ?>" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                        
                        </div>
                        
                        <div class="col-md-6">
                        
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">
                                    <i class="feather icon-twitter"></i>
                                  </span>
                                </div>
                                <input type="url" class="form-control" name="twitter" value="<?php if(isset($userprofileinfo->twitter)) echo $userprofileinfo->twitter ?>" placeholder="Twitter URL" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                            
                         </div>
                        
                        </div> <!-- row -->
                        
                        <div class="row socail_roww">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">
                                    <i class="feather icon-instagram"></i>
                                  </span>
                                </div>
                                <input type="url" class="form-control" name="instagram" value="<?php if(isset($userprofileinfo->instagram)) echo $userprofileinfo->instagram ?>" placeholder="Instagram URL" aria-label="Username">
                              </div>
                        
                        </div>
                        
                        <div class="col-md-6">
                        
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">
                                    <i class="feather icon-linkedin"></i>
                                  </span>
                                </div>
                                <input type="url" class="form-control" name="linkedin" value="<?php if(isset($userprofileinfo->linkedin)) echo $userprofileinfo->linkedin ?>" placeholder="Linkedin URL" aria-label="Username">
                              </div>
                            
                         </div>
                        
                        </div> <!-- row -->
                        
                        
                        
                        </div>
                    </div>
                
          
      </div>
    </div>
    <br />
            
    <p class="text-center">
        <button type="submit" name="submit" value="1" class="btn btn-primary" role="button">Update</a>
    </p>
    </form>


    </div>
</div>


<div id="profile_pic" class="modal fade" role="dialog">
  <div class="modal-dialog model-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <div class="card2">
            <div class="card-body">
            <div class="row"> 
                <div class="col-md-12 hide_loadd">
                    <img id="upload-demo" class="img-responsive" src="
                    
                     <?php if($publicuserinfo->photo):?>
                    <?php echo base_url('uploads/profile_img/'.$publicuserinfo->photo) ?>
                        <?php elseif($facebookUID = $publicuserinfo->facebookUID): ?>
                        <?php echo $facebookUID ?>
                        <?php else: ?>
                    <?php echo base_url('assets/images/placeholder.jpg')?>
                    <?php endif;?>" />
                </div>
               
                <div class="col-md-4 hide_this_always">
                    <div id="upload-demo-i" style=""><?php if($publicuserinfo->photo):?>
                    <img class="img-responsive" src="<?php echo base_url('uploads/profile_img/'.$publicuserinfo->photo) ?>" />
                    <?php endif ?>
                     </div>
                </div>
                
                 <div class="col-md-12">
                   <strong>Select Image:</strong>
                    <div class="row form-inline"> 
                       <div class="form-group col-md-8">
                        
                            <input type="file" id="upload" class="form-control">
                            </div>
                        <div class="form-group col-md-4">
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
  <script>
	$("#bussiness_register").validate(
	);
</script>
<script type="text/javascript">
$( document ).ready(function() {
    $('#profile_pic .hide_loadd').hide();
	$('#profile_pic .hide_this_always').hide();
	
});  
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
$('#profile_pic .hide_loadd').show()
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
				   $("#profile_pic .modal-footer .btn").trigger("click");
				//('#profile_pic .hide_this_always').show();
				 $('#loading').hide();
				  $('.upload-result').show();
				html = '<img class="class="profile-pic" src="' + resp + '" />';
				$("#profile_pic .img_box").html(html);
			}
		});
	});
});
    
</script>
