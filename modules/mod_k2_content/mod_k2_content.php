<?php
/**
 * @version		2.6.x
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2014 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die ;

if (K2_JVERSION != '15')
{
    $language = JFactory::getLanguage();
    $language->load('mod_k2.j16', JPATH_ADMINISTRATOR, null, true);
}

require_once (dirname(__FILE__).DS.'helper.php');

// Params
$moduleclass_sfx = $params->get('moduleclass_sfx', '');
$getTemplate = $params->get('getTemplate', 'Default');
$itemAuthorAvatarWidthSelect = $params->get('itemAuthorAvatarWidthSelect', 'custom');
$itemAuthorAvatarWidth = $params->get('itemAuthorAvatarWidth', 50);
$itemCustomLinkTitle = $params->get('itemCustomLinkTitle', '');
if ($params->get('enablePagination')){
    $doc = JFactory::getDocument();
    $doc->addScript('modules/mod_k2_content/assets/js/jPages.min.js');
    $doc->addStyleSheet('modules/mod_k2_content/assets/css/jPages.css');
    $js = '$K2(document).ready(function(){ $K2("div#holder'.$module->id.'").jPages({
            containerID : "k2ModuleList'.$module->id.'",
            perPage : '.$params->get('itemsPerPage', 1).'
        });    
    });';
    $doc->addScriptDeclaration($js);
}
if ($params->get('itemCustomLinkMenuItem'))
{
    $menu = JMenu::getInstance('site');
    $menuLink = $menu->getItem($params->get('itemCustomLinkMenuItem'));
    if (!$itemCustomLinkTitle)
    {
        $itemCustomLinkTitle = (K2_JVERSION != '15') ? $menuLink->title : $menuLink->name;
    }
    $params->set('itemCustomLinkURL', JRoute::_('index.php?&Itemid='.$menuLink->id));
}

// Get component params
$componentParams = JComponentHelper::getParams('com_k2');

// User avatar
if ($itemAuthorAvatarWidthSelect == 'inherit')
{
    $avatarWidth = $componentParams->get('userImageWidth');
}
else
{
    $avatarWidth = $itemAuthorAvatarWidth;
}

$items = modK2ContentHelper::getItems($params);

if (count($items))
{
    require (JModuleHelper::getLayoutPath('mod_k2_content', $getTemplate.DS.'default'));
}
