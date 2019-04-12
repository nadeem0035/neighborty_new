<?php
if( isset($application[0]) )
{
    if( !empty($application[0]->content) )
    {
        $response = json_decode( str_replace('&quot;', '"', $application[0]->content) );
        // pre($response);
    }
}
?>
<div class="modal fade" id="pop-apply" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Rental Application <span id="total_count"></span></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <ul class="login-tabs apply-tabs">
                <li class="active">About Me <span id="about_me_weight"></span></li>
                <li>Residences <span id="residences_weight"></span></li>
                <li>Occupation <span id="occupation_weight"></span></li>
                <li>References <span id="references_weight"></span></li>
                <li>Additional <span id="additional_weight"></span></li>
                <li>Financial <span id="financial_weight"></span></li>
                <li>Misc. <span id="misc_weight"></span></li>
            </ul>

            <!-- <form id="form_apply"> -->
            <div class="modal-body login-block">
                <div class="tab-content">

                    <div class="tab-pane fade in active">
                        <form id="about_me">

                            <h4>About Me</h4>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label class="control-label" for="fullname">First Name</label>
                                    <input type="text" class="form-control custom-host-input" name="a_first_name" value="<?=@$response->about_me->a_first_name?>" placeholder="First Name" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label" for="fullname">Middle Name</label>
                                    <input type="text" class="form-control custom-host-input" name="a_middle_name" value="<?=@$response->about_me->a_middle_name?>" placeholder="Middle">
                                    <span class="pull-right" style="color:#b1b0b0;font-size:11px;text-transform:uppercase;">Optional</span>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label" for="fullname">last Name</label>
                                    <input type="text" class="form-control custom-host-input" name="a_last_name" value="<?=@$response->about_me->a_last_name?>" placeholder="Last name" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="fullname">Email</label>
                                    <input type="email" class="form-control custom-host-input" name="a_email" value="<?=@$response->about_me->a_email?>" placeholder="jane.j.smith@sampleemail.com" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="fullname"> Phone Number </label>
                                    <input type="number" class="form-control custom-host-input" name="a_phone" value="<?=@$response->about_me->a_phone?>" placeholder="(555) 555-5555 ext. 55555" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="fullname">Date Of Birth</label>
                                    <input type="date" class="form-control custom-host-input" name="a_dob" value="<?=@$response->about_me->a_dob?>" placeholder="YYYY-MM-DD" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="fullname">Social Security No.</label>
                                    <input type="text" class="form-control custom-host-input" name="a_ssn" value="<?=@$response->about_me->a_ssn?>" placeholder="XXX-XX-XXXX">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="fullname">Driver's License No.</label>
                                    <input type="text" class="form-control custom-host-input" name="a_driver_license_no" value="<?=@$response->about_me->a_driver_license_no?>" placeholder="Z98765432">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="fullname">Driver's License State</label>
                                    <input type="text" class="form-control custom-host-input" name="a_driver_license_state" value="<?=@$response->about_me->a_driver_license_state?>" placeholder="">
                                </div>
                            </div>
                            <h4>Other Occupant(s)</h4>
                            <input type="hidden" name="a_occupant_count" id="a_occupant_count">
                            <div id="occupants">
                                <?php
                                if( isset($response->about_me->a_occupant_count) && $response->about_me->a_occupant_count > 0 )
                                {
                                    for ($i=1; $i <= $response->about_me->a_occupant_count; $i++)
                                    {
                                        $name = 'a_occupant_name_'.$i;
                                        $phone = 'a_occupant_phone_'.$i;
                                        // pr($i);
                                        ?>
                                        <div id="occupant_<?=$i?>"><h4>Other Occupant #<?=$i?> <?=$i !== 1 ? '<a class="btn btn-danger btn-sm remove_occupants"><span title="Delete" class="glyphicon glyphicon-trash"></span></a>' : ''?></h4>
                                            <div class="form-group col-md-6">
                                                <label class="control-label" for="fullname">Full Name</label>
                                                <input type="text" class="form-control custom-host-input" name="a_occupant_name_<?=$i?>" value="<?=$response->about_me->{$name}?>" placeholder="John Smith">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label" for="fullname">Phone Number</label>
                                                <input type="text" class="form-control custom-host-input" name="a_occupant_phone_<?=$i?>" value="<?=$response->about_me->{$phone}?>" placeholder="(555) 555-5555 ext. 55555">
                                            </div>
                                        </div>
                                        <?php
                                    }

                                    $footer_data['custom_js'] .= 'var occupantsCount = '.($i-1).';$("input#a_occupant_count").val(occupantsCount);';
                                    // pre($i);
                                }
                                ?>
                            </div>
                            <button id="add_occupant" class="btn" type="button">+ Add Another Occupant</button>

                        </form>
                    </div>

                    <div class="tab-pane fade">
                        <form id="residences">

                            <h4>Current Residence</h4>
                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label class="control-label" for="fullname">Housing Type</label>
                                    <div class="form-field">
                                        <label class="auto-width">
                                            <input name="r_current_housing_type" <?=@$response->residences->r_current_housing_type == 'Rented' ? 'checked' : ''?> type="radio" value="Rented" tabindex="1" class=""> Rented
                                        </label>
                                        &nbsp;
                                        <label class="auto-width">
                                            <input name="r_current_housing_type" <?=@$response->residences->r_current_housing_type == 'Owned' ? 'checked' : ''?> type="radio" value="Owned" tabindex="2" class=""> Owned
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group col-md-8">
                                    <label class="control-label" for="fullname">Current Address</label>
                                    <input type="text" class="form-control custom-host-input" name="r_current_address" value="<?=@$response->residences->r_current_address?>" placeholder="" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label" for="fullname">Move In Date</label>
                                    <input type="date" class="form-control custom-host-input" name="r_current_move_in_date" value="<?=@$response->residences->r_current_move_in_date?>" placeholder="" required>
                                </div>
                                <div id="current_housing_rented">
                                    <div class="form-group col-md-4">
                                        <label class="control-label" for="fullname">Monthly Rent</label>
                                        <input type="number" class="form-control custom-host-input" name="r_current_monthly_rent" value="<?=@$response->residences->r_current_monthly_rent?>" placeholder="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="control-label" for="fullname">Landlord Name</label>
                                        <input type="text" class="form-control custom-host-input" name="r_current_landlord_name" value="<?=@$response->residences->r_current_landlord_name?>" placeholder="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="control-label" for="fullname">Landlord Phone Number</label>
                                        <input type="text" class="form-control custom-host-input" name="r_current_landlord_phone_no" value="<?=@$response->residences->r_current_landlord_phone_no?>" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="control-label" for="fullname">Reason For Leaving</label>
                                    <textarea class="form-control custom-host-input" name="r_current_reason_for_leaving"><?=@$response->residences->r_current_reason_for_leaving?></textarea>
                                </div>

                            </div>
                            <hr/>

                            <h4>Previous Residence</h4>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="fullname">Housing Type</label>
                                    <div class="form-field">
                                        <label class="auto-width">
                                            <input name="r_previous_housing_type" type="radio" <?=@$response->residences->r_previous_housing_type == 'Rented' ? 'checked' : ''?> value="Rented" tabindex="1" class=""> Rented
                                        </label>
                                        &nbsp;
                                        <label class="auto-width">
                                            <input name="r_previous_housing_type" type="radio" <?=@$response->residences->r_previous_housing_type == 'Owned' ? 'checked' : ''?> value="Owned" tabindex="2" class=""> Owned
                                        </label>
                                        &nbsp;
                                        <label class="auto-width">
                                            <input name="r_previous_housing_type" type="radio" <?=@$response->residences->r_previous_housing_type == 'None' ? 'checked' : ''?> value="None" tabindex="2" class=""> None
                                        </label>
                                    </div>

                                </div>
                                <div id="previous_housing_rented_none">

                                    <div class="form-group col-md-8">
                                        <label class="control-label" for="fullname">Current Address</label>
                                        <input type="text" class="form-control custom-host-input" name="r_previous_address" value="<?=@$response->residences->r_previous_address?>" placeholder="" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="control-label" for="fullname">Move In Date</label>
                                        <input type="date" class="form-control custom-host-input" name="r_previous_move_in_date" value="<?=@$response->residences->r_previous_move_in_date?>" placeholder="" required>
                                    </div>
                                    <div id="previous_housing_rented">
                                        <div class="form-group col-md-4">
                                            <label class="control-label" for="fullname">Monthly Rent</label>
                                            <input type="number" class="form-control custom-host-input" name="r_previous_monthly_rent" value="<?=@$response->residences->r_previous_monthly_rent?>" placeholder="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="control-label" for="fullname">Landlord Name</label>
                                            <input type="text" class="form-control custom-host-input" name="r_previous_landlord_name" value="<?=@$response->residences->r_previous_landlord_name?>" placeholder="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="control-label" for="fullname">Landlord Phone Number</label>
                                            <input type="text" class="form-control custom-host-input" name="r_previous_landlord_phone_no" value="<?=@$response->residences->r_previous_landlord_phone_no?>" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label" for="fullname">Reason For Leaving</label>
                                        <textarea class="form-control custom-host-input" name="r_previous_reason_for_leaving"><?=@$response->residences->r_previous_reason_for_leaving?></textarea>
                                    </div>

                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="tab-pane fade">
                        <form id="occupation">

                            <h4>Current Occupation</h4>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label" for="">Status</label>
                                    <div class="form-field">
                                        <label class="auto-width"><input type="radio" name="o_current_status" <?=@$response->occupation->o_current_status == 'Employed' ? 'checked' : ''?> value="Employed" tabindex="1" class="">Employed</label>
                                        <label class="auto-width"><input type="radio" name="o_current_status" <?=@$response->occupation->o_current_status == 'Student' ? 'checked' : ''?> value="Student" tabindex="2" class="">Student</label>
                                        <label class="auto-width"><input type="radio" name="o_current_status" <?=@$response->occupation->o_current_status == 'Unemployed' ? 'checked' : ''?> value="Unemployed" tabindex="3" class="">Unemployed</label>
                                    </div>
                                </div>

                                <div id="o_employed">
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="">Employer</label>
                                        <input type="text" class="form-control custom-host-input" name="o_current_employer" value="<?=@$response->occupation->o_current_employer?>" placeholder="" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="">Job Title</label>
                                        <input type="text" class="form-control custom-host-input" name="o_current_job_title" value="<?=@$response->occupation->o_current_job_title?>" placeholder="" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="">Monthly Salary</label>
                                        <input type="text" class="form-control custom-host-input" name="o_current_monthly_salary" value="<?=@$response->occupation->o_current_monthly_salary?>" placeholder="" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="">Work Type</label>
                                        <select name="o_current_work_type" class="form-control">
                                            <option <?=@$response->occupation->o_current_work_type == 'full_time' ? 'selected' : ''?> value="full_time">Full Time</option>
                                            <option <?=@$response->occupation->o_current_work_type == 'part_time' ? 'selected' : ''?> value="part_time">Part Time</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="">Manager's Name</label>
                                        <input type="text" class="form-control custom-host-input" name="o_current_manager_name" value="<?=@$response->occupation->o_current_manager_name?>" placeholder="" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="">Phone Number</label>
                                        <input type="text" class="form-control custom-host-input" name="o_current_manager_phone_no" value="<?=@$response->occupation->o_current_manager_phone_no?>" placeholder="" required>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label class="control-label" for="">Work Address</label>
                                        <input type="text" class="form-control custom-host-input" name="o_current_work_address" value="<?=@$response->occupation->o_current_work_address?>" placeholder="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="control-label" for="">Start Date</label>
                                        <input type="date" class="form-control custom-host-input" name="o_current_start_date" value="<?=@$response->occupation->o_current_start_date?>" placeholder="" required>
                                    </div>
                                </div>

                                <div id="o_other">
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="">Income Source</label>
                                        <input type="text" class="form-control custom-host-input" name="o_current_monthly_income_source" value="<?=@$response->occupation->o_current_monthly_income_source?>" placeholder="" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="">Monthly Income</label>
                                        <input type="text" class="form-control custom-host-input" name="o_current_monthly_income" value="<?=@$response->occupation->o_current_monthly_income?>" placeholder="" required>
                                    </div>
                                </div>

                            </div>
                            <hr/>
                            <h4>Previous Occupation</h4>
                            <div class="row">


                                <div class="form-group col-md-12">
                                    <label class="control-label" for="">Status</label>
                                    <div class="form-field">
                                        <label class="auto-width"><input type="radio" name="o_previous_status" <?=@$response->occupation->o_previous_status == 'Employed' ? 'checked' : ''?>  value="Employed" tabindex="1" class="">Employed</label>
                                        <label class="auto-width"><input type="radio" name="o_previous_status" <?=@$response->occupation->o_previous_status == 'Student' ? 'checked' : ''?>  value="Student" tabindex="2" class="">Student</label>
                                        <label class="auto-width"><input type="radio" name="o_previous_status" <?=@$response->occupation->o_previous_status == 'Unemployed' ? 'checked' : ''?>  value="Unemployed" tabindex="3" class="">Unemployed</label>
                                        <label class="auto-width"><input type="radio" name="o_previous_status" <?=@$response->occupation->o_previous_status == 'None' ? 'checked' : ''?>  value="None" tabindex="4" class="">None</label>
                                    </div>
                                </div>
                                <?php
                                if( @$response->occupation->o_current_status == 'Employed' )
                                {
                                    $footer_data['custom_js'] .= '
											$("#o_employed").show();$("#o_other").hide();

											$("input[name$=\'o_current_employer\']").attr(\'required\');
											$("input[name$=\'o_current_job_title\']").attr(\'required\');
											$("input[name$=\'o_current_monthly_salary\']").attr(\'required\');
											$("input[name$=\'o_current_manager_name\']").attr(\'required\');
											$("input[name$=\'o_current_manager_phone_no\']").attr(\'required\');
											$("input[name$=\'o_current_start_date\']").attr(\'required\');

											$("input[name$=\'o_current_monthly_income_source\']").removeAttr(\'required\');
											$("input[name$=\'o_current_monthly_income\']").removeAttr(\'required\');
									';
                                }
                                else
                                {
                                    $footer_data['custom_js'] .= '
											$("#o_employed").hide();$("#o_other").show();

											$("input[name$=\'o_current_employer\']").removeAttr(\'required\');
											$("input[name$=\'o_current_job_title\']").removeAttr(\'required\');
											$("input[name$=\'o_current_monthly_salary\']").removeAttr(\'required\');
											$("input[name$=\'o_current_manager_name\']").removeAttr(\'required\');
											$("input[name$=\'o_current_manager_phone_no\']").removeAttr(\'required\');
											$("input[name$=\'o_current_start_date\']").removeAttr(\'required\');

											$("input[name$=\'o_current_monthly_income_source\']").attr(\'required\');
											$("input[name$=\'o_current_monthly_income\']").attr(\'required\');
									';
                                }


                                if( @$response->occupation->o_previous_status == 'Employed' )
                                {
                                    $footer_data['custom_js'] .= '
											$("#o_previous_employed").show();$("#o_previous_other").hide();
											$("input[name$=\'o_previous_employer\']").attr(\'required\');
											$("input[name$=\'o_previous_job_title\']").attr(\'required\');
											$("input[name$=\'o_previous_monthly_salary\']").attr(\'required\');
											$("input[name$=\'o_previous_manager_name\']").attr(\'required\');
											$("input[name$=\'o_previous_manager_phone_no\']").attr(\'required\');
											$("input[name$=\'o_previous_start_date\']").attr(\'required\');

											$("input[name$=\'o_previous_monthly_income_source\']").removeAttr(\'required\');
											$("input[name$=\'o_previous_monthly_income\']").removeAttr(\'required\');
									';
                                }
                                elseif( @$response->occupation->o_previous_status == 'None' )
                                {
                                    $footer_data['custom_js'] .= '
											$("#o_previous_employed").hide();$("#o_previous_other").hide();
											$("input[name$=\'o_previous_employer\']").removeAttr(\'required\');
											$("input[name$=\'o_previous_job_title\']").removeAttr(\'required\');
											$("input[name$=\'o_previous_monthly_salary\']").removeAttr(\'required\');
											$("input[name$=\'o_previous_manager_name\']").removeAttr(\'required\');
											$("input[name$=\'o_previous_manager_phone_no\']").removeAttr(\'required\');
											$("input[name$=\'o_previous_start_date\']").removeAttr(\'required\');

											$("input[name$=\'o_previous_monthly_income_source\']").removeAttr(\'required\');
											$("input[name$=\'o_previous_monthly_income\']").removeAttr(\'required\');
									';
                                }
                                else
                                {
                                    $footer_data['custom_js'] .= '
											$("#o_previous_employed").hide();$("#o_previous_other").show();
											$("input[name$=\'o_previous_employer\']").removeAttr(\'required\');
											$("input[name$=\'o_previous_job_title\']").removeAttr(\'required\');
											$("input[name$=\'o_previous_monthly_salary\']").removeAttr(\'required\');
											$("input[name$=\'o_previous_manager_name\']").removeAttr(\'required\');
											$("input[name$=\'o_previous_manager_phone_no\']").removeAttr(\'required\');
											$("input[name$=\'o_previous_start_date\']").removeAttr(\'required\');

											$("input[name$=\'o_previous_monthly_income_source\']").attr(\'required\');
											$("input[name$=\'o_previous_monthly_income\']").attr(\'required\');
									';
                                }

                                ?>
                                <div id="o_previous_employed">
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="">Employer</label>
                                        <input type="text" class="form-control custom-host-input" name="o_previous_employer" value="<?=@$response->occupation->o_previous_employer?>" placeholder="" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="">Job Title</label>
                                        <input type="text" class="form-control custom-host-input" name="o_previous_job_title" value="<?=@$response->occupation->o_previous_job_title?>" placeholder="" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="">Monthly Salary</label>
                                        <input type="text" class="form-control custom-host-input" name="o_previous_monthly_salary" value="<?=@$response->occupation->o_previous_monthly_salary?>" placeholder="" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="">Work Type</label>
                                        <select name="o_previous_work_type" class="form-control">
                                            <option <?=@$response->occupation->o_previous_work_type == 'full_time' ? 'selected' : ''?> value="full_time">Full Time</option>
                                            <option <?=@$response->occupation->o_previous_work_type == 'part_time' ? 'selected' : ''?> value="part_time">Part Time</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="">Manager's Name</label>
                                        <input type="text" class="form-control custom-host-input" name="o_previous_manager_name" value="<?=@$response->occupation->o_previous_manager_name?>" placeholder="" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="">Phone Number</label>
                                        <input type="text" class="form-control custom-host-input" name="o_previous_manager_phone_no" value="<?=@$response->occupation->o_previous_manager_phone_no?>" placeholder="" required>
                                    </div>
                                    <div class="form-group col-md-8">
                                        <label class="control-label" for="">Work Address</label>
                                        <input type="text" class="form-control custom-host-input" name="o_previous_work_address" value="<?=@$response->occupation->o_previous_work_address?>" placeholder="">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="control-label" for="">Start Date</label>
                                        <input type="date" class="form-control custom-host-input" name="o_previous_start_date" value="<?=@$response->occupation->o_previous_start_date?>" placeholder="" required>
                                    </div>
                                    <hr/>
                                </div>

                                <div id="o_previous_other">
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="">Income Source</label>
                                        <input type="text" class="form-control custom-host-input" name="o_previous_monthly_income_source" value="<?=@$response->occupation->o_previous_monthly_income_source?>" placeholder="" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="">Monthly Income</label>
                                        <input type="text" class="form-control custom-host-input" name="o_previous_monthly_income" value="<?=@$response->occupation->o_previous_monthly_income?>" placeholder="" required>
                                    </div>
                                    <hr/>
                                </div>

                            </div>

                            <h4>Additional Income</h4>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="">Income Sources</label>
                                    <input type="text" class="form-control custom-host-input" name="o_income_sources" value="<?=@$response->occupation->o_income_sources?>" placeholder="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="">Amount</label>
                                    <input type="text" class="form-control custom-host-input" name="o_income_amount" value="<?=@$response->occupation->o_income_amount?>" placeholder="">
                                </div>
                            </div>

                            <h4>Financial Summary</h4>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="">Total Monthly Income</label>
                                    <p>(Monthly Income + Additional Income)</p>
                                </div>
                                <div class="form-group col-md-6 text-right">
                                    <label class="control-label" id="total_of_o">0</label>
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="tab-pane fade">
                        <form id="references">

                            <h4>Personal Reference</h4>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="">Full Name</label>
                                    <input type="text" class="form-control custom-host-input" name="ref_p_full_name" value="<?=@$response->references->ref_p_full_name?>" placeholder="" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="">Relationship</label>
                                    <input type="text" class="form-control custom-host-input" name="ref_p_relationship" value="<?=@$response->references->ref_p_relationship?>" placeholder="" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="">Address</label>
                                    <input type="text" class="form-control custom-host-input" name="ref_p_address" value="<?=@$response->references->ref_p_address?>" placeholder="" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="">Phone Number</label>
                                    <input type="text" class="form-control custom-host-input" name="ref_p_phone_no" value="<?=@$response->references->ref_p_phone_no?>" placeholder="" required>
                                </div>
                            </div>
                            <hr/>
                            <h4>Emergency Contact</h4>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="">Full Name</label>
                                    <input type="text" class="form-control custom-host-input" name="ref_e_full_name" value="<?=@$response->references->ref_e_full_name?>" placeholder="" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="">Relationship</label>
                                    <input type="text" class="form-control custom-host-input" name="ref_e_relationship" value="<?=@$response->references->ref_e_relationship?>" placeholder="" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="">Address</label>
                                    <input type="text" class="form-control custom-host-input" name="ref_e_address" value="<?=@$response->references->ref_e_address?>" placeholder="" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="">Phone Number</label>
                                    <input type="text" class="form-control custom-host-input" name="ref_e_phone_no" value="<?=@$response->references->ref_e_phone_no?>" placeholder="" required>
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="tab-pane fade">
                        <form id="additional">

                            <h4>Additional Information</h4>
                            <div class="row">
                                <div class="form-group">
                                    <label class="control-label col-md-6" for="">Will you have pets?</label>
                                    <div class="form-field col-md-4">
                                        <label class="auto-width"><input type="radio" name="ai_pets" <?=@$response->additional->ai_pets == 'Yes' ? 'checked' : ''?> value="Yes" tabindex="1" class="" required>Yes</label>
                                        <label class="auto-width"><input type="radio" name="ai_pets" <?=@$response->additional->ai_pets == 'No' ? 'checked' : ''?> value="No" tabindex="2" class="" required>No</label>
                                    </div>
                                    <div id="ask_pets_details" style="display:none;">
                                        <div class="col-md-12" style="margin:3px 0px 10px;">
                                            <label class="control-label" for="" style="font-size:13px; color:#3d4a53">List Number And Type Of Pets</label>
                                            <textarea rows="4" class="form-control" name="ai_pets_details" placeholder="2 cats and 1 small dog"><?=@$response->additional->ai_pets_details?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-6" for="">Will you have liquid filled furniture?</label>
                                    <div class="form-field col-md-4">
                                        <label class="auto-width"><input type="radio" name="ai_furniture" <?=@$response->additional->ai_furniture == 'Yes' ? 'checked' : ''?> value="Yes" tabindex="4" class="" required>Yes</label>
                                        <label class="auto-width"><input type="radio" name="ai_furniture" <?=@$response->additional->ai_furniture == 'No' ? 'checked' : ''?> value="No" tabindex="5" class="" required>No</label>
                                    </div>
                                    <div id="ask_furniture_details" style="display:none;">
                                        <div class="col-md-12" style="margin:3px 0px 10px;">
                                            <label class="control-label" for="" style="font-size:13px; color:#3d4a53">Please Explain</label>
                                            <textarea rows="4" class="form-control" name="ai_furniture_details" placeholder="King-sized waterbed"><?=@$response->additional->ai_furniture_details?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-6" for="">Have you ever had bedbugs?</label>
                                    <div class="form-field col-md-4">
                                        <label class="auto-width"><input type="radio" name="ai_bedbugs" <?=@$response->additional->ai_bedbugs == 'Yes' ? 'checked' : ''?> value="Yes" tabindex="7" class="" required>Yes</label>
                                        <label class="auto-width"><input type="radio" name="ai_bedbugs" <?=@$response->additional->ai_bedbugs == 'No' ? 'checked' : ''?> value="No" tabindex="8" class="" required>No</label>
                                    </div>
                                    <div id="ask_bedbugs_details" style="display:none;">
                                        <div class="col-md-12" style="margin:3px 0px 10px;">
                                            <label class="control-label" for="" style="font-size:13px; color:#3d4a53">Please List Date And Explain</label>
                                            <textarea rows="4" class="form-control" name="ai_bedbugs_details" placeholder="July-Dec 2011, treated by exterminators"><?=@$response->additional->ai_bedbugs_details?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-6" for="">Have you ever been evicted?</label>
                                    <div class="form-field col-md-4">
                                        <label class="auto-width"><input type="radio" name="ai_evicted" <?=@$response->additional->ai_evicted == 'Yes' ? 'checked' : ''?> value="Yes" tabindex="10" class="" required>Yes</label>
                                        <label class="auto-width"><input type="radio" name="ai_evicted" <?=@$response->additional->ai_evicted == 'No' ? 'checked' : ''?> value="No" tabindex="11" class="" required>No</label>
                                    </div>
                                    <div id="ask_evicted_details" style="display:none;">
                                        <div class="col-md-12" style="margin:3px 0px 10px;">
                                            <label class="control-label" for="" style="font-size:13px; color:#3d4a53">Please List Date And Explain</label>
                                            <textarea rows="4" class="form-control" name="ai_evicted_details" placeholder="March 2012, violated rental agreement"><?=@$response->additional->ai_evicted_details?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-6" for="">Have you ever filed for bankruptcy?</label>
                                    <div class="form-field col-md-4">
                                        <label class="auto-width"><input type="radio" name="ai_bankruptcy" <?=@$response->additional->ai_bankruptcy == 'Yes' ? 'checked' : ''?> value="Yes" tabindex="13" class="" required>Yes</label>
                                        <label class="auto-width"><input type="radio" name="ai_bankruptcy" <?=@$response->additional->ai_bankruptcy == 'No' ? 'checked' : ''?> value="No" tabindex="14" class="" required>No</label>
                                    </div>
                                    <div id="ask_bankruptcy_details" style="display:none;">
                                        <div class="col-md-12" style="margin:3px 0px 10px;">
                                            <label class="control-label" for="" style="font-size:13px; color:#3d4a53">Please List Date And Explain</label>
                                            <textarea rows="4" class="form-control" name="ai_bankruptcy_details" placeholder="August 2013, unemployment"><?=@$response->additional->ai_bankruptcy_details?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-6" for="">Do you smoke?</label>
                                    <div class="form-field col-md-4">
                                        <label class="auto-width"><input type="radio" name="ai_smoke" <?=@$response->additional->ai_smoke == 'Yes' ? 'checked' : ''?> value="Yes" tabindex="16" class="" required>Yes</label>
                                        <label class="auto-width"><input type="radio" name="ai_smoke" <?=@$response->additional->ai_smoke == 'No' ? 'checked' : ''?> value="No" tabindex="17" class="" required>No</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-6" for="">Have you ever been convicted of selling, distributing or manufacturing illegal drugs?</label>
                                    <div class="form-field col-md-4">
                                        <label class="auto-width"><input type="radio" name="ai_illegal_drugs" <?=@$response->additional->ai_illegal_drugs == 'Yes' ? 'checked' : ''?> value="Yes" tabindex="18" class="" required>Yes</label>
                                        <label class="auto-width"><input type="radio" name="ai_illegal_drugs" <?=@$response->additional->ai_illegal_drugs == 'No' ? 'checked' : ''?> value="No" tabindex="19" class="" required>No</label>
                                    </div>
                                    <div id="ask_illegal_drugs_details" style="display:none;">
                                        <div class="col-md-12" style="margin:3px 0px 10px;">
                                            <label class="control-label" for="" style="font-size:13px; color:#3d4a53">Please List Date And Explain</label>
                                            <textarea rows="4" class="form-control" name="ai_illegal_drugs_details" placeholder="February 2014, misdemeanor for selling perscription drugs"><?=@$response->additional->ai_illegal_drugs_details?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if( @$response->additional->ai_pets == 'Yes' )
                                    $footer_data['custom_js'] .= '$("#ask_pets_details").show();';

                                if( @$response->additional->ai_furniture == 'Yes' )
                                    $footer_data['custom_js'] .= '$("#ask_furniture_details").show();';

                                if( @$response->additional->ai_bedbugs == 'Yes' )
                                    $footer_data['custom_js'] .= '$("#ask_bedbugs_details").show();';

                                if( @$response->additional->ai_evicted == 'Yes' )
                                    $footer_data['custom_js'] .= '$("#ask_evicted_details").show();';

                                if( @$response->additional->ai_bankruptcy == 'Yes' )
                                    $footer_data['custom_js'] .= '$("#ask_bankruptcy_details").show();';

                                if( @$response->additional->ai_illegal_drugs == 'Yes' )
                                    $footer_data['custom_js'] .= '$("#ask_illegal_drugs_details").show();';
                                ?>

                            </div>

                        </form>
                    </div>

                    <div class="tab-pane fade">
                        <form id="financial">

                            <h4>Bank Accounts</h4>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <div class="alert alert-info">
                                        This information is required by landlords and agents as part of their assessment of your financial qualifications.<br>
                                        <label class="no-account-label"><input type="checkbox" id="f_dont_have_account" name="f_dont_have_account" tabindex="1">I don't have any bank accounts</label>
                                    </div>
                                </div>
                            </div>

                            <div id="ask_for_bank">
                                <input type="hidden" name="f_bank_count" id="f_bank_count">
                                <div id="banks">
                                    <?php
                                    if( isset($response->financial->f_bank_count) && $response->financial->f_bank_count > 0 )
                                    {
                                        for ($i=1; $i <= $response->financial->f_bank_count; $i++)
                                        {
                                            $name = 'f_bank_name_'.$i;
                                            $address = 'f_bank_address_'.$i;
                                            $account = 'f_account_number_'.$i;
                                            $balance = 'f_account_balance_'.$i;
                                            $type = 'f_account_type_'.$i;
                                            // pr($i);
                                            ?>
                                            <div id="bank_<?=$i?>"><h4>Bank Account #<?=$i?><?=$i !== 1 ? '<a class="btn btn-danger btn-sm remove_banks"><span title="Delete" class="glyphicon glyphicon-trash"></span></a>' : ''?></h4>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label" for="">Bank Name</label>
                                                        <input type="text" class="form-control custom-host-input" name="f_bank_name_<?=$i?>" value="<?=$response->financial->{$name}?>" placeholder="Bank" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label" for="">Bank Address</label>
                                                        <input type="text" class="form-control custom-host-input" name="f_bank_address_<?=$i?>" value="<?=$response->financial->{$address}?>" placeholder="123 Main St Suite 400" required>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label" for="">Account Number</label>
                                                        <input type="email" class="form-control custom-host-input" name="f_account_number_<?=$i?>" value="<?=$response->financial->{$account}?>" placeholder="987654321" required>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label" for="">Account Balance (Approx)</label>
                                                        <input type="number" class="form-control custom-host-input" name="f_account_balance_<?=$i?>" value="<?=$response->financial->{$balance}?>" placeholder="$" required>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label" for="">Account Type</label>
                                                        <select name="f_account_type_<?=$i?>" class="form-control" required>
                                                            <option <?=$response->financial->{$type} == 'Checking' ? 'selected' : ''?> value="Checking">Checking</option>
                                                            <option <?=$response->financial->{$type} == 'Savings' ? 'selected' : ''?> value="Savings">Savings</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        $footer_data['custom_js'] .= 'var banksCount = '.($i-1).';$("input#f_bank_count").val(banksCount);';
                                        // pre($i);
                                    }
                                    ?>
                                </div>
                                <button id="add_bank" class="btn" type="button">+ Add Bank Account</button>
                            </div>

                        </form>
                    </div>

                    <div class="tab-pane fade">
                        <form id="misc">

                            <h4>Outstanding Loans</h4>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <div class="alert alert-info">
                                        This information is required by landlords and agents as part of their assessment of your financial qualifications.
                                    </div>
                                </div>
                            </div>


                            <input type="hidden" name="f_loans_count" id="f_loans_count">
                            <div id="loans">
                                <?php
                                if( isset($response->misc->f_loans_count) && $response->misc->f_loans_count > 0 )
                                {
                                    for ($i=1; $i <= $response->misc->f_loans_count; $i++)
                                    {
                                        $name = 'm_loan_creditor_name_'.$i;
                                        $address = 'm_loan_creditor_address_'.$i;
                                        $phone = 'm_loan_phone_no_'.$i;
                                        $payment = 'm_loan_monthly_payment_'.$i;
                                        // pr($i);
                                        ?>
                                        <div id="loan_<?=$i?>"><h4>Loan #<?=$i?><?=$i !== 1 ? '<a class="btn btn-danger btn-sm remove_loans"><span title="Delete" class="glyphicon glyphicon-trash"></span></a>' : ''?></h4>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label class="control-label" for="">Creditor Name</label>
                                                    <input type="text" class="form-control custom-host-input" name="m_loan_creditor_name_<?=$i?>" value="<?=$response->misc->{$name}?>" placeholder="Bank">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="control-label" for="">Creditor Address</label>
                                                    <input type="text" class="form-control custom-host-input" name="m_loan_creditor_address_<?=$i?>" value="<?=$response->misc->{$address}?>" placeholder="123 Main St Suite 400">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="control-label" for="">Phone Number</label>
                                                    <input type="email" class="form-control custom-host-input" name="m_loan_phone_no_<?=$i?>" value="<?=$response->misc->{$phone}?>" placeholder="987654321">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="control-label" for="">Monthly Payment</label>
                                                    <input type="number" class="form-control custom-host-input" name="m_loan_monthly_payment_<?=$i?>" value="<?=$response->misc->{$payment}?>" placeholder="$">
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    $footer_data['custom_js'] .= 'var loansCount = '.($i-1).';$("input#f_loans_count").val(loansCount);';
                                    // pre($i);
                                }
                                ?>
                            </div>
                            <button id="add_loan" class="btn" type="button">+ Add a Loan</button>

                            <hr/>

                            <h4>Vehicles</h4>
                            <input type="hidden" name="f_vehicles_count" id="f_vehicles_count">
                            <div id="vehicles">
                                <?php
                                if( isset($response->misc->f_vehicles_count) && $response->misc->f_vehicles_count > 0 )
                                {
                                    for ($i=1; $i <= $response->misc->f_vehicles_count; $i++)
                                    {
                                        $make = 'm_vehicle_make_'.$i;
                                        $model = 'm_vehicle_model_'.$i;
                                        $year = 'm_vehicle_year_'.$i;
                                        $color = 'm_vehicle_color_'.$i;
                                        $license_plate = 'm_vehicle_license_plate_'.$i;
                                        // pr($i);
                                        ?>
                                        <div id="vehicle_<?=$i?>"><h4>Vehicle #<?=$i?><?=$i !== 1 ? '<a class="btn btn-danger btn-sm remove_vehicles"><span title="Delete" class="glyphicon glyphicon-trash"></span></a>' : ''?></h4>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label class="control-label" for="">Make</label>
                                                    <input type="text" class="form-control custom-host-input" name="m_vehicle_make_<?=$i?>" value="<?=$response->misc->{$make}?>" placeholder="DeLorean">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label" for="">Model</label>
                                                    <input type="text" class="form-control custom-host-input" name="m_vehicle_model_<?=$i?>" value="<?=$response->misc->{$model}?>" placeholder="DMC-12">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label" for="">Year</label>
                                                    <input type="email" class="form-control custom-host-input" name="m_vehicle_year_<?=$i?>" value="<?=$response->misc->{$year}?>" placeholder="YYYY">
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label class="control-label" for="">Color</label>
                                                    <input type="text" class="form-control custom-host-input" name="m_vehicle_color_<?=$i?>" value="<?=$response->misc->{$color}?>" placeholder="Silver">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label class="control-label" for="">License Plate</label>
                                                    <input type="text" class="form-control custom-host-input" name="m_vehicle_license_plate_<?=$i?>" value="<?=$response->misc->{$license_plate}?>" placeholder="3CZV657">
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    $footer_data['custom_js'] .= 'var vehiclesCount = '.($i-1).';$("input#f_vehicles_count").val(vehiclesCount);';
                                    // pre($i);
                                }
                                ?>
                            </div>
                            <button id="add_vehicle" class="btn" type="button">+ Add a Vehicle</button>

                        </form>
                    </div>

                </div>
            </div>

            <div class="clearfix"></div>
            <div id="testing_response"></div>

            <div class="modal-footer">
                <input type="hidden" id="request_status">
                <button id="save_button" class="btn btn-primary" onclick="save_application(); return false;">Save</button>
                <button id="next-section" class="btn btn-secondary">Next Section</button>
            </div>

        </div>
    </div>
</div>