<?php
	// Exit if accessed directly.
	defined( 'ABSPATH' ) || exit;

	$includes = array(
        'get-categories'
	);

	foreach ( $includes as $include ) {
		include_once themedir . '/inc/woocommerce/php/' . $include . '.php';
	}
?>