<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/editor.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/bootstrap-datetimepicker.min.css" />
<style>
#wysiwyg{height:0; margin:0; padding:0}
#create_spotlight .control-label{font-size:16px; color:#121212; font-weight:700}
.form-group {
    margin-bottom: 30px;
}
.hbcu_news{display:none}
.bootstrap-datetimepicker-widget.dropdown-menu {
    width: auto;
}
</style>
<div class="page-content">
	<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
	   <div>
		  <h4 class="mb-3 mb-md-0">Spotlight Pro <a href="#" data-toggle="modal" data-target="#spotlightpro">
          <i style="width:30px;" data-feather="help-circle"></i>
          </a></h4>
		  
	   </div>
	   <?php /*?><div class="d-flex align-items-center flex-wrap text-nowrap mt-20">
		  <div id="the-basics">
			 <button type="submit" class="btn btn-primary mr-2 ">Get Started</button>
		  </div>
	   </div><?php */?>
	</div>
	<div class="custom-tabbox">
	   <h4>Let's Start 
		 <?php /*?> <span style="float:right">
		  <button type="button" class="btn btn-primary watch-tutorial" data-toggle="modal" data-target="#exampleModal">
			 <i data-feather="play-circle"></i> Watch Tutorial
	  </button>
		  </span><?php */?>
		  </h4><div class="clearfix"></div>
	   <p class="text-muted">Start here to create your spotlight by selecting a spotlight option below to begin.
	   </p>
	   <!-- tab -->
	   <div class="tabbable-panel">
		  <div class="tabbable-line">
			 <ul class="nav nav-tabs">
				<li class="active">
				   <a class="contentBTn">
				   1. Content </a>
				</li>
                <li>
				   <a  class="thumbnailBtn">
				   2. Add Cover </a>
				</li>
				<li class="">
				   <a class="mediaBTn">
				   3. Optional: Add images slideshow to your post </a>
				</li>

				
			 </ul>
			 <div class="">
			 	<?php $spotid = $this->uri->segment(3);
			 	if(empty($spotid)){
			 		$spotid='';
			 	}
			 	?>
				<div class="tabContent" id="">
                 <?php 
				 $info_aray=array();
				  if(isset($region_info)){
					  foreach($region_info as $info){
						  $info_aray[] =$info->web_id; 
					  }
				  }
				 
				 if(isset($_GET['region']) && $_GET['region']) $reg ='?region=1';else $reg=''; ?>
				<form id="create_spotlight" method="post" action="<?php echo base_url('dashboard/create_new_spotlight/'.$spotid).$reg; ?>">
				   <section>
                   <?php if(isset($_GET['region']) && $_GET['region']): ?>
                   <?php $sodaa = $this->db->where('slug !=','superadmin')->get('admin_urls')->result(); 
				   //print_r($sodaa);
				   if($sodaa):
				   ?>
                  	 <div class="row">
						 <div class="col-md-12">
							<div class="form-group">
							   <label class="control-label" for="category">Region</label>
							   <select class="form-control js-example-basic-multiple" id="region_mutiple" name="region[]" multiple="multiple"  required="required">
								 <?php foreach($sodaa as $soda){ ?>
                                  <option<?php if(in_array($soda->id,$info_aray)) echo ' selected="selected"'; ?>  value="<?php echo $soda->id ?>"><?php echo $soda->site_name ?></option>
                                  <?php } ?>
							   </select>
							</div>
						 </div>
						 
					  </div>
                      <?php endif;?>
                      <?php endif;?>
					  
					  <div class="form-group">
                      <p class="control-label">Choose what you want to create <a href="#" data-toggle="modal" data-target="#spotlightpro">
          <i style="width:30px;" data-feather="help-circle"></i></a></p>
						 <div class="form-check form-check-inline">
							<label class="form-check-label">
							<input type="radio" <?php if($spotlight->spotlight_type=='News / Blog'){ echo 'checked';} ?> required="required" <?php if(empty($spotlight->spotlight_type)){ echo 'checked';} ?> class="form-check-input news-blogbtn" name="spotlight_type" id="optionsRadios5" value="News / Blog">
							News / Blog
							</label>
						 </div>
                         <?php  //print_r($this->session->user_level());
						 $user_level = $this->session->userdata('user_level');
						 ?>
                         <?php  if(special_cms() && $user_level ==1): ?>
                         <div class="form-check form-check-inline">
							<label class="form-check-label">
							<input type="radio" <?php if($spotlight->spotlight_type=='HBCU/PBI'){ echo 'checked';} ?> required="required" 
							<?php if(!empty($spotlight->spotlight_type)&& $spotlight->spotlight_type =='HBCU News'){ echo 'checked';} ?> class="form-check-input news-blogbtn" name="spotlight_type" id="hbcu_check" value="HBCU News">
							HBCU News
							</label>
						 </div>
                         <?php endif;?>
                         <div class="form-check form-check-inline">
							<label class="form-check-label">
							<input type="radio" <?php if($spotlight->spotlight_type=='Media/Podcast'){ echo 'checked';} ?> required="required" class="form-check-input news-blogbtn" name="spotlight_type" id="optionsRadios655" value="Media/Podcast">
							Media/Podcast
							</label>
						 </div>
                         
						 <div class="form-check form-check-inline">
							<label class="form-check-label">
							<input type="radio" <?php if($spotlight->spotlight_type=='Spotit Spotlight'){ echo 'checked';} ?> required="required" class="form-check-input classified-section-btn" name="spotlight_type" id="optionsRadios6" value="Spotit Spotlight">
							Spotlight Post
							</label>
						 </div>
						 <div class="form-check form-check-inline">
							<label class="form-check-label">
							<input type="radio" <?php if($spotlight->spotlight_type=='Job Posting'){ echo 'checked';} ?> required="required" class="form-check-input job-postingbtn" name="spotlight_type" id="optionsRadios7" value="Job Posting">
							Job Posting
							</label>
						 </div>
						 <div class="form-check form-check-inline">
							<label class="form-check-label">
							<input type="radio" <?php if($spotlight->spotlight_type=='Events'){ echo 'checked';} ?>  required="required" class="form-check-input eventsbtn" name="spotlight_type" id="optionsRadios8" value="Events">
							Events
							</label>
						 </div>
					  </div>
					  <!-- radio-btn -->
                       	
					  <div class="newsBlog-section">

					  <div class="row">
						 <div class="col-md-12">
							<div class="form-group">
							   <label class="control-label">Title</label>
							   <textarea  name="postTitle" class="form-control" placeholder="Enter Title" required="required"><?php echo $spotlight->postTitle; ?></textarea>
							</div>
						 </div>
                      </div>
                      <div class="row">
						 <?php
						 //echo $user_level
						  $user_level = $this->session->userdata('user_level');
						  //if(isset($user_level) && ($user_level ==1 || $user_level ==3)){
							$q  =$this->db->query("SELECT categoryTitle FROM spotlights_category ORDER BY categoryTitle ASC");
//print_r($preferences_arr);
if($cats = $q->result())
						  {
							  foreach($cats as $soda){
								  $preferences_arr[] =$soda->categoryTitle;
							  }
						  }
						  //print_r($preferences_arr);
						 /* }else{
						  $preferences_arr = json_decode($userprofileinfo->preferences);
						  
						  }*/
						  
						  //print_r($preferences_arr);
						  ?>
						 <div class="col-md-6">
							<div class="form-group">
							   <label class="control-label" for="category">Choose Your Spotlight Post Category</label>
							   <select class="form-control" id="category" name="category" required="required">
								  <option value="">Select Category</option>
								  <?php foreach ($preferences_arr as $preference) {
								  	
								   ?>
								  <option value="<?php echo $preference; ?>" <?php if($spotlight->category==$preference){ echo 'selected';} ?> ><?php echo $preference; ?></option>
								  <?php } ?>
							   </select>
							</div>
						 </div>
                         <?php  if(special_cms()): ?>
                          <?php $categories2 =  $this->db->get_where('hbcu',array('site_id'=>site_id()))->result() ?>
                            <?php if($categories2): //print_r($users)?>
                             <div class="col-md-6 hbcu_news" id="hbcu_cat" <?php if($spotlight->spotlight_type=='HBCU News'){ echo ' style="display:block"';} ?>>
                                <div class="form-group">
                                   <label class="control-label" for="category">Choose Your HBCU News Category</label>
                                   <select class="form-control" id="category" name="hbcu_cat" required="required">
                                      <option value="">Select HBCU News Category</option>
                                      <?php foreach ($categories2 as $cat) {
                                        
                                       ?>
                                      <option value="<?php echo $cat->categoryID; ?>" <?php if($spotlight->hbcu_cat == $cat->categoryID){ echo 'selected';} ?> ><?php echo $cat->categoryTitle; ?></option>
                                      <?php } ?>
                                   </select>
                                </div>
                             </div>
                             <?php endif;?>
                         <?php endif;?>
                         
					  </div>
					  <!-- row -->
				   </div> <!-- newsBlog-section -->

					  <!-- classified-section-->
					  <div class="classified-section"  <?php if($spotlight->spotlight_type=='Spotit Spotlight'){ echo ' style="display:block"';} ?> >
						 <?php /*?><div class="row">
							<div class="col-md-6">
							   <div class="form-group">
								  <label class="control-label">Contact Email</label>
								  <input type="email" class="form-control mb-4 mb-md-0" name="contact_email" value="<?php echo $spotlight->contact_email; ?>" data-inputmask="'alias': 'email'"/>
							   </div>
							</div>
							<div class="col-md-6">
							   <div class="form-group">
								  <label for="exampleFormControlSelect1">Contact Phone</label>
								  <input type="tel" class="form-control mb-4 mb-md-0" name="contact_phone" value="<?php echo $spotlight->contact_phone; ?>" data-inputmask-alias="(+99) 9999-9999"/>
							   </div>
							</div>
						 </div><?php */?>
						 <!-- row --> 
						 <div class="row">
							<div class="col-md-6">
						 <div class="form-group">
							 <p class="control-label">Add a Coupon or Discount to this Spotlight</p>
							<div class="form-check form-check-inline">
								<label class="form-check-label">
									<input type="radio" required="required" class="form-check-input coupon_yesBtn" name="coupon_status" id="optionsRadios" <?php if($spotlight->coupon_status=='yes'){ echo 'checked';} ?> value="yes">
									Yes
								</label>
							</div>
							<div class="form-check form-check-inline">
								<label class="form-check-label">
									<input type="radio" required="required" class="form-check-input coupon_noBtn" name="coupon_status" id="optionsRadios1" <?php if($spotlight->coupon_status=='no'){ echo 'checked';} ?> <?php if(empty($spotlight->coupon_status)){ echo 'checked';} ?> value="no">
									No
								</label>
							</div>
						</div>	 
						</div>
						<div class="col-md-6">
							<div class="form-group add_coupon">
								<label class="control-label">Add your discount(%)</label>
								<input type="text" class="form-control" name="coupon" placeholder="Add your discount(%)" value="<?php echo $spotlight->coupon; ?>" >
							 </div>
						</div>
						

					  </div>
					  </div>
					  <!-- classified-section-->
					  <!-- jobposting-section-->
					  <div class="jobposting-section" <?php if($spotlight->spotlight_type=='Job Posting'){ echo ' style="display:block"';} ?>>
						 <div class="row">
							<div class="col-md-6">
							   <div class="form-group">
								  <label class="control-label">Salary Range</label>
								  <input type="text" required="required" class="form-control" name="salary_range" placeholder="Enter Title" value="<?php echo $spotlight->salary_range; ?>">
							   </div>
							</div>
							<div class="col-md-6">
							   <div class="form-group">
								  <label class="control-label" for="">Job Position</label>
								  <input type="text" required="required" class="form-control" name="job_position" placeholder="Enter Title" value="<?php echo $spotlight->job_position; ?>">
							   </div>
							</div>
						 </div>
						 <!-- row --> 
					  </div>
					  <!-- jobposting-section-->
					  <!-- events-section-->
					  <div class="events-section" <?php if($spotlight->spotlight_type=='Events'){ echo ' style="display:block"';} ?>>
						 <div class="row">
							<div class="col-md-6">
							   <div class="form-group">
								  <label class="control-label">Event Start Date</label>
								  <input type="text" required="required" class="form_date form-control mb-4 mb-md-0" name="event_start_date"  value="<?php echo $spotlight->event_start_date; ?>"/>
							   </div>
							</div>
                            <div class="col-md-6">
							   <div class="form-group">
								  <label class="control-label">Event Start Time</label>
								  <input type="text" class="form_time form-control mb-4 mb-md-0" name="event_start_time"  value="<?php echo $spotlight->event_start_time; ?>"/>
							   </div>
							</div>
							<div class="col-md-6">
							   <div class="form-group">
								  <label class="control-label" for="">Event End Date</label>
								  <input type="text" required="required" class="form_date form-control" name="event_end_date" value="<?php echo $spotlight->event_end_date; ?>" />
							   </div>
							</div>
                            <div class="col-md-6">
							   <div class="form-group">
								  <label class="control-label">Event Start Time</label>
								  <input type="text" class="form_time form-control mb-4 mb-md-0" name="event_end_time"  value="<?php echo $spotlight->event_end_time; ?>"/>
							   </div>
							</div>
						 </div>
						 <!-- row --> 
                         <div class="row">
                         <div class="col-md-4">
                             <div class="form-group">
                                <label class="control-label" for="">Time Zone</label>
                                <?php $timezone_identifiers = DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, 'US');
?>
                                <?php $us_timezone = array (
									"GMT -12:00) Eniwetok, Kwajalein",
"(GMT -11:00) Midway Island, Samoa",
"(GMT -10:00) Hawaii",
"(GMT -9:30) Taiohae",
"(GMT -9:00) Alaska",
"(GMT -8:00) Pacific Time (US &amp; Canada)",
"GMT -7:00) Mountain Time (US &amp; Canada)",
"(GMT -6:00) Central Time (US &amp; Canada), Mexico City",
"(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima",
"(GMT -4:30) Caracas",
"(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz",
"(GMT -3:30) Newfoundland",
"(GMT -3:00) Brazil, Buenos Aires, Georgetown",
"(GMT -2:00) Mid-Atlantic",
"(GMT -1:00) Azores, Cape Verde Islands",
"(GMT) Western Europe Time, London, Lisbon, Casablanca",
"(GMT +1:00) Brussels, Copenhagen, Madrid, Paris",
"(GMT +2:00) Kaliningrad, South Africa",
"(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg",
"(GMT +3:30) Tehran",
"(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi",
"(GMT +4:30) Kabul",
"GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent",
"GMT +5:30) Bombay, Calcutta, Madras, New Delhi",
"(GMT +5:45) Kathmandu, Pokhara",
"(GMT +6:00) Almaty, Dhaka, Colombo",
"(GMT +6:30) Yangon, Mandalay",
"(GMT +7:00) Bangkok, Hanoi, Jakarta",
"(GMT +8:00) Beijing, Perth, Singapore, Hong Kong",
"(GMT +8:45) Eucla",
"(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk",
"(GMT +9:30) Adelaide, Darwin",
"(GMT +10:00) Eastern Australia, Guam, Vladivostok",
"(GMT +10:30) Lord Howe Island",
"(GMT +11:00) Magadan, Solomon Islands, New Caledonia",
"(GMT +11:30) Norfolk Island",
"(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka",
"(GMT +12:45) Chatham Islands",
"(GMT +13:00) Apia, Nukualofa",
"GMT +14:00) Line Islands, Tokelau",


								) ?>
                                <select name="timezone_offset" id="timezone-offset" class="form-control" required>
                                <option value="">Select Time Zone</option>
                                <?php foreach($us_timezone as $key=>$zone){ ?>
                                    <option <?php if($spotlight->timezone_offset == $zone) echo ' selected="selected"' ?> value="<?php echo $zone ?>">
									<?php echo $zone ?></option>
                                    <?php } ?>
                                </select>
                             </div>
                             </div>
							<div class="col-md-4">
                             <div class="form-group">
                                <label class="control-label" for="">Event Location</label>
                                <input class="form-control" type="text" name="event_location" placeholder="Enter Location" value="<?php echo $spotlight->event_location; ?>" />
                             </div>
                             </div>
                             <div class="col-md-4">
                              <div class="form-group">
                                <label class="control-label" for="">Event Registration Link</label>
                                <input class="form-control" type="url" name="event_register" placeholder="Enter Event Registration Link" value="<?php echo $spotlight->event_register; ?>" />
                             </div>
                            </div>
                        
					  </div>
					  <!-- events-section-->
                      </div>
					  <div class="form-group">
						 <label class="control-label">Add a Description</label>    
						 <textarea name="wysiwyg" id="txtEditor" class="form-control textarea wysiwyg" rows="10" ><?php echo $spotlight->postContent; ?></textarea>
                         <?php echo form_error('wysiwyg', '<label class="error">', '</label>'); ?>
					  </div>
                        <div class="form-group">
                            <label class="control-label">Add Tags (Enter or select tag and press enter)</label>
                            <!-- <input id="name" class="form-control" name="" type="text"> -->
                            <div>
                                <input name="tags" id="tags" value="<?php echo $spotlight->tags; ?>" autocomplete="off" />
                            </div>
                         </div>

					  <p class="text-right">
                      <?php if($spotid = $this->uri->segment(3)): ?>
                            <button type="submit" name="submit" value="publish" class="btn btn-success">Publish</button>
                            <button type="submit" name="submit" value="draft" class="btn btn-danger">Save As Draft</button>
                        <?php endif;?>
					  	<button type="submit" name="submit" value="1" class="btn btn-primary contentBTn">Next</button>
						 <!-- <a href="create_a_spotlight-two.html" class="btn btn-primary contentBTn">Next</a> -->
					  </p>

				   </section>
				</form>
				</div>
				<!-- tab1 -->
				   </div>
				   
				   </div>
				   </div>   
				   
				   
				   
				   </div>
				   <!-- custom-tabbox -->
			 </div>
			 <!-- page-content -->
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
	$("#create_spotlight").validate(
	);
	
	
</script>
<script>
    $(document).ready(function(){

$(".form-check .form-check-input").click(function() {
	//alert('ddddddddddddd');
if($('#hbcu_check').is(":checked")) {
		$("#hbcu_cat").show();
	} else {
		$("#hbcu_cat").hide();
	}
});

    });
</script>