<?php get_header(); ?>

<div id="main-wrapper" class="wp_categories">  
    <?php require_once (TEMPLATEPATH . '/functions/menu.php'); ?>
    
    <h1><?php the_title(); ?></h1>
                           
    <div class="clear"></div>
    
    <div id="sidebar" class="three mobile-four columns nopadding">
        <div class="side-menu">
            <?php if ( is_active_sidebar( 'wpcategories' ) ) : ?>
                <?php dynamic_sidebar( 'wpcategories' ); ?>
            <?php endif; ?>
        </div>
    </div>
    
    <div id="cat_content" class="grid-view nine columns nopadding">
        <div class="product-list single-post">   
            <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                <div class="category_product product-item list row">
                    <div class="product-item-thumb product_main">
                        <a href="<?php the_permalink(); ?>"> <?php echo get_the_post_thumbnail($post->ID, 'entire_cat', array('title' => '')); ?></a>
                    </div>
                    <div class="product-item-info product_info article">
                        <?php the_content(); ?>
                    </div>
                    <div class="clear"></div>
                </div>
            
            <?php endwhile; ?>
            <?php else : ?>
                 <p><?php lang::_e('Sorry, but nothing found.'); ?></p>
            <?php endif; ?>
        </div>
        <div class="clear"></div>
        <a href="#" class="back-to-top"><?php lang::_e('Back to Top'); ?> <img src="<?php echo bloginfo('template_directory').'/img/uarr.png'; ?>" /></a>
    </div>
    <div class="clear"></div>
    <hr />
    
    <?php if ( is_active_sidebar( 'productswidgets' ) ) : ?>
        <?php dynamic_sidebar( 'productswidgets' ); ?>
    <?php endif; ?>
    
<?php get_footer(); ?>