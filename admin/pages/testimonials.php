<?php
$xcrud = Xcrud::get_instance();
$xcrud->table('testimonials');
$xcrud->relation('user_id', 'users', 'id',array('first_name','last_name'));
$xcrud->relation('listing_id', 'listing', 'id',array('listing_name','home_type'));

echo $xcrud->render();
?>