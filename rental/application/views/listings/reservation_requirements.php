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
                        <h1>Reservation Requirements <small>You can view your reservation requirements here</small></h1>
                    </div>
                    <!-- END PAGE TITLE -->
                    <!-- BEGIN PAGE TOOLBAR -->


                    <!-- END PAGE HEAD -->
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN VALIDATION STATES-->
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Reservation Requirements
                                </div>

                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->


                                <div class="portlet light">
                                    <div class="portlet-body">
                                        <div class="row margin-bottom-30">
                                            <div class="col-md-6">
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.
                                                </p>
                                                <ul class="list-unstyled margin-top-10 margin-bottom-10">
                                                    <li>
                                                        <i class="fa fa-check icon-default"></i> Nam liber tempor cum soluta
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-check icon-success"></i> Mirum est notare quam
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-check icon-info"></i> Lorem ipsum dolor sit amet
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-check icon-danger"></i> Mirum est notare quam
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-check icon-warning"></i> Mirum est notare quam
                                                    </li>
                                                </ul>
                                                <!-- Blockquotes -->
                                                <blockquote class="hero">
                                                    <p>
                                                        Lorem ipsum dolor sit amet, consectetuer sed diam nonummy nibh euismod tincidunt.
                                                    </p>
                                                    <small>Bob Nilson</small>
                                                </blockquote>
                                            </div>
                                            <div class="col-md-6">
                                                <iframe src="http://player.vimeo.com/video/22439234" style="width:100%; height:327px;border:0" allowfullscreen="">
                                                </iframe>
                                            </div>
                                        </div>
                                        <!--/row-->

                                    </div>
                                </div>


                                <!-- END FORM-->
                            </div>
                        </div>
                        <!-- END VALIDATION STATES-->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END CONTAINER -->