<?php 
$lat=$_REQUEST[lat];
$lng=$_REQUEST[lng];
$nm=rawurldecode($_REQUEST[nm]);
?>
<!DOCTYPE html>
<html>
<body>

<h1>Google Map</h1>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZxqi-V3z1FoUtVSv-9IWYiZOE_MIRrvE&sensor=false"></script>
<div style="overflow:hidden; margin-left:20px; height:350px;width:1100px;">
<div id="gmap_canvas" style="height:350px;width:1100px;"></div>
<style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
<a class="google-map-code" href="#" id="get-map-data">frameworks</a></div>
<script type="text/javascript"> 
function init_map(){var myOptions = {zoom:15,center:new google.maps.LatLng(<?php  echo $lat?>,<?php  echo $lng?>),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(<?php  echo $lat?>,<?php  echo $lng?>)});
infowindow = new google.maps.InfoWindow({content:"<b><?php  echo $nm;?></b>" });google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>

</body>
</html>
