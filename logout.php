<?php
	session_start();
	if(isset($_SESSION["Paces"])) {
		unset($_SESSION["Paces"]);
	}
	
	session_destroy();
	echo "<body style='linear-gradient(141deg, rgba(220,208,255,1) 0%, rgba(20,20,20,1) 100%); position: relative;'><div style='position:absolute; margin: auto; top:0; right: 0; left:0; bottom:0;'><h1 style='color: white;'>Redirecting you back to homepage...</h1></div></body>";
	header("Refresh:1; home.php");
?>