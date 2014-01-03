<div id="managePaintingsPanel">
	<table>
		<tr>
			<th id="id">ID</th>
			<th>Size</th>
			<th>Thumbnail</th>
			<th>Title</th>
			<th>Price</th>
			<th>Inventory</th>
			<th>Edit</th>
		</tr>
		<?php foreach ($Products as $Product): ?>
			<tr>
				<td class="center"><?php echo $Product->id; ?></td>
				<td class="center"><?php echo $Product->dimensions; ?></td>
				<td class="thumbnail"><img src="<?php echo $Product->images->small->getURL(); ?>" /></td>
				<td><?php echo $Product->title ?><br /><?php echo $Product->description; ?></td> 
				<td class="center"><?php echo $Product->price; ?></td>
				<td class="center"><?php echo $Product->inventory; ?></td>
				<td class="center"><a href="/manage/painting/<?php echo $Product->id; ?>/edit">edit</a></td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>