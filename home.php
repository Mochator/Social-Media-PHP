<?php 
	session_start();
	include("connection.php");
?>

<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PACES | Home</title>
	<script src="headInput.js" type="text/javascript"></script>
	<link href='home.css' type='text/css' rel='stylesheet'>
	<link href='autoSlide.css' type='text/css' rel='stylesheet'>
</head>
<body>
		<!--Background-->
		<div id="top">
			<?php
				include("background.php");
			?>

		<nav>
			<?php
				include("menu.php");
			?>
		</nav>

		<!--Header-->
		<script src="displayForm.js"></script>
		<header style="text-align: center; z-index:2; position: absolute; top: 35%; width: 100%;">
			<h1 style="font-size: 60px; color: white;" id="header-text">FOOTSTEPS ACROSS THE WORLD</h1>
				
				<?php 
					echo "<a class='headBtn'";
					if(!isset($_SESSION['Paces'])) {
						echo "onclick=\"openForm()\">LOGIN</a>";
					} else {
						$username = $_SESSION["Paces"];
						echo "href='profile.php?username=";
	 					echo $username;
	 					echo "'>LOGIN</a>";
					} 
				?>

				<a class="headBtn" <?php echo "href='register.php'" ?> >SIGN UP</a>
		</header>
		</div>

			<!--Login Form-->
			<div id="login">
				<span style="float: right; color: grey; font-size: 26px; cursor: pointer;" onclick="closeForm()">&times;</span>
				<h1>Login</h1>
				<hr>
				<br>
				<form method="post" action="login.php">
					<label for="email">Email Address</label>
					<br>
					<input type="email" name="email" required class="width100">
					<br><br>
					<label for="password">Password</label>
					<br>
					<input type="password" name="password" required class="width100">
					<br><br>
					<input type="submit" name="submit" class="width100" value="Login!">
					<br><br>
					<a href="frequently-asked-question.php" style="font-size: 14px; right: 0;">Forget password?</a>
				</form>
			</div>

			<!--Second navigator-->
			<div id="second-nav">
				<div class="second-nav-item"><a href="#top">Top</a></div>
				<div class="second-nav-item"><a href="#what-are-we">What are we?</a></div>
				<div class="second-nav-item"><a href="#sponsor">Sponsor &#10086; Partners</a></div>
				<div class="second-nav-item"><a href="#support">Help & Support</a></div>
			</div>

			<article class='container' style="background: transparent;">
				<div class='home-content' id="what-are-we">
					<div class="home-content-title">
						<h2>
							Have you ever had the thought of noting down every moment of your footstep?
						</h2>
					</div>
					<div class='inline-block width70'>
						<p style="text-align: justify;">
							<span style="font-size: 36px">P</span>ACES is an Online Gallery for photo sharing. It is best-suit for photography enthusiasts, travellers and various kind of users. You can note down every single of your footstep after visiting a destination like a diary and share it! Regardless how expert you are in the field of photography or you are just a beginner seeking for photography advice. You are always welcomed to PACES and share your experience with each other! 
						</p>
						<br>
						<div style="margin: 15 0">
							<a href="about.php" class="home-link">Read more</a>
						</div>
					</div>
					<div class="inline-block top-align">
						<img src="Resources/about-one.jpg" alt="Every moment of your footstep" class="contentImg">
					</div>
				</div>
				<div class="home-content" id="sponsor">
					<div class="home-content-title">
						<h2>Sponsor &#10086; Partners</h2>
					</div>
					<div style="text-align: center;">
						<a href="http://www.nikon.com/"><img src="Resources/nikon.png" alt="Nikon Corporation" class="sponsor"></a>
						<a href="https://my.canon/"><img src="Resources/canon.jpg" alt="Canon Inc." class="sponsor"></a>
						<a href="https://www.intel.com/content/www/us/en/homepage.html"><img src="Resources/intel.png" alt="Intel Corp." class="sponsor"></a>
						<a href="https://www.klaud9.com/"><img src="Resources/klaud9.png" alt="Klaud9 Company" class="sponsor"></a>
						<a href="https://www.huawei.com/my/"><img src="Resources/huawei.png" alt="Huawei Technologies Co., Ltd." class="sponsor"></a>
						<a href="https://www.honestbee.my/en/"><img src="Resources/honestbee.png" alt="HonestBee Company" class="sponsor"></a>
						<a href="https://www.nivea.com.my/"><img src="Resources/nivea.png" alt="Nivea | Beiersdorf AG" class="sponsor"></a>
						<a href="http://www.prudential.com/"><img src="Resources/prudential.png" alt="Prudential Financial, Inc." class="sponsor"></a>
						<a href="http://www.mbiv2u.com/"><img src="Resources/mbi.png" alt="MBI International" class="sponsor"></a>
					</div>
				</div>
				<div class="home-content" id="support">
					<div class="home-content-title">
						<h2>Help & Support</h2>
						<p>For any customer support needed, you may contact us through our email <a href="mailto:pacesphotography@gmail.com" style="color: #76caff;">pacesphotography@gmail.com</a> or click <a href="customer-support.php" style="color: #76caff;">here</a> for other methods of approaching us!
						<br>
						You may search for your answer in our FAQ page as well, by clicking the button below.
						</p>
						<br>
						<div style="margin: 15 0">
							<a href="frequently-asked-question.php" class="home-link">FAQ</a>
						</div>
					</div>
				</div>				
			</article>

			<footer class="container">
				<?php
				include("footer.php");
				?>
			</footer>
	</body>

</html>