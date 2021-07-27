<style>
#whyjoin .close {
    position: absolute;
    right: 0;
    top: 10px;
    right: 10px;
    font-size: 39px;
	cursor:pointer;
}
#whyjoin .close span{cursor:pointer;}
#whyjoin .modal-header {
    border: none;
    position: relative;
}
#whyjoin .modal-dialog {
    max-width: 400px;
}
#whyjoin .modal-dialog .modal-title {
    margin-bottom: 10px;
    /* text-align: center; */
    font-size: 20px;
    font-weight: 900;
    text-transform: uppercase;
    line-height: 1;
    color: #0D2F81;
    margin-left: 15px;
}
#whyjoin .modal-dialog .benifets li {
    font-size: 17px;
    margin-bottom: 5px;
}
#terms-error{
    position: absolute;
    top: 18px;
}
.terms_error{position:relative}
</style>
<div class="page-wrapper">
    <div class="page-content register-form">
    <?php //print_r(site_detail())?>
         
        <?php  $logo_settings = site_settings('logo_settings');
if($logo_settings){
	 $settings_array = json_decode($logo_settings); 
	if(isset($settings_array->logo2) && $settings_array->logo2) {
		$logo =$settings_array->logo2;
	}elseif($settings_array->logo){
		$logo =$settings_array->logo;
		
	}
	if($logo)echo '<div class="text-center mb-10"><a href="'.base_url().'"><img class="img-logooo" src="'.base_url().'uploads/banners/'.$logo.'" style="max-width:250px" /></a></div>';
	}
	?> <?php if(special_cms()){ ?>
        <h5 class="text-center">Why Join The MBN Community? <a data-toggle="modal" data-target="#whyjoin" href="#">Click Here</a></h5><br />
        <?php } ?>
       <h4 class="text-center">Join Community</h4>
       <br />
       <div class="row w-100 mx-0 auth-page">
          <div class="offset-3 col-md-6 mx-auto">
             <div class="card">
        
                <div class="auth-form-wrapper px-4 py-4">
                   <form id="register" method="post" action="<?php echo base_url('register') ?>" class="forms-sample">
                      <?php if(validation_errors()){ ?>
                      <div class="alert alert-danger"><?php echo validation_errors(); ?></div>
                     <?php } ?>
                      <div class="row">
                         <div class="col-md-6">
                            <div class="form-group">
                               <label for="first_name">First Name <span class="redstar">*</span></label>
                               <input type="text" value="<?php echo set_value('first_name');?>" required="required" name="first_name" class="form-control" id="first_name" autocomplete="off" placeholder="First Name">
                            </div>
                         </div>
                         <div class="col-md-6">
                            <div class="form-group">
                               <label for="last_name">Last Name <span class="redstar">*</span></label>
                               <input type="text" required="required"   value="<?php echo set_value('last_name');?>" name="last_name" class="form-control" id="last_name"  autocomplete="off" placeholder="Last Name">
                            </div>
                         </div>
                      </div>
                      <!-- row -->
                      <div class="form-group">
                         <label for="email">Email <span class="redstar">*</span></label>
                         <input type="email" class="form-control" name="email" value="<?php echo set_value('email');?>" required="required" id="email" autocomplete="off" placeholder="Emal address">
                            <span class="text-danger"><?php //echo $this->session->flashdata('Error'); ?></span>
                      </div>
                      <div class="row">
                         <div class="col-md-6">
                            <div class="form-group">
                               <label for="password">Password <span class="redstar">*</span></label>
                               <input type="password" name="password" required="required" value="<?php echo set_value('password');?>" class="form-control" id="password" autocomplete="off" placeholder="Password">
                            </div>
                         </div>
                         <div class="col-md-6">
                            <div class="form-group">
                               <label for="confirm_password">Confirm Password <span class="redstar">*</span></label>
                               <input type="password" name="confirm_password"  value="<?php echo set_value('confirm_password');?>" required="required" class="form-control" id="confirm_password" aautocomplete="off" placeholder="Confirm Password">
                            </div>
                         </div>
                      </div>
                      
                      <div class="row">
                  <div class="col-md-12">
                        <div class="form-group">
<span class="terms_error"><input type="checkbox" name="terms" required="required"> I agree to the <a target="_blank" href="<?php echo base_url()?>home/terms_conditions">terms of use.</a></span>
                           </div>
                        </div>
                     </div>
                      <!-- <p><button type="button" class="btn btn-secondary w-100" style="background: #3b5998;"><i class="fa fa-facebook"></i> Sign up with Facebook</button></p>
                         <p class="mt10">
                           <button type="button" class="btn btn-success  w-100" style="border-color: #db3236; background: #db3236;"><i class="fa fa-google"></i>  Sign Up with Google</button>  
                         </p>  -->
                      <div class="mt-3">
                         <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0 w-100">Sign Up</button>
                      </div>
                      <br />
                      <p class="text-muted text-center">OR</p>
                      <br />
                      <p>   <a class="btn btn-block btn-social btn-facebook" href="<?php echo get_option('social_url').'/hauth/window/Facebook?site_id='.site_id() ?>" style="background: #3b5998; color: #fff !important;">
                         <span class="fa fa-facebook"></span> Sign in with Facebook
                         </a>
                      </p>
                      <?php /*?><p class="mt-10">
                         <a href="<?php echo get_option('social_url').'/hauth/window/google?site_id='.site_id() ?>" class="btn btn-block btn-social btn-twitter" style="border-color: #db3236; background: #db3236; color: #fff;">
                         <span class="fa fa-google"></span> Sign in with Google
                         </a>
                      </p><?php */?>
                      <a href="<?php echo base_url('login') ?>" class="d-block mt-3 text-center">Already a user? Sign in</a>
                   </form>
                </div>
             </div>
          </div>
       </div>
       <br />
       <p class="text-center text-muted">Powered by QmeLocal </p>
    </div>
 </div>
 
 <div class="modal fade" id="whyjoin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       <img style="max-width:100%" src="<?php echo base_url('benefit.jpg') ?>" />
   </div>
 </div>
 <script>
jQuery( "#register" ).validate({
  rules: {
	password: {
      required: true,
	  pwcheck: true,
     minlength: 8
    },
	confirm_password: {
      required: true,
	  pwcheck: true,
     minlength: 8,
	 equalTo: "#password"
    },
	
	
  },
  messages: {
	password: {
      required: "please enter your password",
    },
	confirm_password: {
      equalTo: "Passwords do not match",
    },
	
	
  },
  
});
jQuery.validator.addMethod("pwcheck", function(value, element) {
	
    	        return this.optional(element) || /^[a-z0-9?!\\s]+$/i.test(value);
    	    }, "Your password must be at least 8 characters long and cannot contain any special characters such as @, #, $, %, &, *,  or +");
</script>
<?php /*?>  <script>
	$("#register").validate(
	{
	rules: {
		user_password: {
			required: true,
			min:6
		}
	}
	}
	);
</script><?php */?>