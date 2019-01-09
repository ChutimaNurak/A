<?php
namespace App;
use Illuminate\Support\Facades\DB;
class CustomerModel {
	
	function select(){
		$sql = "select * from customer";
		return DB::select($sql, []);
	}

	function select_id($id_customer){
		$sql = "select * from customer where ID = {$id_customer}";
		return DB::select($sql, []);
	}

	function select_search($q){
		$sql = "select * from customer where Name like '%{$q}%'";
		return DB::select($sql, []);
	}

	function insert($Name, $Telephone, $Email){
		$sql = "insert into customer (Name,Telephone,Email) 
				values ('{$Name}','{$Telephone}','{$Email}')";
		DB::insert($sql, []);
	}

	function update($Name, $Telephone, $Email,$id_customer){
		$sql = "update customer 
			set 
				Name 	  = '{$Name}',
				Telephone  = '{$Telephone}', 
				Email     = '{$Email}'
			where ID = {$id_customer}";
		DB::update($sql, []);
	}

	function delete($id_customer){
		$sql = "delete from customer where ID = {$id_customer}";
		DB::delete($sql, []);
	}
}