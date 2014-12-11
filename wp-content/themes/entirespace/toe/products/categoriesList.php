<?php foreach($this->categories as $c) { ?>
<article class="toeCategoryListPage product-text product-single-txt row">
	<div class="entry-content row">
        <div class="thumb three columns nopaddingL">
            <?php if($imgSrc = frame::_()->getModule('products')->getCategoryImage($c)) { ?>
				<a href="<?php echo frame::_()->getModule('products')->getLinkToCategory($c, $c->slug)?>"><?php echo html::img($imgSrc, false);?></a>
			<?php } else {
				echo '&nbsp;';
			}?> 
        </div>
        <div class="toeCategoryListDescription nine columns nopadding">
            <a href="<?php echo frame::_()->getModule('products')->getLinkToCategory($c, $c->slug)?>"><h2 class="entry-title"><?php echo $c->name?></h2></a>
            <?php if (!empty($c->description)) echo '<p>'.nl2br($c->description).'</p><br />'; ?>
            <a href="<?php echo frame::_()->getModule('products')->getLinkToCategory($c, $c->slug)?>"><?php lang::_e('Watch the products'); ?></a>
        </div>
    </div><!-- .entry-content -->
</article>
<?php }?>