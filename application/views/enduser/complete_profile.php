<div class="page-wrapper mob-mt30 main-pageprofile">

    <div class="page-content register-form login_step">

       <h4 class="text-center">Perfect! You've Successfully logged in</h4>

       <p class="text-center desktoponly">Please take a moment to upload your Profile Photo, add a Short Description of yourself,<br /> and set your Content Preferences.</p>

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

            <li class="">

               <a href="" class="mediaBTn">

               2. About </a>

            </li>

            <li>

               <a href="#"  class="thumbnailBtn desktoponly">

               3. Content Preferences </a>

               <a href="#"  class="thumbnailBtn onlymob">

                3. Preferences </a>

            </li>

           </ul>

           <div class="">

            <div class="tabContent" id="">

           <?php /*?> <form id="complete_profile" action="<?php echo base_url('login/complete_profile') ?>" enctype="multipart/form-data" method="post"><?php */?>

            

            
<style>
img[src=""] {
   display: none;
}
</style>
            <div class="card">
                    <div class="card-body">
                     <h5 class="text-center">Upload your profile photo

                        </h5>

                        <br />
                    <div class="row"> 
                        <div class="col-md-6 text-center">
                            <img id="upload-demo" src="
							
							               <?php if($profile_img):?>
							                 <?php echo base_url('uploads/profile_img/'.$profile_img) ?>
                            	<?php elseif($facebook_photo): ?>
                                <?php echo $facebook_photo ?>
								            <?php else: ?>
                            <?php echo base_url('assets/images/placeholder.jpg')?>
                            <?php endif;?>" />
                        </div>
                       
                        <div class="col-md-6" style="">
                            <div id="upload-demo-i" style=""><?php if($profile_img):?>
                            <img src="<?php echo base_url('uploads/profile_img/'.$profile_img) ?>" />
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
                          <div class="col-md-12">
                          <p>I will do this later, <strong><a href="<?php echo base_url('login/complete_profile2') ?>">SKIP</a></strong></p>
                          </div>
                          <p class="text-center mt10">
<div class="col-md-12">
<br />


                          <a href="<?php echo base_url('login/complete_profile2') ?>" type="submit" class="btn btn-primary contentBTn">Next</a>
                          </div>

                         </p>
                    </div>
                    
                    </div>
            
            

                              <?php /*?><div class="card-body">

                                      <h5 class="text-center">Upload your profile photo

                                </h5>

                                <br />
  <?php if($error = $this->session->flashdata('image_error')): ?>

                            <div class="alert alert-danger" role="alert" style="    display: block;

    margin: 0 auto;

    margin-bottom: 10px;">

                             <?php echo $error ?>

                            </div>

                        <?php endif ?>
                                 <div class="row">

                                

                                    <div class="col-md-8">

                                       <div class="form-group">

                                          <input type="file" name="profile_pic" accept="image/*" class="file-upload-default" id="cropperImageUpload">

                                          <div class="input-group col-xs-12">

                                             <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">

                                             <span class="input-group-append">

                                             <button class="file-upload-browse btn btn-primary" type="button">Upload</button>

                                             </span>

                                          </div>

                                          <p>Best cover image size 400 X 400</p>

                                       </div>

                                       <div>

                                          <img src="
                                          
                                          <?php if($profile_img) echo base_url('uploads/profile_img/'.$profile_img);else echo ' ../assets/images/placeholder.jpg'?>
                                          
                                         " class="w-100" id="croppingImage" alt="cropper">

                                       </div>

                                       <div class="d-flex justify-content-between align-items-center flex-wrap">

                                          <div class="form-group d-flex align-items-center flex-wrapp mb-0 mr-2 mt-3">

                                          

                                             <input style="display:none" type="number" value="400" class="form-control img-w mr-2 mb-2 mb-md-0 w-75" placeholder="Image width">

                                             <button class="btn btn-primary crop mb-2 mb-md-0">Crop</button>

                                          </div>

                                          

                                       </div>

                                    </div>

                                    <div class="col-md-4 ml-auto">

                                       <h6 class="card-description mb-2 mb-md-4">Cropped Image: </h6>
                                       <img class="w-100 cropped-img mt-2" 
                                       src="<?php if($profile_img) echo base_url('uploads/profile_img/'.$profile_img);else echo '#'?>" alt="">

                                    </div>
                                    
                                     <p class="col-md-12  mt10">
  <input type="hidden" name="profile_pic_edit" value="<?php echo $profile_img; ?>">
  

                          <button type="submit" class="pull-right btn btn-primary contentBTn">Next</button>

                         </p>

                                 </div>

                              </div><?php */?>

                           </div>

            

                  <?php /*?><div class="card">

                      <div class="card-body">

                        <h5 class="text-center">Upload your profile photo

                        </h5>

                        <br />

                        <div class="row">

                        <?php if($error = $this->session->flashdata('image_error')): ?>

                            <div class="alert alert-danger" role="alert" style="    display: block;

    margin: 0 auto;

    margin-bottom: 10px;">

                             <?php echo $error ?>

                            </div>

                        <?php endif ?>

                           <div class="offset-md-2 col-md-8">

                              <input type="file" id="myDropify" data-max-file-size="2M" name="profile_pic" accept="image/*" class="border"

                              <?php if($profile_img): ?>data-default-file="<?php echo base_url('uploads/profile_img/'.$profile_img) ?>"<?php endif ?>

                              

                              

                               />

                               <input type="hidden" name="profile_pic_edit" value="<?php echo $profile_img; ?>">

                               <?php  ?>

                              

                           </div>

                        </div>



                        <br />

                        <p class="text-center mt10">

  

                          <button type="submit" class="btn btn-primary contentBTn">Next</button>

                         </p>



                      </div>

                  </div><?php */?>

            </form>

            </div>

            </div>

            </div>

            </div>

      

      </div>



       </div> <!-- tab-id-->





    </div>

 </div>
<script type="text/javascript">
$uploadCrop = $('#upload-demo').croppie({
    enableExif: false,
    viewport: {
        width: 250,
        height: 250,
    },
    boundary: {
        height: 300
    }
});
     
$('#upload').on('change', function () { 
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
     
$('.upload-result').on('click', function (ev) {
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
				 $('#loading').hide();
				  $('.upload-result').show();
				html = '<img src="' + resp + '" />';
				$("#upload-demo-i").html(html);
			}
		});
	});
});
    
</script>