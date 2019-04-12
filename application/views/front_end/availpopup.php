<?php

 /*$timefrom = array_shift(explode(':', $avail_time_from));*/
$time2= date("H:i", strtotime($avail_time_to));
$time= date("H:i", strtotime($avail_time_from));
$lastE = trim(substr($time, strpos($time, ':')));
/*$timeto = array_shift(explode(':', $time2));*/

    for($time =$time+0; $time < $time2; $time++){
        $timet = $time+1;


            echo '<div class="col-md-6">';
            echo date('h:i a', strtotime($time.$lastE)).' - ';
            echo date('h:i a', strtotime($timet.$lastE));
            echo '</div>';

    }

    ?>
