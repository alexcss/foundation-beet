<?php

function ba_theme_register_required_plugins() {
	$plugins = array(
		/** This is an example of how to include a plugin pre-packaged with a theme */

		array(
			'name'     => 'Advanced Custom Fields Pro', // The plugin name
			'slug'     => 'advanced-custom-fields-pro', // The plugin slug (typically the folder name)
			'source'   => 'https://alexcss.com/upload/plugins/advanced-custom-fields-pro.zip', // The plugin source
			'required' => true,
		),
		array(
			'name'     => 'Contact Form 7', // The plugin name
			'slug'     => 'contact-form-7', // The plugin slug (typically the folder name)
			'source'   => 'https://downloads.wordpress.org/plugin/contact-form-7.4.7.zip', // The plugin source
			'required' => false,
		),
		array(
			'name'     => 'Custom Post Type UI', // The plugin name
			'slug'     => 'custom-post-type-ui', // The plugin slug (typically the folder name)
			'source'   => 'https://downloads.wordpress.org/plugin/custom-post-type-ui.1.5.2.zip', // The plugin source
			'required' => true,
		),
		array(
			'name'     => 'WordPress SEO by Yoast', // The plugin name
			'slug'     => 'wordpress-seo', // The plugin slug (typically the folder name)
			'source'   => 'https://downloads.wordpress.org/plugin/wordpress-seo.4.4.zip', // The plugin source
			'required' => false,
		),
		array(
			'name'     => 'WordPress Duplicator', // The plugin name
			'slug'     => 'duplicator', // The plugin slug (typically the folder name)
			'source'   => 'https://downloads.wordpress.org/plugin/duplicator.1.1.34.zip', // The plugin source
			'required' => false,
		),
		array(
			'name'     => 'Black Studio TinyMCE Widget', // The plugin name
			'slug'     => 'black-studio-tinymce-widget', // The plugin slug (typically the folder name)
			'source'   => 'https://downloads.wordpress.org/plugin/black-studio-tinymce-widget.2.3.1.zip', // The plugin source
			'required' => false,
		),
		array(
			'name'     => 'SVG Support', // The plugin name
			'slug'     => 'svg-support', // The plugin slug (typically the folder name)
			'source'   => 'https://downloads.wordpress.org/plugin/svg-support.2.3.6.zip', // The plugin source
			'required' => false,
		)
	);
	tgmpa( $plugins );
}
add_action( 'tgmpa_register', 'ba_theme_register_required_plugins' );
