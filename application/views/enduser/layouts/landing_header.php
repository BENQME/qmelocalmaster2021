<!DOCTYPE html>
<html>
   <head>
      <title><?php echo strtoupper(site_info()) ?> | Homepage</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
      <meta charset="UTF-8">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('landing_file/css/bootstrap.min.css') ?>" />
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('landing_file/css/style.css') ?>" />
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('landing_file/css/font-awesome.css') ?>" />
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('landing_file/css/animate.css') ?>" />
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('landing_file/css/hover.css') ?>" />
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('landing_file/css/owl.carousel.min.css') ?>" />
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('landing_file/css/owl.theme.default.min.css') ?>" />
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('landing_file/css/form.css') ?>" />
      <style>
	  .badge-secondary2{
    border-radius: 0;
    padding: 5px 11px;
    background: #36a4f7;
}
.trending-activites .thumbnail .caption {

    padding: 14px 15px;
}
	 #ios_popup .modal-footer {
			border-top: none;
			text-align: center;
		}
		#ios_popup .modal-footer button {
    text-transform: capitalize;
}
#ios_popup .modal-header {
    padding: 0;
    border-bottom: none;
}
#ios_popup .modal-header .close {
    margin-top: 10px;
    margin-right: 10px;
    background: #FEDC00 !important;
    background: none;
    font-size: 30px;
    opacity: 1;
    width: 30px;
    height: 30px;
line-height: 35px;
    border-radius: 100%;

}
.trending-list .btn:hover,
.trending-list .btn.active2{ background:#36a4f7 !important;}
.trending-activites .fluid-width-video-wrapper{min-height: 226px;}
@media (min-width: 768px) and (max-width: 991px){
nav.navbar-findcond .navbar-right .btn-project {
   padding: 12px 10px !important;
}
@media (max-width: 1100px){

.navbar-findcond .container {
    display: flex;
    flex-flow: column;
    align-items: center;
}
}

	  </style>
           <?php $logo_settings = json_decode(site_settings('logo_settings'));
		   if($logo_settings->favicon){  ?>
             <link rel="icon" type="image/png" href="<?php echo base_url().'uploads/banners/'.$logo_settings->favicon ?>">
			<link rel="icon" type="image/png" href="<?php echo base_url().'uploads/banners/'.$logo_settings->favicon ?>">
           <?php } else{ ?>
                <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/favicon.png') ?>">
				<link rel="icon" type="image/png" href="<?php echo base_url('assets/img/favicon.png') ?>">
           <?php } ?>
    
   </head>
   <body>
   <?php $this->load->view('enduser/landing/header'); ?>
         <?php echo $page_content ?>
         <?php $this->load->view('enduser/landing/footer'); ?>
      <script type="text/javascript" src="<?php echo base_url('landing_file/js/jquery.js') ?>"></script>
      <script type="text/javascript" src="<?php echo base_url('landing_file/js/bootstrap.min.js') ?>"></script>
      <script type="text/javascript" src="<?php echo base_url('landing_file/js/index.js') ?>"></script>
      <script type="text/javascript" src="<?php echo base_url('landing_file/js/wow.js') ?>"></script>
      <script type="text/javascript" src="<?php echo base_url('landing_file/js/owl.carousel.js') ?>"></script>
      <script type="text/javascript" src="<?php echo base_url('landing_file/js/jcf.js') ?>"></script>
      <script type="text/javascript" src="<?php echo base_url('landing_file/js/jcf.select.js') ?>"></script>
       <script src="<?php echo base_url('assets/fitvids.js') ?>"></script>
      <script>
         $(document).ready(function() {
				jcf.setOptions({
	wrapNative: false,
	wrapNativeOnMobile:false
});
			jcf.replaceAll();
            new WOW().init();
            
         $(".filter-button").click(function(){
                var value = $(this).attr('data-filter');
                if(value == "all")
                {
                    $('.filter').show('1000');
                }
                else
                {
                    $(".filter").not('.'+value).hide('3000');
                    $('.filter').filter('.'+value).show('3000');         
                }
            });
         $('.service_carousel').owlCarousel({
               autoplay: true,
               loop: true,
               autoplayHoverPause: true,
               nav:true,
               dots: false,
               navText: ['<i class="ti-arrow-left"></i>',''],
               responsive: {
                  0: {
                  items: 1
                  },
                  500: {
                  items: 2
                  },
                  600: {
                  items: 2
                  },
                  800: {
                  items: 2
                  },
                  1200: {
                  items: 4
                  }
         
               }
            });
         
            $('.spotlight-slider').owlCarousel({
               autoplay: true,
               loop: true,
               margin: 15,
               slideTransition: 'linear',
               autoplayTimeout: 4500,
               autoplayHoverPause: true,
               autoplaySpeed: 4500,
               nav:false,
               dots: true,
               // navText: ['<span class="fa fa-arrow-left"></span>','<span class="fa fa-arrow-right"></span>'],
               responsive: {
                  0: {
                  items: 1
                  },
                  500: {
                  items: 2
                  },
                  600: {
                  items: 2
                  },
                  800: {
                  items: 2
                  },
                  1200: {
                  items: 3
                  }
         
               }
            });
         
         
            $('.btn-slider').owlCarousel({
               autoplay: true,
               loop: true,
               margin: 15,
               autoplayTimeout: 4500,
               autoplayHoverPause: true,
               autoplaySpeed: 4500,
               nav:true,
               dots: false,
               navText: ['<span class="fa fa-arrow-left"></span>','<span class="fa fa-arrow-right"></span>'],
               responsive: {
                  0: {
                  items: 1
                  },
                  500: {
                  items: 2
                  },
                  600: {
                  items: 2
                  },
                  800: {
                  items: 3
                  },
                  1200: {
                  items: 5
                  }
         
               }
            });
         
               $('.inner-content').hide();
         
                  $('.moreDetail1').click(function(){
                     $('.inner-content1').slideDown(200);
         
                  });
                  $('.moreDetail2').click(function(){
                     $('.inner-content2').slideDown(200);
         
                  });
                  $('.moreDetail3').click(function(){
                     $('.inner-content3').slideDown(200);
         
                  });
                  $('.moreDetail4').click(function(){
                     $('.inner-content4').slideDown(200);
         
                  });
                  $('.moreDetail5').click(function(){
                     $('.inner-content5').slideDown(200);
         
                  });
                  $('.moreDetail6').click(function(){
                     $('.inner-content6').slideDown(200);
         
                  });
                  $('.closeBtn').click(function(){
                        $(".inner-content").hide(200);
                  }); 
              
         });
      </script>
   <div id="ios_popup" class="modal fade" role="dialog">
  <div class="modal-dialog  modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
       <img src="<?php echo base_url('landing_file/images/ios_poup.png') ?>" class="img-responsive">
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn nextBtn" data-dismiss="modal">I got it, close this splash</button>
      </div>
    </div>

  </div>
</div>  
   </body>
</html>