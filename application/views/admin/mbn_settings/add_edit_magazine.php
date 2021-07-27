<?php 

//phpinfo();
// print_r($users) ?>
<style>
.item_list{margin-bottom:10px}
.progress {
    position: relative;
    width: 400px;
    border: 1px solid #ddd;
    padding: 1px;
    border-radius: 3px;
    margin-bottom: 5px;
    height: auto;
    font-size: 12px;
}
.bar {
    background-color: #727cf5;
    width: 0%;
    height: 20px;
  
    line-height: 19px;
    margin-left: 3px;
}
.sponser_sec .kansas .post-image img {
    height: 250px;
    object-fit: cover;
}
.percent {
    position: absolute;
    display: inline-block;
    top: 3px;
    left: 48%;
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
                            <h4 class="mb-15">Digital Magazine <a href="<?php echo base_url('mbncms/magazine') ?>" class="btn btn-primary"> back to list</a></h4>
                            <?php if(isset($page_data->m_id)) $id = $page_data->m_id; else $id=""; ?>
                             <?php if($sucesess = $this->session->flashdata('sucesess')): ?>
                        <div class="alert alert-success" role="alert">
                         <?php echo $sucesess ?>
                        </div>
                    <?php endif ?>
                            <form action="<?php echo base_url('mbncms/add_edit_magazine/').$id  ?>" id="create_page" enctype="multipart/form-data"  method="post">
                                <div class="row">
                                        <div class="col-md-12">
                                        <?php $url_array =  (array)json_decode($page_data->url);
										//print_r($url_array); die;
										 ?>
                                        
                                        <div class="form-group">
                                        <label class="control-label">Title</label>
                                        <input type="text" name="title" class="form-control" placeholder="Enter Title" value="<?php if(isset($page_data->title)) echo $page_data->title ?>" required="required">
                                        </div>
                                        
                                        </div>
                                        
                                        
                                        <div class="col-md-12">
                                        <?php // $url_array =  (array)json_decode($page_data->url);
										//print_r($url_array); die;
										 ?>
                                        <?php //print_r($page_data) ?>
                                        <div class="form-group">
                                        <label class="control-label">PDF URL</label>
                                        <input type="text" name="pdf_url" class="form-control" placeholder="Enter PDF URL" value="<?php if(isset($page_data->pdf)) echo $page_data->pdf ?>" required="required">
                                        </div>
                                        
                                        </div>
                                        
                                       
                 
                                            <?php /*?><div class="col-md-12">
                                            <div class="form-group">
                                               <label for="category1">PDF</label>
                                               <?php $req = 'required="required"' ?>
                                               <div class="progress">
                                                    <div class="bar"></div>
                                                    <div class="percent">0%</div>
                                                </div>
                                               <?php
											   
											   
											    if($page_data->pdf): $req =''; ?>
                                               <a target="_blank" href="<?php echo base_url('uploads/magazine/'.$page_data->pdf)?>">View PDF</a>
                                               
                                               <?php endif;?> 
                                               <input <?php //echo $req;?>  class="form-control" type="file" name="pdf_file" accept="application/pdf" />
                                            </div>
                                        </div><?php */?>
                                        
                                        </div>
                                  
                          <div class="row" style="align-items: center;">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                       <label for="category33">Thumbnail</label>
                                       <?php $req2 = 'required="required"' ?>
                                       <?php if($page_data->thumbnail): ?>
                                       <?php 
									    $req2 =''; 
									   endif;?> 
                                       <input  <?php echo $req2;?> class="form-control" type="file" name="thumbnail" accept="image/*" />
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                  <?php if($page_data->thumbnail): ?>
                                       <img style="height:150px" src="<?php echo base_url('uploads/magazine/'.$page_data->thumbnail)	 ?>" class="img-thumbnail pull-right" />
                                       <?php endif;?> 
                                  </div>
                                </div>
                                  <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                           <label for="category">Category</label>
                                           <select class="form-control" id="category" name="category" required="required">
                                              <?php $categores = $this->db->get_where('magazine_cat',array('site_id'=>site_id() ))->result() ?>
                                               <?php if($categores): ?>
                                               <?php foreach($categores as $cat): ?>
                                              <option<?php if($page_data->category == $cat->categoryTitle) echo ' selected="selected"' ?>  
                                              value="<?php echo $cat->categoryTitle ?>"><?php echo $cat->categoryTitle ?></option>
                                              <?php endforeach;?>
                                              <?php endif;?>
                                              
                                           </select>
                                        </div>
                                    </div>
                                    
                                    
                                 </div>
                                    
                                <div class="row">
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
<script src="http://malsup.github.com/jquery.form.js"></script>
<script>
$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});

/*(function() {
$('#create_page .progress').hide();    
var bar = $('.bar');
var percent = $('.percent');
var status = $('#status');
   
$('form').ajaxForm({
	
    beforeSend: function() {
		$('#create_page .progress').show();
        status.empty();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
		//console.log(percentVal, position, total);
    },
    success: function() {
        var percentVal = '100%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
	complete: function(xhr) {
		 window.location.href = "<?php //echo base_url('mbncms/add_edit_magazine/').$id  ?>";
	}
}); 

})();*/       



</script>
<script>
	$("#create_page").validate(
	);
</script>
