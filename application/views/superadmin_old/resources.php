<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>QMELOCAL Spotlights from your network</title>

	<?php include('bootstrap.php'); ?>
	<!-- core:css -->
	
</head>
<body>
	<div class="main-wrapper">

		<!-- partial:partials/_navbar.html -->
		<div class="horizontal-menu">
			<nav class="navbar top-navbar">
				<div class="container">
					<div class="navbar-content">
						<a href="#" class="navbar-brand">
							STEELTON
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

			<div class="page-content support_services">

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
			<div>
				<h4 class="mb-3 mb-md-0">Explore our Support Services</h4>
			</div>
			</div>


				<div class="row">
					<div class="col-md-4 grid-margin">

						<div class="card">
							
							<div class="card-body">
								<p class="text-center">

         
                               <img src="<?php echo base_url('assets/images/support_services1.png') ?>">

								</p>
								<hr />
								<div class="d-flex align-items-center justify-content-between">
									<div class="d-flex align-items-center">
									 														
									  <div class="mt-2">
										<h6>Things the Biz want to learn</h6>
										<p class="tx-14 text-muted">Search from our content</p>
									  </div>
									</div>
									<div class="dropdown">
									  <button class="btn btn-primary" type="button">
										Explore
									  </button>
									  
									</div>
								  </div>
							</div>
						</div>

					</div> <!-- col -->

					<div class="col-md-4 grid-margin">

						<div class="card">
							
							<div class="card-body">
								<p class="text-center">	
									
                               <img src="<?php echo base_url('assets/images/support_services2.png') ?>">
								</p>
								<hr />
								<div class="d-flex align-items-center justify-content-between">
									<div class="d-flex align-items-center">
									 														
									  <div class="mt-2">
										<h6>Request IT Services</h6>
										<p class="tx-14 text-muted">Web & Mobile App Design & Dev.</p>
									  </div>
									</div>
									<div class="dropdown">
									  <button class="btn btn-primary" type="button">
										Explore
									  </button>
									  
									</div>
								  </div>
							</div>
						</div>

					</div> <!-- col -->

					<div class="col-md-4 grid-margin">

						<div class="card">
							
							<div class="card-body">
								<p class="text-center">	
									
                               <img src="<?php echo base_url('assets/images/support_services3.png') ?>">

								</p>
								<hr />
								<div class="d-flex align-items-center justify-content-between">
									<div class="d-flex align-items-center">
									 														
									  <div class="mt-2">
										<h6>Request Business Consulting</h6>
										<p class="tx-14 text-muted">Consultation Services</p>
									  </div>
									</div>
									<div class="dropdown">
									  <button class="btn btn-primary" type="button">
										Explore
									  </button>
									  
									</div>
								  </div>
							</div>
						</div>
					</div> <!-- col -->

				</div> <!-- row -->


				<div class="row">
					<div class="col-md-4 grid-margin">

						<div class="card">
							
							<div class="card-body">
								<p class="text-center">	
						
                                    <img src="<?php echo base_url('assets/images/support_services4.png') ?>">

								</p>
								<hr />
								<div class="d-flex align-items-center justify-content-between">
									<div class="d-flex align-items-center">
									 														
									  <div class="mt-2">
										<h6>Request Marketing Services</h6>
										<p class="tx-14 text-muted">Market your business</p>
									  </div>
									</div>
									<div class="dropdown">
									  <button class="btn btn-primary" type="button">
										Explore
									  </button>
									  
									</div>
								  </div>
							</div>
						</div>

					</div> <!-- col -->

					<div class="col-md-4 grid-margin">

						<div class="card">
							
							<div class="card-body">
								<p class="text-center">	
									
									 <img src="<?php echo base_url('assets/images/support_services5.png') ?>">
								</p>
								<hr />
								<div class="d-flex align-items-center justify-content-between">
									<div class="d-flex align-items-center">
									 														
									  <div class="mt-2">
										<h6>Request Funding</h6>
										<p class="tx-14 text-muted">Capital Services</p>
									  </div>
									</div>
									<div class="dropdown">
									  <button class="btn btn-primary" type="button">
										Explore
									  </button>
									  
									</div>
								  </div>
							</div>
						</div>

					</div> <!-- col -->

					<div class="col-md-4 grid-margin">

						<div class="card">
							
							<div class="card-body">
								<p class="text-center">	
									
									 <img src="<?php echo base_url('assets/images/support_services6.png') ?>">
								</p>
								<hr />
								<div class="d-flex align-items-center justify-content-between">
									<div class="d-flex align-items-center">
									 														
									  <div class="mt-2">
										<h6>Develop a Funding Package</h6>
										<p class="tx-14 text-muted">QmeFPE</p>
									  </div>
									</div>
									<div class="dropdown">
									  <button class="btn btn-primary" type="button">
										Explore
									  </button>
									  
									</div>
								  </div>
							</div>
						</div>

					</div> <!-- col -->

				</div> <!-- row -->	


				<div class="row">
					<div class="col-md-4 grid-margin">

						<div class="card">
							
							<div class="card-body">
								<p class="text-center">	
									
									 <img src="<?php echo base_url('assets/images/support_services7.png') ?>">
								</p>
								<hr />
								<div class="d-flex align-items-center justify-content-between">
									<div class="d-flex align-items-center">
									 														
									  <div class="mt-2">
										<h6>Develop a Business Plan</h6>
										<p class="tx-14 text-muted">Qme Consulting Hub</p>
									  </div>
									</div>
									<div class="dropdown">
									  <button class="btn btn-primary" type="button">
										Explore
									  </button>
									  
									</div>
								  </div>
							</div>
						</div>

					</div> <!-- col -->

					<div class="col-md-4 grid-margin">

						<div class="card">
							
							<div class="card-body">
								<p class="text-center">	
									
									 <img src="<?php echo base_url('assets/images/support_services8.png') ?>">
								</p>
								<hr />
								<div class="d-flex align-items-center justify-content-between">
									<div class="d-flex align-items-center">
									 														
									  <div class="mt-2">
										<h6>Develop Sales</h6>
										<p class="tx-14 text-muted">Qme Business Solutions Ecosystem</p>
									  </div>
									</div>
									<div class="dropdown">
									  <button class="btn btn-primary" type="button">
										Explore
									  </button>
									  
									</div>
								  </div>
							</div>
						</div>

					</div> <!-- col -->

					<div class="col-md-4 grid-margin">

						<div class="card">
							
							<div class="card-body">
								<p class="text-center">	
									
									 <img src="<?php echo base_url('assets/images/support_services6.png') ?>">
								</p>
								<hr />
								<div class="d-flex align-items-center justify-content-between">
									<div class="d-flex align-items-center">
									 														
									  <div class="mt-2">
										<h6>Social Media & Branding</h6>
										<p class="tx-14 text-muted">Marketing Media</p>
									  </div>
									</div>
									<div class="dropdown">
									  <button class="btn btn-primary" type="button">
										Explore
									  </button>
									  
									</div>
								  </div>
							</div>
						</div>

					</div> <!-- col -->

				</div> <!-- row -->	


				<div class="row">
					<div class="col-md-4 grid-margin">

						<div class="card">
							
							<div class="card-body">
								<p class="text-center">	
									
									 <img src="<?php echo base_url('assets/images/support_services10.png') ?>">
								</p>
								<hr />
								<div class="d-flex align-items-center justify-content-between">
									<div class="d-flex align-items-center">
									 														
									  <div class="mt-2">
										<h6>Work Development & Jobs</h6>
										<p class="tx-14 text-muted">QMEWDJ</p>
									  </div>
									</div>
									<div class="dropdown">
									  <button class="btn btn-primary" type="button">
										Explore
									  </button>
									  
									</div>
								  </div>
							</div>
						</div>

					</div> <!-- col -->

					<div class="col-md-4 grid-margin">

						<div class="card stay-tuned">
							
							<div class="card-body">
									<h4 class="text-center">
										Stay Tuned
									</h4>

									<p class="text-center">
										We're continuously striving to bring you state of art support resource to help Fulfill your business needs. We will keep adding more Services in order to ensure that.
									</p>

							</div>
						</div>

					</div> <!-- col -->

					

				</div> <!-- row -->	
			 
     




   </div>

			<!-- partial:partials/_footer.html -->
			<footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between">
				<p class="text-muted text-center text-md-left">Copyright © 2020 <a href="#" target="_blank">Compass Design Co.</a> All rights reserved</p>
				<p class="text-muted text-center text-md-left mb-0 d-none d-md-block">Handcrafted With <i class="mb-1 text-primary ml-1 icon-small" data-feather="heart"></i></p>
			</footer>
			<!-- partial -->
		
		</div>
	</div>

	
  <!-- plugin js for this page -->


</body>
</html>    