@extends('theme.default')
@section('content')

@forelse($table_customer as $row) 

<style type="text/css">
	h3{
		text-align: center!important;
	}
</style>
<br>
<h3>รหัสลูกค้า {{ $row->ID }}</h3>

<div class="col-md-offset-2 col-md-8">
	<div class="x_panel">
		<form action="{{ url('/') }}/customer/{{ $row->ID }}" method="POST"> 
			{{ csrf_field() }} 
			{{ method_field('PUT') }} 
			<div class="line"> 
				<strong>ชื่อ - นามสกุล : </strong> 
				<input class="form-control" type="text" name="Name"  value="{{ $row->Name }}"> 
			</div> 
		<br>
			<div class="line"> 
				<strong>เบอร์โทร : </strong> 
				<input class="form-control" type="text" data-masked-input="999-9999999" 
						pattern="[0-9]{3}-[0-9]{7}" maxlength="11" name="Telephone" value="{{$row->Telephone }}"> 
			</div> 
		<br>
			<div class="line"> 
				<strong>อีเมลล์ : </strong> 
				<input class="form-control" type="Email" name="Email" value="{{ $row->Email }}"> 
			</div> 
		<br>
			<div class="line">
				<a href="{{ url('/') }}/customer" class="btn btn-primary pull-right">Back</a>
				<button type="submit" class="btn btn-outline btn-warning" >Update</button> 
			</div>
		</form>
	</div>
</div>
@empty

@endforelse
@endsection