<?php
	include("login_session.php");  
	include("connection.php");
	$username = $_SESSION["Paces"];
	include("retrieve.php");
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

			<script>
				function ImagePreview() { 
 					var PreviewIMG = document.getElementById('PreviewPicture'); 
 					var UploadFile    =  document.getElementById('FileUpload').files[0]; 
 					var ReaderObj  =  new FileReader(); 

 					ReaderObj.onloadend = function () { 
    					PreviewIMG.style.backgroundImage  = "url("+ ReaderObj.result+")";
  					} 
 					if (UploadFile) { 
    					ReaderObj.readAsDataURL(UploadFile);
  					} else { 
     				PreviewIMG.style.backgroundImage  = "";
  					} 
				}
        	</script>



		<!--Content-->
		<div id="wrapper" class="container">
			<header class="container container-top">
				<h1>Upload Photo</h1>
			</header>

			<section class="container">
				<!--Instruction-->
				<h2>Here is some Tips!</h2>
				<ol type="number" class="instruction">
					<li>Only one image per upload.</li>
					<li>Selected image can be previewed.</li>
					<li>You can add caption to express your thoughts!</li>
					<li>Add categories to group them up.</li>
					<li>AND... You're ready to go!</li>
				</ol>
				
				<!--Error Message-->
				<script src="information-window.js" type="text/javascript"></script>

				<!--Form Section-->
				<form method="post" action="post.php" class="form center" enctype="multipart/form-data" id="post-form">
					<div class="preview center" id="PreviewPicture">
					</div>
					<div class="preview align-left">
						<input type="file" name="image" value="Browse for image!" onchange="ImagePreview()" id="FileUpload" required class="input">
						<br><br>
						<label for="caption">Caption</label>
						<textarea name="caption" form="post-form" required class="input"></textarea>
						<br><br>
						<label for="category">Category</label><br>
						<input type="text" name="category" value="You can have multiple categories by separating them with space." onclick="if (this.value == 'You can have multiple categories by separating them with space.') {this.value=''; this.style.color='black';}" style = "color: grey;" class="width90 input" required>
						<br><br>
						<input type="submit" name="post" value="Post!" class="width100 submit">
					</div>
				</form>
			</section>
		</div>

	<!-- Footer -->
	<footer id="footer">
		<?php
		include("footer2.php")
		?>						
	</footer>

	</body>
</html>

<?php
	if (isset($_POST["post"])) {

		//Category
		$category = $_POST["category"];
		$category = mysqli_real_escape_string($con, $category);
		$category = stripslashes($category);
		$category = htmlentities($category);

		//Caption
		$caption = $_POST["caption"];
		$caption = mysqli_real_escape_string($con, $caption);
		$caption = stripslashes($caption);
		$caption = htmlentities($caption);

		//Timestamp
		date_default_timezone_set("Asia/Kuala_Lumpur");
		$date = date_create();
		$datetime = date_format($date, "Y-m-d h:i:s");

		//Uploaded files
		$file = $_FILES["image"]["name"];
		$tmpfile = $_FILES["image"]["tmp_name"]; //to get image size

		//File Type
		$imageFileType= pathinfo($file,PATHINFO_EXTENSION);
		$postOk= 1;

		//Image size
		if($_FILES["image"]["error"] == 1) {
			echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML='Error!';document.getElementById('error-content').innerHTML+='Sorry, image is too large.<br>';</script>";
			$postOk= 0;
		}

		//Check if it is an image
		$check = @getimagesize($tmpfile);
		if($check !== false) {
			$postOk= 1;
		} else {
			echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML = 'Error!';document.getElementById('error-content').innerHTML+='File is not an image.<br>';</script>";
			$postOk= 0;
		}
		//error_reporting(E_ALL ^ E_WARNING);

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF") {
			echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML = 'Error!';document.getElementById('error-content').innerHTML+='Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>';</script>";
			$postOk= 0;
		}

			
		//target location
		$newName = $username.date_format($date, "Ymdhis").".".$imageFileType;
		$target_dir= "user/".$username."/";
		$target_file= $target_dir. $newName;	
		
		//echo $datetime."<br>";
		//echo $newName;

		//Uploading images
		if (isset($id)) {
			if ($postOk== 0) {
				echo "<script>document.getElementById('error').style.display = 'block';document.getElementById('error-title').innerHTML = 'Error!';document.getElementById('error-content').innerHTML+='Sorry your file was not uploaded!<br>';</script>";

				// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($tmpfile, $target_file)) {

					$query = "insert into image (User_Id, Image, Caption, Category, Timestamp) values ('$id', '$target_file', '$caption', '$category', '$datetime');";

					if (!mysqli_query($con, $query)) {
						die('Error: '. mysqli_error($con));
					} else {
						unset($_POST["post"]);
						echo "<script>alert('Image has been uploaded!'); window.location.href='profile.php?username=";
						echo $username;
						echo "';</script>";
					}
				}
			}	
		}
		unset($_POST["post"]);
	}
	
?>