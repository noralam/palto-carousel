<?php 
/**
 * Add custom button in TinyMCE  editor for Palto carousel shortcode.
 *
 * Author URI:        http://codecanyon.net/user/expert-wp
 * @since             1.0.0
 * @package           Palto carousel wordpress plugin
 */

// Hooks functions into the correct filters
if ( ! function_exists( 'palto_carousel_mce_button' ) ) :
function palto_carousel_mce_button() {
	// check administrator
	if ( !current_user_can( 'administrator' ) ) {
		return;
	}
	// check if WYSIWYG is enabled
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'palto_carousel_mce_button_scripts' );
		add_filter( 'mce_buttons', 'palto_carousel_tinymce_register' );
	}
}
add_action('admin_head', 'palto_carousel_mce_button');
endif;
// Declare script for new button
if ( ! function_exists( 'palto_carousel_mce_button_scripts' ) ) :
function palto_carousel_mce_button_scripts( $plugin_array ) {
    	$plugin_array['my_mce_button'] = plugins_url( '/../assets/js/admin-mce-button.js', __FILE__ );
		return $plugin_array;

}
endif;
// Register new button in the editor
if ( ! function_exists( 'palto_carousel_tinymce_register' ) ) :
function palto_carousel_tinymce_register( $buttons ) {
	array_push( $buttons, 'my_mce_button' );
	return $buttons;
}
endif;
// Add gallery post id dynamical in TinyMCE editor custom button
if ( ! function_exists( 'palto_carousel_tinymce_shortcode_list_id' ) ) :
function palto_carousel_tinymce_shortcode_list_id(){
    $gposts =  get_posts(array(
	'post_type'   => 'palto-carousel',
    'post_status'      => 'publish',
	'posts_per_page'   => -1,
	'suppress_filters' => true
));
        $tinyMCE_list = array();
		$count=1;
		if($gposts) :
        foreach ($gposts as $gpost) :
			$post_ID = $gpost->ID;
			if(!empty($gpost->post_title)){
			$post_title = $gpost->post_title;
			}else{ 
			$post_title = 'Untitled carousel id -'.$post_ID ;
			}
            $tinyMCE_list[] = array( 'text' => $post_title , 'value' => '[pcarousel id="'.$post_ID.'"]' );
        endforeach;
		else:
		$tinyMCE_list[] = array( 'text' => __('No carousel found','palto') , 'value' => '' );
		endif;
        $jscode = $tinyMCE_list; 
		 if (is_admin()) {
        ?>
        <script type="text/javascript">
        var post_id = <?php echo json_encode($jscode); ?>
        </script>
        <?php
		}

        
    
}
foreach ( array('post.php','post-new.php') as $hook ) {
     add_action( "admin_head-$hook", 'palto_carousel_tinymce_shortcode_list_id' );
}
endif;
