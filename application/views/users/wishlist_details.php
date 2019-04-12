<?php defined('BASEPATH') OR exit('No direct script access allowed');
$ci = &get_instance();
$ci->load->model('Listings_model');
?>
<body>
<?php $this->load->view('dashboard/dashboard-header'); ?>

<section id="section-body">
    <div class="container">


        <div class="user-dashboard-full">
            <?php $this->load->view('dashboard/dashboard-sidebar'); ?>
            <div class="profile-area-content">
                <div class="profile-top">
                    <div style="display:none" class="Metronic-alerts wishlist_notice alert alert-success fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        Your wishlist has been deleted successfully
                    </div>
                    <?php
                    $session_data = $this->session->userdata('logged_in');
                    $avatar = $session_data['picture'];
                    ?>
                    <div class="profile-top-left">
                        <a href="<?= site_url("user-wishlists") ?>" class="title">
                            <?php
                            $session_data = $this->session->userdata('logged_in');
                            $uid = $session_data['id'];
                            echo ucwords($session_data['full_name']).'\'s';
                            ?> <?=$this->lang->line('wish_list');?>
                        </a>
                        <div class="info" style="font-size:12px">
                            <span><?= ucfirst($Wishcat[0]->name); ?>:</span>
                            <strong><?= count($wishlists); ?></strong>
                            <a style="color:#9d7f48;" href="javascript:;" id="<?= $Wishcat[0]->id; ?>" onclick="updateWishCat(this.id)">Edit</a>
                        </div>
                    </div>
                </div>

            </div>
            <script type="text/javascript">
                var arr_info = [];
                <?php
                if ($wishlists != '') {
                    // echo 'isiset';die;
                    $js_array = json_encode($positions);
                    echo "var locations = " . $js_array . ";\n";
                }
                ?>
            </script>
            <div class="portlet-body property-listing list-view" id="wishlist_container">
                <div class="tabbable tabs-left">
                    <!--<ul class="profile-menu-tabs nav nav-tabs" id="WishListMapSection">
                        <li class="active">
                            <a href="#wihslist_listing" data-toggle="tab" aria-expanded="true">List View</a>
                        </li>
                        <li class="">
                            <a href="#wishlist_map" data-toggle="tab" aria-expanded="false">Map View </a>
                        </li>
                    </ul>-->
                    <div class="tab-content">
                        <div class="tab-pane active in " id="wihslist_listing">
                            <div class="portlet-body">
                                <div class="wishlist_detail">
                                    <div class="row">
                                        <?php if ($wishlists != '') { ?>
                                            <?php foreach ($wishlists as $lists): ?>
                                                <?php

                                                $List_images = $ci->Listings_model->get_list_images($lists->listingid);
                                                ?>
                                                <div class="col-md-12">
                                                <div class="item-wrap" id="wishListsRow_<?= $lists->listingid; ?>">
                                                    <div class="property-item table-list">
                                                        <div class="table-cell wishListGallery">
                                                            <div class="figure-block-w">
                                                                <figure class="item-thumb">
                                                                    <?php if (!empty($List_images)) { ?>
                                                                        <div class="widget wishlist_slider">
                                                                            <div class="widget-body">
                                                                                <div class="wishlist-widget-slider">
                                                                                    <?php
                                                                                    $i = 0;
                                                                                    $count = 0;
                                                                                    $length = count($List_images);
                                                                                    for ($i = 0; $i < $length; $i++) {
                                                                                    ?>
                                                                                        <div class="item">
                                                                                                <figure class="item-thumb">
                                                                                                        <img src="<?= base_url(); ?>assets/media/properties/thumbs/<?= $List_images[$i]->picture; ?>" class="img-responsive" alt="<?= ($lists->title); ?>">
                                                                                                </figure>
                                                                                        </div>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php } else {
                                                                        if($lists->image !== ''){
                                                                            ?>
                                                                            <img src="<?= base_url(); ?>assets/media/properties/small/<?= $lists->image; ?>" class="img-responsive" alt="<?= ($lists->title); ?>">
                                                                        <?php } else { ?>
                                                                            <img src="<?= base_url(); ?>assets/img/placeholder.png"  width="318"/>
                                                                       <?php }?>

                                                                    <?php } ?>
                                                                </figure>
                                                            </div>
                                                        </div>
                                                        <div class="item-body table-cell">

                                                            <div class="body-left table-cell">
                                                                <div class="info-row">
                                                                    <h2 class="property-title"><a href="<?= site_url("property"); ?>/<?= $lists->slug.'-'.$lists->listingid; ?>"><?= ($lists->title); ?></a></h2>
                                                                    <h4 class="property-location"><?= $lists->property_location; ?></h4>
                                                                </div>
                                                                <div class="info-row amenities hide-on-grid">
                                                                    <p>
                                                                        <span> <?= $lists->room_type; ?></span>
                                                                        <span>Beds: <i class="fa fa-check"></i> <?= $lists->bedrooms; ?></span>
                                                                        <span>Baths: <?= $lists->bathrooms; ?></span>
                                                                        <span>Sqft: <?= $lists->area_sqrft; ?></span>
                                                                        <span>Type: <i class="fa fa-check"></i> <?= $lists->property_type; ?></span>
                                                                    </p>
                                                                </div>
                                                                <div class="info-row">
                                                                    <div class="form-group" id="msg_box_<?= $lists->id; ?>">
                                                                        <div class="loader" style="display:none;margin-left:40%"><img src="<?= base_url(); ?>assets/img/loading-spinner-default.gif"></div>
                                                                        <textarea class="form-control" id="message_note_<?= $lists->id; ?>" name="message"><?= $lists->note; ?></textarea>
                                                                    </div>
                                                                    <button type="button" id="<?= $lists->id; ?>" onclick="updateUserNote(this.id)" class="btn btn-sm btn-primary">Save Note</button>
                                                                    <div id="wishlist_response_<?= $lists->id; ?>"></div>
                                                                </div>
                                                            </div>
                                                            <div class="body-right table-cell hidden-gird-cell wishListsPricing">
                                                                <div class="info-row price">
                                                                    <h3><?=pkrCurrencyFormat($lists->price);?></h3>
                                                                    <br/>
                                                                    <a href="javascript:;" class="label label-danger" id="<?= $lists->listingid; ?>" onclick="removeWishList(this.id)">Remove</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                </div>

                                                <!--<a href="javascript:;" class="btn blue" id="<?= $lists->listingid; ?>" onclick="loadWishtlistModel(this.id)">Change</a>-->
                                            <?php endforeach; ?>
                                        <?php } else { ?>
                                            <div class="col-md-12" style="padding-right:4px;padding-left:4px;">
                                                <div class="article-detail text-center"><h1>Oh oh! No Listing found.</h1><p></p></div>
                                            </div>
<!--                                            <p>No Listing found</p>-->
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane active in" style="height: 0.1px;overflow: hidden;" id="wishlist_map">
                            <div class="maps-csettings">
                                <?php if ($wishlists != '') { ?>
                                    <?php foreach ($wishlists as $lists): ?>
                                    <?php $review = $ci->Listings_model->get_listing_review($lists->listingid);
                                    if ($review) {
                                        $listing_review['rating'] = round($review->rating, 2) * 20;
                                        $listing_review['total'] = $review->total;
                                    } else {
                                        $listing_review['rating'] = 0;
                                        $listing_review['total'] = 0;
                                    }
                                    ?>
                                    <script type="text/javascript">
                                        <?php
                                        $title_clear = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($lists->listing_name))))));
                                        $summary_clear = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($lists->summary))))));
                                        if (is_file($abs_path . '/assets/media/properties/thumbs/' . $lists->image)) {
                                            if (file_exists($abs_path . '/assets/media/properties/thumbs/' . $lists->image)) {
                                                $list_img = base_url() . "assets/media/properties/thumbs/" . $lists->image;
                                            } else {
                                                $list_img = base_url() . "assets/img/placeholder.png";
                                            }
                                        } else {
                                            $list_img = base_url() . "assets/img/placeholder.png";
                                        }
                                        ?>
                                        arr_info[<?= $lists->listingid ?>] = '<div class="package-text map-popup-bg">' +
                                            '<a href="<?= site_url('booking/detail/'.$lists->slug) ?>">'+
                                            '<img width="225" height="160" class="map-popup-img" src="<?= $list_img ?>" alt=""></a>' +
                                            '<strong class="map-popup-price">$<?= $lists->price ?></strong>' +
                                            '<div><div class="star-ratings-sprite" style="margin-top:2%"><span style="width:<?= $listing_review['rating'] ?>*20 ?>%" class="rating"></span></div></div>' +
                                            '<a href="<?= site_url('booking/detail/'.$lists->slug) ?>"><address class="package-address guest-map-desc"><?= $lists->typed_address ?></address></a>' +
                                            '<strong><?= $lists->bedrooms ?> BR, <?= $lists->bathrooms ?> BA, Sleeps <?= $lists->accommodates ?></strong>' +
                                            '</div>';
                                    </script>
                                <?php endforeach; ?>
                                    <div id="listing_map" style="width: 100%; height:100%;"></div>
                                <?php } else { ?>
                                    <div class="col-md-12" style="padding-right:4px;padding-left:4px;">
                                        <div class="article-detail text-center"><h1>Oh oh! No Listing found.</h1><p></p></div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>


    </div>
</section>


<!-- END CONTAINER -->
