<div id="adminBar">
	<div id="adminBarUsername">
		<a class="button cancel red before pressdown dark" href="/logout">Logout</a>
	</div>
	<ul>
		<?php echo $TabHelper->tab('Add Painting', '/manage/paintings/add'); ?>
		<?php echo $TabHelper->tab('Manage Paintings', '/manage/paintings'); ?>
	</ul>
</div>