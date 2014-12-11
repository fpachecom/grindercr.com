<script type="text/javascript">
$(document).ready(function(){
    $("#also-purchased-slider").carouFredSel({
        width: "100%",
        responsive: true,
        auto: {play:false},
        items: {
            visible: {
                min: 2,
                max: 5
            },
            width: 162,
            height: 240
        },
        scroll: {
            easing: "swing",
            duration: 500
        },
        prev: {
            button  : "#also-purchased-prev",
        },
        next: {
            button  : "#also-purchased-next",
        },
        swipe: true
    });
});
</script>
<div class="bestsellers-widget toeWidget twelve columns" id="toeMostViewedWidgetContent<?php echo $this->uniqID?>">
    <?php if(!empty($this->params['title'])) { ?>
        <div class="toeWidgetTitle big-widget-title"><?php lang::_e($this->params['title'])?></div>
    <?php }?>
    <div  class="products-slider list_carousel responsive">
        <ul class="content-slider" id="also-purchased-slider">
            <?php if (!empty($this->products)):
                    foreach ($this->products as $product) :?>
            <li class="product-item toeMostViewedProduct">
                <div class="product-item-thumb <?php if(frame::_()->getModule('products')->markAsSale($product['productID']) == true) {echo 'sale'; } ?> <?php if($product['post']->mark_as_new == true) {echo 'new'; } ?>">
                    <div class="image-wrapper-aligned">
                        <a href="<?php echo $product['guid']?>"><img src="<?php echo $product['image']['thumb'][0]; ?>" alt="<?php echo $product['title'];?>" /></a>
                    </div>
                    <span class="sticker"></span>
                    <a href="<?php echo $product['guid']; ?>">
                        <span class="product-item-descr"><?php echo $product['description']; ?></span>
                    </a>
                </div>
                <div class="product-item-info">
                    <a href="<?php echo $product['guid']?>" class="product-link"><span class="product_title"><?php echo $product['title'];?></span>
                        <?php if ($this->params['show_price']) :?>
                            <span class="product-item-price product_price"><?php if( $product['post']->toePriceOptExist ) lang::_e('From '); ?><?php echo $product['price'];?></span>
                        <?php endif;?>
                    </a>
                </div>
            </li>
            <?php   endforeach;
                  endif;  ?>
        </ul>
        <div class="clearfix"></div>
        <a href="#" id="also-purchased-prev" class="flex-prev prev"></a>
        <a href="#" id="also-purchased-next" class="flex-next next"></a>
    </div>
</div><!-- End Bestsellers Widget -->
<div class="clear"></div>