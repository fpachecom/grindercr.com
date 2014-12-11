<?php  
/*
 * Template Name: Page with Sidebar
 */
?>
<?php get_header(); ?>

<div id="main-wrapper" class="wp_categories row">  
    <?php require_once (TEMPLATEPATH . '/functions/menu.php'); ?>
    
    <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        
        <div id="sidebar" class="three mobile-four columns nopadding">
            <div class="side-menu">
                <?php if ( is_active_sidebar( 'sidebarpage' ) ) : ?>
                    <?php dynamic_sidebar( 'sidebarpage' ); ?>
                <?php endif; ?>
            </div>
        </div>
        
        <div id="cat_content" class="nine columns nopadding"> 
            <div class="article">
                <?php the_content('Read more...'); ?>
            </div>
            <div class="clear"></div>
            <a href="#" class="back-to-top"><?php lang::_e('Back to Top'); ?> <img src="<?php echo bloginfo('template_directory').'/img/uarr.png'; ?>" /></a>
        </div>
        <div class="clear"></div>
    <?php endwhile; ?>
    <?php else : ?>
         <p><?php lang::_e('Sorry, but nothing found.'); ?></p>
    <?php endif; ?>
    
<?php get_footer(); ?>