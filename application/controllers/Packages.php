<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User class.
 *
 * @extends CI_Controller
 */
class Packages extends CI_Controller {

    /**
     * __construct function.
     *
     * @access public
     * @return void
     */


    public function __construct() {

        parent::__construct();
        $this->load->model('Listings_model', 'listing', true);
        $this->load->model('Packages_model', 'package', true);
        $this->load->model('Common_model','common',true);
        $this->load->model('Booking_model');
    }

    function index() {
        $data['topmenu'] = "topmenu";
        if ($this->session->userdata('logged_in')) {
            $data['topmenu'] = "session_topmenu";
        }


        add_js(array('jquery.validate.min.js', 'general.js'));
        // add_js(array('jquery.slimscroll.min.js','jquery.validate.min.js','general.js','share.js'));


        $select = "id,name,slug,description,status,price,button_text,link,highlight,tags";
        $data['packages'] = $this->common->getAllContent($select,'packages');

        // $data['home_types'] = $this->listing->home_types_search();
        // $data['amenities']  = $this->listing->amenities();

        $this->load->view('templates/header');
        $this->load->view('front_end/package', $data);
        $this->load->view('templates/footer');

    }

    function confirm_package($slug) {


        $data = new stdClass();
        $data->topmenu = "topmenu";

        $this->load->helper('form');
        $this->load->library('form_validation');

        if ($this->session->userdata('logged_in')) {

            $data->topmenu = "session_topmenu";
        }

        $this->seo->SetValues('Title', 'Vacation rentals, private rooms, sublets by the night - Accommodations on Neighborty');
        $this->seo->SetValues('Description', "Browse and book, or list your space. It's easy!");

        add_js(array('payment_general.js'));
        //set_extra_js("Stripe.setPublishableKey('pk_test_pRhbcL9pGd4YqDj5GTdZ8W5l');");
        $custom = '$("input[type=\'radio\']").click(function(){ var val = $(this).attr("value");if(val == "paypal"){ ;$("#stripe_box").fadeOut("slow");}else{$("#stripe_box").fadeIn("slow")}});';
        set_extra_js($custom);

        $data->packages = $this->package->GetPublishPackage($slug);
        $this->load->view('templates/header');
        $this->load->view('front_end/packages_payments', $data);
        $this->load->view('templates/footer');

    }

    function initiate_payment()
    {


require FCPATH.'vendor/square/connect/autoload.php';
        # Replace these values. You probably want to start with your Sandbox credentials
# to start: https://docs.connect.squareup.com/articles/using-sandbox/

# The access token to use in all Connect API requests. Use your *sandbox* access
# token if you're just testing things out.
        $access_token = 'sandbox-sq0atb-UEJukiIzizt8Bow_8KrHOQ';

# Helps ensure this code has been reached via form submission
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            error_log("Received a non-POST request");
            echo "Request not allowed";
            http_response_code(405);
            return;
        }

# Fail if the card form didn't send a value for `nonce` to the server
        $nonce = $_POST['nonce'];
        if (is_null($nonce)) {
            echo "Invalid card data";
            http_response_code(422);
            return;
        }

        \SquareConnect\Configuration::getDefaultConfiguration()->setAccessToken($access_token);
        $locations_api = new \SquareConnect\Api\LocationsApi();

        try {
            $locations = $locations_api->listLocations();
            # We look for a location that can process payments
            $location = current(array_filter($locations->getLocations(), function($location) {
                $capabilities = $location->getCapabilities();
                return is_array($capabilities) &&
                    in_array('CREDIT_CARD_PROCESSING', $capabilities);
            }));

        } catch (\SquareConnect\ApiException $e) {
            echo "Caught exception!<br/>";
            print_r("<strong>Response body:</strong><br/>");
            echo "<pre>"; var_dump($e->getResponseBody()); echo "</pre>";
            echo "<br/><strong>Response headers:</strong><br/>";
            echo "<pre>"; var_dump($e->getResponseHeaders()); echo "</pre>";
            exit(1);
        }

        $transactions_api = new \SquareConnect\Api\TransactionsApi();

# To learn more about splitting transactions with additional recipients,
# see the Transactions API documentation on our [developer site]
# (https://docs.connect.squareup.com/payments/transactions/overview#mpt-overview).
        $request_body = array (

            "card_nonce" => $nonce,

            # Monetary amounts are specified in the smallest unit of the applicable currency.
            # This amount is in cents. It's also hard-coded for $1.00, which isn't very useful.
            "amount_money" => array (
                "amount" => 100,
                "currency" => "USD"
            ),

            # Every payment you process with the SDK must have a unique idempotency key.
            # If you're unsure whether a particular payment succeeded, you can reattempt
            # it with the same idempotency key without worrying about double charging
            # the buyer.
            "idempotency_key" => uniqid()
        );

# The SDK throws an exception if a Connect endpoint responds with anything besides
# a 200-level HTTP code. This block catches any exceptions that occur from the request.
        try {
            $result = $transactions_api->charge($location->getId(), $request_body);
            echo "<pre>";
            print_r($result);
            echo "</pre>";
        } catch (\SquareConnect\ApiException $e) {
            echo "Caught exception!<br/>";
            print_r("<strong>Response body:</strong><br/>");
            echo "<pre>"; var_dump($e->getResponseBody()); echo "</pre>";
            echo "<br/><strong>Response headers:</strong><br/>";
            echo "<pre>"; var_dump($e->getResponseHeaders()); echo "</pre>";
        }
    }

    function process_payment()
    {

        if ($this->session->userdata('logged_in')) {
            $data = new stdClass();
            $id = $this->input->post('package_id');
            $slug = $this->input->post('package');
            $data->packages = $this->package->GetPublishPackage($slug);

           // echo '<pre>';print_r($data->packages);
            $package_id =  $data->packages->id;
            $price =  $data->packages->price;
            $session_array = array(
                'package_id' => $package_id,
                'purchased_at' => date('Y-m-d H:i:s'),
                'total_charges' => $price,
                'message'=>$this->input->post('message')
            );

            $this->session->set_userdata('package_cart', $session_array);


            $data = new stdClass();
            $data->topmenu = "session_topmenu";

            $this->seo->SetValues('Title', 'Book your package - Neighborty');

            if ($this->input->post('payment_type') == 'stripe') {

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
                $slug = $this->input->post('package');
                $package = $this->package->GetPublishPackage($slug);

                $data->stripe = '';



                $stripe_data = array(
                    'amount' => $package->price * 100,
                    "currency" => "EUR",
                    "card" => $token, // array('exp_month' => '02', 'exp_year' => '2016', 'number' => '4111111111111111', 'object' => 'card', 'cvc' => '123'),
                    'capture' => false,
                    "description" => $this->input->post('package'),
                );

                try {


                    $charge = $stripe->addCharge($stripe_data);


                    //pre($charge);

                    if ($charge->paid == true && $charge->status == 'succeeded') {

                        $package_cart['user_id'] = $guest_id;
                        $package_cart['token'] = $token;
                        $package_cart['transaction_through'] = 'card';
                        $package_cart['message'] = $guest_message;
                        $package_cart['transaction_id'] = $charge->id;
                        $package_cart['status'] = 'pending';
                        $package_cart['total_charges'] = $package->price * 100;
                        $package_cart['package_id'] = $package_id;
                        $package_cart['package_type'] = 'package';
                        $this->session->set_userdata('package_cart', $package_cart);
                        $package_cart = $this->session->userdata('package_cart');

                        $booking = $this->Booking_model->booking($package_cart);
                       // $data->listing = $this->Listings_model->get_list( $booking_cart['listing_id']);
                        $resul = $this->common->get_row('package_stats','agent_id',$guest_id);

                        if($resul->featured == '' && $resul->list == '' ){
                            $res = $this->common->get_row('package_detail','package_id',$package_id);
                            $data_array = array(
                                'package_id' => $package_id,
                                'agent_id' => $guest_id,
                                //'featured' => $res->featured_available,
                                'avilable_listings' => $res->availble_listings,
                                'transaction_id'=> $charge->id
                            );
                            $res = $this->Booking_model->add_pack_stat($data_array);
                            if($res){
                                true;
                            }else{
                                false;
                            }
                        }else {
                            $resul = $this->common->get_row('package_stats','agent_id',$guest_id);
                            $res = $this->common->get_row('package_detail','package_id',$package_id);
                            $data_array = array(
                                'package_id' => $package_id,
                                //'featured' => $res->featured_available + $resul->featured,
                                'avilable_listings' => $res->availble_listings + $resul->avilable_listings,
                                'transaction_id'=> $charge->id
                            );
                            $res = $this->Booking_model->update_package_stat($data_array,$guest_id);
                            if($res){
                                true;
                            }else{
                                false;
                            }

                        }


                        if ($booking) {
                            $session_data = $this->session->userdata('logged_in');
                            $user_data = array();
                            $user_data['package_name'] = $this->input->post('package');
                            $user_data['receiver_name'] = $session_data['first_name']. ' ' .$session_data['last_name'];
                            $user_data['url'] = site_url('packages');
                            $to = $session_data['email'];
                            $subject = 'Package purchased';
                            $view = 'package-purchased';
                            sendEmail($to, $subject, $user_data, $view);

                            $message .= '<p>Vous avez réservé votre forfait avec succès. Veuillez attendre l\'approbation de l\'administrateur.</p>';
                            //Send mail
                            //
                           // SendDefaultMessage($guest_id, 'Request to Book Sent', 'You have successfully sent a request to book <strong>'.$data->listing->listing_name.'</strong> in '.$data->listing->city_town.' for the dates of '.$booking_cart['check_in'].' through '.$booking_cart['check_out']. '<br />The host is currently reviewing this request and will let you know soon if this will be possible.
                          //      In the meantime, feel free to take a look at other properties in <a href="'.base_url().'search?location='.$data->listing->city_town.'">'.$data->listing->city_town.'</a> <br />If you have any further questions, please let our Support Team know by using our <a href="'.base_url().'contact">Contact Form</a>.', 'Book Listing');

                            //SendDefaultMessage($guest_id, 'Book Listing', 'You have successfully book listing. Please wait for approval from property host', 'Book Listing');
                         //   SendDefaultMessage($booking_cart['host_id'], 'Reservation Request', 'You have receive reservation request. Please visit website to approve/reject request', 'Reservation Request');
                        //    $this->Inbox_model->send_message($MessageData);
                        } else {
                            $message .= '<p>Quelque chose ne va pas! S\'il vous plaît contacter pour soutenir avec le code de commande</p>';
                        }
                    }


                    else { // Charge was not paid!
                        $message .= 'Your payment could NOT be processed (i.e., you have not been charged) because the payment system rejected the transaction. You can try again or use another card.';
                        if (isset($charge->failure_message) && $charge->failure_message != NULL) {
                            $message .= $charge->failure_message;
                        }
                    }
                } catch (Exception $e) {
                    // Exception with Stripe's API failed

                    $body = $e->getJsonBody();

                    $err = $body['error'];

                    echo '<pre>';print_r($err);
                    if (isset($err['type']) && $err['type'] != NULL) {
                        $message .= '<p>Type is: ' . $err['type'] . "</p>";
                    } if (isset($err['param']) && $err['param'] != NULL) {
                        $message .= '<p>Param is: ' . $err['param'] . "</p>";
                    } if (isset($err['message']) && $err['message'] != NULL) {
                        $message .= '<p>Error message: ' . $err['message'] . "</p>";
                    }
                }






            }
            else if ($this->input->post('payment_type') == 'worldpay') {

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
                            $message .= '<p>Vous avez une liste de livres réussie. Veuillez attendre l\'approbation de l\'hôte de la propriété.</p>';
                            //Send mail
                            SendDefaultMessage($guest_id, 'Book Listing', 'You have successfully book listing. Please wait for approval from property host', 'Book Listing');
                            SendDefaultMessage($booking_cart['host_id'], 'Reservation Request', 'You have receive reservation request. Please visit website to approve/reject request', 'Reservation Request');
                            $this->Inbox_model->send_message($MessageData);
                        } else {
                            $message .= '<p>Quelque chose ne va pas! S\'il vous plaît contacter pour soutenir avec le code de commande</p>';
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
            }
            else if ($this->input->post('payment_type') == 'paypal') {

                $this->load->library('paypal/Paypal_pro');

                $session_data = $this->session->userdata('logged_in');
                $agent_id = $session_data['id'];
                $package_cart = $this->session->userdata('package_cart');
                $guest_message = $this->input->post('message');
                $orderdescription = $this->input->post('package');
                $package_cart['message'] = $guest_message;
                $this->session->set_userdata('package_cart', $package_cart);
                $package_cart = $this->session->userdata('package_cart');

                $invice_id = "G" . $agent_id  . "L" . $package_cart['package_id'] . "I" .$package_cart['purchased_at']; // Order code of your choice

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
                    'amt' => $package_cart['total_charges'], // Required.  The total cost of the transaction to the customer.  If shipping cost and tax charges are known, include them in this value.  If not, this value should be the current sub-total of the order.
                    'currencycode' => 'USD', // A three-character currency code.  Default is USD.
                  //  'itemamt' => $booking_cart['listing_charges'], // Required if you specify itemized L_AMT fields. Sum of cost of all items in this order.
                  //  'shippingamt' => $booking_cart['cleanse_charges'], // Total shipping costs for this order.  If you specify SHIPPINGAMT you mut also specify a value for ITEMAMT.
                    'shipdiscamt' => '', // Shipping discount for this order, specified as a negative number.
                    'insuranceoptionoffered' => '', // If true, the insurance drop-down on the PayPal review page displays the string 'Yes' and the insurance amount.  If true, the total shipping insurance for this order must be a positive number.
               //     'handlingamt' => $booking_cart['services_charges'], // Total handling costs for this order.  If you specify HANDLINGAMT you mut also specify a value for ITEMAMT.
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
                    'amt' => $package_cart['total_charges'], // Cost of item.
                   // 'number' => $package_cart['package_id'], // Item number.  127 char max.
                   // 'qty' => '1', // Item qty on order.  Any positive integer.
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
                }
                else {


                   /* $package_cart['user_id'] = $agent_id;
                   // $package_cart['token'] = $token;
                    $package_cart['transaction_through'] = 'paypal';
                    $package_cart['message'] = $guest_message;
                   // $package_cart['transaction_id'] = $charge->id;
                    $package_cart['status'] = 'pending';
                    $package_cart['total_charges'] = $package_cart['total_charges'];
                    $package_cart['package_id'] = $package_cart['package_id'];
                    $package_cart['package_type'] = 'package';
                    $this->session->set_userdata('package_cart', $package_cart);
                    $package_cart = $this->session->userdata('package_cart');

                    $booking = $this->Booking_model->booking($package_cart);*/


                  //  $paypalInfo = $this->input->get();
                  //  echo '<pre>';print_r($paypalInfo);die;

                    ?>

                    <script type="text/javascript">

                        <!--
                        window.location = "<?= $PayPalResult['REDIRECTURL'] ?>"
                        //-->
                    </script>
                    <?php
                }
            }

            $data->respnsemessage = $message;
            $this->load->view('templates/header');
            $this->load->view('booking/process_request', $data);
            $this->load->view('templates/footer');
        }
        else {
            redirect('/');
        }
    }

    function confirm_payment() {

        $data = new stdClass();
        $data->topmenu = "topmenu";
        $this->load->helper('form');
        $this->load->library('form_validation');

        if ($this->session->userdata('logged_in')) {

            $data->topmenu = "session_topmenu";
        }
        $amount = $this->input->post('amount');
        $this->seo->SetValues('Title', 'Vacation rentals, private rooms, sublets by the night - Accommodations on Neighborty');
        $this->seo->SetValues('Description', "Browse and book, or list your space. It's easy!");

        add_js(array('payment_general.js'));

        $data->price = $amount;

        $this->load->view('templates/header');
        $this->load->view('front_end/confirm_payment', $data);
        $this->load->view('templates/footer');

    }

    public function buyTopUp(){

        if ($this->session->userdata('logged_in')) {
            $data = new stdClass();
            $amount = $this->input->post('amount');
            $price =  $amount;
            $session_array = array(
                'purchased_at' => date('Y-m-d H:i:s'),
                'total_charges' => $price,
                'message'=>$this->input->post('message')
            );

            $this->session->set_userdata('package_cart', $session_array);
            $data = new stdClass();
            $data->topmenu = "session_topmenu";
            $this->seo->SetValues('Title', 'Purchase your topup - Neighborty');

            if ($this->input->post('payment_type') == 'stripe') {

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

                $stripe_data = array(
                    'amount' => $amount * 100,
                    "currency" => "EUR",
                    "card" => $token,
                    'capture' => true,
                    "description" => 'Credit purchased',
                );

                try {

                    $charge = $stripe->addCharge($stripe_data);

                    if ($charge->paid == true && $charge->status == 'succeeded') {

                        $package_cart['user_id'] = $guest_id;
                        $package_cart['token'] = $token;
                        $package_cart['transaction_through'] = 'card';
                        $package_cart['message'] = $guest_message;
                        $package_cart['transaction_id'] = $charge->id;
                        $package_cart['status'] = 'pending';
                        $package_cart['total_charges'] = $amount * 100;
                        $package_cart['package_type'] = 'topup';
                        $package_cart['brand'] = $charge->source->brand;
                        $package_cart['last4'] = $charge->source->last4;

                        $this->session->set_userdata('package_cart', $package_cart);
                        $package_cart = $this->session->userdata('package_cart');
                        $booking = $this->Booking_model->booking($package_cart);

                        $this->db->set('balance', 'balance+' . $amount, FALSE);
                        $this->db->where('agent_id', $guest_id);
                        $this->db->update('topup_balance');


                        if ($booking != false) {

                            $order_no = $booking;
                            $session_data = $this->session->userdata('logged_in');
                            $user_data = array();
                            $user_data['package_name'] = $this->input->post('package');
                            $user_data['receiver_name'] = $session_data['first_name'] . ' ' . $session_data['last_name'];
                            $user_data['url'] = site_url('packages');
                            $to = $session_data['email'];
                            $subject = 'Package purchased';
                            $view = 'topup_purchased';
                            sendEmail($to, $subject, $user_data, $view);


                            $message .= '<p>Nous vous confirmons votre achat de Rs' . $amount . ' de credit.</p>';
                            //Send mail
                            //
                            // SendDefaultMessage($guest_id, 'Request to Book Sent', 'You have successfully sent a request to book <strong>'.$data->listing->listing_name.'</strong> in '.$data->listing->city_town.' for the dates of '.$booking_cart['check_in'].' through '.$booking_cart['check_out']. '<br />The host is currently reviewing this request and will let you know soon if this will be possible.
                            //      In the meantime, feel free to take a look at other properties in <a href="'.base_url().'search?location='.$data->listing->city_town.'">'.$data->listing->city_town.'</a> <br />If you have any further questions, please let our Support Team know by using our <a href="'.base_url().'contact">Contact Form</a>.', 'Book Listing');

                            //SendDefaultMessage($guest_id, 'Book Listing', 'You have successfully book listing. Please wait for approval from property host', 'Book Listing');
                            //   SendDefaultMessage($booking_cart['host_id'], 'Reservation Request', 'You have receive reservation request. Please visit website to approve/reject request', 'Reservation Request');
                            //    $this->Inbox_model->send_message($MessageData);
                        } else {
                            $message .= '<p>Quelque chose ne va pas! S\'il vous plaît contacter pour soutenir avec le code de commande</p>';
                            $order_no = 0;
                        }


                    }
                    else { // Charge was not paid!
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






            }

            else if ($this->input->post('payment_type') == 'worldpay') {

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
            }

            else if ($this->input->post('payment_type') == 'paypal') {

                $this->load->library('paypal/Paypal_pro');

                $session_data = $this->session->userdata('logged_in');
                $agent_id = $session_data['id'];
                $package_cart = $this->session->userdata('package_cart');
                $guest_message = $this->input->post('message');
                $orderdescription = 'Purchase Credit';
                $package_cart['message'] = $guest_message;
                $this->session->set_userdata('package_cart', $package_cart);
                $package_cart = $this->session->userdata('package_cart');

                $invice_id = "G" . $agent_id  . "L" . $package_cart['package_id'] . "I" .$package_cart['purchased_at']; // Order code of your choice

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
                    'amt' => $package_cart['total_charges'], // Required.  The total cost of the transaction to the customer.  If shipping cost and tax charges are known, include them in this value.  If not, this value should be the current sub-total of the order.
                    'currencycode' => 'USD', // A three-character currency code.  Default is USD.
                    //  'itemamt' => $booking_cart['listing_charges'], // Required if you specify itemized L_AMT fields. Sum of cost of all items in this order.
                    //  'shippingamt' => $booking_cart['cleanse_charges'], // Total shipping costs for this order.  If you specify SHIPPINGAMT you mut also specify a value for ITEMAMT.
                    'shipdiscamt' => '', // Shipping discount for this order, specified as a negative number.
                    'insuranceoptionoffered' => '', // If true, the insurance drop-down on the PayPal review page displays the string 'Yes' and the insurance amount.  If true, the total shipping insurance for this order must be a positive number.
                    //     'handlingamt' => $booking_cart['services_charges'], // Total handling costs for this order.  If you specify HANDLINGAMT you mut also specify a value for ITEMAMT.
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
                    'amt' => $package_cart['total_charges'], // Cost of item.
                    // 'number' => $package_cart['package_id'], // Item number.  127 char max.
                    // 'qty' => '1', // Item qty on order.  Any positive integer.
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
                }
                else {

                    $this->db->set('balance', 'balance+'.$amount, FALSE);
                    $this->db->where('agent_id', $agent_id);
                    $this->db->update('topup_balance');

                    ?>

                    <script type="text/javascript">

                        <!--
                        window.location = "<?= $PayPalResult['REDIRECTURL'] ?>"
                        //-->
                    </script>
                    <?php
                }
            }

            $data->respnsemessage = $message;
            $data->order_no = string_padded_with_zero($order_no);
            $this->load->view('templates/header');
            $this->load->view('booking/process_request', $data);
            $this->load->view('templates/footer');
        }
        else {
            redirect('/');
        }


    }







}
