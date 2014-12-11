<div class="cart-widget">
    <?php 
        $cartLink = frame::_()->getModule('pages')->getLink(array('mod' => 'user', 'action' => 'getShoppingCart')); 
    ?>
    <a href="<?php echo $cartLink; ?>"><img src="<?php echo bloginfo('template_directory').'/img/cart-ico.png'; ?>" /></a>
    <div class="widget-title"><a href="<?php echo $cartLink; ?>"><?php lang::_e('Shopping cart')?></a> -</div>
    <?php
        $count_items = 0;
    
        foreach($this->cart as $inCartId => $c) { 
            $count_items += $c['qty'];
        }
    ?>
    <span class="cart-count"><?php echo $count_items; ?></span>
    <a href="<?php echo $cartLink; ?>" class="cart-price"><?php echo $this->total; ?></a>
</div><!-- End Cart Widget -->