<?php
	include("login_session.php");  
	include("connection.php");
	$username = $_SESSION["Paces"];
	include("retrieve.php");

	if($userRow["Role"] == "Member") {
		echo "<script>alert('Access denied!', 'STOP RIGHT THERE');window.location.href='profile.php?username=$username';</script>";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>PACES | Admin Panel</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<script src="headInput.js"></script>
	<link rel="stylesheet" href="profile.css">
	<!--Color picker Javascript-->
	<script>
		function colorpicker() {
			var checkbox = document.getElementById("checkbox_bg");
			var color = document.getElementById("bgcolor");

			if (checkbox.checked == true) {
				color.style.visibility = "visible";
			} else {
				color.style.visibility = "hidden";
			}
		}
	</script>
</head>

<body <?php include("bodyBg.php");?> >
	<div class="tab">
		<a href="admin-panel.php" style="float:right;" class="tablink">Back</a>
	</div>
<?php
	$target_id = intval($_GET['id']);
	$sql = "Select * from image WHERE Image_id= '$target_id'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
?>
<form action="admin-update.php" method="POST" class="container container-top container-bottom" enctype="multipart/form-data" >

<input type="hidden" name="id" value="<?php echo $row['Image_id'];?>"><br><br>

Image ID:<br>
<input type="text" disabled value="<?php echo $row['Image_id'];?>"><br><br>

User ID:<br>
<input type="text" disabled value="<?php echo $row['User_Id'];?>"><br><br>

Image:<br>
<input type="file" name="img" class="input"><br><br>

Caption:<br>
<textarea name="caption" class="width50 input" rows="4"><?php echo $row['Caption'];?></textarea><br><br>

Category:<br>
<input type="text" name = "category" value="<?php echo $row['Category'];?>"><br><br>

Timestamp:<br>
<input type="text" name="timestamp" disabled value="<?php echo $row['Timestamp'];?>"><br><br>

<input type="submit" name="image" value="Submit">


</form>
</body>
</html>



