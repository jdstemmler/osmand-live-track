<!DOCTYPE html>

<?php
$file = file_get_contents('/tmp/location.latest');
$data = unserialize($file);

$lat = $data['lat'];
$lon = $data['lon'];
$tstamp = $data['timestamp'];
?>

 <html>
  <head>
   <title>OsmAnd Location</title>
   <meta charset="UTF-8">
   <meta name="viewport" 
                 content="width=device-width">
   <script type="text/javascript"
      src="http://maps.google.com/maps/api/js?
                    key=your_key_here&sensor=false">
   </script> 
  </head>
  <body onload="GetMap()">
   <div id="textContainer" style="width:500px">
     <b>
     Last Map Update: <?=$tstamp?>
     </b>
   <div id="mapContainer" style="width:500px;height:600px">
   </div>
   <script type="text/javascript">
    function GetMap() {
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
           $track = fopen('../resources/log.body', 'r');
           if ($track) {
              while (($line = fgets($track)) !== false) {
           echo "new google.maps.LatLng($line)";
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
            strokeWeight: 2
        });

        mapPath.setMap(map);
   }
  </script>
 </body>
</html>
