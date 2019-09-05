<?php
include "connection.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$pet_name = $_POST['pet_name'];
	$pet_deviceId = $_POST['pet_deviceId'];
	$pet_access_token = $_POST['pet_access_token'];

	$sql = 'SELECT 
				user_access_token 
			FROM 
				internetofthing_users 
			WHERE 
				user_access_token="' . mysqli_real_escape_string($conn, $pet_access_token) . '"';

	$result = mysqli_query($conn, $sql);
	if(!$result){
		echo 'failed retrieve data from database';
	}else{

		if(mysqli_num_rows($result) == 0){
			echo 'Access denied. (User data not found)';
			exit;
		}

		$sql = "INSERT INTO 
							internetofthing_petlist(
								petlist_name, 
								petlist_deviceId, 
								petlist_access_token) 
				VALUES 
							('" . mysqli_real_escape_string($conn, $pet_name) . "', 
							'" . mysqli_real_escape_string($conn, $pet_deviceId) . "', 
							'" . mysqli_real_escape_string($conn, $pet_access_token) . "')";

		$result = mysqli_query($conn, $sql);

		if(!$result){
			echo 'failed sql query';
		}else{
			$createDir = mkdir($pet_deviceId);
			chmod($pet_deviceId, 0755);
			
			if(!$createDir){
				echo json_encode(array("petlist" => array('state' => "failed_mkdir")));
			}else{
				$srcFile = array();
				array_push($srcFile, "switch.txt");
				array_push($srcFile, "date.txt");

				$dntFile = $pet_deviceId;

				foreach ($srcFile as $key => $value) {
					copy($value, $dntFile."/".$value);
					chmod($dntFile."/".$value, 0755);
				}

				echo json_encode(array("petlist" => array("state" => "new_pet_added")));
			}
		}

	}
}

?>