<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>#footer_section { display:none; }</style>
<body class="login">
    <!-- BEGIN LOGO -->
    <div class="logo">
        <a href="<?= site_url(); ?>">
            <img src="<?= base_url(); ?>assets/img/logo-big.png" alt=""/>
        </a>
    </div>
    <!-- END LOGO -->
    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
    <div class="menu-toggler sidebar-toggler">
    </div>
    <!-- END SIDEBAR TOGGLER BUTTON -->
    <!-- BEGIN LOGIN -->
    <div class="content">
        <!-- BEGIN LOGIN FORM -->
        <?php
        $attributes = array('class' => 'login-form', 'id' => $login_hs);
        echo form_open('users/login', $attributes);
        ?>
        <h3 class="form-title">Login to your account</h3>

        <?php if (validation_errors()) : ?>
            <div class="alert alert-danger">
                <button class="close" data-close="alert"></button>
                <span>
                    <?= validation_errors() ?> </span>
            </div>

        <?php endif; ?>
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger">
                <button class="close" data-close="alert"></button>
                <span>
                    <?= $error ?> </span>
            </div>

        <?php endif; ?>

        <?php if (isset($success)) : ?>
            <div class="alert alert-success">
                <button class="close" data-close="alert"></button>
                <span>
                    <?= $success; ?> </span>
            </div>

        <?php endif; ?>
        
        
        <div class="social_accounts">
        
        <a href="<?= @$fb_login_url ?>" class="btn btn-primary"><img src="<?= base_url(); ?>assets/img/fb-icon.png" /> Login with Facebook</a>
        <div class="clearfix"></div>
        <a href="<?= @$google_login_url; ?>" class="btn btn-google"><img src="<?= base_url(); ?>assets/img/gp-icon.png" /> Login with Google +</a>
        
        </div>
        
         <div class="text-divider"><span>or</span></div>

        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span>
                Enter E-mail and password. </span>
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">E-mail</label>
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="E-mail" name="email"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
            </div>
        </div>
        <div class="form-actions">
            <label class="checkbox">
                <input type="checkbox" name="remember" value="1"/> Remember me </label>
            <button type="submit" class="btn blue pull-right">
                Login <i class="m-icon-swapright m-icon-white"></i>
            </button>
        </div>

        <div class="forget-password">
            <h4>Forgot your password ?</h4>
            <p>
                no worries, click <a href="<?=site_url('users/forget');?>" id="forget-password">
                    here </a>
                to reset your password.
            </p>
        </div>
        <div class="create-account">
            <p>
                Don't have an account yet ?&nbsp; <a href="<?=site_url('users/register');?>" id="register-btn">
                    Create an account </a>
            </p>
        </div>
    </form>
    <!-- END LOGIN FORM -->
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <?php
    $attributes = array('class' => 'forget-form', 'id' => $forget_hs);
    echo form_open('users/forget', $attributes);
    ?>
    <h3>Forget Password ?</h3>
    <?php if (validation_errors()) : ?>
        <div class="alert alert-danger">
            <button class="close" data-close="alert"></button>
            <span>
                <?= validation_errors() ?> </span>
        </div>

    <?php endif; ?>
    <?php if (isset($error)) : ?>
        <div class="alert alert-danger">
            <button class="close" data-close="alert"></button>
            <span>
                <?= $error ?> </span>
        </div>

    <?php endif; ?>

    <?php if (isset($success)) : ?>
        <div class="alert alert-success">
            <button class="close" data-close="alert"></button>
            <span>
                <?= $success; ?> </span>
        </div>

    <?php endif; ?>
    <p>
        Enter your e-mail address below to reset your password.
    </p>
    <div class="form-group">
        <div class="input-icon">
            <i class="fa fa-envelope"></i>
            <input class="form-control placeholder-no-fix" type="text" value="<?php echo set_value("email"); ?>" autocomplete="off" placeholder="Email" name="email"/>
        </div>
    </div>
    <div class="form-actions">
        <button onclick="window.history.back()" type="button" id="back-btn" class="btn">
            <i class="m-icon-swapleft"></i> Back </button>
        <button type="submit" class="btn blue pull-right">
            Submit <i class="m-icon-swapright m-icon-white"></i>
        </button>
    </div>
</form>
<!-- END FORGOT PASSWORD FORM -->
<!-- BEGIN REGISTRATION FORM -->

<?php
$attributes = array('class' => 'register-form', 'id' => $signup_hs);
echo form_open('users/register', $attributes);
?>
<h3>Sign Up</h3>
<?php if (validation_errors()) : ?>
    <div class="alert alert-danger">
        <button class="close" data-close="alert"></button>
        <span>
            <?= validation_errors() ?> </span>
    </div>

<?php endif; ?>
<?php if (isset($error)) : ?>
    <div class="alert alert-danger">
        <button class="close" data-close="alert"></button>
        <span>
            <?= $error ?> </span>
    </div>

<?php endif; ?>

<?php if (isset($success)) : ?>
    <div class="alert alert-success">
        <button class="close" data-close="alert"></button>
        <span>
            <?= $success; ?> </span>
    </div>

<?php endif; ?>

		<div class="social_accounts">
        
        <a href="<?= @$fb_login_url ?>" class="btn btn-primary"><img src="<?= base_url(); ?>assets/img/fb-icon.png" /> Signup with Facebook</a>
        <div class="clearfix"></div>
        
        <a href="<?= @$google_login_url; ?>" class="btn btn-google"><img src="<?= base_url(); ?>assets/img/gp-icon.png" /> Signup with Google +</a>
        
        </div>
        
        <div class="text-divider"><span>or</span></div>

<div class="form-group signup-left-field">
    <label class="control-label visible-ie8 visible-ie9">First Name</label>
    <div class="input-icon">
        <i class="fa fa-font"></i>
        <input class="form-control placeholder-no-fix" type="text"  value="<?php echo set_value("user[first_name]"); ?>" placeholder="First Name" name="user[first_name]"/>
    </div>
</div>

<div class="form-group signup-right-field">
    <label class="control-label visible-ie8 visible-ie9">Last Name</label>
    <div class="input-icon">
        <i class="fa fa-font"></i>
        <input class="form-control placeholder-no-fix" type="text" value="<?php echo set_value("user[last_name]"); ?>" placeholder="Last Name" name="user[last_name]"/>
    </div>
</div>

<div class="clearfix"></div>

<div class="form-group">
    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
    <label class="control-label visible-ie8 visible-ie9">Email</label>
    <div class="input-icon">
        <i class="fa fa-envelope"></i>
        <input class="form-control placeholder-no-fix" type="text" value="<?php echo set_value("user[email]"); ?>" placeholder="Email" name="user[email]"/>
    </div>
</div>


<div class="form-group signup-left-field">
    <label class="control-label visible-ie8 visible-ie9">Password</label>
    <div class="input-icon">
        <i class="fa fa-lock"></i>
        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" minlength="8" pattern=".{8,15}" required title="8 to 15 characters" placeholder="Password" name="user[password]"/>
    </div>
</div>

<div class="form-group signup-right-field">
    <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
    <div class="controls">
        <div class="input-icon">
            <i class="fa fa-check"></i>
            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" pattern=".{8,15}" minlength="8" required title="8 to 15 characters" placeholder="Re-type Your Password" name="user[rpassword]" />
        </div>
    </div>
</div>

<div class="clearfix"></div>

<div class="form-group">
    <label>
        <input type="checkbox" name="tnc"/> I agree to the <a href="javascript:;">
            Terms of Service </a>
        and <a href="javascript:;">
            Privacy Policy </a>
    </label>
    <div id="register_tnc_error">
    </div>
</div>
<div class="form-actions">
    <button onclick="window.history.back()" id="register-back-btn" type="button" class="btn">
        <i class="m-icon-swapleft"></i> Back </button>
    <button type="submit" id="register-submit-btn" class="btn blue pull-right">
        Sign Up <i class="m-icon-swapright m-icon-white"></i>
    </button>
</div>
</form>
<!-- END REGISTRATION FORM -->





<!-- BEGIN Reset Password FORM -->

<?php
$attributes = array('class' => 'reset-form', 'id' => $reset_hs);
$hidden = array('hash' => @$hashvalue);
echo form_open('users/update-password', $attributes, $hidden);
?>
<h3>Reset Password</h3>
<?php if (validation_errors()) : ?>
    <div class="alert alert-danger">
        <button class="close" data-close="alert"></button>
        <span>
            <?= validation_errors() ?> </span>
    </div>

<?php endif; ?>
<?php if (isset($error)) : ?>
    <div class="alert alert-danger">
        <button class="close" data-close="alert"></button>
        <span>
            <?= $error ?> </span>
    </div>

<?php endif; ?>

<?php if (isset($success)) : ?>
    <div class="alert alert-success">
        <button class="close" data-close="alert"></button>
        <span>
            <?= $success; ?> </span>
    </div>

<?php endif; ?>
<p>
    Enter your new password:
</p>


<div class="form-group">
    <label class="control-label visible-ie8 visible-ie9">Password</label>
    <div class="input-icon">
        <i class="fa fa-lock"></i>
        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" required name="password"/>
    </div>
</div>

<div class="form-group">
    <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
    <div class="controls">
        <div class="input-icon">
            <i class="fa fa-check"></i>
            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" required name="rpassword" />
        </div>
    </div>
</div>
<div class="form-actions">
    <button type="submit" id="register-submit-btn" class="btn blue pull-right">
        Reset Password <i class="m-icon-swapright m-icon-white"></i>
    </button>
</div>
</form>
<div class="clear"></div>
<!-- END Reset Password FORM FORM -->
</div>