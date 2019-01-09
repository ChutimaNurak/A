<?php
namespace App;
use Illuminate\Support\Facades\DB;

class RouteModel {

	function select(){
		$sql = "select * from route";
		return DB::select($sql, []);
	}

	function select_id($id_route){
		$sql = "select * from route where ID_Route = {$id_route}";
		return DB::select($sql, []);
	}
	
	//View ID_Job  JobController
	function select_position_route_customer($id_job){
		$sql = "select * FROM customer 
				INNER JOIN position ON customer.ID = position.ID 
				INNER JOIN route ON route.ID_Position = position.ID_Position 
                WHERE ID_Job = {$id_job} order by sequence";
		return DB::select($sql, []);
	}
	//View Latitude&Longitude  function jnos --> RoutController
	function select_la_lon($id_job) {
		$sql = "select position.Latitude, position.Longitude , route.ID_Route, position.ID_Position, job.ID_Job
				FROM position 
				INNER JOIN route ON position.ID_Position = route.ID_Position 
				INNER JOIN job ON route.ID_Job = job.ID_Job 
				WHERE job.ID_Job = {$id_job}";
		return DB::select($sql,[]);
	}

	// function select_id_job($id_job){
	// 	$sql = "select * from route where ID_Job = {$id_job}";
	// 	return DB::select($sql, []);
	// }

	function select_search($q){
		$sql = "select * from route where ID_Route like '%{$q}%'";
		return DB::select($sql, []);
	}

	function insert($id_job,$id_position){
		$sql = "insert into route (ID_Job,ID_Position) 
				values ({$id_job},{$id_position})";
		DB::insert($sql, []);
	}
	function update($id_job, $id_position, $sequence, $district, $time, $id_route){
		$sql = "update route 
			set 
				ID_Job 	     = {$id_job},
				ID_Position  = {$id_position}, 
				Sequence     = {$sequence},
				District     = {$district},
				Time 		 = {$time}
			where ID_Route = {$id_route}";
			// echo $sql;
		DB::update($sql, []);
	}
	
	function delete($id_route){
		$sql = "delete from route where ID_Route = {$id_route}";
		DB::delete($sql, []);
	}

}