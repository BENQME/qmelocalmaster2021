


<div class="horizontal-menu">
    <nav class="navbar top-navbar">
        <div class="container">
            <div class="navbar-content">
                <a href="<?php echo base_url().'superadmin/dashboard' ?>" class="navbar-brand">
                    		QME<span>LOCAL</span>
                </a>
                  <?php $user_info2 = current_user(); //print_r($user_info->photo)  ?>
                  <?php if(!empty($this->input->get('search'))) $s_query = '?search='.$this->input->get('search');else $s_query =""; ?>
                <form class="search-form" method="get" action="<?php echo base_url().'dashboard/main_search' ?>">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i data-feather="search"></i>
                            </div>
                        </div>
                        <input type="text" name="search" value="<?php if(isset($_GET['search']))  echo $_GET['search'] ?>" class="form-control" id="navbarForm" placeholder="Search Keywords that match a business category...">
                    </div>
                </form>
                <?php if(!empty($this->session->userdata('user_id'))){ ?>
                 <?php $this->session->set_userdata('path', $this->uri->uri_string()); ?>
                <ul class="navbar-nav">
                   
                    <li class="nav-item dropdown nav-notifications" id="ajax_notify">
                    
                     <?php $user_notification = user_notification(); //print_r($user_notification ) ?>
                        <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="bell"></i>
                            
                            
                            <div id="l_notifiy">
                            <?php if(isset($user_notification) && count($user_notification)> 0): ?>
                                <div class="indicator">
                                    <div class="circle"></div>
                                </div>
                               <?php endif;?>
                            </div>
                         
                        </a>
                            <div id="user_notify_drop" class="dropdown-menu" aria-labelledby="notificationDropdown">
                             <?php if(isset($user_notification) && count($user_notification)> 0): ?>
                                <div class="dropdown-header d-flex align-items-center justify-content-between">
                                    <p class="mb-0 font-weight-medium"><?php echo user_notification(1) ?> New Notifications</p>
                                   
                                    <a href="<?php echo base_url('user/clear_notification') ?>" id="clear_notification" class="text-muted">Clear all</a>
                                </div>
                                <div class="dropdown-body">
                                     <?php foreach($user_notification as $data): ?>
                                        <a href="<?php echo $data->targetURL ?>" class="dropdown-item">
                                            <?php // if($data->type =='comment'): ?>
                                                <div class="icon">
                                                    <i data-feather="bell"></i>
                                                </div>
                                            <?php  //endif;?>
                                            <div class="content">
                                                <p><?php echo $data->description ?></p>
                                                <p class="sub-text text-muted"><?php echo timeAgo($data->timestamp) ?></p>
                                            </div>
                                        </a>
                                    <?php endforeach ?>
                                </div>
                                <div class="dropdown-footer d-flex align-items-center justify-content-center">
                                    <a href="javascript:;">View all</a>
                                </div>
                               <?php endif;?>
                            </div>
                        
                    </li>
                  
                    <li class="nav-item dropdown nav-profile">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="<?php echo base_url().'uploads/profile_img/'.$user_info2->photo; ?>" alt="profile">
                        </a>
                        <div class="dropdown-menu" aria-labelledby="profileDropdown">
                            <div class="dropdown-header d-flex flex-column align-items-center">
                                <div class="figure mb-3">
                                    <img src="<?php echo base_url().'uploads/profile_img/'.$user_info2->photo; ?>" alt="">
                                </div>
                                <?php $user_profile = $this->db->get_where('user_profile',array('user_id'=>$user_info2->userID))->row(); ?>
                                <div class="info text-center">
                                    <p class="name font-weight-bold mb-0"><?php echo $user_info2->first_name.' '.$user_info2->last_name; ?></p>
                                    <p class="email text-muted mb-3"><?php
									 if(isset($user_profile->designation) && $user_profile->designation) echo $user_profile->designation; else echo $user_info2->email; 
									 ?></p>
                                </div>
                            </div>
                            <div class="dropdown-body">
                                <ul class="profile-nav p-0 pt-3">
                                    <?php /*?><li class="nav-item">
                                        <a href="<?php echo base_url().'publicprofile/'.$user_info2->userID; ?>" class="nav-link">
                                            <i data-feather="user"></i>
                                            <span>Profile</span>
                                        </a>
                                    </li><?php */?>
                                    <?php /*?><li class="nav-item">
                                        <a href="<?php echo base_url('login/onboard') ?>" class="nav-link">
                                            <i data-feather="edit"></i>
                                            
                                            <span><?php if(!$user_profile->designation) echo 'Onboard Your Business';else echo 'Edit Business Detail'  ?></span>
                                        </a>
                                    </li><?php */?>
                                      <li class="nav-item">
                                        <a href="<?php echo base_url('dashboard/edit_profile') ?>" class="nav-link">
                                            <i data-feather="edit"></i>
                                            <span>Edit Short Profile</span>
                                        </a>
                                    </li>
                                    
                                    
                                    <li class="nav-item">
                                        <a href="<?php echo base_url().'superadmin/logout'; ?>" class="nav-link">
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
                <?php }else{ ?>
                <ul class="navbar-nav"><li class="nav-item dropdown nav-profile"><a class="btn btn-primary" href="<?php echo base_url().'enduser/login' ?>">Login</a></li></ul>
                <?php } ?>
            </div>
        </div>
    </nav>
    <?php if(!empty($this->session->userdata('user_id'))){ ?>
    <nav class="bottom-navbar">
        <div class="container">
            <?php $segment = $this->uri->segment(3) ?>
            <?php $segment2 = $this->uri->segment(2) ?>
            		<ul class="nav page-navigation">
						<li class="nav-item<?php if(isset($segment) && $segment == 'dashboard') echo ' active2' ?>">
                            <a class="nav-link" href="<?php echo base_url() ?>superadmin/dashboard">
                            
                                <i class="link-icon" data-feather="box"></i>
                                <span class="menu-title">dashboard</span>
                            </a>
                        </li>
                         <li class="nav-item mega-menu <?php if($segment == 'news') echo ' active2' ?>">
                                <a href="<?php echo base_url() ?>superadmin/activities/news" class="nav-link">
                                    <i class="link-icon" data-feather="home"></i>
                                    <span class="menu-title"> Media &amp; Blog</span>
                                    
                                </a>
                            </li>   
						<li class="nav-item mega-menu <?php if($segment == 'events') echo ' active2' ?>">
							<a href="<?php echo base_url() ?>superadmin/activities/events" class="nav-link">
								<i class="link-icon" data-feather="inbox"></i>
								<span class="menu-title">Events</span>
							</a>
							
						</li>
                        <li class="nav-item mega-menu <?php if($segment == 'spotit') echo ' active2' ?>">
							<a href="<?php echo base_url() ?>superadmin/activities/spotit" class="nav-link">
								<i class="link-icon" data-feather="inbox"></i>
								<span class="menu-title">General Spotlights </span>
							</a>
							
						</li>
                         <li class="nav-item mega-menu <?php if($segment == 'jobs') echo ' active2' ?>">
							<a href="<?php echo base_url() ?>superadmin/activities/jobs" class="nav-link">
								<i class="link-icon" data-feather="inbox"></i>
								<span class="menu-title">Jobs</span>
							</a>
							
						</li>
						
						
						<li class="nav-item<?php if($segment2 == 'myspotlight' || $segment2 == 'create_new_spotlight') echo ' active2' ?>">
							<a href="#" class="nav-link">
								<i class="link-icon" data-feather="smile"></i>
								<span class="menu-title">Global Content</span>
								<i class="link-arrow"></i>
							</a>
							<div class="submenu">
								<ul class="submenu-item">
                                	<li class="nav-item"><a class="nav-link" href="<?php echo base_url('dashboard/myspotlight') ?>">My Spotlights</a></li>
									<li class="nav-item"><a class="nav-link" href="<?php echo base_url('dashboard/create_new_spotlight') ?>">Create a Global Spotlight</a></li>
									<li class="nav-item"><a class="nav-link" href="<?php echo base_url('dashboard/create_new_spotlight?region=1') ?>">Create a Region based Spotlight</a></li>
								</ul>
							</div>
						</li>
						<li class="nav-item <?php if($segment2 == 'add_portal' 
						
						
						|| $segment2 == 'portal_list'
						|| $segment2 == 'add_staff'
						|| $segment2 == 'staff_users'
						
						
						) echo ' active2' ?>">
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
											<li class="nav-item"><a class="nav-link" href="<?php echo base_url('superadmin/add_portal') ?>">Create new portal</a></li>
											<li class="nav-item"><a class="nav-link" href="<?php echo base_url('superadmin/portal_list') ?>">Portals</a></li>
										</ul>
									</div>
									<div class="col-md-6">
										<ul class="submenu-item pl-0">
											<li class="category-heading">Staff Users</li>
											<li class="nav-item"><a class="nav-link" href="<?php echo base_url('superadmin/add_staff') ?>">Create a new User</a></li>
											<li class="nav-item"><a class="nav-link" href="<?php echo base_url('superadmin/staff_users') ?>">Manage Existing User</a></li>
										</ul>
									</div>
								</div>
							</div>
						</li>
						<li class="nav-item" <?php if($segment2 == 'resources') echo ' active2' ?>>
							<a href="#"  class="nav-link">
								<i class="link-icon" data-feather="hash"></i>
								<span class="menu-title">Resources</span></a>
                                
                                
                                
                                <div class="submenu">
								<ul class="submenu-item">
                                	<li class="nav-item"><a class="nav-link" href="<?php echo base_url('settings') ?>">Additional Settings</a></li>
									<li class="nav-item"><a class="nav-link" href="<?php echo base_url('superadmin/resources') ?>">Biz Resources </a></li
								></ul>
							</div>
						</li>
					</ul>
            <?php /*?><ul class="nav page-navigation">
                <li class="nav-item<?php if(isset($segment) && $segment == 'dashboard') echo ' active2' ?>">
                    <a class="nav-link" href="<?php echo base_url() ?>admin/dashboard">
                    
                        <i class="link-icon" data-feather="box"></i>
                        <span class="menu-title">dashboard</span>
                    </a>
                </li>
                 <li class="nav-item <?php if($segment == 'top_activities') echo ' active2' ?>">
                    <a href="<?php echo base_url() ?>admin/top_activities/all" class="nav-link">
                        <i class="link-icon" data-feather="activity"></i>
                        <span class="menu-title">Top Activities</span>
                        
                    </a>
                </li>     
                <li class="nav-item <?php if($segment == 'activities') echo ' active2' ?>">
                    <a href="<?php echo base_url() ?>admin/activities/all" class="nav-link">
                        <i class="link-icon" data-feather="home"></i>
                        <span class="menu-title"><?php echo site_info() ?> Activities</span>
                        
                    </a>
                </li>              

    <li class="nav-item <?php if($segment == 'public_spotlight' || $segment == 'myspotlight' ||  $segment == 'create_new_spotlight') echo ' active2' ?>">
                    <a href="<?php echo base_url(); ?>admin/public_spotlight" class="nav-link">
                        <i class="link-icon" data-feather="smile"></i>
                        <span class="menu-title">Spotlights</span>
                        <i class="link-arrow"></i>
                    </a>
                    <div class="submenu">
                        <ul class="submenu-item">
                            
                            
                            <li class="nav-item"><a class="nav-link" href="<?php echo base_url() ?>admin/myspotlight">My Spotlights</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo base_url() ?>dashboard/create_new_spotlight">Create new Spotlight</a></li>
                        </ul>
                    </div>
                </li>

    

                
                <li class="nav-item <?php if($segment == 'edit_profile' || $segment == 'user_list' ||  $segment == 'staff_users') echo ' active2' ?> ">
                    <a href="#" class="nav-link">
                        <i class="link-icon" data-feather="settings"></i>
                        <span class="menu-title">Manage</span>
                        <i class="link-arrow"></i>
                    </a>
                    <div class="submenu">
                        <ul class="submenu-item">
                            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('dashboard/edit_profile') ?>">Profile </a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/user_list') ?>">Users </a></li>
                            <?php $user_type = $this->session->userdata('user_type'); ?>
                            <?php if(isset($user_type) && $user_type==1){}else{ ?>
                            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/staff_users') ?>">Staff Users </a></li>
                            <?php } ?>
                            <li class="nav-item"><a class="nav-link" href="#">Membership</a></li>
                        </ul>
                    </div>
                </li>
                
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="link-icon" data-feather="hash"></i>
                        <span class="menu-title">Resources</span></a>
                </li>
            </ul><?php */?>
        </div>
    </nav>
    <?php } ?>
</div>
<!-- partial -->