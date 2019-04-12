<?php
    $footer_data['custom_js'] = '';

if( isset($application[0]) )
{
	if( !empty($application[0]->content) )
	{
		$response = json_decode( str_replace('&quot;', '"', $application[0]->content) );
		// pre($response);
	}
}
?>
<div class="modal fade" id="pop-apply" tabindex="-1" role="dialog" style="z-index:10000;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3><?=$this->lang->line('c_rental_app');?> <span id="total_count"></span> <span id="filled" style="display: none;"></span></h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
			</div>
			<ul class="login-tabs apply-tabs">
				<li class="tabs_list active"><?=$this->lang->line('c_about_me');?> <span id="about_me_weight"></span></li>
				<li class="tabs_list"><?=$this->lang->line('c_residences');?> <span id="residences_weight"></span></li>
				<li class="tabs_list"><?=$this->lang->line('c_occupation');?> <span id="occupation_weight"></span></li>
				<li class="tabs_list"><?=$this->lang->line('c_references');?> <span id="references_weight"></span></li>
				<li class="tabs_list"><?=$this->lang->line('c_financial');?> <span id="financial_weight"></span></li>
				<li class="misc_weight"><?=$this->lang->line('c_miscd');?>. <span id="misc_weight"></span></li>
			</ul>

			<!-- <form id="form_apply"> -->
			<div class="modal-body login-block">
				<div class="tab-content" id="tab_bl">

					<div class="tab-pane fade in active">
						<form id="about_me" enctype="multipart/form-data">

							<h4><?=$this->lang->line('c_about_me');?></h4>
							<div class="row">
								<div class="form-group col-md-4">
									<label class="control-label" for="fullname"><?=$this->lang->line('a_first_name');?></label>
									<input type="text" class="form-control custom-host-input" name="a_first_name" value="<?=@$response->about_me->a_first_name?>" placeholder="First Name" required>
								</div>
								<div class="form-group col-md-4">
									<label class="control-label" for="fullname"><?=$this->lang->line('a_last_name');?></label>
									<input type="text" class="form-control custom-host-input" name="a_last_name" value="<?=@$response->about_me->a_last_name?>" placeholder="Last Name" required>
								</div>
								<div class="form-group col-md-4">
									<label class="control-label" for="fullname"><?=$this->lang->line('a_email');?></label>
									<input type="email" class="form-control custom-host-input" name="a_email" value="<?=@$response->about_me->a_email?>" placeholder="jane.j.smith@sampleemail.com" required>
								</div>
								<div class="form-group col-md-4">
									<label class="control-label" for="fullname"><?=$this->lang->line('a_phone');?> </label>
									<input type="text" class="form-control custom-host-input" name="a_phone" value="<?=@$response->about_me->a_phone?>" placeholder="Phone" maxlength="10" required>
								</div>
								<div class="form-group col-md-4">
									<label class="control-label" for="fullname"><?=$this->lang->line('a_dob');?></label>
									<input type="date" class="form-control custom-host-input" name="a_dob" value="<?=@$response->about_me->a_dob?>" placeholder="YYYY-MM-DD" required>
								</div>

							</div>
							<h4><?=$this->lang->line('a_occupant_other');?></h4>
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
								<div id="occupant_<?=$i?>"><h4><?=$this->lang->line('a_oth_occupant');?> #<?=$i?> <?=$i !== 1 ? '<a class="btn btn-danger btn-sm remove_occupants"><span title="Delete" class="glyphicon glyphicon-trash"></span></a>' : ''?></h4>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="control-label" for="fullname"><?=$this->lang->line('a_occupant_name');?></label>
                                            <input type="text" class="form-control custom-host-input" name="a_occupant_name_<?=$i?>" value="<?=$response->about_me->{$name}?>" placeholder="John Smith">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="control-label" for="fullname"><?=$this->lang->line('a_occupant_phone_');?></label>
                                            <input type="text" class="form-control custom-host-input" name="a_occupant_phone_<?=$i?>" value="<?=$response->about_me->{$phone}?>" placeholder="" maxlength="10">
                                        </div>
                                    </div>
								</div>
								<?php
								}

								$footer_data['custom_js'] .= 'var occupantsCount = '.($i-1).';$("input#a_occupant_count").val(occupantsCount);';
								// pre($i);
							}
							?>
							</div>
							<button id="add_occupant" class="btn" type="button">+ <?=$this->lang->line('a_oth_occupant');?></button>

						</form>
					</div>

					<div class="tab-pane fade">
						<form id="residences" enctype="multipart/form-data">

							<h4><?=$this->lang->line('c_current_resid');?></h4>
							<div class="row">

								<div class="form-group col-md-6">
									<label class="control-label" for="fullname"><?=$this->lang->line('r_current_housing_type');?></label>
									<div class="form-field">
										<label class="auto-width">
											<input name="r_current_housing_type" <?=@$response->residences->r_current_housing_type == 'Rented' ? 'checked' : ''?> type="radio" value="Rented" tabindex="1" class=""> <?=$this->lang->line('r_current_housing_type_rented');?>
										</label>
										&nbsp;
										<label class="auto-width">
											<input name="r_current_housing_type" <?=@$response->residences->r_current_housing_type == 'Owned' ? 'checked' : ''?> type="radio" value="Owned" tabindex="2" class=""> <?=$this->lang->line('r_current_housing_type_own');?>
										</label>
									</div>
								</div>


								<div class="form-group col-md-6">
									<label class="control-label" for="fullname"><?=$this->lang->line('r_current_address');?></label>
									<input type="text" class="form-control custom-host-input" name="r_current_address" value="<?=@$response->residences->r_current_address?>" placeholder="" required>
								</div>
								<div class="form-group col-md-3">
									<label class="control-label" for="fullname"><?=$this->lang->line('r_current_move_in_date');?></label>
									<input type="date" class="form-control custom-host-input" name="r_current_move_in_date" value="<?=@$response->residences->r_current_move_in_date?>" placeholder="" required>
								</div>
                                <div class="form-group col-md-3">
									<label class="control-label" for="fullname"><?=$this->lang->line('r_current_move_out_date');?></label>
									<input type="date" class="form-control custom-host-input" name="r_current_move_out_date" value="<?=@$response->residences->r_current_move_out_date?>" placeholder="" required>
								</div>
								<div id="current_housing_rented">
								<div class="form-group col-md-4">
									<label class="control-label" for="fullname"><?=$this->lang->line('r_current_monthly_rent');?></label>
									<input type="number" class="form-control custom-host-input" name="r_current_monthly_rent" value="<?=@$response->residences->r_current_monthly_rent?>" placeholder="">
								</div>
								<div class="form-group col-md-4">
									<label class="control-label" for="fullname"><?=$this->lang->line('r_current_landlord_name');?></label>
									<input type="text" class="form-control custom-host-input" name="r_current_landlord_name" value="<?=@$response->residences->r_current_landlord_name?>" placeholder="">
								</div>
								<div class="form-group col-md-4">
									<label class="control-label" for="fullname"><?=$this->lang->line('r_current_landlord_phone_no');?></label>
									<input type="text" class="form-control custom-host-input" name="r_current_landlord_phone_no" value="<?=@$response->residences->r_current_landlord_phone_no?>" placeholder="" maxlength="10">
								</div>
								</div>
								<div class="form-group col-md-12">
									<label class="control-label" for="fullname"><?=$this->lang->line('r_current_reason_for_leaving');?></label>
									<textarea class="form-control custom-host-input" rows="4" name="r_current_reason_for_leaving"><?=@$response->residences->r_current_reason_for_leaving?></textarea>
								</div>

							</div>

						</form>
					</div>

					<div class="tab-pane fade">
						<form id="occupation" enctype="multipart/form-data">

							<h4> <?=$this->lang->line('current_occupation');?> </h4>
							<div class="row">
								<div class="form-group col-md-12">
									<label class="control-label pull-left" style="padding-right:10px;" for=""><?=$this->lang->line('status');?></label>
									<div class="form-field">
										<label class="auto-width"><input type="radio" name="o_current_status" <?=@$response->occupation->o_current_status == 'Employed' ? 'checked' : ''?> value="Employed" tabindex="1" class=""><?=$this->lang->line('employee');?></label>
										<label class="auto-width" style="padding-left:8px;"><input type="radio" name="o_current_status" <?=@$response->occupation->o_current_status == 'Student' ? 'checked' : ''?> value="Student" tabindex="2" class=""><?=$this->lang->line('student');?></label>
										<label class="auto-width" style="padding-left:8px;"><input type="radio" name="o_current_status" <?=@$response->occupation->o_current_status == 'none' ? 'checked' : ''?> value="none" tabindex="3" class=""><?=$this->lang->line('none');?></label>
									</div>
								</div>

								<div id="o_employed">

                  <div class="form-group col-md-3">
										<label class="control-label" for=""><?=$this->lang->line('employer');?></label>
										<input type="text" class="form-control custom-host-input" name="o_current_employer" value="<?=@$response->occupation->o_current_employer?>" placeholder="" required>
									</div>

									<div class="form-group col-md-3">
										<label class="control-label" for=""><?=$this->lang->line('poistion_title');?></label>
										<input type="text" class="form-control custom-host-input" name="o_current_job_title" value="<?=@$response->occupation->o_current_job_title?>" placeholder="" required>
									</div>
									<div class="form-group col-md-3">
										<label class="control-label" for=""><?=$this->lang->line('monthly_income');?></label>
										<input type="text" class="form-control custom-host-input" name="o_current_monthly_salary" value="<?=@$response->occupation->o_current_monthly_salary?>" placeholder="" required>
									</div>
									<div class="form-group col-md-3">
										<label class="control-label" for=""><?=$this->lang->line('type_of_contract');?></label>


                    <select name="o_current_work_type" class="form-control">
  											<option <?=@$response->occupation->o_current_work_type == 'full_time' ? 'selected' : ''?> value="full_time"><?=$this->lang->line('full_time');?></option>
  											<option <?=@$response->occupation->o_current_work_type == 'part_time' ? 'selected' : ''?> value="part_time"><?=$this->lang->line('part_time');?></option>
                        <option <?=@$response->occupation->o_current_work_type == 'temporary' ? 'selected' : ''?> value="temporary"><?=$this->lang->line('temporary');?></option>
                        <option <?=@$response->occupation->o_current_work_type == 'trainee' ? 'selected' : ''?> value="trainee"><?=$this->lang->line('trainee');?></option>
										</select>

									</div>
									<div class="form-group col-md-3">
										<label class="control-label" for=""><?=$this->lang->line('name_of_responsible');?></label>
										<input type="text" class="form-control custom-host-input" name="o_current_manager_name" value="<?=@$response->occupation->o_current_manager_name?>" placeholder="" required>
									</div>
									<div class="form-group col-md-3">
										<label class="control-label" for=""><?=$this->lang->line('phone');?></label>
										<input type="text" class="form-control custom-host-input" name="o_current_manager_phone_no" value="<?=@$response->occupation->o_current_manager_phone_no?>" placeholder="" maxlength="10" required>
									</div>
									<div class="form-group col-md-6">
										<label class="control-label" for=""><?=$this->lang->line('address_lable');?></label>
										<input type="text" class="form-control custom-host-input" name="o_current_work_address" value="<?=@$response->occupation->o_current_work_address?>" placeholder="">
									</div>
									<div class="form-group col-md-4">
										<label class="control-label" for=""><?=$this->lang->line('start_date');?></label>
										<input type="date" class="form-control custom-host-input" name="o_current_start_date" value="<?=@$response->occupation->o_current_start_date?>" placeholder="" required>
									</div>
								</div>

								<div id="o_other">
									<div class="form-group col-md-4">
										<label class="control-label" for=""><?=$this->lang->line('income_source');?></label>
										<input type="text" class="form-control custom-host-input" name="o_current_monthly_income_source" value="<?=@$response->occupation->o_current_monthly_income_source?>" placeholder="" required>
									</div>
									<div class="form-group col-md-4">
										<label class="control-label" for=""><?=$this->lang->line('monthly_income');?></label>
										<input type="text" class="form-control custom-host-input" name="o_current_monthly_income" value="<?=@$response->occupation->o_current_monthly_income?>" placeholder="" required>
									</div>
								</div>

							</div>
							<hr/>


							<h4><?=$this->lang->line('additional_income');?></h4>
							<div class="row">
								<div class="form-group col-md-6">
									<label class="control-label" for=""><?=$this->lang->line('income_source');?></label>
									<input type="text" class="form-control custom-host-input" name="o_income_sources" value="<?=@$response->occupation->o_income_sources?>" placeholder="">
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for=""><?=$this->lang->line('amount_of_income');?></label>
									<input type="text" class="form-control custom-host-input" name="o_income_amount" value="<?=@$response->occupation->o_income_amount?>" placeholder="">
								</div>
							</div>

							<!-- <h4>Résumé de situation financière</h4>
							<div class="row">
								<div class="form-group col-md-6">
									<label class="control-label" for="">Revenu total</label>
									<p>(revenu mensuel + revenu additionne)</p>
								</div>
								<div class="form-group col-md-6 text-right">
									<label class="control-label" id="total_of_o">0</label>
								</div>
							</div> -->

						</form>
					</div>

					<div class="tab-pane fade">
						<form id="references" enctype="multipart/form-data">

							<h4><?=$this->lang->line('refrence_person');?></h4>
							<div class="row">
								<div class="form-group col-md-6">
									<label class="control-label"><?=$this->lang->line('c_full_name');?></label>
									<input type="text" class="form-control custom-host-input" name="ref_p_full_name" value="<?=@$response->references->ref_p_full_name?>" placeholder="" required>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label"><?=$this->lang->line('martial_status');?>
                                    </label>
									<input type="text" class="form-control custom-host-input" name="ref_p_relationship" value="<?=@$response->references->ref_p_relationship?>" placeholder="" required>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for=""><?=$this->lang->line('address_lable');?></label>
									<input type="text" class="form-control custom-host-input" name="ref_p_address" value="<?=@$response->references->ref_p_address?>" placeholder="" required>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for=""><?=$this->lang->line('phone');?></label>
									<input type="text" class="form-control custom-host-input" name="ref_p_phone_no" value="<?=@$response->references->ref_p_phone_no?>" placeholder="" maxlength="10" required>
								</div>
							</div>
							<hr/>
							<h4><?=$this->lang->line('emergency_contact');?></h4>
							<div class="row">
								<div class="form-group col-md-6">
									<label class="control-label" for=""><?=$this->lang->line('c_full_name');?></label>
									<input type="text" class="form-control custom-host-input" name="ref_e_full_name" value="<?=@$response->references->ref_e_full_name?>" placeholder="" required>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for=""> <?=$this->lang->line('relation_status');?></label>
									<input type="text" class="form-control custom-host-input" name="ref_e_relationship" value="<?=@$response->references->ref_e_relationship?>" placeholder="" required>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for=""><?=$this->lang->line('address_lable');?></label>
									<input type="text" class="form-control custom-host-input" name="ref_e_address" value="<?=@$response->references->ref_e_address?>" placeholder="" required>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for=""><?=$this->lang->line('phone');?></label>
									<input type="text" class="form-control custom-host-input" name="ref_e_phone_no" value="<?=@$response->references->ref_e_phone_no?>" placeholder="" maxlength="10" required>
								</div>
							</div>

						</form>
					</div>


					<div class="tab-pane fade">



                            <form enctype="multipart/form-data" accept-charset="utf-8"  id="financial"  method="post" action="">
                                <div style="display: none" class="ajax-loader_icon" id="loading"><img src="<?=base_url('assets/img/loading-load.gif');?>" /></div>
                                    <div id="bank1"><h4><?=$this->lang->line('c_mandatory');?></h4>
                                        <div class="row">

                                            <div class="form-group col-md-4">
                                                <label class="control-label"><?=$this->lang->line('cnic_front');?></label>
                                                <div class="input-group">
                                                    <div class="input-group-btn">
                                                        <span class="btn btn-primary" onclick="$(this).parent().find('input[type=file]').click();">Choose File</span>
                                                        <input type="file" class="bank_doc" onchange="$(this).parent().parent().find('.form-control').html($(this).val().split(/[\\|/]/).pop());" name="payslip6" id="payslip6" >
                                                        <input type="hidden" value="<?php if(isset($response->financial->identity_card)){ echo $response->financial->identity_card; } ?>" name="payslip6_document" id="payslip6_document">
                                                    </div>
                                                    <div class="form-control"></div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="control-label"><?=$this->lang->line('cnic_back');?></label>
                                                <div class="input-group">
                                                    <div class="input-group-btn">
                                                        <span class="btn btn-primary" onclick="$(this).parent().find('input[type=file]').click();">Choose File</span>
                                                        <input type="file" class="bank_doc" onchange="$(this).parent().parent().find('.form-control').html($(this).val().split(/[\\|/]/).pop());" name="payslip7"  id="payslip7" >
                                                        <input type="hidden" value="<?php if(isset($response->financial->file_id_card_back)){ echo $response->financial->file_id_card_back; } ?>" name="payslip7_document" id="payslip7_document">
                                                    </div>
                                                    <div class="form-control"></div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>



						</form>
					</div>

					<div class="tab-pane fade">
						<form id="misc" enctype="multipart/form-data">
							<h4><?=$this->lang->line('vehicle');?></h4>
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
								<div id="vehicle_<?=$i?>"><h4><?=$this->lang->line('vehicle');?> #<?=$i?><?=$i !== 1 ? '<a class="btn btn-danger btn-sm remove_vehicles"><span title="Delete" class="glyphicon glyphicon-trash"></span></a>' : ''?></h4>
								<div class="row">
									<div class="form-group col-md-3">
										<label class="control-label" for=""><?=$this->lang->line('make');?></label>
										<input type="text" class="form-control custom-host-input" name="m_vehicle_make_<?=$i?>" value="<?=$response->misc->{$make}?>" placeholder="<?=$this->lang->line('make');?>">
									</div>
									<div class="form-group col-md-2">
										<label class="control-label" for=""><?=$this->lang->line('model');?></label>
										<input type="text" class="form-control custom-host-input" name="m_vehicle_model_<?=$i?>" value="<?=$response->misc->{$model}?>" placeholder="<?=$this->lang->line('model');?>">
									</div>
									<div class="form-group col-md-2">
										<label class="control-label" for=""><?=$this->lang->line('year');?></label>
										<input type="email" class="form-control custom-host-input" name="m_vehicle_year_<?=$i?>" value="<?=$response->misc->{$year}?>" placeholder="<?=$this->lang->line('year');?>">
									</div>
									<div class="form-group col-md-2">
										<label class="control-label" for=""><?=$this->lang->line('color');?></label>
										<input type="text" class="form-control custom-host-input" name="m_vehicle_color_<?=$i?>" value="<?=$response->misc->{$color}?>" placeholder="<?=$this->lang->line('color');?>">
									</div>
									<div class="form-group col-md-3">
										<label class="control-label" for=""><?=$this->lang->line('number_plate');?></label>
										<input type="text" class="form-control custom-host-input" name="m_vehicle_license_plate_<?=$i?>" value="<?=$response->misc->{$license_plate}?>" placeholder="<?=$this->lang->line('number_plate');?>">
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
							<button id="add_vehicle" class="btn" type="button">+ Add a <?=$this->lang->line('vehicle');?></button>

						</form>
					</div>

				</div>
                <div class="clearfix"></div>
                <div id="testing_response"></div>
			</div>

			<div class="modal-footer">
				<input type="hidden" id="request_status">
				<button id="save_button" class="btn btn-primary" onclick="save_application(); return false;"><?=$this->lang->line('save');?></button>
				<button id="next-section" class="btn btn-secondary"><?=$this->lang->line('next_section');?></button>
			</div>

		</div>
	</div>
</div>
