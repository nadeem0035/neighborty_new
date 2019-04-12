<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$session_data = $this->session->userdata('logged_in');
?>
<div class="inbox-view-info">
    <div class="row">
        <div class="col-md-7">
            <img src='<?=display_user_avatar($message->picture);?>' class="img-circle" alt="<?= $message->first_name . " " . $message->last_name; ?>" height="30px" width="30px">
            <span class="bold">
                <?= $message->first_name . " " . $message->last_name; ?> (<?=relative_time($message->date_time); ?>)</span>
            <!--
            <span class="bold"> To </span>
            <img  src="<?=display_user_avatar($session_data['pic']);?>" class="img-circle" height="30px" width="30px">
            -->

        </div>
        <div class="col-md-5 inbox-info-btn">
            <div class="btn-group">
                <button data-messageid="<?= $message->id; ?>" class="btn btn-sm btn-primary reply-btn"><i class="fa fa-reply"></i> Reply </button>
            </div>
        </div>
    </div>
</div>
<div class="inbox-view">
    <p><?= strip_tags($message->message) ?> </p>
</div>


    <div class="messaging" style="display:none;">
        <div class="inbox_msg">
            <!--<div class="inbox_people">
                <div class="headind_srch">
                    <div class="recent_heading">
                        <h4>Recent</h4>
                    </div>
                    <div class="srch_bar">
                        <div class="stylish-input-group">
                            <input type="text" class="search-bar"  placeholder="Search" >
                            <span class="input-group-addon">
                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                </span> </div>
                    </div>
                </div>
                <div class="inbox_chat">
                    <div class="chat_list active_chat">
                        <div class="chat_people">
                            <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                            <div class="chat_ib">
                                <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                                <p>Test, which is a new approach to have all solutions
                                    astrology under one roof.</p>
                            </div>
                        </div>
                    </div>
                    <div class="chat_list">
                        <div class="chat_people">
                            <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                            <div class="chat_ib">
                                <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                                <p>Test, which is a new approach to have all solutions
                                    astrology under one roof.</p>
                            </div>
                        </div>
                    </div>
                    <div class="chat_list">
                        <div class="chat_people">
                            <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                            <div class="chat_ib">
                                <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                                <p>Test, which is a new approach to have all solutions
                                    astrology under one roof.</p>
                            </div>
                        </div>
                    </div>
                    <div class="chat_list">
                        <div class="chat_people">
                            <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                            <div class="chat_ib">
                                <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                                <p>Test, which is a new approach to have all solutions
                                    astrology under one roof.</p>
                            </div>
                        </div>
                    </div>
                    <div class="chat_list">
                        <div class="chat_people">
                            <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                            <div class="chat_ib">
                                <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                                <p>Test, which is a new approach to have all solutions
                                    astrology under one roof.</p>
                            </div>
                        </div>
                    </div>
                    <div class="chat_list">
                        <div class="chat_people">
                            <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                            <div class="chat_ib">
                                <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                                <p>Test, which is a new approach to have all solutions
                                    astrology under one roof.</p>
                            </div>
                        </div>
                    </div>
                    <div class="chat_list">
                        <div class="chat_people">
                            <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                            <div class="chat_ib">
                                <h5>Sunil Rajput <span class="chat_date">Dec 25</span></h5>
                                <p>Test, which is a new approach to have all solutions
                                    astrology under one roof.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
            <div class="mesgs">
                <div class="msg_history">
                    <div class="incoming_msg">
                        <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                        <div class="received_msg">
                            <div class="received_withd_msg">
                                <p>Test which is a new approach to have all
                                    solutions</p>
                                <span class="time_date"> 11:01 AM    |    June 9</span></div>
                        </div>
                    </div>
                    <div class="outgoing_msg">
                        <div class="sent_msg">
                            <p>Test which is a new approach to have all
                                solutions</p>
                            <span class="time_date"> 11:01 AM    |    June 9</span> </div>
                    </div>
                    <div class="incoming_msg">
                        <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                        <div class="received_msg">
                            <div class="received_withd_msg">
                                <p>Test, which is a new approach to have</p>
                                <span class="time_date"> 11:01 AM    |    Yesterday</span></div>
                        </div>
                    </div>
                    <div class="outgoing_msg">
                        <div class="sent_msg">
                            <p>Apollo University, Delhi, India Test</p>
                            <span class="time_date"> 11:01 AM    |    Today</span> </div>
                    </div>
                    <div class="incoming_msg">
                        <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                        <div class="received_msg">
                            <div class="received_withd_msg">
                                <p>We work directly with our designers and suppliers,
                                    and sell direct to you, which means quality, exclusive
                                    products, at a price anyone can afford.</p>
                                <span class="time_date"> 11:01 AM    |    Today</span></div>
                        </div>
                    </div>
                </div>
                <div class="type_msg">
                    <div class="input_msg_write">
                        <input type="text" class="write_msg" placeholder="Type a message" />
                        <button class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
die();
?>