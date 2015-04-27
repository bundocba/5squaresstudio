<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_b_survey
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$app		= JFactory::getApplication();
$user		= JFactory::getUser();
$userId		= $user->get('id');
$saveOrder	= $listOrder == 'a.ordering';
if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_request&task=request.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'articleList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
$assoc		= JLanguageAssociations::isEnabled();

?>
<script type="text/javascript">
	Joomla.orderTable = function()
	{
		table = document.getElementById("sortTable");
		direction = document.getElementById("directionTable");
		order = table.options[table.selectedIndex].value;
		if (order != '<?php echo $listOrder; ?>')
		{
			dirn = 'asc';
		}
		else
		{
			dirn = direction.options[direction.selectedIndex].value;
		}
		Joomla.tableOrdering(order, dirn, '');
	}
</script>

	<!-- 	<div class="col" style="width:100%;padding-left:400px;  position: relative;
  top: 25px;
  left: 100px;">
			<input class="random" type="submit" name="random" value="Random">
		</div>
	 -->


<form  method="post" name="adminForm" id="adminForm">
<?php if (!empty( $this->sidebar)) : ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
<?php else : ?>
	<div id="j-main-container">
<?php endif;?>
		<?php if (empty($this->items)) : ?>
			<div class="alert alert-no-items">
				<?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
			</div>
		<?php else : ?>
			<table class="table table-striped" id="articleList">
				<thead>
					<tr>
						<th width="5%" class="nowrap center hidden-phone">
							<?php echo JHtml::_('searchtools.sort', '', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING', 'icon-menu-2'); ?>
						</th>
						<th width="1%" class="hidden-phone">
							<?php echo JHtml::_('grid.checkall'); ?>
						</th>
						<th width="7%" style="min-width:55px" class="nowrap center">
							<?php echo JHtml::_('searchtools.sort', 'JSTATUS', 'a.published', $listDirn, $listOrder); ?>
						</th>
						<th >
							<?php echo JHtml::_('searchtools.sort', 'PassWord', 'a.title', $listDirn, $listOrder); ?>
						</th>

						<!-- <th width="10%" class="nowrap hidden-phone">
							<?php echo JHtml::_('searchtools.sort',  'JAUTHOR', 'a.created_by', $listDirn, $listOrder); ?>
						</th> -->
						
						<th width="5%" class="nowrap hidden-phone">
							<?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($this->items as $i => $item) :
						$item->max_ordering = 0; //??
						$ordering   = ($listOrder == 'a.ordering');
						$canCreate  = $user->authorise('core.create',     'com_request.category.'.$item->catid);
						$canEdit    = $user->authorise('core.edit',       'com_request.request.'.$item->id);
						$canCheckin = $user->authorise('core.manage',     'com_checkin') || $item->checked_out == $created_by;
						$canEditOwn = $user->authorise('core.edit.own',   'com_request.request.'.$item->id) && $item->created_by == $userId;
						$canChange  = $user->authorise('core.edit.published', 'com_request.request.'.$item->id) && $canCheckin;
					?>
					<tr class="row<?php echo $i % 2; ?>" sortable-group-id="<?php echo $item->catid; ?>">
						<td class="order nowrap center hidden-phone">
							<?php
							$iconClass = '';
							if (!$canChange)
							{
								$iconClass = ' inactive';
							}
							elseif (!$saveOrder)
							{
								$iconClass = ' inactive tip-top hasTooltip" title="' . JHtml::tooltipText('JORDERINGDISABLED');
							}
							?>
							<span class="sortable-handler<?php echo $iconClass ?>">
								<i class="icon-menu"></i>
							</span>
							<?php if ($canChange && $saveOrder) : ?>
								<input type="text" style="display:none" name="order[]" size="5" value="<?php echo $item->ordering; ?>" class="width-20 text-area-order " />
							<?php endif; ?>
						</td>
						<td class="center hidden-phone">
							<?php echo JHtml::_('grid.id', $i, $item->id); ?>
						</td>
						<td class="center">
							<div class="btn-group">
								<?php echo JHtml::_('jgrid.published', $item->published, $i, 'request.', $canChange, 'cb'); ?>
							</div>
						</td>
						
						<td class="has-context">
							<?php if ($canEdit || $canEditOwn) : ?>
									<!-- <a href="<?php echo JRoute::_('index.php?option=com_request&task=request.edit&id=' . $item->id); ?>" title="<?php echo JText::_('JACTION_EDIT'); ?>"> -->
									<input id="password" class="password" type="text" name="password_title" value="<?php echo $this->escape($item->title); ?>"placeholder="password">	
									<!-- </a> -->
									<!-- <label for="">
										<input type="checkbox" id="showHide"> Show?
									</label> -->
									

							<?php else : ?>
							<span title="<?php echo JText::sprintf('JFIELD_ALIAS_LABEL'); ?>"><?php echo $this->escape($item->title); ?></span>
							<?php endif; ?>
							
						</td>
						
						<td class="center hidden-phone">
							<?php echo (int) $item->id; ?>
						</td>
					</tr>

					
					<?php endforeach; ?>
				</tbody>	
			</table>
		<?php endif; ?>
	<?php echo $this->pagination->getListFooter(); ?>
		<?php //Load the batch processing form. ?>
		

		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHtml::_('form.token'); ?>
</form>
