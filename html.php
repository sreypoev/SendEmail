<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCI7gnWQspPe0LGgmo4sKsVOI5pafldHVs&v=3.exp&signed_in=true&callback=initMap"async defer></script>

<script type="text/javascript">
//<![CDATA[

function load() {
	  var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 15,
		center: {lat: 11.5697238, lng: 104.8995636}
	  });
	  var geocoder = new google.maps.Geocoder();
	  document.getElementById('searchMap').addEventListener('click', function() {
		geocodeAddress(geocoder, map);
	  });
}
 
function geocodeAddress(geocoder, resultsMap){
  var street = $('#street').val();
  var khan = $('#khan').val();
  var address = street+" "+khan;
  geocoder.geocode({'address': address}, function(results, status) {
	if (status === google.maps.GeocoderStatus.OK) {
      resultsMap.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
        map: resultsMap,
        position: results[0].geometry.location
      });
    } else {
      console.log('Geocode was not successful for the following reason: ' + status);
    }
  });
}
</script>

</head>

<body onload="load()">
<br/>
<form action="#" method="POST"/>
	Street:<input type="text" id="street" /><br/>
	Khan:<input type="text" id="khan" /><br/>
	Room Type:<input type="text" id="roomType" /><br/>
	<input type="button" name="searchMap" id="searchMap" value="Search" />
</form>
<br/>
<br/>
<div id="map" style="width: 600px; height: 400px"></div>
</body>