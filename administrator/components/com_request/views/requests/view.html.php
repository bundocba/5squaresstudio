<?php 
 defined('_JEXEC') or die;

 class requestViewrequests extends JViewLegacy
 {
 	protected $items;

	protected $pagination;

	protected $state;
 	public function display($tpl = null)
	{
		$this->state         = $this->get('State');
		$this->items        = $this->get('Items');
		
		$this->pagination    = $this->get('Pagination');
		 // $this->filterForm    = $this->get('FilterForm');
		requestHelper::addSubmenu('requests');
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));

			return false;
		}
		if ($this->getLayout() !== 'modal')
		{
			$this->addToolbar();
			$this->sidebar = JHtmlSidebar::render();

		}

		parent::display($tpl);
	}
	protected function addToolbar()
	{

		$canDo = requestHelper::getActions();
		$user  = JFactory::getUser();

		// Get the toolbar object instance
		$bar = JToolBar::getInstance('toolbar');
		JToolbarHelper::title(JText::_('requests'), 'stack request');

		if (($canDo->get('core.edit')) || ($canDo->get('core.edit.own')))
		{
			JToolbarHelper::save('requests.save');
		}
	
		JToolbarHelper::help('JHELP_CONTENT_ARTICLE_MANAGER');
	
	}

 }
?>