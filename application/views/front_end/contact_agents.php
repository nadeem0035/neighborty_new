<?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); ?>

<body>
<?php /*$this->load->view('templates/preloader'); */?>
<div id="search_results">
<div id="wrap">
    <?php $this->load->view('templates/'.$topmenu); ?>
    <section class="sub-banner">
        <!--            <div class="bg-parallax bg-6" style="height:420px !important;"></div>-->

    </section>
    <div class="main">

        <div class="title-wrap">
            <section class="destinations" style="background: rgba(10, 7, 6, 0.7); border-top:1px solid #5a524c; border-bottom:1px solid #5a524c;">

                <?php $this->load->view('templates/sub_searchform'); ?>

            </section>

            <section>
                <div class="header-media">
                    <div class="banner-parallax" style="height: 200px;">
                        <div class="banner-bg-wrap">
                            <div class="banner-inner" style="background-image: url(assets/img/inner-page-banner.jpg);">
                                <div class="banner-caption">
                                    <h1>Agent Contact Form</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> <!-- banner ends here -->

            <section id="section-body"> <!-- section Body -->
                <div class="container">
                    <div class="page-title breadcrumb-top">
                        <div class="row">
                            <div class="col-sm-12">
                                <ol class="breadcrumb">
                                    <li><a href="/neighborty"><i class="fa fa-home"></i></a></li>
                                    <li><a href="<?= site_url('contact')?>">Contact Us</a></li>
                                    <li class="active">Agent Contact Form</li>
                                </ol>
                            </div>
                        </div> <!-- row -->
                    </div> <!-- page title breadcrumb top -->


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
                                                        <label class="control-label" for="fullname">Full Name</label>
                                                        <input type="text" class="form-control custom-host-input" required name="fullname" value="<?=$this->input->post('fullname')?>" placeholder="Full Name">
                                                    </div>
                                                </div>

                                                <div class="col-sm-4 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="control-label" for="email">Your Email</label>
                                                        <input type="email" class="form-control custom-host-input"  id="email" name="email"  required data-pattern-error="Please enter valid email."  value="<?=$this->input->post('email')?>" placeholder="Email Address">
                                                    </div>
                                                </div>

                                                <div class="col-sm-4 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="control-label" for="phone">Phone</label>
                                                        <input type="text" class="form-control custom-host-input" id="phone" name="phone" placeholder="Phone Number">
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="control-label" for="country">Your Home Country</label>
                                                        <select class="selectpicker custom-host-select" data-live-search="true" id="country" name="country" required="">
                                                            <option value="">Select Home Country..</option>
                                                            <?php foreach ($countries as $country){?>
                                                                <option value="<?=$country->country_name?>"><?=$country->country_name?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="control-label" for="reason_of_inq">Reason for Inquiry</label>
                                                        <select class="selectpicker  bs-select-hidden custom-host-select" data-live-search="false" required="required" data-errormessage-value-missing="Please, pick one" id="reason_of_inq" name="reason_of_inq">
                                                            <option value="">Reason for Inquiry...</option>
                                                            <option <?=$this->input->post('reason_of_inq')=="Listing Space"?"selected='selected'":""?>>Listing Space</option>
                                                            <option <?=$this->input->post('reason_of_inq')=="Already Listed Space"?"selected='selected'":""?>>Already Listed Space</option>
                                                            <option <?=$this->input->post('reason_of_inq')=="Future Booking"?"selected='selected'":""?>>Future Booking</option>
                                                            <option <?=$this->input->post('reason_of_inq')=="Past Booking"?"selected='selected'":""?>>Past Booking</option>
                                                            <option <?=$this->input->post('reason_of_inq')=="Membership"?"selected='selected'":""?>>Membership</option>
                                                            <option <?=$this->input->post('reason_of_inq')=="Payment"?"selected='selected'":""?>>Payment</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="control-label" for="message">Your Message</label>
                                                        <textarea name="message" id="message" maxlength="1500" class="form-control field-input submit-host-textbar" placeholder="Write Your Message"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-xs-12">
                                                    <button type="submit" class="btn btn-secondary btn-long">Send</button>
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