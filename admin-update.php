<?php
include("login_session.php");  
	include("connection.php");
	$username = $_SESSION["Paces"];
	include("retrieve.php");

	if($userRow["Role"] == "Member") {
		echo "<script>alert('Access denied!', 'STOP RIGHT THERE');window.location.href='profile.php?username=$username';</script>";
	}

if(isset($_POST["account"])) {

	//Retrieve target user details
	$target_sql = "select * from user where User_id = '$target_id'";
	$run_target = mysqli_query($con, $target_sql);
	$target_row = mysqli_fetch_assoc($run_target);

	//Declaring variables
	$target_id = $_POST["id"];
	$fName = $_POST['fname'];
	$lName = $_POST['lname'];
	$dob = date_format(date_create($_POST['dob']), "Y-m-d");
	$gender = $_POST['gender'];
	$nationality = $_POST['nationality'];
	$email = $_POST['email'];
	$role = $_POST["role"];

	//Escape
	$fName = mysqli_real_escape_string($con, $fName);
	$lName = mysqli_real_escape_string($con, $lName);
	$dob = mysqli_real_escape_string($con, $dob);
	$gender = mysqli_real_escape_string($con, $gender);
	$nationality = mysqli_real_escape_string($con, $nationality);
	$email = mysqli_real_escape_string($con, $email);

	//Stripslash
	$fName = stripslashes($fName);
	$lName = stripslashes($lName);
	$dob = stripslashes($dob);
	$gender = stripslashes($gender);
	$nationality = stripslashes($nationality);
	$email = stripslashes($email);
	
	//Htmlentities
	$fName = htmlentities($fName);
	$lName = htmlentities($lName);
	$dob = htmlentities($dob);
	$gender = htmlentities($gender);
	$nationality = htmlentities($nationality);
	$email = htmlentities($email);

	//Encryption
	if(!empty($_POST["password"])) {
		$password = $_POST['password'];
		$password = mysqli_real_escape_string($con, $password);
		$password = stripslashes($password);
		$password = htmlentities($password);
		$password = md5($password);
	} else {
		$password = $target_row["Password"];
	}


	$sql="UPDATE user SET Email='$email', Password='$password', Gender='$gender', Nationality='$nationality', Dob='$dob', First_name = '$fName', Last_name = '$lName', Role = '$role' WHERE User_id= '$target_id';";

	if(mysqli_query($con,$sql)){
		mysqli_close($con);
		header('Location: admin-panel.php');
	}

} elseif(isset($_POST["profile"])) {

	//Declaring variables
	$target_id = $_POST["id"];

	//Bio
	$bio = $_POST['bio'];
	$bio = mysqli_real_escape_string($con, $bio);
	$bio = stripslashes($bio);
	$bio = htmlentities($bio);
	
	//Display Name
	$displayName = $_POST['display_name'];
	$displayName = mysqli_real_escape_string($con, $displayName);
	$displayName = stripslashes($displayName);
	$displayName = htmlentities($displayName);

	//Twitter
	if(!empty($_POST["tw"])) {
		$twitter = "https://twitter.com/".$_POST['tw'];
		$twitter = mysqli_real_escape_string($con, $twitter);
		$twitter = stripslashes($twitter);
		$twitter = htmlentities($twitter);
	} else {
		$twitter = null;
	}

	//Facebook
	if(!empty($_POST["fb"])) {
		$facebook = "https://facebook.com/".$_POST['fb'];
		$facebook = mysqli_real_escape_string($con, $facebook);
		$facebook = stripslashes($facebook);
		$facebook = htmlentities($facebook);
	} else {
		$facebook = null;
	}
	
	//Instagram
	if(!empty($_POST["ig"])) {
		$instagram = "https://instagram.com/".$_POST['ig'];
		$instagram = mysqli_real_escape_string($con, $instagram);
		$instagram = stripslashes($instagram);
		$instagram = htmlentities($instagram);
	} else {
		$instagram = null;
	}
	
	//Instagram
	if(!empty($_POST["ig"])) {
		$youtube = "https://youtube.com/".$_POST['yt'];
		$youtube = mysqli_real_escape_string($con, $youtube);
		$youtube = stripslashes($youtube);
		$youtube = htmlentities($youtube);
	} else {
		$youtube = null;
	}

	//Email
	$email = $_POST['email'];
	$email = mysqli_real_escape_string($con, $email);
	$email = stripslashes($email);
	$email = htmlentities($email);

	//Contact
	if(!empty($_POST["ig"])) {
	$contact = "https://wa.me/".$_POST['contact'];
	$contact = mysqli_real_escape_string($con, $contact);
	$contact = stripslashes($contact);
	$contact = htmlentities($contact);
		
	} else {
		$contact = null;
	}

	//Retrieve username
	$target_sql = "select * from user where User_id = '$target_id'";
	$run_target = mysqli_query($con, $target_sql);
	$target_row = mysqli_fetch_assoc($run_target);
	$target_username = $target_row["Username"];

	//Profile pic & Cover pic check existence
	$cpExist = 0;
	$ppExist = 0;


	//Cover Pic
	if($_FILES["cp"]["error"] == 4) {	
		$cpExist = 0;		
		$cp = $target_row["Cover_pic"];
	} else {
		$cpExist = 1;
	}

	//Profile Pic
	if($_FILES["pp"]["error"] == 4) {
		$ppExist = 0;
		$pp = $target_row["Profile_pic"];
	} else {
		$ppExist = 1;
	}

	//Profile pic & Cover pic success if exist
	$pp_success = 0;
	$cp_success = 0;

	//Date & Time for newname
	date_default_timezone_set("Asia/Kuala_Lumpur");
	$date = date_create();


	//PP update
	if($ppExist == 1) {
		//pp files
		$ppFile = $_FILES["pp"]["name"];
		$ppTmpFile = $_FILES["pp"]["tmp_name"];
		$ppFileType= pathinfo($ppFile,PATHINFO_EXTENSION);		
		//Image Checking
		$ppOk = 0;

		//Image size
		if($_FILES["pp"]["error"] == 1) {
			echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Sorry, image for profile pic is too large.<br>';</script>";
			$ppOk= 0;
		}

		//Check if it is an image
		$ppCheck = @getimagesize($ppTmpFile);
		if($ppCheck !== false) {
			$ppOk= 1;
		} else {
			echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Profile pic's file is not an image.<br>';</script>";
			$ppOk= 0;
		}

		// Allow certain file formats
		if($ppFileType != "jpg" && $ppFileType != "png" && $ppFileType != "jpeg" && $ppFileType != "gif" && $ppFileType != "JPEG" && $ppFileType != "PNG" && $ppFileType != "JPEG" && $ppFileType != "GIF") {
			echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Sorry, we only allow JPG, JPEG, PNG & GIF files for profile pic.<br>';</script>";
			$ppOk= 0;
		}

		//target location
		$pp_newName = $target_username."pp".date_format($date, "Ymdhis").".".$ppFileType;
		$pp_dir= "user/".$target_username."/";
		$pp = $pp_dir. $pp_newName;

		if ($ppOk == 1) {
			if (move_uploaded_file($ppTmpFile, $pp)) {
				$pp_sql = "update user set Profile_pic = '$pp' where User_id = '$target_id';";

				if ($run_pp = mysqli_query($con, $pp_sql)) {
					$pp_success = 1;
				} else {
					$pp_success = 0;
				}		
			}
		} else {
			echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Failed to update profile pic.<br>';</script>";
		}
	} else {
		$pp_success = 1;
	}

	//CP update
	if($cpExist == 1) {
		//pp files
		$cpFile = $_FILES["cp"]["name"];
		$cpTmpFile = $_FILES["cp"]["tmp_name"];
		$cpFileType= pathinfo($cpFile,PATHINFO_EXTENSION);		

		//Image Checking
		$cpOk = 0;

		//print_r($_FILES["cp"]);

		//Image size
		if($_FILES["cp"]["error"] == 1) {
			echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Sorry, image for cover pic is too large.<br>';</script>";
			$cpOk= 0;
		}

		//Check if it is an image
		$cpCheck = @getimagesize($cpTmpFile);
		if($cpCheck !== false) {
			$cpOk= 1;
		} else {
			echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Cover pic's file is not an image.<br>';</script>";
			$cpOk= 0;
		}

		//echo $cpOk;

		// Allow certain file formats
		if($cpFileType != "jpg" && $cpFileType != "png" && $cpFileType != "jpeg" && $cpFileType != "gif" && $cpFileType != "JPG" && $cpFileType != "PNG" && $cpFileType != "JPEG" && $cpFileType != "GIF" ) {
			echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Sorry, we only allow JPG, JPEG, PNG & GIF files for cover pic.<br>';</script>";
			$cpOk= 0;
		}

		//echo $cpOk;

		//target location
		$cp_newName = $target_username."cp".date_format($date, "Ymdhis").".".$cpFileType;
		$cp_dir= "user/".$target_username."/";
		$cp = $cp_dir. $cp_newName;

		if ($cpOk == 1) {
			if (move_uploaded_file($cpTmpFile, $cp)) {
				$cp_sql = "update user set Cover_pic = '$cp' where User_id = '$target_id';";

				if ($run_cp = mysqli_query($con, $cp_sql)) {
					$cp_success = 1;
				} else {
					$cp_success = 0;
				}		
			}
		} else {
			echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Failed to update cover pic.<br>';</script>";
		}
	} else {
		$cp_success = 1;
	}

	if ($cp_success == 1 && $pp_success == 1) {
		$sql="update user set Bio='$bio', Display_name='$displayName', Twitter='$twitter', Facebook='$facebook', Instagram='$instagram', Youtube = '$youtube', Contact_email = '$email', Contact = '$contact',Cover_pic = '$cp', Profile_pic = '$pp' where User_id= '$target_id';";
		if(mysqli_query($con,$sql)){
			mysqli_close($con);
			header('Location: admin-panel.php');
		} else {
			echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='";
			die(mysqli_error($con));
			echo "<br>';</script>";
		}
	}
} elseif(isset($_POST["image"])) {

	//Declaring variables
	$target_id = $_POST["id"];
	$caption = $_POST['caption'];
	$category = $_POST['category'];

	//Escape
	$caption = mysqli_real_escape_string($con, $caption);
	$category = mysqli_real_escape_string($con, $category);

	//Stripslash
	$caption = stripslashes($caption);
	$category = stripslashes($category);

	//Htmlentities
	$caption = htmlentities($caption);
	$category = htmlentities($category);

	//Retrieve username
	$target_sql = "select * from image inner join user on image.User_Id = user.User_id where Image_id = '$target_id'";
	$run_target = mysqli_query($con, $target_sql);
	$target_row = mysqli_fetch_assoc($run_target);
	$target_username = $target_row["Username"];

	//Profile pic & Cover pic check existence
	$imageExist = 0;

	//Profile Pic
	if($_FILES["img"]["error"] == 4) {
		$imageExist = 0;
		$image = $target_row["Image"];
	} else {
		$imageExist = 1;
	}

	//Profile pic & Cover pic success if exist
	$image_success = 0;

	//Date & Time for newname
	date_default_timezone_set("Asia/Kuala_Lumpur");
	$date = date_create();


	//Image update
	if($imageExist == 1) {
		//image files
		$imageFile = $_FILES["img"]["name"];
		$imageTmpFile = $_FILES["img"]["tmp_name"];
		$imageFileType= pathinfo($imageFile,PATHINFO_EXTENSION);	

		//Image Checking
		$imageOk = 0;

		//Image size
		if($_FILES["img"]["error"] == 1) {
			echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Sorry, uploading image is too large.<br>';</script>";
			$imageOk= 0;
		}

		//Check if it is an image
		$imageCheck = @getimagesize($imageTmpFile);
		if($imageCheck !== false) {
			$imageOk= 1;
		} else {
			echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Image file is not an image.<br>';</script>";
			$imageOk= 0;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF") {
			echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Sorry, we only allow JPG, JPEG, PNG & GIF files for uploads.<br>';</script>";
			$imageOk= 0;
		}

		//target location
		$image_newName = $target_username.date_format($date, "Ymdhis").".".$imageFileType;
		$image_dir= "user/".$target_username."/";
		$image = $image_dir. $image_newName;


		if ($imageOk == 1) {
			if (move_uploaded_file($imageTmpFile, $image)) {
				$image_success = 1;		
			} else {
				$image_success = 0;
				$image = $target_row["Image"];
			}
		} else {
			echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Failed to upload image.<br>';</script>";
		}
	}

	$image_sql = "update image set Image = '$image', Caption = '$caption', Category = '$category' where Image_id = '$target_id';";

	if (mysqli_query($con, $image_sql)) {
		mysqli_close($con);
		header('Location: admin-panel.php');
	} else {
		echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='";
			die(mysqli_error($con));
		echo "<br>';</script>";		
	}	
} else {
	header("Location: admin-panel.php");
}
if (isset($_POST["account"])){
	unset($_POST["account"]);
}
if (isset($_POST["profile"])){
	unset($_POST["profile"]);
}
if (isset($_POST["image"])){
	unset($_POST["image"]);
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
<body>
	<!--Error Message-->
	<script src="information-window.js" type="text/javascript"></script>
</body>
</html>