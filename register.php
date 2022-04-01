<?php	
	include("connection.php");
	session_start();
	if(isset($_SESSION["Paces"])) {
		unset($_SESSION["Paces"]);
		session_destroy();
	}
	
?>

<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PACES | Register</title>
	<script src="headInput.js" type="text/javascript"></script>
	<link href="home.css" type="text/css" rel="stylesheet">
	<link href='autoSlide.css' type='text/css' rel='stylesheet'>
</head>
<body>
<!--Layout-->
	<!--Background-->
	<header class="top">
		<?php
			include("background.php");
		?>
		<nav>
			<?php
				include("menu.php");
			?>
		</nav>
	</header>

	<!--Article-->
	<article class='container'>
		<div class="content-title">
			<h1>Register An Account!</h1>
		</div>
    		<div class="errorMsg" id="pwNotMatch">Password doesn't match!</div>
      		<div class="errorMsg" id="emailExist">Email has been registered! Please contact us via email or help centre to reset password.</div>
      		<div class="errorMsg" id="tacNotChecked">Please agree to our Terms & Conditions before using Paces.</div>
      		<div class="errorMsg" id="usernameTaken">This username is not available!</div>			
		</div>
		<!--Form-->
		<div class="content-container"> 
			<form method="post" action="register.php" enctype="multipart/form-data" >
				<div class="register-section" style="">
					<label for="firstName">First Name</label><br>
					<input type="text" name="firstName" class="width70" required>
					<br><br>
					<label for="lastName">Last Name</label><br>
					<input type="text" name="lastName" class="width70" required>
					<br><br>
					<label for="dob">Date of Birth</label><br>
					<input type="date" name="dob" id="datefield" max="2019-01-01" min="1900-01-01" class="width70" required>
      				<br><br>	
      				<label for="gender">Gender</label><br>
      				<input type="radio" name="gender" value="Male" required>Male
      				<input type="radio" name="gender" value="Female" required>Female
      				<br><br>
      				<label for="nationality">Nationality</label><br>
      				<select name="nationality" class="width70">
      					<?php include("countrylist.php");
      					foreach ($countrylist as $country) {
  							echo "<option name='nationality' value='".$country."'>".$country."</option>";
						}
      					?>
      				</select>
      				<br><br>
				</div>
				<div class="register-section">
					<label for="email">Email</label><br>
					<input type="email" name="email" class="width70" style="text-transform: lowercase;" required>
					<br><br>
					<label for="password">Password <span style="font-size: 10px;">(must be at least 8 characters with an uppercase, a lowercase and a number)</span></label><br>
					<input type="password" name="password" class="width70" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password must be at least 8 characters with at least one uppercase, one lowercase and one number" required>
					<br><br>
					<label for="cfmPassword">Confirm Password</label><br>
					<input type="password" name="cfmPassword" class="width70" title="This field's value must match with your password field" required>
					<br><br>
					<input type="checkbox" name="tac" title="Please agree with all our Terms and Condition to proceed." required>
					<label for="tac">
						I have read and agree with the 
						<a href="terms-and-condition-of-use.php" target="_blank" style="text-decoration: none;">Terms and Condition of Use</a>, 
						<a href="terms-of-service.php" target="_blank" style="text-decoration: none;">Terms of Service</a> and 
						<a href="privacy-policies.php" target="_blank" style="text-decoration: none;">Privacy Policy</a> of Paces.
					</label>
					<br><br>
					<hr>
					<br>
					<label for="username">Pick your username!</label><br>
					<input type="text" name="username" class="width70" style="text-transform: lowercase;" pattern="[^' ']+[a-z0-9-_.]{1,20}" required>
					<br><br>
					<input type="submit" name="submit" value="Register!" class="width70">
				</div>
			</form>

			<!--Max Date Javascript-->
			<script src="max-date.js"></script>

	</article>

	<!--Footer-->
	<footer class="container">
		<?php
			include("footer.php");
		?>
	</footer>

	<!--Register php-->
	<?php
		if(isset($_POST['submit'])) {

			//Check terms
			if(isset($_POST['tac'])) {

				//Declaring variables
				$fName = $_POST['firstName'];
				$lName = $_POST['lastName'];
				$dob = date_format(date_create($_POST['dob']), "Y-m-d");
				$gender = $_POST['gender'];
				$nationality = $_POST['nationality'];
				$email = $_POST['email'];
				$password = $_POST['password'];
				$cfmPassword = $_POST['cfmPassword'];
				$username = $_POST['username'];

				//Escape
				$fName = mysqli_real_escape_string($con, $fName);
				$lName = mysqli_real_escape_string($con, $lName);
				$dob = mysqli_real_escape_string($con, $dob);
				$gender = mysqli_real_escape_string($con, $gender);
				$nationality = mysqli_real_escape_string($con, $nationality);
				$email = mysqli_real_escape_string($con, $email);
				$password = mysqli_real_escape_string($con, $password);
				$cfmPassword = mysqli_real_escape_string($con, $cfmPassword);
				$username = mysqli_real_escape_string($con, $username);

				//Stripslash
				$fName = stripslashes($fName);
				$lName = stripslashes($lName);
				$dob = stripslashes($dob);
				$gender = stripslashes($gender);
				$nationality = stripslashes($nationality);
				$email = stripslashes($email);
				$password = stripslashes($password);
				$cfmPassword = stripslashes($cfmPassword);
				$username = stripslashes($username);

				//Htmlentities
				$fName = htmlentities($fName);
				$lName = htmlentities($lName);
				$dob = htmlentities($dob);
				$gender = htmlentities($gender);
				$nationality = htmlentities($nationality);
				$email = htmlentities($email);
				$password = htmlentities($password);
				$cfmPassword = htmlentities($cfmPassword);
				$username = htmlentities($username);

				//Change to lowercase
				$username = strtolower($username);

				//Encryption
				$password = md5($password);
				$cfmPassword = md5($cfmPassword);

				//Declaring boolean
				$booPw = false;
				$booEmail = false;
				$booUsername = false;

				//Reset error message block
				echo "<script>document.getElementById('pwNotMatch').style.display = 'none';</script>";
				echo "<script>document.getElementById('emailExist').style.display = 'none';</script>";
				echo "<script>document.getElementById('usernameTaken').style.display = 'none';</script>";

				//Check PW
				if($password === $cfmPassword) {
					$booPw = true;
					//echo $booPw;
				} else {
					echo "<script>document.getElementById('pwNotMatch').style.display = 'block';</script>";
				}

				//Check email
				$emailQuery = "Select * from user where email = '$email'";

				if ($runEmail = mysqli_query($con, $emailQuery)) {

					$emailCount = mysqli_num_rows($runEmail);

					if($emailCount == 0) {
						$booEmail = true;
						//echo $booEmail;
					} else {
						echo "<script>document.getElementById('emailExist').style.display = 'block';</script>";
					}
				} else {
					die("Error :" . mysqli_error($con));
				}

				//Check username 
				$usernameQuery = "Select * from user where Username = '$username'";

				if($runUsername = mysqli_query($con, $usernameQuery)) {

					$usernameCount = mysqli_num_rows($runUsername);

					if($usernameCount == 0) {
						$booUsername = true;
						//echo $booUsername;
					} else {
						echo "<script>document.getElementById('usernameTaken').style.display = 'block';</script>";
					}
				}

				//If all true 
				if($booPw == true && $booEmail == true && $booUsername == true) {

					//echo "all true";

					//Create folder according to username
					$currentDir = getcwd();					
					$path = $currentDir."\user\\".$username."\\";

					if(!is_dir($path)) {

						if (mkdir($path, 0777)) {

							//Display Name
							$displayName = $lName. " ". $fName;

							//Image file
							$ppFile = mysqli_real_escape_string($con, "Resources/Logo1.png");
							$cpFile = mysqli_real_escape_string($con, "Resources/coverpic.png");

							//Insert User
							$userQuery = "Insert into user(Email, Password, First_name, Last_name, Dob, Gender, Nationality, Username, Role, Display_name, Bio, Profile_pic, Cover_pic) values ('$email', '$password', '$fName', '$lName', '$dob', '$gender', '$nationality', '$username', 'Member', '$displayName', 'Insert your Bio here!', '$ppFile', '$cpFile');";

							//Run User	
							if($runUser = mysqli_query($con, $userQuery)) {

								echo "<script>alert('Create account success! Login again from homepage'); window.location.href='home.php';</script>";

							} else {
								die("Error : ". mysqli_error($con));
							}

						} else {
							die("Error : ". mysqli_error($con));
						}
					}
				}

			} else {
				echo "<script>document.getElementById('tacNotChecked').style.display = 'block';</script>";
			}
		}
	
	?>
</body>
</html>