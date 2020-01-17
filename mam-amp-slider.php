<?php
/**
 * Plugin Name: MAM AMP Slider
 * Plugin URI: https://moveaheadmedia.com.au
 * Description: Create custom AMP slider for every page easily. (This Plugin Require ACF Pro installed)
 * Version: 1.1
 * Author: Moveahead Media
 * Author URI: https://www.moveaheadmedia.com.au/
 */

// add plugin scripts
add_action('wp_enqueue_scripts', 'mamps_script_load');
function mamps_script_load()
{
    wp_enqueue_script('mam-amp', 'https://cdn.ampproject.org/v0.js');
    wp_enqueue_script('mam-amp-carousel', 'https://cdn.ampproject.org/v0/amp-carousel-0.2.js');
}
function mamps_enqueue($hook) {
    wp_enqueue_script('my_custom_script', plugin_dir_url(__FILE__) . '/backend-scripts.js');
}

add_action('admin_enqueue_scripts', 'mamps_enqueue');

// create AMP Slider post type
function mamps_create_posttype(){

    $supports = array(
        'title', // post title
        'editor', // post content
        'excerpt', // post excerpt
        'custom-fields', // custom fields
    );
    $labels = array(
        'name' => _x('AMP Sliders', 'plural'),
        'singular_name' => _x('AMP Slider', 'singular'),
        'menu_name' => _x('AMP Slider', 'admin menu'),
        'name_admin_bar' => _x('AMP Slider', 'admin bar'),
        'add_new' => _x('Add New', 'add new'),
        'add_new_item' => __('Add New AMP Slider'),
        'new_item' => __('New AMP Slider'),
        'edit_item' => __('Edit AMP Slider'),
        'view_item' => __('View AMP Slider'),
        'all_items' => __('All AMP Sliders'),
        'search_items' => __('Search AMP Sliders'),
        'not_found' => __('No AMP Slider found.'),
    );
    $args = array(
        'supports' => $supports,
        'labels' => $labels,
        'public' => true,
        'query_var' => true,
        'menu_icon' => 'dashicons-images-alt2',
        'rewrite' => array('slug' => 'mamps-ampslider'),
        'has_archive' => false
    );
    register_post_type('mamps-ampslider', $args);
}

// Hooking up our function to theme setup
add_action('init', 'mamps_create_posttype');

// add Advanced Custom Fields to wordpress pages back-end. // require advanced custom fields
if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_5e212502bbe19',
        'title' => 'AMP Slider',
        'fields' => array(
            array(
                'key' => 'field_5e212de08eaf5',
                'label' => 'Shortcode',
                'name' => '',
                'type' => 'message',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '<div id="shortcode-con"></div><br /><p><b>Dev Documentation:</b> <a href="https://amp.dev/documentation/components/amp-carousel/">https://amp.dev/documentation/components/amp-carousel/</a></p>',
                'new_lines' => '',
                'esc_html' => 0,
            ),
            array(
                'key' => 'field_5e2127f3d15f1',
                'label' => 'Layout',
                'name' => 'layout',
                'type' => 'select',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '30',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'fill' => 'Fill',
                    'fixed' => 'Fixed',
                    'fixed-height' => 'Fixed Height',
                    'flex-item' => 'Flex Item',
                    'intrinsic' => 'Intrinsic',
                    'nodisplay' => 'No Display',
                    'responsive' => 'Responsive',
                ),
                'default_value' => array(
                    0 => 'responsive',
                ),
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'ajax' => 0,
                'placeholder' => '',
            ),
            array(
                'key' => 'field_5e212781d15ef',
                'label' => 'Width',
                'name' => 'width',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '30',
                    'class' => 'col-md-4',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_5e2127e1d15f0',
                'label' => 'Height',
                'name' => 'height',
                'type' => 'number',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '30',
                    'class' => 'col-md-4',
                    'id' => '',
                ),
                'default_value' => 600,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'min' => '',
                'max' => '',
                'step' => '',
            ),
            array(
                'key' => 'field_5e212807d15f2',
                'label' => 'Autoplay',
                'name' => 'autoplay',
                'type' => 'number',
                'instructions' => 'Stops autoplaying after the requisite number of loops are made.',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '30',
                    'class' => 'col-md-4',
                    'id' => '',
                ),
                'default_value' => 0,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'min' => '',
                'max' => '',
                'step' => '',
            ),
            array(
                'key' => 'field_5e212810d15f3',
                'label' => 'Delay',
                'name' => 'delay',
                'type' => 'number',
                'instructions' => 'Specifies the duration (in milliseconds) to delay advancing to the next slide when autoplay is enabled.',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '30',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 5000,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'min' => '',
                'max' => '',
                'step' => '',
            ),
            array(
                'key' => 'field_5e212829d15f5',
                'label' => 'Column',
                'name' => 'slide-column',
                'type' => 'select',
                'instructions' => 'Bootstrap Columns Layout',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '30',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'col-md-1' => '1/12',
                    'col-md-2' => '2/12',
                    'col-md-3' => '3/12',
                    'col-md-4' => '4/12',
                    'col-md-5' => '5/12',
                    'col-md-6' => '6/12',
                    'col-md-7' => '7/12',
                    'col-md-8' => '8/12',
                    'col-md-9' => '9/12',
                    'col-md-10' => '10/12',
                    'col-md-11' => '11/12',
                    'col-md-12' => '12/12',
                ),
                'default_value' => array(
                    0 => 'col-md-12',
                ),
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'ajax' => 0,
                'placeholder' => '',
            ),
            array(
                'key' => 'field_5e212815d15f4',
                'label' => 'Type',
                'name' => 'type',
                'type' => 'select',
                'instructions' => 'carousel (default): All slides are shown and are scrollable horizontally. Each slide may specify a different width using CSS.
slides: Shows a single slide at a time, with each slide snapping into place as the user swipes.',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '30',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'carousel' => 'Carousel',
                    'slides' => 'Slides',
                ),
                'default_value' => array(
                    0 => 'carousel',
                ),
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'ajax' => 0,
                'placeholder' => '',
            ),
            array(
                'key' => 'field_5e212512d15ec',
                'label' => 'Slides',
                'name' => 'sliders',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '100',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => '',
                'min' => 1,
                'max' => 0,
                'layout' => 'block',
                'button_label' => '',
                'sub_fields' => array(
                    array(
                        'key' => 'field_5e212564d15ed',
                        'label' => 'Background Image',
                        'name' => 'background_image',
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
                        'key' => 'field_5e212564d15ee',
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
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'mamps-ampslider',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'acf_after_title',
        'style' => 'seamless',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => array(
            0 => 'permalink',
            1 => 'the_content',
            2 => 'excerpt',
            3 => 'discussion',
            4 => 'comments',
            5 => 'revisions',
            6 => 'slug',
            7 => 'author',
            8 => 'format',
            9 => 'page_attributes',
            10 => 'featured_image',
            11 => 'categories',
            12 => 'tags',
            13 => 'send-trackbacks',
        ),
        'active' => true,
        'description' => '',
    ));

endif;

// add amp slider shortcode
function mamps_slider_function($atts)
{
    $a = shortcode_atts(array(
        'id' => get_the_ID()
    ), $atts);
    $a['width'] = get_field('width', $a['id']);
    $a['height'] = get_field('height', $a['id']);
    $a['layout'] = get_field('layout', $a['id']);
    $a['autoplay'] = get_field('autoplay', $a['id']);
    $a['delay'] = get_field('delay', $a['id']);
    $a['type'] = get_field('type', $a['id']);
    $a['slide-column'] =  get_field('slide-column', $a['id']);

    $html = '<div class="main-amp-slider">';
    $html .= '<amp-carousel layout="' . $a['layout'] . '" width="' . $a['width'] . '" height="' . $a['height'] . '"  autoplay="' . $a['autoplay'] . '" delay="' . $a['delay'] . '" type="' . $a['type'] . '">';
    if (have_rows('sliders', $a['id'])) {
        $count = 0;
        while (have_rows('sliders', $a['id'])) {
            the_row();
            $image = get_sub_field('background_image');
            $text = get_sub_field('content');
            $count = $count + 1;
            $html .= '<div class="amp-slide amp-slide-' . $count . ' ' . $a['slide-column'] . '">';
            $html .= mamps_get_amp_img($image);
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

add_shortcode('mamps-slider', 'mamps_slider_function');


/**
 *
 * Get amp img html string.
 *
 * @param $src the img src
 * @param string $alt the img alt
 * @param string $layout fill, fixed, fixed-height, flex-item, intrinsic, nodisplay, responsive default
 * @param null $width in px defaults to the image width
 * @param null $height in px defaults to the image height
 * @return string html <amp-img alt="'.$alt.'" src="'.$src.'" width="'.$_width.'" height="'.$_height.'" layout="'.$layout.'"></amp-img>
 */
function mamps_get_amp_img($src, $alt = '', $layout = 'responsive', $width = null, $height = null)
{
    // _src with FTP auth src without FTP auth
    $_src = '';
    if (filter_var($src, FILTER_VALIDATE_URL)) {
        $_src = $src;
    } else {
        $_src = SITE_URL . $src;
        $src = site_url() . $src;
    }

    // get dimensions
    list($_width, $_height) = getimagesize("$_src");
    if ($width && $width > 0) {
        $_width = $width;
    }
    if ($height && $height > 0) {
        $_height = $height;
    }
    // return the amp img html
    return '<amp-img alt="' . $alt . '" src="' . $src . '" width="' . $_width . '" height="' . $_height . '" layout="' . $layout . '"></amp-img>';
}