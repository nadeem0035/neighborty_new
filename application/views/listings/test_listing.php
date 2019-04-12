<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Marker Clustering</title>
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>


<script type="text/javascript">
    <?php
    if(isset($mlistings)) {
        $js_array = json_encode($positions);
        echo "var locations = ". $js_array . ";\n";
    }//if end ?>


</script>




<div id="map"></div>


</body>
</html>