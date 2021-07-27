


<footer class="footer">
  <div class="container">
    <?php /*?><div class="row">
      <div class="col-12">
        <ul class="authors">
          <li>
            <figure> <img src="images/avatar02.jpg" alt="Image"> <a href="#"><i class="fab fa-instagram"></i></a>
              <figcaption><small>JESCCIA BLOOM</small>
                <b>Are you using the best credit card when ordering</b>
              </figcaption>
            </figure>
          </li>
          <li>
            <figure> <img src="images/avatar03.jpg" alt="Image"> <a href="#"><i class="fab fa-instagram"></i></a>
              <figcaption><small>ERICA BAUER</small>
                <b>40 of the most thoughtful gifts for every woman in your life</b>
              </figcaption>
            </figure>
          </li>
          <li>
            <figure> <img src="images/avatar04.jpg" alt="Image"> <a href="#"><i class="fab fa-instagram"></i></a>
              <figcaption><small>AMANDA SOUZA</small>
                <b>Forget chocolate: 2020 is the year of boozy calendars</b>
              </figcaption>
            </figure>
          </li>
        </ul>
      </div>
      <!-- end col-12 -->
      <div class="col-12">
        <div class="newsletter-box"> <i class="fal fa-envelope-open"></i>
          <h3>SUBSCRIBE TO OUR NEWSLETTERS</h3>
          <p>Now to get notified about exclusive offers from every week!</p>
          <form>
            <input type="email" placeholder="Enter Your email Addres...">
            <input type="submit" value="JOIN NOW">
            <label>
              <input type="checkbox">
              I would like to receive news and special offers. </label>
          </form>
        </div>
        <!-- end newsletter-box --> 
      </div>
      <!-- end col-12 --> 
    </div><?php */?>
    <!-- end row -->
    <div class="row align-items-center">
      <div class="col-lg-4">
      <div class="row">
          <div class="col-md-6"> 
                <ul class="footer-menu">
                  <li><a href="<?php echo base_url('login') ?>">Join MBN</a> </li>
                  </ul>
                  <strong>Register For</strong>
                   <ul class="footer-menu">
                  <li><a href="<?php echo base_url('page/mbe-supplier-connect') ?>">MBE Supplier Connect</a></li>
                  <li><a href="<?php echo base_url('page/mbn-usa-corporate-connect') ?>">MBN USA Corporate Connect</a></li>
                  <?php /*?><li><a href="<?php echo base_url('admin') ?>"><span style="text-transform:capitalize"><?php $val =  explode(" ",site_info()); echo $val[0] ?></span> Admin Area</a></li><?php */?>
                  
                </ul>
            </div>
            <div class="col-md-6"> 
                <ul class="footer-menu">
    			   <li><a href="<?php echo base_url('page/about-us') ?>">About Us</a></li>
                   <li><a href="<?php echo base_url('page/contact-us') ?>">Contact Us</a></li>
                  <li><a href="<?php echo base_url('home/privacy_policy') ?>">Privacy Policy</a></li>
                  <li><a href="<?php echo base_url('home/terms_conditions') ?>">Terms and Conditions</a></li>
                </ul>
            </div>
      </div>
      </div>
      <!-- end col-4 -->
      <div class="col-lg-4">
        <figure class="footer-logo">  <?php $logo_settings = json_decode(site_settings('logo_settings'));
		   if($logo_settings->logo){  ?>
           <a href="<?php echo base_url()?>"><img src="<?php echo base_url().'uploads/banners/'.$logo_settings->logo ?>" alt="<?php echo site_info() ?>" /></a>
           <?php } else{ ?>
              <h1><?php echo strtoupper(site_info()) ?></h1>
           <?php } ?> </figure>
      </div>
      <!-- end col-4 -->
      <div class="col-lg-4">
        <ul class="footer-social">
        <?php echo sidebar('social') ?>
        </ul>
      </div>
      <!-- end col-4 -->
      <div class="col-12"> <span class="copyright">&copy;<?php echo site_info() ?> <?php echo date('Y') ?> - Developed By Qme Spotlight Ecosystem  </span> </div>
      <!-- end col-12 --> 
    </div>
    <!-- end row --> 
  </div>
  <!-- end container --> 
</footer>
<!-- end footer --> 
<!-- JS FILES --> 
<div class="modal" id="signup" role="dialog">
    <div class="modal-dialog">
    
   
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">×</span>
         </button>
          <div class="page-content22 register-form22">
          <div class="modal-body">
        <?php //print_r(site_detail())?>
              <?php if(special_cms()){ ?>
            <?php  $logo_settings = site_settings('logo_settings');
    if($logo_settings){
         $settings_array = json_decode($logo_settings); 
        if(isset($settings_array->logo2) && $settings_array->logo2) {
        echo '<div class="text-center mb-10"><a href="'.base_url().'"><img class="img-logooo" src="'.base_url().'assets/traslogo.png" style="max-width:250px" /></a></div>';
        }
         
    }?>
     <h4  class="ma_title text-center" style="margin-bottom:0"> JOIN THE MBN USA COMMUNITY</h4>
     <div class="color_boxx text-center">
     <p>Customize your MBN USA experience to get breaking news <br />impacting minority-owned businesses

</div>
            <h5 class="text-center">Sign up to receive free instant access to:</h5>
        <div class="row">    
        <div class="col-md-6">
        	<ul>
<li>MBN USA Quarterly Magazine </li>
           <li>Resource for MBE Suppliers </li>
            <li>Customer Acquisition Education  </li>
</ul>
        </div>
         <div class="col-md-6">
        	<ul>
 <li>Networking Opportunities</li>
             <li>Supplier Diversity Strategies</li>
             <li>MBE Professional Development</li>
</ul>
        </div>             
</div>
            <?php } ?>
           <div class="row">
              <div class="col-md-12">
                 <div class="card2">
            
                    <div class="auth-form-wrapper">
                       <form id="register" method="post" action="<?php echo base_url('register') ?>" class="forms-sample">
                          <?php if(validation_errors()){ ?>
                          <div class="alert alert-danger"><?php echo validation_errors(); ?></div>
                         <?php } ?>
                          <div class="row">
                             <div class="col-md-6">
                                <div class="form-group">
                                  <?php /*?> <label for="first_name">First Name <span class="redstar">*</span></label><?php */?>
                                   <input type="text" value="<?php echo set_value('first_name');?>" required="required" name="first_name" class="form-control" id="first_name" autocomplete="off" placeholder="First Name">
                                </div>
                             </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                   <?php /*?><label for="last_name">Last Name <span class="redstar">*</span></label><?php */?>
                                   <input type="text" required="required"   value="<?php echo set_value('last_name');?>" name="last_name" class="form-control" id="last_name"  autocomplete="off" placeholder="Last Name">
                                </div>
                             </div>
                          </div>
                          <!-- row -->
                          <div class="form-group">
                             <?php /*?><label for="email">Email <span class="redstar">*</span></label><?php */?>
                             <input type="email" class="form-control" name="email" value="<?php echo set_value('email');?>" required="required" id="email" autocomplete="off" placeholder="Email address">
                                <span class="text-danger"><?php //echo $this->session->flashdata('Error'); ?></span>
                          </div>
                          <div class="row">
                             <div class="col-md-6">
                                <div class="form-group">
                                  <?php /*?> <label for="password">Password <span class="redstar">*</span></label><?php */?>
                                   <input type="password" name="password" required="required" value="<?php echo set_value('password');?>" class="form-control" id="password" autocomplete="off" placeholder="Password">
                                </div>
                             </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                  <?php /*?> <label for="confirm_password">Confirm Password <span class="redstar">*</span></label><?php */?>
                                   <input type="password" name="confirm_password"  value="<?php echo set_value('confirm_password');?>" required="required" class="form-control" id="confirm_password" aautocomplete="off" placeholder="Confirm Password">
                                </div>
                             </div>
                          </div>
                          <div class="row">
                          <div class="col-md-12">
                                <div class="form-group">
                                  <?php /*?> <label for="password">Password <span class="redstar">*</span><?php */?>
                                   <span><input type="checkbox" name="terms" required="required"> I agree to the <a target="_blank" href="<?php echo base_url('home/terms_conditions')?>">terms of use.</a></span>
                                   </div>
                                </div>
                             </div>

                          
                        
                          <p>
                             <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                          </p>
                          <p class="text-muted text-center">OR</p>
                          <p>   <a class="btn btn-block btn-social btn-facebook" href="<?php echo get_option('social_url').'/hauth/window/Facebook?site_id='.site_id() ?>" style="background: #3b5998; color: #fff !important;">
                             Sign in with Facebook
                             </a>
                          </p>
                          <p class="color_textt text-center">Already a user? <a href="<?php echo base_url('login') ?>" class="">Sign in</a></span>
                       </form>
                    </div>
                 </div>
              </div>
           </div>
          
           </div>
           <div class="modal-footer">
          
<p class="tex">Powered by QmeLocal</p>
        </div>
        </div>
      </div>
      
    </div>
  </div>
<script src="<?php echo base_url('landing_file/style2/js/bootstrap.min.js') ?>"></script> 
<script src="<?php echo base_url('landing_file/style2/js/swiper.min.js') ?>"></script> 
<script src="<?php echo base_url('landing_file/style2/js/scripts.js') ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.sameheight.js') ?>"></script>
 <script src="<?php echo base_url('assets/fitvids.js') ?>"></script>
 
<script>
$( document ).ready(function() {
   if ($('.site-menu li').hasClass('chid_active')){
	  // alert('dddd')
	  var $dropDown =$(this).closest('.dropdown');
    $dropDown.find("a:first").addClass("active");
	     $(this).closest('li').addClass("active"); 
   }

});
</script>
<script type="text/javascript" src="<?php echo base_url('landing_file/js/jcf.js') ?>"></script>
      <script type="text/javascript" src="<?php echo base_url('landing_file/js/jcf.select.js') ?>"></script>
<script type="text/javascript">
$(document).ready(function() {
	jcf.setOptions({
wrapNative: false,
wrapNativeOnMobile:false
});
jcf.replaceAll();



});
</script>
<?php $user_id = $this->session->userdata('user_id'); 
if($user_id){
}else{?>

<script type="text/javascript">
$(window).on('load',function(){
    var delayMs = 20000;
	
	//30000; // delay in milliseconds
    
    setTimeout(function(){
        $('#signup').modal('show');
    }, delayMs);
});  
</script>
       <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js"></script>
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
<?php } ?>

</body>
</html>
