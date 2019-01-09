@extends('theme.default')
@section('content')

@forelse($table_position as $row) 

<style>
	#map {
			height: 500px;
			width: 1050px;
			}
	html {
			height: 100%;
			margin: 0;
			padding: 0;
			}
	#floating-panel {
			position: absolute;
			top: 5px;
			left: 30%;
			margin-left: -180px;
			width: 350px;
			z-index: 5;
			background-color: #fff;
			padding: 5px;
			border: 1px solid #999;
			}
	#latlng {
			width: 225px;
			}
	h2{
		text-align: center!important;
	}
</style>

<br>
<h2>แก้ไขข้อมูลรหัสตำแหน่ง {{ $row->ID_Position }}</h2> 
	<div class="col-md-offset-2 col-md-8">
		<div class="x_panel">

			<form action="{{ url('/') }}/position/{{ $row->ID_Position }}" method="POST"> 
				{{ csrf_field() }} 
				{{ method_field('PUT') }}
				<div class="line"> 
					<strong>รหัสลูกค้า : </strong> 
					<input class="form-control" type="number" name="ID" value="{{ $row->ID }}" readonly> 
				</div> 
			<br>
				<div class="line"> 
					<strong>บ้านเลขที่ : </strong> 
					<input class="form-control" type="text" name="House_number"  value="{{ $row->House_number }}"> 
				</div> 
			<br>
				<div class="line"> 
					<strong>หมู่ที่ : </strong> 
					<input class="form-control" class="form-control" type="text" name="Village" value="{{ $row->Village }}"> 
				</div> 
			<br>
				<div class="line"> 
					<strong>ตำบล : </strong> 
					<input class="form-control" type="text" name="Subdistrict" value="{{ $row->Subdistrict }}"> 
				</div> 
			<br>
				<div class="line"> 
					<strong>อำเภอ : </strong> 
					<input class="form-control" type="text" name="City"  value="{{ $row->City }}"> 
				</div> 
			<br>
				<div class="line"> 
					<strong>จังหวัด : </strong> 
					<input class="form-control" type="text" name="Province" value="{{ $row->Province }}"> 
				</div> 
			<br>
				<div class="line"> 
					<strong>รหัสไปรษณีย์ : </strong> 
					<input class="form-control" type="text" name="Zip_code" value="{{ $row->Zip_code }}"> 
				</div>
			<br>
				<div class="line"> 
					<strong>ละติจูด : </strong> 
					<input id="Latitude" class="form-control"  type="text" name="Latitude" value="{{ $row->Latitude }}" > 
				</div> 
			<br>
				<div class="line"> 
					<strong>ลองจิจูด : </strong> 
					<input id="Longitude" class="form-control"  type="text" name="Longitude" value="{{ $row->Longitude }}"> 
				</div>
			<br>
			   	<div class="line"> 
					<a href="{{ url('/') }}/customer/{{ $row->ID }}" class="btn btn-primary pull-right">back</a>
					<button type="submit" class="btn btn-outline btn-warning btn-success">Update</button> 
				</div>
			<br>
		</div>
	</div>
<!--ค้นหาตำแหน่งจาก Latitude และ Longitude และปักหมุด (Marker) ลงบนแผนที่-->
<input id="pac-input" class="controls" type="text" placeholder="Search Box">
<div id="map"></div>
    <script>
    	function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
        //กำหนดค่า Latitude and Longitude ที่จะแสดงผลตรงกลาง Map
				center: {lat: 13.847624, lng: 100.785967},
        //การเปิด/ปรับค่าค่า zoomControl แต่เปิด/ปรับค่า mapTypeContro
          zoomControl: true,
				zoomControlOptions: {
				style: google.maps.ZoomControlStyle.LARGE
			},

		mapTypeControl: true,
		mapTypeControlOptions: {
		style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
		},
		//กำหนดค่าจาก 0 - 21
          zoom: 10,
          mapTypeId: 'roadmap'
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          //อาร์เรย์ที่อยู่
          var places = searchBox.getPlaces();
          //console.log("places : ",places);

          //จำนวนอาร์เรยืที่อยู่ 
          if (places.length == 0) {
            return;
          }

          // Clear out the old markers. ล้างข้อมูลเก่าที่เคยค้นหา
          markers.forEach(function(marker) {
            marker.setMap(null);
          });

          markers = [];

          // For each place, get the icon, name and location.

          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place. เคลียค่า markers
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));
            //ค่า lat&lng
			console.log("place.geometry.location :",place.geometry.location.lat(),place.geometry.location.lng());
			var lat=place.geometry.location.lat();
			var	lng=place.geometry.location.lng();
			var Latitude = document.getElementById("Latitude");
			console.log("lat",Latitude);
			Latitude.value = lat;
			var Longitude = document.getElementById("Longitude");
			console.log("lng",Longitude);
			Longitude.value = lng;

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
      }
    </script>

<!-- GoogleMaps Api -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6EpDuzLcc5fhxZfr30n4eNoHOQQGLlTY&libraries=places&callback=initAutocomplete"async defer></script>
</form>

@empty
	
@endforelse
@endsection