<?php
$xcrud = Xcrud::get_instance();
$xcrud->table('reviews');
$xcrud->relation('reviews_by', 'users', 'id',array('first_name','last_name'));
$xcrud->label('reviews_by', 'Reviews By');
$xcrud->relation('reviews_to', 'users', 'id',array('first_name','last_name'));
$xcrud->label('reviews_to', 'Reviews To');
$xcrud->relation('listing_id', 'listing', 'id',array('listing_name'));
$xcrud->label('listing_id', 'Listing Name');
//$xcrud->disabled('reviews_by,reviews_to,listing_id');
$xcrud->label('communication', 'Comm');
$xcrud->label('accuracy', 'Accu');
$xcrud->label('cleanliness', 'Clean');

echo $xcrud->render();
?>