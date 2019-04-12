<?php
$xcrud = Xcrud::get_instance();
$xcrud->table('premium_packages');
$xcrud->order_by('id','desc');

echo $xcrud->render();
?>