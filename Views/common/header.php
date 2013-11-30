<html>
	<head>
	
	
	</head>
	<body>
		<div id="flashMessage" class="flash_<?php echo $Flash->color(); ?>"><?php echo $Flash->message(); ?></div>
		<nav>
			<?php if ($CurrentUser) : ?>
				<?php echo "Hello, {$CurrentUser->display_name}"; ?> <a href="/logout">Logout</a>
			<?php endif; ?>
			<?php if (!$CurrentUser): ?>
				<form action="/login" method="POST">
					<input type="text" name="email" placeholder="Emails" />
					<input type="password" name="password" placeholder="Password" />
					<input type="submit" name="login" value="Log In" />
					<input type="text" name="<?php echo $csrf['key']; ?>" size="20" width="300" style="width: 300px;" value="<?php echo $csrf['value']; ?>" />
				</form>
			<?php endif; ?>
		</nav>