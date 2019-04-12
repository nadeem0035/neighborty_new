<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<body>
    <?php $this->load->view('dashboard/dashboard-header'); ?>
    <!--start section page body-->
    <section id="section-body">
        <div class="container">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-left">
                            <h1 class="title-head">Welcome back, <?=$_SESSION['logged_in']['full_name']?></h1>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb"><li><a href="#"><i class="fa fa-home"></i></a></li><li class="active"><?=$this->lang->line('notifications_hd');?></li></ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="user-dashboard-full">
                <?php $this->load->view('dashboard/dashboard-sidebar'); ?>
                <div class="profile-area-content">
                    <div class="profile-top">
                        <h2 class="title"><?=$this->lang->line('notifications_hd');?></h2>
                    </div>

                    <div class="my-property">


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
                                            echo "<div class='article-detail text-center'><h1> No Notifications Yet. </h1></div>";
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>


                    </div>

                </div>
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
