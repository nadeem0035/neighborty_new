<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Seo {

    private $title = NULL;    // Contains the cURL response for debug
    private $description = NULL;     // Contains the cURL handler for a session

    function __construct() {
        $this->set_defaults();
    }

    private function set_defaults() {
        $this->title = 'Vacation Rentals, Homes, Apartments & Rooms for Rent - Luxus';
        $this->description = 'Rent unique accommodations from local hosts in 190+ countries. Feel at home anywhere you go in the world with Luxus';
    }

    function SetValues($type, $data) {


        if ($type == 'Title') {
            $this->title = $data;
        }
        if ($type == 'Description') {
            $this->description = $data;
        }
    }

    function GetValues($type) {

        if ($type == 'Title') {
            return $this->title;
        }
        if ($type == 'Description') {
            return $this->description;
        }
    }

}
