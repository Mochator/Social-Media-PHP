	<?php
	$userQuery = "select * from user where username = '$username'";
	if ($runUser = mysqli_query($con, $userQuery)) {
		$userRow = mysqli_fetch_array($runUser);

		$id = $userRow["User_id"];


	} else {
		die("Error : ".mysqli_error($con));
	}
	?>