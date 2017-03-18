<?php

// Stick Admin Bar To The Top
if (!is_admin() && is_user_logged_in()) {
	add_action('get_header', 'ba_filter_head');

	function ba_filter_head() {
		remove_action('wp_head', '_admin_bar_bump_cb');
	}

	function stick_admin_bar() {
		echo "
		<style type='text/css'>
			body.admin-bar {margin-top:32px !important}
			@media screen and (max-width: 782px) {
				body.admin-bar { margin-top:46px !important }
			}
			@media screen and (max-width: 600px) {
				body.admin-bar { margin-top:46px !important }
			}
		</style>
		";
	}

	add_action('admin_head', 'stick_admin_bar');
	add_action('wp_head', 'stick_admin_bar');
}

// Customize Login Screen
function wordpress_login_styling() { ?>
	<style type="text/css">
		.login #login h1 a {
			background-image: url('<?php echo get_header_image(); ?>');
			background-size: contain;
			width: auto;
			height: 220px;
		}
	   body.login{
		   background-color: #<?php echo get_background_color(); ?>;
		   background-image: url('<?php echo get_background_image(); ?>') !important;
		   background-repeat: repeat;
		   background-position: center center;
	   };

	</style>
<?php }
add_action( 'login_enqueue_scripts', 'wordpress_login_styling' );

function admin_logo_custom_url(){
	$site_url = home_url();
	return ($site_url);
}
add_filter('login_headerurl', 'admin_logo_custom_url');
