<?php

/**
 * Enqueue scripts and styles.
 * Our sample Social Icons are using Font Awesome to display the icons so we need to include the FA CSS
 *
 * @return void
 */
if ( ! function_exists( 'skyrocket_scripts_styles' ) ) {
	function skyrocket_scripts_styles() {
		// Register and enqueue our icon font
		// We're using the awesome Font Awesome icon font. http://fortawesome.github.io/Font-Awesome
		wp_register_style( 'fontawesome', trailingslashit( get_template_directory_uri() ) . 'css/font-awesome.min.css' , array(), '4.7', 'all' );
		wp_enqueue_style( 'fontawesome' );
	}
}
add_action( 'wp_enqueue_scripts', 'skyrocket_scripts_styles' );

/**
 * Enqueue scripts for our Customizer preview
 *
 * @return void
 */
if ( ! function_exists( 'skyrocket_customizer_preview_scripts' ) ) {
	function skyrocket_customizer_preview_scripts() {
		wp_enqueue_script( 'ephemeris-customizer-preview', trailingslashit( get_template_directory_uri() ) . 'js/customizer-preview.js', array( 'customize-preview', 'jquery' ) );
	}
}
add_action( 'customize_preview_init', 'skyrocket_customizer_preview_scripts' );

/**
 * Check if WooCommerce is active
 * Use in the active_callback when adding the WooCommerce Section to test if WooCommerce is activated
 *
 * @return boolean
 */
function skyrocket_is_woocommerce_active() {
	if ( class_exists( 'woocommerce' ) ) {
		return true;
	}
	return false;
}

/**
 * Set our Social Icons URLs.
 * Only needed for our sample customizer preview refresh
 *
 * @return array Multidimensional array containing social media data
 */
if ( ! function_exists( 'skyrocket_generate_social_urls' ) ) {
	function skyrocket_generate_social_urls() {
		$social_icons = array(
			array( 'url' => 'behance.net', 'icon' => 'fa-behance', 'title' => esc_html__( 'Follow me on Behance', 'ephemeris' ), 'class' => 'behance' ),
			array( 'url' => 'bitbucket.org', 'icon' => 'fa-bitbucket', 'title' => esc_html__( 'Fork me on Bitbucket', 'ephemeris' ), 'class' => 'bitbucket' ),
			array( 'url' => 'codepen.io', 'icon' => 'fa-codepen', 'title' => esc_html__( 'Follow me on CodePen', 'ephemeris' ), 'class' => 'codepen' ),
			array( 'url' => 'deviantart.com', 'icon' => 'fa-deviantart', 'title' => esc_html__( 'Watch me on DeviantArt', 'ephemeris' ), 'class' => 'deviantart' ),
			array( 'url' => 'dribbble.com', 'icon' => 'fa-dribbble', 'title' => esc_html__( 'Follow me on Dribbble', 'ephemeris' ), 'class' => 'dribbble' ),
			array( 'url' => 'etsy.com', 'icon' => 'fa-etsy', 'title' => esc_html__( 'favourite me on Etsy', 'ephemeris' ), 'class' => 'etsy' ),
			array( 'url' => 'facebook.com', 'icon' => 'fa-facebook', 'title' => esc_html__( 'Like me on Facebook', 'ephemeris' ), 'class' => 'facebook' ),
			array( 'url' => 'flickr.com', 'icon' => 'fa-flickr', 'title' => esc_html__( 'Connect with me on Flickr', 'ephemeris' ), 'class' => 'flickr' ),
			array( 'url' => 'foursquare.com', 'icon' => 'fa-foursquare', 'title' => esc_html__( 'Follow me on Foursquare', 'ephemeris' ), 'class' => 'foursquare' ),
			array( 'url' => 'github.com', 'icon' => 'fa-github', 'title' => esc_html__( 'Fork me on GitHub', 'ephemeris' ), 'class' => 'github' ),
			array( 'url' => 'instagram.com', 'icon' => 'fa-instagram', 'title' => esc_html__( 'Follow me on Instagram', 'ephemeris' ), 'class' => 'instagram' ),
			array( 'url' => 'last.fm', 'icon' => 'fa-lastfm', 'title' => esc_html__( 'Follow me on Last.fm', 'ephemeris' ), 'class' => 'lastfm' ),
			array( 'url' => 'linkedin.com', 'icon' => 'fa-linkedin', 'title' => esc_html__( 'Connect with me on LinkedIn', 'ephemeris' ), 'class' => 'linkedin' ),
			array( 'url' => 'medium.com', 'icon' => 'fa-medium', 'title' => esc_html__( 'Folllow me on Medium', 'ephemeris' ), 'class' => 'medium' ),
			array( 'url' => 'pinterest.com', 'icon' => 'fa-pinterest', 'title' => esc_html__( 'Follow me on Pinterest', 'ephemeris' ), 'class' => 'pinterest' ),
			array( 'url' => 'plus.google.com', 'icon' => 'fa-google-plus', 'title' => esc_html__( 'Connect with me on Google+', 'ephemeris' ), 'class' => 'googleplus' ),
			array( 'url' => 'reddit.com', 'icon' => 'fa-reddit', 'title' => esc_html__( 'Join me on Reddit', 'ephemeris' ), 'class' => 'reddit' ),
			array( 'url' => 'slack.com', 'icon' => 'fa-slack', 'title' => esc_html__( 'Join me on Slack', 'ephemeris' ), 'class' => 'slack.' ),
			array( 'url' => 'slideshare.net', 'icon' => 'fa-slideshare', 'title' => esc_html__( 'Follow me on SlideShare', 'ephemeris' ), 'class' => 'slideshare' ),
			array( 'url' => 'snapchat.com', 'icon' => 'fa-snapchat', 'title' => esc_html__( 'Add me on Snapchat', 'ephemeris' ), 'class' => 'snapchat' ),
			array( 'url' => 'soundcloud.com', 'icon' => 'fa-soundcloud', 'title' => esc_html__( 'Follow me on SoundCloud', 'ephemeris' ), 'class' => 'soundcloud' ),
			array( 'url' => 'spotify.com', 'icon' => 'fa-spotify', 'title' => esc_html__( 'Follow me on Spotify', 'ephemeris' ), 'class' => 'spotify' ),
			array( 'url' => 'stackoverflow.com', 'icon' => 'fa-stack-overflow', 'title' => esc_html__( 'Join me on Stack Overflow', 'ephemeris' ), 'class' => 'stackoverflow' ),
			array( 'url' => 'tumblr.com', 'icon' => 'fa-tumblr', 'title' => esc_html__( 'Follow me on Tumblr', 'ephemeris' ), 'class' => 'tumblr' ),
			array( 'url' => 'twitch.tv', 'icon' => 'fa-twitch', 'title' => esc_html__( 'Follow me on Twitch', 'ephemeris' ), 'class' => 'twitch' ),
			array( 'url' => 'twitter.com', 'icon' => 'fa-twitter', 'title' => esc_html__( 'Follow me on Twitter', 'ephemeris' ), 'class' => 'twitter' ),
			array( 'url' => 'vimeo.com', 'icon' => 'fa-vimeo', 'title' => esc_html__( 'Follow me on Vimeo', 'ephemeris' ), 'class' => 'vimeo' ),
			array( 'url' => 'youtube.com', 'icon' => 'fa-youtube', 'title' => esc_html__( 'Subscribe to me on YouTube', 'ephemeris' ), 'class' => 'youtube' ),
		);

		return apply_filters( 'skyrocket_social_icons', $social_icons );
	}
}

/**
 * Return an unordered list of linked social media icons, based on the urls provided in the Customizer Sortable Repeater
 * This is a sample function to display some social icons on your site.
 * This sample function is also used to show how you can call a PHP function to refresh the customizer preview.
 * Add the following to header.php if you want to see the sample social icons displayed in the customizer preview and your theme.
 * <div class="social">
 *	 <?php echo skyrocket_get_social_media(); ?>
 * </div>
 *
 * @return string Unordered list of linked social media icons
 */
if ( ! function_exists( 'skyrocket_get_social_media' ) ) {
	function skyrocket_get_social_media() {
		$defaults = skyrocket_generate_defaults();
		$output = '';
		$social_icons = skyrocket_generate_social_urls();
		$social_urls = [];
		$social_newtab = 0;
		$social_alignment = '';
		$contact_phone = '';

		$social_urls = explode( ',', get_theme_mod( 'social_urls', $defaults['social_urls'] ) );
		$social_newtab = get_theme_mod( 'social_newtab', $defaults['social_newtab'] );
		$social_alignment = get_theme_mod( 'social_alignment', $defaults['social_alignment'] );
		$contact_phone = get_theme_mod( 'contact_phone', $defaults['contact_phone'] );

		if( !empty( $contact_phone ) ) {
			$output .= sprintf( '<li class="%1$s"><i class="fa %2$s"></i>%3$s</li>',
				'phone',
				'fa-phone',
				$contact_phone
			);
		}

		foreach( $social_urls as $key => $value ) {
			if ( !empty( $value ) ) {
				$domain = str_ireplace( 'www.', '', parse_url( $value, PHP_URL_HOST ) );
				$index = array_search( $domain, array_column( $social_icons, 'url' ) );
				if( false !== $index ) {
					$output .= sprintf( '<li class="%1$s"><a href="%2$s" title="%3$s"%4$s><i class="fa %5$s"></i></a></li>',
						$social_icons[$index]['class'],
						esc_url( $value ),
						$social_icons[$index]['title'],
						( !$social_newtab ? '' : ' target="_blank"' ),
						$social_icons[$index]['icon']
					);
				}
				else {
					$output .= sprintf( '<li class="nosocial"><a href="%2$s"%3$s><i class="fa %4$s"></i></a></li>',
						$social_icons[$index]['class'],
						esc_url( $value ),
						( !$social_newtab ? '' : ' target="_blank"' ),
						'fa-globe'
					);
				}
			}
		}

		if( get_theme_mod( 'social_rss', $defaults['social_rss'] ) ) {
			$output .= sprintf( '<li class="%1$s"><a href="%2$s" title="%3$s"%4$s><i class="fa %5$s"></i></a></li>',
				'rss',
				home_url( '/feed' ),
				'Subscribe to my RSS feed',
				( !$social_newtab ? '' : ' target="_blank"' ),
				'fa-rss'
			);
		}

		if ( !empty( $output ) ) {
			$output = '<ul class="social-icons ' . $social_alignment . '">' . $output . '</ul>';
		}

		return $output;
	}
}

/**
 * Append a search icon to the primary menu
 * This is a sample function to show how to append an icon to the menu based on the customizer search option
 * The search icon wont actually do anything
 */
if ( ! function_exists( 'skyrocket_add_search_menu_item' ) ) {
	function skyrocket_add_search_menu_item( $items, $args ) {
		$defaults = skyrocket_generate_defaults();

		if( get_theme_mod( 'search_menu_icon', $defaults['search_menu_icon'] ) ) {
			if( $args->theme_location == 'primary' ) {
				$items .= '<li class="menu-item menu-item-search"><a href="#" class="nav-search"><i class="fa fa-search"></i></a></li>';
			}
		}
		return $items;
	}
}
add_filter( 'wp_nav_menu_items', 'skyrocket_add_search_menu_item', 10, 2 );

/**
* Set our Customizer default options
*/
if ( ! function_exists( 'skyrocket_generate_defaults' ) ) {
	function skyrocket_generate_defaults() {
		$customizer_defaults = array(
			'social_newtab' => 0,
			'social_urls' => '',
			'social_alignment' => 'alignright',
			'social_rss' => 0,
			'social_url_icons' => '',
			'contact_phone' => '',
			'search_menu_icon' => 0,
			'woocommerce_shop_sidebar' => 1,
			'woocommerce_product_sidebar' => 0,
			'sample_toggle_switch' => 0,
			'sample_slider_control' => 48,
			'sample_sortable_repeater_control' => '',
			'sample_image_radio_button' => 'sidebarright',
			'sample_text_radio_button' => 'right',
			'sample_image_checkbox' => 'stylebold,styleallcaps',
			'sample_single_accordion' => '',
			'sample_alpha_color' => 'rgba(209,0,55,0.7)',
			'sample_simple_notice' => '',
			'sample_tinymce_editor' => '',
			'sample_google_font_select' => json_encode(
				array(
					'font' => 'Open Sans',
					'regularweight' => 'regular',
					'italicweight' => 'italic',
					'boldweight' => '700',
					'category' => 'sans-serif'
				)
			),
			'sample_default_text' => '',
			'sample_email_text' => '',
			'sample_url_text' => '',
			'sample_number_text' => '',
			'sample_hidden_text' => '',
			'sample_date_text' => '',
			'sample_default_checkbox' => 0,
			'sample_default_select' => 'jet-fuel',
			'sample_default_radio' => 'spider-man',
			'sample_default_dropdownpages' => '1548',
			'sample_default_textarea' => '',
			'sample_default_color' => '#333',
			'sample_default_media' => '',
			'sample_default_image' => '',
			'sample_default_cropped_image' => '',
		);

		return apply_filters( 'skyrocket_customizer_defaults', $customizer_defaults );
	}
}

/**
* Load all our Customizer options
*/
include_once trailingslashit( dirname(__FILE__) ) . 'inc/customizer.php';
