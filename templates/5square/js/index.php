<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;



$doc->addStyleSheet(JUri::base().'templates/' . $this->template . '/css/gotop.css');
$doc->addStyleSheet(JUri::base().'templates/' . $this->template . '/css/bootstrap.css');
$doc->addStyleSheet(JUri::base().'templates/' . $this->template . '/css/bootstrap.min.css');
$doc->addStyleSheet(JUri::base().'templates/' . $this->template . '/css/template.css');
$doc->addStyleSheet(JUri::base().'templates/' . $this->template . '/css/nivo-slider.css');
$doc->addStyleSheet(JUri::base().'templates/' . $this->template . '/css/module_content.css');
$doc->addStyleSheet(JUri::base().'templates/' . $this->template . '/css/content-item.css');
$doc->addStyleSheet(JUri::base().'templates/' . $this->template . '/css/rs-mail.css');
$doc->addStyleSheet(JUri::base().'templates/' . $this->template . '/css/contact-form.css');
$doc->addStyleSheet(JUri::base().'templates/' . $this->template . '/css/content-work.css');
$doc->addStyleSheet(JUri::base().'templates/' . $this->template . '/css/footer.css');


$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/bootstrap.js', 'text/javascript');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/jquery.ui.touch-punch.min.js', 'text/javascript');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
	<head>
		
		<jdoc:include type="head" />
		<link href='http://fonts.googleapis.com/css?family=Raleway:400,300' rel='stylesheet' type='text/css'>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
		

		<meta name="HandheldFriendly" content="true" />
		<meta name="apple-mobile-web-app-capable" content="YES" />
		
	</head>
	<body>

		<div id="goTop"></div>
		<header>
			<div class="container">
				<div class="row">
					<?php if ($this->countModules('logo')>0): ?>
					<div class="logo">				
						<jdoc:include type="modules" name="logo" style="xhtml"/>
					</div>
					<?php endif ?>
				</div>
				</header>
			</div>
		<nav>
			<div class="container">
				<div class="row">
					<nav class="navbar-default">
		              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		              </button>
		            </nav>
					<?php if ($this->countModules('menu')>0): ?>

					<div class="r-nav collapse navbar-collapse" id="bs-example-navbar-collapse-1">	

						<jdoc:include type="modules" name="menu" style="xhtml"/>
					</div>
					<?php endif ?>
				</div>
				
			</div>
		</nav>

		<?php if ($this->countModules('slideshowCK')>0): ?>
		<div class="slideshow">
			<div class="container">
				
				<div class="r-nav">				
					<jdoc:include type="modules" name="slideshowCK" style="xhtml"/>
				</div>
				
			</div>
		</div>
		<?php endif ?>
		<?php if ($this->countModules('company-profile')>0 && $this->countModules('blography')>0): ?>
		<div class="container">
			<div class="row md-content">
				<div class="md-left col-xs-12 col-md-5">
					<jdoc:include type="modules" name="company-profile" style="xhtml"/>
				</div>
				<div class="md-right col-xs-12 col-md-7">
					<jdoc:include type="modules" name="blography" style="xhtml"/>
				</div>
			</div>
		</div>
		<?php endif ?>
		<?php if ($this->countModules('content-main-module')>0) : ?>
		<div class="container module-content-product">
			<div class="row">
				<jdoc:include type="modules" name="content-main-module" style="xhtml"/>
			</div>
		</div>
		<?php endif ?>
		<?php if ($this->countModules('content-header')>0): ?>
		
			<div class="container">
				<div class="row">
					<jdoc:include type="modules" name="content-header" style="xhtml"/>
					
				</div>
			</div>

		<?php endif ?>
		<?php if ($this->countModules('Clientele')>0) : ?>
		<div class="container ">
			<div class="row Clientele">
				<jdoc:include type="modules" name="Clientele" style="xhtml"/>
			</div>
		</div>
		<?php endif ?>
		<div class="content_main container">
			<div class="row">
			<jdoc:include type="message" />
			<jdoc:include type="component" />
			</div>
		</div>	
		
		<div class="container">
				<div class="row rs-mail-and-about">
					<div class="col-md-7 rs-mail-and-about-left">
						<jdoc:include type="modules" name="rs-mail" style="xhtml"/>
						
					</div>
					<div class="col-md-5 rs-mail-and-about-right">
						<jdoc:include type="modules" name="testimonials" style="xhtml"/>	
					</div>
				</div>
			</div>
		<?php if ($this->countModules('footer-menu')>0): ?>
		<footer>
			<div class="container">
				<div class="row">
					<jdoc:include type="modules" name="footer-menu" style="xhtml"/>
				</div>
			</div>
		</footer>
		<?php endif ?>
		<script>
			jQuery(document).ready(function($) {

			$(function() {

			$(window).scroll(function() {

			if ($(this).scrollTop() > 100)

			$('#goTop').fadeIn();

			else

			$('#goTop').fadeOut();

			});

			$('#goTop').click(function() {

			$('body,html').animate({scrollTop: 0}, 'slow');

			});

			});

			});


			
		</script>
		<script>
			jQuery(document).ready(function($) {
				//fogclik contact form
				$('.rs-mail-right .rsform-block-reset div input#reset').click(function(event) {
					
					 $('.rs-mail-right div.rsform-block-email div input').val("");

					 $('.rs-mail-right div div textarea').val("");
					 $('.rs-mail-right div.rsform-block-email div input').focus();
				});
				$('.bottom-contact-form .right .rsform-block-reset div input#reset').click(function(event) {
					
					
					 $('.bottom-contact-form .right div div input').val("");
					 $('.bottom-contact-form .left-ct div div input').val("");
					 $('.bottom-contact-form .right  div div textarea').val("");
					 $('.bottom-contact-form .left-ct div.rsform-block-companyname div input').focus();
				});
				
			});
		</script>
		

	</body>

</html>