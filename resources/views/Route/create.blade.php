@extends('theme.default')
@section('content')

<h2 style="text-align: center!important">เพิ่มข้อมูลเส้นทาง</h2>
<form action="{{ url('/') }}/route" method="POST">
	{{ csrf_field() }}
	{{ method_field('POST') }}
	
	<br>
	<div class="line">
		<strong>รหัสรอบงาน :</strong>
		<input class="form-control type="number" name="ID_Job" value="{{$ID_Job}}" readonly >
	</div>
	
	<br>
	<div class="line">
		<strong >ตำแหน่ง : </strong>
		<!--<input type="number" name="ID_Position" placeholder="ระบุรหัสตำแหน่ง" >-->
		<select name="ID_Position" class="form-control">
			@foreach($table_position as $row_position)
			<option value="{{ $row_position->ID_Position }}">
			{{ $row_position->Name_Position }}
			</option>
            @endforeach
      </select>	
	</div>	
	
	<br>
	<div class="line">
		<a href="{{ url('/') }}/job/{{$ID_Job}}" class="btn btn-primary pull-right" >back</a>
		<button type="submit" class="btn btn-warning btn-success">Create</button>
	</div>
</form>
@endsection