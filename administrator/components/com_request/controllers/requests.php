<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_b_survey
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Articles list controller class.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_b_survey
 * @since       1.6
 */
class RequestControllerRequests extends JControllerAdmin
{
	
	
	public function __construct($config = array())
	{
		parent::__construct($config);

	
	}
	public function save(){

		$db = JFactory::getDbo();
		$query=$db->getQuery(true);
		$query='update #__request_password set title="'.$_POST['password_title'].'"';
		$db->setQuery($query);
 
		$result = $db->execute();
		$this->setRedirect('index.php?option=com_request');
	}

}
