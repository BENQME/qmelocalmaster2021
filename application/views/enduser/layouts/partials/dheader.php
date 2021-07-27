<!-- partial:partials/_navbar.html -->
<div class="horizontal-menu">
    <nav class="navbar top-navbar">
        <div class="container">
            <div class="navbar-content">
                <a href="<?php echo base_url('home') ?>" class="navbar-brand">
                
                <?php if(special_cms()){ ?>
						<?php  
						echo '<img class="img-logooo" src="'.base_url().'assets/logo22.jpg" style="max-width:155px" />';
                    }else{?>
                
                
                    <?php echo strtoupper(site_info()) ?>
                    <?php } ?>
                    
                </a>
                  <?php $user_info2 = current_user(); //print_r($user_info->photo)  ?>
                  <?php if(!empty($this->input->get('search'))) $s_query = '?search='.$this->input->get('search');else $s_query =""; ?>
                <form class="search-form" method="get" action="<?php echo base_url('dashboard/main_search/all') ?>">
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
                    
                    <li class="nav-item dropdown nav-messages" id="ajax_notify2">
                        <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="mail"></i>
                             <div id="l_notifiy2">
                            <?php if(isset($user_notification) && count($user_notification)> 0): ?>
                                <div class="indicator">
                                    <div class="circle"></div>
                                </div>
                               <?php endif;?>
                            </div>
                        </a>
                         <?php $user_msg = user_msg(); //print_r($user_notification ) ?>
                        <div id="user_notify_drop2" class="dropdown-menu" aria-labelledby="messageDropdown">
                          <?php if(isset($user_msg) && count($user_msg)> 0): ?>
                            <div class="dropdown-header d-flex align-items-center justify-content-between">
                                <p class="mb-0 font-weight-medium"><?php echo user_msg(1) ?> New Messages</p>
                           
                                <a href="<?php echo base_url('user/clear_notification_mgs') ?>" id="clear_notification_msg22" class="text-muted">Clear all</a>
                            </div>
                            <div class="dropdown-body">
                            <?php foreach($user_msg as $data): ?>
                            <?php $user_data = $this->db->get_where('users',array('userID'=>$data->by_user))->row(); ?>
                                <a href="<?php echo $data->target_url ?>" class="dropdown-item">
                                    <div class="figure">
                                        <img src="<?php if($user_data->photo) echo base_url('uploads/profile_img/'.$user_data->photo);else echo base_url('uploads/profile_img/def.jpg') ?>" alt="userr">
                                    </div>
                                    <div class="content">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p><?php echo $user_data->first_name.' '.$user_data->last_name ?></p>
                                            <p class="sub-text text-muted"><?php echo timeAgo($data->date_time) ?></p>
                                        </div>	
                                        <p class="sub-text text-muted">New message</p>
                                    </div>
                                </a>
                              <?php endforeach ?>
                                
                            </div>
                            <?php endif;?>
                            <div class="dropdown-footer d-flex align-items-center justify-content-center">
                                <a href="<?php echo base_url('dashboard/messages') ?>">View all</a>
                            </div>
                           
                            
                        </div>
                    </li>
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
                                <?php endif;?>
                                
                                <div class="dropdown-footer d-flex align-items-center justify-content-center">
                                    <a href="<?php echo base_url().'dashboard/notifications' ?>">View all</a>
                                </div>
                               
                            </div>
                        
                    </li>
                  
                    <li class="nav-item dropdown nav-profile">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="<?php if($user_info2->photo) echo base_url().'uploads/profile_img/'.$user_info2->photo; else echo  base_url().'uploads/profile_img/def.jpg'  ?>" alt="profile">
                        </a>
                        <div class="dropdown-menu" aria-labelledby="profileDropdown">
                            <div class="dropdown-header d-flex flex-column align-items-center">
                                <div class="figure mb-3">
                                    <img src="<?php if($user_info2->photo) echo base_url().'uploads/profile_img/'.$user_info2->photo; else echo  base_url().'uploads/profile_img/def.jpg'   ?>" alt="">
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
                                    <li class="nav-item">
                                        <a href="<?php echo base_url().'publicprofile/'.$user_info2->userID; ?>" class="nav-link">
                                            <i data-feather="user"></i>
                                            <span>View Public Profile</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url().'dashboard/preference' ?>" class="nav-link">
                                            <i data-feather="edit"></i>
                                            <span>Edit Your Preference</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('dashboard/edit_profile') ?>" class="nav-link">
                                            <i data-feather="edit"></i>
                                            <span>Edit Public Profile</span>
                                        </a>
                                    </li>
                                     <li class="nav-item">
                                        <a href="<?php echo base_url('dashboard/my_network') ?>" class="nav-link">
                                            <i data-feather="users"></i>
                                            <span>My Network/Invite </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('dashboard/messages') ?>" class="nav-link">
                                            <i data-feather="inbox"></i>
                                            <span>Send Inbox Message </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('dashboard/resources') ?>" class="nav-link">
                                            <i data-feather="book"></i>
                                            <span>Custom Resources </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('dashboard') ?>" class="nav-link">
                                            <i data-feather="pen-tool"></i>
                                            <span>Activity Stats </span>
                                        </a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('login/onboard') ?>" class="nav-link">
                                            <i data-feather="briefcase"></i>
                                            
                                            <span><?php if(!$user_profile->designation) echo 'Add/Edit Biz Details';else echo 'Add/Edit Biz Details'  ?></span>
                                        </a>
                                    </li>
                                      
                                    
                                    
                                    <li class="nav-item">
                                        <a href="<?php echo base_url().'dashboard/logout'; ?>" class="nav-link">
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
                <ul class="navbar-nav non_login_menu">
                
               
                <li class="nav-item dropdown nav-profile"><a href="<?php echo base_url('register')?>">Register</a></li>
                <li class="nav-item dropdown nav-profile"><a  href="<?php echo base_url('enduser/login')?>">Login</a></li>
                 <li class="nav-item dropdown nav-profile"><a class="btn btn-primary arrow_back" href="<?php echo base_url('register')?>"> <i data-feather="arrow-left"></i></a></li>
                
                
                
                </ul>
                <?php } ?>
            </div>
        </div>
    </nav>
    <?php if(!empty($this->session->userdata('user_id'))){ ?>
    <nav class="bottom-navbar">
        <div class="container">
            <?php $segment = $this->uri->segment(2) ?>
            <ul class="nav page-navigation">
               </li>
                <li class="nav-item<?php if(!isset($segment)) echo '' ?>">
                    <a class="nav-link" href="<?php echo base_url(); ?>home">
                        <i class="link-icon" data-feather="home"></i>
                        <span class="menu-title">Home</span>
                    </a>
                </li>
               <?php /*?> <li class="nav-item<?php if(!isset($segment)) echo ' active2' ?>">
                    <a class="nav-link" href="<?php echo base_url(); ?>dashboard">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="menu-title">Stats</span>
                    </a>
             </li><?php */?>
                <li class="nav-item <?php if($segment == 'activities') echo ' active2' ?>">
                    <a href="<?php echo base_url(); ?>dashboard/activities/all" class="nav-link">
                        <i class="link-icon" data-feather="eye"></i>
                        <span class="menu-title"><?php echo site_info()?> Activities</span>
                        
                    </a>
                </li>              
                <li class="nav-item <?php if($segment == 'myfeed') echo ' active2' ?>">
                    <a href="<?php echo base_url('dashboard/myfeed/all'); ?>" class="nav-link">
                        <i class="link-icon" data-feather="bell"></i>
                        <span class="menu-title">My Feed</span>
                        
                    </a>
                </li>
              <?php /*?>  <li class="nav-item <?php if($segment == 'messages') echo ' active2' ?>">
                    <a href="<?php echo base_url(); ?>dashboard/messages" class="nav-link">
                        <i class="link-icon" data-feather="inbox"></i>
                        <span class="menu-title">Messages</span>
                        
                    </a>
                    
    </li><?php */?>
    <li class="nav-item <?php if($segment == 'myspotlight') echo ' active2' ?>">
            <a href="<?php echo base_url(); ?>dashboard/myspotlight" class="nav-link">
                <i class="link-icon" data-feather="inbox"></i>
                <span class="menu-title">My Posts</span>
                
            </a>
                    
    </li>
    <li class="nav-item <?php if($segment == 'create_new_spotlight') echo ' active2' ?>">
            <a href="<?php echo base_url(); ?>dashboard/create_new_spotlight" class="nav-link">
                <i class="link-icon" data-feather="edit"></i>
                <span class="menu-title">Create New Post</span>
                
            </a>
                    
    </li>


    <?php /*?><li class="nav-item <?php if($segment == 'public_spotlight' || $segment == 'myspotlight' || $segment == 'create_new_spotlight') echo ' active2' ?>">
                    <a href="#" class="nav-link">
                        <i class="link-icon" data-feather="smile"></i>
                        <span class="menu-title">Spotlights</span>
                        <i class="link-arrow"></i>
                    </a>
                    <div class="submenu">
                        <ul class="submenu-item">
                           
                            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>dashboard/myspotlight">My Spotlights</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>dashboard/create_new_spotlight">Create new Spotlight</a></li>
                        </ul>
                    </div>
                </li><?php */?>

    
               <?php /*?> <li class="nav-item <?php if($segment == 'my_network') echo ' active2' ?>">
                    <a href="<?php echo base_url(); ?>dashboard/my_network" class="nav-link">
                        <i class="link-icon" data-feather="pie-chart"></i>
                        <span class="menu-title">My Network</span>
            
                    </a>
                    
                </li><?php */?>
                
                <li class="nav-item 
				
				<?php if(
				($this->uri->segment(1) == 'publicprofile') || 
				
				($this->uri->segment(2) == 'preference') || 
				($this->uri->segment(2) == 'edit_profile') || 
				($this->uri->segment(2) == 'my_network') || 
				($this->uri->segment(2) == 'messages') || 
				($this->uri->segment(2) == 'resources') || 
				($this->uri->segment(1) == 'dashboard') || 
				($this->uri->segment(2) == 'onboard') 
				
				) echo ' active2' ?>">
                    <a href="#" class="nav-link">
                        <i class="link-icon" data-feather="user"></i>
                        <span class="menu-title">My Account</span>
                        <i class="link-arrow"></i>
                    </a>
                    <div class="submenu">
                        <ul class="submenu-item">
                            <li class="nav-item"><a class="nav-link" href="<?php echo base_url().'publicprofile/'.$userinfo->userID; ?>">View Public Profile </a></li>
                             <li class="nav-item"><a class="nav-link" href="<?php echo base_url().'dashboard/preference' ?>">Edit Your Preference</a></li>
                              <li class="nav-item"><a class="nav-link" href="<?php echo base_url().'dashboard/edit_profile' ?>">Edit Profile</a></li>
                              <li class="nav-item"><a class="nav-link" href="<?php echo base_url().'dashboard/my_network' ?>">My Network/Invite</a></li>
                              <li class="nav-item"><a class="nav-link" href="<?php echo base_url().'dashboard/messages' ?>">Send Inbox Message</a></li>
                              <li class="nav-item"><a class="nav-link" href="<?php echo base_url().'dashboard/resources' ?>">Custom Resources</a></li>
                              <li class="nav-item"><a class="nav-link" href="<?php echo base_url().'dashboard' ?>">Activity Stats</a></li>
                              <li class="nav-item"><a class="nav-link" href="<?php echo base_url().'login/onboard' ?>">Add/Edit Biz Details</a></li>
                              <li class="nav-item"><a class="nav-link" href="<?php echo base_url().'dashboard/logout' ?>">Logout</a></li>
                            
                        </ul>
                    </div>
                </li>
                
                <?php /*?><li class="nav-item <?php if($segment == 'resources') echo ' active2' ?>">
                    <a href="<?php echo base_url().'dashboard/resources' ?>" class="nav-link">
                        <i class="link-icon" data-feather="hash"></i>
                        <span class="menu-title">Resources</span></a>
                </li>
<?php */?>            </ul>
        </div>
    </nav>
    <?php } ?>
</div>
<!-- partial -->