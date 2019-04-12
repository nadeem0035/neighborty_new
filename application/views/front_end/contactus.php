<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<body>
<?php /*$this->load->view('templates/preloader'); */ ?>

<section id="splash-section" class="section index-splash" style="height:265px;">
    <div class="vegas-overlay"></div>
    <div class="splash-inner-media" style="background-image: url(<?=base_url()?>assets/img/background-img1.jpg)"></div>
    <div class="splash-inner-content">
        <?php $this->load->view('includes/menu/home') ;?>
        <div class="container text-center" style="margin-top:35px;">
            <h2 class="main_title"><?=$this->lang->line('c_contact_us');?></h2>
        </div>
    </div>
</section>

<div id="">
    <div id="wrap">

        <div class="main">

            <div class="title-wrap">



                <section id="section-body"> <!-- section Body -->
                    <div class="container">

                        <div class="hi-icon-wrap hi-icon-effect-2 hi-icon-effect-2a">
                            <ul class="no-margins contact_liks">
                                <li class="col-md-3">
                                    <a href="mailto:<?=$this->lang->line('e-mail');?>">
                                        <div class="hi-icon hi-icon-cog"><i class="fa fa-envelope-o"></i></div>
                                        <h4><?=$this->lang->line('c_email');?></h4>
                                        <p><?=$this->lang->line('e-mail');?></p>
                                    </a>
                                </li>
                                <li class="col-md-3">
                                    <a href="https://www.facebook.com/zoneypk/" target="_blank">
                                        <div class="hi-icon hi-icon-cog"><i class="fa fa-facebook"></i></div>
                                        <h4><?=$this->lang->line('c_follow');?></h4>
                                        <p>Via Facebook</p>
                                    </a>
                                </li>
                                <li class="col-md-3">
                                    <a href="<?=site_url();?>search?page_view=grid&type=rent">
                                        <div class="hi-icon hi-icon-cog"><i class="fa fa-key"></i></div>
                                        <h4><?=$this->lang->line('c_tenants');?></h4>
                                        <p></p>
                                    </a>
                                </li>
                                <li class="col-md-3">
                                    <a href="<?=site_url();?>search?page_view=grid&type=sale">
                                        <div class="hi-icon hi-icon-cog"><i class="fa fa-user"></i></div>
                                        <h4><?=$this->lang->line('c_agents');?></h4>
                                        <p></p>
                                    </a>
                                </li>
                            </ul>
                        </div>


                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div id="content-area" class="contact-area">
                                    <div class="white-block">
                                        <div class="row">
                                            <div class="contact-block-inner">
                                                <form id="contactus_form" name="contactus_form" method="post">
                                                    <div id="res_mesg"></div>
                                                    <div class="col-sm-4 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="control-label" for="fullname"><?=$this->lang->line('c_full_name');?></label>
                                                            <input type="text" class="form-control custom-host-input"
                                                                   required name="fullname"
                                                                   value="<?= $this->input->post('fullname') ?>"
                                                                   placeholder="Full Name">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="control-label" for="email"><?=$this->lang->line('c_your_email');?></label>
                                                            <input type="email" class="form-control custom-host-input"
                                                                   id="email" name="email" required
                                                                   data-pattern-error="Please enter valid email."
                                                                   value="<?= $this->input->post('email') ?>"
                                                                   placeholder="Please enter email">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="control-label" for="phone"><?=$this->lang->line('c_phone');?></label>
                                                            <input type="text"  class="form-control custom-host-input"
                                                                   id="phone" name="phone" placeholder="Phone" required>
                                                        </div>
                                                    </div>


                                                   <!-- <div class="col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="control-label" for="country"><?/*=$this->lang->line('c_country');*/?></label>
                                                            <select class="contact_select form-control" id="country" name="country" placeholder="Select a country..." required>
                                                                <option value="">Select Country</option>
                                                                <?php /*foreach ($countries as $country) { */?>
                                                                    <option value="<?/*= $country->country_name */?>"><?/*= $country->country_name */?></option>
                                                                <?php /*} */?>
                                                            </select>
                                                        </div>
                                                    </div>-->


                                                    <!--<div class="col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="control-label" for="reason_of_inq"><?/*=$this->lang->line('c_obj_req');*/?></label>
                                                            <select class="contact_select form-control" required="required" id="reason_of_inq" name="reason_of_inq">
                                                                <option value=""><?/*=$this->lang->line('c_obj_req');*/?></option>
                                                                <option <?/*= $this->input->post('reason_of_inq') == "Listing Space" ? "selected='selected'" : "" */?>>
                                                                    Listing Space
                                                                </option>
                                                                <option <?/*= $this->input->post('reason_of_inq') == "Already Listed Space" ? "selected='selected'" : "" */?>>
                                                                    Already Listed Space
                                                                </option>
                                                                <option <?/*= $this->input->post('reason_of_inq') == "Future Booking" ? "selected='selected'" : "" */?>>
                                                                    Future Booking
                                                                </option>
                                                                <option <?/*= $this->input->post('reason_of_inq') == "Past Booking" ? "selected='selected'" : "" */?>>
                                                                    Past Booking
                                                                </option>
                                                                <option <?/*= $this->input->post('reason_of_inq') == "Membership" ? "selected='selected'" : "" */?>>
                                                                    Membership
                                                                </option>
                                                                <option <?/*= $this->input->post('reason_of_inq') == "Payment" ? "selected='selected'" : "" */?>>
                                                                    Payment
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>-->

                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="control-label" for="message"><?=$this->lang->line('c_message');?></label>
                                                            <textarea name="message" required id="message" maxlength="1500"
                                                                      class="form-control field-input submit-host-textbar"
                                                                      placeholder="Enter message"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-xs-12">
                                                        <button type="submit" class="btn btn-secondary btn-long"><?=$this->lang->line('c_send');?> </button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div> <!-- container -->
                </section>


            </div>


        </div>
    </div>

</div>