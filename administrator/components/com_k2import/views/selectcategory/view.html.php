<?php
 /**
 * K2import View
 * 
 * @package    K2import
 * @link http://www.individual-it.net
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );



class K2importViewSelectcategory extends JViewLegacy
{
	/**
	 * K2importViewSelectcategory view display method
	 * The view for selecting the Main Category for the import and to configure the import
	 * @return void
	 **/
	function display($tpl = null)
	{
		JToolBarHelper::title(   JText::_( 'K2 Import Tool' ) . ' - ' . JText::_( 'configure the import' ), 'generic.png' );

		$model =& $this->getModel();
		
		$modus= JRequest::getVar( 'modus', '', 'get', 'string' );
		
		if ($modus=='archive')
		{
			$mainframe = JFactory::getApplication();
			$file = JFolder::files($mainframe->getCfg('tmp_path').DS.'k2_import', '.csv');
			$this->assignRef( 'file', $file );
			$this->assignRef( 'modus', $modus );			
		}
		else 
		{
			$file= JRequest::getVar( 'file', '', 'get', 'string' );
			$file=JFile::makeSafe($file);
			$this->assignRef( 'file', $file );
		}

		$k2extrafieldgroups=$model->getK2extrafieldgroups();
		$this->assignRef( 'k2extrafieldgroups', $k2extrafieldgroups );	
		
		require_once JPATH_ADMINISTRATOR.'/components/com_k2/models/categories.php';
		$categoriesModel = K2Model::getInstance('Categories', 'K2Model');
		$categories_option[] = JHTML::_('select.option', "take_from_csv", JText::_('Take from CSV'));
		$categoriesFilter = $categoriesModel->categoriesTree(NULL, true, false);
		$categories_options = @array_merge($categories_option, $categoriesFilter);
		$this->assignRef( 'k2categories',JHTML::_('select.genericlist', $categories_options, 'k2category', 'onchange="hide_view_extra_field_group_selection();"', 'value', 'text'));		
		
		
		
		$document = & JFactory::getDocument();
		$document->addStyleSheet('components/com_k2import/css/k2import.css');
		$document->addScript('components/com_k2import/js/k2import.js');

		
	


		parent::display($tpl);
	}
}