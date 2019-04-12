<?php
$xcrud = Xcrud::get_instance();
$xcrud->table('press');
$xcrud->order_by('id','desc');
$xcrud->label('pr_img', 'Image');
$xcrud->change_type('pr_img', 'image', false, array(
    'not_rename' => true,
    'width' => 225,
    'path' => '../../assets/img'));
 
echo $xcrud->render();
?>