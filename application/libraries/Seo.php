<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Seo {

    private $title = NULL;    // Contains the cURL response for debug
    private $description = NULL;     // Contains the cURL handler for a session
    private $og_img = NULL;
    function __construct() {
        $this->set_defaults();
    }

    private function set_defaults() {
        $this->title = 'The most complete real estate platform in Pakistan';
        $this->keywords =  'The most complete real estate platform in Pakistan';
        $this->description = 'Apartment for rent, Rent apartment, house, find house for sale, find real estate agent, go real estate agent, build your rental record, buy a house or apartment';
        $this->og_img = 'https://zoney.pk/assets/img/n-200x200.png';
        $this->Address = 'Lahore,Pakistan';
    }

    function SetValues($type, $data) {

        if ($type == 'Title') {
            $this->title = $data;
           // $this->title = 'Neighborty: Real Estate, Apartments, Buy & Rent';
        }
        if ($type == 'Keywords') {
            $this->keywords = $data;
            //$this->description = 'Rent unique accommodations from local hosts in 190+ countries. Feel at home anywhere you go in the world with Neighborty';
        }

        if ($type == 'Description') {
            $this->description = $data;
            //$this->description = 'Rent unique accommodations from local hosts in 190+ countries. Feel at home anywhere you go in the world with Neighborty';
        }
        if ($type == 'OgImg') {
            $this->og_img = $data;
        }
        if ($type == 'Address') {
            $this->Address = $data;
        }

    }

    function GetValues($type) {


        if ($type == 'Title') {
            return $this->title;
        }
        if ($type == 'Keywords') {
            return $this->keywords;
        }
        if ($type == 'Description') {
            return strip_tags($this->description);
        }
        if ($type == 'OgImg') {
            return $this->og_img;
        }
        if ($type == 'Address') {
            return $this->Address;
        }
    }

}
