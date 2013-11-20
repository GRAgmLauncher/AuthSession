<?php

require_once "config/Constants.php";
require_once "core/Autoloader.php";
require_once "config/Dependencies.php";


debug($container['CurrentSession']);
debug($container['CurrentUser']);

if (isset($_POST['login'])) {
	try {
		$container['AccountManager']->login($_POST['email'], $_POST['pass']);
	} catch (\Exception $e) {
		echo $e->getMessage();
	}
	
}

		
if (isset($_GET['logout'])) {
	$container['AccountManager']->logout();
}

if (isset($_POST['register'])) {
	try {
		$container['AccountManager']->register($_POST['user'], $_POST['email'], $_POST['pass']);
	} catch (\Exception $e) {
		echo $e->getMessage();
	}
}

?>


<html>

<head></head>
<body>
	<?php if ($container['CurrentUser']) : ?>
		<?php echo "Hello, {$container['CurrentUser']->display_name}"; ?> <a href="?logout=true">Logout</a>
	<?php endif; ?>
	<?php if (!$container['CurrentUser']): ?>
		<form action="" method="POST">
			<input type="text" name="email" />
			<input type="password" name="pass" />
			<input type="submit" name="login" value="Log In" />
		</form>
		
		<form action="" method="POST">
			<input type="text" name="user" placeholder="Enter username" />
			<input type="text" name="email" placeholder="Enter email"/>
			<input type="password" name="pass" placeholder="Choose password" />
			<input type="submit" name="register" value="Register" />
		</form>
	<?php endif; ?>
</body>
</html>