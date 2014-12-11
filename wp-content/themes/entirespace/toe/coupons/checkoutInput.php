<script type="text/javascript">
<!--
function toeApplyCoupon() {
    jQuery(this).sendForm({
        msgElID: 'toeCouponsCheckoutMsg',
        data: {coupon: jQuery('#toeCoupon').val(), mod: 'coupons', action: 'applyCoupon', reqType: 'ajax'},
        onSuccess: function(res) {
            if(res.data.totalHtml) {
                updateCart(new Array(), res.data.totalHtml);
            }
            if(!res.error) {
                jQuery('#toeCoupon').val('');
            }
        }
    });
}
function toeShouCouponsDescription(link) {
    var linkPos = jQuery(link).position();
    subScreen.show(<?php echo $this->couponsDescription?>, linkPos.left, linkPos.top);
}
-->
</script>
<div class="coupon-block">
    <?php lang::_e('<p>Enter your coupon code (<a href="#" onclick="toeShouCouponsDescription(this); return false;">where to get one?</a>):</p>')?>
    <?php echo html::text('coupon', array('attrs' => 'id="toeCoupon"'))?>
    <?php echo html::button(array('value' => lang::_('Apply'), 'attrs' => 'onclick="toeApplyCoupon();" class="button" id="ApplyCoupon"'))?>
    <div id="toeCouponsCheckoutMsg"></div>
    <div class="clear"></div>
</div>