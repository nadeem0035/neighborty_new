var FormWizard = function () {


    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().bootstrapWizard) {
                return;
            }



            var form = $('#submit_form');
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);
            var response = $('#listing_response', form);

            form.validate({
                doNotHideMessage: false, //this option enables to show the error/success messages on tab switch.
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                rules: {
                    //account
                    fname: {
                        minlength: 5,
                        required: true
                    },
                    lname: {
                        minlength: 5,
                        required: true
                    },
                    password: {
                        minlength: 5,
                        required: true
                    },
                    rpassword: {
                        minlength: 5,
                        required: true,
                        equalTo: "#submit_form_password"
                    },
                    //profile
                    fullname: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true
                    },
                    gender: {
                        required: true
                    },
                    address: {
                        required: true
                    },
                    city: {
                        required: true
                    },
                    country: {
                        required: true
                    },
                    //payment
                    card_name: {
                        required: true
                    },
                    card_number: {
                        minlength: 16,
                        maxlength: 16,
                        required: true
                    },
                    card_cvc: {
                        digits: true,
                        required: true,
                        minlength: 3,
                        maxlength: 4
                    },
                    card_expiry_date: {
                        required: true
                    },
                    'payment[]': {
                        required: true,
                        minlength: 1
                    }
                },
                messages: {// custom messages for radio buttons and checkboxes
                    'payment[]': {
                        required: "Please select at least one option",
                        minlength: jQuery.validator.format("Please select at least one option")
                    }
                },
                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.attr("name") == "gender") { // for uniform radio buttons, insert the after the given container
                        error.insertAfter("#form_gender_error");
                    } else if (element.attr("name") == "payment[]") { // for uniform checkboxes, insert the after the given container
                        error.insertAfter("#form_payment_error");
                    } else {
                        error.insertAfter(element); // for other inputs, just perform default behavior
                    }
                },
                invalidHandler: function (event, validator) { //display error alert on form submit   
                    success.hide();
                    error.show();
                    Metronic.scrollTo(error, -200);
                },
                highlight: function (element) { // hightlight error inputs
                    $(element)
                            .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
                },
                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                            .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },
                success: function (label) {
                    if (label.attr("for") == "gender" || label.attr("for") == "payment[]") { // for checkboxes and radio buttons, no need to show OK icon
                        label
                                .closest('.form-group').removeClass('has-error').addClass('has-success');
                        label.remove(); // remove error label here
                    } else { // display success icon for other inputs
                        label
                                .addClass('valid') // mark the current input as valid and display OK icon
                                .closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    }
                },
                submitHandler: function (form) {
                    success.show();
                    error.hide();
                    //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax
                }

            });

            var displayConfirm = function () {
                $('#tab4 .form-control-static', form).each(function () {
                    var input = $('[name="' + $(this).attr("data-display") + '"]', form);
                    if (input.is(":radio")) {
                        input = $('[name="' + $(this).attr("data-display") + '"]:checked', form);
                    }
                    if (input.is(":text") || input.is("textarea" || input.is(":number"))) {
                        $(this).html(input.val());
                    } else if (input.is("select")) {
                        $(this).html(input.find('option:selected').text());
                    } else if (input.is(":radio") && input.is(":checked")) {
                        $(this).html(input.attr("data-title"));
                    } else if ($(this).attr("data-display") == 'payment[]') {
                        var payment = [];
                        $('[name="payment[]"]:checked', form).each(function () {
                            payment.push($(this).attr('data-title'));
                        });
                        $(this).html(payment.join("<br>"));
                    }
                });
            }

            var handleTitle = function (tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                // set wizard title
                $('.step-title', $('#form_wizard_1')).text('Step ' + (index + 1) + ' of ' + total);
                // set done steps
                jQuery('li', $('#form_wizard_1')).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }

                if (current == 1) {
                    $('#form_wizard_1').find('.button-previous').hide();
                } else {
                    $('#form_wizard_1').find('.button-previous').show();
                }

                if (current >= total) {
                    $('#form_wizard_1').find('.button-next').hide();
                    $('#form_wizard_1').find('.button-submit').show();
                    displayConfirm();
                } else {
                    $('#form_wizard_1').find('.button-next').show();
                    $('#form_wizard_1').find('.button-submit').hide();
                }
                Metronic.scrollTo($('.page-title'));
            }

            var resetForm = function (form) {
                form.find('input[type="text"]').val('');
                form.find('input[type="number"]').val('');
                form.find('input[type="password"]').val('');
                form.find('input[type="checkbox"]').prop('checked', false);
                form.find('select option').removeAttr("selected");
                form.find('textarea').val('');
            }
            // default form wizard
            $('#form_wizard_1').bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                onTabClick: function (tab, navigation, index, clickedIndex) {

                    /*
                     success.hide();
                     error.hide();
                     if (form.valid() == false) {
                     return false;
                     } 
                    console.log(clickedIndex);
                    */
                    
                    var lid = location.pathname.substring(location.pathname.lastIndexOf("/") + 1);
                    if (clickedIndex == 2) {
                        $('#backend').DOPBackendBookingCalendarPRO({
                            'loadURL': site_url + 'listings/view_existing_listing_calendar',
                            'saveURL': site_url + 'listings/add_listing_calendar'
                        });
                    } else if (clickedIndex == 3) {
                        $("#listing_preview").html('<a href="' + site_url + 'booking/detail/' + lid + '" target="_blank">Preview Listing</a>');
                    }
                                        
                    handleTitle(tab, navigation, clickedIndex);
                    return true;

                },
                onNext: function (tab, navigation, index) {
                    success.hide();
                    error.hide();
                    response.html('');
                    var getindex = index;
                    if (form.valid() == false) {
                        return false;
                    }
                    if (getindex == 1) {
                        var status = false;
                        var data = $('#submit_form').serialize();
                        var url = site_url + 'listings/create_new_listing/';
                        $.ajax({
                            type: "POST",
                            cache: false,
                            url: url,
                            data: data,
                            success: function (result)
                            {
                                if (result) {
                                    status = true;
                                    $("#listing_preview").html('<a href="' + site_url + 'booking/detail/' + result + '" target="_blank">Preview Listing</a>');
                                } else {
                                    $("#listing_response").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button> You have some form errors. Please check below.</div>');
                                    status = false;
                                }

                            },
                            error: function (xhr, ajaxOptions, thrownError)
                            {
                                status = false;
                            },
                            async: false
                        });
                        if (status) {

                            handleTitle(tab, navigation, getindex);
                            return true;
                        } else {
                            return false;
                        }
                    }
                    else if (getindex == 2) {

                        var status2 = false;

                        var url = site_url + 'listings/images_upload_status/';
                        $.ajax({
                            type: "POST",
                            cache: false,
                            url: url,
                            success: function (result)
                            {
                                console.log(result);
                                if (result == 1) {
                                    status2 = true;
                                } else {
                                    $("#listing_response").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button>Please upload preview and at least 4 Listing images</div>');
                                    status2 = false;
                                }

                            },
                            error: function (xhr, ajaxOptions, thrownError)
                            {
                                status2 = false;
                            },
                            async: false
                        });
                        if (status2) {
                            handleTitle(tab, navigation, getindex);
                            $('#backend').DOPBackendBookingCalendarPRO({
                                'loadURL': site_url + 'listings/view_existing_listing_calendar',
                                'saveURL': site_url + 'listings/add_listing_calendar'
                            });
                            return true;
                        } else {
                            return false;
                        }
                    }
                    else if (getindex == 3) {
                        var status = false;
                        var data = $('#submit_form').serialize();
                        var url = site_url + 'listings/update_new_listing/';
                        $.ajax({
                            type: "POST",
                            cache: false,
                            url: url,
                            data: data,
                            success: function (result)
                            {
                                if (result == 1) {
                                    status = true;
                                } else {
                                    $("#listing_response").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button>Please Select Amenities.</div>');
                                    status = false;
                                }

                            },
                            error: function (xhr, ajaxOptions, thrownError)
                            {
                                status = false;
                            },
                            async: false
                        });
                        if (status) {

                            handleTitle(tab, navigation, getindex);
                            return true;
                        } else {
                            return false;
                        }
                    }
                    else if (getindex == 4) {
                        handleTitle(tab, navigation, getindex);
                    }



                },
                onPrevious: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    handleTitle(tab, navigation, index);
                },
                onTabShow: function (tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    var $percent = (current / total) * 100;
                    $('#form_wizard_1').find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });

            $('#form_wizard_1').find('.button-previous').hide();
            $('#form_wizard_1 .button-submit').click(function () {

                var url = site_url + 'listings/finish_new_listing/';
                //var data = $('#submit_form').serialize();
                $.ajax({
                    type: "POST",
                    cache: false,
                    data: 'active=' + $('#l_active').val(),
                    url: url,
                    success: function (result)
                    {
                        if (result) {
                            $("#listing_response").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button> Listing added successfully.</div>');
                            setTimeout(function () {
                                window.location = site_url + 'listings';
                            }, 3000);
                        } else {
                            $("#listing_response").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button> You have some errors. Please try again.</div>');

                        }

                    },
                    error: function (xhr, ajaxOptions, thrownError)
                    {

                    },
                    async: false
                });
                $('#form_wizard_1').find('.button-submit').hide();
                resetForm(form);
            }).hide();


        }

    };

}();