<?php
$data['lat'] = $_GET['lat'];
$data['lon'] = $_GET['lon'];
$data['timestamp'] = $_GET['timestamp'];
$data['hdop'] = $_GET['hdop'];
$data['altitude'] = $_GET['altitude'];
$data['speed'] = $_GET['speed'];
$data['leg'] = $_GET['leg'];
$data['key'] = $_GET['key'];

if ($data['key'] != $tracking_key){
    echo "tracking key invalid";
    return;
}

$lat = $data['lat'];
$lon = $data['lon'];
$loc = $data['leg'];

if ($loc) {
    $file = "./resources/$loc.latest";
    $hist = "./resources/$loc.history";
} else {
    $file = "./resources/location.latest";
    $hist = "./resources/location.history";
}

$f = fopen($file, 'w');
fwrite($f, serialize($data));
fclose($f);

$body = fopen($hist, 'a');
fwrite($body, "new google.maps.LatLng(${lat}, ${lon})\n");
fclose($body);
?>

<b>saving location <?=$lat?>, <?=$lon?> to file</b>
