<style>

/**

 * Nestable

 */
 .select2-container--default .select2-selection--multiple .select2-selection__choice{width:100%;     font-size: 14px;}
 .select2-container--default .select2-selection--multiple .select2-selection__rendered li{cursor: move;}
.card-header{margin-left:12px}


.dd { position: relative; display: block; margin: 0; padding: 0; max-width: 600px; list-style: none; font-size: 13px; line-height: 20px; }



.dd-list { display: block; position: relative; margin: 0; padding: 0; list-style: none; }

.dd-list .dd-list { padding-left: 30px; }

.dd-collapsed .dd-list { display: none; }



.dd-item,

.dd-empty,

.dd-placeholder { display: block; position: relative; margin: 0; padding: 0; min-height: 20px; font-size: 13px; line-height: 20px; }



.dd-handle { display: block; height: 30px; margin: 5px 0; padding: 5px 10px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;

    background: #fafafa;

    background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);

    background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);

    background:         linear-gradient(top, #fafafa 0%, #eee 100%);

    -webkit-border-radius: 3px;

            border-radius: 3px;

    box-sizing: border-box; -moz-box-sizing: border-box;

}

.dd-handle:hover { color: #2ea8e5; background: #fff; }



.dd-item > button { display: block; position: relative; cursor: pointer; float: left; width: 25px; height: 20px; margin: 5px 0; padding: 0; text-indent: 100%; white-space: nowrap; overflow: hidden; border: 0; background: transparent; font-size: 12px; line-height: 1; text-align: center; font-weight: bold; }

.dd-item > button:before { content: '+'; display: block; position: absolute; width: 100%; text-align: center; text-indent: 0; }

.dd-item > button[data-action="collapse"]:before { content: '-'; }



.dd-placeholder,

.dd-empty { margin: 5px 0; padding: 0; min-height: 30px; background: #f2fbff; border: 1px dashed #b6bcbf; box-sizing: border-box; -moz-box-sizing: border-box; }

.dd-empty { border: 1px dashed #bbb; min-height: 100px; background-color: #e5e5e5;

    background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),

                      -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);

    background-image:    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),

                         -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);

    background-image:         linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),

                              linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);

    background-size: 60px 60px;

    background-position: 0 0, 30px 30px;

}



.dd-dragel { position: absolute; pointer-events: none; z-index: 9999; }

.dd-dragel > .dd-item .dd-handle { margin-top: 0; }

.dd-dragel .dd-handle {

    -webkit-box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);

            box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);

}



/**

 * Nestable Extras

 */



.nestable-lists { display: block; clear: both; padding: 30px 0; width: 100%; }



#nestable-menu { padding: 0; margin: 20px 0; }



#nestable-output,

#nestable2-output { width: 100%; height: 7em; font-size: 0.75em; line-height: 1.333333em; font-family: Consolas, monospace; padding: 5px; box-sizing: border-box; -moz-box-sizing: border-box; }

.nestable_class .dd-handle a{color: #fff;}

.nestable_class .dd-handle {

    color: #fff;

    border: 1px solid #999;

    background: #bbb;

    background: -webkit-linear-gradient(top, #bbb 0%, #999 100%);

    background:    -moz-linear-gradient(top, #bbb 0%, #999 100%);

    background:         linear-gradient(top, #bbb 0%, #999 100%);
	min-height:30px;

}

.nestable_class .dd-handle:hover { background: #bbb; }

.nestable_class .dd-item > button:before { color: #fff; }

#nestable3 .dd-handle a {

    color: #fff;

    white-space: break-spaces;

    max-width: 93%;

    display: block;

}

#nestable3 .dd-handle{height:auto;}

@media only screen and (min-width: 700px) {



    .dd { float: left; width: 100%;}



}



.dd-hover > .dd-handle { background: #2ea8e5 !important; }



/**

 * Nestable Draggable Handles

 */



.dd3-content { display: block; height: 30px; margin: 5px 0; padding: 5px 10px 5px 40px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;

    background: #fafafa;

    background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);

    background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);

    background:         linear-gradient(top, #fafafa 0%, #eee 100%);

    -webkit-border-radius: 3px;

            border-radius: 3px;

    box-sizing: border-box; -moz-box-sizing: border-box;

}

.dd3-content:hover { color: #2ea8e5; background: #fff; }



.dd-dragel > .dd3-item > .dd3-content { margin: 0; }



.dd3-item > button { margin-left: 30px; }



.dd3-handle { position: absolute; margin: 0; left: 0; top: 0; cursor: pointer; width: 30px; text-indent: 100%; white-space: nowrap; overflow: hidden;

    border: 1px solid #aaa;

    background: #ddd;

    background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);

    background:    -moz-linear-gradient(top, #ddd 0%, #bbb 100%);

    background:         linear-gradient(top, #ddd 0%, #bbb 100%);

    border-top-right-radius: 0;

    border-bottom-right-radius: 0;

}

.dd3-handle:before { content: '≡'; display: block; position: absolute; left: 0; top: 3px; width: 100%; text-align: center; text-indent: 0; color: #fff; font-size: 20px; font-weight: normal; }

.dd3-handle:hover { background: #ddd; }



/**

 * Socialite

 */



.socialite { display: block; float: left; height: 35px; }

.edit_likk{position:absolute; right:5px; top:5px; color:#fff; text-transform:uppercase}

.edit_likk a{color:#FFFFFF; font-size:12px; margin-right:5px}

    </style>

<div class="page-content">


<div class="row set-card-spacing" style="margin-top:20px">



 <div class="col-md-12 grid-margin2">

    <?php if($success99 = $this->session->flashdata('success99')): ?>

            <div id="success99" class="alert alert-success" role="alert">

                <?php echo $success99 ?>

            </div>

        <?php endif ?>

        <?php if($error = $this->session->flashdata('error')): ?>

            <div id="success99" class="alert alert-error" role="alert">

                <?php echo $error ?>

            </div>

        <?php endif ?>

        <?php 

        $settings_array= array();
         $logo_settings = site_settings('logo_settings');
        if($logo_settings) $settings_array = json_decode($logo_settings); //print_r($settings_array) ?>

        <div class="card rounded" style="display:none">

            <div class="card-header"><h4>Select Theme</h4></div>

             <div class="card-body">

                <form method="post" action="<?php echo base_url('admin/choose_theme') ?>" enctype="multipart/form-data">

                    

                    <style>
					.choose_theme [type=radio] { 
						  position: absolute;
						  opacity: 0;
						  width: 0;
						  height: 0;
						}
						
						/* IMAGE STYLES */
						.choose_theme [type=radio] + img {
						  cursor: pointer;
						}
						
						/* CHECKED STYLES */
						.choose_theme [type=radio]:checked + img {
						  outline: 2px solid #f00;
						}
						</style>

                     <div class="form-group choose_theme"> 
                     
<?php $choose_theme_data =site_settings('choose_theme_data');?>
                       <label>
  <input type="radio" name="theme" value="style1" <?php if(!$choose_theme_data || $choose_theme_data =='style1') echo 'checked' ?> >
  <img src="http://placehold.it/200x200/0bf/fff&text=Default">
</label>

<label>
  <input type="radio" name="theme" value="style2" <?php if($choose_theme_data && $choose_theme_data =='style2') echo 'checked' ?>>
  <img src="http://placehold.it/200x200/b0f/fff&text=Style 2">
</label>
                    </div>
                    <div class="card-footer"><button style="margin-bottom:10px" name="choose_theme" class="btn btn-primary pull-right" type="submit" value="1">Submit</button></div>

                 </form>

            </div>

            </div>

     </div>



</div>
<div class="row set-card-spacing" style="margin-top:20px">



 <div class="col-md-12 grid-margin2">

    <?php if($success99 = $this->session->flashdata('success99')): ?>

            <div id="success99" class="alert alert-success" role="alert">

                <?php echo $success99 ?>

            </div>

        <?php endif ?>

        <?php if($error = $this->session->flashdata('error')): ?>

            <div id="success99" class="alert alert-error" role="alert">

                <?php echo $error ?>

            </div>

        <?php endif ?>

        <?php 
//echo $_SERVER["DOCUMENT_ROOT"] ;
        $settings_array= array();
         $logo_settings = site_settings('logo_settings');
        if($logo_settings) $settings_array = json_decode($logo_settings); //print_r($settings_array) ?>

        <div class="card rounded">

            <div class="card-header"><h4>Logo and Favicon</h4></div>

             <div class="card-body">
                <form method="post" action="<?php echo base_url('admin/landing_menu') ?>" enctype="multipart/form-data">

                    

                    

                     <div class="form-group"> 
                     

                        <label>Favicon <?php if(isset($settings_array->favicon) && $settings_array->favicon) echo '<img class="img-thumbnail" src="'.base_url().'uploads/banners/'.$settings_array->favicon.'" style="max-width:100px" />' ?></label>

                        <input type="file" class="form-control" name="favicon"  />

                    </div>
                     <div class="form-group"> 

                        <label>Logo <?php if(isset($settings_array->logo) && $settings_array->logo) echo '<img class="img-thumbnail" src="'.base_url().'uploads/banners/'.$settings_array->logo.'" style="max-width:300px" />' ?></label>

                        <input type="file" class="form-control" name="logo"  />

                    </div>
                    <div class="form-group"> 

                        <label>Dark Logo <?php if(isset($settings_array->logo2) && $settings_array->logo2) echo '<img class="img-thumbnail" src="'.base_url().'uploads/banners/'.$settings_array->logo2.'" style="max-width:300px" />' ?></label>

                        <input type="file" class="form-control" name="logo2"  />

                    </div>
                    <div class="form-group"> 
                     

                        <label>Header Color <?php if(isset($settings_array->header_color) && $settings_array->header_color) echo '<span style="background:'.$settings_array->header_color.';width:50px; border: 1px solid #000; height:50px; display:block" />' ?></label>

                        <input type="text" class="form-control" name="header_color"  value="<?php if(isset($settings_array->header_color) && $settings_array->header_color) echo $settings_array->header_color ?>" />

                    </div>
                     <div class="form-group"> 
                     

                        <label>Header Navigation Font Color <?php if(isset($settings_array->header_f_color) && $settings_array->header_f_color) echo '<span style="background:'.$settings_array->header_f_color.';width:50px; border: 1px solid #000; height:50px; display:block" />' ?></label>

                        <input type="text" class="form-control" name="header_f_color"  value="<?php if(isset($settings_array->header_f_color) && $settings_array->header_color) echo $settings_array->header_f_color ?>" />

                    </div>
                    <div class="form-group"> 
                     

                        <label>Benefit Section Background  <?php if(isset($settings_array->footer_f_color2) && $settings_array->footer_f_color2) echo '<span style="background:'.$settings_array->footer_f_color2.';width:50px; border: 1px solid #000; height:50px;  display:block"></span>' ?></label>

                        <input type="text" class="form-control" name="footer_f_color2" value="<?php if(isset($settings_array->footer_f_color2) && $settings_array->footer_f_color2) echo $settings_array->footer_f_color2 ?>"  />

                    </div>
                    <div class="form-group"> 
                     

                        <label>Footer Color <?php if(isset($settings_array->footer_color) && $settings_array->footer_color) echo '<span style="background:'.$settings_array->footer_color.';width:50px; height:50px; border: 1px solid #000;  display:block"></span>' ?></label>

                        <input type="text" class="form-control" name="footer_color" value="<?php if(isset($settings_array->footer_color) && $settings_array->footer_color) echo $settings_array->footer_color ?>"  />

                    </div>
                     <div class="form-group"> 
                     

                        <label>Footer  Font Color <?php if(isset($settings_array->footer_f_color) && $settings_array->footer_f_color) echo '<span style="background:'.$settings_array->footer_f_color.';width:50px; height:50px;  display:block"></span>' ?></label>

                        <input type="text" class="form-control" name="footer_f_color" value="<?php if(isset($settings_array->footer_f_color) && $settings_array->footer_f_color) echo $settings_array->footer_f_color ?>"  />

                    </div>
                    

                    <div class="card-footer"><button style="margin-bottom:10px" name="logo_submit" class="btn btn-primary pull-right" type="submit" value="1">Submit</button></div>

                 </form>

            </div>

            </div>

     </div>



</div>












    <div class="cf nestable-lists">

        <div class="row set-card-spacing">

            <div class="col-md-6 grid-margin2">

            <?php if($success2 = $this->session->flashdata('success2')): ?>

                    <div id="success2" class="alert alert-success" role="alert">

                        <?php echo $success2 ?>

                    </div>

                <?php endif ?>

                <div class="card rounded">

                    <div class="card-header"><h4>Add Menu Items</h4></div>

                     <div class="card-body">

                        <form method="post" action="<?php echo base_url('admin/landing_menu') ?>">

                            <div class="form-group"> 

                                <label>Label</label>

                                <input type="text" class="form-control" name="label" required="required" />

                            </div>

                            <div class="form-group"> 

                                <label>URL</label>

                                <input type="text" class="form-control" name="url" required="required"  />

                            </div>

                            <div class="form-group"> 

                                <label>External Link

                                <input type="checkbox" name="external" value="1"  /></label>

                            </div>

                            <div class="card-footer"><button style="margin-bottom:10px" name="add_menu" class="btn btn-primary pull-right" type="submit" value="1">add</button></div>

                         </form>
                         
                         <form method="post" action="<?php echo base_url('admin/landing_menu') ?>">

                            <div class="form-group"> 
								<?php 
                                
                                $this->db->select('spot.userid,spot.category,spot.status,sc.categoryID');
                                $this->db->join('users as usr','usr.userID = spot.userid','left');
                                $this->db->join('spotlights_category as sc','sc.categoryTitle = spot.category','left');
                                $this->db->where('usr.site_id',site_id());
                                $this->db->where('spot.status',1);
                                $this->db->group_by('spot.category');// add group_by
                                $query = $this->db->get('spotlights as spot'); 
                                if($category_data  = $query->result()):
                                
                                ?>
                                <label>Add Category</label>
                                    <select name="category" required="required">
                                        <?php foreach($category_data as $cat): ?>
                                        <?php if($cat->categoryID): ?>
                                            <option value="<?php echo  $cat->categoryID ?>"><?php echo $cat->category ?></option>
                                            <?php endif;?>
                                        <?php endforeach ?>
                                    </select>
                                <?php endif;?>
								
                            </div>
								

                            

                            <div class="card-footer"><button style="margin-bottom:10px" name="add_menu" class="btn btn-primary pull-right" type="submit" value="1">add Category</button></div>

                         </form>

                    </div>

                    </div>

             </div>

           <?php if($landing_menu): $menu_array = json_decode($landing_menu); //print_r($menu_array) ?>

                <div class="col-md-6 grid-margin2">

                 <?php if($success = $this->session->flashdata('success')): ?>

                    <div class="alert alert-success" role="alert">

                        <?php echo $success ?>

                    </div>

                <?php endif ?>

                <div class="card rounded">

                    <div class="dd" id="nestable" style="display:none">

                        <ol class="dd-list">

                            <li class="dd-item" data-id="1">

                                <div class="dd-handle">Item 1</div>

                            </li>

                            <li class="dd-item" data-id="2">

                                <div class="dd-handle">Item 2</div>

                                <ol class="dd-list">

                                    <li class="dd-item" data-id="3"><div class="dd-handle">Item 3</div></li>

                                    <li class="dd-item" data-id="4"><div class="dd-handle">Item 4</div></li>

                                    <li class="dd-item" data-id="5">

                                        <div class="dd-handle">Item 5</div>

                                        <ol class="dd-list">

                                            <li class="dd-item" data-id="6"><div class="dd-handle">Item 6</div></li>

                                            <li class="dd-item" data-id="7"><div class="dd-handle">Item 7</div></li>

                                            <li class="dd-item" data-id="8"><div class="dd-handle">Item 8</div></li>

                                        </ol>

                                    </li>

                                    <li class="dd-item" data-id="9"><div class="dd-handle">Item 9</div></li>

                                    <li class="dd-item" data-id="10"><div class="dd-handle">Item 10</div></li>

                                </ol>

                            </li>

                            <li class="dd-item" data-id="11">

                                <div class="dd-handle">Item 11</div>

                            </li>

                            <li class="dd-item" data-id="12">

                                <div class="dd-handle">Item 12</div>

                            </li>

                        </ol>

                    </div>

                    <div class="dd nestable_class" id="nestable2">

                    <div class="card-header"><h4>Landing Navigation </h4> <h6>(drag & drop rearrange Menu Items)</h6></div>

                    

                   

                        <div class="card-body">

                            <ol class="dd-list">

								<?php  foreach($menu_array as $menu_item){ //print_r($menu_item) ?>

                                <li class="dd-item" data-ext="<?php if(isset($menu_item->ext)) echo $menu_item->ext ?>" data-id="<?php echo $menu_item->id ?>" data-label="<?php echo $menu_item->label ?>" data-url="<?php echo $menu_item->url ?>">

                                

                                    <div class="dd-handle">

                                    <a target="_blank" href="<?php echo $menu_item->url ?>"><?php echo $menu_item->label ?></a>

                                    

                                    

                                    </div>

                                    <div class="edit_likk">

                                    <?php /*?><a class="edit_likk2" href="">edit</a><?php */?>

                                    	<a class="delete_link" data-id="<?php echo $menu_item->id ?>" href="#">delete</a>

                                    </div>

                                    <?php if(isset($menu_item->children) && $menu_item->children){ ?>

                                    <ol class="dd-list">

                                         <?php foreach($menu_item->children as $child_item){ ?>

                                        	<li class="dd-item" data-ext="<?php if(isset($child_item->ext)) echo $child_item->ext ?>" data-id="<?php echo $child_item->id ?>" data-label="<?php echo $child_item->label ?>" data-url="<?php echo $child_item->url ?>"><div class="dd-handle"><a target="_blank" href="<?php echo $child_item->url ?>"><?php echo $child_item->label ?></a></div>

                                            <div class="edit_likk">

                                    <?php /*?><a class="edit_likk2" href="">edit</a><?php */?>

                                    	<a class="delete_link" data-id="<?php echo $child_item->id ?>" href="#">delete</a>

                                    </div>

                                            </li>

											<?php  } ?>

                                        </ol>

                                    <?php } ?>

                                </li>

                                <?php } ?>

                            </ol>

                         </div>

                         <form method="post" action="<?php echo base_url('admin/landing_menu') ?>">

                           <textarea id="nestable2-output" name="menu_order" style="display:none"></textarea>

                     <div class="card-footer"><button style="margin-bottom:10px" name="submit_setting" class="btn btn-primary pull-right" type="submit" value="1">Update</button></div>

                     </form>

                    </div>

                 </div>

            </div>

            <?php endif;?>

        </div>

        <div class="row set-card-spacing" style="margin-top:20px">

        

         <div class="col-md-12 grid-margin2">

            <?php if($success3 = $this->session->flashdata('success3')): ?>

                    <div id="success3" class="alert alert-success" role="alert">

                        <?php echo $success3 ?>

                    </div>

                <?php endif ?>

                <?php if($error = $this->session->flashdata('error')): ?>

                    <div id="success3" class="alert alert-error" role="alert">

                        <?php echo $error ?>

                    </div>

                <?php endif ?>

                <?php 
                if(!special_cms()){
				$settings_array= array();

				if($banner_settings) $settings_array = json_decode($banner_settings); //print_r($settings_array) ?>

                <div class="card rounded">

                    <div class="card-header"><h4>Banner Settings</h4></div>

                     <div class="card-body">

                        <form method="post" action="<?php echo base_url('admin/landing_menu') ?>" enctype="multipart/form-data">

                            <div class="form-group"> 

                                <label>Banner Title</label>

                                <input type="text" class="form-control" name="b_title" value="<?php if(isset($settings_array->b_title)) echo $settings_array->b_title ?>" />

                            </div>

                            <div class="form-group"> 

                                <label>Banner Sub Title</label>

                                <input type="text" class="form-control" name="b_sub_title" value="<?php if(isset($settings_array->sub_title)) echo $settings_array->sub_title ?>" />

                            </div>

                             <div class="form-group"> 

                                <label>Banner Background <?php if(isset($settings_array->b_image) && $settings_array->b_image) echo '<a target="_blank" href="'.base_url().'uploads/banners/'.$settings_array->b_image.'">Preview Image</a>' ?></label>

                                <input type="file" class="form-control" name="b_image"  />

                            </div>

                            <div class="card-footer"><button style="margin-bottom:10px" name="b_submit" class="btn btn-primary pull-right" type="submit" value="1">Submit</button></div>

                         </form>

                    </div>

                    </div>
               <?php } ?>

             </div>

        

        </div>

         <?php  if(special_cms()) { ?>
        <?php if(isset($categories)): 

		$f_spotlights_array= array();

		if(isset($f_spotlights)) $f_spotlights_array = json_decode($f_spotlights);

		?>

            <div class="row set-card-spacing" style="margin-top:20px">

            

             <div class="col-md-12 grid-margin2">

                <?php if($success4 = $this->session->flashdata('success4')): ?>

                        <div id="success4" class="alert alert-success" role="alert">

                            <?php echo $success4 ?>

                        </div>

                    <?php endif ?>

                    <div class="card rounded">

                        <div class="card-header"><h4>Site Header Top Position</h4></div>

                         <div class="card-body">

                            <form method="post" action="<?php echo base_url('admin/landing_menu') ?>" enctype="multipart/form-data">

                                 <div class="form-group" style="display:none"> 

                                     

                                     <input type="text" name="f_title" class="form-control" value="<?php if(isset($f_spotlights_array->f_title)) echo $f_spotlights_array->f_title ?>"/>

                                 </div>

                                 <div class="form-group"  style="display:none"> 

                                     <label>Block Description</label>

                                     <textarea class="form-control" name="f_description"><?php if(isset($f_spotlights_array->f_description)) echo $f_spotlights_array->f_description ?></textarea>

                                 </div>

                                <div class="form-group"> 

                                    <label>Select Site Header Top Position Spotlights</label>

                                    <select class="js-example-basic-multiple w-100" name="f_spotlights[]" multiple="multiple">

                                    <?php 
									$option="";
									foreach($categories as $key=>$spot){
										$sort_array[$spot['postID']] = $spot;
										
									}
									?>
                                    
                                    <?php 
									if($f_spotlights_array->f_spotlights){
									foreach($f_spotlights_array->f_spotlights  as $selected){ 
									 $spot =$sort_array[$selected]
									
									?>
                                    
                                       <option  selected="selected" value="<?php echo  $spot['postID'] ?>"><?php echo  $spot['postTitle'] ?></option>
                                       <?php unset($sort_array[$selected]);
									   
									   }}?>
									<?php foreach($sort_array  as $spot){ ?>
                                       <option <?php if(isset($f_spotlights_array->f_spotlights) && in_array($spot['postID'],$f_spotlights_array->f_spotlights)) echo ' selected="selected"' ?> value="<?php echo  $spot['postID'] ?>"><?php echo  $spot['postTitle'] ?></option>
                                       <?php } ?>

                                    </select>

                                </div>

                                <div class="card-footer"><button style="margin-bottom:10px" name="f_submit" class="btn btn-primary pull-right" type="submit" value="1">Submit</button></div>

                             </form>

                        </div>

                        </div>

                 </div>

            

            </div>

        <?php endif;?>

        <?php } ?>

        <!--admin spotlights-->

        <?php if(isset($s_admin_spotlights) && $s_admin_spotlights): ?>

            <div class="row set-card-spacing2" style="margin-top:20px">

                <div class="col-md-6 grid-margin2">

                <?php if($success6 = $this->session->flashdata('success6')): ?>

                        <div id="success6" class="alert alert-success" role="alert">

                            <?php echo $success6 ?>

                        </div>

                    <?php endif ?>

                    <div class="card rounded">

                        <div class="card-header"><h4><?php echo site_info() ?> <?php  if(special_cms()) echo 'TV';else echo 'Featured Activities' ?></h4></div>

                         <div class="card-body">

                            <form method="post" action="<?php echo base_url('admin/landing_menu') ?>">

                                <div class="form-group"> 

                                    <label>Select Spotlight</label>

                                   <select class="form-control" name="activity">

                                    <?php foreach($s_admin_spotlights as $spt): ?>

                                    <option value="<?php echo $spt['postID'] ?>"><?php echo $spt['postTitle'] ?></option>

                                    <?php endforeach ?>

                                   </select>

                                </div>

                                

                                <div class="card-footer"><button style="margin-bottom:10px" name="add_spot_admin" class="btn btn-primary pull-right" type="submit" value="1">add</button></div>

                             </form>

                        </div>

                        </div>

                 </div>

   

			    <?php 

				

					//print_r($admin_spotlights);

				if($menu_order_spotlights =site_settings('admin_spotlights')):

			

				 $menu_order_spotlights_array = json_decode($menu_order_spotlights); ?>

                    <div class="col-md-6 grid-margin2">

                     <?php if($success7 = $this->session->flashdata('success7')): ?>

                        <div id="success7" class="alert alert-success" role="alert">

                            <?php echo $success7 ?>

                        </div>

                    <?php endif ?>

                    <div class="card rounded">

                        

                        <div class="dd nestable_class" id="nestable3">

                        <div class="card-header"><h4><?php echo site_info() ?>  <?php  if(special_cms()) echo 'TV';else echo 'Featured Activities' ?></h4> <h6>(drag & drop rearrange Items)</h6></div>

                        

                       

                            <div class="card-body">

                                <ol class="dd-list">

                                    <?php  foreach($menu_order_spotlights_array as $menu_item){ //print_r($menu_item) ?>

                                    <li class="dd-item"  data-label="<?php echo $menu_item->label ?>">

                                    

                                        <div class="dd-handle">

                                        <?php $spott = $this->db->get_where('spotlights',array('postID'=>$menu_item->label))->row()->postTitle ?>

                                        <a><?php echo $spott?></a>

                                        

                                        

                                        </div>

                                        <div class="edit_likk">

                                        <?php /*?><a class="edit_likk2" href="">edit</a><?php */?>

                                            <a class="delete_link" data-id="<?php echo $menu_item->label ?>" href="#">delete</a>

                                        </div>

                                       

                                    </li>

                                    <?php } ?>

                                </ol>

                             </div>

                             <form method="post" action="<?php echo base_url('admin/landing_menu') ?>">

                               <textarea id="nestable3-output" name="menu_order_spotlights" style="display:none"></textarea>

                         <div class="card-footer"><button style="margin-bottom:10px" name="submit_admin_spot" class="btn btn-primary pull-right" type="submit" value="1">Update</button></div>

                         </form>

                        </div>

                     </div>

                </div>

                <?php endif;?>

            </div>

        <?php endif;?>

       
        <?php if(isset($categories)): 

		$f_spotlights_array_slider= array();

		if(isset($f_spotlights_slider_data)) $f_spotlights_array_slider = json_decode($f_spotlights_slider_data);
		//print_r($f_spotlights_array_slider)

		?>

            <div class="row set-card-spacing" style="margin-top:20px">

            

             <div class="col-md-12 grid-margin2">

                <?php if($s123 = $this->session->flashdata('s123')): ?>

                        <div id="s123" class="alert alert-success" role="alert">

                            <?php echo $s123 ?>

                        </div>

                    <?php endif ?>

                    <div class="card rounded">

                        <div class="card-header"><h4>Featured Spotlights Slider</h4></div>

                         <div class="card-body">

                            <form method="post" action="<?php echo base_url('admin/landing_menu') ?>" enctype="multipart/form-data">

                                <div class="form-group"> 

                               

                                    <label>Select Featured Spotlights</label>
                                    <?php //print_r($f_spotlights_array_slider->f_spotlights_slider) ?>
                                    <select class="js-example-basic-multiple w-100" name="f_spotlights_slider[]" multiple="multiple">

                                    <?php 
									$option="";
									foreach($categories as $key=>$spot){
										$sort_array2[$spot['postID']] = $spot;
										
									}
									?>
                                    
                                    <?php 
									
									if($f_spotlights_array_slider){
									foreach($f_spotlights_array_slider->f_spotlights_slider  as $selected){ 
									 $spot2 =$sort_array2[$selected]
									
									?>
                                    
                                       <option  selected="selected" value="<?php echo  $spot2['postID'] ?>"><?php echo  $spot2['postTitle'] ?></option>
                                       <?php unset($sort_array2[$selected]);
									   
									   }}?>
                                    <?php foreach($sort_array2 as $spot){ ?>

                                       <option value="<?php echo  $spot['postID'] ?>"><?php echo  $spot['postTitle'] ?></option>

                                       <?php } ?>

                                    </select>

                                </div>

                                <div class="card-footer"><button style="margin-bottom:10px" name="f_submit_slider" class="btn btn-primary pull-right" type="submit" value="1">Submit</button></div>

                             </form>

                        </div>

                        </div>

                 </div>

            

            </div>

        <?php endif;?>
        
        
<?php  if(!special_cms()) { ?>
        <?php if(isset($categories)): 

		$f_spotlights_array= array();

		if(isset($f_spotlights)) $f_spotlights_array = json_decode($f_spotlights);

		?>

            <div class="row set-card-spacing" style="margin-top:20px">

            

             <div class="col-md-12 grid-margin2">

                <?php if($success4 = $this->session->flashdata('success4')): ?>

                        <div id="success4" class="alert alert-success" role="alert">

                            <?php echo $success4 ?>

                        </div>

                    <?php endif ?>

                    <div class="card rounded">

                        <div class="card-header"><h4>Business Featured Resources </h4></div>

                         <div class="card-body">

                            <form method="post" action="<?php echo base_url('admin/landing_menu') ?>" enctype="multipart/form-data">

                                 <div class="form-group"> 

                                     <label>Block Title</label>

                                     <input type="text" name="f_title" class="form-control" value="<?php if(isset($f_spotlights_array->f_title)) echo $f_spotlights_array->f_title ?>"/>

                                 </div>

                                 <div class="form-group"> 

                                     <label>Block Description</label>

                                     <textarea class="form-control" name="f_description"><?php if(isset($f_spotlights_array->f_description)) echo $f_spotlights_array->f_description ?></textarea>

                                 </div>

                                <div class="form-group"> 

                               

                                    <label>Select Featured Spotlights</label>

                                    <select class="js-example-basic-multiple w-100" name="f_spotlights[]" multiple="multiple">


 <?php 
									$option="";
									foreach($categories as $key=>$spot){
										$sort_array2[$spot['postID']] = $spot;
										
									}
									?>
                                    
                                    <?php 
									
									if($f_spotlights_array->f_spotlights){
									foreach($f_spotlights_array->f_spotlights  as $selected){ 
									 $spot2 =$sort_array2[$selected]
									
									?>
                                    
                                       <option  selected="selected" value="<?php echo  $spot2['postID'] ?>"><?php echo  $spot2['postTitle'] ?></option>
                                       <?php unset($sort_array2[$selected]);
									   
									   }}?>





                                    <?php foreach($sort_array2 as $spot){ ?>

                                       <option<?php if(isset($f_spotlights_array->f_spotlights) && in_array($spot['postID'],$f_spotlights_array->f_spotlights)) echo ' selected="selected"' ?>  value="<?php echo  $spot['postID'] ?>"><?php echo  $spot['postTitle'] ?></option>

                                       <?php } ?>

                                    </select>

                                </div>

                                <div class="card-footer"><button style="margin-bottom:10px" name="f_submit" class="btn btn-primary pull-right" type="submit" value="1">Submit</button></div>

                             </form>

                        </div>

                        </div>

                 </div>

            

            </div>

        <?php endif;?>

        <?php } ?>

        <?php if(isset($categories)): 

		$h_spotlights_array= array();

		if(isset($h_spotlights)) $h_spotlights_array = json_decode($h_spotlights);

		?>

            <div class="row set-card-spacing" style="margin-top:20px">

            

             <div class="col-md-12 grid-margin2">

                <?php if($success5 = $this->session->flashdata('success5')): ?>

                        <div id="success5" class="alert alert-success" role="alert">

                            <?php echo $success5 ?>

                        </div>

                    <?php endif ?>

                    <div class="card rounded">

                        <div class="card-header"><h4>Hand Picked Activites</h4></div>

                         <div class="card-body">

                            <form method="post" action="<?php echo base_url('admin/landing_menu') ?>">

                                 <div class="form-group"> 

                                     <label>Block Title</label>

                                     <input type="text" name="h_title" class="form-control" value="<?php if(isset($h_spotlights_array->h_title)) echo $h_spotlights_array->h_title ?>"/>

                                 </div>

                                 <div class="form-group"> 

                                     <label>Block Description</label>

                                     <textarea class="form-control" name="h_description"><?php if(isset($h_spotlights_array->h_description)) echo $h_spotlights_array->h_description ?></textarea>

                                 </div>

                                <div class="form-group"> 

                               

                                    <label>Select Featured Spotlights</label>

                                    <select class="js-example-basic-multiple w-100" name="h_spotlights[]" multiple="multiple">
 <?php 
									$option="";
									foreach($categories as $key=>$spot){
										$sort_array2[$spot['postID']] = $spot;
										
									}
									?>
                                    
                                    <?php 
									
									if($h_spotlights_array->h_spotlights){
									foreach($h_spotlights_array->h_spotlights  as $selected){ 
									 $spot2 =$sort_array2[$selected]
									
									?>
                                    
                                       <option  selected="selected" value="<?php echo  $spot2['postID'] ?>"><?php echo  $spot2['postTitle'] ?></option>
                                       <?php unset($sort_array2[$selected]);
									   
									   }}?>





                                    <?php foreach($sort_array2 as $spot){ ?>
                                    <?php //foreach($categories as $spot){ ?>

                                       <option<?php if(isset($h_spotlights_array->h_spotlights) && in_array($spot['postID'],$h_spotlights_array->h_spotlights)) echo ' selected="selected"' ?>  value="<?php echo  $spot['postID'] ?>"><?php echo  $spot['postTitle'] ?></option>

                                       <?php } ?>

                                    </select>

                                </div>

                                <div class="card-footer"><button style="margin-bottom:10px" name="h_submit" class="btn btn-primary pull-right" type="submit" value="1">Submit</button></div>

                             </form>

                        </div>

                        </div>

                 </div>

            

            </div>

        <?php endif;?>

    </div>

</div>