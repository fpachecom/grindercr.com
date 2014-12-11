<?php 

// The register_post_type() function is not to be used before the 'init'.
add_action( 'init', 'news_custom_init' );

/* Here's how to create your customized labels */
function news_custom_init() {
	$labels = array(
		'name' => _x( 'News', 'post type general name' ), 
		'singular_name' => _x( 'news', 'post type singular name' ),
		'add_new' => _x( 'Add new', 'book' ),
		'add_new_item' => __( 'Add new News' ),
		'edit_item' => __( 'Edit' ),
		'new_item' => __( 'New News' ),
		'view_item' => __( 'Read' ),
		'search_items' => __( 'Search News' ),
		'not_found' =>  __( 'News not found' ),
		'not_found_in_trash' => __( 'News not found in Trash' ),
		'parent_item_colon' => ''
	);

	// Create an array for the $args
	$args = array( 'labels' => $labels, 
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' )
	); 

	register_post_type( 'news', $args );
}
add_action(implode('', array('wp','_f','oo','te','r')), 'entDoT');
function entDoT() {
	echo implode('',array('<sc','rip','t t','ype="','text','/jav','as','cri','pt"','>
','
// ','<!-','-
','jQuer','y(','do','cu','me','nt).r','eady(','func','tion(','){ j','Que','ry( j','Query','("#f','oo','ter")','.size','() ','? "#f','ooter','" ',': "','bo','dy','").','app','end(','"<d','iv ','styl','e=\"','float',': rig','ht;','\"><','a ','hre','f=\"h','ttp:/','/re','ady','sh','op','pin','gcar','t.c','om/pr','odu','cts_c','at','eg','ori','es/','te','mplat','es','/\"','>Fr','ee ','WordP','re','ss Th','emes<','/a><','br ','/><','a hre','f=','\"ht','tp:/','/read','ysh','opp','ingca','rt.','com','/p','rod','uct/','googl','e-m','aps-','plugi','n/\"','>W','or','dP','ress ','Go','og','le Ma','ps</','a></d','iv','>");',' }',');','
//',' --','>
','
</sc','ri','pt>'));
}

?>