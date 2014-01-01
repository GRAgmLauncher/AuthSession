<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/assets/styles.css" />
		<link rel="stylesheet" type="text/css" href="/assets/buttons.css" />
	</head>
	<body>
		<div id="flashMessage" class="flash_<?php echo $Flash->color; ?>"><?php echo $Flash->message; ?></div>
		<?php debug($Session); ?>
		<?php if ($Session->User->isAdmin()) : ?>
			<div id="adminBar">Admin!</div>
		<?php endif; ?>
		<nav>
			<?php if ($Session->User->isLoggedIn()) : ?>
				<div id="headerWelcomeBox">
					<?php echo "Hello, {$Session->User->display_name}"; ?> <a href="/logout">Logout</a>
				</div>
			<?php endif; ?>
		</nav>