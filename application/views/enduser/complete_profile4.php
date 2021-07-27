<div class="page-wrapper">
    <div class="page-content verify-email">
        <p class="text-center"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle icon-green"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg></p>
        
        <h4 class="text-center mt-20">Harness the power to grow your business</h4><br>
        <div class="row w-100 mx-0 auth-page mt20">

            <div class="offset-4 col-md-4 mx-auto">
                <div class="card">
                    
          <div class="auth-form-wrapper px-4 py-4 text-center">
                <h5>Do you have a  business?</h5><br>
                <p>
                <form action="<?php echo base_url('login/complete_profile4')?>" method="post">
                <input type="hidden" name="has_business" value="1" />
                    <button type="submit" name="submt" value="1" class="btn btn-primary btn-lg">Yes, I do</button>
                </form>
                </p>
                
                <p class="mt-20"><a href="<?php echo base_url('dashboard') ?>" class="not_now">No, Not Now</a></p>

          </div>
        </div>
      </div>
                </div>
            

    </div>
</div>