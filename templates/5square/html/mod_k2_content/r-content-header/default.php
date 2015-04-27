<?php
 defined('_JEXEC') or die;
 $document = JFactory::getDocument();
 $rootUrl = JUri::root(true);
 $template = JFactory::getApplication()->getTemplate();


 $document->addStylesheet($rootUrl.'/templates/'.$template.'/css/jquery.bxslider.css');
 $document->addStylesheet($rootUrl.'/templates/'.$template.'/css/content-header-slider.css');

?>
<div class="slider1" id="sliderWrap">
	<?php foreach ($items as $key => $item): ?>
		 <div class="slide-product">
	<a href="<?php echo $item->link; ?>&r=0">
		 	 
		 	
		 	<div class="slider-product-img">
				<img src="<?php echo $item->image;?>">
			</div>
		 	
			<div class="slider-product-title">
				<p><?php echo $item->title;?></p>
			</div>
			<div class="slider-product-date">
				<p> <?php echo JHTML::_('date', $item->created, JText::_('20y')); ?></p>
			</div>
			<div class="slider-product-introtext">
				<p> <?php echo $item->introtext; ?></p>
			</div>

		 </a>
		 </div>
	<?php endforeach ?>
</div>
<script src="<?php echo $rootUrl . '/templates/' . $template . '/js/jquery.bxslider.min.js';?>"></script>
<script language="javascript">
jQuery(window).load(function() {
	  if(window.matchMedia('(max-width: 320px)').matches)
	  {
		  	jQuery('#sliderWrap').bxSlider({
		    slideWidth: 200,
		    minSlides: 1,
		    maxSlides: 3,
		    slideMargin: 10
		  });
	  }
	  else{
		  	jQuery('#sliderWrap').bxSlider({
		    slideWidth: 200,
		    minSlides: 3,
		    maxSlides: 3,
		    slideMargin: 10
		  });
	  }
	
	
	
});
	
</script>
