<form class="stacked" action="" method="POST" enctype="multipart/form-data">
	<?php echo $Form->showField('title'); ?>
	<?php echo $Form->showField('description'); ?>
	<?php echo $Form->showField('image'); ?>
	<input type="submit" name="submit" value="Add Painting" />
</form>