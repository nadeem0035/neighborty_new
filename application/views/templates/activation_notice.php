<div class="clearfix"></div>
<?php if($_SESSION['logged_in']['active'] == 0) { ?>
    <div class="alert alert-warning" style="margin-bottom: 0">
        <strong><?=$this->lang->line('warning');?>!</strong> <?=$this->lang->line('warning_massage');?>
    </div>
<?php } ?>