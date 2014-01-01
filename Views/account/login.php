<?php echo $this->get('loginError'); ?>
<div id="loginOuterContainer">
	<div id="loginInnerContainer">
		<form action="" method="POST" autocomplete="off">
			<?php echo $Form->field('email'); ?>
			<?php echo $Form->field('password'); ?>
			<div class="buttonContainer">
				<?php echo $Form->field('submit'); ?>
			</div>
		</form>
	</div>
</div>