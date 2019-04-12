<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<table class="table table-striped table-advance table-hover">
    <thead>
    <tr>
        <th><strong>Utilisateur</strong></th>
        <th><strong>Message</strong></th>
        <th><strong>Nom de la propriété</strong></th>
        <th><strong>Date et heure</strong></th>
    </tr>
    </thead>
    <tbody>
        <?php
        if( $messages )
        {
            foreach ($messages as $message)
            {
                if( $message->read_status == 0 )
                {
                    $class = 'unread';
                }
                else
                {
                    $class = '';
                }
                ?>
                <tr class="view-archived <?= $class ?>" data-messageid="<?= $message->id; ?>">

                    <td valign="middle">
                        <img class="img-circle" src="<?=get_user_avatar($message->picture,'small');?>" alt="User image" height="22" width="22" style="margin-right:5px;">
                        <span class="hidden-xs"><?= $message->first_name . " " . $message->last_name; ?></span>
                    </td>
                    <td><?= substr(strip_tags($message->message), 0, 40); ?></td>
                    <td><?= substr(strip_tags($message->listing_name), 0, 30); ?></td>
                    <td class="text-right"><?= relative_time($message->date_time); ?></td>
                </tr>

                <?php
            }
        }
        else
        {
            echo "<tr><td colspan='4' align='middle'>No messages here</td></tr>";
        }
        ?>

    </tbody>
</table>

<?php
die();
?>