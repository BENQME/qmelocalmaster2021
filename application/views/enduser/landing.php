<style>
.inner-box h5{text-transform:uppercase}
.fa-sort-desc {
    top: 5px;
    font-size: 24px !important;
}

.zaati_select {

  /* styling */
  background-color: white;
  border: thin solid blue;
  border-radius: 4px;
  display: inline-block;
  font: inherit;
  line-height: 1.5em;
  padding: 0.5em 3.5em 0.5em 1em;

  /* reset */

  margin: 0;      
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  -webkit-appearance: none;
  -moz-appearance: none;
}


/* arrows */
.zaati_select.classic {
  background-image:
    linear-gradient(45deg, transparent 50%, blue 50%),
    linear-gradient(135deg, blue 50%, transparent 50%),
    linear-gradient(to right, skyblue, skyblue);
  background-position:
    calc(100% - 20px) calc(1em + 2px),
    calc(100% - 15px) calc(1em + 2px),
    100% 0;
  background-size:
    5px 5px,
    5px 5px,
    2.5em 2.5em;
  background-repeat: no-repeat;
}

.zaati_select.classic:focus {
  background-image:
    linear-gradient(45deg, white 50%, transparent 50%),
    linear-gradient(135deg, transparent 50%, white 50%),
    linear-gradient(to right, gray, gray);
  background-position:
    calc(100% - 15px) 1em,
    calc(100% - 20px) 1em,
    100% 0;
  background-size:
    5px 5px,
    5px 5px,
    2.5em 2.5em;
  background-repeat: no-repeat;
  border-color: grey;
  outline: 0;
}

.trending-activites .thumbnail .caption p a{color:#36a4f7}


.zaati_select.round {
  background-image:
    linear-gradient(45deg, transparent 50%, gray 50%),
    linear-gradient(135deg, gray 50%, transparent 50%),
    radial-gradient(#ddd 70%, transparent 72%);
  background-position:
    calc(100% - 20px) calc(1em + 2px),
    calc(100% - 15px) calc(1em + 2px),
    calc(100% - .5em) .5em;
  background-size:
    5px 5px,
    5px 5px,
    1.5em 1.5em;
  background-repeat: no-repeat;
}

.zaati_select.round:focus {
  background-image:
    linear-gradient(45deg, white 50%, transparent 50%),
    linear-gradient(135deg, transparent 50%, white 50%),
    radial-gradient(gray 70%, transparent 72%);
  background-position:
    calc(100% - 15px) 1em,
    calc(100% - 20px) 1em,
    calc(100% - .5em) .5em;
  background-size:
    5px 5px,
    5px 5px,
    1.5em 1.5em;
  background-repeat: no-repeat;
  border-color: green;
  outline: 0;
}

.proommo_wraper{padding-bottom: 40px;}



.zaati_select.minimal {
    background-image: linear-gradient(45deg, transparent 50%, gray 50%), linear-gradient(135deg, gray 50%, transparent 50%), linear-gradient(to right, #ccc, #ccc);
    background-position: calc(100% - 19px) calc(1em + 7px), calc(100% - 14px) calc(1em + 7px), calc(100% - 2.5em) 0.5em;
    background-size: 12px 7px, 5px 8px, 0px 1.5em;
    background-repeat: no-repeat;
}


.zaati_select:-moz-focusring {
  color: transparent;
  text-shadow: 0 0 0 #000;
}
.download_area img {
    max-width: 100%;
    width: 215px;
	margin-bottom:10px;
}
.download_area a {
    margin: 0 12px;
}
.header-banner {
    padding-bottom: 150px;

}
.header-banner h4 {
    font-family: 'Overpass-SemiBold';
    line-height: 1.3;
    text-transform: uppercase;
    font-size: 20px;
}
.header-banner {
    padding: 6% 0;
}
.navbar{border-radius:0}

/*Promo box*/
.proommo_wraper{
    background-color: rgba(90, 211, 206, 1);
}
.promo-box h4{font-family: 'Overpass-Bold'; font-size:19px; font-weight:800;line-height: 1.3;}
.promo-box {
    display: flex;
    flex-wrap: wrap;
    overflow: hidden;
    position: relative;
    padding: 10px 18px;
    min-height: 400px;
    margin-bottom: 40px;
}
.promo-box .promo-box-bg {
    opacity: 1;
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background-size: cover;
    z-index: 1;
    background-repeat: no-repeat;
    background-position: top;
    background-color: #5d17eb;
    backface-visibility: hidden;
    transition: transform 1s ease,opacity .5s ease .25s;
}
.promo-box .inner {
    position: relative;
    text-align: left;
    color: #fff;
    z-index: 10;
    padding: 0;
    width: 100%;
    align-self: flex-end;
	margin-bottom:30px;
}
.promo-box:hover .inner {
    align-self: center;
}
.promo-box .heading-wrapper {
    transform: translateY(0px);
    transition: opacity .65s cubic-bezier(.05,.2,.1,1),transform .65s cubic-bezier(.05,.2,.1,1);
}
.promo-box:hover .promo-box-bg {
    transform: scale(1.3);
    transition: transform 1s cubic-bezier(.1,.2,.7,1);
}

.promo-box:before {
    content: '';
    display: block;
    position: absolute;
    bottom: 0;
    left: 0;
    width: calc(100% + 10px);
    height: 100%;
    z-index: 10;
    opacity: 0;
    transition: opacity .65s cubic-bezier(.05,.2,.1,1);
}
.promo-box:before {
    background: #431D8D;
}
/*.prommoo_box .filter{padding-left:10px; padding-right:10px}*/
.promo-box:hover:before {
    opacity: 1;
}
.promo-box .promo-box-bg:before {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 85%;
    display: block;
    z-index: 10;
    content: '';
    background: linear-gradient(to bottom,rgba(15,15,15,0),rgba(15,15,15,.4) 100%);
    transition: opacity .65s cubic-bezier(.05,.2,.1,1);
}

.promo-box p{font-size:15px}
.promo-box .onhover-content{display:none;}
.promo-box:hover .short_description{display:none;}
.promo-box:hover .onhover-content{display:block;}
/*end of promo box*/
</style>

 <?php if(isset($banner_settings) && $banner_settings): $banner_settings  = json_decode($banner_settings)?>
      <div class="header-banner" <?php if(isset($banner_settings->b_image)): ?> style="background:url(<?php echo base_url().'uploads/banners/'.$banner_settings->b_image ?>);     background-size: cover;
    background-position: center;"<?php else: ?> style="background:#431D8D"<?php endif ?>>
         <div class="container">
             <div class="row">
                    <div class="col-md-6">
                        <?php if(isset($banner_settings->b_title) && $banner_settings->b_title): ?>
                            <h1 class=" wow fadeInUp"><?php echo $banner_settings->b_title ?></h1>
                        <?php endif;?>
                        <?php if(isset($banner_settings->sub_title)): ?>
                        <h4 class="wow fadeInDown" data-wow-delay="0.2s"><?php echo $banner_settings->sub_title ?></h4>
                        <?php endif;?>
                    </div>
                </div>
            <?php /*?><div class="registarArea wow fadeInUp" data-wow-delay="0.3s">
               <form class="form-inline" action="<?php base_url() ?>/home/main_search">
                  <div class="form-group">
                     <input type="text" name="search" class="form-control customInput" id="email" placeholder="Enter a keyword">
                  </div>
                  <div class="form-group">
                     <div class="styled-select">
                        <select name="spotlight_type" class="zaati_select minimal">
                           <option value="">Select a main category</option>
                           <option value="news">Media/News</option>
                           <option value="jobs">Jobs</option>
                           <option value="events">Events</option>
                            <option value="spotit">General Spotlight</option>
                        </select>
                     </div>
                  </div>
                  <button type="submit" class="btn nextBtn">Search</button>
               </form>
            </div><?php */?>
           <?php /*?> <div class="download_area row text-center" style="margin-top:8%">
            	<a target="_blank" href="https://play.google.com/store/apps/details?id=com.steelton.app"><img src="<?php echo base_url('landing_file/images/android.png') ?>" /></a>
                <a data-toggle="modal" data-target="#ios_popup" href="#"><img src="<?php echo base_url('landing_file/images/ios.png') ?>" /></a>
            </div>
            <!--register-->
            <div class="rounded wow fadeInDown">
               <i class="fa fa-circle"></i>
            </div><?php */?>
         </div>
         <!-- container -->
      </div>
      <?php endif;?>
      
      
    <div class="trending-activites proommo_wraper">
      <div class="container">
        <div class="row activities-content">
         <div class="col-md-8">
          <h4 class="wow fadeInUp">A local focused digital business resource environment that enables local collective to work together, sharing, contributing, with everyone doing their part to make communities better.
</h4>
          <h1 class="wow fadeInDown" data-wow-delay="0.1s">Join your local community</h1>
          </div>
        </div>
        <div class="row flexx_boxx prommoo_box">
          <div class="col-md-3 col-sm-6 filter">
            <div class="promo-box">
              <div class="promo-box-bg" style="background-image: url(<?php echo base_url('benifit/1.jpg') ?>);"></div>
              
              <div class="inner">
                <div class="heading-wrapper">
                  <h4>EVERYTHING IN ONE PLACE.</h4>
                </div>
                 <div class="short_description">
                
                <p>Access all of your business resources in one place...
</p>

                </div>
                <div class="onhover-content">
                
                <p>Access all of your business resources in one place. Connect with everyone and everything you need to propel your business growth; business advisors, access to capital, digital resources, branding, accounting, career opportunities, coworking and more.
</p>

                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 filter">
            <div class="promo-box">
              <div class="promo-box-bg" style="background-image: url(<?php echo base_url('benifit/2.jpg') ?>);"></div>
              <div class="inner">
                <div class="heading-wrapper">
                  <h4>INSTANTLY CREATE & CONNECT</h4>
                </div>
                 <div class="short_description">
                
                <p>Tap into our city by creating and engaging with...
</p>

                </div>
                <div class="onhover-content">
                
                <p>Tap into our city by creating and engaging with local jobs postings, events, local business news, podcasts, videos, coupons, give and receive reviews. Share what drives, inspires, and empowers you with the community you love.
</p>

                </div>
              </div>
            </div>
          </div>
          
          <div class="col-md-3 col-sm-6 filter">
            <div class="promo-box">
              <div class="promo-box-bg" style="background-image: url(<?php echo base_url('benifit/3.jpg') ?>);"></div>
              <div class="inner">
                <div class="heading-wrapper">
                  <h4>ENGAGE WITH THOSE WHO MATTER</h4>
                </div>
                <div class="short_description">
                
                <p>Network and engage with those who matter through...
</p>

                </div>
                <div class="onhover-content">
                
                <p>Network and engage with those who matter through instant messenger, product reviews, service referrals. Interact with top consultants, advisors, and small business leaders through one local digital opportunity network hub created to help your growth.

</p>

                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 filter">
            <div class="promo-box">
              <div class="promo-box-bg" style="background-image: url(<?php echo base_url('benifit/4.jpg') ?>);"></div>
              <div class="inner">
                <div class="heading-wrapper">
                  <h4>AN EQUITABLE & INCLUSIVE ECONOMY</h4>
                </div>
                <div class="short_description">
                
                <p>A diverse, inclusive, and equitable local...
</p>

                </div>
                <div class="onhover-content">
                
                <p>A diverse, inclusive, and equitable local opportunity network hub; Through one digital platform, you will be able to connect with local environmental, social, governance (ESG) leaders, each focused on empowering sustainability community building/change within our local business community
</p>

                </div>
              </div>
            </div>
          </div>
           <div class="col-md-12">
                <p class="row text-center wow fadeInUp">
                   <a href="<?php echo base_url('register') ?>" class="btn nextBtn">Join Community</a>
                </p>
            </div>
        </div>
      </div>
    </div>

    
    
      <?php if($admin_spotlights = site_settings('admin_spotlights')): ?>
      <?php $admin_spotlights =json_decode($admin_spotlights) 
	  
	  ?>
          <div class="trending-activites">
             <div class="container">
                <div class="row activities-content">
                   <div class="col-sm-6">
                      <h4 class="wow fadeInUp"><?php echo site_info() ?></h4>
                      <h1 class="wow fadeInDown" data-wow-delay="0.1s">Featured  Activities</h1>
                   </div>
                   <?php /*?><div class="col-sm-6">
                      <div class="category-list">
                         <a class="filter-button" data-filter="all">All</a>
                         <a class="filter-button" data-filter="news-blog">Media/News</a>
                         <a class="filter-button" data-filter="jobs">Jobs</a>
                         <a class="filter-button" data-filter="real-estate">Real Estate</a>
                         <a class="filter-button" data-filter="events">Events</a>
                      </div>
                   </div><?php */?>
                </div>
                <!-- row -->
                <br />
                <div class="row flexx_boxx">
                   <?php
				   $flag = false;
				    foreach($admin_spotlights as $spt_id):
				   //print_r($spt_id);
				   
						$ss = $this->db->get_where('spotlights',array('postID'=>$spt_id->label))->row();
						if($ss):
						$flag = true;
						?>
                       <div class="col-sm-4 filter">
                          <div class="thumbnail ">
                           <?php if($ss->em_video):?>
                           
                           <?php echo convertYoutube($ss->em_video, (array)$ss) ?>
                           
                    <?php else: ?>
                    
                           <a href="<?php echo base_url('detail/'.$ss->postSlug) ?>" class="" >
                             <?php if(!empty($ss->cover_photo)):?>
							<img class="img-fluid" src="<?php echo base_url('uploads/cover_photo/'.$ss->cover_photo); ?>" />
						<?php else: ?>
							<img class="img-fluid" src="<?php echo base_url('assets/images/placeholder.jpg')?>" />
						<?php endif;?>
                        </a> 
                        <?php endif;?>
                             <div class="caption">
                             <?php //print_r($ss) ?>
                                <span class="badge badge-secondary2"><?php echo $ss->category ?></span>
                                <h4 class="ellipsis"><?php echo $ss->postTitle; ?></h4>
                                <p><a href="<?php echo base_url('detail/'.$ss->postSlug) ?>" class="" >READ MORE</a></p>
                             </div>
                          </div>
                          <!-- blog-box -->
                       </div>
                       <?php endif; ?>
                   <?php endforeach;?>
                </div>
                <?php if($flag): ?>
                <p class="text-center wow fadeInUp">
                   <a href="<?php echo base_url('login') ?>" class="show-more">SHOW MORE</a>
                </p>
                <?php endif;?>
             </div>
          </div>
      <?php endif;?>
      <?php if($spotlight_all): ?>
          <div class="trending-activites" style="padding-top:0; padding-bottom:30px">
             <div class="container">
                <div class="row activities-content">
                   <div class="col-sm-6">
                      <h4 class="wow fadeInUp"><?php echo site_info() ?></h4>
                      <h1 class="wow fadeInDown" data-wow-delay="0.1s">Business Trending Activities</h1>
                   </div>
                   <div class="col-sm-6">
                      <div class="category-list">
                         <a class="filter-button" data-filter="all">All</a>
                         <a class="filter-button" data-filter="news-blog">Media/News</a>
                         <a class="filter-button" data-filter="jobs">Jobs</a>
                         <a class="filter-button" data-filter="real-estate">Real Estate</a>
                         <a class="filter-button" data-filter="events">Events</a>
                      </div>
                   </div>
                </div>
                <!-- row -->
                <br />
                <div class="row flexx_boxx">
                   <?php $counter=1; foreach($spotlight_all as $spotlight): //print_r($spotlight) ?>
                       <div class="col-sm-4 filter <?php echo createSlug($spotlight['category']) ?>  <?php echo createSlug($spotlight['spotlight_type']) ?>">
                          <div class="thumbnail ">
                             <?php if($spotlight['em_video']):?>
                             
                             <?php echo convertYoutube($spotlight['em_video'],$spotlight) ?>
          <?php else: ?>
                            <a href="<?php echo base_url('detail/'.$spotlight['postSlug']) ?>" class="" >
                             <?php if(!empty($spotlight['cover_photo'])):?>
							<img class="img-fluid" src="<?php echo base_url('uploads/cover_photo/'.$spotlight['cover_photo']); ?>" />
						<?php else: ?>
							<img class="img-fluid" src="<?php echo base_url('assets/images/placeholder.jpg')?>" />
						<?php endif;?> 
                        </a>
                        <?php endif;?> 
                             <div class="caption">
                             <span class="badge badge-secondary2"><?php echo $spotlight['category'] ?></span>
                                <h4 class="ellipsis"><?php echo $spotlight['postTitle']; ?></h4>
                                <p><a href="<?php echo base_url('detail/'.$spotlight['postSlug']) ?>" class="" >READ MORE</a></p>
                             </div>
                          </div>
                          <!-- blog-box -->
                       </div>
                       <?php if($counter==9) break; ?>
                   <?php $counter++;endforeach;?>
                </div>
                <!-- row -->
                <p class="text-center wow fadeInUp">
                   <a href="<?php echo base_url('login') ?>" class="show-more">SHOW MORE</a>
                </p>
             </div>
          </div>
      <?php endif;?>
      
      
      
      <?php $f_spotlights= site_settings('f_spotlights'); ?>
	  <?php if(isset($f_spotlights) && $f_spotlights): 
	  $spot_array = json_decode($f_spotlights)?>
      <div class="featured-business" style="padding-top:30px">
         <div class="container">
            
            <?php if(isset($spot_array->f_title)){ ?><h1 class="wow fadeInUp"><?php echo $spot_array->f_title ?></h1><?php } ?>
            <div class="row resource-subHeading">
                <?php if(isset($spot_array->f_description)){ ?>
               <div class="col-md-7">
                  <h4 class="wow fadeInDown" data-wow-delay="0.2s"><?php echo $spot_array->f_description ?></h4>
               </div>
               <?php }?>
               <?php /*?><div class="col-md-offset-1 col-md-4">
                  <div class="form-group wow fadeInDown" data-wow-delay="0.3s"> 
                     <input type="text" class="form-control" placeholder="Serach Steelton businesses by a keyword" name="" id="">
                  </div>
               </div><?php */?>
            </div>
           <?php if(isset($spot_array->f_spotlights)){
			    $total =count($spot_array->f_spotlights) ?>
                <?php $counter=0; foreach($spot_array->f_spotlights as $spot){ ?>
                <?php if($counter%3==0) echo '<div class="row">'; $counter++ ?>
                 <?php $spot_data = $this->db->get_where('spotlights',array('postID'=>$spot))->row(); 
				 if($spot_data):?>
            
           
			
               <div class="col-sm-4">
                  <article class="col-item">
                     <div class="options">
                        <a href="<?php echo base_url('login') ?>?redirect=<?php echo 'publicprofile/'.$spotlight['userid'] ?>" class="btn btn-default btn-sm">
                        <i class="fa fa-check-circle"></i> Follow
                        </a>
                     </div>
                     <div class="photo">
                           <?php if($spot_data->em_video):?>
						   <?php echo convertYoutube($spot_data->em_video,(array)$spot_data) ?>
          <?php else: ?>
                       <a href="<?php echo base_url('detail/'.$spot_data->postSlug) ?>">
                         <?php if(!empty($spot_data->cover_photo)):?>
							<img src="<?php echo base_url('uploads/cover_photo/'.$spot_data->cover_photo); ?>" class="img-responsive" />
						<?php else: ?>
							<img  src="<?php echo base_url('assets/images/placeholder.jpg')?>" class="img-responsive" />
						<?php endif;?>  
                       </a>
                       <?php endif;?>  
                     </div>
                     <div class="info text-center">
                        <div class="price-details">
                           <h4 class="details ellipsis">
                             <?php echo $spot_data->postTitle ?>
                           </h4>
                           <p> <?php if(!empty($spot_data->postContent)){echo substr(strip_tags($spot_data->postContent), 0,120); } ?>...</p>
                           <p class="more-detailtext"><a href="<?php echo base_url('detail/'.$spot_data->postSlug) ?>"> Read More</a> </p>
                           <hr>
                           <p class="thumb-bar">
                              <a href="<?php echo base_url('detail/'.$spot_data->postSlug)  ?>"><span class="fa fa-share"></span> Share</a>
                              <a href="javascript:void(0)" class="moreDetail<?php echo $counter ?>"><span class="fa fa-info"></span> BIZ DETAILS</a>
                              
                              <a href="<?php echo base_url('login') ?>?redirect=<?php echo 'publicprofile/'.$spot_data->userid ?>"><span class="fa fa-user-o"></span> Profile</a>
                           </p>
                        </div>
                        <!-- price-detail -->
                     </div>
                     <div class="inner-content inner-content<?php echo $counter ?>">
                        <div class="inner-box">
                           <h4>
                              DETAILS <span class="pull-right"><a href="javascript:void(0)" class="closeBtn"><i class="fa fa-times-circle"></i></a></span>
                           </h4>
                           <?php
						   
						     $publicuserprofileinfo = $this->db->get_where('user_profile',array('user_id'=>$spot_data->userid))->row(); ?>
                                <div class="card-body business_profile">
                                <?php if(isset($publicuserprofileinfo->business_name) && $publicuserprofileinfo->business_name): ?>
                                     <h5>Business Name: </h5>
                                    <p><?php echo $publicuserprofileinfo->business_name; ?></p>
                                <?php endif;?>
                                <?php if(isset($publicuserprofileinfo->b_address)): ?>
                                   <h5>LOCATED IN</h5>
                                    <p><?php echo $publicuserprofileinfo->b_address; ?></p>
                                <?php endif;?>
                                
                                
 
                                <?php if(isset($publicuserprofileinfo->years)): ?>
                                   <h5>Number of years in business:</h5>
                                    <p><?php echo $publicuserprofileinfo->years; ?></p>
                                <?php endif;?>
                        
                                <?php if(isset($publicuserprofileinfo->industry)): ?>
                                   <h5>Business Industry:</h5>
                                    <p><?php echo $publicuserprofileinfo->industry; ?></p>
                                <?php endif ?>
                                <?php if(isset($publicuserprofileinfo->phone)): ?>
                                 <p>
                                  Phone: <a href="tel:<?php echo $publicuserprofileinfo->phone ?>"><?php echo $publicuserprofileinfo->phone ?></a>
                               </p>
                                <?php endif ?>
                                 <?php if(isset($publicuserprofileinfo->website) && $publicuserprofileinfo->website): ?>
                                 <p>
                                  Website: <a target="_blank" href="<?php echo $publicuserprofileinfo->website?>"><?php echo $publicuserprofileinfo->website ?></a>
                               </p>
                                <?php endif ?>
                      
    
                   
            
            
            
                                  
                                </div>
            
                           <p>Have you use this Business?
                              <a href="<?php echo base_url('login') ?>?redirect=<?php echo 'publicprofile/'.$spot_data->userid ?>">Write A Review ?</a>
                           </p>
                           <p>
                              <a href="<?php echo base_url('login') ?>?redirect=<?php echo 'publicprofile/'.$spot_data->userid ?>" class="btn ask-question">View Profile</a>
                           </p>
                        </div>
                        <!-- inner-box -->
                     </div>
                     <!-- inner-contnet -->
                  </article>
               </div>
              
            
             <?php endif;?>
             <?php if(($counter%3==0) || ($total == $counter)) echo '</div>';?>
            <?php } ?>
            <?php } ?>
         </div>
         <!-- container -->
      </div>
      <?php endif;?>
      <?php $h_spotlights= site_settings('h_spotlights'); ?>
	  <?php if(isset($h_spotlights) && $h_spotlights): 
	  $spot_array = json_decode($h_spotlights)?>
      <div class="spotlight-section">
         <div class="container">
         <?php if(isset($spot_array->h_title)){ ?><h1 class="wow fadeInUp"><?php echo $spot_array->h_title ?></h1><?php } ?>
         <?php if(isset($spot_array->h_description)){ ?>
               <h5 class="wow fadeInUp" data-wow-delay="0.1s"><?php echo $spot_array->h_description ?></h5>
               <?php }?>
            
            <br />
            <?php if(isset($spot_array->h_spotlights)){
			    $total =count($spot_array->h_spotlights) ?>
                
            <div class="owl-carousel spotlight-slider owl-theme">
				<?php $counter=0; foreach($spot_array->h_spotlights as $spot){ ?>
                <?php $spot_data = $this->db->get_where('spotlights',array('postID'=>$spot))->row(); ?>
                <?php $spot_user = $this->db->get_where('users',array('userID'=>$spot_data->userid))->row(); ?>
                <?php $user_profile = $this->db->get_where('user_profile',array('user_id'=>$spot_data->userid))->row(); ?>
                 <?php $comments = $this->db->get_where('comments',array('itemID'=>$spot))->num_rows();
				 
				 //echo $comments;
				  ?>
                
                <?php //print_r($spot_user) ?>
                   <div class="item">
                      <div class="thumbnail custom-thumbnail">
                         <div class="media">
                            <div class="media-left">
                               <a href="<?php echo base_url('login') ?>?redirect=<?php echo 'publicprofile/'.$spotlight['userid'] ?>">
                               <img class="media-object rounded-circle" src="<?php
							   
							   if($spot_user->photo) $photo = $spot_user->photo; else $photo ='def.jpg';
							    echo base_url().'uploads/profile_img/'.$photo ?>"  alt="...">
                               </a>
                            </div>
                            <div class="media-body">
                               <h4 class="media-heading"><?php echo $spot_user->first_name ?> <?php echo $spot_user->last_name ?></h4>
                               <?php if(isset($user_profile->designation)): ?>
                               	<p><?php echo $user_profile->designation ?></p>
                               <?php endif;?>
                            </div>
                         </div>
                           <?php if($spot_data->em_video):?>
						   <?php echo convertYoutube($spot_data->em_video,(array)$spot_data) ?>
          <?php else: ?>
                         <a href="<?php echo base_url('detail/'.$spot_data->postSlug) ?>">
						 <?php if(!empty($spot_data->cover_photo)):?>
                            <img src="<?php echo base_url('uploads/cover_photo/'.$spot_data->cover_photo); ?>" />
                        <?php else: ?>
                            <img  src="<?php echo base_url('assets/images/placeholder.jpg')?>"  />
                        <?php endif;?>
                        </a>
                        <?php endif;?>
                         <div class="caption">
                            <p class="title-heading"><span class="redcircle"></span><?php echo $spot_data->category ?>
                            </p>
                            <h4 class="title-headinginner ellipsis"><?php echo $spot_data->postTitle ?></h4>
                            <p class="thumb-desc">
                               <?php if(!empty($spot_data->postContent)){echo substr(strip_tags($spot_data->postContent), 0,120); } ?>
                            </p>
                            <div class="pull-left">
                               <p><a href="<?php echo base_url('detail/'.$spot_data->postSlug) ?>" class="view-detail">VIEW DETAIL</a></p>
                            </div>
                            <div class="pull-right">
                               <p class="comment-area">
                                  <a href="<?php echo base_url('detail/'.$spot_data->postSlug) ?>"><span class="fa fa-comment"></span> <?php echo $comments ?> Comments</a>
                                  <a href="<?php echo base_url('detail/'.$spot_data->postSlug) ?>"><span class="fa fa-heart"></span> <?php echo $spot_data->likes ?> Likes</a>
                                  <a href="<?php echo base_url('detail/'.$spot_data->postSlug) ?>"><span class="fa fa-share"></span> Share</a>
                               </p>
                            </div>
                            <div class="clearfix"></div>
                         </div>
                         <!-- caption -->
                      </div>
                      <!-- custom-thumbnail -->
                   </div>
                 <?php } ?>
            </div>
            <?php } ?>
         </div>
      </div>
      <?php endif ?>
      <div class="cta-section">
         <div class="container">
            <h1 class="wow fadeInUp"><?php echo site_info() ?></h1>
           
            <div class="white-line wow fadeInDown"></div>
             <h3 class="text-center" style="color:#FFFFFF">Community, Local Govenment and Businesses Working Together</h3>
            <br /> 
            <div class="row mt20">
               <div class="col-lg-offset-2 col-lg-8">
                  <div class="row">
                     <div class="col-md-6 col-sm-6">
                        <p class="wow fadeInUp">
                           <a href="<?php echo base_url().'register' ?>" class="btn btn-register">
                           I am a Local Business
                           <strong>Register your Business</strong>
                           </a>
                        </p>
                     </div>
                     <div class="col-md-6 col-sm-6">
                        <p class="wow fadeInDown">
                           <a href="<?php echo base_url().'register' ?>" class="btn btn-register btn-SignUp">
                           Sign up as a Free User
                           <strong>Sign Up</strong>
                           </a>
                        </p>
                     </div>
                  </div>
                  <!--inner-row -->
               </div>
            </div>
            <!-- row -->
         </div>
      </div>
      <!-- cta-section -->
     
