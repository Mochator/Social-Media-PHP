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
				<h1>Profile Setting</h1>
			</header>

			<div class="center">
			<section class="container inline-block width70 section align-left">

				<!--Error Message-->
				<script src="information-window.js" type="text/javascript"></script>


				<form method="post" action="profile-setting.php" enctype="multipart/form-data" id="update-form">
					<h2>My Profile</h2>
					<label for="displayName">Display Name</label><br>
					<input type="text" name="displayname" class="width30 input">
					<br><br>
					<label for="bio">Bio</label><br>
					<textarea name="bio" form="update-form" class="width50 input" rows="4"></textarea>
					<br><br>
					<label for="pp">Profile Picture</label><br>
					<input type="file" name="pp" class="input">
					<br><br>
					<label for="cp">Cover Picture</label><br>
					<input type="file" name="cp" class="input">
					<br><br>
					<input type="submit" name="profile" value="Update" class="width100 submit">
					<br><br>
				</form>
				<form method="post" action="profile-setting.php" enctype="multipart/form-data" id="social-form">
					<hr>
					<h2>Social Media</h2>
					<label for="tw">Twitter</label><br>
					<input type="text" name="xtw"value="https://twitter.com/" disabled="disabled" class="input">
					<span> </span>
					<input type="text" name="tw" class="width50 input">
					<br><br>

					<label for="fb">Facebook</label><br>
					<input type="text" name="xfb" value="https://facebook.com/" disabled="disabled" class="input">
					<span> </span>
					<input type="text" name="fb" class="width50 input">
					<br><br>

					<label for="ig">Instagram</label><br>
					<input type="text" name="xig" value="https://instagram.com/" disabled="disabled" class="input">
					<span> </span>
					<input type="text" name="ig" class="width50 input">
					<br><br>

					<label for="contact">Contact</label><br>
					<select class="width10 input">
						<?php include("phone-code.php");
							foreach ($countryArray as $country) {
      								echo "<option name='xcontact' value='".$country['code']."'>".$country['code']."</option>";
							}
						?>
					</select>
					<span> </span>
					<input type="text" name="contact" class="width50 input" pattern="\d*" title="Numbers only!">
					<br><br>

					<label for="email">Display Email</label><br>
					<input type="email" name="email" class="width50 input">
					<br><br>

					<label for="yt">Youtube Channel</label><br>
					<input type="text" name="xyt" value="https://youtube.com/" disabled="disabled" class="input">
					<span> </span>
					<input type="text" name="yt" class="width50 input">
					<br><br>

					<input type="submit" name="social" value="Save" class="width100 submit">
					<br>
				</form>
			</section>
			<section class="container inline-block width20 section align-left">
				<p style="word-wrap: break-word;">
					Dear all users<br><br>
					Please ensure your uploads and contents are adhered on the Terms of Service of Paces, and you have read on our Privacy Policy. Any inappropriate contents published will be removed by our Paces moderators and you are at risk of getting suspended temporarily or permanently. For more information regarding our terms, you may refer to:
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


<!--PHP Script-->
<?php

//Profile udpdate
if (isset($_POST["profile"])){

	//Exist check
	$dnameExist = 0;
	$bioExist = 0;
	$cpExist = 0;
	$ppExist = 0;

	//Display Name
	if(!empty($_POST["displayname"])) {
		$dnameExist = 1;
	} else {
		$dnameExist = 0;
	}

	//Bio
	if(!empty($_POST["bio"])) {
		$bioExist = 1;
	} else {
		$bioExist = 0;
	}

	//Cover Pic
	if($_FILES["cp"]["error"] == 4) {	
		$cpExist = 0;
	} else {
		$cpExist = 1;
	}

	//Profile Pic
	if($_FILES["pp"]["error"] == 4) {
		$ppExist = 0;
	} else {
		$ppExist = 1;
	}

	//Date & Time
	date_default_timezone_set("Asia/Kuala_Lumpur");
	$date = date_create();

	//Test Run
	/*echo $dnameExist;
	echo $bioExist;
	echo $ppExist;
	echo $cpExist;

	print_r($_FILES["cp"]);
	print_r($_FILES["pp"]);*/

	if ($dnameExist == 0 && $bioExist == 0 && $cpExist == 0 && $ppExist == 0) {
		echo "<script>document.getElementById('information').style.display='block'; document.getElementById('information-title').innerHTML = 'Ops!'; document.getElementById('information-content').innerHTML += 'No changes has been made.<br>Perhaps update your bio?'</script>";
	} else {

		$dname_success = 0;
		$bio_success = 0;
		$cp_success = 0;
		$pp_success = 0;

		//Display Name update
		if($dnameExist == 1) {
			$displayname = $_POST["displayname"];
			$displayname = mysqli_real_escape_string($con, $displayname);
			$displayname = stripslashes($displayname);
			$displayname = htmlentities($displayname);

			$dname_sql = "update user set Display_name = '$displayname' where User_id = '$id';";

			if ($run_dname = mysqli_query($con, $dname_sql)) {
				$dname_success = 1;
			} else {
				$dname_success = 0;
				echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Failed to update display name.<br>'; </script>";
			}		
		} else {
			$dname_success = 1;
		}

		//Bio update
		if($bioExist == 1) {
			$bio = $_POST["bio"];
			$bio = mysqli_real_escape_string($con, $bio);
			$bio = stripslashes($bio);
			$bio = htmlentities($bio);

			$bio_sql = "update user set Bio = '$bio' where User_id = '$id';";

			if ($run_dname = mysqli_query($con, $bio_sql)) {
				$bio_success = 1;
			} else {
				$bio_success = 0;
				echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Failed to update bio.<br>'; </script>";
			}		
		} else {
			$bio_success = 1;
		}

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
			if($ppFileType != "jpg" && $ppFileType != "png" && $ppFileType != "jpeg" && $ppFileType != "gif" && $ppFileType != "JPG" && $ppFileType != "PNG" && $ppFileType != "JPEG" && $ppFileType != "GIF" ) {
				echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Sorry, we only allow JPG, JPEG, PNG & GIF files for profile pic.<br>';</script>";
				$ppOk= 0;
			}

			//target location
			$pp_newName = $username."pp".date_format($date, "Ymdhis").".".$ppFileType;
			$pp_dir= "user/".$username."/";
			$pp = $pp_dir. $pp_newName;

			if ($ppOk == 1) {
				if (move_uploaded_file($ppTmpFile, $pp)) {
					$pp_sql = "update user set Profile_pic = '$pp' where User_id = '$id';";

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

		if ($dname_success==1 && $bio_success==1 && $cp_success==1 && $pp_success==1) {
			echo "<script>document.getElementById('information').style.display='block'; document.getElementById('information-title').innerHTML += 'Update Success!'; document.getElementById('information-content').innerHTML += 'Your profile changes successfully updated!'</script>";
		} else {
			echo "<script>document.getElementById('Error').style.display='block'; document.getElementById('error-title').innerHTML += 'Error!'; document.getElementById('error-content').innerHTML += 'TThere is an error in updating your profile. :('</script>";
		}

		//CP update
		if($cpExist == 1) {
			//pp files
			$cpFile = $_FILES["cp"]["name"];
			$cpTmpFile = $_FILES["cp"]["tmp_name"];
			$cpFileType= pathinfo($cpFile,PATHINFO_EXTENSION);		

			//Image Checking
			$cpOk = 0;

			print_r($_FILES["cp"]);

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

			// Allow certain file formats
			if($cpFileType != "jpg" && $cpFileType != "png" && $cpFileType != "jpeg" && $cpFileType != "gif" && $cpFileType != "JPG" && $cpFileType != "PNG" && $cpFileType != "JPEG" && $cpFileType != "GIF" ) {
				echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Sorry, we only allow JPG, JPEG, PNG & GIF files for cover pic.<br>';</script>";
				$cpOk= 0;
			}

			//target location
			$cp_newName = $username."cp".date_format($date, "Ymdhis").".".$cpFileType;
			$cp_dir= "user/".$username."/";
			$cp = $cp_dir. $cp_newName;

			if ($cpOk == 1) {
				if (move_uploaded_file($cpTmpFile, $cp)) {
					$cp_sql = "update user set Cover_pic = '$cp' where User_id = '$id';";

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

		//echo $dname_success;
		//echo $bio_success;
		//echo $cp_success;
		//echo $pp_success;

		//Unset submit button
		unset($_POST["profile"]);
		if(isset($_POST["social"])) {
			unset($_POST["social"]);
		}

		if ($dname_success==1 && $bio_success==1 && $cp_success==1 && $pp_success==1) {
			echo "<script>alert('Your profile detail(s) was successfully updated!');setTimeout(window.location.href='profile-setting.php', 2000);</script>";
		} else {
			echo "<script>document.getElementById('Error').style.display='block'; document.getElementById('error-title').innerHTML += 'Error!'; document.getElementById('error-content').innerHTML += 'There is an error in updating your profile. :('</script>";
		}

	}

	//Unset submit button
	unset($_POST["profile"]);
	if(isset($_POST["social"])) {
		unset($_POST["social"]);
	}
}

//Social update
if (isset($_POST["social"])){

	//Exist check
	$twExist = 0;
	$fbExist = 0;
	$igExist = 0;
	$contactExist = 0;
	$emailExist = 0;
	$ytExist = 0;

	//Twitter
	if(!empty($_POST["tw"])) {
		$twExist = 1;
	} else {
		$twExist = 0;
	}

	//Facebook
	if(!empty($_POST["fb"])) {
		$fbExist = 1;
	} else {
		$fbExist = 0;
	}

	//Instagram
	if(!empty($_POST["ig"])) {
		$igExist = 1;
	} else {
		$igExist = 0;
	}

	//Contact
	if(!empty($_POST["contact"])) {
		$contactExist = 1;
	} else {
		$contactExist = 0;
	}

	//Display email
	if(!empty($_POST["email"])) {
		$emailExist = 1;
	} else {
		$emailExist = 0;
	}

	//Youtube
	if(!empty($_POST["yt"])) {
		$ytExist = 1;
	} else {
		$ytExist = 0;
	}

	if ($twExist == 0 && $fbExist == 0 && $igExist == 0 && $contactExist == 0 && $emailExist == 0 && $ytExist == 0) {
		echo "<script>document.getElementById('information').style.display='block'; document.getElementById('information-title').innerHTML = 'Ops!'; document.getElementById('information-content').innerHTML += 'No changes has been made.'</script>";
	} else {

		$tw_success = 0;
		$fb_success = 0;
		$ig_success = 0;
		$contact_success = 0;
		$email_success = 0;
		$yt_success = 0;

		//Twitter update
		if($twExist == 1) {
			$tw = "https://twitter.com/".$_POST["tw"];
			echo $tw;
			$tw = mysqli_real_escape_string($con, $tw);
			$tw = stripslashes($tw);
			$tw = htmlentities($tw);

			$tw_sql = "update user set Twitter = '$tw' where User_id = '$id';";

			if ($run_tw = mysqli_query($con, $tw_sql)) {
				$tw_success = 1;
			} else {
				$tw_success = 0;
				echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Failed to update your Twitter.<br>'; </script>";
			}		
		} else {
			$tw_success = 1;
		}

		//Facebook update
		if($fbExist == 1) {
			$fb = "https://facebook.com/".$_POST["fb"];
			$fb = mysqli_real_escape_string($con, $fb);
			$fb = stripslashes($fb);
			$fb = htmlentities($fb);

			$fb_sql = "update user set Facebook = '$fb' where User_id = '$id';";

			if ($run_fb = mysqli_query($con, $fb_sql)) {
				$fb_success = 1;
			} else {
				$fb_success = 0;
				echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Failed to update your Facebook.<br>'; </script>";
			}		
		} else {
			$fb_success = 1;
		}

		//Instagram update
		if($igExist == 1) {
			$tw = "https://instagram.com/".$_POST["ig"];
			$tw = mysqli_real_escape_string($con, $ig);
			$ig = stripslashes($ig);
			$ig = htmlentities($ig);

			$ig_sql = "update user set Instagram = '$ig' where User_id = '$id';";

			if ($run_ig = mysqli_query($con, $ig_sql)) {
				$ig_success = 1;
			} else {
				$ig_success = 0;
				echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Failed to update your Instagram.<br>'; </script>";
			}		
		} else {
			$ig_success = 1;
		}

		//Contact update
		if($contactExist == 1) {
			$contact = "https://wa.me/".$_POST["xcontact"].$_POST["contact"];
			$contact = mysqli_real_escape_string($con, $contact);
			$contact = stripslashes($contact);
			$contact = htmlentities($contact);

			$contact_sql = "update user set Contact = '$contact' where User_id = '$id';";

			if ($contact_tw = mysqli_query($con, $contact_sql)) {
				$contact_success = 1;
			} else {
				$contact_success = 0;
				echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Failed to update your contact.<br>'; </script>";
			}		
		} else {
			$contact_success = 1;
		}

		//Display Email update
		if($emailExist == 1) {
			$email = $_POST["email"];
			$email = mysqli_real_escape_string($con, $email);
			$email = stripslashes($email);
			$email = htmlentities($email);

			$email_sql = "update user set Display_email = '$email' where User_id = '$id';";

			if ($run_email = mysqli_query($con, $email_sql)) {
				$email_success = 1;
			} else {
				$email_success = 0;
				echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Failed to update your display email.<br>'; </script>";
			}		
		} else {
			$email_success = 1;
		}

		//Youtube update
		if($igExist == 1) {
			$yt = "https://youtube.com/".$_POST["yt"];
			$yt = mysqli_real_escape_string($con, $yt);
			$yt = stripslashes($yt);
			$yt = htmlentities($yt);

			$yt_sql = "update user set Youtube = '$yt' where User_id = '$id';";

			if ($run_yt = mysqli_query($con, $yt_sql)) {
				$yt_success = 1;
			} else {
				$yt_success = 0;
				echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Failed to update your Youtube Channel.<br>'; </script>";
			}		
		} else {
			$yt_success = 1;
		}

		//Unset submit button
		unset($_POST["social"]);
		if(isset($_POST["profile"])){
			unset($_POST["profile"]);
		}

		if ($tw_success==1 && $fb_success==1 && $ig_success==1 && $contact_success==1 && $email_success==1 && $yt_success==1) {
			echo "<script>alert('Your social detail(s) was successfully updated!');setTimeout(window.location.href='profile-setting.php', 2000);</script>";
		} else {
			echo "<script>document.getElementById('Error').style.display='block'; document.getElementById('error-title').innerHTML += 'Error!'; document.getElementById('error-content').innerHTML += 'There is an error in updating your social account(s). :('</script>";
		}
	}

	//Unset submit button
	unset($_POST["social"]);
	if(isset($_POST["profile"])){
		unset($_POST["profile"]);
	}
}
?>