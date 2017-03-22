<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_login
* @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
* @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');
?>
<?php if ($type == 'logout') : ?>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form">
<?php if ($params->get('greeting')) : ?>
	<div class="login-greeting">
		<?php if ($params->get('name') == 0) : ?>
			<?php echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('name'))); ?>
		<?php else : ?>
		 	<?php echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('username'))); ?>
		<?php endif; ?>
	</div>
<?php endif; ?>
	<div class="logout-button">
		<div class="readon">
		<input type="submit" name="Submit" class="button" value="<?php echo JText::_('JLOGOUT'); ?>" />
	</div>
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.logout" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
<?php else : ?>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" name="form-login" id="form-login" >
	<?php if ($params->get('pretext')): ?>
		<div class="pretext">
		<p><?php echo $params->get('pretext'); ?></p>
		</div>
	<?php endif; ?>
	<fieldset class="userdata">
	<p id="form-login-username">
		<label for="modlgn-username"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?></label><br />
		<input id="modlgn-username" type="text" name="username" class="inputbox"  size="18" />	
	</p>
	<p id="form-login-password">
		<label for="modlgn-passwd"><?php echo JText::_('JGLOBAL_PASSWORD') ?></label><br />
		<input id="modlgn-passwd" type="password" name="password" class="inputbox" size="18"  />
	</p>
	<?php if (count($twofactormethods) > 1) : ?>
	<p id="form-login-secretkey">
			<label for="modlgn-secretkey"><?php echo JText::_('JGLOBAL_SECRETKEY') ?> <span class="icon-help hasTooltip" title="<?php echo JText::_('JGLOBAL_SECRETKEY_HELP'); ?>"></span></label><br />

			<input id="modlgn-secretkey" type="text" name="secretkey" class="inputbox" tabindex="0" size="18" placeholder="" />

	</p>
	<?php endif; ?>
	<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
	<p id="form-login-remember">
		<input id="modlgn-remember" type="checkbox" name="remember" class="inputbox" value="yes"/>
		<label for="modlgn-remember"><?php echo JText::_('MOD_LOGIN_REMEMBER_ME') ?></label>
	</p>
	<?php endif; ?>
	<div class="readon"><input type="submit" name="Submit" class="button" value="<?php echo JText::_('JLOGIN') ?>" /></div>
	<input type="hidden" name="option" value="com_users" />
	<input type="hidden" name="task" value="user.login" />
	<input type="hidden" name="return" value="<?php echo $return; ?>" />
	<?php echo JHtml::_('form.token'); ?>
	</fieldset>
	<ul>
		<li>
			<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
			<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></a>
		</li>
		<li>
			<a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
			<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?></a>
		</li>
		<?php $usersConfig = JComponentHelper::getParams('com_users'); ?>
		<?php if ($usersConfig->get('allowUserRegistration')) : ?>
		<li>
			<a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
				<?php echo JText::_('MOD_LOGIN_REGISTER'); ?></a>
		</li>
		<?php endif; ?>
	</ul>
	<?php if ($params->get('posttext')): ?>
		<div class="posttext">
		<p><?php echo $params->get('posttext'); ?></p>
		</div>
	<?php endif; ?>
</form>
<?php endif; ?>
