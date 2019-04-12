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
            'jquery.dop.FrontendBookingCalendarPRO.js'));



        	set_extra_js('var a = function(self){self.anchor.fancybox({openEffect:"elastic",closeEffect:"elastic"});};
			$("#pikame").PikaChoose({carousel:true,buildFinished:a});
		 
            $("#frontend").DOPFrontendBookingCalendarPRO({
                                "ID":' . $listing_id . ',
                                "loadURL": site_url + "listings/detail_existing_listing_calendar",
                                "sendURL": site_url + "listings/add_listing_calendar"
                            });');

        $data->listing = $this->common->get_row_with_specific_data("*", 'listing', 'id', (int) $listing_id);
        $data->userdetail = $this->common->get_row_with_specific_data("*", 'users', 'id', (int) $data->listing->user_id);
        $amenities = $this->Listings_model->get_list_amenities_name((int) $listing_id);
        if ($amenities) {
            $data->amenities = $amenities;
        }

        $pics = $this->Listings_model->get_list_images((int) $listing_id);
        if ($pics) {
            $data->pictures = $pics;
        }

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
            add_js(array('owl.carousel.min.js', 'general.js', 'parallax.min.js', 'jquery.nicescroll.js', 'jquery.ui.touch-punch.min.js', 'jquery.mb.YTPlayer.min.js', 'worldpay.js', 'worldpay_general.js', 'SmoothScroll.js', 'script.js'));

            $listing_id = $this->input->post('lid');

            $data->listing = $this->common->get_row_with_specific_data("*", 'listing', 'id', (int) $listing_id);
            $checkin = $this->input->post('DOPBCPCalendar-check-in');
            $checkout = $this->input->post('DOPBCPCalendar-check-out');
            $data->totalguests = $this->input->post('totalguests');
            $data->room_type = $this->input->post('room_type');
            $data->checkin = $checkin;
            $data->checkout = $checkout;

            $ac_data = $this->details_existing_listing_calendar($listing_id); // Get avaiable dates 
            $check_dates = date_range($checkin, $checkout); // Convert check-in , check-out into full days array

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

            if ($fullyExists) {

                $session_data = $this->session->userdata('logged_in');

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

                $this->load->view('templates/header');
                $this->load->view('booking/payments', $data);
                $this->load->view('templates/footer');
            } else { //If some one is cheating to system tthen return him back
                $this->session->set_flashdata('error', 'Some thing wrong please try again!');
                $slug = $this->input->post('slug');
                if ($slug) {
                    redirect("/booking/detail/$slug");
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
                        $already_dates = date_range($already_book->check_in, $already_book->check_out);
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

            $this->load->library('worldpay/Worldpay');

            add_css(array('light.css', 'owl.carousel.css', 'jquery.mb.YTPlayer.min.css', 'style.css', 'demo.css', 'set2.css'));
            add_js(array('jquery.slimscroll.min.js', 'owl.carousel.min.js', 'general.js', 'parallax.min.js', 'jquery.nicescroll.js', 'jquery.ui.touch-punch.min.js', 'jquery.mb.YTPlayer.min.js', 'SmoothScroll.js', 'script.js'));

            $data = new stdClass();
            $data->topmenu = "session_topmenu";


            // Initialise Worldpay class with your SERVICE KEY
            $worldpay = new Worldpay();

            $session_data = $this->session->userdata('logged_in');
            $guest_id = $session_data['id'];

            $token = $this->input->post('token');

            $name = $this->input->post('name');
            $guest_message = $this->input->post('message');
            $description = $this->input->post('description');
            $transaction_through = $this->input->post('transaction_through');

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
                    'orderDescription' => $description, // Order description of your choice
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

                    $booking = $this->Booking_model->booking($booking_cart);

                    if ($booking) {
                        $message .= '<p>You have successfully book listing. Please wait for approval from property host.</p>';
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
        } else {
            redirect('/');
        }
    }

    function reservation_requests($bid = NULL, $message = NULL) {

        if ($this->session->userdata('logged_in')) {

            //Add Js/Css
            add_css(array('light.css'));
            add_js(array('jquery.slimscroll.min.js'));

            // create the data object
            $data = new stdClass();
            $session_data = $this->session->userdata('logged_in');
            $host_id = $session_data['id'];

            $data->message = $message;

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

        if ($this->session->userdata('logged_in') && $bid) {
            $session_data = $this->session->userdata('logged_in');
            if ($this->Booking_model->update_reservation_status($bid, $session_data['id'], 'approved')) {

                $this->load->library('worldpay/Worldpay');
                $worldpay = new Worldpay();
                $booking = $this->Booking_model->get_booking($bid);

                try {
                    $worldpay->captureAuthorisedOrder($booking->transaction_id, $booking->total_charges * 100);


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

                    $this->reservation_requests('', '<h3>You Have approved listing successfully</h3>');
                } catch (WorldpayException $e) {
                    $message = '<p>Error code: ' . $e->getCustomCode() . '</p>';
                    $message .= '<p>Error: ' . $e->getMessage() . '</p>';
                    $this->reservation_requests('', $message);
                }
 