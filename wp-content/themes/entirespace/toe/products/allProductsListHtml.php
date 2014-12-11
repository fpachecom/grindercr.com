<div id="toeAllProductsPage">  
    
    <div id="sidebar" class="three mobile-four columns nopadding">
        <div class="side-menu">
            <?php if ( is_active_sidebar( 'productcategories' ) ) : ?>
                <?php dynamic_sidebar( 'productcategories' ); ?>
            <?php endif; ?>
        </div>
    </div>
    
    <div id="cat_content" class="nine columns nopadding">
        <?php 
        if(class_exists('frame') && frame::_()->getModule('pagination')) {
            frame::_()->getModule('pagination')->getView()->display(array('nav_id' => 'pagination', 'show' => array('navigation')));
        }?>            
        <div class="cat_controls">        
            <?php lang::_e('View'); ?>: 
            <a href="#" class="change-to-grid-view <?php if($_COOKIE['catalogView'] == 'grid' || $_COOKIE['catalogView'] == null) echo 'current-catalog-view' ?>"><?php lang::_e('Grid'); ?></a>
            <span class="control-spliter">|</span>
            <a href="#" class="change-to-list-view <?php if($_COOKIE['catalogView'] == 'list') echo 'current-catalog-view' ?>"><?php lang::_e('List'); ?></a>
            
            <?php 
            if(class_exists('frame') && frame::_()->getModule('pagination')) {
                frame::_()->getModule('pagination')->getView()->display(array('nav_id' => 'pagination', 'show' => array('ordering')));
            }?>
        </div>
        <div class="clear"></div>
        
        <div class="product-list row">   
            <?php foreach($this->productsContentParts as $pHtml) {
                echo $pHtml;
            }?>
        </div>
        <div class="clear"></div>
        <a href="#" class="back-to-top"><?php lang::_e('Back to Top'); ?> <img src="<?php echo bloginfo('template_directory').'/img/uarr.png'; ?>" /></a>
    </div>
    <div class="clear"></div>
</div>  