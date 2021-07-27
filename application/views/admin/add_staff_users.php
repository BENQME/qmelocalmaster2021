<div class="page-wrapper">
    <div class="page-content register-form login_step">

        <h4 class="text-center">Add New Staff User</h4>
       
        
        <br />
        <br />
        
  <form id="bussiness_register" action="<?php echo base_url('admin/add_staff') ?>" method="post">
    <div class="row w-100 mx-0 auth-page">

  <div class="offset-2 col-md-8 mx-auto">


              
                    <div class="card">
                     <?php if(validation_errors()){ ?>
                      <div class="alert alert-danger"><?php echo validation_errors(); ?></div>
                     <?php } ?>
                         <?php if($sucesess = $this->session->flashdata('sucesess')): ?>
                    <div class="alert alert-success" role="alert">
                     <?php echo $sucesess ?>
                    </div>
                <?php endif ?>
                        <div class="auth-form-wrapper px-4 py-4">
                        
                        <div class="row">
                            <div class="col-md-6">
                               <div class="form-group">
                                  <label class="control-label">First Name <span class="redstar">*</span></label>
                                  <input type="text" required="required" class="form-control" name="first_name"
                                   value="" placeholder="First Name">
                                  
                               </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb5">
                                    <label class="control-label">Last Name <span class="redstar">*</span></label>
                                    <input type="text" required="required" name="last_name" value="" class="form-control" placeholder="Last Name">
                                 </div>
                            </div>
                        </div> 
                        <div class="row">
                         <div class="col-md-6">
                                <div class="form-group mb5">
                                    <label class="control-label">Email <span class="redstar">*</span></label>
                                    <input type="email" required="required" name="email" value="" class="form-control" placeholder="Email">
                                 </div>
                            </div>
                        </div> <!-- row -->
                        
                        
                        
                        <div class="row">
                            <div class="col-md-6">
                               <div class="form-group">
                                  <label class="control-label">Password <span class="redstar">*</span></label>
                                  <input type="password" required="required" class="form-control" name="password"
                                   value="" placeholder="Password">
                                  
                               </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb5">
                                    <label class="control-label">Confirm Password <span class="redstar">*</span></label>
                                    <input type="password" required="required" name="c_password" value="" class="form-control" placeholder="Confirm Password">
                                 </div>
                            </div>
                        </div> 
                        
                        </div>
                    </div>
                
          
      </div>
    </div>
    <br />
            
    <p class="text-center">
        <button type="submit" name="submit" value="1" class="btn btn-primary" role="button">Submit</a>
    </p>
    </form>


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