<?php

/**
 * @version   2.6.x
 * @package   K2
 * @author    JoomlaWorks http://www.joomlaworks.net
 * @copyright Copyright (c) 2006 - 2014 JoomlaWorks Ltd. All rights reserved.
 * @license   GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;
?>

<div id="k2ModuleBox<?php echo $module->id; ?>" class="k2ItemsBlock<?php if($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>">

  <?php if(count($items)): ?>
  <ul>
    <?php foreach ($items as $key=>$item):  ?>
<a class="moduleItemTitle" href="<?php echo $item->link; ?>">
    <li class="<?php echo ($key%2) ? "odd" : "even"; if(count($items)==$key+1) echo ' lastItem'; ?>">
    <div class="title-product">
			<?php if($params->get('itemTitle')): ?>
  
		<p><?php echo $item->title; ?>&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-right"></span></p>
		      <?php endif; ?>
		</div>
      
      <?php if($params->get('itemImage') ): ?>
      <div class="moduleItemIntrotext">
        <?php if($params->get('itemImage') && isset($item->image)): ?>
        <div class="ct-image-detail-product">
          
	        <!-- <a class="moduleItemImage" href="<?php echo $item->link; ?>" title="<?php echo JText::_('K2_CONTINUE_READING'); ?> &quot;<?php echo K2HelperUtilities::cleanHtml($item->title); ?>&quot;"> -->
	         <p> <img src="<?php echo $item->image; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($item->title); ?>"/></p>
	        <!-- </a> -->
        </div>
        <?php endif; ?>
      </div>
      <?php endif; ?>
    </li>
</a>
 
    <?php endforeach; ?>
  
  </ul>
  <?php endif; ?>

  

</div>
