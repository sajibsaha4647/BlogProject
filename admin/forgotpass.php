<?php
require_once('../Config/Database.php');
require_once('Controller/loginController.php');

?>
<?php

$login = new loginController();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $result = $login->getForgotpass($_POST);
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
            <form action="" method="post">

                <h1>Forgot password</h1>
                <?php if (isset($result)) : ?>
                    <?php echo $result; ?>
                <?php endif; ?>
                <div>
                    <input type="text" placeholder="Enter Valid Email" name="email" />
                </div>
                <div>
                    <input type="submit" name="submit" value="Send" />
                </div>
            </form><!-- form -->
            <div class="button">
                <a href="login.php">Go Back to login</a>
            </div><!-- button -->
            <div class="button">
                <a href="#">Training with live project</a>
            </div><!-- button -->
        </section><!-- content -->
    </div><!-- container -->
</body>

</html>