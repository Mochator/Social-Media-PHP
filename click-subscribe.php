<?php
	if(isset($_POST["subscribe"])) {

		$subscribe_check_query = "select * from subscription where User_id = '$id' and Following_id = '$prof_id'";

		if ($runSubscribe = mysqli_query($con, $subscribe_check_query)) {

			if(mysqli_num_rows($runSubscribe) == 0) {

				$subscribeQuery = "insert into subscription(User_id, Following_id) values ('$id', '$prof_id');";

				if($runSubscribe=mysqli_query($con, $subscribeQuery)) {
					echo "<script>document.getElementById('sub').value='Subscribed'</script>";
				}

			} else {

				$subscribeQuery = "delete from subscription where User_id = '$id' and Following_id = '$prof_id';";

				if($runSubscribe=mysqli_query($con, $subscribeQuery)) {
					echo "<script>document.getElementById('sub').value='Subscribe'</script>";
				}
			}
		} else {
			die("Error: ".mysqli_error($con));
		}
	unset($_POST["subscribe"]);
	}
?>