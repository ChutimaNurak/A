@extends('theme.default')
@section('content')
@forelse($table_job as $row) 

<style type="text/css">
	h2{
		text-align: center!important;
	}
</style>
<br>

<h2>แก้ไขข้อมูลรอบงานที่ {{ $row->ID_Job }}</h2> 
<br> 
<div class="col-md-offset-2 col-md-8">
	<div class="x_panel">
		<form action="{{ url('/') }}/job/{{ $row->ID_Job }}" method="POST"> 
			{{ csrf_field() }} 
			{{ method_field('PUT') }} 
			<div class="line"> 
				<strong>ชื่อรอบงาน : </strong> 
				<input class="form-control" type="text" name="Name_Job"  value="{{ $row-> Name_Job}}"> 
			</div> 
		<br>
			<div class="line"> 
				<strong>ปี/เดือน/วัน และเวลา : </strong> 
				<input class="form-control" type="text" name="Date"  value="{{ $row->Date }}"> 
			</div> 
		<br>
			<div class="line"> 
				<strong>ระยะทางรวม : </strong> 
				<input  class="form-control" type="number" name="Distance_Sum" value="{{$row-> Distance_Sum}}" readonly> 
			</div> 
		<br>
			<div class="line"> 
				<strong>เวลารวม : </strong> 
				<input  class="form-control" type="number" name="Time_Sum" value="{{$row->Time_Sum }}" readonly> 
			</div> 
		<br>
			<div class="line">
				<a href="{{ url('/') }}/job"  class="btn btn-primary pull-right">back</a>
				<button type="submit" class="btn btn-outline btn-warning">Update</button> 
			</div>
		</form>
	</div>
</div>
@empty

@endforelse
@endsection