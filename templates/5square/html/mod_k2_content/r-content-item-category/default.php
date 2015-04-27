<?php
 defined('_JEXEC') or die;

 ?>
  <div class="row content-item">
  	<div class="detail-title detail-320px">
 		<p><?php echo $items[0]->categoryname ;?></p>
	</div>
 	<div class="col-md-9 col-xs-9 left">
 		<div class="detail-prod"style="padding-top:15px;">
 			<?php foreach ($items as $key => $item): ?>
 			<?php if ( $item->id!=36): ?>
 				<div class="product-item-categories">
	 				<div class="product-item-categories-title">
	 					<p class="r-title"><?php echo $item->title;?></p>
	 					<p class="r-icon">
	 						<?php if ($item->image): ?>
	 							<img src="<?php echo $item->image;?>" alt="">
	 						
	 						<?php endif ?>
	 					</p>
	 				</div>
	 				<div class="product-item-categories-introtext">
	 					<p><?php echo $item->introtext;?></p>
	 				</div>
	 			</div>
 			<?php endif ?>
 			<?php endforeach ?>
 			
	 	</div>
 	</div>
 	<div class="col-md-3 col-xs-3 right detail-320px-mall">
 		<div class="detail-title">
 		<p><?php echo$items[0]->categoryname ;?></p>
 		</div>
 		
 	</div>
 </div> 