<?php
	if(isset($_POST["favourite"])) {

		$image_id = $_POST["favourite"];


		$favourite_check_query = "select * from favourite where User_id = '$id' and Image_id = '$image_id';";

		if ($runFavourite = mysqli_query($con, $favourite_check_query)) {
			if(mysqli_num_rows($runFavourite) == 0) {
				$heartQuery = "insert into favourite(User_id, Image_id) values ('$id', '$image_id');";

				if($runHeart=mysqli_query($con, $heartQuery)) {
					echo "<script>document.getElementById('";
					echo $image_id;
					echo "').style.backgroundImage = \"url('Resources/heart-filled.png')\";document.getElementById('";
					echo $image_id;
					echo "').scrollIntoView()</script>";
				}
			} else {
				$heartQuery = "delete from favourite where User_id = '$id' and Image_id = '$image_id'";

				if($runHeart=mysqli_query($con, $heartQuery)) {
					echo "<script>document.getElementById('";
					echo $image_id;
					echo "').style.backgroundImage = \"url('Resources/heart-unfilled.png')\";document.getElementById('";
					echo $image_id;
					echo "').scrollIntoView()</script>";
				}
			}
		} else {
			die("Error: ".mysqli_error($con));
		}
	unset($_POST["favourite"]);
	}
?>