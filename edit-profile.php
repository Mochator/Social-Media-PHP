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

<body<?php include("bodyBg.php");?> >
	<div class="tab">
		<a href="admin-panel.php" style="float:right;" class="tablink">Back</a>
	</div>
<?php
	$target_id = intval($_GET['id']);
	$sql = "Select * from user WHERE User_id= '$target_id'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
?>
<form action="admin-update.php" method="POST" class="container container-top container-bottom" enctype="multipart/form-data" >

<input type="hidden" name="id" value="<?php echo $row['User_id'];?>"><br><br>

User ID:<br>
<input type="text" disabled value="<?php echo $row['User_id'];?>"><br><br>

Username:<br>
<input type="text" disabled value="<?php echo $row['Username'];?>"><br><br>

Display Name:<br>
<input type="text" name="display_name" value="<?php echo $row['Display_name'];?>" required><br><br>

Bio:<br>
<textarea name="bio" class="width50 input" rows="4"><?php echo $row['Bio'];?></textarea><br><br>

Profile Pic:<br>
<input type="file" name="pp" class="input"><br><br>

Cover Pic:<br>
<input type="file" name="cp" class="input"><br><br>

Twitter:<br>
<input type="text" name="xtw"value="https://twitter.com/" disabled="disabled" class="input">
<span> </span>
<input type="text" name="tw" class="width50 input" value="<?php echo str_replace('https://twitter.com/', '',$row['Twitter']);?>">
<br><br>

Facebook:<br>
<input type="text" name="xfb" value="https://facebook.com/" disabled="disabled" class="input">
<span> </span>
<input type="text" name="fb" class="width50 input" value="<?php echo str_replace('https://facebook.com/', '',$row['Facebook']);?>">
<br><br>

Instagram:<br>
<input type="text" name="xig" value="https://instagram.com/" disabled="disabled" class="input">
<span> </span>
<input type="text" name="ig" class="width50 input" value="<?php echo str_replace('https://instagram.com/', '',$row['Instagram']);?>">
<br><br>

Contact:<br>
<input type="text" name="contact" class="width50 input" pattern="\d*" title="Numbers only!" value="<?php echo str_replace('https://wa.me/', '',$row['Contact']);?>">
<br><br>

Youtube:<br>
<input type="text" name="xyt" value="https://youtube.com/" disabled="disabled" class="input">
<span> </span>
<input type="text" name="yt" class="width50 input" value="<?php echo str_replace('https://youtube.com/', '',$row['Youtube']);?>">
<br><br>

Display Email:<br>
<input type="email" name="email" class="width50 input" value="<?php echo $row['Contact_email'];?>">
<br><br>

<?php
if(is_null($row["Background"])) {
	$checkbox = ' ';
	$picker1 = "value=''";
	$picker2 = "value=''";
	$visibility = "style = 'visibility: hidden;'";
						
} else {
	$checkbox = "checked='checked'";
	$bg = explode(" ", $row["Background"]);
	$picker1 = "value='".$bg[0]."'";
	$picker2 = "value='".$bg[1]."'";
	$visibility = "style = 'visibility: visible;'";						
}
?>

<input type="checkbox" name="checkbox_bg" id="checkbox_bg" <?php echo $checkbox;?> onchange="colorpicker()" value="default">
<label for="background">I prefer using default background!</label><br><br>

<span  id="bgcolor" <?php echo $visibility; ?> >
<label for="bgcolor">Color Picker: </label>
<input type="color" name="bgcolor1" class="width10" style="height: 1.5em;" <?php echo $picker1; ?>>
<input type="color" name="bgcolor2" class="width10" style="height: 1.5em;" <?php echo $picker2; ?>>
</span>

<br><br>
<input type="submit" name="profile" value="Submit">


</form>
</body>
</html>



