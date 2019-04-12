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
                //                                $all_reviews = reviews_count($agent->id);
                //                                $reviews_total_rating = count_review_rating($agent->id);
                //                                $avg = 4 * $all_reviews;
                //                                $rating =round($reviews_total_rating/$avg*20,2);
                //                                $rec_count = recommendation_count($agent->id);
                ?>

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