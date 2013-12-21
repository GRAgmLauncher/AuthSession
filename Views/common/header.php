<html>
	<head>
	
	
	</head>
	<body>
		<div id="flashMessage" class="flash_<?php echo $Flash->color; ?>"><?php echo $Flash->message; ?></div>
		<nav>
			<?php if ($Session->User) : ?>
				<?php echo "Hello, {$Session->User->display_name}"; ?> <a href="/logout">Logout</a>
			<?php endif; ?>
			<?php if (!$Session->User): ?>
				<form action="/login" method="POST">
					<input type="text" name="email" placeholder="Emails" />
					<input type="password" name="password" placeholder="Password" />
					<input type="submit" name="login" value="Log In" />
				</form>
			<?php endif; ?>
		</nav>