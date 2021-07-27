<head>

      <meta charset="UTF-8">

      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <meta http-equiv="X-UA-Compatible" content="ie=edge">

      <title><?php echo site_info() ?> Portal</title>

      <link rel="stylesheet" href="<?php echo base_url('assets/vendors/core/core.css') ?>">

      <link rel="stylesheet" href="<?php echo base_url('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') ?>">

      <!-- end plugin css for this page -->

      <!-- inject:css -->

      <link rel="stylesheet" href="<?php echo base_url('assets/fonts/feather-font/css/iconfont.css') ?>">

      <!-- endinject -->

      <!-- Layout styles -->  
<?php if(isset($page_type) && (($page_type =='landing_menu') || $page_type =='mbn_cms')) : ?>
  	<link rel="stylesheet" href="<?php echo base_url('assets/vendors/select2/select2.min.css') ?>">

	<link rel="stylesheet" href="<?php echo base_url('assets/vendors/jquery-tags-input/jquery.tagsinput.min.css') ?>">
    <?php endif ?>
         <?php if(isset($page_type) && $page_type =='onboard2'): ?>

      	<link rel="stylesheet" href="<?php echo base_url('assets/vendors/select2/select2.min.css') ?>">

	<link rel="stylesheet" href="<?php echo base_url('assets/vendors/jquery-tags-input/jquery.tagsinput.min.css') ?>">

     <?php endif ?>
 <?php if(isset($page_type) && $page_type =='user_list'): ?>
     <link rel="stylesheet" href="<?php echo base_url('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') ?>">
     <?php endif ?>
      <link rel="stylesheet" href="<?php echo base_url('assets/css/demo_5/bootstrap-social.css') ?>">

       <?php $logo_settings = json_decode(site_settings('logo_settings'));
		   if($logo_settings->favicon){  ?>
             <link rel="icon" type="image/png" href="<?php echo base_url().'uploads/banners/'.$logo_settings->favicon ?>">
			<link rel="icon" type="image/png" href="<?php echo base_url().'uploads/banners/'.$logo_settings->favicon ?>">
           <?php } else{ ?>
                <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/favicon.png') ?>">
				<link rel="icon" type="image/png" href="<?php echo base_url('assets/img/favicon.png') ?>">
           <?php } ?>

      <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="

  crossorigin="anonymous"></script>
   <?php if(isset($page_type) && $page_type =='spotlight2'): ?>
        <link rel="stylesheet" href="<?php echo base_url('assets/vendors/dropzone/dropzone.min.css') ?>">
 <?php endif ?>
    <?php if(isset($page_type) && $page_type =='admin_media'): ?>
        <link rel="stylesheet" href="<?php echo base_url('assets/vendors/dropzone/dropzone.min.css') ?>">
 <?php endif ?>
       <?php if(isset($page_type) && ($page_type =='complete_profile' ||  $page_type =='user_profile' ||  $page_type =='spotlight3'  ||  $page_type =='spotlight2')): ?>

       <link rel="stylesheet" href="<?php echo base_url('assets/vendors/dropify/dist/dropify.min.css') ?>">
       <script src="<?php echo base_url('assets/cropee/croppie.js') ?>"></script>
       <link rel="stylesheet" href="<?php echo base_url('assets/cropee/croppie.css') ?>">

      <?php endif ?>
       <?php if(isset($page_type) && ($page_type =='complete_profile'  ||  $page_type =='user_profile' ||  $page_type =='spotlight3')): ?>

       <link rel="stylesheet" href="<?php echo base_url('assets/vendors/cropperjs/cropper.min.css') ?>">

       <?php endif ?>
        <?php if(isset($page_type) && $page_type =='spotlight'): ?>
      <link rel="stylesheet" href="<?php echo base_url('assets/vendors/jquery-steps/jquery.steps.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/vendors/simplemde/simplemde.min.css') ?>">
      <link rel="stylesheet" href="<?php echo base_url('assets/vendors/select2/select2.min.css') ?>">
      <link rel="stylesheet" href="<?php echo base_url('assets/vendors/jquery-tags-input/jquery.tagsinput.min.css') ?>">
 <?php endif ?>
 <link rel="stylesheet" href="<?php echo base_url('assets/css/demo_5/style.css') ?>">
 
  <link rel="stylesheet" href="<?php echo base_url('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') ?>">
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"  crossorigin="anonymous">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js"></script>
 <?php if(isset($page_type) && $page_type =='spotlight2'): ?>
 <script src="<?php echo base_url('assets/profile/fileinput.js') ?>"></script>
 

 
 
 <?php endif ?>
  <?php if(isset($page_type) && $page_type =='post_detail'): ?>
<meta property="og:url" content="<?php echo base_url('detail/'.$spotlight->postSlug) ?>" />
<meta property="og:type" content="article" />
<meta property="og:title"  content="<?php echo $spotlight->postTitle ?>" />
<meta property="og:description" content="<?php if(!empty($spotlight->postContent)){ echo substr(strip_tags($spotlight->postContent), 0,100); } ?>" />
<meta property="og:image" content="<?php echo base_url('uploads/cover_photo/'.$spotlight->cover_photo); ?>" />
<?php endif; ?>
  <?php if(isset($page_type) && $page_type =='user_profile'): ?>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />
   <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/themes/krajee-svg/theme.css" media="all" rel="stylesheet" type="text/css" />
<style>
@font-face{font-family:'Glyphicons Halflings';src:url('//netdna.bootstrapcdn.com/bootstrap/3.0.0/fonts/glyphicons-halflings-regular.eot');src:url('//netdna.bootstrapcdn.com/bootstrap/3.0.0/fonts/glyphicons-halflings-regular.eot?#iefix') format('embedded-opentype'),url('//netdna.bootstrapcdn.com/bootstrap/3.0.0/fonts/glyphicons-halflings-regular.woff') format('woff'),url('//netdna.bootstrapcdn.com/bootstrap/3.0.0/fonts/glyphicons-halflings-regular.ttf') format('truetype'),url('//netdna.bootstrapcdn.com/bootstrap/3.0.0/fonts/glyphicons-halflings-regular.svg#glyphicons-halflingsregular') format('svg');}.glyphicon{position:relative;top:1px;display:inline-block;font-family:'Glyphicons Halflings';font-style:normal;font-weight:normal;line-height:1;-webkit-font-smoothing:antialiased;}

.glyphicon-star:before{content:"\e006";}
.glyphicon-star-empty:before{content:"\e007";}
</style>
<?php endif; ?>
      <style>
.fix_star_color svg {
    color: #007bff;
    fill: #007bff;
    width: 18px;
    height: 18px;
    margin-right: 3px;
}
.box_content {min-width:200px}
 .fix_star_color  span{
    font-size: 17px;
    font-weight: bold
 }
	  .cover-body .designation{color:#FFF}
	 .comment_holder .bg-warning {
    background-color: white !important;
}
	  .dropzone .dz-preview .dz-image {
    width: 300px !important;
    height: auto;
}
.edit_b_link {
    text-align: right;
    display: block;
    margin: 12px 10px;
	margin-bottom: 0;
}
.dropzone .dz-preview .dz-image img {
    display: block;
    width: auto;
}
	  #photoUpload{    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;}
	  #photoUpload:hover .feather-edit{
			position: relative;
			z-index: 2;
			color: white;
		cursor:pointer;
		}
	  .like_count .msg{margin-left:3px}
	  .socail_roww .mb-3 {
    margin-bottom: 1.5rem !important;
}
 .socail_roww .input-group-prepend{position:relative}
.socail_roww label.error{color:#F00;position: absolute;
    top: 100%;
    margin-top: 3px}
	  @media (min-width: 576px){
		 #profile_pic .modal-dialog {
			max-width: 800px;
		}
	  }
	 
	  #user_notify_drop .dropdown-body{max-height:300px !important;}
	  .horizontal-menu .bottom-navbar .page-navigation > .nav-item.active > .nav-link,
	  .horizontal-menu .bottom-navbar .page-navigation > .nav-item.active > .nav-link .menu-title,
	  .horizontal-menu .bottom-navbar .page-navigation .nav-item.active .nav-link .link-icon{color:#000 !important;}
	  .horizontal-menu .bottom-navbar .page-navigation > .nav-item:hover > .nav-link .link-arrow, 
	  .horizontal-menu .bottom-navbar .page-navigation > .nav-item:hover > .nav-link .link-icon, 
	  .horizontal-menu .bottom-navbar .page-navigation > .nav-item:hover > .nav-link .menu-title,
	 .horizontal-menu .bottom-navbar .page-navigation > .nav-item.active2 > .nav-link,
	  .horizontal-menu .bottom-navbar .page-navigation > .nav-item.active2 > .nav-link .menu-title,
	   .horizontal-menu .bottom-navbar .page-navigation .nav-item.active2 .nav-link .link-icon
	  {color:#727cf5 !important;}
	  .profile-page .profile-header .cover .cover-body{z-index:99}
	    .pagination .page-item.active a{ background:#727cf5;
		border: 1px solid #727cf5;
		color:#fff;
		}
	    .pagination .page-item a svg{height: 17px;}
	  .pagination .page-item a {
    position: relative;
    display: block;
    padding: 0.5rem 0.75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #007bff;
    background-color: #fff;
    border: 1px solid #dee2e6;
}
	  .pager_boxxx{width:100%}
	  .profile-page .profile-header .cover .gray-shade2 {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
    background: linear-gradient(rgba(0, 0, 0, 0.1), #000 320%);
}
	  .profile-page .profile-header .cover .cover-body .profile-name {
    color: #fff;
}
	  .comment-tree .report-comment{display:none !important;}
	  .comment-tree img{    height: 50px;
    width: auto;}
	  .heartfill svg{fill:#727cf5 !important; color:#727cf5}
	  .comment-tree .reply-comment{display:none !important;}
	 .comment-tree{
    /* margin: 20px 0; */
    padding-bottom: 15px;
    padding-top: 15px;
}
	  .btn-group.absolute{position: absolute;
    right: 0;}
	  #addCommentForm2{background-color: #fff !important} 
	 .commentArea .btn  .fa{
		      font-size: 25px;
    margin-left: 10px;
	 }
	  .commentArea .input-group {
		  padding: 10px 0;
    justify-content: center;
    align-items: center;
}
	  .dropzone .dz-preview .dz-image{width:200px !important;}
	  h4 .edit_my_pr{    font-size: 15px;
    margin-left: 10px;}
.card_content .post_titlee {
 display: block;
 display: -webkit-box;
 max-width: 100%;
 margin: 0 auto;
 -webkit-line-clamp: 2;
 /* autoprefixer: off */
 -webkit-box-orient: vertical;
 /* autoprefixer: on */
 overflow: hidden;
 text-overflow: ellipsis;
}
	  .set-card-spacing .grid-margin .card-body .card_content{padding:10px 12px}
	  .set-card-spacing .grid-margin .card-body .card_content p{ padding:0}
	  .dropzone .dz-preview .dz-image img {
    display: block;
    width: 100%;
}
.set-card-spacing .grid-margin .card-body .card_content.mb-2{margin-bottom:0 !important;     padding-bottom: 0;}
#dropzone {width:100%}
#dropzone .dropzone {
    border: 2px dashed #0087F7 !important;
    border-radius: 5px !important;
    background: white !important;
	    max-height: 100% !important;
overflow:visible !important;
}
.btn-recommended_business.followed{    background: #214FFB !important;
    border-color: #214FFB !important;
    color: #fff !important;}
.dropzone.dz-started .dz-message {
    display: block;
    font-size: 1rem;
    font-weight: 600;
}
	  .tabThumbnail .dropzone {width:100%;}
#wysiwyg{display:block !important; height:0 !important; visibility:hidden}
	  .form-group #tags2,

	 .form-group #tags{display:block !important; visibility:hidden !important; height:0 !important;}

	  #myDropify-error {

    color: red;

    padding: 10px;

    position: absolute;

    top: 0;

    text-align: center;

    width: 100%;

    left: 0;

}
.profile-header .cover figure {
    position: relative;
    height: 271px;
    overflow: hidden;
}
.fixx_img .img-fluid{width:100%}
.profile-header .cover figure img{    object-fit: cover;
    position: absolute;
	width:100%;
	top:0; 
	right:0; 
	left:0
   }
.fixxx_msg_form{width: 100%;
    display: flex;}
.suggest_sodaa .d-flex{align-items: center; }
.suggest_sodaa .btn.btn-icon{height:auto}
.loader { width: 100%;
    position: absolute;
    height: 100%;
    background-color: #fff !important;
    z-index: 1;
	background-image:url(<?php echo base_url('assets/preloader.gif') ?>);
	background-repeat: no-repeat;
    background-position: center;
}
.img_box{display:inline-block;position:relative}
.img_box:hover .abs_icon{display:block}
.img_box .abs_icon {
    position: absolute;
    top: 8px;
    left: 50%;
    color: white;
    font-size: 15px;
	display:none
}
.commentBtn22{
    padding: 13px 15px;
    margin-left: 6px;
}
.commentArea .input-group .input-group-addon img{width:50px;     border-radius: 100% !important; height:auto}
.form-group label.error{color:red !important;}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    cursor: inherit;
    display: block;
    z-index: 9;
}
.profile-header .cover figure img {
    object-fit: cover;
    position: absolute;
    width: 100%;
    top: 0;
    right: 0;
    /* object-fit: contain; */
    /* object-fit: contain !important; */
    object-position: center;
    height: 100%;
}

	  </style>
 <link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css') ?>" />
   </head>