<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-sidebar-closed-hide-logo">
    <!-- BEGIN HEADER -->
    <?php $this->load->view('dashboard/dashboard-header'); ?>
    <!-- END HEADER -->
    <div class="clearfix"></div>
    <!-- BEGIN CONTENT -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <?php $this->load->view('dashboard/dashboard-sidebar'); ?>
        <!-- END SIDEBAR -->
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-head">
                    <!-- BEGIN PAGE TITLE -->
                    <div class="page-title">
                        <h1>Reservations <small>All the recent reservations have shown here</small></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box blue calendar">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>My Reservations
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10 col-sm-12">
                                        <div class="has-toolbar fc fc-ltr fc-unthemed" id="calendar">
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>
                                <!-- END CALENDAR PORTLET-->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END CONTAINER -->