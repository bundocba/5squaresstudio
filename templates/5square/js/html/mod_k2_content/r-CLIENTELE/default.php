<?php
 defined('_JEXEC') or die;
// echo "<pre>";
// print_r($items);
// echo "</pre>";
// die;
  
 ?>

  <div class="row content-item">
 	<div class="col-md-9 col-xs-9 left">
 		<div class="detail-prod"style="padding-top:15px;">
 			<?php foreach ($items as $key => $item): ?>
 				<div class="product-item-categories">
	 				<div class="product-item-categories-title">
	 					<p class="r-title"><?php echo $item->title;?></p>
	 					<p class="r-icon"><img src="<?php echo $item->image;?>" alt=""></p>
	 				</div>
	 				<div class="product-item-categories-introtext">
	 					<p><?php echo $item->introtext;?></p>
	 				</div>
	 			</div>

 			<?php endforeach ?>
 			
	 	</div>
 	</div>
 	<div class="col-md-3 col-xs-3 right">
 		<div class="detail-title">
 		<p><?php echo $items[0]->categoryname ;?></p>
 		</div>
 		
 	</div>
 </div> 