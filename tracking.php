<?php
    $data['lat'] = $_GET['lat'];
    $data['lon'] = $_GET['lon'];
    $data['timestamp'] = $_GET['timestamp'];
    $data['hdop'] = $_GET['hdop'];
    $data['altitude'] = $_GET['altitude'];
    $data['speed'] = $_GET['speed'];
   
    $f = fopen('/tmp/location.latest', 'w');
    fwrite($f, serialize($data));
    fclose($f);

    $kml = fopen('/tmp/log.body', 'w+')
    fwrite($kml, "$data['lat'], $data['lon'], 0\n")
    fclose($kml)
?>

<b>saving location <?=$data['lat']?>, <?=$data['lon']?> to file</b>