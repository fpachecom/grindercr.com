<?php get_header(); ?>
<div id="main-wrapper" class="product_categories row">  
    <?php require_once (TEMPLATEPATH . '/functions/menu.php'); ?>
    
    <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
    
          <?php the_content('Read more...'); ?>
    
    <?php endwhile; ?>
    <?php else : ?>
         <p><?php lang::_e('Sorry, but nothing found.'); ?></p>
    <?php endif; ?>

<?php get_footer(); ?>