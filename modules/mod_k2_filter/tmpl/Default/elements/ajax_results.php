	<script type="text/javascript">
		
		function ajax_results<?php echo $module->id; ?>() {	
			jQuery(".filter_ajax_overlay<?php echo $module->id; ?>").show();
		
			var url = "<?php echo JRoute::_('index.php?option=com_k2&view=itemlist&task=filter&format=raw'); ?>";
			var data = jQuery("#K2FilterBox<?php echo $module->id; ?> form").find(":input").filter(function () {
							return jQuery.trim(this.value).length > 0
						}).serialize();
						
			jQuery.ajax({
				data: data + "&format=raw",
				type: "get",
				url: url,
				success: function(response) {	
					jQuery("#K2FilterBox<?php echo $module->id; ?> div.acounter").hide();
					jQuery("<?php echo $ajax_container; ?>").html(response);				
					history.pushState({}, '', "<?php echo JRoute::_('index.php?option=com_k2&view=itemlist&task=filter'); ?>" + "?" + data);				
					jQuery("html, body").animate({
						scrollTop: jQuery("<?php echo $ajax_container; ?>").offset().top - 70
					}, 500);
					jQuery(".filter_ajax_overlay<?php echo $module->id; ?>").hide();
				}
			});
		}

		jQuery(document).ready(function() {			
			jQuery('body').on("click", "<?php echo $ajax_container; ?> div.k2Pagination a, <?php echo $ajax_container; ?> .pagination a", function() {
				jQuery(".filter_ajax_overlay<?php echo $module->id; ?>").show();
				
				var url = jQuery(this).attr('href');
				var url_push = jQuery(this).attr('href').replace("&format=raw", "").replace("format=raw&", "").replace(".raw", "");
				jQuery.ajax({
					type: "GET",
					url: url + "&format=raw",
					success: function(response) {
						jQuery("<?php echo $ajax_container; ?>").html(response);	
						history.pushState({}, '', url_push);
						jQuery("html, body").animate({
							scrollTop: jQuery("<?php echo $ajax_container; ?>").offset().top - 70
						}, 500);
						jQuery(".filter_ajax_overlay<?php echo $module->id; ?>").hide();						
					}
				});
				return false;
			});
			
		});
		
	</script>
  
	<?php if($ajax_container == '.results_container') : ?>
    <div class="results_container"></div>
	<?php endif; ?>
	
	<style>
		.filter_ajax_overlay<?php echo $module->id; ?> {
			display: none;
			position: fixed;
			top: 0px;
			left: 0px;
			width: 100%;
			height: 100%;
			text-align: center;
			padding-top: 28%;
			    margin-left: 38%;
		}
		.filter_ajax_overlay<?php echo $module->id; ?> img { max-width: 130px; }
	</style>
	<div class="filter_ajax_overlay<?php echo $module->id; ?>"><img src='<?php echo JURI::root(); ?>modules/mod_k2_filter/assets/images/loading.png' /></div>