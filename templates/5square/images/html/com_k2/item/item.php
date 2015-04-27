<?php
 defined('_JEXEC') or die;
// echo "<pre>";
// print_r($this->item);
// echo "</pre>";
// die;
 ?>
 <div class="row content-item">
 	<div class="col-md-9 col-xs-9 left">
 		<div class="detail-prod">
	 		<?php echo $this->item->introtext ;?>
	 	</div>
 	</div>
 	<div class="col-md-3 col-xs-3 right">
 		<div class="detail-title">
 		<p><?php echo $this->item->title ;?></p>
 		</div>
 		
 	</div>
 </div>