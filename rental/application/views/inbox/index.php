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
                        <h1>Inbox <small>All the messages have shown here</small></h1>
                    </div>
                    <!-- END PAGE TITLE -->
                </div>
                <!-- END PAGE HEAD -->
                <!-- END PAGE HEADER-->
                <div class="portlet light">
                    <div class="portlet-body">
                        <div class="row inbox">
                            <div class="col-md-3">
                                <ul class="inbox-nav margin-bottom-10">
                                    <li class="inbox active">
                                        <a href="javascript:;" class="btn" data-title="Inbox">
                                            All Messages (<?= $messages_count; ?>) </a>
                                        <b></b>
                                    </li>
                                    <li class="sent">
                                        <a class="btn" href="javascript:;" data-title="Sent">
                                            Sent </a>
                                        <b></b>
                                    </li>
                                    <li class="reservation">
                                        <a class="btn" href="javascript:;" data-title="Reservations">
                                            Reservations (<?= $ReservationCount; ?>) </a>
                                        <b></b>
                                    </li>
                                    <li class="archived">
                                        <a class="btn" href="javascript:;" data-title="Archived">
                                            Archived </a>
                                        <b></b>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-9">
                                <div class="inbox-header">
                                    <h1 class="pull-left">Inbox</h1>
                                </div>
                                <div class="inbox-loading">
                                    Loading...
                                </div>
                                <div class="inbox-content">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTAINER -->