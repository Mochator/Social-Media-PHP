			<!--Profile, discovery, list, dashboard navigation bar-->
			<div id="setting-list">
				<a href="account-setting.php" class="setting-item">Account Setting</a>
				<a href="profile-setting.php" class="setting-item">Profile Setting</a>
				<?php
				$roleSql = "Select * from user where username = '$_SESSION[Paces]';";

				if($runRole = mysqli_query($con, $roleSql)) {
					$fetchRole = mysqli_fetch_array($runRole);
					if($fetchRole["Role"] != "Member") {
						echo "<a href='admin-panel.php' class='setting-item'>Admin Panel</a>";
					}
				}
				?>
				
				<a href="logout.php" class="setting-item">Logout</a>
				<span class="close" style="margin-right: 2em;" onclick="settingClose()">&times;</span>
			</div>
			<div class="container">
				<div class="nav-item">
					<a href="home.php"><img src="Resources/Logo2.png" alt="PACES Logo" id="logo"></a>
				</div>
				<div class="nav-item" id="menu">
					<a href="feed.php" class="menu-item">Feed</a>
					<a href="discovery.php" class="menu-item">Discovery</a>
					<a href="favourite-list.php" class="menu-item">Favourite List</a>
					<?php
						echo "<a href='profile.php?username=";
						echo $_SESSION["Paces"];
						echo "' class='menu-item'>Profile</a>"
					?> 
				</div>

				<div class="nav-item" id="setting" onclick="settingOpen()">
					<img src="Resources/cog.png">
				</div>
			</div>

			<!--Setting-->
			<script>
				function settingOpen() {
					document.getElementById("setting-list").style.display ="block";
					document.getElementById("setting").style.display="none";
				}
				function settingClose() {
					document.getElementById("setting-list").style.display ="none";
					document.getElementById("setting").style.display="block";
				}
			</script>