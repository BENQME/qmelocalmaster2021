<div class="page-wrapper">
    <div class="page-content register-form login_step">

        <h4 class="text-center">Onboard your business</h4>
        <!-- <p class="text-center">Having a business account on community portal has it's own perks. You can create spotlights, promotions.<br /> events or jobs for your business to engage with your audience.</p> -->	<br />
        <h5 class="text-center">Having your business profile in our community will give you some great perks. </h5>
        <p class="text-center mt10">You can create business spotlights, promotions, events, job listings, find commercial real estate, get reviews,<span class="block"></span> engage local audiences,  and even recommend other great businesses in your community. </p>
        <!-- <p class="mt-20 text-center"><a href="" class="not_now">No, Not Now</a></p> -->
        
        <div class="tabbable-panel business_information">
            <div class="tabbable-line">
               <ul class="nav nav-tabs">
                  <li class="active">
                     <a href="#" class="contentBTn">
                        Business Information </a>
                  </li>
                  <li class="">
                     <a href="" class="mediaBTn">
                        Additional Information </a>
                  </li>

                  <li>
                     <a href="#"  class="thumbnailBtn">
                        Add Your Certifications </a>
                  </li>
               </ul>
               </div>
        </div>
  <form id="bussiness_register" action="<?php echo base_url('login/onboard') ?>" method="post">
    <div class="row w-100 mx-0 auth-page">

  <div class="offset-2 col-md-8 mx-auto">


              
                    <div class="card">
                        
                        <div class="auth-form-wrapper px-4 py-4">
                        
                        <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="control-label">Enter your business email <span class="redstar">*</span></label>
                              <input type="email" required="required" class="form-control" name="business_email"
                               value="<?php if(isset($b_form->business_email)) echo $b_form->business_email ?>" placeholder="Email">
                             
                           </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb5">
                                <label class="control-label">Name of your business <span class="redstar">*</span></label>
                                <input type="text" required="required" name="business_name" value="<?php if(isset($b_form->business_name)) echo $b_form->business_name ?>" class="form-control" placeholder="Business Name">
                             </div>
                        </div>
                        </div> <!-- row -->
                        
                        <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="control-label">Tell us about your business <span class="redstar">*</span></label>
                              <textarea class="form-control" name="about_bussiness" rows="4" required="required"><?php if(isset($b_form->about_bussiness)) echo $b_form->about_bussiness ?></textarea>
                           </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Your Business Mission, and Vision? <span class="redstar">*</span></label>
                                <textarea class="form-control" rows="4" required="required" name="b_mission"><?php if(isset($b_form->b_mission)) echo $b_form->b_mission ?></textarea>
                             </div>
                        
                        </div>
                        </div> <!-- row -->
                        <?php if(!special_cms()): ?>
                        <div class="row">
                         <div class="col-md-6">
                           <div class="form-group">
                              <label class="control-label">Zip Code <span class="redstar">*</span></label>
                              <input type="text" class="form-control" required="required" name="zip_code" value="<?php if(isset($b_form->zip_code)) echo $b_form->zip_code ?>" placeholder="Zip Code">
                           </div>
                        </div>
                        </div>
                        <?php endif;?>
                        <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="control-label">What is your business address? <span class="redstar">*</span></label>
                              <input type="text" class="form-control" required="required" name="b_address" value="<?php if(isset($b_form->b_address)) echo $b_form->b_address ?>" placeholder="Business address">
                           </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Your business phone number? <span class="redstar">*</span></label>
                                <!-- <input type="text" class="form-control" placeholder="Business Name"> -->
                                <input type="tel" class="form-control mb-4 mb-md-0" required="required" name="phone" value="<?php if(isset($b_form->phone)) echo $b_form->phone ?>" data-inputmask-alias="(+99) 9999-9999"/>
                             </div>
                        
                        </div>
                        </div> <!-- row -->
                        
                        <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="control-label">What is your business website url address?</label>
                              <input type="url" class="form-control" name="website" value="<?php if(isset($b_form->website)) echo $b_form->website ?>"  placeholder="Business address">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="control-label">Your Title / Role <span class="redstar">*</span></label>
                              <input type="text" class="form-control" required="required" name="designation" value="<?php if(isset($b_form->designation)) echo $b_form->designation ?>"  placeholder="Designation">
                           </div>
                        </div>
                        </div> <!-- row -->
                        <?php if(!special_cms()): ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <label class="control-label">Contributors Resource Onboarding</label>
                                <p>
                                We champion a rail to help drive the power of our local collective working together, sharing, contributing, and doing our part to make our community better. (Select all of the identifiers that matches the resources you or your organization offers)
                                </p>
                                
                                <?php 
								if($resource_data =$this->db->order_by("b_id", "desc")->get_where('home_blocks',array('post_type'=>'resource'))->result()){
									foreach($resource_data as $resource){
										$services[] = $resource->title;
									}
								}
								
								
								/*$services = 
                                array('Only locally (e.g. within my city, town, or municipality)',
                                'Throughout my state (e.g. only in Illinois)',
                                'Throughout my region (e.g. only in the the Midwest of the United States)',
                                'Nationally (e.g. only in the United States)',
                                'Globally (e.g. other countries in addition to the United States)')*/
                                ?>
                                <?php $serverice_array = array();
                                if(isset($b_form->services)){
                                $serverice_array  = explode('|',$b_form->resources);
                                }
                                ?>
                                <?php $counter=1; foreach($services as $data): ?>
                                <div class="form-check form-check-inline2">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" 
                                        <?php if(is_array($serverice_array) &&in_array($data,$serverice_array)) echo 'checked="checked"' ?>  name="resources[]" value="<?php echo $data ?>">
                                        <?php echo $data ?>
                                    </label>
                                </div>
                                <?php endforeach;?>
                                
                                </div>
                            </div>
         				</div>
                         <?php endif;?>
                        <label class="control-label">Link your social media accounts</label>
                        
                        <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">
                                      <i class="feather icon-facebook"></i>
                                  </span>
                                </div>
                                <input type="text" class="form-control" name="facebook" placeholder="Username" value="<?php if(isset($b_form->facebook)) echo $b_form->facebook ?>" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                        
                        </div>
                        
                        <div class="col-md-6">
                        
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">
                                    <i class="feather icon-twitter"></i>
                                  </span>
                                </div>
                                <input type="text" class="form-control" name="twitter" value="<?php if(isset($b_form->twitter)) echo $b_form->twitter ?>" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                            
                         </div>
                        
                        </div> <!-- row -->
                        
                        <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">
                                    <i class="feather icon-instagram"></i>
                                  </span>
                                </div>
                                <input type="text" class="form-control" name="instagram" value="<?php if(isset($b_form->instagram)) echo $b_form->instagram ?>" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                        
                        </div>
                        
                        <div class="col-md-6">
                        
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">
                                    <i class="feather icon-linkedin"></i>
                                  </span>
                                </div>
                                <input type="text" class="form-control" name="linkedin" value="<?php if(isset($b_form->linkedin)) echo $b_form->linkedin ?>" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                            
                         </div>
                        
                        </div> <!-- row -->
                        
                        
                        
                        </div>
                    </div>
                
          
      </div>
    </div>
    <br />
            
    <p class="text-center">
        <button type="submit" name="submit" value="1" class="btn btn-primary" href="artboard-8.html" role="button">Save and go to Next</a>
    </p>
    </form>


    </div>
</div>
  <script>
	$("#bussiness_register").validate(
	{
        rules:{
            zip_code:{
                required: true,
                remote: "<?php echo base_url('login/check_zip') ?>"
            }
        },
        messages:{
            zip_code: {
                required: "Please enter a valid zip code",
                remote: "Your Business must have <?php echo site_info() ?> Address to Register on <?php echo site_info() ?> Local Business Portal ."
            }
        }
    }
	);
</script>