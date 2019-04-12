<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <div class="table-responsive">
    <table class="table table-striped table-advance table-hover">
        <thead>
        <tr>
            <th><strong><?=$this->lang->line('user');?></strong></th>
            <th><strong><?=$this->lang->line('message');?></strong></th>
            <th><strong><?=$this->lang->line('property_name');?></strong></th>
            <th><strong><?=$this->lang->line('date_hour');?></strong></th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($messages) {
            foreach ($messages as $message) {?>
                <tr class="view-appointment" data-messageid="<?= $message->id; ?>">
                    <td valign="middle">
                        <img class="img-circle" src="<?=get_user_avatar($message->picture,'small');?>" alt="<?= $message->first_name . ' ' . $message->last_name; ?>" height="22" width="22" style="margin-right:5px;">
                        <span class="hidden-xs"><?= $message->first_name . " " . $message->last_name; ?></span>
                    </td>
                    <td><?= substr(strip_tags($message->message), 0, 40); ?></td>
                    <td><?= substr(strip_tags($message->listing_name), 0, 30); ?></td>
                    <td><?= relative_time($message->date_time); ?></td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='4' align='middle'>No messages here</td></tr>";
        }
        ?>
        </tbody>
    </table>
    </div>
<?php
die();
?>