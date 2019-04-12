<?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); ?>
<body>
    <?php $this->load->view('templates/'.$topmenu); ?>
    <?php $this->load->view('templates/quick_searchform'); ?>
    <section id="section-body">
        <div class="container">
            <div class="membership-page-top">
                <div class="membership-page-title">
                    <h1 class="page-title"> Create a free business user account for </h1>
                    <p class="page-subtitle">
                        <?=$user->first_name .' '.$user->last_name;?>
                        <?php $session_data = $this->session->userdata('logged_in');?>
                    </p>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="accord-block">
                            <div class="add-tab-content">
                                <div class="add-tab-row form-section-1">

                                    <form action="<?=site_url('claim-varification');?>" method="post">

                            
                                        <div class="form-group">
                                            <label for="property-title">Work Email Address</label>
                                            <input required="" name="working_email" class="form-control" id="working_email" placeholder="Enter your Email Address">
                                        </div>

                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input class="form-control" name="first_name" id="" placeholder="First Name">
                                        </div>


                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input class="form-control" name="last_name" id="" placeholder="Last Name">
                                        </div>

                                        <div class="form-group">
                                            <label>Phone </label>
                                            <input class="form-control" name="phone" id="" placeholder="Phone" value="">
                                        </div>

                                        <input type="hidden" value="<?=$id;?>" name="agent_id">

                                        <p>By clicking the button below, you represent that you have authority to claim this account on behalf of this business, and agree to Neighborty
                                            <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.
                                        </p>
                                        <input type="submit" id="" class="btn btn-block btn-secondary" value="Continue">
                                    </form>

                                </div>
                                <div class="accord-block text-center" style="margin-top:25px;">
                                    <p>Need help? Phone number <strong>(877) 767-9357</strong></p>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </div>
            </section>
