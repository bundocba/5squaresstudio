<?php


defined('_JEXEC') or die;

class requestHelper 
{
	public static $extension = 'com_request';

	public static function addSubmenu($vName)
	{
		JHtmlSidebar::addEntry(
			JText::_('requests'),
			'index.php?option=com_request&view=requests',
			$vName == 'requests'
			);
		// JHtmlSidebar::addEntry(
		// 	JText::_('CATEGORIES'),
		// 	'index.php?option=com_categories&extension=com_occupation',
		// 	$vName == 'categories'
		// );
	
		
	}
	public static function getActions( $assetName = 'com_request' ){
		$user	= JFactory::getUser();
		$result	= new JObject;
		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.delete','core.edit.state','core.edit.own','core.export'
		);
		foreach ($actions as $action) {
			$result->set($action, $user->authorise($action, $assetName));
		}
		return $result;
	}
}
