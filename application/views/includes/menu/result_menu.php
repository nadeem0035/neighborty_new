
    <div class="header-left">
        <nav class="navi main-nav">
            <ul>
                <li><a href="<?=site_url();?>search?type=rent"><?=$this->lang->line('rent');?></a></li>
                <li><a href="<?=site_url();?>search?type=sale""><?=$this->lang->line('sale');?></a></li>
                <li><a href="<?= site_url('about') ?>"><?=$this->lang->line('about');?></a></li>
                <li><a href="<?=site_url('/blog');?>">Blog</a></li>
            </ul>
        </nav>
    </div>
    <div class="header-logo">
        <a href="<?=site_url('/');?>"><img src="<?=base_url()?>assets/img/white_logo1.png" alt="logo"></a>
    </div>
    <div class="header-right header-user">
        <ul class="account-action top-drop-downs">
            <li class="top-bar-contact">
                <a class="btn btn-add-property" href="<?= site_url("listings/add-property") ?>"><i class="fa fa-plus"></i> <?=$this->lang->line('add_property');?></a>
            </li>
            <?php if($this->session->userdata('logged_in') !=''){ ?>
                <li class="hidden-xs" id="header_notification_bar">

                    <a href="javascript:;" class="iconBadge">


                        <i class="fa fa-bell"></i>

                        <?php if(unread_notification_count() != 0):?>

                            <span class="badge badge-success"><?= unread_notification_count(); ?></span>

                        <?php endif;?>
                    </a>

                    <div class="account-dropdown">
                        <ul class="msgList">
                            <li class="external">
                                <h3><span class="bold"><?= unread_notification_count(); ?> <?=$this->lang->line('d_pending');?>  </span><?=$this->lang->line('d_notification');?> </h3>
                                <a href="<?= site_url("users/notifications"); ?>" style="color:#f78f35;"><?=$this->lang->line('d_everything');?></a>
                            </li>
                            <li>

                                <div class="slimScrollDiv">
                                    <ul class="dropdown-menu-list scroller">
                                        <?php
                                        if( get_notification() )
                                        {
                                            foreach (get_notification() as $notification)
                                            {
                                                ?>
                                                <li class="notify-txt">
                                                    <a href="<?= site_url().$notification->notify_type;?>">
                                                        <span class="date_time"><?= relative_time($notification->date_time); ?></span>
                                                        <span class="label label-sm label-icon label-warning"><i class="fa fa-bell-o"></i></span>
                                                        <span class="n-message"><?= substr(strip_tags($notification->notification), 0, 80); ?></span>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            echo "<li><a>".$this->lang->line('d_no_tification')."</a></li>";
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                                <span class="hidden-sm hidden-xs">
                                    <?php $session_data = $this->session->userdata('logged_in'); $uid = $session_data['id'];$active = $session_data['active'];
                                    echo ucwords($session_data['first_name']);
                                    ?> <i class="fa fa-angle-down"></i>
                                </span>
                    <?php
                    // pre($session_data);
                    if(file_exists(FCPATH.$session_data['thumb']))
                    {
                        ?>
                        <img class="user-image first_preview" src="<?=base_url($session_data['thumb']); ?>" alt="" height="22" width="22">
                        <?php
                    }
                    elseif(file_exists(FCPATH.$session_data['picture']))
                    {
                        ?>
                        <img class="user-image" src="<?=base_url($session_data['picture']); ?>" alt="" height="22" width="22">
                        <?php
                    }
                    else
                    {
                        ?>
                        <img class="user-image" src="<?=base_url($session_data['thumb']); ?>" alt="" height="22" width="22">
                        <?php
                    }
                    ?>
                    <div class="account-dropdown">
                        <?php if($session_data['user_type'] == 'Agent' || $session_data['user_type'] == 'Both') { ?>
                            <ul>
                                <li>
                                    <a href="<?= site_url("dashboard") ?>"><i class="fa fa-dashboard"></i> <?=$this->lang->line('d_dashboard');?>
                                        <?php if($active ==0) { ?>
                                            <span class="" data-toggle="tooltip" title="Unverified Account"><i class="fa fa-exclamation-circle to_right" aria-hidden="true" style="color:#a94442"></i></span>
                                        <?php } ?>
                                    </a>
                                </li>
                                <li><a href="<?= site_url("inbox"); ?>"><i class="fa fa-envelope"></i> <?=$this->lang->line('d_inbox');?> <span class="badge badge-danger pull-right"><?= messages_count(); ?></span></a></li>
                                <li><a href="<?= site_url("listings") ?>"><i class="fa fa-home"></i> <?=$this->lang->line('my_property');?> </a></li>
                                <li><a href="<?= site_url("users/edit-profile") ?>"><i class="fa fa-user"></i> <?=$this->lang->line('d_e_profile');?> </a></li>
                                <li><a href="<?= site_url("user-wishlists"); ?>"><i class="fa fa-heart"></i> <?=$this->lang->line('d_wishlists');?> </a></li>
                                <li><a href="<?= site_url("users/logout") ?>"><i class="fa fa-unlock"></i> <?=$this->lang->line('d_logout');?> </a></li>
                            </ul>
                        <?php }else{ ?>

                            <ul>
                                <li>
                                    <a href="<?= site_url("dashboard") ?>"><i class="fa fa-dashboard"></i> <?=$this->lang->line('d_dashboard');?>
                                        <?php if($active ==0) { ?>
                                            <span class="" data-toggle="tooltip" title="Unverified Account"><i class="fa fa-exclamation-circle to_right" aria-hidden="true" style="color:#a94442"></i></span>
                                        <?php } ?>
                                    </a>
                                </li>
                                <li><a href="<?= site_url("inbox"); ?>"><i class="fa fa-envelope"></i> <?=$this->lang->line('d_inbox');?> <span class="badge badge-danger pull-right"><?= messages_count(); ?></span></a></li>
                                <li><a href="<?= site_url("listings") ?>"><i class="fa fa-home"></i> <?=$this->lang->line('my_property');?> </a></li>
                                <li><a href="<?= site_url("users/edit-profile") ?>"><i class="fa fa-user"></i> <?=$this->lang->line('d_e_profile');?> </a></li>
                                <li><a href="<?= site_url("user-wishlists"); ?>"><i class="fa fa-heart"></i> <?=$this->lang->line('d_wishlists');?> </a></li>
                                <li><a href="<?= site_url("users/logout") ?>"><i class="fa fa-unlock"></i> <?=$this->lang->line('d_logout');?> </a></li>
                            </ul>

                        <?php } ?>
                    </div>
                </li>
                <?php /*$this->load->view('templates/account_menu'); */?>
            <?php } else { ?>
                <li>
                    <div class="user">
                        <a href="<?= site_url("users/login_status/")?>"><i class="fa fa-sign-in"></i> <?=$this->lang->line('login');?></a>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
