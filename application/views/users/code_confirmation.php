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
                    <form action="#" id="verification-form" class="verification-form" method="post" accept-charset="utf-8">

                    <div class="login-register-title clearfix">
                        <h2 class="pull-left"><?=$this->lang->line('verification');?></h2>
                    </div>
                    <div class="notice"></div>
                        <p>Verification Code sent at your email address</p>
                    <?php if (validation_errors()) : ?>
                        <div class="alert alert-danger">
                            <button class="close" data-close="alert"></button>
                            <span><?= validation_errors() ?></span>
                        </div>

                    <?php endif; ?>

                    <?php if ($this->session->userdata('success') != '') : ?>
                        <div class="alert alert-success">
                            <button class="close" data-close="alert"></button>
                            <span><?=$this->session->userdata('register_success'); ?> </span>
                        </div>

                    <?php endif; ?>

                    <?php if ($this->session->userdata('error') != '') : ?>
                       <div class="alert alert-success">
                           <button class="close" data-close="alert"></button>
                           <span><?=$this->session->userdata('error'); ?> </span>
                       </div>

                    <?php endif; ?>


                    <div class="form-group">
                        <div class="input-num input-icon">
                            <input id="code" class="form-control placeholder-no-fix" type="number" max="4" min="4" autocomplete="off" placeholder="<?=$this->lang->line('code');?>" name="code"/>
                        </div>
                    </div>


                    <div class="form-actions">
                        <div class="row">

                            <div class="col-md-12">
                                <div id="not_validated" class="alert alert-danger" style="display: none"></div>
                            </div>

                            <div class="clearfix"></div>

                            <div class="col-xs-6 col-md-6 padding-right-5">
                                <button class="btn btn-primary btn-block verify">Verify</button>
                            </div>

                            <div class="col-xs-6 col-md-6 padding-left-5">
                                <button class="btn btn-secondary btn-block resend-code">Resend code</button>
                            </div>

                        </div>

                    </div>



                    </form>


                </div>
            </div>
        </div>
    </div>
</section>


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
    var site_url = "<?php echo base_url(); ?>";
</script>


<script>
    $('.verification-form input[type="text"]').tooltipster({
        trigger: 'custom',
        onlyOne: false,
        position: 'left',
        contentAsHTML: true,
        interactive: true,
    });

    $('.verification-form').validate({
        errorPlacement: function (error, element) {
            $(element).tooltipster('update', $(error).text());
            $(element).tooltipster('show');
        },
        success: function (label, element) {
            $(element).tooltipster('hide');
        },

        rules: {
            code: {
                required: true,
            },
        },

        messages: {
            code: {
                required: "Verification code is required."
            }
        },

        submitHandler: function (form) {
            varify();
        }
    });


    $(".resend-code").on("click",function(){

        reSendCode();

    });




</script>




