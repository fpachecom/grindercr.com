<script type="text/javascript">
jQuery(document).ready(function(){
    jQuery('#toeAddToCartForm<?php echo $this->post->ID?>').find('input[name=buynow]').click(function(){
        jQuery('#toeAddToCartForm<?php echo $this->post->ID?>').find('input[name=goto]').val('checkout');
    });
});
</script>
<div class="actionButtons cart-buttons">
    <?php if($this->useFormOnButtonsTpl) { ?>
        <form action="" method="post" class="toeAddToCartForm" id="toeAddToCartForm<?php echo $this->post->ID?>" onsubmit="toeAddToCart(this, 'Product was added to cart', true); return false;">
    <?php }?>
        <?php echo html::text('qty', array('value' => 1))?>
        <?php echo html::hidden('goto')?>
        <?php echo html::hidden('addQty', array('value' => 1))?>
        <?php echo html::hidden('mod', array('value' => 'user'))?>
        <?php echo html::hidden('action', array('value' => 'addToCart'))?>
        <?php echo html::hidden('pid', array('value' => $this->post->ID))?>
        <?php echo html::hidden('reqType', array('value' => 'ajax'))?>
        <?php echo html::submit('add', array('value' => lang::_('Add to Cart'), 'attrs' => 'class="button blue-button"'))?>
        <?php echo html::submit('buynow', array('value' => lang::_('Buy Now'), 'attrs' => 'class="button blue-button"'))?>
        <div class="clear"></div>
    <?php if($this->useFormOnButtonsTpl) { ?>
        </form>
    <?php }?>
    <?php if($this->stockCheck && !$this->availableQty) { ?>
        <div class="toeErrorMsg"><?php lang::_e('Please be adviced that this product is out of stock')?></div>
    <?php }?>
    <div class="toeAddToCartMsg"></div>
</div>
<?php //endif;?>