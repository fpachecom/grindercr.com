<?php get_header(); ?>
<div id="main-wrapper" class="home-page row">
    <div id="slider">
        <?php ready_responsive_slider(); ?>
    </div>
    
    <?php require_once (TEMPLATEPATH . '/functions/menu.php'); ?>
    
    <div class="clear"></div>
    <?php if ( is_active_sidebar( 'categoryimage' ) ) : ?>
        <?php dynamic_sidebar( 'categoryimage' ); ?>
    <?php endif; ?>
    
    <?php 
    $query = new WP_Query('post_type=news&showpost=1');
    while($query->have_posts()){ $query->the_post(); ?> 
        <div class="home-news row">
            <hr />
            <div class="news row">
                <div class="news-article six columns mobile-four">
                    <h3 class="news-title"><?php the_title(); ?></h3>
                    <div class="news-excerpt">
                        <?php the_excerpt(); ?> <a href="<?php the_permalink(); ?>"><?php lang::_e('Read More'); ?></a>
                    </div>
                </div>
                <div class="news-image-wrapper six columns mobile-four">
                    <div class="news-image">
                        <?php echo get_the_post_thumbnail($post->ID, 'news'); ?>
                        <div class="zoom"><a href="<?php the_permalink(); ?>"></a></div>
                        <span class="news-image-title">
                            <?php the_title(); ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div><!-- End Home News -->
        <hr />
    <?php } ?>  
    <?php wp_reset_postdata(); ?> 
        
    <?php if ( is_active_sidebar( 'productswidgets' ) ) : ?>
        <?php dynamic_sidebar( 'productswidgets' ); ?>
    <?php endif; ?>
    
<?php get_footer(); ?>