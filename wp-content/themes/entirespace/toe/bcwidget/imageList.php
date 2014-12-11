<div class="carousel-wrapper twelve columns">
    <div class="list_carousel responsive">
        <ul class="category-images-widget">
            <?php if (!empty($this->data)):?>
                <?php foreach ($this->data as $category) :?>
                    <li class="cat-slider-item">
                        <a href="<?php echo $category->href; ?>">
                            <img src="<?php echo $category->image; ?>" alt="" />
                            <span class="slider-cat-name"><?php echo $category->name?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php endif;?>
        </ul>
        <div class="clearfix"></div>
        <a href="#" class="flex-prev prev"></a>
        <a href="#" class="flex-next next"></a>
    </div>
</div>