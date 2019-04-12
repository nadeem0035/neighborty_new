<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-sidebar-closed-hide-logo">
    <?php $this->load->view('dashboard/dashboard-header'); ?>
    <div class="clearfix"></div>
    <div class="page-container">
        <?php $this->load->view('dashboard/dashboard-sidebar'); ?>
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
                                <?php if(isset($message)) { ?>
                                <div id="prefix_596580707996" class="Metronic-alerts  fade in">
                                    <?= $message ?>
                                </div>
                                <?php } ?>
                                <div class="invoice">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover">
                                                    <?php if ($reservations) { ?>
                                                        <thead class="flip-content">
                                                            <tr>
                                                                <th>
                                                                    Guest Name
                                                                </th>
                                                                <th>
                                                                    Listing Name
                                                                </th>
                                                                <th>
                                                                    Check In
                                                                </th>
                                                                <th>
                                                                    Check Out
                                                                </th>
                                                                <th>
                                                                    Guests
                                                                </th>
                                                                <th>
                                                                    Charges
                                                                </th>
                                                                <th>
                                                                    Book Date
                                                                </th>
                                                                <th>
                                                                    Status
                                                                </th>
                                                                <th>
                                                                    Action
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($reservations as $reservation) { ?>
                                                                <tr>
                                                                    <td>
                                                                        <?= ucfirst($reservation->first_name); ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= ucfirst(substr($reservation->listing_name, 0, 20)); ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= $reservation->check_in; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= $reservation->check_out; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= $reservation->total_guest; ?>
                                                                    </td>

                                                                    <td>
                                                                        $<?= $reservation->listing_charges; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= $reservation->book_date; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= ucfirst($reservation->status); ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php if ($reservation->status == 'pending') { ?>
                                                                            <a class="borderRightLink" id="<?=$reservation->id?>" onClick="ApproveModel(this.id)" data-toggle="modal">Approve</a>
                                                                            <a class="borderRightLink" href="<?= site_url("booking/reject/$reservation->id") ?>">Reject</a>
                                                                        <?php } ?>
                                                                        <a href="<?= site_url("booking/reservation-requests/$reservation->id") ?>">Detail View </a>
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
                                    </div>
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