<?php //print_r($page_data) ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js"></script>
<style>
#contact_form input[type="email"],
#contact_form input[type="tel"],
#contact_form input[type="url"],
#contact_form input[type="text"] {
    width: 420px;
    max-width: 100%;
    height: 44px;
    padding: 0 16px;
    border: 1px solid #cecece;
}

#contact_form label.error{
    font-size: 13px;
    color: red;
    font-weight: normal;
    margin-top: 5px;
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
select {
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: linear-gradient(45deg, transparent 50%, gray 50%), linear-gradient(135deg, gray 50%, transparent 50%), linear-gradient(to right, #ccc, #ccc);
    background-position: calc(100% - 30px) 20px, calc(100% - 25px) 20px, calc(100% - 3.5em) 0;
    background-size: 5px 5px, 5px 5px, 1px 40px;
    background-repeat: no-repeat;
height: 43px;
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
        <form method="post" action="<?php echo base_url('payment') ?>" id="contact_form">
        <section>
            <div class="label">
            <div class="inp_custom">
                <div class="formdivider formdivider_custom">
                Contact Information
                </div>
            </div>
            </div>
<?php $p_category = $page_data->custom_fields; 
$p_category = json_decode($p_category);


?>

<div class="row">
<div class="col-md-6"><div class="form-group">
<label>Contact's Name</label>
<input type="text" name="Contacts_Name"  id="Contacts_Name"  placeholder="Contact's Name*"  class="form-control" required="required">
</div>
</div>
<div class="col-md-6"><div class="form-group">
<label class="input">Contact's Email Address</label>
<input type="email" name="email" id="Contacts_Email_Address" required="required"  placeholder="Contact's Email Address*"  class="form-control">
</div></div>
<div class="col-md-6"><div class="form-group">
<label class="input">Title*</label>
<input type="text" name="Contacts_title"   required="required" placeholder="Title*"  class="form-control">
</div></div>
<div class="col-md-6"><div class="form-group">
<label class="input">Company Name*</label>
<input type="text" name="Company_Name" value=""   required="required" placeholder="Company Name*"  class="form-control">
</div></div>
<div class="col-md-6"><div class="form-group">
<label class="input">Contact's Phone Number*</label>
<input type="tel" name="Contacts_Phone_Number"    required="required" placeholder="Contact's Phone Number*"  class="form-control">
<input type="hidden" name="price" value="<?php echo $p_category->price ?>" />
</div></div>
</div>
</section>



<section>
            <div class="label">
            <div class="inp_custom">
                <div class="formdivider formdivider_custom">
                COMPANY INFORMATION
                </div>
            </div>
            </div>


<div class="row">
<div class="col-md-6"><div class="form-group">
<label>Company Name (For Listing)*</label>
<input  type="text"  name="Contacts_Name" id="Company_Name_For_Listing" required="required"  placeholder="Company Name (For Listing)*"class="form-control">
</div>
</div>

<div class="col-md-6"><div class="form-group">
<label class="input">Company URL (For Listing)*</label>
<input type="url" name="Company_URL_For_Listing" id="Company_URL_For_Listing" required="required"  placeholder="Company URL (For Listing)*"  class="form-control">
</div></div>
</div>
</section>

<section>
            <div class="label">
            <div class="inp_custom">
                <div class="formdivider formdivider_custom">
                PLEASE SELECT YOUR INDUSTRY FOR LISTING
                </div>
            </div>
            </div>

<div class="row">
<div class="col-md-12"><div class="form-group">
<label>Industry</label>
<?php  $p_category ="";
  $p_category = $page_data->custom_fields; 
  $p_category = json_decode($p_category);
  if($p_category->sponsors_cat =='corporate'){
	  $page_id = 17;
  }else{
	  $page_id = 18;
  }
   ?>
   <?php if($categories = $this->db->get_where('pages',array('pageID'=>$page_id))->row()):?>
<select id="Industry" name="Industry" required="required" class="form-control">
<option value="">-- Select Industry --</option>


<?php 
$categories = json_decode($categories->spot_category);
foreach($categories as $cat): ?>
<option value="<?php echo $cat ?>"><?php echo $cat ?></option>
<?php endforeach;?>


</select>
<?php endif;?>
</div>
</div>
</div>
</section>
<div class="form-group">
    <button type="submit" name="submit" value="1" class="btn btn-primary contentBTn">Next</button>
     <!-- <a href="create_a_spotlight-two.html" class="btn btn-primary contentBTn">Next</a> -->
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
<script>
$(document).ready(function () {
$.validator.addMethod("phoneUS", function(phone_number, element) {
    phone_number = phone_number.replace(/\s+/g, "");
    return this.optional(element) || phone_number.length > 9 && phone_number.match(/^(\+?1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
}, "Please specify a valid phone number");
	$("#contact_form").validate(
	{

   Contacts_Phone_Number: {
        required: true,
                phoneUS: true
    }
	}
	);
});
</script>
