<?php foreach($Paintings as $Painting): ?>
	<div class="paintingIndexPainting">
		<img src="<?php echo $Painting->images->small->getURL(); ?>" />
	</div>
<?php endforeach; ?>