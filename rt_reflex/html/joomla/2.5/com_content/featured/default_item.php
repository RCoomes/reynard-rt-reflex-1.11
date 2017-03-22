<?php
/**
 * @package   Template Overrides - RocketTheme
* @version   $Id$
* @author    RocketTheme http://www.rockettheme.com
* @copyright Copyright (C) 2007 - 2015 RocketTheme, LLC
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Rockettheme Gantry Template uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */

// no direct access
defined('_JEXEC') or die;

// Create a shortcut for params.
$params = &$this->item->params;
$images = json_decode($this->item->images);
$canEdit	= $this->item->params->get('access-edit');
$showIcons = ($params->get('show_print_icon') || $params->get('show_email_icon') || $canEdit);
$articleInfo = ($params->get('show_create_date') || $params->get('show_modify_date') || ($showIcons));
$articleInfoExtended = (($params->get('show_author') && !empty($this->item->author )) or ($params->get('show_hits')) or ($params->get('show_parent_category') && $this->item->parent_id != 1) || $params->get('show_category') || $params->get('show_category') || $params->get('show_publish_date'));
$publishdate = version_compare(JVERSION,'1.7.3','<') ? 'COM_CONTENT_PUBLISHED_DATE' : 'COM_CONTENT_PUBLISHED_DATE_ON';

?>

<?php if ($this->item->state == 0) : ?>
<div class="system-unpublished">
<?php endif; ?>
<div class="rt-article">
	<div class="rt-article-inner"><?php if ($articleInfo) : ?><div class="rt-article-inner-bg"><?php endif; ?>
		<?php if ($articleInfo) : ?>
		<div class="rt-article-left-col">
			<?php if ($params->get('show_create_date')) : ?>
			<span class="rt-date-posted">
				<span class="date-item"><?php echo JHtml::_('date',$this->item->created, JText::_('d')); ?><br /></span>
				<span class="month-item"><?php echo JHtml::_('date',$this->item->created, JText::_('M')); ?></span>
				<span class="year-item"><?php echo JHtml::_('date',$this->item->created, JText::_('y')); ?></span>
			</span>
			<?php /** End Created Date **/ endif; ?>
			<?php if ($params->get('show_modify_date')) : ?>
				<span class="rt-date-modified">
						<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date',$this->item->modified, JText::_('DATE_FORMAT_LC3'))); ?>
				</span>
			<?php endif; ?>
			<?php /** Begin Article Icons **/ if ($showIcons) : ?>
			<div class="rt-article-<?php echo ($params->get('show_icons')) ? 'icons' : 'no-icon'; ?>">
				<ul class="actions">
					<?php if ($params->get('show_print_icon')) : ?>
					<li class="print-icon">
						<?php echo JHtml::_('icon.print_popup', $this->item, $params); ?>
					</li>
					<?php endif; ?>
					<?php if ($params->get('show_email_icon')) : ?>
					<li class="email-icon">
						<?php echo JHtml::_('icon.email', $this->item, $params); ?>
					</li>
					<?php endif; ?>
			
					<?php if ($canEdit) : ?>
					<li class="edit-icon">
						<?php echo JHtml::_('icon.edit', $this->item, $params); ?>
					</li>
					<?php endif; ?>
				</ul>
			</div>
			<?php /** End Article Icons **/ endif; ?>
			</div>
			<?php endif; ?>
			<div class="rt-article-right-col">
			<?php /** Begin Article Title **/ if ($params->get('show_title')) : ?>
			<div class="module-title">
				<h1 class="title">
					<?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
						<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>">
						<?php echo $this->escape($this->item->title); ?></a>
					<?php else : ?>
						<?php echo $this->escape($this->item->title); ?>
					<?php endif; ?>
				</h1>
			</div>
			<?php /** End Article Title **/ endif; ?>
			<?php if ($articleInfoExtended) : ?>
			<div class="rt-articleinfo">
				<div class="rt-articleinfo-text"><div class="rt-articleinfo-text2">
					<?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
					<span class="rt-author"> 
						<?php $author =  $this->item->author; ?>
						<?php $author = ($this->item->created_by_alias ? $this->item->created_by_alias : $author);?>
				
						<?php if (!empty($this->item->contactid ) &&  $params->get('link_author') == true):?>
							<?php echo JHtml::_('link',JRoute::_('index.php?option=com_contact&view=contact&id='.$this->item->contactid),$author); ?>
				
						<?php else :?>
							<?php echo $author; ?>
						<?php endif; ?>
					</span>
					<?php endif; ?>
					<?php if ($params->get('show_publish_date')) : ?>
					<span class="rt-date-published">
						<?php echo JText::sprintf($publishdate, JHtml::_('date',$this->item->publish_up, JText::_('DATE_FORMAT_LC3'))); ?>
					</span>
					<?php endif; ?>
					<?php if ($params->get('show_hits')) : ?>
					<span class="rt-hits">
						<?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?>
					</span>
					<?php endif; ?>
					<?php if ($params->get('show_parent_category') && $this->item->parent_id != 1) : ?>
	<span class="rt-parent-category">
		<?php $title = $this->escape($this->item->parent_title);
			$url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)) . '">' . $title . '</a>'; ?>
		<?php if ($params->get('link_parent_category') AND $this->item->parent_slug) : ?>
			<?php echo $url; ?>
			<?php else : ?>
			<?php echo $title; ?>
		<?php endif; ?>
		<?php if ($params->get('show_category')) : ?>
			<?php echo ' - '; ?>
		<?php endif; ?>
	</span>
	<?php endif; ?>
	<?php if ($params->get('show_category')) : ?>
	<span class="rt-category">
		<?php $title = $this->escape($this->item->category_title);
			$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)).'">'.$title.'</a>';?>
		<?php if ($params->get('link_category') AND $this->item->catslug) : ?>
			<?php echo $url; ?>
			<?php else : ?>
			<?php echo $title; ?>
		<?php endif; ?>
	</span>
	<?php endif; ?>
				</div></div>
			</div>
			<?php endif; ?>

	<?php if (!$params->get('show_intro')) : ?>
		<?php echo $this->item->event->afterDisplayTitle; ?>
	<?php endif; ?>

	<?php echo $this->item->event->beforeDisplayContent; ?>

<?php  if (isset($images->image_intro) and !empty($images->image_intro)) : ?>
	<?php $imgfloat = (empty($images->float_intro)) ? $params->get('float_intro') : $images->float_intro; ?>

	<div class="img-intro-<?php echo htmlspecialchars($imgfloat); ?>">
	<img
		<?php if ($images->image_intro_caption):
			echo 'class="caption"'.' title="' .htmlspecialchars($images->image_intro_caption) .'"';
		endif; ?>
		src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>"/>
	</div>
<?php endif; ?>

	<?php echo $this->item->introtext; ?>

	<?php if ($params->get('show_readmore') && $this->item->readmore) :
		if ($params->get('access-view')) :
			$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
		else :
			$menu = JFactory::getApplication()->getMenu();
			$active = $menu->getActive();
			$itemId = $active->id;
			$link1 = JRoute::_('index.php?option=com_users&view=login&&Itemid=' . $itemId);
			$returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
			$link = new JURI($link1);
			$link->setVar('return', base64_encode($returnURL));
		endif;
	?>
		<p class="rt-readon-surround">
			<a href="<?php echo $link; ?>" class="readon"><span>
				<?php if (!$params->get('access-view')) :
					echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
				elseif ($readmore = $this->item->alternative_readmore) :
					echo $readmore;
						if ($params->get('show_readmore_title', 0) != 0) :
					echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
						endif;
				elseif ($params->get('show_readmore_title', 0) == 0) :
					echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');	
				else :
					echo JText::_('COM_CONTENT_READ_MORE');
					echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
				endif; ?>
			</span></a>
		</p>
	<?php endif; ?>	
</div>
<?php if ($this->item->state == 0) : ?>
</div>
<?php endif; ?>

<div class="item-separator"></div>
	</div><?php if ($articleInfo) : ?></div><?php endif; ?>
	</div>
<?php echo $this->item->event->afterDisplayContent; ?>