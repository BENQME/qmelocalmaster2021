<?php //echo print_r($site_info);
$site_url = $site_info['site_url'];
if(isset($site_info['site_info']->site_name))$site_name = $site_info['site_info']->site_name;else $site_name =""
?>
<div class="page-content">
   <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
      <div>
         <h4 class="mb-3 mb-md-0">Spotlight Pro <a href="#" data-toggle="modal" data-target="#spotlightpro">
         <img src="<?php echo base_url('assets/images/info.svg')?>" class="infoimg"> </a></h4>
      </div>
      <div class="d-flex align-items-center flex-wrap text-nowrap mt-20">
         <p class="ts-10 mr-15">** Upgrade to Enjoy Pro features of Spotlight Tool</p>
         <div id="the-basics">
            <button type="submit" class="btn btn-primary mr-2 ">Get Started</button>
         </div>
      </div>
   </div>
   <div class="custom-tabbox">
      <h4>Let's Start <span style="float:right">
         <button type="button" class="btn btn-primary watch-tutorial" data-toggle="modal" data-target="#exampleModal">
            <i data-feather="play-circle"></i> Watch Tutorial
     </button>
         </span></h4><div class="clearfix"></div>
      <p class="text-muted">Start here to create your spotlight by selecting a spotlight option below to begin.
      </p>
      <!-- tab -->
      <div class="tabbable-panel">
         <div class="tabbable-line">
            <ul class="nav nav-tabs">
               <li class="active">
                  <a href="create_new_spotlight.html" class="contentBTn">
                  1. Content </a>
               </li>

               <li class="active">
                  <a href="create_a_spotlight-two.html" class="mediaBTn">
                  2.  Featured Images </a>
               </li>


               <li class="active">
                  <a href="#"  class="thumbnailBtn">
                  3. Add Cover & Publish </a>
               </li>
            </ul>
            <div class="">
<style>
img[src=""] {
   display: none;
}
</style>    
<?php 
$spotid = $this->uri->segment(sigment_fixer(4,$this->uri->segment(1)));
if(empty($spotid)){
   $spotid='';
} ?>
               <form id="create_spotlight" method="post" action="<?php echo $site_url.'/admin/create_new_spotlight_step2/'.$spotid; ?>">
               <section class="space-remove">
                  <div class="tabThumbnail" id="">
                     
                     <div class="row">
                        <div class="col-md-6 text-center">
                            <img id="upload-demo" src="
                     
                                    <?php if($spotlight->cover_photo):?>
                                      <?php echo base_url('uploads/cover_photo/'.$spotlight->cover_photo) ?>
                              
                                    <?php else: ?>
                            <?php echo base_url('assets/images/placeholder.jpg')?>
                            <?php endif;?>" />
                        </div>
                       
                        <div class="col-md-6" style="">
                            <div id="upload-demo-i" style="">
                           <?php if($spotlight->cover_photo):?>
                              <img src="<?php echo base_url('uploads/cover_photo/'.$spotlight->cover_photo) ?>" />
                           <?php endif ?>
                             </div>
                        </div>
                        
                         <div class="col-md-12">
                            <strong>Upload Your Spotlight Cover Image:</strong>
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

                     <p class="text-right">
                        <a href="<?php echo $site_url.'/admin/create_new_spotlight_step2/'.$spotid ?>" class="btn btn-primary thumbnailBtn">Previous</a>
                        <button type="submit" name="submit" value="2" class="btn btn-success thumbnailBtn">Save draft</button>
                        <button type="submit" name="submit" value="1" class="btn btn-success btnSave_success">Save and Publish</button>
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
 <script type="text/javascript">
$uploadCrop = $('#upload-demo').croppie({
    enableExif: false,
    viewport: {
        width: 500,
        height: 300,
    },
    boundary: {
        height: 400
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
         url: "<?php echo base_url() ?>dashboard/ajax_coverphoto_upload/<?php echo $spotid ?>",
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