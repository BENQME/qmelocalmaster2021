<?php if(isset($_GET['region']) && $_GET['region']) $reg ='?region=1';else $reg=''; ?>
<div class="page-content">
   <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
      <div>
         <h4 class="mb-3 mb-md-0">Spotlight Pro <a href="#" data-toggle="modal" data-target="#spotlightpro">
           <i style="width:30px;" data-feather="help-circle"></i>
        <?php /*?> <img src="<?php echo base_url('assets/images/info.svg')?>" class="infoimg"><?php */?> </a></h4>
      </div>
      <?php /*?><div class="d-flex align-items-center flex-wrap text-nowrap mt-20">
         <p class="ts-10 mr-15">** Upgrade to Enjoy Pro features of Spotlight Tool</p>
         <div id="the-basics">
            <button type="submit" class="btn btn-primary mr-2 ">Get Started</button>
         </div>
      </div><?php */?>
   </div>
   <div class="custom-tabbox">
      <h4>Let's Start <?php /*?><span style="float:right">
         <button type="button" class="btn btn-primary watch-tutorial" data-toggle="modal" data-target="#exampleModal">
            <i data-feather="play-circle"></i> Watch Tutorial
     </button>
         </span><?php */?></h4><div class="clearfix"></div>
      <p class="text-muted">Start here to create your spotlight by selecting a spotlight option below to begin.
      </p>
      <!-- tab -->
      <div class="tabbable-panel">
         <div class="tabbable-line">
            <ul class="nav nav-tabs">
				<li >
				   <a class="contentBTn">
				   1. Content </a>
				</li>
                <li class="active">
				   <a  class="thumbnailBtn">
				   2. Add Cover </a>
				</li>
				<li class="">
				   <a class="mediaBTn">
				   3. Optional: Add images slideshow to your post </a>
				</li>

				
			 </ul>
            <div class="">
<style>
img[src=""] {
   display: none;
}
</style>    
<?php 
$spotid = $this->uri->segment(3);
if(empty($spotid)){
   $spotid='';
}
?>
               <form id="create_spotlight" method="post" action="<?php echo base_url('dashboard/create_new_spotlight_step3/'.$spotid.$reg); ?>">
               <section class="space-remove">
                  <div class="tabThumbnail" id="">
                     
                     <div class="row">
                        <div class="col-md-12">
                            <label><strong>Upload Your Spotlight Cover Image (Width: 800px and Height: 600px)</strong></label>
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
                        <div<?php //if(!$spotlight->cover_photo) echo ' id="crop_boxx"'?> id="crop_boxx"  class="col-md-6 text-center">
                    
                            <img class="img-thumbnail" id="upload-demo" src="
                     
                                    <?php if($spotlight->cover_photo):?>
                                      <?php echo base_url('uploads/cover_photo/'.$spotlight->cover_photo) ?>
                              
                                    <?php else: ?>
                            <?php echo base_url('assets/images/placeholder.jpg')?>
                            <?php endif;?>" />
                        </div>
                       
                        <div class="col-md-6" style="">
                            <div id="upload-demo-i" style="">
                           <?php if($spotlight->cover_photo):?>
                              <img class="img-thumbnail" src="<?php echo base_url('uploads/cover_photo/'.$spotlight->cover_photo) ?>" />
                           <?php endif ?>
                             </div>
                        </div>
                        
                        
                        
                            <div class="col-md-12">
                             <?php //if($spotlight->spotlight_type =='Media/Podcast'){ ?>
                              <div class="form-group" style="margin-top:5px">
                             	<label><strong>Optional: </strong> Embed Your Video or Podcast</label>
                             	<textarea name="em_video" class="form-control"><?php if($spotlight->em_video) echo $spotlight->em_video ?></textarea>
                             </div>
                             <?php //}else{ ?>
                            <?php /*?><div class="form-group" style="margin-top:5px">
                                <label><strong>Optional</strong>, set a video as cover. add link e.g https://www.youtube.com/watch?v=-EfWe7G15Ic</label>
                                <input type="url" pattern="http://www\.youtube\.com\/(.+)|https://www\.youtube\.com\/(.+)" name="em_video" value="<?php if($spotlight->em_video) $spotlight->em_video ?>" class="form-control">
                                <?php //} ?>
                            </div><?php */?>
                               
                            </div>
                        </div>
                         
                     </div>

                     <p class="text-right">
                     
                     
                     
                        <a href="<?php echo base_url('dashboard/create_new_spotlight/'.$spotid.$reg); ?>" class="btn btn-primary thumbnailBtn">Previous</a>
                        
                        <?php if($spotlight->spotlight_type =='Media/Podcast'){ ?>
                           <button type="submit" name="submit" value="1" class="upload-result33 btn btn-success btnSave_success">Publish</button>
                           <button type="submit" name="submit" value="2" class="upload-result33 btn btn-danger thumbnailBtn">Save draft</button>
							<?php }else{ ?>
                            <button type="submit" name="submit" value="1" class="upload-result33 btn btn-success btnSave_success">Publish</button>
                           <button type="submit" name="submit" value="2" class="upload-result33 btn btn-danger thumbnailBtn">Save draft</button>
                        <button type="submit" name="submit" value="3" class="upload-result222 btn btn-success btnSave_success">Next</button>
                        <?php } ?>
                        </p>
                  </div>
               </section>
               </form>
                     <!-- tab2-->
            </div>
                        
         </div>
      </div>   

   </div>
                     <!-- custom-tabbox -->
</div>
<div class="modal fade" id="spotlightpro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title text-center" id="exampleModalLabel">Spotlight Pro</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
			<p class="text-muted mt-10 text-center"> Spotlight Lets you create and manage your business content in minutes to share with your community and followers. Spotlight can power all of your business content. Create marketing advertising promotions,spotlight Specials and Coupons ads, News & Events, local commercial real estate listings, host Resumes, Jobs postings and Classifieds.</p>
			<br />
			<p class="text-center mt10">
				<button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-primary mr-2 ">Got it</button>
			</p>
		</div>
	  </div>
	</div>
 </div>
  <!--modal -->

   <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Watch Tutorial</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body" style="padding:0">
         <iframe style="margin:0" width="100%" height="315" src="https://www.youtube.com/embed/Vqk1TieHOck" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
       </div>
     </div>
   </div>
 </div>
<script>
$(document).ready(function(){

    $.validator.addMethod("youtube", function(value, element) {
     var p = /^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/;
     return (value.match(p)) ? RegExp.$1 : false;
    }, "Enter correct URL");

    var validator = $("#create_spotlight").validate({
        errorElement:'div',
        rules: {
            useravideo: {
                youtube: "#useravideo"
            }

        },
        messages: {
            useravideo: {
                required: "Enter user A video URL",
            }
        }
    });
});
</script>

 <script type="text/javascript">

$uploadCrop = $('#upload-demo').croppie({
    enableExif: false,
    viewport: {
        width: 400,
        height: 300,
    },
    boundary: {
        height: 400
    }
});
$( document ).ready(function() {
    $('#crop_boxx').hide();
	 $('.upload-result').hide();
});  
$('#upload').on('change', function () { 
 $('#crop_boxx').show();
  $('.upload-result').show();
 $('#create_spotlight .btnSave_success').addClass('upload-result2');
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
     
$('#create_spotlight .upload-result').on('click', function (ev) {
   ev.preventDefault();
   $uploadCrop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
   }).then(function (resp) {
     
      $.ajax({
         url: "<?php echo base_url() ?>dashboard/ajax_coverphoto_upload/<?php echo $this->uri->segment(3); ?>",
         type: "POST",
         data: {"image":resp},
          beforeSend: function(){
             $('#loading').html('Uploading....');
             $('.upload-result').hide();
			  $('.text-right button').removeClass('upload-result2');
            
         },
         success: function (data) {
             $('#loading').hide();
              $('.upload-result').show();
            html = '<img src="' + resp + '" />';
            $("#upload-demo-i").html(html);
			 $('.text-right button').removeClass('upload-result2');
         }
      });
   });
});
$('#create_spotlight  .upload-result222').on('click', function (ev) {
	if( document.getElementById("upload").files.length != 0 ){
   ev.preventDefault();
     var submit_val = $(this).val();
   $uploadCrop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
   }).then(function (resp) {
      $.ajax({
         url: "<?php echo base_url() ?>dashboard/ajax_coverphoto_upload/<?php echo $this->uri->segment(3); ?>",
         type: "POST",
         data: {"image":resp,"submit":submit_val},
          beforeSend: function(){
             $('#create_spotlight  .upload-result222').html('Uploading....');
             $('.upload-result').hide();
            
         },
         success: function (data) {
			 
			window.location.href = "<?php echo base_url('dashboard/create_new_spotlight_step3/'.$this->uri->segment(3)) ?>"
         }
      });
   });
	}
});
$('#create_spotlight  .upload-result33').on('click', function (ev) {
	if( document.getElementById("upload").files.length != 0 ){
   ev.preventDefault();
     var submit_val = $(this).val();
   $uploadCrop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
   }).then(function (resp) {
      $.ajax({
         url: "<?php echo base_url() ?>dashboard/ajax_coverphoto_upload/<?php echo $this->uri->segment(3); ?>",
         type: "POST",
         data: {"image":resp,"submit":submit_val},
          beforeSend: function(){
             $('#create_spotlight  .upload-result33').html('Uploading....');
             $('.upload-result').hide();
            
         },
         success: function (data) {
			 
			window.location.href = "<?php echo base_url('dashboard/myspotlight') ?>"
         }
      });
   });
	}
});
$('#create_spotlight  .upload-result2').on('click', function (ev) {
   ev.preventDefault();
     var submit_val = $(this).val();
   $uploadCrop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
   }).then(function (resp) {
      $.ajax({
         url: "<?php echo base_url() ?>dashboard/ajax_coverphoto_upload/<?php echo $this->uri->segment(3); ?>",
         type: "POST",
         data: {"image":resp,"submit":submit_val},
          beforeSend: function(){
             $('#create_spotlight  .upload-result2').html('Uploading....');
             $('.upload-result').hide();
            
         },
         success: function (data) {
			 
			window.location.href = "<?php echo base_url('dashboard/create_new_spotlight_step3/'.$this->uri->segment(3)) ?>"
         }
      });
   });
});
    
</script>