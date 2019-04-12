<?php
$xcrud = Xcrud::get_instance();
$xcrud->table('booking');
$xcrud->relation('host_id', 'users', 'id',array('first_name','last_name'));
$xcrud->relation('guest_id', 'users', 'id',array('first_name','last_name'));
$xcrud->relation('listing_id', 'listing', 'id',array('listing_name'));
$xcrud->label('guest_id', 'Guest Name');
$xcrud->label('host_id', 'Host Name');
$xcrud->label('listing_id', 'Listing');

$xcrud->columns('host_id,guest_id,listing_id,check_in,check_out,stay_nights,total_guest,total_charges,status,book_date');

echo $xcrud->render();
?>