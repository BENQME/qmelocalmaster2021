<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>QMELOCAL:</title>
      <!-- core:css -->
       <?php include('header.php'); ?>
      <!-- End layout styles -->
   </head>
   <body>
      <div class="main-wrapper">
      <!-- partial:partials/_navbar.html -->
      <div class="horizontal-menu">
         <nav class="navbar top-navbar">
            <div class="container">
               <div class="navbar-content">
                  <a href="#" class="navbar-brand">
                  QME<span>LOCAL</span>
                  </a>
                  <form class="search-form">
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <div class="input-group-text">
                              <i data-feather="search"></i>
                           </div>
                        </div>
                        <input type="text" class="form-control" id="navbarForm" placeholder="Search Keywords that match a business category...">
                     </div>
                  </form>
                  <ul class="navbar-nav">
                     <li class="nav-item dropdown nav-apps">
                        <a class="nav-link dropdown-toggle" href="#" id="appsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i data-feather="grid"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="appsDropdown">
                           <div class="dropdown-header d-flex align-items-center justify-content-between">
                              <p class="mb-0 font-weight-medium">Web Apps</p>
                              <a href="javascript:;" class="text-muted">Edit</a>
                           </div>
                           <div class="dropdown-body">
                              <div class="d-flex align-items-center apps">
                                 <a href="">
                                    <i data-feather="message-square" class="icon-lg"></i>
                                    <p>Chat</p>
                                 </a>
                                 <a href="">
                                    <i data-feather="calendar" class="icon-lg"></i>
                                    <p>Calendar</p>
                                 </a>
                                 <a href="">
                                    <i data-feather="mail" class="icon-lg"></i>
                                    <p>Email</p>
                                 </a>
                                 <a href="">
                                    <i data-feather="instagram" class="icon-lg"></i>
                                    <p>Profile</p>
                                 </a>
                              </div>
                           </div>
                           <div class="dropdown-footer d-flex align-items-center justify-content-center">
                              <a href="javascript:;">View all</a>
                           </div>
                        </div>
                     </li>
                     <li class="nav-item dropdown nav-messages">
                        <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i data-feather="mail"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="messageDropdown">
                           <div class="dropdown-header d-flex align-items-center justify-content-between">
                              <p class="mb-0 font-weight-medium">9 New Messages</p>
                              <a href="javascript:;" class="text-muted">Clear all</a>
                           </div>
                           <div class="dropdown-body">
                              <a href="javascript:;" class="dropdown-item">
                                 <div class="figure">
                                    <img src="https://via.placeholder.com/30x30" alt="userr">
                                 </div>
                                 <div class="content">
                                    <div class="d-flex justify-content-between align-items-center">
                                       <p>Leonardo Payne</p>
                                       <p class="sub-text text-muted">2 min ago</p>
                                    </div>
                                    <p class="sub-text text-muted">Project status</p>
                                 </div>
                              </a>
                              <a href="javascript:;" class="dropdown-item">
                                 <div class="figure">
                                    <img src="https://via.placeholder.com/30x30" alt="userr">
                                 </div>
                                 <div class="content">
                                    <div class="d-flex justify-content-between align-items-center">
                                       <p>Carl Henson</p>
                                       <p class="sub-text text-muted">30 min ago</p>
                                    </div>
                                    <p class="sub-text text-muted">Client meeting</p>
                                 </div>
                              </a>
                              <a href="javascript:;" class="dropdown-item">
                                 <div class="figure">
                                    <img src="https://via.placeholder.com/30x30" alt="userr">
                                 </div>
                                 <div class="content">
                                    <div class="d-flex justify-content-between align-items-center">
                                       <p>Jensen Combs</p>
                                       <p class="sub-text text-muted">1 hrs ago</p>
                                    </div>
                                    <p class="sub-text text-muted">Project updates</p>
                                 </div>
                              </a>
                              <a href="javascript:;" class="dropdown-item">
                                 <div class="figure">
                                    <img src="https://via.placeholder.com/30x30" alt="userr">
                                 </div>
                                 <div class="content">
                                    <div class="d-flex justify-content-between align-items-center">
                                       <p>Amiah Burton</p>
                                       <p class="sub-text text-muted">2 hrs ago</p>
                                    </div>
                                    <p class="sub-text text-muted">Project deadline</p>
                                 </div>
                              </a>
                              <a href="javascript:;" class="dropdown-item">
                                 <div class="figure">
                                    <img src="https://via.placeholder.com/30x30" alt="userr">
                                 </div>
                                 <div class="content">
                                    <div class="d-flex justify-content-between align-items-center">
                                       <p>Yaretzi Mayo</p>
                                       <p class="sub-text text-muted">5 hr ago</p>
                                    </div>
                                    <p class="sub-text text-muted">New record</p>
                                 </div>
                              </a>
                           </div>
                           <div class="dropdown-footer d-flex align-items-center justify-content-center">
                              <a href="javascript:;">View all</a>
                           </div>
                        </div>
                     </li>
                     <li class="nav-item dropdown nav-notifications">
                        <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i data-feather="bell"></i>
                           <div class="indicator">
                              <div class="circle"></div>
                           </div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="notificationDropdown">
                           <div class="dropdown-header d-flex align-items-center justify-content-between">
                              <p class="mb-0 font-weight-medium">6 New Notifications</p>
                              <a href="javascript:;" class="text-muted">Clear all</a>
                           </div>
                           <div class="dropdown-body">
                              <a href="javascript:;" class="dropdown-item">
                                 <div class="icon">
                                    <i data-feather="user-plus"></i>
                                 </div>
                                 <div class="content">
                                    <p>New customer registered</p>
                                    <p class="sub-text text-muted">2 sec ago</p>
                                 </div>
                              </a>
                              <a href="javascript:;" class="dropdown-item">
                                 <div class="icon">
                                    <i data-feather="gift"></i>
                                 </div>
                                 <div class="content">
                                    <p>New Order Recieved</p>
                                    <p class="sub-text text-muted">30 min ago</p>
                                 </div>
                              </a>
                              <a href="javascript:;" class="dropdown-item">
                                 <div class="icon">
                                    <i data-feather="alert-circle"></i>
                                 </div>
                                 <div class="content">
                                    <p>Server Limit Reached!</p>
                                    <p class="sub-text text-muted">1 hrs ago</p>
                                 </div>
                              </a>
                              <a href="javascript:;" class="dropdown-item">
                                 <div class="icon">
                                    <i data-feather="layers"></i>
                                 </div>
                                 <div class="content">
                                    <p>Apps are ready for update</p>
                                    <p class="sub-text text-muted">5 hrs ago</p>
                                 </div>
                              </a>
                              <a href="javascript:;" class="dropdown-item">
                                 <div class="icon">
                                    <i data-feather="download"></i>
                                 </div>
                                 <div class="content">
                                    <p>Download completed</p>
                                    <p class="sub-text text-muted">6 hrs ago</p>
                                 </div>
                              </a>
                           </div>
                           <div class="dropdown-footer d-flex align-items-center justify-content-center">
                              <a href="javascript:;">View all</a>
                           </div>
                        </div>
                     </li>
                     <li class="nav-item dropdown nav-profile">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="https://via.placeholder.com/30x30" alt="profile">
                        </a>
                        <div class="dropdown-menu" aria-labelledby="profileDropdown">
                           <div class="dropdown-header d-flex flex-column align-items-center">
                              <div class="figure mb-3">
                                 <img src="https://via.placeholder.com/80x80" alt="">
                              </div>
                              <div class="info text-center">
                                 <p class="name font-weight-bold mb-0">Amiah Burton</p>
                                 <p class="email text-muted mb-3">amiahburton@gmail.com</p>
                              </div>
                           </div>
                           <div class="dropdown-body">
                              <ul class="profile-nav p-0 pt-3">
                                 <li class="nav-item">
                                    <a href="profile.html" class="nav-link">
                                    <i data-feather="user"></i>
                                    <span>Profile</span>
                                    </a>
                                 </li>
                                 <li class="nav-item">
                                    <a href="javascript:;" class="nav-link">
                                    <i data-feather="edit"></i>
                                    <span>Edit Profile</span>
                                    </a>
                                 </li>
                                 <li class="nav-item">
                                    <a href="javascript:;" class="nav-link">
                                    <i data-feather="log-out"></i>
                                    <span>Log Out</span>
                                    </a>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </li>
                  </ul>
                  <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
                  <i data-feather="menu"></i>               
                  </button>
               </div>
            </div>
         </nav>
         <nav class="bottom-navbar">
            <div class="container">
               <ul class="nav page-navigation">
                  <li class="nav-item">
                     <a class="nav-link" href="dashboard.html">
                     <i class="link-icon" data-feather="box"></i>
                     <span class="menu-title">Dashboard</span>
                     </a>
                  </li>
                  <li class="nav-item mega-menu">
                     <a href="media_blog.html" class="nav-link">
                     <i class="link-icon" data-feather="feather"></i>
                     <span class="menu-title">Media &amp; Blog</span>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="events.html" class="nav-link">
                     <i class="link-icon" data-feather="inbox"></i>
                     <span class="menu-title">Events</span>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="classifieds.html" class="nav-link">
                     <i class="link-icon" data-feather="pie-chart"></i>
                     <span class="menu-title">Spotit Spotlight</span>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="jobs.html" class="nav-link">
                     <i class="link-icon" data-feather="pie-chart"></i>
                     <span class="menu-title">Jobs</span>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                     <i class="link-icon" data-feather="smile"></i>
                     <span class="menu-title">Global Content</span>
                     <i class="link-arrow"></i>
                     </a>
                     <div class="submenu">
                        <ul class="submenu-item">
                           <li class="nav-item"><a class="nav-link" href="">Create a Global Spotlight</a></li>
                           <li class="nav-item"><a class="nav-link" href="">Create a Region based Spotlight</a></li>
                        </ul>
                     </div>
                  </li>
                  <li class="nav-item">
                     <a href="#" class="nav-link">
                     <i class="link-icon" data-feather="pie-chart"></i>
                     <span class="menu-title">Manage</span>
                     <i class="link-arrow"></i>
                     </a>
                     <div class="submenu">
                        <div class="row">
                           <div class="col-md-6">
                              <ul class="submenu-item pr-0">
                                 <li class="category-heading">Portals</li>
                                 <li class="nav-item"><a class="nav-link" href="create_new_portal.html">Create new portal</a></li>
                                 <li class="nav-item"><a class="nav-link" href="portals.html">Edit Existing Portal</a></li>
                              </ul>
                           </div>
                           <div class="col-md-6">
                              <ul class="submenu-item pl-0">
                                 <li class="category-heading">Staff Users</li>
                                 <li class="nav-item"><a class="nav-link" href="create_new_user.html">Create a new User</a></li>
                                 <li class="nav-item"><a class="nav-link" href="users.html">Manage Existing User</a></li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </li>
                  <li class="nav-item">
							<a href="resources.html"  class="nav-link">
								<i class="link-icon" data-feather="hash"></i>
								<span class="menu-title">Resources</span></a>
						</li>
               </ul>
            </div>
         </nav>
      </div>
      <!-- partial -->
      <div class="page-wrapper">
      <div class="page-content">
      <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
         <div>
            <h4 class="mb-3 mb-md-0">Spotlight Pro <a href="#" data-toggle="modal" data-target="#spotlightpro">
               
               <img src="<?php echo base_url('assets/images/info.svg') ?>">
            </a></h4>
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
                     <a href="create_a_spotlight.html" class="contentBTn">
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
                        
                        <div class="row">
                              <div class="col-md-7">
                                 <div class="form-group">
                                    <label>File upload</label>
                                    <input type="file" name="img[]" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                       <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                                       <span class="input-group-append">
                                          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                       </span>
                                    </div>
                                 </div>   

                                  
                                 <p>Best Image upload size 1080x720 - JPG or PNG files only.
                                    </p>


                                  <div class="row thumbnail-images">
                                         <div class="col-md-3">
                                          <div class="card">
                                             <a href="" class="close-iconbtn"><i data-feather="x-circle"></i></a>

                                             <img src="<?php echo base_url('assets/images/placeholder.jpg')?>" 
                                                class="card-img-top" alt="...">
                                            
                                           </div>
                                         </div>  <!-- col -->

                                         <div class="col-md-3">
                                          <div class="card">
                                             <a href="" class="close-iconbtn"><i data-feather="x-circle"></i></a>
                                             <img src="<?php echo base_url('assets/images/placeholder.jpg')?>" class="card-img-top" alt="...">
                                            
                                           </div>
                                         </div>  <!-- col -->

                                         <div class="col-md-3">
                                          <div class="card">
                                             <a href="" class="close-iconbtn"><i data-feather="x-circle"></i></a>
                                             <img src="<?php echo base_url('assets/images/placeholder.jpg')?>" class="card-img-top" alt="...">
                                            
                                           </div>
                                         </div>  <!-- col -->

                                         <div class="col-md-3">
                                          <div class="card">
                                             <a href="" class="close-iconbtn"><i data-feather="x-circle"></i></a>
                                             <img src="<?php echo base_url('assets/images/placeholder.jpg')?>" class="card-img-top" alt="...">
                                            
                                           </div>
                                         </div>  <!-- col -->
                                  </div> <!-- row -->



                              </div> <!-- col -->
                              
                              <div class="col-md-5">
                                 <div class="sliderbox">
                                 <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                       <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                       <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                       <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                       <div class="carousel-item active">

                                          <img src="<?php echo base_url('assets/images/placeholder.jpg')?>" class="d-block w-100" alt="...">
                                          
                                       </div>
                                       <div class="carousel-item">
                                             <img src="<?php echo base_url('assets/images/placeholder.jpg')?>" class="d-block w-100" alt="...">
                                       </div>
                                       <div class="carousel-item">
                                              <img src="<?php echo base_url('assets/images/placeholder.jpg')?>" class="d-block w-100" alt="...">
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

                              </div> <!-- col -->

                        </div> <!-- row  -->


                        


                        <p class="text-right">
                           <a href="create_a_spotlight.html" class="btn btn-primary thumbnailBtn">Previous</a>
                           <a href="create_a_spotlight-three.html" class="btn btn-primary contentBTn">Next</a>
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
         </div>
         <br />
         <!-- partial:../../partials/_footer.html -->
         <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between">
            <p class="text-muted text-center text-md-left">Copyright ?? 2020 <a href="#" target="_blank"> Compass Design Co.</a>, All rights reserved</p>
            <p class="text-muted text-center text-md-left mb-0 d-none d-md-block">Handcrafted With <i class="mb-1 text-primary ml-1 icon-small" data-feather="heart"></i></p>
         </footer>
         <!-- partial -->
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
  <!--modal -->
      <!-- plugin js for this page -->

      <?php include('footer.php'); ?>

      <!-- plugin js for this page -->
       
      <script>
         $(document).ready(function(){
           
           $(".classified-section-btn").click(function(){
             $(".classified-section").show();
           });
         
           $(".job-postingbtn").click(function(){
             $(".jobposting-section").show();
           });
            

         
            $(".eventsbtn").click(function(){
             $(".events-section").show();
           });
         
             
         
            
         
         
         
         });
      </script>
   </body>
</html>