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
        if ($messages)
        {
            foreach ($messages as $message)
            {
                if ($message->read_status == 0)
                {
                    $class = 'unread';
                }
                else
                {
                    $class = '';
                }
                ?>

                <tr class="view-inbox <?= $class ?>" data-messageid="<?= $message->id; ?>">
                    <td valign="middle">
                            <img class="img-circle" src="<?=display_user_avatar($message->picture,'small');?>" alt="<?= $message->first_name . " " . $message->last_name; ?>" height="22" width="22" style="margin-right:5px;">
                        <span class="hidden-xs"><?= $message->first_name . " " . $message->last_name; ?></span>
                    </td>
                    <td><?= character_limiter(htmlspecialchars($message->message),30); ?></td>
                    <td><?= character_limiter(htmlspecialchars($message->listing_name),30); ?></td>
                    <td><?= relative_time($message->date_time); ?></td>
                </tr>

                <?php
            }
        }
        else
        {
            echo "<tr><td colspan='4' align='middle'>".$this->lang->line('no_message')."</td></tr>";
        }
        ?>

        </tbody>
    </table>
</div>
<?php
die();
?>