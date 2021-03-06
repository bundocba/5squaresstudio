<?php
/**
 * @version		$Id: view.php 2725 2013-04-06 17:05:49Z joomlaworks $
 * @package		Simple Image Gallery Pro
 * @author		JoomlaWorks - http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2013 JoomlaWorks Ltd. All rights reserved.
 * @license		http://www.joomlaworks.net/license
 */

// no direct access
defined('_JEXEC') or die ;

jimport('joomla.application.component.view');

if (version_compare(JVERSION, '3.0', 'ge'))
{
	class SigProViewBase extends JViewLegacy
	{
	}

}
else
{
	class SigProViewBase extends JView
	{
	}

}

class SigProView extends SigProViewBase
{

	public function __construct($config = array())
	{

		// Parent construct
		parent::__construct($config);

		// Add common variables to the view
		$mainframe = JFactory::getApplication();

		$option = JRequest::getCmd('option');
		$this->assignRef('option', $option);

		$view = JRequest::getCmd('view');
		$this->assignRef('view', $view);

		$task = JRequest::getCmd('task');
		$this->assignRef('task', $task);

		$type = JRequest::getCmd('type', 'site');
		$this->assignRef('type', $type);

		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$this->assignRef('limit', $limit);

		$limitstart = $mainframe->getUserStateFromRequest($option.$view.$type.'.limitstart', 'limitstart', 0, 'int');
		$this->assignRef('limitstart', $limitstart);

		$sorting = $mainframe->getUserStateFromRequest($option.$view.$type.'sorting', 'sorting', 'modified DESC', 'string');
		$this->assignRef('sorting', $sorting);

		$folder = SigProHelper::getVar('folder');
		$this->assignRef('folder', $folder);

		$params = JComponentHelper::getParams('com_sigpro');
		$this->assignRef('params', $params);

		$tmpl = JRequest::getCmd('tmpl', 'index');
		$this->assignRef('tmpl', $tmpl);

		$editorName = JRequest::getCmd('editorName');
		$this->assignRef('editorName', $editorName);

		$languages = SiGProHelper::getLanguagesList();
		$this->assignRef('languages', $languages);

		$language = JRequest::getCmd('language');
		$this->assign('language', $language);

		if (version_compare(JVERSION, '3.0', 'ge'))
		{
			$version = '30';
		}
		elseif (version_compare(JVERSION, '2.5', 'ge'))
		{
			$version = '25';
		}
		else
		{
			$version = '15';
		}
		$this->assignRef('version', $version);

		$options = array();
		$options[] = JHTML::_('select.option', 0, JText::_('COM_SIGPRO_NORMAL'));
		$options[] = JHTML::_('select.option', 1, JText::_('COM_SIGPRO_SINGLE_THUMBNAIL'));
		$displayMode = JHTML::_('select.genericlist', $options, 'displayMode', '', 'value', 'text');
		$this->assign('displayMode', $displayMode);

		$options = array();
		$options[] = JHTML::_('select.option', 0, JText::_('COM_SIGPRO_NO_CAPTIONS'));
		$options[] = JHTML::_('select.option', 1, JText::_('COM_SIGPRO_SHOW_GENERIC_MESSAGES'));
		$options[] = JHTML::_('select.option', 2, JText::_('COM_SIGPRO_READ_CONTENTS_OF_CAPTION_FILES'));
		$captionsMode = JHTML::_('select.genericlist', $options, 'captionsMode', '', 'value', 'text');
		$this->assign('captionsMode', $captionsMode);

		// Add title and toolbar depending on contenxt
		$user = JFactory::getUser();
		switch ($view)
		{
			case 'galleries' :
				if ($task == 'add')
				{
					JToolBarHelper::title(JText::_('COM_SIGPRO_ADD_GALLERY'), 'sigPro');
					//JToolBarHelper::save('create', 'COM_SIGPRO_PROCEED');
				}
				else
				{
					JToolBarHelper::title(($type == 'k2') ? JText::_('COM_SIGPRO_K2_GALLERIES') : JText::_('COM_SIGPRO_SITE_GALLERIES'), 'sigPro');
					//JToolBarHelper::addNew();
					//JToolBarHelper::deleteList('COM_SIGPRO_YOU_ARE_GOING_TO_DELETE_PERMANENTLY_THE_SELECTED_FOLDERS_FROM_THE_SERVER_ARE_YOU_SURE', 'delete');
					if ($tmpl != 'component' && (version_compare(JVERSION, '1.6.0', 'lt') || $user->authorise('core.admin', $option)))
					{
						//JToolBarHelper::divider();
						//JToolBarHelper::preferences('com_sigpro', '480', '640');
					}
				}
				break;

			case 'gallery' :
				JToolBarHelper::title(JText::_('COM_SIGPRO_EDIT_GALLERY'), 'sigPro');
				//JToolBarHelper::addNew('add', 'COM_SIGPRO_ADD_IMAGES');
				if ($type == 'k2' && $tmpl == 'component')
				{
					//JToolBarHelper::apply();
				}
				else
				{
					//JToolBarHelper::save();
					//JToolBarHelper::apply();
					//JToolBarHelper::cancel();
				}
				break;

			case 'media' :
			case 'info' :
				if ($view == 'info')
				{
					JToolBarHelper::title(JText::_('COM_SIGPRO_INFORMATION'), 'sigPro');
				}
				else
				{
					JToolBarHelper::title(JText::_('COM_SIGPRO_MEDIA_MANAGER'), 'sigPro');
				}
				if ($tmpl != 'component' && (version_compare(JVERSION, '1.6.0', 'lt') || $user->authorise('core.admin', $option)))
				{
					//JToolBarHelper::preferences('com_sigpro', '480', '640');
				}
				break;
			case 'settings' :
				JToolBarHelper::title(JText::_('COM_SIGPRO_SETTINNGS'), 'sigPro');
				break;
		}

		// Add submenu entries depending on context
		if (($view == 'galleries' || $view == 'media' || $view == 'info') && $task != 'add')
		{
			//JSubMenuHelper::addEntry(JText::_('COM_SIGPRO_SITE_GALLERIES'), 'index.php?option=com_sigpro&view=galleries&type=site', $view == 'galleries' && $type == 'site');
			if (JFile::exists(JPATH_SITE.'/components/com_k2/k2.php'))
			{
				//JSubMenuHelper::addEntry(JText::_('COM_SIGPRO_K2_GALLERIES'), 'index.php?option=com_sigpro&view=galleries&type=k2', $view == 'galleries' && $type == 'k2');
			}
			//JSubMenuHelper::addEntry(JText::_('COM_SIGPRO_MEDIA_MANAGER'), 'index.php?option=com_sigpro&view=media', $view == 'media');
			//JSubMenuHelper::addEntry(JText::_('COM_SIGPRO_INFORMATION'), 'index.php?option=com_sigpro&view=info', $view == 'info');
		}

		// Add styles and scripts if we are in an HTML document
		$document = JFactory::getDocument();
		if ($document->getType() == 'html')
		{

			//Meta Heading
			$document = JFactory::getDocument();
			$document->setMetaData("viewport", "width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no");

			JHTML::_('behavior.keepalive');
			if ($this->tmpl == 'component' && version_compare(JVERSION, '1.6.0', 'lt'))
			{
				$mainframe = JFactory::getApplication();
				$document->addStyleSheet(JURI::root(true).'/administrator/templates/system/css/system.css');
				$document->addStyleSheet(JURI::root(true).'/administrator/templates/'.$mainframe->getTemplate().'/css/icon.css');
			}
			$document->addStyleSheet('//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700&subset=latin,cyrillic,greek,vietnamese');
			$document->addStyleSheet(JURI::root(true).'/administrator/components/com_sigpro/css/fonts.css');
			$document->addStyleSheet(JURI::root(true).'/administrator/components/com_sigpro/css/style.css');
			$document->addScript('//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js');
			$document->addScript(JURI::root(true).'/administrator/components/com_sigpro/js/chosen.jquery.min.js');
			$document->addScript(JURI::root(true).'/administrator/components/com_sigpro/js/script.js');
			$document->addScriptDeclaration("var sigProLanguage = new Array('".JText::_('COM_SIGPRO_CHECKING', true)."');");
			// Load the uploader where needed
			if ($view == 'gallery')
			{
				// Load SwipeBox
				$document->addScript(JURI::base(true).'/components/com_sigpro/js/swipebox/ios-orientationchange-fix.js');
				$document->addScript(JURI::base(true).'/components/com_sigpro/js/swipebox/jquery.swipebox.min.js');
				$document->addStyleSheet(JURI::base(true).'/components/com_sigpro/js/swipebox/swipebox.css');

				// Load variables used by the uploader
				$document->addScriptDeclaration('var SIGMaxFileSize = "'.ini_get('upload_max_filesize').'"; var SIGDeleteWarning = "'.JText::_('COM_SIGPRO_DELETE_WARNING', true).'"; var SIGImagesLabel = "'.JText::_('COM_SIGPRO_IMAGES', true).'";');
				
				// Load the plupload script
				$document->addScript(JURI::base(true).'/components/com_sigpro/js/plupload/plupload.js');
				
				// Load the plupload runtimes. Add more?
				$document->addScript(JURI::base(true).'/components/com_sigpro/js/plupload/plupload.flash.js');
				$document->addScript(JURI::base(true).'/components/com_sigpro/js/plupload/plupload.html4.js');
				$document->addScript(JURI::base(true).'/components/com_sigpro/js/plupload/plupload.html5.js');
				
				// Load the queue widget styles and scripts
				$document->addStyleSheet(JURI::base(true).'/components/com_sigpro/js/plupload/jquery.plupload.queue/css/jquery.plupload.queue.css');
				$document->addScript(JURI::base(true).'/components/com_sigpro/js/plupload/jquery.plupload.queue/jquery.plupload.queue.js');
				
				// Try to load the approprieate language file for the uploader
				$language = JFactory::getLanguage();
				$tag = $language->getTag();
				$tag = str_replace('-', '_', $tag);
				$lang = false;
				if (JFile::exists(JPATH_COMPONENT.'/js/plupload/i18n/'.$tag.'.js'))
				{
					$lang = $tag;
				}
				else
				{
					$parts = @explode('_', $tag);
					if (isset($parts[0]) && JFile::exists(JPATH_COMPONENT.'/js/plupload/i18n/'.$parts[0].'.js'))
					{
						$lang = $parts[0];
					}
				}
				if ($lang)
				{
					$document->addScript(JURI::base(true).'/components/com_sigpro/js/plupload/i18n/'.$lang.'.js');
				}

			}
			if ($view == 'media')
			{
				$document->addStyleSheet('//ajax.googleapis.com/ajax/libs/jqueryui/1/themes/smoothness/jquery-ui.css');
				$document->addScript('//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js');
				$document->addStyleSheet(JURI::base(true).'/components/com_sigpro/js/elfinder/css/elfinder.min.css');
				$document->addStyleSheet(JURI::base(true).'/components/com_sigpro/js/elfinder/css/theme.css');
				$document->addScript(JURI::base(true).'/components/com_sigpro/js/elfinder/js/elfinder.min.js');
				
				// Try to load the approprieate language file for the media manager
				$language = JFactory::getLanguage();
				$tag = $language->getTag();
				$tag = str_replace('-', '_', $tag);
				$lang = false;
				if (JFile::exists(JPATH_COMPONENT.'/js/elfinder/js/i18n/elfinder.'.$tag.'.js'))
				{
					$lang = $tag;
				}
				else
				{
					$parts = @explode('_', $tag);
					if (isset($parts[0]) && JFile::exists(JPATH_COMPONENT.'/js/elfinder/js/i18n/elfinder.'.$parts[0].'.js'))
					{
						$lang = $parts[0];
					}
				}
				if ($lang)
				{
					$document->addScript(JURI::base(true).'/components/com_sigpro/js/elfinder/js/i18n/elfinder.'.$lang.'.js');
					$document->addScriptDeclaration('var sigProMediaManagerLang = "'.$lang.'";');
				}
				else
				{
					$document->addScriptDeclaration('var sigProMediaManagerLang = "en";');
				}
			}

		}

		// Add the toolbar and the title to the view.
		$title = $mainframe->JComponentTitle;
		$this->assignRef('title', $title);
		if ($this->tmpl == 'component')
		{
			$toolbar = JToolBar::getInstance('toolbar');
			$toolbar = $toolbar->render('toolbar');
			$this->assignRef('toolbar', $toolbar);
		}

	}

	public function display($tpl = null)
	{
		// Add the menu layout
		if ($this->tmpl == 'component')
		{
			$menu = '';
		}
		else
		{
			ob_start();
			include JPATH_COMPONENT_ADMINISTRATOR.'/layouts/menu.php';
			$menu = ob_get_clean();
		}
		$this->assign('menu', $menu);

		// Add the sidebar layout
		ob_start();
		include JPATH_COMPONENT_ADMINISTRATOR.'/layouts/sidebar.php';
		$sidebar = ob_get_clean();
		$this->assign('sidebar', $sidebar);

		if (isset($this->pagination))
		{
			// Prepare pagination object
			$pagination = new stdClass;
			$pagination->total = $this->pagination->get('pages.total');
			$pagination->active = $this->pagination->get('pages.current');
			$pagination->limit = $this->pagination->get('limit');
			$pagination->limitstart = $this->pagination->get('limitstart');
			$pagination->limitbox = $this->pagination->getLimitBox();
			$pagination->pages = array();
			$pagination->startOffset = 0;
			$pagination->previousOffset = ($pagination->active * $pagination->limit) - (2 * $pagination->limit);
			if ($pagination->previousOffset < 0)
			{
				$pagination->previousOffset = 0;
			}
			$pagination->endOffset = ($pagination->total * $pagination->limit) - $pagination->limit;
			$pagination->nextOffset = $pagination->active * $pagination->limit;
			if ($pagination->nextOffset > $pagination->endOffset)
			{
				$pagination->nextOffset = $pagination->endOffset;
			}
			for ($i = 1; $i <= $pagination->total; $i++)
			{
				$page = new stdClass;
				$page->number = $i;
				$page->offset = ($i * $pagination->limit) - $pagination->limit;
				if ($page->offset < 0)
				{
					$page->offset = 0;
				}
				if ($page->offset > $pagination->endOffset)
				{
					$page->offset = $pagination->endOffset;
				}
				$page->active = ($i == $pagination->active);
				$pagination->pages[] = $page;
			}
			// Add the pagination layout
			ob_start();
			include JPATH_COMPONENT_ADMINISTRATOR.'/layouts/pagination.php';
			$pagination = ob_get_clean();
			$this->assign('pagination', $pagination);

		}
		parent::display($tpl);
	}

}
