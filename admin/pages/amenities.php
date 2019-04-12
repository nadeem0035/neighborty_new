<?php
$xcrud = Xcrud::get_instance();
$xcrud->table('amenities');
$xcrud->order_by('id','desc');
echo $xcrud->render();
?>