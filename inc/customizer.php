<?php
/**
 * Customizer Setup and Custom Controls
 *
 */

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class skyrocket_initialise_customizer_settings {
	// Get our default values
	private $defaults;

	public function __construct() {
		// Get our Customizer defaults
		$this->defaults = skyrocket_generate_defaults();

		// Register our Panels
		add_action( 'customize_register', array( $this, 'skyrocket_add_customizer_panels' ) );

		// Register our sections
		add_action( 'customize_register', array( $this, 'skyrocket_add_customizer_sections' ) );

		// Register our social media controls
		add_action( 'customize_register', array( $this, 'skyrocket_register_social_controls' ) );

		// Register our contact controls
		add_action( 'customize_register', array( $this, 'skyrocket_register_contact_controls' ) );

		// Register our search controls
		add_action( 'customize_register', array( $this, 'skyrocket_register_search_controls' ) );

		// Register our WooCommerce controls, only if WooCommerce is active
		if( skyrocket_is_woocommerce_active() ) {
			add_action( 'customize_register', array( $this, 'skyrocket_register_woocommerce_controls' ) );
		}

		// Register our sample Custom Control controls
		add_action( 'customize_register', array( $this, 'skyrocket_register_sample_custom_controls' ) );

		// Register our sample default controls
		add_action( 'customize_register', array( $this, 'skyrocket_register_sample_default_controls' ) );

	}

	/**
	 * Register the Customizer panels
	 */
	public function skyrocket_add_customizer_panels( $wp_customize ) {
		/**
		 * Add our Header & Navigation Panel
		 */
		 $wp_customize->add_panel( 'header_naviation_panel',
		 	array(
				'title' => __( 'Header & Navigation', 'skyrocket' ),
				'description' => esc_html__( 'Adjust your Header and Navigation sections.', 'skyrocket' )
			)
		);
	}

	/**
	 * Register the Customizer sections
	 */
	public function skyrocket_add_customizer_sections( $wp_customize ) {
		/**
		 * Add our Social Icons Section
		 */
		$wp_customize->add_section( 'social_icons_section',
			array(
				'title' => __( 'Social Icons', 'skyrocket' ),
				'description' => esc_html__( 'Add your social media links and we\'ll automatically match them with the appropriate icons. Drag and drop the URLs to rearrange their order.', 'skyrocket' ),
				'panel' => 'header_naviation_panel'
			)
		);

		/**
		 * Add our Contact Section
		 */
		$wp_customize->add_section( 'contact_section',
			array(
				'title' => __( 'Contact', 'skyrocket' ),
				'description' => esc_html__( 'Add your phone number to the site header bar.', 'skyrocket' ),
				'panel' => 'header_naviation_panel'
			)
		);

		/**
		 * Add our Search Section
		 */
		$wp_customize->add_section( 'search_section',
			array(
				'title' => __( 'Search', 'skyrocket' ),
				'description' => esc_html__( 'Add a search icon to your primary naigation menu.', 'skyrocket' ),
				'panel' => 'header_naviation_panel'
			)
		);

		/**
		 * Add our WooCommerce Layout Section, only if WooCommerce is active
		 */
		$wp_customize->add_section( 'woocommerce_layout_section',
			array(
				'title' => __( 'WooCommerce Layout', 'skyrocket' ),
				'description' => esc_html__( 'Adjust the layout of your WooCommerce shop.', 'skyrocket' ),
				'active_callback' => 'skyrocket_is_woocommerce_active'
			)
		);

		/**
		 * Add our section that contains examples of our Custom Controls
		 */
		$wp_customize->add_section( 'sample_custom_controls_section',
			array(
				'title' => __( 'Sample Custom Controls', 'skyrocket' ),
				'description' => esc_html__( 'These are an example of Customizer Custom Controls.', 'skyrocket'  )
			)
		);

		/**
		 * Add our section that contains examples of the default Core Customizer Controls
		 */
		$wp_customize->add_section( 'default_controls_section',
			array(
				'title' => __( 'Default Controls', 'skyrocket' ),
				'description' => esc_html__( 'These are an example of the default Customizer Controls.', 'skyrocket'  )
			)
		);

		/**
		 * Add our Upsell Section
		 */
		$wp_customize->add_section( new Skyrocket_Upsell_Section( $wp_customize, 'upsell_section',
			array(
				'title' => __( 'Premium Addons Available', 'skyrocket' ),
				'url' => 'https://skyrocketthemes.com',
				'backgroundcolor' => '#344860',
				'textcolor' => '#fff',
				'priority' => 0,
			)
		) );
	}

	/**
	 * Register our social media controls
	 */
	public function skyrocket_register_social_controls( $wp_customize ) {

		// Add our Checkbox switch setting and control for opening URLs in a new tab
		$wp_customize->add_setting( 'social_newtab',
			array(
				'default' => $this->defaults['social_newtab'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'skyrocket_switch_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Toggle_Switch_Custom_control( $wp_customize, 'social_newtab',
			array(
				'label' => __( 'Open in new browser tab', 'skyrocket' ),
				'section' => 'social_icons_section'
			)
		) );
		$wp_customize->selective_refresh->add_partial( 'social_newtab',
			array(
				'selector' => '.social',
				'container_inclusive' => false,
				'render_callback' => function() {
					echo skyrocket_get_social_media();
				},
				'fallback_refresh' => true
			)
		);

		// Add our Text Radio Button setting and Custom Control for controlling alignment of icons
		$wp_customize->add_setting( 'social_alignment',
			array(
				'default' => $this->defaults['social_alignment'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'skyrocket_radio_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Text_Radio_Button_Custom_Control( $wp_customize, 'social_alignment',
			array(
				'label' => __( 'Alignment', 'skyrocket' ),
				'description' => esc_html__( 'Choose the alignment for your social icons', 'skyrocket' ),
				'section' => 'social_icons_section',
				'choices' => array(
					'alignleft' => __( 'Left', 'skyrocket' ),
					'alignright' => __( 'Right', 'skyrocket'  )
				)
			)
		) );
		$wp_customize->selective_refresh->add_partial( 'social_alignment',
			array(
				'selector' => '.social',
				'container_inclusive' => false,
				'render_callback' => function() {
					echo skyrocket_get_social_media();
				},
				'fallback_refresh' => true
			)
		);

		// Add our Sortable Repeater setting and Custom Control for Social media URLs
		$wp_customize->add_setting( 'social_urls',
			array(
				'default' => $this->defaults['social_urls'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'skyrocket_url_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Sortable_Repeater_Custom_Control( $wp_customize, 'social_urls',
			array(
				'label' => __( 'Social URLs', 'skyrocket' ),
				'description' => esc_html__( 'Add your social media links.', 'skyrocket' ),
				'section' => 'social_icons_section',
				'button_labels' => array(
					'add' => __( 'Add Icon', 'skyrocket' ),
				)
			)
		) );
		$wp_customize->selective_refresh->add_partial( 'social_urls',
			array(
				'selector' => '.social',
				'container_inclusive' => false,
				'render_callback' => function() {
					echo skyrocket_get_social_media();
				},
				'fallback_refresh' => true
			)
		);

		// Add our Single Accordion setting and Custom Control to list the available Social Media icons
		$socialIconsList = array(
			'Behance' => __( '<i class="fab fa-behance"></i>', 'skyrocket' ),
			'Bitbucket' => __( '<i class="fab fa-bitbucket"></i>', 'skyrocket' ),
			'CodePen' => __( '<i class="fab fa-codepen"></i>', 'skyrocket' ),
			'DeviantArt' => __( '<i class="fab fa-deviantart"></i>', 'skyrocket' ),
			'Discord' => __( '<i class="fab fa-discord"></i>', 'skyrocket' ),
			'Dribbble' => __( '<i class="fab fa-dribbble"></i>', 'skyrocket' ),
			'Etsy' => __( '<i class="fab fa-etsy"></i>', 'skyrocket' ),
			'Facebook' => __( '<i class="fab fa-facebook-f"></i>', 'skyrocket' ),
			'Flickr' => __( '<i class="fab fa-flickr"></i>', 'skyrocket' ),
			'Foursquare' => __( '<i class="fab fa-foursquare"></i>', 'skyrocket' ),
			'GitHub' => __( '<i class="fab fa-github"></i>', 'skyrocket' ),
			'Google+' => __( '<i class="fab fa-google-plus-g"></i>', 'skyrocket' ),
			'Instagram' => __( '<i class="fab fa-instagram"></i>', 'skyrocket' ),
			'Kickstarter' => __( '<i class="fab fa-kickstarter-k"></i>', 'skyrocket' ),
			'Last.fm' => __( '<i class="fab fa-lastfm"></i>', 'skyrocket' ),
			'LinkedIn' => __( '<i class="fab fa-linkedin-in"></i>', 'skyrocket' ),
			'Medium' => __( '<i class="fab fa-medium-m"></i>', 'skyrocket' ),
			'Patreon' => __( '<i class="fab fa-patreon"></i>', 'skyrocket' ),
			'Pinterest' => __( '<i class="fab fa-pinterest-p"></i>', 'skyrocket' ),
			'Reddit' => __( '<i class="fab fa-reddit-alien"></i>', 'skyrocket' ),
			'Slack' => __( '<i class="fab fa-slack-hash"></i>', 'skyrocket' ),
			'SlideShare' => __( '<i class="fab fa-slideshare"></i>', 'skyrocket' ),
			'Snapchat' => __( '<i class="fab fa-snapchat-ghost"></i>', 'skyrocket' ),
			'SoundCloud' => __( '<i class="fab fa-soundcloud"></i>', 'skyrocket' ),
			'Spotify' => __( '<i class="fab fa-spotify"></i>', 'skyrocket' ),
			'Stack Overflow' => __( '<i class="fab fa-stack-overflow"></i>', 'skyrocket' ),
			'Tumblr' => __( '<i class="fab fa-tumblr"></i>', 'skyrocket' ),
			'Twitch' => __( '<i class="fab fa-twitch"></i>', 'skyrocket' ),
			'Twitter' => __( '<i class="fab fa-twitter"></i>', 'skyrocket' ),
			'Vimeo' => __( '<i class="fab fa-vimeo-v"></i>', 'skyrocket' ),
			'Weibo' => __( '<i class="fab fa-weibo"></i>', 'skyrocket' ),
			'YouTube' => __( '<i class="fab fa-youtube"></i>', 'skyrocket' ),
		);
		$wp_customize->add_setting( 'social_url_icons',
			array(
				'default' => $this->defaults['social_url_icons'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Single_Accordion_Custom_Control( $wp_customize, 'social_url_icons',
			array(
				'label' => __( 'View list of available icons', 'skyrocket' ),
				'description' => $socialIconsList,
				'section' => 'social_icons_section'
			)
		) );

		// Add our Checkbox switch setting and Custom Control for displaying an RSS icon
		$wp_customize->add_setting( 'social_rss',
			array(
				'default' => $this->defaults['social_rss'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'skyrocket_switch_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Toggle_Switch_Custom_control( $wp_customize, 'social_rss',
			array(
				'label' => __( 'Display RSS icon', 'skyrocket' ),
				'section' => 'social_icons_section'
			)
		) );
		$wp_customize->selective_refresh->add_partial( 'social_rss',
			array(
				'selector' => '.social',
				'container_inclusive' => false,
				'render_callback' => function() {
					echo skyrocket_get_social_media();
				},
				'fallback_refresh' => true
			)
		);

	}

	/**
	 * Register our Contact controls
	 */
	public function skyrocket_register_contact_controls( $wp_customize ) {
		// Add our Text field setting and Control for displaying the phone number
		$wp_customize->add_setting( 'contact_phone',
			array(
				'default' => $this->defaults['contact_phone'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'wp_filter_nohtml_kses'
			)
		);
		$wp_customize->add_control( 'contact_phone',
			array(
				'label' => __( 'Display phone number', 'skyrocket' ),
				'type' => 'text',
				'section' => 'contact_section'
			)
		);
		$wp_customize->selective_refresh->add_partial( 'contact_phone',
			array(
				'selector' => '.social',
				'container_inclusive' => false,
				'render_callback' => function() {
					echo skyrocket_get_social_media();
				},
				'fallback_refresh' => true
			)
		);

	}

	/**
	 * Register our Search controls
	 */
	public function skyrocket_register_search_controls( $wp_customize ) {
		// Add our Checkbox switch setting and control for opening URLs in a new tab
		$wp_customize->add_setting( 'search_menu_icon',
			array(
				'default' => $this->defaults['search_menu_icon'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'skyrocket_switch_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Toggle_Switch_Custom_control( $wp_customize, 'search_menu_icon',
			array(
				'label' => __( 'Display Search Icon', 'skyrocket' ),
				'section' => 'search_section'
			)
		) );
		$wp_customize->selective_refresh->add_partial( 'search_menu_icon',
			array(
				'selector' => '.menu-item-search',
				'container_inclusive' => false,
				'fallback_refresh' => false
			)
		);
	}

	/**
	 * Register our WooCommerce Layout controls
	 */
	public function skyrocket_register_woocommerce_controls( $wp_customize ) {

		// Add our Checkbox switch setting and control for displaying a sidebar on the shop page
		$wp_customize->add_setting( 'woocommerce_shop_sidebar',
			array(
				'default' => $this->defaults['woocommerce_shop_sidebar'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Toggle_Switch_Custom_control( $wp_customize, 'woocommerce_shop_sidebar',
			array(
				'label' => __( 'Shop page sidebar', 'skyrocket' ),
				'section' => 'woocommerce_layout_section'
			)
		) );

		// Add our Checkbox switch setting and control for displaying a sidebar on the single product page
		$wp_customize->add_setting( 'woocommerce_product_sidebar',
			array(
				'default' => $this->defaults['woocommerce_product_sidebar'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Toggle_Switch_Custom_control( $wp_customize, 'woocommerce_product_sidebar',
			array(
				'label' => esc_html__( 'Single Product page sidebar', 'skyrocket' ),
				'section' => 'woocommerce_layout_section'
			)
		) );

		// Add our Simple Notice setting and control for displaying a message about the WooCommerce shop sidebars
		$wp_customize->add_setting( 'woocommerce_other_sidebar',
			array(
				'transport' => 'postMessage',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Simple_Notice_Custom_control( $wp_customize, 'woocommerce_other_sidebar',
			array(
				'label' => __( 'Cart, Checkout & My Account sidebars', 'skyrocket' ),
				'description' => esc_html__( 'The Cart, Checkout and My Account pages are displayed using shortcodes. To remove the sidebar from these Pages, simply edit each Page and change the Template (in the Page Attributes Panel) to Full-width Page.', 'skyrocket' ),
				'section' => 'woocommerce_layout_section'
			)
		) );

	}

	/**
	 * Register our sample custom controls
	 */
	public function skyrocket_register_sample_custom_controls( $wp_customize ) {

		// Test of Toggle Switch Custom Control
		$wp_customize->add_setting( 'sample_toggle_switch',
			array(
				'default' => $this->defaults['sample_toggle_switch'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Toggle_Switch_Custom_control( $wp_customize, 'sample_toggle_switch',
			array(
				'label' => __( 'Toggle switch', 'skyrocket' ),
				'section' => 'sample_custom_controls_section'
			)
		) );

		// Test of Slider Custom Control
		$wp_customize->add_setting( 'sample_slider_control',
			array(
				'default' => $this->defaults['sample_slider_control'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control( new Skyrocket_Slider_Custom_Control( $wp_customize, 'sample_slider_control',
			array(
				'label' => __( 'Slider Control (px)', 'skyrocket' ),
				'section' => 'sample_custom_controls_section',
				'input_attrs' => array(
					'min' => 10,
					'max' => 90,
					'step' => 1,
				),
			)
		) );

		// Another Test of Slider Custom Control
		$wp_customize->add_setting( 'sample_slider_control_small_step',
			array(
				'default' => $this->defaults['sample_slider_control_small_step'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_range_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Slider_Custom_Control( $wp_customize, 'sample_slider_control_small_step',
			array(
				'label' => __( 'Slider Control With a Small Step', 'skyrocket' ),
				'section' => 'sample_custom_controls_section',
				'input_attrs' => array(
					'min' => 0,
					'max' => 4,
					'step' => .5,
				),
			)
		) );

		// Add our Sortable Repeater setting and Custom Control for Social media URLs
		$wp_customize->add_setting( 'sample_sortable_repeater_control',
			array(
				'default' => $this->defaults['sample_sortable_repeater_control'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_url_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Sortable_Repeater_Custom_Control( $wp_customize, 'sample_sortable_repeater_control',
			array(
				'label' => __( 'Sortable Repeater', 'skyrocket' ),
				'description' => esc_html__( 'This is the control description.', 'skyrocket' ),
				'section' => 'sample_custom_controls_section',
				'button_labels' => array(
					'add' => __( 'Add Row', 'skyrocket' ),
				)
			)
		) );

		// Test of Image Radio Button Custom Control
		$wp_customize->add_setting( 'sample_image_radio_button',
			array(
				'default' => $this->defaults['sample_image_radio_button'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_radio_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Image_Radio_Button_Custom_Control( $wp_customize, 'sample_image_radio_button',
			array(
				'label' => __( 'Image Radio Button Control', 'skyrocket' ),
				'description' => esc_html__( 'Sample custom control description', 'skyrocket' ),
				'section' => 'sample_custom_controls_section',
				'choices' => array(
					'sidebarleft' => array(
						'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-left.png',
						'name' => __( 'Left Sidebar', 'skyrocket' )
					),
					'sidebarnone' => array(
						'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-none.png',
						'name' => __( 'No Sidebar', 'skyrocket' )
					),
					'sidebarright' => array(
						'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-right.png',
						'name' => __( 'Right Sidebar', 'skyrocket' )
					)
				)
			)
		) );

		// Test of Text Radio Button Custom Control
		$wp_customize->add_setting( 'sample_text_radio_button',
			array(
				'default' => $this->defaults['sample_text_radio_button'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_radio_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Text_Radio_Button_Custom_Control( $wp_customize, 'sample_text_radio_button',
			array(
				'label' => __( 'Text Radio Button Control', 'skyrocket' ),
				'description' => esc_html__( 'Sample custom control description', 'skyrocket' ),
				'section' => 'sample_custom_controls_section',
				'choices' => array(
					'left' => __( 'Left', 'skyrocket' ),
					'centered' => __( 'Centered', 'skyrocket' ),
					'right' => __( 'Right', 'skyrocket'  )
				)
			)
		) );

		// Test of Image Checkbox Custom Control
		$wp_customize->add_setting( 'sample_image_checkbox',
			array(
				'default' => $this->defaults['sample_image_checkbox'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Image_checkbox_Custom_Control( $wp_customize, 'sample_image_checkbox',
			array(
				'label' => __( 'Image Checkbox Control', 'skyrocket' ),
				'description' => esc_html__( 'Sample custom control description', 'skyrocket' ),
				'section' => 'sample_custom_controls_section',
				'choices' => array(
					'stylebold' => array(
						'image' => trailingslashit( get_template_directory_uri() ) . 'images/Bold.png',
						'name' => __( 'Bold', 'skyrocket' )
					),
					'styleitalic' => array(
						'image' => trailingslashit( get_template_directory_uri() ) . 'images/Italic.png',
						'name' => __( 'Italic', 'skyrocket' )
					),
					'styleallcaps' => array(
						'image' => trailingslashit( get_template_directory_uri() ) . 'images/AllCaps.png',
						'name' => __( 'All Caps', 'skyrocket' )
					),
					'styleunderline' => array(
						'image' => trailingslashit( get_template_directory_uri() ) . 'images/Underline.png',
						'name' => __( 'Underline', 'skyrocket' )
					)
				)
			)
		) );

		// Test of Single Accordion Control
		$sampleIconsList = array(
			'Behance' => __( '<i class="fab fa-behance"></i>', 'skyrocket' ),
			'Bitbucket' => __( '<i class="fab fa-bitbucket"></i>', 'skyrocket' ),
			'CodePen' => __( '<i class="fab fa-codepen"></i>', 'skyrocket' ),
			'DeviantArt' => __( '<i class="fab fa-deviantart"></i>', 'skyrocket' ),
			'Discord' => __( '<i class="fab fa-discord"></i>', 'skyrocket' ),
			'Dribbble' => __( '<i class="fab fa-dribbble"></i>', 'skyrocket' ),
			'Etsy' => __( '<i class="fab fa-etsy"></i>', 'skyrocket' ),
			'Facebook' => __( '<i class="fab fa-facebook-f"></i>', 'skyrocket' ),
			'Flickr' => __( '<i class="fab fa-flickr"></i>', 'skyrocket' ),
			'Foursquare' => __( '<i class="fab fa-foursquare"></i>', 'skyrocket' ),
			'GitHub' => __( '<i class="fab fa-github"></i>', 'skyrocket' ),
			'Google+' => __( '<i class="fab fa-google-plus-g"></i>', 'skyrocket' ),
			'Instagram' => __( '<i class="fab fa-instagram"></i>', 'skyrocket' ),
			'Kickstarter' => __( '<i class="fab fa-kickstarter-k"></i>', 'skyrocket' ),
			'Last.fm' => __( '<i class="fab fa-lastfm"></i>', 'skyrocket' ),
			'LinkedIn' => __( '<i class="fab fa-linkedin-in"></i>', 'skyrocket' ),
			'Medium' => __( '<i class="fab fa-medium-m"></i>', 'skyrocket' ),
			'Patreon' => __( '<i class="fab fa-patreon"></i>', 'skyrocket' ),
			'Pinterest' => __( '<i class="fab fa-pinterest-p"></i>', 'skyrocket' ),
			'Reddit' => __( '<i class="fab fa-reddit-alien"></i>', 'skyrocket' ),
			'Slack' => __( '<i class="fab fa-slack-hash"></i>', 'skyrocket' ),
			'SlideShare' => __( '<i class="fab fa-slideshare"></i>', 'skyrocket' ),
			'Snapchat' => __( '<i class="fab fa-snapchat-ghost"></i>', 'skyrocket' ),
			'SoundCloud' => __( '<i class="fab fa-soundcloud"></i>', 'skyrocket' ),
			'Spotify' => __( '<i class="fab fa-spotify"></i>', 'skyrocket' ),
			'Stack Overflow' => __( '<i class="fab fa-stack-overflow"></i>', 'skyrocket' ),
			'Tumblr' => __( '<i class="fab fa-tumblr"></i>', 'skyrocket' ),
			'Twitch' => __( '<i class="fab fa-twitch"></i>', 'skyrocket' ),
			'Twitter' => __( '<i class="fab fa-twitter"></i>', 'skyrocket' ),
			'Vimeo' => __( '<i class="fab fa-vimeo-v"></i>', 'skyrocket' ),
			'Weibo' => __( '<i class="fab fa-weibo"></i>', 'skyrocket' ),
			'YouTube' => __( '<i class="fab fa-youtube"></i>', 'skyrocket' ),
		);
		$wp_customize->add_setting( 'sample_single_accordion',
			array(
				'default' => $this->defaults['sample_single_accordion'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Single_Accordion_Custom_Control( $wp_customize, 'sample_single_accordion',
			array(
				'label' => __( 'Single Accordion Control', 'skyrocket' ),
				'description' => $sampleIconsList,
				'section' => 'sample_custom_controls_section'
			)
		) );

		// Test of Alpha Color Picker Control
		$wp_customize->add_setting( 'sample_alpha_color',
			array(
				'default' => $this->defaults['sample_alpha_color'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'sample_alpha_color',
			array(
				'label' => __( 'Alpha Color Picker Control', 'skyrocket' ),
				'description' => esc_html__( 'Sample custom control description', 'skyrocket' ),
				'section' => 'sample_custom_controls_section',
				'show_opacity' => true,
				'palette' => array(
					'#000',
					'#fff',
					'#df312c',
					'#df9a23',
					'#eef000',
					'#7ed934',
					'#1571c1',
					'#8309e7'
				)
			)
		) );

		// Test of WPColorPicker Alpha Color Picker Control
		$wp_customize->add_setting( 'sample_wpcolorpicker_alpha_color',
			array(
				'default' => $this->defaults['sample_wpcolorpicker_alpha_color'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Alpha_Color_Control( $wp_customize, 'sample_wpcolorpicker_alpha_color',
			array(
				'label' => __( 'WP ColorPicker Alpha Color Picker', 'skyrocket' ),
				'description' => esc_html__( 'Sample color control with Alpha channel', 'skyrocket' ),
				'section' => 'sample_custom_controls_section',
				'input_attrs' => array(
					'palette' => array(
						'#000000',
						'#ffffff',
						'#dd3333',
						'#dd9933',
						'#eeee22',
						'#81d742',
						'#1e73be',
						'#8224e3',
					)
				),
			)
		) );

		// Another Test of WPColorPicker Alpha Color Picker Control
		$wp_customize->add_setting( 'sample_wpcolorpicker_alpha_color2',
			array(
				'default' => $this->defaults['sample_wpcolorpicker_alpha_color'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Alpha_Color_Control( $wp_customize, 'sample_wpcolorpicker_alpha_color2',
			array(
				'label' => __( 'WP ColorPicker Alpha Color Picker', 'skyrocket' ),
				'description' => esc_html__( 'Sample color control with Alpha channel', 'skyrocket' ),
				'section' => 'sample_custom_controls_section',
				'input_attrs' => array(
					'resetalpha' => false,
					'palette' => array(
						'rgba(99,78,150,1)',
						'rgba(67,78,150,1)',
						'rgba(34,78,150,.7)',
						'rgba(3,78,150,1)',
						'rgba(7,110,230,.9)',
						'rgba(234,78,150,1)',
						'rgba(99,78,150,.5)',
						'rgba(190,120,120,.5)',
					),
				),
			)
		) );

		// Test of Simple Notice control
		$wp_customize->add_setting( 'sample_simple_notice',
			array(
				'default' => $this->defaults['sample_simple_notice'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Simple_Notice_Custom_control( $wp_customize, 'sample_simple_notice',
			array(
				'label' => __( 'Simple Notice Control', 'skyrocket' ),
				'description' => __( 'This Custom Control allows you to display a simple title and description to your users. You can even include <a href="http://google.com" target="_blank">basic html</a>.', 'skyrocket' ),
				'section' => 'sample_custom_controls_section'
			)
		) );

		// Test of Dropdown Select2 Control (single select)
		$wp_customize->add_setting( 'sample_dropdown_select2_control_single',
			array(
				'default' => $this->defaults['sample_dropdown_select2_control_single'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Dropdown_Select2_Custom_Control( $wp_customize, 'sample_dropdown_select2_control_single',
			array(
				'label' => __( 'Dropdown Select2 Control', 'skyrocket' ),
				'description' => esc_html__( 'Sample Dropdown Select2 custom control (Single Select)', 'skyrocket' ),
				'section' => 'sample_custom_controls_section',
				'input_attrs' => array(
					'placeholder' => __( 'Please select a state...', 'skyrocket' ),
					'multiselect' => false,
				),
				'choices' => array(
					'nsw' => __( 'New South Wales', 'skyrocket' ),
					'vic' => __( 'Victoria', 'skyrocket' ),
					'qld' => __( 'Queensland', 'skyrocket' ),
					'wa' => __( 'Western Australia', 'skyrocket' ),
					'sa' => __( 'South Australia', 'skyrocket' ),
					'tas' => __( 'Tasmania', 'skyrocket' ),
					'act' => __( 'Australian Capital Territory', 'skyrocket' ),
					'nt' => __( 'Northern Territory', 'skyrocket' ),
				)
			)
		) );

		// Test of Dropdown Select2 Control (Multi-Select)
		$wp_customize->add_setting( 'sample_dropdown_select2_control_multi',
			array(
				'default' => $this->defaults['sample_dropdown_select2_control_multi'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Dropdown_Select2_Custom_Control( $wp_customize, 'sample_dropdown_select2_control_multi',
			array(
				'label' => __( 'Dropdown Select2 Control', 'skyrocket' ),
				'description' => esc_html__( 'Sample Dropdown Select2 custom control  (Multi-Select)', 'skyrocket' ),
				'section' => 'sample_custom_controls_section',
				'input_attrs' => array(
					'multiselect' => true,
				),
				'choices' => array(
					__( 'Antarctica', 'skyrocket' ) => array(
						'Antarctica/Casey' => __( 'Casey', 'skyrocket' ),
						'Antarctica/Davis' => __( 'Davis', 'skyrocket' ),
						'Antarctica/DumontDurville' => __( 'DumontDUrville', 'skyrocket' ),
						'Antarctica/Macquarie' => __( 'Macquarie', 'skyrocket' ),
						'Antarctica/Mawson' => __( 'Mawson', 'skyrocket' ),
						'Antarctica/McMurdo' => __( 'McMurdo', 'skyrocket' ),
						'Antarctica/Palmer' => __( 'Palmer', 'skyrocket' ),
						'Antarctica/Rothera' => __( 'Rothera', 'skyrocket' ),
						'Antarctica/Syowa' => __( 'Syowa', 'skyrocket' ),
						'Antarctica/Troll' => __( 'Troll', 'skyrocket' ),
						'Antarctica/Vostok' => __( 'Vostok', 'skyrocket' ),
					),
					__( 'Atlantic', 'skyrocket' ) => array(
						'Atlantic/Azores' => __( 'Azores', 'skyrocket' ),
						'Atlantic/Bermuda' => __( 'Bermuda', 'skyrocket' ),
						'Atlantic/Canary' => __( 'Canary', 'skyrocket' ),
						'Atlantic/Cape_Verde' => __( 'Cape Verde', 'skyrocket' ),
						'Atlantic/Faroe' => __( 'Faroe', 'skyrocket' ),
						'Atlantic/Madeira' => __( 'Madeira', 'skyrocket' ),
						'Atlantic/Reykjavik' => __( 'Reykjavik', 'skyrocket' ),
						'Atlantic/South_Georgia' => __( 'South Georgia', 'skyrocket' ),
						'Atlantic/Stanley' => __( 'Stanley', 'skyrocket' ),
						'Atlantic/St_Helena' => __( 'St Helena', 'skyrocket' ),
					),
					__( 'Australia', 'skyrocket' ) => array(
						'Australia/Adelaide' => __( 'Adelaide', 'skyrocket' ),
						'Australia/Brisbane' => __( 'Brisbane', 'skyrocket' ),
						'Australia/Broken_Hill' => __( 'Broken Hill', 'skyrocket' ),
						'Australia/Currie' => __( 'Currie', 'skyrocket' ),
						'Australia/Darwin' => __( 'Darwin', 'skyrocket' ),
						'Australia/Eucla' => __( 'Eucla', 'skyrocket' ),
						'Australia/Hobart' => __( 'Hobart', 'skyrocket' ),
						'Australia/Lindeman' => __( 'Lindeman', 'skyrocket' ),
						'Australia/Lord_Howe' => __( 'Lord Howe', 'skyrocket' ),
						'Australia/Melbourne' => __( 'Melbourne', 'skyrocket' ),
						'Australia/Perth' => __( 'Perth', 'skyrocket' ),
						'Australia/Sydney' => __( 'Sydney', 'skyrocket' ),
					)
				)
			)
		) );

		// Test of Dropdown Posts Control
		$wp_customize->add_setting( 'sample_dropdown_posts_control',
			array(
				'default' => $this->defaults['sample_dropdown_posts_control'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control( new Skyrocket_Dropdown_Posts_Custom_Control( $wp_customize, 'sample_dropdown_posts_control',
			array(
				'label' => __( 'Dropdown Posts Control', 'skyrocket' ),
				'description' => esc_html__( 'Sample Dropdown Posts custom control description', 'skyrocket' ),
				'section' => 'sample_custom_controls_section',
				'input_attrs' => array(
					'posts_per_page' => -1,
					'orderby' => 'name',
					'order' => 'ASC',
				),
			)
		) );

		// Test of TinyMCE control
		$wp_customize->add_setting( 'sample_tinymce_editor',
			array(
				'default' => $this->defaults['sample_tinymce_editor'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'wp_kses_post'
			)
		);
		$wp_customize->add_control( new Skyrocket_TinyMCE_Custom_control( $wp_customize, 'sample_tinymce_editor',
			array(
				'label' => __( 'TinyMCE Control', 'skyrocket' ),
				'description' => __( 'This is a TinyMCE Editor Custom Control', 'skyrocket' ),
				'section' => 'sample_custom_controls_section',
				'input_attrs' => array(
					'toolbar1' => 'bold italic bullist numlist alignleft aligncenter alignright link',
					'mediaButtons' => true,
				)
			)
		) );
		$wp_customize->selective_refresh->add_partial( 'sample_tinymce_editor',
			array(
				'selector' => '.footer-credits',
				'container_inclusive' => false,
				'render_callback' => 'skyrocket_get_credits_render_callback',
				'fallback_refresh' => false,
			)
		);

		// Test of Google Font Select Control
		$wp_customize->add_setting( 'sample_google_font_select',
			array(
				'default' => $this->defaults['sample_google_font_select'],
				'sanitize_callback' => 'skyrocket_google_font_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Google_Font_Select_Custom_Control( $wp_customize, 'sample_google_font_select',
			array(
				'label' => __( 'Google Font Control', 'skyrocket' ),
				'description' => esc_html__( 'All Google Fonts sorted alphabetically', 'skyrocket' ),
				'section' => 'sample_custom_controls_section',
				'input_attrs' => array(
					'font_count' => 'all',
					'orderby' => 'alpha',
				),
			)
		) );
	}

	/**
	 * Register our sample default controls
	 */
	public function skyrocket_register_sample_default_controls( $wp_customize ) {

		// Test of Text Control
		$wp_customize->add_setting( 'sample_default_text',
			array(
				'default' => $this->defaults['sample_default_text'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control( 'sample_default_text',
			array(
				'label' => __( 'Default Text Control', 'skyrocket' ),
				'description' => esc_html__( 'Text controls Type can be either text, email, url, number, hidden, or date', 'skyrocket' ),
				'section' => 'default_controls_section',
				'type' => 'text',
				'input_attrs' => array(
					'class' => 'my-custom-class',
					'style' => 'border: 1px solid rebeccapurple',
					'placeholder' => __( 'Enter name...', 'skyrocket' ),
				),
			)
		);

		// Test of Email Control
		$wp_customize->add_setting( 'sample_email_text',
			array(
				'default' => $this->defaults['sample_email_text'],
				'transport' => 'refresh',
				'sanitize_callback' => 'sanitize_email'
			)
		);
		$wp_customize->add_control( 'sample_email_text',
			array(
				'label' => __( 'Default Email Control', 'skyrocket' ),
				'description' => esc_html__( 'Text controls Type can be either text, email, url, number, hidden, or date', 'skyrocket' ),
				'section' => 'default_controls_section',
				'type' => 'email'
			)
		);

		// Test of URL Control
		$wp_customize->add_setting( 'sample_url_text',
			array(
				'default' => $this->defaults['sample_url_text'],
				'transport' => 'refresh',
				'sanitize_callback' => 'esc_url_raw'
			)
		);
		$wp_customize->add_control( 'sample_url_text',
			array(
				'label' => __( 'Default URL Control', 'skyrocket' ),
				'description' => esc_html__( 'Text controls Type can be either text, email, url, number, hidden, or date', 'skyrocket' ),
				'section' => 'default_controls_section',
				'type' => 'url'
			)
		);

		// Test of Number Control
		$wp_customize->add_setting( 'sample_number_text',
			array(
				'default' => $this->defaults['sample_number_text'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_sanitize_integer'
			)
		);
		$wp_customize->add_control( 'sample_number_text',
			array(
				'label' => __( 'Default Number Control', 'skyrocket' ),
				'description' => esc_html__( 'Text controls Type can be either text, email, url, number, hidden, or date', 'skyrocket' ),
				'section' => 'default_controls_section',
				'type' => 'number'
			)
		);

		// Test of Hidden Control
		$wp_customize->add_setting( 'sample_hidden_text',
			array(
				'default' => $this->defaults['sample_hidden_text'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control( 'sample_hidden_text',
			array(
				'label' => __( 'Default Hidden Control', 'skyrocket' ),
				'description' => esc_html__( 'Text controls Type can be either text, email, url, number, hidden, or date', 'skyrocket' ),
				'section' => 'default_controls_section',
				'type' => 'hidden'
			)
		);

		// Test of Date Control
		$wp_customize->add_setting( 'sample_date_text',
			array(
				'default' => $this->defaults['sample_date_text'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_text_sanitization'
			)
		);
		$wp_customize->add_control( 'sample_date_text',
			array(
				'label' => __( 'Default Date Control', 'skyrocket' ),
				'description' => esc_html__( 'Text controls Type can be either text, email, url, number, hidden, or date', 'skyrocket' ),
				'section' => 'default_controls_section',
				'type' => 'text'
			)
		);

		 // Test of Standard Checkbox Control
		$wp_customize->add_setting( 'sample_default_checkbox',
			array(
				'default' => $this->defaults['sample_default_checkbox'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_switch_sanitization'
			)
		);
		$wp_customize->add_control( 'sample_default_checkbox',
			array(
				'label' => __( 'Default Checkbox Control', 'skyrocket' ),
				'description' => esc_html__( 'Sample Checkbox description', 'skyrocket' ),
				'section' => 'default_controls_section',
				'type' => 'checkbox'
			)
		);

 		// Test of Standard Select Control
		$wp_customize->add_setting( 'sample_default_select',
			array(
				'default' => $this->defaults['sample_default_select'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_radio_sanitization'
			)
		);
		$wp_customize->add_control( 'sample_default_select',
			array(
				'label' => __( 'Standard Select Control', 'skyrocket' ),
				'section' => 'default_controls_section',
				'type' => 'select',
				'choices' => array(
					'wordpress' => __( 'WordPress', 'skyrocket' ),
					'hamsters' => __( 'Hamsters', 'skyrocket' ),
					'jet-fuel' => __( 'Jet Fuel', 'skyrocket' ),
					'nuclear-energy' => __( 'Nuclear Energy', 'skyrocket' )
				)
			)
		);

		// Test of Standard Radio Control
		$wp_customize->add_setting( 'sample_default_radio',
			array(
				'default' => $this->defaults['sample_default_radio'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_radio_sanitization'
			)
		);
		$wp_customize->add_control( 'sample_default_radio',
			array(
				'label' => __( 'Standard Radio Control', 'skyrocket' ),
				'section' => 'default_controls_section',
				'type' => 'radio',
				'choices' => array(
					'captain-america' => __( 'Captain America', 'skyrocket' ),
					'iron-man' => __( 'Iron Man', 'skyrocket' ),
					'spider-man' => __( 'Spider-Man', 'skyrocket' ),
					'thor' => __( 'Thor', 'skyrocket' )
				)
			)
		);

		// Test of Dropdown Pages Control
		$wp_customize->add_setting( 'sample_default_dropdownpages',
			array(
				'default' => $this->defaults['sample_default_dropdownpages'],
				'transport' => 'refresh',
				'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control( 'sample_default_dropdownpages',
			array(
				'label' => __( 'Default Dropdown Pages Control', 'skyrocket' ),
				'section' => 'default_controls_section',
				'type' => 'dropdown-pages'
			)
		);

		// Test of Textarea Control
		$wp_customize->add_setting( 'sample_default_textarea',
			array(
				'default' => $this->defaults['sample_default_textarea'],
				'transport' => 'refresh',
				'sanitize_callback' => 'wp_filter_nohtml_kses'
			)
		);
		$wp_customize->add_control( 'sample_default_textarea',
			array(
				'label' => __( 'Default Textarea Control', 'skyrocket' ),
				'section' => 'default_controls_section',
				'type' => 'textarea',
				'input_attrs' => array(
					'class' => 'my-custom-class',
					'style' => 'border: 1px solid #999',
					'placeholder' => __( 'Enter message...', 'skyrocket' ),
				),
			)
		);

		// Test of Color Control
		$wp_customize->add_setting( 'sample_default_color',
			array(
				'default' => $this->defaults['sample_default_color'],
				'transport' => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color'
			)
		);
		$wp_customize->add_control( 'sample_default_color',
			array(
				'label' => __( 'Default Color Control', 'skyrocket' ),
				'section' => 'default_controls_section',
				'type' => 'color'
			)
		);

		// Test of Media Control
		$wp_customize->add_setting( 'sample_default_media',
			array(
				'default' => $this->defaults['sample_default_media'],
				'transport' => 'refresh',
				'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'sample_default_media',
			array(
				'label' => __( 'Default Media Control', 'skyrocket' ),
				'description' => esc_html__( 'This is the description for the Media Control', 'skyrocket' ),
				'section' => 'default_controls_section',
				'mime_type' => 'image',
				'button_labels' => array(
					'select' => __( 'Select File', 'skyrocket' ),
					'change' => __( 'Change File', 'skyrocket' ),
					'default' => __( 'Default', 'skyrocket' ),
					'remove' => __( 'Remove', 'skyrocket' ),
					'placeholder' => __( 'No file selected', 'skyrocket' ),
					'frame_title' => __( 'Select File', 'skyrocket' ),
					'frame_button' => __( 'Choose File', 'skyrocket' ),
				)
			)
		) );

		// Test of Image Control
		$wp_customize->add_setting( 'sample_default_image',
			array(
				'default' => $this->defaults['sample_default_image'],
				'transport' => 'refresh',
				'sanitize_callback' => 'esc_url_raw'
			)
		);
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sample_default_image',
			array(
				'label' => __( 'Default Image Control', 'skyrocket' ),
				'description' => esc_html__( 'This is the description for the Image Control', 'skyrocket' ),
				'section' => 'default_controls_section',
				'button_labels' => array(
					'select' => __( 'Select Image', 'skyrocket' ),
					'change' => __( 'Change Image', 'skyrocket' ),
					'remove' => __( 'Remove', 'skyrocket' ),
					'default' => __( 'Default', 'skyrocket' ),
					'placeholder' => __( 'No image selected', 'skyrocket' ),
					'frame_title' => __( 'Select Image', 'skyrocket' ),
					'frame_button' => __( 'Choose Image', 'skyrocket' ),
				)
			)
		) );

		// Test of Cropped Image Control
		$wp_customize->add_setting( 'sample_default_cropped_image',
			array(
				'default' => $this->defaults['sample_default_cropped_image'],
				'transport' => 'refresh',
				'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'sample_default_cropped_image',
			array(
				'label' => __( 'Default Cropped Image Control', 'skyrocket' ),
				'description' => esc_html__( 'This is the description for the Cropped Image Control', 'skyrocket' ),
				'section' => 'default_controls_section',
				'flex_width' => false,
				'flex_height' => false,
				'width' => 800,
				'height' => 400
			)
		) );

		// Test of Date/Time Control
		$wp_customize->add_setting( 'sample_date_only',
			array(
				'default' => $this->defaults['sample_date_only'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_date_time_sanitization',
			)
		);
		$wp_customize->add_control( new WP_Customize_Date_Time_Control( $wp_customize, 'sample_date_only',
			array(
				'label' => __( 'Default Date Control', 'skyrocket' ),
				'description' => esc_html__( 'This is the Date Time Control but is only displaying a date field. It also has Max and Min years set.', 'skyrocket' ),
				'section' => 'default_controls_section',
				'include_time' => false,
				'allow_past_date' => true,
				'twelve_hour_format' => true,
				'min_year' => '2016',
				'max_year' => '2025',
			)
		) );

		// Test of Date/Time Control
		$wp_customize->add_setting( 'sample_date_time',
			array(
				'default' => $this->defaults['sample_date_time'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_date_time_sanitization',
			)
		);
		$wp_customize->add_control( new WP_Customize_Date_Time_Control( $wp_customize, 'sample_date_time',
			array(
				'label' => __( 'Default Date Control', 'skyrocket' ),
				'description' => esc_html__( 'This is the Date Time Control. It also has Max and Min years set.', 'skyrocket' ),
				'section' => 'default_controls_section',
				'include_time' => true,
				'allow_past_date' => true,
				'twelve_hour_format' => true,
				'min_year' => '2010',
				'max_year' => '2020',
			)
		) );

		// Test of Date/Time Control
		$wp_customize->add_setting( 'sample_date_time_no_past_date',
			array(
				'default' => $this->defaults['sample_date_time_no_past_date'],
				'transport' => 'refresh',
				'sanitize_callback' => 'skyrocket_date_time_sanitization',
			)
		);
		$wp_customize->add_control( new WP_Customize_Date_Time_Control( $wp_customize, 'sample_date_time_no_past_date',
			array(
				'label' => __( 'Default Date Control', 'skyrocket' ),
				'description' => esc_html__( "This is the Date Time Control but is only displaying a date field. Past dates are not allowed.", 'skyrocket' ),
				'section' => 'default_controls_section',
				'include_time' => false,
				'allow_past_date' => false,
				'twelve_hour_format' => true,
				'min_year' => '2016',
				'max_year' => '2099',
			)
		) );
	}
}

/**
 * Render Callback for displaying the footer credits
 */
function skyrocket_get_credits_render_callback() {
	echo skyrocket_get_credits();
}

/**
 * Load all our Customizer Custom Controls
 */
require_once trailingslashit( dirname(__FILE__) ) . 'custom-controls.php';

/**
 * Initialise our Customizer settings
 */
$skyrocket_settings = new skyrocket_initialise_customizer_settings();
