<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_tags
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JHtml::_('behavior.core');
JHtml::_('formbehavior.chosen', 'select');

// Get the user object.
$user = JFactory::getUser();

// Check if user is allowed to add/edit based on tags permissions.
// Do we really have to make it so people can see unpublished tags???
$canEdit = $user->authorise('core.edit', 'com_tags');
$canCreate = $user->authorise('core.create', 'com_tags');
$canEditState = $user->authorise('core.edit.state', 'com_tags');
$items = $this->items;
$n = count($this->items);

?>

<form action="<?php echo htmlspecialchars(JUri::getInstance()->toString()); ?>" method="post" name="adminForm" id="adminForm" class="form-inline">
	<?php if ($this->params->get('show_headings') || $this->params->get('filter_field') || $this->params->get('show_pagination_limit')) : ?>
	<fieldset class="filters btn-toolbar">
		<?php if ($this->params->get('filter_field')) :?>
			<div class="btn-group">
				<label class="filter-search-lbl element-invisible" for="filter-search">
					<?php echo JText::_('COM_TAGS_TITLE_FILTER_LABEL') . '&#160;'; ?>
				</label>
				<input type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->state->get('list.filter')); ?>" class="inputbox" onchange="document.adminForm.submit();" title="<?php echo JText::_('COM_TAGS_FILTER_SEARCH_DESC'); ?>" placeholder="<?php echo JText::_('COM_TAGS_TITLE_FILTER_LABEL'); ?>" />
			</div>
		<?php endif; ?>
		<?php if ($this->params->get('show_pagination_limit')) : ?>
			<div class="btn-group pull-right">
				<label for="limit" class="element-invisible">
					<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
				</label>
				<?php echo $this->pagination->getLimitBox(); ?>
			</div>
		<?php endif; ?>

		<input type="hidden" name="filter_order" value="" />
		<input type="hidden" name="filter_order_Dir" value="" />
		<input type="hidden" name="limitstart" value="" />
		<input type="hidden" name="task" value="" />
		<div class="clearfix"></div>
	</fieldset>
	<?php endif; ?>

	<?php if ($this->items == false || $n == 0) : ?>
		<p> <?php echo JText::_('COM_TAGS_NO_ITEMS'); ?></p>
	<?php else : ?>

	<ul class="category list-striped">
		<?php foreach ($items as $i => $item) : ?>
			<?php if ($item->core_state == 0) : ?>
				<li class="system-unpublished cat-list-row-<?php echo $i % 2; ?>">
			<?php else: ?>
				<li class="cat-list-row-<?php echo $i % 2; ?> clearfix" >
                <div class="sp-module">
                <h3 class="sp-module-title">
					<a href="<?php echo JRoute::_(TagsHelperRoute::getItemRoute($item->content_item_id, $item->core_alias, $item->core_catid, $item->core_language, $item->type_alias, $item->router)); ?>">
						<?php echo $this->escape($item->core_title); ?>
					</a>
                <div class="divider"></div>
				</h3><div class="divider"></div>
                </div>
			<?php endif; ?>
			<?php echo $item->event->afterDisplayTitle; ?>
			<?php $images  = json_decode($item->core_images);?>
			<?php if ($this->params->get('tag_list_show_item_image', 1) == 1 && !empty($images->image_intro)) :?>
				<a class="tag-img pull-left" href="<?php echo JRoute::_(TagsHelperRoute::getItemRoute($item->content_item_id, $item->core_alias, $item->core_catid, $item->core_language, $item->type_alias, $item->router)); ?>">
				<div class="overlay">
				<img src="<?php echo htmlspecialchars($images->image_intro);?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>">
                  <i class="fa fa-link"></i>
                </div>
                </a>
                
                
			<?php endif; ?>
			<?php if ($this->params->get('tag_list_show_item_description', 1)) : ?>
				<?php echo $item->event->beforeDisplayContent; ?>
				<span class="tag-body">
					<?php echo JHtml::_('string.truncate', $item->core_body, $this->params->get('tag_list_item_maximum_characters')); ?>
				</span>
				<?php echo $item->event->afterDisplayContent; ?>
			<?php endif; ?>
				</li>    
           <?php if ($n > 1 && $this->params->get('tag_list_show_item_image', 1) == 1 || $this->params->get('tag_list_show_item_description', 1) ) { ?>
            <div style="height:40px;width:100%;clear:both;"></div>
            <?php } ?>    
		<?php endforeach; ?>
	</ul>

	<?php endif; ?>
</form>
