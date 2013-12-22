<form class="stacked" action="" method="POST" enctype="multipart/form-data">
	<?php echo $Form->field('title'); ?>
	<?php echo $Form->field('description'); ?>
	<?php echo $Form->field('dimensions'); ?>
	<?php echo $Form->field('image'); ?>
	<input type="submit" name="submit" value="Add Painting" />
</form>