<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/assets/styles.css">
	</head>
	<body>
		<div id="flashMessage" class="flash_<?php echo $Flash->color; ?>"><?php echo $Flash->message; ?></div>
		<nav>
			<?php if ($Session->User) : ?>
				<div id="headerWelcomeBox">
					<?php echo "Hello, {$Session->User->display_name}"; ?> <a href="/logout">Logout</a>
				</div>
			<?php endif; ?>
			<?php if (!$Session->User): ?>
				<div id="headerLoginBox">
					<form action="/login" method="POST">
						<input type="text" name="email" placeholder="Emails" />
						<input type="password" name="password" placeholder="Password" />
						<input type="submit" name="login" value="Log In" />
						<input type="hidden" name="thispage" value="<?php echo $thispage; ?>" />
					</form>
				</div>
			<?php endif; ?>
		</nav>