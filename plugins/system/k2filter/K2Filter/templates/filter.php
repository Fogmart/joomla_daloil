<?php
/**
 * @version		$Id: generic.php 1492 2012-02-22 17:40:09Z joomlaworks@gmail.com $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2012 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

?>

<script type="text/javascript">
	if (typeof jQuery == 'undefined') {
		document.write('<scr'+'ipt type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></scr'+'ipt>');
		document.write('<scr'+'ipt>jQuery.noConflict();</scr'+'ipt>');
	}	
	
	//pagination fix
	jQuery(document).ready(function() {
		jQuery('div.k2Pagination a').each(function() {
			if(typeof jQuery(this).attr('href') === 'undefined') return;
			jQuery(this).attr('href', jQuery(this).attr('href') + "&Itemid=<?php echo JRequest::getVar('Itemid'); ?>");
		});
	});

</script>

<!-- Start K2 Generic (search/date) Layout -->
<div id="k2Container" class="genericView<?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">

	<?php if($this->params->get('show_page_title')): ?>
	<!-- Page title -->
	<div class="componentheading<?php echo $this->params->get('pageclass_sfx')?>">
		<?php echo $this->escape($this->params->get('page_title')); ?>
	</div>
	<?php endif; ?>

	<?php if($this->params->get('genericFeedIcon',1)): ?>
	<!-- RSS feed icon -->
	<div class="k2FeedIcon">
		<a href="<?php echo $this->feed; ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
			<span><?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?></span>
		</a>
		<div class="clr"></div>
	</div>
	<?php endif; ?>
	
	<!--added K2FSM -->
	<div class="k2filter-toolbox" style="margin: 20px 0;">
		<?php
			require_once (JPATH_SITE.DS.'modules'.DS.'mod_k2_filter'.DS.'helper.php');
			$moduleId = JRequest::getInt("moduleId");
			$moduleParams = modK2FilterHelper::getModuleParams($moduleId);
		?>
		
		<?php if($this->resultf != "") : ?>
		<h4 class="resultf" style="display: inline-block;">
			<?php echo JText::_($this->resultf); ?>
			<?php if($this->result_count != 0) : ?>
			<?php echo "(".$this->result_count.")" ?>
			<?php endif; ?>
		</h4>
		<?php endif; ?>
		
		<?php if($moduleParams->template_selector == 1 && $this->result_count != 0) : ?>
		<span class="template_selector" style="float: right;">
			<a href="#" onclick="document.K2Filter<?php echo $moduleId; ?>.template_id.value='0'; submit_form_<?php echo $moduleId; ?>(); return false;"><img src="<?php echo JURI::base(); ?>modules/mod_k2_filter/assets/generic.png" /></a>
			<a href="#" onclick="document.K2Filter<?php echo $moduleId; ?>.template_id.value='1'; submit_form_<?php echo $moduleId; ?>(); return false;"><img src="<?php echo JURI::base(); ?>modules/mod_k2_filter/assets/generic_table.png" /></a>
		</span>
		<?php endif; ?>
		
		<div style="clear: both;"></div>
		
		<?php if($moduleParams->ordering == 1 && $this->result_count != 0) : ?>
		<div class="ordering-box" style="display: inline-block;">
			<select style="display: inline-block; width: auto;" name="orderby" onChange="document.K2Filter<?php echo $moduleId; ?>.orderby.value=this.value; submit_form_<?php echo $moduleId; ?>();">
				
				<?php $filterLang =& JFactory::getLanguage();
					  $filterLang->load("mod_k2_filter");
				?>
			
				<option value=""><?php echo JText::_("MOD_K2_FILTER_ORDERING_VALUE"); ?></option>

				<option value="date" <?php if (JRequest::getVar('orderby') == "date") echo 'selected="selected"'; ?><?php if(JRequest::getVar("orderby") == '' && $moduleParams->ordering_default == "date") echo "selected=selected"; ?>><?php echo JText::_('MOD_K2_FILTER_ORDERING_DATE'); ?></option>
				<option value="alpha" <?php if (JRequest::getVar('orderby') == "alpha") echo 'selected="selected"'; ?><?php if(JRequest::getVar("orderby") == '' && $moduleParams->ordering_default == "alpha") echo "selected=selected"; ?>><?php echo JText::_('MOD_K2_FILTER_ORDERING_TITLE'); ?></option>
				<option value="order" <?php if (JRequest::getVar('orderby') == "order") echo 'selected="selected"'; ?><?php if(JRequest::getVar("orderby") == '' && $moduleParams->ordering_default == "order") echo "selected=selected"; ?>><?php echo JText::_('MOD_K2_FILTER_ORDERING_ORDER'); ?></option>
				<option value="featured" <?php if (JRequest::getVar('orderby') == "featured") echo 'selected="selected"'; ?><?php if(JRequest::getVar("orderby") == '' && $moduleParams->ordering_default == "featured") echo "selected=selected"; ?>><?php echo JText::_('MOD_K2_FILTER_ORDERING_FEATURED'); ?></option>
				<option value="hits" <?php if (JRequest::getVar('orderby') == "hits") echo 'selected="selected"'; ?><?php if(JRequest::getVar("orderby") == '' && $moduleParams->ordering_default == "hits") echo "selected=selected"; ?>><?php echo JText::_('MOD_K2_FILTER_ORDERING_HITS'); ?></option>
				<option value="rand" <?php if (JRequest::getVar('orderby') == "rand") echo 'selected="selected"'; ?><?php if(JRequest::getVar("orderby") == '' && $moduleParams->ordering_default == "rand") echo "selected=selected"; ?>><?php echo JText::_('MOD_K2_FILTER_ORDERING_RANDOM'); ?></option>
				<option value="best" <?php if (JRequest::getVar('orderby') == "best") echo 'selected="selected"'; ?><?php if(JRequest::getVar("orderby") == '' && $moduleParams->ordering_default == "best") echo "selected=selected"; ?>><?php echo JText::_('MOD_K2_FILTER_ORDERING_RATING'); ?></option>
				<option value="id" <?php if (JRequest::getVar('orderby') == "id") echo 'selected="selected"'; ?><?php if(JRequest::getVar("orderby") == '' && $moduleParams->ordering_default == "id") echo "selected=selected"; ?>><?php echo JText::_('MOD_K2_FILTER_ORDERING_ID'); ?></option>	
				
				<?php if($moduleParams->ordering_extra == 1) : ?>
					<?php foreach($this->extras as $extra) : ?>
					
						<option value="<?php echo $extra->id;?>" <?php if(JRequest::getVar("orderby") == $extra->id) echo "selected=selected"; ?><?php if(JRequest::getVar("orderby") == '' && $moduleParams->ordering_default == $extra->id) echo "selected=selected"; ?>>
							<?php echo $extra->name; ?>
						</option>
					
					<?php endforeach; ?>
				<?php endif; ?>
				
				<option value="k2store" <?php if (JRequest::getVar('orderby') == "k2store") echo 'selected="selected"'; ?><?php if(JRequest::getVar("orderby") == '' && $moduleParams->ordering_default == "k2store") echo "selected=selected"; ?>><?php echo JText::_('MOD_K2_FILTER_ORDERING_K2STORE'); ?></option>
				
			</select>
			
			<?php $order_method = JRequest::getVar("orderto", ""); ?>
			
			<?php if($order_method != "") : ?>
				<?php if($order_method == "desc") : ?>
					<a href="#" onclick="document.K2Filter<?php echo $moduleId; ?>.orderto.value='asc'; submit_form_<?php echo $moduleId; ?>(); return false;">
						<img src="<?php echo JURI::base(); ?>modules/mod_k2_filter/assets/sort_desc.png" border="0" alt="<?php echo JText::_('MOD_K2_FILTER_ORDERING_DESC'); ?>" title="<?php echo JText::_('MOD_K2_FILTER_ORDERING_DESC'); ?>" width="12" height="12" />
					</a>		
				<?php else : ?>
					<a href="#" onclick="document.K2Filter<?php echo $moduleId; ?>.orderto.value='desc'; submit_form_<?php echo $moduleId; ?>(); return false;">
						<img src="<?php echo JURI::base(); ?>modules/mod_k2_filter/assets/sort_asc.png" border="0" alt="<?php echo JText::_('MOD_K2_FILTER_ORDERING_ASC'); ?>" title="<?php echo JText::_('MOD_K2_FILTER_ORDERING_ASC'); ?>" width="12" height="12">
					</a>
				<?php endif; ?>
			<?php else : ?>
				<?php $order_method = $moduleParams->ordering_default_method; ?>

				<?php if($order_method == "desc") : ?>
					<a href="#" onclick="document.K2Filter<?php echo $moduleId; ?>.orderto.value='asc'; submit_form_<?php echo $moduleId; ?>(); return false;">
						<img src="<?php echo JURI::base(); ?>modules/mod_k2_filter/assets/sort_desc.png" border="0" alt="<?php echo JText::_('MOD_K2_FILTER_ORDERING_DESC'); ?>" title="<?php echo JText::_('MOD_K2_FILTER_ORDERING_DESC'); ?>" width="12" height="12" />
					</a>		
				<?php else : ?>
					<a href="#" onclick="document.K2Filter<?php echo $moduleId; ?>.orderto.value='desc'; submit_form_<?php echo $moduleId; ?>(); return false;">
						<img src="<?php echo JURI::base(); ?>modules/mod_k2_filter/assets/sort_asc.png" border="0" alt="<?php echo JText::_('MOD_K2_FILTER_ORDERING_ASC'); ?>" title="<?php echo JText::_('MOD_K2_FILTER_ORDERING_ASC'); ?>" width="12" height="12">
					</a>
				<?php endif; ?>
			<?php endif; ?>
			
		</div>
		<select style="float: right; width: 80px;" name="flimit" class="limit-box" onChange="document.K2Filter<?php echo $moduleId; ?>.flimit.value=this.value; submit_form_<?php echo $moduleId; ?>();">
			<?php 
				$limits = Array(5, 10, 15, 20, 30, 50, 100, 9999); 
				$selected = JRequest::getInt('flimit');
			?>
			<option value=""><?php echo JText::_("Show"); ?></option>
			<?php foreach($limits as $limit) { ?>
			<option value="<?php echo $limit; ?>"<?php if ($selected == $limit) echo ' selected="selected"'; ?>><?php echo $limit == 9999 ? "All" : $limit; ?></option>
			<?php } ?>
		</select>
		<?php endif; ?>
		<div style="clear: both;"></div>
	</div>	
	<!--///added K2FSM -->

	<?php if(count($this->items)): ?>
	<div class="genericItemList">
		<?php foreach($this->items as $item): ?>

		<!-- Start K2 Item Layout --><div id="kateg" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
		<div class="genericItemView">
		
			<!-- Plugins: BeforeDisplay -->
			<?php echo $item->event->BeforeDisplay; ?>

			<!-- K2 Plugins: K2BeforeDisplay -->
			<?php echo $item->event->K2BeforeDisplay; ?>

			<div class="genericItemHeader">
				<?php if($this->params->get('genericItemDateCreated')): ?>
				<!-- Date created -->
				<span class="genericItemDateCreated">
					<?php echo JHTML::_('date', $item->created , JText::_('K2_DATE_FORMAT_LC2')); ?>
				</span>
				<?php endif; ?>
			
			  
		  </div>
		  
		  <!-- Plugins: AfterDisplayTitle -->
		  <?php echo $item->event->AfterDisplayTitle; ?>

		  <!-- K2 Plugins: K2AfterDisplayTitle -->
		  <?php echo $item->event->K2AfterDisplayTitle; ?>

		  <div class="genericItemBody">
		  
			  <!-- Plugins: BeforeDisplayContent -->
			  <?php echo $item->event->BeforeDisplayContent; ?>

			  <!-- K2 Plugins: K2BeforeDisplayContent -->
			  <?php echo $item->event->K2BeforeDisplayContent; ?>
		  
			  <?php if($this->params->get('genericItemImage') && !empty($item->imageGeneric)): ?>
			  <!-- Item Image -->
			  <div class="genericItemImageBlock">
				  <span class="genericItemImage">
				    <a href="<?php echo $item->link; ?>" title="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>">
				    	<img src="<?php echo $item->imageGeneric; ?>" alt="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>" style="width:<?php echo $this->params->get('itemImageGeneric'); ?>px; height:auto;" />
				    </a>
				  </span>
				  <div class="clr"></div>
			  </div>
			  <?php endif; ?>
			  
			  <?php if($this->params->get('genericItemIntroText')): ?>
			  <!-- Item introtext -->
			  <div class="genericItemIntroText">
			  	<?php echo $item->introtext; ?>
			  </div>
			  <?php endif; ?>
			  
			  <!-- Plugins: AfterDisplayContent -->
			  <?php echo $item->event->AfterDisplayContent; ?>

			  <!-- K2 Plugins: K2AfterDisplayContent -->
			  <?php echo $item->event->K2AfterDisplayContent; ?>

			  <div class="clr"></div>
		  </div>
		  
		  <div class="clr"></div>
		  <?php if($this->params->get('genericItemTitle')): ?>
			  <!-- Item title -->
			  <h3 class="genericItemTitle">
			  	<?php if ($this->params->get('genericItemTitleLinked')): ?>
					<a href="<?php echo $item->link; ?>">
			  		<?php echo $item->title; ?>
			  	</a>
			  	<?php else: ?>
			  	<?php echo $item->title; ?>
			  	<?php endif; ?>
			  </h3>
			  <?php endif; ?>
		  <?php if($this->params->get('genericItemExtraFields') && count($item->extra_fields)): ?>
		  <!-- Item extra fields -->  
		  <div class="genericItemExtraFields">
		  	
		  	<ul>
				<?php foreach ($item->extra_fields as $key=>$extraField): ?>
				<?php if($extraField->value): ?>
				<li class="<?php echo ($key%2) ? "odd" : "even"; ?> type<?php echo ucfirst($extraField->type); ?> group<?php echo $extraField->group; ?>">
					<span class="genericItemExtraFieldsLabel"><?php echo $extraField->name; ?></span>
					<span class="genericItemExtraFieldsValue"><?php echo $extraField->value; ?></span>		
				</li>
				<?php endif; ?>
				<?php endforeach; ?>
				</ul>
		    <div class="clr"></div>
		  </div>
		  <?php endif; ?>
		  
		  <!-- Plugins: AfterDisplay -->
		  <?php echo $item->event->AfterDisplay; ?>

		  <!-- K2 Plugins: K2AfterDisplay -->
		  <?php echo $item->event->K2AfterDisplay; ?>
		  
			<?php if($this->params->get('genericItemCategory')): ?>
			<!-- Item category name -->
			<div class="genericItemCategory">
				<span><?php echo JText::_('K2_PUBLISHED_IN'); ?></span>
				<a href="<?php echo $item->category->link; ?>"><?php echo $item->category->name; ?></a>
			</div>
			<?php endif; ?>
			
			<?php if ($this->params->get('genericItemReadMore')): ?>
			<!-- Item "read more..." link -->
			<div class="genericItemReadMore">
				<a class="k2ReadMore" href="<?php echo $item->link; ?>">
					<?php echo JText::_('K2_READ_MORE'); ?>
				</a>
			</div>
			<?php endif; ?>

			<div class="clr"></div>
		</div></div>
		<!-- End K2 Item Layout -->
		
		<?php endforeach; ?>
	</div>
<div class="clr"></div>
	<!-- Pagination -->
	<?php if($this->pagination->getPagesLinks()): ?>
	<div class="k2Pagination">
		<?php echo $this->pagination->getPagesLinks(); ?>
		<div class="clr"></div>
		<?php echo $this->pagination->getPagesCounter(); ?>
	</div>
	<?php endif; ?>

	<?php endif; ?>
	
</div>
<!-- End K2 Generic (search/date) Layout -->
