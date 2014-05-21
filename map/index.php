<!DOCTYPE html>

<?php

$kml = fopen('../resources/map_data.kml', 'w');

$kmlhead = file_get_contents('../resources/log.head');
$kmlbody = file_get_contents('../resources/log.body');
$kmlfoot = file_get_contents('../resources/log.foot');

fwrite($kml, "$kmlhead");
fwrite($kml, $kmlbody);
fwrite($kml, $kmlfoot);

fclose($kml);


$file = file_get_contents('/tmp/location.latest');
$data = unserialize($file);

$lat = $data['lat'];
$lon = $data['lon'];
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
   <div id="mapContainer" 
             style="width:500px;height:600px">
   </div>
   <script type="text/javascript">
    function GetMap() {
     var latlng = 
      new google.maps.LatLng(<?=$lat?>, <?=$lon?>);
     var myOptions = {
           zoom: 15,
         center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
     };
     var container = document.getElementById(
                               "mapContainer");
     map = new google.maps.Map(container,
                                   myOptions);
     var kml=new google.maps.KmlLayer('../resources/map_data.kml');
     kml.setMap(map);
     marker1 = new google.maps.Marker();
     marker1.setPosition(latlng);
     marker1.setMap(map);
   }
  </script>
 </body>
</html>
