<?php
	header('Content-Type: application/json');
	$objConnect = mysql_connect("localhost","root","");
	$objDB = mysql_select_db("path");
	mysql_query("SET NAMES UTF8");

	$strSQL = "SELECT position.Latitude, position.Longitude , route.ID_Route, position.ID_Position, job.ID_Job
				FROM position 
				INNER JOIN route ON position.ID_Position = route.ID_Position 
				INNER JOIN job ON route.ID_Job = job.ID_Job 
				WHERE job.ID_Job = {$id_job}";
				// console.log( $id_job)
	$objQuery = mysql_query($strSQL);
	$resultArray = array();
	while($obResult = mysql_fetch_array($objQuery))
	{
	array_push($resultArray,$obResult);
	}

	mysql_close($objConnect);

	echo json_encode($resultArray);
	?>