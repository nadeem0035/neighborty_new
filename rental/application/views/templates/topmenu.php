<div class="modal fade" id="pop-login" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Login</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
      </div>
      <div class="modal-body login-block">
        <form action="<?=site_url('users/login');?>" method="post">
         <div class="form-group">
           <div class="input-icon">
             <i class="fa fa-user"></i>
             <input class="form-control placeholder-no-fix" type="email" autocomplete="off" placeholder="E-mail" name="email" required="" />
           </div>
         </div>
         <div class="form-group">
           <div class="input-icon">
             <i class="fa fa-lock"></i>
             <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Enter Your Password" name="password" required="" />
           </div>
         </div>
         <div class="forget-block clearfix">
           <div class="form-group pull-left">
             <div class="checkbox">
               <label><input type="checkbox" name="remember" value="1"/> Remember Me </label>
             </div>
           </div>
           <div class="form-group pull-right">
             <a href="<?=site_url('users/forget');?>" id="forget-password"> Forgot My Password</a>
           </div>
         </div>
         <div class="form-actions">
           <button type="submit" class="btn blue btn-block"> Login <i class="m-icon-swapright m-icon-white"></i></button>
         </div>
         <div class="clearfix"></div>
         <hr>
         <div class="social_accounts">
           Login via
           <a href="<?= @$fb_login_url ?>" class="btn btn-social btn-bg-facebook"><i class="fa fa-facebook"></i></a>
           <a href="<?= @$google_login_url; ?>" class="btn btn-social btn-bg-google-plus"><i class="fa fa-google-plus"></i></a>
           <a href="<?= @$linkedin_login_url; ?>" class="btn btn-social btn-bg-linkedin"><i class="fa fa-linkedin"></i></a>
         </div>
       </form>
     </div>
   </div>
 </div>
</div>
<div class="modal fade" id="pop-signup" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Register <small>(<a href="#">Login</a>)</small></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
      </div>
      <div class="modal-body login-block">
       <form>
         <div class="form-group signup-left-field">
           <div class="input-icon">
             <i class="fa fa-font"></i>
             <input class="form-control placeholder-no-fix" type="text"  value="" placeholder="First Name" name="user[first_name]"/>
           </div>
         </div>
         <div class="form-group signup-left-field">
           <div class="input-icon">
             <i class="fa fa-font"></i>
             <input class="form-control placeholder-no-fix" type="text" value="" placeholder="Last Name" name="user[last_name]"/>
           </div>
         </div>
         <div class="form-group">
           <div class="input-icon">
             <i class="fa fa-envelope"></i>
             <input class="form-control placeholder-no-fix" type="text" value="" placeholder="Email" name="user[email]"/>
           </div>
         </div>
         <div class="form-group signup-left-field">
           <div class="input-icon">
             <i class="fa fa-lock"></i>
             <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" minlength="8" pattern=".{8,15}" required title="8 to 15 characters" placeholder="Password" name="user[password]"/>
           </div>
         </div>
         <div class="form-group signup-left-field">
           <div class="controls">
             <div class="input-icon">
               <i class="fa fa-check"></i>
               <input class="form-control placeholder-no-fix" type="password" autocomplete="off" pattern=".{8,15}" minlength="8" required title="8 to 15 characters" placeholder="Re-type Your Password" name="user[rpassword]" />
             </div>
           </div>
         </div>
         <div class="form-group">
           <div class="input-icon">
             <i class="fa fa-info"></i>
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
         <div class="form-actions">
           <div class="form-group">
             <label class="" style="padding-top:11px;">
               <input type="checkbox" class="option-input checkbox" name="tnc" />
               I agree with the <a href="<?=site_url('page/terms');?>">Terms and Conditions</a> of zoney.
               <div id="register_tnc_error"></div>
             </label>
           </div>
           <button type="submit" id="register-submit-btn" class="btn btn-primary btn-block search_submit">Register <i class="fa fa-arrow-circle-o-right"></i></button>
         </div>
         <div class="clearfix"></div>
         <hr>
         <div class="social_accounts">
           Login via
           <a href="<?= @$fb_login_url ?>" class="btn btn-social btn-bg-facebook"><i class="fa fa-facebook"></i></a>
           <a href="<?= @$google_login_url; ?>" class="btn btn-social btn-bg-google-plus"><i class="fa fa-google-plus"></i></a>
           <a href="<?= @$linkedin_login_url; ?>" class="btn btn-social btn-bg-linkedin"><i class="fa fa-linkedin"></i></a>
         </div>
       </form>
     </div>
   </div>
 </div>
</div>
<header id="header" class="header" style="background-color: transparent;">
  <div class="container">
    <div class="logo float-left">
      <a href="<?=site_url()?>" title=""><img src="<?=base_url()?>assets/img/logo-header.png" alt="">
      </a>
    </div>
    <div class="mob-top-right" style="float:right; margin-top:3%">
      <a class="top-hover" data-toggle="modal" data-target="#pop-signup">Sign Up </a> &nbsp;<span class="topMenuSep">/</span>&nbsp;
      <a class="top-hover"  href="<?= site_url("users/login_status/")?>">Login</a> &nbsp;<span class="topMenuSep">/</span>&nbsp;
      <a class="top-hover" href="<?=site_url("listings/add-listing")?>" >List Your Space</a> &nbsp;
    </div>
    <nav class="navigation nav-r nav" id="navigation" data-menu-type="4000">
      <div class="nav-inner">
        <div class="tb">
        </div>
      </div>
    </nav>
  </div>
</header>