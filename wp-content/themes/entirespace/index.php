<?php get_header(); ?>

<div id="main-wrapper" class="product_categories">  
    <?php require_once (TEMPLATEPATH . '/functions/menu.php'); ?>
    
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
      <h1><?php the_title(); ?></h1>
      <?php the_content('Read more...'); ?>

<?php endwhile; ?>
<?php else : ?>
    <h1><?php lang::_e('Sorry, but nothing found'); ?></h1>
    <p><?php lang::_e('Check page address or try to use search'); ?></p>
<?php endif; ?>

<?php get_footer(); ?>