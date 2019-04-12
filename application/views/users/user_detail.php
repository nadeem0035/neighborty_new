<?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); ?>
<body>
<section id="splash-section" class="section index-splash" style="height:265px;">
    <div class="vegas-overlay"></div>
    <div class="splash-inner-media" style="background-image: url(<?=base_url()?>assets/img/background-img1.jpg)"></div>
    <div class="splash-inner-content">
        <?php $this->load->view('includes/menu/home') ;?>
        <div class="container text-center" style="margin-top:35px;">
            <h2 class="main_title"> User Profile</h2>
        </div>
    </div>
</section>
<style>
    .morecontent span {
        display: none;
    }
    .morelink {
        display: block;
    }
</style>
<?php  $session_data = $this->session->userdata('logged_in'); $uid = $session_data['id'];?>
<section id="section-body">
    <div class="container">
        <div class="page-title breadcrumb-top">
            <div class="row">
                <div class="col-sm-12">
                    <div class="profile-detail-block agent-detail">
                        <div class="row">
                            <div class="col-sm-2 col-xs-12">
                                <div class="profile-image">
                                    <img class="img-circle" src="<?= display_user_avatar($agent->picture); ?>" alt="<?=$agent->first_name . " " . $agent->last_name;?>" width="350" height="350">
                                    <span class="agent_badge" title="" data-placement="top" data-toggle="tooltip" data-original-title="<?=$agent->agent_type?>"><img src="<?=base_url()?>assets/img/agent_badge.png" width="" height="" alt=""></span>
                                </div>
                            </div>
                            <div class="col-md-10 col-sm-8 col-xs-12">
                                <div class="profile-description">
                                    <h1 class="agent-title">
                                        <?= $agent->first_name . " " . $agent->last_name; ?>
                                        <?php if($agent->city != ''):?>
                                            <span class="position"><?=$agent->city?>, </span>
                                        <?php endif;?>
                                        <?php if($agent->state != ''):?>
                                            <span class="position"><?=$agent->state?></span>
                                        <?php endif;?>
                                    </h1>

                                    <?php if (isset($reviews_all)) {
                                        foreach($reviews_all as $review){
                                            $knowl[] = $review->knowledge;
                                            $expert[] = $review->expertise;
                                            $resp[] = $review->responsiveness;
                                            $negoskill[] = $review->negotiation_skills;
                                        }
                                        $knolage_rating = array_sum($knowl)/$total;
                                        $expert_rating = array_sum($expert)/$total;
                                        $resp_rating = array_sum($resp)/$total;
                                        $negoskill_rating = array_sum($negoskill)/$total;
                                    }
                                    ?>

                                    <div class="profile-rating">
                                        <div class="rating">
                                            <div class="star-ratings-sprite" style="margin-top:0px; float:left;"><span style="width:<?= $rating ?>%" class="rating"></span></div>
                                        </div>
                                        <div id="sp_section" onclick="ratingsPlus()">
                                            <span data-toggle="tooltip" data-placement="top" title="" data-original-title="View Detail">
                                                 <i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
                                            </span>
                                            <?=$this->lang->line('ap_See_my_note');?>
                                        </div>
                                        <span style="padding:0px 8px; color:rgba(255,255,255,0.55);">|</span>
                                        <label><?php if($total > 0 ) { echo $total." - Comments"; } else { echo $this->lang->line('ap_no_comments'); }?></label>
                                        <span style="padding:0px 8px; color:rgba(255,255,255,0.55);">|</span>
                                        <label><?=count($recommendations)?> <?=(count($recommendations) > 1 ?'Recommendations':'Recommendation') ;?></label>
                                    </div>
                                    <div class="profile-rating colaprating row">
                                        <div class="col-md-3">
                                            <label class="left"><?=$this->lang->line('ap_k_sector');?></label>
                                            <div class="skil-rating">
                                                <div class="star-ratings-sprite" style="margin-top:0px; float:left;"><span style="width:<?= $knolage_rating * 20 ?>%" class="rating"></span></div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <label class="left"><?=$this->lang->line('ap_expertise');?></label>
                                            <div class="skil-rating">
                                                <div class="star-ratings-sprite" style="margin-top:0px; float:left;"><span style="width:<?= $expert_rating * 20 ?>%" class="rating"></span></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="left"><?=$this->lang->line('ap_response_time');?></label>
                                            <div class="skil-rating">
                                                <div class="star-ratings-sprite" style="margin-top:0px; float:left;"><span style="width:<?= $resp_rating * 20 ?>%" class="rating"></span></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="left"><?=$this->lang->line('ap_negotiation');?></label>
                                            <div class="skil-rating">
                                                <div class="star-ratings-sprite" style="margin-top:0px; float:left;"><span style="width:<?= $negoskill_rating * 20 ?>%" class="rating"></span></div>
                                            </div>
                                        </div>

                                    </div>


                                    <ul class="profile-overlay-actions actions">

                                        <?php if($agent->id != $uid):?>
                                            <?php if($session_data['active']){?>
                                                <li><a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#questionModal"><i class="fa fa-question-circle"></i><?=$this->lang->line('ap_ask_question');?></a></li>
                                            <?php } else { ?>
                                                <li><a onclick="IfQuickContactForm()" class="btn btn-secondary"><i class="fa fa-question-circle"></i> <?=$this->lang->line('ap_ask_question');?></a></li>
                                            <?php } ?>
                                            <?php if($uid == ''){?>
                                                <li><a href="<?=site_url('users/login_status');?>" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i> <?=$this->lang->line('ap_write_comment');?></a></li>
                                            <?php } else{?>
                                                <li><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#reviewModal"><i class="fa fa-pencil-square-o"></i> <?=$this->lang->line('ap_write_comment');?></a></li>
                                            <?php } ?>

                                            <?php if($uid !=''){?>
                                                <li><a href="#" class="btn btn-primary" data-toggle="modal" data-target="#recommendModal"><i class="fa fa-thumbs-up"></i> <?=$this->lang->line('ap_recommended');?></a></li>
                                            <?php }else{?>
                                                <li><a href="<?=site_url('users/login_status');?>" class="btn btn-primary"><i class="fa fa-thumbs-up"></i> <?=$this->lang->line('ap_recommended');?></a></li>

                                            <?php } ?>

                                            <?php //if($agent->topup > 0){?>
                                            <!--<li><a href="javascript:void(0)" id="<?=$agent->id;?>" class="agent_contact_info btn btn-primary" data-toggle="modal" data-target="#"><i class="fa fa-envelope"></i> Contact</a></li>-->
                                            <?php //} else{?>
                                            <?php if($uid == ''){?>
                                                <li><a href="<?=site_url('users/login_status');?>" class="btn btn-primary" ><i class="fa fa-envelope"></i> <?=$this->lang->line('ap_contact');?></a></li>
                                            <?php } else{ ?>
                                                <li><a href="javascript:void(0)" id="<?=$agent->id;?>" class="btn btn-primary" data-toggle="modal" data-target="#companyInfo"><i class="fa fa-envelope"></i> <?=$this->lang->line('ap_contact');?></a></li>

                                            <?php } ?>
                                            <?php //} ?>

                                        <?php endif;?>
                                        <?php
                                        $data = array('list_img' => base_url() . "assets/media/users_avatar/" .$folder. $pic);
                                        ?>
                                        <li class="share-btn">
                                            <a href="#" class="btn btn-primary"><i class="fa fa-share-square-o"></i> <?=$this->lang->line('ap_share');?></a>
                                            <?php $this->load->view('includes/share_agent', $data);?>
                                        </li>
                                    </ul>

                                    <!--Ask a Question Modal-->
                                    <div class="modal fade" id="questionModal" tabindex="-1" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content host-modal">
                                                <div class="modal-header host-modal-header">
                                                    <h4 class="modal-title">Ask a question</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                                                </div>
                                                <div class="modal-body host-modal-body">
                                                    <div class="row">
                                                        <div class="col-sm-3 col-xs-12">

                                                            <div class="profile-image">

                                                                <a href="<?=site_url()?>agent/profile/<?=$agent->id?>">
                                                                    <img src="<?=display_user_avatar($agent->picture);?>" alt="<?= $agent->first_name . " " . $agent->last_name; ?>" width="350" height="350">
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-9 col-sm-12 col-xs-12">
                                                            <div class="form-small">
                                                                <h3>Contact <?= $agent->first_name . " " . $agent->last_name; ?></h3>

                                                                <form id="contacthostform_<?= $agent->id ?>" class="form">

                                                                    <div class="form-group">
                                                                        <?php if ( $session_data['first_name'] == '' ) { ?>
                                                                            <input class="form-control" required name="fullname" value=""
                                                                                   type="text" placeholder="Full Name">
                                                                        <?php }else {?>
                                                                            <input class="form-control" required name="fullname"
                                                                                   value="<?= $session_data['first_name'] ." ". $session_data['last_name'] ?>"
                                                                                   type="text" placeholder="Full Name">
                                                                        <?php } ?>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input class="form-control" required name="email"
                                                                               value="<?= $session_data['email'] ?>" type="email" placeholder="Email">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input class="form-control" required name="phone"
                                                                               value="<?= $session_data['phone'] ?>" type="text" placeholder="Phone">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <textarea class="form-control" required name="message" rows="7" placeholder="">Hi <?= $agent->first_name . " " . $agent->last_name; ?>,Hello, (..), I saw your profile on Mayraghar.neighborty.com I would like to know if you can help me with my research.
                                                                        </textarea>
                                                                    </div>
                                                                    <input type="hidden" name="receiver_id" value="<?= $agent->id ?>"/>
                                                                    <a id="<?= $agent->id ?>" onclick="validateQuickContactForm(this.id)" class="btn btn-secondary btn-block">Ask Question
                                                                    </a>
                                                                    <div class="form-group">
                                                                        <div id="contact_response_<?= $agent->id ?>"></div>
                                                                    </div>

                                                                </form>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Recommend Modal-->
                                    <div class="modal fade" id="recommendModal" tabindex="-1" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content host-modal">
                                                <div class="modal-header host-modal-header">
                                                    <h4 class="modal-title">Recommendations <?= $agent->first_name . " " . $agent->last_name; ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                                                </div>
                                                <div class="modal-body host-modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                                            <div class="form-small">
                                                                <div id="response_suc" style="color:green;"></div>
                                                                <form id="user_recommendation" class="form">
                                                                    <div class="form-group">
                                                                        <label class="form-contral">Name *</label>
                                                                        <input type="text" class="form-control" name="poster_name" value="<?=$session_data['first_name'].' '.$session_data['first_name'];?>" readonly required="true">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="form-contral">Email *</label>
                                                                        <input type="email" class="form-control" name="poster_email" value="<?=$session_data['email'];?>" required="true" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="form-contral">Recommandation *</label>
                                                                        <textarea required name="recommendation" rows="3" class="form-control"></textarea>
                                                                    </div>
                                                                    <input type="hidden" name="agent_id" value="<?= $agent->id ?>" />
                                                                    <button type="submit" class="btn btn-secondary" onclick="addRecommendation()">Send</button>
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <div class="form-group"><div id="recm_response"></div></div>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Contact Info Modal-->
                                    <div class="modal fade" id="agentInfo" tabindex="-1" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content host-modal">
                                                <div class="modal-header host-modal-header">
                                                    <h4 class="modal-title">Contact</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                                                </div>
                                                <div class="modal-body host-modal-body">
                                                    <div class="row">
                                                        <div class="col-sm-3 col-xs-12">
                                                            <div class="profile-image">
                                                                <a href="<?=site_url()?>agent/profile/<?=$agent->id?>">
                                                                    <img src="<?=display_user_avatar($agent->picture);?>" alt="Agent Thumb" width="350" height="350">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-9 col-xs-12">
                                                            <ul class="profile-contact" style="margin-top:0px !important;">
                                                                <li><span>ADDRESS:</span> <?=$agent->location?></li>
                                                                <li><span>PHONE:</span> <?=$agent->phone?></li>
                                                                <li class="email"><span>Email:</span> <a href="mailto:<?=$agent->email?>"><?=$agent->email?></a></li>
                                                            </ul>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php $this->load->view('templates/agent_contact');?>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="property-menu-wrap">
                <div class="container">
                    <ul class="property-menu">
                        <li><a class="back-top" href="#header-section"><i class="fa fa-long-arrow-up"></i> Back to top</a></li>
                        <li><a class="target" href="#listing">Properties Listed </a></li>
                        <li><a class="target" href="#team">Team or Agencies</a></li>
                        <li><a class="target" href="#reviews-section">Rating and Comments </a></li>
                        <li><a class="target" href="#recommend-section">Recommandations</a></li>
                    </ul>
                </div>
            </div>

            <section class="detail-top detail-top-grid">
                <div class="container">
                    <div class="property-menuWrap">
                        <div class="container">
                            <ul class="property-menu">
                                <li><a class="target active" href="#about"><?=$this->lang->line('ap_about');?></a></li>
                                <li><a class="target" href="#listing"><?=$this->lang->line('ap_properties_listed');?> </a></li>
                                <?php if(count($teams)) { ?>
                                    <li><a class="target" href="#team"><?=$this->lang->line('ap_team_agency');?></a></li>
                                <?php } ?>
                                <li><a class="target" href="#reviews-section"><?=$this->lang->line('ap_rate_comment');?> </a></li>
                                <li><a class="target" href="#recommend-section"><?=$this->lang->line('ap_recommandations');?></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="detail-media">

                        <div id="about" class="agent-description detail-block target-block">
                            <div class="detail-title">
                                <h2 class="title-left"><?=$this->lang->line('ap_about');?> <?= $agent->first_name . " " . $agent->last_name; ?></h2>

                                <?php if($uid == $agent->id) { ?>
                                    <div class="title-right">
                                        <a class="btn btn-primary btn-md" href="<?=site_url('users/edit-profile');?>"><i class="fa fa-pencil"></i> Edit profile</a>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <p><?=$agent->about;?></p>
                                </div>
                                <div class="col-sm-3">
                                    <ul class="profile-contact">
                                        <li><span><?=$this->lang->line('ap_member_since');?> :</span> <?=date("M  Y",strtotime($agent->registered_date))?></li>
                                        <?php if($agent->city != ''):?>
                                            <li><span><?=$this->lang->line('ap_city_disc');?> :</span> <?=$agent->city?>, <?=$agent->state?></li>
                                        <?php endif;?>
                                    </ul>
                                </div>
                                <div class="col-sm-3">
                                    <ul class="profile-contact">
                                        <li><span><?=$this->lang->line('ap_price_range');?> :</span> <?=pkrCurrencyFormat($min);?> - <?=pkrCurrencyFormat($max);?> </li>
                                        <?php if(count($recommendation)> 1):?>
                                            <li><span><?=(count($recommendations) > 1 ?'Recommendations':'Recommendation') ;?> :</span> <?=count($recommendations)?> </li>
                                        <?php endif;?>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                </div>


                            </div>

                        </div>

                    </div>
                </div>
            </section>

            <section id="section-body">
                <section class="section-detail-content">
                    <div class="detail-bar">

                        <div id="listing" class="property-description detail-block target-block">
                            <?php if(count($listings)){ ?>
                                <div class="detail-title">
                                    <h2 class="title-left"><?=$this->lang->line('ap_p_listed');?></h2>
                                    <div class="title-right">
                                        <ul class="nav navTabs nav-pills">
                                            <li style="line-height:30px;padding-right:6px;"><lable><?=$this->lang->line('ap_property');?>:</lable></li>
                                            <li class="active"><a onclick="getProperty(this,'all',<?=$agent->id;?>)" href="javascript:void(0)"> <?=$this->lang->line('ap_see_all');?> <span>(<?=count($listings);?>)</span></a></li>
                                            <?php if(count($sale)):?>
                                                <li><a id="sale" onclick="getProperty(this,'sale',<?=$agent->id;?>)"  href="javascript:void(0)"> <?=$this->lang->line('ap_sale');?> <span>(<?=count($sale);?>)</span></a></li>
                                            <?php endif;?>
                                            <?php if(count($rent)):?>
                                                <li><a id="rent" onclick="getProperty(this,'rent',<?=$agent->id;?>)"  href="javascript:void(0)"> <?=$this->lang->line('ap_rent');?> <span>(<?=count($rent);?>)</span></a></li>
                                            <?php endif;?>



                                            <?php if(count($sold)):?>
                                                <li><a id="sold" onclick="getProperty(this,'sold',<?=$agent->id;?>)"  href="javascript:void(0)"> <?=$this->lang->line('ap_archived');?> <span>(<?=count($sold);?>)</span></a></li>
                                            <?php endif;?>
                                        </ul>
                                    </div>
                                </div>

                                <div id="viewAll" class="contentArea">
                                    <div id="content-area">
                                        <div id="agent_properties">
                                            <?php $this->load->view('includes/agents/properties'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div id="forSale" class="contentArea"></div>
                                <div id="forRent" class="contentArea"></div>
                            <?php } else { ?>
                                <section class="section-detail-content page-navigation-cn no_results" style="margin-top:50px;">
                                    <div class="page-main">
                                        <div class="article-detail text-center">
                                            <h2><?=$this->lang->line('ap_no_listings_found');?></h2>
                                            <p><?=$this->lang->line('ap_will_be_back');?> </p>
                                        </div>
                                    </div>
                                </section>
                            <?php } ?>
                        </div>

                        <?php $this->load->view('includes/team'); ?>

                        <div id="reviews-section" class="detail-address detail-block target-block">
                            <div class="detail-title">
                                <h2 class="title-left"><?=$this->lang->line('ap_rate_comment');?> </h2>
                                <div class="title-right">
                                    <?php if($uid != $agent->id) { ?>
                                        <?php if($uid == '') { ?>
                                            <button type="button" onclick="location.href='<?=site_url('users/login_status');?>'" class="btn btn-primary btn-md"><i class="fa fa-pencil-square-o"></i> <?=$this->lang->line('ap_write_comment');?></button>
                                        <?php } else { ?>
                                            <button type="button" data-toggle="modal" data-target="#reviewModal" class="btn btn-primary btn-md"><i class="fa fa-pencil-square-o"></i> <?=$this->lang->line('ap_write_comment');?></button>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>

                            <form id="review-sort-control" class="row" style="display: none">
                                <div class="col-md-4 col-sm-4"></div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 text-right">Show :</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" title="All Reviews...">
                                                <option>All Reviews</option>
                                                <option>Helped me buy a home or lot/land (5)</option>
                                                <option>Helped me buy a home or lot/land (5)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="form-group row">
                                        <label class="control-label col-sm-3 text-right">Sort by :</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" title="Newest first">
                                                <option value="1" selected="selected">Newest first</option>
                                                <option value="2">Rating (high to low)</option>
                                                <option value="3">Rating (low to high)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php if(count($reviews_all)){ ?>

                            <div class="reviews-list profile-reviews">
                                <div class="add-rating review-heading">
                                    <label>Level of Recommendation</label>
                                    <div class="rating">
                                        <div class="star-ratings-sprite" style="margin-top:0px; float:left;"><span style="width:<?= $rating ?>%" class="rating"></span></div>
                                    </div>
                                </div>

                                <?php
                                if (isset($reviews_all)) {
                                    foreach ($reviews_all as $review) {
                                        //print_r($review);
                                        $ind_rating = ($review->knowledge + $review->expertise + $review->responsiveness + $review->negotiation_skills)/4;
                                        $indiv_rating = $ind_rating * 20;
                                        ?>
                                        <div class="media reviewsHeight col-md-6">
                                            <div class="media">
                                                <div class="review-top review-reviewer-info" style="margin-bottom:0;">
                                                    <div class="rating">
                                                        <div class="star-ratings-sprite" style="margin-top:0px; float:left;"><span style="width:<?= $indiv_rating ?>%" class="rating"></span></div>
                                                    </div>
                                                    <div class="clearfix"><br/></div>
                                                    <span class="review-date"><?=$review->review_title ?></span>
                                                    <br/>
                                                    <h5 class="media-heading reviewtitle" style="padding-left:0;"><?=date("l M j, Y",strtotime($review->date_time))?></h5>
                                                </div>

                                                <div class="media-body">
                                                    <div class="review-top review-reviewer-info" style="margin-bottom:0px;">
                                                        <h5 class="media-heading">Reviewed by: <?=$review->first_name." ".$review->last_name?></h5>

                                                    </div>
                                                    <p class="review-done">Sourced by zoney.pk</p>
                                                    <!--<p class="review-done"><?/*=$agent->city.','*/?><?/*=$agent->state*/?></p>-->
                                                </div>
                                            </div>
                                            <table class="table table-striped rating-table">
                                                <tbody>
                                                <tr>
                                                    <td>Knowledge of his sector:</td>
                                                    <td><div class="star-ratings-sprite"><span style="width:<?= (($review->knowledge))*20 ?>%" class="rating"></span></div></td>
                                                </tr>
                                                <tr>
                                                    <td>Expert advice:</td>
                                                    <td><div class="star-ratings-sprite"><span style="width:<?= (($review->expertise))*20 ?>%" class="rating"></span></div></td>
                                                </tr>
                                                <tr>
                                                    <td>Easy and fast exchange:</td>
                                                    <td><div class="star-ratings-sprite"><span style="width:<?= (($review->responsiveness))*20 ?>%" class="rating"></span></div></td>
                                                </tr>
                                                <tr>
                                                    <td>Ability to negotiate:</td>
                                                    <td><div class="star-ratings-sprite"><span style="width:<?= (($review->negotiation_skills))*20 ?>%" class="rating"></span></div></td>
                                                </tr>

                                                </tbody>
                                            </table>
                                            <p class="viewmore"><?=$review->review;?></p>
                                        </div>


                                        <?php
                                    }
                                }
                                }else { ?>
                                    <section class="section-detail-content page-navigation-cn no_results" style="margin-top:20px;">
                                        <div class="page-main">
                                            <div class="article-detail text-center">
                                                <h2><?=$this->lang->line('no_ratings_user');?></h2>
                                                <p><?=$this->lang->line('ap_will_be_back');?> </p>
                                            </div>
                                        </div>
                                    </section>

                                <?php }  ?>

                                <div class="clearfix"></div>

                            </div>

                        </div>


                        <div id="recommend-section" class="detail-block target-block">
                            <div class="detail-title">
                                <h2 class="title-left"><?=$this->lang->line('ap_recommandations');?></h2>
                                <div class="title-right">
                                    <?php if($uid != $agent->id) { ?>

                                        <?php if($uid == '') { ?>
                                            <button type="button" onclick="location.href='<?=site_url('users/login_status');?>'" class="btn btn-primary btn-md"><i class="fa fa-thumbs-up"></i> Add a recommendation</button>
                                        <?php } else { ?>
                                            <button type="button" data-toggle="modal" data-target="#recommendModal" class="btn btn-primary btn-md"><i class="fa fa-thumbs-up"></i>Add a recommendation</button>
                                        <?php } ?>



                                    <?php } ?>
                                </div>
                            </div>
                            <div id="recommendation_list">
                                <div class="row">
                                    <?php if(count($recommendations)) { ?>

                                        <?php foreach($recommendations as $recommendation){?>
                                            <div class="col-md-4 col-sm-4">
                                                <div class="recommendation-box">
                                                    <div class="recommendation-msg"><p class="viewmore"><?=$recommendation->recommendation;?></p></div>
                                                    <div class="recommendation-sender">
                                                        <p class="sender-info">
                                                            <span class="sender-name"><?=$recommendation->name;?></span>
                                                            <br>
                                                            <span class="sender-detail">Recommended <?= ucfirst($agent->first_name . " " . $agent->last_name); ?>  almost <?= relative_time($recommendation->created_at); ?></span><br>
                                                        </p>
                                                        <div class="clearfix"></div>
                                                    </div>

                                                </div>
                                            </div>
                                        <?php }
                                    }else { ?>
                                        <section class="section-detail-content page-navigation-cn no_results" style="margin-top:20px;">
                                            <div class="page-main">
                                                <div class="article-detail text-center">
                                                    <h2><?=$this->lang->line('ap_no_recommendations_user');?></h2>
                                                    <p><?=$this->lang->line('ap_will_be_back');?> </p>
                                                </div>
                                            </div>
                                        </section>

                                    <?php  } ?>
                                </div>
                            </div>
                        </div>


                    </div>
                </section>
            </section>
        </div>
</section>

<?php $this->load->view('includes/write_review'); ?>
