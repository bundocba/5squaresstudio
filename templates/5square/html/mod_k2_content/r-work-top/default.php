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
			<ul id="horiz_container" >
				<?php foreach ($items as $key => $item): ?>
				<li >
					<a href="#">
					<!-- <a href="<?php echo $item->link;?>&r=1"> -->
						<img src="<?php echo $item->image ;?>">
					<!-- </a> -->
					</a>
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

<script  type="text/javascript">
	jQuery(document).ready(function($) {
		$_paramPx=320;
		$_left = jQuery('li#horiz_container_inner').offset().left;
		if ($(window).width()<=768 && $(window).width()>480) {
			$_left=0;
			$_paramPx=247;
		}
		else if($(window).width()<=480){
			$_left=0;
			$_paramPx=149;
		}else{
			
			$_left=$_left-198;
			$_paramPx=320;
		}
		jQuery('.top-work-slider ul li img').hover(function() {
			
			window.clearInterval(binterval);
		}, function() {
			
		});
		var binterval=	setInterval(function () {
			varName();
		}, 1000);
		var f=0;
		var varName = function(){
			console.log($_left)
				if ($(window).width()<=768 && $(window).width()>480) {

					if($_left<-1307){
						f=1;
					}
					if($_left>-14){
						f=0;
					}
					if(f==1)
					{
						m_right();

					}else{
						m_left();
					}
				}
				else if($(window).width()<=480){
					if($_left<-700){
						f=1;
					}
					if($_left>-14){
						f=0;
					}
					if(f==1)
					{
						
						m_right();

					}else{
						m_left();
					}
				}
				else{
					
					if($_left<-1850){
						f=1;
					}
					if($_left>-14){
						f=0;
					}
					if(f==1)
					{
						
						m_right();

					}else{
						m_left();
					}
				}
				
		}

		function m_left(){	
			$_left -= $_paramPx;	
			jQuery('li#horiz_container_inner').animate({
					left: $_left	
			});
		}
		function m_right(){
			$_left += $_paramPx;
			jQuery('li#horiz_container_inner').animate({
				left: $_left	
			});		
		}
	});
</script>
