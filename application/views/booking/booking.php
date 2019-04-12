<?php defined('BASEPATH') OR exit('No direct script access allowed');
$footer_data['custom_js'] = '';
?>
<style>
    #map {
        width: 100%;
        min-height: 500px !important;
    }
</style>
    <body>

    <section id="splash-section" class="section index-splash">
        <div class="vegas-overlay"></div>
        <div class="splash-inner-media" style="background-image: url(<?=base_url()?>assets/img/background-img1.jpg)"></div>
        <div class="splash-inner-content">
            <?php $this->load->view('includes/menu/home') ;?>
            <div class="container" style="margin-top:40px;">
                <div class="label-wrap">
                    <span class="label label-detail label-primary <?=($listing->purpose == 'rent' ? 'is_rent' : 'is_sale');?>"><?=($listing->purpose == 'rent' ? $this->lang->line('l_for_rent') : $this->lang->line('l_for_sale'));?></span>
                </div>

                <ul class="actions actions-detail">
                    <li class="share-btn">
                        <?php
                        $data = array('list_img' => base_url() . "assets/media/properties/thumbs/".$listing->preview_image_url, 'slug' => $listing->slug.'-'.$listing->id, 'description' => $listing->title.' '.substr($listing->summary, 0, 400));
                        $this->load->view('includes/share', $data);
                        ?>
                        <span title="" data-placement="top" data-toggle="tooltip"
                              data-original-title="share"><i class="fa fa-share-alt"></i></span>
                    </li>
                    <li class="fa-heart-white">

                        <?php if ($this->session->userdata('logged_in')) {
                            $listing->wUserId;$listing->wishlistId;
                            $session_data = $this->session->userdata('logged_in');
                            $uid = $session_data['id'];
                            $listing_user =  $listing->user_id;
                            $wishlist = user_have_wishlist($uid,$listing->id);
                            if($uid != $listing_user){
                                if(count($wishlist) > 0){ ?>
                                    <span class="active" title="" data-placement="top" id="<?= $listing->id ?>" data-toggle="modal" data-original-title="Favorite"><i class="fa fa-heart"></i></span>
                                <?php } else { ?>
                                    <span title="" data-placement="top" id="<?= $listing->id;?>" onclick="loadWishtlistModel(this.id)" data-toggle="modal" data-original-title="Favorite"><i class="fa fa-heart"></i></span>
                                <?php } ?>


                            <?php } else{ ?>
                                <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite"><a href="javascript:void(0)" onClick="alert('You can\'t add your own listing to wishlist!')"><i class="fa fa-heart"></i></a></span>
                            <?php } ?>


                        <?php } else { ?>
                            <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite"><a href="<?= site_url("users/login_status/") ?>"><i class="fa fa-heart"></i></a></span>
                        <?php } ?>

                    </li>
                </ul>

                <div class="clearfix"></div>
                <h1 class="main_title property-name"><?= ucwords($listing->title) ?></h1>

                <div class="table-list p_dtl_ads">
                    <div class="header-left table-cell">
                        <p class="txt-white property-address"><i class="flaticon flaticon-location-pin"></i> <?php echo $listing->property_location; ?></p>
                    </div>
                    <div class="header-right table-cell">
                        <h2 class="item-price property-price">
                            <?=pkrCurrencyFormat($listing->price);?> <span class="item-sub-price" style="display:inline-block"></span>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="section-body">

        <div class="detail-top detail-top-grid no-margin">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <div class="header-detail table-list">
                            <div class="header-left">
                                <ol class="breadcrumb">
                                    <li><a href="<?=site_url('/');?>"><i class="fa fa-home"></i></a></li>

                                    <li><a href="<?=site_url();?>search?page_view=grid&type=<?=$listing->purpose;?>"> <?=ucwords($listing->purpose);?></a></li>

                                    <li><a href="<?=site_url();?>search?page_view=grid&city=<?=$listing->city;?>"><?= getCityById($listing->city) ?></a></li>

                                    <?php if($listing->area):?>
                                    <li><a href="<?=site_url();?>search?page_view=grid&sub_area=<?=$listing->area;?>"><?= getAreaById($listing->area) ?></a></li>
                                    <?php endif;?>

                                    <li class="active"><?= $listing->title; ?></li>

                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="section-detail-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 container-contentbar">
                        <div class="detail-bar">

                            <div class="detail-media detail-top-slideshow">
                                <div class="tab-content">
                                    <div id="gallery" class="tab-pane fade in active">
                                        <!--<span class="label-wrap visible-sm visible-xs">
                                            <span class="label label-primary <?/*=($listing->purpose == 'rent' ? 'is_rent' : 'is_sale');*/?>"><?/*=($listing->property_type == 'rent' ? $this->lang->line('l_for_rent') : $this->lang->line('l_for_sale'));*/?></span>
                                        </span>-->
                                        <div class="slideshow">
                                            <div class="slideshow-main">
                                                <div class="slide text-center">
                                                    <?php if (isset($pictures)) { ?>

                                                        <?php foreach ($pictures as $pic) { ?>
                                                            <figure>
                                                                <!--
                                                                <a href="<?= base_url() ?>assets/media/properties/thumbs/<?= $pic->picture ?>">
                                                                    <img src="<?= base_url() ?>assets/media/properties/thumbs/<?= $pic->picture ?>"  alt="<?= $pic->picture ?>" title="<?= $pic->picture ?>">
                                                                </a>
                                                                -->

                                                                <a class="progressive replace hover-effect" href="<?=display_listing_preview('small',$pic->picture);?>"
                                                                   title="<?=ucwords($pic->picture)?>" alt="<?=ucwords($pic->picture)?>">
                                                                    <img class="preview" src="<?=display_listing_tiny_image($pic->picture);?>" alt="image" />
                                                                </a>



                                                            </figure>
                                                        <?php } ?>

                                                    <?php } else { ?>
                                                        <figure>
                                                            <!--
                                                            <a href="<?= base_url() ?>assets/media/properties/thumbs/<?= $listing->preview_image_url ?>">
                                                                <img src="<?= base_url() ?>assets/media/properties/thumbs/<?= $listing->preview_image_url ?>"  alt="<?= $listing->preview_image_url ?>" title="<?= $listing->preview_image_url ?>"/>
                                                            </a>
                                                            -->

                                                            <a class="progressive replace hover-effect" href="<?=display_listing_preview('small',$listing->preview_image_url);?>"
                                                               title="<?=ucwords($listing->preview_image_url)?>" alt="<?=ucwords($listing->preview_image_url)?>">
                                                                <img class="preview" src="<?=display_listing_tiny_image($listing->preview_image_url);?>" alt="image" />
                                                            </a>


                                                        </figure>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="slideshow-nav-main" style="display:none">
                                                <div class="slideshow-nav">
                                                    <div>
                                                        <img src="<?= base_url() ?>assets/media/properties/thumbs/<?= $pic->picture ?>" width="100" height="70" alt="Slide show thumb">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div id="map" class="tab-pane fade"></div>-->
                                    <!--<div id="street-map" class="tab-pane fade"></div>-->
                                </div>
                                <div class="media-tabs" style="display:none;">
                                    <ul class="media-tabs-list">
                                        <li class="popup-trigger" data-placement="bottom" data-toggle="tooltip" data-original-title="View Photos">
                                            <a href="#gallery" data-toggle="tab"><i class="fa fa-camera"></i></a>
                                        </li>
                                        <!--<li data-placement="bottom" data-toggle="tooltip" data-original-title="Map View"><a href="#map" data-toggle="tab"><i class="fa fa-map"></i></a></li>-->
                                        <!--<li data-placement="bottom" data-toggle="tooltip" data-original-title="Street View"><a href="#street-map" data-toggle="tab"><i class="fa fa-street-view"></i></a></li>-->
                                    </ul>
                                    <ul class="actions">
                                        <li class="share-btn">
                                            <?php
                                            $data = array('list_img' => base_url() . "assets/media/properties/thumbs/".$listing->preview_image_url, 'slug' => $listing->slug.'-'.$listing->id,'description' => $listing->summary);
                                            $this->load->view('includes/share', $data);
                                            ?>
                                            <span data-placement="top" data-toggle="tooltip" data-original-title="share"><i class="fa fa-share-alt"></i></span>
                                        </li>
                                        <li class="fa-heart-white" style="display: none">
                                            <?php if ($this->session->userdata('logged_in')) { ?>

                                                <?php
                                                $session_data = $this->session->userdata('logged_in');
                                                $uid = $session_data['id'];
                                                $listing_user =  $listing->user_id;

                                                if($uid != $listing_user){


                                                    if (count($wishlists->total) > 0) { ?>

                                                        <span class="active" title="" data-placement="top" id="<?= $listing->id ?>" onclick="loadWishtlistModel(this.id)" data-toggle="modal" data-original-title="Favorite"><i class="fa fa-heart"></i></span>

                                                    <?php } else { ?>

                                                        <span title="" data-placement="top" id="<?= $listing->id;?>" onclick="loadWishtlistModel(this.id)" data-toggle="modal" data-original-title="Favorite"><i class="fa fa-heart"></i></span>

                                                    <?php } ?>


                                                <?php } else{ ?>


                                                    <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite"><a href="javascript:void(0)" onClick="alert('You can\'t add your own listing to wishlist!')"><i class="fa fa-heart"></i></a></span>

                                                <?php } ?>



                                            <?php } else { ?>

                                                <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite"><a href="<?= site_url("users/login_status/") ?>"><i class="fa fa-heart"></i></a></span>

                                            <?php } ?>

                                        </li>

                                        <li class="fa-heart-white">
                                            <?php if ($this->session->userdata('logged_in')) { ?>
                                                <?php
                                                $list->wUserId;$list->wishlistId;
                                                $session_data = $this->session->userdata('logged_in');
                                                $uid = $session_data['id'];
                                                $listing_user =  $list->user_id;
                                                if($uid != $listing_user){
                                                    if ($list->wUserId == $uid && $list->wishlistId == $list->listid) { ?>
                                                        <span class="active" title="" data-placement="top" id="<?= $list->listid ?>" data-toggle="modal" data-original-title="Favorite"><i class="fa fa-heart"></i></span>
                                                    <?php } else { ?>
                                                        <span title="" data-placement="top" id="<?= $list->listid;?>" onclick="loadWishtlistModel(this.id)" data-toggle="modal" data-original-title="Favorite"><i class="fa fa-heart"></i></span>
                                                    <?php } ?>
                                                <?php } else{ ?>
                                                    <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite"><a href="javascript:void(0)" onClick="alert('You can\'t add your own listing to wishlist!')"><i class="fa fa-heart"></i></a></span>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite"><a href="<?= site_url("users/login_status/") ?>"><i class="fa fa-heart"></i></a></span>
                                            <?php } ?>
                                        </li>
                                    </ul>
                                </div>
                                
                            </div>
                            <?=$this->load->view('includes/listings/listing_locations');?>
                            <?=$this->load->view('includes/listings/occupancy_details');?>
                            <?=$this->load->view('includes/listings/amenities');?>
                            <?=$this->load->view('includes/listings/floorplans');?>
                            <?=$this->load->view('includes/listings/listing_documents');?>
                            <?=$this->load->view('includes/listings/listing_qualification');?>
                            <?=$this->load->view('includes/listings/listing_video');?>
                            <?=$this->load->view('includes/listings/listing_map');?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-md-offset-0 col-sm-offset-3 container-sidebar">
                        <?php $this->load->view('includes/listing_sidebar');?>

                    </div>
                </div>
            </div>
            <?php $this->load->view('includes/featured_listings'); ?>

        </section>
    </section>
    <div id="lightbox-popup-main" class="fade">
        <div class="lightbox-popup">
            <div class="popup-inner">
                <div class="lightbox-left" style="width: 100%">
                    <div class="lightbox-header">
                        <div class="header-title">
                            <p>
                                <span>
                                     <a href="<?= site_url() ?>" title=""><img
                                                 src="<?= base_url() ?>assets/img/logo-header.png" alt="logo"></a>
                                </span>
                                <span class="hidden-xs"><?= ucwords($listing->title) . " - " .getCityById($listing->city).' '. $listing->state_provience .'  ' .$listing->country; ?>
                                </span>

                            </p>
                        </div>
<!--                        <input type="hidden" value="--><?//=strip_tags($listing->summary);?><!--">-->
                        <div class="header-actions">

                            <ul class="actions">

                                <li class="share-btn">
                                    <?php
                                    $data = array('list_img' => base_url() . "assets/media/properties/thumbs/" .$listing->preview_image_url, 'slug' => $listing->slug.'-'.$listing->id, 'description' => stripHTMLtags($listing->summary));
                                    $this->load->view('includes/share', $data);
                                    ?>
                                    <span title="" data-placement="right" data-toggle="tooltip" data-original-title="share"><i
                                                class="fa fa-share-alt"></i></span>

                                </li>
                                <li class="fa-heart-white">
                                    <?php if ($this->session->userdata('logged_in')) { ?>

                                        <?php
                                        $session_data = $this->session->userdata('logged_in');
                                        $uid = $session_data['id'];
                                        $listing_user =  $listing->user_id;

                                        if($uid != $listing_user){


                                            if (count($wishlists->total) > 0) { ?>

                                                <span class="active" title="" data-placement="top" id="<?= $listing->id ?>" onclick="loadWishtlistModel(this.id)" data-toggle="modal" data-original-title="Favorite"><i class="fa fa-heart"></i></span>

                                            <?php } else { ?>

                                                <span title="" data-placement="top" id="<?= $listing->id;?>" onclick="loadWishtlistModel(this.id)" data-toggle="modal" data-original-title="Favorite"><i class="fa fa-heart"></i></span>

                                            <?php } ?>


                                        <?php } else{ ?>


                                            <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite"><a href="javascript:void(0)" onClick="alert('You can\'t add your own listing to wishlist!')"><i class="fa fa-heart"></i></a></span>

                                        <?php } ?>



                                    <?php } else { ?>

                                        <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite"><a href="<?= site_url("users/login_status/") ?>"><i class="fa fa-heart"></i></a></span>

                                    <?php } ?>

                                </li>
                                <li class="lightbox-expand visible-xs compress">
                                    <span><i class="fa fa-envelope-o"></i></span>
                                </li>
                                <li class="lightbox-close">
                                    <span><i class="fa fa-close"></i></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="gallery-area">
                        <div class="slider-placeholder">
                            <div class="loader-inner">
                                <span class="fa fa-spin fa-spinner"></span> Loading Slider...
                            </div>
                        </div>
                        <div class="expand-icon lightbox-expand hidden-xs"></div>
                        <div class="gallery-inner">
                            <div class="lightbox-slide slide-animated">
                                <?php if (isset($pictures)) { ?>

                                    <?php
                                    foreach ($pictures as $pic) {
                                        ?>
                                        <div>
                                            <img src="<?= base_url() ?>assets/media/properties/thumbs/<?= $pic->picture ?>"
                                                 alt="Lightbox Slider" width="1170" height="525">

                                        </div>

                                    <?php } ?>

                                    <!-- Gallery Section Ends -->
                                <?php } else { ?>
                                    <div>
                                        <a href="#"><img
                                                    src="<?= base_url() ?>assets/media/properties/thumbs/<?= $listing->preview_image_url ?>"/></a>
                                    </div>
                                <?php } ?>


                            </div>
                        </div>
                        <div class="lightbox-slide-nav visible-xs">
                            <button class="lightbox-arrow-left lightbox-arrow"><i class="fa fa-angle-left"></i></button>
                            <p class="lightbox-nav-title">Luxury apartment by view</p>
                            <button class="lightbox-arrow-right lightbox-arrow"><i class="fa fa-angle-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view('listings/veiw_application'); ?>
<?php $this->load->view('includes/apply_for_listing'); ?>
<?php $this->load->view('includes/set_appointment'); ?>

