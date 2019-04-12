<?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); ?>
<body>
<?php $this->load->view('templates/'.$topmenu); ?>
<div class="header-media">
    <div class="agent-parallax">
        <div class="banner-bg-wrap">
            <div class="banner-inner" style="background-image:url(<?=base_url()?>assets/img/landing-img.jpg);">
                <div class="search-table">
                    <div class="search-col banner-caption agents-landing">
                        <h1>Trouver votre agent immobilier près de chez vous</h1>
                        <?php $this->load->view('templates/agent_searchform'); ?>
                        <?php //$this->load->view('includes/landing_search'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section id="section-body" style="min-height: <?=$agents != NULL ?'700px' : 'auto';?>">
    <div class="container">
        <div class="page-title breadcrumb-top">

            <h3><?=$search_count;?> Résultats des agents pour "<?=($this->input->get('city') != '' ? $this->input->get('city') :'' )?>,<?=($this->input->get('country') != '' ? $this->input->get('country') :'' )?>"</h3>
            <div class="row"></div>
        </div>
        <?php if (isset($agents) && $agents != NULL) { ?>
            <div class="row agent-listing" id="sorted_listings">


                <div class="col-lg-9 col-md-8 col-sm-12"  id="rendered_resulsts">
                    <div class="ajax-loader_icon" id="search_loader" style="display:none"><img src="<?=base_url('assets/img/loading-spinner-default.gif');?>" /></div>
                    <?php foreach ($agents as $agent) { ?>

                        <div class="profile-detail-block">
                            <div class="row">
                                <div class="col-md-2 col-sm-2">

                                    <figure style="margin-bottom:0px;">
                                        <a href="<?= site_url() ?>agent/profile/<?= $agent->id ?>">
                                            <img src="<?=display_user_avatar($agent->picture);?>" alt="Agent Thumb" width="350" height="350">
                                        </a>
                                    </figure>
                                </div>
                                <div class="col-md-4 profile-description">
                                    <h3><a href="<?= site_url() ?>agent/profile/<?= $agent->id ?>"><?= $agent->first_name . " " . $agent->last_name ?></a></h3>
                                    <h4 class="position"><?= $agent->agent_type ?></h4>
                                    <ul class="agent-list-detail">
                                        <li><span>À VENDRE:</span> <span class="blue"><?=$agent->forsale;?></span></li>
                                        <li><span>A LOUER:</span> <span class="blue"><?=$agent->rented;?></span></li>
                                        <li><span>Vendu:</span> <span class="blue"><?=$agent->sold;?></span></li>
                                    </ul>
                                </div>
                                <?php
                                    $all_reviews = reviews_count($agent->id);
                                    $reviews_total_rating = count_review_rating($agent->id);
                                    $avg = 4 * $all_reviews;
                                    $rating =round($reviews_total_rating/$avg*20,2);
                                    $rec_count = recommendation_count($agent->id);
                                ?>



                                <div class="col-md-3" style="display: ">
                                    <ul class="agent-list-detail">
                                        <li>
                                            <div class="star-ratings-sprite" style="margin-top:0px; float:left;"><span style="width:<?= $rating ?>%" class="rating"></span></div>
                                        </li>
                                        <br />
                                        <li><span class=""><?=$all_reviews?></span> commentaires</li>
                                        <li><span class=""><?=$rec_count?> </span> Recommandations </li>
                                    </ul>
                                </div>
                                <div class="col-md-3">
                                    <ul class="agent-list-detail">
                                        <li><span>Membre depuis:</span> <?= date("M d, Y", strtotime($agent->registered_date)) ?></li>
                                        <?php if($agent->experience != ''):?>
                                            <li><span>Des années d'expérience:</span> <?= $agent->experience; ?></li>
                                        <?php endif;?>
                                        <?php if($agent->languages != ''):?>
                                            <li><span>Langues:</span> <?= $agent->languages; ?></li>
                                        <?php endif;?>
                                    </ul>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#quick_contact_<?= $agent->id; ?>" style="margin-top:7px;" class="btn btn-primary btn-sm hidden-xs">contact rapide</a>
                                </div>
                                <?php
                                    $data = array(
                                        'id' => $agent->id,
                                        'name' => ucwords($agent->first_name .' ' .$agent->last_name),
                                        'image'=>display_user_avatar($agent->picture),
                                    );
                                ?>
                                <?php $this->load->view('includes/quick_contact',$data); ?>
                            </div>
                            <!--<a href="<?/*= site_url() */?>agent/profile/<?/*= $agent->id */?>" class="justLinks"></a>-->
                        </div>

                    <?php } ?>

                    <p>&nbsp;</p>
                    <div class="pagination-main page-navigation-cn ajax_pagingsearc">
                        <center><?php echo $links;?></center>
                    </div>

                </div>


                <div class="col-lg-3 col-md-4 sidebar-white hidden-sm hidden-xs">

                    <?php if(!empty($advertisement)):?>

                        <div class="widget widget-recommend">
                            <div class="widget-body">
                                <?php foreach($advertisement as $adv):?>
                                    <a href="<?=$adv->link;?>" target="_blank">
                                        <img class="media-object img-responsive" src="<?=base_url('assets/media/advertisement/'.$adv->content);?>" alt="dd" style="display: block !important;">
                                    </a>
                                <?php endforeach;?>
                            </div>
                        </div>
                    <?php endif;?>

                    <?php if(!empty($featured_agents)):?>
                        <div class="widget widget-slider">
                            <div class="widget-top">
                                <h3 class="widget-title">Agents en vedette</h3>
                            </div>
                            <div class="widget-body">
                                <div class="property-widget-slider">
                                    <?php foreach($featured_agents as $agnt):?>

                                        <?php

                                        if (file_exists('assets/media/users_avatar/' . $agnt->picture) == FALSE || $agnt->picture == null) {
                                            $folder = "";
                                            $pic = 'placeholder.png';
                                        } else {

                                            $folder = "medium/";
                                            $pic = $agnt->picture;
                                        }
                                        ?>


                                        <div class="item">
                                            <div class="figure-block">
                                                <figure class="item-thumb">
                                                    <span class="label-featured label label-success">En vedette</span>

                                                    <a class="hover-effect" href="<?= site_url() ?>agent/profile/<?= $agnt->id ?>">
                                                        <img src="<?= base_url() . 'assets/media/users_avatar/' . $folder . $pic; ?>"
                                                             alt="Agent Thumb" width="370" height="202">
                                                    </a>
                                                    <div class="price">
                                                        <span class="item-price"><?=$agnt->first_name . ' ' .$agnt->last_name;?></span>
                                                    </div>

                                                </figure>
                                            </div>
                                        </div>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        </div>
                    <?php endif;?>

                </div>


            </div>
        <?php } else {  ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="page-main">
                    <div class="article-detail text-center">
                        <h1>Votre recherche ne correspond à aucun agent</h1>
                        <p>Veuillez modifier vos critères de recherche et essayer de rechercher </p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>













