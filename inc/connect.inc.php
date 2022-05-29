<?php 
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ebuybd";

	$con = mysqli_connect($servername,$username,$password,$dbname);

	if(!$con)die("Couldn't connet to SQL server".mysqli_connect_error());
	
?>