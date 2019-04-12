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
                        <h1 class="page-title"> Ajouter du crédit</h1>
                        <p class="page-subtitle">Veuillez ajouter vos informations afin de crédité votre compte  </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="membership-content-area">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 container-contentbar">
                    <div class="membership-content">

                        <form id="payment_form" name="payment_form" action="<?=site_url('packages/buyTopUp');?>" method="post">

                            <div id="paymentErrors" class="paymentErrors"></div>
                            <div class="info-title">
                                <h2 class="info-title-left"> Méthode de paiement  </h2>
                            </div>

                            <div class="method-select-block">
<!--                                <div class="method-row">-->
<!--                                    <div class="method-select">-->
<!--                                        <div class="radio">-->
<!--                                            <label><input type="radio" class="payment-paypal" id="payment_type" name="payment_type" value="paypal" checked>Paypal</label>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="method-type"><img src="--><?//=base_url()?><!--assets/img/paypal-icon.jpg" alt="paypal"></div>-->
<!--                                </div>-->
<!--                                <div class="method-option">-->
<!--                                    <div class="checkbox">-->
<!--                                        <label><input type="checkbox" name="payment_type" value="option1">Set this as recurring payment</label>-->
<!--                                    </div>-->
<!--                                </div>-->
                                <div class="method-row">
                                    <div class="method-select">
                                        <div class="radio">
                                            <label><input type="radio" class="payment-stripe" id="payment_type" name="payment_type" value="stripe" checked>Stripe</label>
                                        </div>
                                    </div>
                                    <div class="method-type"><img src="<?=base_url()?>assets/img/stripe-icon.jpg" alt="stripe"></div>
                                </div>
                            </div>
                            <div class="info-title"><h2 class="info-title-left"> Information bancaire  </h2></div>
                            <div class="info-detail">
                                <div class="row">
                                    <div id="stripe_box">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="address">Nom sur la carte *</label>
                                                <input id="name" name="name" class="form-control" placeholder="Nom sur la carte">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="apartment">Numero de carte </label>
                                                <input required class="form-control" id="card" step="3" size="20" data-worldpay="number" data-stripe="number"  placeholder="Numero de carte ">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="state">Expiration (mois)</label>
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
                                                <label for="state"> Expiration (année)</label>
                                                <select id="state" class="selectpicker" data-live-search="false" title="Select" data-stripe="exp-year" data-worldpay="exp-year">
                                                    <?php for($i=date('Y');$i <= date('Y')+5;$i++) { ?>
                                                        <option value="<?=$i;?>"><?=$i;?></option>
                                                    <?php } ?>
                                                </select>

                                            </div>
                                        </div>


                                        <div class="col-sm-6">
                                            <div class="form-group">

                                                <label for="security-no">Code de sécurité (CVC)</label>
                                                <input type="text" class="form-control" id="cvc" step="6" required size="4" data-stripe="cvc" data-worldpay="cvc" placeholder="Code de sécurité (CVC)">

                                            </div>
                                        </div>

                                    </div>

                                    <input type="hidden" value="<?=$price;?>" name="amount" />
<!--                                    <div class="col-sm-12">-->
<!--                                        <div class="form-group">-->
<!--                                            <label for="phone"> Message * </label>-->
<!--                                            <textarea class="form-control" rows="6" name="message" placeholder="Write Your Thoughts"></textarea>-->
<!--                                        </div>-->
<!--                                    </div>-->
                                </div>
                            </div>

                            <button type="submit" id="place_order" class="btn btn-success btn-submit"> Purchase </button>
                            <div class="token col-md-8" id="token"><img width="40px" src="<?= base_url(); ?>assets/img/ploading.gif"><span> Payment Processing ...</span></div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-md-offset-0 col-sm-offset-3 container-sidebar">
                    <aside id="sidebar">
                        <div class="payment-side-block">
                            <h3 class="side-block-title"> Ajouter du crédit </h3>
                            <ul class="pkg-total-list">
                                <li class="total-list-head">
                                    <span class="pull-left"></span>
                                    <span class="pull-right"><a href="<?=site_url('agents/payment');?>">Update Topup</a></span>
                                </li>
                                <li>
                                    <span class="pull-left">total price:</span>
                                    <span class="pull-right"><?=pkrCurrencyFormat($price);?></span>
                                </li>
                            </ul>
                        </div>
                        <div class="payment-side-block">
                            <h3 class="side-block-title">Besoin d’aide</h3>
                            <a href="<?=site_url('contact');?>" class="btn btn-primary btn-block">Contact Us</a>
                        </div>
                    </aside>
                </div>
            </div>
        </div>


    </div>
</section>