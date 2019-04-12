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
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box blue calendar">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>My Trips
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row">

                                    <div class="col-md-12">

                                        <?php if ($detailview) { ?>
                                            <div class="invoice">
                                                <?php if ($MyTrip) { ?>
                                                    <div class="row invoiceTop">
                                                        <div class="col-xs-8">
                                                            <h3>Host Details:</h3>
                                                            <ul class="list-unstyled">
                                                                <li>
                                                                    <span>First Name: </span> <?= $MyTrip->first_name; ?>
                                                                </li>
                                                                <li>
                                                                    <span>Last Name:</span> <?= $MyTrip->last_name; ?>
                                                                </li>
                                                                <li>
                                                                    <span>Profile:</span>  <a href="<?= site_url("users/show/" . $MyTrip->uid) ?>" target="_blank">View Profile </a>
                                                                </li>
                                                            </ul>
                                                            <h3>Host's Message:</h3>
                                                            <p><?= $MyTrip->key_exchange; ?></p>


                                                        </div>
                                                        <div class="col-xs-4 invoice-payment">
                                                            <h3>Payment Details:</h3>
                                                            <ul class="list-unstyled">
                                                                <li>
                                                                    <span>Listing Name:</span> <a href="<?= site_url("booking/detail/$MyTrip->slug"); ?>" target="_blank"><?= $MyTrip->listing_name; ?></a>
                                                                </li>
                                                                <li>
                                                                    <span>Check In:</span> <?= $MyTrip->check_in; ?>
                                                                </li>
                                                                <li>
                                                                    <span>Check Out:</span> <?= $MyTrip->check_out; ?>
                                                                </li>
                                                                <li>
                                                                    <span>Nights:</span> <?= $MyTrip->stay_nights; ?>
                                                                </li>
                                                                <li>
                                                                    <span>Guests:</span> <?= $MyTrip->total_guest; ?>
                                                                </li>
                                                                <li>
                                                                    <span>Charges:</span> $<?= $MyTrip->listing_charges; ?>
                                                                </li>
                                                                <li>
                                                                    <span>Status:</span> <?= $MyTrip->status; ?>
                                                                </li>
                                                                <li>
                                                                    <span>Book Date:</span> <?= $MyTrip->book_date; ?>
                                                                </li>
                                                            </ul>
                                                        </div>


                                                    </div>

                                                    <?php if ($MyTrip->status == 'leave_feedback') { ?>
                                                        <div class="col-md-8">
                                                            <h3 class="reviews-area-sub">Write a review for Host</h3>

                                                            <div class="reviewssection">

                                                                <div class="portlet-body form">
                                                                    <div class="form-body">
                                                                        <div class="form-group">             
                                                                            <div class="portlet-body form">
                                                                                <div class="responsemessage"></div>
                                                                                <!-- BEGIN FORM-->
                                                                                <form id="AddReviews" name="AddReviews" class="form-horizontal">
                                                                                    <div class="form-body">
                                                                                        <div class="form-group">
                                                                                            <label class="col-md-3">Write Your Title</label>
                                                                                            <div class="col-md-8">
                                                                                                <input type="text" name="reviews[title]" class="form-control" id="rtitle">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label class="col-md-3">Your Message</label>
                                                                                            <div class="col-md-8">
                                                                                                <textarea class="form-control" name="reviews[review]" rows="5"></textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                        <input type="hidden" name="reviews[reviews_to]" value="<?= $MyTrip->uid ?>" />
                                                                                        <input type="hidden" name="reviews[listing_id]" value="<?= $MyTrip->lid ?>" />
                                                                                        <input type="hidden" name="reviews[booking_id]" value="<?= $MyTrip->id ?>" />
                                                                                        <div class="form-group rateCategory">
                                                                                            <div class="col-md-6">
                                                                                                <div class="col-md-5">
                                                                                                    <label>Accuracy</label>
                                                                                                </div>  
                                                                                                <div class="col-md-7">
                                                                                                    <div class="feedback-str">
                                                                                                        <div id="Accuracy"></div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <div class="col-md-5">
                                                                                                    <label>Communication</label>
                                                                                                </div>  
                                                                                                <div class="col-md-7">
                                                                                                    <div class="feedback-str">
                                                                                                        <div id="Communication"></div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <div class="col-md-5">
                                                                                                    <label>Cleanliness</label>
                                                                                                </div>  
                                                                                                <div class="col-md-7">
                                                                                                    <div class="feedback-str">
                                                                                                        <div id="Cleanliness"></div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <div class="col-md-5">
                                                                                                    <label>Location</label>
                                                                                                </div>  
                                                                                                <div class="col-md-7">
                                                                                                    <div class="feedback-str">
                                                                                                        <div id="Location"></div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <div class="col-md-5">
                                                                                                    <label>Check-in</label>
                                                                                                </div>  
                                                                                                <div class="col-md-7">
                                                                                                    <div class="feedback-str">
                                                                                                        <div id="check_in"></span></div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <div class="col-md-5">
                                                                                                    <label>Value</label>
                                                                                                </div>  
                                                                                                <div class="col-md-7">
                                                                                                    <div class="feedback-str">
                                                                                                        <div id="Value"></span></div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>    
                                                                                        <div class="form-actions">
                                                                                            <button type="button" onclick="add_reviews();" class="btn btn-default">Submit Review</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                                <!-- END FORM-->
                                                                            </div>                                                        
                                                                            <div class="clearfix"></div>
                                                                        </div>                                                                                                                                                  
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    <?php } ?>
                                                    <?php
                                                } else {
                                                    echo "<h2>No record found</h2>";
                                                }
                                                ?>
                                            </div>
                                        <?php } else { ?>

                                            <div class="tabbable tabs-left">
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a href="#tab_6_1" data-toggle="tab" aria-expanded="true">
                                                            Calendar View</a>
                                                    </li>
                                                    <li class="">
                                                        <a href="#tab_6_2" data-toggle="tab" aria-expanded="false">
                                                            List view </a>
                                                    </li>

                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active in" id="tab_6_1">
                                                        <div class="portlet-body form">
                                                            <div class="form-body">
                                                                <div class="form-group">													

                                                                    <div class="has-toolbar fc fc-ltr fc-unthemed" id="calendar">
                                                                    </div>                                                  
                                                                    <div class="clearfix"></div>
                                                                </div>                                                                                     		                                                           
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="tab_6_2">
                                                        <div class="portlet-body form">
                                                            <div class="form-body">
                                                                <div class="form-group">													
                                                                    <div class="col-xs-12">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped table-hover">
                                                                                <?php if ($MyTrips) { ?>
                                                                                    <thead class="flip-content">
                                                                                        <tr>
                                                                                            <th>
                                                                                                Host Name
                                                                                            </th>
                                                                                            <th>
                                                                                                Listing name
                                                                                            </th>
                                                                                            <th>
                                                                                                Check In
                                                                                            </th>
                                                                                            <th>
                                                                                                Check Out
                                                                                            </th>
                                                                                            <th>
                                                                                                Charges
                                                                                            </th>
                                                                                            <th>
                                                                                                Status
                                                                                            </th>

                                                                                            <th>
                                                                                                Booking
                                                                                            </th>

                                                                                            <th>
                                                                                                Action
                                                                                            </th>

                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <?php foreach ($MyTrips as $MyTrip) { ?>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <a href="<?= site_url("users/show/$MyTrip->uid"); ?>" target="_blank"><?= ucwords($MyTrip->first_name) ?></a>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <a href="<?= site_url("booking/detail/$MyTrip->slug"); ?>" target="_blank"><?= ucwords(substr($MyTrip->listing_name, 0, 30)); ?></a>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <?= $MyTrip->check_in; ?>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <?= $MyTrip->check_out; ?>
                                                                                                </td>
                                                                                                <td>
                                                                                                    $<?= $MyTrip->total_charges; ?>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <?= ucwords($MyTrip->status); ?>
                                                                                                </td>

                                                                                                <td>
                                                                                                    <?= date('Y-m-d', strtotime($MyTrip->book_date)); ?>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <?php if ($MyTrip->status == 'leave_feedback') { ?>
                                                                                                        <a class="borderRightLink" href="<?= site_url("listings/my-trips/$MyTrip->id") ?>">Leave Feedback</a>

                                                                                                    <?php } ?>
                                                                                                    <a href="<?= site_url("listings/my-trips/$MyTrip->id") ?>">Detail View </a>
                                                                                                </td>

                                                                                            </tr>
                                                                                            <?php
                                                                                        }
                                                                                    } else {
                                                                                        echo "<h2> No record found</h2>";
                                                                                    }
                                                                                    ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>                                                    
                                                                    <div class="clearfix"></div>
                                                                </div>     
                                                            </div>

                                                        </div>	

                                                    </div>

                                                </div>
                                            </div>

                                        <?php } ?>

                                    </div>

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