
 <?php if(isset($page_type) && ($page_type =='user_profile' ||  $page_type =='post_detail')): ?>
 <script src="<?php echo base_url('assets/fitvids.js') ?>"></script>
 <script src="<?php echo base_url('assets/profile/global.js') ?>"></script>
 <script src="<?php echo base_url('assets/profile/fileinput.js') ?>"></script>
   <script src="<?php echo base_url('assets/vendors/owl.carousel/owl.carousel.min.js') ?>"></script>
 <script src="<?php echo base_url('assets/js/carousel.js') ?>"></script>
 <?php endif ?>
 <script src="<?php echo base_url('assets/vendors/core/core.js') ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.sameheight.js') ?>"></script>
<script>
		
		jQuery('.eq_height_wrapper').sameHeight({
		elements: '>*',
		flexible: true
	});
</script>
      <!-- endinject -->

      <!-- plugin js for this page -->

      <script src="<?php echo base_url('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') ?>"></script>

      <script src="<?php echo base_url('assets/vendors/progressbar.js/progressbar.min.js') ?>"></script>
      <!-- end plugin js for this page -->

      <!-- inject:js -->
      <script src="<?php echo base_url('assets/vendors/clipboard/clipboard.min.js') ?>"></script>
      <script src="<?php echo base_url('assets/vendors/feather-icons/feather.min.js') ?>"></script>
      <script src="<?php echo base_url('assets/js/template.js') ?>"></script>
    <?php if(isset($page_type) && ($page_type =='complete_profile' ||  $page_type =='user_profile' ||  $page_type =='spotlight3')): ?>

     <script src="<?php echo base_url('assets/vendors/jquery-steps/jquery.steps.min.js') ?>"></script>

      <script src="<?php echo base_url('assets/js/dropify.js') ?>"></script>

      <script src="<?php echo base_url('assets/vendors/dropify/dist/dropify.min.js') ?>"></script>

      <script src="<?php echo base_url('assets/js/wizard.js') ?>"></script>
      

      <?php /*?> <script src="<?php echo base_url('assets/vendors/cropperjs/cropper.min.js') ?>"></script> 

       <script src="<?php echo base_url('assets/js/cropper.js') ?>"></script> <?php */?>
      
      <script>

         $(function() {

         $('#search').on('keyup', function() {

          var pattern = $(this).val();

          $('.searchable-container .items').hide();

          $('.searchable-container .items').filter(function() {

              return $(this).text().match(new RegExp(pattern, 'i'));

          }).show();

         });



         





         });

      </script>

      <?php endif ?>
 <?php if(isset($page_type) && ($page_type =='messages')): ?>
       <script src="<?php echo base_url('assets/vendors/chartjs/Chart.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/vendors/jquery.flot/jquery.flot.js') ?>"></script>
  <script src="<?php echo base_url('assets/vendors/jquery.flot/jquery.flot.resize.js') ?>"></script>
  <script src="<?php echo base_url('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') ?>"></script>
       <script src="<?php echo base_url('assets/js/dashboard.js') ?>"></script>
  <script src="<?php echo base_url('assets/js/datepicker.js') ?>"></script>
  <script src="<?php echo base_url('assets/js/chat.js') ?>"></script>
  <?php endif;?>
        <?php if(isset($page_type) && $page_type =='onboard2'): ?>

<script src="<?php echo base_url('assets/vendors/jquery-validation/jquery.validate.min.js') ?>"></script>

<script src="<?php echo base_url('assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js') ?>"></script>

<script src="<?php echo base_url('assets/vendors/inputmask/jquery.inputmask.bundle.min.js') ?>"></script>

<script src="<?php echo base_url('assets/vendors/select2/select2.min.js') ?>"></script>

<script src="<?php echo base_url('assets/vendors/typeahead.js/typeahead.bundle.min.js') ?>"></script>

<script src="<?php echo base_url('assets/vendors/jquery-tags-input/jquery.tagsinput.min.js') ?>"></script>



<script src="<?php echo base_url('assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js') ?>"></script>

<script src="<?php echo base_url('assets/vendors/jquery-steps/jquery.steps.min.js') ?>"></script>

<script src="<?php echo base_url('assets/js/wizard.js') ?>"></script>

<script src="<?php echo base_url('assets/js/form-validation.js') ?>"></script>

<script src="<?php echo base_url('assets/js/bootstrap-maxlength.js') ?>"></script>

<script src="<?php echo base_url('assets/js/inputmask.js') ?>"></script>

<script src="<?php echo base_url('assets/js/tags-input.js') ?>"></script>

  <?php endif ?>
  
  <?php if(isset($page_type) && $page_type =='user_deshboard'): ?>
<script src="<?php echo base_url()?>assets/vendors/chartjs/Chart.min.js"></script>
<script src="<?php echo base_url()?>assets/js/dashboard.js"></script>
<script>
$(document).ready(function () {
            showGraph();
        });


        function showGraph()
        {
            {
                $.post("<?php echo base_url('dashboard/mychart') ?>",
                function (data)
                {
					var u_data = data;
                   /* console.log(data);
                     var name = [];
                    var marks = [];

                    for (var i in data) {
                        name.push(data[i].student_name);
                        marks.push(data[i].marks);
                    }*/

 var gridLineColor = 'rgba(77, 138, 240, .1)';

					var chartdata = {
						  labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
						  datasets: [{
							label: 'Spotlights',
							data:u_data,
							backgroundColor: '#727cf5'
						  }]
						};
						
				var option = {
					  maintainAspectRatio: false,
					  legend: {
						display: false,
						  labels: {
							display: false
						  }
					  },
					  scales: {
						xAxes: [{
						  display: true,
              barPercentage: .3,
              categoryPercentage: .6,
						  gridLines: {
							display: false
						  },
						  ticks: {
							fontColor: '#8392a5',
							fontSize: 10
						  }
						}],
						yAxes: [{
						  gridLines: {
							color: gridLineColor
						  },
						  ticks: {
							fontColor: '#8392a5',
							fontSize: 10
						  }
						}]
					  }
					};
             /*       var chartdata = {
                        labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                        datasets: [
                            {
                                label: 'Student Marks',
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: marks
                            }
                        ]
                    };*/

                    var graphTarget = $("#monthly-sales-chart2");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata,
						options: option
                    });
                });
            }
        }
        </script>

<?php /*?><script type="text/javascript">





const useAJAX = false;
$(document).ready(function(){
	
	
   var gridLineColor = 'rgba(77, 138, 240, .1)';
    var monthlySalesChart = document.getElementById('monthly-sales-chart2').getContext('2d');
    var my_chart =  new Chart(monthlySalesChart, {
        type: 'bar',
        data: {
          labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
          datasets: [{
            label: 'Sales',
            data:<?php echo $user_month_data; ?>,
            backgroundColor: '#727cf5'
          }]
        },
        options: {
          maintainAspectRatio: false,
          legend: {
            display: false,
              labels: {
                display: false
              }
          },
          scales: {
            xAxes: [{
              display: true,
              barPercentage: .3,
              categoryPercentage: .6,
              gridLines: {
                display: false
              },
              ticks: {
                fontColor: '#8392a5',
                fontSize: 10
              }
            }],
            yAxes: [{
              gridLines: {
                color: gridLineColor
              },
              ticks: {
                fontColor: '#8392a5',
                fontSize: 10,
                min: 80,
                max: 200
              }
            }]
          }
        }
      }
    );
  console.log(my_chart);
  my_chart.update(data.);
});
</script>
<?php */?><?php endif;?>
<?php if(isset($page_type) && $page_type =='spotlight'): ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap-datetimepicker.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/timepicker.js')?>"></script>
<link rel="stylesheet" href="<?php echo base_url('markitup/easyeditor-modal.css') ?>">
<script src="<?php echo base_url('assets/vendors/jquery-tags-input/jquery.tagsinput.min.js') ?>"></script>
 <script src="<?php echo base_url('assets/vendors/select2/select2.min.js') ?>"></script>
 <script src="<?php echo base_url('assets/js/tags-input.js') ?>"></script>
 <style>
 .trumbowyg-editor p{margin-bottom:15px}
.trumbowyg-Youtube-button{
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
	font-size: 23px;
}
.trumbowyg-Youtube-button svg{display:none}
.trumbowyg-Youtube-button:before {
    content: "\f167";
}
</style>
<link rel="stylesheet" href="<?php echo base_url('markitup/easyeditor-modal.css') ?>">
  <script src="<?php echo base_url('markitup/jquery.form.min.js') ?>"></script>
 <script src="<?php echo base_url('markitup/jquery.easyeditor.js') ?>"></script>

<script src="<?php echo base_url('assets/editor.js')?>"></script>
 <script src="<?php echo base_url('assets/noembed.js')?>"></script>
 <script src="<?php echo base_url('assets/clean_paste.js')?>"></script>
  <script src="<?php echo base_url('assets/e_plugin/trumbowyg.fontsize.js')?>"></script>
    <script src="<?php echo base_url('assets/e_plugin/trumbowyg.fontfamily.js')?>"></script>
<script>
function isURL(str) {
  var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
  '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.?)+[a-z]{2,}|'+ // domain name
  '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
  '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
  '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
  '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
  return pattern.test(str);
}
function youtube_parser(url){
    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
    var match = url.match(regExp);
    return (match&&match[7].length==11)? match[7] : false;
}
function zati_soda(){
$('#txtEditor').trumbowyg('restoreRange');
 var videoLink = prompt('Youtube Video Link', '');
	

	var videoId = youtube_parser(videoLink);
	
		//alert(videoId);

	if(videoId) {
		var video = '<iframe width="100%" height="400px" src="https://www.youtube.com/embed/'+videoId+'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
		//$(iframe).attr({ width: '100%', height: '500', frameborder: 0, allowfullscreen: true, src: 'https://www.youtube.com/embed/' + videoId });
		//alert(video);
		 
		$('#txtEditor').trumbowyg('execCmd', {
			cmd: 'insertHtml',
			param: video,
			forceCss: false,
		});
		//_this.insertAtCaret(iframe);
	}else {
	alert('Invalid YouTube URL!');
	}

}
function getYoutubeVideoIdFromUrl(url){
	if(url.length === 0) return false;
	var videoId = '';
	url = url.replace(/(>|<)/gi,'').split(/(vi\/|v=|\/v\/|youtu\.be\/|\/embed\/)/);
	if(url[2] !== undefined) {
		videoId = url[2].split(/[^0-9a-z_\-]/i);
		videoId = videoId[0];
	}
	else {
		videoId = url;
	}
	return videoId;
};
	$(document).ready(function() {
		
		
		
		
		
		$("#easyeditor-modal-1").on("click",".easyeditor-modal-close", function(){
			 $('#easyeditor-modal-1').addClass('is-hidden');
			});
		
		$(".trumbowyg-editor").on("click",".editor_img", function(){
			var href =$(this).parent().find('a').attr("href");
			if(href){
				var placeholder =href;
			}else{
				var placeholder ='http://';
			}
			var person = prompt("Please Enter URL", 'http://');
			 if (person != null ) {
				 if (isURL(person)) {
					$(this).wrap('<a href="'+person+'"></a>');
				 }else{
				  alert('Please Insert a Valid URL');
				 }
			 }
			});
		$("#easyeditor-modal-1").on("click",".delete", function(){
		   var id     = $(this).data('delete');   
		   var clicked     = $(this)
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('dashboard/delete_editor_image')?>",
				data: "id="+ id,
				success: function(){
					clicked.parent().parent().remove();
					clicked.parent().parent().fadeIn();
				}
			});
		return false;
		});
		
		
		
		var trumbowyg = $("#txtEditor").trumbowyg({
			btnsDef: {
				// Create a new dropdown
				 image: {
					fn: function(){
					  $('#easyeditor-modal-1').removeClass('is-hidden');
				
					},
					title: 'Insert Image',
					text: 'Insert Image',
					ico: 'insertImage',
					class: 'trumbowyg-insertImage-button',
                    hasIcon: true
				},
				 youtube22: {
					fn: function(){
						//alert('dddddddd');
						zati_soda();
					
					
					},
					title: 'Insert Youtube',
					text: 'Insert Youtube',
					ico: '',
					class: 'trumbowyg-Youtube-button',
                    hasIcon: true
				}
		   },
			btns:[
			["viewHTML"],["undo","redo"],["formatting"],["strong","em","del"],['fontsize'],['fontfamily'],["superscript","subscript"],["link"],["image"],["justifyLeft","justifyCenter","justifyRight","justifyFull"],["unorderedList","orderedList"],["horizontalRule"],['youtube22'],["removeformat"],["fullscreen"]
		],
		imgDblClickHandler: function () {
			var href =$(this).parent().find('a').attr("href");
			var src =$(this).attr("src");
			if(href){
				var placeholder =href;
			}else{
				var placeholder ='http://';
			}
			var person = prompt("Please Enter URL", 'http://');
			 if (person != null ) {
				 if (isURL(person)) {
					 var html = '<a class="img_link" href="'+person+'"><img src="'+src+'" class="img-responsive editor_img" alt=""></a>'
					 $(this).remove();
					 $('#txtEditor').trumbowyg('execCmd', {
							cmd: 'insertHtml',
							param: html,
							forceCss: false,
						});
					//$(this).unwrap();
					//$(this).wrap('<a class="img_link" href="'+person+'"></a>');
					//alert('ddddddddddd');
				 }else{
				  alert('Please Insert a Valid URL');
				 }
			 }
			/*var t = i.data('trumbowyg'),
				$img = $(this),
				src = $img.attr('src'),
				style = $img.attr('style') || '';

			if (src.indexOf('data:image') === 0) {
				src = base64;
			}*/
		},
		svgPath: '<?php echo base_url('assets/icons.svg')?>' // or a path like '/assets/my-custom-path/icons.svg'
	});

	$loader = $('.easyeditor-modal-content-body-loader');
        $('.easyeditor-modal-content-body').find('form').ajaxForm({
            beforeSend: function() {
                $loader.css('width', '0%');
            },
            uploadProgress: function(event, position, total, percentComplete) {
                $loader.css('width', percentComplete + '%');
            },
            success: function() {
                $loader.css('width', '100%');
            },
            complete: function(get) {
				 $('#easyeditor-modal-1 .ajaxx_box').html(get.responseText); 
				 $('#easyeditor-modal-1 #easyeditor-file').val(''); 
				 $loader.hide();
               /* if(get.responseText != 'null') {
				   
                    easyEditor.insertHtml('<figure><img src="<?php echo base_url()?>uploads/editor_images/'+ get.responseText +'" alt=""></figure>');

                    easyEditor.closeModal('#easyeditor-modal-1');
                }*/
            }
			});
			
			$("#easyeditor-modal-1").on("click",".img_boxx", function(){
			var html = $(this).html();
			$('#txtEditor').trumbowyg('execCmd', {
				cmd: 'insertHtml',
				param: html,
				forceCss: false,
			});
			
			//trumbowyg.execCmd("insertHtml", html);
			$('#easyeditor-modal-1').addClass('is-hidden');
			// easyEditor.closeModal('#easyeditor-modal-1');
			//Some code
		});
	});
</script>
<div class="easyeditor-modal is-hidden" id="easyeditor-modal-1" style="z-index:99999">
    <div class="easyeditor-modal-content">
        <div class="easyeditor-modal-content-header">Upload images</div>
        <div class="easyeditor-modal-content-body">
            <div class="easyeditor-modal-content-body-loader"></div>
               <div  class="ajaxx_box row">
               <?php 
			   $user_id = $this->session->userdata('user_id');
			   $images  = $this->db->get_where('editor_img',array('user_id'=>$user_id))->result();
			   $html ="";
				if($images){
					foreach($images as $img){
					$html .=  '<div class="col-md-2 boxx"><div class="img_boxx"><img src="'.base_url('uploads/editor_images/'.$img->url).'" class="img-responsive editor_img"></div><small><span class="delete" data-delete="'.$img->image_id.'"> delete</span></small>
				</div>';
				}
				}
				echo $html ?>
              </div>
            <button class="easyeditor-modal-close">x</button>

            <form action="<?php echo base_url('dashboard/editor_upload')?>" method="post" enctype="multipart/form-data">
                <input type="file" name="file" id="easyeditor-file">
                <button type="submit" name="easyeditor-upload">Upload Image</button>
                
            </form>

        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#create_spotlight #region_mutiple').select2();
});
 /* window.onload = function () {
    tinymce.init({selector: 'textarea.wysiwyg',
	branding: false,
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        toolbar2: "print preview media | forecolor backcolor emoticons",

    });
  }*/
</script>
  <!-- end custom js for this page -->
  <script>
    $(document).ready(function(){
      
    $(".coupon_yesBtn").click(function(){
      $(".add_coupon").show();
      });
      $(".coupon_noBtn").click(function(){
      $(".add_coupon").hide();
      });
      
      $(".classified-section-btn").click(function(){
      $(".classified-section").show();
      $(".jobposting-section").hide();
      $(".events-section").hide();
      });
    
      $(".job-postingbtn").click(function(){
      $(".jobposting-section").show();
       $(".events-section").hide();
       $(".classified-section").hide();
      });
       
       $(".eventsbtn").click(function(){
      $(".events-section").show();
      $(".jobposting-section").hide();
      $(".classified-section").hide();
      });

       $(".news-blogbtn").click(function(){
      $(".events-section").hide();
      $(".jobposting-section").hide();
      $(".classified-section").hide();
      }); 
    
    });
   </script>
   
   
   <div class="easyeditor-modal is-hidden" id="easyeditor-modal-1">
    <div class="easyeditor-modal-content">
        <div class="easyeditor-modal-content-header">Upload images</div>
        <div class="easyeditor-modal-content-body">
            <div class="easyeditor-modal-content-body-loader"></div>
               <div  class="ajaxx_box row">
               <?php 
			   $user_id = $this->session->userdata('user_id');
			   $images  = $this->db->get_where('editor_img',array('user_id'=>$user_id))->result();
			   $html ="";
				if($images){
					foreach($images as $img){
					$html .=  '<div class="col-md-2 boxx"><div class="img_boxx"><img src="'.base_url('uploads/editor_images/'.$img->url).'" class="img-responsive editor_img"></div><small><span class="delete" data-delete="'.$img->image_id.'"> delete</span></small>
				</div>';
				}
				}
				echo $html ?>
              </div>
            <button class="easyeditor-modal-close">x</button>

            <form action="<?php echo base_url('dashboard/editor_upload')?>" method="post" enctype="multipart/form-data">
                <input type="file" name="file" id="easyeditor-file">
                <button type="submit" name="easyeditor-upload">Upload Image</button>
                
            </form>

        </div>
    </div>
</div>
<?php endif ?>
<?php if(isset($page_type) && $page_type =='spotlight2'): ?>
<script src="<?php echo base_url('assets/vendors/dropzone/dropzone.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/dropzone.js') ?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript">
Dropzone.autoDiscover = false;
	$(document).ready(function() {
		var maxImageWidth =600
		var maxImageHeight =400
		 var dz_sort = new Dropzone('#spotlight_upload', {
        url: "<?php echo base_url('dashboard/multi_image_upload/'.$this->uri->segment(3)) ?>",
        maxFilesize: 3,
        acceptedFiles: 'image/*',
        addRemoveLinks: true,
		dictDefaultMessage: 'Drop image here (or click) to upload Images (Recommended image size is "Width: 800px and Height: 625px")',
		 init: function() {
        thisDropzone = this;
			$.get('<?php echo base_url('dashboard/display_image/'.$this->uri->segment(3)) ?>', function(data) {
	 
				$.each(data, function(key,value){
					 
					var mockFile = { name: value.name, size: value.fileid, fileid: value.fileid,filelink: value.filelink };
					 
					thisDropzone.options.addedfile.call(thisDropzone, mockFile);
	 
					thisDropzone.options.thumbnail.call(thisDropzone, mockFile, "<?php echo base_url('uploads/spotlights/')?>"+value.name);
					 $(mockFile.previewElement).prop('id', value.fileid);
				});
				 
			});
		
		this.on("thumbnail", function(file) {
			if (file.width < maxImageWidth || file.height < maxImageHeight) {
				file.rejectDimensions();
			}else {
				if(file.size < 1024*1024*2/*2MB*/)
				{
					file.acceptDimensions();
				}
			}
		}),
		this.on("success", function(file, response) {
    		//console.log(response); 
        var res = $.parseJSON( response );  
				file.fileid=res.image_id;
				file.file_name=res.filelink;
        //console.log(res.image_id);
    		}),

    this.on("removedfile", function (file, data) {
    		$.ajax({
    			type:'POST',
    			url:'<?php echo base_url('dashboard/delete_image/') ?>'+file.fileid,
    			data : {"file_id" : file.fileid,"file_name" : file.filelink},
    			success : function (data) {
            	$.each(data, function (key, value) {
				
				});
    			}
    		});
			var _ref;
      return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;        
              
			})
		
		},
		 accept: function(file, done) {
			file.rejectDimensions = function() { 
				done("Images width and height must be greater then 600px and 400px "); 
			};
			file.acceptDimensions = done;
		}
    	
    });

	
	$('.dropzone').sortable({
            items: '.dz-preview',
            cursor: 'move',
            opacity: 0.5,
            containment: '.dropzone',
            distance: 20,
            tolerance: 'pointer',
            stop: function () {
				console.log(dz_sort.files)
                var queue = dz_sort.files;
                var new_queue = [];
                $('#spotlight_upload .dz-preview').each(function (count, el) {
					var name  = $(this).attr('id')
					
					//$(this).find('.dz-details span').text();
					 new_queue.push(name);
					/*//console.log(name);
                    //var name = el.innerHTML;
                    queue.forEach(function (file) {
                            file.order = count + 1;
                            new_queue.push(file);
                        }
                    });*/
					console.log(new_queue);
					///
						$.ajax({
							  type: "POST",
							  url: "<?php echo base_url('dashboard/ajax_short_image') ?>",
							  data: JSON.stringify(new_queue),
							  ontentType: "application/json",
							   beforeSend: function(){
								     $('#ajax_loader').show()
								$('#ajax_loader').html(' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
							   },
							  success: function(result) {
								  $('#ajax_loader').hide()
								
							  },
						});
				});
				
				///
                
            }
        });
	
});

</script>


<?php endif ?>
 <?php if(isset($page_type) && ($page_type =='user_profile' ||  $page_type =='post_detail')): ?>
 <script src="<?php echo base_url('assets/fitvids.js') ?>"></script>
 <script src="<?php echo base_url('assets/profile/global.js') ?>"></script>
 <script src="<?php echo base_url('assets/profile/fileinput.js') ?>"></script>
   <script src="<?php echo base_url('assets/vendors/owl.carousel/owl.carousel.min.js') ?>"></script>
 <script src="<?php echo base_url('assets/js/carousel.js') ?>"></script>

 <script>
  
  
  
 $( document ).ready(function() {
 initFitVids();
 });
 </script>
 <?php endif ?>
  <script>
  
  
  
 $( document ).ready(function() {
	 new ClipboardJS('.card-header .copy_to_clipboard');
	 
   $('.post-actions .like_count').on('click touchstart', function () {
	  var likes = parseInt($(this).find('like_count_data').text());
	  var current =$(this);
	 if(!likes) likes=0;
		$.ajax({
			  type: "POST",
			  url: "<?php echo base_url('user/like_count') ?>",
			  data: {
				id: $(this).data('post-id')
			  },
			  
			  dataType:'json',
			  beforeSend: function(){
				 current.append('<span class="msg spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
			   },
			  success: function(result) {
				if(result.status == 'login'){
					window.location.href ='<?php echo base_url('enduser/login') ?>';
				}else{
					//result = JSON.stringify(result);
					 current.find('.msg').remove();
					console.log(result)
					//alert(result.status)
					if(result.status =='like'){
						current.find('svg').css({ fill: "#727cf5" })
						current.find('svg').css({ color: "#727cf5" })
						
					}else{
						current.find('svg').css({ fill: "none" })
						current.find('svg').css({ color: "#000" })
						current.removeClass('heartfill');
					}
					
					current.find('.like_count_data').html(result.count) 
				}
			  },
			});
	   });
	   
	   
	   
	   //fallow script
	   
	   $('#fallow_btn').on('click touchstart', function () {
	  var likes = parseInt($(this).find('like_count_data').text());
	  var current =$(this);
		$.ajax({
			  type: "POST",
			  url: "<?php echo base_url('user/follow') ?>",
			  data: {
				id: $(this).data('fallow-id')
			  },
			  dataType:'json',
			   beforeSend: function(){
				 current.append(' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
			   },
			  success: function(result) {
				if(result.status == 'login'){
					window.location.href ='<?php echo base_url('enduser/login') ?>'
					//alert('Can not like own post');
				}else{
					//result = JSON.stringify(result);
					//console.log(result)
					if(result.status =='followed'){
						current.addClass('followed');
						current.text('Following') 
						
					}else{
						current.removeClass('followed')
						current.text('Follow') 
					}
					
					
				}
			  },
			});
	   });
	   
	   
	   
	   
	    $('#recommend_btn').on('click touchstart', function () {
	  var likes = parseInt($(this).find('like_count_data').text());
	  var current =$(this);
		$.ajax({
			  type: "POST",
			  url: "<?php echo base_url('user/recommend') ?>",
			  data: {
				id: $(this).data('recommend-id')
			  },
			  dataType:'json',
			  beforeSend: function(){
				 current.append(' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
			   },
			  success: function(result) {
				if(result.status == 'login'){
					window.location.href ='<?php echo base_url('enduser/login') ?>'
					//alert('Can not like own post');
				}else{
					//result = JSON.stringify(result);
					//console.log(result)
					if(result.status =='recommended'){
						current.addClass('recommend');
						current.text('Recommended') 
						
					}else{
						current.removeClass('recommend')
						current.text('Recommend this business') 
					}
					
					
				}
			  },
			});
	   });
	   
	  
var timeout = setInterval(reloadChat, 10000); 
var timeout = setInterval(notify_body, 10000);   

var timeout = setInterval(msg_notify, 10000); 
var timeout = setInterval(msg_notify_body, 10000); 
	   
});
  
function reloadChat () {

     $('#ajax_notify #l_notifiy').load('<?php echo base_url('user/notification_html') ?>');
}
function notify_body () {

     $('#ajax_notify #user_notify_drop').load('<?php echo base_url('user/notification_body') ?>');
}

function msg_notify () {

     $('#ajax_notify2 #l_notifiy2').load('<?php echo base_url('user/notification_html_msg') ?>');
}
function msg_notify_body () {

     $('#ajax_notify2 #user_notify_drop2').load('<?php echo base_url('user/notification_body_msg') ?>');
}
 </script>
 
	  <div id="modal_alert" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal_table" style="max-width:480px">
    <div class="modal-content modal_cell rounded">
      <div class="modal-header">
        <h3>Fail</h3>
      </div>
      <div class="modal-body text-center text-danger"></div>
     <div class="modal-footer text-center-xs">
        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> Close</button>
      </div>
    </div>
  </div>
</div>
<div id="modal_success" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal_table" style="max-width:480px">
    <div class="modal-content modal_cell rounded">
      <div class="modal-header">
        <h3>Success</h3>
      </div>
      <div class="modal-body text-center text-success" style="padding-top:30px;padding-bottom:30px;font-weight:bold;max-width:480px">Your profile cover was changed successfully!</div>
      <div class="modal-footer text-center-xs">
        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i> Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_delete">
  <div class="modal-dialog modal_table" style="max-width:400px">
    <div class="modal-content modal_cell">
      <div class="modal-header">
        <h3 id="myModalLabel"><i class="fa fa-info-circle"></i> Notification</h3>
      </div>
      <div class="modal-body">Are You Sure Want To Continue</div>
      <div class="modal-footer">
        <div class="row">
          <div class="col-xs-6 text-left"><a href="http://localhost/social/user/remove/comments/10/snapshots-20" class="btn btn-danger" id="delete_link" data-id="comment10" data-parent="snapshots20"><i class="fa fa-check" id="delete-icon"></i> Continue</a></div>
          <div class="col-xs-6">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="review_model" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Write a Review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form accept-charset="UTF-8" action="<?php echo base_url('publicprofile/review/'.$this->uri->segment(2)) ?>" method="post">
           <input id="user_ratingsss" value="<?php if(isset($user_review->ratings)) echo $user_review->ratings ?>" type="number" name="rating" class="rating" min='0' max='5' step='1'>
            <div class="form-group">
            <textarea class="form-control" cols="50" id="new-review" name="comment" placeholder="Enter your review here..." rows="5"><?php if(isset($user_review->review_content)) echo $user_review->review_content ?></textarea>
</div>
<div class="form-group">
              <button type="submit" class="btn btn-primary"><?php if(isset($user_review))echo 'Update Reivew';else echo ' Add Reivew' ?></button>
             </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>
 <?php if(isset($page_type) && ($page_type =='user_profile')): ?>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/star-rating.min.js" type="text/javascript"></script>
 <?php endif ?>
 <?php if($page_type =='spotlight' || $page_type =='spotlight2' || $page_type =='spotlight3'  ): ?>
 <script>
 $(document).ready(function() {
     $('#exampleModal').on('hidden.bs.modal', function () {
    $("#exampleModal iframe").attr("src", $("#exampleModal iframe").attr("src"));
});
});

</script>
 
 <?php endif ?>