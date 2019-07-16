<?php
/**
 *
 * Layout for the shopper form to change the current shopper
 *
 * @package	VirtueMart
 * @subpackage Cart
 * @author Maik K�nnemann
 *
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2013 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: cart.php 2458 2013-07-16 18:23:28Z kkmediaproduction $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
?>

<h4 style="margin-top:20px;"><?php echo vmText::_ ('COM_VIRTUEMART_CART_CHANGE_SHOPPER'); ?></h4>
<div style="margin-bottom:20px;" class="clear"></div>
<form action="<?php echo JRoute::_ ('index.php'); ?>" method="post" class="inline">
	<table cellspacing="0" cellpadding="0" border="0"  style="border:0px;margin-top:-25px;">
		<tr>
			<td style="margin-top:-20px;">
				<span style="margin-right: 5px;float:left;"><input type="text" name="usersearch" size="20" maxlength="50"></span>
				<span><input type="submit" name="searchShopper" title="<?php echo vmText::_('COM_VIRTUEMART_SEARCH'); ?>" value="<?php echo vmText::_('COM_VIRTUEMART_SEARCH'); ?>" class="button" /></span>
			</td>
        	<td style="padding-top:20px;">
				<?php 
				if (!class_exists ('VirtueMartModelUser')) {
					require(VMPATH_ADMIN . DS . 'models' . DS . 'user.php');
				}

				$currentUser = $this->cart->user->virtuemart_user_id;
				echo JHtml::_('Select.genericlist', $this->userList, 'userID', 'class="vm-chzn-select" style="width: 180px; top:17px;"', 'id', 'displayedName', $currentUser,'userIDcart');
				?>
			</td>
			<td style="border:0px;padding-top:30px;">
				<span style="margin-right: 5px;"><input type="submit" name="changeShopper" title="<?php echo vmText::_('COM_VIRTUEMART_SAVE'); ?>" value="<?php echo vmText::_('COM_VIRTUEMART_SAVE'); ?>" class="button" style="margin:1px 0 0;padding:3px 15px;border-radius:3px;" /></span>
				<input type="hidden" name="view" value="cart"/>
				<input type="hidden" name="task" value="changeShopper"/>
			</td>
        </tr>
		<tr>
			
			<td class="centered" colspan="2">
				<?php if($this->adminID && $currentUser != $this->adminID) { ?>
					<hr /><b class="centered"><?php echo vmText::_('COM_VIRTUEMART_CART_ACTIVE_ADMIN') .' '.JFactory::getUser($this->adminID)->name; ?></b><hr />
				<?php } ?>
				<?php echo JHtml::_( 'form.token' ); ?>
			</td>
		</tr>
	</table>
</form>

<h5><?php echo vmText::_ ('COM_VIRTUEMART_CART_CHANGE_SHOPPERGROUP'); ?></h5>

<form action="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=cart'); ?>" method="post" class="inline">
	<table cellspacing="0" cellpadding="0" border="0" style="border:0px !important;">
		<tr style="border:0px;">
			<td style="border:0px;">
				<?php 
				if ($this->shopperGroupList) {
					echo $this->shopperGroupList;
				}
				?>
			</td>
			<td style="border:0px;">
				<input type="submit" name="changeShopperGroup" title="<?php echo vmText::_('COM_VIRTUEMART_SAVE'); ?>" value="<?php echo vmText::_('COM_VIRTUEMART_SAVE'); ?>" class="button" style="margin:-2px 10px 0 10px;padding:4px 15px;border-radius:3px;" />
				<input type="hidden" name="view" value="cart"/>
				<input type="hidden" name="task" value="changeShopperGroup"/>
				<?php echo JHtml::_( 'form.token' ); ?>
			</td>
			<?php if (JFactory::getSession()->get('tempShopperGroups', FALSE, 'vm')) { ?>
			<td style="border:0px;">
				<input type="reset" title="<?php echo vmText::_('COM_VIRTUEMART_RESET'); ?>" value="<?php echo vmText::_('COM_VIRTUEMART_RESET'); ?>" class="btn btn-dark" style="margin:-2px 0 0;padding:5px 15px;border-radius:3px;""
					onclick="window.location.href='<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=cart&task=resetShopperGroup'); ?>'"/>
			</td>
			<?php } ?>
		</tr>
	</table>
</form>

