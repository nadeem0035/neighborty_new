<?php
$xcrud = Xcrud::get_instance();
$xcrud->table('user_ads');
$xcrud->relation('user_id', 'ad_requests', 'id',array('name','phone'));
$xcrud->label('user_id', 'User Name');
$xcrud->order_by('id','desc');
$xcrud->validation_required(array('user_id','banner_type','start_date','end_date','image','status'));
$xcrud->columns('id,user_id,banner_type,start_date,end_date,image');

$xcrud->highlight_row('end_date', '>', date('Y-m-d'), '#dff0d8');
$xcrud->highlight_row('end_date', '<', date('Y-m-d'), '#f2dede');


$xcrud->change_type('image', 'image', false, array(
   // 'width' => 290,
   // 'height' => 150,
   // 'crop' => true,
    'path' => '../../assets/media/ads'));

echo $xcrud->render();
?>
