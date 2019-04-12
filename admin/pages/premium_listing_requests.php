<?php
$xcrud = Xcrud::get_instance();
$xcrud->table('premium_requests');

$xcrud->relation('user_id', 'users', 'id',array('first_name','last_name'));
$xcrud->relation('package_id', 'premium_packages', 'id',array('name','duration'));
$xcrud->relation('listing_id', 'listing', 'id',array('title'));

$xcrud->label('user_id', 'User');
$xcrud->label('package_id', 'Package');
$xcrud->label('listing_id', 'Listing Name');


$xcrud->columns('user_id,package_id,listing_id,start_date,end_date,status');

$xcrud->highlight_row('end_date', '=', '0000-00-00', '#fcf8e3');
$xcrud->highlight_row('end_date', '>=', date('Y-m-d'), '#dff0d8');




$xcrud->order_by('id','desc');

echo $xcrud->render();
?>