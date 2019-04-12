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
                            <h2 class="title">My Applications</h2>
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
                                                        <img src="<?= base_url() ?>assets/media/properties/thumbs/<?= $listing->preview_image_url ?>"/>
                                                    </a>
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="item-body table-cell">
                                            <div class="body-left table-cell">
                                                <div class="info-row">
                                                    <h2 class="property-title"><a href="<?=site_url("property/".$listing->slug)?>"> <?= ucwords($listing->listing_name) ?></a></h2>
                                                    <h4 class="property-location"><?php echo $listing->address_line_1.' '.$listing->address_line_2.', '.$listing->city_town.', '.$listing->state_province.' '.$listing->zip_postal_code?></h4>
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

                                    <p class="text-center"> No Application Found</p>

                            <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
