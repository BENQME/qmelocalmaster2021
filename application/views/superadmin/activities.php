
<div class="page-content">
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div>
          <h4 class="mb-3 mb-md-0"><?php if($this->uri->segment(3) =='news') echo 'Media & Blog';
		                             elseif($this->uri->segment(3) =='events') echo 'Events';
									  elseif($this->uri->segment(3) =='spotit') echo 'General Spotlights ';
									  elseif($this->uri->segment(3) =='jobs') echo 'Jobs
';
									  ?>
                                     
                                    </h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
<?php if(!empty($this->input->get('search'))) $s_query = '?search='.$this->input->get('search');else $s_query =""; ?>
        <div id="the-basics">
            <form id="search_feed" method="get" action="<?php echo base_url() ?>superadmin/activities/<?php echo $this->uri->segment(3); ?>">
                <input class="typeahead" name="search" type="text" value="<?php if(isset($_GET['search']) && $_GET['search']) echo $_GET['search'] ?>" placeholder="Search">
            </form>
        </div>
        </div>
      </div>

    <br />
    <div class="steelton_home_section">

    <div class="tab-content">
        <?php /*?><div class="tab-pane active" id="tabs-all" role="tabpanel">
            <div class="row set-card-spacing">
			<?php if($spotlight_all):
           	  foreach ($spotlight_all as $spotlight) { ?>
               <?php include('sportlights/post_loop.php') ?>  
            <?php } endif ?>
            </div> <!-- row -->

        </div><?php */?>
        
        <div class="tab-pane22" style="display:block">

            <div class="row set-card-spacing">
	
				<?php if($spotlight_all):
                foreach ($spotlight_all as $spotlight) { ?>
                    <?php include(FCPATH .'application/views/enduser/sportlights/post_loop.php') ?>  
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