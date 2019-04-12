<?php
$xcrud = Xcrud::get_instance();
$xcrud->table('top_inspiration');
$xcrud->change_type('thumb_img', 'image', false, array(
    'width' => 290,
    'height' => 150,
	'crop' => true,
    'path' => '../../assets/media/inspirations/thumbs'));

$xcrud->change_type('large_img', 'image', false, array(
    'width' => 600,
    'height' => 665,
    'path' => '../../assets/media/inspirations/'));

echo $xcrud->render();
?>