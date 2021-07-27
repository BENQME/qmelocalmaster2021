<style>
.img-fluid {
    width: 100%;
}
.font_texxtt{font-size:16px}

.profile_listt .nextBtn {
    border-radius: 50px;
    padding: 11px 30px;
    background: #FEDC00;
    border-color: #FEDC00;
    color: #0C2C5B;
    cursor: pointer;
    font-family: 'Overpass-Bold';
    text-transform: uppercase;
    font-size: 15px;
}
.zatitt {
    box-shadow: 0 0 10px 0 rgb(183 192 206 / 20%);
    -webkit-box-shadow: 0 0 10px 0 rgb(183 192 206 / 20%);
    -moz-box-shadow: 0 0 10px 0 rgba(183, 192, 206, 0.2);
    -ms-box-shadow: 0 0 10px 0 rgba(183, 192, 206, 0.2);
}
.zatitt .caption{
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff !important;
    background-clip: border-box;
    border: 1px solid #f2f4f9;
    border-radius: 0.25rem;
}
.zatitt .caption:first-child {
    border-radius: 0 0 0 0;
}
.zatitt .caption{
    padding: 10px 5px;
}
.zatitt .caption {
    padding: 0.875rem 1.5rem;
    margin-bottom: 0;
    background-color: rgba(0, 0, 0, 0);
    border-bottom: 1px solid #f2f4f9;
}
.profile_listt .btn-primary {
    border-radius: 0;
}
.trending-activites .thumbnail .caption {
    padding-bottom: 0;
}
p.sodaa a{color: #000000 !important;}
p.sodaa{margin-bottom:2px; }
.icon_star {
    position: absolute;
    right: 10px;
    top: 10px;
    font-size: 25px;
    color: #d4af37
}
.badge.badge-primary {
    background: #214FFB !important;
    border-color: #214FFB !important;
    color: #fff!important;
    padding: 5px 8px;
    font-family: 'Overpass' !important;
    font-size: 15px;
    border-radius: 5px;
}
.trending-activites.related_spotlights .thumbnail .caption {
    padding-bottom: 10px;
}
.trending-activites{padding-bottom:0}
.trending-activites.related_spotlights{padding-top:20px; padding-bottom:30px}
.jcf-select .jcf-select-opener {
    top: 7px;
    color: red;
}
.jcf-select {
    /* border: 1px solid #777 !important; */
    /* background: #F7F8FA; */
    /* box-shadow: 0 0 10px 0 rgb(183 192 206 / 20%); */
    /* -webkit-box-shadow: 0 0 10px 0 rgb(183 192 206 / 20%); */
    /*-moz-box-shadow: 0 0 10px 0 rgba(183, 192, 206, 0.2);
    -ms-box-shadow: 0 0 10px 0 rgba(183, 192, 206, 0.2);*/
    border: 1px solid #ddd;
    border-radius: 5px;
	border-radius: 50px;
}
.jcf-select .jcf-select-text {
    font-size: 18px;
    font-weight: 700;
}
</style>
<div class="trending-activites profile_listt">
    <div class="container">
    <div class="activities-content">
    <div class="row">
       <div class="col-sm-12">
          <h4 class="wow fadeInUp animated"><?php echo site_info() ?></h4>
          <h1><?php echo $page_title ?></h1>
         
       </div>
       
       
    </div>
    <div class="row" style="margin-bottom:30px">
       <div class="col-sm-7">
        <p class="font_texxtt"><?php echo $page_content ?></p>
     </div>
      <div class="col-sm-5">
       <a class="btn nextBtn" href="<?php echo base_url('register') ?>">Create Your Bussiness Profile</a>
     </div>
     </div>
 <?php  if(isset($res) && $res):  ?>  
 <?php $counter=0; foreach($res as $person): //echo $person['userID'] ?>
         	<?php if($counter%4==0) echo '<div class="row set-card-spacing">'; $counter++  ?>
            
            <div class="col-sm-3">
				  <div class="thumbnail zatitt">
                  <div class="caption">
						<div class="ml-2">
                        <div class="icon_star"><i class="fa fa-star"></i></div>
                           <p class="sodaa"><a style="color:#686868;" href="<?php echo base_url('publicprofile/'.$person['user_id']);?>"> 
                             <?php 
             $full_name =$person['first_name'].' '.$person['last_name'];
             if (strlen($full_name) > 18)
                {
                    echo substr($full_name, 0, 18)."...";
                }
                else
                {
                    echo $full_name;
                }
?>
                           
                           </a>
                           <?php 
						  $current_user = $this->session->userdata('user_id');
							  if($current_user){
							   
							   $followers = $this->db->get_where('followers', array('is_following'=>$person['user_id'],'userID'=>$current_user))->row();
							   
							   if(!$followers && ($current_user !=$person['user_id'])){
							  
						    ?>
                           <a class="badge badge-primary" href="<?php echo base_url() ?>dashboard/follow/<?php echo $person['user_id'] ?>">follow</a>
                           <?php }}else{?>
                           <a class="badge badge-primary" href="<?php echo base_url() ?>register">follow</a>
                           <?php  } ?>
                           </p>
                           <?php $userprofile_info =$this->db->get_where('user_profile', array('user_id'=>$person['user_id']))->row() ?>
                           <?php $user_info =$this->db->get_where('users', array('userID'=>$person['user_id']))->row() ?>
                           <?php //print_r($userprofile_info) ?>
                            <p class="tx-11 text-muted"><?php if($designation = $userprofile_info->designation) echo $designation; elseif($user_info->title)echo $user_info->title;  ?></p>
                          
                        </div>
					 </div>
                  
                  <a href="<?php echo base_url('publicprofile/'.$person['user_id']);?>"> 
                        <?php if($person['photo']): ?>
                        	<img class="img-fluid" src="<?php echo base_url().'uploads/profile_img/'.$person['photo']; ?>" alt="">
                        <?php else: ?>
                        	<img class="img-fluid" src="<?php echo base_url().'uploads/profile_img/def.jpg'; ?>" alt="">
                        <?php endif;?>
                       
                        </a>
					 <p><a class="btn btn-primary" href="<?php echo base_url('publicprofile/'.$person['user_id']);?>">View Profile</a></p>
				  </div>
				  <!-- blog-box -->
			   </div>
            
            
             <!-- col -->
    
           <?php if($counter%4==0 ||  count($res) == $counter) echo '</div>';  ?>
    
            <?php endforeach; ?>
  <?php endif;?>
 </div>
    </div>
</div>

<?php $pd_id = $this->uri->segment(3) ?>
<?php if($related_spotlights): ?>
<div class="trending-activites related_spotlights">
	 <div class="container">
		<div class="row activities-content">
		   <div class="col-md-8">
			  <h4 class="wow fadeInUp"><?php echo $page_title ?></h4>
			  <h1 class="wow fadeInDown" data-wow-delay="0.1s">Related Spotlights</h1>
		   </div>
           <?php if($related_categories){ ?>
           <div class="col-md-4">
			 
           
           <select name="spotlight_type" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" style="border:1px solid #020101">
               <option value="">Search By Category</option>
               
                <?php foreach($related_categories as $category){?>
                
                 <option<?php if($category['category'] == $_GET['category']) echo ' selected="selected"' ?>  value="<?php echo base_url('home/usergroup/'.$pd_id.'?category='.urlencode($category['category']))?>"><?php echo $category['category']?></option>
             <?php } ?>
           
            </select>
		   </div>
           <?php } ?>
		   
		</div>
		<!-- row -->
		<br />
        <?php if($related_spotlights): ?>
		<div class="row flexx_boxx">
        
		   <?php foreach($related_spotlights as $spotlight): //print_r($spotlight) ?>
			   <div class="col-sm-4 filter  <?php echo createSlug($spotlight['spotlight_type']) ?>">
				  <div class="thumbnail ">
                  <?php if($spotlight['em_video']):?><?php echo convertYoutube($spotlight['em_video'],$spotlight) ?>
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
						<h5><?php echo $spotlight['spotlight_type'] ?></h5>
						<h4 class="ellipsis"><?php echo $spotlight['postTitle']; ?></h4>
						<p><a href="<?php echo base_url('detail/'.$spotlight['postSlug']) ?>" class="" >READ MORE</a></p>
					 </div>
				  </div>
				  <!-- blog-box -->
			   </div>
		   <?php endforeach;?>
		</div>
		<!-- row -->
		<p class="text-center wow fadeInUp">
		   <a href="<?php echo base_url('login') ?>" class="show-more">SHOW MORE</a>
		</p>
        <?php else: ?>
        <p class="text-center wow fadeInUp">
		   <p>no Spotlights added yet</p>
		</p>
        <?php endif;?>
	 </div>
  </div>
<?php endif;?>