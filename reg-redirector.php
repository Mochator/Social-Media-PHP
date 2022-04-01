<?php
//Register redirector
session_start();
if (isset($_SESSION["Paces"])) {
	unset($_SESSION["Paces"]);
	session_destroy();
} 
header("Location: register.php");

?>