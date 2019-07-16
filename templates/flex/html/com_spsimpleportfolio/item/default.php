<?php
/**
 * @package     SP Simple Portfolio
 * @copyright   Copyright (C) 2010 - 2014 JoomShaper. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 */

defined('_JEXEC') or die();

require_once JPATH_COMPONENT . '/helpers/helper.php';
jimport( 'joomla.filesystem.file' );
SpsimpleportfolioHelper::generateMeta($this->item);

$doc = JFactory::getDocument();
$doc->addStylesheet( JURI::root(true) . '/templates/flex/html/com_spsimpleportfolio/assets/css/spsimpleportfolio.css' );

$menu = JFactory::getApplication()->getMenu();
$category = '';
if(is_object($menu->getActive())) {
	$active = $menu->getActive();
	$category = JRoute::_('index.php?option=com_spsimpleportfolio&Itemid=' . $active->id);
}


$tags = SpsimpleportfolioHelper::getTags( (array) $this->item->spsimpleportfolio_tag_id );
$newtags = array();
foreach ($tags as $tag) {
	$newtags[] 	 = $tag->title;
}

//video
if($this->item->video) {
	$video = parse_url($this->item->video);

	switch($video['host']) {
		case 'youtu.be':
		$video_id 	= trim($video['path'],'/');
		$video_src 	= '//www.youtube.com/embed/' . $video_id;
		break;

		case 'www.youtube.com':
		case 'youtube.com':
		parse_str($video['query'], $query);
		$video_id 	= $query['v'];
		$video_src 	= '//www.youtube.com/embed/' . $video_id;
		break;

		case 'vimeo.com':
		case 'www.vimeo.com':
		$video_id 	= trim($video['path'],'/');
		$video_src 	= "//player.vimeo.com/video/" . $video_id;
	}

}

?>
<div id="sp-simpleportfolio" class="sp-simpleportfolio sp-simpleportfolio-view-item">
	<div class="sp-simpleportfolio-image">
		<?php if($this->item->video) { ?>
		<div class="sp-simpleportfolio-embed">
			<iframe src="<?php echo $video_src; ?>" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
		</div>
		<?php } else { ?>
		<?php if($this->item->image) { ?>
		<img class="sp-simpleportfolio-img" src="<?php echo $this->item->image; ?>" alt="<?php echo $this->item->title; ?>">
		<?php } else { ?>
		<img class="sp-simpleportfolio-img" src="<?php echo $this->item->thumbnail; ?>" alt="<?php echo $this->item->title; ?>">
		<?php } ?>
		<?php } ?>
	</div>

	<div class="sp-simpleportfolio-details clearfix">

		<div class="sp-simpleportfolio-description entry-header">
			<h2><?php echo $this->item->title; ?>
            <div class="divider"></div></h2>
			<?php echo $this->item->description; ?>
            <hr /><a class="btn sppb-btn-default btn-sm" href="<?php echo $category; ?>"><i style="margin-left:-7px;margin-right:7px;" class="pe pe-7s-back"></i><?php echo JText::_('COM_SPPORTFOLIO_BACK_TO_CATEGORY'); ?></a>
		</div>
        
		
        <div class="sp-simpleportfolio-meta">
			<?php if(isset($this->item->client) && $this->item->client){ ?>
                <div class="sp-simpleportfolio-client sp-module">
                    <h3 class="sp-module-title"><?php echo JText::_('COM_SPSIMPLEPORTFOLIO_PROJECT_CLIENT'); ?><div class="divider"></div></h3><div class="divider"></div>
                    <div class="sp-module-content"><?php echo $this->item->client; ?></div>
                </div>
            <?php } //has project client ?>
            <div class="sp-simpleportfolio-created sp-module">
                <h3 class="sp-module-title"><i class="fa fa-calendar-o"></i> <?php echo JText::_('COM_SPSIMPLEPORTFOLIO_PROJECT_DATE'); ?><div class="divider"></div></h3><div class="divider"></div>
                <div class="sp-module-content"><?php echo JHtml::_('date', $this->item->created_on, JText::_('DATE_FORMAT_LC3')); ?></div>
            </div>

            <div class="sp-simpleportfolio-tags sp-module">
                <h3 class="sp-module-title"><i style="font-size:15px;margin-right:1px;" class="fa fa-tags"></i> <?php echo JText::_('COM_SPSIMPLEPORTFOLIO_PROJECT_CATEGORIES'); ?><div class="divider"></div></h3><div class="divider"></div>
                <div class="sp-module-content"><?php echo implode(', ', $newtags); ?></div>
            </div>
 
            <?php if ($this->item->url) { ?>
            <div class="sp-simpleportfolio-link sp-module">
                <a class="btn btn-primary" target="_blank" href="<?php echo $this->item->url; ?>"><?php echo JText::_('COM_SPSIMPLEPORTFOLIO_VIEW_PROJECT'); ?></a>
            </div>
            <?php } ?>
        </div>
	</div>
</div>