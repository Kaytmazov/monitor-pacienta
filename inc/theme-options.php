<?php

/**
 * Set up a WP-Admin page for managing turning on and off theme features.
 */
function monitor_pacienta_theme_add_options_page() {
	add_theme_page(
		'Theme Options',
		'Theme Options',
		'manage_options',
		'monitor-pacienta-theme-options',
		'monitor_pacienta_theme_options_page'
	);

	// Call register settings function
	add_action( 'admin_init', 'monitor_pacienta_theme_options' );
}
add_action( 'admin_menu', 'monitor_pacienta_theme_add_options_page' );


/**
 * Register settings for the WP-Admin page.
 */
function monitor_pacienta_theme_options() {
	register_setting( 'monitor-pacienta-theme-options', 'monitor-pacienta-theme-align-wide', array( 'default' => 1 ) );
	register_setting( 'monitor-pacienta-theme-options', 'monitor-pacienta-theme-wp-block-styles', array( 'default' => 1 ) );
	register_setting( 'monitor-pacienta-theme-options', 'monitor-pacienta-theme-editor-color-palette', array( 'default' => 1 ) );
	register_setting( 'monitor-pacienta-theme-options', 'monitor-pacienta-theme-dark-mode' );
	register_setting( 'monitor-pacienta-theme-options', 'monitor-pacienta-theme-responsive-embeds', array( 'default' => 1 ) );
}


/**
 * Build the WP-Admin settings page.
 */
function monitor_pacienta_theme_options_page() { ?>
	<div class="wrap">
	<h1><?php _e('Monitor Pacienta Theme Options', 'monitor-pacienta-theme'); ?></h1>
	<form method="post" action="options.php">
		<?php settings_fields( 'monitor-pacienta-theme-options' ); ?>
		<?php do_settings_sections( 'monitor-pacienta-theme-options' ); ?>

			<table class="form-table">
				<tr valign="top">
					<td>
						<label>
							<input name="monitor-pacienta-theme-align-wide" type="checkbox" value="1" <?php checked( '1', get_option( 'monitor-pacienta-theme-align-wide' ) ); ?> />
							<?php _e( 'Enable wide and full alignments.', 'monitor-pacienta-theme' ); ?>
							(<a href="https://developer.wordpress.org/block-editor/developers/themes/theme-support/#wide-alignment"><code>align-wide</code></a>)
						</label>
					</td>
				</tr>
				<tr valign="top">
					<td>
						<label>
							<input name="monitor-pacienta-theme-editor-color-palette" type="checkbox" value="1" <?php checked( '1', get_option( 'monitor-pacienta-theme-editor-color-palette' ) ); ?> />
							<?php _e( 'Enable a custom theme color palette.', 'monitor-pacienta-theme' ); ?>
							(<a href="https://developer.wordpress.org/block-editor/developers/themes/theme-support/#block-color-palettes"><code>editor-color-palette</code></a>)
						</label>
					</td>
				</tr>
				<tr valign="top">
					<td>
						<label>
							<input name="monitor-pacienta-theme-dark-mode" type="checkbox" value="1" <?php checked( '1', get_option( 'monitor-pacienta-theme-dark-mode' ) ); ?> />
							<?php _e( 'Enable a dark theme style.', 'monitor-pacienta-theme' ); ?>
							(<a href="https://developer.wordpress.org/block-editor/developers/themes/theme-support/#dark-backgrounds"><code>dark-editor-style</code></a>)
						</label>
					</td>
				</tr>
				<tr valign="top">
					<td>
						<label>
							<input name="monitor-pacienta-theme-wp-block-styles" type="checkbox" value="1" <?php checked( '1', get_option( 'monitor-pacienta-theme-wp-block-styles' ) ); ?> />
							<?php _e( 'Enable core block styles on the front end.', 'monitor-pacienta-theme' ); ?>
							(<a href="https://developer.wordpress.org/block-editor/developers/themes/theme-support/#default-block-styles"><code>wp-block-styles</code></a>)
						</label>
					</td>
				</tr>
				<tr valign="top">
					<td>
						<label>
							<input name="monitor-pacienta-theme-responsive-embeds" type="checkbox" value="1" <?php checked( '1', get_option( 'monitor-pacienta-theme-responsive-embeds' ) ); ?> />
							<?php _e( 'Enable responsive embedded content.', 'monitor-pacienta-theme' ); ?>
							(<a href="https://developer.wordpress.org/block-editor/developers/themes/theme-support/#responsive-embedded-content"><code>responsive-embeds</code></a>)
						</label>
					</td>
				</tr>
			</table>

		<?php submit_button(); ?>
	</form>
	</div>
<?php }


/**
 * Enable alignwide and alignfull support if the monitor-pacienta-theme-align-wide setting is active.
 */
function monitor_pacienta_theme_enable_align_wide() {

	if ( get_option( 'monitor-pacienta-theme-align-wide', 1 ) == 1 ) {

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );
	}
}
add_action( 'after_setup_theme', 'monitor_pacienta_theme_enable_align_wide' );


/**
 * Enable custom theme colors if the monitor-pacienta-theme-editor-color-palette setting is active.
 */
function monitor_pacienta_theme_enable_editor_color_palette() {
	if ( get_option( 'monitor-pacienta-theme-editor-color-palette', 1 ) == 1 ) {

		// Add support for a custom color scheme.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => __( 'Strong Blue', 'monitor-pacienta-theme' ),
				'slug'  => 'strong-blue',
				'color' => '#0073aa',
			),
			array(
				'name'  => __( 'Lighter Blue', 'monitor-pacienta-theme' ),
				'slug'  => 'lighter-blue',
				'color' => '#229fd8',
			),
			array(
				'name'  => __( 'Very Light Gray', 'monitor-pacienta-theme' ),
				'slug'  => 'very-light-gray',
				'color' => '#eee',
			),
			array(
				'name'  => __( 'Very Dark Gray', 'monitor-pacienta-theme' ),
				'slug'  => 'very-dark-gray',
				'color' => '#444',
			),
		) );
	}
}
add_action( 'after_setup_theme', 'monitor_pacienta_theme_enable_editor_color_palette' );


/**
 * Enable dark mode if monitor-pacienta-theme-dark-mode setting is active.
 */
function monitor_pacienta_theme_enable_dark_mode() {
	if ( get_option( 'monitor-pacienta-theme-dark-mode' ) == 1 ) {

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );
		add_editor_style( 'style-editor-dark.css' );

		// Add support for dark styles.
		add_theme_support( 'dark-editor-style' );
	}
}
add_action( 'after_setup_theme', 'monitor_pacienta_theme_enable_dark_mode' );


/**
 * Enable dark mode on the front end if monitor-pacienta-theme-dark-mode setting is active.
 */
function monitor_pacienta_theme_enable_dark_mode_frontend_styles() {
	if ( get_option( 'monitor-pacienta-theme-dark-mode' ) == 1 ) {
		wp_enqueue_style( 'monitor-pacienta-themedark-style', get_template_directory_uri() . '/css/dark-mode.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'monitor_pacienta_theme_enable_dark_mode_frontend_styles' );

/**
 * Enable core block styles support if the monitor-pacienta-theme-wp-block-styles setting is active.
 */
function monitor_pacienta_theme_enable_wp_block_styles() {

	if ( get_option( 'monitor-pacienta-theme-wp-block-styles', 1 ) == 1 ) {

		// Adding support for core block visual styles.
		add_theme_support( 'wp-block-styles' );
	}
}
add_action( 'after_setup_theme', 'monitor_pacienta_theme_enable_wp_block_styles' );


/**
 * Enable responsive embedded content if the monitor-pacienta-theme-responsive-embeds setting is active.
 */
function monitor_pacienta_theme_enable_responsive_embeds() {

	if ( get_option( 'monitor-pacienta-theme-responsive-embeds', 1 ) == 1 ) {

		// Adding support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
	}
}
add_action( 'after_setup_theme', 'monitor_pacienta_theme_enable_responsive_embeds' );
