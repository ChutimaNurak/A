<?php
namespace App;
use Illuminate\Support\Facades\DB;
class JobModel {
	
	function select(){
		$sql = "select * from job";
		return DB::select($sql, []);
	}

	function select_id($id_job){
		$sql = "select * from job where ID_Job = {$id_job}";
		return DB::select($sql, []);
	}

	function select_search($q){
		$sql = "select * from job where Name_Job like '%{$q}%'";
		return DB::select($sql, []);
	}

	function insert($name_job){
		$sql = "insert into job (Name_Job) values ('{$name_job}')";
		DB::insert($sql, []);
	}

	function update($name_job,$date, $distance_sum,$time_sum,$id_job){
		$sql = "update job
				set 
				   Name_Job = '{$name_job}',
				   Date = '{$date}',
				   Distance_Sum = {$distance_sum},
				   Time_Sum = {$time_sum}
				where ID_Job = {$id_job}";
		DB::update($sql, []);
	}
	//อัพเวลา RouteController
	function up_time($distane_sum,$time_sum,$id_job){
		$sql = "update job
				set 
				Distance_Sum = {$distane_sum},
				Time_Sum = {$time_sum}
				where ID_Job = {$id_job} ";
		DB::update($sql, []);
	}

	function delete($id_job){
		$sql = "delete from job where ID_Job = {$id_job}";
		DB::delete($sql, []);
	}
	
}