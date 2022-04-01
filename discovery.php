<?php
	include("login_session.php");  
	include("connection.php");
	$username = $_SESSION["Paces"];
	include("retrieve.php");

	//Image SQL
	$booImgRun = false;
	$booImgRun2 = false;

	if(isset($_GET["submit"])){
		$search = $_GET["search"];
		$by = $_GET["by"];

		if($by == "category") {
			$imageQuery = "select *, image.User_Id as ImageOwner from image where image.Category like '%".$search."%';";
			$imageQuery2 = "select *, image.User_Id as ImageOwner from image where image.Category like '%".$search."%' order by Timestamp desc;";

			if($runImage = mysqli_query($con, $imageQuery)){
				$booImgRun = true;
			} else {
				die("Error: ".mysqli_error($con));
			}

			if($runImage2 = mysqli_query($con, $imageQuery2)){
				$booImgRun2 = true;
			} else {
				die("Error: ".mysqli_error($con));
			}

		} else if ($by == "user") {
			$imageQuery = "select *, image.User_Id as ImageOwner from image inner join user on image.User_Id = user.User_id where user.Username like '%".$search."%';";
			$imageQuery2 = "select *, image.User_Id as ImageOwner from image inner join user on image.User_Id = user.User_id where user.Username like '%".$search."%' order by Timestamp desc;";
			
			if($runImage = mysqli_query($con, $imageQuery)){
				$booImgRun = true;
			} else {
				die("Error: ".mysqli_error($con));
			}

			if($runImage2 = mysqli_query($con, $imageQuery2)){
				$booImgRun2 = true;
			} else {
				die("Error: ".mysqli_error($con));
			}

		} else if ($by == "caption") {
			$imageQuery = "select *, image.User_Id as ImageOwner from image where Caption like '%".$search."%';";
			$imageQuery2 = "select *, image.User_Id as ImageOwner from image where Caption like '%".$search."%' order by Timestamp desc;";
			
			if($runImage = mysqli_query($con, $imageQuery)){
				$booImgRun = true;
			} else {
				die("Error: ".mysqli_error($con));
			}

			if($runImage2 = mysqli_query($con, $imageQuery2)){
				$booImgRun2 = true;
			} else {
				die("Error: ".mysqli_error($con));
			}

		} else {
			//by = all
			$imageQuery = "select *, image.User_Id as ImageOwner from image inner join user on image.User_Id = user.User_id where concat(user.Username,image.Category, image.Caption) like '%".$search."%';";

			$imageQuery2 = "select *, image.User_Id as ImageOwner from image inner join user on image.User_Id = user.User_id where concat(user.Username,image.Category, image.Caption) like '%".$search."%' order by Timestamp desc;";

			if($runImage = mysqli_query($con, $imageQuery)){
				$booImgRun = true;
			} else {
				die("Error: ".mysqli_error($con));
			}

			if($runImage2 = mysqli_query($con, $imageQuery2)){
				$booImgRun2 = true;
			} else {
				die("Error: ".mysqli_error($con));
			}
		}

	} else {
		
		$imageQuery = "select count(favourite.Favourite_id) as favourites, favourite.Favourite_id as Favourite_id, image.Image_id, image.Image,image.Caption, image.Category, image.User_Id as ImageOwner from favourite inner join image on favourite.Image_id = image.Image_id group by favourite.Image_id order by favourites desc limit 10;";
		$imageQuery2 = "select *, image.User_id as ImageOwner from image order by Timestamp desc limit 10;";

		if($runImage = mysqli_query($con, $imageQuery)) {
			$booImgRun = true;
		} else {
			die("Error: ".mysqli_error($con));
		}

		if($runImage2 = mysqli_query($con, $imageQuery2)) {
			$booImgRun2 = true;
		} else {
			die("Error: ".mysqli_error($con));
		}
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
	<body <?php include("bodyBg.php");?> >

		<!--Navigation bar-->
		<nav>
			<?php
			include("menu2.php");
			?>
		</nav>

		<!--Content-->
		<div id="wrapper" class="container">
			<header class="container container-top">
				<h1>Discovery</h1>
			</header>

			<!--Search-->
			<section class="container">
				<form method="get" action="discovery.php" id="search" class="center">
					<label for="search">Search </label>
					<input type="text" name="search" class="width30 searchbar">

					<input type="submit" name="submit" value="Go" class="searchbutton">

					

					<input type="radio" name="by" value="all" checked><label for="by">All Categories</label>
					<input type="radio" name="by" value="category"><label for="by">Image Category</label>
					<input type="radio" name="by" value="user"><label for="by">User</label>
					<input type="radio" name="by" value="caption"><label for="by">Caption</label>					
				</form>
			</section>

			<!-- Thumbnails -->
					<section class="thumbnails container center">
						<h2>Top Rated</h2>
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
    					  			echo "</a></div><form action='discovery.php";
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
 								echo "<div class='errorMessage'>Error fetching images x.x</div>";
 							}
						} else {
							echo "<div class='errorMessage'>Error fetching images x.x</div>";
						
						}
						?>
						
					</section>
					<section class="thumbnails container center">
						<h2>Latest Post</h2>
						<?php
						if($booImgRun2 == true) {

							if(mysqli_num_rows($runImage2) > 0) {	
									
								while($imageRow2 = mysqli_fetch_assoc($runImage2)){

									$img_id = $imageRow2["Image_id"];
									$img_image = $imageRow2["Image"];
									$img_caption = $imageRow2["Caption"];

									$ownerId2 = $imageRow2["ImageOwner"];
									$ownerQuery2 = "select * from user where User_id = '$ownerId2'";
									$runOwner2 = mysqli_query($con, $ownerQuery2);
									$ownerRow2 = mysqli_fetch_assoc($runOwner2);

									include("heart.php");
								
    					  			echo "<div class='thumbnail align-left'><a href='";
    					  			echo $img_image;
    					  			echo "' target='_blank'><div style='position: relative;'><img class='thumb-img' src='";
    					  			echo $img_image;
    					  			echo "' alt='";
    					  			echo $img_caption;
    					  			echo "' /></a><div class='caption'>";
    					  			echo $img_caption;
    					  			echo "</div></div><div class='thumbnail-details'><a href='profile.php?username=";
    					  			echo $ownerRow2["Username"];
    					  			echo "'><img src='";
    					  			echo $ownerRow2["Profile_pic"];
    					  			
    					  			echo "' class = 'thumbnail-pp'><div><br>";
    					  			echo $ownerRow2["Display_name"];
    					  			echo "</a></div><form action='discovery.php";
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
 								echo "<div class='errorMessage'>Error fetching images x.x</div>";
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