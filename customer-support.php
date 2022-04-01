<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PACES | About</title>
	<script src="headInput.js" type="text/javascript"></script>
	<link href="home.css" type="text/css" rel="stylesheet">
	<link href='autoSlide.css' type='text/css' rel='stylesheet'>
</head>
<body>
<!--Layout-->
	<!--Background-->
	<header class="top">
		<?php
			include("background.php");
		?>
		<nav>
			<?php
				include("menu.php");
			?>
		</nav>
	</header>

	<!--Article-->
	<article class='container'>
		<div class="content-title">
			<h1>Customer Support</h1>
		</div>

		<div class="content-container">
			<div class="center-align">
				<div class="methods">
					<h2>Headquarter</h2>
					<p>5 Taman Teknologi,<br>Bukit Jalil 57000,<br>Kuala Lumpur, Malaysia</p>
				</div>
				<div class="methods">
					<h2>Email</h2>
					<p>pacesphotography@gmail.com</p>
				</div>
				<div class="methods">
					<h2>Contact</h2>
					<p>
						Tel: 012-3456789<br>
						Fax: 012-3456789<br>
						Hotline: 1800-345-678
					</p>
				</div>
			</div>
		</div>
		<div class="content-container">
			<div class="center-align email">
				<form action="mailto:pacesphotography@gmail.com?subject=Customer%20Support" method="post" id="email" class="left-align" enctype="text/plain">
					<label for="name">Name</label><br>
					<input type="text" name="name" class="width50"><br><br>
					<label for="email">Email</label><br>
					<input type="email" name="email" class="width50"><br><br>
					<label for="subject">Purpose</label><br>
					<input type="text" name="subject"  class="width50"><br><br>
					<label for="message">Message</label><br>
					<textarea form="email"  class="width50"></textarea><br><br>
					<input type="submit" name="submit" value="Send email!">
					<input type="reset">
				</form> 
			</div>
		</div>
	</article>

		<!--Footer-->
	<footer class="container">
		<?php
			include("footer.php");
		?>
	</footer>

</body>
</html>