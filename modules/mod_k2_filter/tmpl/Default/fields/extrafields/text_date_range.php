<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
?>

<script type="text/javascript">
	jQuery(document).ready(function () {
		jQuery("input.datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
	});
</script>
	
	<div class="k2filter-field-text-date">
		<h3>
			<?php echo $field->name; ?>
		</h3>

		<input placeholder="<?php echo JText::_('MOD_K2_FILTER_FIELD_RANGE_FROM'); ?>" class="datepicker inputbox range" name="searchword<?php echo $field->id;?>-from" type="text" <?php if (JRequest::getVar('searchword'.$field->id.'-from')) echo ' value="'.JRequest::getVar('searchword'.$field->id.'-from').'"'; ?> /> - 
		
		<input placeholder="<?php echo JText::_('MOD_K2_FILTER_FIELD_RANGE_TO'); ?>" class="datepicker inputbox range" name="searchword<?php echo $field->id;?>-to" type="text" <?php if (JRequest::getVar('searchword'.$field->id.'-to')) echo ' value="'.JRequest::getVar('searchword'.$field->id.'-to').'"'; ?> />
	</div>

