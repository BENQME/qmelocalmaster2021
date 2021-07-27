<div class="page-content">

            <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                <div>
                  <h4 class="mb-3 mb-md-0">Messages</h4>
                </div>
                
            </div>

            <div class="row chat-wrapper">
                <div class="col-md-12">
                <?php //print_r($userinfo) ?>
        <div class="card">
          <div class="card-body">
            <div class="row position-relative">
              <div class="col-lg-4 chat-aside border-lg-right">
                <div class="aside-content">
                  <div class="aside-header">
                    <div class="d-flex justify-content-between align-items-center pb-2 mb-2">
                      <div class="d-flex align-items-center">
                        <figure class="mr-2 mb-0">
                          <img src="<?php echo base_url().'uploads/profile_img/'.$userinfo->photo; ?>" class="img-sm rounded-circle" alt="profile">
                           <div class="status<?php if(is_online($userinfo->userID)) echo ' online' ?>"></div>
                        </figure>
                        <div>
                          <h6><?php echo $userinfo->first_name.' '.$userinfo->last_name; ?></h6>
                          
                        </div>
                      </div>
                      <?php /*?><div class="dropdown">
                        <button class="btn p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="icon-lg text-muted pb-3px" data-feather="settings" data-toggle="tooltip" title="Settings"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View Profile</span></a>
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="edit-2" class="icon-sm mr-2"></i> <span class="">Edit Profile</span></a>
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="aperture" class="icon-sm mr-2"></i> <span class="">Add status</span></a>
                          <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="settings" class="icon-sm mr-2"></i> <span class="">Settings</span></a>
                        </div>
                      </div><?php */?>
                    </div>
                    <?php /*?><form class="search-form">
                      <div class="input-group border rounded-sm">
                        <div class="input-group-prepend">
                          <div class="input-group-text border-0 rounded-sm">
                            <i data-feather="search" class="icon-md cursor-pointer"></i>
                          </div>
                        </div>
                        <input type="text" class="form-control  border-0 rounded-sm" id="searchForm" placeholder="Search here...">
                      </div>
                    </form><?php */?>
                  </div>
                  <div class="aside-body">
                    <ul class="nav nav-tabs mt-3" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="chats-tab" data-toggle="tab" href="#chats" role="tab" aria-controls="chats" aria-selected="true">
                          <div class="d-flex flex-row flex-lg-column flex-xl-row align-items-center">
                            <i data-feather="message-square" class="icon-sm mr-sm-2 mr-lg-0 mr-xl-2 mb-md-1 mb-xl-0"></i>
                            <p class="d-none d-sm-block">Contacts</p>
                          </div>
                        </a>
                      </li>
                      
                    </ul>
                    <div class="tab-content mt-3">
                      <?php if(isset($contacts) && $contacts): //print_r($contacts) ?>
                      <div class="tab-pane fade show active" id="chats" role="tabpanel" aria-labelledby="chats-tab">
                        <div>
                          <p class="text-muted mb-1">Recent chats</p>
                          <ul class="list-unstyled chat-list px-1">
                          <?php foreach($contacts as $contact): ?>
                            <li class="chat-item pr-1">
                              <a href="<?php echo base_url('dashboard/messages/'.$contact['contact_id']) ?>" class="d-flex align-items-center">
                                <figure class="mb-0 mr-2">
                                  <img src="<?php echo base_url().'uploads/profile_img/'.$contact['photo']; ?>" class="img-xs rounded-circle" alt="user">
                                  <div class="status <?php if(is_online($contact['contact_id'])) echo ' online' ?>"></div>
                                </figure>
                                <div class="d-flex justify-content-between flex-grow border-bottom">
                                  <div>
                                    <p class="text-body font-weight-bold"><?php echo $contact['first_name'].' '.$contact['last_name']; ?></p>
                                    <?php
									$last_msg = $this->db->where(array('receiver_id'=>$this->session->userdata('user_id'),'sender_id'=>$contact['contact_id']))->from('messages')->order_by('date_time','desc')->get()->row();
									//print_r($last_msg->messsage);
									//print_r($chat_history_alt);
				/*					$counter=0;
									$chat_history2=array();
									 if(isset($chat_history) && count($chat_history)>0): 
										 $chat_history2 = array_reverse($chat_history);
										 
										 foreach($chat_history as $msg){ 
										 if($msg['mark_read'] !=1) $counter++;
										 
										 }*/
										 
										 ?>
                                       <?php //endif ?>
                                    <p class="text-muted tx-13"><?php if(isset($last_msg->messsage)) echo $last_msg->messsage ?></p>
                                  
                                  </div>
                                  <div class="d-flex flex-column align-items-end">
                                    <p class="text-muted tx-13 mb-1"><?php if(isset($chat_history2[0]['date_time'])) echo date('F d, Y g:i a',strtotime($chat_history2[0]['date_time'])) ?></p>
                                    <div class="badge badge-pill badge-primary ml-auto"><?php echo user_msg_by_sender($contact['contact_id']) ?></div>
                                  </div>
                                </div>
                              </a>
                            </li>
                            <?php endforeach;?>
                          </ul>
                        </div>
                      </div>
                      <?php endif;?>
                    </div>
                  </div>
                </div>
              </div>
              <?php if(isset($to_user) && $to_user): ?>
                  <div class="col-lg-8 chat-content">
                    <div class="chat-header border-bottom pb-2">
                      <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                          <i data-feather="corner-up-left" id="backToChatList" class="icon-lg mr-2 ml-n2 text-muted d-lg-none"></i>
                          <figure class="mb-0 mr-2">
                            <img src="<?php echo base_url().'uploads/profile_img/'.$to_user->photo; ?>" class="img-sm rounded-circle" alt="image">
                            <div class="status <?php if(is_online($to_user->userID)) echo ' online' ?>"></div>
                          </figure>
                          <div>
                            <p><?php echo $to_user->first_name.' '.$to_user->last_name; ?></p>
                          </div>
                        </div>
                        <div class="d-flex align-items-center mr-n1">
                          <!-- <a href="#">
                            <i data-feather="video" class="icon-lg text-muted mr-3" data-toggle="tooltip" title="Start video call"></i>
                          </a>
                          <a href="#">
                            <i data-feather="phone-call" class="icon-lg text-muted mr-0 mr-sm-3" data-toggle="tooltip" title="Start voice call"></i>
                          </a> -->
                          <?php if(is_array($contacts) && $this->uri->segment(3) &&  multi_in_array($this->uri->segment(3),$contacts)): ?>
                           <a href="<?php echo base_url('dashboard/contact/'.$this->uri->segment(3)) ?>" class="d-none d-sm-block">
                            <i data-feather="user-minus" class="icon-lg text-muted" data-toggle="tooltip" title="Remove From Contact"></i>
                          </a>
                          
                          <?php else: ?>
                         <a href="<?php echo base_url('dashboard/contact/'.$this->uri->segment(3)) ?>" class="d-none d-sm-block">
                            <i data-feather="user-plus" class="icon-lg text-muted" data-toggle="tooltip" title="Add to contacts"></i>
                          </a>
                          <?php endif ?>
                        </div>
                      </div>
                    </div>
                    <div class="chat-body" id="msg_top">
                    <?php if(count($chat_history)>0): ?>
                          <ul class="messages">
                            <?php foreach($chat_history as $msg): //print_r($msg) ?>
                            <li class="message-item <?php if($msg['msg_by'] == $this->session->userdata('user_id')) echo 'me'; else echo 'friend' ?>" chat_id="chat_<?php echo $msg['id'] ?>">
                              <img src="<?php echo base_url().'uploads/profile_img/'.$msg['photo']; ?>" class="img-xs rounded-circle" alt="avatar">
                              <div class="content">
                                <div class="message">
                                  <div class="bubble">
                                    <?php echo $msg['messsage'] ?>
                                  </div>
                                  <span><?php echo date('F d, Y g:i a',strtotime($msg['date_time'])) ?></span>
                                </div>
                              </div>
                            </li>
                            <?php endforeach ?>
                  <?php /*?>          <li class="message-item me">
                              <img src="https://via.placeholder.com/43x43" class="img-xs rounded-circle" alt="avatar">
                              <div class="content">
                                <div class="message">
                                  <div class="bubble">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry printing and typesetting industry.</p>
                                  </div>
                                </div>
                                <div class="message">
                                  <div class="bubble">
                                    <p>Lorem Ipsum.</p>
                                  </div>
                                  <span>8:13 PM</span>
                                </div>
                              </div>
                            </li>
                            <li class="message-item friend">
                              <img src="https://via.placeholder.com/43x43" class="img-xs rounded-circle" alt="avatar">
                              <div class="content">
                                <div class="message">
                                  <div class="bubble">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                  </div>
                                  <span>8:15 PM</span>
                                </div>
                              </div>
                            </li>
                            <li class="message-item me">
                              <img src="https://via.placeholder.com/43x43" class="img-xs rounded-circle" alt="avatar">
                              <div class="content">
                                <div class="message">
                                  <div class="bubble">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry printing and typesetting industry.</p>
                                  </div>
                                  <span>8:15 PM</span>
                                </div>
                              </div>
                            </li>
                            <li class="message-item friend">
                              <img src="https://via.placeholder.com/43x43" class="img-xs rounded-circle" alt="avatar">
                              <div class="content">
                                <div class="message">
                                  <div class="bubble">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                  </div>
                                  <span>8:17 PM</span>
                                </div>
                              </div>
                            </li>
                            <li class="message-item me">
                              <img src="https://via.placeholder.com/43x43" class="img-xs rounded-circle" alt="avatar">
                              <div class="content">
                                <div class="message">
                                  <div class="bubble">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry printing and typesetting industry.</p>
                                  </div>
                                </div>
                                <div class="message">
                                  <div class="bubble">
                                    <p>Lorem Ipsum.</p>
                                  </div>
                                  <span>8:18 PM</span>
                                </div>
                              </div>
                            </li>
                            <li class="message-item friend">
                              <img src="https://via.placeholder.com/43x43" class="img-xs rounded-circle" alt="avatar">
                              <div class="content">
                                <div class="message">
                                  <div class="bubble">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                  </div>
                                  <span>8:22 PM</span>
                                </div>
                              </div>
                            </li>
                            <li class="message-item me">
                              <img src="https://via.placeholder.com/43x43" class="img-xs rounded-circle" alt="avatar">
                              <div class="content">
                                <div class="message">
                                  <div class="bubble">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry printing and typesetting industry.</p>
                                  </div>
                                  <span>8:30 PM</span>
                                </div>
                              </div>
                            </li><?php */?>
                          </ul>
                      <?php endif ?>
                    </div>
                    <div class="chat-footer d-flex">
                      
                      <?php /*?><div class="d-none d-md-block">
                        <button type="button" class="btn border btn-icon rounded-circle mr-2" data-toggle="tooltip" title="Attatch files">
                          <i data-feather="paperclip" class="text-muted"></i>
                        </button>
                      </div><?php */?>
                       <form class="fixxx_msg_form" method="post" action="<?php echo base_url('dashboard/messages/'.$this->uri->segment(3)) ?>">
                      <div class="search-form flex-grow mr-2" id="chat_form">
    
                        <div class="input-group">
                          <input type="text" name="message" required="required" class="form-control rounded-pill" id="chatForm" placeholder="Type a message">
                        </div>
                    </div>
                       <button type="submit" name="submit" value="1" class="btn btn-primary btn-icon rounded-circle">
                          <i data-feather="send"></i>
                        </button>
                        </form>
                        <div>
                       
                      </div>
                    </div>
                  </div>
              <?php endif;?>
            </div>
          </div>
        </div>
                </div>
            </div>
        </div>