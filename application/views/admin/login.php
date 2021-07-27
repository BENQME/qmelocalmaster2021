<?php //echo $site_url ?>
<div class="page-wrapper">
<div class="page-content register-form">

    <h4 class="text-center"><?php echo site_info() ?> Admin Login</h4><br />
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
        <form class="forms-sample" id="login" method="post" action="<?php echo base_url('admin'); ?>">
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
              <span class="text-right"><a href="<?php echo base_url().'admin/reset_password' ?>">Forgot Password?</a></span> 
            </p>


          </div>
         
          
          <div class="mt-3">
            <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0 w-100">Login</button>
           
          </div>
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