<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<body>
<?php $this->load->view('templates/' . $topmenu); ?>
<?php $this->load->view('templates/quick_searchform'); ?>
<div id="search_results">
    <section id="section-body">
        <div class="container">
            <div class="page-title breadcrumb-top">
                <div class="row">
                    <div class="col-sm-12">
                        <ol class="breadcrumb">
                            <li><a href="#"><i class="fa fa-home"></i></a></li>
                            <li class="active">All Agents</li>
                        </ol>
                        <div class="page-title-left">
                            <h2>All Agents</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 list-grid-area container-contentbar">
                    <div id="content-area">

                        <div class="ajax-loader_icon" id="loading" style="display:none"><img src="<?=base_url('assets/img/loading-spinner-default.gif');?>" /></div>

                        <?php if (isset($agents) && $agents != NULL) { ?>

                            <div class="agent-listing">

                                <?php foreach ($agents as $agent) { ?>
                                    <div class="profile-detail-block">
                                        <div class="media">
                                            <div class="media-left">

                                                <?php

                                                if (file_exists('assets/media/users_avatar/' . $agent->picture) == FALSE || $agent->picture == null) {
                                                    $folder = "";
                                                    $pic = 'placeholder.png';
                                                } else {

                                                    $folder = "medium/";
                                                    $pic = $agent->picture;
                                                }

                                                ?>

                                                <figure style="margin-bottom:0px;">
                                                    <a href="<?= site_url() ?>agent/profile/<?= $agent->id ?>">
                                                        <img src="<?= base_url() . 'assets/media/users_avatar/' . $folder . $pic; ?>"
                                                             alt="Agent Thumb" width="350" height="350">
                                                    </a>
                                                </figure>
                                            </div>
                                            <div class="media-body">
                                                <div class="profile-description">
                                                    <h3>
                                                        <a href="<?= site_url() ?>agent/profile/<?= $agent->id ?>"><?= $agent->first_name . " " . $agent->last_name ?></a>

                                                        <div class="bottom-ratings tip">
                                                            <!--<div class="star-ratings-sprite" style="margin-top:0px; float:left;">
                                                                <span style="width:<?/*= (($agent->rating))*20 */?>%" class="rating"></span>
                                                            </div>-->

                                                           <img src="<?/*=base_url()*/?>assets/img/star-off.png">
                                                            <img src="<?/*=base_url()*/?>assets/img/star-off.png">
                                                            <img src="<?/*=base_url()*/?>assets/img/star-off.png">
                                                            <img src="<?/*=base_url()*/?>assets/img/star-off.png">
                                                            <img src="<?/*=base_url()*/?>assets/img/star-off.png">
                                                            <span style="width:<?= (($agent->rating)) * 20 ?>%" class="top-ratings">
                                                            <img src="<?/*=base_url()*/?>assets/img/star-on.png">
                                                            <img src="<?/*=base_url()*/?>assets/img/star-on.png">
                                                            <img src="<?/*=base_url()*/?>assets/img/star-on.png">
                                                            <img src="<?/*=base_url()*/?>assets/img/star-on.png">
                                                            <img src="<?/*=base_url()*/?>assets/img/star-on.png">
                                                        </span>
                                                        </div>
                                                    </h3>
                                                    <h4 class="position"><?= $agent->agent_type ?></h4>
                                                    <ul class="profile-contact">
                                                        <li><span>For Sale:</span> <span
                                                                    class="blue"><?= sale_count($agent->id); ?></span>
                                                        </li>
                                                        <li><span>Sold:</span> <span
                                                                    class="blue"><?= sold_count($agent->id); ?></span>
                                                        </li>
                                                        <li>
                                                            <span>Member Since:</span> <?= date("M d, Y", strtotime($agent->registered_date)) ?>
                                                        </li>
                                                        <li><span>Years Of Experience:</span> <?= $agent->experience; ?>
                                                        </li>
                                                        <li><span>Languages:</span> <?= $agent->languages; ?></li>
                                                    </ul>
                                                    <div class="row">
                                                        <div class="col-sm-6"><a
                                                                    href="<?= site_url() ?>agent/profile/<?= $agent->id ?>"
                                                                    class="btn btn-primary hidden-xs"
                                                                    style="margin-top:20px; width:100%;">View
                                                                Profile</a></div>
                                                        <div class="col-sm-6"><a href="javascript:void(0)"
                                                                                 data-toggle="modal"
                                                                                 data-target="#quick_contact_<?= $agent->id; ?>"
                                                                                 class="btn btn-primary hidden-xs"
                                                                                 style="margin-top:20px; width:100%;">Quick
                                                                Contact</a></div>
                                                    </div>
                                                    <?php $this->load->view('includes/quick_contact'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>


                            </div>
                        <?php } ?>

                        <hr>


                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-md-offset-0 col-sm-offset-3 container-sidebar">
                    <aside id="sidebar" class="sidebar-white">

                        <div class="widget">
                            <div class="widget-top"><h3 class="widget-title">Search Agent Filters</h3></div>
                            <div class="widget-body">

                                <?php $this->load->view('includes/agents/agents_search'); ?>

                            </div>
                        </div>


                        <?php $this->load->view('listings/featured'); ?>

                        <div class="widget widget-recommend">
                            <div class="widget-body">
                                <a href="#">
                                    <img class="media-object" src="<?= base_url() ?>assets/img/real-Estate-Banners.jpg"
                                         alt="Thumb" width="" height="">
                                </a>
                            </div>
                        </div>

                        <?php if (isset($let_reviews) && $let_reviews != NULL) { ?>

                            <div class="widget widget-reviews">
                                <div class="widget-top">
                                    <h3 class="widget-title">Latest Reviews</h3>
                                </div>
                                <div class="widget-body">
                                    <?php foreach ($let_reviews as $let_review) { ?>
                                        <div class="media">

                                            <?php
                                            if (file_exists('assets/media/users_avatar/' . $let_review->picture) == FALSE || $let_review->picture == null) {
                                                $folder = "";
                                                $pic = 'default.png';
                                            } else {

                                                $folder = "medium/";
                                                $pict = $let_review->picture;
                                            }

                                            ?>
                                            <div class="media-left">
                                                <a href="<?= site_url() ?>agent/profile/<?= $let_review->id ?>">
                                                    <img class="media-object img-circle"
                                                         src="<?= base_url() . 'assets/media/users_avatar/' . $folder . $pict; ?>"
                                                         alt="Thumb" width="50" height="50">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h3 class="media-heading"><a
                                                            href="<?= site_url() ?>agent/profile/<?= $let_review->id ?>"><?= $let_review->first_name . " " . $let_review->last_name ?></a>
                                                </h3>


                                                    <div class="bottom-ratings tip">
                                                        <img src="<?=base_url()?>assets/img/star-off.png">
                                                        <img src="<?=base_url()?>assets/img/star-off.png">
                                                        <img src="<?=base_url()?>assets/img/star-off.png">
                                                        <img src="<?=base_url()?>assets/img/star-off.png">
                                                        <img src="<?=base_url()?>assets/img/star-off.png">
                                                        <span style="width:<?= (($let_review->rating)) * 20 ?>%" class="top-ratings">
                                                            <img src="<?=base_url()?>assets/img/star-on.png">
                                                            <img src="<?=base_url()?>assets/img/star-on.png">
                                                            <img src="<?=base_url()?>assets/img/star-on.png">
                                                            <img src="<?=base_url()?>assets/img/star-on.png">
                                                            <img src="<?=base_url()?>assets/img/star-on.png">
                                                        </span>
                                                    </div>




                                                <!--<div class="rating">
                                            <span class="bottom-ratings"><span class="fa fa-star-o"></span><span
                                                        class="fa fa-star-o"></span><span
                                                        class="fa fa-star-o"></span><span
                                                        class="fa fa-star-o"></span><span
                                                        class="fa fa-star-o"></span><span
                                                        style="width:<?/*= (($let_review->rating)) * 20 */?>%"
                                                        class="top-ratings"><span
                                                            class="fa fa-star"></span><span
                                                            class="fa fa-star"></span><span
                                                            class="fa fa-star"></span><span
                                                            class="fa fa-star"></span><span
                                                            class="fa fa-star"></span></span></span>
                                                </div>-->
                                                <p> <?= character_limiter($let_review->review, 90); ?></p>
                                            </div>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>
                        <?php } ?>

                    </aside>
                </div>
            </div>
        </div>
    </section>
</div>