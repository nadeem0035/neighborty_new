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
                    <!-- BEGIN FORGOT PASSWORD FORM -->
                    <?php
                    $attributes = array('class' => 'forget-form', 'id' => $forget_hs);
                    echo form_open('users/forget', $attributes);
                    ?>

                    <div class="login-register-title clearfix">
                        <h2 class="pull-left"><?=$this->lang->line('c_forgotten_pass');?></h2>
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

                    <p><?=$this->lang->line('c_enter_email_reset_pass');?></p>

                    <div class="form-group">
                        <div class="input-email input-icon">
                            <input class="form-control placeholder-no-fix" type="text" value="<?php echo set_value("email"); ?>" autocomplete="off" placeholder="Email" name="email"/>
                        </div>
                    </div>

                    <div class="form-actions">
                        <!--<button onclick="window.history.back()" type="button" id="back-btn" class="btn"><i class="fa fa-arrow-circle-o-left"></i> <?/*=$this->lang->line('c_back');*/?></button>-->
                        <button type="submit" class="btn btn-primary btn-block"><?=$this->lang->line('c_submit');?> <i class="fa fa-arrow-circle-o-right"></i></button>
                    </div>
                    </form>
                    <!-- END FORGOT PASSWORD FORM -->

                </div>
            </div>
        </div>
    </div>
</section>
<!--end section page body-->
<?php
put_js_footer();

?>


