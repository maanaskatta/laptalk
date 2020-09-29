<?php
	include 'connect.php';
	session_start();
	session_unset();
	session_destroy();
	mysqli_close($conn);
	header("Location:index.html");

?>