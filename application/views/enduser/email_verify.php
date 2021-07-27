<div class="page-content verify-email">
  <h4 class="text-center"> <?php if($isverify =='yes') echo "You have successfully verified your account."; else echo 'Invalid Verification Code' ?></h4>
  <br />
  <?php if($isverify =='yes'): ?>
      <div class="row w-100 mx-0 auth-page">
        <div class="offset-3 col-md-6 mx-auto">
          <div class="card">
            <div class="auth-form-wrapper px-4 py-5">
              <p class="text-center"> <i class="icon-green" data-feather="check-circle"></i></p>
              <p class="text-center mt-20">
                <a class="btn btn-primary mr-2 mb-2 mb-md-0 w-100" href="<?php echo base_url('enduser/login') ?>">Click Here To  Login</a>
              </p>
            </div>
          </div>
        </div>
      </div>
  <?php endif;?>
</div>
