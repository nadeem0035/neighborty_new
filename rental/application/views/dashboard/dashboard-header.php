<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="<?= site_url(); ?>">
                <img src="<?= base_url(); ?>assets/img/logo-light.png" alt="logo" class="logo-default"/>
            </a>
            <div style="display:none;" class="menu-toggler sidebar-toggler">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->

        <!-- BEGIN PAGE TOP -->
        <div class="page-top">

<?php $this->load->view('templates/common_topmenu'); ?>

        </div>
        <!-- END PAGE TOP -->
    </div>
    <!-- END HEADER INNER -->
</div>