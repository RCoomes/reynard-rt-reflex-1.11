<?php
/**
 * @package		Joomla.Site
 * @subpackage  Templates.beez3
 *
* @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
* @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app = JFactory::getApplication();
$templateparams = $app->getTemplate(true)->params;
$images = json_decode($this->item->images);
$urls = json_decode($this->item->urls);
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

// Create shortcut to parameters.
$params		= $this->item->params;
$canEdit	= $this->item->params->get('access-edit');
$showIcons = ($params->get('show_print_icon') || $params->get('show_email_icon') || $canEdit);
$articleInfo = ($params->get('show_create_date') || $params->get('show_modify_date') || ($showIcons));
$articleInfoExtended = (($params->get('show_author') && !empty($this->item->author )) or ($params->get('show_hits')) or ($params->get('show_parent_category') && $this->item->parent_id != 1) || $params->get('show_category') || $params->get('show_category') || $params->get('show_publish_date'));
$user		= JFactory::getUser();

?>

<div class="article-wrapper">
	<div class="rt-article">
		<div class="rt-article-inner">
		<?php if ($articleInfo) : ?><div class="rt-article-inner-bg"><?php endif; ?>
		<?php if ($articleInfo) : ?>
		<div class="rt-article-left-col">
			<?php if ($params->get('show_create_date')) : ?>
				<div class="rt-date-posted">
					<span class="date-item"><?php echo JHtml::_('date',$this->item->created, JText::_('d')); ?><br /></span>
					<span class="month-item"><?php echo JHtml::_('date',$this->item->created, JText::_('M')); ?></span>
					<span class="year-item"><?php echo JHtml::_('date',$this->item->created, JText::_('y')); ?></span>
				</div>
			<?php endif; ?>
			<?php if ($params->get('show_modify_date')) : ?>
				<div class="rt-date-modified">
					<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC3'))); ?>
				</div>
			<?php endif; ?>

			<?php /** Begin Article Icons **/ if ($showIcons) : ?>
			<div class="rt-article-<?php echo ($params->get('show_icons')) ? 'icons' : 'no-icon'; ?>">
				<ul class="actions">
				<?php if (!$this->print) : ?>
					<?php if ($params->get('show_print_icon')) : ?>
						<li class="print-icon">
						<?php echo JHtml::_('icon.print_popup',  $this->item, $params); ?>
						</li>
					<?php endif; ?>

					<?php if ($params->get('show_email_icon')) : ?>
						<li class="email-icon">
						<?php echo JHtml::_('icon.email',  $this->item, $params); ?>
						</li>
					<?php endif; ?>
					<?php if ($canEdit) : ?>
					<li class="edit-icon">
						<?php echo JHtml::_('icon.edit', $this->item, $params); ?>
					</li>
					<?php endif; ?>
				<?php else : ?>
					<li>
						<?php echo JHtml::_('icon.print_screen',  $this->item, $params); ?>
					</li>
					<?php endif; ?>
				</ul>
			</div>
			<?php /** End Article Icons **/ endif; ?>
		</div>
		<?php endif; ?>


		<div class="rt-article-right-col">	
			<article class="item-page<?php echo $this->pageclass_sfx?>">
			<?php if ($this->params->get('show_page_heading')) : ?>

				<?php if ($this->params->get('show_page_heading') and $params->get('show_title')) :?>
				<hgroup>
				<?php endif; ?>
					<h1 class="rt-pagetitle">
					<?php echo $this->escape($this->params->get('page_heading')); ?>
					</h1>
			<?php endif; ?>

			<?php if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && $this->item->paginationrelative)
				{
				 echo $this->item->pagination;
				}

				if ($params->get('show_title')) : ?>
				<div class="module-title">
					<h2 class="title">
						<?php if ($params->get('link_titles') && !empty($this->item->readmore_link)) : ?>
							<a href="<?php echo $this->item->readmore_link; ?>"> <?php echo $this->escape($this->item->title); ?></a>
						<?php else : ?>
							<?php echo $this->escape($this->item->title); ?>
						<?php endif; ?>
					</h2>
				</div>
				<?php endif; ?>
				<?php if ($this->params->get('show_page_heading') and $params->get('show_title')) :?>
				</hgroup>
				<?php endif; ?>

			<?php if ($articleInfoExtended) : ?>
				<dl class="rt-articleinfo">
					<div class="rt-articleinfo-text"><div class="rt-articleinfo-text2">
						<?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
				<dd class="rt-author">
					<?php $author = $this->item->author; ?>
					<?php $author = ($this->item->created_by_alias ? $this->item->created_by_alias : $author);?>

				<?php if (!empty($this->item->contactid) && $params->get('link_author') == true): ?>
							<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY',
								JHtml::_('link', JRoute::_('index.php?option=com_contact&view=contact&id=' . $this->item->contactid), $author)
							); ?>

				<?php else: ?>
					<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
				<?php endif; ?>
				</dd>
			<?php endif; ?>
			<?php if ($params->get('show_publish_date')) : ?>
				<dd class="rt-date-published">
				<?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', JHtml::_('date', $this->item->publish_up, JText::_('DATE_FORMAT_LC3'))); ?>
				</dd>
			<?php endif; ?>
			<?php if ($params->get('show_hits')) : ?>
				<dd class="rt-hits">
				<?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?>
				</dd>
			<?php endif; ?>
			<?php if ($params->get('show_parent_category') && $this->item->parent_slug != '1:root') : ?>
				<span class="rt-parent-category">
				<?php	$title = $this->escape($this->item->parent_title);
				$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)).'">'.$title.'</a>';?>
				<?php if ($params->get('link_parent_category') and $this->item->parent_slug) : ?>
					<?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
				<?php else : ?>
					<?php echo JText::sprintf('COM_CONTENT_PARENT', $title); ?>
				<?php endif; ?>
				</span>
			<?php endif; ?>
			<?php if ($params->get('show_category')) : ?>
				<span class="rt-category">
				<?php 	$title = $this->escape($this->item->category_title);
				$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)).'">'.$title.'</a>';?>
				<?php if ($params->get('link_category') and $this->item->catslug) : ?>
					<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
				<?php else : ?>
					<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $title); ?>
				<?php endif; ?>
				</span>
			<?php endif; ?>
				</div></div>
				</dl>
			<?php endif; ?>

			<?php echo $this->item->event->beforeDisplayContent; ?>

			<?php  if (!$params->get('show_intro')) :
				echo $this->item->event->afterDisplayTitle;
			endif; ?>

			<?php if (isset ($this->item->toc)) : ?>
				<?php echo $this->item->toc; ?>
			<?php endif; ?>

			<?php if (isset($urls) AND ((!empty($urls->urls_position) AND ($urls->urls_position=='0')) OR  ($params->get('urls_position')=='0' AND empty($urls->urls_position) ))
					OR (empty($urls->urls_position) AND (!$params->get('urls_position')))): ?>

			<?php echo $this->loadTemplate('links'); ?>
			<?php endif; ?>
			<?php  if (isset($images->image_fulltext) and !empty($images->image_fulltext)) : ?>
			<?php $imgfloat = (empty($images->float_fulltext)) ? $params->get('float_fulltext') : $images->float_fulltext; ?>

				<div class="img-fulltext-<?php echo htmlspecialchars($imgfloat); ?>">
			<img
				<?php if ($images->image_fulltext_caption):
					echo 'class="caption"'.' title="' .htmlspecialchars($images->image_fulltext_caption) .'"';
				endif; ?>
				src="<?php echo htmlspecialchars($images->image_fulltext); ?>" alt="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>"/>
			</div>
			<?php endif; ?>
			<?php
			if (!empty($this->item->pagination) AND $this->item->pagination AND !$this->item->paginationposition AND !$this->item->paginationrelative):
				echo $this->item->pagination;
			 endif;
			?>
			<?php echo $this->item->text; ?>
			<?php // TAGS ?>
			<?php if ($params->get('show_tags', 1) && isset($this->item->tags) && !empty($this->item->tags)) : ?>
				<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
				<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
			<?php endif; ?>
			<?php
			if (!empty($this->item->pagination) AND $this->item->pagination AND $this->item->paginationposition AND!$this->item->paginationrelative):
				 echo $this->item->pagination;?>
			<?php endif; ?>

			<?php if (isset($urls) AND ((!empty($urls->urls_position)  AND ($urls->urls_position=='1')) OR ( $params->get('urls_position')=='1') )): ?>

			<?php echo $this->loadTemplate('links'); ?>
			<?php endif; ?>

			<?php echo $this->item->event->afterDisplayContent; ?>

			<?php
			if (!empty($this->item->pagination) AND $this->item->pagination AND $this->item->paginationposition AND $this->item->paginationrelative):
				 echo $this->item->pagination;?>
			<?php endif; ?>

			</article>
		</div>

		<?php if ($articleInfo) : ?></div><?php endif; ?>
	 	</div>
	</div>
</div>