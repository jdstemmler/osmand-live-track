<!DOCTYPE html>

<?php
$file = file_get_contents('../resources/location.latest');
$data = unserialize($file);

$lat = $data['lat'];
$lon = $data['lon'];
$tstamp = $data['timestamp'];
?>

 <html>
  <head>
   <title>OsmAnd Location</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width">
   <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=your_key_here&sensor=false"></script>
   <script type="text/javascript">
    function initialize() {
     var latlng = new google.maps.LatLng(<?=$lat?>, <?=$lon?>);
     var mapOptions = {
         zoom: 15,
         center: latlng,
         mapTypeId: google.maps.MapTypeId.ROADMAP
     };
     var container = document.getElementById("mapContainer");
     var map = new google.maps.Map(container, mapOptions);

     var marker1 = new google.maps.Marker({
         position: latlng,
         map: map});
     var pathCoordinates = [
         <?php
           $track = fopen('../resources/location.history', 'r');
           if ($track) {
              while (($line = fgets($track)) !== false) {
           echo "new google.maps.LatLng($line),\n";
              }
           } else {
           echo "new google.maps.LatLng($lat, $lon)";
           }
           fclose($track);
          ?>
     ];
     var mapPath = new google.maps.Polyline({
         path: pathCoordinates,
         geodesic: true,
         strokeColor: '#FF0000',
         strokeOpacity: 1.0,
         strokeWeight: 3
        });

     mapPath.setMap(map);
    }
   </script>
  </head>

  <body onload="initialize()">
   <div id="textContainer" style="width:500px">
     <b>
     Last Map Update:
      <?php
        echo date('Y-m-d H:i:s', substr($tstamp,0,-3));
      ?>
     </b>
   </div>
   <div id="mapContainer" style="width:500px;height:600px" />
 </body>
</html>
