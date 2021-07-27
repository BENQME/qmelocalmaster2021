<?php // print_r($users) ?>
<style>
.item_list{margin-bottom:10px}
pre {
    background-color: #e8eff4;
    padding: 5px;
    font-size: 14px;
    word-break: break-all;
    white-space: break-spaces;
    border: 1px solid #ddd;
	margin-bottom:0;
}
small.delete{margin-bottom:10px; display:block}
</style>
<div class="page-content">
    <div class="steelton_home_section">
     <?php include('nav_links.php') ?>
         <div class="tab-content">
            <div class="row">
            
                <div class="col-md-12 grid-margin stretch-card">
               
                    <div class="card">
                     <?php if($sucesess = $this->session->flashdata('sucesess')): ?>
                    <div class="alert alert-success" role="alert">
                     <?php echo $sucesess ?>
                    </div>
                <?php endif ?>
                      <div class="card-body">
                        <h4 class="mb-15">Media</h4>
           				 <form action="<?php echo base_url('mbncms/media') ?>" method="post" enctype="multipart/form-data" >
                            <input type="file" name="file" />
                            <input type="submit" name="submit" value="submit" />
                        </form>
                        
                        
                      </div>
                    </div>
                </div>
                
            </div>
            <div class="row" style="background:#fff; padding:15px 0">
				<?php if($media): ?>
                <?php foreach($media as $img): ?>
                    <div class="col-md-3">
                    <?php $img_url =base_url('uploads/media/'.$img['file_name']); ?>
                    <?php $mim =  exif_imagetype($img_url); //print_r($mim) ?>
                    <?php if(!$mim) { ?>
                     <small style="word-break: break-all;"><pre><?php echo htmlspecialchars($img_url); ?></pre></small>
                    <?php }else{ ?>
                    <img style="display:block" class="img-thumbnail" src="<?php echo base_url('uploads/media/'.$img['file_name']) ?>" />
                    <small style="word-break: break-all;"><pre><?php echo htmlspecialchars('<img src="'.$img_url.'" />'); ?></pre></small>
                    <?php } ?>
                    <small class="delete"><a href="<?php echo base_url('mbncms/delete_media/'.$img['media_id']) ?>">Delete</a></small>
                    </div>
                <?php endforeach ?>
                <?php endif ?>
                </div>
        </div>
    </div>
</div>