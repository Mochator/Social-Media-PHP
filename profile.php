<?php
	include("login_session.php");  
	include("connection.php");
	$username = $_GET["username"];

	$booImgRun = false;

	//Query depends on own account
	$idQuery = "select * from user where username = '$_SESSION[Paces]';";
	if($runId = mysqli_query($con, $idQuery)) {
		$idRow = mysqli_fetch_array($runId);

		$id = $idRow["User_id"];
	}

	//Query	depends on profile
	$userQuery = "select * from user where username = '$username'";
	if ($runUser = mysqli_query($con, $userQuery)) {
		$userRow = mysqli_fetch_array($runUser);

		$pp = $userRow['Profile_pic'];
		$cp = $userRow['Cover_pic'];
		$prof_id = $userRow["User_id"];

		if($username == $_SESSION["Paces"]) {
			$profile = "own";
		} else {
			$profile = "others";
		}

		//Post retrieve
		$imageQuery = "select *, User_id as ImageOwner from image where User_id = '$prof_id' order by Timestamp desc;";

		//Run image query
		if($runImage = mysqli_query($con, $imageQuery)) {
			$booImgRun = true;
		} else {
			$booImgRun = false;
			die("Error :" . mysqli_error($con));
		}

	} else {
		die("Error : ".mysqli_error($con));
	}
	
	
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
		<body <?php echo " style=\"background-image: url('$cp');\"";?>>
		<!--Navigation bar-->
		<nav>
			<?php
			include("menu2.php");
			?>
		</nav>
		
		<div id="wrapper" class="container">

				<!-- Header -->
					<header id="profile">


						<!--DP-->
						<span class="avatar">
							<?php
								echo"<img src='$pp' alt='My Profile Pic' />";
							?>
						</span>

						
						<?php
							if ($profile == "own") {
								echo "<button onclick=\"window.location.href='post.php'\" class='sub'>Add New Photo</button>";
							} elseif ($profile == "others") {
								include("subscribe.php");
								echo "<form action='profile.php?username=$username' method='POST'><input type='submit' name='subscribe' class='sub' id='sub' value='".$value."'>";
								echo "</a></form>";
							} 
						?>
												

						<!--Display Name-->
						<div class="userDisplay" id="display-name"><b><?php echo $userRow["Display_name"];?></b></div>

						<!--Bio-->
						<div class="userDisplay" id="bio"><?php echo $userRow["Bio"]?></div>

						<!--Social Media-->
						<ul class="icons">
							<?php
							$twitter = $userRow["Twitter"];
							if ($twitter != null) {
							 echo "<li><a href='";
							 echo $twitter;
							 echo "' class='icon' target='_blank'><img src='Resources/tw.png' alt='Twitter'></a></li>";
							}

							$facebook = $userRow["Facebook"];
							if ($facebook != null) {
							 echo "<li><a href='";
							 echo $facebook;
							 echo "'class='icon' target='_blank'><img src='Resources/fb.png' alt='Facebook'></a></li>";
							}

							$instagram = $userRow["Instagram"];
							if ($instagram != null) {
							 echo "<li><a href='";
							 echo $instagram;
							 echo "' class='icon' target='_blank'><img src='Resources/ig.png' alt='Instagram'></a></li>";
							}

							$contact = $userRow["Contact"];
							if ($contact != null) {
							 echo "<li><a href='";
							 echo $contact;
							 echo "' class='icon' target='_blank'><img src='Resources/wa.png' alt='Whatsapp'></a></li>";
							}

							$email = $userRow["Contact_email"];
							if ($email != null) {
								echo "<li><a href='mailto: ";
								echo $email;
								echo "' class='icon' target='_blank'><img src='Resources/mail.png' alt='Mail'></a></li>";
							}

							$youtube = $userRow["Youtube"];
							if ($youtube != null) {
								echo "<li><a href='";
								echo $youtube;
								echo "' class='icon' target='_blank'><img src='Resources/youtube.png' alt='Youtube'></a></li>";
							}
							?>	
						</ul>
					</header>

					<!-- Thumbnails -->
					<section class="thumbnails container center">

						<?php
						if($booImgRun == true) {

							if(mysqli_num_rows($runImage) > 0) {	
									
								while($imageRow = mysqli_fetch_assoc($runImage)){

									$img_id = $imageRow["Image_id"];
									$img_image = $imageRow["Image"];
									$img_caption = $imageRow["Caption"];

									$ownerId = $imageRow["ImageOwner"];
									$ownerQuery = "select * from user where User_id = '$ownerId'";
									$runOwner = mysqli_query($con, $ownerQuery);
									$ownerRow = mysqli_fetch_assoc($runOwner);

									include("heart.php");
								
    					  			echo "<div class='thumbnail align-left'><a href='";
    					  			echo $img_image;
    					  			echo "' target='open-image'><div style='position: relative;'><img class='thumb-img' src='";
    					  			echo $img_image;
    					  			echo "' alt='";
    					  			echo $img_caption;
    					  			echo "'/></a><div class='caption'>";
    					  			echo $img_caption;
    					  			echo "</div></div><div class='thumbnail-details'><a href='profile.php?username=";
    					  			echo $ownerRow["Username"];
    					  			echo "'><img src='";
    					  			echo $ownerRow["Profile_pic"];
    					  			
    					  			echo "' class = 'thumbnail-pp'><div><br>";
    					  			echo $ownerRow["Display_name"];
    					  			echo "</a></div><form action='profile.php?username=";
    					  			echo $ownerRow["Username"];
;    					  			echo "' method='POST'>";
    					  			if($booFavourite == true) {
    					  				echo "<input type='submit' name='favourite' style=\"background-image: url('Resources/heart-filled.png')\" class='heart' value='";
    					  				echo $img_id."' id='";
    					  				echo $img_id;
    					  				echo "'>";
    					  			} else {
    					  				echo "<input type='submit' name='favourite' style=\"background-image: url('Resources/heart-unfilled.png')\" class='heart' value='";
    					  				echo $img_id."' id='";
    					  				echo $img_id;
    					  				echo "'>";
    					  			}
    					  			echo "</form></div></div>";
 								}
 							} else {
 								echo "<div class='errorMessage'>User has not upload any images yet :(</div>";
 							}
						} else {
							echo "<div class='errorMessage'>Error fetching images x.x</div>";
						
						}
						?>
						
					</section>
				</div>




				<!-- Footer -->
				<footer id="footer">
					<?php
					include("footer2.php")
					?>						
				</footer>

<!--Favourite & Subcribe PHP Script-->
<?php 
include("click-heart.php");
if($profile == "others") {
	include("click-subscribe.php");
}
?>

	</body>
</html>
