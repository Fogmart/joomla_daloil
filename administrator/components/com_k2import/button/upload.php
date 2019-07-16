<?php
/**

*/

// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

/**
 * Renders a standard HTML upload control in the toolbar
 *
 * @package 	Joomla.Framework
 * @subpackage		HTML
 * @since		1.5
 */
class JToolbarButtonUpload extends JToolbarButton
{
	/**
	 * Button type
	 *
	 * @access	protected
	 * @var		string
	 */
	var $_name = 'Upload';

	public function fetchButton($type='Custom', $html = '', $id = 'custom')
	{

		if (!isset($definition))
		$definition=array();
			
		if (!isset($definition[1]))
		$definition[1]='';

		if (!isset($definition[2]))
		$definition[2]='';

		//$TableSuffix = JRequest::getVar('table_suffix');
		$TableSuffix = $definition[1];

		$fNameShort = basename($definition[2]);

		//Construct the form action string:
		$Action = JURI::base().'index.php?option=com_k2import&amp;task=upload&amp;';
//TODO Translations
		$html_return = '
       <form id="k2import_selectfile_form" name="upload" method="post" enctype="multipart/form-data"
        action="'.$Action.'">
         <input type="file" name="uploaded_file" id="k2import_selectfile_uploaded_file" >
     
   		  <input  type="text" readonly="readonly" class="text_area" id="existingFileValue" name="existing_file">
    	 <input type="button" id="browseSrv" value="Browse server...">
     
		
   <button class="btn btn-small" onclick="$(\'k2import_selectfile_form\').submit()">
<i class="icon-file "> </i>Import Items
</button>	
        
		

       </form>';


		return $html_return;
	}

	public function fetchId($type='Custom', $html = '', $id = 'custom')
	{
		if(version_compare(JVERSION,'1.6.0','ge')) {
			return $this->_parent->getName().'-'.$id;
		}

	}
}
