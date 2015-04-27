<?php defined('_JEXEC') or die('Restricted access');
jimport('joomla.database.table');
class requestTablerequest extends JTable
{

	public function __construct(&$db)
	{
		
		parent::__construct('#__request_password', 'id', $db);

	}
	
}
