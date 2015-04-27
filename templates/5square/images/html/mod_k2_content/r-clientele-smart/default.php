<?php
 defined('_JEXEC') or die;
 ?>
 <h3><?php echo $items[0]->categoryname;?></h3>
<?php foreach ($items as $key => $item): ?>
	<div class="col-md-4 col-xs-4">
		<h4><?php echo $item->title;?></h4><br />
		<?php echo $item->introtext;?><br />
		
	</div>
<?php endforeach ?>
