<?php defined('BASEPATH') OR exit('No direct script access allowed');
$session_data = $this->session->userdata('logged_in');
$UserType = $session_data['user_type'];
?>
<!-- For bar chart only -->
<!--<script type="text/javascript" src="--><?//= base_url(); ?><!--assets/js/jquery.min.js"></script>-->
<!-- For bar chart only -->

<body>

<?php $this->load->view('dashboard/dashboard-header'); ?>




<!--start section page body-->
<section id="section-body">
    <div class="container">
        <div class="page-title" style="display:none;">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-left">
                        <h1 class="title-head"> </h1>
                    </div>

                    <div class="page-title-right">
                        <ol class="breadcrumb"><li><a href=""><i class="fa fa-home"></i></a></li><li class="active"><?=$this->lang->line('dashboard');?></li></ol>
                    </div>
                    <?php $this->load->view('templates/activation_notice'); ?>

                </div>
            </div>
        </div>

        <div class="user-dashboard-full">
            <?php $this->load->view('dashboard/dashboard-sidebar'); ?>
            <div class="profile-area-content">
                <div class="profile-top">
                    <div id="carousel-module-4" class="houzez-module caption-above carousel-module" style="padding:0px;">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="module-title-nav clearfix">
                                    <div>
                                        <h2 class="title"><?=$this->lang->line('saved_recently');?></h2>
                                    </div>
                                   <!-- <div class="module-nav">
                                        <button class="btn btn-sm btn-crl-4-prev">Prev</button>
                                        <button class="btn btn-sm btn-crl-4-next">Next</button>
                                        <a href="#" class="btn btn-carousel btn-sm">All</a>
                                    </div>-->
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div id="properties-carousel-4" class="carousel slide-animated">

                                    <?php foreach($latest_home as $list) :?>
                                        <div class="item">
                                        <div class="figure-block">
                                            <figure class="item-thumb recent_saved_item">
                                                <div class="label-wrap label-left">
                                                    <!--<span class="label label-success">Featured</span>-->
                                                    <span class="label-status label label-default"><?=($list->property_type == 'rent' ? 'For Rent' :$list->property_type);?></span>
                                                </div>
                                                <?php
                                                if(is_file($abs_path.'/assets/media/properties/thumbs/'.$list->preview_image_url)){
                                                    if (file_exists($abs_path.'/assets/media/properties/thumbs/'.$list->preview_image_url)) {
                                                        $list_img=$search_img.$list->preview_image_url;
                                                    }else{
                                                        $list_img=base_url()."assets/img/placeholder.png";
                                                    }
                                                }else{
                                                    $list_img=base_url()."assets/img/placeholder.png";
                                                }
                                                ?>

                                                <a class="hover-effect" href="<?=site_url("property/".$list->slug.'-'.$list->id)?>">
                                                    <img src="<?=$list_img;?>" alt="<?=$list->title;?>">
                                                </a>

                                                <ul class="actions">

                                                    <li class="share-btn">
                                                        <?php
                                                        $data= array('list_img'=>base_url() . "assets/media/properties/thumbs/".$list->preview_image_url,'slug'=>$list->slug.'-'.$list->listid,'description'=>$list->summary);
                                                        $this->load->view('includes/share',$data);
                                                        ?>
                                                        <span title="" data-placement="top" data-toggle="tooltip" data-original-title="share"><i class="fa fa-share-alt"></i></span>
                                                    </li>
                                                </ul>
                                                <figcaption class="detail-above detail">
                                                    <div class="fig-title clearfix">
                                                        <h3 class="pull-left"><?=$list->title;?></h3>
                                                    </div>

                                                    <ul class="list-inline">
                                                        <li class="cap-price"><?=pkrCurrencyFormat($list->price);?>  <span class="item-sub-price" style="display:inline-block"><?/*= ($list->property_type == 'sale' ? '' : ''); */?></li>
                                                    </ul>
                                                </figcaption>
                                            </figure>
                                        </div>
                                    </div>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ($UserType == 'Host') { ?>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="white-block dashboard-stat2">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-green-sharp"><small class="font-green-sharp">$</small> <?php
                                            if (@$sales->balance > 0) {
                                                echo $sales->balance;
                                            } else {
                                                echo 0;
                                            }
                                            ?></h3>
                                        <small>Lifetime Revenue</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-pie-chart"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <a class="btn btn-primary btn-block" href="<?= site_url("users/transactions") ?>">View Transactions</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="white-block dashboard-stat2">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-green-sharp"><small class="font-green-sharp">$</small> <?= $month_revenue ?></h3>
                                        <small>Revenue THIS MONTH</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-pie-chart"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <a class="btn btn-primary btn-block" href="<?= site_url("users/transactions") ?>">View Transactions</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="white-block dashboard-stat2">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-green-sharp"><?= $totalWishlists ?></h3>
                                        <small>YOUR Wishlists</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-pie-chart"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <a class="btn btn-primary btn-block" href="<?= site_url("user-wishlists") ?>">View Wishlists</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="white-block dashboard-stat2">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-red-haze"><?= @$count_reviews; ?></h3>
                                        <small>TOTAL REVIEWS</small>
                                    </div>
                                    <div class="icon">
                                        <i class="icon-like"></i>
                                    </div>
                                </div>
                                <div class="progress-info">
                                    <a class="btn btn-primary btn-block" href="<?= site_url("reviews") ?>">View Reviews</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="row">
                    <?php //if (HavingReservationRequests($uid)) { ?>
                        <!--
                        <div class="col-md-6 col-sm-12">
                            <div class="white-block">
                                <div class="portlet-title">REVENUE Summary</div>
                                <div class="portlet-body">
                                    <div class="row list-separated">
                                        <div class="col-md-3 col-sm-3 col-xs-6">
                                            <div class="font-grey-mint font-sm">
                                                Total Sales
                                            </div>
                                            <div class="uppercase font-hg font-red-flamingo">
                                                <?= @$sales->credits ?> <span class="font-lg font-grey-mint">$</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-6">
                                            <div class="font-grey-mint font-sm">
                                                Revenue
                                            </div>
                                            <div class="uppercase font-hg theme-font-color">
                                                <?= @$sales->balance ?> <span class="font-lg font-grey-mint">$</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-6">
                                            <div class="font-grey-mint font-sm">
                                                Service fee
                                            </div>
                                            <div class="uppercase font-hg font-purple">
                                                <?= @$sales->debits ?><span class="font-lg font-grey-mint">$</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-6">
                                            <div class="font-grey-mint font-sm">
                                                Net Income
                                            </div>
                                            <div class="uppercase font-hg font-blue-sharp">
                                                <?= @$sales->balance ?><span class="font-lg font-grey-mint">$</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="sales_statistics" class="portlet-body-morris-fit morris-chart" style="width:100%;">
                                        <?= $chart ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        -->
                    <?php //} ?>
                    <?php if (HavingTransactions($uid) && $UserType == 'Host') { ?>
                        <div class="col-md-6 col-sm-12">
                            <!-- BEGIN PORTLET-->
                            <div class="white-block ">
                                <div class="portlet-title">Listing Statistics</div>
                                <div class="portlet-body">
                                    <div class="table-scrollable table-scrollable-borderless" style="min-height: 342px;">
                                        <table class="table table-hover table-light">
                                            <?php if (isset($BookingDetails) && $BookingDetails != NULL) { ?>
                                            <thead>
                                            <tr class="uppercase">
                                                <th colspan="2">
                                                    Guest
                                                </th>
                                                <th>
                                                    Amount
                                                </th>
                                                <th>
                                                    Listing Name
                                                </th>
                                                <th>
                                                    Date
                                                </th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($BookingDetails as $BookingDetail) { ?>
                                                <tr>
                                                    <td class="fit">
                                                        <img class="user-pic" src="<?= base_url(); ?><?= $users_avatar . "small/" . $BookingDetail->picture ?>">
                                                    </td>
                                                    <td>
                                                        <a href="javascript:;" class="primary-link"><?= $BookingDetail->first_name . " " . $BookingDetail->last_name; ?></a>
                                                    </td>
                                                    <td>
                                                        $<?= $BookingDetail->listing_charges ?>
                                                    </td>
                                                    <td>
                                                        <?= ucwords(substr($BookingDetail->listing_name, 0, 30)); ?>
                                                    </td>
                                                    <td>
                                                        <?= date('Y-m-d', strtotime($BookingDetail->book_date)); ?>
                                                    </td>

                                                </tr>

                                                <?php
                                            }
                                            } else {
                                                echo "No record Found";
                                            }
                                            ?>

                                            </tbody></table>
                                    </div>
                                </div>
                            </div>
                            <!-- END PORTLET-->
                        </div>
                    <?php } ?>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="white-block">
                            <div class="portlet-title">
                                <?=$this->lang->line('recent_posts');?> <span class="caption-helper">(<?= $messages_count; ?> <?=$this->lang->line('pending');?>)</span>
                                <a href="<?= site_url("inbox") ?>" class="caption-sm"><?=$this->lang->line('see_all');?></a>
                            </div>
                            <div class="portlet-body">
                                <?php  if ($recent_chats) {   ?>
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 171px;">
                                    <div class="general-item-list">
                                        <?php
                                            $users_avatar ='assets/media/users_avatar/';
                                            foreach ($recent_chats as $message) {


                                                if (file_exists('assets/media/users_avatar/' . $message->picture) == FALSE || $message->picture == null) {
                                                    $folder = "";
                                                    $pic = 'placeholder.png';
                                                } else {

                                                    $folder = "medium/";
                                                    $pic = $message->picture;
                                                }



                                                ?>
                                                <div class="item">
                                                    <img class="img-circle" src='<?=base_url().$users_avatar.$pic; ?>' alt="<?= $message->first_name . " " . $message->last_name; ?>" height="35px" width="35px"/>
                                                    <div class="item-details">
                                                        <a href='<?= site_url("agent/profile/" . $message->uid) ?>' class="item-name primary-link"><?= $message->first_name . " " . $message->last_name; ?></a>
                                                        <span class="item-label"><?= relative_time($message->date_time); ?></span>

                                                        <span class="item-status">
                                                                <?php
                                                                if ($message->read_status == 0) {
                                                                    echo '<span class="badge badge-empty btn-info">New</span>';
                                                                    $class = 'label-info';
                                                                } else {
                                                                    echo '<span class="badge badge-empty btn-success">Read</span>';
                                                                    $class = 'label-success';
                                                                }
                                                                ?>

                                                            </span>
                                                    </div>
                                                    <div class="item-body"><?= strip_tags($message->message); ?></div>
                                                </div>
                                                <?php } ?>

                                    </div>
                                </div>
                                    <?php
                                } else {
                                    echo '<p class="text-center" style="font-size:14px;">
                                                    <br/><br/>'.$this->lang->line('messages_not_sent').'
                                                    <br/>'.$this->lang->line('start_contacting_agent').' 
                                                    <br/><br/>
                                                    <a class="btn btn-primary btn-md" href="'.site_url().'">'.$this->lang->line('find_an_agent').'</a>
                                                  </p>';
                                }
                                ?>
                            </div>
                        </div>
                        <!-- END PORTLET-->
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="white-block">
                            <div class="portlet-title">
                                <?=$this->lang->line('recent_appointment');?> </span>
                                <a href="<?= site_url("appointments") ?>" class="caption-sm"><?=$this->lang->line('see_all');?></a>
                            </div>
                            <div class="portlet-body">
                            <?php if(count($appointments) > 0) { ?>
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 171px;">
                                    <div class="general-item-list">
                                        <?php


                                        $users_avatar ='assets/media/users_avatar/';
                                        foreach($appointments as $listing){

                                            if(!file_exists(base_url() . $users_avatar .$folder. $agent->picture))
                                            {
                                                $folder = "";
                                                $pic = 'default.png';
                                            }
                                            else{
                                                $folder="medium/";
                                                $pic = $agent->picture;
                                            }
                                            ?>
                                            <div class="item">
                                                <div class="media my-property" style="padding:0px;">
                                                    <div class="media-left">
                                                        <div class="my-description" style="width:100%">
                                                            <h4 class="my-heading"><a href="#"><span class="label label-default">Appointment with</span> <?= $listing->first_name . " " . $listing->last_name; ?></a></h4>
                                                            <p class="status"><strong>Phone:</strong> <?=$listing->phone?>  <strong>Email:</strong> <a href="mailto:<?=$listing->email?>"><?=$listing->email?> </a></p>
                                                            <p class="status"><strong>Date/Time:</strong><?=date('F jS, Y',strtotime($listing->timeslot));?></p>
                                                        </div>
                                                    </div>
                                                    <div class="media-right">
                                                        <div class="my-description" style="width:100%;">
                                                            <h5 class="my-heading"><a href="<?=site_url("property/".$listing->slug)?>"><?= ucwords($listing->listing_name) ?></a></h5>
                                                            <p class="address"><?php echo $listing->address_line_1.' '.$listing->address_line_2.', '.$listing->city_town.', '.$listing->state_province.' '.$listing->zip_postal_code?></p>
                                                            <p class="status"><strong>Status:</strong> <?=$listing->property_type;?> <strong>Price:</strong> <?=pkrCurrencyFormat($list->price);?>  <?/*=($listing->property_type == 'sale' ? '': '');*/?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php } ?>





                                    </div>
                                </div>
                            <?php } else{ ?>

                                <p class="text-center" style="font-size:14px;"><br/><br/>
                                    <?=$this->lang->line('not_scheduled_appointment');?>
                                    <br/>
                                    <?=$this->lang->line('making_an_appointment');?>
                                    <br/><br />
                                    <a class="btn btn-primary btn-md" href="<?=site_url();?>"><?=$this->lang->line('book_meeting');?></a>
                                </p>

                            <?php } ?>
                            </div>
                        </div>
                        <!-- END PORTLET-->
                    </div>

                    <div class="col-md-6 col-sm-12" style="margin-top: 8px;">
                        <!-- BEGIN PORTLET-->
                        <div class="white-block">
                            <div class="portlet-title">
                                <?=$this->lang->line('recent_comments');?>
                                <a href="<?= site_url("reviews") ?>" class="caption-sm pull-right padding10"><?=$this->lang->line('see_all');?></a>
                            </div>
                            <div class="portlet-body">
                                <?php if (isset($reviews_to) && $reviews_to != NULL) {
                                  
                                    ?>
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 171px;">
                                    <div class="general-item-list">
                                        <?php
                                            foreach (array_slice($reviews_to, 0,3) as $review_to) {

                                                $rating = round($review_to->rating * 20, 2);
                                                ?>
                                                <div class="item">
                                                    <img class="img-circle" src="<?= base_url() . $users_avatar . 'small/' . $review_to->picture; ?>" alt="<?=$review_to->first_name . " " . $review_to->last_name; ?>" width="35px" height="35px" />
                                                    <div class="item-details">
                                                        <a href="<?= site_url("agent/profile/" . $review_to->agent_id) ?>" class="item-name primary-link"><?= $review_to->first_name . " " . $review_to->last_name; ?></a>
                                                        <span class="item-label"><?= relative_time($review_to->date_time); ?></span>
                                                        <div class="item-status pull-right"><div class="star-ratings-sprite"><span style="width:<?= $rating ?>%" class="rating"></span></div></div>
                                                    </div>
                                                    <div class="item-body"><?= strip_tags($review_to->review); ?></div>
                                                </div>
                                                <div class="clearfix"></div>
                                      <?php } ?>
                                    </div>
                                </div>
                            <?php
                            } else {
                                echo '<p class="text-center" style="font-size:14px;"><br/>'.$this->lang->line('no_comments').'</p>';
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12" style="margin-top: 8px;">
                        <!-- BEGIN PORTLET-->
                        <div class="white-block">
                            <div class="portlet-title">
                                <?=$this->lang->line('your_recent_comments');?>
                                <a href="<?= site_url("reviews") ?>" class="caption-sm pull-right padding10"><?=$this->lang->line('see_all');?></a>
                            </div>
                            <div class="portlet-body">
                                <?php if (isset($reviews_by) && $reviews_by != NULL) {
                                    ?>
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 171px;">
                                    <div class="general-item-list">
                                        <?php
                                            foreach (array_slice($reviews_by, 0,3) as $review_to) {

                                                $rating = round($review_to->rating * 20, 2);
                                                ?>
                                                <div class="item">
                                                    <img class="img-circle" src="<?= base_url() . $users_avatar . 'small/' . $review_to->picture; ?>" alt="<?=$review_to->first_name . " " . $review_to->last_name;?>" width="35px" height="35px" />
                                                    <div class="item-details">
                                                        <a href="<?= site_url("agent/profile/" . $review_to->agent_id) ?>" class="item-name primary-link"><?= $review_to->first_name . " " . $review_to->last_name; ?></a>
                                                        <span class="item-label"><?= relative_time($review_to->date_time); ?></span>
                                                        <span class="item-status pull-right"><div class="star-ratings-sprite"><span style="width:<?= $rating ?>%" class="rating"></span></div></span>
                                                    </div>
                                                    <div class="item-body"><?= strip_tags($review_to->review); ?></div>
                                                </div>
                                                <div class="clearfix"></div>
                                    <?php   } ?>

                                    </div>
                                </div>
                                    <?php
                                } else {
                                    echo '<p class="text-center" style="font-size:14px;"><br/>'.$this->lang->line('no_comments').'</p>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
</section>
<!--end section page body-->