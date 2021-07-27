<div class="row set-card-spacing"><?php 
if($spotlight_all):
   $col_size =12;
	foreach ($spotlight_all as $spotlight) { ?>
      <?php include('sportlights/post_loop.php') ?>  
	<?php } ?>
    
  <?php endif;?>
   <div class="pager_boxxx text-center">
     <div class="col-md-12"><?php echo $links; ?></div>
    </div>

</div>