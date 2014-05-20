<!DOCTYPE html>

<?php

$file = file_get_contents('/tmp/location');
$data = unserialize($file);

?>

 <html>
  <head>
   <title>My First Map</title>
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
      new google.maps.LatLng(<?=$data["lat"]?>, <?=$data["lon"]?>);
     var myOptions = {
           zoom: 14,
         center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
     };
     var container = document.getElementById(
                               "mapContainer");
     map = new google.maps.Map(container,
                                   myOptions);
     marker1 = new google.maps.Marker();
     marker1.setPosition(latlng);
     marker1.setMap(map)
   }
  </script>
 </body>
</html>
