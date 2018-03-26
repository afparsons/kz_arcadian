<?php

/* === Post Formats === */

add_theme_support('post-formats', array('aside', 'gallery', 'Featured Stories'));

/* === Enable Shortcodes inside Widgets	=== */

add_filter('widget_text', 'do_shortcode');

/* === Load CSS & JavaScript === */

function kz_arcadian_scripts_enqueue() {
  wp_enqueue_style('customstyle', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'kz_arcadian_scripts_enqueue');

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

?>
