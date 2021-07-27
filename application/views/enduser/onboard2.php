<div class="page-wrapper">
<div class="page-content register-form login_step">

    <h4 class="text-center">Onboard your business</h4>
    <p class="text-center">Having a business account on community portal has it's own perks. You can create spotlights, promotions.<br /> events or jobs for your business to engage with your audience.</p>

    <!-- <p class="mt-20 text-center"><a href="" class="not_now">No, Not Now</a></p> -->
    
    <div class="tabbable-panel business_information">
        <div class="tabbable-line">
           <ul class="nav nav-tabs">
              <li class="active">
                 <a href="artboard-7.html" class="contentBTn">
                    Business Information </a>
              </li>
              <li class="active">
                 <a href="" class="mediaBTn">
                    Additional Information </a>
              </li>

              <li>
                 <a href="#"  class="thumbnailBtn">
                    Add Your Certifications  </a>
              </li>
           </ul>
           </div>
    </div>
<form id="bussiness_register" action="<?php echo base_url('login/onboard2') ?>" method="post">
<div class="row w-100 mx-0 auth-page">

<div class="offset-2 col-md-8 mx-auto art-board8">



            <div class="card">
        <?php
$industry = array('Aerospace',
'Agriculture',
'Business Education',
'Community',
'Computers',
'Construction',
'Education',
'Energy',
'Entertainment',
'Finance',
'Government',
'Healthcare',
'Home and Garden',
'Hospitality',
'Inspirational Messages',
'Law',
'Manufacturing',
'Marketing',
'Mining',
'Music / Film Production',
'My Life / My Journal',
'News',
'Professional Business Services ',
'Publishing',
'Religion',
'Services Industry',
'Software Industry',
'Technology',
'Telecommunications',
'Transportation');
        ?>        
      <div class="auth-form-wrapper px-4 py-4">
        <div class="form-group">
            <label class="industry"><strong>What is your business industry <span class="redstar">*</span></strong></label>
            
            <select name="industry" class="form-control" id="industry" required>
                <option selected value="">Select</option>
					<?php foreach($industry as $data): ?>
                        <option <?php if(isset($b_form->industry) && $b_form->industry ==$data) echo 'selected="selected"' ?>  value="<?php echo $data ?>"><?php echo $data ?></option>
                    <?php endforeach;?>

            </select>
            
         </div>

        <div class="form-group">
            <label class="control-label">Please use single words or short phrases to list your business services (separate each service with a comma). <span class="redstar">*</span></label>
            <div>
                <input name="b_services" id="tags" value="<?php if(isset($b_form->b_services)) echo $b_form->b_services ?>" required />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">Where do you sell your products/services? <span class="redstar">*</span></label>
            
			<?php $services = 
                array('Only locally (e.g. within my city, town, or municipality)',
                'Throughout my state (e.g. only in Illinois)',
                'Throughout my region (e.g. only in the the Midwest of the United States)',
                'Nationally (e.g. only in the United States)',
                'Globally (e.g. other countries in addition to the United States)')
            ?>
	       <?php $serverice_array = array();
		    if(isset($b_form->services)){
				 $serverice_array  = json_decode($b_form->services);
			}
			?>
           <?php $counter=1; foreach($services as $data): ?>
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" 
					<?php if(is_array($serverice_array) &&in_array($data,$serverice_array)) echo 'checked="checked"' ?>  name="services[]" value="<?php echo $data ?>">
                  <?php echo $data ?>
                </label>
            </div>
            <?php endforeach;?>
            
         </div>

         <div class="form-group">
            <label class="control-label">Do you want to expand the area of where you sell your good or services? <span class="redstar">*</span></label>
            <!-- <select class="form-control" id="exampleFormControlSelect1">
                <option selected >Select</option>
                <option value="No, I want to stay within the area where I currently sell my goods and services for now">No, I want to stay within the area where I currently sell my goods and services for now</option>
                <option value="Yes, I want to sell to other states and regions in my country">Yes, I want to sell to other states and regions in my country</option>
                <option value="Yes, I want to sell in other stand regions in my country and internationally">Yes, I want to sell in other stand regions in my country and internationally</option>
                <option value="Other">Other</option>
            </select> -->
            
            
            <?php $expand_area = 
                array('No, I want to stay within the area where I currently sell my goods and services for now)',
                'Yes, I want to sell to other states and regions in my country',
                'Yes, I want to sell in other states and regions in my country as well as internationally')
            ?>
	       <?php $expand_area_array = array();
		    if(isset($b_form->expand_area)){
				 $expand_area_array  = json_decode($b_form->expand_area);
			}
			?>
           <?php $counter=1; foreach($expand_area as $data): ?>
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" 
					<?php if(is_array($serverice_array) &&in_array($data,$expand_area_array)) echo 'checked="checked"' ?>  name="expand_area[]" value="<?php echo $data ?>">
                  <?php echo $data ?>
                </label>
            </div>
            <?php endforeach;?>
         </div>

         <div class="form-group">
         <?php $years = array(
		 "Less than 1 year / I'm Just starting out.",'1 to 5 years','5 to 10 years','10 to 20 years','20 to 30 years','30 to 50 Years','50 Plus years'
		 );
               // array("Less than one year / I'm just starting out", '1 to 4 years','5 to 9 years','10 years or more')
            ?>
            <label class="control-label">How many years have you been in business? <span class="redstar">*</span></label>
            <select class="form-control" name="years" id="exampleFormControlSelect1" required>
                <option value="">Select</option>
                <?php foreach($years as $data): ?>
                        <option <?php if(isset($b_form->years) && $b_form->years ==$data) echo 'selected="selected"' ?>  value="<?php echo $data ?>"><?php echo $data ?></option>
                    <?php endforeach;?>

            </select>
            
         </div>

         <div class="form-group">
            <label class="control-label">How many employees do you have? <span class="redstar">*</span></label>
            <?php $employees_num = 
                array("It is just me / I am self employed / Sole Proprietor",
                '2 to 4 employees',
                '5 to 9 employees',
				 '10 to 49 employees',
				 '50 to 99 employees',
				 '100 to 249 employees',
				 '> 249 employees')
            ?>
            <select class="form-control" name="employees_num" required>
                <option value="">Select</option>
               <?php foreach($employees_num as $data): ?>
                        <option <?php if(isset($b_form->employees_num) && $b_form->employees_num ==$data) echo 'selected="selected"' ?>  value="<?php echo $data ?>"><?php echo $data ?></option>
                    <?php endforeach;?>
                
            </select>
         </div>


        

         

         <div class="form-group">
            <label class="control-label">What is your business average annual revenue? <span class="redstar">*</span></label>
            
            
            <?php $revenue = 
                array("I'm just starting out, so I have no revenue",
                'Less than $100k',
                'Between $100k and $250k',
				 'Between $250k and $1MM',
				 'Between $1MM and $5MM',
				 'Over $5MM')
            ?>
            <?php foreach($revenue as $data): ?>
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" <?php if(isset($b_form->revenue) && $b_form->revenue ==$data) echo 'checked="checked"' ?>  class="form-check-input" name="revenue" value="<?php echo $data ?>" required>
                        <?php echo $data ?>
                    </label>
                </div>
              <?php endforeach;?>

         </div>

         <div class="form-group">
            <label class="control-label">Please select if your business has been certified as the following: <span class="redstar">*</span></label>
         
			<?php $certified = 
                array("Certified Woman Owned Business",
                'Self Certified Minority-Owned Business',
                'Certified Veteran Owned Business',
                 'Certified Small Business',
				 'Certified NMSDC and Affiliates',
                 'Not Applicable (e.g. I do not qualify to certify under these criteria)',
                 'Other')
            ?>
            <?php $certified_array = array();
		    if(isset($b_form->expand_area)){
				 $certified_array  = json_decode($b_form->certified);
			}
			?>
            <?php foreach($certified as $data): ?>
                <div class="form-check form-check-inline">
                    <label class="form-check-label">
                        <input type="checkbox" <?php if(is_array($certified_array) &&in_array($data,$certified_array)) echo 'checked="checked"' ?> class="form-check-input" name="certified[]" value="<?php echo $data ?>">
                        <?php echo $data ?>
                    </label>
                </div>
             <?php endforeach;?>

         </div>

         <div class="form-group">
            <label class="control-label">Is your business a member of a chamber of commerce <!--<span class="redstar">*</span>--></label>
            <select class="form-control" name="is_member">
                <option value="">Select </option>
                <option <?php if(isset($b_form->is_member) && $b_form->is_member =='Yes') echo 'selected="selected"' ?> value="Yes">Yes</option>
                <option <?php if(isset($b_form->is_member) && $b_form->is_member =='No, but I want to learn more') echo 'selected="selected"' ?>  value="">No, but I want to learn more</option>
                
            </select>
         </div>	

         <div class="form-group">
            <label for="name">Please list any certifications you have obtained for your business <br />e.g. ISO, GFSI, FSSC 22000, B Corporation, etc.)  </label>
            <input  id="name" name="certifications"  class="form-control" 
            value="<?php if(isset($b_form->certifications)) echo $b_form->certifications  ?>" type="text">
        </div>

        <div class="form-group">
            <label class="control-label">Has your business won any awards? If so, please list them below. (Comma Separated)</label>
            <!-- <input id="name" class="form-control" name="" type="text"> -->
            <div>
                <input name="awards" id="tags2"  value="<?php if(isset($b_form->awards)) echo $b_form->awards  ?>" />
            </div>
         </div>	

            

      </div>
    </div>
     
  </div>
</div>
<br />
        
<p class="text-center">
    <a class="btn btn-primary" href="<?php echo base_url('login/onboard') ?>">Previous</a>		
    <button class="btn btn-primary" name="submit" value="1" type="submit" role="button">Save and go to Next</button>
</p>

</form> 
</div>
</div>
  <script>
	$("#bussiness_register").validate({ 
    rules: { 
            "services[]": { 
                    required: true, 
                    minlength: 1 
            },
			"expand_area[]": { 
                    required: true, 
                    minlength: 1 
            },
			"expand_area[]": { 
                    required: true, 
                    minlength: 1 
            },
			"certified[]": { 
                    required: true, 
                    minlength: 1 
            },
			
			
    },
	errorPlacement: function (error, element) {
    if (element.is(":checkbox") || element.is(":radio")) {
    error.insertBefore(element.parent().parent());
}
else {
    error.insertAfter(element);
}
        },
	}
	);
</script>