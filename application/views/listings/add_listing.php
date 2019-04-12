<?php defined('BASEPATH') OR exit('No direct script access allowed'); //pre($_SESSION); ?>
   <?php $this->load->view('templates/header'); ?>
    <style>
        .form-horizontal .form-group
        {
            margin: 5px 0 !important;
        }
        .space10
        {
            margin: 15px 0 !important;
        }
        .text-left input
        {
            text-align: left !important;
        }
    </style>
    <body>
<?php $this->load->view('dashboard/dashboard-header'); ?>

<section id="section-body">
        <div class="container">

            <div class="user-dashboard-full">
                <?php $this->load->view('dashboard/dashboard-sidebar'); ?>
                <div class="profile-area-content">

                    <?php $this->load->view('listings/steps_header');?>

                    <div class="membership-content-area">
                        <?=isset($msg) ? $msg : '';?>
                        <?php
                        if( $step == 1)
                            $this->load->view('listings/step1');
                        ?>

                        <?php
                        if( $step == 2 )
                            $this->load->view('listings/step2');
                        ?>

                        <?php
                        if( $step == 3 )
                            $this->load->view('listings/step3');
                        ?>

                        <?php
                        if( $step == 4 )
                            $this->load->view('listings/step5');
                        ?>

                        <?php
                        if( $step == 5 )
                           // $this->load->view('listings/step5');
                        ?>


                    </div>


                </div>
            </div>

    </section>
<?php $this->load->view('templates/dashboard_footer'); ?>
<?php
//$footer_data = isset($footer_data) ? $footer_data : '';
//$this->load->view('templates/dashboard_footer', $footer_data);
?>