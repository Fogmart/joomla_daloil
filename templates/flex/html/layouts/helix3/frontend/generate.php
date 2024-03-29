<?php
/**
 * @package     Helix
 *
 * @copyright   Copyright (C) 2010 - 2016 JoomShaper. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */
defined('_JEXEC') or die('Restricted Access');

//

//helper & model
$menu_class   = JPATH_ROOT . '/plugins/system/helix3/core/classes/helix3.php';

if (file_exists($menu_class)) {
    require_once($menu_class);
}

$template       = JFactory::getApplication()->getTemplate();
$themepath      = JPATH_THEMES . '/' . $template;
$rows_file      = $themepath . '/html/layouts/helix3/frontend/rows.php';
$lyt_thm_path   = $themepath . '/html/layouts/helix3/';

$layout_path  = (file_exists($rows_file)) ? $lyt_thm_path : JPATH_ROOT .'/plugins/system/helix3/layouts';

$data = $displayData;

$output ='';

$output .= '<' . $data['sematic'] . ' id="' . $data['id'] . '"' . $data['row_class'] . '>';

if ($data['componentArea']){
    if (!$data['pagebuilder']){
        if (!$data['fluidrow']){
			$output .= '<div class="container">';
		} 
		else {
			$output .= '<div class="container-fluid">';
		}
    } 
}
else{
    if (!$data['fluidrow']){
        $output .= '<div class="container">';
    } 
}


$getLayout = new JLayoutFile('frontend.rows', $layout_path );

$output .= $getLayout->render($data);


if ($data['componentArea']){
    if (!$data['pagebuilder']){
		 if (!$data['fluidrow']){
			$output .= '</div>';
		} else {
			$output .= '</div>';
		}
    }
}

else{
    if (!$data['fluidrow']){
        $output .= '</div>';
    }
}

$output .= '</' . $data['sematic'] . '>';


echo $output;

