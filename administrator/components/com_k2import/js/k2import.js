

function add_more_attachments()
{
	attachment_num=count_attachments-1;
	add_more_fields('k2importfield_attachment_'+attachment_num,'k2importfield_attachment_'+count_attachments);
	add_more_fields('k2importfield_attachment_title_'+attachment_num,'k2importfield_attachment_title_'+count_attachments);
	add_more_fields('k2importfield_attachment_title_attribute_'+attachment_num,'k2importfield_attachment_title_attribute_'+count_attachments);
	count_attachments++;

}



function selectDropdownOption(element,wert){
	for (var i=0; i < element.options.length; i++){
		if (element.options[i].value == wert) {
			element.options[i].selected = true;
		} else {
			element.options[i].selected = false;
		}
	}
}

//http://javascript.jstruebig.de/javascript/35
function stripHTML(str){

	// remove all string within tags

	var tmp = str.replace(/(<.*['"])([^'"]*)(['"]>)/g, 

			function(x, p1, p2, p3) { return  p1 + p3;}

	);

	// now remove the tags

	return tmp.replace(/<\/?[^>]+>/gi, '');

}

function hide_view_extra_field_group_selection()
{

	if (document.id('k2category').get('value')=='take_from_csv')
	{
		document.id('k2extrafieldgroup_tr').setStyle('display', 'table-row');
		document.id('k2ignore_level_tr').setStyle('display', 'table-row');
	}
	else
	{
		document.id('k2extrafieldgroup_tr').setStyle('display', 'none');
		document.id('k2ignore_level_tr').setStyle('display', 'none');
	}
	
}


function add_more_fields(k2importfield_id,new_k2importfield_id)
{
	k2importfield=jQuery('#'+k2importfield_id);
	var k2importselect_div=k2importfield.find(".k2importselect:last"); 
	var new_k2importfield=k2importfield.clone(true,true);
	
	//try to find CSV columns that match the new fields
	new_k2importfield.find('select option').each (function() {
		//The spli().join() combination is basically a replaceAll function
		if (jQuery(this).html().toLowerCase().split(" ").join("") == new_k2importfield_id.substr(14).split("_").join("")) {
				jQuery(this).attr('selected', 'selected');
				
			}
	});
	

	new_k2importfield.attr('id',new_k2importfield_id);
	new_k2importfield.insertAfter(k2importfield);
	new_k2importfield.find('select').attr('name','k2importfields['+new_k2importfield_id.substr(14)+']');
	new_k2importfield.find('input').attr('name','k2importfields_php_command['+new_k2importfield_id.substr(14)+']');

	new_k2importfield.find('.k2optionscount').text('['+count_attachments+']');


}