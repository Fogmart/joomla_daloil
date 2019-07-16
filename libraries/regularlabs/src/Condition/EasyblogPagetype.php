<?php
/**
 * @package         Regular Labs Library
 * @version         17.9.4890
 * 
 * @author          Peter van Westen <info@regularlabs.com>
 * @link            http://www.regularlabs.com
 * @copyright       Copyright © 2017 Regular Labs All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

namespace RegularLabs\Library\Condition;

defined('_JEXEC') or die;

/**
 * Class EasyblogPagetype
 * @package RegularLabs\Library\Condition
 */
class EasyblogPagetype
	extends Easyblog
{
	public function pass()
	{
		return $this->passByPageType('com_easyblog', $this->selection, $this->include_type);
	}
}
