<?php
	session_start();
	if(!isset($_SESSION['Paces'])) {
		header("location: home.php");
	}
?>


