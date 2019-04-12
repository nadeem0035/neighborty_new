<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script>
<?php
if (isset($MapsData) && $MapsData != NULL) {
    foreach ($MapsData as $MapData) {
        ?>
            TripsMaps(<?= $MapData['bid']; ?>, <?= $MapData['latitude']; ?>, <?= $MapData['longitude']; ?>);
        <?php
    }
}
?>
</script>
