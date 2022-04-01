<?php

//Favourite retrieve
		if($booImgRun==true){

			//favourite exist check
			$booFavourite = false;

			//fav sql
			$favouriteQuery = "select * from favourite where User_id = '$id' and Image_id = '$img_id'";

			//Run favourite
			if($runFavourite = mysqli_query($con, $favouriteQuery)){

				if(mysqli_num_rows($runFavourite) == 1){
					$booFavourite = true;
				} else {
					$booFavourite = false;
				}

			} else {
				die("Error: ".mysqli_error($con));
			}
		}
?>