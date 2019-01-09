<?php
namespace App;
use Illuminate\Support\Facades\DB;
class PositionModel {

	//CONCAT Position
	function select_all() {
		$sql = "select ID_Position, CONCAT(Name,', ',House_number,' หมู่',Village,' ',Subdistrict,' ',City,' ',Province,' ',Zip_code) AS Name_Position FROM position INNER JOIN customer ON position.ID = customer.ID Order by Name";
		return DB::select($sql, []);
	}

	//เลือกโชว์ตำแหน่งเฉพาะ ID
	function select_id_customer($id_customer){
			$sql = "select * from Position where ID = {$id_customer}";
		return DB::select($sql, []);
	}

	function select() {
			$sql = "select * from position";
		return DB::select($sql, []);
	}

	function select_id($id_position){
		$sql = "select * from position where ID_Position = {$id_position}";
		return DB::select($sql, []);
	}

	//search Zip_code
	function select_search($zip_code) {
		$sql = "select * from position where Zip_code like '%{$zip_code}%'";
		return DB::select($sql, []);
	}

	function insert($ID,$House_number,$Village,$Subdistrict,$City,$Province,$Zip_code,$Latitude,$Longitude){
		$sql = "insert into 
				position (ID,House_number,Village,Subdistrict,City,Province,Zip_code,Latitude,Longitude) 
				values ({$ID},'{$House_number}','{$Village}','{$Subdistrict}','{$City}','{$Province}',
						'{$Zip_code}','{$Latitude}','{$Longitude}')";
		DB::insert($sql, []);
	}

	function update($ID,$House_number,$Village,$Subdistrict,$City,$Province,$Zip_code,$Latitude,$Longitude,
					$id_position) {
		$sql = "update position 
				set 
					ID 			 = {$ID},
					House_number = '{$House_number}', 
					Village      = '{$Village}',  
					Subdistrict     = '{$Subdistrict}', 
					City         = '{$City}',
					Province     = '{$Province}',
					Zip_code     = '{$Zip_code}',
					Latitude     = {$Latitude},
					Longitude    = {$Longitude}
				where ID_Position = {$id_position}";
		DB::update($sql, []);
	}

	function delete($id_position){
		$sql = "delete from position where ID_Position = {$id_position}";
		DB::delete($sql, []);
	}
}