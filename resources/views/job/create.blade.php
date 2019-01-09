@extends('theme.default')
@section('content')
<br>
<h2 style="text-align: center!important;">เพิ่มข้อมูลรอบงาน</h2>
<div class="col-md-offset-2 col-md-8">
	<div class="x_panel">
		<form action="{{ url('/') }}/job" method="POST">
			{{ csrf_field() }}
			{{ method_field('POST') }}
			<br>

			<div class="line">
				<strong>ชื่อรอบงาน :</strong>
				<input class="form-control" type="text" name="Name_Job" placeholder="ระบุชื่อรอบงาน" required >
			</div>
			<br>

			<div class="line">
				<a href="{{ url('/') }}/job"  class="btn btn-primary pull-right">back</a>
				<button type="submit" class="btn btn-warning">Create</button>
			</div>
		</form>
	</div>
</div>
@endsection