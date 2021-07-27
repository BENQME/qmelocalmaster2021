<?php // print_r($users) ?>
<style>
.item_list{margin-bottom:10px}
.table td img {
    width: 150px;
    height: auto;
    border-radius: 0;
	display:block; max-width:250px
}
</style>
<link type="text/css" href="<?php echo base_url('assets/editor.css')?>" rel="stylesheet"/>
    <div class="page-content">
        <div class="steelton_home_section">
         <?php include('nav_links.php') ?>
             <div class="tab-content">
                <div class="row">
                
                    <div class="col-md-12 grid-margin stretch-card">
                   
                        <div class="card">
                          <div class="card-body">
                            <h4 class="mb-15">CMS Widgets <a href="<?php echo base_url('mbncms/widgets') ?>" class="btn btn-primary"> back to list</a></h4>
                            <?php if(isset($page_data->w_id)) $id = $page_data->w_id; else $id=""; ?>
                             <?php if($sucesess = $this->session->flashdata('sucesess')): ?>
                        <div class="alert alert-success" role="alert">
                         <?php echo $sucesess ?>
                        </div>
                    <?php endif ?>
                            <form action="<?php echo base_url('mbncms/add_edit_widget/').$id  ?>" id="create_page"  method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                           <label class="control-label">Title</label>
                                           <input type="text" name="title" class="form-control" placeholder="Enter Title" value="<?php if(isset($page_data->title)) echo $page_data->title ?>" required="required">
                                        </div>
                                        <div class="form-group">
                                           <label class="control-label">Order</label>
                                           <input type="number" name="order_index" class="form-control" placeholder="Enter Order Number" value="<?php if(isset($page_data->order_index)) echo $page_data->order_index ?>" required="required">
                                        </div>
                                        <div class="form-group">
                                           <label class="control-label">Content</label>
                                           <textarea id="txtEditor22" class="form-control" style="min-height:200px" name="content"><?php if(isset($page_data->content)) echo $page_data->content ?></textarea>
                                          
                                        </div>
                                        <div class="form-group">
                                           <label class="control-label">URL</label>
                                           <input type="url" name="url" class="form-control" placeholder="Enter URL" value="<?php if(isset($page_data->url)) echo $page_data->url ?>">
                                        </div>
                                    </div>
                                  <div class="col-md-12">
                                        <div class="form-group">
                                           <label for="widget_area">Position</label>
                                           <select class="form-control" id="widget_area" name="widget_area">
                                              <option value="default">Sidebar</option>
                                              <option<?php if($page_data->widget_area =='home_page') echo ' selected="selected"' ?>  value="home_page">Main Home Page Ads 1600x270</option>
                                              <option<?php if($page_data->widget_area =='home_bottom') echo ' selected="selected"' ?>  value="home_bottom">MBN Advertised Scroll Ads 1920x350</option>
                                              <option<?php if($page_data->widget_area =='home_bottom2') echo ' selected="selected"' ?>  value="home_bottom2">MBN In Motion Ads 1600x270</option>
                                               <option<?php if($page_data->widget_area =='social') echo ' selected="selected"' ?>  value="social">Social Links</option>
                                                 <option<?php if($page_data->widget_area =='home_page2') echo ' selected="selected"' ?>  value="home_page2">MBN Tv Ads 1600x270</option>
                                                   <option<?php if($page_data->widget_area =='TrendingNews') echo ' selected="selected"' ?>  value="TrendingNews">Trending News (Ad position & size 900X100)</option>
                                                   <option<?php if($page_data->widget_area =='AffiliateNews') echo ' selected="selected"' ?>  value="AffiliateNews"> Affiliate News (Ad position & size 900X100) </option>
                                                  
                                                 
                                              
                                           </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                           <label for="widget_area_url">Page URLS (comma Separated urls)</label>
                                           <textarea class="form-control" id="widget_area_url" name="widget_area_url"><?php echo $page_data->widget_area_url ?></textarea>
                                        </div>
                                    </div>
                                     <div class="col-md-12">
                                    <p class="text-right">
					  	<button type="submit" name="submit" value="1" class="btn btn-primary contentBTn">Submit</button>
						 <!-- <a href="create_a_spotlight-two.html" class="btn btn-primary contentBTn">Next</a> -->
					  </p>
                      </div>
                              </div>
                              
                            </form>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});

</script>
<script>
	$("#create_page").validate(
	);
</script>
