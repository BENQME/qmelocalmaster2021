<div class="page-content">



    <!-- <h3><i class="link-icon" data-feather="home"></i> Steelton Spotlight</h3> -->
    
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div>
          <h4 class="mb-3 mb-md-0"><i class="link-icon" data-feather="home"></i> <?php echo site_info() ?> Admin Activities <span class="edit_my_pr"><a href="<?php echo base_url('dashboard/preference') ?>">Edit Your Preference</a></span></h4>
        </div>
        
      </div>

    <br />
    <div class="steelton_home_section">
    <div class="tab-content">
        
        <div class="tab-pane22" style="display:block">

            <div class="row set-card-spacing">
	
				<?php if($spotlight_all):
                foreach ($spotlight_all as $spotlight) { ?>
                    <?php include('sportlights/post_loop.php') ?>  
                <?php }?>
               
                    <div class="pager_boxxx text-center">
                     <div class="col-md-12"><?php echo $links; ?></div>
                    </div>
                <?php endif ?>
  
            </div> <!-- row -->
        </div> <!-- tab 1 -->
    </div>		
</div>
</div>