<?php $sigment = $this->uri->segment(3);?>
<div class="page-wrapper">
<div class="page-content register-form">
    <h4 class="text-center">Set your password</h4><br />
    <?php if($error): ?>
    <strong class="danger" style="text-align:center; display:block">Invalid Verification Key</strong>
    <?php else: ?>
    <div class="row w-100 mx-0 auth-page">

        <div class="offset-4 col-md-4 mx-auto">
            <div class="card">
                
      <div class="auth-form-wrapper px-4 py-4">
		<?php if($error = $this->session->flashdata('login_error')): ?>
            <div class="alert alert-danger" role="alert">
             <?php echo $error ?>
            </div>
        <?php endif ?>
        <form class="forms-sample" id="bussiness_register" method="post" action="<?php echo base_url('superadmin/add_password') ?>">
          <div class="form-group">
            <label for="email">Your Password</label>
            <input type="password" name="password" class="form-control"  placeholder="Password" id="password" required="required">
          </div>
          <div class="form-group">
            <label for="email">Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required="required">
          </div>
          <input type="hidden" name="user_id" value="<?php echo $_GET['user_id'] ?>" />
          
          <div class="mt-3">
            <button type="submit" name="submit" value="1" class="btn btn-primary mr-2 mb-2 mb-md-0 w-100">Add Password</button>
           
          </div>
        </form>

      </div>
    </div>
  </div>
            </div>
    <?php endif;?>
        

</div>
</div>
 <script>
jQuery( "#bussiness_register" ).validate({
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