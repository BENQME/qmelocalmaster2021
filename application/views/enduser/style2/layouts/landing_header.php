<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="theme-color" content="#e90101"/>
<title><?php echo strtoupper(site_info()) ?> | Homepage</title>

<?php /*?><!-- SOCIAL MEDIA META -->
<meta property="og:description" content="Aqum | Contemporary News and Magazine">
<meta property="og:image" content="http://www.themezinho.net/aqum/preview.png">
<meta property="og:site_name" content="aqum">
<meta property="og:title" content="aqum">
<meta property="og:type" content="website">
<meta property="og:url" content="http://www.themezinho.net/aqum">

<!-- TWITTER META -->
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="@aqum">
<meta name="twitter:creator" content="@aqum">
<meta name="twitter:title" content="aqum">
<meta name="twitter:description" content="Aqum | Contemporary News and Magazine">
<meta name="twitter:image" content="http://www.themezinho.net/aqum/preview.png">

<!-- FAVICON FILES -->
<link href="ico/apple-touch-icon-144-precomposed.png" rel="apple-touch-icon" sizes="144x144">
<link href="ico/apple-touch-icon-114-precomposed.png" rel="apple-touch-icon" sizes="114x114">
<link href="ico/apple-touch-icon-72-precomposed.png" rel="apple-touch-icon" sizes="72x72">
<link href="ico/apple-touch-icon-57-precomposed.png" rel="apple-touch-icon">
<link href="ico/favicon.png" rel="shortcut icon"><?php */?>

<!-- CSS FILES -->
<link rel="stylesheet" href="<?php echo base_url('landing_file/style2/css/fontawesome.min.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('landing_file/style2/css/swiper.min.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('landing_file/style2/css/bootstrap.min.css') ?>">
<link rel="stylesheet" href="<?php echo base_url('landing_file/style2/css/style.css') ?>">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('landing_file/css/form.css') ?>" />
<script src="<?php echo base_url('landing_file/style2/js/jquery.min.js') ?>"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/bootstrap-datetimepicker.min.css" />
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.js"></script>
<script type="text/javascript" src="https://mbnusa.biz/assets/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="https://mbnusa.biz/assets/js/timepicker.js"></script>

<script type="text/javascript" src="https://mbnusa.biz/assets/js/timepicker.js"></script>


<?php $logo_settings = json_decode(site_settings('logo_settings'));
		   if($logo_settings->favicon){  ?>
             <link rel="icon" type="image/png" href="<?php echo base_url().'uploads/banners/'.$logo_settings->favicon ?>">
			<link rel="icon" type="image/png" href="<?php echo base_url().'uploads/banners/'.$logo_settings->favicon ?>">
           <?php } else{ ?>
                <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/favicon.png') ?>">
				<link rel="icon" type="image/png" href="<?php echo base_url('assets/img/favicon.png') ?>">
           <?php } ?>
  <link rel="stylesheet" href="<?php echo base_url('assets/signup_popup.css') ?>">         
 <style>

 .sticky-navbar {text-transform: uppercase;}
 .sticky-navbar ul li.menu_cls_3 a{text-transform:none}
body .post-title a {
    display: inline;
    background-image: -moz-linear-gradient(rgba(0, 0, 0, 0) calc(99% - 1px), #CB0017 1px) !important;
    background-image: -webkit-linear-gradient(rgba(0, 0, 0, 0) calc(99% - 1px), #CB0017 1px) !important;
    background-image: linear-gradient(rgba(0, 0, 0, 0) calc(99% - 1px), #CB0017 1px) !important;
}
body .chicago .post-title a{background:none !important;} 
 .navbar .hamburger-menu{    margin-right: 0}
 .dropdown22 {    display: flex;
    flex-flow: row;}
 .navbar .site-menu.mga_dropdown{
    margin-left:0;
}
.dropdown22  .jcf-select .jcf-select-text {
    line-height: 34px;
	font-size:17px;
}
.dropdown22 label {
    font-size: 17px;
    margin-right: 10px;
    color: #0D2F81;
}
.jcf-select .jcf-select-opener{color:#CB0017}
.jcf-select {
    margin-bottom: 0;
    border-bottom: 2px solid #CB0017;
    color: #CB0017 !important;
	width: 100%;
	min-width:250px;
}

 .sticky-navbar .site-menu ul li {
    margin-right: 1vw;
}
 .navbar .site-menu.mga_dropdown ul>li i {
    margin-left: 3px;
}
.sticky-navbar .site-menu ul li a,
 .navbar .site-menu.mga_dropdown>ul>li a{font-size:14px;}
  .navbar .site-menu.mga_dropdown>ul>li{margin-right:10px !important}
   .navbar .site-menu.mga_dropdown>ul>li:last-child{margin-right:0;}
 .navbar .site-menu ul li {
    margin-right: 1.5vw;
}
 .content-section.space-20{padding-bottom:0}
 .texas .post-content .post-title {
    font-size: 18px;
    font-weight: 600;
}
 .nevada .post-content {
   padding-bottom: 20px;
}
 .blog-post {
    margin-bottom: 20px;
}
 .header .container .logo a img {
    height: auto;
}
.blog-post .metas .author figure,
.blog-post .metas .author {
    vertical-align: middle;
}
.navbar .hamburger-menu{display:none}
.footer .footer-logo img {
    height: auto;
}
.footer .footer-social li a,
.footer .footer-menu li a {
    color: #000 !important;
}
.footer {
    background: #f1f1f1;
    color: #000 !important;
}
.new-york .post-content .post-title{text-transform:uppercase}
.ful_width{width:100%}
.site-menu.mga_dropdown ul li ul.maga_dropdown li a {
    display: block;
    /* background: #666; */
    padding: 0;
    text-align: left;
    font-size: 14px;
    margin-left: 10px;
    line-height: 1.2;
}
.footer .footer-menu li{display:block}
.site-menu.mga_dropdown ul li ul.maga_dropdown li {
	width:100%;
    margin: 0;
    padding: 5px;
    white-space: normal;
    font-size: 15px;
	
}
.site-menu.mga_dropdown ul li ul.maga_dropdown li strong {
    font-size: 16px;
    text-transform: uppercase;
    color: #fff !important;
}
.site-menu.mga_dropdown ul li ul.maga_dropdown li a{color: #81fdc5 !important;}
.site-menu.mga_dropdown ul li ul.maga_dropdown {
    z-index: 9999;
    min-width: 280px;
    padding: 14px 10px;
}
.navbar .search-button{position:relative}
.search-box2.active{display:block}
.search-box2{display:none; position:absolute; right:0; top:0}
.mobile_logo{display:none}
.search_dropdown .dropdown-menu{border:none !important;}
.search-button:after{display:none !important;}
.header .container .right-side .account a{text-align:right}
.kansas .post-title {
    font-size: 18px;
}
.kansas .fluid-width-video-wrapper {
    min-height: 300px;
}
.blog-post.miami .post-image img {
    min-height: 0;
}
.blog-post .post-image img {
    min-height: 296px;
	object-fit: cover;
}
.new-york .post-content .post-title {
    text-transform: none !important;
}
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
@media only screen and (max-width: 767px), only screen and (max-device-width: 767px){
.header .container .right-side .account a{text-align: center;}
.header .container .right-side .account span.m_bokk{display:block}
	.main-slider .swiper-pagination {
    position: static !important;
    text-align: center !important;
    margin: 0 auto !important;
}
	.chicago .post-content .post-title {
    font-size: 25px;
    line-height: 30px;
}
.search_dropdown {position:static}
.search_dropdown .dropdown-menu-right {
    right: 5px;
    left: 5px;
    width: auto;
}
input[type="search"] {
    max-width: 100%;
    height: 48px;
    padding: 0 15px;
}
.navbar .logo img {
    height: 57px;
}
.content-section.space-50{    padding: 20px 0;}
.navbar .hamburger-menu{display:block}
.header .container .right-side .account {
    display: block;
}
.mobile_logo{display:block}
.header .container .left-side .social-media .label{display:none}
}

@media (min-width: 992px){
.container, .container-lg, .container-md, .container-sm {
    max-width: 1060px;
}
}
@media (min-width: 1280px){
.container {
    max-width: 1260px;
}
}
@media (min-width: 1170px){
.container {
    max-width: 1100px;
}
}
@media (min-width: 1200px){
.container, .container-lg, .container-md, .container-sm, .container-xl {
    max-width: 1300px;
}
}
@media (max-width: 1060px){
	.navbar .hamburger-menu{display:block}
	.navbar .site-menu.mga_dropdown{display:none}
	}
 </style>
</head>
<body>
<?php $this->load->view('enduser/style2/landing/header'); ?>
<?php echo $page_content ?>
<?php $this->load->view('enduser/style2/landing/footer'); ?>















