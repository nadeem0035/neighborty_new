<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<body>
<?php $this->load->view('dashboard/dashboard-header'); ?>

<section id="section-body">
    <div class="container">

        <div class="user-dashboard-full">
            <?php $this->load->view('dashboard/dashboard-sidebar'); ?>
            <div class="profile-area-content">
                <div class="detail-bar">
                    <div class="detail-content-tabber">

                        <div class="tab-content">



                            <div class="tab-pane fade in active">
                                <div class="detail-address detail-block">
                                    <div class="account-block">
                                        <div class="my-property-listing">
                                            <div class="row grid-row">
                                                <?php

                                                if(count($appointments) > 0){
                                                $users_avatar ='assets/media/users_avatar/';
                                                foreach($appointments as $listing){
                                                   /* if(!file_exists(base_url() . $users_avatar .$folder. $agent->picture))
                                                    {
                                                        $folder = "";
                                                        $pic = 'default.png';
                                                    }
                                                    else{
                                                        $folder="medium/";
                                                        $pic = $agent->picture;
                                                    }*/
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
                                                                        <a href="<?=site_url("property/".$listing->slug.'-'.$listing->listing_id)?>">
                                                                            <img src="<?=display_listing_preview('search_thumbs',$listing->preview_image_url);?>"/>
                                                                        </a>
                                                                    </figure>
                                                                </div>
                                                            </div>
                                                            <div class="media-body media-middle">
                                                                <div class="my-description">
                                                                    <h4 class="my-heading"><a href="<?=site_url("property/".$listing->slug.'-'.$listing->listing_id)?>"><?= ucwords($listing->listing_name) ?></a></h4>
                                                                    <p class="address"><?php echo $listing->address_line_1.' '.$listing->address_line_2.', '.$listing->city_town.', '.$listing->state_province.' '.$listing->zip_postal_code?></p>
                                                                    <p class="status"><strong>Status:</strong> <?=$listing->property_type;?> <strong>Price:</strong> <?= pkrCurrencyFormat($listing->price);?>  <?/*=($listing->property_type == 'sale' ? '': '');*/?></p>
                                                                </div>
                                                                <div class="my-actions" style="top:0px;">
                                                                    <div class="my-description btn-group" style="width:85px;">
                                                                        <a href="<?= site_url() ?>agent/profile/<?= $listing->id ?>"><img src="<?=display_user_avatar($listing->picture);?>" alt="Agent Thumb" width="75" height="75" class="img-circle"></a>
                                                                    </div>
                                                                    <div class="my-description btn-group">
                                                                        <h4 class="my-heading"><a href="<?= site_url() ?>agent/profile/<?= $listing->id ?>"><span class="label label-default">Appointment with</span> <?= $listing->first_name . " " . $listing->last_name; ?></a></h4>
                                                                        <p class="status"><strong>Phone:</strong> <?=$listing->phone?>  <strong>Email:</strong> <a href="mailto:<?=$listing->email?>"><?=$listing->email?> </a></p>
                                                                        <p class="status"><strong>Date/Time:</strong><?=date('F jS, Y',strtotime($listing->appointment_start_time));?> <strong>Status:</strong><?=($listing->app_status == '' ? 'Pending' : $listing->app_status);?></p>
                                                                        <p class="status"><strong>Start Time:</strong><?=date('g:i A', strtotime($listing->appointment_start_time))?> <strong>End Time:</strong><?=date('g:i A', strtotime($listing->appointment_end_time))?></p>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <?php } else{ ?>
                                                    <div class="article-detail text-center">
                                                        <h1><?=$this->lang->line('appo_no_fond');?></h1>
                                                        <p><?=$this->lang->line('appo_no_fond_p');?></p>
                                                        <a href="<?=site_url('/');?>" class="btn btn-sm btn-primary">Search Properties</a>
                                                    </div>
                                                <?php }?>
                                            </div>
                                        </div>
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
<div class="modal fade" id="pop-viewApp" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content host-modal">
            <div class="modal-header host-modal-header">
                <h4 class="modal-title">Rental Application</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body host-modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <ul class="login-tabs apply-tabs col-sm-3">
                            <li class="active">About Me <span id="about_me_weight"></span></li>
                            <li>Residences <span id="residences_weight"></span></li>
                            <li>Occupation <span id="occupation_weight"></span></li>
                            <li>References <span id="references_weight"></span></li>
                            <li>Additional <span id="additional_weight"></span></li>
                            <li>Financial <span id="financial_weight"></span></li>
                            <li>Misc. <span id="misc_weight"></span></li>
                        </ul>
                        <div class="tab-content col-sm-9">
                            <div class="tab-pane fade in active">
                                <div id="about_me">
                                    <h4>About Me</h4>
                                    <div class="clearfix"></div>
                                    <ul class="profile-contact">
                                        <li><span>Name:</span> <?=@$response->about_me->a_first_name?> <?=@$response->about_me->a_middle_name?> <?=@$response->about_me->a_last_name?></li>
                                        <li><span>Phone Number:</span> <?=@$response->about_me->a_phone?></li>
                                        <li><span>Date Of Birth:</span> <?=@$response->about_me->a_dob?></li>
                                        <li><span>Social Security No.:</span> <?=@$response->about_me->a_ssn?></li>
                                        <li><span>Driver's License No.:</span> <?=@$response->about_me->a_driver_license_no?></li>
                                        <li><span>Driver's License State:</span> <?=@$response->about_me->a_driver_license_state?></li>
                                        <li class="email"><span>Email:</span> <a href="mailto:<?=@$response->about_me->a_email?>"><?=@$response->about_me->a_email?></a></li>
                                    </ul>
                                    <h4>Other Occupant(s)</h4>
                                    <ul class="profile-contact">
                                        <li><span>Name:</span> <?=$response->about_me->{$name}?></li>
                                        <li><span>Phone Number:</span> <?=$response->about_me->{$phone}?></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane fade">
                                <div id="residences">
                                    <h4>Current Residence</h4>
                                    <ul class="profile-contact">
                                        <li><span>Housing Type:</span> Rented or Owned </li>
                                        <li><span>Current Address:</span> </li>
                                        <li><span>Date Of Birth:</span> </li>
                                        <li><span>Move In Date:</span> </li>
                                        <li><span>Monthly Rent:</span> </li>
                                        <li><span>Landlord Name:</span> </li>
                                        <li><span>Landlord Phone Number:</span> </li>
                                        <li class="email"><span>Reason For Leaving:</span> </li>
                                    </ul>
                                    <hr/>
                                    <h4>Previous Residence</h4>
                                    <ul class="profile-contact">
                                        <li><span>Housing Type:</span> Rented or Owned None</li>
                                        <li><span>Current Address:</span> </li>
                                        <li><span>Date Of Birth:</span> </li>
                                        <li><span>Move In Date:</span> </li>
                                        <li><span>Monthly Rent:</span> </li>
                                        <li><span>Landlord Name:</span> </li>
                                        <li><span>Landlord Phone Number:</span> </li>
                                        <li class="email"><span>Reason For Leaving:</span> </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane fade">
                                <div id="occupation">
                                    <h4>Current Occupation</h4>
                                    <ul class="profile-contact">
                                        <li><span>Status:</span> Employed Student Unemployed </li>
                                        <li><span>Employer:</span> </li>
                                        <li><span>Job Title:</span> </li>
                                        <li><span>Monthly Salary:</span> </li>
                                        <li><span>Work Type</span> </li>
                                        <li><span>Manager's Name:</span> </li>
                                        <li><span>Phone Number:</span> </li>
                                        <li><span>Work Address:</span> </li>
                                        <li><span>Start Date:</span> </li>
                                        <li><span>Income Source:</span> </li>
                                        <li><span>Monthly Income:</span> </li>
                                        <li class="email"><span>Reason For Leaving:</span> </li>
                                    </ul>
                                    <hr/>
                                    <h4>Previous Occupation</h4>
                                    <h4>Additional Income</h4>
                                    <h4>Financial Summary</h4>
                                </div>
                            </div>
                            <div class="tab-pane fade">
                                <div id="references">
                                    <h4>Personal Reference</h4>
                                    <hr/>
                                    <h4>Emergency Contact</h4>
                                </div>
                            </div>
                            <div class="tab-pane fade">
                                <div id="additional">
                                    <h4>Additional Information</h4>
                                </div>
                            </div>
                            <div class="tab-pane fade">
                                <div id="financial">
                                    <h4>Bank Accounts</h4>
                                </div>
                            </div>
                            <div class="tab-pane fade">
                                <div id="misc">
                                    <h4>Outstanding Loans</h4>
                                    <hr/>
                                    <h4>Vehicles</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer host-modal-footer">
                <button onclick="" class="btn btn-primary">Edit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
