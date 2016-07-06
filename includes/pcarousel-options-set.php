<?php 
/*
 * @link              http://digitalkroy.com/palto-carousel
 * @since             1.0.0
 * @package           Palto carousel wordpress Plugin    
 * description        All jQuery options set here for carousel
 *
 * @  palto-carousel
 */

 if ( ! function_exists( 'palto_carousel_scripts_add' ) ) :
 function palto_carousel_scripts_add(){
  ?>
	<script type="text/javascript">
		(function ($) {
			"use strict";
			$(document).ready(function(){
			<?php
			global $post;
				//Query args
		$args = array(
		'post_type'  		=>	'palto-carousel',
		'posts_per_page' 	=> -1,
		);
	//start WP_Query
	$loop= new WP_Query($args);
			?>
	<?php while ( $loop->have_posts()) :  $loop->the_post();
	$post_ID = $post->ID;
	$palto_autoplay = get_post_meta( get_the_ID(), 'palto_autoplay',true );
	$autoplaySpeed = get_post_meta( get_the_ID(), 'auto_playSpeed',true );
	$pauseOnHover = get_post_meta( get_the_ID(), 'pauseOnHover',true );
	$falto_infinite = get_post_meta( get_the_ID(), 'falto_infinite',true );
	$falto_img_number = get_post_meta( get_the_ID(), 'falto_img_number',true );
	$falto_img_medium = get_post_meta( get_the_ID(), 'falto_img_medium',true );
	$falto_img_tab = get_post_meta( get_the_ID(), 'falto_img_tab',true );
	$falto_imgScroll = get_post_meta( get_the_ID(), 'falto_imgScroll',true );
	$Scrollspeed = get_post_meta( get_the_ID(), 'Scrollspeed',true );
	$drag_mouse = get_post_meta( get_the_ID(), 'drag_mouse',true );
	$falto_arrows = get_post_meta( get_the_ID(), 'falto_arrows',true );
	$arrows_icons = get_post_meta( get_the_ID(), 'arrows_icons',true );
	$arrows_position = get_post_meta( get_the_ID(), 'arrows_position',true );
	$arrows_margin = get_post_meta( get_the_ID(), 'arrows_margin',true );
	$arrows_background = get_post_meta( get_the_ID(), 'arrows_background',true );
	$arrows_backhover = get_post_meta( get_the_ID(), 'arrows_backhover',true );
	$arrows_color = get_post_meta( get_the_ID(), 'arrows_color',true );
	$arrow_color_hover = get_post_meta( get_the_ID(), 'arrow_color_hover',true );
	$falto_dots = get_post_meta( get_the_ID(), 'falto_dots',true );
	$use_lightbox = get_post_meta( get_the_ID(), 'use_lightbox',true );
	$falto_center_mode = get_post_meta( get_the_ID(), 'falto_center_mode',true );
	$falto_centerPadding = get_post_meta( get_the_ID(), 'falto_centerPadding',true );
	$falto_variableWidth = get_post_meta( get_the_ID(), 'falto_variableWidth',true );
	$falto_direction = get_post_meta( get_the_ID(), 'falto_direction',true );
	$falto_CSS3 = get_post_meta( get_the_ID(), 'falto_CSS3',true );
	$falto_fade = get_post_meta( get_the_ID(), 'falto_fade',true );
	$falto_mobilefirst = get_post_meta( get_the_ID(), 'falto_mobilefirst',true );
	$lightbox_effect = get_post_meta( get_the_ID(), 'lightbox_effect',true );

		?>
		$("#palto-slider-<?php echo $post_ID; ?>").slick({
				
				autoplay: <?php if($palto_autoplay=='auto_enable'): ?>true<?php else:?>false<?php endif; ?>,
				<?php if($palto_autoplay=='auto_enable'): ?>
				autoplaySpeed:<?php echo esc_attr($autoplaySpeed); ?>,
				pauseOnHover:<?php if($pauseOnHover=='pause_enable'): ?>true<?php else:?>false<?php endif; ?>,
				<?php endif; ?>
				<?php if($palto_autoplay=='auto_enable'): ?>
				infinite: true,
				<?php else: ?>
				infinite: <?php if($falto_infinite=='infinite_enable'): ?>true<?php else:?>false<?php endif; ?>,
				<?php endif; ?>
				slidesToShow: <?php echo esc_attr($falto_img_number); ?>,
				slidesToScroll: <?php echo esc_attr($falto_imgScroll); ?>,
				speed: <?php echo esc_attr($Scrollspeed); ?>,
				draggable:<?php if($drag_mouse=='enable_dragging'): ?>true<?php else:?>false<?php endif; ?>,
				Transfrom: true,
				cssEase:'<?php echo esc_attr($falto_CSS3); ?>',
				dots: <?php if($falto_dots=='dots_enable'): ?>true<?php else:?>false<?php endif; ?>,
				arrows:<?php if($falto_arrows=='arrows_enable'): ?>true<?php else:?>false<?php endif; ?>,
				mobileFirst:<?php if($falto_mobilefirst): ?>true<?php else:?>false<?php endif; ?>,
				centerMode: <?php if($falto_center_mode=='center_enable'): ?>true<?php else:?>false<?php endif; ?>,
				<?php if($falto_centerPadding): ?>
				centerPadding: '<?php echo esc_attr($falto_centerPadding); ?>px',
				<?php endif; ?>
				variableWidth:<?php if($falto_variableWidth=='variableWidth_enable'): ?>true<?php else:?>false<?php endif; ?>,
				rtl:<?php if($falto_direction=='sliders_Right'): ?>true<?php else:?>false<?php endif; ?>,
				<?php if($falto_direction=='vertical_sliders'): ?>
				vertical:true,
				<?php endif; ?>
				fade: <?php if($falto_fade=='fade_enable'): ?>true<?php else:?>false<?php endif; ?>,
				<?php if($falto_arrows=='arrows_enable'): ?>
				prevArrow:'<button type="button" class="falto-arrow falto-prev-theme<?php echo esc_attr($arrows_position); ?>"><i class="icon-left-<?php echo esc_attr($arrows_icons); ?>"></i></button>',
				nextArrow:'<button type="button" class="falto-arrow falto-next-theme<?php echo esc_attr($arrows_position); ?>"><i class="icon-right-<?php echo esc_attr($arrows_icons); ?>"></i></button>',
				<?php endif; ?>
				   responsive: [{
					 breakpoint: 1170,
					  settings: {
						slidesToShow: <?php echo esc_attr($falto_img_number); ?>,
					  }

					}, {
					 breakpoint: 960,
					  settings: {
						slidesToShow: <?php echo esc_attr($falto_img_medium); ?>,
					  }

					}, {

					  breakpoint: 700,
					  settings: {
						slidesToShow: <?php echo esc_attr($falto_img_tab); ?>,
					  }

					}, {
					 breakpoint: 480,
					settings: {
					arrows: false,
					centerMode: true,
					centerPadding: '40px',
					slidesToShow: 1,
					slidesToScroll: 1,

					 }

					}]
			  });
		$('#palto-slider-<?php echo esc_attr($post_ID); ?>.palto-slider button.falto-arrow').css({'background-color': '<?php echo esc_attr($arrows_background); ?>','color': '<?php echo esc_attr($arrows_color); ?>', 'margin': '<?php echo esc_attr($arrows_margin); ?>px 0'});
$('#palto-slider-<?php echo esc_attr($post_ID); ?>.palto-slider button.falto-arrow').hover(function(){
    $(this).css({'background-color':'<?php echo esc_attr($arrows_backhover); ?>', 'color':'<?php echo esc_attr($arrow_color_hover); ?>'});
	}, function(){
    $(this).css({'background-color':'<?php echo esc_attr($arrows_background); ?>', 'color':'<?php echo esc_attr($arrows_color); ?>'});

});
<?php if($use_lightbox=='lightbox_enable'): ?>	
$('#palto-slider-<?php echo esc_attr($post_ID); ?> .palto-item a').nivoLightbox({ 
    effect: '<?php echo esc_attr($lightbox_effect); ?>',
});
<?php endif; ?>
		<?php endwhile; ?> 
		<?php wp_reset_postdata(); ?>

			  });
		}(jQuery));	
    </script>
<?php 
}
 add_action('wp_footer','palto_carousel_scripts_add',99);
endif;
