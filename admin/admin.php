<?php

/***** Theme Info Page *****/

/* this is horribly incomplete. compare with MH version */

function kz_arcadian_theme_info_page() {
	add_theme_page(__('Welcome to KZ Arcadian', 'kz-arcadian'), __('Theme Info', 'kz-arcadian'), 'edit_theme_options', 'magazine', 'kz_arcadian_display_theme_page');
}

add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'featured_story',
    array(
      'labels' => array(
        'name' => __( 'Featured Stories' ),
        'singular_name' => __( 'Featured Stories' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
}

add_action('admin_menu', 'kz_arcadian_theme_info_page');

function mh_magazine_lite_display_theme_page() {
	$theme_data = wp_get_theme(); ?>
	<div class="theme-info-wrap">
		<h1><?php printf(__('Welcome to %1s %2s', 'kz-arcadian'), $theme_data->Name, $theme_data->Version ); ?></h1>
		<div class="theme-description"><?php echo $theme_data->Description; ?></div>
		<hr>
		<div class="theme-links clearfix">
			<p><strong><?php _e('Important Links:', 'kz-arcadian'); ?></strong>
				<a href="mailto:grahamkey12@gmail.com" target="_blank"><?php _e('Contact the Author', 'kz-arcadian'); ?></a>
			</p>
		</div>
		<hr>
		<div id="getting-started">
			<h3><?php printf(__('Welcome to %s', 'kz-arcadian'), $theme_data->Name); ?></h3>
			<div class="row clearfix">
				<div class="col-1-2">
					<h4>About KZ Arcadian</h4>
          	<p>KZ Arcadian is an alpha-state development theme for The Index, Kalamazoo College's student newspaper. KZ Arcadian has been built from scratched based on its predecessor, KZ Index, a fork of MH Magazine Lite. Designed by <strong><a href="http://www.thekzooindex.com/tag/graham-key/">Graham Key</a></strong> (Publication Manager 2014-2015, Web Editor 2015-2016) and rebuilt by <strong><a href="http://www.thekzooindex.com/tag/andrew-parsons/">Andrew Parsons</a></strong> (Web Editor 2016-Present).</p>
            <h4>Modifications</h4>
            	<p>
              	<li>Extensive CSS Customization</li>
                <li>Added Fullwidth Page Feature</li>
                <li>Added Fullwidth Footer</li>
                <li>Added Post Widgets</li>
                <li>Added Media Queries for Responsive Capability</li>
                <li>Customized Author Box</li>
                </p>
                <h4>Support</h4>
              <p>Do not attempt to modify this theme's code on your own. If you have any questions about website features or functionality, please contact <strong><a href="mailto:parsonsandrew1@gmail.com">Andrew Parsons</a></strong> or <strong><a href="mailto:grahamkey12@gmail.com">Graham Key</a></strong> directly.
				</div>
				<div class="col-1-2">
					<img src="<?php echo get_template_directory_uri(); ?>/screenshot.png" alt="Theme Screenshot" />
				</div>
			</div>
		</div>
		<hr>
		<div id="theme-author">
			<p>KZ Arcadian is proudly brought to you by The Index.</p>
		</div>
		</div> <?php
}

/***** Custom Meta Boxes *****/
function kz_arcadian_add_meta_boxes() {
	add_meta_box('mh_post_details', __('Post Options', 'kz-arcadian'), 'mh_post_options', 'post', 'normal', 'high');
}
add_action('add_meta_boxes', 'kz_arcadian_add_meta_boxes');

function kz_arcadian_post_options() {
	global $post;
	wp_nonce_field('mh_meta_box_nonce', 'meta_box_nonce');
	echo '<p>';
	echo '<label for="kz-arcadian-subheading">' . __("Subject Heading (will be displayed above post title). Required!", 'kz-arcadian') . '</label>';
	echo '<br />';
	echo '<input class="widefat" type="text" name="kz-arcadian-subheading" id="kz-arcadian-subheading" placeholder="Enter subject heading" value="' . esc_attr(get_post_meta($post->ID, 'kz-arcadian-subheading', true)) . '" size="30" />';
	echo '</p>';
}

function kz_arcadian_save_meta_boxes($post_id, $post) {
	if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'mh_meta_box_nonce')) {
		return $post->ID;
	}
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
      	return $post->ID;
	}
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post->ID;
		}
	}
	elseif (!current_user_can('edit_post', $post_id)) {
		return $post->ID;
	}
	if ('post' == $_POST['post_type']) {
		$meta_data['kz-arcadian-subheading'] = esc_attr($_POST['kz-arcadian-subheading']);
	}
	foreach ($meta_data as $key => $value) {
		if ($post->post_type == 'revision') return;
		$value = implode(',', (array)$value);
		if (get_post_meta($post->ID, $key, FALSE)) {
			update_post_meta($post->ID, $key, $value);
		} else {
			add_post_meta($post->ID, $key, $value);
		}
		if (!$value) delete_post_meta($post->ID, $key);
	}
}
add_action('save_post', 'kz_arcadian_save_meta_boxes', 10, 2 );

?>
