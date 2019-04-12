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

                    <!-- BEGIN Reset Password FORM -->

                    <?php
                    $attributes = array('class' => 'reset-form', 'id' => 'Form_show');
                    $hidden = array('hash' => @$hashvalue);
                    echo form_open('users/update-password', $attributes, $hidden);
                    ?>

                    <div class="login-register-title text-center">
                        <h2><?=$this->lang->line('c_reset');?></h2>
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

                    <p><?=$this->lang->line('c_new_pass');?>:</p>

                    <div class="form-group">
                        <div class="input-pass input-icon">
                            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="password" placeholder="Password" required name="password"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="controls">
                            <div class="input-pass input-icon">
                                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Repeat password" required id="rpassword" name="rpassword" />
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" id="register-submit-btn" class="btn btn-primary btn-block"><?=$this->lang->line('c_reset');?> <i class="m-icon-swapright m-icon-white"></i></button>
                    </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</section>
<!--end section page body-->
<?php
put_js_footer();

?>
