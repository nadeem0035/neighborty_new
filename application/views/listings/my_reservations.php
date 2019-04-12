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
                                    <i class="fa fa-gift"></i>My Reservations
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row">

                                    <div class="col-md-12">

                                        <?php if ($detailview) { ?>
                                            <div class="invoice">
                                                <?php if ($MyReservation) { ?>
                                                    <div class="row invoiceTop">
                                                        <div class="col-xs-8">
                                                            <h3>Guest Details:</h3>
                                                            <ul class="list-unstyled">
                                                                <li>
                                                                    <span>First Name: </span> <?= $MyReservation->first_name; ?>
                                                                </li>
                                                                <li>
                                                                    <span>Last Name:</span> <?= $MyReservation->last_name; ?>
                                                                </li>
                                                                <li>
                                                                    <span>Profile:</span>  <a href="<?= site_url("users/show/" . $MyReservation->uid) ?>" target="_blank">View Profile </a>
                                                                </li>
                                                            </ul>
                                                            <h3>Guest's Message:</h3>
                                                            <p><?= $MyReservation->message; ?></p>


                                                        </div>
                                                        <div class="col-xs-4 invoice-payment">
                                                            <h3>Payment Details:</h3>
                                                            <ul class="list-unstyled">
                                                                <li>
                                                                    <span>Listing Name:</span> <a href="<?= site_url("booking/detail/$MyReservation->slug"); ?>" target="_blank"><?= $MyReservation->listing_name; ?></a>
                                                                </li>
                                                                <li>
                                                                    <span>Check In:</span> <?= $MyReservation->check_in; ?>
                                                                </li>
                                                                <li>
                                                                    <span>Check Out:</span> <?= $MyReservation->check_out; ?>
                                                                </li>
                                                                <li>
                                                                    <span>Nights:</span> <?= $MyReservation->stay_nights; ?>
                                                                </li>
                                                                <li>
                                                                    <span>Guests:</span> <?= $MyReservation->total_guest; ?>
                                                                </li>
                                                                <li>
                                                                    <span>Charges:</span> $<?= $MyReservation->listing_charges; ?>
                                                                </li>
                                                                <li>
                                                                    <span>Status:</span> <?= $MyReservation->status; ?>
                                                                </li>
                                                                <li>
                                                                    <span>Book Date:</span> <?= $MyReservation->book_date; ?>
                                                                </li>
                                                            </ul>
                                                        </div>


                                                    </div>
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
                                                                                <?php if ($MyReservations) { ?>
                                                                                    <thead class="flip-content">
                                                                                        <tr>
                                                                                            <th>
                                                                                                Guest Name
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
                                                                                                View
                                                                                            </th>

                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <?php foreach ($MyReservations as $myreservation) { ?>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <a href="<?= site_url("users/show/$myreservation->uid"); ?>" target="_blank"><?= ucwords($myreservation->first_name) ?></a>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <a href="<?= site_url("booking/detail/$myreservation->slug"); ?>" target="_blank"><?= ucwords(substr($myreservation->listing_name, 0, 30)); ?></a>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <?= $myreservation->check_in; ?>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <?= $myreservation->check_out; ?>
                                                                                                </td>
                                                                                                <td>
                                                                                                    $<?= $myreservation->total_charges; ?>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <?= ucwords($myreservation->status); ?>
                                                                                                </td>

                                                                                                <td>
                                                                                                    <?= date('Y-m-d', strtotime($myreservation->book_date)); ?>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <a href="<?= site_url("listings/my-reservations/$myreservation->id") ?>">View </a>
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