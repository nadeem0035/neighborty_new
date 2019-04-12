<div class="tab-pane fade ">
    <div class="detail-address detail-block">
        <div class="account-block">
            <div class="my-property-listing">

                   <div class="row grid-row">
                    <?php

                    if(!empty($appointments)) {
                    $users_avatar ='assets/media/users_avatar/';
                    foreach($appointments as $listing){
                        ?>
                        <div class="item-wrap">
                            <?php if ($listing->app_status == 'Cancel'){ ?>
                            <div class="media my-property sect_backg">
                            <?php } else {?>
                                <div class="media my-property">
                            <?php }?>

                                <div class="media-left">
                                    <div class="figure-block">
                                        <figure class="item-thumb">
                                            <a href="<?=site_url("property/".$listing->slug.'-'.$listing->ualid)?>">
                                                <img src="<?=display_listing_preview('search_thumbs',$listing->preview_image_url);?>" alt="<?= ucwords($listing->listing_name) ?>" />
                                            </a>
                                        </figure>
                                    </div>
                                </div>
                                <div class="media-body media-middle">
                                    <div class="my-description">
                                        <h4 class="my-heading"><a href="<?=site_url("property/".$listing->slug.'-'.$listing->ualid)?>"><?= ucwords($listing->listing_name) ?></a></h4>
                                        <p class="address"><?php echo $listing->address_line_1.' '.$listing->address_line_2.', '.$listing->city_town.', '.$listing->state_province.' '.$listing->zip_postal_code?></p>
                                        <p class="status"><strong>Status:</strong> <?=$listing->property_type;?> <strong>Price:</strong> <?=pkrCurrencyFormat($listing->price);?></p>
                                    </div>
                                    <div class="my-actions" style="top:0px;padding-right:0px;">
                                        <div class="my-description btn-group" style="width:85px;">
                                            <a href="<?= site_url() ?>agent/profile/<?= $listing->usid ?>"><img src="<?=display_user_avatar($listing->picture);?>" alt="<?= $listing->first_name . " " . $listing->last_name; ?>" width="75" height="75" class="img-circle"></a>
                                        </div>
                                        <div class="my-description btn-group">
                                            <h4 class="my-heading"><a href="<?= site_url() ?>agent/profile/<?= $listing->usid ?>"><span class="label label-default">Appointment with</span> <?= $listing->first_name . " " . $listing->last_name; ?></a></h4>
                                            <div class="my-actions action-cancel">
                                                <div class="btn-group">
                                                    <?php if ($listing->app_status == 'Cancel'){ ?>
                                                        <a href="javascript:void(0);" id="<?=$listing->uaid?>" class="canl-btn-disable" data-toggle="tooltip" data-placement="top" title="Cancel"><i class="fa fa-close"></i></a>
                                                    <?php } else { ?>
                                                    <a href="javascript:void(0);" id="<?=$listing->uaid?>" class="action-btn" onclick="appStatusCancel(this.id,<?=$listing->ualid;?>,<?=$listing->usid;?>)" data-toggle="tooltip" data-placement="top" title="Cancel"><i class="fa fa-close"></i></a>
                                                    <?php } ?>
                                                    <?php if ($listing->app_status == 'Confirm'){ ?>
                                                    <a href="javascript:void(0);" id="<?=$listing->uaid?>" class="btn-disable" data-toggle="tooltip" data-placement="top" title="Confirm"><i class="fa fa-check-square-o"></i></a>
                                                   <?php } else { ?>
                                                    <a href="javascript:void(0);" id="<?=$listing->uaid?>" class="action-btn" onclick="appStatusConfirm(this.id,<?=$listing->ualid;?>,<?=$listing->usid;?>)" data-toggle="tooltip" data-placement="top" title="Confirm"><i class="fa fa-check-square-o"></i></a>
                                                    <?php } ?>
                                                   </div>
                                            </div>
                                            <p class="status"><strong>Phone:</strong> <?=$listing->phone?>  <strong>Email:</strong> <a href="mailto:<?=$listing->email?>"><?=$listing->email?> </a></p>
                                            <p class="status"><strong>Date:</strong><?=date('F jS, Y',strtotime($listing->appointment_start_time));?></p>
                                            <p class="status"><strong>Start Time:</strong><?=date('g:i A', strtotime($listing->appointment_start_time))?> <strong>End Time:</strong><?=date('g:i A', strtotime($listing->appointment_end_time))?></p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                   <?php } else{ ?>
                            <div class="text-center clearfix" style="margin:15px 0;">
                                <p><?=$this->lang->line('not_scheduled_appointment');?> </p>
                                <a class="btn btn-primary btn-md" href="<?=site_url()?>">Search Properties</a>
                                <br/>
                            </div>
                  <?php } ?>
                </div>

            </div>
        </div>
        <hr>
        </div>
    </div>