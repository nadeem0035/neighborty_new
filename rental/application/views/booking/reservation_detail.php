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
            <div class="page-content" style="min-height:634px">           
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <h3 class="form-section"> Reservation Requests</h3>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="invoice">
                                    <?php if ($reservation) { ?>
                                        <div class="row invoiceTop">
                                            <div class="col-xs-8">
                                                <h3>Guest Details:</h3>
                                                <ul class="list-unstyled">
                                                    <li>
                                                        <span>First Name: </span> <?= $reservation->first_name; ?>
                                                    </li>
                                                    <li>
                                                        <span>Last Name:</span> <?= $reservation->last_name; ?>
                                                    </li>
                                                    <li>
                                                        <span>Profile:</span>  <a href="<?= site_url("users/show/" . $reservation->uid) ?>" target="_blank">View Profile </a>
                                                    </li>
                                                </ul>
                                                <h3>Guest's Message:</h3>
                                                <p><?= $reservation->message; ?></p>
                                            </div>
                                            <div class="col-xs-4 invoice-payment">
                                                <h3>Payment Details:</h3>
                                                <ul class="list-unstyled">
                                                    <li>
                                                        <span>Listing Name:</span> <?= $reservation->listing_name; ?>
                                                    </li>
                                                    <li>
                                                        <span>Check In:</span> <?= $reservation->check_in; ?>
                                                    </li>
                                                    <li>
                                                        <span>Check Out:</span> <?= $reservation->check_out; ?>
                                                    </li>
                                                    <li>
                                                        <span>Nights:</span> <?= $reservation->stay_nights; ?>
                                                    </li>
                                                    <li>
                                                        <span>Guests:</span> <?= $reservation->total_guest; ?>
                                                    </li>
                                                    <li>
                                                        <span>Charges:</span> <?= PkrFormat($reservation->listing_charges); ?>
                                                    </li>
                                                    <li>
                                                        <span>Status:</span> <?= $reservation->status; ?>
                                                    </li>
                                                    <li>
                                                        <span>Book Date:</span> <?= $reservation->book_date; ?>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END CONTAINER -->