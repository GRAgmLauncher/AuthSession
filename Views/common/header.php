<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/assets/styles.css" />
		<link rel="stylesheet" type="text/css" href="/assets/buttons.css" />
	</head>
	<body>
		<div id="flashMessage" class="flash_<?php echo $Flash->color; ?>"><?php echo $Flash->message; ?></div>
		<?php if ($Session->User->isAdmin()) : ?>
			<?php require_once("/Views/common/includes/adminBar.php"); ?>
		<?php endif; ?>
		<nav>

		</nav>