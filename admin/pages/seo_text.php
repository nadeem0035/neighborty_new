<?php
$xcrud = Xcrud::get_instance();
$xcrud->table('seo_text');
$xcrud->order_by('id','desc');
echo $xcrud->render();
?>