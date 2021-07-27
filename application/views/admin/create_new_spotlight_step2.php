<div class="page-content">
  <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
     <div>
        <h4 class="mb-3 mb-md-0">Spotlight Pro <a href="#" data-toggle="modal" data-target="#spotlightpro">
        <img src="<?php echo base_url('assets/images/info.svg') ?>" class="infoimg"> </a></h4>
     </div>
     <div class="d-flex align-items-center flex-wrap text-nowrap mt-20">
        <p class="ts-10 mr-15">** Upgrade to Enjoy Pro features of Spotlight Tool</p>
        <div id="the-basics">
           <button type="submit" class="btn btn-primary mr-2 ">Get Started</button>
        </div>
     </div>
  </div>
  <div class="custom-tabbox">
     <h4>Let's Start 
        <span style="float:right">
           <button type="button" class="btn btn-primary watch-tutorial" data-toggle="modal" data-target="#exampleModal">
              <i data-feather="play-circle"></i> Watch Tutorial
       </button>
           </span>
     </h4><div class="clearfix"></div>
     <p class="text-muted">Start here to create your spotlight by selecting a spotlight option below to begin.
     </p>
     <!-- tab -->
     <div class="tabbable-panel">
        <div class="tabbable-line">
           <ul class="nav nav-tabs">
              <li class="active">
                 <a href="create_new_spotlight.html" class="contentBTn">
                 1. Content </a>
              </li>

              <li class="active">
                 <a href="" class="contentBTn">
                 2. Featured Images </a>
              </li>


              <li>
                 <a href="#"  class="thumbnailBtn">
                 3. Add Cover & Publish </a>
              </li>
           </ul>
           <div class="">
             
              <section class="space-remove">
                 
                 <div class="tabThumbnail" id="">
                    <?php //print_r($spotlight_images);exit; ?>
                    <div class="row">
                          <div class="col-md-12">
                             <div class="form-group">
                                <label>File upload</label>
                               <?php $url = $this->uri->segment(3); ?>
                                <div class="input-group col-xs-12" id="dropzone">
                                <form action="<?php echo base_url('dashboard/multi_image_upload/'.$url) ?>" class="dropzone" id="spotlight_upload" enctype="multipart/form-data" ></form>
                                <?php /*?>   <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                                   <span class="input-group-append">
                                      <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                   </span><?php */?>
                                </div>
                             </div>   

                         <?php /*?>     
                             <p>Best Image upload size 1080x720 - JPG or PNG files only.</p>


                              <div class="row thumbnail-images">
                                     <div class="col-md-3">
                                      <div class="card">
                                         <a href="" class="close-iconbtn"><i data-feather="x-circle"></i></a>
                                         <img src="<?php echo base_url('assets/images/placeholder.jpg') ?>" class="card-img-top" alt="...">
                                        
                                       </div>
                                     </div>  <!-- col -->

                                     <div class="col-md-3">
                                      <div class="card">
                                         <a href="" class="close-iconbtn"><i data-feather="x-circle"></i></a>
                                         <img src="<?php echo base_url('assets/images/placeholder.jpg') ?>" class="card-img-top" alt="...">
                                        
                                       </div>
                                     </div>  <!-- col -->

                                     <div class="col-md-3">
                                      <div class="card">
                                         <a href="" class="close-iconbtn"><i data-feather="x-circle"></i></a>
                                         <img src="<?php echo base_url('assets/images/placeholder.jpg') ?>" class="card-img-top" alt="...">
                                        
                                       </div>
                                     </div>  <!-- col -->

                                     <div class="col-md-3">
                                      <div class="card">
                                         <a href="" class="close-iconbtn"><i data-feather="x-circle"></i></a>
                                         <img src="<?php echo base_url('assets/images/placeholder.jpg') ?>" class="card-img-top" alt="...">
                                        
                                       </div>
                                     </div>  <!-- col -->
                              </div> <!-- row -->
<?php */?>


                          </div> <!-- col -->
                          
                          <?php /*?><div class="col-md-5">
                             <div class="sliderbox">
                             <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                   <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                   <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                   <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                   <div class="carousel-item active">
                                      <img src="<?php echo base_url('assets/images/placeholder.jpg') ?>" class="d-block w-100" alt="...">
                                   </div>
                                   <div class="carousel-item">
                                      <img src="<?php echo base_url('assets/images/placeholder.jpg') ?>" class="d-block w-100" alt="...">
                                   </div>
                                   <div class="carousel-item">
                                      <img src="<?php echo base_url('assets/images/placeholder.jpg') ?>" class="d-block w-100" alt="...">
                                   </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                   <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                   <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                   <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                   <span class="sr-only">Next</span>
                                </a>
                             </div>
                             </div>

                          </div><?php */?> <!-- col -->

                    </div> <!-- row  -->


                    


                    <p class="text-right">
                       <a href="<?php echo base_url().'admin/create_new_spotlight/'.$url; ?>" class="btn btn-primary thumbnailBtn">Previous</a>
                       <a href="<?php echo base_url().'admin/create_new_spotlight_step3/'.$url; ?>" class="btn btn-primary contentBTn">Next</a>
                    </p>

              </div>


              

           </section>
              <!-- tab2 -->
                 </div>
                 
                 </div>
                 </div>   
                 
                 
                 
                 </div>
                 <!-- custom-tabbox -->
           </div>
           <!-- page-content -->
        </div>


             <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Watch Tutorial</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <iframe width="100%" height="315" src="https://www.youtube.com/embed/1QUfq-tFGlg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
       </div>
     </div>
   </div>
 </div>


 <!-- modal -->
<div class="modal fade" id="spotlightpro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title text-center" id="exampleModalLabel">Spotlight Pro</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <p class="text-muted mt-10 text-center"> Spotlight Lets you create and manage your business content in minutes to share with your community and followers. Spotlight can power all of your business content. Create marketing advertising promotions,spotlight Specials and Coupons ads, News & Events, local commercial real estate listings, host Resumes, Jobs postings and Classifieds.</p>
      <br />
      <p class="text-center mt10">
        <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-primary mr-2 ">Got it</button>
      </p>


    </div>
    </div>
  </div>
  </div>
