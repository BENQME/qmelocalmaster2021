<?php //print_r($page_data) ?>
<section class="page-header">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2>Partners</h2>
      </div>
      <!-- end col-12 --> 
    </div>
    <!-- end row --> 
  </div>
  <!-- end container --> 
</section>
<section class="content-section">
  <div class="container">
    <div class="row">
      <?php $partners = $this->db->order_by("b_id", "desc")->get_where('home_blocks',array('post_type'=>'partners'))->result();?>
<?php if($partners): ?>
<?php foreach($partners as $partner): ?>
            <div class="col-md-2 px-1">
              <?php if($partner->thumbnail): ?>
              <div class="content_box">
               <a target="_blank" href="<?php echo $partner->title ?>"><img src="<?php echo base_url('uploads/home_sponsors/'.$partner->thumbnail)	 ?>" /></a>
             
              </div>
              <?php endif;?>
            </div>
             <?php endforeach;?>
<?php endif;?>
    </div>
    <!-- end row --> 
  </div>
  <!-- end container --> 
</section>