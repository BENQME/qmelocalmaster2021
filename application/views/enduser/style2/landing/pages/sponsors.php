<style>
.sponser_sec .kansas .post-image img {
    width: 100%;
    height: 250px;
    object-fit: contain;
}
.sponser_sec .blog-post .metas,
.sponser_sec .kansas{text-align:center; display:block}
.btn-primary2 {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
    background: #ddd;
    color: #007bff;
    border: none;
    display: block;
}
.fa-bookmark:before {
    line-height: 2.5;
}
.kansas .post-title {
    font-size: 18px;
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
.sponser_sec .blog-post .post-categories {
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
.page-header h2{
color:#0D2F81 !important;
}
.page-header{border-bottom:none;}
</style>

<?php $p_category = json_decode($page_data->spot_category); ?>
<section class="page-header">
  <div class="container">
    <div class="row">
      <div class="col-12">
      <?php /*?><?php if($cat_titlee){ ?>
      	<h4><?php echo $cat_titlee ?></h4>
	  <?php }else { ?>
      <h4>All</h4>
      <?php } ?><?php */?>
        <h2><?php echo $page_data->pageTitle ?></h2>
        <?php if($p_category): ?>
        <div class="dropdown22 form-inline">
        <label> Choose</label>
            <select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" class="form-control2">
            <option value="<?php echo base_url('page/'.$page_data->pageSlug.'/all') ?>">Industry</option>
            <?php foreach($p_category as $cat){ ?>
            <?php $cat_id =$this->db->get_where('spotlights_category',array('categoryTitle'=>$cat))->row()->categoryID ?>
            	<option<?php if($this->uri->segment(3) == $cat_id ) echo ' selected="selected"' ?>  value="<?php echo base_url('page/'.$page_data->pageSlug.'/'.$cat_id) ?>"><?php echo $cat ?></option>
                <?php } ?>
            </select>
        </div>
        <?php endif;?>
      </div>
    </div>
    <!-- end row --> 
  </div>
  <!-- end container --> 
</section>
<?php if($cat_titlee): ?>
<?php $sponsors = $this->db->order_by('s_id','desc')->get_where('sponsers',array('category'=>$cat_titlee,'sponser_category'=>$page_data->pageID))->result() ?>
<?php else: ?>
<?php $sponsors = $this->db->order_by('s_id','desc')->get_where('sponsers',array('sponser_category'=>$page_data->pageID))->result() ?>
<?php endif;?>
<?php if($sponsors): ?>
<section class="sponser_sec content-section">
  <div class="container">
    <div class="row">
      <?php foreach($sponsors as $sponsor): ?>
      <div class="eq_height_wrapper col-md-4 col-sm-6">
          <div class="blog-post eq_hight kansas text-center">
              <figure class="post-image">
              <?php 
               if($sponsor->thumbnail)
                  $thumbnail =base_url('uploads/sponsors/'.$sponsor->thumbnail);
                  else   
                  $thumbnail = base_url('assets/images/placeholder.jpg'); 
              
              ?>
              <img src="<?php echo $thumbnail ?>" alt="<?php echo $sponsor->title ?>"> 
              
              </figure>
              <div class="post-content text-center">
              <ul class="post-categories">
                    <li><a><?php echo $sponsor->category ?></a></li>
                  </ul>
                
                <h3 class="post-title"><a>
				<?php echo  $sponsor->title ?></a></h3>
                <div class="metas2 text-center">
                <?php echo  $sponsor->content ?>
               
                </div>
                <!-- end metas --> 
              </div>
              <?php $url_array =  (array)json_decode($sponsor->url);?>
              <div class="link_holder">
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
               </div>
          </div>
       
      
      </div>
      <?php endforeach;?>
    </div>
    <!-- end row --> 
  </div>
  <!-- end container --> 
</section>
<?php endif;?>

<section class="content-section" style="padding:0">
  <div class="container">
   <?php if($spotlight_all): ?>
    <div class="row">
      <div class="col-12">
        <h2 class="section-title">
		
        <?php if($cat_titlee){ ?>
      <h4><?php echo 'Spotlights: '.$cat_titlee ?></h4>
	  <?php }else{ ?>
      <h4>Related Spotlights</h4>
	  <?php }?>
        
        </h2>
      </div>
      <!-- end col-12--> 
    </div>
   
    <div class="row">
    <?php foreach($spotlight_all as $spotlight): //print_r($spotlight) ?>
      <div class="col-lg-4 col-md-6">
        <div class="blog-post kansas">
          <figure class="post-image">
          <?php if($spotlight['em_video']):?><div style="margin:0" class="fluid-width-video-wrapper"><?php echo convertYoutube($spotlight['em_video']) ?></div>
          <?php else: ?>
          <a href="<?php echo base_url('detail/'.$spotlight['postSlug']) ?>" class="bookmark"><i class="fal fa-bookmark"></i></a> 
          <?php if(!empty($spotlight['cover_photo'])):?>
					<img class="img-fluid" src="<?php echo base_url('uploads/cover_photo/'.$spotlight['cover_photo']); ?>" />
				<?php else: ?>
					<img class="img-fluid" src="<?php echo base_url('assets/images/placeholder.jpg')?>" />
				<?php endif;?> 
          <?php endif;?>
          
          </figure>
          <div class="post-content">
             <ul class="post-categories">
                  <?php /*?><?php if($spotlight['spotlight_type'] == 'Spotit Spotlight') $haha = 'General Spotlight'; else $haha = $spotlight['spotlight_type']; ?>
                    <li><a><?php echo $haha ?></a></li><?php */?>
                    <li><a><?php echo $spotlight['category'] ?></a></li>
                  </ul>
            <h3 class="post-title"><a href="<?php echo base_url('detail/'.$spotlight['postSlug']) ?>"><?php echo $spotlight['postTitle']; ?></a></h3>
            <div class="metas"> 
            
            <span class="date"><?php echo date('F jS Y',strtotime($spotlight['created_at'])); ?></span>
              <div class="dot"></div>
              <span class="author">
              
               By <a href="<?php echo base_url('publicprofile/'.$spotlight['userid']) ?>"><?php 
					 $full_name =$spotlight['first_name'].' '.$spotlight['last_name'];
					 if (strlen($full_name) > 30)
						{
							echo substr($full_name, 0, 30)."...";
						}
						else
						{
							echo $full_name;
						}
?>
					 <?php // echo $bandage ?></a>
              
              </span> </div>
            <!-- end metas --> 
          </div>
          <!-- end post-content --> 
        </div>
       </div>
       <?php endforeach;?>

    </div>
      <p class="text-center wow fadeInUp">
        
       <?php echo $links ?>
        </p>
    <?php else: ?>
    <h4 style="margin-top:20px"> No  Spotlights Found</h4>
    <?php endif;?>
      
  </div>
  <!-- end container --> 
</section>
