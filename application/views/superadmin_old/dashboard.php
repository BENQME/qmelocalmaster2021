<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>QMELOCAL (Administration)</title>
	<!-- core:css -->
	 <?php include('bootstrap.php'); ?>
	 <!-- end custom js for this page -->
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
												<a href="pages/general/profile.html" class="nav-link">
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
            <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
          </div>
          <div class="d-flex align-items-center flex-wrap text-nowrap">
            <div class="input-group date datepicker dashboard-date mr-2 mb-2 mb-md-0 d-md-none d-xl-flex" id="dashboardDate">
              <span class="input-group-addon bg-transparent"><i data-feather="calendar" class=" text-primary"></i></span>
              <input type="text" class="form-control">
            </div>
            <button type="button" class="btn btn-outline-info btn-icon-text mr-2 d-none d-md-block">
              <i class="btn-icon-prepend" data-feather="download"></i>
              Import
            </button>
            <button type="button" class="btn btn-outline-primary btn-icon-text mr-2 mb-2 mb-md-0">
              <i class="btn-icon-prepend" data-feather="printer"></i>
              Print
            </button>
            <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
              <i class="btn-icon-prepend" data-feather="download-cloud"></i>
              Download Report
            </button>
          </div>
        </div>

        <div class="row">
          <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow">
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">New Sign Ups</h6>
                      <div class="dropdown mb-2">
                        <button class="btn p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="edit-2" class="icon-sm mr-2"></i> <span class="">Edit</span></a>
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="trash" class="icon-sm mr-2"></i> <span class="">Delete</span></a>
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="printer" class="icon-sm mr-2"></i> <span class="">Print</span></a>
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="download" class="icon-sm mr-2"></i> <span class="">Download</span></a>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">3,897</h3>
                        <div class="d-flex align-items-baseline">
                          <p class="text-success">
                            <span>+3.3%</span>
                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                          </p>
                        </div>
                      </div>
                      <div class="col-6 col-md-12 col-xl-7">
                        <div id="apexChart1" class="mt-md-3 mt-xl-0"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">New Subscriptions</h6>
                      <div class="dropdown mb-2">
                        <button class="btn p-0" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton1">
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="edit-2" class="icon-sm mr-2"></i> <span class="">Edit</span></a>
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="trash" class="icon-sm mr-2"></i> <span class="">Delete</span></a>
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="printer" class="icon-sm mr-2"></i> <span class="">Print</span></a>
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="download" class="icon-sm mr-2"></i> <span class="">Download</span></a>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">35,084</h3>
                        <div class="d-flex align-items-baseline">
                          <p class="text-danger">
                            <span>-2.8%</span>
                            <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                          </p>
                        </div>
                      </div>
                      <div class="col-6 col-md-12 col-xl-7">
                        <div id="apexChart2" class="mt-md-3 mt-xl-0"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Content Engagement</h6>
                      <div class="dropdown mb-2">
                        <button class="btn p-0" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton2">
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="edit-2" class="icon-sm mr-2"></i> <span class="">Edit</span></a>
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="trash" class="icon-sm mr-2"></i> <span class="">Delete</span></a>
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="printer" class="icon-sm mr-2"></i> <span class="">Print</span></a>
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="download" class="icon-sm mr-2"></i> <span class="">Download</span></a>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-6 col-md-12 col-xl-5">
                        <h3 class="mb-2">89.87%</h3>
                        <div class="d-flex align-items-baseline">
                          <p class="text-success">
                            <span>+2.8%</span>
                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                          </p>
                        </div>
                      </div>
                      <div class="col-6 col-md-12 col-xl-7">
                        <div id="apexChart3" class="mt-md-3 mt-xl-0"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- row -->

     

        <div class="row">
          <div class="col-lg-7 col-xl-8 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                  <h6 class="card-title mb-0">Monthly Subscriptions</h6>
                  <div class="dropdown mb-2">
                    <button class="btn p-0" type="button" id="dropdownMenuButton4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton4">
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="edit-2" class="icon-sm mr-2"></i> <span class="">Edit</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="trash" class="icon-sm mr-2"></i> <span class="">Delete</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="printer" class="icon-sm mr-2"></i> <span class="">Print</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="download" class="icon-sm mr-2"></i> <span class="">Download</span></a>
                    </div>
                  </div>
                </div>
                <p class="text-muted mb-4">Sales are activities related to selling or the number of goods or services sold in a given time period.</p>
                <div class="monthly-sales-chart-wrapper">
                  <canvas id="monthly-sales-chart"></canvas>
                </div>
              </div> 
            </div>
          </div>
          <div class="col-lg-5 col-xl-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                  <h6 class="card-title mb-0">Cloud storage</h6>
                  <div class="dropdown mb-2">
                    <button class="btn p-0" type="button" id="dropdownMenuButton5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton5">
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="edit-2" class="icon-sm mr-2"></i> <span class="">Edit</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="trash" class="icon-sm mr-2"></i> <span class="">Delete</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="printer" class="icon-sm mr-2"></i> <span class="">Print</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="download" class="icon-sm mr-2"></i> <span class="">Download</span></a>
                    </div>
                  </div>
                </div>
                <div id="progressbar1" class="mx-auto"></div>
                <div class="row mt-4 mb-3">
                  <div class="col-6 d-flex justify-content-end">
                    <div>
                      <label class="d-flex align-items-center justify-content-end tx-10 text-uppercase font-weight-medium">Total storage <span class="p-1 ml-1 rounded-circle bg-primary-muted"></span></label>
                      <h5 class="font-weight-bold mb-0 text-right">8TB</h5>
                    </div>
                  </div>
                  <div class="col-6">
                    <div>
                      <label class="d-flex align-items-center tx-10 text-uppercase font-weight-medium"><span class="p-1 mr-1 rounded-circle bg-primary"></span> Used storage</label>
                      <h5 class="font-weight-bold mb-0">6TB</h5>
                    </div>
                  </div>
                </div>
                <button class="btn btn-primary btn-block">Upgrade storage</button>
              </div>
            </div>
          </div>
        </div> <!-- row -->

        <div class="row">
          
          <div class="col-lg-12 stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                  <h6 class="card-title mb-0">Recent Local Business Registerations</h6>
                  <div class="dropdown mb-2">
                    <button class="btn p-0" type="button" id="dropdownMenuButton7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton7">
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="edit-2" class="icon-sm mr-2"></i> <span class="">Edit</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="trash" class="icon-sm mr-2"></i> <span class="">Delete</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="printer" class="icon-sm mr-2"></i> <span class="">Print</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="download" class="icon-sm mr-2"></i> <span class="">Download</span></a>
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-hover mb-0">
                    <thead>
                      <tr>
                        <th class="pt-0">#</th>
                        <th class="pt-0">Username</th>
                        <th class="pt-0">Business Name</th>
                        <th class="pt-0">Business Category</th>
                        <th class="pt-0">Status</th>
                        <th class="pt-0">Region</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>NobleUI jQuery</td>
                        <td>01/01/2019</td>
                        <td>26/04/2019</td>
                        <td><span class="badge badge-danger">Released</span></td>
                        <td>Leonardo Payne</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>NobleUI Angular</td>
                        <td>01/01/2019</td>
                        <td>26/04/2019</td>
                        <td><span class="badge badge-success">Review</span></td>
                        <td>Carl Henson</td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>NobleUI ReactJs</td>
                        <td>01/05/2019</td>
                        <td>10/09/2019</td>
                        <td><span class="badge badge-info-muted">Pending</span></td>
                        <td>Jensen Combs</td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>NobleUI VueJs</td>
                        <td>01/01/2019</td>
                        <td>31/11/2019</td>
                        <td><span class="badge badge-warning">Work in Progress</span>
                        </td>
                        <td>Amiah Burton</td>
                      </tr>
                      <tr>
                        <td>5</td>
                        <td>NobleUI Laravel</td>
                        <td>01/01/2019</td>
                        <td>31/12/2019</td>
                        <td><span class="badge badge-danger-muted text-white">Coming soon</span></td>
                        <td>Yaretzi Mayo</td>
                      </tr>
                      <tr>
                        <td>6</td>
                        <td>NobleUI NodeJs</td>
                        <td>01/01/2019</td>
                        <td>31/12/2019</td>
                        <td><span class="badge badge-primary">Coming soon</span></td>
                        <td>Carl Henson</td>
                      </tr>
                      <tr>
                        <td class="border-bottom">3</td>
                        <td class="border-bottom">NobleUI EmberJs</td>
                        <td class="border-bottom">01/05/2019</td>
                        <td class="border-bottom">10/11/2019</td>
                        <td class="border-bottom"><span class="badge badge-info-muted">Pending</span></td>
                        <td class="border-bottom">Jensen Combs</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div> 
            </div>
          </div>
        </div> <!-- row -->


        <div class="row">
          <div class="col-12 col-xl-12 grid-margin stretch-card">
            <div class="card overflow-hidden">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
                  <h6 class="card-title mb-0">Qmelocal yearly engagement</h6>
                  <div class="dropdown">
                    <button class="btn p-0" type="button" id="dropdownMenuButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton3">
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="edit-2" class="icon-sm mr-2"></i> <span class="">Edit</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="trash" class="icon-sm mr-2"></i> <span class="">Delete</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="printer" class="icon-sm mr-2"></i> <span class="">Print</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="download" class="icon-sm mr-2"></i> <span class="">Download</span></a>
                    </div>
                  </div>
                </div>
                <div class="row align-items-start mb-2">
                  <div class="col-md-7">
                    <p class="text-muted tx-13 mb-3 mb-md-0">Revenue is the income that a business has from its normal business activities, usually from the sale of goods and services to customers.</p>
                  </div>
                  <div class="col-md-5 d-flex justify-content-md-end">
                    <div class="btn-group mb-3 mb-md-0" role="group" aria-label="Basic example">
                      <button type="button" class="btn btn-outline-primary">Today</button>
                      <button type="button" class="btn btn-outline-primary d-none d-md-block">Week</button>
                      <button type="button" class="btn btn-primary">Month</button>
                      <button type="button" class="btn btn-outline-primary">Year</button>
                    </div>
                  </div>
                </div>
                <div class="flot-wrapper">
                  <div id="flotChart1" class="flot-chart"></div>
                </div>
              </div>
            </div>
          </div>
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

	<!-- core:js -->
  
	<!-- end custom js for this page -->
</body>
</html>    