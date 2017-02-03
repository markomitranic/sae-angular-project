<?php 

// This is the propper way to enqueue both scripts and additional CSS.

// For a full list of scripts included with WP visit:
// https://developer.wordpress.org/reference/functions/wp_enqueue_script/#Default_scripts_included_with_WordPress

// If you would like to learn why, how and mechanics - you can visit:
// Usage: http://code.tutsplus.com/articles/how-to-include-javascript-and-css-in-your-wordpress-themes-and-plugins--wp-24321


function custom_styles() {
    // Register the style first so that WP knows what we are working with:
    wp_register_style( 'core-css', get_template_directory_uri() . '/css/zimt.css' );
 
    // Then we need to enqueue them one by one to the theme:
    wp_enqueue_style( 'core-css' );
}
add_action( 'wp_enqueue_scripts', 'custom_styles' );

function custom_scripts() {
    // Register the scripts first so that WP knows what we are working with:
    // Parameters: Slug, url, dependencies, version, in_footer
    wp_register_script( 'contentReplacer', get_template_directory_uri() . '/scripts/contentReplacer.js', ['jquery'], 1.2, true );
    wp_register_script( 'cart', get_template_directory_uri() . '/scripts/cart.js', ['jquery'], 1.2, true );
    wp_register_script( 'cookie', get_template_directory_uri() . '/scripts/cookie.js', ['jquery'], 1.2, true );
    wp_register_script( 'form-validator', get_template_directory_uri() . '/scripts/jquery.validate.min.js', ['jquery'], '2.3.26', true );
    wp_register_script( 'form-creator', get_template_directory_uri() . '/scripts/formCreator.js', ['jquery'], '2.3.26', true );
    wp_register_script( 'delegate', get_template_directory_uri() . '/scripts/delegate.js', ['jquery'], 1.2, true );



    
 
    // Then we need to enqueue them one by one to the theme:
    wp_enqueue_script( 'form-validator' );
    wp_enqueue_script( 'form-creator' );
    wp_enqueue_script( 'contentReplacer' );
    wp_enqueue_script( 'cart' );
    wp_enqueue_script( 'cookie' );
    wp_enqueue_script( 'delegate' );
}
add_action( 'wp_enqueue_scripts', 'custom_scripts' );


// Sometimes it is mandatory to have a special version of jQuery. This should be avoided. And allowed only outside admin panel.
if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', ( get_template_directory_uri() . "/scripts/jquery-2.2.4.min.js"), false, '2.2.4');
        wp_enqueue_script('jquery');
}



// This function is used to register navigation positions within the theme.
// Usage: https://codex.wordpress.org/Function_Reference/register_nav_menus

function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'footer-menu' => __( 'Footer Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );



// We can add predefined image sizes that wordpress will automatically create while uploading.
// Usage: https://developer.wordpress.org/reference/functions/add_image_size/

add_image_size( 'Product', 500, 500, false ); // $name, $min-width, $min-height, $crop


// There are a few unneeded tags within our <head>. It looks messy. We can disable/unmount them here/

remove_action('wp_head', 'rsd_link'); // Weblog client legacy support (editing via custom-made Apps)
remove_action('wp_head', 'wlwmanifest_link'); // Windows Live Writer Manifest
remove_action('wp_head', 'wp_generator'); // Built-in Meta generator (if we want to use custom meta tags)

// Disable galleries support
add_action( 'admin_head_media_upload_gallery_form', 'mfields_remove_gallery_setting_div' );
if( !function_exists( 'mfields_remove_gallery_setting_div' ) ) {
   function mfields_remove_gallery_setting_div() {
        print '
        <style type="text/css">
     #gallery-settings *{
           display:none;
       }
    </style>';
    }
}

function filter_ptags_on_images($content){
 return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

function override_mce_options($initArray) {
  $opts = '*[*]';
  $initArray['valid_elements'] = $opts;
  $initArray['extended_valid_elements'] = $opts;
  return $initArray;
}
add_filter('tiny_mce_before_init', 'override_mce_options'); 




// OPEN GRAPH
add_action('wp_head', 'fb_opengraph_meta');
function fb_opengraph_meta() {
  global $post;
  if (is_single()) {
    $image = get_field('hero_slika')['url'];
  } else {
    $image = get_bloginfo('template_url') . '/image/facebook-hero.jpg';
  }

  $description = my_excerpt( $post->post_content, $post->post_excerpt );
  $description = strip_tags($description);
  $description = str_replace("\"", "'", $description);

  $output = '<meta property="og:title" content="'.get_the_title() . ' ~ ' . get_bloginfo('name').'" />
  <meta property="og:type" content="article" />
  <meta property="og:image" content="'.$image.'" />
  <meta property="og:url" content="'.get_the_permalink().'" />
  <meta property="og:description" content="'.$description.'" />
  <meta property="og:site_name" content="'.get_bloginfo('name').'" />';

echo $output;

}

function my_excerpt($text, $excerpt){
 if ($excerpt) return $excerpt;
 $text = strip_shortcodes( $text );
 $text = apply_filters('the_content', $text);
 $text = str_replace(']]>', ']]&gt;', $text);
 $text = strip_tags($text);
 $excerpt_length = apply_filters('excerpt_length', 60);
 $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
 $words = preg_split("/[\n]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
 if ( count($words) > $excerpt_length ) {
   array_pop($words);
   $text = implode(' ', $words);
   $text = $text . $excerpt_more;
 } else {
   $text = implode(' ', $words);
 }
 return apply_filters('wp_trim_excerpt', $text, $excerpt);
}




?>
