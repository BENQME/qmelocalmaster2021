<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>QMELOCAL :: Registeration</title>
<?php include('bootstrap.php'); ?>
    <script
  src="https://code.jquery.com/jquery-3.5.0.min.js"
  integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
  crossorigin="anonymous"></script>
</head>
<body>

	<div class="main-wrapper">

		<div class="page-wrapper full-page">
      <?php
        if($this->session->flashdata('message')) {
          echo '<div class="alert alert-success">
              '.$this->session->flashdata("message").'
          </div>';
        }
      ?>

			<div class="page-content d-flex align-items-center justify-content-center">

				<div class="row w-100 mx-0 auth-page">
					<div class="col-md-8 col-xl-6 mx-auto">
						<div class="card">
							<div class="row">
                <div class="col-md-4 pr-md-0">
                  <div class="auth-left-wrapper">
                  </div>
                </div>
                <div class="col-md-8 pl-md-0">
                  <div class="auth-form-wrapper px-4 py-5">
                    <a href="#" class="noble-ui-logo d-block mb-2">STEELTON<span> PORTAL</span></a>
                    <h5 class="text-muted font-weight-normal mb-4">Create a free account.</h5>
                    <form class="forms-sample" id="register" method="post" action="<?php echo base_url('superadmin/register/validate');?>">
                      <div class="form-group">
                        <label for="exampleInputUsername1">Username</label>

                        <?php
                        if(!empty($profile->displayName)):
                        ?>
                          <input type="text" required class="form-control" id="exampleInputUsername1" value="<?php echo set_value('',$profile->displayName);?>" name="user_name" autocomplete="Username" placeholder="Username">
                        <span class="text-danger"><?php echo form_error('user_name'); ?></span>
                        <?php else:
                        ?>
                          <input type="text" required class="form-control" id="exampleInputUsername1" value="<?php echo set_value('user_name');?>" name="user_name" autocomplete="Username" placeholder="Username">
                        <span class="text-danger"><?php echo form_error('user_name'); ?></span>
                        <?php endif?>

                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>

                        <?php
                        if(!empty($profile->email)):
                        ?>
                          <input type="email" required name="user_email" class="form-control" value="<?php echo set_value('',$profile->email)?>" id="exampleInputEmail1" placeholder="Email">
                          <span class="text-danger"><?php echo form_error('user_email'); ?></span>
                        <?php else:
                        ?>
                          <input type="email" required name="user_email" class="form-control" value="<?php echo set_value('user_email')?>" id="exampleInputEmail1" placeholder="Email">
                          <span class="text-danger"><?php echo form_error('user_email'); ?></span>
                        <?php endif?>

                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" required class="form-control" name="user_password" value="<?php echo set_value('user_password');?>" id="exampleInputPassword1" autocomplete="current-password" placeholder="Password">
                        <span class="text-danger"><?php echo form_error('user_password'); ?></span>
                      </div>
                      <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input">
                          Remember me
                        </label>
                      </div>
                      <div class="mt-3">
                        <p><button type="submit" name="register" value="Register" class="btn btn-primary mr-2 mb-2 mb-md-0 w-100">Register</button></p>
                        <p class="text-center mt10">OR</p>

                       <p class="mt10"> <a type="button" href="<?php echo base_url('hauth/window/Twitter');?>" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0 w-100">
                          <i class="btn-icon-prepend" data-feather="twitter"></i>
                          Sign up with twitter
      </a></p>

                         <p class="mt10"><a type="button" href="<?php echo base_url('hauth/window/Facebook');?>" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0 w-100">
                          <i class="btn-icon-prepend" data-feather="facebook"></i>
                          Sign up with Facebook
      </a></p>

                      </div>
                      <a href="<?php echo base_url('superadmin/login') ?>" class="d-block mt-3 ">Already a user? Sign in</a>
                    </form>
                  </div>
                </div>
              </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js"></script>
 <script>
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
</script>
</body>
</html>
