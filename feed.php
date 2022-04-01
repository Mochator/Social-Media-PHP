<?php
	include("login_session.php");  
	include("connection.php");
	$username = $_SESSION["Paces"];
	include("retrieve.php");

	//Image SQL
	$booImgRun = false;
		
	$imageQuery = "select *, image.User_Id as ImageOwner from subscription inner join image on subscription.Following_Id = image.User_Id where subscription.User_id = '$id' order by image.Timestamp desc;";

	if($runImage = mysqli_query($con, $imageQuery)) {
		$booImgRun = true;
	} else {
		die("Error: ".mysqli_error($con));
	}

?>

<!--HTML-->
<!DOCTYPE HTML>
<html>
	<head>
		<title>PACES</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<script src="headInput.js"></script>
		<link rel="stylesheet" href="profile.css">
		
	</head>

	<!--Body section-->
	<body <?php include("bodyBg.php");?>>

		<!--Navigation bar-->
		<nav>
			<?php
			include("menu2.php");
			?>
		</nav>

		<!--Content-->
		<div id="wrapper" class="container">
			<header class="container container-top">
				<h1>My Feed</h1>
			</header>

			<!-- Thumbnails -->
					<section class="thumbnails container center">

						<div class="img-display">
						</div>

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
    					  			echo "</a></div><form action='feed.php";
						  			echo "' method='POST'>";
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
 								echo "<div class='errorMessage'>You have not subscribed anyone yet :(<br><br> Perhaps subscribe some now?</div>";
 							}
						} else {
							echo "<div class='errorMessage'>Error fetching images x.x</div>";
						
						}
						?>
						
					</section>
				</div>
		</div>

	<!-- Footer -->
	<footer id="footer">
		<?php
		include("footer2.php");
		?>						
	</footer>

	<!--Favourite PHP Script-->
	<?php include("click-heart.php");?>
	
	</body>
</html>