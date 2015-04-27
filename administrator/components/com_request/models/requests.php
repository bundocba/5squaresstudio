<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_categories
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

class RequestModelRequests  extends JModelList
{
	
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'a.id',
				'title', 'a.title',
				'published', 'a.published',
				
				'desription', 'a.desription',
				'created_by', 'a.created_by',
				'ordering', 'a.ordering'
			);
		}

		parent::__construct($config);
	}
	
	protected function getListQuery()
	{
		// Create a new query object.
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$user = JFactory::getUser();

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'a.id, a.title, a.published, a.created_by' .
				', a.ordering'
			)
		);
	
		$query->from('#__request_password AS a');

		
		return $query;
	}
	
}
