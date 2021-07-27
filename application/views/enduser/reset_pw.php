<div class="page-wrapper">
<div class="page-content register-form">

    <h4 class="text-center">Reset your password</h4><br />
    <div class="row w-100 mx-0 auth-page">

        <div class="offset-4 col-md-4 mx-auto">
            <div class="card">
                
      <div class="auth-form-wrapper px-4 py-4">
		<?php if($error = $this->session->flashdata('login_error')): ?>
            <div class="alert alert-danger" role="alert">
             <?php echo $error ?>
            </div>
        <?php endif ?>
        <form class="forms-sample" id="login" method="post" action="<?php echo base_url('login/reset_password') ?>">
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Email">
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
	$("#login").validate(
	);
</script>