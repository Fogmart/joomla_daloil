<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

require_once JPATH_SITE . '/components/com_users/helpers/route.php';

JHtml::_('behavior.keepalive');
JHtml::_('bootstrap.tooltip');

$usersConfig = JComponentHelper::getParams('com_users');

?>
<form action="<?php echo JRoute::_(htmlspecialchars(JUri::getInstance()->toString()), true, $params->get('usesecure')); ?>" method="post" id="login-form">
	<?php if ($params->get('pretext')) : ?>
		<div class="form-group pretext">
			<p><?php echo $params->get('pretext'); ?></p>
		</div>
	<?php endif; ?>
	
	<div id="form-login-username" class="form-group">
		<?php if (!$params->get('usetext')) : ?>
			<div class="input-group">
				<span class="input-group-addon hasTooltip" title="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>">
					<i style="color:#888;text-shadow:1px 1px 0px #fff;width:16px;" class="fa fa-user"></i>
				</span>
				<input id="modlgn-username" type="text" name="username" class="form-control" tabindex="0" size="18" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>" />
			</div>
		<?php else: ?>
			<input id="modlgn-username" type="text" name="username" class="form-control" tabindex="0" size="18" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>" />
		<?php endif; ?>
	</div>
	<div id="form-login-password" class="form-group">
		<div class="controls">
			<?php if (!$params->get('usetext')) : ?>
				<div class="input-group">
					<span class="input-group-addon hasTooltip" title="<?php echo JText::_('JGLOBAL_PASSWORD') ?>">
						<i style="color:#888;text-shadow:1px 1px 0px #fff;width:16px;" class="fa fa-lock"></i>
					</span>
					<input id="modlgn-passwd" type="password" name="password" class="form-control" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" />
				</div>
			<?php else: ?>
				<input id="modlgn-passwd" type="password" name="password" class="form-control" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" />
			<?php endif; ?>
		</div>
	</div>
	<?php if (count($twofactormethods) > 1): ?>
	<div id="form-login-secretkey" class="form-group">
		<?php if (!$params->get('usetext')) : ?>
			<div class="input-group">
				<span class="input-group-addon hasTooltip" title="<?php echo JText::_('JGLOBAL_SECRETKEY_HELP'); ?>">
					<i class="fa fa-key"></i>
				</span>
				<input id="modlgn-secretkey" autocomplete="off" type="text" name="secretkey" class="form-control" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY') ?>" />
			</div>
		<?php else: ?>
			<div class="input-group">
				<input id="modlgn-secretkey" autocomplete="off" type="text" name="secretkey" class="form-control" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY') ?>" />
			</div>
		<?php endif; ?>
	</div>
	<?php endif; ?>

	<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
	<div id="form-login-remember" class="form-group">
		<div class="checkbox">
			<label for="modlgn-remember"><input id="modlgn-remember" type="checkbox" name="remember" class="inputbox" value="yes"><?php echo JText::_('MOD_LOGIN_REMEMBER_ME') ?></label>
		</div>
	</div>
	<?php endif; ?>

	<div id="form-login-submit" class="form-group">
		<button type="submit" tabindex="0" name="Submit" class="btn btn-success"><?php echo JText::_('JLOGIN') ?></button>
		<?php if ($usersConfig->get('allowUserRegistration')) : ?>
			<a style="margin:10px 0;" class="btn sppb-btn-default" href="<?php echo JRoute::_('index.php?option=com_users&view=registration&Itemid=' . UsersHelperRoute::getRegistrationRoute()); ?>"><i style="margin-left:-5px;margin-right:9px;opacity:0.6;" class="fa fa-user-plus"></i><?php echo JText::_('MOD_LOGIN_REGISTER'); ?></a>
		<?php endif; ?>
	</div>

	<ul class="form-links">
		<li>
			<a style="padding-left:5px;font-size:90%;" href="<?php echo JRoute::_('index.php?option=com_users&view=remind&Itemid=' . UsersHelperRoute::getRemindRoute()); ?>">
			<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?></a>
		</li>
		<li>
			<a style="padding-left:5px;font-size:90%;" href="<?php echo JRoute::_('index.php?option=com_users&view=reset&Itemid=' . UsersHelperRoute::getResetRoute()); ?>">
			<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></a>
		</li>
	</ul>
	
	<input type="hidden" name="option" value="com_users" />
	<input type="hidden" name="task" value="user.login" />
	<input type="hidden" name="return" value="<?php echo $return; ?>" />
	<?php echo JHtml::_('form.token'); ?>

	<?php if ($params->get('posttext')) : ?>
		<div class="posttext form-group">
			<p><?php echo $params->get('posttext'); ?></p>
		</div>
	<?php endif; ?>
</form>
