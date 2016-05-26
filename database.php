<?php 
//connection credentials

$host = "localhost";
$user = "root";
$pass = "";
$db = "quizzer";

//Create mysqli boject
$mysqli = new mysqli($host, $user, $pass, $db);

//Error Handler
if($mysqli->connect_error)
{
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit();
}

 ?>