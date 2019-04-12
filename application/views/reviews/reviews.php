<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<body>
    <?php $this->load->view('dashboard/dashboard-header'); ?>

    <section id="section-body">
        <div class="container">

            <!--user-dashboard-full-->
            <?php $this->load->view('dashboard/dashboard-sidebar'); ?>
            <div class="profile-area-content">
                <div class="profile-top">
                    <div class="profile-top-left">
                        <h2 class="title">Reviews <small>All the reviews have shown here</small></h2>
                    </div>
                </div>

                <div class="account-block">
                    <div class="saved-search-list">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_6_1" data-toggle="tab" aria-expanded="true">Reviews About You</a></li>
                            <li class=""><a href="#tab_6_2" data-toggle="tab" aria-expanded="false">Reviews By You </a></li>
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
                                                    <div class="saved-search-block">
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <img class="img-circle" width="100px" height="100px" src="<?= base_url() . $users_avatar .'small/'. $review_to->picture; ?>">
                                                            </div>
                                                            <div class="col-sm-10">
                                                                <div class="item-status pull-right"><div class="star-ratings-sprite"><span style="width:<?= $rating ?>%" class="rating"></span></div></div>
                                                                <h4 class="my-heading"><span><?= $review_to->first_name . " " . $review_to->last_name; ?></span></h4>
                                                                <!--<h5 class="subreview-title"><?/*= strip_tags($review_to->title); */?></h5>-->
                                                                <div class="review-detail"><?= strip_tags($review_to->review); ?></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <?php
                                                }
                                            } else {
                                                echo "<div class='article-detail text-center'><h1>Oh oh! Record not found.</h1></div>";
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
                                                    <div class="saved-search-block">
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <img class="img-circle" width="100px" height="100px" src="<?= base_url() . $users_avatar .'small/'. $review_by->picture; ?>">
                                                            </div>
                                                            <div class="col-md-10">
                                                                <div class="item-status pull-right"><div class="star-ratings-sprite"><span style="width:<?= $rating ?>%" class="rating"></span></div></div>
                                                                <h4><span><?= $review_by->first_name . " " . $review_by->last_name; ?></span></h4>
                                                                <!--<h5 class="subreview-title"><?/*= strip_tags($review_by->title); */?></h5>-->
                                                                <div class="review-detail"><?= strip_tags($review_by->review); ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            } else {
                                                echo "<div class='article-detail text-center'><h1>Oh oh! Record not found.</h1></div>";
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
        </div>
    </section>