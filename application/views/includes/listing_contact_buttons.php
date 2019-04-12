<?php if($list->property_type == 'rent') { ?>

  <?php if ($this->session->userdata('logged_in')) { ?>
     <a href="javascript:void(0)" data-toggle="modal" data-target="#apply" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Apply</a>
  <?php } else { ?>
     <a href="<?= site_url("users/login/")?>" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Apply</a>
  <?php } ?>

<?php } ?>

<?php if ($this->session->userdata('logged_in')) { ?>

    <a href="javascript:void(0)" data-toggle="modal" data-target="#set-appointment" class="btn btn-sm btn-primary"><i class="fa fa-calendar"></i> Set Appointment</a>

<?php } else { ?>

    <a href="<?= site_url("users/login/")?>"  class="btn btn-sm btn-primary"><i class="fa fa-calendar"></i> Set Appointment</a>

<?php } ?>