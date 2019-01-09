@extends('theme.default')
@section('content')
@forelse($table_job as $row) 
<style>
  	h2{
  		  text-align: center!important;
  	}
  	table{
  		  width: 200%;
  	}  
  	html {
  		  height: 100%;
  		  margin: 0;
  		  padding: 0;
  	}
  	#map {
  		  height: 500px;
  		  width: 100%;
  	}
</style>


<!-- Export  -->
<br>
  <a href="{{url('/')}}/job/{{$ID_Job}}/pdf" class="btn pull-right hidden-print">Export to PDF </a>
  <!-- <button onclick="window.print()" class="button button5 pull-right hidden-print" >พิมพ์รายงาน</button> -->
<!-- 	<a href="{{url('/')}}/excel/{{$row->ID_Job}}" class="btn pull-right hidden-print">Export to Excel</a>
<br><br> -->

	<div class="line"> 
		<strong>รหัสรอบงาน : </strong> 
		<span>{{ $row->ID_Job }}</span> 
	</div> 

	<div class="line"> 
		<strong>ปี/เดือน/วัน และเวลา ที่เพิ่มรอบงาน: </strong> 
		<span>{{ $row->Date }}</span> 
	</div> 

	<div class="line"> 
		<strong>ระยะทางรวม (กิโลเมตร): </strong> 
		<span>{{ $row->Distance_Sum }}</span> 
	</div> 

	<div class="line"> 
		<strong>ระยะเวลารวม (นาที): </strong> 
		<span>{{ $row->Time_Sum }}</span> 
	</div> 
	
	<div class="line"> 
		<a href="{{ url('/') }}/route/create?ID_Job={{$ID_Job}}" class="btn btn-warning hidden-print">เพิ่มข้อมูลเส้นทาง </a>
		<a href="{{ url('/') }}/job" class="btn btn-primary hidden-print ">back</a>
	</div> 

<br>
<h2>รอบงาน {{ $row->Name_Job }} </h2>
<br>
	<table class="table">
		<tr>
      <th style="text-align: center!important;">ลำดับที่</th>
			<th>ชื่อ - นามสกุล</th>
			<th style="text-align: center!important;">ตำแหน่ง</th>
			<th >ละติจูด</th>
			<th >ลองจิจูด</th>
			<th style="text-align: center!important;">ระยะทาง(กิโลเมตร)</th>
			<th style="text-align: center!important;">เวลา(นาที)</th>
			<th></th>
		</tr>
		@foreach($table_route as $row)
		<tr>
            <td style="text-align: center!important;">{{ $row->Sequence}} </td>
			<td>{{ $row->Name }}</td>
			<td>{{ $row->House_number }} ม.{{ $row->Village }} ต.{{$row->Subdistrict}} อ.{{$row->City}} จ.{{ $row->Province }} </td>
			<td style="text-align: center!important;">{{ $row->Latitude }} </td>
			<td style="text-align: center!important;">{{ $row->Longitude }} </td>
			<td id="dis" style="text-align: center!important;" >{{ $row->District}} </td>
			<td style="text-align: center!important;">{{ $row->Time}}</td>
			<td style="text-align: center!important;">
				<form class="inline" action="{{ url('/') }}/route/{{ $row->ID_Route }}?ID_Job={{$ID_Job}}" method="POST"> 
				{{ csrf_field() }} 
				{{ method_field('DELETE') }} 
				<a href="{{ url('/') }}/route/{{ $row->ID_Route }}/edit" class="btn btn-outline btn-success hidden-print"><i class="fa fa-edit  "></i></a> 
				<button type="submit" class="btn btn-danger hidden-print"><i class="fa fa-times "></i></button> 
				</form>
		</tr>
		@endforeach
	</table>

<!-- หาเส้นทาง -->
    <a href="{{ url('/') }}/route/dis/{{$row->ID_Job}}" class="btn btn-primary pull-right hidden-print">คำนวนเส้นทาง</a><br><br>

<!-- Google Map -->
   <div id="map"></div>
  <script>
  function initMap() {
    var mapOptions = {
      center: {lat: 13.847860, lng: 100.604274},
      zoom: 11,
    }

    var maps = new google.maps.Map(document.getElementById("map"),mapOptions);

    var marker, info;

    // อ่านค่า Json แล้ว Loop ค่าเพื่อปักหมุดลงใน Map
    $.getJSON( "{{ url('/') }}/route/json/{{$row->ID_Job}}", function( jsonObj ) {
        console.log( jsonObj );
        
          //*** loop
          $.each(jsonObj, function(i, item){
          
          marker = new google.maps.Marker({
            position: new google.maps.LatLng(item.Latitude, item.Longitude),
            map: maps,
            title: item.LOC_NAME
          });
        //ตั้งค่าmap ให้อยู่ใกล้เคียงต่ำแหน่งเริ่มแรก
        // maps.setCenter(new google.maps.LatLng(item.Latitude,item.Longitude));
        maps.setCenter({lat:item.Latitude,lng:item.Longitude});

        info = new google.maps.InfoWindow();
        
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            info.setContent(item.LOC_NAME);
            info.open(maps, marker);
            }
          })(marker, i));
        }); // loop
      });
    };
  
  </script> 
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6EpDuzLcc5fhxZfr30n4eNoHOQQGLlTY&libraries=places&callback=initMap"async defer></script> 
@empty 
@endforelse
@endsection