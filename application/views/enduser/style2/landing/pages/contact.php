<?php //print_r($page_data) ?>
<style>
#contact_form input[type="email"],
#contact_form input[type="tel"],
#contact_form input[type="text"] {
    width: 420px;
    max-width: 100%;
    height: 44px;
    padding: 0 16px;
    border: 1px solid #cecece;
}
#contact_form  label{
font-weight: 600;
    font-size: 17px;
}
#contact_form textarea.form-control {
    min-height: 150px;
}
#contact_form  button[type="submit"] {
    height: 44px;
    color: #fff !important;
    background: #c11d2d !important;
    float: right;
}

</style>
<section class="page-header">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2><?php echo $page_data->pageTitle ?></h2>
      </div>
      <!-- end col-12 --> 
    </div>
    <!-- end row --> 
  </div>
  <!-- end container --> 
</section>
<section class="content-section no-space">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
      	<div class="page_content">
        
        <?php if($page_data->pageContent) echo $page_data->pageContent; ?>
        <?php if($sucesess = $this->session->flashdata('sucesess')): ?>
                        <div class="alert alert-success" role="alert">
                         <?php echo $sucesess ?>
                        </div>
                    <?php endif ?>
                    
        <form action="<?php echo base_url('mbncms/contact_submit/')?>" id="contact_form"  method="post">
        <div class="row">
        
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label">Your Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter Your Name" required="required">
                </div>
                <div class="form-group">
                    <label class="control-label">Your Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter Your Email" required="required">
                </div>
                <div class="form-group">
                    <label class="control-label">Phone Number</label>
                    <input type="tel" name="phone" class="form-control" placeholder="Enter Your Phone Number" required="required">
                </div>
                <div class="form-group">
                    <label class="control-label">Subject</label>
                    <input type="text" name="subject" class="form-control" placeholder="Enter Subject" required="required">
                </div>
                <div class="form-group">
                    <label class="control-label">Message</label>
                    <textarea name="message" class="form-control" required="required"></textarea>
                    <input type="hidden" name="url" value="<?php echo $this->uri->segment(2) ?>" />
                </div>
                  <div class="form-group">
                    <button type="submit" name="submit" value="1" class="btn btn-primary contentBTn">Submit</button>
                     <!-- <a href="create_a_spotlight-two.html" class="btn btn-primary contentBTn">Next</a> -->
                  </div>
            </div>
        </div>
        </form>
		</div>
      </div>
      <!-- end col-8 -->
      <div class="col-lg-4">
        <aside class="sidebar sticky-top">
        <?php echo sidebar('home_bottom')?>
          
        </aside>
        <!-- end sidebar --> 
      </div>
      <!-- end col-4 --> 
    </div>
    <!-- end row --> 
  </div>
  <!-- end container --> 
</section>
<?php /*?><script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js"></script>
<script>
	$("#contact_form").validate(
	);
</script><?php */?>