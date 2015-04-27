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

  <?php if($params->get('itemPreText')): ?>
  <p class="modulePretext"><?php echo $params->get('itemPreText'); ?></p>
  <?php endif; ?>

  <?php if(count($items)): ?>
  <ul>
    <?php foreach ($items as $key=>$item):  ?>
    <li class="<?php echo ($key%2) ? "odd" : "even"; if(count($items)==$key+1) echo ' lastItem'; ?>">


      <?php if($params->get('itemTitle')): ?>
      <a class="moduleItemTitle" href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a>
      <?php endif; ?>

    


      <?php if($params->get('itemImage') || $params->get('itemIntroText')): ?>
      <div class="moduleItemIntrotext">
        <?php if($params->get('itemImage') && isset($item->image)): ?>
        <div class="ct-image-detail">
          
        <a class="moduleItemImage" href="<?php echo $item->link; ?>" title="<?php echo JText::_('K2_CONTINUE_READING'); ?> &quot;<?php echo K2HelperUtilities::cleanHtml($item->title); ?>&quot;">
          <img src="<?php echo $item->image; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($item->title); ?>"/>
        </a>
        </div>
        <?php endif; ?>
        <div class="ct-detail">
          <?php if($params->get('itemIntroText')): ?>
          <?php echo $item->introtext; ?>
          <?php endif; ?>
        </div>
        
      </div>
      <?php endif; ?>



      <?php if($params->get('itemReadMore') && $item->fulltext): ?>
      <div class="more-ct">
        <a class="moduleItemReadMore" href="<?php echo $item->link; ?>">
        <?php echo JText::_('more'); ?>
      </a>
      </div>
      
      <?php endif; ?>

      <!-- Plugins: AfterDisplay -->
      <?php echo $item->event->AfterDisplay; ?>

      <!-- K2 Plugins: K2AfterDisplay -->
      <?php echo $item->event->K2AfterDisplay; ?>

   
    </li>
    <?php endforeach; ?>
  
  </ul>
  <?php endif; ?>

  

</div>
