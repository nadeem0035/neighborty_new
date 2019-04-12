<?php
$xcrud = Xcrud::get_instance();
$xcrud->table('packages');

echo $xcrud->render();
?>