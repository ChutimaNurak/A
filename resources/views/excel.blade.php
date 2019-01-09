@extends('theme.default')
@section('content')

<php
$connect = mysqli_connect("localhost", "root", "", "path");
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT * FROM customer 
			INNER JOIN position ON customer.ID = position.ID 
			INNER JOIN route ON route.ID_Position = position.ID_Position 
            WHERE ID_Job =  {$id_job}";
 $query="SELECT * FROM  job where ID_Job = {$id_job}";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                <tr>
					<th>ชื่อ - นามสกุล</th>
					<th style="text-align: center!important;">ตำแหน่ง</th>
					<th >ละติจูด</th>
					<th >ลองจิจูด</th>
					<th style="text-align: center!important;">ลำดับที่</th>
					<th style="text-align: center!important;">ระยะทาง(กิโลเมตร)</th>
					<th style="text-align: center!important;">เวลา(นาที)</th>
				</tr>
  				';
  			while($row = mysqli_fetch_array($result)) 
		  	{
		  		$output .= '
    			<tr>
					<td>{{ $row->Name }}</td>
					<td>{{ $row->House_number }} ม.{{ $row->Village }} ต.{{$row->Subdistrict}} อ.{{$row->City}} จ.{{ $row->Province }} </td>
					<td style="text-align: center!important;">{{ $row->Latitude }} </td>
					<td style="text-align: center!important;">{{ $row->Longitude }} </td>
					<td style="text-align: center!important;">{{ $row->Sequence}} </td>
					<td id="dis" style="text-align: center!important;" >{{ $row->District}} </td>
					<td style="text-align: center!important;">{{ $row->Time}}</td>
				</tr>
			   ';
			}
			  $output .= '</table>';
			  header('Content-Type: application/xls');
			  header('Content-Disposition: attachment; filename=download.xls');
			  echo $output;
		}
	}
?>

<!-- @forelse($table_job as $row) -->
@empty  
@endforelse
@endsection