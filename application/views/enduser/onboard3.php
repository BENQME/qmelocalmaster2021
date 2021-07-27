<div class="page-wrapper youtube-video">
    <div class="page-content register-form login_step">

        <h4 class="text-center">Onboard your business</h4>
        <p class="text-center">Having a business account on community portal has it's own perks. You can create spotlights, promotions.<br /> events or jobs for your business to engage with your audience.</p>

        <!-- <p class="mt-20 text-center"><a href="" class="not_now">No, Not Now</a></p> -->
        
        <div class="tabbable-panel business_information">
            <div class="tabbable-line">
               <ul class="nav nav-tabs">
                  <li class="active">
                     <a href="artboard-7.html" class="contentBTn">
                        Business Information </a>
                  </li>
                  <li class="active">
                     <a href="artboard-8.html" class="mediaBTn">
                        Additional Information </a>
                  </li>

                  <li class="active">
                     <a href="#"  class="thumbnailBtn">
                         Add Your Certifications </a>
                  </li>
               </ul>
               </div>
        </div>
<form id="bussiness_register" action="<?php echo base_url('login/onboard3') ?>" method="post">
    <div class="row w-100 mx-0 auth-page">

  <div class="offset-2 col-md-8 mx-auto art-board8">



                <div class="card">
                    
          <div class="auth-form-wrapper px-4 py-4">
            

                <div class="form-group">
                    <label class="control-label">Key certifications and registration guides required to do business<span class="block"></span> with state and federal government. <span class="learnmore"><a href="javascript:void(0)" data-container="body" data-toggle="popover" data-placement="bottom" data-content="The following questions are related to what a business would need if it were trying to pursue government funding or contracts.  Questions include the DUNS number, CAGE code, if you are registered with SAM, etc. This section contains Tooltips that will help educate you on how to get started on bidding on government contracts and fulfilling all the required steps to register your business for SAM.  If you are looking to go after government contracts, but do not know where or how to start, please watch the videos immediately below."><i class="feather icon-play"></i> Learn more</a></span></label>
                 </div>	
            
            <div class="form-group">
                <label class="control-label">How do I register my business for government contracts?
                </label>
                <iframe width="100%" height="250" src="https://www.youtube.com/embed/iuZI_0Yq2AQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
             </div>
             
             <div class="form-group">
                <label class="control-label"> 10 Best Practices for Winning Government Contract Jobs
                </label>
                <iframe width="100%" height="250" src="https://www.youtube.com/embed/CqCqg8S9lms" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
             </div>

             <div class="form-group">
                <label class="control-label">Please provide the NAICS codes associated with your business. <span class="learnmore"><a href="javascript:void(0)" data-container="body" data-toggle="popover" data-placement="bottom" data-content="'What are NAICS codes?' NAICS (North American Industry Classification System) codes are the identifying numbers used by the federal government to identify and classify companies by industry. When you fill out a business tax return, the Schedule C form requests your company's NAICS code, and when you apply for small business loans, credit accounts and other services, you may be asked to provide your NAICS code as well. More information here: https://smallbusiness.chron.com/uses-naics-codes-4099.html"><i class="feather icon-play"></i> Learn more</a></span></label>
                <input class="form-control" name="NAICS" type="text" placeholder="Type here."
                 value="<?php if(isset($b_form->NAICS)) echo $b_form->NAICS  ?>"
                 />
             </div>	

             <div class="form-group">
                <label class="control-label">Learn about what NAICS codes are, what they are used for, and how to find yours at this video link</label>
                <iframe width="100%" height="250" src="https://www.youtube.com/embed/qvUiPdm0CTc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
             </div>

            <div class="form-group">
                <label class="control-label">What is your EIN? <span class="learnmore"><a href="javascript:void(0)" data-container="body" data-toggle="popover" data-placement="bottom" data-content="'What is an EIN?' An Employer Identification Number (EIN) is also known as a Federal Tax Identification Number, and is used to identify a business entity. Generally, businesses need an EIN. You may apply for an EIN in various ways, and now you may apply online. This is a free service offered by the Internal Revenue Service and you can get your EIN immediately. You must check with your state to make sure you need a state number or charter. '9 Benefits of Getting an EIN (Even If You Don’t Have To)' (link: https://www.fundera.com/blog/benefits-of-getting-an-ein) 'Apply for an Employer Identification Number (EIN) Online for free' https://www.irs.gov/businesses/small-businesses-self-employed/apply-for-an-employer-identification-number-ein-online"><i class="feather icon-play"></i> Learn more</a></span></label>
                <input id="" class="form-control" name="EIN" type="text" placeholder="Type here."  value="<?php if(isset($b_form->EIN)) echo $b_form->NAICS  ?>"  />
             </div>	

             <div class="form-group">
                <label class="control-label">What is your DUNS number? <span class="learnmore"><a href="javascript:void(0)" data-container="body" data-toggle="popover" data-placement="bottom" data-content="'Why should I get a DUNS Number?' Having a D-U-N-S number may help your company obtain SSL certificate approval faster. A D-U-N-S Number may enable organizations to verify your business credentials quickly. Therefore, it can help bypass the need to submit all types of documentation to show proof of business ownership. You can learn more about DUNS numbers and how to get one at this link: https://www.dnb.com/duns-number.html"><i class="feather icon-play"></i> Learn more</a></span></label>
                <input id="" class="form-control" name="DUNS" value="<?php if(isset($b_form->DUNS)) echo $b_form->DUNS  ?>" type="text" placeholder="Type here." />
             </div>	


             <div class="form-group">
                <label class="control-label">What is a DUNS Number Used For?</label>
                <iframe width="100%" height="250" src="https://www.youtube.com/embed/Dw0cvRUtxS4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
             </div>


             <div class="form-group">
                <label class="control-label">Dun and Bradstreet Number: 4 Ways to Get It FREE</label>
                <iframe width="100%" height="250" src="https://www.youtube.com/embed/JzJWM9PWKoc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
             </div>
             

             <div class="form-group">
                <label class="control-label">Are you registered with SAM (System for Award Management)? <span class="learnmore"><a href="javascript:void(0)" data-container="body" data-toggle="popover" data-placement="bottom" data-content="'Why Your Business Needs A SAM (System for Award Management) Registration' If you’re a small business trying to increase your market share in the competitive business climate of today, getting your SAM Registration is not just important – it’s critical. A SAM registration is the first step to doing business with the world’s #1 consumer, the United States government. All federal agencies use the SAM database to identify businesses registered to do business with federal, state, and local level government. Both military and civilian agencies utilize SAM for a number of sourcing and procurement needs. They additionally use SAM to identify businesses with disadvantaged business designations such as Women Owned Small Businesses (WOSB) or Veteran Owned Small Businesses (VOSB). More info here: https://selectgcr.com/why-business-needs-sam-registration/ 'What is SAM and how do I register?' You can find out what SAM is and how to get registered for SAM at this link: https://www.sam.gov/SAM/"><i class="feather icon-play"></i> Learn more</a></span></label>

                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" name="SAM" <?php if(isset($b_form->SAM) && $b_form->SAM =='Yes') echo ' checked="checked"' ?>  class="form-check-input" name="optionsRadios5" id="optionsRadios5" value="Yes">
                                        Yes, I am registered
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" name="SAM"  <?php if(isset($b_form->SAM) && $b_form->SAM =='No') echo ' checked="checked"' ?> class="form-check-input" name="optionsRadios5" id="optionsRadios6" value="No">
                                        No, I am not registered
                                    </label>
                                </div>
                            
             </div>	

             <div class="form-group">
                <label class="control-label">What is your Cage Code? <span class="learnmore"><a href="javascript:void(0)" data-container="body" data-toggle="popover" data-placement="bottom" data-content="'Why do I need a CAGE code?' Companies that register in the System for Award Management (SAM) will be assigned a Commercial And Government Entity (CAGE) Code. This Code is a five-character ID number used extensively within the federal government, assigned by the Department of Defense's Defense Logistics Agency (DLA). You can find out what a CAGE code is and how to get it at this link: https://www.coleygsa.com/what-cage-code/"><i class="feather icon-play"></i> Learn more</a></span></label>
                <input id="" class="form-control" name="cage" value="<?php if(isset($b_form->cage)) echo $b_form->cage  ?>"  type="text" placeholder="Type here." />
             </div>	

             <div class="form-group">
                <label class="control-label">How to complete <a href="www.sam.gov" target="_blank"> www.sam.gov</a> to get a CAGE code</label>
                <iframe width="100%" height="250" src="https://www.youtube.com/embed/eWS2shtXwxk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
             </div>

             

                

          </div>
        </div>
          
      </div>
    </div>
    <br />
            
    <p class="text-center">
        <a class="btn btn-primary" href="<?php echo base_url('login/onboard2') ?>" role="button">Previous</a>		
        <button type="submit" name="submit" value="1" class="btn btn-primary">Submit</button>
    </p>
</form>

    </div>
</div>
 <script>
	$("#bussiness_register").validate();
</script>