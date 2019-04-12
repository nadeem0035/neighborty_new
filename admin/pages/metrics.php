<?php
$xcrud = Xcrud::get_instance();
$xcrud->table('countries_metrics');
//$xcrud->label('currency', 'Measurement Type');
//$xcrud->label('currency', 'Currency Type');
echo $xcrud->render();
?>