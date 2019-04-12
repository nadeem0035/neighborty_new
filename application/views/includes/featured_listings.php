<?php if($featured):?>

    <div id="carousel-module-grid" class="houzez-module carousel-module">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="module-title-nav clearfix">
                        <div>
                            <h2><?=$this->lang->line('featured_properties');?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row grid-row">
                        <div class="properties-carousel-grid carousel  slide-animated">
                            <?php foreach ($featured as $top):?>
                                <div class="item">
                                    <div class="item-wrap">
                                        <div class="property-item item-grid">
                                            <div class="figure-block">
                                                <figure class="item-thumb">
                                                    <div class="label-wrap label-left hide-on-list">
                                                        <div class="label-status label label-default <?=($top->property_type == 'rent' ? 'is_rent' : 'is_sale');?>"><?=($top->property_type == 'rent' ?  $this->lang->line('l_for_rent'): $this->lang->line('l_for_sale') );?></div>
                                                        <span class="label label-success"><?=$this->lang->line('l_sponsored');?></span>
                                                    </div>

                                                    <div class="price hide-on-list">
                                                        <h3><?=pkrCurrencyFormat($top->price);?><?php if($top->property_type == 'rent') { ?>
                                                                <span style="font-weight: 200 !important;font-size: 13px;">Per Month</span>
                                                            <?php } ?>
                                                        </h3>
                                                    </div>

                                                    <a class="progressive replace hover-effect" href="<?=display_listing_preview('small',$top->preview_image_url);?>"
                                                       title="<?=ucwords($top->title)?>" alt="<?=ucwords($top->title)?>">
                                                        <img class="preview" src="<?=display_listing_tiny_image($top->preview_image_url);?>" alt="image" />
                                                    </a>


                                                   <!-- <a href="<?=site_url("property/".$top->slug.'-'.$top->id)?>" class="hover-effect" style="background-image:url('<?=display_listing_preview('small',$top->preview_image_url);?>');" alt="<?=$top->listing_name;?>" title="<?=$top->listing_name;?>"></a>-->

                                                    <ul class="actions">
                                                        <li class="fa-heart-white">

                                                            <?php if ($this->session->userdata('logged_in')) {
                                                                $listing->wUserId;$listing->wishlistId;
                                                                $session_data = $this->session->userdata('logged_in');
                                                                $uid = $session_data['id'];
                                                                $listing_user =  $top->user_id;
                                                                $wishlist = user_have_wishlist($uid,$top->id);
                                                                if($uid != $listing_user){
                                                                    if(count($wishlist) > 0){ ?>
                                                                        <span class="active"id="<?= $top->id ?>" data-toggle="modal"><i class="fa fa-heart"></i></span>
                                                                    <?php } else { ?>
                                                                        <span id="<?= $top->id;?>" onclick="loadWishtlistModel(this.id)" data-toggle="modal"><i class="fa fa-heart"></i></span>
                                                                    <?php } ?>


                                                                <?php } else{ ?>
                                                                    <span><a href="javascript:void(0)" onClick="alert('You can\'t add your own listing to wishlist!')"><i class="fa fa-heart"></i></a></span>
                                                                <?php } ?>


                                                            <?php } else { ?>
                                                                <span><a href="<?= site_url("users/login_status/") ?>"><i class="fa fa-heart"></i></a></span>
                                                            <?php } ?>

                                                        </li>
                                                    </ul>
                                                </figure>
                                            </div>
                                            <div class="item-body">
                                                <div class="body-left">
                                                    <div class="info-row">
                                                        <h2 class="property-title"><a href="<?=site_url("property/".$top->slug.'-'.$top->id)?>"><?=ucwords($top->title)?></a></h2>
                                                        <h4 class="property-location"><?=$top->property_location?></h4>
                                                    </div>
                                                    <div class="table-list full-width info-row">
                                                        <div class="cell">
                                                            <div class="info-row amenities">

                                                                <p>
                                                                    <span><?=$this->lang->line('bedrooms');?>: <?=($top->bedrooms == null ? 0 : $list->bedrooms)?></span>
                                                                    <span><?=$this->lang->line('bathrooms');?>: <?=($top->bathrooms == null ? 0 : $list->bathrooms)?></span>
                                                                    <span>
                                                                                       <?=$this->lang->line('property_area');?> :


                                                                        <?php if($top->unit_id =='Square Feet'){?>

                                                                            <?=$top->area_sqrft;?>

                                                                        <?php } ?>
                                                                        <?php if($top->unit_id =='Square Yards'){?>

                                                                            <?=$top->area_sqyard;?>

                                                                        <?php } ?>
                                                                        <?php if($top->unit_id =='Square Meters'){?>

                                                                            <?=$top->area_sqmeter;?>

                                                                        <?php } ?>
                                                                        <?php if($top->unit_id =='Marla'){?>

                                                                            <?=$top->area_marla;?>

                                                                        <?php } ?>
                                                                        <?php if($top->unit_id =='Kanal'){?>

                                                                            <?=$top->area_kanal;?>

                                                                        <?php } ?>

                                                                        <?php if($top->unit_id =='acre'){?>

                                                                            <?=$top->area_acre;?>

                                                                        <?php } ?>

                                                                        - <?=$top->unit_id;?>

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
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif;?>