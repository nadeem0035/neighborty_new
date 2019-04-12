<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$session_data = $this->session->userdata('logged_in');
$UserType = $session_data['user_type'];
?>
<!-- For bar chart only -->
<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
<!-- For bar chart only -->
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
                <!-- BEGIN PAGE HEAD -->
                <div class="page-head">
                    <!-- END PAGE TITLE -->
                    <div class="page-title">
                        <h1>Dashboard <small>statistics &amp; reports</small></h1>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-bar-chart theme-font-color hide"></i>
                                    <span class="caption-subject theme-font-color bold uppercase">Your Upcoming Trips</span>
                                </div>
                            </div>

                            <?php if (isset($upcomingtrips) && $upcomingtrips) { ?>
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 570px;">
                                    <?php foreach ($upcomingtrips as $upcomingtrip) {
                                        ?>
                                        <div class="row"> 
                                            <div class="col-md-4">
                                                <div class="portlet sale-summary">
                                                    <div class="portlet-body">
                                                        <div class="wishListGallery">
                                                            <div id="myCarousel<?= $upcomingtrip['bid']; ?>" class="carousel image-carousel slide">
                                                                <div class="carousel-inner">
                                                                    <?php
                                                                    if ($upcomingtrip['pictures']) {
                                                                        $i = 1;
                                                                        foreach ($upcomingtrip['pictures'] as $picture) {
                                                                            ?>
                                                                            <div class="item <?php
                                                                            if ($i) {
                                                                                echo 'active';
                                                                            }
                                                                            ?>">
                                                                                <img src="<?= base_url(); ?>assets/media/listings/listings/<?= $picture->picture; ?>" class="img-responsive" alt="">
                                                                            </div>
                                                                            <?php
                                                                            $i = 0;
                                                                        }
                                                                    }
                                                                    ?>

                                                                </div>
                                                                <a class="carousel-control left" href="#myCarousel<?= $upcomingtrip['bid']; ?>" data-slide="prev">
                                                                    <i class="m-icon-big-swapleft m-icon-white"></i>
                                                                </a>
                                                                <a class="carousel-control right" href="#myCarousel<?= $upcomingtrip['bid']; ?>" data-slide="next">
                                                                    <i class="m-icon-big-swapright m-icon-white"></i>
                                                                </a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <h4><a class="btn btn-default btn-sm" onclick="ContactHostDashboard(this.id)" id="<?= $upcomingtrip['bid']; ?>" data-toggle="modal">Contact Host</a> &nbsp; <?= ucwords($upcomingtrip['full_name']); ?></h4>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
  
                                                    <div class="col-md-7 profile-info">
                                                        <h3 class="tripsh1"><a href="<?=site_url("booking/detail/".$upcomingtrip['slug']);?>" target="_blank"><?= ucfirst($upcomingtrip['listing_name']); ?></a></h3>
                                                        <ul class="list-inline upcomingTrips">
                                                            <li>
                                                                <i class="fa fa-calendar"></i> <span class="bold">Check In:</span> <?= date('M d, Y', strtotime($upcomingtrip['check_in'])) ?> (11 AM)
                                                            </li>
                                                            <li>
                                                                <i class="fa fa-calendar"></i> <span class="bold">Check Out:</span> <?= date('M d, Y', strtotime($upcomingtrip['check_out'])) ?> (10 AM)
                                                            </li>
                                                        </ul>
                                                        <span class="bold">Key Exchange Details: </span>
                                                        <div class="keyExhangeInfo"></div>
                                                        <p><?= $upcomingtrip['key_exchange']; ?></p>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="mapscsettings">
                                                            <div id="map_<?= $upcomingtrip['bid'] ?>" style="height:200px;width:260px;"></div>
                                                        </div>
                                                    </div>

                                            </div>

                                            <div class="tripsline"></div>

                                        </div>

                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                            } else {
                                echo "No Record Found!";
                            }
                            ?>

                        </div>
                    </div>

                </div> 
                <!-- END PAGE HEAD -->
                <?php if ($UserType == 'Host') { ?>
                    <div class="row margin-top-10">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-green-sharp"><small class="font-green-sharp">$</small> <?php
                                            if (@$sales->balance > 0) {
                                                echo $sales->balance;
                                            } else {
                                                echo 0;
                                            }
                                            ?></h3>
                                        <small>Lifetime Revenue</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-pie-chart"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <a class="btn  btn-default btn-sm full-button" href="<?= site_url("users/transactions") ?>">View Transactions</a>    
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-green-sharp"><small class="font-green-sharp">$</small> <?= $month_revenue ?></h3>
                                        <small>Revenue THIS MONTH</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-pie-chart"></i>
                                    </div>
                                </div>
                                <div class="progress-info">

                                    <a class="btn  btn-default btn-sm full-button" href="<?= site_url("users/transactions") ?>">View Transactions</a>     

                                </div>
                            </div>
                        </div>                
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-green-sharp"><?= $totalWishlists ?></h3>
                                        <small>YOUR Wishlists</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-pie-chart"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <a class="btn  btn-default btn-sm full-button" href="<?= site_url("user-wishlists") ?>">View Wishlists</a>    
                                </div>
                            </div>
                        </div>                
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-red-haze"><?= @$count_reviews; ?></h3>
                                        <small>TOTAL REVIEWS</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-like"></i>
                                    </div>
                                </div>
                                <div class="progress-info">

                                    <a class="btn  btn-default btn-sm full-button" href="<?= site_url("reviews") ?>">View Reviews</a>    

                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="row">
                    <?php if (HavingReservationRequests($uid)) { ?>
                        <div class="col-md-6 col-sm-12">
                            <!-- BEGIN PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption caption-md">
                                        <i class="icon-bar-chart theme-font-color hide"></i>
                                        <span class="caption-subject theme-font-color bold uppercase">REVENUE Summary</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row list-separated">
                                        <div class="col-md-3 col-sm-3 col-xs-6">
                                            <div class="font-grey-mint font-sm">
                                                Total Sales
                                            </div>
                                            <div class="uppercase font-hg font-red-flamingo">
                                                <?= @$sales->credits ?> <span class="font-lg font-grey-mint">PKR</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-6">
                                            <div class="font-grey-mint font-sm">
                                                Revenue
                                            </div>
                                            <div class="uppercase font-hg theme-font-color">
                                                <?= @$sales->balance ?> <span class="font-lg font-grey-mint">PKR</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-6">
                                            <div class="font-grey-mint font-sm">
                                                Service fee
                                            </div>
                                            <div class="uppercase font-hg font-purple">
                                                <?= @$sales->debits ?><span class="font-lg font-grey-mint">PKR</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-6">
                                            <div class="font-grey-mint font-sm">
                                                Net Income
                                            </div>
                                            <div class="uppercase font-hg font-blue-sharp">
                                                <?= @$sales->balance ?><span class="font-lg font-grey-mint">PKR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="sales_statistics" class="portlet-body-morris-fit morris-chart" style="width:100%;">
                                        <?= $chart ?>
                                    </div>
                                </div>
                            </div>
                            <!-- END PORTLET-->
                        </div>
                    <?php } ?> 
                    <?php if (HavingTransactions($uid) && $UserType == 'Host') { ?>
                        <div class="col-md-6 col-sm-12">
                            <!-- BEGIN PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption caption-md">
                                        <i class="icon-bar-chart theme-font-color hide"></i>
                                        <span class="caption-subject theme-font-color bold uppercase">Listing Statistics</span>

                                    </div>

                                </div>
                                <div class="portlet-body">
                                    <div class="table-scrollable table-scrollable-borderless" style="min-height: 342px;">
                                        <table class="table table-hover table-light">
                                            <?php if (isset($BookingDetails) && $BookingDetails != NULL) { ?>
                                                <thead>
                                                    <tr class="uppercase">
                                                        <th colspan="2">
                                                            Guest
                                                        </th>
                                                        <th>
                                                            Amount
                                                        </th>
                                                        <th>
                                                            Listing Name
                                                        </th>
                                                        <th>
                                                            Date
                                                        </th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($BookingDetails as $BookingDetail) { ?>
                                                        <tr>
                                                            <td class="fit">
                                                                <img class="user-pic" src="<?= base_url(); ?><?= $users_avatar . "small/" . $BookingDetail->picture ?>">
                                                            </td>
                                                            <td>
                                                                <a href="javascript:;" class="primary-link"><?= $BookingDetail->first_name . " " . $BookingDetail->last_name; ?></a>
                                                            </td>
                                                            <td>
                                                                <?= PkrFormat($BookingDetail->listing_charges) ?>
                                                            </td>
                                                            <td>
                                                                <?= ucwords(substr($BookingDetail->listing_name, 0, 30)); ?>
                                                            </td>
                                                            <td>
                                                                <?= date('Y-m-d', strtotime($BookingDetail->book_date)); ?>
                                                            </td>

                                                        </tr>

                                                        <?php
                                                    }
                                                } else {
                                                    echo "No record Found";
                                                }
                                                ?>

                                            </tbody></table>
                                    </div>
                                </div>
                            </div>
                            <!-- END PORTLET-->
                        </div>
                    <?php } ?>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <!-- BEGIN PORTLET-->
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-bar-chart theme-font-color hide"></i>
                                    <span class="caption-subject theme-font-color bold uppercase">Recent Messages</span>
                                    <span class="caption-helper"><?= $messages_count; ?> pending</span>

                                </div>
                                <a href="<?= site_url("inbox") ?>" class="caption-sm pull-right padding10">View All</a> 
                            </div>
                            <div class="portlet-body">
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 305px;">
                                    <div class="general-item-list">
                                        <?php
                                        if ($recent_chats) {

                                            foreach ($recent_chats as $message) {
                                                ?>
                                                <div class="item">
                                                    <div class="item-head">
                                                        <div class="item-details">
                                                            <img class="item-pic" src='<?= base_url() . $users_avatar . "small/" . $message->picture; ?>' height="35px" width="35px">
                                                            <a href='<?= site_url("users/show/" . $message->uid) ?>' class="item-name primary-link"><?= $message->first_name . " " . $message->last_name; ?></a>
                                                            <span class="item-label"><?= relative_time($message->date_time); ?></span>
                                                        </div>
                                                        <span class="item-status"><span class="badge badge-empty badge-success"></span>
                                                            <?php
                                                            if ($message->read_status == 0) {
                                                                echo "New";
                                                                $class = 'newmsg';
                                                            } else {
                                                                echo "Read";
                                                                $class = '';
                                                            }
                                                            ?>
                                                        </span>
                                                    </div>
                                                    <div class="item-body <?= $class ?>">
                                                        <?= strip_tags($message->message); ?>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        } else {
                                            echo '<div class="item">No messages here</div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END PORTLET-->
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <!-- BEGIN PORTLET-->
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-bar-chart theme-font-color hide"></i>
                                    <span class="caption-subject theme-font-color bold uppercase">Recent Reviews</span>
                                    <span class="caption-helper"><?= $count_reviews; ?> Reviews</span>
                                </div>
                                <a href="<?= site_url("reviews") ?>" class="caption-sm pull-right padding10">View All</a> 
                            </div>
                            <div class="portlet-body">
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 305px;">
                                    <div class="general-item-list">
                                        <?php
                                        if (isset($reviews_to) && $reviews_to != NULL) {
                                            foreach ($reviews_to as $review_to) {
                                                $rating = round($review_to->rating * 20, 2);
                                                ?>
                                                <div class="item">
                                                    <div class="item-head">
                                                        <div class="item-details">
                                                            <img class="item-pic" src="<?= base_url() . $users_avatar . 'small/' . $review_to->picture; ?>" />
                                                            <a href="<?= site_url("users/show/" . $review_to->uid) ?>" class="item-name primary-link"><?= $review_to->first_name . " " . $review_to->last_name; ?></a>
                                                            <span class="item-label"><?= relative_time($review_to->date_time); ?></span>
                                                        </div>
                                                        <span class="item-status"><div class="star-ratings-sprite"><span style="width:<?= $rating ?>%" class="rating"></span></div></span>
                                                    </div>
                                                    <div class="item-body">
                                                        <?= strip_tags($review_to->review); ?>
                                                    </div>
                                                    <a href="<?= site_url("booking/detail/$review_to->slug"); ?>"><span class="pull-left"><?= $review_to->state_province . ", " . $review_to->country; ?></span></a>
                                                    <a href="<?= site_url("booking/detail/$review_to->slug"); ?>"><span class="pull-right"><?= $review_to->listing_name; ?></span></a>
                                                </div>
                                                <div class="clearfix"></div>
                                                <?php
                                            }
                                        } else {
                                            echo '<div class="item">No messages here</div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                 
            </div>
        </div>
    </div>

    <!-- END CONTAINER -->