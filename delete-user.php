<?php
include("login_session.php");  
	include("connection.php");
	$username = $_SESSION["Paces"];
	include("retrieve.php");

	if($userRow["Role"] == "Member") {
		echo "<script>alert('Access denied!', 'STOP RIGHT THERE');window.location.href='profile.php?username=$username';</script>";
	}

$target_id = intval($_GET['id']);
$result = mysqli_query($con, "delete from favourite where User_Id= '$target_id'");
$result = mysqli_query($con, "delete from subscribe where User_Id= '$target_id'");
$result = mysqli_query($con, "delete from image where User_Id= '$target_id'");
$result = mysqli_query($con, "delete from user where User_id= '$target_id'");
mysqli_close($con);
header("Location: admin-panel.php");
?>