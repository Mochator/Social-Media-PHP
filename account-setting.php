<?php
	include("login_session.php");  
	include("connection.php");
	$username = $_SESSION["Paces"];
	include("retrieve.php");
?>

<!DOCTYPE HTML>
<!--
	Visualize by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>PACES</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<script src="headInput.js"></script>
		<link rel="stylesheet" href="profile.css">
		
	</head>

	<body <?php include("bodyBg.php");?> >

		<!--Navigation bar-->
		<nav>
			<?php
			include("menu2.php");
			?>
		</nav>
		
		<div id="wrapper" class="container">
			<header class="container container-top">
				<h1>Account Setting</h1>
			</header>

			<div class="center">
			<section class="container inline-block width70 section align-left">

				<!--Javascript-->
				<!--Error Message-->
				<script src="information-window.js" type="text/javascript"></script>
				<!--Max Date Javascript-->
				<script src="max-date.js"></script>
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
				<!--Error Message-->
				<script src="information-window.js" type="text/javascript"></script>

				<form method="post" action="account-setting.php" enctype="multipart/form-data" id="account-form">

					<h2>Change Personal Information</h2>
					<label for="fname">First Name</label><br>
					<input type="text" name="fname" class="width30 input">
					<br><br>

					<label for="lname">Last Name</label><br>
					<input type="text" name="lname" class="width30 input">
					<br><br>

					<label for="dob">Date of Birth</label><br>
					<input type="date" name="dob" id="datefield" max="2019-01-01" min="1900-01-01" class="width30 input">
      				<br><br>	

      				<label for="gender">Gender</label><br>
      				<input type="radio" name="gender" value="Male">Male
      				<input type="radio" name="gender" value="Female">Female
      				<br><br>

      				<label for="nationality">Nationality</label><br>
      				<select name="nationality" class="width30 input">
      					<?php include("countrylist.php");
      					foreach ($countrylist as $country) {
      						if ($userRow["Nationality"] == $country) {
      							echo "<option name='nationality' selected value='".$country."'>".$country."</option>";			
      						} else {
      							echo "<option name='nationality' value='".$country."'>".$country."</option>";
      						}					
						}
      					?>
      				</select>
      				<br><br>

      				<hr>

					<h2>Change Email</h2>
					<label for="email">New Email</label><br>
					<input type="email" name="email" class="width30 input">
					<br><br>

					<hr>

					<h2>Change Password</h2>
					<label for="new_pw">New Password <span style="font-size: 10px;">(must be at least 8 characters with an uppercase, a lowercase and a number)</span></label><br>
					<input type="password" name="new_pw" class="width30 input" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password must be at least 8 characters with at least one uppercase, one lowercase and one number">
					<br><br>

					<label for="cfm_new_pw">Confirm New Password</label><br>
					<input type="password" name="cfm_new_pw" class="width30 input" title="This field's value must match with your password field">
					<br><br>
					
					<hr>

					<h2>Authentic Verification</h2>
					<label for="pw">Current Password</label><br>
					<input type="password" name="pw" class="width30 input" title="This field is required for email and password changes.">
					<br><br>

					<hr>

					<!--PHP Script for Color Picker visibility-->
					<?php
					if(is_null($userRow["Background"])) {
						$checkbox = ' ';
						$picker1 = "value=''";
						$picker2 = "value=''";
						$visibility = "style = 'visibility: hidden;'";
						
					} else {
						$checkbox = "checked='checked'";
						$picker1 = "value='".$bg[0]."'";
						$picker2 = "value='".$bg[1]."'";
						$visibility = "style = 'visibility: visible;'";
						
					}
					?>

					<input type="checkbox" name="checkbox_bg" id="checkbox_bg"<?php echo $checkbox;?> onchange="colorpicker()" value="default">
					<label for="background">I prefer using default background!</label><br><br>

					<span  id="bgcolor" <?php echo $visibility; ?> >
					<label for="bgcolor">Color Picker: </label>
					<input type="color" name="bgcolor1" class="width10" style="height: 1.5em;" <?php echo $picker1 ?>>
					<input type="color" name="bgcolor2" class="width10" style="height: 1.5em;" <?php echo $picker2 ?>>
					</span>

					<br><br>

					<input type="submit" name="submit" value="Save" class="width100 submit">
					
				</form>
			</section>
			<section class="container inline-block width20 section align-left">
				<p style="word-wrap: break-word;">
					Authentic Verification is required for email or password changes for security purpose.<br><br>
					Visit the links below for more informtion:
					<ul>
						<li><a href="terms-of-service.php" class="link">Terms of Services</a></li>
						<li><a href="privacy-policy.php" class="link">Privacy Policy</a></li>
					</ul>
				</p>
			</section>
		</div>
		</div>


		<!-- Footer -->
		<footer id="footer">
			<?php
			include("footer2.php")
			?>						
		</footer>		

	</body>
</html>

<!--PHP Code-->
<?php
if(isset($_POST["submit"])){

	//Exist check
	$fname_exist = 0;
	$lname_exist = 0;
	$dob_exist = 0;
	$gender_exist = 0;
	$nationality_exist = 0;
	$email_exist = 0;
	$newpw_exist = 0;
	$cfmpw_exist = 0;
	$pw_exist = 0;
	$checkbox = 0;

	//First name
	if(!empty($_POST["fname"])) {
		$fname_exist = 1;
	} else {
		$fname_exist = 0;
	}

	//Last name
	if(!empty($_POST["lname"])) {
		$lname_exist = 1;
	} else {
		$lname_exist = 0;
	}

	//DOB
	if(!empty($_POST["dob"])) {
		$dob_exist = 1;
	} else {
		$dob_exist = 0;
	}

	//Gender
	if(!empty($_POST["gender"])) {
		$gender_exist = 1;
	} else {
		$gender_exist = 0;
	}

	//Nationality
	if(!empty($_POST["nationality"])) {
		$nationality_exist = 1;
	} else {
		$fnationality_exist = 0;
	}

	//Email
	if(!empty($_POST["email"])) {
		$email_exist = 1;
	} else {
		$email_exist = 0;
	}

	//New password
	if(!empty($_POST["new_pw"])) {
		$newpw_exist = 1;
	} else {
		$newpw_exist = 0;
	}

	//Confirm new password
	if(!empty($_POST["cfm_new_pw"])) {
		$cfmpw_exist = 1;
	} else {
		$cfmpw_exist = 0;
	}

	//Password
	if(!empty($_POST["pw"])) {
		$pw_exist = 1;
	} else {
		$pw_exist = 0;
	}

	//Background colour checkbox
	if(isset($_POST["checkbox_bg"])) {
		$checkbox = 1;
	} else {
		$checkbox = 0;
	}


	if($fname_exist==1 || $lname_exist==1 || $dob_exist==1 || $gender_exist==1 || $nationality_exist==1 || $newpw_exist==1 || $cfmpw_exist==1 || $checkbox==1) {

		$fname_success = 0;
		$lname_success = 0;
		$dob_success = 0;
		$gender_success = 0;
		$nationality_success = 0;
		$newpw_success = 0;		
		$email_success = 0;
		$bg_success = 0;

		//First Name update
		if($fname_exist == 1) {
			$fname = $_POST["fname"];
			$fname = mysqli_real_escape_string($con, $fname);
			$fname = stripslashes($fname);
			$fname = htmlentities($fname);

			$fname_sql = "update user set First_name = '$fname' where User_id = '$id';";

			if ($run_fname = mysqli_query($con, $fname_sql)) {
				$fname_success = 1;
			} else {
				$fname_success = 0;
				echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Failed to update first name.<br>'; </script>";
			}		
		} else {
			$fname_success = 1;
		}

		//Last Name update
		if($lname_exist == 1) {
			$lname = $_POST["lname"];
			$lname = mysqli_real_escape_string($con, $lname);
			$lname = stripslashes($lname);
			$lname = htmlentities($lname);

			$lname_sql = "update user set Last_name = '$lname' where User_id = '$id';";

			if ($run_lname = mysqli_query($con, $lname_sql)) {
				$lname_success = 1;
			} else {
				$lname_success = 0;
				echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Failed to update last name.<br>'; </script>";
			}		
		} else {
			$lname_success = 1;
		}

		//DOB update
		if($dob_exist == 1) {
			$dob = date_format(date_create($_POST['dob']), "Y-m-d");
			$dob = mysqli_real_escape_string($con, $dob);
			$dob = stripslashes($dob);
			$dob = htmlentities($dob);

			$dob_sql = "update user set Dob = '$dob' where User_id = '$id';";

			if ($run_dob = mysqli_query($con, $dob_sql)) {
				$dob_success = 1;
			} else {
				$dob_success = 0;
				echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Failed to update date of birth.<br>'; </script>";
			}		
		} else {
			$dob_success = 1;
		}

		//Gender update
		if($gender_exist == 1) {
			$gender = $_POST["gender"];
			$gender = mysqli_real_escape_string($con, $gender);
			$gender = stripslashes($gender);
			$gender = htmlentities($gender);

			$gender_sql = "update user set Gender = '$gender' where User_id = '$id';";

			if ($run_gender = mysqli_query($con, $gender_sql)) {
				$gender_success = 1;
			} else {
				$gender_success = 0;
				echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Failed to update gender.<br>'; </script>";
			}		
		} else {
			$gender_success = 1;
		}

		//Nationality update
		if($nationality_exist == 1) {
			$nationality = $_POST["nationality"];
			$nationality = mysqli_real_escape_string($con, $nationality);
			$nationality = stripslashes($nationality);
			$nationality = htmlentities($nationality);

			$nationality_sql = "update user set Nationality = '$nationality' where User_id = '$id';";

			if ($run_nationality = mysqli_query($con, $nationality_sql)) {
				$nationality_success = 1;
			} else {
				$nationality_success = 0;
				echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Failed to update your nationality.<br>'; </script>";
			}		
		} else {
			$nationality_success = 1;
		}

		//Email update
		if($email_exist == 1 && $pw_exist == 1) {

			//Database pw
			$db_pw = $userRow["Password"];

			//Form pw
			$pw = $_POST['pw'];
			$pw = mysqli_real_escape_string($con, $pw);
			$pw = stripslashes($pw);
			$pw = htmlentities($pw);
			$pw = md5($pw);

			//Check pw similarity
			if($pw == $db_pw) {
				$email = $_POST["email"];
				$email = mysqli_real_escape_string($con, $email);
				$email = stripslashes($email);
				$email = htmlentities($email);

				$email_sql = "update user set Email = '$email' where User_id = '$id';";

				if ($run_email = mysqli_query($con, $email_sql)) {
					$email_success = 1;
				} else {
					$email_success = 0;
					echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Failed to update password.<br>'; </script>";
				}	
			} else {
				$email_success = 0;
				echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Current password incorrect!<br>'; </script>";
			}
		} else {
			$email_success = 1;
		}

		//Password update
		if($newpw_exist == 1 && $cfmpw_exist == 1 && $pw_exist == 1) {

			//Database pw
			$db_pw = $userRow["Password"];

			//Form pw
			$pw = $_POST['pw'];
			$pw = mysqli_real_escape_string($con, $pw);
			$pw = stripslashes($pw);
			$pw = htmlentities($pw);
			$pw = md5($pw);

			//New pw
			$new_pw = $_POST["new_pw"];
			$new_pw = mysqli_real_escape_string($con, $new_pw);
			$new_pw = stripslashes($new_pw);
			$new_pw = htmlentities($new_pw);
			$new_pw = md5($new_pw);

			//Confirm new pw 
			$cfm_new_pw = $_POST["cfm_new_pw"];
			$cfm_new_pw = mysqli_real_escape_string($con, $cfm_new_pw);
			$cfm_new_pw = stripslashes($cfm_new_pw);
			$cfm_new_pw = htmlentities($cfm_new_pw);
			$cfm_new_pw = md5($cfm_new_pw);

			//Checking boolean
			$db_same = 0; //database pw same
			$form_same = 0; //form pw same

			//Check current pw similarity
			if($pw == $db_pw) {
				$db_same = 1;	
			} else {
				$db_same = 0;
				echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Current password incorrect!<br>'; </script>";
			}

			//new pw similarity 
			if($new_pw == $cfm_new_pw) {
				$form_same = 1;
			} else {
				$form_same = 0;
				echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='New password doesn't match.<br>'; </script>";
			}

			//Update
			if($form_same == 1 && $db_same == 1) {
				$pw_sql = "update user set Password = '$new_pw' where User_id = '$id';";

				if ($run_pw = mysqli_query($con, $pw_sql)) {
					$pw_success = 1;
				} else {
					$pw_success = 0;
					echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Failed to update password.<br>'; </script>";
				}		
			}
		} else {
			$newpw_success = 1;
		}

		//Background colour update
		if($checkbox == 1) {

			//First colour
			$bgcolor1 = $_POST["bgcolor1"];
			$bgcolor1 = mysqli_real_escape_string($con, $bgcolor1);
			$bgcolor1 = stripslashes($bgcolor1);
			$bgcolor1 = htmlentities($bgcolor1);

			//Second colour
			$bgcolor2 = $_POST["bgcolor2"];
			$bgcolor2 = mysqli_real_escape_string($con, $bgcolor2);
			$bgcolor2 = stripslashes($bgcolor2);
			$bgcolor2 = htmlentities($bgcolor2);

			$bgcolor = $bgcolor1." ".$bgcolor2;

			$bg_sql = "update user set Background = '$bgcolor' where User_id = '$id';";

			if ($run_bg = mysqli_query($con, $bg_sql)) {
				$bg_success = 1;
			} else {
				$bg_success = 0;
				echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Failed to change background colour.<br>'; </script>";
				die(mysqli_error($con));
			}		
		} else {
			$bg_sql = "update user set Background = null where User_id = '$id';";

			if ($run_bg = mysqli_query($con, $bg_sql)) {
				$bg_success = 1;
			} else {
				$bg_success = 0;
				echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Failed to remove background colour.<br>'; </script>";
			}
		}

		/*
		echo $id;
		echo $fname_success;
		echo $lname_success;
		echo $dob_success;
		echo $gender_success;
		echo $nationality_success;
		echo $newpw_success;		
		echo $email_success;
		echo $bg_success;*/

		unset($_POST["submit"]);

		if($fname_success==1 && $lname_success==1 && $dob_success==1 && $gender_success==1 && $nationality_success==1 && $newpw_success==1 && $email_success==1 && $bg_success==1) {
			echo "<script>alert('Your account detail(s) was successfully updated!');setTimeout(window.location.href='account-setting.php', 2000);</script>";
		} else {
			echo "<script>document.getElementById('Error').style.display='block'; document.getElementById('error-title').innerHTML += 'Error!'; document.getElementById('error-content').innerHTML += 'There is an error in updating your account detail(s). :('</script>";
		}
	}
	unset($_POST["submit"]);
}
?>