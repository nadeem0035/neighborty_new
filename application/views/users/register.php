<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    .agent-ser {
        width: 100%;
        position: relative;
        top: 2px !important;
        color: rgb(255, 255, 255);
        left: 0;
        right: 0;
        display: inline-block;
    }
    .input-info .btn{
        padding-left:40px;
    }
</style>
<body class="login_body">
<section id="" class="houzez-module">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="logo text-center">
                    <a href="<?=site_url()?>" title=""><img src="<?=base_url()?>assets/img/logo-header2.png" alt="" width="280"></a>
                </div>
                <div class="clearfix"></div>
                <div class="login-register-block login-block">
                    <!-- BEGIN REGISTRATION FORM -->
                    <?php
                    $attributes = array('class' => 'register-form', 'id' => $signup_hs, 'name' => $signup_hs, 'novalidate');
                    echo form_open('users/register', $attributes);
                    ?>

                    <div class="login-register-title clearfix">
                        <h2 class="pull-left"><?=$this->lang->line('regstr');?></h2>
                        <a href="<?=site_url('users/login');?>" class="pull-right"><?=$this->lang->line('login');?></a>
                    </div>

                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger">
                            <button class="close" data-close="alert"></button>
                            <span><?= validation_errors() ?> </span>
                        </div>

                    <?php endif; ?>
                    <?php if (isset($error)) : ?>
                        <div class="alert alert-danger">
                            <button class="close" data-close="alert"></button>
                            <span><?= $error ?> </span>
                        </div>

                    <?php endif; ?>

                    <?php if (isset($success)) : ?>
                        <div class="alert alert-success">
                            <button class="close" data-close="alert"></button>
                            <span><?= $success; ?> </span>
                        </div>

                    <?php endif; ?>


                    <div class="form-group">
                        <div class="input-font input-icon">
                            <input class="form-control placeholder-no-fix" type="text"  value="<?php echo set_value("user[first_name]"); ?>" placeholder="<?=$this->lang->line('f_name');?>" name="user[first_name]" required title="<?=$this->lang->line('f_name_r');?>" />
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="input-font input-icon">
                            <input class="form-control placeholder-no-fix" type="text" value="<?php echo set_value("user[last_name]"); ?>" placeholder="<?=$this->lang->line('l_name');?>" name="user[last_name]" required title="<?=$this->lang->line('l_name_r');?>" />
                        </div>
                    </div>



                    <div class="form-group">
                        <div class="input-email input-icon">
                            <input class="form-control placeholder-no-fix" type="email" value="<?php echo set_value("user[email]"); ?>" placeholder="<?=$this->lang->line('u_email');?>" name="user[email]" required title="<?=$this->lang->line('u_email_r');?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-icon">
                            <input  autocomplete="off"  class="form-control phone_number placeholder-no-fix" type="tel" value="" id="phone"  name="phone" required title="<?=$this->lang->line('u_phone_r');?>" />
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="input-pass input-icon">
                            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" minlength="6" pattern=".{6,15}" required title="<?=$this->lang->line('u_password_r');?>" placeholder="<?=$this->lang->line('u_password');?>" name="user[password]"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="controls">
                            <div class="input-pass input-icon">
                                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" pattern=".{6,15}" minlength="6" required title="<?=$this->lang->line('u_password_r');?>" placeholder="<?=$this->lang->line('u_rpassword');?>" name="user[rpassword]" />
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="input-info input-icon">
                            <select name="user[agent_type]" id="agent_type" class="form-control" required title="Register As">
                                <option value="" selected="selected">Register As</option>
                                <option value="Owner / Individual">Owner / Individual </option>
                                <option value="Real Estate Agent / Dealer">Real Estate Agent / Dealer</option>
                                <option value="Real Estate Agency / Business">Real Estate Agency / Business</option>
                                <option value="Builder">Builder </option>
                                <option value="Contractor">Contractor</option>
                                <option value="Interior Designer">Interior Designer</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group" id="agency_name" style="display:none">
                        <div class="controls">
                            <div class="input-building input-icon">
                                <input class="form-control placeholder-no-fix" type="text" autocomplete="off"  title="Agency Name" placeholder="Agency Name" name="user[agency_name]" />
                            </div>
                        </div>
                    </div>


                    <div class="form-actions">
                        <div class="form-group">
                            <label class="" style="padding-top:11px;">
                                <input type="checkbox" class="option-input checkbox" name="tnc" />
                                <?=$this->lang->line('check_terms');?> <a href="<?=site_url('page/terms');?>"><?=$this->lang->line('check_terms2');?></a> <?=$this->lang->line('check_terms3');?>
                                <div id="register_tnc_error"></div>
                            </label>
                        </div>
                        <button type="submit" id="register-submit-btn" class="btn btn-primary pull-left search_submit"><?=$this->lang->line('register');?> <i class="fa fa-arrow-circle-o-right"></i></button>
                    </div>


                    <div style="display: none">
                        <div class="clearfix"></div>

                        <div class="form-group">
                            <label style="color: #00aeef"><input type="checkbox" id="show" class="pull-left" style="margin-right:10px;display: inline-block" name="check_landlord"/>
                                <?=$this->lang->line('check_active');?>
                            </label>
                        </div>

                        <div class="form-actions">
                            <div class="form-group">
                                <label class="" style="padding-top:11px;">
                                    <input type="checkbox" name="tnc" style="display: inline-block"/>
                                    <?=$this->lang->line('check_terms');?> <a href="<?=site_url('page/terms');?>"><?=$this->lang->line('check_terms2');?></a> <?=$this->lang->line('check_terms3');?>
                                    <div id="register_tnc_error"></div>
                                </label>
                            </div>
                            <button type="submit" id="register-submit-btn" class="btn btn-primary pull-left search_submit"><?=$this->lang->line('register');?> <i class="fa fa-arrow-circle-o-right"></i></button>
                        </div>
                    </div>


                    <div class="clearfix"></div>

                    <hr>
                    <div class="social_accounts">
                        <?=$this->lang->line('u_register_with');?>
                        <a href="<?= @$fb_login_url ?>" class="btn btn-social btn-bg-facebook"><i class="fa fa-facebook"></i></a>
                        <a href="<?= @$google_login_url; ?>" class="btn btn-social btn-bg-google-plus"><i class="fa fa-google-plus"></i></a>
                        <a href="<?= @$linkedin_login_url; ?>" class="btn btn-social btn-bg-linkedin"><i class="fa fa-linkedin"></i></a>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--end section page body-->

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyAYxatVl0mCNR-6v6bUZNn4-VTCD9PqHVE" type="text/javascript"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.js"></script>
<?php
put_js_footer();
?>
<script>
    jQuery(document).ready(function() {
        jQuery('.tooltip').tooltipster();
    });
</script>
<script>

    $('.register-form input[type="text"], .register-form input[type="email"],.register-form input[type="tel"], .register-form input[type="password"],  .register-form input[type="checkbox"], .register-form select').tooltipster({
        trigger: 'custom',
        onlyOne: false,
        position: 'left',
        contentAsHTML: true,
        interactive: true,
    });



    $.validator.addMethod("customphone", function(value, element){
        return ($(element).hasClass('number-invalid') && $(element).val().length != 0) ? false : true;
    }, "wrong phone number");

    $.validator.addMethod("customnum", function(value, element){
        var firstChar = $('#phone').val().substr(0, 2);
        var firstChar2 = $('#phone').val().substr(0, 1);
        console.log(firstChar);
        if(firstChar == 03 || firstChar2 == 3 ){
            return true;
        }else {
            return false;
        }

    }, "Number is not correct");



    // initialize validate plugin on the form
    $('.register-form').validate({
        errorPlacement: function (error, element) {
            $(element).tooltipster('update', $(error).text());
            $(element).tooltipster('show');
        },
        success: function (label, element) {
            $(element).tooltipster('hide');
        },
        rules: {
            phone:{
                minlength:10,
                maxlength:11,
                required:true,
                customphone : true,
                customnum : true
            },

            first_name: {
                required: true
            },
            email: {
                required: true,
                email: true
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

            username: {
                required: true
            },
            password: {
                required: true,
                minlength: 8,
                maxlength: 15

            },
            rpassword: {
                equalTo: "#password",
                minlength: 6,
                maxlength: 10
            },
            agent_type: {
                required: true
            },
            tnc: {
                required: true
            }
        },


        messages: {
            first_name: {
                required: "First name is required."
            },
            email: {
                required: "Email Address already exist."
            },
            address: {
                required: "Address is required."
            },
            city: {
                required: "City is required."
            },
            country: {
                required: "Country is required."
            },
            username: {
                required: "User name is required."
            },
            password: {
                required: "Password is required."
            },

            tnc: {
                required: "Please accept TNC first."
            }
        },

        submitHandler: function (form) { // for demo
            form.submit();

        }
    });

</script>
<script>
    function is_location_valid(address)
    {
        var geocoder = new google.maps.Geocoder();

        geocoder.geocode( {"address": address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK)
            {
                $(".search_submit").attr("disabled", false);
                $('#notice').html('');
            }
            else
            {
                $('#notice').attr('style','color:#a94442');
                $('#notice').html('Please enter valid location');
                $(".search_submit").attr("disabled", true);
            }
        });
    }
</script>
<script>
    jQuery(document).ready(function(){

        jQuery('#agent_type').change(function(){

            if( $('#agent_type').val() == 'Real Estate Agency / Business')
                $('#agency_name').show();
            else
                $('#agency_name').hide();
        });



        jQuery("#show").click(function() {
            if(jQuery(this).is(":checked")) {

                jQuery(".formHide").show();
                $('#usertype').val('Agent');
            } else {
                $("#agent_type").val("");
                $("#location").val("");
                $("#phone_no").val("");
                $('#usertype').val('Renter');
                jQuery(".formHide").hide();
            }
        });

        $(".phone_number").on("keypress keyup blur",function (event) {
            $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });

        //loadPlacesMap();
    });
    var site_url = "<?php echo base_url(); ?>";

</script>