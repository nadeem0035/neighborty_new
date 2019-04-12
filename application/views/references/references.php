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
                    <div class="page-title">
                        <h1>Reviews <small>All the reviews have shown here</small></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN VALIDATION STATES-->

                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    References
                                </div>

                            </div>
                            <div class="portlet-body">
                                <div class="tabbable tabs-left">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_6_1" data-toggle="tab" aria-expanded="true">
                                                References About You</a>
                                        </li>
                                        <li class="">
                                            <a href="#tab_6_2" data-toggle="tab" aria-expanded="false">
                                                References By You </a>
                                        </li>

                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active in" id="tab_6_1">
                                            <div class="portlet-body form">
                                                <div class="form-body">
                                                    <div class="form-group">													
                                                        <?php
                                                        if (isset($references_to) && $references_to != NULL) {

                                                            foreach ($references_to as $reference_to) {
                                                                ?>
                                                                <div class="col-md-12" >
                                                                    <div class="col-md-2 text-center">

                                                                        <img class="img-circle" width="100px" height="100px" src="<?= base_url() . $users_avatar .'small/'. $reference_to->picture; ?>">
                                                                        <h4><span><?= $reference_to->first_name . " " . $reference_to->last_name; ?></span></h4>

                                                                    </div>

                                                                    <div class="col-md-10">

                                                                        <div class="review-detail"><?= strip_tags($reference_to->review) ?></div>

                                                                        <span class="pull-left ref-dates"> <?= date("F j, Y, g:i A",  strtotime($reference_to->date_time));?></span></a>

                                                                        <span class="pull-right ref-relation"><?= $reference_to->relation; ?></span></a>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <hr>
                                                                </div>
                                                                <div class="clearfix"></div>

                                                                <?php
                                                            }
                                                        } else {
                                                            echo "<h3>No Record found</h3>";
                                                        }
                                                        ?>
                                                        <div class="clearfix"></div>
                                                    </div>                                                                                     		                                                           
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab_6_2">
                                            <div class="portlet-body form">
                                                <div class="form-body">
                                                    <div class="form-group">													
                                                        <?php
                                                        if (isset($references_by) && $references_by != NULL) {

                                                            foreach ($references_by as $reference_by) {
                                                                ?>
                                                                <div class="col-md-12" >
                                                                    <div class="col-md-2 text-center">

                                                                        <img class="img-circle" width="100px" height="100px" src="<?= base_url() . $users_avatar .'small/'. $reference_by->picture; ?>">
                                                                        <h4><span><?= $reference_by->first_name . " " . $reference_by->last_name; ?></span></h4>

                                                                    </div>

                                                                    <div class="col-md-10">

                                                                        <div class="review-detail"><?= strip_tags($reference_by->review); ?></div>

                                                                        <span class="pull-left" style="color:#75571E; font-weight:700"> <?= date("F j, Y, g:i A",  strtotime($reference_by->date_time));?></span></a>

                                                                        <span class="pull-right" style="color:#333; font-weight:700"><?= $reference_by->relation; ?></span></a>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <hr>
                                                                </div>
                                                                <div class="clearfix"></div>

                                                                <?php
                                                            }
                                                        } else {
                                                            echo "<h3>No Record found</h3>";
                                                        }
                                                        ?>
                                                        <div class="clearfix"></div>
                                                    </div>     
                                                </div>

                                            </div>	

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- END VALIDATION STATES-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTAINER -->