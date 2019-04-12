<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<body>
<!--start section top-->
<section id="splash-section" class="section">
    <div class="vegas-overlay"></div>
    <div class="splash-inner-media" style="background-image: url(<?=base_url()?>assets/img/landing-bedroom.jpg)"></div>

    <div class="splash-inner-content">
        <?php $this->load->view('includes/menu/home') ;?>
        <div class="container">
            <!--start section header-->

            <!--end section header-->
            <?php $this->load->view('templates/home_searchform'); ?>


            <div class="splash-footer">
                <div class="row">
                    <div class="col-sm-6 col-xs-6 splash-foot-left">
                        <!--<p><i class="fa fa-phone-square"></i> CALL US FREE <strong>(800) 897 6543</strong></p>-->
                    </div>
                    <div class="col-sm-6 col-xs-6 splash-foot-right">
                        <p><?=$this->lang->line('c_follow');?>
                            <a href="https://www.facebook.com/neighborty/" class="btn-facebook"><i class="fa fa-facebook-square"></i></a>
                            <a href="https://www.linkedin.com/company/neighborty/" class="btn-twitter"><i class="fa fa-linkedin-square"></i></a>
                            <a href="https://www.instagram.com/neighborty_inc/" class="btn-pinterest"><i class="fa fa-instagram"></i></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--end section top-->



<section id="section-body">

    <?php if( $this->uri->segment(1) == 'rent' ) { ?>
        <?php if (count($featured_rental)) { ?>
            <div class="houzez-module-main">
                <div class="houzez-module carousel-module">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="module-title-nav clearfix">
                                    <div>
                                        <h2><?=$this->lang->line('c_f_for_rent');?></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="row grid-row">
                                    <div class="carousel properties-carousel-grid-1 slide-animated">
                                        <?php

                                        if (count($featured_rental)) { ?>
                                            <?php foreach ($featured_rental as $rental) { ?>
                                                <div class="item">

                                                    <div class="item-wrap">
                                                        <div class="property-item item-grid">
                                                            <div class="figure-block">
                                                                <figure class="item-thumb">
                                                                    <!-- <div class="label-wrap hide-on-list">
                                                                    <div class="label-status label label-default">For <? /*=$rental->property_type*/ ?></div>
                                                                </div>-->
                                                                    <span class="label-featured label label-success is_featured"><?=$this->lang->line('c_sponsored');?></span>
                                                                    <div class="price hide-on-list">
                                                                        <!--<h3>$350,000</h3>-->
                                                                        <p class="rant"><?=pkrCurrencyFormat($rental->price);?><?/*= ($rental->property_type == 'rent' ? '' : ''); */?></p>
                                                                    </div>

                                                                    <a href="<?= site_url('property/' . $rental->slug . '-' . $rental->id) ?>"
                                                                       class="hover-effect">
                                                                        <img src="<?=display_listing_preview('medium',$rental->preview_image_url);?>" alt="<?= ucwords($rental->listing_name) ?>">
                                                                    </a>
                                                                    <ul class="actions">
                                                                        <li class="share-btn">
                                                                            <div class="share_tooltip fade">
                                                                                <a href="#" target="_blank"><i
                                                                                            class="fa fa-facebook"></i></a>
                                                                                <a href="#" target="_blank"><i
                                                                                            class="fa fa-twitter"></i></a>
                                                                                <a href="#" target="_blank"><i
                                                                                            class="fa fa-google-plus"></i></a>
                                                                                <a href="#" target="_blank"><i
                                                                                            class="fa fa-pinterest"></i></a>
                                                                            </div>
                                                                            <span data-toggle="tooltip"
                                                                                  data-placement="top" title="share"><i
                                                                                        class="fa fa-share-alt"></i></span>
                                                                        </li>
                                                                        <li>
                                                                            <?php if ($this->session->userdata('logged_in')) { ?>
                                                                                <span data-toggle="tooltip"
                                                                                      data-placement="top"
                                                                                      title="Favorite"
                                                                                      id="<?= $top_deal->id ?>"
                                                                                      onClick="loadWishtlistModel(this.id)"
                                                                                      data-toggle="modal"><i
                                                                                            class="fa fa-heart-o"></i></span>
                                                                            <?php } else { ?>
                                                                                <span data-toggle="tooltip"
                                                                                      data-placement="top"
                                                                                      title="Favorite"><a
                                                                                            href="<?= site_url("users/login_status/") ?>"><i
                                                                                                class="fa fa-heart-o"></i></a></span>
                                                                            <?php } ?>
                                                                        </li>
                                                                        <!--<li><span data-toggle="tooltip" data-placement="top" title="Photos (12)"><i class="fa fa-camera"></i></span></li>-->
                                                                    </ul>
                                                                </figure>
                                                            </div>
                                                            <div class="item-body">

                                                                <div class="body-left">
                                                                    <div class="info-row">
                                                                        <h2 class="property-title"><a
                                                                                    href="<?= site_url('property/' . $rental->slug . '-' . $rental->id) ?>"><?= ucwords($rental->listing_name) ?></a>
                                                                        </h2>
                                                                        <h4 class="property-location"><?= $rental->city_town ?>
                                                                            , <?= $rental->state_province ?></h4>
                                                                    </div>
                                                                    <div class="table-list full-width info-row">
                                                                        <div class="cell">
                                                                            <div class="info-row amenities">
                                                                                <p>
                                                                                    <span><?=$this->lang->line('c_bedroom');?>: <?= $rental->bedrooms ?></span>
                                                                                    <span><?=$this->lang->line('c_bathrooms');?>: <?= $rental->bathrooms ?></span>
                                                                                    <span><?=$rental->area;?> <?=$rental->unit;?></span>
                                                                                </p>
                                                                                <p><?= $rental->home_type ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <!--<div class="cell">
                                                                            <div class="phone">
                                                                                <a href="<?/*= site_url('property/' . $rental->slug . '-' . $rental->id) */?>"
                                                                                   class="btn btn-primary">Details <i
                                                                                            class="fa fa-angle-right fa-right"></i></a>

                                                                            </div>
                                                                        </div>-->
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <h5 class="tbc-magazine-custom-subheading"><?=$this->lang->line('c_no_sales');?></h5>
                                        <?php } ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }

    }?>

    <?php if( $this->uri->segment(1) == 'buy' ) { ?>
        <?php if (count($featured_sale)) { ?>

            <div class="houzez-module-main">
                <div class="houzez-module carousel-module">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="module-title-nav clearfix">
                                    <div>
                                        <h2><?=$this->lang->line('c_f_for_sale');?></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="row grid-row">
                                    <div class="carousel properties-carousel-grid-1 slide-animated">
                                        <?php

                                        if (count($featured_sale)) { ?>
                                            <?php foreach ($featured_sale as $sale) { ?>
                                                <div class="item">

                                                    <div class="item-wrap">
                                                        <div class="property-item item-grid">
                                                            <div class="figure-block">
                                                                <figure class="item-thumb">
                                                                    <!-- <div class="label-wrap hide-on-list">
                                                                    <div class="label-status label label-default">For <? /*=$rental->property_type*/ ?></div>
                                                                </div>-->
                                                                    <span class="label-featured label label-success is_featured"><?=$this->lang->line('featured');?></span>
                                                                    <div class="price hide-on-list">
                                                                        <!--<h3>$350,000</h3>-->
                                                                        <p class="rant">
                                                                            <?=pkrCurrencyFormat($sale->price);?> <?/*= ($sale->property_type == 'rent' ? '' : ''); */?></p>
                                                                    </div>
                                                                    <a href="<?= site_url('property/' . $sale->slug . '-' . $sale->id) ?>"
                                                                       class="hover-effect">
                                                                        <img src="<?=display_listing_preview('medium',$sale->preview_image_url);?>" alt="<?= ucwords($sale->listing_name) ?>">
                                                                    </a>
                                                                    <ul class="actions">
                                                                        <li class="share-btn">
                                                                            <div class="share_tooltip fade">
                                                                                <a href="#" target="_blank"><i
                                                                                            class="fa fa-facebook"></i></a>
                                                                                <a href="#" target="_blank"><i
                                                                                            class="fa fa-twitter"></i></a>
                                                                                <a href="#" target="_blank"><i
                                                                                            class="fa fa-google-plus"></i></a>
                                                                                <a href="#" target="_blank"><i
                                                                                            class="fa fa-pinterest"></i></a>
                                                                            </div>
                                                                            <span data-toggle="tooltip"
                                                                                  data-placement="top" title="share"><i
                                                                                        class="fa fa-share-alt"></i></span>
                                                                        </li>
                                                                        <li>
                                                                            <?php if ($this->session->userdata('logged_in')) { ?>
                                                                                <span data-toggle="tooltip"
                                                                                      data-placement="top"
                                                                                      title="Favorite"
                                                                                      id="<?= $sale->id ?>"
                                                                                      onClick="loadWishtlistModel(this.id)"
                                                                                      data-toggle="modal"><i
                                                                                            class="fa fa-heart-o"></i></span>
                                                                            <?php } else { ?>
                                                                                <span data-toggle="tooltip"
                                                                                      data-placement="top"
                                                                                      title="Favorite"><a
                                                                                            href="<?= site_url("users/login_status/") ?>"><i
                                                                                                class="fa fa-heart-o"></i></a></span>
                                                                            <?php } ?>
                                                                        </li>
                                                                        <!--<li><span data-toggle="tooltip" data-placement="top" title="Photos (12)"><i class="fa fa-camera"></i></span></li>-->
                                                                    </ul>
                                                                </figure>
                                                            </div>
                                                            <div class="item-body">

                                                                <div class="body-left">
                                                                    <div class="info-row">
                                                                        <h2 class="property-title"><a
                                                                                    href="<?= site_url('property/' . $sale->slug . '-' . $sale->id) ?>"><?= ucwords($sale->listing_name) ?></a>
                                                                        </h2>
                                                                        <h4 class="property-location"><?= $sale->city_town ?>
                                                                            , <?= $sale->state_province ?></h4>
                                                                    </div>
                                                                    <div class="table-list full-width info-row">
                                                                        <div class="cell">
                                                                            <div class="info-row amenities">
                                                                                <p>
                                                                                    <span><?=$this->lang->line('c_bedroom');?>: <?= $sale->bedrooms ?></span>
                                                                                    <span><?=$this->lang->line('c_bathrooms');?>: <?= $sale->bathrooms ?></span>
                                                                                    <span><?=$sale->area;?> <?=$sale->unit;?></span>
                                                                                </p>
                                                                                <p><?= $sale->home_type ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <!--<div class="cell">
                                                                            <div class="phone">
                                                                                <a href="<?/*= site_url('property/' . $sale->slug . '-' . $sale->id) */?>"
                                                                                   class="btn btn-primary">Details <i
                                                                                            class="fa fa-angle-right fa-right"></i></a>

                                                                            </div>
                                                                        </div>-->
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <h5 class="tbc-magazine-custom-subheading"><?=$this->lang->line('c_no_sales');?></h5>
                                        <?php } ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }

    }?>

    <!--start location module-->
    <?php $this->load->view('includes/site_locations');?>
    <!--end location module-->


</section>


<!--<a href="<?/*=site_url('booking/detail/'.$top_deal->slug)*/?>" class="awe-btn awe-btn-1 awe-btn-small grid-custom-paragraph">Book Now</a>-->

