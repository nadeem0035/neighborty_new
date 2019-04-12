<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<body class="login">
    <!-- BEGIN LOGO -->
    <div class="logo">
        <a href="<?= site_url(); ?>">
            <img src="<?=base_url();?>assets/img/logo-big.png" alt=""/>
        </a>
    </div>
    <!-- END LOGO -->
    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
    <div class="menu-toggler sidebar-toggler">
    </div>
    <!-- END SIDEBAR TOGGLER BUTTON -->
    <!-- BEGIN LOGIN -->
    <div class="content" style="color: #fff; text-align: center; margin-top: 50px;display: block;">
        
        <?php if($logged_in) { echo anchor('users/logout', 'Logout'); } else { echo anchor('users/login', 'Login Signup'); }?>
       
    </div>