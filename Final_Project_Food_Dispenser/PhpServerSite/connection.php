<?php
$server = 'localhost';
$username   = '';
$password   = '';
$database   = '';
$conn = mysqli_connect($server, $username,  $password);
 
if($conn == null){
    exit('Error: could not establish database connection');
}

if(!mysqli_select_db($conn, $database)){
    exit('Error: could not select the database');
}
?>