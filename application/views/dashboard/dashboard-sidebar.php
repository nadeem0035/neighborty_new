<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$session_data = $this->session->userdata('logged_in');
$uid = $session_data['id'];
$UserType = $session_data['user_type'];
?>

<ul class="profile-menu-tabs">
    <li class="start <?php if (site_url("dashboard") == current_url()) { echo "active"; } ?>">
        <a href="<?= site_url("dashboard") ?>"><span class="title"><?=$this->lang->line('dashboard');?></span></a>
    </li>

    <li class="<?php if (site_url("users/edit-profile") == current_url()) { echo "active"; } ?>">
        <a href="<?= site_url("users/edit-profile") ?>"><span class="title"><?=$this->lang->line('my_profile');?></span></a>
    </li>

    <li class="<?php if (site_url("inbox") == current_url()) { echo "active"; } ?>"><a href="<?= site_url("inbox"); ?>"><span class="title"><?=$this->lang->line('my_mailbox');?></span></a></li>

    <!-- Agent -->
    <?php
    if( isset($_SESSION['logged_in']['user_type']) && $_SESSION['logged_in']['user_type'] == 'Agent' )
    {
        ?>
        <li class="<?=site_url("listings") == current_url() || stristr( current_url(), 'listings/add-listing' ) || stristr( current_url(), 'listings/edit' ) ? "active" : ''?>">
            <a href="<?= site_url("listings") ?>"><span class="title"><?=$this->lang->line('property_tab');?> </span></a>
        </li>

        <li class="<?php if (site_url("applications") == current_url()) { echo "active"; } ?>">
            <a href="<?= site_url("applications"); ?>"><?=$this->lang->line('applications');?> </a>
        </li>

        <!--<li class="<?php /*if (site_url("appointments") == current_url()) { echo "active"; } */?>">
            <a href="<?/*= site_url("appointments"); */?>"><?/*=$this->lang->line('appointments');*/?></a>
        </li>-->

        <!--
        <li class="<?php if (site_url("agents/teams") == current_url()) { echo "active"; } ?>">
            <a href="<?= site_url("agents/teams"); ?>"><?=$this->lang->line('team');?></a>
        </li>
        -->

        <!--<li class="<?php /*if (site_url("agents/payment") == current_url()) { echo "active"; } */?>">
            <a href="<?/*= site_url("agents/payment"); */?>"><?/*=$this->lang->line('paid');*/?></a>
        </li>-->


        <!-- Renter -->
        <?php
    } elseif( isset($_SESSION['logged_in']['user_type']) && $_SESSION['logged_in']['user_type'] == 'Renter' )
    {?>

        <li class="<?=site_url("listings") == current_url() || stristr( current_url(), 'listings/add-listing' ) || stristr( current_url(), 'listings/edit' ) ? "active" : ''?>">
            <a href="<?= site_url("listings") ?>"><span class="title"><?=$this->lang->line('property_tab');?> </span></a>
        </li>


        <li class="<?php if (site_url("applications") == current_url()) { echo "active"; } ?>">
            <a href="<?= site_url("applications"); ?>"><?=$this->lang->line('applications');?></a>
        </li>


        <!--<li class="<?php /*if (site_url("appointments") == current_url()) { echo "active"; } */?>">
            <a href="<?/*= site_url("appointments"); */?>"><?/*=$this->lang->line('appointments');*/?></a>
        </li>-->

        <!--
        <li class="<?php if (site_url("listings/add-listing") == current_url()) { echo "active"; } ?>">
            <a href="<?= site_url("listings/add-listing"); ?>">Application information </a>
        </li>
        -->

    <?php } else{ ?>

        <!-- Renter + Agent -->

        <li class="<?=site_url("listings") == current_url() || stristr( current_url(), 'listings/add-listing' ) || stristr( current_url(), 'listings/edit' ) ? "active" : ''?>">
            <a href="<?= site_url("listings") ?>"><span class="title"><?=$this->lang->line('property_tab');?></span></a>
        </li>

        <li class="<?php if (site_url("applications") == current_url()) { echo "active"; } ?>">
            <a href="<?= site_url("applications"); ?>"><?=$this->lang->line('applications');?></a>
        </li>

        <!--<li class="<?php /*if (site_url("listings/add-listing") == current_url()) { echo "active"; } */?>">
            <a href="<?/*= site_url("listings/add-listing"); */?>">Upcoming appointments </a>
        </li>-->

        <!--<li class="<?php /*if (site_url("listings/add-listing") == current_url()) { echo "active"; } */?>">
            <a href="<?/*= site_url("listings/add-listing"); */?>">Application information </a>
        </li>-->

        <!--<li class="<?php /*if (site_url("appointments") == current_url()) { echo "active"; } */?>">
            <a href="<?/*= site_url("appointments"); */?>"><?/*=$this->lang->line('appointments');*/?></a>
        </li>-->


        <!--<li class="<?php /*if (site_url("listings/add-listing") == current_url()) { echo "active"; } */?>">
            <a href="<?/*= site_url("listings/add-listing"); */?>">Add a new property </a>
        </li>-->

    <?php }
    ?>

    <li class=" <?php if ($this->uri->segment(1) == 'user-wishlists' || $this->uri->segment(1) == 'user-wishlist') { echo "active"; } ?>">
        <a href="<?= site_url("user-wishlists") ?>"><span class="title"><?=$this->lang->line('favorites');?></span></a>
    </li>
</ul>