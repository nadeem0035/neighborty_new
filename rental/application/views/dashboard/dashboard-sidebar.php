<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$session_data = $this->session->userdata('logged_in');
$uid = $session_data['id'];
$UserType = $session_data['user_type'];
?>

<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->

        <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="start <?php
            if (site_url("dashboard") == current_url()) {
                echo "active";
            }
            ?>">
                <a href="<?= site_url("dashboard") ?>">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class=" <?php
            if (site_url("inbox") == current_url()) {
                echo "active";
            }
            ?>">
                <a href="<?= site_url("inbox"); ?>">
                    <i class="icon-envelope"></i>
                    <span class="title">Inbox</span>
                </a>

            </li>
            <li class=" <?php
            if ($this->uri->segment(1) == 'user-wishlists' || $this->uri->segment(1) == 'user-wishlist') {
                echo "active";
            }
            ?>">
                <a href="<?= site_url("user-wishlists") ?>">
                    <i class="icon-heart"></i>
                    <span class="title">Wishlist</span>
                </a>
            </li>
            <?php if (HavingMyTrips($uid)) { ?>
                <li class=" <?php
                if ($this->uri->segment(2) == 'my-trips') {
                    echo "active";
                }
                ?>">
                    <a href="<?= site_url("listings/my-trips") ?>">
                        <i class="icon-calendar"></i>
                        <span class="title">My Trips</span>
                    </a>

                </li>
            <?php } ?>
                
            <?php if ($UserType == 'Host') { ?>
                <li class=" <?php
                if ($this->uri->segment(2) == 'my-reservations') {
                    echo "active";
                }
                ?>">
                    <a href="<?= site_url("listings/my-reservations") ?>">
                        <i class="icon-calendar"></i>
                        <span class="title">My Reservations</span>
                    </a>

                </li>
            <?php } ?>
            <?php if (HavingListings($uid)) { ?>
                <li>
                    <a href="javascript:;">
                        <i class="icon-bar-chart"></i>
                        <span class="title">My Listings</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">

                        <li class=" <?php
                        if (site_url("listings") == current_url()) {
                            echo "active";
                        }
                        ?>">
                            <a href="<?= site_url("listings"); ?>">
                                My Listings</a>
                        </li>

                        <?php //if (HavingReservationRequests($uid)) { ?>
                            <li class=" <?php
                            if (site_url("booking/reservation-requests") == current_url()) {
                                echo "active";
                            }
                            ?>">
                                <a href="<?= site_url("booking/reservation-requests") ?>">
                                    Reservation Requests</a>
                            </li>
                        <?php //} ?>
                        <!--  
                       <li class=" <?php
                        if (site_url("listings/your-reservations") == current_url()) {
                            echo "active";
                        }
                        ?>">
                           <a href="<?= site_url("listings/your-reservations") ?>">
                               Your Reservations</a>
                       </li>
                                        <li class=" <?php
                        if (site_url("listings/requirements") == current_url()) {
                            echo "active";
                        }
                        ?>">
                                               <a href="<?= site_url("listings/requirements") ?>">
                                                   Reservation Requirements</a>
                                           </li>-->


                    </ul>
                </li>
            <?php } ?>

            <!--            <li>
                            <a href="javascript:;">
                                <i class="icon-diamond"></i>
                                <span class="title">Your Trips</span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu">
                                <li class=" <?php
            if (site_url("trips/present") == current_url()) {
                echo "active";
            }
            ?>">
                                    <a href="<?= site_url("trips/present") ?>">
                                        Your Trips</a>
                                </li>
            
                                <li class=" <?php
            if (site_url("trips/previous") == current_url()) {
                echo "active";
            }
            ?>">
                                    <a href="<?= site_url("trips/previous") ?>">
                                        Previous Trips</a>
                                </li>
            
                            </ul>
                        </li>-->
            <li>
                <a href="javascript:;">
                    <i class="icon-user"></i>
                    <span class="title">Profile</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li class="<?php
                    if (site_url("users/edit-profile") == current_url()) {
                        echo "active";
                    }
                    ?>">
                            <?= anchor('users/edit-profile', 'View/Edit Profile'); ?>
                    </li>
                    <li class="<?php
                    if (site_url("users/avatar") == current_url()) {
                        echo "active";
                    }
                    ?>">
                            <?= anchor('users/avatar', 'Profile Picture'); ?>
                    </li>
                    <li class=" <?php
                    if (site_url("users/password-update") == current_url()) {
                        echo "active";
                    }
                    ?>">
                        <a href="<?= site_url("users/password-update") ?>"><span class="title">Change Password</span></a>
                    </li>
                    <li class=" <?php
                    if (site_url("listings/add-listing") == current_url()) {
                        echo "active";
                    }
                    ?>">
                        <a href="<?= site_url("listings/add-listing") ?>">
                            Add New Listings</a>
                    </li>
                    <?php if ($UserType == 'Host') { ?>
                        <li class=" <?php
                        if (site_url("users/verification") == current_url()) {
                            echo "active";
                        }
                        ?>">
                            <a href="<?= site_url("users/verification") ?>">
                                Trust and Verification</a>
                        </li>
                    <?php } ?>
                    <!-- 
                    <?php if (HavingReviews($uid)) { ?>
                                                          <li class=" <?php
                        if (site_url("reviews") == current_url()) {
                            echo "active";
                        }
                        ?>">
                                                              <a href="<?= site_url("reviews") ?>">
                                                                  Reviews</a>
                                                          </li>
                    <?php } ?>
                               <li class=" <?php
                    if (site_url("references") == current_url()) {
                        echo "active";
                    }
                    ?>">
                                      <a href="<?= site_url("references") ?>">
                                          References</a>
                                  </li>-->


                </ul>
            </li>
            <?php if (HavingTransactions($uid)) { ?>
                <li class="last">
                    <a href="javascript:;">
                        <i class="icon-settings"></i>
                        <span class="title">Account</span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                        <!--                    <li class=" <?php
                        if (site_url("users/notifications") == current_url()) {
                            echo "active";
                        }
                        ?>">
                                                <a href="<?= site_url("users/notifications") ?>">
                                                    <span class="title">Notifications</span></a>
                                            </li>
                                            <li class=" <?php
                        if (site_url("users/payment-methods") == current_url()) {
                            echo "active";
                        }
                        ?>">
                                                <a href="<?= site_url("users/payment-methods") ?>"><span class="title">Payment Methods</span></a></li>
                                            <li class=" <?php
                        if (site_url("users/preferences") == current_url()) {
                            echo "active";
                        }
                        ?>">
                                                <a href="<?= site_url("users/preferences") ?>"><span class="title">Payout Preferences</span></a></li>-->

                        <li class=" <?php
                        if (site_url("users/transactions") == current_url()) {
                            echo "active";
                        }
                        ?>">
                            <a href="<?= site_url("users/transactions") ?>"><span class="title">Transaction History</span></a>
                        </li>

                        <!--                    <li class=" <?php
                        if (site_url("users/privacy") == current_url()) {
                            echo "active";
                        }
                        ?>">
                                                <a href="<?= site_url("users/privacy") ?>"><span class="title">Privacy</span></a></li>
                                            <li class=" <?php
                        if (site_url("users/settings") == current_url()) {
                            echo "active";
                        }
                        ?>">
                                                <a href="<?= site_url("users/settings") ?>"><span class="title">Settings</span></a>
                                            </li>-->


                    </ul>
                </li>
            <?php } ?>

        </ul>

        <!-- END SIDEBAR MENU -->
    </div>
</div>