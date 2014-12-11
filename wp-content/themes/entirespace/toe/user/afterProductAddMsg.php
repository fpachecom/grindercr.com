<div><?php lang::_e('Product was added to your cart')?></div>
<div>
    <a href="<?php echo frame::_()->getModule('pages')->getLink(array('mod' => 'checkout', 'action' => 'getAllHtml'))?>"><?php lang::_e('Checkout')?></a>
    <a href="<?php echo frame::_()->getModule('pages')->getLink(array('mod' => 'user', 'action' => 'getShoppingCart'))?>"><?php lang::_e('Shopping cart')?></a>
</div>
