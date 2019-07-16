<?php

/**
 * K2import default controller
 *
 * @package    K2import
 * @link http://www.individual-it.net
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controller');


/**
 * K2import Component Controller
 *
 * @package		K2import
 */
class K2importController extends JControllerLegacy
{
	
	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
	function display($cachable = false, $urlparams = Array())
	{
				
		
		parent::display();
	}

	function import_ajax_wrapper()
	{

		$view = & $this->getView( 'importajaxwrapper', 'html' );
	
// 		echo "<pre>";
// 		print_r($_POST);
// 		echo "</pre>";
		$_POST['task']='import';
		$csv_count_rows_to_do	= JRequest::getVar( 'csv_count_rows_to_do', '10', 'post', 'int' );
		$start_row_num	= JRequest::getVar( 'start_row_num', '1', 'post', 'int' );
		$view->display();


		$document = & JFactory::getDocument();
		$url=JURI::base().'index.php?option=com_k2import&task=import';
			

		$js="
		var xmlHttpObject;
		var response;
		var start_row_num =".$start_row_num.";
		window.addEvent('domready', function(){	
				import_ajax_wrapper();						
			});
				
		function import_ajax_wrapper() {			
			var request = jQuery.ajax({
					url: '".$url."',
					type: 'POST',
					data: '".http_build_query($_POST, '', '&')."&start_row_num='+start_row_num,
					dataType: 'html',
					beforeSend: function( xhr ) {
							jQuery('#k2import_messages').append(\"<div class='k2import_message'>". JText::_( 'importing items, please stand by')	."</div>\");	
							}
					});
														
			request.fail(function(jqXHR, textStatus,errorThrown) {
				jQuery('#k2import_messages').append(\"<div class='k2import_message'>\" + textStatus + \" - \" + errorThrown + \"<br><br>When reporting this error check <a href=http://webmasters.stackexchange.com/questions/8525/how-to-open-the-javascript-console-in-different-browsers>Javascript Console</a> for more information<br><pre>\"	+ jqXHR.getAllResponseHeaders() + \"</pre></div>\");
				console.log(jqXHR.responseText);
							
			});				
			
		

					
			request.done(function(msg, textStatus, jqXHR) {
										
					var error_messages='';
					start_row_num=start_row_num+".$csv_count_rows_to_do.";
					//alert (xmlHttpObject.response.text);
					
					try {
						response = jQuery.parseJSON(msg);
						//alert(response.error_message[0]);
						response.error_message.each(function(error_message)
						{					
							if (error_message!='')
							{
								//TODO add to language file
								error_messages=error_messages+'<li>' + error_message +'</li>';
							}						
						});							
							
					} catch (e) {
						
						response = new Object();
						response.finish=true;
						
						//TODO add to language file
						error_messages=error_messages+'<li>Unexpected ERROR. We cancel the import. If there are just Warnings and Notices try to set your Error Reporting in System->Global Configuration->Server to \'None\' or \'Simple\'.<br><br>' + msg +'</li>';
						
					}

					if (error_messages=='')
					{
						message='". JText::_( 'items were successful imported')	."';
					}
					else
					{
						message='". JText::_( 'items were imported, but with some problems')	.":' + ' <ol>' + error_messages + '</ol>';
					}

					message = message + ' <div class=\"k2import_rows_left\">Row: ' + response.absolute_row_num + ' / memory peak: ' + response.memory + '<div>';
					
					jQuery('#k2import_messages').append(\"<div class='k2import_message'>\"+message+\"</div>\");	
					jQuery('html, body').animate({ scrollTop: jQuery(document).height()-jQuery(window).height() },100);
					if (response.finish==false)
					{
						import_ajax_wrapper();
					}
					else
					{
			
						jQuery('#k2import_messages').append(\"<div class='k2import_message'>". JText::_( 'Import finished')	."</div>\");
						jQuery('html, body').animate({ scrollTop: jQuery(document).height()-jQuery(window).height() },100);
					}
					
				});
			}
			
			";

		$document->addStyleSheet('components/com_k2import/css/k2import.css');
		$document->addScript('components/com_k2import/js/k2import.js');
		
		
		$document->addScriptDeclaration($js);
		if(version_compare(JVERSION,'1.6.0','ge')) {
			JHtml::_('behavior.framework', true);
		}		
		
		
	}

	function import()
	{


		$db =& JFactory::getDBO();
		$mainframe 				= JFactory::getApplication();


		$file        				= JRequest::getVar( 'file', '', 'post', 'string' );
		$k2category        			= JRequest::getVar( 'k2category', '', 'post', 'string' );
		$k2importfields       		= JRequest::getVar( 'k2importfields', '', 'post' );
		$k2importfields_php_command	= JRequest::getVar( 'k2importfields_php_command', '', 'post' );
		
		$k2importextrafields   		= JRequest::getVar( 'k2importextrafields', '', 'post' );
		$in_charset        			= substr(JRequest::getVar( 'in_charset', '', 'post' ),0,20);
		$out_charset        		= substr(JRequest::getVar( 'out_charset', '', 'post' ),0,20);
		$overwrite        			= JRequest::getVar( 'overwrite', 'NO', 'post','string' );
		$ignore_level       		= JRequest::getVar( 'ignore_level', 'NO', 'post', 'string' );
		$should_we_import_the_id	= JRequest::getVar( 'should_we_import_the_id', 'NO', 'post', 'string' );
		
		$modus        				= JRequest::getVar( 'modus', '', 'post', 'string' );
		$start_row_num 				= JRequest::getVar( 'start_row_num', '1', '', 'int' );
		$max_execution_time			= JRequest::getVar( 'max_execution_time', '', 'post', 'int' );
		$csv_count_rows_to_do		= JRequest::getVar( 'csv_count_rows_to_do', '10', 'post', 'int' );
		$fileroot					= JRequest::getVar( 'fileroot', '/', 'post', 'string' );
		
		
		if ((int)$max_execution_time>0)
		{
			ini_set('max_execution_time', (int)$max_execution_time);
		}
		$start_row_num=(int)$start_row_num;

		$file=JFile::makeSafe($file);

		if ($overwrite!='ID' && $overwrite!='TITLE')
		$overwrite='NO';
		
		if ($ignore_level!='YES')
		$ignore_level='NO';
		
		if ($should_we_import_the_id!='YES')
		$should_we_import_the_id='NO';		



		if ($k2category=='take_from_csv')
		$k2extrafieldgroup        = JRequest::getVar( 'k2extrafieldgroup', '', 'post', 'int' );
		else
		$k2extrafieldgroup='';
			


		$sql_error_message='';
		$error_message=array();
		//array_push($error_message, $start_row_num);
		//[]='' . $start_row_num;

		$model=$this->getModel( 'k2import' );
		if ($modus=='archive')
		{
			$file='k2_import'.DS.$file;
		}


		$csv_data=$model->getData($file,$in_charset,$out_charset,$start_row_num,$csv_count_rows_to_do);

		if (empty($csv_data['error']))
		{
			$csv_data=$csv_data['data'];
		}
		else 
		{
			$error_message[]=$csv_data['error'];
			$csv_data=array();
		}
		
		$k2fields=$model->getK2fields($k2category,$k2extrafieldgroup);


		//create a list of all k2fields we like to import
		$k2fieldlist='';
		$count_csv_rows=count($csv_data);


		$return=new stdClass();

		//we are comming to the end
		if ($csv_count_rows_to_do>$count_csv_rows)
		{
			$csv_count_rows_to_do=$count_csv_rows;

			$return->finish=true;
		}
		else
		{
			$return->finish=false;
		}



		for($csv_row_num=0; $csv_row_num<$count_csv_rows;$csv_row_num++)
		{

			$absolute_row_num=$start_row_num+$csv_row_num;
			$return->absolute_row_num=& $absolute_row_num;

			$attachments_names=array();
			$attachments_titles=array();
			$attachments_title_attributes=array();
			//add the imported values
			$field_array=array();
			$k2_sub_category = array();
			$gallery='';
			$gallery_images='';
			$tags=array();
			$id_from_csv='';
			$image_name='';

			foreach ($k2importfields as $name=>$column_num)
			{
				if (is_numeric($column_num))
				{
					//eval custom PHP command
					if (isset($k2importfields_php_command[$name]) && $k2importfields_php_command[$name]!="") {
						$csv_data[$csv_row_num][$column_num]=$this->eval_k2importfields_php_command($k2importfields_php_command[$name],$csv_data[$csv_row_num][$column_num]);
					}
					
					if ($name=='tags' )
					{
						$tags=explode(',',$csv_data[$csv_row_num][$column_num]);
						array_walk($tags , create_function('&$temp', '$temp = trim($temp);'));
						$tags=$model->getK2tags($tags);
					}
					elseif ($name=='id' )
					{
						//we don't import the id, we just need it for overwriting
						$id_from_csv=(int)$csv_data[$csv_row_num][$column_num];
					}


					elseif ($name =='image')
					{
						$image_name=$csv_data[$csv_row_num][$column_num];
					}
					elseif (substr($name,0,26) =='attachment_title_attribute')
					{
						array_push($attachments_title_attributes, $csv_data[$csv_row_num][$column_num]);
					}
					elseif (substr($name,0,16) =='attachment_title')
					{
						array_push($attachments_titles, $csv_data[$csv_row_num][$column_num]);
					}
					elseif (substr($name,0,10) =='attachment')
					{
						if (!filter_var($csv_data[$csv_row_num][$column_num],FILTER_VALIDATE_URL) && $csv_data[$csv_row_num][$column_num] !== "") {
							$csv_data[$csv_row_num][$column_num]=$fileroot.$csv_data[$csv_row_num][$column_num];
						}
						array_push($attachments_names, $csv_data[$csv_row_num][$column_num]);
					}

					elseif ($name =='created_by')
					{
						//if (strlen($field_array)>0)
						//	$field_array .= ',';
						$user =& JFactory::getUser();

						//check if there is such a user in the DB
						$db =& JFactory::getDBO();

						$db->setQuery("SELECT count(id) from `#__users` WHERE id='".(int)$csv_data[$csv_row_num][$column_num]."'");
						$user_count = $db->loadResult();

						if ($user_count==1)
							$field_array[$name]= (int)$csv_data[$csv_row_num][$column_num];
						else
						{
							$field_array[$name]= (int)$user->id;
							array_push($error_message, 'row: '. $absolute_row_num  .' there is no user with the ID: ' . (int)$csv_data[$csv_row_num][$column_num]. " I'm using the ID:".(int)$user->id );
								
							//							$error_message[]=. "\n";
						}


					}
					elseif ($name =='k2category_name')
					{


						//check if there is a category with this name, if yes get the id
						if ($ignore_level=='NO')
						{
								
							if ($k2category!='take_from_csv')
								$parent_cat_sql=' AND parent="'.(int)$k2category.'" ';
							else
								$parent_cat_sql=' AND parent="0" ';
						}
						else
							$parent_cat_sql=' ';

						$db->setQuery("SELECT id from `#__k2_categories` WHERE name='".$db->escape($csv_data[$csv_row_num][$column_num])."'" . $parent_cat_sql . " LIMIT 1");


						$k2_sub_category['id'] = $db->loadResult();
						if ($k2_sub_category['id'] == null)
						{
							//we have create a new category, so collect the data for it
							$k2_sub_category['name'] = $csv_data[$csv_row_num][$column_num];
							if ($k2category!='take_from_csv')
								$k2_sub_category['parent_id'] = (int)$k2category;
							else
								$k2_sub_category['parent_id'] =0;
						}


					}
					elseif ($name =='k2category_description' )
					{
						//collect the data for the category

						$k2_sub_category['description'] = $csv_data[$csv_row_num][$column_num];
					}
					elseif ($name =='k2category_access')
					{
						if (!is_numeric($csv_data[$csv_row_num][$column_num]))
						{
							$error_message[]='row: '. $absolute_row_num  ." the category access is not valid. Integer value requered!\n";
							$k2_sub_category['access'] = 0;
						} else {
							$k2_sub_category['access'] = (int)$csv_data[$csv_row_num][$column_num];
						}
					}
					elseif ($name =='k2category_trash')
					{
					
						if (	$csv_data[$csv_row_num][$column_num]!=0 &&
								$csv_data[$csv_row_num][$column_num]!=1 )
						{
							$error_message[]='row: '. $absolute_row_num  ." the value is not valid. Possible values are 0 for not trashed and 1 for trashed\n";
							$k2_sub_category['trash'] = 0;
						} else {
							$k2_sub_category['trash'] = (int)$csv_data[$csv_row_num][$column_num];
						}
					}					
					elseif ($name =='k2category_plugins')
					{			
						$k2_sub_category['plugins'] = $csv_data[$csv_row_num][$column_num];
					}				
					elseif ($name =='k2category_params')
					{
						$k2_sub_category['params'] = $csv_data[$csv_row_num][$column_num];

					}
					elseif ($name =='k2category_image')
					{
						$k2_sub_category['image'] = $csv_data[$csv_row_num][$column_num];
					
					}					
					elseif ($name =='k2category_language')
					{
						if (trim($csv_data[$csv_row_num][$column_num]) == "") {
							$k2_sub_category['language'] = "*";
						} else {
							$k2_sub_category['language'] = $csv_data[$csv_row_num][$column_num];
						}
						
					}											
					elseif ($name=='gallery')
					{
							
						if (strlen(trim($csv_data[$csv_row_num][$column_num]))>0)
						{
							$gallery=JFolder::makeSafe(trim($csv_data[$csv_row_num][$column_num]));
							$field_array['gallery']='{gallery}'.  $gallery . '{/gallery}';

						}
							
					}
					elseif ($name=='gallery_images')
					{
						if (strlen(trim($csv_data[$csv_row_num][$column_num]))>0)
						{
							$gallery_images=explode(',',$csv_data[$csv_row_num][$column_num]);
						}
						//$value=JFolder::makeSafe($value);
						//create gallery folder if it not exist
						//JFolder::create(JPATH_SITE.DS.'media'.DS.'k2'.DS.'galleries' . DS . $value);
					}
					elseif ($name=='comments')
					{
						if (strlen(trim($csv_data[$csv_row_num][$column_num]))>0)
						{
							$comments=json_decode($csv_data[$csv_row_num][$column_num]);



						}
						else
						{
							$comments='';
						}


					}
					elseif ($name=='publish_up')
					{
						if (strlen(trim($csv_data[$csv_row_num][$column_num]))<=0)
						{
							$field_array[$name]=date('Y-m-d H:i:s');
						}
						else
						{
							$field_array[$name]= $csv_data[$csv_row_num][$column_num];
						}
					}
					elseif ($name == 'item_plugins')
					{
						$field_array['plugins']= $csv_data[$csv_row_num][$column_num];					
					}
					elseif ($name == 'item_params')
					{
						$field_array['params']= $csv_data[$csv_row_num][$column_num];
					}					
					elseif ($name === 'after_save_php_eval')
					{
						$after_save_php_eval= $csv_data[$csv_row_num][$column_num];
					}
					else
					{
						$field_array[$name]= $csv_data[$csv_row_num][$column_num];

					}
				}
			}

			//we need a new category when there is no given $k2_sub_category['id']
			//and no main-category is defined or the main-category should be the parent category
			//and the category from the CSV should be a sub-category but it does not exist
			if ((!isset($k2_sub_category['id']) || $k2_sub_category['id'] == null) &&
			(!is_numeric($k2category) || $k2_sub_category['parent_id']==$k2category))
			{
				//create a new category
				if (!isset($k2_sub_category['access']) || !is_int($k2_sub_category['access']))
				{
					$k2_sub_category['access']=0;
				}
					
				if (!isset($k2_sub_category['parent_id']) || !is_int($k2_sub_category['parent_id']))
				{
					$k2_sub_category['parent_id'] =0;
				}
				if (!isset($k2_sub_category['name']))
				{
					$k2_sub_category['name'] = "imported data ". date('Y-m-d H:i:s');
				}
					
				if (!isset($k2_sub_category['description']))
				{
					$k2_sub_category['description'] = "";
				}
				if (!isset($k2_sub_category['image']))
				{
					$k2_sub_category['image'] = "";
				}
				
				if (!isset($k2extrafieldgroup) || !is_int($k2extrafieldgroup))
					$k2extrafieldgroup='';

				if (!isset($k2_sub_category['params']) || trim($k2_sub_category['params']) == "")
					$k2_sub_category['params'] = '{"inheritFrom":"0","theme":"","num_leading_items":"2","num_leading_columns":"1","leadingImgSize":"Large","num_primary_items":"4","num_primary_columns":"2","primaryImgSize":"Medium","num_secondary_items":"4","num_secondary_columns":"1","secondaryImgSize":"Small","num_links":"4","num_links_columns":"1","linksImgSize":"XSmall","catCatalogMode":"0","catFeaturedItems":"1","catOrdering":"","catPagination":"2","catPaginationResults":"1","catTitle":"1","catTitleItemCounter":"1","catDescription":"1","catImage":"1","catFeedLink":"1","catFeedIcon":"1","subCategories":"1","subCatColumns":"2","subCatOrdering":"","subCatTitle":"1","subCatTitleItemCounter":"1","subCatDescription":"1","subCatImage":"1","itemImageXS":"","itemImageS":"","itemImageM":"","itemImageL":"","itemImageXL":"","catItemTitle":"1","catItemTitleLinked":"1","catItemFeaturedNotice":"0","catItemAuthor":"1","catItemDateCreated":"1","catItemRating":"0","catItemImage":"1","catItemIntroText":"1","catItemIntroTextWordLimit":"","catItemExtraFields":"0","catItemHits":"0","catItemCategory":"1","catItemTags":"1","catItemAttachments":"0","catItemAttachmentsCounter":"0","catItemVideo":"0","catItemVideoWidth":"","catItemVideoHeight":"","catItemAudioWidth":"","catItemAudioHeight":"","catItemVideoAutoPlay":"0","catItemImageGallery":"0","catItemDateModified":"0","catItemReadMore":"1","catItemCommentsAnchor":"1","catItemK2Plugins":"1","itemDateCreated":"1","itemTitle":"1","itemFeaturedNotice":"1","itemAuthor":"1","itemFontResizer":"1","itemPrintButton":"1","itemEmailButton":"1","itemSocialButton":"1","itemVideoAnchor":"1","itemImageGalleryAnchor":"1","itemCommentsAnchor":"1","itemRating":"1","itemImage":"1","itemImgSize":"Large","itemImageMainCaption":"1","itemImageMainCredits":"1","itemIntroText":"1","itemFullText":"1","itemExtraFields":"1","itemDateModified":"1","itemHits":"1","itemCategory":"1","itemTags":"1","itemAttachments":"1","itemAttachmentsCounter":"1","itemVideo":"1","itemVideoWidth":"","itemVideoHeight":"","itemAudioWidth":"","itemAudioHeight":"","itemVideoAutoPlay":"0","itemVideoCaption":"1","itemVideoCredits":"1","itemImageGallery":"1","itemNavigation":"1","itemComments":"1","itemTwitterButton":"1","itemFacebookButton":"1","itemGooglePlusOneButton":"1","itemAuthorBlock":"1","itemAuthorImage":"1","itemAuthorDescription":"1","itemAuthorURL":"1","itemAuthorEmail":"0","itemAuthorLatest":"1","itemAuthorLatestLimit":"5","itemRelated":"1","itemRelatedLimit":"5","itemRelatedTitle":"1","itemRelatedCategory":"0","itemRelatedImageSize":"0","itemRelatedIntrotext":"0","itemRelatedFulltext":"0","itemRelatedAuthor":"0","itemRelatedMedia":"0","itemRelatedImageGallery":"0","itemK2Plugins":"1","catMetaDesc":"","catMetaKey":"","catMetaRobots":"","catMetaAuthor":""}';
				
				if (!isset($k2_sub_category['trash']) || !is_int($k2_sub_category['trash']) == "")
					$k2_sub_category['trash'] = 0;
				
				 $createK2categoryReturn=$model->createK2category(	$k2_sub_category['name'],
																	$k2_sub_category['parent_id'],
																	$k2_sub_category['access'],
																	$k2_sub_category['description'],
																	$k2extrafieldgroup,
																	$k2_sub_category['plugins'],
																	$k2_sub_category['trash'],
																	$k2_sub_category['params'],
																	$k2_sub_category['image'],
																	$k2_sub_category['language']);
				 
				 $k2_sub_category['id']=$createK2categoryReturn['id'];
				 #TODO display error if an error happened
				 if ($createK2categoryReturn['error']!="") {
				 	$error_message[]='row: '. $absolute_row_num  . ' - save category image - ' .$createK2categoryReturn['error'];
				 }
			}

			$extrafield_values=array();
			$extrafield_search_values='';
		
			foreach ($k2fields as $k2field)
			{

				if ($k2field['extra']=='extra')
				{
					$k2field['value']=json_decode($k2field['value']);

					$column_num=$k2importextrafields[$k2field['id']];
					if (is_numeric($column_num))
					{
						switch($k2field['type'])
						{
							case 'link':
								$csv_data[$csv_row_num][$column_num]=explode(';', $csv_data[$csv_row_num][$column_num]);
								for ($link_i=0;$link_i<count($csv_data[$csv_row_num][$column_num]); $link_i++)
								{
									$csv_data[$csv_row_num][$column_num][$link_i]=trim($csv_data[$csv_row_num][$column_num][$link_i]);
								}
								if ($csv_data[$csv_row_num][$column_num][0]=='')
								{
									$csv_data[$csv_row_num][$column_num][0]=$k2field['value'][0]->name;
									$error_message[]='row: '. $absolute_row_num  . ' no Link-Text found for ' .  $k2field['title']  . ". I will take ".$k2field['value'][0]->name." as Link-Text";
								}
								if ($csv_data[$csv_row_num][$column_num][1]=='')
								{
									$csv_data[$csv_row_num][$column_num][1]='http://www.individual-it.net';
									$error_message[]='row: '. $absolute_row_num  .' no Link-URL found for ' .  $k2field['title']  . ". I will link to the best URL in the net: http://www.individual-it.net :-)";
								}
								if ($csv_data[$csv_row_num][$column_num][2]=='' ||
								($csv_data[$csv_row_num][$column_num][2]!='same' &&
								$csv_data[$csv_row_num][$column_num][2]!='new' &&
								$csv_data[$csv_row_num][$column_num][2]!='popup' &&
								$csv_data[$csv_row_num][$column_num][2]!='lightbox'))
								{
									$csv_data[$csv_row_num][$column_num][2]=$k2field['value'][0]->target;
									$error_message[]='row: '. $absolute_row_num  .' no or not valid Link-Target found for ' .  $k2field['title']  . ". I will take ".$k2field['value'][0]->target." as Link-Target. Possible values are: same,new,popup and lightbox \n";
								}
									
								array_push($extrafield_values, array('id'=>$k2field['id'], 'value'=>array($csv_data[$csv_row_num][$column_num][0],$csv_data[$csv_row_num][$column_num][1], $csv_data[$csv_row_num][$column_num][2])));
									
								break;
							case 'select':
							case 'radio':
								$select_error=true;
								//$select_values=explode("},{",$k2field['value']);
								$select_error=true;
								foreach ( $k2field['value'] as $select_k2field)
								{
									if ($select_k2field->name == trim($csv_data[$csv_row_num][$column_num]))
									{
										array_push($extrafield_values,array('id'=>$k2field['id'],'value'=>(string)$select_k2field->value) );
										$select_error=false;
									}

								}
									
									
								if ($select_error)
								$error_message[]='row: '. $absolute_row_num  . ' no association found for ' .  $k2field['title']  ;
								break;
									
							case 'multipleSelect':
								$select_error=true;
								$multipleSelect_csv_data=explode (",",$csv_data[$csv_row_num][$column_num]);
								$multipleSelect_values=array();

								//trim all values inside the array
								array_walk($multipleSelect_csv_data , create_function('&$temp', '$temp = trim($temp);'));

								foreach ( $k2field['value'] as $select_k2field)
								{

									if (in_array($select_k2field->name,$multipleSelect_csv_data))
									{
										array_push($multipleSelect_values,(string)$select_k2field->value );
										$select_error=false;
									}

								}
								if (sizeof($multipleSelect_values)>0)
								{
									array_push($extrafield_values,array('id'=>$k2field['id'],'value'=>$multipleSelect_values) );
								}
								if ($select_error)
								{
									$error_message[]='row: '. $absolute_row_num  . ' no association found for ' .  $k2field['title'] ;
								}
								break;
							default:


								if (!isset($csv_data[$csv_row_num][$column_num]) || strlen($csv_data[$csv_row_num][$column_num])<=0)
								{
									if (isset($k2field['value']['value']))
									{
										$csv_data[$csv_row_num][$column_num]=$k2field['value']['value'];
									}
									else
									{
										$csv_data[$csv_row_num][$column_num]='';
									}
								}


									
								array_push($extrafield_values,array('id'=>$k2field['id'],'value'=>$csv_data[$csv_row_num][$column_num] ));

								//print_r($extrafield_values);
								break;

						}
						$extrafield_search_values.= " " . $csv_data[$csv_row_num][$column_num];
							
					}


				}

			}

			//so what category should we use for importing?
			if (is_numeric($k2category) && (!isset($k2_sub_category['id']) || !is_numeric($k2_sub_category['id'])))
			{
				$k2_sub_category['id']=$k2category;
			}

			$return_save=$model->save($overwrite,$field_array,$k2_sub_category['id'],json_encode($extrafield_values),$extrafield_search_values,$tags,$gallery,$gallery_images,$comments,$id_from_csv,$should_we_import_the_id);

			if ($return_save['errors']!='no error')
			{

				$error_message[]='row: '. $absolute_row_num  . ' - save item - ' . $return_save['errors'];
			}



			if (isset($image_name) && trim ($image_name)!='')
			{
				if (!filter_var($image_name,FILTER_VALIDATE_URL)) {
					$image_name=$fileroot.$image_name;
				}
				$return_image=$model->saveImage($image_name);


				if ($return_image!='no error')
				{
					$error_message[]='row: '. $absolute_row_num  . ' - save image - ' .$return_image;
				}
			}




			if (isset($attachments_names[0]) && $attachments_names[0]!='')
			{
				
				$return_attachments=$model->saveAttachments($attachments_names,$attachments_titles,$attachments_title_attributes);
				if ($return_attachments!='no error')
				{
					//if ($error_message!='')
					//$error_message[]="\n";

					$error_message[]='row: '. $absolute_row_num  . ' - save attachments - ' .$return_attachments;
				}
			}


			//eval custom PHP command
			if (isset($after_save_php_eval) && $after_save_php_eval!=="") {
				try {
					$this->eval_k2importfields_php_command($after_save_php_eval,$return_save["id"]);
				} catch(Exception $e) {
					array_push($error_message, 'row: '. $absolute_row_num  . ' - After Save PHP eval() - ' . $e->getMessage());
				}
			}


		}


		//$returnURL = JURI::base().'index.php?option=com_k2import';

		//we can clean up

		if ($return->finish)
		{
			$import_tmp_dir=$mainframe->getCfg('tmp_path').DS.'k2_import';
			if( JFolder::exists($import_tmp_dir) )
			{
				JFolder::delete($import_tmp_dir);
			}


			$fDestName= $mainframe->getCfg('tmp_path') . DS . $file;

			if( JFile::exists($fDestName) )
			{
				JFile::delete($fDestName);
			}
		}

		$return->error_message=$error_message;




		$return->memory=(memory_get_peak_usage(true) / 1024 / 1024) . " MB";

		$document = &JFactory::getDocument();
		$document->setMimeEncoding('application/json');
		
		// Output the JSON data.
		$json_return=json_encode($return);
		
		if ($json_return === FALSE) {
			$json_error="";
			switch (json_last_error()) {
				case JSON_ERROR_NONE:
					$json_error= ' - No errors';
					break;
				case JSON_ERROR_DEPTH:
					$json_error= ' - Maximum stack depth exceeded';
					break;
				case JSON_ERROR_STATE_MISMATCH:
					$json_error= ' - Underflow or the modes mismatch';
					break;
				case JSON_ERROR_CTRL_CHAR:
					$json_error= ' - Unexpected control character found';
					break;
				case JSON_ERROR_SYNTAX:
					$json_error= ' - Syntax error, malformed JSON';
					break;
				case JSON_ERROR_UTF8:
					$json_error= ' - Malformed UTF-8 characters, possibly incorrectly encoded';
					break;
				default:
					$json_error= ' - Unknown error';
					break;
			}
			$return->error_message=array();
			//the messages should be the only place where that error can come from
			$return->error_message[]="ERROR: could not encode return value to json." . $json_error;
		}
		
		echo json_encode($return);
		die();


	}

	function associate()
	{

		$view = & $this->getView( 'associate', 'html' );
		$view->setModel( $this->getModel( 'k2import' ), true );
		$view->display();


	}

	function selectcategory()
	{
		$view = & $this->getView( 'selectcategory', 'html' );
		$view->setModel( $this->getModel( 'k2import' ), true );
		$view->display();
	}

	
	function download()
	{
	
		$document = &JFactory::getDocument();
		$document->setMimeEncoding( 'text/csv' );
		$exportfilename	= JRequest::getVar( 'exportfilename', '', '', 'path' );
		
		if (($exportfilename === '') || (preg_match("/^k2_export_\d{4}-\d{2}-\d{2}_\d{6}\.csv$/", $exportfilename) !== 1)) {
			throw new InvalidArgumentException ('illegal filename');
		}
		JResponse::setHeader( 'Content-Disposition', 'attachment; filename="'.$exportfilename );
		
		$exportfilename = JFactory::getConfig()->get('tmp_path') . DS . $exportfilename;
		$exportfilename = JPath::clean($exportfilename);
		

		readfile($exportfilename);
	
	
	}	
	
	/**
	 * 
	 * Uploads a file if the upload is used
	 * copy the file to the tmp directory if a local file is used
	 * unpack a packed file is used
	 * 
	 * @throws	Will throw an exception if something went wrong with the upload
	 */
	function upload()
	{

		$mainframe = JFactory::getApplication();
		jimport('joomla.filesystem.file');


		//Retrieve file details from uploaded file, sent from upload form:
		$uploaded_file = JRequest::getVar('uploaded_file', null, 'files', 'array');

		//do we use an existing file on server or an uploades file?
		if (empty($uploaded_file['name']))
		{
			$existing_file = JRequest::getVar('existing_file', null, 'post', 'string');
			
			$existing_file_name = JFile::makeSafe(Jfile::getname(Jfile::stripExt($existing_file)));
			$existing_file_extension = JFile::makeSafe(JFile::getExt($existing_file));
			$existing_file_folder_name=JFolder::makeSafe(strstr($existing_file,$existing_file_name,true));
			
			
			// $mainframe->getCfg('tmp_path') . DS . JFile::makeSafe(JFile::getName($existing_file));
			$tempfile=tempnam($mainframe->getCfg('tmp_path'), $existing_file_name);
			$fDestName=$tempfile . "." . $existing_file_extension;
			
			//we don't need the file itseld, we just need the name
			Jfile::delete($tempfile);
			
			if (!JFile::copy(JPATH_ROOT . $existing_file_folder_name . $existing_file_name . "." .$existing_file_extension,$fDestName)) {
				//TODO add to language file
				throw new Exception('The file could not be uploaded.');
			}
			

		}
		else
		{
			$fDestName= $mainframe->getCfg('tmp_path') . DS . JFile::makeSafe($uploaded_file['name']);
			$fNameTmp = $uploaded_file['tmp_name'];

			if ( !JFile::upload($fNameTmp, $fDestName))
			{
				//TODO add to language file
				throw new Exception('The file could not be uploaded. Please check the folder permissions and if a file with the same name exists.');
				
			}
		}



			$returnURL = JURI::base().'index.php?option=com_k2import&task=selectcategory&file='.JFile::getName($fDestName);




			if (strtolower(JFile::getExt($fDestName))!='csv')
			{
				//we will try to use the file as archive
				jimport('joomla.filesystem.archive');

				$import_tmp_dir=$mainframe->getCfg('tmp_path').DS.'k2_import';

				if( JArchive::extract($fDestName, $import_tmp_dir) )
				{
					$csv_files = JFolder::files($import_tmp_dir, '.csv');

					foreach ($csv_files as $csv_file)
					{
						if( ! JFile::move($csv_file, JFile::makeSafe($csv_file), $import_tmp_dir) )
						{
							//TODO add to language file
											
							throw new Exception( 'The file '. $csv_file.' could not be renamed.');
						}
					}

					//TODO add to language file
					$this->setRedirect($returnURL.'&modus=archive','The file was successful uploaded and extracted');
				}
				else
				{
					//TODO add to language file
					throw new Exception( 'The file could not be extracted.');
				}
			}
			else
			{
				//TODO add to language file
				$this->setRedirect($returnURL,'The file was successful uploaded');
			}

		
			
		
	}


	function export_ajax_wrapper()
	{
		$model =& $this->getModel();
		
		$categories_to_export = JRequest::getVar( 'cid', '', 'post', 'array' );
		$items_count = $model->get_items_count($categories_to_export);
		
		$view = & $this->getView( 'importajaxwrapper', 'html' );
		
		$_POST['task']='export';
		
		$view->display();
		
		
		$document = & JFactory::getDocument();
		$url=JURI::base().'index.php?option=com_k2import&task=export';
		
		$js="
		var response;
		var start_item_num = 0;
		var exportfilename = '';
		window.addEvent('domready', function(){
				export_ajax_wrapper();
			});
		
		function export_ajax_wrapper() {
				var request = jQuery.ajax({
					url: '".$url."',
					type: 'POST',
					data: '".http_build_query($_POST, '', '&')."&start_item_num='+start_item_num+'&exportfilename='+exportfilename,
					dataType: 'html',
					beforeSend: function( xhr ) {
							jQuery('#k2import_messages').append(\"<div class='k2import_message'>". JText::_( 'exporting items, please stand by')	."</div>\");
							}
					});
		
			request.fail(function(jqXHR, textStatus,errorThrown) {
				jQuery('#k2import_messages').append(\"<div class='k2import_message'>\" + textStatus + \" - \" + errorThrown + \"<br><br>When reporting this error check <a href=http://webmasters.stackexchange.com/questions/8525/how-to-open-the-javascript-console-in-different-browsers>Javascript Console</a> for more information<br><pre>\"	+ jqXHR.getAllResponseHeaders() + \"</pre></div>\");
				console.log(jqXHR.responseText);
				
			});
		
		
		
			
			request.done(function(msg, textStatus, jqXHR) {
		
					var error_messages='';
					
					//alert (xmlHttpObject.response.text);
			
					try {
						response = jQuery.parseJSON(msg);
						//alert(response.error_message[0]);
						response.error_message.each(function(error_message)
						{
							if (error_message!='')
							{
								//TODO add to language file
								error_messages=error_messages+'<li>' + error_message +'</li>';
							}
						});
				
					} catch (e) {
		
						response = new Object();
						response.finish=true;
		
						//TODO add to language file
						error_messages=error_messages+'<li>Unexpected ERROR. We cancel the export. If there are just Warnings and Notices try to set your Error Reporting in System->Global Configuration->Server to \'None\' or \'Simple\'.<br><br>' + msg +'</li>';
		
					}
		
					if (error_messages=='')
					{
						message=response.exported_rows+' ". JText::_( 'items were successfully exported')	."';
					}
					else
					{
						message=response.exported_rows+' ". JText::_('items were exported, but with some problems')	.":' + ' <ol>' + error_messages + '</ol>';
					}
		
					message = message + ' <div class=\"k2import_rows_left\">memory peak: ' + response.memory + '<div>';
			
					jQuery('#k2import_messages').append(\"<div class='k2import_message'>\"+message+\"</div>\");
					
					exportfilename=response.exportfilename;
					jQuery('html, body').animate({ scrollTop: jQuery(document).height()-jQuery(window).height() },100);
					
					if (response.finish==false)
					{
						start_item_num=start_item_num+response.exported_rows;
						export_ajax_wrapper();
					}
					else
					{
		
						jQuery('#k2import_messages').append(\"<div class='k2import_message'> \
								<a href='".JURI::base()."index.php?option=com_k2import&task=download&format=raw&exportfilename=\"+exportfilename+\"'>" .
								JText::_ ( 'Export finished. Click here to download data' ) . "</a></div>\");
						jQuery('html, body').animate({ scrollTop: jQuery(document).height()-jQuery(window).height() },100);
					}
					

				});
			}
		
			";
		
		$document->addStyleSheet('components/com_k2import/css/k2import.css');
		$document->addScript('components/com_k2import/js/k2import.js');
		
		
		$document->addScriptDeclaration($js);
		if(version_compare(JVERSION,'1.6.0','ge')) {
			JHtml::_('behavior.framework', true);
		}
		
	}


	function export()
	{
		
		$document = &JFactory::getDocument();
		$document->setMimeEncoding('application/json');
		
		$model =& $this->getModel();
		
		$return=new stdClass();
		$error_message=array();
		$count_exported_empty_categories=0;
		
		$categories_to_export	= JRequest::getVar( 'cid', '', 'post', 'array' );
		$start_item_num			= JRequest::getVar( 'start_item_num', '0', '', 'int' );
		$exportfilename			= JRequest::getVar( 'exportfilename', '', '', 'path' );
		try {
			$items_count = $model->get_items_count ( $categories_to_export );
			
			$all_extrafields = $model->get_all_extrafields ( $categories_to_export );
			
			if ($categories_to_export === array("")){
				$count_of_categories_to_export = count ( $model->getK2categories () );
			} else {
				$count_of_categories_to_export = count ( $categories_to_export );
			}
			
			// only try to export max 1 item per loop for every sec of max_execution_time
			$max_execution_time = ini_get ( 'max_execution_time' );
			
			if ($max_execution_time === "0") {
				$max_execution_time = $items_count;
			}
			
			$items_to_do = min(array(intval($items_count / $count_of_categories_to_export),(int)$max_execution_time));
			
			// we cannot export more than there are alltogether
			if (($items_to_do + $start_item_num) >= $items_count) {
				$items_to_do = $items_count - $start_item_num;
				
				$return->finish = true;
			} else {
				$return->finish = false;
			}
			
			$view = & $this->getView ( 'export', 'raw' );
			$view->setModel ( $this->getModel ( 'k2import' ), true );
			
			$items = Array ();
			
			$max_attachments = $model->get_max_attachments ( $categories_to_export );
			
			if ($start_item_num === 0) {
				// TODO können wir das nicht von getK2fields nehmen?
				$csv = '"ID","Title","Alias","Introtext","Fulltext","Tags","Published","Publish Up",' . '"Publish Down","Access","Trash","Created","User ID","Hits","Language","Video",' . '"Ordering","Featured","Featured ordering","Image","Image caption","Image credits",' . '"Video caption","Video credits","Gallery Name","Images for the Gallery","Meta Description",' . '"Meta Data","Meta Keywords",' . '"Item Plugins",' . '"Item Params",' . '"Category Name",' . '"Category Description",' . '"Category Access",' . '"Category Trash",' . '"Category Plugins",' . '"Category Params",' . '"Category Image",' . '"Category Language",' . '"Comments"';
				for($i = 0; $i < $max_attachments; $i ++) {
					
					$csv .= ',"Attachment' . $i . '","Attachment Title' . $i . '","Attachment Title Attribute' . $i . '"';
				}
				
				foreach ( $all_extrafields as $extra_field ) {
					
					$csv .= ',"' . $extra_field->name . '"';
				}
				
				$items = $model->export_empty_categories ( $categories_to_export );
				$count_exported_empty_categories=count($items);
			}
			
			$items = array_merge ( $items, $model->export ( $categories_to_export, $start_item_num, $items_to_do ) );
		} catch ( Exception $e ) {
			$return->finish = true;
			$error_message [] = $e->getMessage () . "<br>" . $e->getTraceAsString ();
			$return->error_message = $error_message;
			echo json_encode ( $return );
			
			die ();
		}		
		// print_r($items);
		
		foreach ( $items as $item ) {
			
			if (! isset ( $item->introtext ))
				$item->introtext = '';
			
			if (! isset ( $item->fulltext ))
				$item->fulltext = '';
			
			if (! isset ( $item->alias ))
				$item->alias = '';
			
			if (! isset ( $item->ordering ))
				$item->ordering = '';
			
			if (! isset ( $item->hits ))
				$item->hits = 0;
			
			if (! isset ( $item->featured ))
				$item->featured = '';
			
			if (! isset ( $item->featured_ordering ))
				$item->featured_ordering = '';
			
			if (! isset ( $item->gallery_images ))
				$item->gallery_images = '';
			
			if (! isset ( $item->image_caption ))
				$item->image_caption = '';
			
			if (! isset ( $item->image_credits ))
				$item->image_credits = '';
			
			if (! isset ( $item->language ) || trim ( $item->language ) == "")
				$item->language = '*';
			
			if (! isset ( $item->video ))
				$item->video = '';
			
			if (! isset ( $item->video_credits ))
				$item->video_credits = '';
			
			if (! isset ( $item->video_caption ))
				$item->video_caption = '';
			
			if (! isset ( $item->gallery ))
				$item->gallery = '';
			
			if (! isset ( $item->gallery_images ))
				$item->gallery_images = '';
			
			if (! isset ( $item->metadesc ))
				$item->metadesc = '';
			
			if (! isset ( $item->metadata ))
				$item->metadata = '';
			
			if (! isset ( $item->metakey ))
				$item->metakey = '';
			
			if (! isset ( $item->comment ))
				$item->comment = '';
			
			if (! isset ( $item->published ))
				$item->published = '';
			
			if (! isset ( $item->publish_up ))
				$item->publish_up = '';
			
			if (! isset ( $item->publish_down ))
				$item->publish_down = '';
			
			if (! isset ( $item->access ))
				$item->access = '';
			
			if (! isset ( $item->trash ))
				$item->trash = '';
			
			if (! isset ( $item->created ))
				$item->created = '';
			
			if (! isset ( $item->item_plugins ))
				$item->item_plugins = '';
			
			if (! isset ( $item->item_params ))
				$item->item_params = '';
			
			if (! isset ( $item->category_plugins ))
				$item->category_plugins = '';
			
			if (! isset ( $item->category_trash ))
				$item->category_trash = '';
			
			if (! isset ( $item->category_params ))
				$item->category_params = '';
			
			if (! isset ( $item->category_language ) || trim ( $item->category_language ) == "")
				$item->category_language = '*';
			
			if (! isset ( $item->created_by ))
				$item->created_by = '';
			
			$csv .= "\r\n\"" . $item->id . '","' . $item->title . '","' . $item->alias . '","' . $item->introtext . '","' . $item->fulltext . '","';
			
			$first_tag = true;
			if (isset ( $item->tags ) && count ( $item->tags ) > 0) {
				foreach ( $item->tags as $tag ) {
					if (! $first_tag)
						$csv .= ",";
					
					$csv .= $tag->name;
					$first_tag = false;
				}
			}
			
			$csv .= '","' . $item->published . '","' . $item->publish_up . '","' . $item->publish_down . '","' . $item->access . '","' . $item->trash . '","' . $item->created . '","' . $item->created_by . '","' . $item->hits . '","' . $item->language . '","' . $item->video . '","' . $item->ordering . '","' . $item->featured . '","' . $item->featured_ordering . '","' . $item->image . '","' . $item->image_caption . '","' . $item->image_credits . '","' . $item->video_caption . '","' . $item->video_credits . '","' . $item->gallery . '","' . $item->gallery_images . '","' . $item->metadesc . '","' . $item->metadata . '","' . $item->metakey . '","' . $item->item_plugins . '","' . $item->item_params . '","' . $item->category_name . '","' . $item->category_description . '","' . $item->category_access . '","' . $item->category_trash . '","' . $item->category_plugins . '","' . $item->category_params . '","' . $item->category_image . '","' . $item->category_language . '","' . $item->comment . '"';
			
			$count_attachment = 0;
			if (isset ( $item->attachments ) && count ( $item->attachments ) > 0) {
				
				foreach ( $item->attachments as $attachment ) {
					$csv .= ',"' . $attachment->filename . '","' . $attachment->title . '","' . $attachment->titleAttribute . '"';
					$count_attachment ++;
				}
			}
			
			for($count_attachment = $count_attachment; $count_attachment < $max_attachments; $count_attachment ++) {
				
				$csv .= ',,,';
			}
			
			// print_r($item);
			
			foreach ($all_extrafields as $extra_field ) {
				$found_extra_field = false;
				if (isset ( $item->extra_fields ) && count ( $item->extra_fields ) > 0) {
					for($i = 0; $i < count ( $item->extra_fields ); $i ++) {
						
						// if there is no set type, then there are extra-fields in the item, but the category
						// is not associated with the extra-field groub, so we don't show them
						if (isset ( $item->extra_fields [$i]->type ) && $extra_field->id == $item->extra_fields [$i]->id && $item->extra_fields [$i]->type != 'link') {
							$csv .= ',"';
							
							if (isset ( $item->extra_fields [$i]->entry ) && is_array ( $item->extra_fields [$i]->entry )) {
								$first_entry = true;
								foreach ( $item->extra_fields [$i]->entry as $entry ) {
									if (! $first_entry)
										$csv .= ",";
									
									$csv .= $entry;
									$first_entry = false;
								}
							} elseif (isset ( $item->extra_fields [$i]->entry )) {
								$csv .= $item->extra_fields [$i]->entry;
							} elseif (isset ( $item->extra_fields [$i]->value )) {
								$csv .= $item->extra_fields [$i]->value;
							}
							
							$csv .= '"';
							$found_extra_field = true;
						} elseif (isset ( $item->extra_fields [$i]->type ) && $extra_field->id == $item->extra_fields [$i]->id && $item->extra_fields [$i]->type == 'link') {
							$csv .= ',"' . $item->extra_fields [$i]->value [0] . ";" . $item->extra_fields [$i]->value [1] . ";" . $item->extra_fields [$i]->value [2] . '"';
							$found_extra_field = true;
						}
					}
				}
				
				if (! $found_extra_field) {
					$csv .= ',';
				}
			}
		}
		
		
		if ($exportfilename === '') {
			$exportfilename = JFactory::getConfig()->get('tmp_path') . DS . "k2_export_" . date('Y-m-d_His') . ".csv";
		} else {
			if (preg_match("/^k2_export_\d{4}-\d{2}-\d{2}_\d{6}\.csv$/", $exportfilename) !== 1) {
				throw new InvalidArgumentException ('illegal value for "exportfilename"');
			}
			$exportfilename = JFactory::getConfig()->get('tmp_path') . DS . $exportfilename;
		}
		$exportfilename = JPath::clean($exportfilename);
		$bytes_written = file_put_contents($exportfilename, $csv, FILE_APPEND);
		
		if ($bytes_written === false) {
			throw new Exception('could not write temp file ' . $exportfilename . " " . count ( $csv ) . " " . $bytes_written);
		} elseif (! is_int ( $bytes_written )) {
			throw new InvalidArgumentException ('$file_write_result must be false or integer');
		} elseif (strlen ( $csv ) !== $bytes_written) {
			throw new Exception('wrong amount of bytes written to ' . $exportfilename . ". Data: " . strlen ( $csv ) .
								" bytes but written " . $bytes_written . " bytes");
		}
		
		
		$return->exportfilename = basename($exportfilename);
		
		#Do not count the empty categories as exported rows
		$return->exported_rows = count($items)-$count_exported_empty_categories;
		$return->error_message=$error_message;
		

		$return->memory=(memory_get_peak_usage(true) / 1024 / 1024) . " MB";
				
		// Output the JSON data.
		echo json_encode($return);		
		
		
		die();


	}

	function filebrowser(){
		$view = & $this->getView('k2import', 'html');
		$view->setLayout('filebrowser');
		$view->filebrowser();

	}
	
	function eval_k2importfields_php_command($command,$value) {
		eval ($command);
		return $value;
	}

}
?>