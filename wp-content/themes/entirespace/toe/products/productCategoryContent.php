<div class="category_product grid three mobile-two columns nopaddingR <?php if($_COOKIE['catalogView'] == 'grid' || $_COOKIE['catalogView'] == null) echo 'active-catalog-view' ?>">
    <form action="" method="post" class="toeAddToCartForm" id="toeAddToCartForm<?php echo $this->post->ID?>" onsubmit="toeAddToCart(this); return false;">
        <div class="product-item-thumb product_main <?php if(frame::_()->getModule('products')->markAsSale($this->post->ID) == true) {echo 'sale'; } ?> <?php if($this->pData['mark_as_new']->value) {echo 'new'; } ?>">
            <!--toeImage-->
            <a href="<?php the_permalink(); ?>"><img src="<?php echo $this->image['big'][0]?>" /></a>
            <span class="sticker"></span>
            <a href="<?php the_permalink(); ?>">
                <span class="product-item-descr"><?php echo get_the_excerpt(); ?></span>
            </a>
            <!--/toeImage-->
        </div>
        <div class="product-item-info product_info">
            <?php if ($this->viewOptions['title']) :?>
                <!--toetitle-->
                <div class="grid-product-name">
                    <a href="<?php the_permalink(); ?>" class="product-link"><?php echo get_the_title()?></a>
                </div><div class="clear"></div>
                <!--/toetitle-->
            <?php endif;?>
            <?php if ($this->viewOptions['price']) :?>
                <div class="product_price product-item-price grid-item-price">
                    <span><?php echo $this->priceHtml?></span>
                </div>
            <?php endif;?>
        </div>
    </form>
</div>

<div class="category_product product-item list <?php if($_COOKIE['catalogView'] == 'list') echo 'active-catalog-view' ?>">
    <form action="" method="post" class="toeAddToCartForm twelve product-item list" id="toeAddToCartForm<?php echo $this->post->ID?>" onsubmit="toeAddToCart(this); return false;">
        <div class="product-item-thumb product_main <?php if(frame::_()->getModule('products')->markAsSale($this->post->ID) == true) {echo 'sale'; } ?> <?php if($this->pData['mark_as_new']->value) {echo 'new'; } ?>">
            <a href="<?php the_permalink(); ?>"><img src="<?php echo $this->image['big'][0]?>" /></a>
            <span class="sticker"></span>
            <?php if (get_post_meta( $this->post->ID, 'product_hover_title', true ) != ''): ?>
                <a href="<?php the_permalink(); ?>">
                    <span class="product-item-descr"><?php echo get_post_meta( $this->post->ID, 'product_hover_title', true ); ?></span>
                </a>
            <?php endif; ?>
        </div>
        <div class="product-item-info product_info">
            <?php if ($this->viewOptions['title']) :?>
                <!--toetitle-->
                <a href="<?php the_permalink(); ?>" class="prod-title product-link"><?php echo get_the_title()?></a>
                <!--/toetitle-->
            <?php endif;?>
            <div class="rating"><?php echo $this->ratingBox; ?></div>
            <div class="clear"></div>
            <p><?php echo get_the_excerpt(); ?></p>
            <?php if ($this->viewOptions['price']) :?>
                <div class="product_price product-item-price">
                    <span><?php echo $this->priceHtml?></span>
                </div>
            <?php endif;?>
            <div class="prod-btns">
                <a href="<?php the_permalink(); ?>" class="button"><?php lang::_e('View more'); ?></a>
                <?php if ($this->viewOptions['add_to_cart']) :?>
                    <div class="product_to_cart">
                          <?php echo '<a href="'.uri::mod('user', '', 'addToCart', array('pid' => $this->post->ID)).'" class="button blue-button">'.lang::_('Add to Cart').'</a>';?>
                    </div>
                <?php endif;?>
            </div>
        </div>
    <hr class="list" />
    </form>
</div>