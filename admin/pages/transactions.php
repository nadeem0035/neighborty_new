<?php
$xcrud = Xcrud::get_instance();
$xcrud->table('transaction');
$xcrud->relation('user_id', 'users', 'id',array('first_name','last_name'));
$xcrud->relation('booking_id', 'booking', 'id',array('check_in','check_out'),null,null,null,' --TO-- ');
$xcrud->label('booking_id', 'Booking Duration');
$xcrud->columns('user_id,booking_id,transaction_type,description,amount,process_date,status');
$xcrud->label('user_id', 'Host Name');
$xcrud->label('transaction_type', 'Trans');

echo $xcrud->render();
?>