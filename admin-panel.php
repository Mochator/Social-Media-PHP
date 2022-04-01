<?php
	include("login_session.php");  
	include("connection.php");
	$username = $_SESSION["Paces"];
	include("retrieve.php");

	if($userRow["Role"] == "Member") {
		echo "<script>alert('Access denied!', 'STOP RIGHT THERE');window.location.href='profile.php?username=$username';</script>";
	}
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>PACES | Admin Panel</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<script src="headInput.js"></script>
		<link rel="stylesheet" href="profile.css">
		
	</head>
	<body <?php include("bodyBg.php");?> class="admin">
		<!-- Tab links -->
	<div class="tab">
  		<button class="tablinks" onclick="openTab(event, 'Member')">Members</button>
  		<button class="tablinks" onclick="openTab(event, 'Profile')">Profile</button>
  		<button class="tablinks" onclick="openTab(event, 'Image')">Image</button>
  		<a class="tablink" style="float:right;" <?php echo "href='profile.php?username=$username'";?>>Back to my profile</a>
	</div>

	<!-- Tab content -->
	<div id="Member" class="tabcontent">
  		<h3>Member</h3>
  		<table>
  			<tr class="tr">
				<td>User_Id</td>
				<td>Username</td>
				<td>Email</td>
				<td>Password</td>
				<td>First_name</td>
				<td>Last_name</td>
				<td>Dob</td>
				<td>Gender</td>
				<td>Nationality</td>
				<td>Role</td>
				<td>Edit</td>
				<td>Delete</td>
			</tr>
  		<?php
  		$all_user_query = "Select * from user";
		$run_all_user = mysqli_query($con, $all_user_query);

  		while($all_user_row = mysqli_fetch_assoc($run_all_user)) {
  			echo "<tr class='tr2'>";

  			echo "<td>";
			echo $all_user_row['User_id'];
			echo "</td>";

			echo "<td>";
			echo $all_user_row['Username'];
			echo "</td>";

			echo "<td>";
			echo $all_user_row['Email'];
			echo "</td>";

			echo "<td>";
			echo $all_user_row['Password'];
			echo "</td>";

			echo "<td>";
			echo $all_user_row['First_name'];
			echo "</td>";

			echo "<td>";
			echo $all_user_row['Last_name'];
			echo "</td>";

			echo "<td>";
			echo $all_user_row['Dob'];
			echo "</td>";

			echo "<td>";
			echo $all_user_row['Gender'];
			echo "</td>";

			echo "<td>";
			echo $all_user_row['Nationality'];
			echo "</td>";

			echo "<td>";
			echo $all_user_row['Role'];
			echo "</td>";

			echo "<td><a href=\"edit-account.php?id=";
			echo $all_user_row['User_id'];
			echo "\">Edit</a></td>";

			echo "<td><a href=\"delete-user.php?id=";
			echo $all_user_row['User_id'];
			echo "\" onclick=\"return confirm('Delete ";
			echo $all_user_row['Username'];
			echo " details?');\">Delete</a></td></tr>";
  		}
  		?>
  	</table>
	</div>

	<div id="Profile" class="tabcontent">
		<h3>Profile</h3>
  		<table>
  			<tr class="tr">
				<td>User_Id</td>
				<td>Username</td>
				<td>Display_name</td>
				<td>Bio</td>
				<td>Profile_pic</td>
				<td>Cover_pic</td>
				<td>Facebook</td>
				<td>Contact</td>
				<td>Instagram</td>
				<td>Twitter</td>
				<td>Youtube</td>
				<td>Display_email</td>
				<td>Background</td>
				<td style="width: 3.5%">Edit</td>
			</tr>
  		<?php
  		$all_user_query = "Select * from user";
  		$run_all_user2 = mysqli_query($con, $all_user_query);

  		while($all_user_row2 = mysqli_fetch_assoc($run_all_user2)) {
  			echo "<tr class='tr2'>";

  			echo "<td style='width: 6%'>";
			echo $all_user_row2['User_id'];
			echo "</td>";

			echo "<td style='width: 10%'>";
			echo $all_user_row2['Username'];
			echo "</td>";

			echo "<td style='width: 6%'>";
			echo $all_user_row2['Display_name'];
			echo "</td>";

			echo "<td style='width: 10%; overflow-x: scroll;' class='td'>";
			echo $all_user_row2['Bio'];
			echo "</td>";

			echo "<td><img src='";
			echo $all_user_row2['Profile_pic'];
			echo "'></td>";

			echo "<td><img src='";
			echo $all_user_row2['Cover_pic'];
			echo "'></td>";

			echo "<td style='width: 6%'><a href='";
			echo $all_user_row2['Facebook'];
			echo "'>";
			echo $all_user_row2['Facebook'];
			echo "</a></td>";

			echo "<td style='width: 6%'><a href='";
			echo $all_user_row2['Contact'];
			echo "'>";
			echo $all_user_row2['Contact'];
			echo "</a></td>";

			echo "<td style='width: 6%'><a href='";
			echo $all_user_row2['Instagram'];
			echo "'>";
			echo $all_user_row2['Instagram'];
			echo "</a></td>";

			echo "<td style='width: 6%'><a href='";
			echo $all_user_row2['Twitter'];
			echo "'>";
			echo $all_user_row2['Twitter'];
			echo "</a></td>";

			echo "<td style='width: 6%'><a href='";
			echo $all_user_row2['Youtube'];
			echo "'>";
			echo $all_user_row2['Youtube'];
			echo "</a></td>";

			echo "<td style='width: 8%'><a href='";
			echo $all_user_row2['Contact_email'];
			echo "'>";
			echo $all_user_row2['Contact_email'];
			echo "</a></td>";

			echo "<td style='width: 10%'>";
			echo $all_user_row2['Background'];
			echo "</td>";

			echo "<td><a href=\"edit-profile.php?id=";
			echo $all_user_row2['User_id'];
			echo "\">Edit</a></td>";
  		}
  		?>
  	</table>
	</div>

	<div id="Image" class="tabcontent">
  		<h3>Image</h3>
  		<table>
  			<tr class="tr">
				<td>Image_Id</td>
				<td>User_id</td>
				<td>Image</td>
				<td>Caption</td>
				<td>Category</td>
				<td>Timestamp</td>
				<td>Edit</td>
				<td>Delete</td>
			</tr>
  		<?php
  		$all_image_query = "Select * from image";
		$run_all_image = mysqli_query($con, $all_image_query);

  		while($image_row = mysqli_fetch_assoc($run_all_image)) {
  			echo "<tr class='tr2'>";

  			echo "<td>";
			echo $image_row['Image_id'];
			echo "</td>";

			echo "<td>";
			echo $image_row['User_Id'];
			echo "</td>";

			echo "<td><img src='";
			echo $image_row['Image'];
			echo "'></td>";

			echo "<td style='width: 20%; overflow-x: scroll;' class='td'>";
			echo $image_row['Caption'];
			echo "</td>";

			echo "<td style='width: 20%; overflow-x: scroll;' class='td'>";
			echo $image_row['Category'];
			echo "</td>";

			echo "<td>";
			echo $image_row['Timestamp'];
			echo "</td>";

			echo "<td><a href=\"edit-image.php?id=";
			echo $image_row['Image_id'];
			echo "\">Edit</a></td>";

			echo "<td><a href=\"delete-image.php?id=";
			echo $image_row['Image_id'];
			echo "\" onclick=\"return confirm('Delete ";
			echo $image_row['Image_id'];
			echo " details?');\">Delete</a></td></tr>";
  		}
  		?>
  	</table>
	</div>
	<div>

	</div>

	<!--Javascript-->
	<script>
		function openTab(evt, tabName) {
 		 // Declare all variables
  		var i, tabcontent, tablinks;

  		// Get all elements with class="tabcontent" and hide them
  		tabcontent = document.getElementsByClassName("tabcontent");
  		for (i = 0; i < tabcontent.length; i++) {
   			tabcontent[i].style.display = "none";
  		}

  		// Get all elements with class="tablinks" and remove the class "active"
  		tablinks = document.getElementsByClassName("tablinks");
  		for (i = 0; i < tablinks.length; i++) {
    		tablinks[i].className = tablinks[i].className.replace(" active", "");
 		 }

 		// Show the current tab, and add an "active" class to the button that opened the tab
  		document.getElementById(tabName).style.display = "block";
  		evt.currentTarget.className += " active";
		}
	</script>

	</body>
</html>