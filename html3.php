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
	console.log("....."+str+"......");
	var geocoder = new google.maps.Geocoder();
	  geocoder.geocode({'address': str}, function(results, status) {
	if (status === google.maps.GeocoderStatus.OK) {
		/* var x = results[0].geometry.location.lat();
         var y = results[0].geometry.location.lng();
		 var latlng = new google.maps.LatLng(x, y);
	    var myOptions = {
						zoom: 8,
						center: latlng,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					};
		map = new google.maps.Map(document.getElementById("map"), myOptions);
		var marker = new google.maps.Marker({
			position: new google.maps.LatLng(x, y),
			map: map,
			title: str
		});
	}*/
		map.setCenter(results[0].geometry.location);
		var marker = new google.maps.Marker({
		 	map: map,
	    	position: results[0].geometry.location
		  });
		}else {
		  console.log('Geocode was not successful for the following reason: ' + status);
		}
		
	  });
    return true;
}

function parseXML(xml){
	var khan = $('#khan').val();
	var searchFor = khan.trim();
    $(xml).find('hotel').each(function(){
		var title = $(this).find('address').text();
		var street = $(this).find('address').find('street').text();
		var sangkat = $(this).find('address').find('Sangkat').text();
        var khan = $(this).find('address').find('Khan').text();
		var addres = street+" "+sangkat+" "+khan;
		var title = title.trim();
		console.log("FROM XML: "+addres);
		console.log("TEXT: "+searchFor);
        if(title.indexOf(searchFor) > -1){
            if(matchFound(addres, searchFor)){
				
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
				url: "hotelss.xml",
				dataType: "xml",
				success: parseXML
		});
	});
});
 
</script>

</head>

<body onload="load()">
<br/> 
<?php echo"1:". is_numeric('1100069851');
echo "2:".is_int('100069851');
echo "3:".ctype_digit('100069851'); ?>

<form action="#" method="POST"/>
	Adrres:<input type="text" id="khan" /><br/>
	Room Type:<input type="text" id="roomType" /><br/>
	<input type="button" name="searchMap" id="searchMap" value="Search" />
</form>
<br/>
<br/>
<div id="map" style="width: 600px; height: 400px"></div>
<br/>
<div id="output"></div>
</body>