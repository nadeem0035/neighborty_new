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
                                    Reviews
                                </div>

                            </div>
                            <div class="portlet-body">
                                <div class="tabbable tabs-left">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_6_1" data-toggle="tab" aria-expanded="true">
                                                Reviews About You</a>
                                        </li>
                                        <li class="">
                                            <a href="#tab_6_2" data-toggle="tab" aria-expanded="false">
                                                Reviews By You </a>
                                        </li>

                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active in" id="tab_6_1">
                                            <div class="portlet-body form">
                                                <div class="form-body">
                                                    <div class="form-group">													
                                                        <?php
                                                        if (isset($reviews_to) && $reviews_to != NULL) {

                                                            foreach ($reviews_to as $review_to) {
                                                                $rating = round($review_to->rating * 20, 2);
                                                                ?>
                                                                <div class="col-md-12" >
                                                                    <div class="col-md-2 text-center">

                                                                        <img class="img-circle" width="100px" height="100px" src="<?= base_url() . $users_avatar .'small/'. $review_to->picture; ?>">
                                                                        <h4><span><?= $review_to->first_name . " " . $review_to->last_name; ?></span></h4>

                                                                        <div class="feedback-str">
                                                                            <div class="star-ratings-sprite"><span style="width:<?= $rating ?>%" class="rating"></span></div>
                                                                        </div>

                                                                    </div>

                                                                    <div class="col-md-10">
                                                                        
                                                                        <h3 class="subreview-title"><?= strip_tags($review_to->title); ?></h3>

                                                                        <div class="review-detail"><?= strip_tags($review_to->review); ?></div>

                                                                        <a href="<?= site_url("booking/detail/$review_to->slug"); ?>"><span class="pull-left" style="color:#75571E; font-weight:700">From: <?= $review_to->state_province . ", " . $review_to->country; ?>  -  <?= date("F j, Y, g:i A",  strtotime($review_to->date_time));?></span></a>

                                                                        <a href="<?= site_url("booking/detail/$review_to->slug"); ?>"><span class="pull-right" style="color:#333; font-weight:700"><?= $review_to->listing_name; ?></span></a>
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
                                                        if (isset($reviews_by) && $reviews_by != NULL) {

                                                            foreach ($reviews_by as $review_by) {
                                                                $rating = round($review_by->rating * 20, 2);
                                                                ?>
                                                                <div class="col-md-12" >
                                                                    <div class="col-md-2 text-center">

                                                                        <img class="img-circle" width="100px" height="100px" src="<?= base_url() . $users_avatar .'small/'. $review_by->picture; ?>">
                                                                        <h4><span><?= $review_by->first_name . " " . $review_by->last_name; ?></span></h4>

                                                                        <div class="feedback-str">
                                                                            <div class="star-ratings-sprite"><span style="width:<?= $rating ?>%" class="rating"></span></div>
                                                                        </div>

                                                                    </div>

                                                                    <div class="col-md-10">
                                                                        
                                                                        <h3 class="subreview-title"><?= strip_tags($review_by->title); ?></h3>

                                                                        <div class="review-detail"><?= strip_tags($review_by->review); ?></div>

                                                                        <a href="<?= site_url("booking/detail/$review_by->slug"); ?>"><span class="pull-left" style="color:#75571E; font-weight:700">From: <?= $review_by->state_province . ", " . $review_by->country; ?>  -  <?= date("F j, Y, g:i A",  strtotime($review_by->date_time));?></span></a>

                                                                        <a href="<?= site_url("booking/detail/$review_by->slug"); ?>"><span class="pull-right" style="color:#333; font-weight:700"><?= $review_by->listing_name; ?></span></a>
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