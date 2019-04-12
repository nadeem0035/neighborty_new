<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<form class="form-horizontal" action="#" id="reply_compose" method="POST" enctype="multipart/form-data">

    <div class="inbox-form-group">
        <div class="controls-row">
            <textarea class="inbox-editor form-control" name="message" rows="12"></textarea>

        </div>
    </div>
    <input type="hidden" name="message_id" value="<?= $message_id ?>" />

    <div class="inbox-compose-btn">
        <button class="btn blue" type="button" id="send_reply"><i class="fa fa-check"></i>Send</button>

    </div>
</form>

<?php
die();
?>