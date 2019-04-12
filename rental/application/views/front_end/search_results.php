<?php if($listings) { ?>
    <div class="col-lg-7 check-rates-cn">
        <section class="package-list">
            <div class="sort-view clearfix ajax_pagingsearc">
                <div class="sort-by float-left"><?php echo $links;?></div>
            </div>
            <script type="text/javascript">
                var arr_info = [];
            </script>
            <?php
            // print_r($reviews);
            foreach($listings as $list){?>
                <div class="package-list-cn row" data_id="<?=$list->listid?>">
                    <div class="package-item col-md-12">
                        <figure class="package-img col-md-4">
                            <?php

                            if(is_file($abs_path.'/assets/media/listings/search_thumbs/'.$list->image)){
                                if (file_exists($abs_path.'/assets/media/listings/search_thumbs/'.$list->image)) {
                                    $list_img=$search_img.$list->image;
                                }else{
                                    $list_img=base_url()."assets/img/placeholder.png";
                                }
                            }else{
                                $list_img=base_url()."assets/img/placeholder.png";
                            }
                            ?>
                            <a href="<?=site_url("booking/detail/".$list->slug)?>"><img src="<?=$list_img?>"  alt=""></a>
                        </figure>
                        <div class="package-text col-md-8">
                            <div class="list_info col-md-9">
                                <a href="<?=site_url("booking/detail/".$list->slug)?>" class="listing-name-custom"><?=ucwords($list->listing_name)?></a>
                                <address class="package-address listing-address-custom"><?php echo $list->address_line_1.' '.$list->address_line_2.', '.$list->city_town.', '.$list->state_province.' '.$list->zip_postal_code?></address>
                                <div class="hometype">Home Type: <?php echo $list->home_type;?></div>
                                <div><span class="bedrooms">Bedrooms : <?php echo $list->bedrooms;?></span>
                                    <span>Beds: <?php echo $list->beds;?></span></div>
                                <div>Accommodates: <?php echo $list->accommodates;?></div>
                                <!--<span class="package-star star-default-color"><i class="glyphicon glyphicon-star"></i> <i class="glyphicon glyphicon-star"></i>
                                                              <i class="glyphicon glyphicon-star"></i> <i class="glyphicon glyphicon-star"></i>
                                                              <i class="glyphicon glyphicon-star"></i></span>-->
                                <div><div class="star-ratings-sprite"><span style="width:<?= $reviews[$list->listid]['rating'] ?>%" class="rating"></span></div>
                                    <span class="package-rating star-no-color"><ins class="package-rating-mini-customs"><?= $reviews[$list->listid]['total'] ?></ins> - Reviews</span>
                                </div>

                            </div>
                            <div class=" col-md-3">
                                <div class="price separately"><ins class="listing-price-custom">
                                        <?=PkrFormat($list->price)?>
                                        <span class="listing-price-brief-custom"> (per night)</span></ins></div>
                                <a href="<?=site_url("booking/detail/".$list->slug)?>" class="awe-btn awe-btn-1 awe-btn-small">BOOK NOW</a>
                                <div class="listing-wishlist-container">
                                    <?php if ($this->session->userdata('logged_in')) { ?>
                                        <a  class="awe-btn awe-btn-1 awe-btn-small" id="<?=$list->listid?>" onclick="loadWishtlistModel(this.id)" data-toggle="modal">Add to Wishlist</a>
                                    <?php } else{ ?>
                                        <a  href="<?= site_url("users/login_status/")?>" class="awe-btn awe-btn-1 awe-btn-small"> Add to Wishlist</a>
                                    <?php } ?>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>





            <?//=$list->listid .'id'.$list->id;?>
                <script type="text/javascript">

                    <?php
                    $title_clear = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($list->listing_name))))));
                    $summary_clear = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($list->summary))))));
                    ?>

                    arr_info[<?=$list->id?>] = '<div class="package-text map-popup-bg">'+
                        '<a href="<?=site_url('booking/detail/'.$list->slug)?>"><img class="map-popup-img" src="<?=$list_img?>" alt=""></a>'+
                        '<strong class="map-popup-price"><?=PkrFormat($list->price)?></strong>'+
                        '<div><span class="package-star star-ratings-sprite" style="display: inline-block;margin-top:6px;margin-bottom:0px">'+
                        '</span> <span class="package-rating guest-map-color"><ins class="package-rating-mini-customs"><?= $reviews[$list->listid]['total'] ?> / 5</ins> - Guest Rate</span></div>'+
                        '<a href="<?=site_url('booking/detail/'.$list->slug)?>"><address class="package-address guest-map-desc"><?=$list->typed_address?></address></a>'+
                        '<strong><?=$list->bedrooms?> BR, <?=$list->bathrooms?> BA, Sleeps <?=$list->accommodates?></strong>'+
                        '</div>';

                </script>





            <?php } ?>


            <div class="page-navigation-cn ajax_pagingsearc" >
                <center><?php echo $links;?></center>
            </div>
        </section>
    </div>
    <div class="col-lg-5  data-sticky_column">
        <div id="search_map" class="listed-map"></div>


    </div>
    <script type="text/javascript">
        <?php
        if(isset($listings)) {
            $js_array = json_encode($positions);
            echo "var locations = ". $js_array . ";\n";
        }//if end ?>
    </script>
    <?php
} else {?>
    <div class="page-navigation-cn no_results">
        <center> Sorry No Listing Found! </center>

    </div>
<?php }?>
