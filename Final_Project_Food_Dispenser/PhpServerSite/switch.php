<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$petdir = $_POST['pet_deviceId'];
	$value = file_get_contents($petdir."/switch.txt");
	$value = $value=='#'? '@' : '#';
	file_put_contents($petdir."/switch.txt", $value);

	$file = $petdir.'/date.txt';
	date_default_timezone_set('Asia/Taipei');
	if(file_get_contents($file) != "")
		$date = file_get_contents($file)."\t".date('Y-m-d h:i:sa', time());
	else 
		$date = date('Y-m-d h:i:sa', time());
	file_put_contents($file, $date);

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