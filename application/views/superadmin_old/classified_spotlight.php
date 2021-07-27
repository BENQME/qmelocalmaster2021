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
											<a href=""><i data-feather="message-square" class="icon-lg"></i><p>Chat</p></a>
											<a href=""><i data-feather="calendar" class="icon-lg"></i><p>Calendar</p></a>
											<a href=""><i data-feather="mail" class="icon-lg"></i><p>Email</p></a>
											<a href=""><i data-feather="instagram" class="icon-lg"></i><p>Profile</p></a>
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
                           <li class="nav-item"><a class="nav-link" href="create_a_spotlight.html">Create a Global Spotlight</a></li>
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
			<h4 class="mb-3 mb-md-0">Heaven 1 Kanal 5 Beds</h4>
			<p class="text-muted">1 min ago</p>
          </div>
         
		</div>
		
		<div class="row">
				<div class="col-md-8">
							<div class="jobs_spotlight_slider">
								<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                       <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                       <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                       <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                       <div class="carousel-item active">

                                       	<img src="<?php echo base_url('assets/images/placeholder.jpg') ?>" class="d-block w-100" alt="..." >
                                       </div>
                                       <div class="carousel-item">
                                          

                                       	<img src="<?php echo base_url('assets/images/placeholder.jpg') ?>" class="d-block w-100" alt="..." >

                                       </div>
                                       <div class="carousel-item">

                                       	<img src="<?php echo base_url('assets/images/placeholder.jpg') ?>" class="d-block w-100" alt="..." >

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
							</div> <!-- slider -->

							<br />
							<h6 class="card-title">Description</h6>
							<p>We Are Back Now. So After Long Time Period I & R Builders Proudly Presents Brand New 1 Kanal 5 Beds Cottage Available For Sale In Bahria Town
								Cottage Is On 50 Ft Wide Road. 
								Proper Double Unit With Total 5 Bedrooms With Attach Bathrooms. 
								On Ground Floor 2 Bedrooms With Attach Bathrooms, Kitchen, T. V Lounge And Drawing Plus Dinning Room.</p>	
							<br />
							<h6 class="card-title">Location & Nearby</h6>
							
							<p>
								
                               	<img src="<?php echo base_url('assets/images/placeholder.jpg') ?>" class="d-block w-100" alt="..." >

							</p>
								
								<br />
								<h6 class="card-title">Benefits</h6>		

								<p>Calculate and view the monthly mortgage on this house</p>	
								
								

								<div class="card-footer custom-card">
									<div class="d-flex post-actions">
										<a href="javascript:;" class="d-flex align-items-center text-muted mr-4">
											<i class="icon-md" data-feather="heart"></i>
											<p class="d-none d-md-block ml-2">Like</p>
										</a>
										<a href="javascript:;" class="d-flex align-items-center text-muted mr-4">
											<i class="icon-md" data-feather="message-square"></i>
											<p class="d-none d-md-block ml-2">Spot it </p>
										</a>
										<a href="javascript:;" class="d-flex align-items-center text-muted">
											<i class="icon-md" data-feather="share"></i>
											<p class="d-none d-md-block ml-2">Share</p>
										</a>
									</div>
								</div>
								
								<hr />
								<h4>Similar Spotit Spotlight</h4><br />
								<div class="row set-card-spacing">
									<div class="col-md-6 grid-margin">
														<div class="card rounded">
															<div class="card-header">
																<div class="d-flex align-items-center justify-content-between">
																	<div class="d-flex align-items-center">
																		<img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">														
																		<div class="ml-2">
																			<p>Mike Popescu</p>
																			<p class="tx-11 text-muted">1 min ago</p>
																		</div>
																	</div>
																	<div class="dropdown">
																		<button class="btn p-0" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<i class="icon-lg pb-3px" data-feather="more-horizontal"></i>
																		</button>
																		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
																			<a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="meh" class="icon-sm mr-2"></i> <span class="">Unfollow</span></a>
																			<a class="dropdown-item d-flex align-items-center" href="classified_spotlight.html"><i data-feather="corner-right-up" class="icon-sm mr-2"></i> <span class="">Go to post</span></a>
																			<a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="share-2" class="icon-sm mr-2"></i> <span class="">Share</span></a>
																			<a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="copy" class="icon-sm mr-2"></i> <span class="">Copy link</span></a>
																		</div>
																	</div>
																</div>
															</div>
															<div class="card-body">
																<p class="mb-2"><strong><a href="" class="spotlight-title">Spotlight Title</a></strong></p>
																<p class="mb-3 tx-14">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus minima delectus nemo unde quae recusandae assumenda.</p>
																<img class="img-fluid" src="https://via.placeholder.com/513x342" alt="">
															</div>
															<div class="card-footer">
																<div class="d-flex post-actions">
																	<a href="javascript:;" class="d-flex align-items-center text-muted mr-4">
																		<i class="icon-md" data-feather="heart"></i>
																		<p class="d-none d-md-block ml-2">Like</p>
																	</a>
																	<a href="javascript:;" class="d-flex align-items-center text-muted mr-4">
																		<i class="icon-md" data-feather="message-square"></i>
																		<p class="d-none d-md-block ml-2">Comment</p>
																	</a>
																	<a href="javascript:;" class="d-flex align-items-center text-muted">
																		<i class="icon-md" data-feather="share"></i>
																		<p class="d-none d-md-block ml-2">Share</p>
																	</a>
																</div>
															</div>
														</div>
									</div>
									<div class="col-md-6 grid-margin">
														<div class="card rounded">
															<div class="card-header">
																<div class="d-flex align-items-center justify-content-between">
																	<div class="d-flex align-items-center">
																		<img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">														
																		<div class="ml-2">
																			<p>Mike Popescu</p>
																			<p class="tx-11 text-muted">1 min ago</p>
																		</div>
																	</div>
																	<div class="dropdown">
																		<button class="btn p-0" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																			<i class="icon-lg pb-3px" data-feather="more-horizontal"></i>
																		</button>
																		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
																			<a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="meh" class="icon-sm mr-2"></i> <span class="">Unfollow</span></a>
																			<a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="corner-right-up" class="icon-sm mr-2"></i> <span class="">Go to post</span></a>
																			<a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="share-2" class="icon-sm mr-2"></i> <span class="">Share</span></a>
																			<a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="copy" class="icon-sm mr-2"></i> <span class="">Copy link</span></a>
																		</div>
																	</div>
																</div>
															</div>
															<div class="card-body">
																<p class="mb-2"><strong><a href="" class="spotlight-title">Spotlight Title</a></strong></p>
																<p class="mb-3 tx-14">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus minima delectus nemo unde quae recusandae assumenda.</p>
																<img class="img-fluid" src="https://via.placeholder.com/513x342" alt="">
															</div>
															<div class="card-footer">
																<div class="d-flex post-actions">
																	<a href="javascript:;" class="d-flex align-items-center text-muted mr-4">
																		<i class="icon-md" data-feather="heart"></i>
																		<p class="d-none d-md-block ml-2">Like</p>
																	</a>
																	<a href="javascript:;" class="d-flex align-items-center text-muted mr-4">
																		<i class="icon-md" data-feather="message-square"></i>
																		<p class="d-none d-md-block ml-2">Comment</p>
																	</a>
																	<a href="javascript:;" class="d-flex align-items-center text-muted">
																		<i class="icon-md" data-feather="share"></i>
																		<p class="d-none d-md-block ml-2">Share</p>
																	</a>
																</div>
															</div>
														</div>
									</div>
								</div> <!-- row -->

				</div> <!-- col -->
				<div class="col-md-4">

					<div class="col-md-12 grid-margin">
						<div class="card rounded">
							<div class="card-body">
								<h6 class="card-title">Posted By</h6>
								<div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
									<div class="d-flex align-items-center hover-pointer">
										<img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">													
										<div class="ml-2">
											<p>Mike Popescu</p>
											<p class="tx-11 text-muted">12 Mutual Friends</p>
										</div>
									</div>
									<button class="btn btn-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus" data-toggle="tooltip" title="" data-original-title="Connect"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg></button>
								</div>
								<br />

								<h6 class="card-title">Price</h6>
								<p>USD 600,000</p>
								<hr />
								
								<h6 class="card-title">Location</h6>
								<p><i data-feather="map-pin" class="blue-text"></i> Wilmington</p>
								

							<p class="text-center applybtn">	
								<button type="button" class="btn btn-primary">Call Now</button>
							</p>

							</div>
						</div>
					</div> <!-- gird-margin -->


					<div class="col-md-12 grid-margin">
						<div class="card rounded">
							<div class="card-body">
								<h6 class="card-title">suggestions for you</h6>
								<div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
									<div class="d-flex align-items-center hover-pointer">
										<img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">													
										<div class="ml-2">
											<p>Mike Popescu</p>
											<p class="tx-11 text-muted">12 Mutual Friends</p>
										</div>
									</div>
									<button class="btn btn-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus" data-toggle="tooltip" title="" data-original-title="Connect"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg></button>
								</div>
								<div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
									<div class="d-flex align-items-center hover-pointer">
										<img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">													
										<div class="ml-2">
											<p>Mike Popescu</p>
											<p class="tx-11 text-muted">12 Mutual Friends</p>
										</div>
									</div>
									<button class="btn btn-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus" data-toggle="tooltip" title="" data-original-title="Connect"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg></button>
								</div>
								<div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
									<div class="d-flex align-items-center hover-pointer">
										<img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">													
										<div class="ml-2">
											<p>Mike Popescu</p>
											<p class="tx-11 text-muted">12 Mutual Friends</p>
										</div>
									</div>
									<button class="btn btn-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus" data-toggle="tooltip" title="" data-original-title="Connect"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg></button>
								</div>
								<div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
									<div class="d-flex align-items-center hover-pointer">
										<img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">													
										<div class="ml-2">
											<p>Mike Popescu</p>
											<p class="tx-11 text-muted">12 Mutual Friends</p>
										</div>
									</div>
									<button class="btn btn-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus" data-toggle="tooltip" title="" data-original-title="Connect"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg></button>
								</div>
								<div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
									<div class="d-flex align-items-center hover-pointer">
										<img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">													
										<div class="ml-2">
											<p>Mike Popescu</p>
											<p class="tx-11 text-muted">12 Mutual Friends</p>
										</div>
									</div>
									<button class="btn btn-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus" data-toggle="tooltip" title="" data-original-title="Connect"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg></button>
								</div>
								<div class="d-flex justify-content-between">
									<div class="d-flex align-items-center hover-pointer">
										<img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">													
										<div class="ml-2">
											<p>Mike Popescu</p>
											<p class="tx-11 text-muted">12 Mutual Friends</p>
										</div>
									</div>
									<button class="btn btn-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus" data-toggle="tooltip" title="" data-original-title="Connect"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg></button>
								</div>

							</div>
						</div>
					</div>

				</div> <!-- col -->

		</div> <!-- row -->




           
			
			
			</div>

			<!-- partial:../../partials/_footer.html -->
			<footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between">
				<p class="text-muted text-center text-md-left">Copyright © 2020 <a href="#" target="_blank"> Compass Design Co.</a>, All rights reserved</p>
				<p class="text-muted text-center text-md-left mb-0 d-none d-md-block">Handcrafted With <i class="mb-1 text-primary ml-1 icon-small" data-feather="heart"></i></p>
			</footer>
			<!-- partial -->
		</div>
	</div>

	<!-- core:js -->
     <?php include('footer.php'); ?>
	<!-- end custom js for this page -->

</body>
</html>