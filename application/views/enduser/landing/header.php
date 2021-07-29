<style>
.navbar{border-radius:0}
nav.navbar-findcond .navbar-right li {
    margin-right: 4px;
}
.trending-activites .thumbnail{border:none !important;}
.trending-activites .thumbnail .caption {
    background: #F7F8FA;
}
.logotext .sub-text{font-size: 10px;}
/*.logotext h1 {
   font-size: 29px;
}*/
.customInput2{font-size: 12px;}
nav.navbar-findcond .navbar-right>li:last-child {
    max-width: 70px;
    display: block;
}
.header-banner2{background:#E2DEEF;}
.header-banner2 .registarArea{margin:30px 0}
.ellipsis {
  white-space: nowrap;
  text-overflow: ellipsis;
  overflow: hidden;
}

	.trending-list .btn.active2 {
    background: #0E2D5C;
    color: #fff;
}
.profile_listt .btn-primary{display: block;
    color: white !important;}
.logoo{height:auto; max-width:267px}
.v_box {
    position: relative;
}
.play_icon {
    position: absolute;
    top: 50%;
    display: block;
    width: 100%;
    text-align: center;
    transform: translate(0, -50%);
}
.play_icon img {
    width: 50px !important;
	min-height:0 !important;
}
.trending-activites .thumbnail img {
    min-height: 263px;
	    object-fit: cover;
}
.nav>li>a {
    padding: 10px 8px;
}

.dropdown-menu .abs_div{    position: absolute;
    right: 10px;
    color: #000 !IMPORTANT;
	top:10px;
}
.dropdown-menu .abs_div i{color:#000 !important; font-size:20px; cursor:pointer !important;}
nav.navbar-findcond .navbar-right li a {
    font-size: 15px;
}
@media (min-width: 768px){
	
	nav.navbar-findcond .navbar-right {
		display: flex;
		align-items: center;
	}
.flexx_boxx{display: flex;
    flex-flow: row wrap;}
.mga_dropdown{ padding:20px 0; width:709px; left:0 !important;}	
	
	.mga_dropdown li{float:left; width:348px; margin-bottom:10px}
	nav.navbar-findcond ul.mga_dropdown li a:hover{color:#480299 !important;}
	.mga_dropdown li a{white-space:normal; line-height:1}
	
}

@media (max-width: 768px){
	nav.navbar-findcond .navbar-right .dropdown ul.dropdown-menu{position:relative}
	nav.navbar-findcond .navbar-right .form-inline{display: flex;}
	nav.navbar-findcond .navbar-right {
    margin-left: 0;
}
	nav.navbar-findcond .navbar-right li a {
    font-size: 15px;
}
nav.navbar-findcond .navbar-right>li:last-child {
    max-width: 100%;
}

	}
@media (max-width: 767px){
	nav.navbar-findcond .navbar-right .input-group{width: 100%;}
	.nextBtn {
    width: max-content;
}
	nav.navbar-findcond .navbar-right .nextBtn2{
    margin-right: 15px;
    border-radius: 0;
}
.header-banner h4{font-size:15px !important;}
.trending-activites{    padding-top: 30px;
    padding-bottom: 30px;}
	.featured-business{padding-bottom:0}
	.trending-activites .thumbnail img {
    min-height: 0;
}
}
@media (min-width: 768px) and (max-width: 1200px){
nav.navbar-findcond .navbar-right li a {
    font-size: 1.4vw;
}
.navbar-findcond .container {
    display: flex;
    flex-flow: column;
    align-items: center;
    width: 100% !important;
}
.navbar-brand{padding-bottom:0}

nav.navbar-findcond .navbar-right {
    margin-top: 0;
}
}
@media (max-width: 420px){
	.logoo {
    max-width: 230px;
}
.profile_listt .nextBtn{font-size:12px !important;}
.related_spotlights .jcf-select .jcf-select-text,
.profile_listt  .jcf-select .jcf-select-text {
    font-size: 15px;
}

}

</style>
<?php $logo_settings = json_decode(site_settings('logo_settings')); ?>
<?php if($header_color = $logo_settings->header_color): ?>
<style>
nav.navbar-findcond{background:<?php echo $header_color  ?>}
</style>
<?php endif;?>

<?php if($footer_color = $logo_settings->footer_color): ?>
<style>
.cta-section{background:<?php echo $footer_color  ?>}
</style>
<?php endif;?>

<?php if($header_f_color = $logo_settings->header_f_color): ?>
<style>
nav.navbar-findcond .navbar-right li a{color:<?php echo $header_f_color  ?>}
</style>
<?php endif;?>
<?php if($footer_f_color = $logo_settings->footer_f_color): ?>
<style>
.cta-section h1,
.cta-section h3,
.cta-section .white-line{color:<?php echo $footer_f_color  ?> !important;}
.cta-section .white-line{background:<?php echo $footer_f_color  ?> !important;}


</style>
<?php endif;?>
<?php if($footer_f_color2 = $logo_settings->footer_f_color2): ?>
<style>
.trending-activites.proommo_wraper{background-color:<?php echo $footer_f_color2  ?>!important;}
</style>
<?php endif;?>
<!-- header -->
  <nav class="navbar navbar-findcond">
     <div class="container">
        <div class="navbar-header">
           <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
           <span class="sr-only">Toggle navigation</span>
           <span class="icon-bar top-bar"></span>
           <span class="icon-bar middle-bar"></span>
           <span class="icon-bar bottom-bar"></span>
           </button>
           <a class="logotext" href="<?php echo base_url('home') ?>">
           <?php $logo_settings = json_decode(site_settings('logo_settings'));
		   if($logo_settings->logo){  ?>
           <img class="navbar-brand logoo" src="<?php echo base_url().'uploads/banners/'.$logo_settings->logo ?>" alt="<?php echo site_info() ?>" />
           <?php } else{ ?>
              <h1><?php echo strtoupper(site_info()) ?><sup>&trade;</sup></h1>
              <span class="sub-text">CONNECTING BUSINESSES TO RESOURCE</span>
           <?php } ?>
           </a>
        </div>
        <div class="collapse navbar-collapse" id="navbar">
        <?php $landing_menu = site_settings('landing_menu'); ?>
           <ul class="nav navbar-nav navbar-right">
           <?php if($landing_menu): 
           $menu_array = json_decode($landing_menu);
           ?>
           
           <?php  foreach($menu_array as $menu_item){ //print_r($menu_item) ?>
              <li <?php if(isset($menu_item->children) && $menu_item->children){ ?>class="dropdown"<?php } ?>>
                 <a<?php if(isset($menu_item->ext) && $menu_item->ext ==1) echo ' target="_blank"'  ?>  href="<?php echo str_replace('{site_url}',bese_url(),$menu_item->url) ?>" <?php if(isset($menu_item->children) && $menu_item->children){ ?> class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"<?php } ?>><?php echo $menu_item->label ?>
                  <?php if(isset($menu_item->children) && $menu_item->children){ ?> <span class="fa fa-angle-down"></span><?php } ?></a>
                 <?php if(isset($menu_item->children) && $menu_item->children){ ?>
                 <ul class="dropdown-menu<?php if(count($menu_item->children)> 7) echo ' mga_dropdown' ?>">
                 <?php if(count($menu_item->children)> 7)  echo '<span class="abs_div"><i class="fa fa-close"></i></span>'?>
                    <?php foreach($menu_item->children as $child_item){ ?>
                         <li><a <?php if(isset($child_item->ext) && $child_item->ext ==1) echo ' target="_blank"'  ?> href="<?php echo str_replace('{site_url}',bese_url(),$child_item->url) ?>"><?php echo $child_item->label ?></a></li>
                    <?php  } ?>
                 </ul>
                 <?php } ?>
              </li>
              <?php } ?>
              <?php endif;?>
              <li>
              <form class="form-inline" action="<?php base_url() ?>/home/main_search">
                  <div class="input-group">
                     <input type="text" name="search" class="form-control customInput2" id="email" placeholder="Search activities by keyword">
                  </div>
                  
                  <button type="submit" class="btn nextBtn2"><i class="fa fa-search"></i></button>
               </form>
              
              </li>
              <li>
             
      		
     
   <?php 
   $user_name;
   if($user_id = $this->session->userdata('user_id')){
		   
		   $user_data = $this->db->get_where('users',array('userID'=>$user_id))->row();
		   
		    $full_name =$user_data->first_name;
             if (strlen($full_name) > 8)
                {
                    $full_name = substr($full_name, 0, 8)."..";
                }
                else
                {
                    $full_name = $full_name;
                }
		   $user_name = 'Hi, '.$full_name;
	   }
            
?>
       <a href="<?php
	   
	  if($this->session->userdata('user_id'))   echo base_url().'dashboard';else echo base_url().'login'
	 ?>">
     <span class="mobil_only"><?php if($this->session->userdata('user_id')) echo $user_name;else echo 'Login/Join' ?></span>
      
      </a>
              
            </li>
            <?php /*?> <?php if(!$this->session->userdata('user_id')): ?>
              <li><a href="<?php echo base_url('register') ?>" class="btn btn-project">LIST YOUR BUSINESS</a></li>
               <?php endif;?><?php */?>
           </ul>
        </div>
     </div>
  </nav>
  <?php /*?><?php 
  $catss= array();
  if(isset($categories)):
    foreach($categories as $cat){
        $catss[] = $cat['category'];
    }
   $selected_cats = array_filter(array_unique($catss));
   ?>
  <div class="trending-list">
     <div class="container">
        <div class="owl-carousel btn-slider owl-theme">
           <?php foreach($selected_cats as $c){ ?>
           <div class="item">
           <?php $category_data =  $this->db->get_where('spotlights_category',array('categoryTitle'=>$c))->row()?>
              <a href="<?php echo base_url('home/category/'.$category_data->categoryID) ?>" class="btn
			  <?php if($category_data->categoryID == $this->uri->segment(3)) echo ' active2'; ?>"> <?php echo $c ?></a>
           </div>
           <?php } ?>
           
        </div>
     </div>
  </div>
  <?php endif ?><?php */?>