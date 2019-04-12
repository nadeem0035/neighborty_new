<?php

defined("BASEPATH") OR exit("No direct script access allowed");
?>
<?php

$events = array();
$color = array("#16a085", "#3498db", "#8e44ad", "#D2691E", "#191970", "#696969", "#00CED1", "#808080", "#708090", "#2E8B57", "#6A5ACD", "#2F4F4F", "#696969
", "#778899", "#556B2F", "#A0522D", "#DB7093", "#008B8B");

foreach ($listings as $listing) {
    $e = array();
    $e['id'] = $listing->lid;
    $e['title'] = ucfirst($listing->listing_name) . "  ( $" . $listing->total_charges . " )";
    $e['start'] = $listing->check_in;
    $e['end'] = $listing->check_out;
    $e['backgroundColor'] = $color[array_rand($color)];
    $e['url'] = site_url("listings/my-trips/" . $listing->bid);
    $e['allDay'] = "false";
    array_push($events, $e);
}
echo json_encode($events);
