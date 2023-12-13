<?php
	// Exit if accessed directly.
	defined( 'ABSPATH' ) || exit;

	$includes = array(
		'enqueue-styles'
	);

	foreach ( $includes as $include ) {
		include_once themedir . '/inc/enqueue-styles/php/' . $include . '.php';
	}
?>