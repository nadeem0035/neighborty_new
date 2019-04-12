<?php
$xcrud = Xcrud::get_instance();
$xcrud->table('reservation');
$xcrud->relation('user_id', 'users', 'id',array('first_name','last_name'));
$xcrud->label('user_id', 'User Name');
$xcrud->relation('listing_id', 'listing', 'id',array('listing_name'));
$xcrud->label('listing_id', 'Listing Name');
$xcrud->disabled('user_id,listing_id');
echo $xcrud->render();
?>