<div class="toeSingleProductShell">
	<div id="single-content" class="row">
		<?php if ( is_active_sidebar( 'breadcrumbs' ) ) { ?>
			<?php dynamic_sidebar( 'breadcrumbs' ); ?>
		<?php } ?>

		<div class="right-content six columns">
			<form action="" method="post" class="toeAddToCartForm" id="toeAddToCartForm<?php echo $this->post->ID?>" onsubmit="toeAddToCart(this, 'Product was added to cart', true); return false;">
				<?php if ($this->viewOptions['title']) {?>
					<!--toetitle-->
						<h1><?php the_title(); ?></h1>
					<!--/toetitle-->
				<?php }?>
				<?php if(isset($this->variationsSelect) && !empty($this->variationsSelect)) 
					echo $this->variationsSelect;?>
				<div class="rating">
					<div class="item-rating">
						<?php echo $this->ratingBox; ?>
					</div>
				</div>
				<div class="clear"></div>
				<?php if ($this->viewOptions['short_descr']) {?>
					<!--toeshort_description-->
					<div id="product_excerpt" class="product-description">
						<?php the_excerpt(); ?>
					</div>
					<!--/toeshort_description-->
				<?php } ?>
				<?php if ($this->viewOptions['price']) {?>
					<!--toeprice-->
					<div id="product_price" class="product-price product_price">
						<span><?php echo $this->priceHtml?></span>
					</div>
					<div class="clear"></div>
					<!--/toeprice-->
				<?php } ?>
				<hr />

				<div id="prod-details-tab" class="product-info-box">
					<?php if ($this->viewOptions['details']) {?>
					<!--toeproperties-->
					<h4><?php lang::_e('Details'); ?></h4>
					<div class="extraFields">
						<table>
							<?php if ($this->viewOptions['sku']) {?>
							<!--toesku-->
							<tr>
								<td class="text-left"><?php echo lang::_e('Product ID:'); ?></td>
								<td>
									<div id="product_sku">
										<span><?php echo $this->pData['sku']->value;?></span>
									</div>
								</td>
							</tr>
							<!--/toesku-->
							<?php }?>

							<?php foreach($this->pData as $d) {
								if (in_array($d->name, array('cost','price','sku','featured','views'))) continue;   
								$d->valToType();
								$value = $d->getValue();
								if(empty($value)) continue;
								?>
								<tr>
									<td><?php lang::_e($d->label)?></td>
									<td>
										<?php 
											echo $d->displayValue();
											$showUnits = '';
											if(in_array($d->name, array('weight'))) {
												$showUnits = frame::_()->getModule('options')->get('weight_units');
											} elseif(in_array($d->name, array('width', 'height', 'length'))) {
												$showUnits = frame::_()->getModule('options')->get('size_units');
											}
											if(!empty($showUnits)) {
												echo ' ('. $showUnits. ')';
											}
										?>
									</td>
								</tr>
								<?php }?>
								<?php foreach ($this->pExtra as $d) {?>
								<tr>
									<td><?php lang::_e($d->label)?></td>
									<td> <?php echo $d->displayValue();?></td>
								</tr>
							<?php }?>

							<?php if(!empty($this->extraFields)) {?>
								<?php foreach($this->extraFields as $d) { ?>
								<tr>
									<td><?php lang::_e($d->label)?></td>
									<td><?php $d->display()?></td>
								</tr>
								<?php }?>
							<?php }?>
						</table>
					</div>
					<!--/toeproperties-->
					<?php } ?>
				</div>

				<?php if ($this->viewOptions['full_descr']) :?>
					<!--toefull_description-->
						<div id="product_description" class="product-info article">
							<div class="product_block_wrapper">
								<?php echo $this->fullDescr; ?>
							</div>  
						</div>
					<!--/toefull_description-->
				<?php endif; ?>
				<?php if ($this->viewOptions['add_to_cart']) :?>
					<!--toeadd_to_cart-->
						<div class="product_to_cart">
							<?php echo $this->actionButtons; ?>
						</div>
					<!--/toeadd_to_cart-->
				<?php endif; ?>

				<div class="product-social">
					<span id="gplus">
						<div class="g-plusone" data-size="medium"></div>
						<script type="text/javascript">
						  (function() {
							var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
							po.src = 'https://apis.google.com/js/plusone.js';
							var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
						  })();
						</script>
					</span>
					<span id="tweet">
						<a href="https://twitter.com/share" class="twitter-share-button" data-count="none"><?php lang::_e('Tweet'); ?></a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					</span>
					<span id="facebook">
						<!--<div class="fb-like" data-send="false" data-layout="button_count" data-width="110" data-show-faces="false"></div>-->
						<fb:like send="false" layout="button_count" width="110" show_faces="false"></fb:like>
					</span>
				</div>
				<div class="clear"></div>

				<div class="bc">
					<h4><?php lang::_e('VIEW MORE'); ?></h4>
					<ul class="bc-list">
						<?php 
							$cats = get_the_terms( $this->post->ID, 'products_categories' );
							if (!empty($cats)){
								foreach ($cats as $products_categories){
									$link = get_term_link($products_categories->slug, 'products_categories');
									echo '<li><a href="'.$link.'">'.$products_categories->name.'</a></li>';
								}
							}
						?>
						<?php 
							$cats = get_the_terms( $this->post->ID, 'products_brands' );
							if (!empty($cats)){
								foreach ($cats as $products_categories){
									$link = get_term_link($products_categories->slug, 'products_brands');
									echo '<li><a href="'.$link.'">'.$products_categories->name.'</a></li>';
								}
							}
						?>
					</ul>
				</div>
			</form>

			<?php if(!empty($this->additionalTabs)) { ?>
				<?php foreach($this->additionalTabs as $id => $tab) { ?>
				<div class="product-info-box">
					<h4><?php echo $tab['label']?></h4>
					<div id="toeProductAdditionalTab<?php echo $id?>"><?php echo $tab['content']?></div>
				</div>
				<?php }?>
			<?php }?>

			<?php if ( is_active_sidebar( 'alsopurchased' ) ) : ?>
				<?php dynamic_sidebar( 'alsopurchased' ); ?>
			<?php endif; ?>
		</div>

		<div class="product_main six columns nopadding">
			<div id="single-gallery" class="row <?php if(frame::_()->getModule('products')->markAsSale($this->post->ID) == true) {echo 'sale'; } ?> <?php if($this->pData['mark_as_new']->value) {echo 'new'; } ?>">
				<span class="sticker"></span>
				<div id="imgslider" class="product_full_image row">
					<div id="big-image-wrapper" class="shadow-block">
                        <?php if (!empty($this->images)) {$bigImage = $this->images[0]['big'][0];} ?>
						<a href="<?php echo $bigImage; ?>" rel="lightbox[product]">							
							<img src="<?php echo $bigImage; ?>" alt="" class="back-img" />
							<span class="zoom"></span>
						</a>
					</div>
				</div>
				<?php if (!empty($this->images) && count($this->images) > 1):?>
				<div class="product_slider">
					<ul class="row product_gallery_thumbs">
						<?php foreach($this->images as $image) :?>
						   <li class="four columns">
								<?php
									$imgsrc = $image['big'][0];
								?>
								 <a href="<?php get_image($imgsrc, 460, 263, 'height'); ?>" alt="<?php echo $imgsrc_big = $image['big'][0]; ?>">
									<img src="<?php echo $image['thumb'][0]; ?>" 
										 width="<?php echo $image['thumb'][1]; ?>"
										 height="<?php echo $image['thumb'][2]; ?>"
										 alt="<?php echo get_the_title();?>" />
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div id="all-prod-images">
					<?php foreach($this->images as $image) :?>
						<?php
							$imgsrc = $image['big'][0];
						?>
						<a href="<?php echo $imgsrc; ?>" rel="lightbox[product]"></a>
					<?php endforeach; ?>
				</div>
				<?php endif;?>
			</div>

			<?php comments_template(); ?>
		</div> 

		<div class="clear"></div>
		<hr />
	<?php if ( is_active_sidebar( 'productwidgets' ) ) { ?>
		<?php dynamic_sidebar( 'productwidgets' ); ?>
	<?php } ?>
	</div>
</div>
