<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-sidebar-closed-hide-logo">
    <!-- BEGIN HEADER -->
    <?php $this->load->view('dashboard/dashboard-header'); ?>
    <!-- END HEADER -->
    <div class="clearfix">
    </div>
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <div class="row">
            <div class="col-md-3">
                <!-- BEGIN TODO SIDEBAR -->
                <div class="todo-sidebar">
                    <div class="portlet light" style="background:#F5F5F5;">
                        <div class="portlet-title">
                            <div class="caption profilewrap">
                                <img class="img-circle user-avatar-fixed" src="<?= base_url() . $users_avatar . "medium/" . $user->picture; ?>">
                                <?php if ($edit_profile) { ?>
                                    <div style="font-size:16px; margin-top:10px; "><a href="<?= site_url("users/edit-profile"); ?>" class="btn btn-default">Edit Profile</a></div>    
                                <?php } ?>
                            </div>
                        </div>
                        <div class="portlet-body todo-project-list-content" aria-expanded="false" style="height: auto;">
                            <div class="todo-project-list">
                                <ul class="nav nav-pills nav-stacked">
                                    <li>
                                        <a href="javascript:;">
                                            <span class="badge badge-success"> 1 </span> &nbsp;Email Verified  <i class="icon-verified"></i></a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="badge badge-success"> 2 </span> &nbsp;Phone Number Verified <i class="icon-verified"></i></a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="badge badge-success"> 3 </span> &nbsp;Payment Method Verified <i class="icon-verified"></i></a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="badge badge-success"> 4 </span> &nbsp;Identity Verified <i class="icon-verified"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="todo-sidebar">
                    <div class="portlet light" style="background:#F5F5F5;">
                        <div class="portlet-title">
                            <div class="caption" style="text-align: center;">
                                <span class="caption-subject font-green-sharp bold uppercase">About Me</span>    
                            </div>
                        </div>
                        <div class="portlet-body todo-project-list-content" aria-expanded="false" style="height: auto;">
                            <div class="todo-project-list">
                                <ul class="nav nav-pills nav-stacked">
                                    <li>
                                        <span>Gender</span>
                                        <p><?= $user->gender; ?></p>
                                    </li>
                                    <li>
                                        <span>Languages</span>
                                        <p><?= $user->languages; ?></p>
                                    </li>
                                    <li>
                                        <span>Member since</span>
                                        <p><?= date("F j, Y", strtotime($user->registered_date)); ?></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="todo-sidebar">
                    <div class="portlet light" style="background:#F5F5F5;">
                        <div class="portlet-title">
                            <div class="caption" style="text-align: center;">
                                <span class="caption-subject font-green-sharp bold uppercase">Listings</span>    
                            </div>
                        </div>
                        <div class="portlet-body todo-project-list-content">
                            <div class="col-md-12">
                                <?php
                                if (isset($user_listings) && $user_listings != NULL) { ?>
                                <div class="scroller" style="position: relative; overflow: hidden; width: auto; height: 525px;">
                                 <?php  foreach ($user_listings as $user_listing) {
                                        ?>
                                        <div class="listing-image-box">
                                            <a href="<?= site_url("booking/detail/$user_listing->slug"); ?>"><img src="<?= base_url(); ?>assets/media/listings/search_thumbs/<?= $user_listing->preview_image_url; ?>" alt=""></a>
                                            <a href="<?= site_url("booking/detail/$user_listing->slug"); ?>">
                                                <div class="listing-img-heading">
                                                    <h2 class="listing-img-subheading"><?= $user_listing->listing_name; ?></h2>
                                                </div>
                                            </a>
                                        </div> 
                                        <?php
                                    } ?>
                                    </div>
                                    <?php
                                } else {
                                    echo "<h4>No Record found</h4>";
                                }
                                ?>
                                <div class="clear"></div> 
                            </div>
                        </div><div class="clear"></div> 
                    </div> 
                </div>
                <!-- END TODO SIDEBAR -->
            </div>
            <div class="col-md-9" style="height:100%; background:#FFF; border-radius:6px;">
                <!-- BEGIN TODO SIDEBAR -->
                <div class="todo-sidebar">
                    <div class="portlet light">
                        <div class="form-body">
                            <h1>Hey, I'm <?= $user->first_name . " " . $user->last_name; ?>! </h1>
                            <h4 style="font-weight:600;"><?php if(isset($user->city) && $user->city !=NULL){ echo $user->city.','; } ;?> <?php if(isset($user->state)  && $user->state !=NULL){ echo $user->state.',';} ?> <?= $user->country; ?></h4>
                            <div class="form-group"> <p><?= strip_tags($user->about) ?></p> </div>
                            <div class="form-group"> 
                                <span class="caption-subject font-black-sharp bold" style="font-size:26px;">Reviews </span>
                            </div>
                            <hr>  
                            <div class="form-group"><h3><span class="reviews-bolder">Reviews From Guests</span></h3> </div>
                            <div class="form-group" style="margin-left: 6%;margin-right: 6%;">  
                                <?php
                                if (isset($reviews_to) && $reviews_to != NULL) {
                                    foreach ($reviews_to as $review_to) {
                                        $rating = round($review_to->rating * 20, 2);
                                        ?>
                                        <!--Start form-group-->
                                        <div class="form-group formG-review">
                                            <h1 class="starRtitle"><a href='<?= site_url("booking/detail/$review_to->slug"); ?>' style="color:#333; font-weight:700"><?= ucfirst($review_to->listing_name); ?></a></h1>
                                            <div class="col-md-3 starR">
                                                <div class="row">
                                                    <div class="feedback-str">
                                                        <div class="star-ratings-sprite"><span style="width:<?= $rating ?>%" class="rating"></span></div>
                                                        <b><?= number_format($rating / 20, 1); ?></b>
                                                    </div>
                                                    <div class="feedback-str">
                                                        <div class="star-ratings-sprite"><span style="width:<?= ($review_to->accuracy) * 20; ?>%" class="rating"></span></div>
                                                        <b>Accuracy</b>
                                                    </div>
                                                    <div class="feedback-str">
                                                        <div class="star-ratings-sprite"><span style="width:<?= ($review_to->communication) * 20; ?>%" class="rating"></span></div>
                                                        <b>Communication</b>
                                                    </div>
                                                    <div class="feedback-str">
                                                        <div class="star-ratings-sprite"><span style="width:<?= ($review_to->cleanliness) * 20; ?>%" class="rating"></span></div>
                                                        <b>Cleanliness</b>
                                                    </div>
                                                    <div class="feedback-str">
                                                        <div class="star-ratings-sprite"><span style="width:<?= ($review_to->location) * 20; ?>%" class="rating"></span></div>
                                                        <b>Location</b>
                                                    </div>
                                                    <div class="feedback-str">
                                                        <div class="star-ratings-sprite"><span style="width:<?= ($review_to->check_in) * 20; ?>%" class="rating"></span></div>
                                                        <b>Check in</b>
                                                    </div>
                                                    <div class="feedback-str">
                                                        <div class="star-ratings-sprite"><span style="width:<?= ($review_to->value) * 20; ?>%" class="rating"></span></div>
                                                        <b>Value</b>
                                                    </div>
                                                </div><!--End Row-->
                                            </div><!--End Col-md-3-->
                                            <div class="col-md-9">
                                                <div class="guestName"><?= ucfirst($review_to->first_name) . " " . $review_to->last_name; ?></div>
                                                <div class="location">From:<span><?= $review_to->state_province . ", " . $review_to->country; ?></span></div>
                                                <div class="stay">Stayed:<span><?= date("F j, Y", strtotime($review_to->date_time)); ?></span></div>
                                                <div class="review-title"><?= strip_tags($review_to->title); ?></div>
                                                <div class="review-descr"><?= strip_tags($review_to->review); ?></div>
                                            </div>
                                        </div>
                                        <!--End form-group-->
                                        <hr class="review-hr"/>
                                        <?php
                                    }
                                } else {
                                    echo "<h3>No Record found</h3>";
                                }
                                ?>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group"><h3><span class="reviews-bolder">Reviews given by you</span></h3> </div>
                            <div class="form-group" style="margin-left: 6%;margin-right: 6%;">                                                  
                                <?php
                                if (isset($reviews_by) && $reviews_by != NULL) {
                                    foreach ($reviews_by as $review_by) {
                                        $rating = round($review_by->rating * 20, 2);
                                        ?>
                                        <!--Start form-group-->
                                        <div class="form-group formG-review">
                                            <h1 class="starRtitle"><a href='<?= site_url("booking/detail/$review_by->slug"); ?>' style="color:#333; font-weight:700"><?= ucfirst($review_by->listing_name); ?></a></h1>
                                            <div class="col-md-3 starR">
                                                <div class="row">
                                                    <div class="feedback-str">
                                                        <div class="star-ratings-sprite"><span style="width:<?= $rating ?>%" class="rating"></span></div>
                                                        <b><?= number_format($rating / 20, 1); ?></b>
                                                    </div>
                                                    <div class="feedback-str">
                                                        <div class="star-ratings-sprite"><span style="width:<?= ($review_by->accuracy) * 20; ?>%" class="rating"></span></div>
                                                        <b>Accuracy</b>
                                                    </div>
                                                    <div class="feedback-str">
                                                        <div class="star-ratings-sprite"><span style="width:<?= ($review_by->communication) * 20; ?>%" class="rating"></span></div>
                                                        <b>Communication</b>
                                                    </div>
                                                    <div class="feedback-str">
                                                        <div class="star-ratings-sprite"><span style="width:<?= ($review_by->cleanliness) * 20; ?>%" class="rating"></span></div>
                                                        <b>Cleanliness</b>
                                                    </div>
                                                    <div class="feedback-str">
                                                        <div class="star-ratings-sprite"><span style="width:<?= ($review_by->location) * 20; ?>%" class="rating"></span></div>
                                                        <b>Location</b>
                                                    </div>
                                                    <div class="feedback-str">
                                                        <div class="star-ratings-sprite"><span style="width:<?= ($review_by->check_in) * 20; ?>%" class="rating"></span></div>
                                                        <b>Check in</b>
                                                    </div>
                                                    <div class="feedback-str">
                                                        <div class="star-ratings-sprite"><span style="width:<?= ($review_by->value) * 20; ?>%" class="rating"></span></div>
                                                        <b>Value</b>
                                                    </div>
                                                </div><!--End Row-->
                                            </div><!--End Col-md-3-->
                                            <div class="col-md-9">
                                                <div class="guestName"><?= ucfirst($review_by->first_name) . " " . $review_by->last_name; ?></div>
                                                <div class="location">From:<span><?= $review_by->state_province . ", " . $review_by->country; ?></span></div>
                                                <div class="stay">Stayed:<span><?= date("F j, Y", strtotime($review_by->date_time)); ?></span></div>
                                                <div class="review-title"><?= strip_tags($review_by->title); ?></div>
                                                <div class="review-descr"><?= strip_tags($review_by->review); ?></div>
                                            </div>
                                        </div>
                                        <!--End form-group-->
                                        <hr class="review-hr"/>
                                        <?php
                                    }
                                } else {
                                    echo "<h3>No Record found</h3>";
                                }
                                ?>
                                <div class="clearfix"></div>
                            </div>      


<!--                             <div class="form-group"><h3><span class="reviews-bolder">References</span></h3> </div>
<div class="form-group" style="margin-left: 6%;margin-right: 6%;">                                                    
                            <?php
                            if (isset($references_to) && $references_to != NULL) {
                                foreach ($references_to as $reference_to) {
                                    ?>
                                                                <div class="col-md-12" >
                                                                <div class="col-md-2 text-center">
                                                                <img class="img-circle" width="100px" height="100px" src="<?= base_url() . $users_avatar . 'small/' . $reference_to->picture; ?>">
                                                                <h4><span class="reviews-bolder"><?= $reference_to->first_name . " " . $reference_to->last_name; ?></span></h4>
                                                                </div>
                                                                <div class="col-md-10">
                                                                <div class="review-detail"><?= strip_tags($reference_to->review); ?></div>
                                                                <span class="pull-left" style="color:#75571E; font-weight:700"> <?= date("F j, Y, g:i A", strtotime($reference_to->date_time)); ?></span></a>
                                                                <span class="pull-right" style="color:#333; font-weight:700"><?= $reference_to->relation; ?></span></a>
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
 -->
                        </div>    
                    </div>
                </div>
                <!-- END TODO SIDEBAR -->
            </div>
        </div>
    </div>
    <!-- END CONTAINER -->