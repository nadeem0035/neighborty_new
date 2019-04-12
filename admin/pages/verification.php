<?php
$xcrud = Xcrud::get_instance();
$xcrud->table('trust_verification');
$xcrud->relation('user_id', 'users', 'id',array('first_name','last_name'));
$xcrud->label('user_id', 'User Name');
$xcrud->change_type('document', 'file', '', array('not_rename' => true, 'path' => '../../uploads'));
echo $xcrud->render();
?>