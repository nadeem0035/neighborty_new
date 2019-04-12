<?php
if( isset($application[0]) )
{
    if( !empty($application[0]->content) )
    {
        $response = json_decode( str_replace('&quot;', '"', $application[0]->content) );
        //pre($response);
    }
}

if( empty($response) || !isset($response) )
    exit('Application Not Submitted.');
?>

<div class="tab-pane apply_tab fade in active" id="about_me">
    <table class="table profile-contacts" border="0">
        <thead>
        <tr>
            <th colspan="2"><?=$this->lang->line('c_about_me');?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th><?=$this->lang->line('c_name');?>:</th>
            <td><?=@$response->about_me->a_first_name?> <?=@$response->about_me->a_middle_name?> <?=@$response->about_me->a_last_name?></td>
        </tr>
        <tr>
            <th><?=$this->lang->line('c_v_phone');?>:</th>
            <td><?=@$response->about_me->a_phone?></td>
        </tr>
        <tr>
            <th><?=$this->lang->line('c_email_v');?>:</th>
            <td><a href="mailto:<?=@$response->about_me->a_email?>"><?=@$response->about_me->a_email?></a></td>
        </tr>
        <tr>
            <th><?=$this->lang->line('c_dob');?>:</th>
            <td><?=@$response->about_me->a_dob ?></td>
        </tr>

        </tbody>
    </table>
    <table class="table profile-contacts" border="0">
        <thead>
        <tr>
            <th colspan="2"> <?=$this->lang->line('c_other_occupant');?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        if( isset($response->about_me->a_occupant_count) && $response->about_me->a_occupant_count > 0 )
        {
            for ($i=1; $i <= $response->about_me->a_occupant_count; $i++)
            {
                $name = 'a_occupant_name_'.$i;
                $phone = 'a_occupant_phone_'.$i;
                // pr($i);
                ?>
                <tr>
                    <th><?=$i?>. <?=$this->lang->line('a_occupant_name');?>:</th>
                    <td><?=$response->about_me->{$name}?></td>
                </tr>
                <tr>
                    <th><?=$i?>. <?=$this->lang->line('c_a_occupant_phone_');?>:</th>
                    <td><?=$response->about_me->{$phone}?></td>
                </tr>
                <?php
            }
        }
        else
            echo "<tr><td colspan='2' align='center'>".$this->lang->line('c_not_yet')."</td></tr>";
        ?>
        </tbody>
    </table>
</div>

<div class="tab-pane apply_tab fade" id="residences">
    <table class="table profile-contacts" border="0">
        <thead>
        <tr><th colspan="2"><?=$this->lang->line('c_residences');?></th></tr>
        </thead>
        <tbody>
        <tr>
            <th><?=$this->lang->line('c_house_type');?>:</th><td><?=@$response->residences->r_current_housing_type?></td>
        </tr>
        <tr>
            <th><?=$this->lang->line('c_r_current_address');?>:</th><td><?=@$response->residences->r_current_address?></td>
        </tr>
        <tr>
            <th><?=$this->lang->line('c_r_current_move_in_date');?>:</th><td><?=@$response->residences->r_current_move_in_date?></td>
        </tr>
        <tr>
            <th><?=$this->lang->line('c_r_current_move_out_date');?>:</th><td><?=@$response->residences->r_current_move_out_date?></td>
        </tr>
        <tr>
            <th><?=$this->lang->line('c_r_current_monthly_rent');?>:</th><td><?=@$response->residences->r_current_monthly_rent?></td>
        </tr>
        <tr>
            <th><?=$this->lang->line('c_r_current_landlord_name');?>:</th><td><?=@$response->residences->r_current_landlord_name?></td>
        </tr>
        <tr>
            <th><?=$this->lang->line('c_r_current_landlord_phone_no');?></th><td><?=@$response->residences->r_current_landlord_phone_no?></td>
        </tr>
        <tr>
            <td colspan="2"><?=@$response->residences->r_current_reason_for_leaving?></td>
        </tr>
        </tbody>
    </table>

</div>

<div class="tab-pane apply_tab fade" id="occupation">
        <table class="table profile-contacts" border="0">
            <thead>
            <tr><th colspan="4"><?=$this->lang->line('c_occupation');?></th></tr>
            </thead>
            <tbody>
            <tr>
                <th><?=$this->lang->line('c_o_current_status');?>:</th><td><?=@$response->occupation->o_current_status?></td>
                <th><?=$this->lang->line('c_o_current_employer');?>:</th><td><?=@$response->occupation->o_current_employer?></td>
            </tr>
            <tr>
                <th><?=$this->lang->line('c_o_current_job_title');?>:</th><td><?=@$response->occupation->o_current_job_title?></td>
                <th><?=$this->lang->line('c_o_current_monthly_salary');?>:</th><td><?=@$response->occupation->o_current_monthly_salary?></td>
            </tr>
            <tr>
                <th><?=$this->lang->line('c_o_current_work_type');?>:</th> <td><?=@$response->occupation->o_current_work_type?></td>
                <th><?=$this->lang->line('c_o_current_manager_name');?>:</th><td><?=@$response->occupation->o_current_manager_name?></td>
            </tr>
            <tr>
                <th><?=$this->lang->line('c_o_current_manager_phone_no');?>:</th> <td><?=@$response->occupation->o_current_manager_phone_no?></td>
                <th><?=$this->lang->line('c_o_current_work_address');?>:</th> <td><?=@$response->occupation->o_current_work_address?></td>
            </tr>
            <tr>
                <th><?=$this->lang->line('c_o_current_start_date');?></th> <td><?=@$response->occupation->o_current_start_date?></td>
                <th><?=$this->lang->line('c_o_income_sources');?></th> <td><?=@$response->occupation->o_current_monthly_income_source?></td>
            </tr>

            <tr>
                <th><?=$this->lang->line('c_o_income_amount');?>:</th><td colspan="3"><?=@$response->occupation->o_current_monthly_income?></td>
            </tr>
            </tbody>

            <thead>
            <tr><th colspan="4"><?=$this->lang->line('c_additional_incom');?></th></tr>
            </thead>
            <tbody>
            <tr>
                <th><?=$this->lang->line('c_o_income_sources');?>:</th><td colspan="3"><?=@$response->occupation->o_income_sources?></td>
            </tr>
            <tr>
                <th><?=$this->lang->line('c_o_income_amount');?>:</th><td colspan="3"><?=@$response->occupation->o_income_amount?></td>
            </tr>
            </tbody>
        </table>
    </div>
    <!-- <h4>Financial Summary</h4> -->

<div class="tab-pane apply_tab fade" id="references">
    <table class="table profile-contacts" border="0">
        <thead>
        <tr>
            <th colspan="2"><?=$this->lang->line('c_references');?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th><?=$this->lang->line('ref_p_full_name');?>:</th>
            <td><?=@$response->references->ref_p_full_name?></td>
        </tr>
        <tr>
            <th><?=$this->lang->line('c_ref_p_relationship');?>:</th>
            <td><?=@$response->references->ref_p_relationship?></td>
        </tr>
        <tr>
            <th><?=$this->lang->line('c_ref_p_phone_no');?>:</th>
            <td><?=@$response->references->ref_p_phone_no?></td>
        </tr>
        <tr>
            <th><?=$this->lang->line('c_ref_p_address');?>:</th>
            <td><?=@$response->references->ref_p_address?></td>
        </tr>
        </tbody>
        <thead>
        <tr>
            <th colspan="2"><?=$this->lang->line('c_emergency_contact');?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th><?=$this->lang->line('c_ref_e_full_name');?>:</th>
            <td><?=@$response->references->ref_e_full_name?></td>
        </tr>
        <tr>
            <th><?=$this->lang->line('c_ref_e_relationship');?>:</th>
            <td><?=@$response->references->ref_e_relationship?></td>
        </tr>
        <tr>
            <th><?=$this->lang->line('c_ref_e_phone_no');?>:</th>
            <td><?=@$response->references->ref_e_phone_no?></td>
        </tr>
        <tr>
            <th><?=$this->lang->line('c_ref_e_address');?>:</th>
            <td><?=@$response->references->ref_e_address?></td>
        </tr>
        </tbody>
    </table>
</div>
<div class="tab-pane apply_tab fade" id="financial">
    <table class="table profile-contacts" border="0">
        <thead>
        <tr>
            <th colspan="2"><?=$this->lang->line('c_financial');?></th>
        </tr>
        </thead>
        <tbody>
        <?php

        if( count($response->financial) > 0 )
        { ?>

            <?php if($response->financial->identity_card != '') { ?>
            <tr><th><?=$this->lang->line('c_identity_card');?>:</th>
                <td><a class="btn btn-sm btn-primary" href="<?=base_url('assets/media/bank_document/'.$response->financial->identity_card);?>">Vue</a></td>
            </tr>
        <?php } ?>

            <?php if($response->financial->file_id_card_back != '') { ?>

            <tr><th><?=$this->lang->line('c_file_id_card_back');?> :</th>
                <td><a class="btn btn-sm btn-primary" href="<?=base_url('assets/media/bank_document/'.$response->financial->file_id_card_back);?>">Vue</a></td>
            </tr>

        <?php } ?>

        <?php }
        else
            echo "<tr><td align='center' colspan='2'>".$this->lang->line('c_not_yet')."</td></tr>";
        ?>
        </tbody>
    </table>
</div>

<div class="tab-pane apply_tab fade" id="misc">
    <table class="table profile-contacts" border="0">
        <thead>
        <tr>
            <th colspan="2"><?=$this->lang->line('c_misc');?></th>
        </tr>
        </thead>
        <thead>
        <tr>
            <th colspan="2"><?=$this->lang->line('c_vehicle');?></th>
        </tr>
        </thead>
        <tbody>
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
                <tr><th><?=$i?>. <?=$this->lang->line('c_m_vehicle_make');?>:</th><td><?=$response->misc->{$make}?></td></tr>
                <tr><th><?=$i?>. <?=$this->lang->line('c_m_vehicle_model');?>:</th><td><?=$response->misc->{$model}?></td></tr>
                <tr><th><?=$i?>. <?=$this->lang->line('c_m_vehicle_year');?>:</th><td><?=$response->misc->{$year}?></td></tr>
                <tr><th><?=$i?>. <?=$this->lang->line('c_m_vehicle_color');?>:</th><td><?=$response->misc->{$color}?></td></tr>
                <tr><th><?=$i?>. <?=$this->lang->line('c_m_vehicle_license_plate');?>:</th><td><?=$response->misc->{$license_plate}?></td></tr>
                <?php
            }
        }
        else
            echo "<tr><td colspan='2' align='center'>".$this->lang->line('c_not_yet')."</td></tr>";
        ?>

        </tbody>
    </table>
</div>
