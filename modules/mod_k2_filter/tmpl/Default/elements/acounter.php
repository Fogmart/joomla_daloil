		<script type="text/javascript">			
			function acounter<?php echo $module->id; ?>() {
				jQuery("#K2FilterBox<?php echo $module->id; ?> div.acounter").html("<p><img src='<?php echo JURI::root(); ?>media/k2/assets/images/system/loader.gif' /></p>");

				var url = "<?php echo JRoute::_('index.php?option=com_k2&view=itemlist&task=filter&format=count'); ?>";
				var data = jQuery("#K2FilterBox<?php echo $module->id; ?> form").find(":input").filter(function () {
								return jQuery.trim(this.value).length > 0
							}).serialize();
							
				jQuery.ajax({
					data: data + "&format=count",
					type: "get",
					url: url,
					success: function(response) {
						jQuery("#K2FilterBox<?php echo $module->id; ?> div.acounter").html("<p>"+response+" <?php echo JText::_("MOD_K2_FILTER_ACOUNTER_TEXT"); ?></p>");
						jQuery("#K2FilterBox<?php echo $module->id; ?> div.acounter").show();
					}
				});
			}
			jQuery(document).ready(function() {
				jQuery("#K2FilterBox<?php echo $module->id; ?> form").change(function(event) {
					acounter<?php echo $module->id; ?>();
				});
			});
		</script>
		
		<div class="acounter"></div>