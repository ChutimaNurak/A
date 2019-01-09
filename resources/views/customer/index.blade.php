@extends('theme.default')
@section('content')

<style type="text/css">
	table {
		width:100%;
	}
	h1{
		text-align: center!important
	}
</style>

<br>
<!-- เพิ่มข้อมูลลูกค้า -->
<a href="{{ url('/') }}/customer/create" class="btn btn-warning pull-right">เพิ่มข้อมูลลูกค้า</a> 
<br>

<h1>รายละเอียดข้อมูลลูกค้า</h1>
<br>

<!-- ค้นหา -->
	<div class="line" style="text-align: center!important"> 
		<form class="inline" action="{{ url('/') }}/customer" method="GET"> 
			<input type="text" name="q" placeholder="ระบุชื่อ-นามสกุล" value="{{ $q }}"> 
                    <button class="btn btn-default" type="submit">
                        <i class="fa fa-search"></i>
		</form> 
	</div>
		<br>
		<br>
<!-- ตาราง -->
		<table class="table">
			<tr>
				<!-- <th style="text-align: center!important;">รหัสลูกค้า</th> -->
				<th></th>
				<th>ชื่อ-นามสกุล</th>
				<th>เบอร์โทร</th>
				<th>อีเมลล์</th>
				<th></th>
			</tr>
			@foreach($table_customer as $row)
			<tr>
				<td></td>
				<!-- <td style="text-align: center!important">{{ $row->ID }} </td> -->
				<td>{{ $row->Name }}</td>
				<td>{{ $row->Telephone }}</td>
				<td>{{ $row->Email}} </td>
				<td style="text-align: center!important">
					<form class="inline" action="{{ url('/') }}/customer/{{ $row->ID }}" method="POST"> 
					{{ csrf_field() }} 
					{{ method_field('DELETE') }} 
					<a href="{{ url('/') }}/customer/{{ $row->ID }}" class="btn btn-outline btn-primary">View</a>
					<a href="{{ url('/') }}/customer/{{ $row->ID }}/edit" class="btn btn-outline btn-success">edit</a>
					<button type="submit" class="btn btn-danger">Delete</button> 
					</form>
				</td>
			</tr>
			@endforeach
		</table>
@endsection
