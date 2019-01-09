@extends('theme.default')
@section('content')
@forelse($table_route as $row) 

<style type="text/css">
	h2{
		text-align: center!important;
	}
</style>
<br>

	<h2>แก้ไขข้อมูลเส้นทางที่ {{ $row->ID_Route }}</h2> 
	<form action="{{ url('/') }}/route/{{ $row->ID_Route }}" method="POST"> 
		{{ csrf_field() }} 
		{{ method_field('PUT') }} 

		<div class="line"> 
			<strong>รหัสรอบงาน : </strong> 
			<input class="form-control" type="text" name="ID_Job"  value="{{ $row->ID_Job }}" readonly> 
		</div> 
		<br>

		<div class="line"> 
			<strong>ตำแหน่ง : </strong> 
			<!-- <input type="text" name="ID_Position" value="{{$row->ID_Position }}">  -->
			<select name="ID_Position" class="form-control"  >
				@foreach($table_position as $row_position)
				<option value="{{ $row_position->ID_Position }}"
						{{ $row_position->ID_Position === $row->ID_Position ? "selected" : "" }} >
						{{ $row_position->Name_Position }}
				</option>
            	@endforeach
			</select>
		</div> 
		<br>

		<div class="line"> 
			<strong>ลำดับที่ : </strong> 
			<input class="form-control"  type="text" name="Sequence" value="{{ $row->Sequence }}" readonly> 
		</div> 
		<br>

		<div class="line"> 
			<strong>ระยะทาง : </strong> 
			<input class="form-control"  type="text" name="District" value="{{ $row->District }}" readonly >  
		</div>
		<br>

		<div class="line"> 
			<strong>เวลา : </strong> 
			<input class="form-control"  type="text" name="Time" value="{{ $row->Time }}" readonly> 
		</div>
		<br>

		<div class="line">
			<a href="{{ url('/') }}/job/{{ $row->ID_Job }}" class="btn btn-primary pull-right ">back</a>
			<button type="submit" class="btn btn-outline btn-warning btn-warning">Update</button> 
		</div>
	</form>
@empty
<div>This Route id does not exist</div> 
@endforelse
@endsection