<?php
/**
 * Flex 1.0 @package Helix3 Framework
 * @author Aplikko http://www.aplikko.com
 * @copyright Copyright (c) 2015 Aplikko
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');

function modChrome_sp_xhtml($module, $params, $attribs) {

	$moduleTag     = $params->get('module_tag', 'div');
	$bootstrapSize = (int) $params->get('bootstrap_size', 0);
	$moduleClass   = $bootstrapSize != 0 ? ' col-sm-' . $bootstrapSize : '';
	$headerTag     = htmlspecialchars($params->get('header_tag', 'h3'));
	$headerClass   = htmlspecialchars($params->get('header_class', 'sp-module-title'));
	
	if ($module->content) {
		echo '<' . $moduleTag . ' class="sp-module ' . htmlspecialchars($params->get('moduleclass_sfx')) . $moduleClass . '">';

			if ($module->showtitle)
			{
				echo '<' . $headerTag . ' class="' . $headerClass . '">' . $module->title . '<div class="divider"></div></' . $headerTag . '><div class="divider"></div>';
			}

			echo '<div class="sp-module-content">';
			echo $module->content;
			echo '</div>';

		echo '</' . $moduleTag . '>';
	}
}