<?php

/**
 * Enqueue scripts and styles.
 * Our sample Social Icons are using Font Awesome icons so we need to include the FA CSS when viewing our site
 * The Single Accordion Control is also displaying some FA icons in the Customizer itself, so we need to enqueue FA CSS in the Customizer too
 *
 * @return void
 */
if ( ! function_exists( 'skyrocket_scripts_styles' ) ) {
	function skyrocket_scripts_styles() {
		// Register and enqueue our icon font
		// We're using the awesome Font Awesome icon font. https://fontawesome.com
		wp_register_style( 'fontawesome', trailingslashit( get_template_directory_uri() ) . 'css/fontawesome-all.min.css' , array(), '6.4.0', 'all' );
		wp_enqueue_style( 'fontawesome' );
	}
}
add_action( 'wp_enqueue_scripts', 'skyrocket_scripts_styles' );
add_action( 'customize_controls_print_styles', 'skyrocket_scripts_styles' );

/**
 * Enqueue scripts for our Customizer preview
 *
 * @return void
 */
if ( ! function_exists( 'skyrocket_customizer_preview_scripts' ) ) {
	function skyrocket_customizer_preview_scripts() {
		wp_enqueue_script( 'skyrocket-customizer-preview', trailingslashit( get_template_directory_uri() ) . 'js/customizer-preview.js', array( 'customize-preview', 'jquery' ) );
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
		$plurality = apply_filters( 'skyrocket_social_icons_plurality', _x( 'me', 'First-person pronoun for Social Icon titles', 'skyrocket' ) );

		$social_icons = array(
			array( 'url' => '500px.com', 'icon' => 'fab fa-500px', 'title' => esc_html( sprintf( __( 'Follow %s on 500px', 'skyrocket' ), $plurality ) ), 'class' => 'fivehundredpx' ),
			array( 'url' => 'artstation.com', 'icon' => 'fab fa-artstation', 'title' => esc_html( sprintf( __( 'Follow %s on ArtStation', 'skyrocket' ), $plurality ) ), 'class' => 'artstation' ),
			array( 'url' => 'behance.net', 'icon' => 'fab fa-behance', 'title' => esc_html( sprintf( __( 'Follow %s on Behance', 'skyrocket' ), $plurality ) ), 'class' => 'behance' ),
			array( 'url' => 'bitbucket.org', 'icon' => 'fab fa-bitbucket', 'title' => esc_html( sprintf( __( 'Fork %s on Bitbucket', 'skyrocket' ), $plurality ) ), 'class' => 'bitbucket' ),
			array( 'url' => 'codepen.io', 'icon' => 'fab fa-codepen', 'title' => esc_html( sprintf( __( 'Follow %s on CodePen', 'skyrocket' ), $plurality ) ), 'class' => 'codepen' ),
			array( 'url' => 'deviantart.com', 'icon' => 'fab fa-deviantart', 'title' => esc_html( sprintf( __( 'Watch %s on DeviantArt', 'skyrocket' ), $plurality ) ), 'class' => 'deviantart' ),
			array( 'url' => 'discord.gg', 'icon' => 'fab fa-discord', 'title' => esc_html( sprintf( __( 'Join %s on Discord', 'skyrocket' ), $plurality ) ), 'class' => 'discord' ),
			array( 'url' => 'dribbble.com', 'icon' => 'fab fa-dribbble', 'title' => esc_html( sprintf( __( 'Follow %s on Dribbble', 'skyrocket' ), $plurality ) ), 'class' => 'dribbble' ),
			array( 'url' => 'etsy.com', 'icon' => 'fab fa-etsy', 'title' => esc_html( sprintf( __( 'favorite %s on Etsy', 'skyrocket' ), $plurality ) ), 'class' => 'etsy' ),
			array( 'url' => 'facebook.com', 'icon' => 'fab fa-facebook-f', 'title' => esc_html( sprintf( __( 'Like %s on Facebook', 'skyrocket' ), $plurality ) ), 'class' => 'facebook' ),
			array( 'url' => 'figma.com', 'icon' => 'fab fa-figma', 'title' => esc_html( sprintf( __( 'Follow %s on Figma', 'skyrocket' ), $plurality ) ), 'class' => 'figma' ),
			array( 'url' => 'flickr.com', 'icon' => 'fab fa-flickr', 'title' => esc_html( sprintf( __( 'Connect with %s on Flickr', 'skyrocket' ), $plurality ) ), 'class' => 'flickr' ),
			array( 'url' => 'foursquare.com', 'icon' => 'fab fa-foursquare', 'title' => esc_html( sprintf( __( 'Follow %s on Foursquare', 'skyrocket' ), $plurality ) ), 'class' => 'foursquare' ),
			array( 'url' => 'github.com', 'icon' => 'fab fa-github', 'title' => esc_html( sprintf( __( 'Fork %s on GitHub', 'skyrocket' ), $plurality ) ), 'class' => 'github' ),
			array( 'url' => 'instagram.com', 'icon' => 'fab fa-instagram', 'title' => esc_html( sprintf( __( 'Follow %s on Instagram', 'skyrocket' ), $plurality ) ), 'class' => 'instagram' ),
			array( 'url' => 'kickstarter.com', 'icon' => 'fab fa-kickstarter-k', 'title' => esc_html( sprintf( __( 'Back %s on Kickstarter', 'skyrocket' ), $plurality ) ), 'class' => 'kickstarter' ),
			array( 'url' => 'last.fm', 'icon' => 'fab fa-lastfm', 'title' => esc_html( sprintf( __( 'Follow %s on Last.fm', 'skyrocket' ), $plurality ) ), 'class' => 'lastfm' ),
			array( 'url' => 'linkedin.com', 'icon' => 'fab fa-linkedin-in', 'title' => esc_html( sprintf( __( 'Connect with %s on LinkedIn', 'skyrocket' ), $plurality ) ), 'class' => 'linkedin' ),
			array( 'url' => 'mastodon.social', 'icon' => 'fab fa-mastodon', 'title' => esc_html( sprintf( __( 'Follow %s on Mastodon', 'skyrocket' ), $plurality ) ), 'class' => 'mastodon' ),
			array( 'url' => 'mastodon.art', 'icon' => 'fab fa-mastodon', 'title' => esc_html( sprintf( __( 'Follow %s on Mastodon', 'skyrocket' ), $plurality ) ), 'class' => 'mastodon' ),
			array( 'url' => 'medium.com', 'icon' => 'fab fa-medium-m', 'title' => esc_html( sprintf( __( 'Follow %s on Medium', 'skyrocket' ), $plurality ) ), 'class' => 'medium' ),
			array( 'url' => 'patreon.com', 'icon' => 'fab fa-patreon', 'title' => esc_html( sprintf( __( 'Support %s on Patreon', 'skyrocket' ), $plurality ) ), 'class' => 'patreon' ),
			array( 'url' => 'pinterest.com', 'icon' => 'fab fa-pinterest-p', 'title' => esc_html( sprintf( __( 'Follow %s on Pinterest', 'skyrocket' ), $plurality ) ), 'class' => 'pinterest' ),
			array( 'url' => 'quora.com', 'icon' => 'fab fa-quora', 'title' => esc_html( sprintf( __( 'Follow %s on Quora', 'skyrocket' ), $plurality ) ), 'class' => 'Quora' ),
			array( 'url' => 'reddit.com', 'icon' => 'fab fa-reddit-alien', 'title' => esc_html( sprintf( __( 'Join %s on Reddit', 'skyrocket' ), $plurality ) ), 'class' => 'reddit' ),
			array( 'url' => 'slack.com', 'icon' => 'fab fa-slack-hash', 'title' => esc_html( sprintf( __( 'Join %s on Slack', 'skyrocket' ), $plurality ) ), 'class' => 'slack.' ),
			array( 'url' => 'slideshare.net', 'icon' => 'fab fa-slideshare', 'title' => esc_html( sprintf( __( 'Follow %s on SlideShare', 'skyrocket' ), $plurality ) ), 'class' => 'slideshare' ),
			array( 'url' => 'snapchat.com', 'icon' => 'fab fa-snapchat-ghost', 'title' => esc_html( sprintf( __( 'Add %s on Snapchat', 'skyrocket' ), $plurality ) ), 'class' => 'snapchat' ),
			array( 'url' => 'soundcloud.com', 'icon' => 'fab fa-soundcloud', 'title' => esc_html( sprintf( __( 'Follow %s on SoundCloud', 'skyrocket' ), $plurality ) ), 'class' => 'soundcloud' ),
			array( 'url' => 'spotify.com', 'icon' => 'fab fa-spotify', 'title' => esc_html( sprintf( __( 'Follow %s on Spotify', 'skyrocket' ), $plurality ) ), 'class' => 'spotify' ),
			array( 'url' => 'stackoverflow.com', 'icon' => 'fab fa-stack-overflow', 'title' => esc_html( sprintf( __( 'Join %s on Stack Overflow', 'skyrocket' ), $plurality ) ), 'class' => 'stackoverflow' ),
			array( 'url' => 'steamcommunity.com', 'icon' => 'fab fa-steam', 'title' => esc_html( sprintf( __( 'Follow %s on Steam', 'skyrocket' ), $plurality ) ), 'class' => 'steam' ),
			array( 'url' => 't.me', 'icon' => 'fab fa-telegram', 'title' => esc_html( sprintf( __( 'Chat with %s on Telegram', 'skyrocket' ), $plurality ) ), 'class' => 'Telegram' ),
			array( 'url' => 'tiktok.com', 'icon' => 'fab fa-tiktok', 'title' => esc_html( sprintf( __( 'Follow %s on TikTok', 'skyrocket' ), $plurality ) ), 'class' => 'tiktok' ),
			array( 'url' => 'tumblr.com', 'icon' => 'fab fa-tumblr', 'title' => esc_html( sprintf( __( 'Follow %s on Tumblr', 'skyrocket' ), $plurality ) ), 'class' => 'tumblr' ),
			array( 'url' => 'twitch.tv', 'icon' => 'fab fa-twitch', 'title' => esc_html( sprintf( __( 'Follow %s on Twitch', 'skyrocket' ), $plurality ) ), 'class' => 'twitch' ),
			array( 'url' => 'twitter.com', 'icon' => 'fab fa-twitter', 'title' => esc_html( sprintf( __( 'Follow %s on Twitter', 'skyrocket' ), $plurality ) ), 'class' => 'twitter' ),
			array( 'url' => 'assetstore.unity.com', 'icon' => 'fab fa-unity', 'title' => esc_html( sprintf( __( 'Follow %s on Unity Asset Store', 'skyrocket' ), $plurality ) ), 'class' => 'unity' ),
			array( 'url' => 'unsplash.com', 'icon' => 'fab fa-unsplash', 'title' => esc_html( sprintf( __( 'Follow %s on Unsplash', 'skyrocket' ), $plurality ) ), 'class' => 'unsplash' ),
			array( 'url' => 'vimeo.com', 'icon' => 'fab fa-vimeo-v', 'title' => esc_html( sprintf( __( 'Follow %s on Vimeo', 'skyrocket' ), $plurality ) ), 'class' => 'vimeo' ),
			array( 'url' => 'weibo.com', 'icon' => 'fab fa-weibo', 'title' => esc_html( sprintf( __( 'Follow %s on weibo', 'skyrocket' ), $plurality ) ), 'class' => 'weibo' ),
			array( 'url' => 'wa.me', 'icon' => 'fab fa-whatsapp', 'title' => esc_html( sprintf( __( 'Chat with %s on WhatsApp', 'skyrocket' ), $plurality ) ), 'class' => 'WhatsApp' ),
			array( 'url' => 'youtube.com', 'icon' => 'fab fa-youtube', 'title' => esc_html( sprintf( __( 'Subscribe to %s on YouTube', 'skyrocket' ), $plurality ) ), 'class' => 'youtube' ),
		);

		return apply_filters( 'skyrocket_social_icons', $social_icons );
	}
}

/**
 * Return an unordered list of linked social media icons, based on the urls provided in the Customizer Sortable Repeater
 * This is a sample function to display some social icons on your site.
 * This sample function is also used to show how you can call a PHP function to refresh the customizer preview.
 * Add the following code to header.php if you want to see the sample social icons displayed in the customizer preview and your theme.
 * Before any social icons display, you'll also need to add the relevent URL's to the Header Navigation > Social Icons section in the Customizer.
 * <div class="social">
 *	 <?php echo skyrocket_get_social_media(); ?>
 * </div>
 *
 * @return string Unordered list of linked social media icons
 */
if ( ! function_exists( 'skyrocket_get_social_media' ) ) {
	function skyrocket_get_social_media() {
		$defaults = skyrocket_generate_defaults();
		$output = array();
		$social_icons = skyrocket_generate_social_urls();
		$social_urls = explode( ',', get_theme_mod( 'social_urls', $defaults['social_urls'] ) );
		$social_newtab = get_theme_mod( 'social_newtab', $defaults['social_newtab'] );
		$social_alignment = get_theme_mod( 'social_alignment', $defaults['social_alignment'] );
		$contact_phone = get_theme_mod( 'contact_phone', $defaults['contact_phone'] );

		if( !empty( $contact_phone ) ) {
			$output[] = sprintf( '<li class="%1$s"><i class="%2$s"></i>%3$s</li>',
				'phone',
				'fas fa-phone fa-flip-horizontal',
				$contact_phone
			);
		}

		foreach( $social_urls as $key => $value ) {
			if ( !empty( $value ) ) {
				$domain = str_ireplace( 'www.', '', parse_url( $value, PHP_URL_HOST ) );
				$index = array_search( strtolower( $domain ), array_column( $social_icons, 'url' ) );
				if( false !== $index ) {
					$output[] = sprintf( '<li class="%1$s"><a href="%2$s" title="%3$s"%4$s><i class="%5$s"></i></a></li>',
						$social_icons[$index]['class'],
						esc_url( $value ),
						$social_icons[$index]['title'],
						( !$social_newtab ? '' : ' target="_blank"' ),
						$social_icons[$index]['icon']
					);
				}
				else {
					$output[] = sprintf( '<li class="nosocial"><a href="%2$s"%3$s><i class="%4$s"></i></a></li>',
						$social_icons[$index]['class'],
						esc_url( $value ),
						( !$social_newtab ? '' : ' target="_blank"' ),
						'fas fa-globe'
					);
				}
			}
		}

		if( get_theme_mod( 'social_rss', $defaults['social_rss'] ) ) {
			$output[] = sprintf( '<li class="%1$s"><a href="%2$s" title="%3$s"%4$s><i class="%5$s"></i></a></li>',
				'rss',
				home_url( '/feed' ),
				'Subscribe to my RSS feed',
				( !$social_newtab ? '' : ' target="_blank"' ),
				'fas fa-rss'
			);
		}

		if ( !empty( $output ) ) {
			$output = apply_filters( 'skyrocket_social_icons_list', $output );
			array_unshift( $output, '<ul class="social-icons ' . $social_alignment . '">' );
			$output[] = '</ul>';
		}

		return implode( '', $output );
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
 * Return a string containing the sample TinyMCE Control
 * This is a sample function to show how you can use the TinyMCE Control for footer credits in your Theme
 * Add the following three lines of code to your footer.php file to display the content of your sample TinyMCE Control
 * <div class="footer-credits">
 *		<?php echo skyrocket_get_credits(); ?>
 *	</div>
 */
if ( ! function_exists( 'skyrocket_get_credits' ) ) {
	function skyrocket_get_credits() {
		$defaults = skyrocket_generate_defaults();

		// wpautop this so that it acts like the new visual text widget, since we're using the same TinyMCE control
		return wpautop( get_theme_mod( 'sample_tinymce_editor', $defaults['sample_tinymce_editor'] ) );
	}
}

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
			'sample_slider_control_small_step' => 2,
			'sample_sortable_repeater_control' => '',
			'sample_image_radio_button' => 'sidebarright',
			'sample_text_radio_button' => 'right',
			'sample_image_checkbox' => 'stylebold,styleallcaps',
			'sample_single_accordion' => '',
			'sample_alpha_color' => 'rgba(209,0,55,0.7)',
			'sample_wpcolorpicker_alpha_color' => 'rgba(55,55,55,0.5)',
			'sample_wpcolorpicker_alpha_color2' => 'rgba(33,33,33,0.8)',
			'sample_pill_checkbox' => 'tiger,elephant,hippo',
			'sample_pill_checkbox2' => 'captainmarvel,msmarvel,squirrelgirl',
			'sample_pill_checkbox3' => 'author,categories,comments',
			'sample_simple_notice' => '',
			'sample_divider_control' => '',
			'sample_divider_control2' => '',
			'sample_divider_control3' => '',
			'sample_dropdown_select2_control_single' => 'vic',
			'sample_dropdown_select2_control_multi' => 'Antarctica/McMurdo,Australia/Melbourne,Australia/Broken_Hill',
			'sample_dropdown_select2_control_multi2' => 'Atlantic/Stanley,Australia/Darwin',
			'sample_dropdown_posts_control' => '',
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
			'sample_date_only' => '2017-08-28',
			'sample_date_time' => '2017-08-28 16:30:00',
			'sample_date_time_no_past_date' => date( 'Y-m-d' ),
		);

		return apply_filters( 'skyrocket_customizer_defaults', $customizer_defaults );
	}
}

/**
 * Load all our Customizer options
 */
function skyrocket_customizer_setup() {
	include_once trailingslashit( dirname(__FILE__) ) . 'inc/customizer.php';
}
add_action( 'after_setup_theme', 'skyrocket_customizer_setup' );
