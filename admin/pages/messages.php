<?php
$xcrud = Xcrud::get_instance();
$xcrud->table('messages');
$xcrud->where('type =', 'Inbox');
$xcrud->columns('type', true);
$xcrud->fields('type', true);
$xcrud->relation('sender_id', 'users', 'id',array('first_name','last_name'));
$xcrud->label('sender_id', 'Message From');
$xcrud->relation('receiver_id', 'users', 'id',array('first_name','last_name'));
$xcrud->label('receiver_id', 'Message To');
$xcrud->relation('listing_id', 'listing', 'id',array('listing_name'));
$xcrud->label('listing_id', 'Listing Name');
//$xcrud->disabled('sender_id,receiver_id,listing_id');
echo $xcrud->render();
?>