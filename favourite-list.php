<?php
	include("login_session.php");  
	include("connection.php");
	$username = $_SESSION["Paces"];
	include("retrieve.php");

	//Image SQL
	$booImgRun = false;

	if(isset($_GET["submit"])){
		$search = $_GET["search"];
		$by = $_GET["by"];

		if($by == "category") {
			$imageQuery = "select *, image.User_Id as ImageOwner from favourite inner join image on favourite.Image_Id = image.Image_id where image.Category like '%".$search."%' and favourite.User_id = '$id';";

			if($runImage = mysqli_query($con, $imageQuery)) {
				$booImgRun = true;
			} else {
				die("Error: ".mysqli_error($con));
			}

		} else if ($by == "user") {
			$imageQuery = "select *, image.User_Id as ImageOwner from favourite inner join image on favourite.Image_Id = image.Image_id inner join user on favourite.User_id = user.User_id where user.Username like '%".$search."%' and favourite.User_id = '$id';";
			
			if($runImage = mysqli_query($con, $imageQuery)) {
				$booImgRun = true;
			} else {
				die("Error: ".mysqli_error($con));
			}

		} else if ($by == "caption") {
			$imageQuery = "select *, image.User_Id as ImageOwner from favourite inner join image on favourite.Image_Id = image.Image_id where Caption like '%".$search."%' and favourite.User_id = '$id';";
			
			if($runImage = mysqli_query($con, $imageQuery)) {
				$booImgRun = true;
			} else {
				die("Error: ".mysqli_error($con));
			}

		} else {
			//by = all
			$imageQuery = "select *, image.User_Id as ImageOwner from favourite inner join image on favourite.Image_Id = image.Image_id inner join user on favourite.User_id = user.User_id where concat(user.Username,image.Category, image.Caption) like '%".$search."%' and favourite.User_id = '$id';";

			if($runImage = mysqli_query($con, $imageQuery)) {
				$booImgRun = true;
			} else {
				die("Error: ".mysqli_error($con));
			}
		}

	} else {
		
		$imageQuery = "select *, image.User_Id as ImageOwner from favourite inner join image on favourite.Image_Id = image.Image_id where favourite.User_id = '$id';";

		if($runImage = mysqli_query($con, $imageQuery)) {
			$booImgRun = true;
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
				<h1>Favourite List</h1>
			</header>

			<!--Search-->
			<section class="container">
				<form method="get" action="favourite-list.php" id="search" class="center">
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
    					  			echo "</a></div><form action='favourite-list.php";
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
 								echo "<div class='errorMessage'>You have not yet favourited any images :(<br><br> Perhaps favourite some now?</div>";
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