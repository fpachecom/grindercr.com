<?php
// Activation plugin theme part
add_action( 'after_switch_theme', 'entire_space_theme_setup' ); 
function entire_space_theme_setup() {
if(class_exists('frame')) {
        frame::_()->getModule('options')->getModel('')->put(array('code' => 'default_theme', 'value' => 'entire_space'));
    }
}

// widget code here

/*
 * Adding Custom Widget Set on Theme activation
 * $sidebarSlug - Sidebar Slug Name
 * $widgetSlug - Widget Slug Name in lowercase!
 * $countMod - use 0, if you want add only one copy of widget, if you adding same widget second time use 1, third time - use 2
 * $widgetSettings - this is associative array of widget settings
 */
function addWidgetToSidebar($sidebarSlug, $widgetSlug, $countMod, $widgetSettings = array()){   
    $sidebarOptions = get_option('sidebars_widgets');
    if(!isset($sidebarOptions[$sidebarSlug])){
        $sidebarOptions[$sidebarSlug] = array('_multiwidget' => 1);
    }
    $newWidget = get_option('widget_'.$widgetSlug);
    if(!is_array($newWidget))$newWidget = array();
    $count = count($newWidget)+1+$countMod;
    $sidebarOptions[$sidebarSlug][] = $widgetSlug.'-'.$count;
    
    // widget settings
    $newWidget[$count] = $widgetSettings;
    
    update_option('sidebars_widgets', $sidebarOptions);
    update_option('widget_'.$widgetSlug, $newWidget);
}

$checkWidgets = get_option('theme_entirespace_widgets');
if($checkWidgets != 'set'){
    update_option('sidebars_widgets', '');
    addWidgetToSidebar('cart', 'toeshoppingcartwidget', 0);
    addWidgetToSidebar('currency', 'toecurrencywidget', 0);
    addWidgetToSidebar('categoryimage', 'toebcwidget', 0, array('title' => '', 'list' => 'products_categories', 'view' => '1'));
    addWidgetToSidebar('productswidgets', 'toemostviewedwidget', 0, array('title' => 'Most Popular', 'number_of_products' => '10', 'show_price' => '1'));
    addWidgetToSidebar('productswidgets', 'toefpwidget', 0, array('title' => 'Featured Products', 'number_of_products' => '10', 'show_price' => '1'));
    addWidgetToSidebar('productcategories', 'toebcwidget', 1, array('title' => '', 'list' => 'products_categories', 'view' => '0'));
    addWidgetToSidebar('productwidgets', 'toemostviewedwidget', 1, array('title' => 'Most Popular', 'number_of_products' => '10', 'show_price' => '1'));
    addWidgetToSidebar('alsopurchased', 'toealsopurchasedwidget', 0, array('title' => 'You also purchased this', 'number_of_products' => '3', 'show_price' => '1'));
    addWidgetToSidebar('footerwidgets', 'toecommentswidget', 0, array('title' => 'Latest Reviews', 'order' => 'recent', 'number_of_comments' => '3', 'comment_len' => '100', 'show_product_link' => '1'));
    addWidgetToSidebar('footerwidgets', 'toetwitterwidget', 0, array('title' => 'Twitter', 'username' => 'ReadyEcommerceW', 'count' => '5'));
    addWidgetToSidebar('wpcategories', 'categories', 0, array('title' => 'Categories'));
    addWidgetToSidebar('breadcrumbs', 'toebrcwidget', 0, array('title' => 'Home'));
    
    update_option('theme_entirespace_widgets', 'set');
    update_option('posts_per_page', 12); // set 12 items per page in catalog
	
	/**
		*Activate notice
	*/
	update_option('hideDummyDataInstallNotice', false);
	update_option('wasDummyProductsInstalled', false);
	
}

function get_image($src, $width, $height, $mode) {
    switch ($mode){
        case 'width': echo uri::_(array('baseUrl' => $src, 'w' => $width)); break;
        case 'height': echo uri::_(array('baseUrl' => $src, 'h' => $height)); break;
        case 'both': echo uri::_(array('baseUrl' => $src, 'w' => $width, 'h' => $height)); break;
        default: echo uri::_(array('baseUrl' => $src, 'w' => $width, 'h' => $height)); break;
    }
}

// admin settings
require_once (TEMPLATEPATH . '/functions/admin-menu.php');

//include Foundation Framework options
require_once (TEMPLATEPATH . '/functions/foundation/nav-walkers.php');

// including slider to admin page
//require_once (TEMPLATEPATH . '/functions/admin_slider/index.php');
require_once (TEMPLATEPATH . '/functions/admin_responsive_slider/index.php');

// include live settings
if(get_option('espace_live_settings') == 'on') require_once (TEMPLATEPATH . '/functions/livesettings/live-settings.php');

require_once (TEMPLATEPATH . '/functions/custom-post-type.php');

// Add new image size in WP Uploader popup window
function true_get_the_sizes() {
   $s = array('');
   global $_wp_additional_image_sizes;
   if ( isset($_wp_additional_image_sizes) && count($_wp_additional_image_sizes) ) {
       $s = apply_filters( 'intermediate_image_sizes', $_wp_additional_image_sizes );
       $s = apply_filters( 'true_get_the_sizes', $_wp_additional_image_sizes );
   }
   return $s;
}
 
function true_sizes_input_fields( $fields, $post ) {
   if ( !isset($fields['image-size']['html']) || substr($post->post_mime_type, 0, 5) != 'image' )
       return $fields;
 
   $s = true_get_the_sizes();
   if ( !count($s) )
       return $fields;
 
   $items = array();
   foreach ( array_keys($s) as $size ) {
       $l = apply_filters( 'img_sz_name', $size );
       $element_id = "image-size-{$size}-{$post->ID}";
       $ds = image_downsize( $post->ID, $size );
       $enabled = $ds[3];
       $html = "<div class='image-size-item'>\n";
       $html .= "\t<input type='radio' " . disabled( $enabled, false, false ) . "name='attachments[{$post->ID}][image-size]' id='{$element_id}' value='{$size}' />\n";
       $html .= "\t<label for='{$element_id}' style='margin:0 0 0 2px;'>{$l}</label>\n";
       if ( $enabled )
           $html .= "\t<label for='{$element_id}' class='help'>" . sprintf( "(%d&nbsp;&times;&nbsp;%d)", $ds[1], $ds[2] ). "</label>\n";
       $html .= "</div>";
       $items[] = $html;
   }
 
   $items = join( "\n", $items );
   $fields['image-size']['html'] = "{$fields['image-size']['html']}\n{$items}";
 
   return $fields;
}
 
add_filter( 'attachment_fields_to_edit', 'true_sizes_input_fields', 11, 2 );

add_image_size( 'Slider', 1010, 400, true );

// including home slider
function ready_slider(){
    $data = get_option(OPTIONS);
    $slides = $data['ready_slider'];
    if (!empty($slides)){
?>

<div id="startslider"  class="evoslider default">
    <dl>
        <?php 
        foreach ($slides as $slide => $value) {?>
            <dt><?php echo $value['title']?></dt>
            <dd data-src="<?php echo $value['url']; ?>" data-text="overlay"<?php if($value['link'] != '') {?> data-url="<?php echo $value['link']; ?>" <?php }?>>
                <?php if($value['description'] != '') {?><div class="evoText"><?php echo $value['description']; ?></div><?php }?>
            </dd>
        <?php }?>
    </dl>
</div>
<script type="text/javascript">
$(document).ready(function(){
    startcommerceSlider = jQuery("#startslider").evoSlider({
        mode:"<?php echo $data['mode']?>",
        speed: <?php if($data['speed'] != '') {echo $data['speed'];} else {echo '500';}?>,
        interval: <?php if($data['interval'] != '') {echo $data['interval'];} else {echo '3000';}?>,
        pauseOnHover: <?php echo $data['pauseOnHover'] ? 'true' : 'false'?>,
        showPlayButton: <?php echo $data['showPlayButton'] ? 'true' : 'false'?>,
        directionNav: <?php echo $data['directionNav'] ? 'true' : 'false'?>,                 // Shows directional navigation when initialized
        directionNavAutoHide: <?php echo $data['directionNavAutoHide'] ? 'true' : 'false'?>,        // Shows directional navigation on hover and hide it when mouseout
        width: <?php if($data['width'] != '') {echo $data['width'];} else {echo '1010';}?>,
        height: <?php if($data['height'] != '') {echo $data['height'];} else {echo '400';}?>,
        <?php if($data['slideSpace'] != '') {echo 'slideSpace:'.$data['slideSpace'].',';} ?>                      // The space between slides
        <?php if($data['paddingRight'] != '') {echo 'paddingRight:'.$data['paddingRight'].',';} ?> // Padding right of the container/frame
        titleClockWiseRotation: <?php echo $data['directionNavAutoHide'] ? 'true' : 'false'?>,      // Rotates title bar by clock wise
        hideCurrentTitle: <?php echo $data['hideCurrentTitle'] ? 'true' : 'false'?>,            // Hides active title bar
        <?php if($data['startIndex'] != '') {echo 'startIndex:'.$data['startIndex'].',';} ?> // Start index when initialized
        showIndex: true,                    // Displays index in toggle icon and bullets control
        mouse: false,                        // Enables mousewheel scroll navigation
        keyboard: true,                     // Enables keyboard navigation (left and right arrows)
        easing: "swing",                    // Defines the easing effect mode
        loop: true,                         // Rotate slideshow
        lazyLoad: <?php echo $data['lazyLoad'] ? 'true' : 'false'?>,                    // Enables lazy load feature
        autoplay: true,                     // Sets EvoSlider to play slideshow when initialized
        pauseOnClick: true,                 // Stop slideshow if playing
        playButtonAutoHide: <?php echo $data['playButtonAutoHide'] ? 'true' : 'false'?>,          // Shows play/pause button on hover and hide it when mouseout
        toggleIcon: true,                   // Enables toggle icon
        showDirectionText: <?php echo $data['showDirectionText'] ? 'true' : 'false'?>,           // Shows text on direction navigation
        nextText: "<?php echo $data['nextText']?>",                   // Next button text
        prevText: "<?php echo $data['prevText']?>",                   // Prev button text
        controlNav: <?php echo $data['controlNav']?>,                   // Enables control navigation
        controlNavMode: "<?php echo $data['controlNavMode']?>",          // Sets control navigation mode ("bullets", "thumbnails", or "rotator")
        controlNavVertical: <?php echo $data['controlNavVertical'] ? 'true' : 'false'?>,          // Defines control navigation to display vertically
        controlNavPosition: "<?php echo $data['controlNavPosition']?>",       // Sets control navigation position ("inside" or "outside")
        controlNavVerticalAlign: "<?php echo $data['controlNavVerticalAlign']?>",   // Sets position of the vertical control navigation ("left" or "right")
        <?php if($data['controlSpace'] != '') {echo 'controlSpace:'.$data['controlSpace'].',';} ?>  // The space between outside control navigation with slides                 
        controlNavAutoHide: <?php echo $data['controlNavAutoHide'] ? 'true' : 'false'?>,          // Shows control navigation on mouseover and hide it when mouseout
        showRotatorTitles: true,            // Shows rotator titles
        showRotatorThumbs: true,            // Shows rotator thumbnails
        rotatorThumbsAlign: "<?php echo $data['rotatorThumbsAlign']?>",         // Thumbnails float position
        classBtnNext: "<?php if ($data['classBtnNext'] != '') {echo $data['classBtnNext'];} else {echo 'evo_next';}?>",           // The CSS class used for the next button
        classBtnPrev: "<?php if ($data['classBtnPrev'] != '') {echo $data['classBtnPrev'];} else {echo 'evo_prev';}?>",           // The CSS class used for the next button
        classExtLink: "<?php if ($data['classExtLink'] != '') {echo $data['classExtLink'];} else {echo 'evo_link';}?>",           // The CSS class used for the next button
        permalink: <?php echo $data['permalink'] ? 'true' : 'false'?>,                   // Enable or disable linking to slides via the url
        autoHideText: <?php echo $data['autoHideText'] ? 'true' : 'false'?>,                // Shows overlay text on mouseover and hide it on mouseout    
        outerText: <?php echo $data['outerText'] ? 'true' : 'false'?>,                   // Enables outer text
        outerTextPosition: "<?php echo $data['outerTextPosition']?>",         // Outer text align ("left" or "right")
        <?php if($data['outerTextSpace'] != '') {echo 'outerTextSpace:'.$data['outerTextSpace'].',';} ?>  // Space between text and slide
        linkTarget: "<?php echo $data['linkTarget']?>",               // The target attribute of the image link ("_blank", "_parent", "_self", or "_top")
        responsive: <?php echo $data['responsive'] ? 'true' : 'false'?>,                  // Enables responsive layout
        imageScale: "<?php echo $data['imageScale']?>"            // Sets image scale option ("fullSize", "fitImage", "fitWidth", "fitHeight", "none")                
    });
});
</script>

<?php    
    }
} // end Slider

// Responsive slider
function ready_responsive_slider(){
    $data = get_option(OPTIONS);
    $slides = $data['ready_responsive_slider'];
    if (!empty($slides)){
?>

<?php foreach ($slides as $slide => $value) {?>
    <a href="<?php echo $value['link']; ?>">
        <?php if($value['url'] != '') {?><img src="<?php echo $value['url']; ?>" alt="<?php echo $value['title']; ?>" /><?php }?>
    </a>
<?php }?>

<!--<div class="flexslider">
    <ul class="slides">
        <?php 
        foreach ($slides as $slide => $value) {?>
            <li>
                <a href="<?php echo $value['link']; ?>">
                    <?php if($value['url'] != '') {?><img src="<?php echo $value['url']; ?>" alt="<?php echo $value['title']; ?>" /><?php }?>
                </a>
                <?php if($value['description'] != ''): ?>
                <p class="flex-caption"><?php echo $value['description']; ?></p>
                <?php endif; ?>
            </li>
        <?php }?>
    </ul>
</div>-->
<script type="text/javascript">
    $(window).load(function() {
        $('#slider').orbit({ 
            fluid: '16x6'
        });
        /*
        $('.flexslider').flexslider({
            animation:"<?php echo $data['animation']?>",
            direction:"<?php echo $data['direction']?>",
            slideshowSpeed:"<?php if ($data['slideshowspeed'] != ''){ echo $data['slideshowspeed'];} else {echo '3000';} ?>",
            animationSpeed:"<?php if ($data['animationspeed'] != ''){ echo $data['animationspeed'];} else {echo '600';} ?>",
            randomize:"<?php echo $data['randomize'] ? 'true' : 'false'?>"
        });
        */
    });
</script>
<?php    
    }
} // end Responsive Slider

add_theme_support( 'post-thumbnails' );		
add_image_size( 'news', 431, 217, true );
add_image_size( 'entire_cat', 158, 158, true );
add_image_size( 'entire_image_category', 220, 130, true );
remove_action('wp_head','wp_generator');

// Navigations
register_nav_menus(array(
    'main' => __('Main menu')
));

/**
 * Register our sidebars and widgetized areas. 
 */
function entire_space_widgets_init() {

    register_sidebar( array(
		'name' => lang::_( 'Cart'),
		'id' => 'cart',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );

    register_sidebar( array(
		'name' => lang::_( 'Currency' ),
		'id' => 'currency',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );
    
    register_sidebar( array(
		'name' => lang::_( 'Images category on Home page' ),
		'id' => 'categoryimage',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );
    
    register_sidebar( array(
		'name' => lang::_( 'Products Widgets on Home page' ),
		'id' => 'productswidgets',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );
    
    register_sidebar( array(
		'name' => lang::_( 'Product Categories' ),
		'id' => 'productcategories',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );
    
    register_sidebar( array(
		'name' => lang::_( 'Products Widgets on Product Page' ),
		'id' => 'productwidgets',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );
    
    register_sidebar( array(
		'name' => lang::_( 'AlsoPurchased Widget on Product Page' ),
		'id' => 'alsopurchased',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );
    
    register_sidebar( array(
		'name' => lang::_( 'Wordpress Categories Page Widgets' ),
		'id' => 'wpcategories',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	) );
    
    register_sidebar( array(
		'name' => lang::_( 'Widgets for Page with sidebar' ),
		'id' => 'sidebarpage',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );
    
    register_sidebar( array(
		'name' => lang::_( 'Footer Widgets' ),
		'id' => 'footerwidgets',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h2>',
		'after_title' => '</h2><hr class="wave-line" /><div class="clear"></div>',
	) );
    
    register_sidebar( array(
		'name' => lang::_( 'Breadcrumbs' ),
		'id' => 'breadcrumbs',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );

}
add_action( 'widgets_init', 'entire_space_widgets_init' );  

function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>" class="comment-block">
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php lang::_e('Your comment is awaiting moderation.') ?></em>
      <?php endif; ?>
      <strong><?php printf( '<span class="fn">%s</span>', get_comment_author_link() ); ?></strong>
      <?php comment_text() ?> 
     </div>
   </li>
<?php
}

// checking for menus
function mf_get_menu_name($location){
    if(!has_nav_menu($location)) return false;
    $menus = get_nav_menu_locations();
    $menu_title = wp_get_nav_menu_object($menus[$location])->name;
    return $menu_title;
}

// new menu walker
class entire_main_walker_nav_menu extends Walker_Nav_Menu {
  
    // add classes to ul sub-menus
    function start_lvl( &$output, $depth ) {
        // depth dependent classes
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array(
            'sub-menu',
            ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
            'menu-depth-' . $display_depth
            );
        $class_names = implode( ' ', $classes );
      
        // build html
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }
 
    // add main/sub classes to li's and links
    function start_el( &$output, $item, $depth, $args ) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
      
        // depth dependent classes
        $depth_classes = array(
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
      
        // passed classes
        //$classes = empty( $item->classes ) ? array() : (array) $item->classes;
        //$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
      
        // build html
        $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';
      
        // link attributes
        $attributes = ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
      
        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            apply_filters( 'the_title', $item->title, $item->ID ),
            $args->link_after,
            $args->after
        );
      
        // build html
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}
?>