<?php

/* === Enable Shortcodes inside Widgets	=== */

add_filter('widget_text', 'do_shortcode');

/* === Theme Setup === */

function kz_arcadian_setup() {

  $header = array(
		'default-image' => '',
		'width' => 300,
		'height' => 100,
		'flex-width' => true,
		'flex-height' => true,
		'header-text' => false
	);
	add_theme_support('custom-header', $header);

  // Add default posts and comments RSS feed links to head.
  add_theme_support('automatic-feed-links');

  /*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
  add_theme_support('title-tag');

  add_theme_support('post-thumbnails');

  add_theme_support('post-formats', array('aside', 'gallery', 'Featured Stories'));


  // is 'custom_background' necessary?
  add_theme_support('custom-background');

  /*
	 * Enable support for Post Thumbnails on posts and pages.
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

  // Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

  /* MIGHT BE USEFUL IN THE FUTURE?
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

  /* I think we need to build out functionality for this but it might be useful
  for WYSIWYG editing. Consult Google.
  */
  add_editor_style();

  // Register navigation menu
  register_nav_menu('main_nav','Main Navigation');
}
add_action('after_setup_theme', 'kz_arcadian_setup');

/**
 * Register our sidebars and widgetized areas.
 *
 */
function kz_arcadian_widgets_init() {

	register_sidebar(array(
		'name'          => 'Home right sidebar',
		'id'            => 'home_right_1',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

  register_sidebar(array(
    'name' => 'Footer', 
    'id' => 'footer',
    'description' => 'Widget area in footer',
    'before_widget' => '<div class="footer-widget footer">',
    'after_widget' => '</div>',
    'before_title' => '<h6 class="footer-widget-title">',
    'after_title' => '</h6>'
  ));


}
add_action( 'widgets_init', 'kz_arcadian_widgets_init' );

/* === Load CSS & JavaScript === */

function kz_arcadian_enqueue_scripts() {
  wp_enqueue_style('customstyle', get_stylesheet_uri());
  wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('google-fonts','https://fonts.googleapis.com/css?family=Amiri:400,400i|Catamaran:300,400,700,800&amp;subset=latin-ext');
  //check for newer/smaller releases of FontAwesome...?
  //maybe even just store the few FontAwesome icons locally, avoid request...
  //check which font weights are needed.
  // consider registering: https://wordpress.stackexchange.com/questions/82490/when-should-i-use-wp-register-script-with-wp-enqueue-script-vs-just-wp-enque
  // and: https://jhtechservices.com/wordpress-wp_enqueue_script-vs-wp_register_script/
}
add_action('wp_enqueue_scripts', 'kz_arcadian_enqueue_scripts');

/* === Comment Fields === */
/*

// TODO: figure out why "mh-magazine-lite" is here

function kz_arcadian_comment_fields($fields) {
  $commenter = wp_get_current_commenter();
  $req = get_option('require_name_email');
  $aria_req = ($req ? " aria-required='true'" : '');
  $fields =  array(
    'author'	=>	'<p class="comment-form-author"><label for="author">' . __('Name ', 'mh-magazine-lite') . '</label>' . ($req ? '<span class="required">*</span>' : '') . '<br/><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></p>',
    'email' 	=>	'<p class="comment-form-email"><label for="email">' . __('Email ', 'mh-magazine-lite') . '</label>' . ($req ? '<span class="required">*</span>' : '' ) . '<br/><input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></p>',
    'url' 		=>	'<p class="comment-form-url"><label for="url">' . __('Website', 'mh-magazine-lite') . '</label><br/><input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></p>'
  );
  return $fields;
}
*/

/* === Branding Customizations === */

/* Adds custom logo to WP login page */
function kz_arcadian_custom_login_logo() { ?>
  <style type="text/css">
    #login h1 a, .login h1 a {
      background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/site-login-logo.png);
		  height:65px;
		  width:320px;
		  background-size: 320px 65px;
		  background-repeat: no-repeat;
      padding-bottom: 30px;
    }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

/* Adds custom logo to WP dashboard */
function kz_arcadian_custom_dashboard_logo() {
  echo '
  <style type="text/css">
  #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
  background-image: url(' . get_bloginfo('stylesheet_directory') . '/images/custom-dashboard-logo.png) !important;
  background-position: 0 0;
  color:rgba(0, 0, 0, 0);
  }
  #wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon {
  background-position: 0 0;
  }
  </style>
  ';
}
add_action('wp_before_admin_bar_render', 'kz_arcadian_custom_dashboard_logo');

/* This is horrid and needs to be slimmed down */
/* I don't know if we actually need it??? */
function the_index_header_logo() {
  $header_img = get_header_image();
  echo '<div class="logo-wrap" role="banner">' . "\n";
  if ($header_img) {
    echo '<a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name')) . '" rel="home"><img src="' . esc_url($header_img) . '" height="' . esc_attr(get_custom_header()->height) . '" width="' . esc_attr(get_custom_header()->width) . '" alt="' . esc_attr(get_bloginfo('name')) . '" /></a>' . "\n";
  } else {
    echo '<div class="logo">' . "\n";
    echo '<a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name')) . '" rel="home">' . "\n";
    echo '<h1 class="logo-name">' . esc_attr(get_bloginfo('name')) . '</h1>' . "\n";
    echo '<h2 class="logo-desc">' . esc_attr(get_bloginfo('description')) . '</h2>' . "\n";
    echo '</a>' . "\n";
    echo '</div>' . "\n";
  }
  echo '</div>' . "\n";
}

/* TODO: CHeck if we need the 'mh_page_title' function? */

/***** Subheading on Posts *****/

function mh_subheading() {
	global $post;
	if (get_post_meta($post->ID, "mh-subheading", true)) {
		echo '<div class="subheading-top"></div>' . "\n";
		echo '<h2 class="subheading">' . esc_attr(get_post_meta($post->ID, "mh-subheading", true)) . '</h2>' . "\n";
	}
}
add_action('mh_post_header', 'mh_subheading');


/* === Extras === */
// These functions may be useful but are currently not needed and thus disabled.

/**
 * This codeblock checks for WordPress version 4.7 or later.
 * Change '4.7-alpha' to proper version if needed.
 * STATUS: Disabled
 */
// if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
//   // do something here
//   return;
// }





?>
