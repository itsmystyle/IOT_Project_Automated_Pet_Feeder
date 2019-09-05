<?php
	session_start();
	error_reporting(0);

	include 'connection.php';

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$sql = "SELECT 
                        user_name,
                        user_access_token
                    FROM
                        internetofthing_users
                    WHERE
                        user_name = '" . mysqli_real_escape_string($conn, $_POST['user_name']) . "'
                    AND
                        user_pass = '" . sha1($_POST['user_pass']) . "'";

        $result = mysqli_query($conn, $sql);

        if(!$result){
        	echo 'Unable to select items from database.';
        	exit;
        }else{
        	
        	if(mysqli_num_rows($result) == 0){
        		$response = array("secure"=>"UNAUTHORIZED");
        	}else{
        		while($row = mysqli_fetch_assoc($result)){
        			$response = array("secure"=>"AUTHORIZED", "access-token"=>$row['user_access_token']);
        		}
        	}

        	echo json_encode(array("web_server"=>$response));
        }
	}
?>
