<?php //print_r($page_data) ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js"></script>
<style>
.formdivider_custom{
background: linear-gradient(to right, #004185 0%, #D71921 100%) !important;
font-weight:400;
}
.inp_custom{border:none}
.inp_custom::after{display:none}
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




/* The container */
.custom_check_box label {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.custom_check_box input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.custom_check_box .checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.custom_check_box:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.custom_check_box input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.custom_check_box .checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.custom_check_box input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.custom_check_box .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}





.supplier_sgin_uppp .page_content h4{margin-bottom:0}
#contact_form textarea.form-control {
    min-height: 88px;
}
</style>
<?php /*?><section class="page-header">
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
</section><?php */?>
<section class="content-section no-space supplier_sgin_uppp">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
      <div class="page_content">
      
      
        <?php if($page_data->pageContent) echo $page_data->pageContent; ?>
        <form method="post" action="<?php echo base_url('payment/payment_success2') ?>" id="contact_form">
        <section>
            <div class="label">
            <div class="inp_custom">
                <div class="formdivider formdivider_custom">
                CONTACT INFORMATION (NOT PUBLISHED)
                </div>
            </div>
            </div>
<?php $p_category = $page_data->custom_fields; 
$p_category = json_decode($p_category);


?>

<div class="row">
<div class="col-md-6"><div class="form-group">
<label>Full Name</label>
<input type="text" name="Contacts_Name"  id="Contacts_Name"  placeholder="Full Name*"  class="form-control" required="required">
</div>
</div>
<div class="col-md-6"><div class="form-group">
<label class="input">Phone Number*</label>
<input type="tel" name="Contacts_Phone_Number"    required="required" placeholder="Phone Number*"  class="form-control">
</div></div>
<div class="col-md-6"><div class="form-group">
<label class="input">Email Address</label>
<input type="email" name="email" id="Contacts_Email_Address" required="required"  placeholder="Email Address*"  class="form-control">
</div></div>

</div>
</section>



<section>
            <div class="label">
            <div class="inp_custom">
                <div class="formdivider formdivider_custom">
                LISTING INFORMATION
                </div>
            </div>
            </div>


<div class="row">
<div class="col-md-6"><div class="form-group">
<label>Company Name*</label>
<input  type="text"  name="Company_Name_For_Listing" id="Company_Name_For_Listing" required="required"  placeholder="Company Name*"class="form-control">
</div>
</div>

<div class="col-md-6"><div class="form-group">
<label class="input">Company Website URL*</label>
<input type="url" id="urlBanner" name="Company_URL_For_Listing" id="Company_URL_For_Listing" required="required"  placeholder="Company Website URL*"  class="form-control">
</div></div>

<div class="col-md-6"><div class="form-group">
<label class="input">Contact's Title</label>
<input type="text" name="Contacts_Title" id="Contacts_Title"  placeholder="Contact's Title"  class="form-control">
</div></div>
<div class="col-md-6"><div class="form-group">
<label class="input">Phone_Number__xxx_xxxxxxx</label>
<input type="tel" name="Contact_Phone_Number" id="Contact_Phone_Number"  placeholder="Phone Number - (xxx) xxx-xxxx"  class="form-control">
</div></div>


<div class="col-md-6"><div class="form-group">
<label class="input">Contact Email</label>
<input type="email" name="Contact_Email" id="Contact_Email"  placeholder="Contact Email"  class="form-control">
</div></div>

<div class="col-md-12"><div class="form-group">
<label class="input">Street Address*</label>
<textarea name="Street_Address" id="Street_Address" rows="2"  placeholder="Street Address*"  class="form-control"></textarea>
</div></div>


<div class="col-md-6"><div class="form-group">
<label class="input">City Name*</label>
<input type="text" name="City_Name" id="City_Name"  required="required"  placeholder="City Name*"  class="form-control">
</div></div>


<div class="col-md-6"><div class="form-group">
<label class="input">State Name*</label>
<?php $us_state = array(
    'AL'=>'Alabama',
    'AK'=>'Alaska',
    'AZ'=>'Arizona',
    'AR'=>'Arkansas',
    'CA'=>'California',
    'CO'=>'Colorado',
    'CT'=>'Connecticut',
    'DE'=>'Delaware',
    'DC'=>'District of Columbia',
    'FL'=>'Florida',
    'GA'=>'Georgia',
    'HI'=>'Hawaii',
    'ID'=>'Idaho',
    'IL'=>'Illinois',
    'IN'=>'Indiana',
    'IA'=>'Iowa',
    'KS'=>'Kansas',
    'KY'=>'Kentucky',
    'LA'=>'Louisiana',
    'ME'=>'Maine',
    'MD'=>'Maryland',
    'MA'=>'Massachusetts',
    'MI'=>'Michigan',
    'MN'=>'Minnesota',
    'MS'=>'Mississippi',
    'MO'=>'Missouri',
    'MT'=>'Montana',
    'NE'=>'Nebraska',
    'NV'=>'Nevada',
    'NH'=>'New Hampshire',
    'NJ'=>'New Jersey',
    'NM'=>'New Mexico',
    'NY'=>'New York',
    'NC'=>'North Carolina',
    'ND'=>'North Dakota',
    'OH'=>'Ohio',
    'OK'=>'Oklahoma',
    'OR'=>'Oregon',
    'PA'=>'Pennsylvania',
    'RI'=>'Rhode Island',
    'SC'=>'South Carolina',
    'SD'=>'South Dakota',
    'TN'=>'Tennessee',
    'TX'=>'Texas',
    'UT'=>'Utah',
    'VT'=>'Vermont',
    'VA'=>'Virginia',
    'WA'=>'Washington',
    'WV'=>'West Virginia',
    'WI'=>'Wisconsin',
    'WY'=>'Wyoming',
);
?>
   <?php if($us_state):?>
<select id="state" name="state" required="required" class="form-control">
<option value="">-- Select State Name --</option>


<?php 
foreach($us_state as $state): ?>
<option value="<?php echo $state ?>"><?php echo $state ?></option>
<?php endforeach;?>


</select>
<?php endif;?>
</div></div>


<div class="col-md-6"><div class="form-group">
<label class="input">Zip Code*</label>
<input type="text" name="Zip_Code" id="Zip_Code"  required="required"  placeholder="Zip Code*"  class="form-control">
</div></div>

</div>

</section>

<section>
            <div class="label">
            <div class="inp_custom">
                <div class="formdivider formdivider_custom">
                PLEASE SELECT YOUR INDUSTRY
                </div>
            </div>
            </div>

<div class="row">
<div class="col-md-12"><div class="form-group">
<?php //print_r($page_data) ?>
<?php  $p_category ="";
  $p_category = $page_data->custom_fields; 
  $p_category = json_decode($p_category);
  if($p_category->sponsors_cat =='corporate'){
	  $page_id = 17;
  }else{
	  $page_id = $page_data->pageID;
  }
  
  $industry = array(
  "Advertising and Marketing",
"Aeorspace and Defense",
"Agriculture and Mining",
"Arts, Entertainment and Recreation",
"Automotive",
"Biotech and Pharmaceutical",
"Business Services",
"Construction",
"Consumer Products",
"Energy and Utilities",
"Financial Services",
"Healthcare",
"Information Communication Technology",
"Insurance",
"Legal",
"Professional and Technical Services",
"Retail",
"Technology",
"Transportation and Logistics",
"Travel and Hospitality"
  
  )
   ?>
   <?php if($categories = $this->db->get_where('pages',array('pageID'=>$page_id))->row()):?>
<select id="Industry" name="Industry" required="required" class="form-control">
<option value="">-- Select Industry --</option>


<?php 
$categories = json_decode($categories->spot_category);
foreach($industry as $cat): ?>
<option value="<?php echo $cat ?>"><?php echo $cat ?></option>
<?php endforeach;?>


</select>
<?php endif;?>
</div>
</div>
</div>
</section>
<section>
            <div class="label">
            <div class="inp_custom">
                <div class="formdivider formdivider_custom">
                CHOOSE ALL CERTIFICATIONS THAT APPLY
                </div>
            </div>
            </div>
<div class="row custom_check_box">

   <div class="col-md-6">
        <div class="form-group">
        	<label>
                Minority-Owned Business Enterprise
            <input type="checkbox" name="certifications[]" class="form-control" value="Minority-Owned Business Enterprise" /> 
        
             <span class="checkmark"></span>
            </label>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="form-group">
        	<label>
                  Disability-Owned Business Enterprise
            <input type="checkbox" name="certifications[]" class="form-control" value="Disability-Owned Business Enterprise" /> 
        
             <span class="checkmark"></span>
            </label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        	<label>
                  LGBTQIA+ Owned Business Enterprise
            <input type="checkbox" name="certifications[]" class="form-control" value="LGBTQIA+ Owned Business Enterprise" /> 
        
             <span class="checkmark"></span>
            </label>
        </div>
    </div>
     <div class="col-md-6">
        <div class="form-group">
        	<label>
                 Veteran-Owned Business Enterprise
            <input type="checkbox" name="certifications[]" class="form-control" value="Veteran-Owned Business Enterprise" /> 
        
             <span class="checkmark"></span>
            </label>
        </div>
    </div>
</div>
<div class="row text-center2">
<div class="col-md-12">
<strong>
By submitting this form, you agree that you have answered truthfully about the certifications above. Your directory entry will be printed as is except in the case where content must be edited for clarity or grammatical errors.</strong>
</div>
</div>
</section>
<div class="form-group">
<?php   $p_category = $page_data->custom_fields; 
	  $p_category = json_decode($p_category);
	  
	 $emails = $p_category->emails; ?>
<input type="hidden" name="user_emailss" value="<?php echo $emails ?>" />
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
	$("#contact_form").validate({
	rules:{

	Contacts_Phone_Number: {
		required: true,
		phoneUS: true
	},
	Contact_Phone_Number: {
		required: true,
		phoneUS: true
	},
	
	}
	});
	
});
$(document).ready(function() {
    $('#urlBanner').bind('change', function() {
        var $this = $(this);
        if(!/^http:\/\//.test($this.val())) {
            $this.val('http://' + $this.val());
        }
    });
});
</script>
