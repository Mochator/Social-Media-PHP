<?php	
	include("connection.php");
	session_start();
	if (isset($_SESSION['Paces'])) {
		$username = $_SESSION["Paces"];
	 	echo "<script>window.location.href='profile.php?username=";
	 	echo $username;
	 	echo "'</script>";
	}
?>

<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PACES | Login</title>
	<script src="headInput.js" type="text/javascript"></script>
	<link href="home.css" type="text/css" rel="stylesheet">
	<link href='autoSlide.css' type='text/css' rel='stylesheet'>
</head>
<body>
	<script>
		function hide() {
			document.getElementById('incorrect').style.visibility = "hidden";
		}
	</script>
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
	<article class="container">
		<div class="content-title">
			<h1>Login</h1>
		</div>
		<div class="content-container center-align">
			<form method="post" action="login.php">
				<label for="email">Email Address</label>
				<br>
				<input type="email" name="email" required class="width40">
				<br><br>
				<label for="password">Password</label>
				<br>
				<input type="password" name="password" required class="width40">
				<p style="visibility: hidden; font-size: 10px; color: red;" id="incorrect">Incorrect username or password!</p>
				<input type="submit" name="submit" class="width40" value="Login!">
				<br><br>
				<a href="frequently-asked-question.php" style="font-size: 14px; right: 0;">Forget password?</a>
			</form>
		</div>
	</article>


	<!--Footer-->
	<footer class="container">
		<?php
			include("footer.php");
		?>
	</footer>

<!--PHP script-->
<?php
	if (isset($_POST["submit"])) {

		$email = $_POST['email'];
		$password = $_POST['password'];

	 	//escape
	 	$email = mysqli_real_escape_string($con, $email);
	 	$password = mysqli_real_escape_string($con, $password);

	 	//stripslashes
	 	$email = stripslashes($email);
	 	$password = stripslashes($password);

		//htmlentities
	 	$email = htmlentities($email);
	 	$password = htmlentities($password);

	 	//Encryption
	 	$password = md5($password);

	 	//Query
	 	$query = "Select * from user where Email = '$email'";

	 	//Hide incorrect
	 	echo "<script>document.getElementById('incorrect').style.visibility = 'hidden';</script>";

	 	//Run query
	 	if(!$runQuery = mysqli_query($con, $query)) {
	 		die("Error: " . mysqli_error($con));
	 	} else {
	 		$rowCount = mysqli_num_rows($runQuery);
	 		//Check user exist
	 		if($rowCount == 1) {
	 			$result = mysqli_fetch_array($runQuery);
	 			$dbPassword = $result["Password"];
	 			
	 			//Check password
	 			if($dbPassword == $password) {
	 				$username = $result["Username"];
	 				$_SESSION["Paces"] = $username;
	 				echo "<script>window.location.href='profile.php?username=";
	 				echo $username;
	 				echo "'</script>";
	 			} else {
	 			echo "<script>document.getElementById('incorrect').style.visibility = 'visible';</script>";
	 			}
	 		} else {
	 			echo "<script>document.getElementById('incorrect').style.visibility = 'visible';</script>"; 
	 		}
	 	}
	} else {
		echo '<script>window.location.href="home.php"</script>';	
	}
	
	mysqli_close($con);
?>
</body>
</html>