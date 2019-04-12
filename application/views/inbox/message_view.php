<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="inbox-header inbox-view-header">
    <h1 class="pull-left">New server for datacenter needed <a href="javascript:;">
            Inbox </a>
    </h1>
    <div class="pull-right">
        <i class="fa fa-print"></i>
    </div>
</div>
<div class="inbox-view-info">
    <div class="row">
        <div class="col-md-7">
            <img src="<?=display_user_avatar($message->picture,'small');?>">
            <span class="bold">
                <?= $message->first_name . " " . $message->last_name; ?></span>

            to <span class="bold">
                me </span>
            on <?= $message->date_time; ?>
        </div>
        <div class="col-md-5 inbox-info-btn">
            <div class="btn-group">
                <button data-messageid="23" class="btn blue reply-btn">
                    <i class="fa fa-reply"></i> Reply </button>
                <button class="btn blue dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu pull-right">
                    <li>
                        <a href="javascript:;" data-messageid="23" class="reply-btn">
                            <i class="fa fa-reply reply-btn"></i> Reply </a>
                    </li>
                    <li>
                        </div>
                        </div>
                        </div>
                        </div>
                        <div class="inbox-view">
                            <p><?= $message->message; ?> </p>
                        </div>


                        <?php
                        die();
                        ?>