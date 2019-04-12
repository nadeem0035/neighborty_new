<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<table class="table table-striped table-advance table-hover">
    <tbody>
        <?php
        if ($messages) {
            foreach ($messages as $message) {
                if ($message->read_status == 0) {
                    echo $class = 'unread';
                } else {
                    echo $class = '';
                }
                ?>
                <tr class="<?= $class ?>" data-messageid="<?= $message->id; ?>">
                    <td class="inbox-small-cells">
                        <input type="checkbox" class="mail-checkbox">
                    </td>

                    <td class="view-message hidden-xs">
                        <?= $message->first_name . " " . $message->last_name; ?>
                    </td>
                    <td class="view-message ">
                        <?= substr($message->message, 0, 40); ?>
                    </td>

                    <td class="view-message ">
                        <?= $message->listing_name; ?>
                    </td>

                    <td class="view-message text-right">
                        <?= $message->date_time; ?>
                    </td>
                </tr>

                <?php
            }
        } else {
            echo "<tr>No Record Found</tr>";
        }
        ?>

    </tbody>
</table>

<?php
die();
?>