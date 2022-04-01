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
</head>

<body <?php include("bodyBg.php");?> >
	<div class="tab">
		<a href="admin-panel.php" style="float:right;" class="tablink">Back</a>
	</div>
<?php
	$target_id = intval($_GET['id']);
	$sql = "Select * from user WHERE User_id= '$target_id'";
	$result = mysqli_query($con, $sql);
	while ($row = mysqli_fetch_assoc($result)) {
?>
<form action="admin-update.php" method="POST" class="container container-top container-bottom">

<input type="hidden" name="id" value="<?php echo $row['User_id'];?>"><br><br>

User ID:<br>
<input type="text" disabled value="<?php echo $row['User_id'];?>"><br><br>

Username:<br>
<input type="text" name="username" value="<?php echo $row['Username'];?>" required><br><br>

Email:<br>
<input type="email" name="email" value="<?php echo $row['Email'];?>" required><br><br>

Password:<br>
<input type="password" name="password"required><br><br>

First Name:<br>
<input type="text" name="fname" value="<?php echo $row['First_name'];?>" required><br><br>

Last Name:<br>
<input type="text" name="lname" value="<?php echo $row['Last_name'];?>" required><br><br>

Gender:<br>
<input type="radio" name="gender" value="Male" required <?php if($row['Gender'] == "Male") {?>checked="checked"<?php ;} ?> > Male 
<input type="radio" name="gender" value="Female" required <?php if($row['Gender'] == "Female") {?>checked="checked"<?php };?> > Female<br><br>

Nationality:<br>
<select name="nationality" class="input">
<?php include("countrylist.php");
	foreach ($countrylist as $country) {
		if ($row["Nationality"] == $country) {
			echo "<option name='nationality' selected value='".$country."'>".$country."</option>";			
		} else {
			echo "<option name='nationality' value='".$country."'>".$country."</option>";
    	}					
	}
   ?>
</select>

<br><br>

Date of Birth:<br>
<input type="date" name="dob" value="<?php echo $row['Dob'];?>" required> <br><br>

Role:<br>
<select name="role" class="input">
<?php
	echo "<option name='role' value='Member' ";
	if($row["Role"] == "Member") {
		echo "selected";
	}
	echo ">Member</option>";			
	echo "<option name='role' value='Admin' ";
	if($row["Role"] == "Admin") {
		echo "selected";
	}
	echo ">Admin</option>";

	if($userRow["Role"] == "Owner"){
		echo "<option name='role' value='Owner' ";
		if($row["Role"] == "Owner") {
			echo "selected";
		}
		echo ">Owner</option>";
	}

?>
</select>
<br><br>
<input type="submit" name="account" value="Submit">
<?php } ?>
</form>
</body>
</html>

