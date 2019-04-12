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
                <!-- BEGIN PAGE HEAD -->
                <div class="page-head">
                    <!-- BEGIN PAGE TITLE -->
                    <div class="page-title">
                        <h1>Listings <small>All the recent listings have shown here</small></h1>
                    </div>
                    <!-- END PAGE TITLE -->
                </div>
                <!-- END PAGE HEAD -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- Start Body -->
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i> Manage your Listings  
                                </div>
                            </div>
                            <div id="display_notices">
                            </div>
                            <div style="display:none" class="Metronic-alerts notifications alert alert-success fade in">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                              <span>Your listing has been deleted successfully</span>
                          </div>
                          <div class="portlet-body">
                            <div class="row">
                                <?php  $count = count($publish_listings);if($count > 0){ ?>
                                <div class="col-md-12">
                                   <div class="col-md-12"><h2>Published Listings</h2><hr /></div>
                                   <?php
                                   $i = 1;
                                   foreach ($publish_listings as $user_listing) {
                                    $lid = $user_listing->id;
                                    $slug = $user_listing->slug;
                                    $rating = CalculateRating($lid)*20;
                                    ?>
                                    <div class="col-md-6 listing-item booking-results" id="booking_row_<?=$lid;?>">
                                        <div class="booking-result">
                                            <div class="booking-img col-md-6">
                                                <a href="<?= site_url("booking/detail/$slug"); ?>" target="_blank">
                                                    <img width="190px" src="<?= base_url(); ?>assets/media/listings/search_thumbs/<?= $user_listing->preview_image_url; ?>" alt="">
                                                </a>
                                                <a class="btn  btn-default btn-xs" href="<?= site_url("listings/edit/$lid"); ?>">Edit Listing</a>
                                                <a class="btn  btn-default btn-xs pull-right" href="<?= site_url("booking/detail/$slug"); ?>" target="_blank">View Listing</a>
                                            </div>
                                            <div class="booking-info col-md-6">
                                                <span>
                                                    <a class="listing-link" target="_blank" href="<?= site_url("booking/detail/$slug"); ?>"><?= character_limiter($user_listing->listing_name,25); ?></a>
                                                </span>
                                                <ul class="list-unstyled price-location">
                                                    <li><i class="fa fa-map-marker"></i> <?= $user_listing->full_address; ?></li>
                                                    <li><i class="fa fa-cog"></i> Status : <?= $user_listing->active; ?></li>
                                                    <li><i class="fa fa-money"></i> From : <?= PkrFormat($user_listing->price); ?></li>
                                                    <li><i class="fa fa-hand-o-right"></i> Action :<a style="color:#9d7f48" href="javascript:;" id="<?=$lid;?>" onclick="deleteListingByUser(this.id)">Delete Listing</a></li>
                                                </ul>
                                                <div class="star-ratings-sprite"><span style="width:<?= $rating ?>%" class="rating"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if ($i % 2 == 0) {
                                        echo "<div class='clear'></div>";
                                    }
                                    ?>
                                    <?php
                                    $i++;
                                } 
                                ?>  
                            </div>
                            <?php } ?>
                            <!-- Pending Listings -->
                            <?php  
                            $count = count($pending_listings);
                            if($count > 0){ ?>
                            <div class="col-md-12">
                               <div class="col-md-12"><h2>Pending Listings</h2><hr /></div>
                               <?php
                               $i = 1;
                               foreach ($pending_listings as $user_listing) {
                                $lid = $user_listing->id;
                                $slug = $user_listing->slug;
                                $rating = CalculateRating($lid)*20;
                                ?>
                                <div class="col-md-6 listing-item booking-results" id="booking_row_<?=$lid;?>">
                                    <div class="booking-result">
                                        <div class="booking-img col-md-6">
                                            <a href="<?= site_url("booking/detail/$slug"); ?>" target="_blank">
                                                <img width="190px" src="<?= base_url(); ?>assets/media/listings/search_thumbs/<?= $user_listing->preview_image_url; ?>" alt="">
                                            </a>
                                            <a class="btn  btn-default btn-xs" href="<?= site_url("listings/edit/$lid"); ?>">Edit Listing</a>
                                            <a class="btn  btn-default btn-xs pull-right" href="<?= site_url("booking/detail/$slug"); ?>" target="_blank">View Listing</a>
                                        </div>
                                        <div class="booking-info col-md-6">
                                            <span>
                                                <a class="listing-link" target="_blank" href="<?= site_url("booking/detail/$slug"); ?>"><?= character_limiter($user_listing->listing_name,25); ?></a>
                                            </span>
                                            <ul class="list-unstyled price-location">
                                                <li><i class="fa fa-map-marker"></i> <?= $user_listing->full_address; ?></li>
                                                <li><i class="fa fa-cog"></i> Status : <?= $user_listing->active; ?></li>
                                                <li><i class="fa fa-money"></i> From : <?= PkrFormat($user_listing->price); ?></li>
                                                <li><i class="fa fa-money"></i> Action :<a style="color:#9d7f48" href="javascript:;" id="<?=$lid;?>" onclick="deleteListingByUser(this.id)">Delete Listing</a></li>
                                            </ul>
                                            <div class="star-ratings-sprite"><span style="width:<?= $rating ?>%" class="rating"></span></div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if ($i % 2 == 0) {
                                    echo "<div class='clear'></div>";
                                }
                                ?>
                                <?php
                                $i++;
                            }  
                            ?>  
                        </div>
                        <?php } ?>
                        <!-- End Pending Listings-->
                        <!-- Review Listings-->
                        <?php   $count = count($review_listings); if($count > 0){ ?>
                        <div class="col-md-12">
                           <div class="col-md-12"><h2>Review Listings</h2><hr /></div>
                           <?php
                           $count = count($review_listings);
                           $i = 1;
                           foreach ($review_listings as $user_listing) {
                            $lid = $user_listing->id;
                            $slug = $user_listing->slug;
                            $rating = CalculateRating($lid)*20;
                            ?>
                            <div class="col-md-6 listing-item booking-results" id="booking_row_<?=$lid;?>">
                                <div class="booking-result">
                                    <div class="booking-img col-md-6">
                                        <a href="<?= site_url("booking/detail/$slug"); ?>" target="_blank">
                                            <img width="190px" src="<?= base_url(); ?>assets/media/listings/search_thumbs/<?= $user_listing->preview_image_url; ?>" alt="">
                                        </a>
                                        <a class="btn  btn-default btn-xs" href="<?= site_url("listings/edit/$lid"); ?>">Edit Listing</a>
                                        <a class="btn  btn-default btn-xs pull-right" href="<?= site_url("booking/detail/$slug"); ?>" target="_blank">View Listing</a>
                                    </div>
                                    <div class="booking-info col-md-6">
                                        <span>
                                            <a class="listing-link" target="_blank" href="<?= site_url("booking/detail/$slug"); ?>"><?= character_limiter($user_listing->listing_name,25); ?></a>
                                        </span>
                                        <ul class="list-unstyled price-location">
                                            <li><i class="fa fa-map-marker"></i> <?= $user_listing->full_address; ?></li>
                                            <li><i class="fa fa-cog"></i> Status : <?= $user_listing->active; ?></li>
                                            <li><i class="fa fa-money"></i> From : <?= PkrFormat($user_listing->price); ?></li>
                                            <li><i class="fa fa-money"></i> Action :<a style="color:#9d7f48" href="javascript:;" id="<?=$lid;?>" onclick="deleteListingByUser(this.id)">Delete Listing</a></li>
                                        </ul>
                                        <div class="star-ratings-sprite"><span style="width:<?= $rating ?>%" class="rating"></span></div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if ($i % 2 == 0) {
                                echo "<div class='clear'></div>";
                            }
                            ?>
                            <?php
                            $i++;
                        } 
                        ?>  
                    </div>
                    <?php } ?>
                    <!-- End Review Listings-->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Body -->
</div>
</div>
</div>
    <!-- END CONTAINER -->