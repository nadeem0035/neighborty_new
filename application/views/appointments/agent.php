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
                        <h2 class="title"><?=$this->lang->line('my_appointments');?></h2>
                    </div>
                </div>

                <?php //$this->load->view('includes/add_availability'); ?>

                <div class="detail-bar">
                    <div class="detail-content-tabber">
                        <ul class="detail-tabs">

                            <li class="active"><?=$this->lang->line('my_availabilities');?></li>
                            <li class="<?=($_SESSION['logged_in']['user_type'] == 'Renter' ? 'active' :'');?>"><?=$this->lang->line('appointments');?></li>
                            <li class="<?=($_SESSION['logged_in']['user_type'] == 'Renter' ? 'active' :'');?>"><?=$this->lang->line('my_appointments');?> </li>

                        </ul>
                        <div class="tab-content">

                            <?php $this->load->view('includes/agents/availability'); ?>
                            <?php $this->load->view('includes/agents/list_appointments'); ?>
                            <?php $this->load->view('includes/agents/agent_appointments'); ?>

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
