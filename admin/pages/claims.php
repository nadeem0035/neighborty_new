<?php
$xcrud = Xcrud::get_instance();
$xcrud->table('claims');
$xcrud->relation('agent_id', 'users', 'id',array('first_name','last_name'));
$xcrud->relation('listing_id', 'listing', 'id',array('listing_name'));
$xcrud->label('agent_id', 'Claimed Agent');
$xcrud->label('status', 'Is Claimed?');
$xcrud->highlight_row('status', '=', 1, '#8DED79');
$xcrud->columns('agent_id,phone,email,first_name,last_name,status,created_at');

echo $xcrud->render();
?>