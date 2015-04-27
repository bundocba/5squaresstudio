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
<?php JHTML::_('behavior.modal'); ?>
<div class="show-all-image">
	<ul>
		<?php foreach ($items as $key => $item): ?>
		<li>
			<!-- <a class="modal"  href="<?php echo $item->imageLarge;?>"> -->
				<a href="<?php echo $item->link;?>&r=1"><img src="<?php echo $item->image;?>"></a>
			<!-- </a> -->
		</li>
		<?php endforeach ?>
		
	</ul>
</div>
