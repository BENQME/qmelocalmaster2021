<style>
.side-widget .inner .site-menu ul li.menu_cls_3 a,
.navbar ul li.menu_cls_3 a{text-transform:none !important;}
.site-menu ul li.active a{color:#D71921}
</style>
<?php //echo $slug ?>
<?php $landing_menu = site_settings('landing_menu'); ?>
<?php  ob_start(); ?>


<ul>
   <?php if($landing_menu): 
   $menu_array = json_decode($landing_menu);
   ?>
   <?php $class=1; foreach($menu_array as $menu_item){ //print_r($menu_item) ?>
    <?php
	$child_active ="";
	$a ="";
	 if(isset($menu_item->children) && $menu_item->children){ ?>
   <?php foreach($menu_item->children as $child_item){ ?>
   <?php  $link_array = explode('/',$child_item->url);
    $last_part = end($link_array);
	$prev_part = prev($link_array);
	$match =$prev_part.'/'.$last_part;
	 ?>
   <?php if($this->uri->segment(2) && $match ==$slug
   //strpos($child_item->url,$slug)!== false
   ){
	   
	   $child_active = 'active '; break;
   }else{
	    $child_active ="";
   }
    ?>
   <?php  }} ?>
   <?php if($menu_item->url !='#' && (strtolower($menu_item->label) == $slug )){
	    $a ="active ";
   }elseif($this->uri->segment(2) && strpos($menu_item->url,$slug)){
	   $a ="active ";
   }else{
	   $a ="";
   }?>
      <li class="<?php echo $a.$child_active; ?><?php if(isset($menu_item->children) && $menu_item->children)echo 'dropdown ' ?> menu_cls_<?php echo $class ?>">
         <a<?php if(isset($menu_item->ext) && $menu_item->ext ==1) echo ' target="_blank"'  ?>  href="<?php if( $menu_item->url =='maga')
         echo '#';else echo $menu_item->url ?>"> 
         <?php echo trim($menu_item->label) ?></a><?php if(isset($menu_item->children) && $menu_item->children){ ?> <i></i><?php } ?>
         <?php if(isset($menu_item->children) && $menu_item->children){ ?>
         <ul<?php if( $menu_item->url =='maga')echo ' class="maga_dropdown"'; ?>>
            <?php foreach($menu_item->children as $child_item){ ?>
            <?php if($child_item->url =='label'){ ?>
            <li class="label22" style="display:block; width:100%"><strong style=" color:#fff"><?php echo $child_item->label ?></strong></li>
            <?php }else{ ?>
                 <li <?php if(strpos($child_item->url,$slug)) echo 'class="chid_active"' ?>><a <?php if(isset($child_item->ext) && $child_item->ext ==1) echo ' target="_blank"'  ?> href="<?php echo $child_item->url ?>">
				 <?php if($menu_item->url =='maga') echo '-' ?>  <?php echo $child_item->label ?></a></li>
            <?php  } ?>
            <?php  } ?>
         </ul>
         <?php } ?>
      </li>
      <?php $class++; } ?>
      <?php endif;?>
 </ul>

<?php $menu = ob_get_contents();
ob_end_clean();?>


<nav class="sticky-navbar">
  
  <div class="site-menu mga_dropdown">
    <?php  echo $menu ?>
  </div>
 
  <!-- end site-menu -->
  <div class="search-button"> <i class="fal fa-search"></i> </div>
</nav>

<!--end sticky-navbar -->
<div class="scrollup">
  <svg class="progress-circle" width="100%" height="100%" viewBox="-2 -2 104 104">
    <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
  </svg>
</div>
<aside class="side-widget">
  <div class="close-button"><i class="fal fa-times"></i></div>
  <!-- end close-button -->
  <?php /*?><figure class="logo"> 
  <?php $logo_settings = json_decode(site_settings('logo_settings'));
		   if($logo_settings->logo){  ?>
           <img class="" src="<?php echo base_url().'uploads/banners/'.$logo_settings->logo ?>" alt="<?php echo site_info() ?>" />
           <?php } else{ ?>
              <h1><?php echo strtoupper(site_info()) ?></h1>
           <?php } ?>
  </figure><?php */?>
  <div class="inner" id="side_menu">
    <div class="widget">
		<div class="account"><i class="fal fa-user-circle"></i> <a href="<?php echo base_url().'login' ?>">ACCOUNT</a></div>
      <!-- end account -->
      
       
      <div class="site-menu">
      
      <?php echo $menu ?>
    
           
       <?php /*?> <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="#">Pages</a><i></i>
            <ul>
              <li><a href="about-us.html">About Us</a></li>
              <li><a href="our-authors.html">Our Authors</a></li>
              <li><a href="advertise.html">Advertise</a></li>
              <li><a href="contact.html">Contact</a></li>
            </ul>
          </li>
          <li><a href="fashion.html">Fashion</a></li>
          <li><a href="travel.html">Travel</a></li>
          <li><a href="beauty.html">Beauty</a></li>
          <li><a href="lifestyle.html">Lifestyle</a></li>
        </ul><?php */?>
      </div>
      <!-- end site-menu --> 
    </div>
  <?php /*?>  <!-- end widget -->
    <div class="widget">
      <h6 class="widget-title">Newsletter</h6>
      <div class="side-newsletter">
        <form>
          <input type="email" placeholder="Enter Your email Addres...">
          <label>
            <input type="checkbox">
            I agree terms of newsletter. </label>
          <input type="submit" value="JOIN NOW">
        </form>
      </div>
      <!-- end side-newsletter --> 
    </div>
    <!-- end widget -->
    <div class="widget">
      <h6 class="widget-title">Featured Post</h6>
      <div class="blog-post light kansas">
        <figure class="post-image"> <img src="images/whats-new01.jpg" alt="Image"> </figure>
        <div class="post-content">
          <ul class="post-categories">
            <li><a href="#">TRAVEL</a></li>
            <li><a href="#">LIFESTYLE</a></li>
          </ul>
          <h3 class="post-title"><a href="post-single.html">T-Shirts: The Rise of Anti-
            Surveillance Fashion</a></h3>
          <div class="metas"> <span class="date">March 5th 2020</span>
            <div class="dot"></div>
            <span class="author">By <a href="#">Willimes Domson</a></span> </div>
          <!-- end metas --> 
        </div>
        <!-- end post-content --> 
      </div>
      <!-- end blog-post --> 
    </div>
    <!-- end widget --> <?php */?>
  </div>
  <!-- end inner --> 
</aside>
<!-- end side-widget -->

<!-- end search-box -->
<header class="header">
  <div class="container">
    <div class="left-side">
      <div class="social-media"> <div class="label"> FOLLOW US
        <?php /*?><div class="social-info">
          <ol>
            <li><i class="fab fa-facebook-f"></i> Facebook <span>5.6K</span></li>
            <li><i class="fab fa-twitter"></i> Twitter <span>1.62K</span></li>
            <li><i class="fab fa-youtube"></i> Youtube <span>2.4M</span></li>
            <li><i class="fab fa-instagram"></i> Instagram <span>5.6K</span></li>
          </ol>
        </div><?php */?>
        <!-- end social-info --> 
        </div>
		  <!-- end label -->
        <ul>
         <?php echo sidebar('social') ?>
        </ul>
      </div>
      <!-- end social-connected --> 
    </div>
    <!-- end left-side -->
    <div class="logo"> <a href="<?php echo base_url('home') ?>">
    <?php $logo_settings = json_decode(site_settings('logo_settings'));
		   if($logo_settings->logo){  ?>
           <img class="navbar-brand2 logoo logo-light2" src="<?php echo base_url().'uploads/banners/'.$logo_settings->logo ?>" alt="<?php echo site_info() ?>" />
           <?php } else{ ?>
              <h1><?php echo strtoupper(site_info()) ?></h1>
           <?php } ?>
</a> </div>
    <!-- end logo -->
    <div class="right-side">
      <div class="custom-control custom-switch">
        <!--<input type="checkbox" class="custom-control-input" id="darkSwitch">
        <label class="custom-control-label" for="darkSwitch">Dark Mode</label>-->
      </div>
      <!-- end custom-control -->
      
      <div class="account">
      <?php if(!$this->session->userdata('user_id')): ?>
      		<a href="<?php echo base_url().'login' ?>"><i class="fal fa-user"></i>  <span class="m_bokk">Login</span></a>
      <?php endif;?>
   <?php 
   $user_name;
   if($user_id = $this->session->userdata('user_id')){
		   
		   $user_data = $this->db->get_where('users',array('userID'=>$user_id))->row();
		   $user_name = 'Hi, '.$user_data->first_name;
	   }
	    ?>
       <a href="<?php
	   
	  if($this->session->userdata('user_id'))   echo base_url().'dashboard';else echo base_url().'register'
	 ?>"><i class="fal fa-user-edit"></i> 
     <span class="mobil_only"><?php if($this->session->userdata('user_id')) echo $user_name;else echo 'Join Now' ?></span>
     <span class="dasktop_only">
      <?php if($this->session->userdata('user_id')) echo $user_name;else echo 'Join The MBN USA Community' ?>
     </span>
      
      </a></div>
      <!-- end account --> 
    </div>
    <!-- end right-side --> 
  </div>
  <!-- end container --> 
</header>
<!-- end header -->



<nav class="navbar">
  <div class="container">
    <div class="hamburger-menu"> <i class="fal fa-bars"></i> </div>
   
    
    <div class="site-menu mga_dropdown">
    
   <?php echo $menu ?>
      
    </div>
        <div class="logo mobile_logo"> <a href="<?php echo base_url('home') ?>">
    <?php $logo_settings = json_decode(site_settings('logo_settings'));
		   if($logo_settings->logo){  ?>
           <img class="navbar-brand2 logoo logo-light2" src="<?php echo base_url().'uploads/banners/'.$logo_settings->logo ?>" alt="<?php echo site_info() ?>" />
           <?php } else{ ?>
              <h1><?php echo strtoupper(site_info()) ?></h1>
           <?php } ?>
</a> </div>
    <!-- end site-menu -->
    
    <div class="dropdown search_dropdown">
  <span class="search-button dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="fal fa-search"></i> 
  </span>

  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
   <div class="fom_box">
    <form action="<?php base_url() ?>/home/main_search">
      <input type="search" name="search" value="<?php echo $_GET['search'] ?>" placeholder="Type here to find">
    </form>
 </div>
  </div>
</div>
    <!-- end search-button --> 
  </div>
  <!-- end container --> 
</nav>
<!-- end navbar -->