 <?php $user_type = $this->session->userdata('user_type'); ?>
 <?php $staff_id = $this->session->userdata('staff_id') ?>
<div class="horizontal-menu">
    <nav class="navbar top-navbar">
        <div class="container">
            <div class="navbar-content">
                <a href="<?php echo base_url().'admin/dashboard' ?>" class="navbar-brand">
                    <?php  echo strtoupper(site_info()) ?> &nbsp;<span class="text-muted">(Admin)</span>
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
                                        <img src="<?php echo base_url('uploads/profile_img/'.$user_data->photo)?>" alt="userr">
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
                            <img src="<?php echo base_url().'uploads/profile_img/'.$user_info2->photo; ?>" alt="profile">
                        </a>
                        <div class="dropdown-menu" aria-labelledby="profileDropdown">
                            <div class="dropdown-header d-flex flex-column align-items-center">
                                 <?php if(!$staff_id): ?>
                                <div class="figure mb-3">
                                    <img src="<?php echo base_url().'uploads/profile_img/'.$user_info2->photo; ?>" alt="">
                                </div>
                                 <?php endif;?>
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
                                <?php if(!$staff_id): ?>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url().'publicprofile/'.$user_info2->userID; ?>" class="nav-link">
                                            <i data-feather="user"></i>
                                            <span>View Biz Profile</span>
                                        </a>
                                    </li>
                                     <li class="nav-item">
                                        <a href="<?php echo base_url().'dashboard/preference' ?>" class="nav-link">
                                            <i data-feather="edit"></i>
                                            <span>Edit Your Preference</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url('login/onboard') ?>" class="nav-link">
                                            <i data-feather="briefcase"></i>
                                            
                                            <span><?php if(!$user_profile->designation) echo 'Add Full Biz Details';else echo 'Edit Business Detail'  ?></span>
                                        </a>
                                    </li>
                                      <li class="nav-item">
                                        <a href="<?php echo base_url('dashboard/edit_profile') ?>" class="nav-link">
                                            <i data-feather="edit"></i>
                                            <span>Edit Short Profile</span>
                                        </a>
                                    </li>
                                    
                                    <?php endif;?>
                                    <li class="nav-item">
                                        <a href="<?php echo base_url().'admin/logout'; ?>" class="nav-link">
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
            <?php $segment = $this->uri->segment(2) ?>
            <ul class="nav page-navigation">
            <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url() ?>home">
                    
                        <i class="link-icon" data-feather="home"></i>
                        <span class="menu-title">Home</span>
                    </a>
                </li>
                <li class="nav-item <?php if($segment == 'activities') echo ' active2' ?>">
                    <a href="<?php echo base_url() ?>admin/activities/all" class="nav-link">
                        <i class="link-icon" data-feather="home"></i>
                        <span class="menu-title"><?php echo site_info() ?> Latest Activities</span>
                        
                    </a>
                </li>      
                 <li class="nav-item <?php if($segment == 'top_activities') echo ' active2' ?>">
                    <a href="<?php echo base_url() ?>admin/top_activities/all" class="nav-link">
                        <i class="link-icon" data-feather="activity"></i>
                        <span class="menu-title">Top Activities</span>
                        
                    </a>
                </li>     
                        
               <?php /*?> <li class="nav-item <?php if($segment == 'myfeed') echo ' active2' ?>">
                    <a href="<?php echo base_url('dashboard/myfeed/all'); ?>" class="nav-link">
                        <i class="link-icon" data-feather="feather"></i>
                        <span class="menu-title">My Feed</span>
                        
                    </a>
                </li><?php */?>
                <?php /*?><li class="nav-item <?php if($segment == 'messages') echo ' active2' ?>">
                    <a href="<?php echo base_url(); ?>dashboard/messages" class="nav-link">
                        <i class="link-icon" data-feather="inbox"></i>
                        <span class="menu-title">Messages</span>
                        
                    </a>
                    
    </li><?php */?>

    <li class="nav-item <?php if($segment == 'public_spotlight' || $segment == 'myspotlight' ||  $segment == 'create_new_spotlight') echo ' active2' ?>">
                    <a href="#" class="nav-link">
                        <i class="link-icon" data-feather="smile"></i>
                        <span class="menu-title">Create</span>
                        <i class="link-arrow"></i>
                    </a>
                    <div class="submenu">
                        <ul class="submenu-item">
                            <?php /*?><li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>dashboard/public_spotlight">Public Spotlights</a></li><?php */?>
                            
                            
                            <li class="nav-item"><a class="nav-link" href="<?php echo base_url() ?>admin/myspotlight">My Spotlights</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?php echo base_url() ?>dashboard/create_new_spotlight">Create new Spotlight</a></li>
                        </ul>
                    </div>
                </li>

    
                <?php /*?><li class="nav-item <?php if($segment == 'my_network') echo ' active2' ?>">
                    <a href="<?php echo base_url(); ?>dashboard/my_network" class="nav-link">
                        <i class="link-icon" data-feather="pie-chart"></i>
                        <span class="menu-title">My Network</span>
            
                    </a>
                    
                </li><?php */?>
                 <?php if($user_type == 1){}else{ ?>
                <li class="nav-item <?php if($segment == 'edit_profile' || $segment == 'user_list' ||  $segment == 'staff_users') echo ' active2' ?> ">
                    <a href="#" class="nav-link">
                        <i class="link-icon" data-feather="settings"></i>
                        <span class="menu-title">Manage</span>
                        <i class="link-arrow"></i>
                    </a>
                    <div class="submenu">
                        <ul class="submenu-item">
                        <li class="nav-item<?php if(isset($segment) && $segment == 'dashboard') echo ' active2' ?>">
                            <a class="nav-link" href="<?php echo base_url() ?>admin/dashboard">
  
                                <span class="menu-title"><?php echo site_info() ?> Stats</span>
                            </a>
                        </li>
                            
                            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/user_list') ?>">Users </a></li>
                            <?php $user_type = $this->session->userdata('user_type'); ?>
                            <?php if(isset($user_type) && $user_type==1){}else{ ?>
                            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/staff_users') ?>">Staff Users </a></li>
                            <?php } ?>
                            <?php if($user_type ==1){}else{ ?>
                            <li class="nav-item"><a class="nav-link" href="<?php echo base_url('admin/landing_menu') ?>">Manage <?php echo site_info() ?> Site </a></li>
                           <?php } ?>
                             <?php if(special_cms() && ($user_type != 1)): ?>
                              <li class="nav-item"><a class="nav-link" href="<?php echo base_url('mbncms') ?>">MBN CMS </a></li>
                              <?php endif;?>
      
                        </ul>
                    </div>
                </li>
                <?php } ?>
                <li class="nav-item">
                    <a href="<?php echo base_url('admin/resources') ?>" class="nav-link">
                        <i class="link-icon" data-feather="hash"></i>
                        <span class="menu-title">Resources</span>
              <?php /*?>          <i class="link-arrow"></i><?php */?>
                        
                        </a>
                        <?php /*?><div class="submenu">
                            <ul class="submenu-item">
                            
                            </ul>
                        </div><?php */?>
                       
                </li>
            </ul>
        </div>
    </nav>
    <?php } ?>
</div>
<!-- partial -->