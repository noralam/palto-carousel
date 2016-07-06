<?php 
/*
 * @link              http://digitalkroy.com/palto-carousel-2/
 * @since             1.0.0
 * @package           Palto carousel wordpress plugin    
 * description        All carousel output by this shortcode
 *
 * @ Palto carousel
 */
 
 
if ( ! function_exists( 'palto_carousel_shortcode' ) ) : 
function palto_carousel_shortcode($atts, $content = null){
global $post;
ob_start();
    $palto_atts = shortcode_atts( array(
        'id'=> '',
    ), $atts );

	//Query args
	$args = array(
		'post_type'  		=>	'palto-carousel',
		'post_status'  		=>	'publish',
		'posts_per_page' 	=> 1,
		 'p'                => $palto_atts['id']
		
	);
	//start WP_Query
	$loop= new WP_Query($args);
	 
?>
	
	<?php if ($loop -> have_posts() ) : ?>
	<?php while ( $loop->have_posts()) :  $loop->the_post();
	$post_ID = $post->ID;
	 // Get the list of files
    $files = get_post_meta( get_the_ID(), 'carousel_img', 1 );
	$image_size = get_post_meta( get_the_ID(), 'select_img_size',true );
	$carousel_margin = get_post_meta( get_the_ID(), 'carousel_margin',true );
	$dots_position = get_post_meta( get_the_ID(), 'dots_position',true );
	$position_border = get_post_meta( get_the_ID(), 'position_border', true );
	$use_lightbox = get_post_meta( get_the_ID(), 'use_lightbox', true );

    $full_border_lenth = get_post_meta( get_the_ID(), 'full_border_lenth', true);
	$falto_direction = get_post_meta( get_the_ID(), 'falto_direction',true );
    $full_border_color = get_post_meta( get_the_ID(), 'full_border_color', true );
	if($position_border=='border_full'){
		$fullborder= 'border:'.$full_border_lenth.'px solid '.$full_border_color;
	}
	else{
		$fullborder= 'border:medium none';
	}
	?>
<div id="palto-slider-<?php echo esc_attr($post_ID); ?>" class="palto-slider palto-dots-<?php echo esc_attr($dots_position); ?>" style="<?php echo esc_attr($fullborder); ?>; margin: <?php echo esc_attr($carousel_margin); ?>px 0px;" <?php if($falto_direction=='sliders_Right'): ?>dir="rtl"<?php endif; ?>>
<?php
    // Loop through them and output an image
    foreach ( (array) $files as $attachment_id => $attachment_url ) {
	    $falto_margin = get_post_meta( get_the_ID(), 'falto_margin', true );
	$position_border = get_post_meta( get_the_ID(), 'position_border', true );
	$img_hover = get_post_meta( get_the_ID(), 'img_hover', true );
    $img_border_lenth = get_post_meta( get_the_ID(), 'img_border_lenth', true);
	$img_light= wp_get_attachment_image_src( $attachment_id,'large' );
    $img_border_color = get_post_meta( get_the_ID(), 'img_border_color', true );
	if($img_hover=='hover_enable'){
	$hover_animation = get_post_meta( get_the_ID(), 'hover_animation', true );
	}
	else{
		$hover_animation = '';
	}
	if($position_border=='border_img'){
		$border= 'border:'.$img_border_lenth.'px solid '.$img_border_color;
	}
	else{
		$border= 'border:medium none';
	}
	if($use_lightbox=='lightbox_enable'){ 
	    echo '	<div class="palto-item '.$hover_animation.'" style="margin:0 '.esc_attr($falto_margin).'px;'.esc_attr($border).'">';
		echo'<a href="'.$img_light[0].'" data-lightbox-gallery="gallery'.$post_ID.'">';
        echo wp_get_attachment_image( $attachment_id, $image_size );
        echo '</a>';
        echo '</div>';
	}else{ 
	   echo '	<div class="palto-item '.$hover_animation.'" style="margin:0 '.esc_attr($falto_margin).'px;'.esc_attr($border).'">';
        echo wp_get_attachment_image( $attachment_id, $image_size );
        echo '</div>';
	}

    }?>

</div>
	<?php endwhile; ?> 

<?php wp_reset_postdata(); ?>
 <?php else: ?>
 <div class="palto-error">
 <h2><?php esc_html_e('No carousel found!','palto'); ?></h2>
 </div>
 <?php endif; ?>

 <?php 
 $galleryBox = ob_get_clean(); 
return $galleryBox;
}
add_shortcode('pcarousel','palto_carousel_shortcode');
endif;
