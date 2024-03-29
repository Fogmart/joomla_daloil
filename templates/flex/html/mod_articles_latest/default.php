<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>
<div class="latest-articles<?php echo $moduleclass_sfx; ?>">
<?php foreach ($list as $item) {

	$attrbs = json_decode($item->attribs);
	$images = json_decode($item->images);
	$thumb_image = '';
	
	
	if(isset($images->image_intro) && !empty($images->image_intro)) {
		if(isset($attrbs->spfeatured_image) && !empty($attrbs->spfeatured_image)) {
			$thumb_image = $attrbs->spfeatured_image;
		} else {
			$thumb_image = $images->image_intro;
		}
	
	} elseif(isset($attrbs->spfeatured_image) && !empty($attrbs->spfeatured_image)) {

		$thumb_image = $attrbs->spfeatured_image;
			
	} 
	
?>
	<div itemscope itemtype="http://schema.org/Article">
		<a href="<?php echo $item->link; ?>" class="latest-news-title" itemprop="url">
			<?php if (!empty($thumb_image)) {?>
                <span class="img-responsive article-list-img">
                    <span class="overlay"></span>
                    <img src="<?php echo $thumb_image; ?>" alt="<?php echo $item->title; ?>">
                </span>
                <span class="latest-articles-title" itemprop="name">
					<?php echo $item->title; ?>
				</span>
            <?php } else { ?>
               <span class="date">
               <small data-toggle="tooltip"><?php echo JHtml::_('date', $item->created, JText::_('m / d')); ?></small>
               <span class="year"><?php echo JHtml::_('date', $item->created, JText::_('Y')); ?></span>
               </span>
               
				<span class="latest-articles-title" itemprop="name">
					<?php echo $item->title; ?>
				</span>
			<?php } ?>
		</a>
        <div class="clearfix"></div>
	</div>
<?php } ?>
</div><div class="clearfix"></div>
