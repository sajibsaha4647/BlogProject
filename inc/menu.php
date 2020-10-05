<body>
	<div class="headersection templete clear">
		<a href="#">
			<div class="logo">
				<img src="images/logo.png" alt="Logo" />
				<h2>Programming</h2>
				<p>Learn From Here</p>
			</div>
		</a>
		<div class="social clear">
			<div class="icon clear">
				<a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="#" target="_blank"><i class="fa fa-google-plus"></i></a>
			</div>
			<div class="searchbtn clear">
				<form action="search.php" method="post">
					<input type="text" name="search" placeholder="Search keyword..." />
					<input type="submit" name="submit" value="Search" />
				</form>
			</div>
		</div>
	</div>
	<div class="navsection templete">
		<ul>
			<?php
			$path = $_SERVER['SCRIPT_FILENAME'];
			$CurrentPage = basename($path, '.php');
			?>
			<li><a <?php if ($CurrentPage == 'index') {
						echo 'id = "active"';
					} ?> href="index.php">Home</a></li>
			<li><a <?php if ($CurrentPage == 'about') {
						echo 'id = "active"';
					} ?> href="about.php">About</a></li>
			<li><a <?php if ($CurrentPage == 'contact') {
						echo 'id = "active"';
					} ?> href="contact.php">Contact</a></li>
		</ul>
	</div>