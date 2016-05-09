<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCI7gnWQspPe0LGgmo4sKsVOI5pafldHVs&v=3.exp"></script>

<script type="text/javascript">
//<![CDATA[

function load() {
	var lat= 11.5697238, lng= 104.8995636;
	var latlng = new google.maps.LatLng(lat, lng);
    var myOptions = {
        zoom: 18,
        center: latlng,
        'scrollwheel': true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("map"), myOptions);
    geocoder = new google.maps.Geocoder();
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        title: "Is here... :)"
    });
}
function matchFound(str, string_to_find){
	 var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 15,
		center: {lat: 11.5697238, lng: 104.8995636}
	  });
	var geocoder = new google.maps.Geocoder();
	  geocoder.geocode({'address': str}, function(results, status) {
	if (status === google.maps.GeocoderStatus.OK) {
		  map.setCenter(results[0].geometry.location);
		  var marker = new google.maps.Marker({
			map: map,
			position: results[0].geometry.location
		  });
		  console.log(map);
		} else {
		  console.log('Geocode was not successful for the following reason: ' + status);
		}
	  });
    return true;
}

function parseXML(xml){
    var street = $('#street').val();
	var khan = $('#khan').val();
	var searchFor = street+" "+khan;
	var searchFor = searchFor.trim();
    $(xml).find('hotel').each(function(){
        var title = $(this).find('address').text();
		var title = title.trim();
        if(title.indexOf(searchFor) > -1){
            if(matchFound(title, searchFor)){
				
            }
        }else{
			console.log('ELSE');
		}
    });  
}
$(document).ready(function() {
	$("#searchMap").on("click", function(event) {
		 $.ajax({
				type: "GET",
				url: "hotels.xml",
				dataType: "xml",
				success: parseXML
		});
	});
});
 
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
<br/>
<div id="output"></div>
</body>