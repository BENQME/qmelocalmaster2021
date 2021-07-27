<div class="page-content">
		<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
          <div>
            <h4 class="mb-3 mb-md-0">New Support Service</h4>
          </div>
          <div class="d-flex align-items-center flex-wrap text-nowrap">

          </div>
        </div>
		<div class="row">
			<div class="col-md-12 stretch-card">
			  <div class="card">
				<div class="card-body">
                         <?php if($sucesess = $this->session->flashdata('sucesess')): ?>
                    <div class="alert alert-success" role="alert">
                     <?php echo $sucesess ?>
                    </div>
                <?php endif;
				$rs_id = $this->uri->segment(3);
				
				?>
					<form id="bussiness_register" enctype="multipart/form-data" method="post" action="<?php echo base_url('admin/add_resources/'.$rs_id) ?>">
					  <div class="row">
						<div class="col-sm-12">
						  <div class="form-group">
							<label class="control-label">Title </label>
							<input type="text" class="form-control" name="title" value="<?php if(isset($res->title)) echo $res->title ?>" required="required" placeholder="Enter First name">
						  </div>
						</div><!-- Col -->
						<div class="col-sm-12">
						  <div class="form-group">
							<label class="control-label">Description </label>
							<textarea name="description" required="required" class="form-control"><?php if(isset($res->description)) echo $res->description ?></textarea>
						  </div>
						</div><!-- Col -->
					  </div><!-- Row -->

					  <div class="row">
						<div class="col-sm-6">
						  <div class="form-group">
							<label class="control-label">Thumbnail  </label>
                            <?php if(isset($res->img)) {?> 
                              <a target="_blank" href="<?php echo base_url('uploads/res/'.$res->img) ?>"><?php echo $res->img ?></a>
                             <?php } ?>
							<input type="file" name="thumbnail"  class="form-control">
						  </div>
						</div><!-- Col -->
						<div class="col-sm-6">
						  <div class="form-group">
							<label class="control-label">URL  </label>
							<input type="url" class="form-control" name="url" required="required" value="<?php if(isset($res->link)) echo $res->link ?>"  placeholder="Enter URL ">
						  </div>
						</div><!-- Col -->
					  </div><!-- Row -->
					
					<button type="submit" name="submit" value="1" class="btn btn-primary submit">submit</button>
                    </form>
				</div>
			  </div>
			</div>
  
		</div> <!-- row -->	

		<br>
		<!-- <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
			<div>
			  <h4 class="mb-3 mb-md-0">The Portal seems very empty, would you like to share the global content/spotlights to the this portal?</h4>
			</div>
			<div class="d-flex align-items-center flex-wrap text-nowrap">
  
			</div>
		  </div> -->

		



		
	</div>
     <script>
jQuery( "#bussiness_register" ).validate();
</script>