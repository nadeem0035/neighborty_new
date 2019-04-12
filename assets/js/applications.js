$('.bank_doc').change(function(event){

    var field_id = event.target.id;

   // var name = $(this).attr('name');
    //console.log(field_id);

    startUpload(field_id);
});


function startUpload(id) {
    var formUrl = site_url + 'upload-document';
    var file_data = $('#'+id).prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    console.log(form_data);
    //alert(formData);
    $.ajax(
        {
            url: formUrl,
            type: 'POST',
            data: form_data,
            async : false,
            cache : false,
            contentType : false,
            processData : false,

            beforeSend: function() {
                $('.ajax-loader_icon').show();
            },
            success: function (data, textSatus, jqXHR)
            {
                if (data)
                {
                    $('#'+id+'_document').val(data);
                    console.log('uploaded');
                }
                else
                {
                    alert('not uploaded')
                }
            },
            complete: function(xhr) {
                $('.ajax-loader_icon').hide();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                console.log('Fileupload error');
            }
        });

}



function array2object(form_id) {
    if (form_id.length == 0)
        return false;

    var form = $('form#' + form_id).serializeArray();
    var final_data = {};
    $(form).each(function (index, obj) {
        final_data[obj.name] = obj.value;
    });

    return final_data;
}

function application_count(){
    var url = site_url + 'apply/update_count/';
    var count = $('#total_count').text();
    $.ajax({
        type: "POST",
        cache: false,
        url: url,
        data: {count:count},
        async: false,
        success: function (result) {
            if (result) {
                true;
            }
        },
    });
}

function save_application() {

    var locked = $('#request_status').val();

    if (locked == 'yes') {
        return false;
    }
    var form_data = {

        about_me: array2object('about_me'),
        residences: array2object('residences'),
        occupation: array2object('occupation'),
        references: array2object('references'),
        additional: array2object('additional'),
        financial: array2object('financial'),
        misc: array2object('misc')

    };

    $.ajax({
        url: site_url + 'do',
        type: 'POST',
        data: form_data,
        beforeSend: function () {
            $('#request_status').val('yes');
            $('#save_button').attr('disabled', 'disabled');
        },
        success: function (data) {
            console.log('success');
            $('#request_status').val('no');
            $('#save_button').removeAttr('disabled');
            // alert('sent');
            $('#testing_response').html(data);

        }
    });
    return false;
}



$(document).ready(function () {
   // $("#tab_bl input").on('blur',function(){
    $("#tab_bl input").change(function(){
        // alert('blur');
        save_application();
        application_count();

    });
});

function apply_before() {
    $(".alert").html('<p>Please complete your application to proceed</p>');
    $('.alert').show();
    $('.alert').fadeOut(3000);

}


occupantsDiv = $('#occupants');

// if( occupantsCount == '' )
if (typeof occupantsCount == 'undefined') {
    occupantsCount = 0;
}

$('#add_occupant').click(function () {
    if (occupantsCount == '5') {
        $('#add_occupant').attr('disabled', true);
        return false;
    }
    else {
        $('#add_occupant').removeAttr('disabled');
    }

    occupantsCount++;
    $('input#a_occupant_count').val(occupantsCount);

    if (occupantsCount == '5') {
        $('#add_occupant').attr('disabled', true);
    }

    if (occupantsCount == 1) {
        occupantsDiv.append('<div id="occupant_' + occupantsCount + '"><h4>Autre occupant #' + occupantsCount + '</h4>' +
            '<div class="form-group col-md-6">' +
            '<label class="control-label" for="fullname">Nom complet</label>' +
            '<input type="text" class="form-control custom-host-input" name="a_occupant_name_' + occupantsCount + '" value="" placeholder="John Smith">' +
            '</div>' +
            '<div class="form-group col-md-6">' +
            '<label class="control-label" for="fullname">Téléphone </label>' +
            '<input type="text" class="form-control custom-host-input" name="a_occupant_phone_' + occupantsCount + '" value="" placeholder="" maxlength="10">' +
            '</div>' +
            '</div>');
    }
    else {
        occupantsDiv.append('<div id="occupant_' + occupantsCount + '"><h4>Autre occupant #' + occupantsCount + ' <a class="btn btn-danger btn-sm remove_occupants"><span title="Delete" class="glyphicon glyphicon-trash"></span></a></h4>' +
            '<div class="form-group col-md-6">' +
            '<label class="control-label" for="fullname">Nom complet</label>' +
            '<input type="text" class="form-control custom-host-input" name="a_occupant_name_' + occupantsCount + '" value="" placeholder="John Smith">' +
            '</div>' +
            '<div class="form-group col-md-6">' +
            '<label class="control-label" for="fullname">Téléphone</label>' +
            '<input type="text" class="form-control custom-host-input" name="a_occupant_phone_' + occupantsCount + '" value="" placeholder="" maxlength="10">' +
            '</div>' +
            '</div>');
    }

    return false;

});

//Remove button
$(document).on('click', '.remove_occupants', function () {
    /*if( occupantsCount > 2 )
    {
        // $(this).closest('div').remove();
    }*/
    // alert(occupantsCount);
    $('div#occupant_' + occupantsCount).remove();
    setInterval(function () {
        $('#save_button').click();
    }, 1000);

    if (occupantsCount >= '5') {
        $('#add_occupant').removeAttr('disabled');
    }
    occupantsCount--;
    $('input#a_occupant_count').val(occupantsCount);
    return false;
});


/* Residences */
$("input[name$='r_current_housing_type']").click(function () {
    var show_r_current_housing_type = $(this).val();
    if (show_r_current_housing_type == 'Rented') {
        $("input[name$='r_current_monthly_rent']").attr('required');
        $("#current_housing_rented").show();
    }
    else {
        $("input[name$='r_current_monthly_rent']").removeAttr('required');
        $("#current_housing_rented").hide();
    }
});

$("input[name$='r_previous_housing_type']").click(function () {
    var show_r_previous_housing_type = $(this).val();
    // alert(show_r_previous_housing_type);
    if (show_r_previous_housing_type == 'Rented') {
        $("input[name$='r_previous_address']").attr('required');
        $("input[name$='r_previous_move_in_date']").attr('required');
        $("input[name$='r_previous_monthly_rent']").attr('required');
        $("#previous_housing_rented_none").show();
        $("#previous_housing_rented").show();
    }
    if (show_r_previous_housing_type == 'None') {
        $("input[name$='r_previous_address']").removeAttr('required');
        $("input[name$='r_previous_move_in_date']").removeAttr('required');
        $("input[name$='r_previous_monthly_rent']").removeAttr('required');
        $("#previous_housing_rented_none").hide();
    }
    if (show_r_previous_housing_type == 'Owned') {
        $("input[name$='r_previous_address']").attr('required');
        $("input[name$='r_previous_move_in_date']").attr('required');
        $("input[name$='r_previous_monthly_rent']").removeAttr('required');
        $("#previous_housing_rented_none").show();
        $("#previous_housing_rented").hide();
    }
});

/* Occupation */
$("input[name$='o_current_status']").click(function () {
    var show_o_current_status = $(this).val();
    if (show_o_current_status == 'Employed') {
        $("input[name$='o_current_employer']").attr('required');
        $("input[name$='o_current_job_title']").attr('required');
        $("input[name$='o_current_monthly_salary']").attr('required');
        $("input[name$='o_current_manager_name']").attr('required');
        $("input[name$='o_current_manager_phone_no']").attr('required');
        $("input[name$='o_current_start_date']").attr('required');

        $("input[name$='o_current_monthly_income_source']").removeAttr('required');
        $("input[name$='o_current_monthly_income']").removeAttr('required');

        $("#o_employed").show();
        $("#o_other").hide();
    }
    else {
        $("input[name$='o_current_employer']").removeAttr('required');
        $("input[name$='o_current_job_title']").removeAttr('required');
        $("input[name$='o_current_monthly_salary']").removeAttr('required');
        $("input[name$='o_current_manager_name']").removeAttr('required');
        $("input[name$='o_current_manager_phone_no']").removeAttr('required');
        $("input[name$='o_current_start_date']").removeAttr('required');

        $("input[name$='o_current_monthly_income_source']").attr('required');
        $("input[name$='o_current_monthly_income']").attr('required');

        $("#o_employed").hide();
        $("#o_other").show();
    }
});

$("input[name$='o_previous_status']").click(function () {
    var show_o_previous_status = $(this).val();
    if (show_o_previous_status == 'Employed') {
        $("input[name$='o_previous_employer']").attr('required');
        $("input[name$='o_previous_job_title']").attr('required');
        $("input[name$='o_previous_monthly_salary']").attr('required');
        $("input[name$='o_previous_manager_name']").attr('required');
        $("input[name$='o_previous_manager_phone_no']").attr('required');
        $("input[name$='o_previous_start_date']").attr('required');

        $("input[name$='o_previous_monthly_income_source']").removeAttr('required');
        $("input[name$='o_previous_monthly_income']").removeAttr('required');

        $("#o_previous_employed").show();
        $("#o_previous_other").hide();
    }
    else {
        $("input[name$='o_previous_employer']").removeAttr('required');
        $("input[name$='o_previous_job_title']").removeAttr('required');
        $("input[name$='o_previous_monthly_salary']").removeAttr('required');
        $("input[name$='o_previous_manager_name']").removeAttr('required');
        $("input[name$='o_previous_manager_phone_no']").removeAttr('required');
        $("input[name$='o_previous_start_date']").removeAttr('required');

        $("input[name$='o_previous_monthly_income_source']").attr('required');
        $("input[name$='o_previous_monthly_income']").attr('required');

        $("#o_previous_employed").hide();
        $("#o_previous_other").show();
    }

    if (show_o_previous_status == 'None') {
        $("input[name$='o_previous_employer']").removeAttr('required');
        $("input[name$='o_previous_job_title']").removeAttr('required');
        $("input[name$='o_previous_monthly_salary']").removeAttr('required');
        $("input[name$='o_previous_manager_name']").removeAttr('required');
        $("input[name$='o_previous_manager_phone_no']").removeAttr('required');
        $("input[name$='o_previous_start_date']").removeAttr('required');

        $("input[name$='o_previous_monthly_income_source']").removeAttr('required');
        $("input[name$='o_previous_monthly_income']").removeAttr('required');

        $("#o_previous_employed").hide();
        $("#o_previous_other").hide();
    }

});

/* Additional Information */
$("input[name$='ai_pets']").click(function () {
    var show_ai_pets_status = $(this).val();
    if (show_ai_pets_status == 'Yes') {
        $("#ask_pets_details").show();
    }
    else {
        $("#ask_pets_details").hide();
    }
});

$("input[name$='ai_furniture']").click(function () {
    var show_ai_furniture_status = $(this).val();
    if (show_ai_furniture_status == 'Yes') {
        $("#ask_furniture_details").show();
    }
    else {
        $("#ask_furniture_details").hide();
    }
});

$("input[name$='ai_bedbugs']").click(function () {
    var show_ai_bedbugs_status = $(this).val();
    if (show_ai_bedbugs_status == 'Yes') {
        $("#ask_bedbugs_details").show();
    }
    else {
        $("#ask_bedbugs_details").hide();
    }
});

$("input[name$='ai_evicted']").click(function () {
    var show_ai_evicted_status = $(this).val();
    if (show_ai_evicted_status == 'Yes') {
        $("#ask_evicted_details").show();
    }
    else {
        $("#ask_evicted_details").hide();
    }
});

$("input[name$='ai_bankruptcy']").click(function () {
    var show_ai_bankruptcy_status = $(this).val();
    if (show_ai_bankruptcy_status == 'Yes') {
        $("#ask_bankruptcy_details").show();
    }
    else {
        $("#ask_bankruptcy_details").hide();
    }
});

$("input[name$='ai_illegal_drugs']").click(function () {
    var show_ai_illegal_drugs_status = $(this).val();
    if (show_ai_illegal_drugs_status == 'Yes') {
        $("#ask_illegal_drugs_details").show();
    }
    else {
        $("#ask_illegal_drugs_details").hide();
    }
});


/* Financial */
$('#f_dont_have_account').change(function() {
    if ($(this).is(':checked')) {
        setTimeout(function(){$('#ask_for_bank').hide();}, 200);
       /* $('#banks').empty();*/
    } else {
        setTimeout(function(){$('#ask_for_bank').show();}, 200);
    }
});


banksDiv = $('#banks');
if (typeof banksCount == 'undefined') {
    banksCount = 0;
}

$('#add_bank').click(function () {
    if (banksCount == '5') {
        $('#add_bank').attr('disabled', true);
        return false;
    }
    else {
        $('#add_bank').removeAttr('disabled');
    }

    banksCount++;
    $('input#f_bank_count').val(banksCount);
    if (banksCount == '5') {
        $('#add_bank').attr('disabled', true);
    }

    if (banksCount == 1) {
        banksDiv.append('<div id="bank_' + banksCount + '"><h4>Bank Document #' + banksCount + '</h4>' +
            '<div class="row">' +
            '<div class="form-group col-md-12">' +
            '<label class="control-label" for="">Bank Document</label>' +
            '<input type="file" class="form-control custom-host-input" name="f_bank_document_' + banksCount + '" placeholder="" required>' +
            '</div>' +
            '</div>');
    }
    else {
        banksDiv.append('<div id="bank_' + banksCount + '"><h4>Bank Document #' + banksCount + '<a class="btn btn-danger btn-sm remove_banks"><span title="Delete" class="glyphicon glyphicon-trash"></span></a></h4>' +
            '<div class="row">' +
            '<div class="form-group col-md-12">' +
            '<label class="control-label" for="">Bank Document</label>' +
            '<input type="file" class="form-control custom-host-input" name="f_bank_document_' + banksCount + '" placeholder="" required>' +
            '</div>' +
            '</div>');
    }

    return false;

});

//Remove button
$(document).on('click', '.remove_banks', function () {
    $('div#bank_' + banksCount).remove();
    setInterval(function () {
        $('#save_button').click();
    }, 1000);

    if (banksCount >= '5') {
        $('#add_bank').removeAttr('disabled');
    }
    banksCount--;
    $('input#f_bank_count').val(banksCount);
    return false;
});

/* Misc. */

loansDiv = $('#loans');
if (typeof loansCount == 'undefined') {
    loansCount = 0;
}

$('#add_loan').click(function () {
    if (loansCount == '5') {
        $('#add_loan').attr('disabled', true);
        return false;
    }
    else {
        $('#add_loan').removeAttr('disabled');
    }

    loansCount++;
    $('input#f_loans_count').val(loansCount);
    if (loansCount == '5') {
        $('#add_loan').attr('disabled', true);
    }

    if (loansCount == 1) {
        loansDiv.append('<div id="loan_' + loansCount + '"><h4>Crédit #' + loansCount + '</h4>' +
            '<div class="row">' +
            '<div class="form-group col-md-3">' +
            '<label class="control-label" for="">Etablissement de crédit</label>' +
            '<input type="text" class="form-control custom-host-input" name="m_loan_creditor_name_' + loansCount + '" placeholder="">' +
            '</div>' +
            '<div class="form-group col-md-3">' +
            '<label class="control-label" for="">Adresse de l’établissement</label>' +
            '<input type="text" class="form-control custom-host-input" name="m_loan_creditor_address_' + loansCount + '" placeholder="123 Main St Suite 400">' +
            '</div>' +
            '<div class="form-group col-md-3">' +
            '<label class="control-label" for="">Téléphone</label>' +
            '<input type="email" class="form-control custom-host-input" name="m_loan_phone_no_' + loansCount + '" placeholder="987654321" maxlength="10">' +
            '</div>' +
            '<div class="form-group col-md-3">' +
            '<label class="control-label" for="">Paiement mensuel</label>' +
            '<input type="number" class="form-control custom-host-input" name="m_loan_monthly_payment_' + loansCount + '" placeholder="$">' +
            '</div>' +
            '</div>');
    }
    else {
        loansDiv.append('<div id="loan_' + loansCount + '"><h4>Crédit #' + loansCount + '<a class="btn btn-danger btn-sm remove_loans"><span title="Delete" class="glyphicon glyphicon-trash"></span></a></h4>' +
            '<div class="row">' +
            '<div class="form-group col-md-3">' +
            '<label class="control-label" for="">Etablissement de crédit</label>' +
            '<input type="text" class="form-control custom-host-input" name="m_loan_creditor_name_' + loansCount + '" placeholder="Bank">' +
            '</div>' +
            '<div class="form-group col-md-3">' +
            '<label class="control-label" for="">Adresse de l’établissement</label>' +
            '<input type="text" class="form-control custom-host-input" name="m_loan_creditor_address_' + loansCount + '" placeholder="123 Main St Suite 400">' +
            '</div>' +
            '<div class="form-group col-md-3">' +
            '<label class="control-label" for="">Téléphone</label>' +
            '<input type="email" class="form-control custom-host-input" name="m_loan_phone_no_' + loansCount + '" placeholder="987654321" maxlength="10">' +
            '</div>' +
            '<div class="form-group col-md-3">' +
            '<label class="control-label" for="">Paiement mensuel</label>' +
            '<input type="number" class="form-control custom-host-input" name="m_loan_monthly_payment_' + loansCount + '" placeholder="$">' +
            '</div>' +
            '</div>');
    }

    return false;

});

//Remove button
$(document).on('click', '.remove_loans', function () {
    $('div#loan_' + loansCount).remove();
    setInterval(function () {
        $('#save_button').click();
    }, 1000);
    if (loansCount >= '5') {
        $('#add_loan').removeAttr('disabled');
    }
    loansCount--;
    $('input#f_loans_count').val(loansCount);
    return false;
});


vehiclesDiv = $('#vehicles');
if (typeof vehiclesCount == 'undefined') {
    vehiclesCount = 0;
}

$('#add_vehicle').click(function () {
    if (vehiclesCount == '5') {
        $('#add_vehicle').attr('disabled', true);
        return false;
    }
    else {
        $('#add_vehicle').removeAttr('disabled');
    }
    vehiclesCount++;
    $('input#f_vehicles_count').val(vehiclesCount);
    if (vehiclesCount == '5') {
        $('#add_vehicle').attr('disabled', true);
    }

    if (vehiclesCount == 1) {
        vehiclesDiv.append('<div id="vehicle_' + vehiclesCount + '"><h4>Vehicle #' + vehiclesCount + '</h4>' +
            '<div class="row">' +
            '<div class="form-group col-md-3">' +
            '<label class="control-label" for="">Make</label>' +
            '<input type="text" class="form-control custom-host-input" name="m_vehicle_make_' + vehiclesCount + '" placeholder="Make">' +
            '</div>' +
            '<div class="form-group col-md-2">' +
            '<label class="control-label" for="">Model</label>' +
            '<input type="text" class="form-control custom-host-input" name="m_vehicle_model_' + vehiclesCount + '" placeholder="Model">' +
            '</div>' +
            '<div class="form-group col-md-2">' +
            '<label class="control-label" for="">Year</label>' +
            '<input type="email" class="form-control custom-host-input" name="m_vehicle_year_' + vehiclesCount + '" placeholder="YYYY">' +
            '</div>' +
            '<div class="form-group col-md-2">' +
            '<label class="control-label" for="">Color</label>' +
            '<input type="text" class="form-control custom-host-input" name="m_vehicle_color_' + vehiclesCount + '" placeholder="Color">' +
            '</div>' +
            '<div class="form-group col-md-3">' +
            '<label class="control-label" for="">Number Plate</label>' +
            '<input type="text" class="form-control custom-host-input" name="m_vehicle_license_plate_' + vehiclesCount + '" placeholder="Number plate">' +
            '</div>' +
            '</div>');
    }
    else {
        vehiclesDiv.append('<div id="vehicle_' + vehiclesCount + '"><h4>Vehicle #' + vehiclesCount + '<a class="btn btn-danger btn-sm remove_vehicles"><span title="Delete" class="glyphicon glyphicon-trash"></span></a></h4>' +
            '<div class="row">' +
            '<div class="form-group col-md-3">' +
            '<label class="control-label" for="">Make</label>' +
            '<input type="text" class="form-control custom-host-input" name="m_vehicle_make_' + vehiclesCount + '" placeholder="Make">' +
            '</div>' +
            '<div class="form-group col-md-2">' +
            '<label class="control-label" for="">Model</label>' +
            '<input type="text" class="form-control custom-host-input" name="m_vehicle_model_' + vehiclesCount + '" placeholder="Model">' +
            '</div>' +
            '<div class="form-group col-md-2">' +
            '<label class="control-label" for="">Year</label>' +
            '<input type="email" class="form-control custom-host-input" name="m_vehicle_year_' + vehiclesCount + '" placeholder="YYYY">' +
            '</div>' +
            '<div class="form-group col-md-2">' +
            '<label class="control-label" for="">Color</label>' +
            '<input type="text" class="form-control custom-host-input" name="m_vehicle_color_' + vehiclesCount + '" placeholder="Silver">' +
            '</div>' +
            '<div class="form-group col-md-3">' +
            '<label class="control-label" for="">Number Plate</label>' +
            '<input type="text" class="form-control custom-host-input" name="m_vehicle_license_plate_' + vehiclesCount + '" placeholder="3CZV657">' +
            '</div>' +
            '</div>');
    }
    return false;

});

//Remove button
$(document).on('click', '.remove_vehicles', function () {
    $('div#vehicle_' + vehiclesCount).remove();
    setInterval(function () {
        $('#save_button').click();
    }, 1000);
    if (vehiclesCount >= '5') {
        $('#add_vehicle').removeAttr('disabled');
    }
    vehiclesCount--;
    $('input#f_vehicles_count').val(vehiclesCount);
    return false;
});


$('#next-section').click(function () {
    $('ul.apply-tabs > li.active').next('li').trigger('click');
});


function calculate_whole_form_wieght() {

    /*$('input').on('change', function()
    {*/
    // alert('2');
    var cntreq = 0;
    var cntvals = 0;
    $('#tab_bl input').each(function (i, val) {
        if ($(this).attr('required') == 'required') {
            cntreq++;
            if ($(this).val() != '') {
                $(this).removeClass("highlight");
                cntvals++;
            }
            else {
                $(this).addClass("highlight");
            }
        }
    });
    var count = (cntvals / cntreq) * 100;
    $('#total_count').empty();

    if (isNaN(count)) {
        // $('#total_count').html('0%');
        $('#total_count').html('');
        return false;
    }

    if (count == '100') {
        $('#total_count').hide();
        $('#total_count').html('100');
      //  $('#total_count').html('<i class="fa fa-check"></i>');
        $('#filled').html('<i class="fa fa-check"></i>');
        $('#filled').show();

        $('#whole_form_weight').html('Fini à 100%');
    }
    else {
        $('#filled').hide();
        $('#total_count').html(Math.round(count) + '%');
        $('#whole_form_weight').html('Fini à'+Math.round(count) + '%');
    }
    // $('#'+output_id).append(count+'%');

    // save_application();
    /*});*/
}

function calculate_form_wieght_onload(form_id, output_id) {
    // calculate_form_wieght(form_id, output_id);

    var cntreq = 0;
    var cntvals = 0;
    $('form#' + form_id + ' input').each(function (i, val) {


        if ($(this).attr('required') == 'required') {
            cntreq++;
            /*if( $(this).attr('type') == 'radio' )
            {
                if( $(this).attr('checked', 'checked') )
                {
                    $(this).removeClass("highlight");
                    cntvals++;
                }
                else
                {
                    $(this).addClass("highlight");
                }
            }
            else
            {*/
            if ($(this).val() != '') {
                $(this).removeClass("highlight");
                cntvals++;
            }
            else {
                $(this).addClass("highlight");
            }
            /*}*/

        }

        /*if($(this).attr('required') == 'required')
        {
            cntreq++;
            if($(this).val() != '')
            {
                $(this).removeClass("highlight");
                cntvals++;
            }
            else
            {
                $(this).addClass("highlight");
            }
        }*/
    });
    var count = (cntvals / cntreq) * 100;
    $('#' + output_id).empty();


    if (isNaN(count)) {
        // $('#'+output_id).html('0%');
        $('#' + output_id).html('');
        return false;
    }

    if (count == '100')
        $('#' + output_id).html('<i class="fa fa-check"></i>');
    else
        $('#' + output_id).html(Math.round(count) + '%');


    calculate_whole_form_wieght();
}

function calculate_form_wieght(form_id, output_id) {

    // alert('1');
    $('form#' + form_id + ' input').on('change', function () {
        // alert('2');
        var cntreq = 0;
        var cntvals = 0;
        $('form#' + form_id + ' input').each(function (i, val) {
            if ($(this).attr('required') == 'required') {
                cntreq++;
                /*if( $(this).attr('type') == 'radio' )
                {
                    if( $(this).attr('checked', 'checked') )
                    {
                        $(this).removeClass("highlight");
                        cntvals++;
                    }
                    else
                    {
                        $(this).addClass("highlight");
                    }
                }
                else
                {*/
                if ($(this).val() != '') {
                    $(this).removeClass("highlight");
                    cntvals++;
                }
                else {
                    $(this).addClass("highlight");
                }
                /*}*/

            }
        });
        var count = (cntvals / cntreq) * 100;
        console.log(cntvals + '>>' +cntreq);
        console.log(count);
        $('#' + output_id).empty();

        if (isNaN(count)) {
            // $('#'+output_id).html('0%');
            $('#' + output_id).html('');
            return false;
        }

        if (count == '100')
            $('#' + output_id).html('<i class="fa fa-check"></i>');
        else
            $('#' + output_id).html(Math.round(count) + '%');
        // $('#'+output_id).append(count+'%');

        calculate_whole_form_wieght();
    });
}

calculate_form_wieght('about_me', 'about_me_weight');
calculate_form_wieght('residences', 'residences_weight');
calculate_form_wieght('occupation', 'occupation_weight');
calculate_form_wieght('references', 'references_weight');
calculate_form_wieght('additional', 'additional_weight');
calculate_form_wieght('financial', 'financial_weight');
//calculate_form_wieght('misc', 'misc_weight');

calculate_form_wieght_onload('about_me', 'about_me_weight');
calculate_form_wieght_onload('residences', 'residences_weight');
calculate_form_wieght_onload('occupation', 'occupation_weight');
calculate_form_wieght_onload('references', 'references_weight');
calculate_form_wieght_onload('additional', 'additional_weight');
calculate_form_wieght_onload('financial', 'financial_weight');
//calculate_form_wieght_onload('misc', 'misc_weight');

calculate_whole_form_wieght();
