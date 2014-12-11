<script type="text/javascript">
// <!--
var checkoutSkipConfirmStep = <?php echo $this->checkoutSkipConfirmStep?>;
jQuery(document).ready(function(){
    jQuery('.toe_checkout_head_part').click(function(e){
        var classes = jQuery(this).attr('class').split(' ');
        if(classes[1]) {
            jQuery('.toe_checkout_part_'+ classes[1]).stop().slideToggle('slow');
        }
    });
    jQuery('#billing_').click(function(){
        jQuery(this).copyFieldsValues('shipping_');
    });
    jQuery('#shipping_').click(function(){
        jQuery(this).copyFieldsValues('billing_');
    });
	jQuery('#toeShippingSameAsBilling').change(function(){
		if(jQuery('#toeShippingSameAsBilling').attr('checked')) {
			jQuery(this).copyFieldsValues('billing_', 'shipping_');
			jQuery('#toe_checkout_form_1 [name^=shipping_]').not('[name=shipping_module]').setReadonly();
			jQuery('#shippingSameAsBillingIndicator').show();
		} else  {
			jQuery('#toe_checkout_form_1 [name^=shipping_]').not('[name=shipping_module]').unsetReadonly();
			jQuery('#shippingSameAsBillingIndicator').hide();
		}
	});
	jQuery('#toeShippingSameAsBilling').removeAttr('checked');
	if(parseInt(toeOption('shipp_same_as_bill'))) {
		jQuery('#toeShippingSameAsBilling').trigger('click');
	}
    jQuery('#toe_checkout_form_1').submit(function(){
		if(jQuery('#toeShippingSameAsBilling').attr('checked')) {
			jQuery(this).copyFieldsValues('billing_', 'shipping_');
		}
        jQuery(this).sendForm({onSuccess: function(res){
            if(res.html) {
                jQuery('#toe_checkout_content').slideToggle('slow', function(){
                   if(checkoutSkipConfirmStep) {
                        res.html = '<div style="display: none;">'+ res.html+ '</div>';
                   }
                   jQuery(this).html( res.html );
                   jQuery(this).slideToggle('slow');
                   
                   if(checkoutSkipConfirmStep) {
                       jQuery(this).find('form:first').submit();
                   }
                });
            }
        }});
        return false;
    });
});
// -->
</script>
<div id="toe_checkout_content" class="row">
    <form id="toe_checkout_form_1" action="<?php echo uri::mod('order', '', 'addFromCheckout')?>" method="post">
        <?php foreach($this->blokSteps as $sKey => $sInfo) { 
            if(empty($this->$sKey)) continue;
            ?>
            <div class="toe_checkout_part_box fleft six columns checkout_<?php echo $sKey?>">
                <h2 class="toe_checkout_head_part <?php echo $sKey?>"><?php lang::_e($sInfo['title'])?></h2>
                <div class="toe_checkout_part_<?php echo $sKey?>">
                    <?php echo $this->$sKey?>
                </div>
            </div>
        <?php }?>
        <div class="clear"></div>
        <div class="fright">
            <?php echo html::hidden('action', array('value' => 'addFromCheckout'))?>
            <?php echo html::hidden('mod', array('value' => 'order'))?>
            <?php echo html::hidden('reqType', array('value' => 'ajax'))?>
            <a class="button prev-link" href="<?php echo frame::_()->getModule('pages')->getLink(array('mod' => 'user', 'action' => 'getShoppingCart')); ?>"><?php lang::_e('Go to Previous'); ?></a>
            <?php echo html::submit('next', array('value' => lang::_('Confirm and go Next'), 'attrs' => 'class="step2-button"'))?>
        </div>
    </form>
</div>
<div id="msg"></div>