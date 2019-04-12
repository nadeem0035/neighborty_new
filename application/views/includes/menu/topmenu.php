<!--start header section-->

<header id="header-section" class="header-section-4 header-main nav-left hidden-sm hidden-xs" data-sticky="1">
    <div class="container">
        <div class="header-left">
            <div class="logo">
                <a href="<?=site_url()?>" title=""><img src="<?=base_url()?>assets/img/logo-header.png" width="200" alt=""></a>
            </div>asasasasasa
            <?php $this->load->view('templates/menu'); ?>
            <?php //$this->load->view('includes/menu'); ?>
        </div>
    </div>
</header>
<div class="header-mobile visible-sm visible-xs">
    <div class="container">
        <!--start mobile nav-->
        <div class="mobile-nav">
            <span class="nav-trigger"><i class="fa fa-navicon"></i></span>
            <div class="nav-dropdown main-nav-dropdown"></div>
        </div>
        <!--end mobile nav-->
        <div class="header-logo">
            <a href="<?=site_url()?>" title=""><img src="<?=base_url()?>assets/img/logo-header2.png" alt=""></a>
        </div>
        <div class="header-user">
            <ul class="account-action">
                <li>
                    <span class="user-icon"><i class="fa fa-user"></i></span>
                    <div class="account-dropdown">
                        <ul>
                            <li><a href="<?= site_url("users/login_status/")?>"><i class="fa fa-user"></i><?=$this->lang->line('login');?></a></li>
                            <li><a href="<?= site_url("users/signup_status/")?>"><i class="fa fa-user"></i><?=$this->lang->line('register');?></a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>