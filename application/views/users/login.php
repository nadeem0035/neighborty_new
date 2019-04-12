<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    .agent-ser {
        width: 100%;
        position: relative;
        top: 2px !important;
        color: rgb(255, 255, 255);
        left: 0px;
        right: 0px;
        display: inline-block;
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

                    <!-- BEGIN LOGIN FORM -->
                    <?php
                    $attributes = array('class' => 'login-form', 'id' => $login_hs);
                    echo form_open('users/login', $attributes);
                    ?>

                    <div class="login-register-title clearfix">
                        <h2 class="pull-left"><?=$this->lang->line('login');?></h2>
                        <a href="<?=site_url('users/register');?>" class="pull-right">Registration</a>
                    </div>

                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger">
                            <button class="close" data-close="alert"></button>
                            <span><?= validation_errors() ?></span>
                        </div>

                    <?php endif; ?>
                    <?php if (isset($error)) : ?>
                        <div class="alert alert-danger">
                            <button class="close" data-close="alert"></button>
                            <span><?= $error ?></span>
                        </div>

                    <?php endif; ?>

                    <?php if (isset($success)) : ?>
                        <div class="alert alert-success">
                            <button class="close" data-close="alert"></button>
                            <span><?= $success; ?></span>
                        </div>

                    <?php endif; ?>

                    <?php if ($this->session->userdata('register_success') != '') : ?>
                        <div class="alert alert-success">
                            <button class="close" data-close="alert"></button>
                            <span><?=$this->session->userdata('register_success'); ?> </span>
                        </div>

                    <?php endif; ?>



                    <div class="alert alert-danger display-hide" style="display: none">
                        <button class="close" data-close="alert"></button>
                        <span><?=$this->lang->line('incorrect');?></span>
                    </div>

                    <div class="form-group">
                        <div class="input-email input-icon">
                            <input class="form-control placeholder-no-fix" type="email" autocomplete="off" placeholder="E-mail" name="email"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-pass input-icon">
                            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="<?=$this->lang->line('password');?>" name="password"/>
                        </div>
                    </div>

                    <div class="forget-block clearfix">
                        <div class="form-group pull-left">
                            <div class="checkbox">
                                <label><input type="checkbox" name="remember" value="1"/> <?=$this->lang->line('remember_me');?> </label>
                            </div>
                        </div>
                        <div class="form-group pull-right">
                            <a href="<?=site_url('users/forget');?>" id="forget-password"> <?=$this->lang->line('forgottext');?> </a>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary btn-block"> <?=$this->lang->line('login');?> </button>
                    </div>

                    <hr>
                    <div class="social_accounts">
                        <?=$this->lang->line('login_social');?>
                        <a href="<?= @$fb_login_url ?>" class="btn btn-social btn-bg-facebook"><i class="fa fa-facebook"></i></a>
                        <a href="<?= @$google_login_url; ?>" class="btn btn-social btn-bg-google-plus"><i class="fa fa-google-plus"></i></a>

                        <a href="<?= @$linkedin_login_url; ?>" class="btn btn-social btn-bg-linkedin"><i class="fa fa-linkedin"></i></a>

                    </div>
                    </form>
                    <!-- END LOGIN FORM -->

                </div>
            </div>
        </div>
    </div>
</section>
<!--end section page body-->

<?php
put_js_footer();

?>

<?php

echo "<script>
$(document).ready(function()
{";
put_extra_js();
echo "
});
</script>
";

?>


<script>
    jQuery(document).ready(function() {
        jQuery('.tooltip').tooltipster();
    });
</script>


<script>
    $('.login-form input[type="email"], .login-form input[type="password"]').tooltipster({
        trigger: 'custom',
        onlyOne: false,
        position: 'left',
        contentAsHTML: true,
        interactive: true,
    });

    $('.login-form').validate({
        errorPlacement: function (error, element) {
            if($(error).text() !== ''){
                $(element).tooltipster('update', $(error).text());
                $(element).tooltipster('show');
            }else {
                $(element).tooltipster('hide');
            }

        },
        success: function (label, element) {
            $(element).tooltipster('hide');
        },

        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true
            }

        },

        messages: {
            email: {
                required: "Email is required."
            },
            password: {
                required: "Password is required."
            }
        },

        submitHandler: function (form) {
            form.submit();
        }
    });


</script>




