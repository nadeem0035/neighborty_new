<div class="header-mobile visible-sm visible-xs">
    <div class="container-fluid">
        <div class="mobile-nav">
            <span class="nav-trigger"><i class="fa fa-navicon"></i></span>
            <div class="nav-dropdown main-nav-dropdown"></div>
        </div>
        <div class="header-logo" style="line-height:50px; padding-bottom:6px;">
            <a href="<?=site_url('/');?>"><img src="<?=base_url()?>assets/img/white_logo1.png" alt="logo"></a>
        </div>
        <?php if($this->session->userdata('logged_in') !=''){ ?>
            <div class="header-user">
                <ul class="account-action">
                    <li id="userInfo">
                            <span class="hidden-sm hidden-xs">
                                        <?php $session_data = $this->session->userdata('logged_in');
                                        $uid = $session_data['id'];
                                        echo ucwords($session_data['full_name']);
                                        ?> <i class="fa fa-angle-down"></i>
                            </span>
                        <?php
                        if(file_exists(FCPATH.$session_data['thumb']))
                        {
                            ?>
                            <img class="user-image first_preview" src="<?=base_url($session_data['thumb']); ?>" alt="User image" height="22" width="22">
                            <?php
                        }
                        elseif(file_exists(FCPATH.$session_data['picture']))
                        {
                            ?>
                            <img class="user-image" src="<?=base_url($session_data['picture']); ?>" alt="profile image" height="22" width="22">
                            <?php
                        }
                        else
                        {
                            ?>
                            <img class="user-image" src="<?=base_url($session_data['thumb']); ?>" alt="profile image" height="22" width="22">
                            <?php
                        }
                        ?>
                        <span class="img-circle" ></span>
                        <div class="account-dropdown">
                            <?php if($session_data['user_type'] == 'Agent' || $session_data['user_type'] == 'Both') { ?>
                                <ul>
                                    <li><a href="<?= site_url("dashboard") ?>"><i class="fa fa-dashboard"></i> <?=$this->lang->line('d_dashboard');?> </a></li>
                                    <li><a href="<?= site_url("inbox"); ?>"><i class="fa fa-envelope"></i> <?=$this->lang->line('d_inbox');?> </a></li>
                                    <li><a href="<?= site_url("users/edit-profile") ?>"><i class="fa fa-user"></i> <?=$this->lang->line('d_e_profile');?> </a></li>
                                    <!--<li><a href="<?/*= site_url("agent/profile/" . $uid) */?>"><i class="fa fa-file"></i> <?/*=$this->lang->line('d_profile');*/?> </a></li>-->
                                    <!--<li><a href="<?/*= site_url("listings"); */?>"><i class="fa fa-plus-circle"></i> Mes propriétés  </a></li>-->
                                    <li><a href="<?= site_url("user-wishlists"); ?>"><i class="fa fa-heart"></i> <?=$this->lang->line('d_wishlists');?> </a></li>
                                    <li><a href="<?= site_url("users/logout") ?>"><i class="fa fa-unlock"></i> <?=$this->lang->line('d_logout');?> </a></li>
                                </ul>
                            <?php }else{ ?>
                                <ul>
                                    <li><a href="<?= site_url("dashboard") ?>"><i class="fa fa-dashboard"></i> <?=$this->lang->line('d_dashboard');?> </a></li>
                                    <li><a href="<?= site_url("inbox"); ?>"><i class="fa fa-envelope"></i> <?=$this->lang->line('d_inbox');?></a></li>
                                    <li><a href="<?= site_url("users/edit-profile") ?>"><i class="fa fa-user"></i> <?=$this->lang->line('d_e_profile');?> </a></li>
                                    <!--<li><a href="<?/*= site_url("users/show/" . $uid) */?>"><i class="fa fa-file"></i> <?/*=$this->lang->line('d_profile');*/?> </a></li>-->
                                    <li><a href="<?= site_url("user-wishlists"); ?>"><i class="fa fa-heart"></i> <?=$this->lang->line('d_wishlists');?> </a></li>
                                    <li><a href="<?= site_url("users/logout") ?>"><i class="fa fa-unlock"></i> <?=$this->lang->line('d_logout');?> </a></li>
                                </ul>
                            <?php } ?>
                        </div>
                    </li>
                </ul>
            </div>
        <?php } else { ?>
            <div class="header-user">
                <ul class="account-action">
                    <li>
                        <span class="user-icon"><i class="fa fa-user"></i></span>
                        <div class="account-dropdown">
                            <ul>
                                <li><a href="<?= site_url("users/login_status/")?>"><i class="fa fa-user"></i><?=$this->lang->line('login');?></a></li>
                                <li><a href="<?= site_url("users/signup_status/")?>"><i class="fa fa-user"></i><?=$this->lang->line('register');?></a></li>
                                <li><a href="<?= site_url("listings/add-property")?>"><i class="fa fa-plus"></i> <?=$this->lang->line('add_property');?></a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        <?php } ?>
    </div>
</div>