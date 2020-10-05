<?php
require_once('../Config/Database.php');
require_once('Controller/loginController.php');

?>
<?php

$login = new loginController();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$result = $login->AuthuserLogin($_POST);
}

?>
<!DOCTYPE html>

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>

<body>
	<div class="container">
		<section id="content">
			<form action="login.php" method="post">

				<h1>Admin Login</h1>
				<?php if (isset($result)) : ?>
					<?php echo $result; ?>
				<?php endif; ?>
				<div>
					<input type="text" placeholder="Username" required="" name="username" />
				</div>
				<div>
					<input type="password" placeholder="Password" required="" name="password" />
				</div>
				<div>
					<input type="submit" name="submit" value="Log in" />
				</div>
			</form><!-- form -->
			<div class="button">
				<a href="forgotpass.php">Forgot Password</a>
			</div><!-- button -->
			<div class="button">
				<a href="#">Training with live project</a>
			</div><!-- button -->
		</section><!-- content -->
	</div><!-- container -->
</body>

</html>