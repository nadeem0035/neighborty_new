<!-- BEGIN PAGE TOP -->
<?php if($this->session->userdata('logged_in') !=''){ ?>
<div class="top-menu">

    <ul class="nav navbar-nav pull-right">
        <li class="separator hide">
        </li>
        <!-- BEGIN NOTIFICATION DROPDOWN -->
        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
        <li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <i class="icon-bell"></i>
                <span class="badge badge-success"><?= unread_notification_count(); ?></span>
            </a>
            <ul class="dropdown-menu">

                <li class="external">
                    <h3><span class="bold"><?= unread_notification_count(); ?> pending</span> notifications</h3>
                    <a href="<?= site_url("users/notifications"); ?>" style="color:#FFF;">view all</a>
                </li>
                <li>
                    <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">

                        <?php
                        if (get_notification()) {
                            foreach (get_notification() as $notification) {
                                ?>
                                <li>
                                    <a href="javascript:;">
                                        <span class="time"><?= relative_time($notification->date_time); ?></span>
                                        <span class="details">
                                            <span class="label label-sm label-icon label-warning">
                                                <i class="fa fa-bell-o"></i>
                                            </span>
                                            <?= substr(strip_tags($notification->notification), 0, 80); ?> 
                                        </span>
                                    </a>
                                </li>
                                <?php
                            }
                        } else {
                            echo "<li><a>No messages</a></li>";
                        }
                        ?>
                    </ul>
                </li>
            </ul>
        </li>
        <!-- END NOTIFICATION DROPDOWN -->
        <li class="separator hide">
        </li>

        <li class="dropdown dropdown-extended dropdown-inbox dropdown-dark" id="header_inbox_bar">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <i class="icon-envelope-open"></i>
                <span class="badge badge-danger">
                    <?= messages_count(); ?> </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="external">
                        <h3>You have <span class="bold"> <?= messages_count(); ?> New</span> Messages</h3>
                        <a href="<?= site_url("inbox"); ?>" style="color:#FFF;">view all</a>
                    </li>
                    <li>
                        <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                            <?php
     
                            if (messages_in_header()) {
                                foreach (messages_in_header() as $message) {
                                    ?>
                                    <li>
                                        <a href="<?= site_url("inbox"); ?>">
                                            <span class="photo">
                                       
                                       <img src='<?= base_url() . users_avatar() . "small/" . $message->picture; ?>' class="img-circle" alt="">                                   </span>
                                   <span class="subject">
                                    <span class="from">
                                        <?= $message->first_name . " " . $message->last_name; ?> </span>
                                        <span class="time"> <?= relative_time($message->date_time); ?></span>
                                    </span>
                                    <span class="message">
                                        <?= substr(strip_tags($message->message), 0, 40); ?>... </span>
                                    </a>
                                </li>
                                <?php
                            }
                        } else {
                            echo "<li><a href='" . site_url("inbox") . "'>No messages</a></li>";
                        }
                        ?>
                    </ul>
                </li>
            </ul>
        </li>
        <!-- END INBOX DROPDOWN -->
        <li class="separator hide">
        </li>
        <!-- BEGIN TODO DROPDOWN -->
        <li class="dropdown dropdown-user dropdown-dark">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <span class="username username-hide-on-mobile">
                    <?php
                    $session_data = $this->session->userdata('logged_in');
                    $uid = $session_data['id'];
                    echo ucwords($session_data['full_name']);
                    echo $session_data['rental_type'];
                    ?> 
                </span>

        <?php if(file_exists(FCPATH.$session_data['thumb'])){ ?>
            <img  class="img-circle first_preview"  src="<?= base_url() . $session_data['thumb']; ?>">
            <?php } elseif(file_exists(FCPATH.$session_data['picture'])){ ?>
            <img  class="img-circle"   src="<?= base_url() . $session_data['picture']; ?>">
            <?php } else{ ?>
            <img class="img-circle"  src="<?= base_url()?>assets/media/users_avatar/default.png">
        <?php } ?> 
                <span class="img-circle" ></span>                  
            </a>
            <ul class="dropdown-menu dropdown-menu-default">
                <li>
                    <a href="<?= site_url("dashboard") ?>">
                        <i class="icon-user"></i> Dashboard </a>
                    </li>
                    <li>
                        <a href="<?= site_url("users/edit-profile") ?>"><i class="icon-pencil"></i> Edit Profile </a>
                    </li>
                    <li>
                        <a href="<?= site_url("users/show/" . $uid) ?>"><i class="icon-eye"></i> View Public Profile </a>
                    </li>   
                    <li>
                        <a href="<?= site_url("listings/add-listing"); ?>">
                            <i class="icon-list"></i> Add New Listings </a>
                        </li>
<!--                <li>
                    <a href="<?= site_url("user-wishlists"); ?>">
                        <i class="fa fa-heart"></i> Wish Lists </a>
                    </li>-->
                    <li>
                        <a href="<?= site_url("inbox"); ?>">
                            <i class="icon-envelope-open"></i> My Inbox
                        </a>
                    </li>
                    <li class="divider">
                    </li>
                    <li>
                        <a href="<?= site_url("users/logout") ?>">
                            <i class="icon-key"></i> Log Out </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
<?php } ?>
<!-- END PAGE TOP -->
