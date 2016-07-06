<?php 
/**
 * Register palto carousel post type. 
 * This is administrator only post type. 
 *
 * @link              http://digitalkroy.com/palto-carousel
 * @since             1.0.0
 * @package           palto-carousel
 *
 * @wordpress-plugin
 */
 
 if ( ! function_exists( 'palto_carousel_post_type' ) ) :
function palto_carousel_post_type() {
	$labels = array(
		'name'               => __( 'carousels','palto' ),
		'singular_name'      => __( 'carousel','palto' ),
		'menu_name'          => __( 'Palto carousel','palto' ),
		'name_admin_bar'     => __( 'Palto carousel','palto' ),
		'add_new'            => __( 'Add New carousel','palto' ),
		'add_new_item'       => __( 'Add New carousel','palto' ),
		'new_item'           => __( 'New carousel', 'palto' ),
		'edit_item'          => __( 'Edit carousel', 'palto' ),
		'view_item'          => __( 'View carousel', 'palto' ),
		'all_items'          => __( 'All carousel', 'palto' ),
		'parent_item_colon'  => __( 'Parent carousel:', 'palto' ),
		'not_found'          => __( 'No carousel found.', 'palto' ),
		'not_found_in_trash' => __( 'No carousel found in Trash.', 'palto' ),
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'You can create awesome image carousels with by palto carousel.', 'palto' ),
		'public'             => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => false,
		'rewrite'            => array( 'slug' => 'palto-carousel' ),
		'capabilities' => array(
          'edit_post'          => 'edit_carousel', 
		  'read_post'          => 'read_carousels', 
		  'delete_post'        => 'delete_carousel', 
		  'delete_posts'       => 'delete_carousels', 
		  'edit_posts'         => 'edit_carousels', 
		  'edit_others_posts'  => 'edit_others_carousels', 
		  'publish_posts'      => 'publish_carousels',       
		  'read_private_posts' => 'read_private_carousels', 
		  'create_posts'       => 'create_carousels',
		),
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => 25,
		'menu_icon' => 'dashicons-tickets-alt',
		'supports'           => array( 'title')
	);

	register_post_type( 'palto-carousel', $args );

}
 add_action( 'init', 'palto_carousel_post_type' );
 endif;
 
 
/**
 * palto Carousel update messages.
 *
 *
 */
 if ( ! function_exists( 'palto_carousel_updated_messages' ) ) :
function palto_carousel_updated_messages( $messages ) {
	global $post;
    $post_ID = $post->ID;
	$post             = get_post();
	$post_type        = get_post_type( $post );
	$post_type_object = get_post_type_object( $post_type );
	$pcarousel_shortcode = '[pcarousel id="'.$post_ID.'"]';
	$messages['palto-carousel'] = array(
		0  => '', // Unused. Messages start at index 1.
		1  => __('Carousel updated. Shortcode is:','palto').'<input style="min-width:165px" type=\'text\' onClick=\'this.setSelectionRange(0, this.value.length)\' value=\''.$pcarousel_shortcode.'\' />',
		2  => __( 'Carousel field updated. Shortcode is:', 'palto').'<input style="min-width:165px" type=\'text\' onClick=\'this.setSelectionRange(0, this.value.length)\' value=\''.$pcarousel_shortcode.'\' />',
		3  => __( 'Carousel field deleted.', 'palto' ),
		4  => __( 'Carousel item updated.', 'palto' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Carousel restored to revision from %s', 'palto' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6  =>  __('Carousel published. Shortcode is:','palto').'<input style="min-width:165px" type=\'text\' onClick=\'this.setSelectionRange(0, this.value.length)\' value=\''.$pcarousel_shortcode.'\' />',
		7  => __( 'Carousel saved.', 'palto' ).'<input style="min-width:165px" type=\'text\' onClick=\'this.setSelectionRange(0, this.value.length)\' value=\''.$pcarousel_shortcode.'\' />',
		8  => __( 'Carousel submitted.', 'palto' ).'<input style="min-width:165px" type=\'text\' onClick=\'this.setSelectionRange(0, this.value.length)\' value=\''.$pcarousel_shortcode.'\' />',
		9  => sprintf(
			__( 'Carousel item scheduled for: <strong>%1$s</strong>.', 'palto' ),
			// translators: Publish box date format, see http://php.net/date
			date_i18n( __( 'M j, Y @ G:i', 'palto' ), strtotime( $post->post_date ) )
		),
		10 => __( 'Carousel draft updated.', 'palto' )
	);


	return $messages;
}
add_filter( 'post_updated_messages', 'palto_carousel_updated_messages' );
 endif;

// palto carousel all item column set
function palto_carousel_image_count_admin_column($post_ID) {
    $palto_carousel_count = get_post_meta($post_ID, 'carousel_img', true); 
    if ($palto_carousel_count) {
        $total_images_count = count( $palto_carousel_count );
        return $total_images_count;
    }
}

add_filter('manage_palto-carousel_posts_columns', 'palto_carousel_shortcode_column_head', 10);
add_action('manage_palto-carousel_posts_custom_column', 'palto_carousel_column_content', 10, 2);
function palto_carousel_shortcode_column_head($defaults) {
    $defaults['shortcode_generate'] = 'Carousel Shortcode';
    $defaults['carousel_images'] = 'Carousel Images';
    return $defaults;
}
function palto_carousel_column_content($column_name, $post_ID) {
    if ($column_name == 'shortcode_generate') {
        $ug_img_count = palto_carousel_image_count_admin_column($post_ID);
        $shortcode_render = '[pcarousel id="'.$post_ID.'"]';
        
        if($ug_img_count < 1) {
        echo 'Shortcode will appear when you upload images.';
        } else {
        echo '<input style="min-width:210px" type=\'text\' onClick=\'this.setSelectionRange(0, this.value.length)\' value=\''.$shortcode_render.'\' />';
        }
    }
    if ($column_name == 'carousel_images') {
        $ug_img_count = palto_carousel_image_count_admin_column($post_ID);
        if ($ug_img_count) {
                $img_upload_txt = __(' image uploaded.','palto');
          
            echo esc_html($ug_img_count.$img_upload_txt);
        } else {
		    $img_noupload_txt = __(' No image uploaded!','palto');
           echo esc_html($img_noupload_txt);
        }
    }
}

/**
 *add palto carousel administrator role
 *
 *
 */
if ( ! function_exists( 'palto_carousel_admin_role' ) ) :
function palto_carousel_admin_role() {
    // gets the administrator role
    $admins = get_role( 'administrator' );

    $admins->add_cap( 'edit_carousel' ); 
    $admins->add_cap( 'read_carousels' ); 
    $admins->add_cap( 'delete_carousel' ); 
    $admins->add_cap( 'delete_carousels' ); 
    $admins->add_cap( 'edit_carousels' ); 
    $admins->add_cap( 'edit_others_carousels' ); 
    $admins->add_cap( 'publish_carousels' ); 
    $admins->add_cap( 'read_private_carousels' ); 
    $admins->add_cap( 'create_carousels' ); 
}
add_action( 'admin_init', 'palto_carousel_admin_role');
endif;
/**
 *Remove palto carousel administrator role
 *
 *
 */
if ( ! function_exists( 'palto_carousel_admin_role_remove' ) ) :
function palto_carousel_admin_role_remove() {
    // gets the administrator role
    $admins = get_role( 'administrator' );
	$admins->remove_cap( 'edit_carousel' ); 
    $admins->remove_cap( 'read_carousels' ); 
    $admins->remove_cap( 'delete_carousel' ); 
    $admins->remove_cap( 'delete_carousels' ); 
    $admins->remove_cap( 'edit_carousels' ); 
    $admins->remove_cap( 'edit_others_carousels' ); 
    $admins->remove_cap( 'publish_carousels' ); 
    $admins->remove_cap( 'read_private_carousels' ); 
    $admins->remove_cap( 'create_carousels' ); 
}
endif;
/**
 * Change palto carousel title placeholder
 *
 *
 */
if ( ! function_exists( 'palto_carousel_title_text' ) ) :
function palto_carousel_title_text( $title ){
     $screen = get_current_screen();
 
     if  ( 'palto-carousel' == $screen->post_type ) {
          $title = __('Enter carousel name','palto');
     }
 
     return $title;
}
 
add_filter( 'enter_title_here', 'palto_carousel_title_text' );
endif;