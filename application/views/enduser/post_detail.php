<?php /*?> <link rel="stylesheet" href="<?php echo base_url('assets/vendors/owl.carousel/owl.carousel.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/owl.carousel/owl.theme.default.min.css') ?>"><?php */?>
  <link rel="stylesheet" href="<?php echo base_url('assets/signup_popup.css') ?>">         
<?php //print_r($spotlight) ?>
<style>
/*#signup .error {
    color: red;
    font-size: 12px;
}
 #signup button[type="submit"] {
     height: auto;
    padding: 10px;
	background:#727cf5;
	color:#fff;
}
 #signup .close {
    position: absolute;
    right: 0;
    top: 10px;
    right: 10px;
    font-size: 39px;
    cursor: pointer;
	opacity:1;
	color:#000;
	z-index: 9;
}
#signup .ma_title {
    font-size: 1.3rem;
	font-weight: normal;
}
#signup h5{font-size: 1rem;
margin-bottom:5px;}
#signup .btn-block,
#signup button[type="submit"],
#signup .form-group,
 #signup .form-control,
#signup p, 
#signup li {
    font-size: 0.8rem;
	margin-bottom: 5px;
}
#signup .text-muted{margin-top:5px;}
#signup .btn-block,
#signup button[type="submit"]{padding:7px}
#signup .modal-footer{
    text-align: center!important;
    justify-content: center;
}
#signup ul{padding-left: 10px; margin-bottom:5px}
 #signup .img-logooo{margin-bottom: 10px;}
 #signup .form-control{max-width: 100%;
    height: auto;
    padding: 6px;
    border: 1px solid #e8ebf1;
    width: 100%;
	border-radius:0;

}*/

/*end signup*/
.related_postss .img-fluid{min-height: 219px;
    object-fit: cover;}
.set_adsss img{max-width:100%}
.jobs_spotlight_slider img {
    height: 500px;
    object-fit: cover;
}

.owl-carousel .owl-nav.disabled {
    display: block;
 
	display:block !important;}
.owl-carousel .active123 .v_thumb{border:2px solid #727cf5}
.owl-carousel .owl-nav button.owl-next{right:0}
.owl-carousel .owl-nav button.owl-prev{left:0;}
.owl-carousel .owl-nav button.owl-next, 
.owl-carousel .owl-nav button.owl-next, .owl-carousel .owl-nav button.owl-prev {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: #727cf5;
    color: white;
    width: 30px;
    height: 30px;
    font-size: 34px;
    line-height: 14px;
    font-size: 34px;
}
.carousel-inner2 > .carousel-item {
    position: relative;
    display: none;
    -webkit-transition: 1.5s ease-in-out left;
    -moz-transition: 1.5s ease-in-out left;
    -o-transition: 1.5s ease-in-out left;
    transition: 1.5s ease-in-out left;
}
.card .event_boxx h6{margin-bottom:4px !important}
.btn-recommended_business2{background: #EFF5FF !important;
    border-color: #214FFB !important;
    color: #214FFB !important;
}
iframe{max-width:100%}
.bg-warning {
    background-color: #fff !important;
}
.side_barrr .card .card-title{margin-bottom:5px}

.abs_icon {
    position: absolute;
    right: 10px;
    bottom: 10px;
    background: #214FFB;
    padding: 10px;
    border-radius: 100%;
}
.img-thumbnail {width:100px}
.abs_icon img{height:30px !important}
.detail_dropdown button svg {
    width: 35px;
    height: 31px;
    padding: 5px;
}
.detail_dropdown button svg {
    width: 50px !important;
    height: 50px !important;
}
	.jobs_spotlight_slider img {
    height: auto;
    object-fit: contain;
}
.related_postss .fluid-width-video-wrapper{min-height:175px}
.related_postss .fluid-width-video-wrapper iframe{border:none; margin:0 !important}
.carousel-item22 .play_icon {
    position: absolute;
    top: 50%;
    display: block;
    width: 100%;
    text-align: center;
    transform: translate(50%, -50%);
}
.carousel-item22  .v_box {
    position: relative;
}
.carousel-item22 .play_icon img {
    width: 30px !important;
}
.owl-theme .owl-dots .owl-dot{display:none !important;}
.owl-carousel .owl-item .v_thumb {
	object-fit: cover;
    min-height: 161px;
}
.detail_dropdown_mobile{display:none}
@media (max-width: 767px){
	.page-content h4.mb-3 {
    display: flex;
    font-size: 15px;
    line-height: 1.4;
	margin-bottom:0 !important;
}
.detail_dropdown_mobile {
    display: block;
    float: right;
    margin-right: 0;
    position: absolute;
    right: 0;
    top: 46%;
    transform: translate(0, -50%);
}

.detail_dropdown_mobile .btn_sidebar  svg{width:30px; height:30px;}
.zat_carttt .card-header .fllex_mobileee {
 
    position: relative;
}
	.dropdown.detail_dropdown{display:none}
	}
@media (max-width: 576px){
	.zat_carttt .card-header .fllex_mobileee{flex-flow: column;
}
.jobs_spotlight_slider img {
    height: 240px;
        object-fit: contain;
}
.horizontal-menu .navbar .navbar-content .navbar-nav .nav-item{    width: auto;}
.horizontal-menu .navbar .navbar-content .navbar-nav {
    margin-right: 10px;
}
}

</style>
<div class="page-wrapper post_detail_page">
<?php $this->db->where('userID', $spotlight->userid);
		                $this->db->from('users');
						$userinfo = $this->db->get()->row(); ?>
        <div class="page-content fix_width">
               
    <?php //print_r($gallery);
	
	//print_r($spotlight) ?>
    <?php
	 $icon="";
	 
	  if (strpos($spotlight->postContent, 'youtube.com/embed/') !== false) { 
	 
	 $icon = ' <span title="This spotlight also have video content featured in it" class="iconn_fix badge badge-primary" data-toggle="tooltip" data-placement="top" style="background:red"><i class="icon-md" data-feather="video"></i></span>';
	 }
	  if (strpos($spotlight->postContent, 'embed.podcasts') !== false) { 
	 
	 $icon .= ' <span class="iconn_fix badge badge-primary" data-toggle="tooltip" data-placement="top" title="This spotlight also have podcast content featured in it" style="background:orange"><i class="icon-md" data-feather="mic"></i></span>';
	 }
	 
	 
	  ?>
      <?php if(special_cms()){ ?>
      
      <div class="row set_adsss align-items-center">
      <div class="col-12 col-md-12 text-center">
      <?php echo sidebar_by_url(current_url()) ?>
      </div>
    </div>
      <?php } ?>
    <div class="row">
            <div class="col-md-12">
             <div class="zat_carttt card rounded">
               <div class="card-body">

            <?php 
			//print_r($spotlight->userid); die;
			$user_data = $this->db->get_where('users',array('userID'=> $spotlight->userid))->row();
			
			  ?>
            <div class="card-header">
		 <div class="d-flex fllex_mobileee align-items-center justify-content-between">
			 <div>
              
             <div class="d-flex align-items-center">
				<a href="<?php echo base_url('publicprofile/'.$spotlight->userid) ?>"><img class="img-thumbnail rounded-circle" src="<?php echo base_url().'uploads/profile_img/'.$user_data->photo; ?>" alt=""></a>											

				 <div class="ml-2">
				
					<h6><?php echo $user_data->first_name.' '.$user_data->last_name;?></h6>
					 <h6 class="tx-15 ext-muted" style="margin:5px 0"><?php echo date('F d, Y',strtotime($spotlight->created_at)) ?></h6>
                     
                     
                    
                     
                     
				 </div>
                 
                 <div class="dropdown detail_dropdown_mobile">
             <?php  echo $icon; ?>
         <button class="btn_sidebar btn p-0" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <i class="icon-lg pb-3px" data-feather="more-horizontal"></i>
         </button>
         <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton2">
             <?php $user_id = $this->session->userdata('user_id'); ?>
             <?php  if($user_id  != $spotlight->userid): ?>
             <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('publicprofile/'.$spotlight->userid) ?>"><i data-feather="meh" class="icon-sm mr-2"></i> <span class=""><?php if(!is_following($spotlight->userid)) echo 'Follow'; else echo 'UnFollow'?></span></a>
             <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('publicprofile/'.$spotlight->userid) ?>"><i data-feather="corner-right-up" class="icon-sm mr-2"></i> <span class="">View Profile</span></a>
        
        <?php endif ?>
             <?php if($this->session->userdata('user_id') != $spotlight->userid): ?>
             <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('dashboard/messages/'.$spotlight->userid) ?>"><i data-feather="send" class="icon-sm mr-2"></i> <span class="">Send Message</span></a>
             <?php endif;?>
             <?php $url =  base_url('detail/'.$spotlight->postSlug)?>
             <a class="copy_to_clipboard dropdown-item d-flex align-items-center" data-clipboard-text="<?php echo $url ?>"><i data-feather="copy" class="icon-sm mr-2"></i> <span class="">Copy Link</span></a>
             
         </div>
         
        </div>
			 </div>
              
              
              </div>
			 <div class="dropdown detail_dropdown">
           <?php /*?>  <?php  echo $icon; ?>
             <?php if($this->session->userdata('user_id') != $user_data->userID): ?>
                            <a  href="<?php echo base_url().'dashboard/messages/'.$user_data->userID; ?>" class="btn_sidebar btn btn-primary btn-recommended_business btn-icon-text btn_send_msg">
                                 Send Message
                            </a>
                            <?php endif;?>   <?php */?>
         <button class="btn_sidebar btn btn-primary btn-recommended_business2 btn-icon-text btn_send_msg p-0" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <i class="icon-lg pb-3px" data-feather="more-horizontal"></i>
         </button>
         <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
             <?php $user_id = $this->session->userdata('user_id'); ?>
             <?php  if($user_id  != $spotlight->userid): ?>
             <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('publicprofile/'.$spotlight->userid) ?>"><i data-feather="meh" class="icon-sm mr-2"></i> <span class=""><?php if(!is_following($spotlight->userid)) echo 'Follow'; else echo 'UnFollow'?></span></a>
             <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('publicprofile/'.$spotlight->userid) ?>"><i data-feather="corner-right-up" class="icon-sm mr-2"></i> <span class="">View Profile</span></a>
        
        <?php endif ?>
             <?php if($this->session->userdata('user_id') != $spotlight->userid): ?>
             <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('dashboard/messages/'.$spotlight->userid) ?>"><i data-feather="send" class="icon-sm mr-2"></i> <span class="">Send Message</span></a>
             <?php endif;?>
             <?php $url =  base_url('detail/'.$spotlight->postSlug)?>
             <a class="copy_to_clipboard dropdown-item d-flex align-items-center" data-clipboard-text="<?php echo $url ?>"><i data-feather="copy" class="icon-sm mr-2"></i> <span class="">Copy Link</span></a>
             
         </div>
         
        </div>
		 </div>
         
        <div class="card-body33" style="margin:20px 0">
        
                           
                            <?php if(isset($spotlight->spotlight_type) && $spotlight->spotlight_type  =='Job Posting'): ?>
								<?php if(isset($spotlight->salary_range)): ?>
                                    <h6 class="card-title">Salery</h6>
                                    <p><?php echo $spotlight->salary_range ?></p>
                                 <?php endif;?>
                                 <?php if(isset($spotlight->job_position)): ?>
                                 	<hr />
                                    <h6 class="card-title">Job Position</h6>
                                    <p><?php echo $spotlight->job_position ?></p>
                                 <?php endif;?>
                                 <?php //print_r($userinfo) ?>
                                  <p class="text-center2 applybtn2" style="margin-top:5px">	
                                    <a target="_blank" href="mailto:<?php echo $userinfo->email ?>" type="button" class="btn btn-primary">Apply</a>
                                </p>
                            <?php elseif(isset($spotlight->spotlight_type) &&  $spotlight->spotlight_type  =='Events22'): ?>
                                <div class="row event_boxx">
									 <?php if(isset($spotlight->event_date)): ?>
                                         <div class="col-4 col-md-4 col-xs-4">
                                            <h6 class="card-title">Event Start Date & Time</h6>
                                            <p><?php echo date('F d, Y g:i a',strtotime($spotlight->event_date)) ?></p>
                                         </div>
                                     <?php endif;?>
                                     <?php if(isset($spotlight->event_time)): ?>
                                        <div class="col-4 col-md-4 col-xs-4">
                                            <h6 class="card-title">Event End Date & Time</h6>
                                            <p><?php echo date('F d, Y g:i a',strtotime($spotlight->event_time)) ?></p>
                                        </div>
                                     <?php endif;?>
                                      <?php if(isset($spotlight->event_location)): ?>
                                        <div class="col-4 col-md-4 col-xs-4">
                                            <h6 class="card-title">Location</h6>
                                            <p><i data-feather="map-pin" class="blue-text"></i> <?php echo $spotlight->event_location ?></p>
                                        </div>
                                        <?php endif;?>
                                 </div>
                                    <?php /*?>  <a target="_blank" href=" https://www.google.com/calendar/render?action=TEMPLATE&text=<?php echo urlencode($spotlight->postTitle) ?>&details=sadfasd&location=<?php echo urlencode($spotlight->event_location) ?>&dates=
                                      
                                      
                                      <?php echo date("c", strtotime($spotlight->event_date)) ?>
                                      %2Fundefined" type="button" class="btn btn-primary">Apply</a><?php */?>
                                   
                                   <?php elseif(isset($spotlight->spotlight_type) &&  trim($spotlight->spotlight_type)  == 'Spotit Spotlight'): ?>
									  <?php if(isset($spotlight->contact_email) && $spotlight->contact_email): ?>
                                        <h6 class="card-title">Contact Email</h6>
                                        <p><?php echo $spotlight->contact_email ?></p>
                                     <?php endif;?>
                                      <?php if(isset($spotlight->contact_phone) && $spotlight->contact_phone): ?>
                                      <hr />
                                        <h6 class="card-title">Contact Phone #</h6>
                                        <p><?php echo $spotlight->contact_phone ?></p>
                                        
                                     <?php endif;?>
                                     <?php if(isset($spotlight->coupon) && $spotlight->coupon_status =='yes'): ?>
                                      <hr />
                                        <h6 class="card-title">Special Promotion</h6>
                                        <p><?php echo $spotlight->coupon ?>% OFF</p>
                                        
                                     <?php endif;?>
                                
                            
                             <?php else: ?>
                             
                          
                        <?php endif ?>      
                        
                        </div>
                        
        <h4 class="mb-3 mb-md-0"><?php if(isset($spotlight)) echo $spotlight->postTitle ?>
        
        
        </h4>
	 </div>
            <?php if($spotlight->spotlight_type =='Media/Podcast'){ ?>
            <?php //print_r($media_posts) ?>
            <?php if($spotlight->em_video):?><div style="margin:0" class="fluid-width-video-wrapper"><?php echo convertYoutube($spotlight->em_video) ?></div>
            <br />
            <?php endif;?>
            <?php /*?><div class="jobs_spotlight_slider22" style="margin-bottom:20px">
                <div class="owl_wrapper">
                    <div class="owl-carousel owl-theme owl-basic">
             
                     <?php 
                        foreach($media_posts as $img): ?>
                        <?php if($img->cover_photo): ?>
                           <div class="carousel-item22 item <?php if($spotlight->postID == $img->postID)echo ' active123';  ?>">
                            <a href="<?php echo base_url('detail/'.$img->postSlug) ?>">
                                <div class="v_box">
                                <img class="v_thumb" src="<?php echo base_url('uploads/cover_photo/'.$img->cover_photo) ?>">
                                <span class="play_icon"><img src="<?php echo base_url() ?>landing_file/style2/you/youtube.svg"></span>
                                </div>
                            </a>
                              
                            
                           </div>
                       <?php endif;?>
                        <?php $counter++; endforeach;?>
 
                    </div>
                  
                 </div>		
            </div><?php */?>
            
            <?php if(isset($spotlight)) echo $spotlight->postContent ?>
            <?php }else{ ?>

           
            
             <?php if(isset($gallery) && $gallery): ?>
                <div class="jobs_spotlight_slider">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" >
                        <?php if(count($gallery)>1): ?>
                        <ol class="carousel-indicators">
                         <?php  $counter=0; $active =' class="active"'; if($spotlight->cover_photo): ?>
                         <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $counter ?>" <?php echo $active; $active=""  ?>></li>
                         <?php $active =''; $counter=1; endif;?>
                           <?php 
						    foreach($gallery as $img): ?>
                           		<li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $counter ?>" <?php echo $active; $active=""  ?>></li>
                           <?php $counter++; endforeach;?>
                        </ol>
                        <?php endif;?>
                        <div class="carousel-inner">
                        <?php  $counter=0; $active =' active'; if($spotlight->cover_photo): ?>
                          <div class="carousel-item active">
                              <img src="<?php echo base_url('uploads/cover_photo/'.$spotlight->cover_photo); ?>" class="d-block w-100">
                           </div>
                           <?php
						   $counter=1;
						   $active="";
						    endif;?>
                         <?php 
						    foreach($gallery as $img): ?>
                            <?php if($img->image_name): ?>
                               <div class="carousel-item <?php echo $active; $active=""  ?>">
                                  <img src="<?php echo base_url('uploads/spotlights/'.$img->image_name) ?>" class="d-block w-100">
                                <?php /*?>  <?php if($spotlight->spotlight_type =='Spotit Spotlight'): ?>
                                  <div class="abs_icon"><img src="<?php echo base_url('assets/shout.svg') ?>" /></div>
                                  <?php endif ?><?php */?>
                               </div>
                           <?php endif;?>
                            <?php $counter++; endforeach;?>
     
                        </div>
                       <?php /*?> <?php if(count($gallery)>1): ?>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                           <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                           <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                           <span class="carousel-control-next-icon" aria-hidden="true"></span>
                           <span class="sr-only">Next</span>
                        </a>
                        <?php endif;?><?php */?>
                     </div>		
                </div>
             <?php elseif($spotlight->cover_photo && !$spotlight->em_video): ?>
              <div class="jobs_spotlight_slider">
              
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    
                    <div class="carousel-inner">
                           <div class="carousel-item active">
                              <img src="<?php echo base_url('uploads/cover_photo/'.$spotlight->cover_photo); ?>" class="d-block w-100">
                              <?php /*?><?php if($spotlight->spotlight_type =='Spotit Spotlight'): ?>
                              <div class="abs_icon"><img src="<?php echo base_url('assets/shout.svg') ?>" /></div>
                              <?php endif ?><?php */?>
                           </div>
 
                    </div>
                    
                 </div>		
            </div>
            <?php endif;?>
     <?php if($spotlight->em_video):?><div style="margin:0" class="fluid-width-video-wrapper"><?php echo convertYoutube($spotlight->em_video) ?></div>
          <?php endif ?>
            <?php if(isset($spotlight)) echo $spotlight->postContent ?>
            <?php if(($spotlight->spotlight_type =='Events') && $spotlight->event_register): ?>
                
            
            <div class="row text-center2">
                <div class="col-md-12" style="margin:20px 0">
                <div class="event_boxx">
                 <?php if(isset($spotlight->event_start_date)): ?>
                     <div class="mb-2">
                       
                         <?php $event_start_time =$spotlight->event_start_time ?>
                        <p> <strong>Event Start Date & Time: </strong> <?php echo date('F d, Y',strtotime($spotlight->event_start_date)) ?> <?php echo $event_start_time ?></p>
                     </div>
                 <?php endif;?>
                 <?php if(isset($spotlight->event_end_date)): ?>
                    <div class="mb-2">
                    <?php $event_end_time =$spotlight->event_end_time ?>
                        <p><strong>Event End Date & Time: </strong><?php echo date('F d, Y',strtotime($spotlight->event_end_date)) ?> <?php echo $event_end_time ?></p>
                    </div>
                 <?php endif;?>
                  <?php if($timezone_offset = $spotlight->timezone_offset): ?>
                    <div class="mb-2">
                        <p><strong>Time Zone: </strong> <?php echo $timezone_offset ?></p>
                    </div>
                 <?php endif;?>
                  <?php if(isset($spotlight->event_location)): ?>
                     <div class="mb-2">
                        <p><strong>Location: </strong> <?php echo $spotlight->event_location ?></p>
                    </div>
                    <?php endif;?>
                    
             </div>
                <a target="_blank" class="btn btn-primary" href="<?php echo $spotlight->event_register ?>"> Register Now</a>
                </div>
            </div>
            <?php endif;?>
            
            
            <?php }?>
            <?php if(isset($spotlight->tags) && $spotlight->tags): ?>
             	<br />
                    <div class="d-flex post-actions tag_boxx" style="margin-bottom:20px">
                        <h4 class="d-flex align-items-center text-muted">
                            <i class="icon-md" data-feather="tag"></i>
                            
                            <p class="d-none d-md-block ml-2">Tags: </p>
                            <?php $tags =  explode(',',$spotlight->tags) ?>
                            <p class="d-md-block ml-2">
                            <?php foreach($tags as $tag) echo '<a href="'.base_url('tag/?tag='.$tag).'" class="btn btn-primary">'.$tag.'</a> ' ?>
                            
                            
                            </p>
                        </h4>
                    </div>
                 <?php endif;?>
<script async src="https://static.addtoany.com/menu/page.js"></script>
                <div class="card-footer custom-card">
                    
                    <div class="d-flex post-actions">
                        <?php if($likes_data && count($likes_data)>0){ 
                                $already_like= 'heartfill';
                             }else{ 
                                $already_like= '';
                             } ?>
                        <a href="javascript:;" class="like_count <?php echo $already_like; ?> d-flex align-items-center text-muted mr-4 " data-post-id="<?php echo trim($spotlight->postID) ?>">
                            
                                <i class="icon-md" data-feather="heart"></i>
                            
                            <p class="d-none d-md-block ml-2"><span class="like_count_data"><?php if(isset($spotlight->likes)) echo $spotlight->likes; else echo 0 ?></span> Like</p>
                        </a>
                        <?php $comment_count =$this->db->get_where('comments',array('itemID'=>$spotlight->postID))->num_rows() ?>
                        <a  id="show_comment" href="javascript:;" class="d-flex align-items-center text-muted mr-4">
                            <i class="icon-md" data-feather="message-square"></i>
                            <p class="d-none d-md-block ml-2"><?php echo $comment_count ?> Comments </p>
                        </a>
                        <a href="javascript:;" data-a2a-url="<?php echo base_url('detail/'.$spotlight->postSlug) ?>" data-a2a-title="<?php echo $spotlight->postTitle ?>" class=" a2a_dd d-flex align-items-center text-muted  mr-4">
                            <i class="icon-md" data-feather="share"></i>
                            <!-- AddToAny BEGIN -->
<!-- AddToAny END -->
                            <p class="d-none d-md-block ml-2">Share</p>
                        </a>
                       <?php /*?> <?php if($comment_count >0){ ?>
                        <a href="javascript:;" class="d-flex align-items-center text-muted mr-4">
                            <i class="icon-md" data-feather="message-square"></i>
                            <p class="d-none d-md-block ml-2">View <?php echo $comment_count ?> Comments </p>
                        </a>
                        <?php } ?><?php */?>
                    </div>
                </div>
                 
                <?php //print_r($_REQUEST) ?>
                
                
                </div>
                </div>
               
               </div> <!-- col -->
             <!-- col -->

    </div> <!-- row -->
               <div class="row2 comment_holder" id="comment">
					
						<?php
							echo getComments('spotlights', $spotlight->postID);
						?>
							
                </div>
                
                
					<div class="clearfix"></div>
                <hr />
                
                <?php if(isset($related_posts) && $related_posts): //print_r($related_posts) ?>
                <h4>More <?php echo str_replace('Spotit Spotlight', 'General Spotlights',$spotlight->spotlight_type) ?></h4><br />
                <div class="row set-card-spacing related_postss">
					
                        <?php foreach($related_posts as $post):
						//print_r($user_info);
						 ?>
                            <div class="eq_height_wrapper col-md-4 grid-margin">
                                <div class="eq_hight card rounded">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <?php if($post['photo']): ?>
                                                <a href="<?php echo base_url('publicprofile/'.$post['userid']) ?>"><img class="img-xs rounded-circle" src="<?php echo base_url().'uploads/profile_img/'.$post['photo']; ?>" alt=""></a>														
                                                <?php endif ?>
                                                <div class="ml-2">
                                                    <p> <a style="color:#686868" href="<?php echo base_url('publicprofile/'.$post['userid']) ?>"><?php echo $post['first_name'].' '.$post['last_name']; ?></a></p>
                                                    <p class="tx-11 text-muted"><?php echo timeAgo($post['created_at']); ?></p>
                                                </div>
                                            </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon-lg pb-3px" data-feather="more-horizontal"></i>
                                            </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                
                                                <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('publicprofile/'.$post['userid']) ?>"><i data-feather="meh" class="icon-sm mr-2"></i> <span class=""><?php if(!is_following($post['userid'])) echo 'Follow'; else echo 'UnFollow'?></span></a>
                                                <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('publicprofile/'.$post['userid']) ?>"><i data-feather="corner-right-up" class="icon-sm mr-2"></i> <span class="">View Profile</span></a>
                                                
                                                <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('detail/'.$post['postSlug']) ?>"><i data-feather="info" class="icon-sm mr-2"></i> <span class="">Go to post</span></a>
                                                <?php if($this->session->userdata('user_id') != $post['userid']): ?>
                                                <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('dashboard/messages/'.$post['userid']) ?>"><i data-feather="send" class="icon-sm mr-2"></i> <span class="">Send Message</span></a>
                                                <?php endif;?>
                                                
                                                <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('detail/'.$post['postSlug']) ?>"><i data-feather="share-2" class="icon-sm mr-2"></i> <span class="">Share</span></a>
                                                <?php $url =  base_url('detail/'.$post['postSlug'])?>
                                                <a class="copy_to_clipboard dropdown-item d-flex align-items-center" data-clipboard-text="
												<?php echo $url ?>"><i data-feather="copy" class="icon-sm mr-2"></i> <span class="">Copy Link</span></a>
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                         <?php if($post['em_video']):?>
                                       <?php /*?>  <div style="margin:0" class="fluid-width-video-wrapper"><?php echo convertYoutube($post['em_video']) ?>
                                         
                                         
                                         </div><?php */?>
                                         <a href="<?php echo base_url('detail/'.$post['postSlug']) ?>">
                                <div class="v_box">
                                <img class="img-fluid v_thumb" src="<?php echo base_url('uploads/cover_photo/'.$post['cover_photo']) ?>">
                                <span class="play_icon"><img src="<?php echo base_url() ?>landing_file/style2/you/youtube.svg"></span>
                                </div>
                            </a>
          <?php else: ?>
                                        <?php if(!empty($post['cover_photo'])):?>
                                            <a href="<?php echo base_url('detail/'.$post['postSlug']) ?>"><img class="img-fluid" src="<?php echo base_url('uploads/cover_photo/'.$post['cover_photo']); ?>" /></a>
                                        <?php else: ?>
                                            <a href="<?php echo base_url('detail/'.$post['postSlug']) ?>"><img class="img-fluid" src="<?php echo base_url('assets/images/placeholder.jpg')?>" /></a>
                                        <?php endif;?> 
                                        <?php endif;?>
                                        <div class="card_content set_eq_h mb-2">
                                   <strong><a href="<?php echo base_url('detail/'.$post['postSlug']) ?>" class="spotlight-title"><?php echo $post['postTitle']; ?></a></strong>
                                     </div>
                                    <div class="card_content mb-3 tx-14">
                                      <?php if(!empty($post['postContent'])){echo substr(strip_tags($post['postContent']), 0,100); } ?>
                                        </div>
                                         
                                    </div>
                                    <div class="card-footer">
		 <div class="d-flex post-actions">
          <?php if($post['likecount']>0){ 
                                $already_like= 'heartfill';
                             }else{ 
                                $already_like= '';
                             } ?>
                        <a href="javascript:;" class="like_count <?php echo $already_like; ?> d-flex align-items-center text-muted mr-4 " data-post-id="<?php echo trim($post['postID']) ?>">
                            
                                <i class="icon-md" data-feather="heart"></i>
                            
                            <p class="d-none d-md-block ml-2"><span class="like_count_data"><?php if(isset($post['likes']))
							 echo $post['likes']; else echo 0 ?></span> Like</p>
                        </a>
			<!-- <a href="javascript:;" class="d-flex align-items-center text-muted mr-4">
				 <i class="icon-md" data-feather="heart"></i>
				 <p class="d-none d-md-block ml-2">Like</p>
			 </a>-->
                 <a href="<?php echo base_url('detail/'.$post['postSlug']) ?>#comment" class="d-flex align-items-center text-muted mr-4">
                     <i class="icon-md" data-feather="message-square"></i>
                     <p class="d-none d-md-block ml-2">Comment</p>
                 </a>
                 <a href="javascript:;" data-a2a-url="<?php echo base_url('detail/'.$post['postSlug']) ?>" data-a2a-title="<?php echo $post['postTitle']?>" class=" a2a_dd d-flex align-items-center text-muted  ml-2">
                            <i class="icon-md" data-feather="share"></i>
                            <!-- AddToAny BEGIN -->
<!-- AddToAny END -->
                            <p class="d-none d-md-block ml-2">Share</p>
                        </a>
                 <?php /*?><a href="<?php echo base_url('detail/'.$post['postSlug']) ?>" class="d-flex align-items-center text-muted">
                     <i class="icon-md" data-feather="share"></i>
                     <p class="d-none d-md-block ml-2">Share</p>
                 </a><?php */?>
             </div>
         </div>
                                </div>
                            </div>
                        <?php endforeach;?>
                    
                    
                    
                </div> <!-- row -->
 <?php endif;?>
            
        </div>
    </div>
    
 <div class="modal" id="signup" role="dialog">
    <div class="modal-dialog">
    
   
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">×</span>
         </button>
          <div class="page-content22 register-form22">
          <div class="modal-body">
        <?php //print_r(site_detail())?>
              <?php if(special_cms()){ ?>
            <?php  $logo_settings = site_settings('logo_settings');
    if($logo_settings){
         $settings_array = json_decode($logo_settings); 
        if(isset($settings_array->logo2) && $settings_array->logo2) {
        echo '<div class="text-center mb-10"><a href="'.base_url().'"><img class="img-logooo" src="'.base_url().'assets/traslogo.png" style="max-width:250px" /></a></div>';
        }
         
    }?>
     <h4  class="ma_title text-center" style="margin-bottom:0"> JOIN THE MBN USA COMMUNITY</h4>
     <div class="color_boxx text-center">
    <p>Customize your MBN USA experience to get breaking news <br />impacting minority-owned businesses



</p>
</div>
            <h5 class="text-center">Sign up to receive free instant access to:</h5>
        <div class="row">    
        <div class="col-md-6">
        	<ul>
<li>MBN USA Quarterly Magazine </li>
           <li>Resource for MBE Suppliers </li>
            <li>Customer Acquisition Education  </li>
</ul>
        </div>
         <div class="col-md-6">
        	<ul>
 <li>Networking Opportunities</li>
             <li>Supplier Diversity Strategies</li>
             <li>MBE Professional Development</li>
</ul>
        </div>             
</div>
            <?php } ?>
           <div class="row">
              <div class="col-md-12">
                 <div class="card2">
            
                    <div class="auth-form-wrapper">
                       <form id="register" method="post" action="<?php echo base_url('register') ?>" class="forms-sample">
                          <?php if(validation_errors()){ ?>
                          <div class="alert alert-danger"><?php echo validation_errors(); ?></div>
                         <?php } ?>
                          <div class="row">
                             <div class="col-md-6">
                                <div class="form-group">
                                  <?php /*?> <label for="first_name">First Name <span class="redstar">*</span></label><?php */?>
                                   <input type="text" value="<?php echo set_value('first_name');?>" required="required" name="first_name" class="form-control" id="first_name" autocomplete="off" placeholder="First Name">
                                </div>
                             </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                   <?php /*?><label for="last_name">Last Name <span class="redstar">*</span></label><?php */?>
                                   <input type="text" required="required"   value="<?php echo set_value('last_name');?>" name="last_name" class="form-control" id="last_name"  autocomplete="off" placeholder="Last Name">
                                </div>
                             </div>
                          </div>
                          <!-- row -->
                          <div class="form-group">
                             <?php /*?><label for="email">Email <span class="redstar">*</span></label><?php */?>
                             <input type="email" class="form-control" name="email" value="<?php echo set_value('email');?>" required="required" id="email" autocomplete="off" placeholder="Email address">
                                <span class="text-danger"><?php //echo $this->session->flashdata('Error'); ?></span>
                          </div>
                          <div class="row">
                             <div class="col-md-6">
                                <div class="form-group">
                                  <?php /*?> <label for="password">Password <span class="redstar">*</span></label><?php */?>
                                   <input type="password" name="password" required="required" value="<?php echo set_value('password');?>" class="form-control" id="password" autocomplete="off" placeholder="Password">
                                </div>
                             </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                  <?php /*?> <label for="confirm_password">Confirm Password <span class="redstar">*</span></label><?php */?>
                                   <input type="password" name="confirm_password"  value="<?php echo set_value('confirm_password');?>" required="required" class="form-control" id="confirm_password" aautocomplete="off" placeholder="Confirm Password">
                                </div>
                             </div>
                          </div>
                          <div class="row">
                          <div class="col-md-12">
                                <div class="form-group">
                                  <?php /*?> <label for="password">Password <span class="redstar">*</span><?php */?>
                                   <span><input type="checkbox" name="terms" required="required"> I agree to the <a target="_blank" href="<?php echo base_url('home/terms_conditions')?>">terms of use.</a></span>
                                   </div>
                                </div>
                             </div>

                          
                        
                          <p>
                             <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                          </p>
                          <p class="text-muted text-center">OR</p>
                          <p>   <a class="btn btn-block btn-social btn-facebook" href="<?php echo get_option('social_url').'/hauth/window/Facebook?site_id='.site_id() ?>" style="background: #3b5998; color: #fff !important;">
                             Sign in with Facebook
                             </a>
                          </p>
                          <p class="color_textt text-center">Already a user? <a href="<?php echo base_url('login') ?>" class="">Sign in</a></span>
                       </form>
                    </div>
                 </div>
              </div>
           </div>
          
           </div>
           <div class="modal-footer">
          
<p class="tex">Powered by QmeLocal</p>
        </div>
        </div>
      </div>
      
    </div>
  </div>
<script type="text/javascript">
$(function(){ // document ready

    $("a").filter(function () {
        return this.hostname && this.hostname !== location.hostname;
    }).each(function () {
        $(this).attr({
            target: "_blank",
            title: "Visit " + this.href + " (click to open in a new window)"
        });
    });

});
$(document).ready(function () {
	$('.page-content #show_comment').on('click touchstart', function (e) {
		//e.prevent.default();
		//alert('ddddddddddd')
		$('#comment_list').toggle();
		});
	 });
</script>
<script type="text/javascript">
$(document).ready(function(){
     $("#carouselExampleIndicators").carousel({
         interval : 4000,
         pause: false
     });
});
</script>
 <?php if(special_cms()){ ?>
<?php $user_id = $this->session->userdata('user_id'); 
if($user_id){
}else{?>

<script type="text/javascript">
$(window).on('load',function(){
    var delayMs = 20000;
	
	//30000; // delay in milliseconds
    
    setTimeout(function(){
        $('#signup').modal('show');
    }, delayMs);
});  
</script>
       <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js"></script>
 <script>
jQuery( "#register" ).validate({
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
<?php } ?>
<?php } ?>