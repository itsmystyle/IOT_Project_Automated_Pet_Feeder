<?php
include "connection.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$access_token = $_POST['access_token'];

	$sql = 'SELECT 
				petlist_id, 
				petlist_name, 
				petlist_deviceId 
			FROM 
				internetofthing_petlist 
			WHERE 
				petlist_access_token="' . mysqli_real_escape_string($conn, $access_token) . '"';

	$result = mysqli_query($conn, $sql);
	if(!$result){
		echo 'failed retrieve data from database - petlist';
	}else{
		$arr = array();

		while($row = mysqli_fetch_assoc($result)){
			$petlist = array("petlist_id"=>$row['petlist_id'],
								"petlist_name"=>$row['petlist_name'],
								"petlist_deviceId"=>$row['petlist_deviceId']);
			array_push($arr, $petlist);
		}

		if(empty($arr)){
			echo json_encode(array("petlist"=>"empty"));
		}else{
			echo json_encode(array("petlist"=>$arr));
		}
	}
}

?>