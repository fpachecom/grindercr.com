<?php get_header(); ?>
<div id="main-wrapper" class="product_categories row">  
    <?php require_once (TEMPLATEPATH . '/functions/menu.php'); ?>
    
    <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        
        <?php 
            if(!frame::_()->getModule('pages')->isAllProducts())
                if(frame::_()->getModule('pages')->isOrdersList() == false and frame::_()->getModule('pages')->isCart() == false and !frame::_()->getModule('pages')->isCheckoutStep1() == false and !frame::_()->getModule('pages')->isCheckoutStep2() == false and !frame::_()->getModule('pages')->isCheckoutStep3() == false) $class = 'class="article"'; 
        ?>
        <div <?php echo $class; ?>>
            <?php the_content('Read more...'); ?>
        </div>
          
    <?php endwhile; ?>
    <?php else : ?>
         <p><?php lang::_e('Sorry, but nothing found.'); ?></p>
    <?php endif; ?>

<?php get_footer(); ?>