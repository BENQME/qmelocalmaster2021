<!DOCTYPE html>
<html lang="en">
   <?php $this->load->view('enduser/layouts/partials/header'); ?>
   <style>
   #recommend_btn{text-transform:capitalize}
   .btn-icon-prepend p{display:none}
   #photoUpload:hover  .btn-icon-prepend p{display:block}
   </style>
   <body>
      <div class="main-wrapper">	
      		<?php
		 $user_level = $this->session->userdata('user_level');
			if(isset($user_level) &&  $user_level ==1){
				$this->load->view('admin/layouts/partials/dheader');
			}elseif(isset($user_level) &&  $user_level ==3){
				$this->load->view('superadmin/layouts/partials/dheader');
			}else{
			$this->load->view('enduser/layouts/partials/dheader');
			}
		
		
		  ?>
      	<div class="page-wrapper">
		<div class="page-content">
		<?php if($sucesess = $this->session->flashdata('sucesess')): ?>
            <div class="alert alert-success" role="alert">
             <?php echo $sucesess ?>
            </div>
        <?php endif ?>
	<div class="profile-page tx-13">
	  <div class="row">
      <?php //print_r($publicuserinfo)
	  
	   ?>
      <?php $user_profile = $this->db->get_where('user_profile',array('user_id'=>$publicuserinfo->userID))->row(); ?>
		<div class="col-12 grid-margin">
						<div class="profile-header">
							<div class="cover">
								<div class="gray-shade2"></div>
								<figure>
                                
                                
                                 <?php if($publicuserinfo->userID == $this->session->userdata('user_id')) { ?>
                                    <div class="loader cover_loader" style="display:none"></div>
                                    <form id="photoUpload" action="<?php echo base_url('dashboard/uploads?type=cover'); ?>" method="post" enctype="multipart/form-data">
                                        <div data-provides="fileupload" class="btn btn-file fileupload fileupload-new userImage" style="padding:0">
                                            <div class="fileupload-new" style="overflow:hidden">
                                               
                                                    <div class="rounded" style="width:100%;overflow:hidden">
                                                      <div class="btn-icon-prepend">
                                                      <i data-feather="edit" class=""></i>
                                                      <p style="color: #FFFFFF;
    z-index: 2;
    position: relative;">(Recommended image size is "Width: 1148px and Height: 272px")</p>
                                                      </div>
                                                        <img id="userfile_preview" src="
														<?php if($publicuserinfo->cover)echo base_url('uploads/covers/' .$publicuserinfo->
cover);else echo 'https://via.placeholder.com/1148x272' ?>" class="img-fluid"/>
                                                        <input onchange="readPhoto(this, 'userfile_preview');" type="file" name="userfile" accept="image/*" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="gray-shade2"></div>
                                    </form>
                                <?php }else{ ?>
                                	<?php if(!empty($publicuserinfo->cover)) { ?>
                                        <div class="btn btn-file " style="padding:0">
                                            <div class="" style="overflow:hidden">
                                               
                                                    <div class="rounded" style="width:100%;overflow:hidden">
                                                        <img id="userfile_preview" src="
														<?php if($publicuserinfo->cover)echo base_url('uploads/covers/' .$publicuserinfo->
cover);else echo 'https://via.placeholder.com/1148x272' ?>" class="img-fluid"/>
                                                        
                                                </div>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                    <img src="https://via.placeholder.com/1148x272" class="img-fluid" alt="profile cover">
                                    <?php } ?>
                                <?php  }?>
									
								</figure>
								<div class="cover-body d-flex justify-content-between align-items-center">
									<div class="flxx_div">
                                      <?php if(isset($publicuserinfo) && ($publicuserinfo->userID == $this->session->userdata('user_id'))) { ?>
                                       <div class="img_box">
                                      <img class="profile-pic" src="
									  <?php if($publicuserinfo->photo)echo base_url('uploads/profile_img/').$publicuserinfo->photo; else echo base_url('uploads/profile_img/def.jpg');  ?>
" alt="profile"> 
                                      <div class="abs_icon">
                                       <a class="" data-toggle="modal" data-target="#profile_pic" href="#"><i class="fa fa-pencil"></i></a>
                                      
                                       </div>
                                       </div>
                                    <?php } else { ?>
										<img class="profile-pic" src="<?php if($publicuserinfo->photo)echo base_url('uploads/profile_img/').$publicuserinfo->photo; else echo base_url('uploads/profile_img/def.jpg');  ?>" alt="profile">
                                        <?php } ?>
										<span style="float: right;
    margin-top: 29px;
    line-height: 1;" class="profile-name">
	 <?php 
					 $full_name =$publicuserinfo->first_name.' '.$publicuserinfo->last_name;
					 if (strlen($full_name) > 25)
						{
							echo substr($full_name, 0, 25)."...";
						}
						else
						{
							echo $full_name;
						}
?>
	
	<?php //echo $publicuserinfo->first_name.' '.$publicuserinfo->last_name; ?>
                                        <br>
                                        <em style="font-size:12px">
                                       <?php
									 if(isset($user_profile->designation) && $user_profile->designation) echo '('.$user_profile->designation.')'; else echo $publicuserinfo->title; 
									 ?></em>
                                        </span>
                                         <span class="designation"></span>
									</div>
									<div class="d-none2 d-md-block">
										<button class="btn btn-primary btn-icon-text btn-edit-profile btn-white">
											<i data-feather="user-check" class="btn-icon-prepend"></i> <?php echo followers_count($publicuserinfo->userID) ?>
									   </button>
										<?php 
										$user_id = $this->session->userdata('user_id');
										if($user_id && ($user_id != $publicuserinfo->userID)){
										$data =  $this->db->where(array('is_following'=>$publicuserinfo->userID,'userID'=>$user_id))->from('followers')->get()->row() ?>
										<button id="fallow_btn" data-fallow-id="<?php echo $publicuserinfo->userID ?>" class="btn btn-primary btn-recommended_business btn-icon-text btn-edit-profile<?php if(isset($data) && $data) echo ' followed' ?>">
											 <?php if(isset($data) && $data) echo 'Following';else echo 'Follow'  ?>
										</button>
                                       
                                        <?php //echo $recomended ?>
                                        <button id="recommend_btn" data-recommend-id="<?php echo $publicuserinfo->userID ?>" class="btn btn-primary btn-recommended_business btn-icon-text btn-edit-profile<?php if(isset($recomended) && $recomended) echo ' recommended' ?>">
											 <?php if(isset($recomended) && $recomended) echo 'Recommended';else echo 'Recommend this business'  ?>
										</button>
                                        
                                         <button id="review_btn" data-toggle="modal" data-target="#review_model" class="btn btn-primary btn-recommended_business btn-icon-text btn-edit-profile<?php if(isset($user_review) && $user_review) echo ' reviewed' ?>">
											 <?php if(isset($user_review) && $user_review) echo 'Edit Your Review';else echo 'Write a Review'  ?>
										</button>
                                         <a  href="<?php echo base_url().'dashboard/messages/'.$publicuserinfo->userID; ?>" class="btn btn-primary btn-recommended_business btn-icon-text btn_send_msg">
											 Send Message
										</a>
                                        <?php } ?>
                                        

										
									</div>
								</div>
							</div>
							<div class="header-links">
								<ul class="links d-flex align-items-center mt-3 mt-md-0">
                                <?php //echo $this->uri->segment(1) ?>
                                <li class="header-link-item d-flex align-items-center">
										<i class="mr-1  icon-md" data-feather="home"></i>
										<a class="pt-1px  d-md-block" href="<?php echo base_url('home') ?>">Home</a>
									</li>
									<li c class="header-link-item ml-3 pl-3 border-left d-flex align-items-center
									  <?php if(($this->uri->segment(1) == 'publicprofile') && !$this->uri->segment(3)) echo ' active' ?> ">
										<i class="mr-1  icon-md" data-feather="columns"></i>
										<a class="pt-1px  d-md-block" href="<?php echo base_url('publicprofile/'.$publicuserinfo->userID) ?>">About my Business</a>
									</li>
									 <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center <?php if($this->uri->segment(2) =='news') echo ' active' ?>">
										<i class="mr-1 icon-md" data-feather="file-text"></i>
										<a class="pt-1px  d-md-block" href="<?php echo base_url('publicprofile/news/'.$publicuserinfo->userID) ?>">News/Blog <span class="text-muted tx-12">(<?php if(isset($total_posts_news))echo $total_posts_news; else echo 0 ?>)</span></a>
									</li>
									 <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center <?php if($this->uri->segment(2) =='jobs') echo ' active' ?>">
										<i class="mr-1 icon-md" data-feather="briefcase"></i>
										<a class="pt-1px  d-md-block" href="<?php echo base_url('publicprofile/jobs/'.$publicuserinfo->userID) ?>">Jobs <span class="text-muted tx-12">(<?php if(isset($total_posts_jobs))echo $total_posts_jobs; else echo 0 ?>)</span></a>
									</li>
									<li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center <?php if($this->uri->segment(2) =='events') echo ' active' ?>">
										<i class="mr-1  icon-md" data-feather="calendar"></i>
										<a class="pt-1px  d-md-block" href="<?php echo base_url('publicprofile/events/'.$publicuserinfo->userID) ?>">Events <span class="text-muted tx-12">(<?php if(isset($total_posts_events))echo $total_posts_events; else echo 0 ?>)</span></a>
									</li>
                                    <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center <?php if($this->uri->segment(2) =='media') echo ' active' ?>">
										<i class="mr-1  icon-md" data-feather="calendar"></i>
										<a class="pt-1px  d-md-block" href="<?php echo base_url('publicprofile/media/'.$publicuserinfo->userID) ?>">Media /Podcast <span class="text-muted tx-12">(<?php if(isset($total_posts_media))echo $total_posts_media; else echo 0 ?>)</span></a>
									</li>
									<li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
										<i class="mr-1 icon-md" data-feather="bookmark"></i>
										<a class="pt-1px  d-md-block" href="<?php echo base_url('publicprofile/promotion/'.$publicuserinfo->userID) ?>">General Spotlights <span class="text-muted tx-12">(<?php if(isset($total_posts_promotion))echo $total_posts_promotion; else echo 0 ?>)</span></a>
									</li>

									<?php /*?><li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
										<i class="mr-1 icon-md" data-feather="archive"></i>
										<a class="pt-1px d-none d-md-block" href="#">My Activities <span class="text-muted tx-12">(34)</span></a>
									</li> <?php */?>

									
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="row profile-body">
					<!-- left wrapper start -->
					<?php /*?><div class="d-none d-md-block col-md-4 col-xl-3 left-wrapper">
						<div class="card rounded">
							<div class="card rounded">
    <div class="card-body">
        <?php if($publicuserprofileinfo->about): ?>
        <div class="">
            <label class="tx-11 font-weight-bold mb-0 text-uppercase">About <?php echo $publicuserinfo->first_name; ?>:</label>
            <p class="text-muted"><?php echo $publicuserprofileinfo->about; ?></p>
        </div>
        <?php endif;?>
       
        <?php if(isset($publicuserprofileinfo->preferences)): ?>
            <div class="mt-3">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Preference:</label>
                <p class="text-muted"><?php  $preference_arr = json_decode($publicuserprofileinfo->preferences); echo implode(', ', $preference_arr) ?></p>
            </div>
         <?php elseif($publicuserinfo->level !=0): ?>
         <?php
		 
		 
		  $categories = $this->db->select('*')->from('spotlights_category')->get()->result(); //print_r($categories) ?>
          <?php if($categories){
			  foreach($categories as $cat){
				  $cat_array[] =$cat->categoryTitle;
			  }
		  }?>
         <div class="mt-3">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">Preference:</label>
                <p class="text-muted"><?php  echo implode(', ', $cat_array) ?></p>
            </div>
		<?php endif?>
        <?php $count_review = $this->db->get_where('reviews',array('user_id'=>$publicuserinfo->userID,'type'=>'review'))->num_rows() ?>
        <div class="mt-3">
            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Reviews:</label>
            <p class="text-muted">
            <a  data-toggle="modal" data-target="#all_reviews" href="#">
			<?php if($count_review) echo str_pad($count_review, 2, '0', STR_PAD_LEFT);else echo '0' ?></a></p>
        </div>
         <?php $count_recommend = $this->db->get_where('reviews',array('user_id'=>$publicuserinfo->userID,'type'=>'recommend'))->num_rows() ?>
        <div class="mt-3">
            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Recommandations:</label>
            <p class="text-muted">
			<a  data-toggle="modal" data-target="#all_recommandations" href="#">
			<?php if($count_recommend) echo str_pad($count_recommend, 2, '0', STR_PAD_LEFT);else echo '0' ?></a></p>
        </div>
        <?php if($publicuserprofileinfo->business_email): ?>
        <div class="mt-3">
            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Business Email:</label>
            <p class="text-muted"><a href="mailto:<?php echo $publicuserprofileinfo->business_email; ?>"><?php echo $publicuserprofileinfo->business_email; ?></a></p>
        </div>
        <?php endif ?>
         <?php if($publicuserprofileinfo->business_email): ?>
        <div class="mt-3">
            <label class="tx-11 font-weight-bold mb-0 text-uppercase">Website:</label>
            <p class="text-muted"><a target="_blank" href="<?php echo $publicuserprofileinfo->website; ?>"><?php echo $publicuserprofileinfo->website; ?></a></p>
        </div>
        <?php endif ?>
        <div class="mt-3 d-flex social-links">
            <?php if($publicuserprofileinfo->twitter): ?>
            <a target="_blank" href="<?php echo $publicuserprofileinfo->twitter; ?>" class="btn d-flex align-items-center justify-content-center border mr-2 btn-icon twitter">
          
                <i data-feather="twitter" data-toggle="tooltip" title="Twitter"></i>
            </a>
              <?php endif ?>
              <?php if($publicuserprofileinfo->instagram): ?>
            <a href="<?php echo $publicuserprofileinfo->instagram; ?>" class="btn d-flex align-items-center justify-content-center border mr-2 btn-icon instagram">
                <i data-feather="instagram" data-toggle="tooltip" title="Instagram"></i>
            </a>
             <?php endif ?>
              <?php if($publicuserprofileinfo->facebook): ?>
            <a href="<?php echo $publicuserprofileinfo->facebook; ?>" class="btn d-flex align-items-center justify-content-center border mr-2 btn-icon facebook">
                <i data-feather="facebook" data-toggle="tooltip" title="Facebook"></i>
            </a>
            <?php endif ?>
        </div>
    </div>
</div>
						</div>
					</div><?php */?>
					<!-- left wrapper end -->
					<!-- middle wrapper start -->
					<div class="col-md-12 col-xl-12 middle-wrapper">
						
						<div class="row set-card-spacing">
							
							<div class="col-md-12 grid-margin">
									  <?php echo $page_content ?>
							</div>
						  </div>

					</div>
					<!-- middle wrapper end -->
					<!-- right wrapper start -->
					<?php /*?><div class="d-none d-xl-block col-xl-3 right-wrapper">
						<div class="row">	
							<?php if(count($spotlights_photo)>0): ?>
							<div class="col-md-12 grid-margin">
								<div class="card rounded">
									<div class="card-body">
										<h6 class="card-title">latest Spotlights</h6>
										<div class="latest-photos">
											<div class="row">
												<?php foreach($spotlights_photo as $pic): ?>
                                                <?php if($pix = $pic->cover_photo){ ?>
                                                    <div class="col-md-6">
                                                        <figure>
                                                          <a href="<?php echo base_url('detail/'.$pic->postSlug) ?>"> <img class="img-fluid" 
                                                            src="<?php echo base_url('uploads/cover_photo/'.$pix); ?>" alt="">
                                                            <span class="sodaa" style="text-align: center;
    display: block;
    margin-top: 7px;"><?php echo str_replace('Spotit Spotlight','General Spotlight',$pic->spotlight_type) ?></span>
                                                            </a>
                                                            
                                                        </figure>
                                                    </div>
                                                <?php } ?>
                                                <?php endforeach;?>
			
											</div>
										</div>
									</div>
								</div>
							</div>
                            <?php endif;?>
                            <?php $user_id = $this->session->userdata('user_id'); ?>
                            <?php if(($user_id && $user_id == $publicuserinfo->userID) && (isset($suggest_users) && count($suggest_users)>0)): //print_r($suggest_users) ?>
                                <div class="col-md-12 grid-margin suggest_sodaa" id="suggest_sodaa">
                                    <div class="card rounded">
                                        <div class="card-body">
                                            <h6 class="card-title">suggestions for you</h6>
                                            <?php foreach($suggest_users as $user): //print_r($user) ?>
                                            <?php //$already_followers = $this->db->where('is_following',$user['userID'])->from('followers')->get()->row();
											  if(!is_following($user['userID'])):
											 ?>
                                            <div class="d-flex justify-content-between mb-2 pb-2 border-bottom is_following_divv">
                                                <div class="d-flex align-items-center hover-pointer">
                                                    <img class="img-xs rounded-circle" src="<?php echo base_url().'uploads/profile_img/'.$user['photo']; ?>" alt="">													
                                                    <div class="ml-2">
                                                        <p><?php echo $user['first_name'] ?> <?php echo $user['last_name'] ?></p>
                                                        
                                                    </div>
                                                </div>
                                                <a href="<?php echo base_url('publicprofile/'.$user['userID']);?>" class="btn btn-icon"><i data-feather="user-plus" data-toggle="tooltip" title="Connect"></i></a>
                                            </div>
                                            <?php endif;?>
                                            <?php endforeach;?>
    
                                        </div>
                                    </div>
                                </div>
                            <?php endif;?>
                            <?php if(isset($review_list) && $review_list): ?>
                            <div class="col-md-12 grid-margin">
								<div class="card rounded">
									<div class="card-body">
										<h6 class="card-title">latest Reviews</h6>
										<div class="latest-photos">
											<div class="row">
												<?php $counter=1; foreach($review_list as $review): //print_r($review) ?>
                                                <div class="card2 rounded2 mb-15">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                             <div class="d-flex align-items-center">
                                                                <a href="<?php echo base_url('publicprofile/'.$review['review_by']);?>"> <img class="img-xs rounded-circle" src="<?php echo base_url().'uploads/profile_img/'.$review['photo']; ?>" alt=""></a>										
                                                                 <div class="ml-2">
                                                                     <p><?php echo $review['first_name'] ?> <?php echo $review['last_name'] ?></p>
                                                                     <p class="tx-11 text-muted"><?php echo timeAgo($review['date_time']) ?></p>
                                                                 </div>
                                                             </div>
                                                           <?php if(isset($review['ratings'])): ?>
                                                            <div class="d-flex align-items-right fix_star_color"><i data-feather="star" class="icon-sm"></i> <span class=""><?php echo $review['ratings'] ?></span></div>
                                                            <?php endif;?>
                                                         </div>
                                                         <?php if(isset($review['review_content'])): ?>
                                                         <div class="box_content mt-10">
                                                                             
                                                                         <div class="card_content mb-3 tx-14"><?php echo $review['review_content'] ?></div>
                                                                            
                                                                     </div>
                                                         <?php endif ?>
                                                     </div>
                                                 <?php if($counter==3) break; ?>
                                                 
                                                <?php $counter++; endforeach;?>
                <a data-toggle="modal" data-target="#all_reviews" href="#">
                View All</a>
											</div>
										</div>
									</div>
								</div>
							</div>
                            <?php endif;?>
						</div>
					</div><?php */?>
					<!-- right wrapper end -->
				</div>
		</div>

</div>


<div id="all_recommandations" class="modal fade" role="dialog">
  <div class="modal-dialog model-lg">

    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">

        <h5 class="modal-title">Recommandations</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>
      <div class="modal-body">
            <div class="latest-photos container">
            
                <?php if($recommend_list){ foreach($recommend_list as $recommend): //print_r($review) ?>
                <div class="row">
                    <div class="pb-15" style="
   width: 100%;
    margin: 10px 0;
">
                            <div class="d-flex align-items-center justify-content-between">
                                 <div class="d-flex align-items-center">
                                    <a href="<?php echo base_url('publicprofile/'.$recommend['review_by']);?>"> <img class="img-xs rounded-circle" src="<?php echo base_url().'uploads/profile_img/'.$recommend['photo']; ?>" alt=""></a>										
                                     <div class="ml-2">
                                         <p><?php echo $recommend['first_name'] ?> <?php echo $recommend['last_name'] ?></p>
                                         <p class="tx-11 text-muted"><?php echo timeAgo($recommend['date_time']) ?></p>
                                     </div>
                                 </div>
                             </div>
                             <?php if(isset($recommend['review_content'])): ?>
                             <div class="box_content mt-10">
                                                 
                                             <div class="card_content mb-3 tx-14"><?php echo $recommend['review_content'] ?></div>
                                                
                                         </div>
                             <?php endif ?>
                         </div>
                </div>
                <?php endforeach;
				}
				?>

           
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="all_reviews" class="modal fade" role="dialog">
  <div class="modal-dialog model-lg">

    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">

        <h5 class="modal-title">Reviews</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>
      <div class="modal-body">
            <div class="latest-photos container">
            
                <?php foreach($review_list as $review): //print_r($review) ?>
                <div class="row">
                    <div class="pb-15" style="
   width: 100%;
    margin: 10px 0;
">
                            <div class="d-flex align-items-center justify-content-between">
                                 <div class="d-flex align-items-center">
                                    <a href="<?php echo base_url('publicprofile/'.$review['review_by']);?>"> <img class="img-xs rounded-circle" src="<?php echo base_url().'uploads/profile_img/'.$review['photo']; ?>" alt=""></a>										
                                     <div class="ml-2">
                                         <p><?php echo $review['first_name'] ?> <?php echo $review['last_name'] ?></p>
                                         <p class="tx-11 text-muted"><?php echo timeAgo($review['date_time']) ?></p>
                                     </div>
                                 </div>
                               <?php if(isset($review['ratings'])): ?>
                                <div class="d-flex align-items-right fix_star_color"><i data-feather="star" class="icon-sm"></i> <span class=""><?php echo $review['ratings'] ?></span></div>
                                <?php endif;?>
                             </div>
                             <?php if(isset($review['review_content'])): ?>
                             <div class="box_content mt-10">
                                                 
                                             <div class="card_content mb-3 tx-14"><?php echo $review['review_content'] ?></div>
                                                
                                         </div>
                             <?php endif ?>
                         </div>
                </div>
                <?php endforeach;?>

           
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div id="profile_pic" class="modal fade" role="dialog">
  <div class="modal-dialog model-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <div class="card2">
            <div class="card-body">
            <div class="row"> 
                <div class="col-md-12 hide_loadd">
                    <img id="upload-demo" class="img-responsive" src="
                    
                     <?php if($publicuserinfo->photo):?>
                    <?php echo base_url('uploads/profile_img/'.$publicuserinfo->photo) ?>
                        <?php elseif($facebookUID = $publicuserinfo->facebookUID): ?>
                        <?php echo $facebookUID ?>
                        <?php else: ?>
                    <?php echo base_url('assets/images/placeholder.jpg')?>
                    <?php endif;?>" />
                </div>
               
                <div class="col-md-4 hide_this_always">
                    <div id="upload-demo-i" style=""><?php if($publicuserinfo->photo):?>
                    <img class="img-responsive" src="<?php echo base_url('uploads/profile_img/'.$publicuserinfo->photo) ?>" />
                    <?php endif ?>
                     </div>
                </div>
                
                 <div class="col-md-12">
                   <strong>Select Image:</strong>
                    <div class="row form-inline"> 
                       <div class="form-group col-md-8">
                        
                            <input type="file" id="upload" class="form-control">
                            </div>
                        <div class="form-group col-md-4">
                            <button class="btn btn-primary btn-success upload-result">Crop Image</button>
                        </div>
                       
                        
                        
               <div class="form-group">         
        <div id="loading" style="display:block"></div>
        </div>
        <br />
              
                    </div>
                </div>
                  
            </div>
            
            </div>
        
        
        
                     
        
                   </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<script type="text/javascript">
$( document ).ready(function() {
    $('#profile_pic .hide_loadd').hide();
	$('#profile_pic .hide_this_always').hide();
	
});  
$uploadCrop = $('#profile_pic #upload-demo').croppie({
    enableExif: false,
    viewport: {
        width: 250,
        height: 250,
    },
    boundary: {
        height: 300
    }
});
     
$('#profile_pic #upload').on('change', function () { 
$('#profile_pic .hide_loadd').show()
	var reader = new FileReader();
    reader.onload = function (e) {
    	$uploadCrop.croppie('bind', {
    		url: e.target.result
    	}).then(function(){
    		console.log('jQuery bind complete');
    	});
    	    
    }
    reader.readAsDataURL(this.files[0]);
});
     
$('#profile_pic .upload-result').on('click', function (ev) {
	ev.preventDefault();
	$uploadCrop.croppie('result', {
		type: 'canvas',
		size: 'viewport'
	}).then(function (resp) {
     
		$.ajax({
			url: "<?php echo base_url() ?>login/ajax_img_upload",
			type: "POST",
			data: {"image":resp},
			 beforeSend: function(){
				 $('#loading').html('Uploading....');
				 $('.upload-result').hide();
				
			},
			success: function (data) {
			      location.reload();
				//('#profile_pic .hide_this_always').show();
				 $('#loading').hide();
				  $('.upload-result').show();
				html = '<img src="' + resp + '" />';
				$("#upload-demo-i").html(html);
			}
		});
	});
});
    
</script>

		
		
        <?php $this->load->view('enduser/layouts/partials/dfooter'); ?>
        </div>
      </div>
      <?php $this->load->view('enduser/layouts/partials/footer'); ?>
   </body>
</html>