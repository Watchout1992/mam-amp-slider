<?php
/**
 * Plugin Name: MAM AMP Slider
 * Plugin URI: https://moveaheadmedia.com.au
 * Description: Create custom AMP slider for every page easily. (This Plugin Require ACF Pro installed)
 * Version: 1.0
 * Author: Moveahead Media
 * Author URI: https://www.moveaheadmedia.com.au/
 */

// add plugin scripts
add_action( 'wp_enqueue_scripts', 'mamps_script_load' );
function mamps_script_load(){
    wp_enqueue_script( 'mam-amp', 'https://cdn.ampproject.org/v0.js');
    wp_enqueue_script( 'mam-amp-carousel', 'https://cdn.ampproject.org/v0/amp-carousel-0.1.js');
}

// add Advanced Custom Fields to wordpress pages back-end. // require advanced custom fields
if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_5d5f5f65c7cdd',
        'title' => 'Fast Main Slider',
        'fields' => array(
            array(
                'key' => 'field_5d5f5f79012d9',
                'label' => 'Slides',
                'name' => 'slides',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => '',
                'min' => 0,
                'max' => 0,
                'layout' => 'row',
                'button_label' => '',
                'sub_fields' => array(
                    array(
                        'key' => 'field_5d5f5f86012da',
                        'label' => 'Background Image',
                        'name' => 'image',
                        'type' => 'image',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '100',
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => 'url',
                        'preview_size' => 'full',
                        'library' => 'all',
                        'min_width' => '',
                        'min_height' => '',
                        'min_size' => '',
                        'max_width' => '',
                        'max_height' => '',
                        'max_size' => '',
                        'mime_types' => '',
                    ),
                    array(
                        'key' => 'field_5d5f5fa4012db',
                        'label' => 'Content',
                        'name' => 'content',
                        'type' => 'wysiwyg',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '100',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'tabs' => 'all',
                        'toolbar' => 'full',
                        'media_upload' => 1,
                        'delay' => 0,
                    ),
                ),
            ),
            array(
                'key' => 'field_5d5f6067be483',
                'label' => 'Show in Header',
                'name' => 'show_in_header',
                'type' => 'select',
                'instructions' => 'you can choose to show the slider in the header.
or use this shortcode [fast-slider] or <span class="fast-slider-code"></span>',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'No' => 'No',
                    'Yes' => 'Yes',
                ),
                'default_value' => array(
                ),
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'ajax' => 0,
                'placeholder' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

endif;


// add amp slider shortcode
function mamps_slider_function( $atts ){
    $a = shortcode_atts( array(
        'id' => get_the_ID()
    ), $atts );

    $html = '<div class="main-amp-slider">';
    $html .= '<amp-carousel width="1920" height="700" layout="responsive" autoplay delay="4000" type="slides">';
    if( have_rows('slides', $a['id']) ){
        $count = 0;
        while ( have_rows('slides', $a['id']) ){
            the_row();
            $image = get_sub_field('image');
            list($width, $height, $type, $attr) = getimagesize($image);
            $text = get_sub_field('content');
            $count = $count + 1;
            $html .= '<div class="amp-slide amp-slide-'.$count.'">';
            $html .= '<amp-img src="'.$image.'" '.$attr.' layout="responsive"></amp-img>';
            $html .= '<div class="slider-content">';
            $html .= '<div class="container">';
            $html .= $text;
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
        }
    }
    $html .= '</amp-carousel>';
    $html .= '</div>';
    return $html;
}
add_shortcode( 'mamps-slider', 'mamps_slider_function' );
