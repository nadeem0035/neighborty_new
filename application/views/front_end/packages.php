<?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); ?>

<body>
    <?php $this->load->view('templates/preloader'); ?>
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


                <section class="blog-content">
                    <div class="row">
                        <div class="col-md-2"> </div>

                        <div class="col-md-8">
                            <div class="container-fluid">
                                <div class="row contact-form">

                                    <div class="col-md-9">

                                        <span class="contact-body-title">Contact Form </span>

                                        <span class="contact-body-subtitle">Please fill out the form below, and we will be in touch with you shortly.</span>
										<div id="res_mesg"></div>
                                        <form class="tbc-margins-adjust" id="contactus_form" name="contactus_form">
                                            <div class="form-field field-input col-md-6">
                                                <input type="text" class="form-control custom-host-input" required name="fullname" value="<?=$this->input->post('fullname')?>" placeholder="Full Name">

                                            </div>
                                              <div class="form-field field-input col-md-6">
                                                <input type="email" class="form-control custom-host-input"  id="email" name="email"  required data-pattern-error="Please enter valid email."  value="<?=$this->input->post('email')?>" placeholder="Email Address">

                                            </div>

                                             <div class="form-field field-input col-md-6">
                                                <input type="text" class="form-control custom-host-input" id="phone" name="phone" placeholder="Phone Number">

                                            </div>
                                             <div class="form-field field-select col-md-6">
                                                 <select class="form-control custom-host-select" id="country" name="country" required="">
                                                    <option value="">Select Home Country..</option>
                                                  <?php foreach ($countries as $country){?>
                                                  <option value="<?=$country->country_name?>"><?=$country->country_name?></option>
                                                  <?php } ?>  
                                                </select>
                                            </div>
                                             <div class="form-field field-select col-md-6">
                                                <select class="form-control custom-host-select" required="required" data-errormessage-value-missing="Please, pick one" id="reason_of_inq" name="reason_of_inq">
                                                    <option value="">Reason for Inquiry...</option>
                                                    <option <?=$this->input->post('reason_of_inq')=="Listing Space"?"selected='selected'":""?>>Listing Space</option>
                                                    <option <?=$this->input->post('reason_of_inq')=="Already Listed Space"?"selected='selected'":""?>>Already Listed Space</option>
                                                    <option <?=$this->input->post('reason_of_inq')=="Future Booking"?"selected='selected'":""?>>Future Booking</option>
                                                    <option <?=$this->input->post('reason_of_inq')=="Past Booking"?"selected='selected'":""?>>Past Booking</option>
                                                    <option <?=$this->input->post('reason_of_inq')=="Membership"?"selected='selected'":""?>>Membership</option>
                                                    <option <?=$this->input->post('reason_of_inq')=="Payment"?"selected='selected'":""?>>Payment</option>
                                                </select>
                                            </div>

                                             <div class="form-field field-input col-md-6">
                                                <input type="text" class="form-control custom-host-input" maxlength="100" id="subject" name="subject" placeholder="Write Your Subject ">

                                            </div>

                                            <div class="form-field form-field-host-area col-md-12">


                                                <textarea name="message" id="message" maxlength="1500" class="form-control field-input submit-host-textbar" placeholder="Write Your Message"></textarea>


                                                <div class="field-input host-submit">

                                                    <button  type="submit" id="contactus_submit" class="awe-btn awe-btn-1 awe-btn-medium">SUBMIT</button>

                                                </div>

                                            </div>

                                        </form>

                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="col-md-2"> </div>

                    </div>
                </section>


            </div>




        </div>
    </div>