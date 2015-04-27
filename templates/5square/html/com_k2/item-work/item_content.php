<div class="row content-item">
 	<div class="col-md-9 col-xs-9 left">
 		<div class="detail-prod">
 			<p style="color:#86754d;font-size:14px;"><?php echo $this->item->category->name ;?>/<b style="text-transform: uppercase;"><?php echo $this->item->title ;?></b></p></br>
 			<b style="float:left;color:#919191;font-size:12px;">Date : </b><p ><?php echo JHTML::_('date', $this->item->created , JText::_('d/m/20y')); ?></p>
	 		<b style="float:left;color:#919191;font-size:12px;">Description :</b><?php echo $this->item->introtext ;?>
	 	</div>
 	</div>
 	<div class="col-md-3 col-xs-3 right">
 		<div class="detail-title">
 		<p><?php echo $this->item->category->name ;?></p>
 		</div>
 		
 	</div>
</div>