<div class="page-wrapper">
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
</style>
<div class="page-content register-form">


<?php  
 $logo_settings = site_settings('logo_settings');
if($logo_settings){
	 $settings_array = json_decode($logo_settings); 
	if(isset($settings_array->logo2) && $settings_array->logo2) {
	echo '<div class="text-center mb-10"><a href="'.base_url().'"><img class="img-logooo" src="'.base_url().'uploads/banners/'.$settings_array->logo2.'" style="max-width:250px" /></a></div>';
	}
	 
}


 ?>

    <h4 class="text-center">Login to your account</h4><br />
		
    <div class="row w-100 mx-0 auth-page">



        <div class="offset-4 col-md-4 mx-auto">

            <div class="card">

                

      <div class="auth-form-wrapper px-4 py-4">

		<?php if($error = $this->session->flashdata('login_error')): ?>

            <div class="alert alert-danger" role="alert">

             <?php echo $error ?>

            </div>

        <?php endif ?>
        <?php if($success = $this->session->flashdata('success')): ?>

            <div class="alert alert-success" role="alert">

             <?php echo $success ?>

            </div>

        <?php endif ?>

        <form class="forms-sample" id="login" method="post" action="<?php echo base_url('login') ?>">

          <div class="form-group">

            <label for="email">Email address</label>

            <input type="email" name="email" class="form-control" id="email" required="required" placeholder="Email">

          </div>

          <div class="form-group">

            <label for="password">Password</label>

            <input type="password" name="password" required="required" class="form-control" id="password" autocomplete="current-password" placeholder="Password">

          </div>

          



          <div class="d-flex justify-content-between">

            <div class="form-check form-check-flat form-check-primary">

              <label class="form-check-label">

                <input type="checkbox" class="form-check-input">

                Remember me

              </label>

            </div>



            <p class="mt-10">

              <span class="text-right"><a  href="<?php echo base_url('login/reset_password') ?>">Forgot Password?</a></span> 

            </p>





          </div>

         

          

          <div class="mt-3">

            <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0 w-100">Login</button>

           

          </div>

           <br />

                      <p class="text-muted text-center">OR</p>

                      <br />

                      <?php

                      $this->session->unset_userdata('user_baseurl2');

                      $this->session->set_userdata('user_baseurl2', $this->uri->uri_string());?>

                      <p>   <a class="btn btn-block btn-social btn-facebook" 

                      href="<?php echo get_option('social_url').'/hauth/window/Facebook?site_id='.site_id() ?>" style="background: #3b5998; color: #fff !important;">

                         <span class="fa fa-facebook"></span> Sign in with Facebook

                         </a>

                      </p>

          <a class="regiser_link" href="<?php echo base_url('register') ?>" class="d-block mt-3">Don't have an account? Register here</a>

        </form>



      </div>

    </div>
<div class="text-center mt-20"><img class="img-logooo2" src="<?php echo base_url('assets/powelogo.svg')?>" style="max-width:200px" /></div>
  </div>

            </div>

        



</div>

</div>

<script>

	$("#login").validate(

	);

</script>