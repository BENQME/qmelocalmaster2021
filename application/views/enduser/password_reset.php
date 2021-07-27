<div class="page-wrapper">
<div class="page-content register-form">

    <h4 class="text-center">Reset your password</h4><br />
    <div class="row w-100 mx-0 auth-page">

        <div class="offset-4 col-md-4 mx-auto">
            <div class="card">
                
      <div class="auth-form-wrapper px-4 py-4">
<?php /*?>		<?php if($error = $this->session->flashdata('login_error')): ?>
            <div class="alert alert-danger" role="alert">
             <?php echo $error ?>
            </div>
        <?php endif ?><?php */?>
        <form class="forms-sample" id="reset_pw" method="post" action="<?php echo base_url('login/resetpass') ?>">
          <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" name="password" id="password" class="form-control">
          </div>
          <div class="form-group">
            <label for="email">Retype Password</label>
            <input type="password" name="re_password" class="form-control">
          </div>
          
          
          <div class="mt-3">
            <button type="submit" name="submit" value="1" class="btn btn-primary mr-2 mb-2 mb-md-0 w-100">Reset Password</button>
           
          </div>
          <a href="<?php echo base_url('register') ?>" class="d-block mt-3">Not a user? Sign up</a>
        </form>

      </div>
    </div>
  </div>
            </div>
        

</div>
</div>
<script>
$( "#reset_pw" ).validate({
  rules: {
	password: {
      required: true,
	  pwcheck: true,
     minlength: 8
    },
	re_password: {
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
	re_password: {
      equalTo: "Passwords do not match",
    },
	
	
  },
  
});
$.validator.addMethod("pwcheck", function(value, element) {
	
    	        return this.optional(element) || /^[a-z0-9?!\\s]+$/i.test(value);
    	    }, "Your password must be at least 8 characters long and cannot contain any special characters such as @, #, $, %, &, *,  or +");
</script>