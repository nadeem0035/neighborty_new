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
                        <!-- BEGIN VALIDATION STATES-->
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <h3 class="form-section">Notifications</h3>
                                </div>
                            </div>
                            <div class="invoice">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <?php if ($notifications) { ?>
                                                    <thead class="flip-content">
                                                        <tr>
                                                            <th>
                                                                ID
                                                            </th>
                                                            <th>
                                                                Notification
                                                            </th>
                                                            <th>
                                                                Status
                                                            </th>
                                                            <th>
                                                                Date
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i = 1;
                                                        foreach ($notifications as $notification) {
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <?= $i ?>
                                                                </td>
                                                                <td>
                                                                    <?= ucfirst($notification->notification); ?>
                                                                </td>
                                                                <td>
                                                                    Read
                                                                </td>
                                                                <td>
                                                                    <?= relative_time($notification->date_time); ?>
                                                                </td>

                                                            </tr>
                                                            <?php
                                                            $i++;
                                                        }
                                                    } else {
                                                        echo "<h2> No Notification here</h2>";
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