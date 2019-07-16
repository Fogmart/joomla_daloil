	<script type="text/javascript">
	
		jQuery(document).ready(function() {
			var availableTags<?php echo $module->id; ?> = [
				
				<?php 
				
					$restcata = 0;
					
					if($restmode == 1) {	
						$view = JRequest::getVar("view");
						$task = JRequest::getVar("task");
						
						if($view == "itemlist" && $task == "category") 
							$restcata = JRequest::getInt("id");
						else if($view == "item") {
							$id = JRequest::getInt("id");
							$restcata = modK2FilterHelper::getParent($id);
						}
						else {
							$restcata = JRequest::getVar("restcata");
						}
					}
				
					$tags = modK2FilterHelper::getTags($params, $restcata); 
					
				?>
				
				<?php foreach($tags as $k=>$tag) {
					echo "\"" . $tag->tag . "\"";
					if(($k+1) != count($tags)) {
						echo ", ";
					}
				}
				?>
			];
			
			jQuery("#K2FilterBox<?php echo $module->id; ?> input.inputbox").autocomplete({
				<?php if($acounter) : ?>
				select: function(event, ui) {
					jQuery(this).val(ui.item.value);
					acounter<?php echo $module->id; ?>()
				},
				<?php endif; ?>
				source: function(request, response) {
					var filteredArray = jQuery.map(availableTags<?php echo $module->id; ?>, function(item) {
						if(item.toUpperCase().indexOf(request.term.toUpperCase()) == 0){
							return item;
						}
						else{
							return null;
						}
					});
					response(filteredArray);
				}
			});
		});
	</script>