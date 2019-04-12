<!-- 
    Note : This view will be replaced with Views->Users->wishlist_details ____Orignal.php
    Once Site Will be live
    This is just for the demonstration of Dummy Data
-->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$ci = &get_instance();
$ci->load->model('Listings_model');
?>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-sidebar-closed-hide-logo">
    <!-- BEGIN HEADER -->
    <?php $this->load->view('dashboard/dashboard-header'); ?>
    <!-- END HEADER -->
    <div class="clearfix"></div>
    <!-- BEGIN CONTENT -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <?php $this->load->view('dashboard/dashboard-sidebar'); ?>
        <!-- END SIDEBAR -->
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-head">
                    <div class="page-title">
                        <h1>Reviews <small>All the reviews have shown here</small></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN VALIDATION STATES-->
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div style="display:none" class="Metronic-alerts wishlist_notice alert alert-success fade in">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                  Your wishlist has been deleted successfully
                              </div>
                              <?php
                              $session_data = $this->session->userdata('logged_in');
                              $avatar = $session_data['picture'];
                              ?>
                              <div class="caption">
                                <a style="font-size:13px;font-weight: bold;color:#9d7f48;" href="<?= site_url("user-wishlists") ?>">
                                    <?php
                                    $session_data = $this->session->userdata('logged_in');
                                    $uid = $session_data['id'];
                                    echo ucwords($session_data['full_name']) . '\'s';
                                    ?> 
                                    Wishlists
                                </a>
                                <div class="info" style="font-size:12px">
                                    <span><?= ucfirst($Wishcat[0]->name); ?>:</span>
                                    <strong><?= count($wishlists); ?></strong> 
                                    <a style="color:#9d7f48;" href="javascript:;" id="<?= $Wishcat[0]->id; ?>" onclick="updateWishCat(this.id)">Edit</a>
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
                            <div class="portlet-body" id="wishlist_container">
                                <div class="tabbable tabs-left">
                                    <ul class="nav nav-tabs" id="WishListMapSection">
                                        <li class="active">
                                            <a href="#wihslist_listing" data-toggle="tab" aria-expanded="true">List View</a>
                                        </li>
                                        <li class="">
                                            <a href="#wishlist_map" data-toggle="tab" aria-expanded="false">Map View </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active in " id="wihslist_listing">
                                            <div class="portlet-body">
                                                <div class="wishlist_detail">
                                                    <?php if ($wishlists != '') { ?>
                                                    <?php foreach ($wishlists as $lists): ?>
                                                        <?php

                                                        $List_images = $ci->Listings_model->get_list_images($lists->listingid);
                                                        ?>
                                                        <div class="row wishListsRow" id="wishListsRow_<?= $lists->listingid; ?>">
                                                            <div class="col-md-12 news-page">
                                                                <div class="row">
                                                                    <div class="col-md-4 wishListGallery">
                                                                        <?php if (!empty($List_images)) { ?>
                                                                        <div id="myCarousel<?= $lists->id; ?>" class="carousel image-carousel slide">
                                                                            <div class="carousel-inner">
                                                                                <?php
                                                                                $i = 0;
                                                                                $count = 0;
                                                                                $length = count($List_images);
                                                                                for ($i = 0; $i < $length; $i++) {
                                                                                    ?>
                                                                                    <div class="item <?php
                                                                                    if ($count == 0) {
                                                                                        echo 'active';
                                                                                    };
                                                                                    ?>">
                                                                                    <img src="<?= base_url(); ?>assets/media/listings/listings/<?= $List_images[$i]->picture; ?>" class="img-responsive" alt="">
                                                                                </div>
                                                                                <?php
                                                                                $count++;
                                                                            }
                                                                            ?> 
                                                                        </div>
                                                                        <a class="carousel-control left" href="#myCarousel<?= $lists->id; ?>" data-slide="prev">
                                                                            <i class="m-icon-big-swapleft m-icon-white"></i>
                                                                        </a>
                                                                        <a class="carousel-control right" href="#myCarousel<?= $lists->id; ?>" data-slide="next">
                                                                            <i class="m-icon-big-swapright m-icon-white"></i>
                                                                        </a>
                                                                    </div>
                                                                    <?php } else { ?>
                                                                    <img src="<?= base_url(); ?>assets/img/placeholder.png"  width="318"/>
                                                                    <?php } ?>
                                                                </div>
                                                                <!--end col-md-5-->
                                                                <!--start col-md-right-->
                                                                <div class="col-md-5 blog-article">
                                                                    <a href="<?= site_url("booking/detail"); ?>/<?= $lists->slug; ?>"><h2>
                                                                        <?= character_limiter($lists->listing_name, 20); ?></h2></a>
                                                                        <p><?= $lists->typed_address; ?></p>
                                                                        <ul class="list-inline">
                                                                            <li>
                                                                                <i class="fa fa-check"></i> <?= $lists->home_type; ?>
                                                                            </li>
                                                                            <li>
                                                                                <i class="fa fa-check"></i> <?= $lists->room_type; ?>
                                                                            </li>
                                                                            <li>
                                                                                <i class="fa fa-check"></i> Sleeps <?= $lists->beds; ?>
                                                                            </li>
                                                                        </ul>
                                                                        <div class="general-item-list">
                                                                            <div class="item">
                                                                                <div class="item-body">
                                                                                    <div class="form-group" id="msg_box_<?= $lists->id; ?>">
                                                                                        <div class="loader" style="display:none;margin-left:40%"><img src="<?= base_url(); ?>assets/img/loading-spinner-default.gif"></div>
                                                                                        <textarea class="form-control" id="message_note_<?= $lists->id; ?>" name="message" rows="2"><?= $lists->note; ?></textarea>
                                                                                    </div>
                                                                                    <button type="button" id="<?= $lists->id; ?>" 
                                                                                        onclick="updateUserNote(this.id)" class="btn green">Save Note</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>    
                                                                        </div>
                                                                        <!--end col-md-right-->
                                                                        <!-- start right most -->
                                                                        <div class="col-md-3">
                                                                            <div class="caption wishListsPricing">
                                                                                <h2><?= PkrFormat($lists->price); ?> <small>(per night)</small></h2>
                                                                                <p>
                                                                                    <!--<a href="javascript:;" class="btn blue" id="<?= $lists->listingid; ?>" onclick="loadWishtlistModel(this.id)">Change</a>-->                                                                                <a href="javascript:;" class="btn red" id="<?= $lists->listingid; ?>" onclick="removeWishList(this.id)">Remove</a>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <!-- end right most -->        
                                                                    </div>
                                                                    <div class="space20">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                        <?php } else { ?>
                                                        <p>No Listing found</p>
                                                        <?php } ?>
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
                                                            if (is_file($abs_path . '/assets/media/listings/listings/' . $lists->image)) {
                                                                if (file_exists($abs_path . '/assets/media/listings/listings/' . $lists->image)) {
                                                                    $list_img = base_url() . "assets/media/listings/listings/" . $lists->image;
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
                                                            '<strong class="map-popup-price"><?=PkrFormat($lists->price) ?></strong>' +
                                                            '<div><div class="star-ratings-sprite" style="margin-top:2%"><span style="width:<?= $listing_review['rating'] ?>*20 ?>%" class="rating"></span></div></div>' +
                                                            '<a href="<?= site_url('booking/detail/'.$lists->slug) ?>"><address class="package-address guest-map-desc"><?= $lists->typed_address ?></address></a>' +
                                                            '<strong><?= $lists->bedrooms ?> BR, <?= $lists->bathrooms ?> BA, Sleeps <?= $lists->accommodates ?></strong>' +
                                                            '</div>';
                                                        </script>
                                                    <?php endforeach; ?>
                                                    <div id="listing_map" style="width: 100%; height:100%;"></div>
                                                    <?php } else { ?>
                                                    <div id="listing_map" style="width: 100%; height:100%;">No Listing Found</div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END VALIDATION STATES-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTAINER -->
