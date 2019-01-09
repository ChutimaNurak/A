@extends('theme.default')
@section('content')
<!--ค้นหาตำแหน่งจาก Latitude และ Longitude และปักหมุด (Marker) ลงบนแผนที่ -->
<style>
	#map {
			height: 500px;
			width: 1050px;
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
<h2>เพิ่มข้อมูลที่อยู่ลูกค้า</h2>
<div class="col-md-offset-2 col-md-8">
	<div class="x_panel">
		<form action="{{ url('/') }}/position" method="POST">
			{{ csrf_field() }}
			{{ method_field('POST') }}
			<div class="line">
				<strong>รหัสลูกค้า :</strong>
				<input  class="form-control" type="text" name="ID" value="{{$ID}}" readonly >
			</div>
		<br>
			<div class="line">
				<strong>บ้านเลขที่ : </strong>
				<input  class="form-control" type="text" name="House_number" placeholder="ระบุบ้านเลขที่" required>
			</div>
		<br>
			<div class="line">
				<strong>หมูที่ : </strong>
				<input  class="form-control" type="text" name="Village" placeholder="ระบุหมูที่" required>
			</div>
		<br>
			<div class="line">
				<strong>ตำบล: </strong>
				<input  class="form-control" type="text" name="Subdistrict" placeholder="ระบุตำบล" required>
			</div>
		<br>
			<div class="line">
				<strong>อำเภอ : </strong>
				<input  class="form-control" type="text" name="City" placeholder="ระบุอำเภอ" required>
			</div>
		<br>
			<div class="line">
				<strong>จังหวัง : </strong>
				<input  class="form-control" type="text" name="Province" placeholder="ระบุจังหวัง" required>
			</div>
		<br>
			<div class="line">
				<strong>รหัสไปรณีย์ : </strong>
				<input  class="form-control" type="text" name="Zip_code" placeholder="ระบุรหัสไปรณีย์" required>
			</div>
		<br>
			<div class="line" >
				<strong>ละจิจูด : </strong>
				<input id="Latitude"  class="form-control" type="text" name="Latitude" placeholder="ระบุละจิจูด">
			</div>
		<br>
			<div class="line">
				<strong>ลองจิจูด : </strong>
				<input id="Longitude" class="form-control" type="text" name="Longitude"  placeholder="ระบุลองจิจูด"  >
			</div>
		<br>
			<div class="line">
				<a href="{{ url('/') }}/customer/{{$ID}}"  class="btn btn-primary pull-right ">back</a>
				<button type="submit" class="btn btn-warning btn-success btn-warning" >Create</button>
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
          zoomControl: 10,
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
 
       // สร้างช่องค้นหาและเชื่อมโยงกับองค์ประกอบ UI
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // SearchBox 
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // รายละเอียดเพิ่มเติมสำหรับสถานที่
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
@endsection