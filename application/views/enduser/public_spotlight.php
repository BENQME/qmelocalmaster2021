<div class="page-content">
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
<div>
<h4 class="mb-3 mb-md-0">Public Spotlight</h4>
</div>
<div class="d-flex align-items-center flex-wrap text-nowrap">

<?php if(!empty($this->input->get('search'))) $s_query = '?search='.$this->input->get('search');else $s_query =""; ?>
            <form id="search_feed" method="get" action="<?php echo base_url('dashboard/public_spotlight/'.$this->uri->segment(3)); ?>">
                <input class="typeahead" name="search" type="text" value="<?php if(isset($_GET['search']) && $_GET['search']) echo $_GET['search'] ?>" placeholder="Search">
            </form>
</div>
</div>
<div class="row set-card-spacing">
	<?php 
	 if($spotlight_posts):
	foreach ($spotlight_posts as $spotlight) { ?>
      <?php include('sportlights/post_loop.php') ?>  
<?php } endif ?>
 <div class="pager_boxxx text-center">
     <div class="col-md-12"><?php echo $links; ?></div>
    </div>
</div>
</div>
