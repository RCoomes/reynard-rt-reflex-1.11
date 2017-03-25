<?php
/**
 * @package Gantry Template Framework - RocketTheme
* @version   $Id$
* @author RocketTheme http://www.rockettheme.com
* @copyright Copyright (C) 2007 - 2015 RocketTheme, LLC
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );
/* Load Mootools */
JHTML::_('behavior.framework', true);
/* Load jQuery */
JHtml::_('jquery.framework', true);
// load and inititialize gantry class
require_once('lib/gantry/gantry.php');
$gantry->init();

function isBrowserCapable(){
	global $gantry;
	
	$browser = $gantry->browser;
	
	// ie.
	if ($browser->name == 'ie' && $browser->version < 8) return false;
	
	return true;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $gantry->language; ?>" lang="<?php echo $gantry->language;?>" >
<head>
	<script src="//assets.adobedtm.com/c876840ac68fc41c08a580a3fb1869c51ca83380/satelliteLib-0a468d1f187baaccf238a04e406eefb408f3ba8b.js"></script>
	<?php 
		$gantry->displayHead();
		/* Force IE to most recent version */
		if ($gantry->browser->name == 'ie') : 
			echo '<meta http-equiv="X-UA-Compatible" content="IE=edge" />';
		endif;		
		$gantry->addStyles(array('template.css','joomla.css'));
       	$gantry->addLess('global.less');
			
		if ($gantry->get('loadtransition') && isBrowserCapable()){
			$gantry->addScript('load-transition.js');
			$hidden = ' class="rt-hidden"';
		} else {
			$hidden = '';
		}
		
	?>
</head>
	<body <?php echo $gantry->displayBodyTag(array('backgroundlevel')); ?>>
		<div id="rt-page-surround">
			<div class="rt-container">
				<div class="rt-container-bg">
					<?php /** Begin Drawer **/ if ($gantry->countModules('drawer')) : ?>
					<div id="rt-drawer">
						<?php echo $gantry->displayModules('drawer','standard','standard'); ?>
						<div class="clear"></div>
					</div>
					<?php /** End Drawer **/ endif; ?>
					<?php /** Begin Top **/ if ($gantry->countModules('top')) : ?>
					<div id="rt-top-surround">
						<div id="rt-top">
							<?php echo $gantry->displayModules('top','standard','standard'); ?>
							<div class="clear"></div>
						</div>
					</div>
					<?php /** End Top **/ endif; ?>
					<?php /** Begin Header **/ if ($gantry->countModules('header')) : ?>
					<div id="rt-header">
						<?php echo $gantry->displayModules('header','standard','standard'); ?>
						<div class="clear"></div>
					</div>
					<?php /** End Header **/ endif; ?>
					<?php /** Begin Navigation **/ if ($gantry->countModules('navigation')) : ?>
					<div id="rt-navigation"><div id="rt-navigation2">
						<?php echo $gantry->displayModules('navigation','standard','menu'); ?>
						<div class="clear"></div>
					</div></div>
					<?php /** End Header **/ endif; ?>
					<div id="rt-container-content"<?php echo $hidden; ?>>
						<?php /** Begin Showcase **/ if ($gantry->countModules('showcase')) : ?>
						<div id="rt-showcase">
							<?php echo $gantry->displayModules('showcase','standard','standard'); ?>
							<div class="clear"></div>
						</div>
						<?php /** End Showcase **/ endif; ?>
						<?php /** Begin Feature **/ if ($gantry->countModules('feature')) : ?>
						<div id="rt-feature">
							<?php echo $gantry->displayModules('feature','standard','standard'); ?>
							<div class="clear"></div>
						</div>
						<?php /** End Feature **/ endif; ?>
						<div id="rt-body-surround">
							<?php /** Begin Utility **/ if ($gantry->countModules('utility')) : ?>
							<div id="rt-utility">
								<?php echo $gantry->displayModules('utility','standard','standard'); ?>
								<div class="clear"></div>
							</div>
							<?php /** End Utility **/ endif; ?>
							<?php /** Begin Main Top **/ if ($gantry->countModules('maintop')) : ?>
							<div id="rt-maintop">
								<?php echo $gantry->displayModules('maintop','standard','standard'); ?>
								<div class="clear"></div>
							</div>
							<?php /** End Main Top **/ endif; ?>
							<?php /** Begin Breadcrumbs **/ if ($gantry->countModules('breadcrumb')) : ?>
							<div id="rt-breadcrumbs">
								<?php echo $gantry->displayModules('breadcrumb','basic','breadcrumbs'); ?>
								<div class="clear"></div>
							</div>
							<?php /** End Breadcrumbs **/ endif; ?>
							<?php /** Begin Main Body **/ ?>
						    <?php echo $gantry->displayMainbody('mainbody','sidebar','standard','scroller','scroller','scroller','scroller'); ?>
							<?php /** End Main Body **/ ?>
							<?php /** Begin Main Bottom **/ if ($gantry->countModules('mainbottom')) : ?>
							<div id="rt-mainbottom">
								<?php echo $gantry->displayModules('mainbottom','standard','standard'); ?>
								<div class="clear"></div>
							</div>
							<?php /** End Main Bottom **/ endif; ?>
							<?php /** Begin Bottom **/ if ($gantry->countModules('bottom')) : ?>
							<div id="rt-bottom">
								<?php echo $gantry->displayModules('bottom','standard','standard'); ?>
								<div class="clear"></div>
							</div>
							<?php /** End Bottom **/ endif; ?>
						</div>
						<?php /** Begin Footer Section **/ if ($gantry->countModules('footer') or $gantry->countModules('copyright') or $gantry->countModules('debug')) : ?>
						<div id="rt-footer-surround" <?php echo $gantry->displayClassesByTag('rt-footer-surround'); ?>>
							<?php /** Begin Footer **/ if ($gantry->countModules('footer')) : ?>
							<div id="rt-footer">
								<?php echo $gantry->displayModules('footer','standard','standard'); ?>
								<div class="clear"></div>
							</div>
							<?php /** End Footer **/ endif; ?>
							<?php /** Begin Copyright **/ if ($gantry->countModules('copyright')) : ?>
							<div id="rt-copyright">
								<?php echo $gantry->displayModules('copyright','standard','limited'); ?>
								<div class="clear"></div>
							</div>
							<?php /** End Copyright **/ endif; ?>
							<?php /** Begin Debug **/ if ($gantry->countModules('debug')) : ?>
							<div id="rt-debug">
								<?php echo $gantry->displayModules('debug','standard','standard'); ?>
								<div class="clear"></div>
							</div>
							<?php /** End Debug **/ endif; ?>
						</div>
						<?php /** End Footer Section **/ endif; ?>
					</div>
				</div>
			</div>
			<?php /** Begin Popups **/ 
			echo $gantry->displayModules('popup','popup','popup');
			echo $gantry->displayModules('login','login','popup'); 
			/** End Popup s**/ ?>
			<?php /** Begin Analytics **/ if ($gantry->countModules('analytics')) : ?>
			<?php echo $gantry->displayModules('analytics','basic','basic'); ?>
			<?php /** End Analytics **/ endif; ?>
		</div>
		<script type="text/javascript">_satellite.pageBottom();</script>
	</body>
</html>
<?php
$gantry->finalize();

?>