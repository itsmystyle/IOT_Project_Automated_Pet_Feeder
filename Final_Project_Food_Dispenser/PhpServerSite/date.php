<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$petdir = $_POST['pet_deviceId'];

	$arr = array();

	$filePath = fopen($petdir."/date.txt", "r");

	while($line = fgets($filePath)){
		$value = explode("\t", $line);
		foreach ($value as $key => $data) {
			array_push($arr, $data);
		}
	}

	echo json_encode(array("weather_date"=>$arr));
}

?>