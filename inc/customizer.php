<?php
/**
 * Ephemeris Customizer Setup and Custom Controls
 *
 */

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class ephemeris_initialise_customizer_settings {
	// Get our default values
	private $defaults;

	public function __construct() {
		// Get our Customizer defaults
		$this->defaults = ephemeris_generate_defaults();

		// Register our Panels
		add_action( 'customize_register', array( $this, 'ephemeris_add_customizer_panels' ) );

		// Register our sections
		add_action( 'customize_register', array( $this, 'ephemeris_add_customizer_sections' ) );

		// Register our social media controls
		add_action( 'customize_register', array( $this, 'ephemeris_register_social_controls' ) );

		// Register our contact controls
		add_action( 'customize_register', array( $this, 'ephemeris_register_contact_controls' ) );

		// Register our search controls
		add_action( 'customize_register', array( $this, 'ephemeris_register_search_controls' ) );

		// Register our WooCommerce controls, only if WooCommerce is active
		if( ephemeris_is_woocommerce_active() ) {
			add_action( 'customize_register', array( $this, 'ephemeris_register_woocommerce_controls' ) );
		}

		// Register our sample Custom Control controls
		add_action( 'customize_register', array( $this, 'ephemeris_register_sample_custom_controls' ) );

		// Register our sample default controls
		add_action( 'customize_register', array( $this, 'ephemeris_register_sample_default_controls' ) );

	}

	/**
	 * Register the Customizer panels
	 */
	public function ephemeris_add_customizer_panels( $wp_customize ) {
		/**
		 * Add our Header & Navigation Panel
		 */
		 $wp_customize->add_panel( 'header_naviation_panel',
		 	array(
				'title' => __( 'Header & Navigation' ),
				'description' => esc_html__( 'Adjust your Header and Navigation sections.' )
			)
		);
	}

	/**
	 * Register the Customizer sections
	 */
	public function ephemeris_add_customizer_sections( $wp_customize ) {
		/**
		 * Add our Social Icons Section
		 */
		$wp_customize->add_section( 'social_icons_section',
			array(
				'title' => __(  'Social Icons' ),
				'description' => esc_html__(  'Add your social media links and we’ll automatically match them with the appropriate icons. Drag and drop the URLs to rearrange their order.' ),
				'panel' => 'header_naviation_panel'
			)
		);

		/**
		 * Add our Contact Section
		 */
		$wp_customize->add_section( 'contact_section',
			array(
				'title' => __(  'Contact' ),
				'description' => esc_html__(  'Add your phone number to the site header bar.' ),
				'panel' => 'header_naviation_panel'
			)
		);

		/**
		 * Add our Search Section
		 */
		$wp_customize->add_section( 'search_section',
			array(
				'title' => __(  'Search' ),
				'description' => esc_html__(  'Add a search icon to your primary naigation menu.' ),
				'panel' => 'header_naviation_panel'
			)
		);

		/**
		 * Add our WooCommerce Layout Section, only if WooCommerce is active
		 */
		$wp_customize->add_section( 'woocommerce_layout_section',
  			array(
  				'title' => __(  'WooCommerce Layout' ),
  				'description' => esc_html__(  'Adjust the layout of your WooCommerce shop.' ),
 				'active_callback' => 'ephemeris_is_woocommerce_active'
  			)
 		);

		$wp_customize->add_section( 'sample_custom_controls_section',
			array(
				'title' => __(  'Sample Custom Controls' ),
				'description' => esc_html__(  'These are an example of Customizer Custom Controls.' )
			)
		);

		$wp_customize->add_section( 'default_controls_section',
			array(
				'title' => __(  'Default Controls' ),
				'description' => esc_html__(  'These are an example of the default Customizer Controls.' )
			)
		);

	}

	/**
	 * Register our social media controls
	 */
	public function ephemeris_register_social_controls( $wp_customize ) {

		// Add our Checkbox switch setting and control for opening URLs in a new tab
		$wp_customize->add_setting( 'social_newtab',
			array(
				'default' => $this->defaults['social_newtab'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'ephemeris_switch_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Toggle_Switch_Custom_control( $wp_customize, 'social_newtab',
			array(
				'label' => esc_html__( 'Open in new browser tab', 'ephemeris' ),
				'type' => 'checkbox',
				'section' => 'social_icons_section'
			)
		) );
		$wp_customize->selective_refresh->add_partial( 'social_newtab',
			array(
				'selector' => '.social',
				'container_inclusive' => false,
				'render_callback' => function() {
					echo ephemeris_get_social_media();
				},
				'fallback_refresh' => true
			)
		);

		// Add our Text Radio Button setting and Custom Control for controlling alignment of icons
		$wp_customize->add_setting( 'social_alignment',
			array(
				'default' => $this->defaults['social_alignment'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'ephemeris_text_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Text_Radio_Button_Custom_Control( $wp_customize, 'social_alignment',
			array(
				'label' => esc_attr__( 'Alignment', 'ephemeris' ),
				'description' => esc_attr__( 'Choose the alignment for your social icons', 'ephemeris' ),
				'section' => 'social_icons_section',
				'choices' => array(
					'alignleft' => esc_html__( 'Left' ),
					'alignright' => esc_html__( 'Right' )
				)
			)
		) );
		$wp_customize->selective_refresh->add_partial( 'social_alignment',
			array(
				'selector' => '.social',
				'container_inclusive' => false,
				'render_callback' => function() {
					echo ephemeris_get_social_media();
				},
				'fallback_refresh' => true
			)
		);

		// Add our Sortable Repeater setting and Custom Control for Social media URLs
		$wp_customize->add_setting( 'social_urls',
			array(
				'default' => $this->defaults['social_urls'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'ephemeris_url_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Sortable_Repeater_Custom_Control( $wp_customize, 'social_urls',
			array(
				'label' => esc_html__( 'Social URLs', 'ephemeris' ),
				'description' => esc_html__( 'Add your social media links.', 'ephemeris' ),
				'section' => 'social_icons_section'
			)
		) );
		$wp_customize->selective_refresh->add_partial( 'social_urls',
			array(
				'selector' => '.social',
				'container_inclusive' => false,
				'render_callback' => function() {
					echo ephemeris_get_social_media();
				},
				'fallback_refresh' => true
			)
		);

		// Add our Single Accordion setting and Custom Control to list the available Social Media icons
		$socialIconsList = array(
			'Behance' => esc_html__( 'fa-behance', 'ephemeris' ),
			'Bitbucket' => esc_html__( 'fa-bitbucket', 'ephemeris' ),
			'CodePen' => esc_html__( 'fa-codepen', 'ephemeris' ),
			'DeviantArt' => esc_html__( 'fa-deviantart', 'ephemeris' ),
			'Dribbble' => esc_html__( 'fa-dribbble', 'ephemeris' ),
			'Etsy' => esc_html__( 'fa-etsy', 'ephemeris' ),
			'Facebook' => esc_html__( 'fa-facebook', 'ephemeris' ),
			'Flickr' => esc_html__( 'fa-flickr', 'ephemeris' ),
			'Foursquare' => esc_html__( 'fa-foursquare', 'ephemeris' ),
			'GitHub' => esc_html__( 'fa-github', 'ephemeris' ),
			'Instagram' => esc_html__( 'fa-instagram', 'ephemeris' ),
			'Last.fm' => esc_html__( 'fa-lastfm', 'ephemeris' ),
			'LinkedIn' => esc_html__( 'fa-linkedin', 'ephemeris' ),
			'Medium' => esc_html__( 'fa-medium', 'ephemeris' ),
			'Pinterest' => esc_html__( 'fa-pinterest', 'ephemeris' ),
			'Google+' => esc_html__( 'fa-google-plus', 'ephemeris' ),
			'Reddit' => esc_html__( 'fa-reddit', 'ephemeris' ),
			'Slack' => esc_html__( 'fa-slack', 'ephemeris' ),
			'SlideShare' => esc_html__( 'fa-slideshare', 'ephemeris' ),
			'Snapchat' => esc_html__( 'fa-snapchat', 'ephemeris' ),
			'SoundCloud' => esc_html__( 'fa-soundcloud', 'ephemeris' ),
			'Spotify' => esc_html__( 'fa-spotify', 'ephemeris' ),
			'Stack Overflow' => esc_html__( 'fa-stack-overflow', 'ephemeris' ),
			'Tumblr' => esc_html__( 'fa-tumblr', 'ephemeris' ),
			'Twitch' => esc_html__( 'fa-twitch', 'ephemeris' ),
			'Twitter' => esc_html__( 'fa-twitter', 'ephemeris' ),
			'Vimeo' => esc_html__( 'fa-vimeo', 'ephemeris' ),
			'YouTube' => esc_html__( 'fa-youtube', 'ephemeris' )
		);
		$wp_customize->add_setting( 'social_url_icons',
			array(
				'default' => $this->defaults['social_url_icons'],
				'transport' => 'refresh',
				'sanitize_callback' => 'ephemeris_text_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Single_Accordion_Custom_Control( $wp_customize, 'social_url_icons',
			array(
				'label' => esc_html__( 'View list of available icons', 'ephemeris' ),
				'description' => $socialIconsList,
				'section' => 'social_icons_section'
			)
		) );

		// Add our Checkbox switch setting and Custom Control for displaying an RSS icon
		$wp_customize->add_setting( 'social_rss',
			array(
				'default' => $this->defaults['social_rss'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'ephemeris_switch_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Toggle_Switch_Custom_control( $wp_customize, 'social_rss',
			array(
				'label' => esc_html__( 'Display RSS icon', 'ephemeris' ),
				'type' => 'checkbox',
				'section' => 'social_icons_section'
			)
		) );
		$wp_customize->selective_refresh->add_partial( 'social_rss',
			array(
				'selector' => '.social',
				'container_inclusive' => false,
				'render_callback' => function() {
					echo ephemeris_get_social_media();
				},
				'fallback_refresh' => true
			)
		);

	}

	/**
	 * Register our Contact controls
	 */
	public function ephemeris_register_contact_controls( $wp_customize ) {
		// Add our Text field setting and Control for displaying the phone number
		$wp_customize->add_setting( 'contact_phone',
			array(
				'default' => $this->defaults['contact_phone'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'ephemeris_text_sanitization'
			)
		);
		$wp_customize->add_control( 'contact_phone',
			array(
				'label' => esc_html__( 'Display phone number', 'ephemeris' ),
				'type' => 'text',
				'section' => 'contact_section'
			)
		);
		$wp_customize->selective_refresh->add_partial( 'contact_phone',
			array(
				'selector' => '.social',
				'container_inclusive' => false,
				'render_callback' => function() {
					echo ephemeris_get_social_media();
				},
				'fallback_refresh' => true
			)
		);

	}

	/**
	 * Register our Search controls
	 */
	public function ephemeris_register_search_controls( $wp_customize ) {
		// Add our Checkbox switch setting and control for opening URLs in a new tab
		$wp_customize->add_setting( 'search_menu_icon',
			array(
				'default' => $this->defaults['search_menu_icon'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'ephemeris_switch_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Toggle_Switch_Custom_control( $wp_customize, 'search_menu_icon',
			array(
				'label' => esc_html__( 'Display Search Icon', 'ephemeris' ),
				'type' => 'checkbox',
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
	public function ephemeris_register_woocommerce_controls( $wp_customize ) {

		// Add our Checkbox switch setting and control for displaying a sidebar on the shop page
		$wp_customize->add_setting( 'woocommerce_shop_sidebar',
			array(
				'default' => $this->defaults['woocommerce_shop_sidebar'],
				'transport' => 'refresh',
				'sanitize_callback' => 'ephemeris_switch_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Toggle_Switch_Custom_control( $wp_customize, 'woocommerce_shop_sidebar',
			array(
				'label' => esc_html__( 'Shop page sidebar', 'ephemeris' ),
				'type' => 'checkbox',
				'section' => 'woocommerce_layout_section'
			)
		) );

		// Add our Checkbox switch setting and control for displaying a sidebar on the single product page
		$wp_customize->add_setting( 'woocommerce_product_sidebar',
			array(
				'default' => $this->defaults['woocommerce_product_sidebar'],
				'transport' => 'refresh',
				'sanitize_callback' => 'ephemeris_switch_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Toggle_Switch_Custom_control( $wp_customize, 'woocommerce_product_sidebar',
			array(
				'label' => esc_html__( 'Single Product page sidebar', 'ephemeris' ),
				'type' => 'checkbox',
				'section' => 'woocommerce_layout_section'
			)
		) );

		// Add our Simple Notice setting and control for displaying a message about the WooCommerce shop sidebars
		$wp_customize->add_setting( 'woocommerce_other_sidebar',
			array(
				'transport' => 'postMessage',
				'sanitize_callback' => 'ephemeris_text_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Simple_Notice_Custom_control( $wp_customize, 'woocommerce_other_sidebar',
			array(
				'label' => esc_html__( 'Cart, Checkout & My Account sidebars', 'ephemeris' ),
				'description' 	=> esc_html__('The Cart, Checkout and My Account pages are displayed using shortcodes. To remove the sidebar from these Pages, simply edit each Page and change the Template (in the Page Attributes Panel) to Full-width Page.', 'ephemeris'),
				'section' => 'woocommerce_layout_section'
			)
		) );

	}

	/**
	 * Register our sample custom controls
	 */
	public function ephemeris_register_sample_custom_controls( $wp_customize ) {

		// Test of Checkbox Switch Custom Control
		$wp_customize->add_setting( 'sample_checkbox_switch',
			array(
				'default' => $this->defaults['sample_checkbox_switch'],
				'transport' => 'refresh',
				'sanitize_callback' => 'ephemeris_switch_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Toggle_Switch_Custom_control( $wp_customize, 'sample_checkbox_switch',
			array(
				'label' => esc_html__( 'Checkbox switch', 'ephemeris' ),
				'type' => 'checkbox',
				'section' => 'sample_custom_controls_section'
			)
		) );

		// Test of Slider Custom Control
		$wp_customize->add_setting( 'sample_slider_control',
			array(
				'default' => $this->defaults['sample_slider_control'],
				'transport' => 'postMessage',
				'sanitize_callback' => 'ephemeris_sanitize_integer'
			)
		);
		$wp_customize->add_control( new Skyrocket_Slider_Custom_Control( $wp_customize, 'sample_slider_control',
			array(
				'label' => esc_html__( 'Slider Control (px)', 'ephemeris' ),
				'section' => 'sample_custom_controls_section',
				'input_attrs' => array(
					'min' => 10,
					'max' => 90,
					'step' => 1,
				),
			)
		) );

		// Add our Sortable Repeater setting and Custom Control for Social media URLs
		$wp_customize->add_setting( 'sample_sortable_repeater_control',
			array(
				'default' => $this->defaults['sample_sortable_repeater_control'],
				'transport' => 'refresh',
				'sanitize_callback' => 'ephemeris_url_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Sortable_Repeater_Custom_Control( $wp_customize, 'sample_sortable_repeater_control',
			array(
				'label' => esc_html__( 'Sortable Repeater', 'ephemeris' ),
				'description' => esc_html__( 'This is the field description, if needed', 'ephemeris' ),
				'section' => 'sample_custom_controls_section'
			)
		) );

		// Test of Image Radio Button Custom Control
		$wp_customize->add_setting( 'sample_image_radio_button',
			array(
				'default' => $this->defaults['sample_image_radio_button'],
				'transport' => 'refresh',
				'sanitize_callback' => 'ephemeris_text_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Image_Radio_Button_Custom_Control( $wp_customize, 'sample_image_radio_button',
			array(
				'label' => esc_attr__( 'Image Radio Button Control', 'ephemeris' ),
				'description' => esc_attr__( 'Sample custom control description', 'ephemeris' ),
				'section' => 'sample_custom_controls_section',
				'choices' => array(
					'sidebarleft' => array(
						'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-left.png',
						'name' => esc_html__( 'Left Sidebar' )
					),
					'sidebarnone' => array(
						'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-none.png',
						'name' => esc_html__( 'No Sidebar' )
					),
					'sidebarright' => array(
						'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-right.png',
						'name' => esc_html__( 'Right Sidebar' )
					)
				)
			)
		) );

		// Test of Text Radio Button Custom Control
		$wp_customize->add_setting( 'sample_text_radio_button',
			array(
				'default' => $this->defaults['sample_text_radio_button'],
				'transport' => 'refresh',
				'sanitize_callback' => 'ephemeris_text_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Text_Radio_Button_Custom_Control( $wp_customize, 'sample_text_radio_button',
			array(
				'label' => esc_attr__( 'Text Radio Button Control', 'ephemeris' ),
				'description' => esc_attr__( 'Sample custom control description', 'ephemeris' ),
				'section' => 'sample_custom_controls_section',
				'choices' => array(
					'left' => esc_html__( 'Left' ),
					'centered' => esc_html__( 'Centered' ),
					'right' => esc_html__( 'Right' )
				)
			)
		) );

		// Test of Image Checkbox Custom Control
		$wp_customize->add_setting( 'sample_image_checkbox',
			array(
				'default' => $this->defaults['sample_image_checkbox'],
				'transport' => 'refresh',
				'sanitize_callback' => 'ephemeris_text_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Image_checkbox_Custom_Control( $wp_customize, 'sample_image_checkbox',
			array(
				'label' => esc_attr__( 'Image Checkbox Control', 'ephemeris' ),
				'description' => esc_attr__( 'Sample custom control description', 'ephemeris' ),
				'section' => 'sample_custom_controls_section',
				'choices' => array(
					'stylebold' => array(
						'image' => trailingslashit( get_template_directory_uri() ) . 'images/Bold.png',
						'name' => esc_html__( 'Bold' )
					),
					'styleitalic' => array(
						'image' => trailingslashit( get_template_directory_uri() ) . 'images/Italic.png',
						'name' => esc_html__( 'Italic' )
					),
					'styleallcaps' => array(
						'image' => trailingslashit( get_template_directory_uri() ) . 'images/AllCaps.png',
						'name' => esc_html__( 'All Caps' )
					),
					'styleunderline' => array(
						'image' => trailingslashit( get_template_directory_uri() ) . 'images/Underline.png',
						'name' => esc_html__( 'Underline' )
					)
				)
			)
		) );

		// Test of Single Accordion Control
		$sampleIconsList = array(
			'Behance' => esc_html__( 'fa-behance', 'ephemeris' ),
			'Bitbucket' => esc_html__( 'fa-bitbucket', 'ephemeris' ),
			'CodePen' => esc_html__( 'fa-codepen', 'ephemeris' ),
			'DeviantArt' => esc_html__( 'fa-deviantart', 'ephemeris' ),
			'Dribbble' => esc_html__( 'fa-dribbble', 'ephemeris' ),
			'Etsy' => esc_html__( 'fa-etsy', 'ephemeris' ),
			'Facebook' => esc_html__( 'fa-facebook', 'ephemeris' ),
			'Flickr' => esc_html__( 'fa-flickr', 'ephemeris' ),
			'Foursquare' => esc_html__( 'fa-foursquare', 'ephemeris' ),
			'GitHub' => esc_html__( 'fa-github', 'ephemeris' ),
		);
		$wp_customize->add_setting( 'sample_single_accordion',
			array(
				'default' => $this->defaults['sample_single_accordion'],
				'transport' => 'refresh',
				'sanitize_callback' => 'ephemeris_text_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Single_Accordion_Custom_Control( $wp_customize, 'sample_single_accordion',
			array(
				'label' => esc_html__( 'Single Accordion Control', 'ephemeris' ),
				'description' => $sampleIconsList,
				'section' => 'sample_custom_controls_section'
			)
		) );

		// Test of Alpha Color Picker Control
		$wp_customize->add_setting( 'sample_alpha_color_picker',
			array(
				'default' => $this->defaults['sample_alpha_color_picker'],
				'transport' => 'postMessage'
			)
		);
		$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'sample_alpha_color_picker',
			array(
				'label' => esc_attr__( 'Alpha Color Picker Control', 'ephemeris' ),
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

		// Test of Simple Notice control
		$wp_customize->add_setting( 'sample_simple_notice',
			array(
				'transport' => 'postMessage',
				'sanitize_callback' => 'ephemeris_text_sanitization'
			)
		);
		$wp_customize->add_control( new Skyrocket_Simple_Notice_Custom_control( $wp_customize, 'sample_simple_notice',
			array(
				'label' => esc_html__( 'Simple Notice Control', 'ephemeris' ),
				'description' 	=> esc_html__('This Custom Control allows you to display a simple title and description to your users.', 'ephemeris'),
				'section' => 'sample_custom_controls_section'
			)
		) );

		// Test of Google Font Select Control
		$wp_customize->add_setting( 'sample_google_font_select',
			array(
			 'default' => $this->defaults['sample_google_font_select'],
			)
		);
		$wp_customize->add_control( new Skyrocket_Google_Font_Select_Custom_Control( $wp_customize, 'sample_google_font_select',
			array(
				'label' => esc_attr__( 'Google Font Control', 'ephemeris' ),
				'description' => esc_attr__( 'Sample custom control description', 'ephemeris' ),
				'section' => 'sample_custom_controls_section',
			)
		) );

	}

	/**
	 * Register our sample default controls
	 */
	public function ephemeris_register_sample_default_controls( $wp_customize ) {

		// Test of Text Control
		$wp_customize->add_setting( 'sample_default_text',
			array(
				'default' => $this->defaults['sample_default_text'],
				'transport' => 'refresh'
			)
		);
		$wp_customize->add_control( 'sample_default_text',
			array(
 				'label' => 'Default Text Control',
 				'description' => 'Text controls Type can be either text, email, url, number, hidden, or date',
  				'section' => 'default_controls_section',
 				'type' => 'text',
				'input_attrs' => array(
					'class' => 'my-custom-class',
					'style' => 'border: 1px solid rebeccapurple',
					'placeholder' => __( 'Enter name...' ),
				),
  			)
  		);

		// Test of Email Control
		$wp_customize->add_setting( 'sample_email_text',
			array(
				'default' => $this->defaults['sample_email_text'],
				'transport' => 'refresh'
			)
		);
		$wp_customize->add_control( 'sample_email_text',
			array(
				'label' => 'Default Email Control',
				'description' => 'Text controls Type can be either text, email, url, number, hidden, or date',
				'section' => 'default_controls_section',
				'type' => 'email'
			)
		);

		// Test of URL Control
		$wp_customize->add_setting( 'sample_url_text',
			array(
				'default' => $this->defaults['sample_url_text'],
				'transport' => 'refresh'
			)
		);
		$wp_customize->add_control( 'sample_url_text',
			array(
				'label' => 'Default URL Control',
				'description' => 'Text controls Type can be either text, email, url, number, hidden, or date',
				'section' => 'default_controls_section',
				'type' => 'url'
			)
		);

		// Test of Number Control
		$wp_customize->add_setting( 'sample_number_text',
			array(
				'default' => $this->defaults['sample_number_text'],
				'transport' => 'refresh'
			)
		);
		$wp_customize->add_control( 'sample_number_text',
			array(
				'label' => 'Default Number Control',
				'description' => 'Text controls Type can be either text, email, url, number, hidden, or date',
				'section' => 'default_controls_section',
				'type' => 'number'
			)
		);

		// Test of Hidden Control
		$wp_customize->add_setting( 'sample_hidden_text',
			array(
				'default' => $this->defaults['sample_hidden_text'],
				'transport' => 'refresh'
			)
		);
		$wp_customize->add_control( 'sample_hidden_text',
			array(
				'label' => 'Default Hidden Control',
				'description' => 'Text controls Type can be either text, email, url, number, hidden, or date',
				'section' => 'default_controls_section',
				'type' => 'hidden'
			)
		);

		// Test of Date Control
		$wp_customize->add_setting( 'sample_date_text',
			array(
				'default' => $this->defaults['sample_date_text'],
				'transport' => 'refresh'
			)
		);
		$wp_customize->add_control( 'sample_date_text',
			array(
				'label' => 'Default Date Control',
				'description' => 'Text controls Type can be either text, email, url, number, hidden, or date',
				'section' => 'default_controls_section',
				'type' => 'text'
			)
		);

		 // Test of Standard Checkbox Control
		$wp_customize->add_setting( 'sample_default_checkbox',
			array(
				'default' => $this->defaults['sample_default_checkbox'],
				'transport' => 'refresh'
			)
		);
		$wp_customize->add_control( 'sample_default_checkbox',
			array(
				'label' => esc_html__( 'Default Checkbox Control', 'ephemeris' ),
				'description' => 'Sample Checkbox description',
				'section'  => 'default_controls_section',
				'type'=> 'checkbox'
			)
		);

 		// Test of Standard Select Control
		$wp_customize->add_setting( 'sample_default_select',
			array(
				'default'=> $this->defaults['sample_default_select'],
				'transport' => 'refresh'
			)
		);
		$wp_customize->add_control( 'sample_default_select',
			array(
				'label' => 'Standard Select Control',
				'section' => 'default_controls_section',
				'type' => 'select',
				'choices' => array(
					'wordpress' => 'WordPress',
					'hamsters' => 'Hamsters',
					'jet-fuel' => 'Jet Fuel',
					'nuclear-energy' => 'Nuclear Energy'
				)
			)
		);

		// Test of Standard Radio Control
		$wp_customize->add_setting( 'sample_default_radio',
			array(
				'default'=> $this->defaults['sample_default_radio'],
				'transport' => 'refresh'
			)
		);
		$wp_customize->add_control( 'sample_default_radio',
			array(
				'label' => 'Standard Radio Control',
				'section' => 'default_controls_section',
				'type' => 'radio',
				'choices' => array(
					'captain-america' => 'Captain America',
					'iron-man' => 'Iron Man',
					'spider-man' => 'Spider-Man',
					'thor' => 'Thor'
				)
			)
		);

		// Test of Dropdown Pages Control
		$wp_customize->add_setting( 'sample_default_dropdownpages',
			array(
				'default' => $this->defaults['sample_default_dropdownpages'],
				'transport' => 'refresh'
			)
		);
		$wp_customize->add_control( 'sample_default_dropdownpages',
			array(
				'label' => 'Default Dropdown Pages Control',
				'section' => 'default_controls_section',
				'type' => 'dropdown-pages'
			)
		);

		// Test of Textarea Control
		$wp_customize->add_setting( 'sample_default_textarea',
			array(
				'default' => $this->defaults['sample_default_textarea'],
				'transport' => 'refresh'
			)
		);
		$wp_customize->add_control( 'sample_default_textarea',
			array(
				'label' => 'Default Textarea Control',
				'section' => 'default_controls_section',
				'type' => 'textarea',
				'input_attrs' => array(
					'class' => 'my-custom-class',
					'style' => 'border: 1px solid #999',
					'placeholder' => __( 'Enter message...' ),
				),
			)
		);

		// Test of Color Control
		$wp_customize->add_setting( 'sample_default_color',
			array(
				'default' => $this->defaults['sample_default_color'],
				'transport' => 'refresh'
			)
		);
		$wp_customize->add_control( 'sample_default_color',
			array(
				'label' => 'Default Color Control',
				'section' => 'default_controls_section',
				'type' => 'color'
			)
		);

	}
}

/**
 * Load all our Customizer Custom Controls
 */
require_once trailingslashit( dirname(__FILE__) ) . 'custom-controls.php';

/**
 * Initialise our Customizer settings
 */
$ephemeris_settings = new ephemeris_initialise_customizer_settings();
