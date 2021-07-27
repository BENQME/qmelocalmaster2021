<div class="page-content">
	<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
	   <div>
		  <h4 class="mb-3 mb-md-0">Spotlight Pro <a href="#" data-toggle="modal" data-target="#spotlightpro"><img src="<?php echo base_url('assets/images/info.svg')?>" class="infoimg"> </a></h4>
		  
	   </div>
	   <div class="d-flex align-items-center flex-wrap text-nowrap mt-20">
		  <p class="ts-10 mr-15">** Upgrade to Enjoy Pro features of Spotlight Tool</p>
		  <div id="the-basics">
			 <button type="submit" class="btn btn-primary mr-2 ">Get Started</button>
		  </div>
	   </div>
	</div>
	<div class="custom-tabbox">
	   <h4>Let's Start 
		  <span style="float:right">
		  <button type="button" class="btn btn-primary watch-tutorial" data-toggle="modal" data-target="#exampleModal">
			 <i data-feather="play-circle"></i> Watch Tutorial
	  </button>
		  </span>
		  </h4><div class="clearfix"></div>
	   <p class="text-muted">Start here to create your spotlight by selecting a spotlight option below to begin.
	   </p>
	   <!-- tab -->
	   <div class="tabbable-panel">
		  <div class="tabbable-line">
			 <ul class="nav nav-tabs">
				<li class="active">
				   <a href="#" class="contentBTn">
				   1. Content </a>
				</li>
				<li class="">
				   <a href="" class="mediaBTn">
				   2. Featured Images </a>
				</li>

				<li>
				   <a href="#"  class="thumbnailBtn">
				   3. Add Cover & Publish </a>
				</li>
			 </ul>
			 <div class="">
			 	<?php $spotid = $this->uri->segment(3);
			 	if(empty($spotid)){
			 		$spotid='';
			 	}
			 	?>
				<div class="tabContent" id="">
				<form id="create_spotlight" method="post" action="<?php echo  base_url().'admin/create_new_spotlight/'.$spotid; ?>">
				   <section>
					  <p>Choose what you want to create</p>
					  <div class="form-group">
						 <div class="form-check form-check-inline">
							<label class="form-check-label">
							<input type="radio" <?php if($spotlight->spotlight_type=='News / Blog'){ echo 'checked';} ?> required="required" <?php if(empty($spotlight->spotlight_type)){ echo 'checked';} ?> class="form-check-input news-blogbtn" name="spotlight_type" id="optionsRadios5" value="News / Blog">
							News / Blog
							</label>
						 </div>
						 <div class="form-check form-check-inline">
							<label class="form-check-label">
							<input type="radio" <?php if($spotlight->spotlight_type=='Spotit Spotlight'){ echo 'checked';} ?> required="required" class="form-check-input classified-section-btn" name="spotlight_type" id="optionsRadios6" value="Spotit Spotlight">
							General Spotlight  Post
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
						 <div class="col-md-6">
							<div class="form-group">
							   <label class="control-label">Title</label>
							   <input type="text" name="postTitle" class="form-control" placeholder="Enter Title" value="<?php echo $spotlight->postTitle; ?>" required="required">
							</div>
						 </div>
						 <?php 
						 
						 if($preferences_arr = $categories): ?>
						 <div class="col-md-6">
							<div class="form-group">
							   <label for="category">Choose Your Spotlight Post Category</label>
							   <select class="form-control" id="category" name="category" required="required">
								  <option value="">Select Category</option>
								  <?php foreach ($preferences_arr as $preference) {
								  	
								   ?>
								  <option value="<?php echo $preference->categoryTitle ?>" <?php if($spotlight->category == $preference->categoryTitle){ echo 'selected';} ?> ><?php echo $preference->categoryTitle; ?></option>
								  <?php } ?>
							   </select>
							</div>
						 </div>
                         <?php endif;?>
					  </div>
					  <!-- row -->
				   </div> <!-- newsBlog-section -->

					  <!-- classified-section-->
					  <div class="classified-section">
						 <div class="row">
							<div class="col-md-6">
							   <div class="form-group">
								  <label class="control-label">Contact Email</label>
								  <input type="email"  required="required" class="form-control mb-4 mb-md-0" name="contact_email" value="<?php echo $spotlight->contact_email; ?>" data-inputmask="'alias': 'email'"/>
							   </div>
							</div>
							<div class="col-md-6">
							   <div class="form-group">
								  <label for="exampleFormControlSelect1">Contact Phone</label>
								  <input type="tel" required="required" class="form-control mb-4 mb-md-0" name="contact_phone" value="<?php echo $spotlight->contact_phone; ?>" data-inputmask-alias="(+99) 9999-9999"/>
							   </div>
							</div>
						 </div>
						 <!-- row --> 
						 <div class="row">
							<div class="col-md-6">
						 <div class="form-group">
							 <p>Add a Coupon or Discount to this Spotlight</p>
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
					  <div class="jobposting-section">
						 <div class="row">
							<div class="col-md-6">
							   <div class="form-group">
								  <label class="control-label">Salary Range</label>
								  <input type="text" required="required" class="form-control" name="salary_range" placeholder="Enter Title" value="<?php echo $spotlight->salary_range; ?>">
							   </div>
							</div>
							<div class="col-md-6">
							   <div class="form-group">
								  <label for="">Job Position</label>
								  <input type="text" required="required" class="form-control" name="job_position" placeholder="Enter Title" value="<?php echo $spotlight->job_position; ?>">
							   </div>
							</div>
						 </div>
						 <!-- row --> 
					  </div>
					  <!-- jobposting-section-->
					  <!-- events-section-->
					  <div class="events-section">
						 <div class="row">
							<div class="col-md-6">
							   <div class="form-group">
								  <label class="control-label">Event Date</label>
								  <input type="date" required="required" class="form-control mb-4 mb-md-0" name="event_date" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd/mm/yyyy" value="<?php echo $spotlight->event_date; ?>"/>
							   </div>
							</div>
							<div class="col-md-6">
							   <div class="form-group">
								  <label for="">Event Time</label>
								  <input type="text" required="required" class="form-control" name="event_time" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="HH:MM:ss" value="<?php echo $spotlight->event_time; ?>" />
							   </div>
							</div>
						 </div>
						 <!-- row --> 

						 <div class="form-group">
							<label for="">Event Location</label>
							<input class="form-control" required="required" type="text" name="event_location" placeholder="Enter Location" value="<?php echo $spotlight->event_location; ?>" />
						 </div>

					  </div>
					  <!-- events-section-->
					  <div class="form-group">
						 <label>Add a Description</label>    
						 <textarea name="wysiwyg" id="wysiwyg" class="form-control textarea wysiwyg" rows="10" ><?php echo $spotlight->postContent; ?></textarea>
                         <?php echo form_error('wysiwyg', '<label class="error">', '</label>'); ?>
					  </div>


					  <p class="text-right">
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
       <div class="modal-body">
         <iframe width="100%" height="315" src="https://www.youtube.com/embed/1QUfq-tFGlg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
       </div>
     </div>
   </div>
 </div>
<script>
	$("#create_spotlight").validate(
	);
</script>
