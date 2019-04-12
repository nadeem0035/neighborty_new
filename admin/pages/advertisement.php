<?php
$xcrud = Xcrud::get_instance();
$xcrud->table('advertisements');
$xcrud->change_type('content', 'image', false, array(
    'not_rename' => true,
    'width' => 225,
    'path' => '../../assets/media/advertisement/'));
echo $xcrud->render();
?>