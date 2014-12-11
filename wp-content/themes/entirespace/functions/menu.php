<?php 
/* 
 * This is site menu, just including in pages.
 */
?>
 <div id="main-menu">
    <?php if (mf_get_menu_name('main') != '') $walker = new entire_main_walker_nav_menu; else $walker = ''; ?>
    <?php wp_nav_menu( array( 'theme_location' => 'main', 'container' => '', 'container_id' => '', 'container_class' => '', 'menu_id' => '', 'fallback_cb' => 'wp_page_menu', 'walker' => $walker) ); ?>
    <div class="clear"></div>
</div>

<?php
if (mf_get_menu_name('main') != ''){
    wp_nav_menu(array(
      'theme_location' => 'main',
      'walker'         => new Walker_Nav_Menu_Dropdown(),
      'fallback_cb' => 'wp_page_menu',
      'items_wrap'     => '<select class="mobile-menu"><option value="">'.lang::_('Select a page').'</option>%3$s</select>',
    ));
}?>