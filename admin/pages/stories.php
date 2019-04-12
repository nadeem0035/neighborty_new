<?php
$xcrud = Xcrud::get_instance();
$xcrud->table('stories');
 $xcrud->change_type('image', 'image', false, array(
    'width' => 350,
    'path' => '../../assets/media/stories'));

echo $xcrud->render();
?>