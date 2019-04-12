<?php
$xcrud = Xcrud::get_instance();
$xcrud->table('inquiries');
$xcrud->columns('message', true);

echo $xcrud->render();
?>