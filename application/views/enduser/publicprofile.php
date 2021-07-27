
<div class="card rounded">
                    <?php if($publicuserprofileinfo->complete_profile == 1): ?>
                    <div class="card-body business_profile">
                    <?php if($publicuserinfo->userID == $this->session->userdata('user_id')) { ?>
                        <a  class="edit_b_link" href="<?php echo base_url('login/complete_profile') ?>"><i class="mb-2 icon-md" data-feather="edit"></i>Edit Business Details</a> 
                    <?php } ?>
                    <?php //print_r($publicuserprofileinfo) ?>
                    
					<?php if(isset($publicuserprofileinfo->business_name)): ?>
                        <p class="mb-2"><strong>Business Name:</strong></p>
                        <p class="mb-3 tx-14"><?php echo $publicuserprofileinfo->business_name; ?></p>
                    <?php endif;?>
                    
                    <?php if(isset($publicuserprofileinfo->about_bussiness)): ?>
                        <p class="pt0"><strong>About Business:</strong></p>
                        <p class="mb-3 tx-14"><?php echo $publicuserprofileinfo->about_bussiness; ?></p>
                    <?php endif;?>
                    
                   <?php if(isset($publicuserprofileinfo->b_mission)): ?>
                      <p class="pt0"><strong>Mission & Vision:</strong></p>
                      <p class="mb-3 tx-14"><?php  if(isset($publicuserprofileinfo->b_mission))  echo $publicuserprofileinfo->b_mission; ?></p>
                     <?php endif ?>
                     <?php if(isset($publicuserprofileinfo->b_services)): ?>
                      <p class="pt0"><strong>Services:</strong></p>
                      <p class="mb-3 tx-14"><?php  if(isset($publicuserprofileinfo->b_services))  echo str_replace(',',', ',$publicuserprofileinfo->b_services); ?></p>
                     <?php endif ?>
                    
					<?php if(isset($publicuserprofileinfo->b_address)): ?>
                        <p class="pt0"><strong>Business Address:</strong></p>
                        <p class="mb-3 tx-14"><?php echo $publicuserprofileinfo->b_address; ?></p>
                    <?php endif;?>
					<?php if(isset($publicuserprofileinfo->phone)): ?>
                        <p class="pt0"><strong>Business Phone Number:</strong></p>
                        <p class="mb-3 tx-14"><a href="tel:<?php echo $publicuserprofileinfo->phone; ?>"><?php echo $publicuserprofileinfo->phone; ?></a></p>
                    <?php endif;?>
					<?php if(isset($publicuserprofileinfo->website)): ?>
                        <p class="pt0"><strong>Website:</strong></p>
                        <p class="mb-3 tx-14">
                          <a href="<?php echo $publicuserprofileinfo->website; ?>"><?php echo $publicuserprofileinfo->website; ?></a>
                        </p>
                    <?php endif;?>
					<?php if(isset($publicuserprofileinfo->business_email)): ?>
                        <p class="pt0"><strong>Business contact email address:</strong></p>
                        <p class="mb-3 tx-14">
                          <a href="mailto:<?php echo $publicuserprofileinfo->business_email; ?>"><?php echo $publicuserprofileinfo->business_email; ?></a>
                        </p>
                    <?php endif;?>
					<?php if(isset($publicuserprofileinfo->years)): ?>
                        <p class="pt0"><strong>Number of years in business:</strong></p>
                        <p class="mb-3 tx-14"><?php echo $publicuserprofileinfo->years; ?></p>
                    <?php endif;?>
					
					<?php if(isset($publicuserprofileinfo->industry)): ?>
                        <p class="pt0"><strong>Business Industry:</strong></p>
                        <p class="mb-3 tx-14"><?php echo $publicuserprofileinfo->industry; ?></p>
                    <?php endif ?>
				<?php /*?>	<?php if(isset($publicuserprofileinfo->b_services)): ?>
                        <p class="pt0"><strong>Business Services:</strong></p>
                        <p class="mb-3 tx-14"><?php echo $publicuserprofileinfo->b_services; ?></p>
                    <?php endif ?><?php */?>
 						<?php if(isset($publicuserprofileinfo->certified)): ?>
                      <p class="pt0"><strong>Business Certifications & Awards:</strong></p>
                      <p class="mb-3 tx-14"><?php $certified  = json_decode($publicuserprofileinfo->certified); echo implode('<br>',$certified)?></p>
                      <?php  if(isset($publicuserprofileinfo->certifications)):?>
                       	<p class="mb-3 tx-14"><?php   echo $publicuserprofileinfo->certifications; ?></p>
                       <?php endif;?>
                        <?php  if(isset($publicuserprofileinfo->awards)):?>
                       	<p class="mb-3 tx-14"> <?php  echo $publicuserprofileinfo->awards; ?></p>
                       <?php endif;?>
                        <?php 
						/*$ar_val= array();
						 if(isset($publicuserprofileinfo->NAICS) && $publicuserprofileinfo->NAICS){
							 echo '<p class="mb-3 tx-14"><strong>NAICS: </strong> '.$publicuserprofileinfo->NAICS.'</p>';
							
							} 
							if(isset($publicuserprofileinfo->EIN) && $publicuserprofileinfo->EIN){
								 echo '<p class="mb-3 tx-14"><strong>EIN: </strong> '.$publicuserprofileinfo->EIN.'</p>';
							}
						if(isset($publicuserprofileinfo->DUNS)  && $publicuserprofileinfo->DUNS){
							 echo '<p class="mb-3 tx-14"><strong>DUNS:</strong> '.$publicuserprofileinfo->DUNS.'</p>';
						}
						 if(isset($publicuserprofileinfo->cage) && $publicuserprofileinfo->cage){
							 echo '<p class="mb-3 tx-14"><strong>cage: </strong> '.$publicuserprofileinfo->cage.'</p>';
						 }*/
						 
 ?>
                      <?php endif; ?>
                      <?php /*?><?php if(isset($publicuserprofileinfo->services)): ?>
                      <p class="pt0"><strong>Basic description of your business services and offerings:</strong></p>
                          <p class="mb-3 tx-14"><?php  $service_arr = json_decode($publicuserprofileinfo->services); 
                          echo implode(', ', $service_arr); ?>
    
                        </p>
                    <?php endif;?><?php */?>



    <div class="card-body2222" style="margin:20px 0">
        
       
 
        <?php $count_review = $this->db->get_where('reviews',array('user_id'=>$publicuserinfo->userID,'type'=>'review'))->num_rows() ?>
            <p class="pt0"><strong>Reviews:</strong></p>
            <p class="mb-3 tx-14">
            <a  data-toggle="modal" data-target="#all_reviews" href="#">
			<?php if($count_review) echo str_pad($count_review, 2, '0', STR_PAD_LEFT);else echo '0' ?></a></p>
         <?php $count_recommend = $this->db->get_where('reviews',array('user_id'=>$publicuserinfo->userID,'type'=>'recommend'))->num_rows() ?>
             <p class="pt0"><strong>Recommandations:</strong></p>
            <p class="mb-3 tx-14">
			<a  data-toggle="modal" data-target="#all_recommandations" href="#">
			<?php if($count_recommend) echo str_pad($count_recommend, 2, '0', STR_PAD_LEFT);else echo '0' ?></a></p>
        
        <p class="mt-3 d-flex social-links" style="margin-top:0">
         
            <?php if($publicuserprofileinfo->twitter): ?>
            <a target="_blank" href="<?php echo $publicuserprofileinfo->twitter; ?>" class="btn d-flex align-items-center justify-content-center border mr-2 btn-icon twitter">
          
                <i data-feather="twitter" data-toggle="tooltip" title="Twitter"></i>
            </a>
              <?php endif ?>
              <?php if($publicuserprofileinfo->instagram): ?>
            <a target="_blank" href="<?php echo $publicuserprofileinfo->instagram; ?>" class="btn d-flex align-items-center justify-content-center border mr-2 btn-icon instagram">
                <i data-feather="instagram" data-toggle="tooltip" title="Instagram"></i>
            </a>
             <?php endif ?>
              <?php if($publicuserprofileinfo->facebook): ?>
            <a target="_blank" href="<?php echo $publicuserprofileinfo->facebook; ?>" class="btn d-flex align-items-center justify-content-center border mr-2 btn-icon facebook">
                <i data-feather="facebook" data-toggle="tooltip" title="Facebook"></i>
            </a>
            <?php endif ?>
        </p>
    </div>

                      
                    </div>
                    <?php endif ?>
                  </div>