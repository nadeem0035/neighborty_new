<?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); ?>
<body>
<?php $this->load->view('templates/'.$topmenu); ?>
<?php $this->load->view('templates/quick_searchform'); ?>


<section id="section-body">
    <div class="container">
        <div class="membership-page-top">



            <div class="row">
                <div class="col-md-5">
                    <h1>Verify Your Business Phone Number for <?=$name;?></h1>
                    <p>To protect you and your business we need to verify your association with this business. If this phone number is incorrect you can add an extension or change the business <a href="#">phone number</a>.</p>
                    <h5 style="display:none">How would you like to verify?</h5>

                    <div class="widget-range verify_content" style="display:none">
                        <div class="widget-body">
                            <div class="range-block">
                                <div class="media-left">
                                    <i class="fa fa-mobile"></i>
                                </div>
                                <div class="media-body">
                                    <span>Text me at (843) 617-0537</span>
                                    <p>Neighborty will send a 4-digit verification code via SMS. You’ll submit this code on the next screen.</p>
                                </div>
                            </div>
                            <div class="range-block">
                                <div class="media-left">
                                    <i class="fa fa-mobile"></i>
                                </div>
                                <div class="media-body">
                                    <span>Call me at (843) 617-0537</span>
                                    <p>Neighborty will call you and a verification code will be displayed on the next screen. Submit this code using your phone.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-1"></div>
                <div class="col-md-6 sidebar-white">
                    <div class="widget widget-rated">
                        <div class="widget-body">
                            <div class="media">
                                <div class="media-left">
                                    <div class="profile-image" style="position:relative;">
                                        <img class="img-circle" src="<?= display_user_avatar($picture); ?>" alt="<?=$name;?>" width="350" height="350">
                                        <span class="agent_badge" title="" data-placement="top" data-toggle="tooltip" data-original-title="<?=$agent_type?>"><img src="<?=base_url()?>assets/img/agent_badge.png" width="" height="" alt="">
                                        </span>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h1 class="agent-title">
                                        <?=(agent_name);?>
                                        <?php if($city != ''):?>
                                            <span class="position"><?=$city?>, </span>
                                        <?php endif;?>
                                        <?php if($state != ''):?>
                                            <span class="position"><?=$state?></span>
                                        <?php endif;?>
                                    </h1>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="widget widget-rated" style="display:none">
                        <div class="widget-body">
                            <div class="media">
                                <div class="media-left">
                                    <figure class="item-thumb">
                                        <a class="hover-effect" href="#">
                                            <img alt="thumb" src="images/widgets/01_100x75.jpg" width="100" height="85">
                                        </a>
                                    </figure>
                                </div>
                                <div class="media-body">
                                    <span class="label label-default <?=($list->property_type == 'rent' ? 'is_rent' : 'is_sale');?>">
                                        <?=($list->property_type == 'rent' ? 'Rent' : 'Sale');?>
                                    </span>
                                    <h4 class="item-caption-title><a href="<?=site_url("property/".$list->slug.'-'.$list->listid)?>"><?=ucwords($list->listing_name)?></a></h4>
                                    <div class="amenities">
                                        <p>
                                            <?=($list->pieces == null ? 0 : $list->pieces)?> p
                                            <span style="padding:0 8px; color:rgba(0,0,0,0.55);">|</span>
                                            <?=($list->bedrooms == null ? 0 : $list->bedrooms)?> chb
                                            <span style="padding:0 8px; color:rgba(0,0,0,0.55);">|</span>
                                            <?=number_format((float)$list->sqrft);?> m²
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
</section>
