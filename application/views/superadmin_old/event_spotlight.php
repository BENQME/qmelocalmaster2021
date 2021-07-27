<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>QMELOCAL :: Business Profile/Profile</title>
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
			<h4 class="mb-3 mb-md-0">Minds of Pakistan</h4>
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

                                          <img src="<?php echo base_url('assets/images/placeholder.jpg') ?>">
                                       </div>
                                       <div class="carousel-item">

                                          <img src="<?php echo base_url('assets/images/placeholder.jpg') ?>">
                                       </div>
                                       <div class="carousel-item">
                                        
                                        <img src="<?php echo base_url('assets/images/placeholder.jpg') ?>">

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
							<h6 class="card-title">About this Event</h6>
							<p>The aim of the Bibi Ji Foundation is to engage Pakistan's youth through seminars, debating sessions and voluntary work with different organisations. It is not a charity but an organisation that is being run by volunteers.</p>	
							<br />
							<h6 class="card-title">Our First Initiative:</h6>
							
								<P>With so much negativity circling around Pakistan, one may wonder that who are the people or where are the people, who are making a positive change?</P>
								<P>This conference brings the general public closer to the work that the youth is doing in Pakistan to make it a better place.</P>
								<P>Our special guest is Jibran Nasir who will be speaking at the conference. Moreover, some exciting new talent and existing talent who are doing amazing work in Pakistan are also joining us.</P>
								

								<br />
								<h6 class="card-title">SPEAKERS OR TEAMS:</h6>		

								<p>
									<strong>Arafat Mazhar</strong> is the founder of Engage Pakistan which is an interdisciplinary research oragnisation. He is writer as well and has written extensively in Dawn newspaper. He is the founder of ShehriPakistan that makes Urdu animation on civics. He is also the director of Shehr-e-Tabasum - A cyber punk short Urdu animated film set in a dystopian future.
								</p>	


								<p><strong>Maryam Malhi</strong> a student of Kinnard sets out to raise awareness about mental health for underprivilidged people. She is the founder of Mental Education and Care Association (MECA) and with a dedicated team, they organise different sessions like Baithak Sessions, Breathing Lounge and visit schools and colleges as well to raise awareness about Mental Health in Pakistan.</p>	
								
								<p><strong>Muzamil Hassan</strong> CEO of Gen D Analytics and is the content creator at Lolz Studios, a social media platform through which he and his dedicated team produce short skits about different issues of Pakistan. He is the host of Unboxing Pakistan, which is a Podcast designed to unravel some of Pakistan's most fundamental issues with people who run the state of affairs.</p>	
								
								<p><strong> Team of ProperGaanda:</strong> An up and coming Digital Media Company, ProperGaanda, is an independent recorder of Pakistan’s peculiarities, amplifying the voice of progressive Pakistanis from all over the world while still focusing on creating quality content. At its heart, PG is the voice of the people, by the people, for the people.</p>

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
								<h4>Similar Events</h4><br />
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
																			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-lg pb-3px"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
																		</button>
																		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
																			<a class="dropdown-item d-flex align-items-center" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-meh icon-sm mr-2"><circle cx="12" cy="12" r="10"></circle><line x1="8" y1="15" x2="16" y2="15"></line><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg> <span class="">Unfollow</span></a>
																			<a class="dropdown-item d-flex align-items-center" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-right-up icon-sm mr-2"><polyline points="10 9 15 4 20 9"></polyline><path d="M4 20h7a4 4 0 0 0 4-4V4"></path></svg> <span class="">Go to post</span></a>
																			<a class="dropdown-item d-flex align-items-center" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2 icon-sm mr-2"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line></svg> <span class="">Share</span></a>
																			<a class="dropdown-item d-flex align-items-center" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-copy icon-sm mr-2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg> <span class="">Copy link</span></a>
																		</div>
																	</div>
																</div>
															</div>
															<div class="card-body">
																<!-- <h6 class="date_time">DATA & TIME : 02-02-2020 10:00 AM</h6> -->
																<div class="date_timebox">
																<div class="pull-left">	
																<h6 class="date_time">DATE <br> <span>02-02-2020</span></h6>		
																</div>
																<div class="pull-right">
																	<h6 class="date_time">TIME <br> <span>10:00 AM</span></h6>
																</div>
																<div class="clearfix"></div>
															</div>
															<p class="mb-2"><strong><a href="" class="spotlight-title">Spotlight Title</a></strong></p>
																<p class="mb-3 tx-14">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus minima delectus nemo unde quae recusandae assumenda.</p>
																<img class="img-fluid" src="https://via.placeholder.com/513x342" alt="">
															</div>
															<div class="card-footer">
																<div class="d-flex post-actions">
																	<a href="javascript:;" class="d-flex align-items-center text-muted mr-4">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart icon-md"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
																		<p class="d-none d-md-block ml-2">Like</p>
																	</a>
																	<a href="javascript:;" class="d-flex align-items-center text-muted mr-4">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square icon-md"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
																		<p class="d-none d-md-block ml-2">Comment</p>
																	</a>
																	<a href="javascript:;" class="d-flex align-items-center text-muted">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share icon-md"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path><polyline points="16 6 12 2 8 6"></polyline><line x1="12" y1="2" x2="12" y2="15"></line></svg>
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
																			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-lg pb-3px"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
																		</button>
																		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
																			<a class="dropdown-item d-flex align-items-center" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-meh icon-sm mr-2"><circle cx="12" cy="12" r="10"></circle><line x1="8" y1="15" x2="16" y2="15"></line><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg> <span class="">Unfollow</span></a>
																			<a class="dropdown-item d-flex align-items-center" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-right-up icon-sm mr-2"><polyline points="10 9 15 4 20 9"></polyline><path d="M4 20h7a4 4 0 0 0 4-4V4"></path></svg> <span class="">Go to post</span></a>
																			<a class="dropdown-item d-flex align-items-center" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2 icon-sm mr-2"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line></svg> <span class="">Share</span></a>
																			<a class="dropdown-item d-flex align-items-center" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-copy icon-sm mr-2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg> <span class="">Copy link</span></a>
																		</div>
																	</div>
																</div>
															</div>
															<div class="card-body">
																<div class="date_timebox">
																<div class="pull-left">	
																<h6 class="date_time">DATE <br> <span>02-02-2020</span></h6>		
																</div>
																<div class="pull-right">
																	<h6 class="date_time">TIME <br> <span>10:00 AM</span></h6>
																</div>
																<div class="clearfix"></div>
															</div>
															<p class="mb-2"><strong><a href="" class="spotlight-title">Spotlight Title</a></strong></p>
																<p class="mb-3 tx-14">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus minima delectus nemo unde quae recusandae assumenda.</p>
																<img class="img-fluid" src="https://via.placeholder.com/513x342" alt="">
															</div>
															<div class="card-footer">
																<div class="d-flex post-actions">
																	<a href="javascript:;" class="d-flex align-items-center text-muted mr-4">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart icon-md"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
																		<p class="d-none d-md-block ml-2">Like</p>
																	</a>
																	<a href="javascript:;" class="d-flex align-items-center text-muted mr-4">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square icon-md"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
																		<p class="d-none d-md-block ml-2">Comment</p>
																	</a>
																	<a href="javascript:;" class="d-flex align-items-center text-muted">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share icon-md"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path><polyline points="16 6 12 2 8 6"></polyline><line x1="12" y1="2" x2="12" y2="15"></line></svg>
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

								<h6 class="card-title">DATE</h6>
								<p>02-02-2020</p>
								<hr />

								<h6 class="card-title">TIME</h6>
								<p>10:00 AM</p>
								<hr />
								
								<h6 class="card-title">Location</h6>
								<p><i data-feather="map-pin" class="blue-text"></i> Islamabad</p>
								

							<p class="text-center applybtn">	
								<button type="button" class="btn btn-primary">Apply</button>
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