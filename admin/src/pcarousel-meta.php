<?php
/**
 * Include and setup custom metaboxes and fields. 
 *
 * @link              http://digitalkroy.com/palto-carousel
 * @since             1.0.0
 * @package           palto-carousel
 *
 * @wordpress-plugin
 */

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}
if ( ! function_exists( 'palto_carousel_meta_options' ) ) :
add_action( 'cmb2_init', 'palto_carousel_meta_options' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function palto_carousel_meta_options() {

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$palto_carousel = new_cmb2_box( array(
		'id'            => '_carousel_metabox',
		'title'         => __( 'Palto carousel', 'palto' ),
		'object_types'  => array( 'palto-carousel', ), // Post type
		// 'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		//'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );

	$palto_carousel->add_field( array(
		'name'         => __( 'Add carousel images', 'palto' ),
		'desc'         => __( 'Upload or add carousel images for create carousel.', 'palto' ),
		'id'           => 'carousel_img',
		'type'         => 'file_list',
		'preview_size' => array( 100, 100 ), 
		'text' => array(
        'add_upload_files_text' => __('Add your carousel images','palto')
    )
	) );

	$palto_carousel->add_field( array(
		'name'             => __( 'Select image size', 'palto' ),
		'desc'             => __( 'Select image size as you need.', 'palto' ),
		'id'               => 'select_img_size',
		'type'             => 'pw_select',
		'default'             => 'medium',
		'options'          => array(
			'medium'   => __( ' Medium (300px x 300px )  ', 'palto' ),
			'xmedium'   => __( ' Extra medium (450px x 450px )  ', 'palto' ),
			'thumbnail' => __( 'Thumbnail (150px x 150px hard cropped)  ', 'palto' ),
			'large' => __( 'Large (1024px x 1024px max height 1024px)', 'palto' ),
			'full'     => __( 'Full (original size uploaded)', 'palto' ),
		),
	) );
	$palto_carousel->add_field( array(
		'name'             => __( 'Carousel top bottom margin', 'palto' ),
		'desc'             => __( 'Set your carousel top bottom margin here.', 'palto' ),
		'id'               => 'carousel_margin',
	'type'        => 'own_slider',
	'min'         => '0',
	'max'         => '100',
	'default'     => '20', // start value
	'value_label' => __('Margin px:','palto'),
	) );

	$palto_carousel->add_field( array(
		'name'    => __( 'Auto play', 'palto' ),
		'desc'    => __( 'You can hide or active auto play.default auto play true', 'palto' ),
		'id'      => 'palto_autoplay',
		'type'    => 'radio_inline',
		'default'    => 'auto_enable',
		'options' => array(
			'auto_enable' => __( 'Enable', 'palto' ),
			'auto_disable' => __( 'disable', 'palto' ),
		),
	) );
	$palto_carousel->add_field( array(
	'name' => __( 'Set auto play speed', 'palto' ),
	'desc' => __( 'Auto play Speed in milliseconds', 'palto' ),
	'id'   => 'auto_playSpeed',
	'type'        => 'own_slider',
	'min'         => '0',
	'max'         => '10000',
	'default'     => '3000', // start value
	'value_label' => __('milliseconds:','palto'),
	'attributes' => array(
		'data-conditional-id' => 'palto_autoplay',
		'data-conditional-value' => 'auto_enable',

		)

	) );
	$palto_carousel->add_field( array(
	'name' => __( 'Scroll speed', 'palto' ),
	'desc' => __( 'Scroll speed in milliseconds', 'palto' ),
	'id'   => 'Scrollspeed',
	'type'        => 'own_slider',
		'min'         => '0',
		'max'         => '1000',
		'default'     => '300', // start value
		'value_label' => __('Milliseconds:','palto'),
	) );
	$palto_carousel->add_field( array(
		'name'    => __( 'Pause on hover', 'palto' ),
		'id'      => 'pauseOnHover',
		'type'    => 'radio',
		'default'    => 'pause_disable',
		'options' => array(
			'pause_enable' => __( 'Enable', 'palto' ),
			'pause_disable' => __( 'disable', 'palto' ),
		),
		'attributes' => array(
		'data-conditional-id' => 'palto_autoplay',
		'data-conditional-value' => 'auto_enable',
		)
	) );
	$palto_carousel->add_field( array(
		'name'    => __( 'Infinite loop', 'palto' ),
		'id'      => 'falto_infinite',
		'type'    => 'radio',
		'default'    => 'infinite_enable',
		'options' => array(
			'infinite_enable' => __( 'Enable', 'palto' ),
			'infinite_disable' => __( 'disable', 'palto' ),
		),
		'attributes' => array(
		'data-conditional-id' => 'palto_autoplay',
		'data-conditional-value' => 'auto_disable',
		)
	) );
	$palto_carousel->add_field( array(
		'name'    => __( 'Carousel item margin', 'palto' ),
		'desc'    => __( 'Carousel item margin set left and right side by px.default 0', 'palto' ),
		'id'      => 'falto_margin',
		'type'        => 'own_slider',
		'min'         => '0',
		'max'         => '50',
		'default'     => '0', // start value
		'value_label' => __('Margin px:','palto'),
	) );

	$palto_carousel->add_field( array(
		'name'    => __( 'Images show large screen', 'palto' ),
		'desc'    => __( 'Set images to show at a time in large screen', 'palto' ),
		'id'      => 'falto_img_number',
		'type'        => 'own_slider',
		'min'         => '1',
		'max'         => '10',
		'default'     => '4', // start value
		'value_label' => __('Images number:','palto'),
	) );
	$palto_carousel->add_field( array(
		'name'    => __( 'Images show medium screen', 'palto' ),
		'desc'    => __( 'Set images to show at a time in medium screen.', 'palto' ),
		'id'      => 'falto_img_medium',
		'type'        => 'own_slider',
		'min'         => '1',
		'max'         => '10',
		'default'     => '3', // start value
		'value_label' => __('Images number:','palto'),
	) );
	$palto_carousel->add_field( array(
		'name'    => __( 'Images show in tab', 'palto' ),
		'desc'    => __( 'Set images to show at a time in tab screen.', 'palto' ),
		'id'      => 'falto_img_tab',
		'type'        => 'own_slider',
		'min'         => '1',
		'max'         => '5',
		'default'     => '2', // start value
		'value_label' => __('Images number:','palto'),
	) );
	$palto_carousel->add_field( array(
		'name'    => __( 'Images scroll at a time', 'palto' ),
		'desc'    => __( 'Set images to scroll at a time', 'palto' ),
		'id'      => 'falto_imgScroll',
		'type'        => 'own_slider',
		'min'         => '1',
		'max'         => '10',
		'default'     => '1', // start value
		'value_label' => __('Images number:','palto'),
	) );

		$palto_carousel->add_field( array(
		'name'    => __( 'Mouse dragging', 'palto' ),
		'id'      => 'drag_mouse',
		'type'    => 'radio',
		'default'    => 'enable_dragging',
		'options' => array(
			'enable_dragging' => __( 'Enable', 'palto' ),
			'disable_dragging' => __( 'disable', 'palto' ),
		),
	) );
	$palto_carousel->add_field( array(
		'name'    => __( 'Carousel arrows', 'palto' ),
		'desc'    => __( 'If you use arrows click enable.', 'palto' ),
		'id'      => 'falto_arrows',
		'type'    => 'radio_inline',
		'default'    => 'arrows_disable',
		'options' => array(
			'arrows_enable' => __( 'Enable', 'palto' ),
			'arrows_disable' => __( 'Disable', 'palto' ),
		),
		
	) );
	$palto_carousel->add_field( array(
		'name'             => __( 'Select arrows icons', 'palto' ),
		'desc'             => __( 'Select icon for arrows.', 'palto' ),
		'id'               => 'arrows_icons',
		'type'             => 'radio_inline',
		'default'             => '5',
		'options'          => array(
			'1'   => __( ' Icon one', 'palto' ),
			'2'   => __( 'Icon two ', 'palto' ),
			'3'   => __( 'Icon three ', 'palto' ),
			'4'   => __( 'Icon four ', 'palto' ),
			'5'   => __( 'Icon five ', 'palto' ),
			'6'   => __( 'Icon six ', 'palto' ),
			'7'   => __( 'Icon seven ', 'palto' ),
			'8'   => __( 'Icon eight ', 'palto' ),
			'9'   => __( 'Icon nine ', 'palto' ),
			'10'   => __( 'Icon ten ', 'palto' ),
			'11'   => __( 'Icon eleven ', 'palto' ),
			
		),
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => 'falto_arrows',
			'data-conditional-value' => 'arrows_enable',
		)
	) );
	$palto_carousel->add_field( array(
		'name'             => __( 'Set arrows position', 'palto' ),
		'desc'             => __( 'You can set your arrows position', 'palto' ),
		'id'               => 'arrows_position',
		'type'             => 'pw_select',
		'default'             => '1',
		'options'          => array(
			'1'   => __( ' Default', 'palto' ),
			'2'   => __( 'Bottom Middle ', 'palto' ),
			'3'   => __( 'Bottom Left ', 'palto' ),
			'6'   => __( ' Bottom Right ', 'palto' ),
			'4'   => __( ' Top left', 'palto' ),
			'5'   => __( ' Top right ', 'palto' ),
			
		),
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => 'falto_arrows',
			'data-conditional-value' => 'arrows_enable',
		)
	) );
	$palto_carousel->add_field( array(
		'name'             => __( 'Set arrows top bottom margin', 'palto' ),
		'desc'             => __( 'You arrow button set right position by top bottom margin set.', 'palto' ),
		'id'               => 'arrows_margin',
		'type'        => 'own_slider',
		'min'         => '-50',
		'max'         => '50',
		'default'     => '0', // start value
		'value_label' => __('Margin:','palto'),
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => 'falto_arrows',
			'data-conditional-value' => 'arrows_enable',
		)
	) );
	$palto_carousel->add_field( array(
		'name'             => __( 'Arrows background color', 'palto' ),
		'desc'             => __( 'Set arrows icon background color .', 'palto' ),
		'id'               => 'arrows_background',
		'type'    => 'colorpicker',
		'default' => '#111111',
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => 'falto_arrows',
			'data-conditional-value' => 'arrows_enable',
		)
	) );
	$palto_carousel->add_field( array(
		'name'             => __( 'Arrows background hover color', 'palto' ),
		'desc'             => __( 'Set arrows icon background hover color .', 'palto' ),
		'id'               => 'arrows_backhover',
		'type'    => 'colorpicker',
		'default' => '#555555',
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => 'falto_arrows',
			'data-conditional-value' => 'arrows_enable',
		)
	) );
	$palto_carousel->add_field( array(
		'name'             => __( 'Arrows icon color', 'palto' ),
		'desc'             => __( 'Set arrows icon color .', 'palto' ),
		'id'               => 'arrows_color',
		'type'    => 'colorpicker',
		'default' => '#ffffff',
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => 'falto_arrows',
			'data-conditional-value' => 'arrows_enable',
		)
	) );
	$palto_carousel->add_field( array(
		'name'             => __( 'Arrows icon hover color', 'palto' ),
		'desc'             => __( 'Set arrows icon hover color .', 'palto' ),
		'id'               => 'arrow_color_hover',
		'type'    => 'colorpicker',
		'default' => '#cccccc',
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => 'falto_arrows',
			'data-conditional-value' => 'arrows_enable',
		)
	) );
	$palto_carousel->add_field( array(
		'name'    => __( 'Carousel dots', 'palto' ),
		'desc'    => __( 'If you use dots click enable.', 'palto' ),
		'id'      => 'falto_dots',
		'type'    => 'radio_inline',
		'default'    => 'dots_enable',
		'options' => array(
			'dots_enable' => __( 'Enable', 'palto' ),
			'dots_disable' => __( 'Disable', 'palto' ),
		),
	) );
	$palto_carousel->add_field( array(
		'name'    => __( 'Select dots position ', 'palto' ),
		'desc'    => __( 'You can set dots position right, left and center.', 'palto' ),
		'id'      => 'dots_position',
		'type'             => 'pw_select',
		'default'             => 'center',
		'options'          => array(
			'center' => __( 'Center', 'palto' ),
			'left'   => __( 'Left', 'palto' ),
			'right' => __( 'Right ', 'palto' ),
		),
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => 'falto_dots',
			'data-conditional-value' => 'dots_enable',
		)
	) );
	$palto_carousel->add_field( array(
		'name'    => __( 'Select CSS3 Animation Easing', 'palto' ),
		'desc'    => __( 'Select animation-timing-function property.', 'palto' ),
		'id'      => 'falto_CSS3',
		'type'    => 'select',
		'default'    => 'ease',
		'options' => array(
			'linear' => __( 'Linear', 'palto' ),
			'ease' => __( 'Ease', 'palto' ),
			'ease-in' => __( 'Ease-in', 'palto' ),
			'ease-out' => __( 'Ease-out', 'palto' ),
			'ease-in-out' => __( 'Ease-in-out', 'palto' ),
		),
	) );
	$palto_carousel->add_field( array(
		'name'    => __( 'Image hover animation ', 'palto' ),
		'desc'    => __( 'If you want to use hover animation select active button.', 'palto' ),
		'id'      => 'img_hover',
		'type'    => 'radio_inline',
		'default'    => 'hover_disable',
		'options' => array(
			'hover_enable' => __( 'active', 'palto' ),
			'hover_disable' => __( 'hide', 'palto' ),
		),
	) );
	$palto_carousel->add_field( array(
		'name'    => __( 'Select image hover animation', 'palto' ),
		'desc'    => __( 'Select hover animation for your carousel image hover.', 'palto' ),
		'id'      => 'hover_animation',
		'type'    => 'select',
		'default'    => 'hvr-grow',
		'options' => array(
			'hvr-grow' => __( 'Grow', 'palto' ),
			'hvr-shrink' => __( 'Shrink', 'palto' ),
			'hvr-pulse' => __( 'Pulse', 'palto' ),
			'hvr-pulse-grow' => __( 'Pulse Grow', 'palto' ),
			'hvr-pulse-shrink' => __( 'Pulse Shrink', 'palto' ),
			'hvr-push' => __( 'Push', 'palto' ),
			'hvr-pop' => __( 'Pop', 'palto' ),
			'hvr-bounce-in' => __( 'Bounce In', 'palto' ),
			'hvr-bounce-out' => __( 'Bounce Out', 'palto' ),
			'hvr-rotate' => __( 'Rotate', 'palto' ),
			'hvr-float' => __( 'Float', 'palto' ),
			'hvr-sink' => __( 'Sink', 'palto' ),
			'hvr-bob' => __( 'Bob', 'palto' ),
			'hvr-hang' => __( 'Hang', 'palto' ),
			'hvr-buzz-out' => __( 'Buzz Out', 'palto' ),

		),
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => 'img_hover',
			'data-conditional-value' => 'hover_enable',
		)
	) );

	$palto_carousel->add_field( array(
		'name'    => __( 'Select border type', 'palto' ),
		'id'      => 'position_border',
		'type'    => 'radio_inline',
		'default'    => 'border_no',
		'options' => array(
		    'border_no' => __( 'No border', 'palto' ),
			'border_full' => __( 'Full carousel border', 'palto' ),
			'border_img' => __( 'All images border', 'palto' ),
		),

	) );
	$palto_carousel->add_field( array(
		'name'    => __( 'Full carousel border length', 'palto' ),
		'desc'    => __( 'Set your border length by px.default length 1px.', 'palto' ),
		'id'      => 'full_border_lenth',
		'type'        => 'own_slider',
		'min'         => '1',
		'max'         => '10',
		'default'     => '1', // start value
		'value_label' => 'px:',
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => 'position_border',
			'data-conditional-value' => 'border_full',
		)
	) );
	$palto_carousel->add_field( array(
		'name'             => __( 'Full carousel border color', 'palto' ),
		'desc'             => __( 'Select border color.', 'palto' ),
		'id'               => 'full_border_color',
		'type'    => 'colorpicker',
		'default' => '#cccccc',
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => 'position_border',
			'data-conditional-value' => 'border_full',
		)
	) );
	$palto_carousel->add_field( array(
		'name'    => __( 'Carousel item border length', 'palto' ),
		'desc'    => __( 'Set your border length by px.default length 1px.', 'palto' ),
		'id'      => 'img_border_lenth',
		'type'        => 'own_slider',
		'min'         => '1',
		'max'         => '10',
		'default'     => '1', // start value
		'value_label' => 'px:',
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => 'position_border',
			'data-conditional-value' => 'border_img',
		)
	) );
	$palto_carousel->add_field( array(
		'name'             => __( 'Carousel item border color', 'palto' ),
		'desc'             => __( 'Select border color.', 'palto' ),
		'id'               => 'img_border_color',
		'type'    => 'colorpicker',
		'default' => '#cccccc',
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => 'position_border',
			'data-conditional-value' => 'border_img',
		)
	) );
		$palto_carousel->add_field( array(
		'name'    => __( 'Carousel lightbox', 'palto' ),
		'desc'    => __( 'You can set lightbox in this carousel.', 'palto' ),
		'id'      => 'use_lightbox',
		'type'    => 'radio_inline',
		'default'    => 'lightbox_disable',
		'options' => array(
			'lightbox_enable' => __( 'Active', 'palto' ),
			'lightbox_disable' => __( 'Hide', 'palto' ),
		),
	) );

	$palto_carousel->add_field( array(
		'name'             => __( 'Select lightbox effect', 'palto' ),
		'desc'             => __( 'Select lightbox effect as you need.', 'palto' ),
		'id'               => 'lightbox_effect',
		'type'             => 'pw_select',
		'default'             => 'slideLeft',
		'options'          => array(
			'fade'   => __( 'Fade', 'palto' ),
			'fadeScale'   => __( 'Fade scale', 'palto' ),
			'slideLeft'   => __( 'Slide left', 'palto' ),
			'slideRight'   => __( 'Slide right', 'palto' ),
			'slideUp'   => __( 'slide up', 'palto' ),
			'slideDown'   => __( 'Slide down', 'palto' ),
			'fall'   => __( 'Fall', 'palto' ),

		),
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => 'use_lightbox',
			'data-conditional-value' => 'lightbox_enable',
		)
	) );
	$palto_carousel->add_field( array(
		'name'    => __( 'Carousel center mode', 'palto' ),
		'desc'    => __( 'Enables centred view with partial prev/next slides. Use with odd numbered slidesToShow counts.', 'palto' ),
		'id'      => 'falto_center_mode',
		'type'    => 'radio_inline',
		'default'    => 'center_disable',
		'options' => array(
			'center_enable' => __( 'Enable', 'palto' ),
			'center_disable' => __( 'Disable', 'palto' ),
		),
	) );
	$palto_carousel->add_field( array(
		'name'    => __( 'Carousel center mode Padding', 'palto' ),
		'desc'    => __( 'Set center mode padding here.', 'palto' ),
		'id'      => 'falto_centerPadding',
		'type'        => 'own_slider',
		'min'         => '1',
		'max'         => '150',
		'default'     => '50', // start value
		'value_label' => 'px:',
		'attributes' => array(
			'required' => true, // Will be required only if visible.
			'data-conditional-id' => 'falto_center_mode',
			'data-conditional-value' => 'center_enable',
		)
	) );

	$palto_carousel->add_field( array(
		'name'    => __( 'Carousel variable width', 'palto' ),
		'desc'    => __( 'Variable width work when image size selected full and image upload different size.', 'palto' ),
		'id'      => 'falto_variableWidth',
		'type'    => 'radio',
		'default'    => 'variableWidth_disable',
		'options' => array(
			'variableWidth_enable' => __( 'Enable', 'palto' ),
			'variableWidth_disable' => __( 'Disable', 'palto' ),
		),

	) );

	$palto_carousel->add_field( array(
		'name'    => __( 'sliders direction', 'palto' ),
		'desc'    => __( 'Change the sliders direction.', 'palto' ),
		'id'      => 'falto_direction',
		'type'    => 'select',
		'default'    => 'sliders_Left',
		'options' => array(
			'sliders_Left' => __( 'Left to right', 'palto' ),
			'sliders_Right' => __( 'Right to left', 'palto' ),
			'vertical_sliders' => __( 'Vertical', 'palto' ),
		),
	) );

	$palto_carousel->add_field( array(
		'name'    => __( 'Single image fade', 'palto' ),
		'desc'    => __( 'Only one image show on front when fade enabled', 'palto' ),
		'id'      => 'falto_fade',
		'type'    => 'radio',
		'default'    => 'fade_disable',
		'options' => array(
			'fade_enable' => __( 'Enable', 'palto' ),
			'fade_disable' => __( 'Disable', 'palto' ),
		),
	) );
	$palto_carousel->add_field( array(
		'name'    => __( 'Mobile first function', 'palto' ),
		'desc'    => __( 'Responsive settings use mobile first calculation', 'palto' ),
		'id'      => 'falto_mobilefirst',
		'type'    => 'radio',
		'default'    => 'mobilefirst_disable',
		'options' => array(
			'mobilefirst_enable' => __( 'Enable', 'palto' ),
			'mobilefirst_disable' => __( 'Disable', 'palto' ),
		),

	) );
}
endif;

