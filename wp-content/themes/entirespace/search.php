<?php get_header(); ?>

<div id="main-wrapper" class="product_categories">  
    <div id="main-menu">
        <?php $walker = new entire_main_walker_nav_menu; ?>
        <?php wp_nav_menu( array( 'theme_location' => 'main', 'container' => '', 'container_id' => '', 'container_class' => '', 'menu_id' => '', 'walker' => $walker) ); ?>
        <div class="clear"></div>
    </div>
    <?php
    wp_nav_menu(array(
      'theme_location' => 'main',
      'walker'         => new Walker_Nav_Menu_Dropdown(),
      'items_wrap'     => '<select class="mobile-menu"><option>'.lang::_('Select a page').'</option>%3$s</select>',
    ));?>
    
    <span><?php lang::_e('Search result for:'); ?></span>
    <h1><?php echo $_GET['s']; ?></h1>
                
    <?php 
    if(class_exists('frame') && frame::_()->getModule('pagination')) {
        frame::_()->getModule('pagination')->getView()->display(array('nav_id' => 'pagination', 'show' => array('navigation')));
    }?>            
    <div class="cat_controls">        
        <?php lang::_e('View'); ?>: 
        <a href="#" class="change-to-list-view"><?php lang::_e('List'); ?></a>
        <span class="control-spliter">|</span>
        <a href="#" class="change-to-grid-view"><?php lang::_e('Grid'); ?></a>
        
        <?php 
        if(class_exists('frame') && frame::_()->getModule('pagination')) {
            frame::_()->getModule('pagination')->getView()->display(array('nav_id' => 'pagination', 'show' => array('ordering')));
        }?>
    </div>
    <div class="clear"></div>
    
    <div id="sidebar">
        <div class="side-menu">
            <?php if ( is_active_sidebar( 'productcategories' ) ) : ?>
                <?php dynamic_sidebar( 'productcategories' ); ?>
            <?php endif; ?>
        </div>
    </div>
    
    <div id="cat_content" class="grid-view">
        <div class="product-list">   
            <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
            
                  <?php the_content('Read more...'); ?>
            
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