<?php
$xcrud = Xcrud::get_instance();
$xcrud->table('ad_requests');
$xcrud->unset_add();
echo $xcrud->render();
?>
