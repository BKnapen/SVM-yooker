<?php
	if ( ! function_exists( 'woocommerce_custom_styles' ) ) :
		function woocommerce_custom_styles() {
			global $post;
		
			$url = untrailingslashit( get_stylesheet_directory_uri( __FILE__ ) );
			$path = untrailingslashit( get_stylesheet_directory( __FILE__ ) );
			// Register theme stylesheet.
			//$theme_version = wp_get_theme()->get( 'Version' );
		
			wp_register_style(
				'woocommerce-custom-style',
				$url. '/assets/css/style.css',
				array(),
				filemtime($path. '/assets/css/style.css')
			);
		
		
			wp_register_script(
				'bootstrap-script',
				$url. '/assets/js/bootstrap.js',
				array(),
				filemtime($path. '/assets/js/bootstrap.js'),
				true
			);

			if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'wcproductcategories') ) {
				// Enqueue theme stylesheet.
				wp_enqueue_style( 'woocommerce-custom-style' );
				wp_enqueue_script( 'bootstrap-script' );
		
				wp_localize_script(
					'bootstrap-script', 
					'bootstrap', 
					array(
						'ajax_url' => admin_url( 'admin-ajax.php' ),
						'assetsurl' => $url
					)
				);
			}
		}
	endif;

	add_action( 'wp_enqueue_scripts', 'woocommerce_custom_styles' );
?>