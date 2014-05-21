<?php
    $data['lat'] = $_GET['lat'];
    $data['lon'] = $_GET['lon'];
    $data['timestamp'] = $_GET['timestamp'];
    $data['hdop'] = $_GET['hdop'];
    $data['altitude'] = $_GET['altitude'];
    $data['speed'] = $_GET['speed'];
   
    $lat = $data['lat'];
    $lon = $data['lon'];
    
    $f = fopen('/tmp/location.latest', 'w');
    fwrite($f, serialize($data));
    fclose($f);

    $kml = fopen('./resources/log.body', 'a');
    fwrite($kml, "${lon},${lat}\n");
    fclose($kml);
?>

<b>saving location <?=$lat?>, <?=$lon?> to file</b>