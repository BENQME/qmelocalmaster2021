
<style>
.form-inline > * {
   margin:5px 3px;
}
.form-inline input[type="text"]{
	padding: 7px 15px;
    height: auto;
	width:100%;
	}
.form-inline button {
    padding: 10px 15px;
    height: auto;
	background:#D71921;
	color:#fff;
}

.bootstrap-datetimepicker-widget table td.day {
    height: 20px;
    line-height: 20px;
    width: 20px;
    background: #024287 !important;
    color: #fff !important;
    opacity: 1;
}
.bootstrap-datetimepicker-widget table td.disabled.day {
	background: none !important;
    color: #dee2e6 !important;
}
@media (min-width: 768px){
.right_boxxx{float:right}
}
</style>
<section class="content-section" style="padding:30px 0">
  <div class="container">
    <div class="row align-items-center" style="margin-bottom:20px;">
    <?php if($slug =='events'): ?>
      <div class="col-12 col-md-4">
        <h2 class="section-title" style="margin-bottom:0"><?php echo $page_title ?></h2>
      </div>
       <div class="col-12 col-md-8">
       <?php echo sidebar_by_url(current_url()) ?>
        <div class="right_boxxx">
        
        	<form class="form-inline" method="get">
            	<div class="form-group"><input class="form_datetime2 form-control" type="text" name="start_date" value="<?php echo $_GET['start_date']  ?>" placeholder="View Event Calendar" /></div>
            	<?php /*?><div class="form-group"><input class="form_datetime form-control" type="text" placeholder="Event End Date Time" value="<?php echo $_GET['end_date']  ?>"  name="end_date" /></div><?php */?>
            	<div class="form-group"><button type="submit" class="btn btn-primary">Search</button></div>
</form>
        </div>
      </div>
      <?php else: ?>
      <div class="col-6 col-md-4">
        <h2 class="section-title"><?php echo $page_title ?></h2>
      </div>
      <div class="col-6 col-md-8">
      <?php echo sidebar_by_url(current_url()) ?>
      </div>
      <?php endif;?>
      <!-- end col-12--> 
    </div>
    <?php 
	if($spotlight_all2){
		foreach($spotlight_all2 as $spotlight){ ?>
			<?php if($slug =='events')
				{
				 $start_d[] = date('m/d/y',strtotime($spotlight['event_start_date']));
				}
		}
	}
	?>
    <?php if($spotlight_all): ?>
    <div class="row">
    <?php foreach($spotlight_all as $spotlight): ?>
      <div class="col-lg-4 col-md-6">
        <div class="blog-post kansas">
          <figure class="post-image">
          <?php if($spotlight['em_video']):?><?php echo convertYoutube($spotlight['em_video'],$spotlight) ?>
          <?php else: ?>
          <a href="<?php echo base_url('detail/'.$spotlight['postSlug']) ?>" class="bookmark2">
          <?php if(!empty($spotlight['cover_photo'])):?>
					<img class="img-fluid" src="<?php echo base_url('uploads/cover_photo/'.$spotlight['cover_photo']); ?>" />
				<?php else: ?>
					<img class="img-fluid" src="<?php echo base_url('assets/images/placeholder.jpg')?>" />
				<?php endif;?> 
                </a>
          <?php endif;?>
          </figure>
          <div class="post-content">
             <ul class="post-categories">
                 <?php /*?> <?php if($spotlight['spotlight_type'] == 'Spotit Spotlight') $haha = 'General Spotlight'; else $haha = $spotlight['spotlight_type']; ?>
                    <li><a><?php echo $haha ?></a></li><?php */?>
                    <li><a><?php echo $spotlight['category'] ?></a></li>
                  </ul>
            <h3 class="post-title"><a href="<?php echo base_url('detail/'.$spotlight['postSlug']) ?>"><?php echo $spotlight['postTitle']; ?></a></h3>
            <div class="metas"> 
            <?php if($slug =='events'): ?>
              <strong class="date">Event Date: <?php echo date('F d, Y',strtotime($spotlight['event_start_date'])); ?></strong>
            <?php else: ?>
            <span class="date"><?php echo date('F jS Y',strtotime($spotlight['created_at'])); ?></span>
              <div class="dot"></div>
              <span class="author">
              
               <a href="<?php echo base_url('publicprofile/'.$spotlight['userid']) ?>"><?php 
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
              
              </span> 
              
              <?php endif;?>
              </div>
            <!-- end metas --> 
          </div>
          <!-- end post-content --> 
        </div>
       </div>
       <?php endforeach;?>

    </div>
      <p class="text-center wow fadeInUp">
        
        <a href="<?php echo base_url('login') ?>" class="show-more">SHOW MORE</a>
        </p>
    <?php else: ?>
    <h4> No  Spotlights Found</h4>
    <?php endif;?>
      
  </div>
  <!-- end container --> 
</section>
<?php if($slug =='events'): ?>
<?php //echo $date_string = implode(',',$start_d); ?>
<script>
var available_Dates = <?php echo json_encode($start_d)?>;
$('.form_datetime2').datetimepicker({
	 format: 'DD-MM-YYYY',
	  enabledDates : available_Dates
  });
  $('.form_datetime2').on('change', function(e){ 
    var formatedValue = this.val();
	alert(formatedValue)
    console.log(formatedValue);
})
</script>
<?php endif;?>