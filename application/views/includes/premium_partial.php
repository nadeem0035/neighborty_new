<?php defined('BASEPATH') OR exit('No direct script access allowed');
$ci = &get_instance();
$ci->load->model('Listings_model');
?>
<?php if(!empty($premium_listings) ){ ?>
    <h2 class="padding-top-10">Premium Properties</h2>
    <div class="list-grid-area">
        <div class="grid-view-3-col grid-view">

        <?php
        if(count($premium_listings) ){ ?>

            <?php foreach ($premium_listings as $sale){?>
                <div class="item slick_slide">
                    <div class="item-wrap">
                        <div class="property-item item-grid">
                            <div class="figure-block">
                                <figure class="item-thumb">
                                    <div class="label-wrap label-left">
                                        <span class="label label-danger">Premium</span>
                                    </div>
                                    <div class="price"><p class="rant"><?=pkrCurrencyFormat($sale->price);?></p></div>

                                    <div class="hover-effect">
                                                    <?php
                                                    $List_images = $ci->Listings_model->get_list_images($sale->id);
                                                    if (!empty($List_images)) { ?>

                                                        <div class="slider-mini">
                                                            <?php
                                                            $i = 0;
                                                            $count = 0;
                                                            $length = count($List_images);
                                                            for ($i = 0; $i < $length; $i++) {
                                                                ?>
                                                                <div class="bg_img" style="background-image:url('<?=display_listing_preview('small', $List_images[$i]->picture); ?>');" alt="<?= ($sale->title); ?>"></div>
                                                            <?php } ?>
                                                        </div>

                                                    <?php } else { ?>

                                                        <img src="<?=display_listing_preview('small',$sale->preview_image_url);?>" alt="<?=ucwords($sale->title)?>" title="<?=ucwords($sale->title)?>">

                                                    <?php } ?>
                                                </div>
                                                <ul class="actions">
                                                    <li>
                                                        <?php if ($this->session->userdata('logged_in')) { ?>
                                                            <span id="<?=$sale->id?>" onClick="loadWishtlistModel(this.id)" data-toggle="modal"><i class="fa fa-heart"></i></span>
                                                        <?php } else{ ?>
                                                            <span><a href="<?= site_url("users/login_status/")?>"><i class="fa fa-heart"></i></a></span>
                                                        <?php } ?>
                                                    </li>
                                                </ul>
                                            </figure>
                                        </div>
                                        <div class="item-body">
                                            <div class="body-left">
                                                <div class="info-row">
                                                    <h2 class="property-title"><a href="<?=site_url('property/'.$sale->slug.'-'.$sale->id)?>"><?=character_limiter($sale->title, 50)?></a></h2>
                                                    <h4 class="property-location"><?=getCityById($sale->city);?>, <?=$sale->state_province?></h4>
                                                </div>
                                                <div class="table-list full-width info-row">
                                                    <div class="cell">
                                                        <div class="info-row amenities">
                                                            <p>
                                                                <span><?=$this->lang->line('bedrooms');?>: <?=($sale->bedrooms == null ? 0 : $sale->bedrooms)?></span>
                                                                <span><?=$this->lang->line('bathrooms');?>: <?=($sale->bathrooms == null ? 0 : $sale->bathrooms)?></span>
                                                                <span>
                                                                                        Area:


                                                                    <?php if($sale->unit_id =='Square Feet'){?>

                                                                        <?=$sale->area_sqrft;?>

                                                                    <?php } ?>
                                                                    <?php if($sale->unit_id =='Square Yards'){?>

                                                                        <?=$sale->area_sqyard;?>

                                                                    <?php } ?>
                                                                    <?php if($sale->unit_id =='Square Meters'){?>

                                                                        <?=$sale->area_sqmeter;?>

                                                                    <?php } ?>
                                                                    <?php if($sale->unit_id =='Marla'){?>

                                                                        <?=$sale->area_marla;?>

                                                                    <?php } ?>
                                                                    <?php if($sale->unit_id =='Kanal'){?>

                                                                        <?=$sale->area_kanal;?>

                                                                    <?php } ?>

                                                                    <?php if($sale->unit_id =='acre'){?>

                                                                        <?=$sale->area_acre;?>

                                                                    <?php } ?>

                                                                    - <?=$sale->unit_id;?>

                                                                                    </span>
                                                            </p>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            <?php } ?>

        <?php }
        else
            { ?>
                    <div class="text-center">
                        <h5 class="tbc-magazine-custom-subheading"><?=$this->lang->line('no_listing_available');?></h5>
                    </div>
            <?php } ?>

        </div>
    </div>
<?php } ?>