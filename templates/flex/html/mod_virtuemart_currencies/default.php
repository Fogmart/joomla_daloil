<?php // no direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('formbehavior.chosen', 'select');
?>
<div class="currency-selector-module">
<!-- Currency Selector Module -->
<?php if ($text_before != '') { ?><p><?php echo $text_before ?></p><?php } ?>
<form action="<?php echo vmURI::getCleanUrl() ?>" method="post">
	<?php echo JHTML::_('select.genericlist', $currencies, 'virtuemart_currency_id', 'class="chosen-select"', 'virtuemart_currency_id', 'currency_txt', $virtuemart_currency_id) ; ?>
    <!-- 
    <input class="btn btn-default" type="submit" name="submit" value="<?php echo vmText::_('VM_VIRTUEMART_CURRENCIES_CHANGE_CURRENCIES') ?>" />
    <a class="btn btn-default" href="#" role="button"><?php echo vmText::_('VM_VIRTUEMART_CURRENCIES_CHANGE_CURRENCIES') ?></a>
     -->
    <button class="btn btn-default" type="submit" name="submit" data-toggle="tooltip" title="<?php echo vmText::_('MOD_VIRTUEMART_CURRENCIES_CHANGE_CURRENCIES') ?>"><i class="fa fa-refresh"></i></button>
</form>
</div>

