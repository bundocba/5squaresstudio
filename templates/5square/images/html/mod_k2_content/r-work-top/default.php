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
JHtml::script(Juri::base() . 'templates/5square/html/mod_k2_content/r-work-top/js/jquery.horizontal.scroll.js');

?>

<div class="top-work-slider">
	<ul id="horiz_container_outer">
		
		<li id="horiz_container_inner">
			<ul id="horiz_container">
				<?php foreach ($items as $key => $item): ?>
				<li>
					<a href="<?php echo $item->link;?>&r=1"><img src="<?php echo $item->image ;?>"></a>
				</li>
				<?php endforeach ?>
			</ul>
			
		</li>
		
	</ul>
</div>
<div class="work-slider-scroll">
	<div id="silder-sroll-detail">
		
		<span><a id="left_scroll" class="mouseover_left" href="#"><p>PREV</p></a></span>
		<div id="dt-sroll">
			<div id="cube" ></div>
		</div>
		<span><a id="right_scroll" class="mouseover_right" href="#"><p>NEXT</p></a></span>
		
	</div>
</div>

