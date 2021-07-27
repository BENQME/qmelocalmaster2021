<?php //print_r($page_data) ?>
<style>
.card-body .btn2:hover,
.card-body .btn2:focus,
.card-body .btn2{
    margin-bottom: 15px;
    background: none !important;
    border: none;
    border-bottom: 2px solid #0D2F81 !important;
    color: #000;
    border-radius: 0;
    line-height: 15px;
    width: max-content;
	outline:none !important;
}
.modal-header .bsm-modal-x-btn {
    top: 5px;
    margin: 0;
    z-index: 1;
    padding: 0;
    opacity: 1;
    right: 15px;
    cursor: pointer;
    line-height: 1;
    text-shadow: none;
    position: absolute;
    font-weight: 700;
    font-family: inherit;
    background: transparent;
    border: none;
    color: #fff;
    font-size: 40px;
    font-weight: normal;
}
.modal-header {
    border-top-left-radius: calc(0px - 0px);
    border-top-right-radius: calc(0px - 0px);
    background: rgb(34, 34, 34);
    border-bottom-color: rgba(233, 236, 239, 0);
    display: block;
    color: #ffffff !important;
    padding: 14px 10px;
}
.modal-header h4{margin-bottom:0}
</style>
<section class="about_us page_title">

<div class="container">
  <div class="row">
    <div class="col-12">
      <h2 style="font-weight:700"><?php echo $page_data->pageTitle ?></h2>
    </div>
    <!-- end col-12 --> 
  </div>
  <!-- end row --> 
</div>
</section>
<section class="about_goal">
  <div class="container">
    <div class="row text-center goal_box">
      <div class="col-md-8 col-8 center_content">
        <div class="icon"> <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="46" height="46" viewBox="0 0 46 46">
          <defs>
            <linearGradient id="linear-gradient" x1="0.5" x2="0.5" y2="1" gradientUnits="objectBoundingBox">
              <stop offset="0" stop-color="#fff"/>
              <stop offset="1" stop-color="#91a6d8"/>
            </linearGradient>
          </defs>
          <g id="goal" transform="translate(0)" opacity="0.82">
            <path id="Path_1" data-name="Path 1" d="M9.771,331.738a3.579,3.579,0,0,1,.537-2.963l6.55-9.333-3.7-5.125a.9.9,0,0,0-1.458,0l-11.534,16A.9.9,0,0,0,.9,331.738Z" transform="translate(0 -285.738)" fill="url(#linear-gradient)"/>
            <path id="Path_2" data-name="Path 2" d="M312.424,19.078v-4.7h11.23a1.348,1.348,0,0,0,1.144-2.06l-2.352-3.78,2.352-3.78a1.348,1.348,0,0,0-1.144-2.06h-11.23V1.348a1.348,1.348,0,1,0-2.7,0V19.078A1.738,1.738,0,0,1,312.424,19.078Z" transform="translate(-281.902 0)" fill="url(#linear-gradient)"/>
            <path id="Path_3" data-name="Path 3" d="M161.672,349.174l-3.217,3a1.348,1.348,0,0,1-1.837,0L154.284,350l-2.333,2.174a1.348,1.348,0,0,1-1.837,0l-3.217-3-9.273,13.214a.9.9,0,0,0,.735,1.414h31.85a.9.9,0,0,0,.735-1.414Z" transform="translate(-125.11 -317.803)" fill="url(#linear-gradient)"/>
            <path id="Path_4" data-name="Path 4" d="M262.238,249.441l2.333-2.174a1.348,1.348,0,0,1,1.837,0l2.334,2.174,2.6-2.364-5.112-7.285a.9.9,0,0,0-1.471,0l-5.112,7.285Z" transform="translate(-236.315 -217.9)" fill="url(#linear-gradient)"/>
          </g>
          </svg> </div>
        <p>MBN USA’s mission is to promote the value of minority business development and recognize
          corporate supplier diversity success.</p>
      </div>
      <!-- end col-12 --> 
    </div>
    <!-- end row -->
    <div class="row about_content align-items-center">
      <div class="col-md-6">
        <p>MBN USA was founded in 1988 when founder and CEO Don McKneely recognized the need for a news source to tell the powerful stories of MBEs and the corporations that support them. Since its inception, MBN USA has received numerous awards for its work in MBE supplier diversity development. These include being recognized by the U.S. Department of Commerce Small Business Administration (SBA) and being named the National Supplier of the Year by the National Minority Supplier Development Council (NMSDC).</p>
      </div>
      <div class="col-md-6"> <img lass="img-thumbnail img-responsive" src="<?php echo base_url('landing_file/style2/images/about_right.png') ?>"> </div>
    </div>
  </div>
</section>
<section class="what_we_do">
  <div class="container">
    <h2 class="about_s_title">What we do</h2>
    <div class="row">
      <div class="col-md-4 col-sm-6">
        <div class="content_box">
          <div class="icon"><img src="<?php echo base_url('landing_file/style2/images/1.svg') ?>" /></div>
          <div class="content">
            <p>MBN USA showcases the commitment of America’s top corporations to diversity and inclusion.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="content_box">
          <div class="icon"><img src="<?php echo base_url('landing_file/style2/images/02.svg') ?>" /></div>
          <div class="content">
            <p>MBN USA profiles top corporate supplier diversity programs and shares how they coordinate across lines of business and business functions to advance diversity in the supply chain.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="content_box">
          <div class="icon"><img src="<?php echo base_url('landing_file/style2/images/3.svg') ?>" /></div>
          <div class="content">
            <p>MBN USA provides a platform for exploration of the business case for the inclusion of MBE suppliers.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-6">
        <div class="content_box">
          <div class="icon"><img src="<?php echo base_url('landing_file/style2/images/4.svg') ?>" /></div>
          <div class="content">
            <p>MBN USA actively supports and promotes organizations that are allies in the empowerment of diverse business owners.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="content_box">
          <div class="icon"><img src="<?php echo base_url('landing_file/style2/images/5.svg') ?>" /></div>
          <div class="content">
            <p>MBN USA celebrates and connects diverse business owners, leaders, and advocates.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
 <?php $team = $this->db->order_by("b_id", "desc")->get_where('home_blocks',array('post_type'=>'team'))->result();?>
<?php if($team): ?>
<section class="about_team">
  <div class="container">
    <h2 class="about_s_title">MBN USA <br />
      Executives</h2>
    <div class="row text-center">
     <?php foreach($team as $t): ?>
      <div class="col-md-4 col-sm-6">
        <div class="card ">
        <?php if($t->thumbnail): ?>
          <div class="img_box"> <img lass="img-responsive" src="<?php echo base_url('uploads/team/'.$t->thumbnail)	 ?>"> </div>
          <?php endif;?>
          <div class="card-body">
            <div class="content">
              <h6><?php echo $t->title?></h6>
              <?php $fields = $t->custom_fields; 
				 $fields = json_decode($fields);  ?>
              <div class="tem_content">
                <p> <?php echo $fields->short_info ?></p>
              <a class="btn btn2" data-toggle="modal" data-target="#bio<?php echo $t->b_id?>">Read Full Bio</a>
              </div>
              <?php if( $fields->linkedin): ?>
               
               		<a target="_blank" class="btn btn-primary" href="<?php echo $fields->linkedin ?>">Linkedin</a>
               <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
        
    
        
      <?php endforeach;?>
<?php /*?>      <div class="col-md-4 col-sm-6">
        <div class="card ">
          <div class="img_box"> <img lass="img-responsive" src="http://placehold.it/400x250/81fdc5/000&amp;text=Team Picture"> </div>
          <div class="card-body">
            <div class="content">
              <h6>Don McKneely</h6>
              <span class="tem_info">President</span>
              <div class="tem_content">
                <p> MBN USA was founded in 1988 when founder and CEO Don McKneely recognized the need for a news source to tell the powerful stories of MBEs and the corporations that support them.</p>
               
              </div>
               <a class="btn btn-primary" href="#">Linkedin</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div class="card ">
          <div class="img_box"> <img lass="img-responsive" src="http://placehold.it/400x250/81fdc5/000&amp;text=Team Picture"> </div>
          <div class="card-body">
            <div class="content">
              <h6>Don McKneely</h6>
              <span class="tem_info">President</span>
              <div class="tem_content">
                <p> MBN USA was founded in 1988 when founder and CEO Don McKneely recognized the need for a news source to tell the powerful stories of MBEs and the corporations that support them.</p>
               
              </div>
               <a class="btn btn-primary" href="#">Linkedin</a>
            </div>
          </div>
        </div>
      </div><?php */?>
    </div>
  </div>
</section>
<?php endif;?>
<section class="about_signup">
    <div class="container">
    <div class="join_text">
     <h2 class="about_s_title">Join MBN Community</h2>
     <a  class="btn btn_join_now" href="<?php echo base_url('login')?>"> Join Now</a>
    </div>
    </div>
</section>
<?php if($team): ?>
 <?php foreach($team as $t): ?>
<div class="modal fade" id="bio<?php echo $t->b_id ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $t->b_id ?>" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        
                       <h4><?php echo $t->title?></h4>
                       <button type="button" class="bsm-modal-x-btn" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body">
                       <?php $fields = $t->custom_fields; 
				 $fields = json_decode($fields);  ?>
                       <?php echo $fields->full_info ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                       
                    </div>
                </div>
            </div>
        </div>
<?php endforeach;?>
<?php endif;?>
<?php /*?><section class="page-header">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2><?php echo $page_data->pageTitle ?></h2>
      </div>
      <!-- end col-12 --> 
    </div>
    <!-- end row --> 
  </div>
  <!-- end container --> 
</section>
<section class="content-section no-space">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
      <div class="page_content">
        <?php if($page_data->pageContent) echo $page_data->pageContent; ?>
        </div>
      </div>
      <!-- end col-8 -->
      <div class="col-lg-4">
        <aside class="sidebar sticky-top">
        <?php echo sidebar('default')?>
          
        </aside>
        <!-- end sidebar --> 
      </div>
      <!-- end col-4 --> 
    </div>
    <!-- end row --> 
  </div>
  <!-- end container --> 
</section><?php */?>
