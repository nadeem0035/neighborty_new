<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<table class="table table-striped table-advance table-hover">
    <tbody>
        <?php
        if ($messages) {
            foreach ($messages as $message) {
                ?>
                <tr class="view-sent" data-messageid="<?= $message->id; ?>">


                    <td class="hidden-xs">
                        <?= $message->first_name . " " . $message->last_name; ?>
                    </td>
                    <td>
                        <?= substr(strip_tags($message->message), 0, 40); ?>
                    </td>

                    <td>
                        <?= substr(strip_tags($message->listing_name), 0, 30); ?>
                    </td>

                    <td>
                        <?= relative_time($message->date_time); ?>
                    </td>
                </tr>

                <?php
            }
        } else {
            echo "<tr>No messages here</tr>";
        }
        ?>

    </tbody>
</table>

<?php
die();
?>