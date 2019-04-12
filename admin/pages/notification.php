<?php
$xcrud = Xcrud::get_instance();
$xcrud->table('notification');
$xcrud->relation('user_id', 'users', 'id',array('first_name','last_name'));
$xcrud->label('user_id', 'Notification For');
//$xcrud->disabled('sender_id,receiver_id,listing_id');
echo $xcrud->render();
?>