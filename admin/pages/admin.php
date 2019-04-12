<?php

$xcrud = Xcrud::get_instance();
$xcrud->table('admin');
$xcrud->change_type('password', 'password', 'md5', 8);
$xcrud->validation_required('email')->validation_required('password');
$xcrud->validation_pattern('email', 'email');

//$xcrud->unset_remove();
echo $xcrud->render();
?>