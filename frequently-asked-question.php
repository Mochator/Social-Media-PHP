<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PACES | FAQ</title>
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
			<h1>Frequently Asked Question</h1>
		</div>

		<div class="content-container">
			<button class="accordion"><h2>1. Privacy</h2></button>
			<div class="panel">
				<ol type="i">
				<li><h3>Account Privacy</h3></li>
				<p>
					<h4>What should I do if I have forgotten my password?</h4>
						You may click on the forget password button and you will be redirected to our email form. Please contact any admin via emailing us. An Paces' admin will assist you on that. Click <a href="customer-support.php">here</a> for our email form or directly email us <a href="mailto:pacesphotography@gmail.com">pacesphotography@gmail.com</a>.
				</p>
				<p>
					<h4>How do I change my email / password?</h4>
					You can change your email / password or any other account-related settings under "Account Setting" in your setting menu after logged in. You are required to enter your current password for authentication purpose.
				</p>
				<br>			
				<li><h3>Profile Prviacy</h3></li>
				<p>
					<h4>Is my profile visible to every user?</h4>
					No, only registered members can view your profile after they have logged in.
				</p>
				<p>
					<h4>How do I make changes to my profile?</h4>
					You can change your profile details under "Profile Setting" in your setting menu after logged in.
				</p>
				<p>
					<h4>How do I add my social media?</h4>
					You can add your social media under the second section in "Profile Setting". Only social media that has added will be displayed out on your profile.
				</p>
				<br>
				<li><h3>Image Privacy</h3></li>
				<p>
					<h4>How can I make changes to my image?</h4>
					Unfortunately, you can't. BUT! You can contact an admin for image's content changes.
				</p>
				<p>
					<h4>Will my image being used by other's for their own benefits?</h4>
					Don't worry about that, all images are copyrighted as Paces' property. Hence, action will be taken for any un-authorized image use. 
				</p>
				<p>
					<h4>What should I do if someone is using my image?</h4>
					You can contact us immediately via email. Click <a href="customer-support.php">here</a> for our email form or directly email us <a href="mailto:pacesphotography@gmail.com">pacesphotography@gmail.com</a>.
				</p>
				</ol>
			</div>
			<button class="accordion"><h2>2. Account Issue</h2></button>
			<div class="panel">
				<ol type="i">
				<li><h3>Unable to access own account</h3></li>
				<p>
					<h4>My account got stolen!</h4>
						For stolen account, please contact us immediately so we can provide you fastest support before any of your personal information or images got abused. Click <a href="customer-support.php">here</a> for our email form or directly email us <a href="mailto:pacesphotography@gmail.com">pacesphotography@gmail.com</a>.
				</p>
				<p>
					<h4>I have forgotten both email and password what should I do?</h4>
						If you have forgotten both important details for login, there will be an verification process you have to go through along with the responsible admin in order to get back your account.
				</p>
				<br>
				<li><h3>Account suspended</h3></li>
				<p>
					<h4>In what circumstances my account will get suspended?</h4>
						If you have gone against the terms of service or the privacy policies by posting illegal contents or inappriopriate images, you may at the risk of getting your account suspended. Please read on our <a href="terms-of-service.php">Terms of Service</a> and <a href="privacy-policy.php">Privacy Policy</a> before using Paces. 
				</p>
				<p>
					<h4>What if i got faulty suspended?</h4>
						You appeal by emailing us. An admin will be assigned to you.
				</p>
			</ol>
			</div>
			<button class="accordion"><h2>3. Upload Image</h2></button>
			<div class="panel">
				<ol type="i">
				<li><h3>Copyright Issue</h3></li>
				<p>
					<h4>Can I upload others' images</h4>
						Yes, you may if you have granted the owner's permission. However, please don't if you did not as it is against our <a href="terms-of-service.php">Terms of Service</a>.
				</p>
				<br>
				<li><h3>Instruction on image uploads</h3></li>
				<p>
					<h4>How do I upload an image?</h4>
						There is an "Add new photo" button appear after you have logged into your profile. The button can only be seen while you're on your own profile page.
				</p>
				<p>
					<h4>What is the maximum size I can upload?</h4>
						You can upload up to 8MB.
				</p>
				<br>
				<li><h3>Upload image issue</h3></li>
				<p>
					<h4>File is not an image</h4>
						This error message will appear when your uploading image file is not a real image, which means it may be a virus file instead.
				</p>
				<p>
					<h4>Sorry, we only accept jpg, png, jpeg and gif iamge extension.</h4>
						The extension of your image file doesn't meet our requirement. Please convert it to the mentioned extension before uploading.
				</p>
				<p>
					<h4>Image file is too large</h4>
						Your image file has exceeded our maximum upload size. Please ensure your image size is within 8MB.
				</p>
				</ol>
			</div>
			<button class="accordion"><h2>4. Contact Us</h2></button>
			<div class="panel">
				<ol type="i">
				<li><h3>Contact method</h3></li>
				<p>
						There are several methods you can contact us, via Email, visit our Headquarter or our Hotline. Please visit our <a href="customer-support" target="_blank">Email Us</a> page for more!
				</p>
				</ol>
			</div>
		</div>
	</article>

		<!--Footer-->
	<footer class="container">
		<?php
			include("footer.php");
		?>
	</footer>

<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    /* Toggle between adding and removing the "active" class,
    to highlight the button that controls the panel */
    this.classList.toggle("active");

    /* Toggle between hiding and showing the active panel */
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>


</body>
</html>