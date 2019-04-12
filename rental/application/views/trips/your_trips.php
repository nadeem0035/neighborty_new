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
                        <h1>Trips <small>You have no current Trips</small></h1>
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
                                    <i class="fa fa-gift"></i>Trips
                                </div>

                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->


                                <div class="portlet light">
                                    <div class="portlet-body">
                                        <div class="row margin-bottom-30">
                                            <div class="col-md-12">
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.
                                                </p>

                                                <form class="form-horizontal" role="form">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Where are you going</label>
 
<div class="col-md-9">
                                                                <div class="input-group">
                                                                    <div>
                                                                  <input id="newpassword" class="form-control" name="place" placeholder="Type Here..." type="text">
                                                                    </div>
                                                                    <span class="input-group-btn">
<button class="btn btn-default" type="button"><i class="fa fa-arrow-left fa-fw"></i> Search</button>
</span>
                                                                </div>
                                                            </div> 
                                                            
                                                   </div>
                                                    </div> <!-- End Form Body -->
                                                </form>

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