<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User class.
 * 
 * @extends CI_Controller
 */
class Booking extends CI_Controller {

    /**
     * __construct function.
     * 
     * @access public
     * @return void
     */
    public function __construct() {

        parent::__construct();
        $this->load->model('Booking_model');
        $this->load->model('Common_model', 'common', true);
        $this->load->model('Listings_model');
        $this->load->model('Inbox_model');
        set_extra_js("ComponentsPickers.init();");
    }

    public function detail() {
        $data = new stdClass();
        $data->topmenu = "listing_topmenu";
        if ($this->session->userdata('logged_in')) {
            add_css(array('light.css'));
            add_js(array('jquery.slimscroll.min.js'));
            $data->topmenu = "session_topmenu";
        }

        $this->load->helper('form');
        $this->load->library('form_validation');
        $slug = $this->uri->segment(3);
        $id = explode('-', $slug);
        $listing_id = $id[count($id) - 1];

        add_css(array('owl.carousel.css',
            'jquery.mb.YTPlayer.min.css',
            'style.css',
            'demo.css',
            'set2.css',
            'listing-gallery.css',
            'jquery.dop.Select.css',
            'jquery.fancybox.css',
            'jquery.dop.FrontendBookingCalendarPRO.css',
        ));

        add_js(array('owl.carousel.min.js',
            'general.js',
            'parallax.min.js',
            'jquery.nicescroll.js',
            'jquery.ui.touch-punch.min.js',
            'jquery.mb.YTPlayer.min.js',
            'SmoothScroll.js',
            'script.js',
            'jquery.pikachoose.min.js',
            'booking.js',
            'jquery.dop.Select.js',
            'dop-prototypes.js',
            'jquery.fancybox.js',
            'jquery.dop.FrontendBookingCalendarPRO.js',
            'jquery.sticky.js'));

        set_extra_js('var a = function(self){self.anchor.fancybox({openEffect:"elastic",closeEffect:"elastic"});};
			$("#pikame").PikaChoose({carousel:true,buildFinished:a});
		 
            $("#frontend").DOPFrontendBookingCalendarPRO({
                                "ID":' . $listing_id . ',
                                "loadURL": site_url + "listings/detail_existing_listing_calendar",
                                "sendURL": site_url + "listings/add_listing_calendar"
                            });');
        $data->users_avatar = $this->config->item('users_avatar');
        $data->listing = $this->common->get_row_with_specific_data("*", 'listing', 'id', (int) $listing_id);
        $data->userdetail = $this->common->get_row_with_specific_data("*", 'users', 'id', (int) $data->listing->user_id);
        $amenities = $this->Listings_model->get_list_amenities_name((int) $listing_id);

        $data->detail_review = $this->Listings_model->get_listing_detail_review((int) $listing_id);
        $data->reviews_all = $this->Listings_model->get_list_reviews_all((int) $listing_id);
        //echo $this->db->last_query();
        $review = $this->Listings_model->get_listing_review((int) $listing_id);
        if ($review) {
            $listing_review['rating'] = round($review->rating, 2) * 20;
            $listing_review['total'] = $review->total;
        } else {
            $listing_review['rating'] = 0;
            $listing_review['total'] = 0;
        }
        $data->reviews = $listing_review;
        if ($amenities) {
            $data->amenities = $amenities;
        }

        $pics = $this->Listings_model->get_list_images((int) $listing_id);
        if ($pics) {
            $data->pictures = $pics;
        }

        //Title and meta description
        $this->seo->SetValues('Title', ucfirst($data->listing->listing_name) . " - Apartments for Rent in " . ucfirst($data->listing->state_province));
        $this->seo->SetValues('Description', ucfirst($data->listing->home_type) . " for $" . $data->listing->price . ". " . ucfirst(substr($data->listing->summary, 0, 140)));


        $this->load->view('templates/header');
        $this->load->view('booking/booking', $data);
        $this->load->view('templates/footer');
    }

    function confirm_booking() {

        if ($this->session->userdata('logged_in') && $this->input->post('slug')) { //
            // load form helper and validation library
            $this->load->helper('form');
            $this->load->library('form_validation');

            add_css(array('light.css'));
            add_js(array('jquery.slimscroll.min.js'));
            $data = new stdClass();
            $data->topmenu = "session_topmenu";

            // $data['title'] = ucfirst($page); // Capitalize the first letter
            add_css(array('owl.carousel.css', 'jquery.mb.YTPlayer.min.css', 'style.css', 'demo.css', 'set2.css'));
            add_js(array('owl.carousel.min.js', 'general.js', 'parallax.min.js', 'jquery.nicescroll.js', 'jquery.ui.touch-punch.min.js', 'jquery.mb.YTPlayer.min.js', 'worldpay.js', 'payment_general.js', 'SmoothScroll.js', 'script.js'));
            //set_extra_js("Stripe.setPublishableKey('pk_test_mhZZ5WRRZuJvCBvG678ujp9F');");

            $listing_id = $this->input->post('lid');
            $session_data = $this->session->userdata('logged_in');

            $data->listing = $this->Listings_model->GetPublishlist((int) $listing_id);
            $checkin = $this->input->post('DOPBCPCalendar-check-in');
            $checkout = $this->input->post('DOPBCPCalendar-check-out');
            $data->totalguests = $this->input->post('totalguests');
            $data->room_type = $this->input->post('room_type');
            $data->checkin = $checkin;
            $data->checkout = $checkout;

            $ac_data = $this->details_existing_listing_calendar($listing_id); // Get avaiable dates 
            $check_dates = dateRange($checkin, $checkout); // Convert check-in , check-out into full days array

            $listing_price = array();

            foreach ($ac_data as $key => $value) {  //Get price of selected dates
                if ((in_array($key, $check_dates))) {
                    if ($value->status == 'available') {
                        if ($value->promo > 0) {
                            $listing_price[] = $value->promo;
                        } else {
                            $listing_price[] = $value->price;
                        }
                    }
                }
            }

            foreach ($ac_data as $key => $value) {   //Get array of avaiable dates
                if ($value->status == 'available') {
                    $avaiable_dates[] = $key;
                }
            }

            $fullyExists = (count($check_dates) == count(array_intersect($check_dates, $avaiable_dates))); // Check if users check-in and check-out dates avaiable

            $data->totalnights = count($check_dates); // Count booked nights

            $data->listing_price_sum = array_sum($listing_price);
            $data->service_fee = 0.15;  // 15% service Fee
            $data->cleanse_charges = 0;

            if ($data->listing->active != 'Publish') {

                $this->session->set_flashdata('error', "You Can Book only Publish listings!");
                $slug = $this->input->post('slug');
                if ($slug) {
                    redirect("/booking/detail/$slug");
                } else {
                    redirect("/");
                }
            } else if ($this->Listings_model->validate_user_listing($session_data['id'], $listing_id)) {

                $this->session->set_flashdata('error', "You Can't Book your own listings!");
                $slug = $this->input->post('slug');
                if ($slug) {
                    redirect("/booking/detail/$slug");
                } else {
                    redirect("/");
                }
            } else if ($fullyExists) {

                $session_array = array(
                    'listing_id' => $listing_id, 
                    'host_id' => $data->listing->user_id,
                    'check_in' => $data->checkin,
                    'check_out' => $data->checkout,
                    'total_guest' => $data->totalguests,
                    'stay_nights' => $data->totalnights,
                    'listing_charges' => $data->listing_price_sum,
                    'cleanse_charges' => $data->cleanse_charges,
                    'services_charges' => $data->service_fee * $data->listing_price_sum,
                    'total_charges' => $data->listing_price_sum + ( $data->listing_price_sum * $data->service_fee ) + $data->cleanse_charges,
                );

                $this->session->set_userdata('booking_cart', $session_array);

                $data->userdetail = $this->common->get_row_with_specific_data("*", 'users', 'id', (int) $data->listing->user_id);
                $data->users_avatar = $this->config->item('users_avatar');

                //Title and meta description
                $this->seo->SetValues('Title', 'Vacation rentals, private rooms, sublets by the night - Accommodations on stayluxus');
                $this->seo->SetValues('Description', "Browse and book, or list your space. It's easy!");

                $this->load->view('templates/header');
                $this->load->view('booking/payments', $data);
                $this->load->view('templates/footer');
            } else { //If some one is cheating to system tthen return him back
                $this->session->set_flashdata('error', 'Some thing wrong please try again!');
                $slug = $this->input->post('slug');
                if ($slug) {
                    redirect("/booking/detail/$slug");
                } else {
                    redirect("/");
                }
            }
        } else {
            redirect("/");
        }
    }

    function details_existing_listing_calendar($listingid) {

        if ($listingid) {

            $listing = $this->Listings_model->get_list($listingid);
            $already_booked = $this->Listings_model->already_booked($listingid); //Remove booked or issue dates
            $ac_data = json_decode($listing->availability_calendar);
            if ($ac_data) {
                if ($already_booked) {
                    foreach ($already_booked as $already_book) {
                        $already_dates = dateRange($already_book->check_in, $already_book->check_out);
                        foreach ($ac_data as $key => $value) {
                            if ((in_array($key, $already_dates))) {
                                $ac_data->$key->status = 'booked';
                            }
                        }
                    }
                    return $ac_data;
                } else {
                    return $ac_data;
                }
            }
        }
    }

    function process_request() {

        if ($this->session->userdata('logged_in')) {

            add_css(array('light.css', 'owl.carousel.css', 'jquery.mb.YTPlayer.min.css', 'style.css', 'demo.css', 'set2.css'));
            add_js(array('jquery.slimscroll.min.js', 'owl.carousel.min.js', 'general.js', 'parallax.min.js', 'jquery.nicescroll.js', 'jquery.ui.touch-punch.min.js', 'jquery.mb.YTPlayer.min.js', 'SmoothScroll.js', 'script.js'));


            $data = new stdClass();
            $data->topmenu = "session_topmenu";

            //Title and meta description
            $this->seo->SetValues('Title', 'Book rental property for your Vacation - stayluxus');

            if ($this->input->post('transaction_through') == 'card') { //Stripe payment method
                $this->load->library('stripe/Stripe');
                $stripe = new Stripe();

                $session_data = $this->session->userdata('logged_in');
                $guest_id = $session_data['id'];

                $token = $this->input->post('stripeToken');

                $name = $this->input->post('name');
                $guest_message = $this->input->post('message');
                $orderdescription = $this->input->post('description');

                $booking_cart = $this->session->userdata('booking_cart');

                $message = '';

                $data->stripe = '';
                $dataes = array(
                    'amount' => $booking_cart['total_charges'] * 100,
                    "currency" => "usd",
                    "card" => $token, // array('exp_month' => '02', 'exp_year' => '2016', 'number' => '4111111111111111', 'object' => 'card', 'cvc' => '123'),
                    'capture' => false,
                    "description" => $orderdescription
                );

                try {

                    $charge = $stripe->addCharge($dataes);

                    if ($charge->paid == true && $charge->status == 'succeeded') {

                        $booking_cart['guest_id'] = $guest_id;
                        $booking_cart['token'] = $token;
                        $booking_cart['transaction_through'] = 'card';
                        $booking_cart['message'] = $guest_message;
                        $booking_cart['transaction_id'] = $charge->id;
                        $booking_cart['status'] = 'pending';
                        $this->session->set_userdata('booking_cart', $booking_cart);
                        $booking_cart = $this->session->userdata('booking_cart');

                        $MessageData = array(
                            'receiver_id' => $booking_cart['host_id'],
                            'sender_id' => $guest_id,
                            'type' => 'Reservation',
                            'message' => 'You have receive reservation request',
                            'listing_id' => $booking_cart['listing_id'],
                            'check_in' => date('Y-m-d', strtotime($booking_cart['check_in'])),
                            'check_out' => date('Y-m-d', strtotime($booking_cart['check_out'])),
                            'guest' => $booking_cart['total_guest'],
                            'read_status' => 0,
                        );

                        $booking = $this->Booking_model->booking($booking_cart);
                        $data->listing = $this->Listings_model->get_list( $booking_cart['listing_id']);

                        if ($booking) {
                            $message .= '<p>You have successfully book listing. Please wait for approval from property host.</p>';
                            //Send mail
                            //
                             SendDefaultMessage($guest_id, 'Request to Book Sent', 'You have successfully sent a request to book <strong>'.$data->listing->listing_name.'</strong> in '.$data->listing->city_town.' for the dates of '.$booking_cart['check_in'].' through '.$booking_cart['check_out']. '<br />The host is currently reviewing this request and will let you know soon if this will be possible.
                                In the meantime, feel free to take a look at other properties in <a href="'.base_url().'search?location='.$data->listing->city_town.'">'.$data->listing->city_town.'</a> <br />If you have any further questions, please let our Support Team know by using our <a href="'.base_url().'contact">Contact Form</a>.', 'Book Listing');

                            //SendDefaultMessage($guest_id, 'Book Listing', 'You have successfully book listing. Please wait for approval from property host', 'Book Listing');
                            SendDefaultMessage($booking_cart['host_id'], 'Reservation Request', 'You have receive reservation request. Please visit website to approve/reject request', 'Reservation Request');
                            $this->Inbox_model->send_message($MessageData);
                        } else {
                            $message .= '<p>Something wrong! Please contact to support with Order Code</p>';
                        }
                    } else { // Charge was not paid!
                        $message .= 'Your payment could NOT be processed (i.e., you have not been charged) because the payment system rejected the transaction. You can try again or use another card.';
                        if (isset($charge->failure_message) && $charge->failure_message != NULL) {
                            $message .= $charge->failure_message;
                        }
                    }
                } catch (Exception $e) {
                    // Exception with Stripe's API failed

                    $body = $e->getJsonBody();

                    $err = $body['error'];
                    if (isset($err['type']) && $err['type'] != NULL) {
                        $message .= '<p>Type is: ' . $err['type'] . "</p>";
                    } if (isset($err['param']) && $err['param'] != NULL) {
                        $message .= '<p>Param is: ' . $err['param'] . "</p>";
                    } if (isset($err['message']) && $err['message'] != NULL) {
                        $message .= '<p>Error message: ' . $err['message'] . "</p>";
                    }
                }


                $data->respnsemessage = $message;
                $this->load->view('templates/header');
                $this->load->view('booking/process_request', $data);
                $this->load->view('templates/footer');
            } else if ($this->input->post('transaction_through') == 'worldpay') {

                $this->load->library('worldpay/Worldpay');

                // Initialise Worldpay class with your SERVICE KEY
                $worldpay = new Worldpay();

                $session_data = $this->session->userdata('logged_in');
                $guest_id = $session_data['id'];

                $token = $this->input->post('token');

                $name = $this->input->post('name');
                $guest_message = $this->input->post('message');
                $orderdescription = $this->input->post('description');

                $booking_cart = $this->session->userdata('booking_cart');

                $message = '';
                // Try catch 
                try {

                    // Customers billing address
                    $billing_address = array(
                        "address1" => '',
                        "address2" => '',
                        "address3" => '',
                        "postalCode" => '',
                        "city" => '',
                        "state" => '',
                        "countryCode" => ''
                    );

                    $response = $worldpay->createOrder(array(
                        'token' => $token, // The token from WorldpayJS
                        'orderDescription' => $orderdescription, // Order description of your choice
                        'amount' => $booking_cart['total_charges'] * 100, // Amount in pence
                        'authoriseOnly' => true,
                        'currencyCode' => 'USD', // Currency code
                        'name' => $name, // Customer name
                        'billingAddress' => $billing_address, // Billing address array
                        'customerIdentifiers' => array(// Custom indentifiers
                            'my-customer-ref' => ''
                        ),
                        'customerOrderCode' => "G" . $guest_id . "H" . $booking_cart['host_id'] . "L" . $booking_cart['listing_id'] . "I" . date("Ymd", strtotime($booking_cart['check_in'])) . "O" . date("Ymd", strtotime($booking_cart['check_out'])) // Order code of your choice
                    ));
                    if ($response['paymentStatus'] === 'SUCCESS' || $response['paymentStatus'] === 'AUTHORIZED') {
                        // Create order was successful!
                        $worldpayOrderCode = $response['orderCode'];
                        $message .= '<p>Order Code: <span id="order-code">' . $worldpayOrderCode . '</span></p>';
                        //$message .= '<p>Token: <span id="token">' . $response['token'] . '</span></p>';
                        $message .= '<p>Payment Status: <span id="payment-status">' . $response['paymentStatus'] . '</span></p>';
                        /// $message .= '<pre>' . print_r($response, true) . '</pre>';
                        //Record the data in table
                        $booking_cart['guest_id'] = $guest_id;
                        $booking_cart['token'] = $token;
                        $booking_cart['transaction_through'] = 'card';
                        $booking_cart['message'] = $guest_message;
                        $booking_cart['transaction_id'] = $worldpayOrderCode;
                        $booking_cart['status'] = 'pending';
                        $this->session->set_userdata('booking_cart', $booking_cart);
                        $booking_cart = $this->session->userdata('booking_cart');

                        $MessageData = array(
                            'receiver_id' => $booking_cart['host_id'],
                            'sender_id' => $guest_id,
                            'type' => 'Reservation',
                            'message' => 'You have receive reservation request',
                            'listing_id' => $booking_cart['listing_id'],
                            'check_in' => date('Y-m-d', strtotime($booking_cart['check_in'])),
                            'check_out' => date('Y-m-d', strtotime($booking_cart['check_out'])),
                            'guest' => $booking_cart['total_guest'],
                            'read_status' => 0,
                        );

                        $booking = $this->Booking_model->booking($booking_cart);

                        if ($booking) {
                            $message .= '<p>You have successfully book listing. Please wait for approval from property host.</p>';
                            //Send mail
                            SendDefaultMessage($guest_id, 'Book Listing', 'You have successfully book listing. Please wait for approval from property host', 'Book Listing');
                            SendDefaultMessage($booking_cart['host_id'], 'Reservation Request', 'You have receive reservation request. Please visit website to approve/reject request', 'Reservation Request');
                            $this->Inbox_model->send_message($MessageData);
                        } else {
                            $message .= '<p>Something wrong! Please contact to support with Order Code</p>';
                        }
                    } else {
                        // Something went wrong
                        $message .= '<p id="payment-status">' . $response['paymentStatus'] . '</p>';
                        //throw new WorldpayException(print_r($response, true));
                    }
                } catch (WorldpayException $e) { // PHP 5.3+
                    // Worldpay has thrown an exception
                    $message .= '<p>Error code: ' . $e->getCustomCode() . '</p>';
                    // $message .= 'HTTP status code:' . $e->getHttpStatusCode() . '<br/>';
                    // $message .= 'Error description: ' . $e->getDescription() . ' <br/>';
                    $message .= '<p>Error message: ' . $e->getMessage() . "</p>";
                } catch (Exception $e) {  // PHP 5.2 
                    $message .= '<p>Error message: ' . $e->getMessage() . "</p>";
                }

                $data->respnsemessage = $message;
                $this->load->view('templates/header');
                $this->load->view('booking/process_request', $data);
                $this->load->view('templates/footer');
            } else if ($this->input->post('transaction_through') == 'paypal') {

                $this->load->library('paypal/Paypal_pro');

                $session_data = $this->session->userdata('logged_in');
                $guest_id = $session_data['id'];
                $booking_cart = $this->session->userdata('booking_cart');
                $guest_message = $this->input->post('message');
                $orderdescription = $this->input->post('description');
                $booking_cart['message'] = $guest_message;
                $this->session->set_userdata('booking_cart', $booking_cart);
                $booking_cart = $this->session->userdata('booking_cart');

                $invice_id = "G" . $guest_id . "H" . $booking_cart['host_id'] . "L" . $booking_cart['listing_id'] . "I" . date("Ymd", strtotime($booking_cart['check_in'])) . "O" . date("Ymd", strtotime($booking_cart['check_out'])); // Order code of your choice


                $SECFields = array(
                    'token' => '', // A timestamped token, the value of which was returned by a previous SetExpressCheckout call.
                    'maxamt' => '6000', // The expected maximum total amount the order will be, including S&H and sales tax.
                    'returnurl' => site_url('booking/success'), // Required.  URL to which the customer will be returned after returning from PayPal.  2048 char max.
                    'cancelurl' => site_url(), // Required.  URL to which the customer will be returned if they cancel payment on PayPal's site.
                    'callback' => '', // URL to which the callback request from PayPal is sent.  Must start with https:// for production.
                    'callbacktimeout' => '', // An override for you to request more or less time to be able to process the callback request and response.  Acceptable range for override is 1-6 seconds.  If you specify greater than 6 PayPal will use default value of 3 seconds.
                    'callbackversion' => '', // The version of the Instant Update API you're using.  The default is the current version.							
                    'reqconfirmshipping' => '', // The value 1 indicates that you require that the customer's shipping address is Confirmed with PayPal.  This overrides anything in the account profile.  Possible values are 1 or 0.
                    'noshipping' => '', // The value 1 indiciates that on the PayPal pages, no shipping address fields should be displayed.  Maybe 1 or 0.
                    'allownote' => '', // The value 1 indiciates that the customer may enter a note to the merchant on the PayPal page during checkout.  The note is returned in the GetExpresscheckoutDetails response and the DoExpressCheckoutPayment response.  Must be 1 or 0.
                    'addroverride' => '', // The value 1 indiciates that the PayPal pages should display the shipping address set by you in the SetExpressCheckout request, not the shipping address on file with PayPal.  This does not allow the customer to edit the address here.  Must be 1 or 0.
                    'localecode' => '', // Locale of pages displayed by PayPal during checkout.  Should be a 2 character country code.  You can retrive the country code by passing the country name into the class' GetCountryCode() function.
                    'pagestyle' => '', // Sets the Custom Payment Page Style for payment pages associated with this button/link.  
                    'hdrimg' => '', // URL for the image displayed as the header during checkout.  Max size of 750x90.  Should be stored on an https:// server or you'll get a warning message in the browser.
                    'hdrbordercolor' => '', // Sets the border color around the header of the payment page.  The border is a 2-pixel permiter around the header space.  Default is black.  
                    'hdrbackcolor' => '', // Sets the background color for the header of the payment page.  Default is white.  
                    'payflowcolor' => '', // Sets the background color for the payment page.  Default is white.
                    'skipdetails' => '', // This is a custom field not included in the PayPal documentation.  It's used to specify whether you want to skip the GetExpressCheckoutDetails part of checkout or not.  See PayPal docs for more info.
                    'email' => '', // Email address of the buyer as entered during checkout.  PayPal uses this value to pre-fill the PayPal sign-in page.  127 char max.
                    'solutiontype' => '', // Type of checkout flow.  Must be Sole (express checkout for auctions) or Mark (normal express checkout)
                    'landingpage' => '', // Type of PayPal page to display.  Can be Billing or Login.  If billing it shows a full credit card form.  If Login it just shows the login screen.
                    'channeltype' => '', // Type of channel.  Must be Merchant (non-auction seller) or eBayItem (eBay auction)
                    'giropaysuccessurl' => '', // The URL on the merchant site to redirect to after a successful giropay payment.  Only use this field if you are using giropay or bank transfer payment methods in Germany.
                    'giropaycancelurl' => '', // The URL on the merchant site to redirect to after a canceled giropay payment.  Only use this field if you are using giropay or bank transfer methods in Germany.
                    'banktxnpendingurl' => '', // The URL on the merchant site to transfer to after a bank transfter payment.  Use this field only if you are using giropay or bank transfer methods in Germany.
                    'brandname' => '', // A label that overrides the business name in the PayPal account on the PayPal hosted checkout pages.  127 char max.
                    'customerservicenumber' => '', // Merchant Customer Service number displayed on the PayPal Review page. 16 char max.
                    'giftmessageenable' => '', // Enable gift message widget on the PayPal Review page. Allowable values are 0 and 1
                    'giftreceiptenable' => '', // Enable gift receipt widget on the PayPal Review page. Allowable values are 0 and 1
                    'giftwrapenable' => '', // Enable gift wrap widget on the PayPal Review page.  Allowable values are 0 and 1.
                    'giftwrapname' => '', // Label for the gift wrap option such as "Box with ribbon".  25 char max.
                    'giftwrapamount' => '', // Amount charged for gift-wrap service.
                    'buyeremailoptionenable' => '', // Enable buyer email opt-in on the PayPal Review page. Allowable values are 0 and 1
                    'surveyquestion' => '', // Text for the survey question on the PayPal Review page. If the survey question is present, at least 2 survey answer options need to be present.  50 char max.
                    'surveyenable' => '', // Enable survey functionality. Allowable values are 0 and 1
                    'totaltype' => '', // Enables display of "estimated total" instead of "total" in the cart review area.  Values are:  Total, EstimatedTotal
                    'notetobuyer' => '', // Displays a note to buyers in the cart review area below the total amount.  Use the note to tell buyers about items in the cart, such as your return policy or that the total excludes shipping and handling.  127 char max.							
                    'buyerid' => '', // The unique identifier provided by eBay for this buyer. The value may or may not be the same as the username. In the case of eBay, it is different. 255 char max.
                    'buyerusername' => '', // The user name of the user at the marketplaces site.
                    'buyerregistrationdate' => '', // Date when the user registered with the marketplace.
                    'allowpushfunding' => ''     // Whether the merchant can accept push funding.  0 = Merchant can accept push funding : 1 = Merchant cannot accept push funding.			
                );

                // Basic array of survey choices.  Nothing but the values should go in here.  
                $SurveyChoices = array('Choice 1', 'Choice2', 'Choice3', 'etc');

                // You can now utlize parallel payments (split payments) within Express Checkout.
                // Here we'll gather all the payment data for each payment included in this checkout 
                // and pass them into a $Payments array.  
                // Keep in mind that each payment will ahve its own set of OrderItems
                // so don't get confused along the way.
                $Payments = array();
                $Payment = array(
                    'amt' => $booking_cart['total_charges'], // Required.  The total cost of the transaction to the customer.  If shipping cost and tax charges are known, include them in this value.  If not, this value should be the current sub-total of the order.
                    'currencycode' => 'USD', // A three-character currency code.  Default is USD.
                    'itemamt' => $booking_cart['listing_charges'], // Required if you specify itemized L_AMT fields. Sum of cost of all items in this order.  
                    'shippingamt' => $booking_cart['cleanse_charges'], // Total shipping costs for this order.  If you specify SHIPPINGAMT you mut also specify a value for ITEMAMT.
                    'shipdiscamt' => '', // Shipping discount for this order, specified as a negative number.
                    'insuranceoptionoffered' => '', // If true, the insurance drop-down on the PayPal review page displays the string 'Yes' and the insurance amount.  If true, the total shipping insurance for this order must be a positive number.
                    'handlingamt' => $booking_cart['services_charges'], // Total handling costs for this order.  If you specify HANDLINGAMT you mut also specify a value for ITEMAMT.
                    'taxamt' => '', // Required if you specify itemized L_TAXAMT fields.  Sum of all tax items in this order. 
                    'desc' => $orderdescription, // Description of items on the order.  127 char max.
                    'custom' => '', // Free-form field for your own use.  256 char max.
                    'invnum' => $invice_id, // Your own invoice or tracking number.  127 char max.
                    'notifyurl' => '', // URL for receiving Instant Payment Notifications
                    'shiptoname' => '', // Required if shipping is included.  Person's name associated with this address.  32 char max.
                    'shiptostreet' => '', // Required if shipping is included.  First street address.  100 char max.
                    'shiptostreet2' => '', // Second street address.  100 char max.
                    'shiptocity' => '', // Required if shipping is included.  Name of city.  40 char max.
                    'shiptostate' => '', // Required if shipping is included.  Name of state or province.  40 char max.
                    'shiptozip' => '', // Required if shipping is included.  Postal code of shipping address.  20 char max.
                    'shiptocountrycode' => '', // Required if shipping is included.  Country code of shipping address.  2 char max.
                    'shiptophonenum' => '', // Phone number for shipping address.  20 char max.
                    'notetext' => '', // Note to the merchant.  255 char max.  
                    'allowedpaymentmethod' => '', // The payment method type.  Specify the value InstantPaymentOnly.
                    'allowpushfunding' => '', // Whether the merchant can accept push funding:  0 - Merchant can accept push funding.  1 - Merchant cannot accept push funding.  This will override the setting in the merchant's PayPal account.
                    'paymentaction' => 'Authorization', // How you want to obtain the payment.  When implementing parallel payments, this field is required and must be set to Order. 
                    'paymentrequestid' => '', // A unique identifier of the specific payment request, which is required for parallel payments. 
                    'sellerid' => '', // The unique non-changing identifier for the seller at the marketplace site.  This ID is not displayed.
                    'sellerusername' => '', // The current name of the seller or business at the marketplace site.  This name may be shown to the buyer.
                    'sellerpaypalaccountid' => ''   // A unique identifier for the merchant.  For parallel payments, this field is required and must contain the Payer ID or the email address of the merchant.
                );

                // For order items you populate a nested array with multiple $Item arrays.  
                // Normally you'll be looping through cart items to populate the $Item array
                // Then push it into the $OrderItems array at the end of each loop for an entire 
                // collection of all items in $OrderItems.

                $PaymentOrderItems = array();
                $Item = array(
                    'name' => $orderdescription, // Item name. 127 char max.
                    'desc' => $orderdescription, // Item description. 127 char max.
                    'amt' => $booking_cart['listing_charges'], // Cost of item.
                    'number' => $booking_cart['listing_id'], // Item number.  127 char max.
                    'qty' => '1', // Item qty on order.  Any positive integer.
                    'taxamt' => '', // Item sales tax
                    'itemurl' => '', // URL for the item.
                    'itemweightvalue' => '', // The weight value of the item.
                    'itemweightunit' => '', // The weight unit of the item.
                    'itemheightvalue' => '', // The height value of the item.
                    'itemheightunit' => '', // The height unit of the item.
                    'itemwidthvalue' => '', // The width value of the item.
                    'itemwidthunit' => '', // The width unit of the item.
                    'itemlengthvalue' => '', // The length value of the item.
                    'itemlengthunit' => '', // The length unit of the item.
                    'itemurl' => '', // URL for the item.
                    'itemcategory' => '', // Must be one of the following values:  Digital, Physical
                    'ebayitemnumber' => '', // Auction item number.  
                    'ebayitemauctiontxnid' => '', // Auction transaction ID number.  
                    'ebayitemorderid' => '', // Auction order ID number.
                    'ebayitemcartid' => ''      // The unique identifier provided by eBay for this order from the buyer. These parameters must be ordered sequentially beginning with 0 (for example L_EBAYITEMCARTID0, L_EBAYITEMCARTID1). Character length: 255 single-byte characters
                );
                array_push($PaymentOrderItems, $Item);

                // Now we've got our OrderItems for this individual payment, 
                // so we'll load them into the $Payment array
                $Payment['order_items'] = $PaymentOrderItems;

                // Now we add the current $Payment array into the $Payments array collection
                array_push($Payments, $Payment);

                $BuyerDetails = array(
                    'buyerid' => '', // The unique identifier provided by eBay for this buyer.  The value may or may not be the same as the username.  In the case of eBay, it is different.  Char max 255.
                    'buyerusername' => '', // The username of the marketplace site.
                    'buyerregistrationdate' => '' // The registration of the buyer with the marketplace.
                );

                // For shipping options we create an array of all shipping choices similar to how order items works.
                $ShippingOptions = array();
                $Option = array(
                    'l_shippingoptionisdefault' => '', // Shipping option.  Required if specifying the Callback URL.  true or false.  Must be only 1 default!
                    'l_shippingoptionname' => '', // Shipping option name.  Required if specifying the Callback URL.  50 character max.
                    'l_shippingoptionlabel' => '', // Shipping option label.  Required if specifying the Callback URL.  50 character max.
                    'l_shippingoptionamount' => ''      // Shipping option amount.  Required if specifying the Callback URL.  
                );
                array_push($ShippingOptions, $Option);

                // For billing agreements we create an array similar to working with 
                // payments, order items, and shipping options.	
                $BillingAgreements = array();
                $Item = array(
                    'l_billingtype' => '', // Required.  Type of billing agreement.  For recurring payments it must be RecurringPayments.  You can specify up to ten billing agreements.  For reference transactions, this field must be either:  MerchantInitiatedBilling, or MerchantInitiatedBillingSingleSource
                    'l_billingagreementdescription' => '', // Required for recurring payments.  Description of goods or services associated with the billing agreement.  
                    'l_paymenttype' => '', // Specifies the type of PayPal payment you require for the billing agreement.  Any or IntantOnly
                    'l_billingagreementcustom' => ''     // Custom annotation field for your own use.  256 char max.
                );
                array_push($BillingAgreements, $Item);

                $PayPalRequestData = array(
                    'SECFields' => $SECFields,
                    'SurveyChoices' => $SurveyChoices,
                    'Payments' => $Payments,
                    'BuyerDetails' => $BuyerDetails,
                    'ShippingOptions' => $ShippingOptions,
                    'BillingAgreements' => $BillingAgreements
                );

                $PayPalResult = $this->paypal_pro->SetExpressCheckout($PayPalRequestData);

                if (!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK'])) {

                    $data->respnsemessage = $PayPalResult['ERRORS'][0]['L_LONGMESSAGE'];
                    $this->load->view('templates/header');
                    $this->load->view('booking/process_request', $data);
                    $this->load->view('templates/footer');
                } else {
                    ?>

                    <script type="text/javascript">
                        <!--
                        window.location = "<?= $PayPalResult['REDIRECTURL'] ?>"
                        //-->
                    </script>
                    <?php
                }
            }
        } else {
            redirect('/');
        }
    }

    function Get_express_checkout_details($token) {
        $PayPalResult = $this->paypal_pro->GetExpressCheckoutDetails($token);

        if (!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK'])) {
            return $PayPalResult['ERRORS'][0]['L_LONGMESSAGE'];
        } else {
            return $PayPalResult;
        }
    }

    function Do_express_checkout_payment($response) {

        $DECPFields = array(
            'token' => $response['TOKEN'], // Required.  A timestamped token, the value of which was returned by a previous SetExpressCheckout call.
            'payerid' => $response['PAYERID'], // Required.  Unique PayPal customer id of the payer.  Returned by GetExpressCheckoutDetails, or if you used SKIPDETAILS it's returned in the URL back to your RETURNURL.
            'returnfmfdetails' => '', // Flag to indiciate whether you want the results returned by Fraud Management Filters or not.  1 or 0.
            'giftmessage' => '', // The gift message entered by the buyer on the PayPal Review page.  150 char max.
            'giftreceiptenable' => '', // Pass true if a gift receipt was selected by the buyer on the PayPal Review page. Otherwise pass false.
            'giftwrapname' => '', // The gift wrap name only if the gift option on the PayPal Review page was selected by the buyer.
            'giftwrapamount' => '', // The amount only if the gift option on the PayPal Review page was selected by the buyer.
            'buyermarketingemail' => '', // The buyer email address opted in by the buyer on the PayPal Review page.
            'surveyquestion' => '', // The survey question on the PayPal Review page.  50 char max.
            'surveychoiceselected' => '', // The survey response selected by the buyer on the PayPal Review page.  15 char max.
            'allowedpaymentmethod' => ''     // The payment method type. Specify the value InstantPaymentOnly.
        );

        // You can now utlize parallel payments (split payments) within Express Checkout.
        // Here we'll gather all the payment data for each payment included in this checkout 
        // and pass them into a $Payments array.  
        // Keep in mind that each payment will ahve its own set of OrderItems
        // so don't get confused along the way.	

        $Payments = array();
        $Payment = array(
            'amt' => $response['AMT'], // Required.  The total cost of the transaction to the customer.  If shipping cost and tax charges are known, include them in this value.  If not, this value should be the current sub-total of the order.
            'currencycode' => $response['CURRENCYCODE'], // A three-character currency code.  Default is USD.
            'itemamt' => $response['ITEMAMT'], // Required if you specify itemized L_AMT fields. Sum of cost of all items in this order.  
            'shippingamt' => $response['SHIPPINGAMT'], // Total shipping costs for this order.  If you specify SHIPPINGAMT you mut also specify a value for ITEMAMT.
            'shipdiscamt' => '', // Shipping discount for this order, specified as a negative number.
            'insuranceoptionoffered' => '', // If true, the insurance drop-down on the PayPal review page displays the string 'Yes' and the insurance amount.  If true, the total shipping insurance for this order must be a positive number.
            'handlingamt' => $response['HANDLINGAMT'], // Total handling costs for this order.  If you specify HANDLINGAMT you mut also specify a value for ITEMAMT.
            'taxamt' => $response['TAXAMT'], // Required if you specify itemized L_TAXAMT fields.  Sum of all tax items in this order. 
            'desc' => $response['DESC'], // Description of items on the order.  127 char max.
            'custom' => '', // Free-form field for your own use.  256 char max.
            'invnum' => '', // Your own invoice or tracking number.  127 char max.
            'notifyurl' => '', // URL for receiving Instant Payment Notifications
            'shiptoname' => '', // Required if shipping is included.  Person's name associated with this address.  32 char max.
            'shiptostreet' => '', // Required if shipping is included.  First street address.  100 char max.
            'shiptostreet2' => '', // Second street address.  100 char max.
            'shiptocity' => '', // Required if shipping is included.  Name of city.  40 char max.
            'shiptostate' => '', // Required if shipping is included.  Name of state or province.  40 char max.
            'shiptozip' => '', // Required if shipping is included.  Postal code of shipping address.  20 char max.
            'shiptocountrycode' => '', // Required if shipping is included.  Country code of shipping address.  2 char max.
            'shiptophonenum' => '', // Phone number for shipping address.  20 char max.
            'notetext' => '', // Note to the merchant.  255 char max.  
            'allowedpaymentmethod' => '', // The payment method type.  Specify the value InstantPaymentOnly.
            'paymentaction' => 'Authorization', // How you want to obtain the payment.  When implementing parallel payments, this field is required and must be set to Order. 
            'paymentrequestid' => '', // A unique identifier of the specific payment request, which is required for parallel payments. 
            'sellerid' => '', // The unique non-changing identifier for the seller at the marketplace site.  This ID is not displayed.
            'sellerusername' => '', // The current name of the seller or business at the marketplace site.  This name be shown to the buyer.
            'sellerregistrationdate' => '', // Date when the seller registered with the marketplace.
            'softdescriptor' => '', // A per transaction description of the payment that is passed to the buyer's credit card statement.
            'transactionid' => ''     // Tranaction identification number of the tranasction that was created.  NOTE:  This field is only returned after a successful transaction for DoExpressCheckout has occurred. 
        );

        // For order items you populate a nested array with multiple $Item arrays.  
        // Normally you'll be looping through cart items to populate the $Item array
        // Then push it into the $OrderItems array at the end of each loop for an entire 
        // collection of all items in $OrderItems.

        $PaymentOrderItems = array();

        // Now we've got our OrderItems for this individual payment, 
        // so we'll load them into the $Payment array
        $Payment['order_items'] = $PaymentOrderItems;

        // Now we add the current $Payment array into the $Payments array collection
        array_push($Payments, $Payment);

        $UserSelectedOptions = array(
            'shippingcalculationmode' => '', // Describes how the options that were presented to the user were determined.  values are:  API - Callback   or   API - Flatrate.
            'insuranceoptionselected' => '', // The Yes/No option that you chose for insurance.
            'shippingoptionisdefault' => '', // Is true if the buyer chose the default shipping option.  
            'shippingoptionamount' => '', // The shipping amount that was chosen by the buyer.
            'shippingoptionname' => '', // Is true if the buyer chose the default shipping option...??  Maybe this is supposed to show the name..??
        );

        $PayPalRequestData = array(
            'DECPFields' => $DECPFields,
            'Payments' => $Payments,
            'UserSelectedOptions' => $UserSelectedOptions
        );

        $PayPalResult = $this->paypal_pro->DoExpressCheckoutPayment($PayPalRequestData);

        if (!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK'])) {
            $errors = $PayPalResult['ERRORS'][0]['L_LONGMESSAGE'];
            return false;
        } else {
            return true;
        }
    }

    function success() {

        if ($this->input->get('token')) {

            $this->load->library('paypal/Paypal_pro');

            add_css(array('light.css', 'owl.carousel.css', 'jquery.mb.YTPlayer.min.css', 'style.css', 'demo.css', 'set2.css'));
            add_js(array('jquery.slimscroll.min.js', 'owl.carousel.min.js', 'general.js', 'parallax.min.js', 'jquery.nicescroll.js', 'jquery.ui.touch-punch.min.js', 'jquery.mb.YTPlayer.min.js', 'SmoothScroll.js', 'script.js'));


            $data = new stdClass();
            $data->topmenu = "session_topmenu";

            $message = 'Some thing wrong!';

            $response = $this->Get_express_checkout_details($this->input->get('token'));
            if ($response['CHECKOUTSTATUS'] == 'PaymentActionNotInitiated' && $response['ACK'] == 'Success') {
                if ($this->Do_express_checkout_payment($response)) {
                    $final_response = $this->Get_express_checkout_details($response['TOKEN']);
                    if ($final_response['CHECKOUTSTATUS'] == 'PaymentActionCompleted' && isset($final_response['PAYMENTREQUEST_0_TRANSACTIONID'])) {

                        $session_data = $this->session->userdata('logged_in');
                        $guest_id = $session_data['id'];

                        $booking_cart = $this->session->userdata('booking_cart');


                        $MessageData = array(
                            'receiver_id' => $booking_cart['host_id'],
                            'sender_id' => $guest_id,
                            'type' => 'Reservation',
                            'message' => 'You have receive reservation request',
                            'listing_id' => $booking_cart['listing_id'],
                            'check_in' => date('Y-m-d', strtotime($booking_cart['check_in'])),
                            'check_out' => date('Y-m-d', strtotime($booking_cart['check_out'])),
                            'guest' => $booking_cart['total_guest'],
                            'read_status' => 0,
                        );

                        $booking_cart['guest_id'] = $guest_id;
                        $booking_cart['token'] = $final_response['TOKEN'];
                        $booking_cart['transaction_through'] = 'paypal';
                        $booking_cart['transaction_id'] = $final_response['PAYMENTREQUEST_0_TRANSACTIONID'];
                        $booking_cart['status'] = 'pending';
                        $this->session->set_userdata('booking_cart', $booking_cart);
                        $booking_cart = $this->session->userdata('booking_cart');

                        $booking = $this->Booking_model->booking($booking_cart);

                        if ($booking) {
                            $message = '<p>You have successfully book listing. Please wait for approval from property host.</p>';
                            SendDefaultMessage($guest_id, 'Book Listing', 'You have successfully book listing. Please wait for approval from property host', 'Book Listing');
                            
                           // SendDefaultMessage($guest_id, 'Request to Book Sent', 'You have successfully sent a request to book <strong>'.$listing_details['listing_name'].'<strong> in '.$listing_details['city_town'].' for the dates of '.$session_data['check_in'].' through '.$session_data['check_out'].PHP_EOL.'.The host is currently reviewing this request and will let you know soon if this will be possible.
                               // In the meantime, feel free to take a look at other properties in <a href="'.base_url().'search?location='.$session_data['city_town'].'">'.$session_data['city_town'].'</a>'.PHP_EOL.'If you have any further questions, please let our Support Team know by using our <a href="'.base_url().'contact">Contact Form</a>.', 'Book Listing');

                            SendDefaultMessage($booking_cart['host_id'], 'Reservation Request', 'You have receive reservation request. Please visit website to approve/reject request', 'Reservation Request');
                            $this->Inbox_model->send_message($MessageData);
                        } else {
                            $message = '<p>Something wrong! Please contact to support with Order Code</p>';
                        }
                    }
                }
            }

            //Title and meta description
            $this->seo->SetValues('Title', 'Book rental property for your Vacation - stayluxus');

            $data->respnsemessage = $message;
            $this->load->view('templates/header');
            $this->load->view('booking/process_request', $data);
            $this->load->view('templates/footer');
        } else {
            redirect("/");
        }
    }

    function reservation_requests($bid = NULL, $message = NULL) {

        if ($this->session->userdata('logged_in')) {

            //Add Js/Css
            add_css(array('light.css'));
            add_js(array('jquery.slimscroll.min.js', 'dashboard.js'));

            // create the data object
            $data = new stdClass();
            $session_data = $this->session->userdata('logged_in');
            $host_id = $session_data['id'];

            $data->message = $message;

            $this->seo->SetValues('Title', 'Guest Reservation Requests - stayluxus');

            if ($bid) {


                $data->reservation = $this->Booking_model->reservation_request($host_id, $bid);

                $this->load->view('templates/header');
                $this->load->view('booking/reservation_detail', $data);
                $this->load->view('templates/footer');
            } else {

                $data->reservations = $this->Booking_model->reservation_requests($host_id);

                $this->load->view('templates/header');
                $this->load->view('booking/reservation_requests', $data);
                $this->load->view('templates/footer');
            }
        } else {
            redirect('/');
        }
    }

    function approve($bid = NULL) {
        $this->load->model('Users_model');

        if ($this->session->userdata('logged_in') && $bid) {
            $session_data = $this->session->userdata('logged_in');
            $keyExhangeInfo = $this->input->post('keyExhangeInfo');
            if ($this->Booking_model->update_reservation_status($bid, $session_data['id'], array('status' => 'approved', 'key_exchange' => $keyExhangeInfo))) {

                $booking = $this->Booking_model->get_booking($bid);

                $message = '';

                if ($booking->transaction_through == 'card') {


                    $this->load->library('stripe/Stripe');
                    $stripe = new Stripe();


                    try {
                        $stripe->captureCharge($booking->transaction_id);


                        //Send message
                        $MessageData = array(
                            'receiver_id' => $booking->guest_id,
                            'sender_id' => $booking->host_id,
                            'type' => 'Reservation',
                            'message' => 'You reservation request approved by host',
                            'listing_id' => $booking->lid,
                            'check_in' => date('Y-m-d', strtotime($booking->check_in)),
                            'check_out' => date('Y-m-d', strtotime($booking->check_out)),
                            'guest' => $booking->total_guest,
                            'read_status' => 0,
                        );

                        $this->Inbox_model->send_message($MessageData);

                        //Store record in trasnsection
                        //Guest credit card data 
                        $guest_credit_data = array(
                            'booking_id' => $bid,
                            'user_id' => $booking->guest_id,
                            'transaction_type' => 'Credit',
                            'description' => 'Payment Credit through card for listing "' . $booking->listing_name . '" and listing ID: ' . $booking->lid . ' Check-in:' . $booking->check_in . ' & Check-out ' . $booking->check_out,
                            'amount' => $booking->total_charges,
                            'status' => 'ok',
                            'process_date' => date('Y-m-d')
                        );
                        $this->Booking_model->transaction($guest_credit_data);

                        //Guest booking data 
                        $guest_debit_data = array(
                            'booking_id' => $bid,
                            'user_id' => $booking->guest_id,
                            'transaction_type' => 'Debit',
                            'description' => 'Payment Debit for listing "' . $booking->listing_name . '" and listing ID: ' . $booking->lid . ' Check-in:' . $booking->check_in . ' & Check-out ' . $booking->check_out,
                            'amount' => $booking->total_charges,
                            'status' => 'ok',
                            'process_date' => date('Y-m-d')
                        );
                        $this->Booking_model->transaction($guest_debit_data);

                        //Host booking Credit data

                        $host_credit_data = array(
                            'booking_id' => $bid,
                            'user_id' => $booking->host_id,
                            'transaction_type' => 'Credit',
                            'description' => 'Payment Credit for listing name "' . $booking->listing_name . '" and listing ID: ' . $booking->lid . ' Check-in:' . $booking->check_in . ' & Check-out ' . $booking->check_out,
                            'amount' => $booking->listing_charges,
                            'status' => 'pending',
                            'process_date' => date('Y-m-d', strtotime("+7 day", strtotime($booking->check_out)))
                        );

                        $this->Booking_model->transaction($host_credit_data);

                        //Host booking Debit data for service fee

                        $host_debit_data = array(
                            'booking_id' => $bid,
                            'user_id' => $booking->host_id,
                            'transaction_type' => 'Debit',
                            'description' => 'Payment Debit as a Service fee for listing name "' . $booking->listing_name . '" and listing ID: ' . $booking->lid . ' Check-in:' . $booking->check_in . ' & Check-out ' . $booking->check_out,
                            'amount' => $booking->listing_charges * 0.05,
                            'status' => 'pending',
                            'process_date' => date('Y-m-d', strtotime("+7 day", strtotime($booking->check_out)))
                        );

                        $this->Booking_model->transaction($host_debit_data);

                        //Admin booking Credit data for service fee                   
                        $owner_credit_data = array(
                            'booking_id' => $bid,
                            'user_id' => 1, //For admin
                            'transaction_type' => 'Credit',
                            'description' => 'Payment Credit as a serrvice fee from Guest for listing name "' . $booking->listing_name . '" and listing ID: ' . $booking->lid . ' Check-in:' . $booking->check_in . ' & Check-out ' . $booking->check_out,
                            'amount' => $booking->services_charges,
                            'status' => 'ok',
                            'process_date' => date('Y-m-d')
                        );

                        $this->Booking_model->transaction($owner_credit_data);

                        //Admin booking Credit data for service fee                   
                        $owner_credit_data = array(
                            'booking_id' => $bid,
                            'user_id' => 1, //For admin
                            'transaction_type' => 'Credit',
                            'description' => 'Payment Credit as a serrvice fee from HOST for listing name "' . $booking->listing_name . '" and listing ID: ' . $booking->lid . ' Check-in:' . $booking->check_in . ' & Check-out ' . $booking->check_out,
                            'amount' => $booking->listing_charges * 0.05,
                            'status' => 'ok',
                            'process_date' => date('Y-m-d')
                        );

                        $this->Booking_model->transaction($owner_credit_data);
                        $this->reservation_requests('', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>You Have approved listing successfully</div>');
                        


                        $listing = $this->Listings_model->get_list($booking->lid);
                        $listing_link = '<a href="'.site_url('booking/detail/'.$listing->slug.'').'" target="_blank">'.$listing->listing_name.'</a>';
                        $user = $this->Users_model->get_user($booking->guest_id);
                        $user_host = $this->Users_model->get_user($booking->host_id);
                        $guest_profile = '<a href="'.site_url('users/show/'.$user->id.'').'" target="_blank">'.$user->first_name. ' ' .$user->last_name.'</a>';
                        


                        $is_new_user = $this->Booking_model->isNewUser($booking->host_id);

                        if($is_new_user == 0 OR $is_new_user == FALSE){

                        SendDefaultMessage($booking->host_id, 'Your First Listing  has been Approved', 'Congratulations! You have been approved to list your first property on the exclusive Luxus network.
                        Here are your property details:<br />
                        <strong>Property Information</strong><br />
                        <strong>Listing Name</strong>: '.$listing->listing_name.'<br />
                        <strong>Address:</strong>: '.$listing->full_address.'<br />
                        <strong>Price:</strong>: '.$listing->price.'<br />
                        <strong>key exchange information:</strong>: '.$listing->additional_note.'<br />
                        <strong>Available From:</strong>: '.$listing->available_from.'<br />
                        <strong>Available To:</strong>: '.$listing->available_to.'<br />
                        If you need to edit any of this information, you can log into your <a href="'.base_url().'dashboard">account</a>  and edit. Keep in mind, editing some information may cause the listing to go back into <a href="'.base_url().'page/faqs">review<a/>.
                        <br /> Please read through our Terms & Conditions  and Host Expectations  once again to be fully prepared for being a host.<br /> 
                        We are very excited to have you join us and be part of making hospitality reach the Luxus standard.<br /> ' , 'Congratulation');


                        }





                        SendDefaultMessage($booking->guest_id, 'Request to Book Approved', 'Congratulations! '.$user_host->first_name. ' ' .$user_host->last_name.' has accepted your request to book <strong>'.$booking->listing_name.'</strong> in '.$booking->city_town.' for the dates of '.$booking->check_in.' through '.$booking->check_out.'<br /> Below is your reservation information: <br />
                        <a href="'.base_url().'booking/reservation-requests">Reservation Information</a> You can also find this information by logging into your account by clicking here <a href="'.base_url().'booking/dashboard">Dashboard</a>.<br />Enjoy your stay! <br />', 'Congratulation');

                        SendDefaultMessage($booking->host_id, 'Booking Confirmed', 'You Have approved your ('.$listing_link.') successfully to '.$guest_profile.'', 'Congratulation');
                    
                    } catch (Exception $e) {

                        $body = $e->getJsonBody();

                        $err = $body['error'];
                        if (isset($err['type']) && $err['type'] != NULL) {
                            $message .= '<p>Type is: ' . $err['type'] . "</p>";
                        } if (isset($err['param']) && $err['param'] != NULL) {
                            $message .= '<p>Param is: ' . $err['param'] . "</p>";
                        } if (isset($err['message']) && $err['message'] != NULL) {
                            $message .= '<p>Error message: ' . $err['message'] . "</p>";
                        }
                        $this->Booking_model->final_update_reservation_status($bid, $session_data['id'], 'issue'); //RevertReservation Requests status
                        $this->reservation_requests('', $message);
                    }
                } else if ($booking->transaction_through == 'WorldPay') { //WorldPay
                    $this->load->library('worldpay/Worldpay');
                    $worldpay = new Worldpay();


                    try {
                        $worldpay->captureAuthorisedOrder($booking->transaction_id, $booking->total_charges * 100);


                        //Send message
                        $MessageData = array(
                            'receiver_id' => $booking->guest_id,
                            'sender_id' => $booking->host_id,
                            'type' => 'Reservation',
                            'message' => 'You reservation request approved by host',
                            'listing_id' => $booking->lid,
                            'check_in' => date('Y-m-d', strtotime($booking->check_in)),
                            'check_out' => date('Y-m-d', strtotime($booking->check_out)),
                            'guest' => $booking->total_guest,
                            'read_status' => 0,
                        );

                        $this->Inbox_model->send_message($MessageData);

                        //Store record in trasnsection
                        //Guest credit card data 
                        $guest_credit_data = array(
                            'booking_id' => $bid,
                            'user_id' => $booking->guest_id,
                            'transaction_type' => 'Credit',
                            'description' => 'Payment Credit through card for listing "' . $booking->listing_name . '" and listing ID: ' . $booking->lid . ' Check-in:' . $booking->check_in . ' & Check-out ' . $booking->check_out,
                            'amount' => $booking->total_charges,
                            'status' => 'ok',
                            'process_date' => date('Y-m-d')
                        );
                        $this->Booking_model->transaction($guest_credit_data);

                        //Guest booking data 
                        $guest_debit_data = array(
                            'booking_id' => $bid,
                            'user_id' => $booking->guest_id,
                            'transaction_type' => 'Debit',
                            'description' => 'Payment Debit for listing "' . $booking->listing_name . '" and listing ID: ' . $booking->lid . ' Check-in:' . $booking->check_in . ' & Check-out ' . $booking->check_out,
                            'amount' => $booking->total_charges,
                            'status' => 'ok',
                            'process_date' => date('Y-m-d')
                        );
                        $this->Booking_model->transaction($guest_debit_data);

                        //Host booking Credit data

                        $host_credit_data = array(
                            'booking_id' => $bid,
                            'user_id' => $booking->host_id,
                            'transaction_type' => 'Credit',
                            'description' => 'Payment Credit for listing name "' . $booking->listing_name . '" and listing ID: ' . $booking->lid . ' Check-in:' . $booking->check_in . ' & Check-out ' . $booking->check_out,
                            'amount' => $booking->listing_charges,
                            'status' => 'pending',
                            'process_date' => date('Y-m-d', strtotime("+7 day", strtotime($booking->check_out)))
                        );

                        $this->Booking_model->transaction($host_credit_data);

                        //Host booking Debit data for service fee

                        $host_debit_data = array(
                            'booking_id' => $bid,
                            'user_id' => $booking->host_id,
                            'transaction_type' => 'Debit',
                            'description' => 'Payment Debit as a Service fee for listing name "' . $booking->listing_name . '" and listing ID: ' . $booking->lid . ' Check-in:' . $booking->check_in . ' & Check-out ' . $booking->check_out,
                            'amount' => $booking->listing_charges * 0.05,
                            'status' => 'pending',
                            'process_date' => date('Y-m-d', strtotime("+7 day", strtotime($booking->check_out)))
                        );

                        $this->Booking_model->transaction($host_debit_data);

                        //Admin booking Credit data for service fee                   
                        $owner_credit_data = array(
                            'booking_id' => $bid,
                            'user_id' => 1, //For admin
                            'transaction_type' => 'Credit',
                            'description' => 'Payment Credit as a serrvice fee from Guest for listing name "' . $booking->listing_name . '" and listing ID: ' . $booking->lid . ' Check-in:' . $booking->check_in . ' & Check-out ' . $booking->check_out,
                            'amount' => $booking->services_charges,
                            'status' => 'ok',
                            'process_date' => date('Y-m-d')
                        );

                        $this->Booking_model->transaction($owner_credit_data);

                        //Admin booking Credit data for service fee                   
                        $owner_credit_data = array(
                            'booking_id' => $bid,
                            'user_id' => 1, //For admin
                            'transaction_type' => 'Credit',
                            'description' => 'Payment Credit as a serrvice fee from HOST for listing name "' . $booking->listing_name . '" and listing ID: ' . $booking->lid . ' Check-in:' . $booking->check_in . ' & Check-out ' . $booking->check_out,
                            'amount' => $booking->listing_charges * 0.05,
                            'status' => 'ok',
                            'process_date' => date('Y-m-d')
                        );

                        $this->Booking_model->transaction($owner_credit_data);

                        $this->reservation_requests('', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>You Have approved listing successfully</div>');

                        SendDefaultMessage($booking->guest_id, 'Booking Confirmed', 'Your Reservation request approved successfully from host', 'Congratulation');
                        SendDefaultMessage($booking->host_id, 'Booking Confirmed', 'You Have approved listing successfully', 'Congratulation');
                    } catch (WorldpayException $e) {
                        $message .= '<p>Error code: ' . $e->getCustomCode() . '</p>';
                        $message .= '<p>Error: ' . $e->getMessage() . '</p>';
                        $this->Booking_model->final_update_reservation_status($bid, $session_data['id'], 'issue'); //Revert status
                        $this->reservation_requests('', $message);
                    }
                } else if ($booking->transaction_through == 'paypal') {

                    $this->load->library('paypal/Paypal_pro');


                    $DCFields = array(
                        'authorizationid' => $booking->transaction_id, // Required. The authorization identification number of the payment you want to capture. This is the transaction ID returned from DoExpressCheckoutPayment or DoDirectPayment.
                        'amt' => $booking->total_charges, // Required. Must have two decimal places.  Decimal separator must be a period (.) and optional thousands separator must be a comma (,)
                        'completetype' => 'Complete', // Required.  The value Complete indiciates that this is the last capture you intend to make.  The value NotComplete indicates that you intend to make additional captures.
                        'currencycode' => 'USD', // Three-character currency code
                        'invnum' => '', // Your invoice number
                        'note' => '', // Informational note about this setlement that is displayed to the buyer in an email and in his transaction history.  255 character max.
                        'softdescriptor' => '', // Per transaction description of the payment that is passed to the customer's credit card statement.
                        'storeid' => '', // ID of the merchant store.  This field is required for point-of-sale transactions.  Max: 50 char
                        'terminalid' => ''      // ID of the terminal.  50 char max.  
                    );

                    $PayPalRequestData = array('DCFields' => $DCFields);
                    $PayPalResult = $this->paypal_pro->DoCapture($PayPalRequestData);

                    if (!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK'])) {
                        $this->Booking_model->final_update_reservation_status($bid, $session_data['id'], 'issue'); //Revert status
                        $this->reservation_requests('', '<h3>' . $PayPalResult['ERRORS'][0]['L_LONGMESSAGE'] . '</h3>');
                    } else {


                        //Send message
                        $MessageData = array(
                            'receiver_id' => $booking->guest_id,
                            'sender_id' => $booking->host_id,
                            'type' => 'Reservation',
                            'message' => 'You reservation request approved by host',
                            'listing_id' => $booking->lid,
                            'check_in' => date('Y-m-d', strtotime($booking->check_in)),
                            'check_out' => date('Y-m-d', strtotime($booking->check_out)),
                            'guest' => $booking->total_guest,
                            'read_status' => 0,
                        );

                        $this->Inbox_model->send_message($MessageData);

                        //Store record in trasnsection
                        //Guest credit card data 
                        $guest_credit_data = array(
                            'booking_id' => $bid,
                            'user_id' => $booking->guest_id,
                            'transaction_type' => 'Credit',
                            'description' => 'Payment Credit through PayPal for listing "' . $booking->listing_name . '" and listing ID: ' . $booking->lid . ' Check-in:' . $booking->check_in . ' & Check-out ' . $booking->check_out,
                            'amount' => $booking->total_charges,
                            'status' => 'ok',
                            'process_date' => date('Y-m-d')
                        );
                        $this->Booking_model->transaction($guest_credit_data);

                        //Guest booking data 
                        $guest_debit_data = array(
                            'booking_id' => $bid,
                            'user_id' => $booking->guest_id,
                            'transaction_type' => 'Debit',
                            'description' => 'Payment Debit for listing "' . $booking->listing_name . '" and listing ID: ' . $booking->lid . ' Check-in:' . $booking->check_in . ' & Check-out ' . $booking->check_out,
                            'amount' => $booking->total_charges,
                            'status' => 'ok',
                            'process_date' => date('Y-m-d')
                        );
                        $this->Booking_model->transaction($guest_debit_data);

                        //Host booking Credit data

                        $host_credit_data = array(
                            'booking_id' => $bid,
                            'user_id' => $booking->host_id,
                            'transaction_type' => 'Credit',
                            'description' => 'Payment Credit for listing name "' . $booking->listing_name . '" and listing ID: ' . $booking->lid . ' Check-in:' . $booking->check_in . ' & Check-out ' . $booking->check_out,
                            'amount' => $booking->listing_charges,
                            'status' => 'pending',
                            'process_date' => date('Y-m-d', strtotime("+7 day", strtotime($booking->check_out)))
                        );

                        $this->Booking_model->transaction($host_credit_data);

                        //Host booking Debit data for service fee

                        $host_debit_data = array(
                            'booking_id' => $bid,
                            'user_id' => $booking->host_id,
                            'transaction_type' => 'Debit',
                            'description' => 'Payment Debit as a Service fee for listing name "' . $booking->listing_name . '" and listing ID: ' . $booking->lid . ' Check-in:' . $booking->check_in . ' & Check-out ' . $booking->check_out,
                            'amount' => $booking->listing_charges * 0.05,
                            'status' => 'pending',
                            'process_date' => date('Y-m-d', strtotime("+7 day", strtotime($booking->check_out)))
                        );

                        $this->Booking_model->transaction($host_debit_data);

                        //Admin booking Credit data for service fee                   
                        $owner_credit_data = array(
                            'booking_id' => $bid,
                            'user_id' => 1, //For admin
                            'transaction_type' => 'Credit',
                            'description' => 'Payment Credit as a serrvice fee from Guest for listing name "' . $booking->listing_name . '" and listing ID: ' . $booking->lid . ' Check-in:' . $booking->check_in . ' & Check-out ' . $booking->check_out,
                            'amount' => $booking->services_charges,
                            'status' => 'ok',
                            'process_date' => date('Y-m-d')
                        );

                        $this->Booking_model->transaction($owner_credit_data);

                        //Admin booking Credit data for service fee                   
                        $owner_credit_data = array(
                            'booking_id' => $bid,
                            'user_id' => 1, //For admin
                            'transaction_type' => 'Credit',
                            'description' => 'Payment Credit as a serrvice fee from HOST for listing name "' . $booking->listing_name . '" and listing ID: ' . $booking->lid . ' Check-in:' . $booking->check_in . ' & Check-out ' . $booking->check_out,
                            'amount' => $booking->listing_charges * 0.05,
                            'status' => 'ok',
                            'process_date' => date('Y-m-d')
                        );

                        $this->Booking_model->transaction($owner_credit_data);

                        $this->reservation_requests('', '<h3>Your listing approved for living guest successfully</h3>');
                        SendDefaultMessage($booking->guest_id, 'Booking Confirmed', 'Your Reservation request approved successfully from host', 'Congratulation');
                        SendDefaultMessage($booking->host_id, 'Booking Confirmed', 'You Have approved listing successfully', 'Congratulation');
                    }
                }
            } else {
                $this->reservation_requests('', '<h3>Some thing wrong! please try again</h3>');
            }
        } else {
            redirect('/');
        }
    }

    function reject($bid = NULL) {

        if ($this->session->userdata('logged_in') && $bid) {
            $session_data = $this->session->userdata('logged_in');
            if ($this->Booking_model->update_reservation_status($bid, $session_data['id'], array('status' => 'cancel'))) {

                $booking = $this->Booking_model->get_booking($bid);

                $message = '';

                //Send message
                $MessageData = array(
                    'receiver_id' => $booking->guest_id,
                    'sender_id' => $booking->host_id,
                    'type' => 'Reservation',
                    'message' => 'You reservation request Reject by host',
                    'listing_id' => $booking->lid,
                    'check_in' => date('Y-m-d', strtotime($booking->check_in)),
                    'check_out' => date('Y-m-d', strtotime($booking->check_out)),
                    'guest' => $booking->total_guest,
                    'read_status' => 0,
                );

                $this->Inbox_model->send_message($MessageData);

                if ($booking->transaction_through == 'card') {

                    $this->load->library('stripe/Stripe');
                    $stripe = new Stripe();
                    $booking = $this->Booking_model->get_booking($bid);

                    try {
                        $stripe->addRefund($booking->transaction_id);
                        $this->reservation_requests('', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>You Have Reject listing successfully</div>');
                        SendDefaultMessage($booking->guest_id, 'Booking Rejected', 'Your Reservation request Rejected from host', 'Sorry!');
                        SendDefaultMessage($booking->host_id, 'Booking Rejected', 'You Have Reject listing ', 'Sorry!');
                    } catch (Exception $e) {

                        $body = $e->getJsonBody();

                        $err = $body['error'];
                        if (isset($err['type']) && $err['type'] != NULL) {
                            $message .= '<p>Type is: ' . $err['type'] . "</p>";
                        } if (isset($err['param']) && $err['param'] != NULL) {
                            $message .= '<p>Param is: ' . $err['param'] . "</p>";
                        } if (isset($err['message']) && $err['message'] != NULL) {
                            $message .= '<p>Error message: ' . $err['message'] . "</p>";
                        }
                        $this->reservation_requests('', $message);
                    }
                } else if ($booking->transaction_through == 'worldpay') { //worldpay
                    $this->load->library('worldpay/Worldpay');
                    $worldpay = new Worldpay();
                    $booking = $this->Booking_model->get_booking($bid);

                    try {
                        $worldpay->cancelAuthorisedOrder($booking->transaction_id);
                        $this->reservation_requests('', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>You Have Reject listing successfully</div>');
                        SendDefaultMessage($booking->guest_id, 'Booking Rejected', 'Your Reservation request Rejected from host', 'Sorry!');
                        SendDefaultMessage($booking->host_id, 'Booking Rejected', 'You Have Reject listing ', 'Sorry!');
                    } catch (WorldpayException $e) {
                        $message .= '<p>Error code: ' . $e->getCustomCode() . '</p>';
                        $message .= '<p>Error: ' . $e->getMessage() . '</p>';
                        $this->reservation_requests('', $message);
                    }
                } else if ($booking->transaction_through == 'paypal') {

                    $this->load->library('paypal/Paypal_pro');

                    $DVFields = array(
                        'authorizationid' => $booking->transaction_id, // Required.  The value of the original authorization ID returned by PayPal.  NOTE:  If voiding a transaction that has been reauthorized, use the ID from the original authorization, not the reauth.
                        'note' => 'Cancel By Host', // An information note about this void that is displayed to the payer in an email and in his transaction history.  255 char max.
                        'msgsubid' => ''      // A message ID used for idempotence to uniquely identify a message.
                    );

                    $PayPalRequestData = array('DVFields' => $DVFields);
                    $PayPalResult = $this->paypal_pro->DoVoid($PayPalRequestData);

                    if (!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK'])) {

                        $this->reservation_requests('', '<h3>' . $PayPalResult['ERRORS'][0]['L_LONGMESSAGE'] . '</h3>');
                    } else {
                        $this->reservation_requests('', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>You Have Reject listing successfully</div>');
                        SendDefaultMessage($booking->guest_id, 'Booking Rejected', 'Your Reservation request Rejected from host', 'Sorry!');
                        SendDefaultMessage($booking->host_id, 'Booking Rejected', 'You Have Reject listing ', 'Sorry!');
                    }
                }
            } else {
                $this->reservation_requests('', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Some thing wrong! please try again</div>');
            }
        } else {
            redirect('/');
        }
    }

    public function ApproveModel() {

        // load form helper and validation library
        $this->load->helper('form');
        $this->load->library('form_validation');

        $bid = $this->input->post('bid');
        $session_data = $this->session->userdata('logged_in');
        $data = new stdClass;
        $data->booking = $this->Booking_model->reservation_request($session_data['id'], $bid);
        $this->load->view('booking/approvemodel', $data);
    }

}