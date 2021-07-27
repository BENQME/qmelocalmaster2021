
<style>
.blog-post:hover .post-image img{    transform: scale(1);}
.magazine_sec .blog-post .metas,
.magazine_sec .kansas{text-align:center; display:block}
.btn-primary2 {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
    background: #ddd;
    color: #007bff;
    border: none;
    display: block;
}
.kansas .post-image{margin-bottom:0;}
.fa-bookmark:before {
    line-height: 2.5;
}
.kansas .post-title {
    margin:0;
}
.page-header h2 {
    font-size: 34px;

}
select {
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: linear-gradient(45deg, transparent 50%, gray 50%), linear-gradient(135deg, gray 50%, transparent 50%), linear-gradient(to right, #ccc, #ccc);
    background-position: calc(100% - 30px) 20px, calc(100% - 25px) 20px, calc(100% - 3.5em) 0;
    background-size: 5px 5px, 5px 5px, 1px 40px;
    background-repeat: no-repeat;
height: 43px;
}
.dropdown22{margin-top:20px}
.dropdown22 label{
    font-size: 20px;
    font-weight: 700;
    margin-right: 10px;
}
.magazine_sec .blog-post .post-categories {
    align-items: center;
    justify-content: center;
}
.link_holder span a,
.link_holder span{color:#0D2F81; margin:0 5px;}
.link_holder span {
  display:inline-block; 
  padding:0 7px; 
  position:relative;
  line-height:1;
}
.link_holder span:not(:last-child)::after{
  content:""; 
  border:1px solid #0D2F81;
  position:absolute; 
  right:-3px; 
  top:0; 
  height:100%;
}
.magazine_sec .post-content{padding: 15px 5px;
}
.magazine_sec .kansas {
    text-align: center;
    display: block;
    background: #f1f1f1;
}
.content-section {
    padding: 30px 0;
}
</style>
<?php if($_GET['m_id']):?>
<style>
.ipgs,
embed{height:calc(100vh - 40px)!important;}
.header,
.navbar,
.footer {
display:none;
}
.back_box{ position:absolute; background: #007bff;}
.btn-primary {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
    border-radius: 0;
    font-size: 20px;
}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/magazine/css/style.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/magazine/min_version/ipages.min.css') ?>">
    <?php $pdf = $this->db->get_where('magazine',array('m_id'=>$_GET['m_id']))->row(); ?>
    
<div class="back_box"><a class="btn btn-primary" href="<?php echo base_url('page/'.$page_data->pageSlug) ?>"><i class="fa fa-book"> Back To List</i></a></div> 
<?php /*?><div class="ipgs-flipbook" style=" display:noneheight:70vh" data-pdf-src="<?php echo base_url('uploads/magazine/'.$pdf) ?>"></div><?php */?>
<div id="adobe-dc-view"></div>
<?php /*?><script src="https://documentcloud.adobe.com/view-sdk/main.js"></script>
<script type="text/javascript">
	document.addEventListener("adobe_dc_view_sdk.ready", function(){ 
		var adobeDCView = new AdobeDC.View({clientId: "563fba0f0aa44d84a53a1ee7d48970f3", divId: "adobe-dc-view"});
		adobeDCView.previewFile({
			content:{location: {url: "<?php echo base_url('uploads/magazine/'.$pdf) ?>"}},
			metaData:{fileName: "Bodea Survey.pdf"}
		},{defaultViewMode: "FIT_WIDTH",  showAnnotationTools: false, dockPageControls: false});
	});
</script><?php */?>
<?php /*?><div id="adobe-dc-view"></div>
<script src="https://documentcloud.adobe.com/view-sdk/main.js"></script>
<script type="text/javascript">
	document.addEventListener("adobe_dc_view_sdk.ready", function(){ 
		var adobeDCView = new AdobeDC.View({clientId: "563fba0f0aa44d84a53a1ee7d48970f3", divId: "adobe-dc-view"});
		adobeDCView.previewFile({
			content:{location: {url: "<?php echo base_url('uploads/magazine/'.$pdf->pdf) ?>"}},
			metaData:{fileName: "<?php echo $pdf->title ?>"}
		}, {defaultViewMode: "FIT_WIDTH", showAnnotationTools: false, showLeftHandPanel: false, 
			showPageControls: false, showDownloadPDF: false, showPrintPDF: false});
	});
</script><?php */?>
<?php /*?><script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.4/pdfobject.js"></script>
<script>
var options = {
    height: "100vh",
    pdfOpenParams: { view: 'FitV'}
};
PDFObject.embed("<?php echo base_url('uploads/magazine/'.$pdf) ?>", "#my-container", options); 
</script><?php */?>
<?php /*?><script type="text/javascript" src="<?php echo base_url('assets/magazine/js/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/magazine/min_version/pdf.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/magazine/min_version/jquery.ipages.min.js') ?>"></script><?php */?>
<?php else: ?>

<?php $p_category = $page_data->magazine_cat; ?>
<section class="page-header">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-12 col-md-4">
        <h2><?php echo $page_data->pageTitle ?></h2>
      </div>
      
      <div class="col-12 col-md-8">
      <?php echo sidebar_by_url(current_url()) ?>
      </div>
    </div>
    <!-- end row --> 
  </div>
  <!-- end container --> 
</section>
<?php if($p_category): ?>
<?php $magazine = $this->db->order_by('m_id','desc')->get_where('magazine',array('category'=>$p_category))->result() ?>
<?php endif;?>
<?php if($magazine): ?>
<section class="magazine_sec content-section">
  <div class="container">
    <div class="row">
      <?php foreach($magazine as $sponsor): ?>
      <div class="eq_height_wrapper col-md-3 px-5 col-sm-6">
          <div class="card eq_hight kansas text-center">
              <figure class="post-image">
              <a target="_blank" href="<?php echo $sponsor->pdf ?>">
				  <?php 
                   if($sponsor->thumbnail)
                      $thumbnail =base_url('uploads/magazine/'.$sponsor->thumbnail);
                      else   
                      $thumbnail = base_url('assets/images/placeholder.jpg'); 
                  
                  ?>
                  <img src="<?php echo $thumbnail ?>" alt="<?php echo $sponsor->title ?>"> 
              </a>
              </figure>
              <div class="post-content text-center">
              
                
                <h3 class="post-title"><a target="_blank" href="<?php echo $sponsor->pdf ?>">
				<?php echo  $sponsor->title ?></a></h3>
                <div class="metas2 text-center">
                <?php echo  $sponsor->content ?>
               
                </div>
                <!-- end metas --> 
              </div>
              <?php $url_array =  (array)json_decode($sponsor->url);?>
              <?php /*?><div class="link_holder">
               <?php if($url_array['website']){ ?>
               <span>
                <a target="_blank" href="<?php echo $url_array['website'] ?>">Visit Website</a>
                </span>
               <?php } ?>
               <?php if($url_array['profile']){ ?>
               <span> 
                <a target="_blank" href="<?php echo $url_array['profile'] ?>">View Profile</a> 
                </span>
               <?php } ?>
                <?php if($url_array['spot_url']){ ?>
                 <span>
           
                <a target="_blank" href="<?php echo $url_array['spot_url'] ?>">View Spotlight</a>
                </span>
               <?php } ?>
               </div><?php */?>
          </div>
       
      
      </div>
      <?php endforeach;?>
    </div>
    <!-- end row --> 
  </div>
  <!-- end container --> 
</section>
<?php endif;?>
<?php endif;?>