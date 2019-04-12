<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body>
    <?php $this->load->view('templates/preloader'); ?>
    <div id="wrap">
        <?php $this->load->view('templates/' . $topmenu); ?>
        <section class="sub-banner">
            <div class="bg-parallax bg-6" style="height:420px !important;"></div>
        </section>
        <div class="main">
            <div class="title-wrap">
                <section class="blog-content">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="post post-single">
                                <h1 class="title-post-head col-md-12">Payments</h1>
                                <div class="post-content paymentsForm">

                                    <?php
                                    $attributes = array('class' => 'tbc-margins-adjust', 'id' => 'payment_form', 'name' => 'payment_form');
                                    echo form_open('booking/process-request', $attributes);
                                    ?>

                                    <div class="col-md-12">
                                        <div class="form-field field-select col-md-4">
                                            <label>Payment Type</label>
                                            <select class="custom-host-select" id="transaction_through" name="transaction_through" step="1">
                                                <option value="card">Debit/Credit Card</option>
                                                <option value="paypal">PayPal</option>
                                            </select>
                                        </div>
                                        <div class="form-field field-select col-md-8">
                                            <div class="payment_logos_container">  
                                                <img src="<?= base_url() ?>assets/img/img_amex.png">
                                                <img src="<?= base_url() ?>assets/img/img_discover.png">
                                                <img src="<?= base_url() ?>assets/img/img_mastercard.png">
                                                <img src="<?= base_url() ?>assets/img/img_paypal.png">
                                                <img src="<?= base_url() ?>assets/img/img_visa.png">
                                            </div>                                             
                                        </div>
                                    </div>
                                    <div id="row_dim">
                                        <div class="col-md-12">	
                                            <div class="form-field field-input col-md-4">
                                                <label>Name on Card</label>                                             
                                                <input type="text" id="name" name="name" required class="custom-host-input cardNum" step="2" data-worldpay="name"  placeholder="Enter Name on Card">
                                            </div>
                                            <div class="form-field field-input col-md-4">
                                                <label>Card Number</label>                                             
                                                <input type="text" required class="custom-host-input cardNum" id="card" step="3" size="20" data-worldpay="number" data-stripe="number"  placeholder="Enter Card Number">
                                            </div>
                                        </div>
                                        <div class="form-field field-input col-md-12">
                                            <div class="form-field field-select col-md-4">
                                                <label>Expires On (Month)</label>
                                                <select class="custom-host-select" id="expiration-month" required step="4" data-stripe="exp-month" data-worldpay="exp-month">
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
                                            <div class="form-field field-select col-md-4">
                                                <label>Expires On (Year)</label>
                                                <select class="custom-host-select" id="expiration-year" step="5" required data-stripe="exp-year" data-worldpay="exp-year">
                                                    <option value="2015">2015</option>
                                                    <option value="2016">2016</option>
                                                    <option value="2017">2017</option>
                                                    <option value="2018">2018</option>
                                                    <option value="2019">2019</option>
                                                    <option value="2020">2020</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2022">2022</option>
                                                    <option value="2023">2023</option>
                                                    <option value="2024">2024</option>
                                                    <option value="2025">2025</option>
                                                </select>
                                            </div>
                                            <div class="form-field field-select col-md-4">
                                                <label>Security Number (CVC)</label>
                                                <input type="text" class="custom-host-input" id="cvc" step="6" required size="4" data-stripe="cvc" data-worldpay="cvc" placeholder="Enter Security Number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="post post-single paymentSecInfo">
                                        <h1 class="title-post-head col-md-12">Tell <?= ucfirst($userdetail->first_name); ?> About Your Trip</h1>
                                        <div class="post-content">
                                            <p>Some Helpful Tips on what to write ??</p>
                                            <ul class="filter">
                                                <li><img src="<?= base_url() ?>assets/img/icon-tick.png"> <span class="tbc-lists-inner">What brings you to <?= $listing->city_town; ?> ? Who's joining you ?</span></li>
                                                <li><img src="<?= base_url() ?>assets/img/icon-tick.png"> <span class="tbc-lists-inner">Coordinate Check-in plans and key exchange</span></li>
                                                <li><img src="<?= base_url() ?>assets/img/icon-tick.png"> <span class="tbc-lists-inner">Ask for recommendation in their neighbour childhood</span></li>
                                                <li><img src="<?= base_url() ?>assets/img/icon-tick.png"> <span class="tbc-lists-inner">For how long you want to stay and what places you like the most ?</span></li>
                                            </ul>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <img class="img-circle hostPicture" src="<?= base_url() ?><?= $users_avatar ?>/small/<?= $userdetail->picture ?> ">
                                                        <p class="host-message"><?= ucfirst($userdetail->first_name); ?> </p>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="clearfix"></div>
                                                        <div class="form-field form-field-host-area col-md-12">
                                                            <label class="home-labels host-labels-adjust">Message your Host</label>
                                                            <textarea name="message" id="message" required class="field-input submit-host-textbar" placeholder="Write Your Thoughts">Your custom message</textarea>
                                                            <p>By Clicking on "Confirm Booking", you agree to pay the total amount shown which includes the Service Fees on the right, and the <a class="paymentLinks" href="#">Terms of Service</a>, <a class="paymentLinks" href="#">House Rules</a> and <a class="paymentLinks" href="#">Guest Refund Policy</a>.</p>
                                                            <div class="alert alert-info">
                                                                You will only be charged once the host accepts your reservation request. No charge will be made if the host declines or does not respond within 48 hours.
                                                            </div>
                                                            <div id="paymentErrors" class="paymentErrors"></div>

                                                            <input type="hidden" name="description" step="8" value="<?= ucwords($listing->listing_name) ?>" />
                                                            <div class="field-input hostSubmitPayment">
                                                                <button type="submit" id="place-orde" step="9" class="awe-btn awe-btn-1 awe-btn-medium col-md-4">CONFIRM BOOKING</button>
                                                                <div class="token col-md-8" id="token"><img width="40px" src="<?= base_url(); ?>assets/img/ploading.gif"><span> Payment Processing ...</span></div>
                                                            </div>
                                                        </div>   
                                                    </div>
                                                </div>
                                            </div>                                              
                                        </div>                                   
                                    </div>
                                    <div class="clearfix"></div> 
                                    </form>
                                </div>                                    
                            </div>
                            <div class="clearfix"></div>

                        </div>
                        <div class="col-md-4">
                            <div class="paymentWidget">
                                <div><img src="<?= base_url() ?>assets/media/listings/listings/<?= $listing->preview_image_url; ?>" alt=""></div>
                                <h1><?= ucwords($listing->listing_name) ?></h1>
                                <p><?= $listing->typed_address; ?></p>
                                <hr>
                                <p><span class="bold"><?= $listing->room_type ?></span> for <span class="bold"><?= $totalguests ?> guest</span></p>
                                <p><span class="bold"><?= date("D, F j, Y", strtotime($checkin)) ?></span> to <span class="bold"><?= date("D, F j, Y", strtotime($checkout)) ?></span></p>
                                <hr>
                                <div class="hl-customer-like">
                                    <div class="customer-like">
                                        <span class="cs-like-label">Cancellation Policy</span>
                                        <ul>
                                            <li>Strict</li>
                                        </ul>
                                    </div>
                                    <div class="customer-like">
                                        <span class="cs-like-label">House Rules</span>
                                        <ul>
                                            <li>Read Policy</li>
                                        </ul>
                                    </div>
                                    <div class="customer-like">
                                        <span class="cs-like-label">Guests</span>
                                        <ul>
                                            <li><?= $totalguests ?></li>
                                        </ul>
                                    </div>
                                    <div class="customer-like">
                                        <span class="cs-like-label">Nights</span>
                                        <ul>
                                            <li><?= $totalnights ?></li>
                                        </ul>
                                    </div>
                                    <hr>
                                    <div class="customer-like">
                                        <span class="cs-like-label">$<?= round(($listing_price_sum / $totalnights), 2) ?> x <?= $totalnights ?> night(s)</span>
                                        <ul>
                                            <li>$<?= $listing_price_sum ?> USD</li>
                                        </ul>
                                    </div>
                                    <div class="customer-like">
                                        <span class="cs-like-label">Service Fee</span>
                                        <ul>
                                            <li>$<?= ($listing_price_sum * $service_fee); ?> USD</li>
                                        </ul>
                                    </div>
                                    <div class="customer-like">
                                        <span class="cs-like-label">Cleanse charges</span>
                                        <ul>
                                            <li>$<?= $cleanse_charges ?> USD</li>
                                        </ul>
                                    </div>
                                    <hr>
                                    <h1>Total: <span>$<?= $listing_price_sum + ($listing_price_sum * $service_fee) + $cleanse_charges ?> USD</span></h1>
                                    <hr>
                                    <p>You are paying in <span class="bold">USD</span> Your total charge is <span class="bold">$ <?= $listing_price_sum + ($listing_price_sum * $service_fee) + $cleanse_charges ?></span> </p>                                
                                </div>                                    
                            </div>    
                        </div>
                    </div>
                </section>      
            </div>
        </div>
    </div>