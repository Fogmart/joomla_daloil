
<?php defined('_JEXEC') or die('Restricted access'); 
if(version_compare( JVERSION, '1.6.0', 'ge' )) {
	//TODO should we not switch to jQuery?
	JHTML::_('behavior.framework'); /* to load mootools */
}
?>


<form action="index.php" method="post" name="adminForm" class="k2import">

<div id="k2import_assoc_header_row">
	<div><?php echo JText::sprintf('COM_K2IMPORT_K2_FIELD'); ?></div>
	<div><?php echo JText::sprintf('COM_K2IMPORT_CSV_COLUMN'); ?></div>
	<div><?php echo JText::sprintf('COM_K2IMPORT_PHP_EVAL_FUNCTION'); ?>
		<?php echo JHtml::tooltip(JText::sprintf('COM_K2IMPORT_EVAL_EXPLANATION'),array("image"=>"notice-note.png"));?>
	</div>
</div>
<?php
foreach ($this->k2fields as $k2field)
{

	$additional_num='';
	echo '<div class="k2importfield" id="k2importfield_'.$k2field['extra']. $k2field['id'].'">
		<div class="k2importtitle">'. $k2field['title'].'</div>';
		
		

	 if ($k2field['id']=='attachment_0' || 
	 	 $k2field['id']=='attachment_title_0' || 
	 	 $k2field['id']=='attachment_title_attribute_0')
	 	 {
	 	 	echo '<div class="k2importselect"><div class="k2optionscount">[0]</div>';
	 	 }
	 else{
	 	echo '<div class="k2importselect">';
	 }
	 
	echo '<select name="k2import'.$k2field['extra'].'fields['. $k2field['id'].']" class="k2importfield" size="0">';
	echo '<option  value="" label="empty">take standard value or leave empty</option>';

	$already_selected=false;
	for ($csv_header_num=0;$csv_header_num<count($this->csv_headers);$csv_header_num++)
	{
		echo '<option  value="'.$csv_header_num.'" label="'.$this->csv_headers[$csv_header_num] . '"';
		
		$simplified_header=strtolower($this->csv_headers[$csv_header_num]);
		$simplified_header=str_replace(array(" ","_","-"), "", $simplified_header);
		$simplified_title=str_replace(array(" ","_","-"), "",strtolower($k2field['title']));
		$simplified_id=str_replace(array(" ","_","-"), "",$k2field['id']);
		
		if (($simplified_title==$simplified_header ||$simplified_id==$simplified_header)
			&& $already_selected==false
			)
		{
			echo " selected ";
			$already_selected=true;
		}
		echo '>'.$this->csv_headers[$csv_header_num].'</option>';
	}
	
	echo '</select>';
	
	if (isset($k2field['tooltip'])) {
		echo JHtml::tooltip($k2field['tooltip']);
	} else {
		echo "<span> </span>";
	}
	
	echo '</div>';

	echo '<input type="text" name="k2import'.$k2field['extra'].'fields_php_command['. $k2field['id'].']" value="" size=50 class="k2importfield" />';

	echo '</div>';

}
?>
<script type="text/javascript">
var count_attachments=1;

</script>

<input type="hidden" name="option" value="com_k2import" />
<input type="hidden" name="task" value="import_ajax_wrapper" />
<input type="hidden" name="file" value="<?php echo $this->file;?>" />
<input type="hidden" name="modus" value="<?php echo $this->modus;?>" />
<input type="hidden" name="csv_count_rows_to_do" value="<?php echo $this->csv_count_rows_to_do;?>" />
<input type="hidden" name="max_execution_time" value="<?php echo $this->max_execution_time;?>" />
<input type="hidden" name="start_row_num" value="<?php echo $this->start_row_num;?>" />

<input type="hidden" name="controller" value="k2import" />

<input type="hidden" name="k2category" value="<?php echo $this->k2category; ?>" />
<input type="hidden" name="in_charset" value="<?php echo $this->in_charset; ?>" />
<input type="hidden" name="out_charset" value="<?php echo $this->out_charset; ?>" />
<input type="hidden" name="overwrite" value="<?php echo $this->overwrite; ?>" />
<input type="hidden" name="ignore_level" value="<?php echo $this->ignore_level; ?>" />
<input type="hidden" name="k2extrafieldgroup" value="<?php echo $this->k2extrafieldgroup; ?>" />
<input type="hidden" name="should_we_import_the_id" value="<?php echo $this->should_we_import_the_id; ?>" />
<input type="hidden" name="fileroot" value="<?php echo $this->fileroot; ?>" />



<button type="submit"><?php echo  JText::_( 'continue' ); ?></button>

</form>