
    <?php foreach ($members as $member):?>
        <div class="item-wrap" id="member_<?=$member->id;?>">
            <div class="media my-property">
                <div class="media-left">
                    <div class="figure-block">
                        <figure class="item-thumb">
                            <a href="#">

                                <?php

                                if (file_exists('assets/media/users_avatar/' . $member->picture) == FALSE || $member->picture == null) {
                                    $folder = "";
                                    $pic = 'default.png';
                                } else {

                                    $folder = "medium/";
                                    $pic = $member->picture;
                                }

                                ?>

                                <img src="<?= base_url() . 'assets/media/users_avatar/' . $folder . $pic; ?>" alt="Agent Thumb" width="350" height="350">
                            </a>
                        </figure>
                    </div>
                </div>
                <div class="media-body">
                    <div class="my-description">
                        <h4 class="my-heading"><a href="<?=site_url('agent/profile/'.$member->id);?>"><?=ucfirst($member->first_name .''.$member->last_name);?></a>, <span class="small"><?=ucfirst($member->agent_type );?></span></h4>
                        <p class="address"><?=ucfirst($member->location);?></p>
                        <p class="status"><strong>Email:</strong> <?=$member->email;?> <strong>téléphone:</strong> <?=$member->phone;?></p>
                        <p class="status">
                            <strong>À Vendre:</strong> <span class="blue"><?= sale_count($member->id); ?></span>
                            <strong>Vendu:</strong> <span class="blue"><?= sold_count($member->id); ?></span>
                            <strong>Membre depuis:</strong> <?= date("M d, Y", strtotime($member->registered_date)) ?>
                            <?php if($member->experience != ''):?>
                                <strong>Experience:</strong> <?=$member->experience;?>
                            <?php endif;?>
                        </p>
                        <div class="rating">
                                                        <span data-title="Average Rate: 4.67 / 5" class="bottom-ratings tip"><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span style="width: 93.4%" class="top-ratings"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></span>
                                                        </span>
                            <span class="star-text-right small">15 Notes et commentaires</span>
                        </div>
                    </div>
                    <div class="my-actions">
                        <div class="btn-group">
                            <a style="background-color: <?=($member->active == 1 ? '#71c514' : '#f0ad4e');?>" href="javascript:void(0)" status="<?=$member->active;?>" class="action-btn btn-success agent_status" id="<?=$member->id;?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Update Status">
                             <span class="status_icon_<?=$member->id;?>">

                                  <?php if($member->active == 1){ ?>

                                      <i class="fa fa-check-circle-o" aria-hidden="true"></i>

                                  <?php } else{ ?>

                                      <i class="fa fa-times-circle-o" aria-hidden="true"></i>

                                  <?php }?>

                               </span>

                            </a>

                            <a href="javascript:void(0)" class="action-btn delete_agent" id="<?=$member->id;?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Remove"><i class="fa fa-close"></i></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach;?>