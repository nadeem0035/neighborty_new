<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <body>
<?php $this->load->view('dashboard/dashboard-header'); ?>
    <section id="section-body">
        <div class="container">

            <div class="user-dashboard-full">
                <?php $this->load->view('dashboard/dashboard-sidebar'); ?>

                <div class="profile-area-content">
                    <div class="profile-top">
                        <div class="profile-top-left">
                            <h2 class="title"><?=$this->lang->line('my_properties');?></h2>
                        </div>
                        <div class="profile-top-right">
                            <div class="my-property-search text-right">
                                <?php
                                $availble_normal = $package_stats[0]->list;
                                $cont_featured = $package_stats[0]->featured;

                                  $user_avilalble_listings = ($cont_featured + $availble_normal);
                                  $total_pkg_listings = $package[0]->total_listings;


//                                if ($user_avilalble_listings != 0){ ?>

                                    <a href="<?= site_url("listings/add-property"); ?>" class="btn btn-secondary"><?=$this->lang->line('new_offers');?></a>
                                <?php //}else { ?>
                                    <!--<a onclick="listing_avail();" class="btn btn-secondary">Nouvelles offres</a>-->
                                <?php// } ?>

                            </div>

                        </div>
                        <div class="profile-top-right">
                            <div class="text-left avilble" id="listing_response"></div>
                        </div>


                    </div>

                    <div class="detail-bar">
                        <div class="detail-content-tabber my-property-listing">
                            <div class="row">


                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="tab-content row grid-row">
                                        <div id='response'></div>
                                        <div id='prores'></div>

                                        <div id="display_notices"></div>


                                            <?php
                                            $count = count($listings);
                                            if($count > 0)
                                            {
                                                ?>
                                                <div class="item-wrap">
                                                    <?php
                                                    $i = 1;
                                                    $toggle_id = 1;
                                                    foreach( $listings as $user_listing )
                                                    {
                                                        $lid = $user_listing->id;
                                                        $slug = $user_listing->slug;
                                                        $rating = CalculateRating($lid)*20;
                                                        ?>
                                                        <div class="media my-property" id="booking_row_<?=$lid;?>">
                                                            <div class="media-left">
                                                                <div class="figure-block">
                                                                    <figure class="item-thumb">
                                                                        <a href="<?= site_url("property/$slug-$lid"); ?>">
                                                                            <img src="<?=display_listing_preview('small',$user_listing->preview_image_url);?>" alt="<?= character_limiter($user_listing->title,25); ?>">
                                                                        </a>
                                                                    </figure>
                                                                </div>
                                                            </div>
                                                            <div class="media-body media-middle">
                                                                <div class="my-description" style="width: auto">
                                                                    <h4 class="my-heading">
                                                                        <a href="<?= site_url("property/$slug-$lid"); ?>">
                                                                            <?php if($user_listing->status == 'publish'){ ?>

                                                                                <span class="label label-success"><?=$user_listing->status;?></span>

                                                                            <?php } else{ ?>

                                                                                <span class="label label-warning"><?=$user_listing->status;?></span>

                                                                            <?php } ?>
                                                                            <?= character_limiter($user_listing->title,300); ?>
                                                                        </a>
                                                                    </h4>
                                                                    <p class="address"><?=empty($user_listing->property_location) ? $user_listing->property_street.' '.$user_listing->city : $user_listing->property_location?></p>
                                                                    <p class="status">
                                                                        <strong><?=$this->lang->line('status');?>:</strong>

                                                                            <?=($user_listing->purpose == 'rent' ? 'For Rent' : 'For Sale');?>

                                                                        <strong><?=$this->lang->line('price');?></strong>

                                                                            <?=pkrCurrencyFormat($user_listing->price);?>
                                                                    </p>
                                                                </div>
                                                                <div class="my-actions">
                                                                    <div class="btn-group">


                                                                        <?php if($user_listing->id != $user_listing->prId){ ?>

                                                                        <span data-id="<?=$user_listing->id;?>" data-toggle="modal" data-target="#requestModel">
                                                                           <a  href="javascript:void(0);" class="action-btn" data-toggle="tooltip" data-placement="top" title="Premium"><i class="fa fa-star"></i></a>
                                                                        </span>

                                                                        <?php } else{ ?>

                                                                            <?php if($user_listing->prStatus =='Inactive') { ?>

                                                                            <a style="background-color: #f0ad4e"  href="javascript:void(0);" class="action-btn" data-toggle="tooltip" data-placement="top" title="Pending Premium"><i class="fa fa-star"></i></a>

                                                                            <?php } else{ ?>


                                                                                <?php if(getRemainingDays($user_listing->endDate) == 'Expired'){ ?>

                                                                                    <a style="background-color:#a94442"  href="javascript:void(0);" class="action-btn" data-toggle="tooltip" data-placement="top" title="Expired"><i class="fa fa-star"></i></a>


                                                                                <?php } else{ ?>

                                                                                    <a style="background-color:#3c763d"  href="javascript:void(0);" class="action-btn" data-toggle="tooltip" data-placement="top" title="Premium Property"><i class="fa fa-star"></i></a>


                                                                                <?php } ?>

                                                                            <?php } ?>

                                                                        <?php } ?>


                                                                        <a href="<?= site_url("listings/edit_property/$lid"); ?>" class="action-btn" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                                                        <a href="<?= site_url("property/$slug-$lid"); ?>" class="action-btn" data-toggle="tooltip" data-placement="top" title="Quick overview"><i class="fa fa-eye"></i></a>
                                                                        <!--<a href="javascript:void(0);" class="action-btn" data-toggle="tooltip" data-placement="top" title="Book"><i class="fa fa-book"></i></a>-->

                                                                        <a href="javascript:void(0);" class="action-btn" data-toggle="tooltip" data-placement="top" title="Number of request" id="viewApp" data-applicant-id="<?=$toggle_id?>">
                                                                            <i class="fa fa-file-text-o"></i>
                                                                        </a>
                                                                        <a href="javascript:void(0);" id="<?=$lid;?>" onclick="remove_listing_by_user_id(this.id)" class="action-btn" data-toggle="tooltip" data-placement="top" title="Remove"><i class="fa fa-close"></i></a>
                                                                    </div>
                                                                    <!--<p class="expire-text"><strong>Expiration:</strong> 2 days remaining</p>-->
                                                                </div>
                                                            </div>

                                                            <div class="clearfix"></div>

                                                            <div id="applicants_<?=$toggle_id?>" style="display:none;"><hr />
                                                                <table class="table compare-table table-striped">
                                                                    <thead class="thead-inverse">
                                                                    <tr><th colspan="3">List of Applications</th></tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php
                                                                    $applicants = $this->crud_model->get(
                                                                        array(
                                                                            'join'=>'',
                                                                            'fields'=>'lp.applicant_id, u.first_name, u.last_name, u.email, u.phone, u.id AS user_id, u.picture',
                                                                            'from'=>'
                                                                                        listing_applications AS lp
                                                                                        INNER JOIN users AS u ON u.id = lp.applicant_id
                                                                                    ',
                                                                            'where'=>'lp.listing_id = '.$lid
                                                                        )
                                                                    );

                                                                    if( is_array($applicants) ) :

                                                                        foreach ($applicants as $applicant)
                                                                        {
                                                                            // pre($applicant);
                                                                            ?>
                                                                            <tr>
                                                                                <td>
                                                                                    <a href="javascript:void(0);">
                                                                                        <img class="img-circle" src="<?=site_url('assets/media/users_avatar/small/'.$applicant->picture)?>" alt="Thumb" width="30" height="30">
                                                                                        <span><?=$applicant->first_name?> <?=$applicant->last_name?></span>
                                                                                    </a>
                                                                                <td>
                                                                                    <p>
                                                                                        <strong>Phone:</strong> <?=!empty($applicant->user_id) ? $applicant->user_id : '--';?>
                                                                                        <strong>Email:</strong> <?=$applicant->email?>
                                                                                    </p>
                                                                                </td>

                                                                               <td align="right"><a id="open_modelbox" href="javascript:void(0);" data-title="Robert John Application" data-href="<?=site_url('apply/view/'.$applicant->user_id);?>" class="btn btn-sm btn-primary" onclick="view_application(this.getAttribute('data-title'),this.getAttribute('data-href'))">View Application</a></td>
                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                    else :
                                                                        echo '<tr><td colspan="3" align="center">Sorry, No application found yet</td></tr>';
                                                                    endif;
                                                                    ?>

                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                        </div>
                                                        <?php if ($i % 2 == 0) { echo "<div class='clear'></div>";} ?>
                                                        <?php
                                                        $i++;
                                                        $toggle_id++;
                                                    }
                                                    ?>
                                                </div>
                                                <?php
                                            }else{

                                                echo '<div class="article-detail text-center"><h1>'.$this->lang->line('no_result').'</h1><p>'.$this->lang->line('no_property_waiting').'</p></div>';
                                            }
                                            ?>



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


        <?php $this->load->view('listings/premium_listings_popup'); ?>

        <?php $this->load->view('listings/veiw_application'); ?>




<?php
/*

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

*/
?>