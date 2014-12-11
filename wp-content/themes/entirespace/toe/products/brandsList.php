<?php foreach($this->brands as $b) { ?>
<article class="toeCategoryListPage product-text product-single-txt row">
	<div class="entry-content row">
        <div class="thumb three columns nopaddingL">
            <?php if($imgSrc = frame::_()->getModule('products')->getCategoryImage($b)) { ?>
				<a href="<?php echo frame::_()->getModule('products')->getLinkToCategory($b, $b->slug)?>"><?php echo html::img($imgSrc, false);?></a>
			<?php } else {
				echo '&nbsp;';
			}?> 
        </div>
        <div class="toeCategoryListDescription nine columns nopadding">
            <a href="<?php echo frame::_()->getModule('products')->getLinkToCategory($b, $b->slug)?>"><h2 class="entry-title"><?php echo $b->name?></h2></a>
            <?php if (!empty($b->description)) echo '<p>'.nl2br($b->description).'</p><br />'; ?>
            <a href="<?php echo frame::_()->getModule('products')->getLinkToCategory($b, $b->slug)?>"><?php lang::_e('Watch the products'); ?></a>
        </div>
    </div><!-- .entry-content -->
</article>
<?php }?>