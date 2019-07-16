<?php
/**
 * Renders a HTML export button in the toolbar
 *
 * @package    K2import
 * @link http://www.individual-it.net
 * @license		GNU/GPL
 */

// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

class JToolbarButtonExport extends JToolbarButton
{
	/**
	 * Button type
	 *
	 * @access	protected
	 * @var		string
	 */
	var $_name = 'Export';

	public function fetchButton($type='Custom', $html = '', $id = 'custom')
	{

		//Construct the form action string:
		$Action = JURI::base().'index.php?option=com_k2import';

	return
	'<button class="btn btn-small" onclick="$(\'adminForm\').task.value = \'export_ajax_wrapper\'; $(\'adminForm\').action = \'' . $Action . '\'; $(\'adminForm\').submit();" ><span title="'.$this->_name.'" href="#">
	<i class="icon-file "> </i>
	'.$this->_name.'
	</button>';
	

	}

	public function fetchId($type='Custom', $html = '', $id = 'custom')
	{
			return $this->_parent->getName().'-'.$id;
	}

}
