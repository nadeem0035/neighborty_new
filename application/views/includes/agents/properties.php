<div class="ajax-loader_icon" id="loading" style="display:none"><img src="<?=base_url('assets/img/loading-spinner-default.gif');?>" /></div>
<style>
/*#myList li.list{ display:none;  }*/
#loadMore {
    margin-top:15px;
    cursor:pointer;
}
#loadMore:hover {
    color:black;
}
#showLess {
    color:red;
    cursor:pointer;
}
#showLess:hover {
    color:black;
}
</style>


<div class="activity-map-wrapper">

    <div class="filter">
        <section id="select_all">
            <?php if(count($listings)){ ?>
            <div class="property-listing grid-view grid-view-3-col">
                <div class="row">
                    <ul id="myList">
                        <?php foreach($listings as $list){ ?>
                        <li class="list item-wrap <?=($list->property_type == 'sale' ? 'sale_property':'rent_property')?>" id="all">
                            <div class="property-item-grid">
                                <figure class="item-thumb">
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
                                    <a href="<?=site_url("property/".$list->slug.'-'.$list->id)?>" class="hover-effect">
                                        <img src="<?=$list_img?>" alt="<?=ucwords($list->listing_name)?>">
                                    </a>
                                    <div class="label-wrap label-left">
                                        <?php if($list->active == 'Sold'){ ?>
                                        <span class="label label-primary sold">Sold</span>
                                        <?php } else{ ?>
                                        <span class="label label-primary <?=($list->property_type == 'sale' ? 'sale':'rent')?>"><?=($list->property_type == 'rent' ? 'For Rent' : 'For Sale');?></span>
                                        <?php } ?>
                                        <span class="label label-dark"><?=date("F jS, Y", strtotime($list->date_created));?></span>


                                    </div>
                                    <div class="price">

                                        <span class="item-price"><?=pkrCurrencyFormat($list->price);?></span>

                                    </div>

                                        <div class="item-caption">
                                            <div class="label-wrap"></div>
                                            <h4 class="item-caption-title"><a href="<?=site_url("property/".$list->slug.'-'.$list->id)?>" class="listing-name-custom"><?=ucwords($list->listing_name)?></a></h4>
                                            <ul class="item-caption-list">

                                                <li><?=$this->lang->line('l_room');?>: <?=($list->pieces == null ? 0 : $list->pieces)?></li>
                                                <li><?=$this->lang->line('l_broom');?>: <?=($list->bedrooms == null ? 0 : $list->bedrooms)?></li>
                                                <li><?=$this->lang->line('l_bathroom');?>: <?=($list->bathrooms == null ? 0 : $list->bathrooms)?></li>
                                                <li><?=$top->area;?> <?=$top->unit;?></li>


                                            </ul>
                                        </div>
                                    </figure>
                                </div>

                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12 text-center">
<!--                    --><?php //if(count($listings) > 9){ ?>
<!--                    <div id="loadMore" class="btn btn-primary btn-md">Load More</div>-->
<!--                    --><?php //} ?>
                </div>
                <?php }  ?>
            </section>
            <section id="select_sale" style="display: none">
                <?php if(count($listings)){ ?>
                <div class="property-listing grid-view grid-view-3-col">
                    <div class="row">
                        <ul id="list_sale">
                            <?php foreach($listings as $list ){ ?>
                            <?php if($list->property_type == 'sale' && $list->active !='Sold') { ?>
                            <li class="list item-wrap <?=($list->property_type == 'sale' ? 'sale_property':'rent_property')?>" id="all">
                                <div class="property-item-grid">
                                    <figure class="item-thumb">
                                        <?php
                                        if (file_exists($abs_path.'/assets/media/listings/search_thumbs/'.$list->preview_image_url)) {
                                            $list_img=$search_img.$list->preview_image_url;
                                        }else{
                                            $list_img=base_url()."assets/img/placeholder.png";
                                        }
                                        ?>
                                        <a href="<?=site_url("property/".$list->slug.'-'.$list->id)?>" class="hover-effect">
                                            <img src="<?=$list_img?>" alt="<?=ucwords($list->listing_name)?>">
                                        </a>
                                        <div class="label-wrap label-left">
                                            <span class="label label-primary <?=($list->property_type == 'sale' ? 'sale':'rent')?>">For <?=$list->property_type;?></span>
                                            <?php if($list->active == 'sold'){ ?>
                                            <span class="label label-danger">Sold</span>
                                            <?php } ?>
                                            <span class="label label-dark"><?=date("F jS, Y", strtotime($list->date_created));?></span>
                                        </div>
                                        <div class="price">
                                            <span class="item-price"><?=pkrCurrencyFormat($list->price);?></span>
                                        </div>

                                            <div class="item-caption">
                                                <div class="label-wrap"></div>
                                                <h4 class="item-caption-title"><a href="<?=site_url("property/".$list->slug.'-'.$list->id)?>" class="listing-name-custom"><?=ucwords($list->listing_name)?></a></h4>
                                                <ul class="item-caption-list">

                                                    <li><?=$this->lang->line('l_room');?>: <?=($list->pieces == null ? 0 : $list->pieces)?></li>
                                                    <li><?=$this->lang->line('l_broom');?>: <?=($list->bedrooms == null ? 0 : $list->bedrooms)?></li>
                                                    <li><?=$this->lang->line('l_bathroom');?>: <?=($list->bathrooms == null ? 0 : $list->bathrooms)?></li>
                                                    <li><?=$top->area;?> <?=$top->unit;?></li>


                                                </ul>
                                            </div>
                                        </figure>
                                    </div>

                                </li>
                                <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12 text-center">
<!--                        --><?php //if(count($sale) > 9){ ?>
<!--                        <div id="loadMore" class="btn btn-primary btn-md">Load More </div>-->
<!--                        --><?php //} ?>
                    </div>
                    <?php } else { ?>
                    <section class="section-detail-content page-navigation-cn no_results" style="margin-top:50px;">
                        <div class="page-main">
                            <div class="article-detail text-center">
                                <h1>No listing found against this agent</h1>
                                <p>Please check back later</p>
                            </div>
                        </div>
                    </section>
                    <?php } ?>
                </section>
                <section id="select_rent" style="display:none">
                    <?php if(count($listings)){ ?>
                    <div class="property-listing grid-view grid-view-3-col">
                        <div class="row">
                            <ul id="list_rent">
                                <?php $i = 1;?>
                                <?php foreach($listings as $list){ ?>
                                <?php if($list->property_type == 'rent' && $list->active != 'Sold') { ?>
                                <li class="list item-wrap <?=($list->property_type == 'sale' ? 'sale_property':'rent_property')?>" id="all">
                                    <div class="property-item-grid">
                                        <figure class="item-thumb">
                                            <?php
                                            if(is_file($abs_path.'/assets/media/listings/search_thumbs/'.$list->preview_image_url)){
                                                if (file_exists($abs_path.'/assets/media/listings/search_thumbs/'.$list->preview_image_url)) {
                                                    $list_img=$search_img.$list->preview_image_url;
                                                }else{
                                                    $list_img=base_url()."assets/img/placeholder.png";
                                                }
                                            }else{
                                                $list_img=base_url()."assets/img/placeholder.png";
                                            }
                                            ?>
                                            <a href="<?=site_url("property/".$list->slug.'-'.$list->id)?>" class="hover-effect">
                                                <img src="<?=$list_img?>" alt="<?=ucwords($list->listing_name)?>">
                                            </a>
                                            <div class="label-wrap label-left">
                                                <span class="label label-primary <?=($list->property_type == 'sale' ? 'sale':'rent')?>">For <?=$list->property_type;?></span>
                                                <?php if($list->active == 'sold'){ ?>
                                                <span class="label label-danger">Sold</span>
                                                <?php } ?>
                                                <span class="label label-dark"><?=date("F jS, Y", strtotime($list->date_created));?></span>
                                            </div>
                                            <div class="price">

                                                <span class="item-price"><?=pkrCurrencyFormat($list->price);?></span>

                                            </div>

                                                <div class="item-caption">
                                                    <div class="label-wrap"></div>
                                                    <h4 class="item-caption-title"><a href="<?=site_url("property/".$list->slug.'-'.$list->id)?>" class="listing-name-custom"><?=ucwords($list->listing_name)?></a></h4>
                                                    <ul class="item-caption-list">
                                                        <li><?=$this->lang->line('l_room');?>: <?=($list->pieces == null ? 0 : $list->pieces)?></li>
                                                        <li><?=$this->lang->line('l_broom');?>: <?=($list->bedrooms == null ? 0 : $list->bedrooms)?></li>
                                                        <li><?=$this->lang->line('l_bathroom');?>: <?=($list->bathrooms == null ? 0 : $list->bathrooms)?></li>
                                                        <li><?=$top->area;?> <?=$top->unit;?></li>
                                                    </ul>
                                                </div>
                                            </figure>
                                        </div>

                                    </li>
                                    <?php } ?>
                                    <?php $i++;?>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12 text-center">
<!--                            --><?php //if(count($rent) > 9){ ?>
<!--                            <div id="loadMore" class="btn btn-primary btn-md">Load More</div>-->
<!--                            --><?php //} ?>
                        </div>
                        <?php } else { ?>
                        <section class="section-detail-content page-navigation-cn no_results" style="margin-top:50px;">
                            <div class="page-main">
                                <div class="article-detail text-center">
                                    <h1>No listing found against this agent</h1>
                                    <p>Please check back later</p>
                                </div>
                            </div>
                        </section>
                        <?php } ?>
                    </section>
                    <section id="select_sold" style="display: none">
                        <?php if(count($listings)){ ?>
                        <div class="property-listing grid-view grid-view-3-col">
                            <div class="row">
                                <ul id="list_sale">
                                    <?php foreach($listings as $list){ ?>
                                    <?php if($list->active == 'Sold') { ?>
                                    <li class="list item-wrap <?=($list->property_type == 'sale' ? 'sale_property':'rent_property')?>" id="all">
                                        <div class="property-item-grid">
                                            <figure class="item-thumb">
                                                <?php
                                                if (file_exists($abs_path.'/assets/media/listings/search_thumbs/'.$list->preview_image_url)) {
                                                    $list_img=$search_img.$list->preview_image_url;
                                                }else{
                                                    $list_img=base_url()."assets/img/placeholder.png";
                                                }
                                                ?>
                                                <a href="<?=site_url("property/".$list->slug.'-'.$list->id)?>" class="hover-effect">
                                                    <img src="<?=$list_img?>" alt="<?=ucwords($list->listing_name)?>">
                                                </a>
                                                <div class="label-wrap label-left">
                                                    <span class="label label-primary sold">Sold</span>
                                                    <span class="label label-dark"><?=date("F jS, Y", strtotime($list->date_created));?></span>
                                                </div>
                                                <div class="price">
                                                    <?php if($list->property_type == 'sale'){ ?>
                                                    <span class="item-price"><?=pkrCurrencyFormat($list->price);?></span>
                                                    <?php } else if ($list->property_type == 'rent'){ ?>
                                                    <span class="item-price"><?=pkrCurrencyFormat($list->price);?></span>
                                                    <?php } ?>
                                                </div>
                                                <div class="item-caption">
                                                    <div class="label-wrap"></div>
                                                    <h4 class="item-caption-title"><a href="<?=site_url("property/".$list->slug.'-'.$list->id)?>" class="listing-name-custom"><?=ucwords($list->listing_name)?></a></h4>
                                                    <ul class="item-caption-list">
                                                        <li><?=$this->lang->line('l_room');?>: <?=($list->pieces == null ? 0 : $list->pieces)?></li>
                                                        <li><?=$this->lang->line('l_broom');?>: <?=($list->bedrooms == null ? 0 : $list->bedrooms)?></li>
                                                        <li><?=$this->lang->line('l_bathroom');?>: <?=($list->bathrooms == null ? 0 : $list->bathrooms)?></li>
                                                        <li><?=$top->area;?> <?=$top->unit;?></li>
                                                    </ul>
                                                </div>
                                            </figure>
                                        </div>

                                    </li>
                                    <?php } ?>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12 text-center">
<!--                            --><?php //if(count($sold) > 9){ ?>
<!--                            <div id="loadMore" class="btn btn-primary btn-md">Load More</div>-->
<!--                            --><?php //} ?>
                        </div>
                        <?php } else { ?>
                        <section class="section-detail-content page-navigation-cn no_results" style="margin-top:50px;">
                            <div class="page-main">
                                <div class="article-detail text-center">
                                    <h1>No listing found against this agent</h1>
                                    <p>Please check back later</p>
                                </div>
                            </div>
                        </section>
                        <?php } ?>
                    </section>
                </div>
            </div>