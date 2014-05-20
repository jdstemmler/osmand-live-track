<?php
	$data['lat'] = $_GET['lat'];
	$data['lon'] = $_GET['lon'];
	$data['timestamp'] = $_GET['timestamp'];
	$data['hdop'] = $_GET['hdop'];
   $data['altitude'] = $_GET['altitude'];
   $data['speed'] = $_GET['speed'];
   
   $f = fopen('/tmp/location', 'w');
   fwrite($f, serialize($data));
   fclose($f);
?>