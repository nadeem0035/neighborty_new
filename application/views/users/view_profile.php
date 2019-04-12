<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<body>
    <?php $this->load->view('dashboard/dashboard-header'); ?>
    <?php //$this->load->view('templates/quick_searchform'); ?>


    <section id="section-body">
        <div class="container">
            <div class="page-title breadcrumb-top"></div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-md-offset-0 col-sm-offset-3 container-sidebar">
                    <aside id="sidebar" class="sidebar-white account-block">

                        <div class="widget userProfile">
                            <div class="widget-top text-center" style="margin:0;">
                                <img src="<?=display_user_avatar($user->picture);?>"  alt="Agent Thumb" width="280" height="280" style="margin:0;">
                                <br/><br/>
                                <?php if ($edit_profile) { ?>
                                    <a href="<?= site_url("users/edit-profile"); ?>">Edit Profile</a>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="widget widget-verified">
                            <div class="widget-top">
                                <h3 class="widget-title">Verified info</h3>
                            </div>
                            <div class="widget-body">
                                <ul>
                                    <li>Government ID  <img src="<?=base_url('assets/img/icon-verified.png');?>"></li>
                                    <li>Personal info <img src="<?=base_url('assets/img/icon-verified.png');?>"></li>
                                    <li>Email address  <img src="<?=base_url('assets/img/icon-verified.png');?>"></li>
                                    <li>Phone number  <img src="<?=base_url('assets/img/icon-verified.png');?>"></li>
                                </ul>
                            </div>
                        </div>

                        <div class="widget widget-info">
                            <div class="widget-top">
                                <h3 class="widget-title">About Me</h3>
                            </div>
                            <div class="widget-body">
                                <ul>
                                    <!--<li><label>Gender</label><p><?/*= $user->gender; */?></p></li>-->
                                    <li><strong>School</strong><br/>University of Chicago</li>
                                    <li><strong>Work</strong><br/>United Airlines</li>
                                    <li><strong>Languages</strong><br/><?= $user->languages; ?></li>
                                </ul>
                            </div>
                        </div>
                    </aside>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 container-contentbar">
                    <div class="detail-bar">
                        <h1><?= $user->first_name . " " . $user->last_name; ?>'s Profile </h1>
                        <p>
                            <?php if(isset($user->city) && $user->city !=NULL){ echo $user->city.','; } ;?>
                            <?php if(isset($user->state)  && $user->state !=NULL){ echo $user->state.',';} ?> <?= $user->country; ?>
                            <strong>Joined </strong> <?= date("F Y", strtotime($user->registered_date)); ?>
                        </p>

                        <div class="detail-block">
                            <div class="detail-title">
                                <h2 class="title-left">Favorite Properties (<?= count($wishlists)?>)</h2>
                            </div>

                            <div class="property-listing grid-view grid-view-3-col">
                                <div class="row">
                                    <?php
                                    if (isset($wishlists) && $wishlists != NULL) {
                                    foreach ($wishlists as $wishlist) {
                                    ?>

                                    <div class="item-wrap">
                                        <div class="property-item-grid">
                                            <figure class="item-thumb">
                                                <a href="<?=site_url("property/".$wishlist->slug.'-'.$wishlist->listingid)?>" class="hover-effect">
                                                    <img src="<?=display_listing_preview('search_thumbs',$wishlist->preview_image_url);?>" alt="thumb">
                                                </a>
                                                <div class="price">
                                                    <?php if($wishlist->property_type == 'sale'){ ?>
                                                        <span class="item-price"><?=pkrCurrencyFormat($wishlist->price);?></span>
                                                    <?php } else if ($wishlist->property_type == 'rent'){ ?>
                                                        <span class="item-price"><?=pkrCurrencyFormat($wishlist->price);?></span>
                                                    <?php } ?>
                                                </div>
                                                <ul class="actions">
                                                    <li>
                                                    <span title="" data-placement="top" data-toggle="tooltip" data-original-title="Favorite">
                                                        <i class="fa fa-heart"></i>
                                                    </span>
                                                    </li>
                                                    <li class="share-btn">
                                                        <div class="share_tooltip fade">
                                                            <a target="_blank" href="#"><i class="fa fa-facebook"></i></a>
                                                            <a target="_blank" href="#"><i class="fa fa-twitter"></i></a>
                                                            <a target="_blank" href="#"><i class="fa fa-google-plus"></i></a>
                                                            <a target="_blank" href="#"><i class="fa fa-pinterest"></i></a>
                                                        </div>
                                                        <span title="" data-placement="top" data-toggle="tooltip" data-original-title="share"><i class="fa fa-share-alt"></i></span>
                                                    </li>
                                                    <li>
                                                    <span data-toggle="tooltip" data-placement="top" title="" data-original-title="Photos (12)">
                                                        <i class="fa fa-camera"></i>
                                                    </span>
                                                    </li>
                                                </ul>
                                                <div class="item-caption">
                                                    <div class="label-wrap">
                                                        <span class="label label-primary"><?=$wishlist->property_type?></span>
                                                    </div>
                                                    <h4 class="item-caption-title"><a href="<?=site_url("property/".$wishlist->slug.'-'.$wishlist->listingid)?>"><?= $wishlist->listing_name; ?></a></h4>
                                                    <ul class="item-caption-list">
                                                        <li><?=$wishlist->beds?> bd</li>
                                                        <li><?=$wishlist->bathrooms?> ba</li>
                                                        <li><?=$wishlist->sqrft?> sqft</li>
                                                    </ul>
                                                </div>
                                            </figure>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    } else {?>
                                        <div class="col-md-12" style="padding-right:4px;padding-left:4px;">
                                            <div class="article-detail text-center"><h1>Oh oh! No Listing found.</h1><p></p></div>
                                        </div>

                                    <?php } ?>
                                </div>
                            </div>

                            <?php
/*                            if (isset($listings) && $listings != NULL) { */?><!--
                                <?php /* foreach ($listings as $list) {*/?>

                                    <?php
/*                                    if(is_file($abs_path.'/assets/media/listings/search_thumbs/'.$list->preview_image_url)){
                                        if (file_exists($abs_path.'/assets/media/listings/search_thumbs/'.$list->preview_image_url)) {
                                            $list_img=$search_img.$list->preview_image_url;
                                        }else{
                                            $list_img=base_url()."assets/img/placeholder.png";
                                        }
                                    }else{
                                        $list_img=base_url()."assets/img/placeholder.png";
                                    }
                                    */?>


                                <?php /*} */?>
                            --><?php /*} else {
                                echo "<!--<p class='text-center' style='margin-bottom:0;text-align:center;'>No Record found</p>-->";
                            }
                            */?>
                        </div>


                        <div class="detail-block">
                            <div class="detail-title">
                                <h2 class="title-left">Reviews (<?= count($reviews_by)?>)</h2>
                            </div>

                            <div class="comments-block">
                                <div class="row">

                                <?php
                                if (isset($reviews_by) && $reviews_by != NULL) {
                                    foreach ($reviews_by as $review_by) {
                                        $rating = round($review_by->rating * 20, 2);
                                        ?>
                                        <div class="media author-comment-this comment-u">
                                            <div class="media-left text-center">
                                                <a href="<?=site_url('agent/profile/'.$review_by->agent_id)?>">
                                                    <img src="<?=display_user_avatar($review_by->picture);?>" class="img-circle" alt="Agent Thumb" width="65" height="65">
                                                    <br/>
                                                    <?= ucfirst($review_by->first_name)?>
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="feedback-str pull-right">
                                                    <div class="star-ratings-sprite pull-left"><span style="width:<?= $rating ?>%" class="rating"></span></div>
                                                    <!--<b class="pull-left"><?/*= number_format($rating / 20, 1); */?></b>-->
                                                </div>
                                                <p><?= strip_tags($review_by->review); ?></p>
                                                <ul>
                                                   <!-- <li><a class="list-title" href='<?/*= site_url("booking/detail/$review_by->slug"); */?>'>Location Appartement<?/*= ucfirst($review_by->listing_name); */?></a></li>-->
                                                   <!-- <li>-</li>-->
                                                    <li><?= date("F j, Y", strtotime($review_by->date_time)); ?></li>
                                                </ul>
                                            </div>
                                        </div>



                                        <?php
                                    }
                                } else { ?>
                                    <div class="col-md-12" style="padding-right:4px;padding-left:4px;">
                                        <div class="article-detail text-center"><h1>Oh oh! No Record found.</h1><p></p></div>
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






<!--                             <div class="form-group"><h3><span class="reviews-bolder">References</span></h3> </div>
<div class="form-group" style="margin-left: 6%;margin-right: 6%;">                                                    
                            <?php
                            if (isset($references_to) && $references_to != NULL) {
                                foreach ($references_to as $reference_to) {
                                    ?>
                                                                <div class="col-md-12" >
                                                                <div class="col-md-2 text-center">
                                                                <img class="img-circle" width="100px" height="100px" src="<?= base_url() . $users_avatar . 'small/' . $reference_to->picture; ?>">
                                                                <h4><span class="reviews-bolder"><?= $reference_to->first_name . " " . $reference_to->last_name; ?></span></h4>
                                                                </div>
                                                                <div class="col-md-10">
                                                                <div class="review-detail"><?= strip_tags($reference_to->review); ?></div>
                                                                <span class="pull-left" style="color:#75571E; font-weight:700"> <?= date("F j, Y, g:i A", strtotime($reference_to->date_time)); ?></span></a>
                                                                <span class="pull-right" style="color:#333; font-weight:700"><?= $reference_to->relation; ?></span></a>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <hr>
                                                                </div>
                                                                <div class="clearfix"></div>
                                    <?php
                                }
                            } else {
                                echo "<h3>No Record found</h3>";
                            }
                            ?>
<div class="clearfix"></div>
</div>          
 -->