<?php
	session_start();
	error_reporting(0);

	include 'connection.php';

	if($_SERVER['REQUEST_METHOD'] != "POST"){
		echo '<form method="post" action="">
				<table align="center" border="0">
					<tr>
						<td><input type="text" name="user_name" placeholder="Username" required>
							<span style="color:red;">* <sup>required</sup><span>
						</input></td>
					</tr>
					<tr>
						<td><input type="password" name="user_pass" placeholder="Password" required>
							<span style="color:red;">*<span>
						</input></td>
					</tr>
					<tr>
						<td><input type="password" name="user_pass_check" placeholder="Re-Password" required>
							<span style="color:red;">*<span>
						</input></td>
					</tr>
					<tr>
						<td><input type="email" name="registerEmail" placeholder="Email">
						</input></td>
					</tr>
					<tr>
						<td><button type="submit" name="submit">Sign Up</button></td>
					</tr>
				</table>
			</form>';
	}else{
		$error = array();

		if(!empty($_POST['user_name'])){
        //the user name exists
        if(!ctype_alnum($_POST['user_name'])){
            $errors[] = 'The username can only contain letters and digits.';
        }
        
        if(strlen($_POST['user_name']) > 15){
            $errors[] = 'The username cannot be longer than 15 characters.';
        }

        if(strlen($_POST['user_name']) < 6){
            $errors[] = 'The username must be at least 6 characters.';
        }

	    }else{
	        $errors[] = 'The username field must not be empty.';
	    }

	    if(!empty($_POST['user_pass']) && !empty($_POST['user_pass_check'])){
	    	//make sure password is right
	        if($_POST['user_pass'] != $_POST['user_pass_check']){
	            $errors[] = 'The two passwords did not match.';
	        }
	    }else{
	        $errors[] = 'The password and reconfimation password fields must not be empty.';
	    }

	    if(!empty($error)){
	    	foreach($error as $key => $value){
	    		echo $value.'<br>';
	    	}
	    }else{

	    	function getGUID(){
		        if (function_exists('com_create_guid')){
		            return com_create_guid();
		        }else{
		            mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
		            $charid = strtoupper(md5(uniqid(rand(), true)));
		            $hyphen = chr(45);// "-"
		            $uuid = substr($charid, 0, 8).$hyphen
		                .substr($charid, 8, 4).$hyphen
		                .substr($charid,12, 4).$hyphen
		                .substr($charid,16, 4).$hyphen
		                .substr($charid,20,12);// "}"
		            return $uuid;
		        }
		    }

		    $GUID = getGUID();

	    	$sql = "INSERT INTO 
    						internetofthing_users(
    							user_name, 
    							user_pass, 
    							user_email, 
    							user_access_token) 
					VALUES 
							('" . mysqli_real_escape_string($conn, $_POST['user_name']) . "', 
							'" . sha1($_POST['user_pass']) . "', 
							'" . mysqli_real_escape_string($conn, $_POST['user_email']) . "', 
							'" . mysqli_real_escape_string($conn, $GUID) . "')";

			$result = mysqli_query($conn, $sql);

			if(!$result){
				echo 'Unable to register. Please contact us!';
			}else{
				echo 'Sucessfully registered account!';
			}
	    }
	}

?>