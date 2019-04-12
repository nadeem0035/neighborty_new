<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<body>
    <?php $this->load->view('dashboard/dashboard-header'); ?>

    <section id="section-body">
        <div class="container">

            <div class="user-dashboard-full">
                <?php $this->load->view('dashboard/dashboard-sidebar'); ?>
                <div class="profile-area-content">
                    <div class="profile-top">
                        <div class="profile-top-left">
                            <h2 class="title"><?=$this->lang->line('my_applications');?></h2>
                        </div>
                    </div>
                    <div class="account-block">
                        <div class="property-listing grid-view grid-view-4-col">
                            <div class="row">
                                <?php

                                if(count($applications) > 0) {
                              //  echo '<pre>';print_r($applications);
                                foreach($applications as $listing){ ?>
                                <div class="item-wrap">
                                    <div class="property-item table-list">
                                        <div class="table-cell">
                                            <div class="figure-block">
                                                <figure class="item-thumb">
                                                    <div class="price hide-on-list">
                                                        <p class="price-start">Start from</p>
                                                        <span class="item-price"><?=pkrCurrencyFormat($listing->price);?> </span>
                                                        <!--<span class="item-sub-price"><?/*=($listing->property_type == 'sale' ? '': '');*/?></span>-->
                                                    </div>
                                                    <a href="#" class="hover-effect">
                                                        <img src="<?=display_listing_preview('thumbs',$listing->preview_image_url);?>" alt="<?= ucwords($listing->title) ?>"/>

                                                    </a>
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="item-body table-cell">
                                            <div class="body-left table-cell">
                                                <div class="info-row">
                                                    <h2 class="property-title"><a href="<?=site_url("property/".$listing->slug.'-'.$listing->id)?>"> <?= ucwords($listing->title) ?></a></h2>
                                                    <h4 class="property-location"><?php echo $listing->property_location; ?></h4>
                                                </div>
                                            </div>
                                            <div class="table-list full-width hide-on-list">
                                                <div class="cell">
                                                    <div class="phone">
                                                    <?=$listing->note_text;?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php }   ?>

                            <?php } else{ ?>
                                    <div class="col-md-12" style="padding-right:4px;padding-left:4px;">
                                        <div class="article-detail text-center"><h1><?=$this->lang->line('no_result');?></h1><p><?=$this->lang->line('no_property_waiting');?></p></div>
                                    </div>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
