<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<body>
<?php $this->load->view('templates/' .$topmenu); ?>
<?php $this->load->view('templates/quick_searchform'); ?>
<section id="section-body">
    <div class="container">

        <div class="membership-page-top">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="membership-page-title">
                        <h1 class="page-title">Finaliser votre commande</h1>
                        <p class="page-subtitle">Entrer s’il vous plait vos informations pour complété votre forfait membre!</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="membership-content-area">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 container-contentbar">
                    <div class="membership-content">

                        <form id="payment_form" name="payment_form" action="<?=site_url('packages/process_payment');?>" method="post">

                            <div id="paymentErrors" class="paymentErrors"></div>
                            <div class="info-title">
                                <h2 class="info-title-left"> Payment Method </h2>
                            </div>

                            <div class="method-select-block">
                                <!--<div class="method-row">
                                        <div class="method-select">
                                            <div class="radio">
                                                <label><input type="radio" class="payment-paypal" id="payment_type" name="payment_type" value="paypal" checked>Paypal</label>
                                            </div>
                                        </div>
                                        <div class="method-type"><img src="<?/*=base_url()*/?>assets/img/paypal-icon.jpg" alt="paypal"></div>
                                    </div>-->
                                <div class="method-option">
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="payment_type" value="option1">Set this as recurring payment</label>
                                    </div>
                                </div>
                                <div class="method-row">
                                    <div class="method-select">
                                        <div class="radio">
                                            <label><input type="radio" class="payment-stripe" id="payment_type" name="payment_type" value="stripe" checked>Stripe</label>
                                        </div>
                                    </div>
                                    <div class="method-type"><img src="<?=base_url()?>assets/img/stripe-icon.jpg" alt="stripe"></div>
                                </div>
                            </div>
                            <div class="info-title"><h2 class="info-title-left"> Payment information </h2></div>
                            <div class="info-detail">
                                <div class="row">
                                    <div id="stripe_box">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="address">Name on Card*</label>
                                                <input id="name" name="name" class="form-control" placeholder="Enter Name on Card">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="apartment">Card Number</label>
                                                <input required class="form-control" id="card" step="3" size="20" data-worldpay="number" data-stripe="number"  placeholder="Enter Card Number">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="state"> Expires On (Month)</label>
                                                <select id="state" class="selectpicker" data-live-search="false" title="Select" data-stripe="exp-month" data-worldpay="exp-month">
                                                    <option value="01">01</option>
                                                    <option value="02">02</option>
                                                    <option value="03">03</option>
                                                    <option value="04">04</option>
                                                    <option value="05">05</option>
                                                    <option value="06">06</option>
                                                    <option value="07">07</option>
                                                    <option value="08">08</option>
                                                    <option value="09">09</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="state"> Expires On (Year)</label>
                                                <select id="state" class="selectpicker" data-live-search="false" title="Select" data-stripe="exp-year" data-worldpay="exp-year">
                                                    <?php for($i=date('Y');$i <= date('Y')+5;$i++) { ?>
                                                        <option value="<?=$i;?>"><?=$i;?></option>
                                                    <?php } ?>
                                                </select>

                                            </div>
                                        </div>


                                        <div class="col-sm-6">
                                            <div class="form-group">

                                                <label for="security-no">Security Number (CVC)</label>
                                                <input type="text" class="form-control" id="cvc" step="6" required size="4" data-stripe="cvc" data-worldpay="cvc" placeholder="Enter Security Number">

                                            </div>
                                        </div>

                                    </div>

                                    <!-- <div class="col-sm-12">
                                         <div class="form-group">
                                             <label for="phone"> Message * </label>
                                             <textarea class="form-control" rows="6" name="message" placeholder="Write Your Thoughts"></textarea>
                                         </div>
                                     </div>-->
                                </div>
                            </div>
                            <input type="hidden" name="package" value="<?= $packages->name ?>" />
                            <input type="hidden" name="id" value="<?= $packages->id ?>" />

                            <button type="submit" id="place_order" class="btn btn-success btn-submit"> Complete Membership </button>
                            <span class="help-block">By clicking "Complete Membership" you agree to our <a href="#">Terms of use.</a></span>
                            <div class="token col-md-8" id="token"><img width="40px" src="<?= base_url(); ?>assets/img/ploading.gif"><span> Payment Processing ...</span></div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-md-offset-0 col-sm-offset-3 container-sidebar">
                    <aside id="sidebar">
                        <div class="payment-side-block">
                            <h3 class="side-block-title"> Forfait membre </h3>
                            <div class="pkg-total-list">
                                <div class="total-list-head">
                                    <span class="pull-left"><?= ucwords($packages->name);?></span>
                                    <span class="pull-right"><a href="<?=site_url('packages');?>">Changé de forfait</a></span>
                                </div>
                                <?=$packages->description;?>
                                <!--<li>
                                     <span class="pull-left">Package Time:</span>

                                 </li>
                                 <li>
                                     <span class="pull-left">Listing Included:</span>

                                 </li>
                                 <li>
                                     <span class="pull-left">Featured Listing Included:</span>

                                 </li>-->
                                <div>
                                    <span class="pull-left">Total Price:</span>
                                    <span class="pull-right"><?=pkrCurrencyFormat($packages->price);?></span>
                                </div>
                            </div>
                        </div>
                        <div class="payment-side-block">
                            <h3 class="side-block-title"> Besoin d’aide? </h3>
                            <a href="<?=site_url('contact');?>" class="btn btn-primary btn-block">Contact us</a>
                        </div>
                    </aside>
                </div>
            </div>
        </div>


    </div>
</section>