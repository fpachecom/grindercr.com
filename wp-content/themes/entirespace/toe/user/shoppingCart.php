<?php if($this->canEdit) {?>
<script type="text/javascript">
// <!--
var toeQtyPrev = '';
jQuery(document).ready(function(){
    jQuery('.prod_qty').keyup(function(){
        var val = jQuery(this).val();
        if(val == '')
            val = 0;
        if(!isNumber(toeQtyPrev)) {
            var intMatches = /\d+/.exec(toeQtyPrev);
            if(intMatches)
                toeQtyPrev = intMatches[0];
        }
        if(!isNumber(val)) 
            val = toeQtyPrev;
        jQuery(this).val(val);
    });
    jQuery('.prod_qty').keydown(function(){
        if(jQuery(this).val() == '0')
            jQuery(this).val('');
        toeQtyPrev = jQuery(this).val();
    });
    jQuery('.cartQtyUpdate').submit(function(){
        jQuery(this).sendForm({
            msgElID: 'qty_update_msg_'+ jQuery(this).find('input[type=hidden][name=inCartId]').val(),
            onSuccess: function(res) {
                if(res.data)
                    updateCart( [res.data.cart], res.data.totalHtml, res.data.newCartData );
            }
        });
        return false;
    });
    jQuery('.remove_from_cart').click(function(){
        var inCartId = jQuery(this).parents('tr:first').find('input[type=hidden][name=inCartId]').val();
        inCartId = parseInt(inCartId);
        if(isNumber(inCartId)) {
            jQuery(this).sendForm({
                msgElID: 'qty_update_msg_'+ inCartId,
                data: {inCartId: inCartId, reqType: 'ajax', action: 'updateCart', mod: 'user', qty: 0},
                onSuccess: function(res) {
                    if(res.data)
                        updateCart( [res.data.cart], res.data.totalHtml, res.data.newCartData );
                }
            });
        }
        return false;
    });
});
// -->
</script>
<?php }?>
<div id="shopping_cart_page">
    <?php if($this->canEdit) {?>
    <div class="todo-cart">
        <a href="<?php bloginfo('url'); ?>" class="button"><?php lang::_e('Continue shoping'); ?></a>
        <a class="button blue-button" href="<?php echo frame::_()->getModule('pages')->getLink(array('mod' => 'checkout', 'action' => 'getAllHtml'))?>"><?php lang::_e('Proceed to checkout')?></a>
    </div>
    <?php } ?>
    <div class="clear"></div>
    
    <table class="shopping_cart">
        <thead>
        <tr>
            <?php foreach($this->columns as $cKey => $cInfo) { ?>
                <?php if($cInfo['disable']) continue;?>
                <?php if($cKey == 'action' && !$this->canEdit) continue;?>
                <?php if($cKey != 'action'):?>
                        <td class="shopping_cart_<?php echo $cKey?>"><?php lang::_e($cInfo['title'])?></td>
                    <?php endif; ?>
            <?php }?>
        </tr>
        </thead>
        <tbody>
    <?php foreach($this->cart as $inCartId => $c) { ?>
        <tr class="cart_row_<?php echo $inCartId?>">
            <?php foreach($this->columns as $cKey => $cInfo) {
                if($cInfo['disable']) continue;
                switch($cKey) {
                    case 'id' :?>
                        <td><?php echo $c['pid']?></td>
                    <?php break;
                    case'img':?>
                        <td class="col_img shopping_cart_img">
                            <?php
                                $imgsrc = frame::_()->getModule('products')->getView()->getProductImage($c['pid']);
                            ?>
                            <div class="cart_thumb">
                                <a href="<?php echo get_post_permalink($c['pid']);?>" target="_blank" title="<?php echo $c['name']?>">
                                    <img src="<?php echo uri::_(array('baseUrl' => $imgsrc['big'][0], 'w' => 150))?>" alt="<?php echo $c['name']?>" />
                                </a>
                            </div>
                        </td>
                    <?php break;
                    case 'name': ?>
                        <td>
                            <h3><a href="<?php echo get_post_permalink($c['pid']);?>"><?php echo $c['name']?></a></h3>
                            <!--<span class="toeProdOutOfStock">***</span>-->
                            <?php if(!empty($c['options'])) { ?>
                                <div><?php lang::_e('Options')?></div>
                                <div>
                                <?php foreach($c['options'] as $optKey => $opt) { ?>
                                    <?php if(empty($opt['displayValue'])) continue;?>
                                    <b><?php lang::_e($opt['label'])?></b>: 
                                    <?php 
                                        if(is_array($opt['displayValue']))
                                            echo implode(', ', $opt['displayValue']);
                                        else
                                            echo $opt['displayValue']
                                    ?><br />
                                <?php } ?>
                                </div>
                            <?php }?>
                        </td>
                    <?php break;
                    case 'qty':?>
                        <td>
                            <?php if($this->canEdit && !$c['gift']) {?>
                                <?php echo html::formStart('qty_cart', array('action' => '', 'attrs' => 'class="cartQtyUpdate"'))?>
                                <?php echo html::hidden('inCartId', array('value' => $inCartId))?>
                                <?php echo html::textIncDec('qty', array('value' => $c['qty'], 'attrs' => 'class="prod_qty"', 'id' => 'qty_'. $inCartId. ''))?>
                                <?php echo html::hidden('reqType', array('value' => 'ajax'))?>
                                <?php echo html::hidden('action', array('value' => 'updateCart'))?>
                                <?php echo html::hidden('mod', array('value' => 'user'))?>
                                <?php /** @deprecated @see inCartId key, but DO NOT delete this*/?>
                                <?php echo html::hidden('pid', array('value' => $c['pid']))?>
                                <?php /*****/?>
                                <?php echo html::submit('update', array('value' => lang::_('Update'), 'attrs' => 'class="update_qty"'))?>
                                <div id="qty_update_msg_<?php echo $inCartId?>"></div>
                                <?php echo html::formEnd()?>
                            <?php } else {
                                if($this->canEdit && $c['gift']) {	//Show this for gifts
                                    echo html::formStart('qty_cart', array('action' => '', 'attrs' => 'class="cartQtyUpdate"'));
                                    echo html::hidden('inCartId', array('value' => $inCartId));
                                    echo html::formEnd();
                                }
                                echo $c['qty'];
                            }?>
                        </td>
                    <?php break;
                    case 'price': ?>
                        <td>
                            <?php if($c['gift']) {
                                lang::_e('It\'s a gift');
                            } else {
								echo frame::_()->getModule('currency')->displayTotal($c['price'], 1 /*Price for one product*/, $c['pid'], array('options' => $c['options']));
                                //echo frame::_()->getModule('currency')->display($c['price']);
                            }?>
                        </td>
                    <?php break;
                    case 'total': ?>
                        <td class="cart_total total_<?php echo $inCartId?>">
                            
                                <?php if($c['gift']) {
                                    lang::_e('It\'s a gift');
                                } else {
                                    echo frame::_()->getModule('currency')->displayTotal($c['price'], $c['qty'], $c['pid'], array('options' => $c['options']));
                                }?>
                            <?php if($this->canEdit): ?>
                            <div class="cart_total_wrapper">
                                <br /><a href="#" class="remove remove_from_cart"> <?php lang::_e('Remove'); ?></a>
                            </div>
                            <?php endif; ?>
                        </td>
                    <?php break;
                }
            }?>
        </tr>
    <?php }?>
        </tbody>
    </table>
    <?php if($this->canEdit) {?>
        <div id="toeCartTotalBox"><?php echo $this->totalBox?></div>
        <div class="clear"></div>
        <div class="todo-cart todo-cart-bottom">
            <a href="<?php bloginfo('url'); ?>" class="button"><?php lang::_e('Continue shoping'); ?></a>
            <a class="button blue-button" href="<?php echo frame::_()->getModule('pages')->getLink(array('mod' => 'checkout', 'action' => 'getAllHtml'))?>"><?php lang::_e('Proceed to checkout')?></a>
        </div>
        <div style="float: left;">
            <a href="#" onclick="toeClearCart({reload: true}); return false;" class="button"><?php lang::_e('Clear Cart')?></a>
            <div class="toeCartMsg"></div>
        </div>
        <div class="clear"></div>
    <?php }?>
</div>