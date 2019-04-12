<?php defined('BASEPATH') OR exit('No direct script access allowed');
$ci = &get_instance();
$ci->load->model('Listings_model');
?>
<?php if(!empty($featured_sale) ){ ?>
    <div class="houzez-module post-card-module properties-featured">
        <div class="container">
            <div class="module-title-nav clearfix">
                <h2><?=$this->lang->line('forsale');?></h2>
            </div>
            <div class="row grid-row padding-b-15">
                <?php
                if(count($featured_sale) ){ ?>

                    <?php foreach ($featured_sale as $sale){?>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="item slick_slide">
                                <div class="item-wrap">
                                    <div class="property-item item-grid">
                                        <div class="figure-block">
                                            <figure class="item-thumb">
                                                <span class="label-featured label label-success is_featured"><?=$this->lang->line('featured');?></span>
                                                <div class="price hide-on-list">
                                                    <p class="rant"><?=pkrCurrencyFormat($sale->price);?></p>
                                                </div>
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
                                                                <a class="progressive replace hover-effect" href="<?=display_listing_preview('small', $List_images[$i]->picture); ?>"
                                                                   title="<?=ucwords($sale->title)?>" alt="<?=ucwords($sale->title)?>">

                                                                    <img class="preview" src="<?=display_listing_tiny_image($List_images[$i]->picture);?>" alt="image" height="180"/>

                                                                </a>

                                                                <!--<img src="<?=display_listing_preview('small', $List_images[$i]->picture); ?>" class="img-responsive" alt="<?= ($sale->title); ?>">-->

                                                            <?php } ?>
                                                        </div>

                                                    <?php } else { ?>

                                                        <a class="progressive replace hover-effect" href="<?=display_listing_preview('small', $List_images[$i]->picture); ?>"
                                                           title="<?=ucwords($sale->title)?>" alt="<?=ucwords($sale->title)?>">

                                                            <img class="preview" src="<?=display_listing_tiny_image($List_images[$i]->picture);?>" alt="image" height="180"/>

                                                        </a>



                                                        <!--<img src="<?=display_listing_preview('small',$sale->preview_image_url);?>" alt="<?=ucwords($sale->title)?>" title="<?=ucwords($sale->title)?>">-->

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
                                                    <h4 class="property-location"><i class="flaticon flaticon-location-pin"></i><?=getCityById($sale->city);?>, <?=$sale->state_province?></h4>
                                                </div>
                                                <div class="table-list full-width info-row">
                                                    <div class="cell">
                                                        <div class="info-row amenities">
                                                            <p class="no-margin-b">
                                                                <span><i class="flaticon flaticon-bed"></i><?=($sale->bedrooms == null ? 0 : $sale->bedrooms)?></span>
                                                                <span><i class="flaticon flaticon-bathtub"></i><?=($sale->bathrooms == null ? 0 : $sale->bathrooms)?></span>
                                                                <span><i class="fa fa-object-group"></i>
                                                                    <?php if($sale->unit_id =='Square Feet'){?>
                                                                        <a href="#" data-toggle="popover" data-content="
                                                                            <table class='table table-popover'>
                                                                                <tr>
                                                                                    <th colspan='2'><?=$this->lang->line('land_area');?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><strong><?=$sale->area_sqrft;?></strong></td>
                                                                                    <td><strong><?=$this->lang->line('sqft');?></strong></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$sale->area_sqyard;?></td>
                                                                                    <td><?=$this->lang->line('sqyd');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$sale->area_sqmeter;?></td>
                                                                                    <td><?=$this->lang->line('sqm');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$sale->area_marla;?></td>
                                                                                    <td><?=$this->lang->line('marla');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$sale->area_kanal;?></td>
                                                                                    <td><?=$this->lang->line('kanal');?></td>
                                                                                </tr>
                                                                            </table>
                                                                        ">
                                                                            <?=$sale->area_sqrft;?> - <?=$sale->unit_id;?>
                                                                        </a>
                                                                    <?php } ?>
                                                                    <?php if($sale->unit_id =='Square Yards'){?>
                                                                        <a href="#" data-toggle="popover" data-content="
                                                                            <table class='table table-popover'>
                                                                                <tr>
                                                                                    <th colspan='2'><?=$this->lang->line('land_area');?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$sale->area_sqrft;?></td>
                                                                                    <td><?=$this->lang->line('sqft');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><strong><?=$sale->area_sqyard;?></strong></td>
                                                                                    <td><strong><?=$this->lang->line('sqyd');?></strong></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$sale->area_sqmeter;?></td>
                                                                                    <td><?=$this->lang->line('sqm');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$sale->area_marla;?></td>
                                                                                    <td><?=$this->lang->line('marla');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$sale->area_kanal;?></td>
                                                                                    <td><?=$this->lang->line('kanal');?></td>
                                                                                </tr>
                                                                            </table>
                                                                        ">
                                                                            <?=$sale->area_sqyard;?> - <?=$sale->unit_id;?>
                                                                        </a>
                                                                    <?php } ?>
                                                                    <?php if($sale->unit_id =='Square Meters'){?>
                                                                        <a href="#" data-toggle="popover" data-content="
                                                                            <table class='table table-popover'>
                                                                                <tr>
                                                                                    <th colspan='2'><?=$this->lang->line('land_area');?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$sale->area_sqrft;?></td>
                                                                                    <td><?=$this->lang->line('sqft');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$sale->area_sqyard;?></td>
                                                                                    <td><?=$this->lang->line('sqyd');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><strong><?=$sale->area_sqmeter;?></strong></td>
                                                                                    <td><strong><?=$this->lang->line('sqm');?></strong></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$sale->area_marla;?></td>
                                                                                    <td><?=$this->lang->line('marla');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$sale->area_kanal;?></td>
                                                                                    <td><?=$this->lang->line('kanal');?></td>
                                                                                </tr>
                                                                            </table>
                                                                        ">
                                                                            <?=$sale->area_sqmeter;?> - <?=$sale->unit_id;?>
                                                                        </a>
                                                                    <?php } ?>
                                                                    <?php if($sale->unit_id =='Marla'){?>
                                                                        <a href="#" data-toggle="popover" data-content="
                                                                            <table class='table table-popover'>
                                                                                <tr>
                                                                                    <th colspan='2'><?=$this->lang->line('land_area');?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$sale->area_sqrft;?></td>
                                                                                    <td><?=$this->lang->line('sqft');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$sale->area_sqyard;?></td>
                                                                                    <td><?=$this->lang->line('sqyd');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$sale->area_sqmeter;?></td>
                                                                                    <td><?=$this->lang->line('sqm');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><strong><?=$sale->area_marla;?></strong></td>
                                                                                    <td><strong><?=$this->lang->line('marla');?></strong></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$sale->area_kanal;?></td>
                                                                                    <td><?=$this->lang->line('kanal');?></td>
                                                                                </tr>
                                                                            </table>
                                                                        ">
                                                                            <?=$sale->area_marla;?> - <?=$sale->unit_id;?>
                                                                        </a>
                                                                    <?php } ?>
                                                                    <?php if($sale->unit_id =='Kanal'){?>
                                                                        <a href="#" data-toggle="popover" data-content="
                                                                            <table class='table table-popover'>
                                                                                <tr>
                                                                                    <th colspan='2'><?=$this->lang->line('land_area');?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$sale->area_sqrft;?></td>
                                                                                    <td><?=$this->lang->line('sqft');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$sale->area_sqyard;?></td>
                                                                                    <td><?=$this->lang->line('sqyd');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$sale->area_sqmeter;?></td>
                                                                                    <td><?=$this->lang->line('sqm');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$sale->area_marla;?></td>
                                                                                    <td><?=$this->lang->line('marla');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><strong><?=$sale->area_kanal;?></strong></td>
                                                                                    <td><strong><?=$this->lang->line('kanal');?></strong></td>
                                                                                </tr>
                                                                            </table>
                                                                        ">
                                                                            <?=$sale->area_kanal;?> - <?=$sale->unit_id;?>
                                                                        </a>
                                                                    <?php } ?>
                                                                    <?php if($sale->unit_id =='acre'){?>
                                                                        <a href="#" data-toggle="popover" data-content="
                                                                            <table class='table table-popover'>
                                                                                <tr>
                                                                                    <th colspan='2'><?=$this->lang->line('land_area');?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$sale->area_sqrft;?></td>
                                                                                    <td><?=$this->lang->line('sqft');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$sale->area_sqyard;?></td>
                                                                                    <td><?=$this->lang->line('sqyd');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$sale->area_sqmeter;?></td>
                                                                                    <td><?=$this->lang->line('sqm');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$sale->area_marla;?></td>
                                                                                    <td><?=$this->lang->line('marla');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$sale->area_kanal;?></td>
                                                                                    <td><?=$this->lang->line('kanal');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><strong><?=$sale->area_acre;?></strong></td>
                                                                                    <td><strong><?=$this->lang->line('acre');?></strong></td>
                                                                                </tr>
                                                                            </table>
                                                                        ">
                                                                            <?=$sale->area_acre;?> - <?=$sale->unit_id;?>
                                                                        </a>
                                                                    <?php } ?>
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
                        </div>
                    <?php } ?>

                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <a href="<?=site_url();?>search?type=sale" class="btn btn-secondary">View More</a>
                    </div>

                <?php }
                else
                { ?>
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <h5 class="tbc-magazine-custom-subheading"><?=$this->lang->line('no_listing_available');?></h5>
                    </div>
                <?php } ?>
            </div>

            <hr/>

            <div class="clearfix"></div>


            <div class="module-title-nav padding-top-10 clearfix">
                <h2><?=$this->lang->line('forrent');?></h2>
            </div>

            <div class="row grid-row">
                <?php
                if(count($featured_rent) ){ ?>

                    <?php foreach ($featured_rent as $rent){?>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="item slick_slide">
                                <div class="item-wrap">
                                    <div class="property-item item-grid">
                                        <div class="figure-block">
                                            <figure class="item-thumb">
                                                <span class="label-featured label label-success is_featured"><?=$this->lang->line('featured');?></span>
                                                <div class="price hide-on-list">

                                                    <p class="rant">
                                                        <?=pkrCurrencyFormat($rent->price);?>
                                                    </p>
                                                </div>

                                                <div class="hover-effect">
                                                    <?php
                                                    $List_images = $ci->Listings_model->get_list_images($rent->id);
                                                    if (!empty($List_images)) { ?>

                                                        <div class="slider-mini">
                                                            <?php
                                                            $i = 0;
                                                            $count = 0;
                                                            $length = count($List_images);
                                                            for ($i = 0; $i < $length; $i++) {
                                                                ?>

                                                                <a class="progressive replace hover-effect" href="<?=display_listing_preview('small', $List_images[$i]->picture); ?>"
                                                                   title="<?=ucwords($sale->title)?>" alt="<?=ucwords($sale->title)?>">

                                                                    <img class="preview" src="<?=display_listing_tiny_image($List_images[$i]->picture);?>" alt="image" height="180" />

                                                                </a>


                                                               <!-- <img src="<?=display_listing_preview('small', $List_images[$i]->picture); ?>" class="img-responsive" alt="<?= ($rent->title); ?>">-->

                                                            <?php } ?>
                                                        </div>

                                                    <?php } else { ?>

                                                        <a class="progressive replace hover-effect" href="<?=display_listing_preview('small', $List_images[$i]->picture); ?>"
                                                           title="<?=ucwords($sale->title)?>" alt="<?=ucwords($sale->title)?>">

                                                            <img class="preview" src="<?=display_listing_tiny_image($List_images[$i]->picture);?>" alt="image" height="180" />

                                                        </a>


                                                        <!--<img src="<?=display_listing_preview('small',$rent->preview_image_url);?>" alt="<?=ucwords($rent->title)?>" title="<?=ucwords($rent->title)?>">-->


                                                    <?php } ?>
                                                    <!-- <a href="<?/*=site_url('property/'.$rent->slug.'-'.$rent->id)*/?>" class="hover-effect">
                                                                        <img src="<?/*=display_listing_preview('small',$rent->preview_image_url);*/?>" alt="<?/*=ucwords($rent->title)*/?>" title="<?/*=ucwords($rent->title)*/?>">

                                                                    </a>-->
                                                </div>
                                                <ul class="actions">
                                                    <li>
                                                        <?php if ($this->session->userdata('logged_in')) { ?>
                                                            <span id="<?=$rent->id?>" onClick="loadWishtlistModel(this.id)" data-toggle="modal"><i class="fa fa-heart"></i></span>
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
                                                    <h2 class="property-title"><a href="<?=site_url('property/'.$rent->slug.'-'.$rent->id)?>"><?=character_limiter($rent->title,50)?></a></h2>
                                                    <h4 class="property-location"><i class="flaticon flaticon-location-pin"></i><?=getCityById($rent->city);?>, <?=$rent->state_province?></h4>
                                                </div>
                                                <div class="table-list full-width info-row">
                                                    <div class="cell">
                                                        <div class="info-row amenities">
                                                            <p class="no-margin-b">
                                                                <span><i class="flaticon flaticon-bed"></i><?=($rent->bedrooms == null ? 0 : $rent->bedrooms)?></span>
                                                                <span><i class="flaticon flaticon-bathtub"></i><?=($rent->bathrooms == null ? 0 : $rent->bathrooms)?></span>
                                                                <span><i class="fa fa-object-group"></i>
                                                                    <?php if($rent->unit_id =='Square Feet'){?>
                                                                        <a href="#" data-toggle="popover" data-content="
                                                                            <table class='table table-popover'>
                                                                                <tr>
                                                                                    <th colspan='2'><?=$this->lang->line('land_area');?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><strong><?=$rent->area_sqrft;?></strong></td>
                                                                                    <td><strong><?=$this->lang->line('sqft');?></strong></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$rent->area_sqyard;?></td>
                                                                                    <td><?=$this->lang->line('sqyd');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$rent->area_sqmeter;?></td>
                                                                                    <td><?=$this->lang->line('sqm');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$rent->area_marla;?></td>
                                                                                    <td><?=$this->lang->line('marla');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$rent->area_kanal;?></td>
                                                                                    <td><?=$this->lang->line('kanal');?></td>
                                                                                </tr>
                                                                            </table>
                                                                        ">
                                                                            <?=$rent->area_sqrft;?> - <?=$rent->unit_id;?>
                                                                        </a>
                                                                    <?php } ?>
                                                                    <?php if($rent->unit_id =='Square Yards'){?>
                                                                        <a href="#" data-toggle="popover" data-content="
                                                                            <table class='table table-popover'>
                                                                                <tr>
                                                                                    <th colspan='2'><?=$this->lang->line('land_area');?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$rent->area_sqrft;?></td>
                                                                                    <td><?=$this->lang->line('sqft');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><strong><?=$rent->area_sqyard;?></strong></td>
                                                                                    <td><strong><?=$this->lang->line('sqyd');?></strong></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$rent->area_sqmeter;?></td>
                                                                                    <td><?=$this->lang->line('sqm');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$rent->area_marla;?></td>
                                                                                    <td><?=$this->lang->line('marla');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$rent->area_kanal;?></td>
                                                                                    <td><?=$this->lang->line('kanal');?></td>
                                                                                </tr>
                                                                            </table>
                                                                        ">
                                                                            <?=$rent->area_sqyard;?> - <?=$rent->unit_id;?>
                                                                        </a>
                                                                    <?php } ?>
                                                                    <?php if($rent->unit_id =='Square Meters'){?>
                                                                        <a href="#" data-toggle="popover" data-content="
                                                                            <table class='table table-popover'>
                                                                                <tr>
                                                                                    <th colspan='2'><?=$this->lang->line('land_area');?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$rent->area_sqrft;?></td>
                                                                                    <td><?=$this->lang->line('sqft');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$rent->area_sqyard;?></td>
                                                                                    <td><?=$this->lang->line('sqyd');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><strong><?=$rent->area_sqmeter;?></strong></td>
                                                                                    <td><strong><?=$this->lang->line('sqm');?></strong></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$rent->area_marla;?></td>
                                                                                    <td><?=$this->lang->line('marla');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$rent->area_kanal;?></td>
                                                                                    <td><?=$this->lang->line('kanal');?></td>
                                                                                </tr>
                                                                            </table>
                                                                        ">
                                                                            <?=$rent->area_sqmeter;?> - <?=$rent->unit_id;?>
                                                                        </a>
                                                                    <?php } ?>
                                                                    <?php if($rent->unit_id =='Marla'){?>
                                                                        <a href="#" data-toggle="popover" data-content="
                                                                            <table class='table table-popover'>
                                                                                <tr>
                                                                                    <th colspan='2'><?=$this->lang->line('land_area');?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$rent->area_sqrft;?></td>
                                                                                    <td><?=$this->lang->line('sqft');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$rent->area_sqyard;?></td>
                                                                                    <td><?=$this->lang->line('sqyd');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$rent->area_sqmeter;?></td>
                                                                                    <td><?=$this->lang->line('sqm');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><strong><?=$rent->area_marla;?></strong></td>
                                                                                    <td><strong><?=$this->lang->line('marla');?></strong></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$rent->area_kanal;?></td>
                                                                                    <td><?=$this->lang->line('kanal');?></td>
                                                                                </tr>
                                                                            </table>
                                                                        ">
                                                                            <?=$rent->area_marla;?> - <?=$rent->unit_id;?>
                                                                        </a>
                                                                    <?php } ?>
                                                                    <?php if($rent->unit_id =='Kanal'){?>
                                                                        <a href="#" data-toggle="popover" data-content="
                                                                            <table class='table table-popover'>
                                                                                <tr>
                                                                                    <th colspan='2'><?=$this->lang->line('land_area');?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$rent->area_sqrft;?></td>
                                                                                    <td><?=$this->lang->line('sqft');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$rent->area_sqyard;?></td>
                                                                                    <td><?=$this->lang->line('sqyd');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$rent->area_sqmeter;?></td>
                                                                                    <td><?=$this->lang->line('sqm');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$rent->area_marla;?></td>
                                                                                    <td><?=$this->lang->line('marla');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><strong><?=$rent->area_kanal;?></strong></td>
                                                                                    <td><strong><?=$this->lang->line('kanal');?></strong></td>
                                                                                </tr>
                                                                            </table>
                                                                        ">
                                                                            <?=$rent->area_kanal;?> - <?=$rent->unit_id;?>
                                                                        </a>
                                                                    <?php } ?>
                                                                    <?php if($rent->unit_id =='acre'){?>
                                                                        <a href="#" data-toggle="popover" data-content="
                                                                            <table class='table table-popover'>
                                                                                <tr>
                                                                                    <th colspan='2'><?=$this->lang->line('land_area');?></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$rent->area_sqrft;?></td>
                                                                                    <td><?=$this->lang->line('sqft');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$rent->area_sqyard;?></td>
                                                                                    <td><?=$this->lang->line('sqyd');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$rent->area_sqmeter;?></td>
                                                                                    <td><?=$this->lang->line('sqm');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$rent->area_marla;?></td>
                                                                                    <td><?=$this->lang->line('marla');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><?=$rent->area_kanal;?></td>
                                                                                    <td><?=$this->lang->line('kanal');?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><strong><?=$rent->area_acre;?></strong></td>
                                                                                    <td><strong><?=$this->lang->line('acre');?></strong></td>
                                                                                </tr>
                                                                            </table>
                                                                        ">
                                                                            <?=$rent->area_acre;?> - <?=$rent->unit_id;?>
                                                                        </a>
                                                                    <?php } ?>
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
                        </div>
                    <?php } ?>

                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <a href="<?=site_url();?>search?type=rent" class="btn btn-secondary">View More</a>
                    </div>

                <?php }
                else
                { ?>
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <h5 class="tbc-magazine-custom-subheading"><?=$this->lang->line('no_listing_available');?></h5>
                    </div>
                <?php } ?>
            </div>

        </div>
    </div>
<?php } ?>