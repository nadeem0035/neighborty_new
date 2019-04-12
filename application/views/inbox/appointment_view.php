<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$session_data = $this->session->userdata('logged_in');
?>
    <div class="inbox-view-info">
        <div class="row">
            <div class="col-md-7">
                <img src='<?=get_user_avatar($message->picture,'small');?>' class="img-circle" alt="<?= $message->first_name . " " . $message->last_name; ?>" height="30px" width="30px">
                <span class="bold">
                <?= $message->first_name . " " . $message->last_name; ?> (<?=relative_time($message->date_time); ?>)</span>
                <!--
            <span class="bold"> To </span>
            <img  src="<?=get_user_avatar($session_data['picture'],'small');?>" class="img-circle" height="30px" width="30px">
            -->

            </div>
            <div class="col-md-5 inbox-info-btn">
                <div class="btn-group">
                    <button data-messageid="<?= $message->id; ?>" class="btn blue reply-btn">
                        <i class="fa fa-reply"></i> Reply </button>
                </div>
            </div>
        </div>
    </div>
    <div class="inbox-view">
        <p><?= strip_tags($message->message) ?> </p>
    </div>

<?php
die();
?>