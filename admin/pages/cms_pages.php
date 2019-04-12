<?php
$xcrud = Xcrud::get_instance();
$xcrud->table('pages');
 
echo $xcrud->render();
?>