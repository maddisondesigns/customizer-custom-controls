<?php
/**
 * Skyrocket Customizer Custom Controls
 *
 */

if ( class_exists( 'WP_Customize_Control' ) ) {
	/**
	 * Image Check Box Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	 class Skyrocket_Image_Checkbox_Custom_Control extends WP_Customize_Control {
 		/**
 		 * The type of control being rendered
 		 */
  		public $type = 'image_checkbox';
 		/**
 		 * Enqueue our scripts and styles
 		 */
  		public function enqueue() {
 			wp_enqueue_style( 'skyrocket_custom_controls_css', trailingslashit( get_template_directory_uri() ) . 'css/customizer.css', array(), '1.0', 'all' );
  		}
 		/**
 		 * Render the control in the customizer
 		 */
  		public function render_content() {
  		?>
 			<div class="image_checkbox_control">
 				<?php if( !empty( $this->label ) ) { ?>
 					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
 				<?php } ?>
 				<?php if( !empty( $this->description ) ) { ?>
 					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
 				<?php } ?>
				<?	$chkboxValues = explode( ',', esc_attr( $this->value() ) ); ?>
				<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-multi-image-checkbox" <?php $this->link(); ?> />
 				<?php foreach ( $this->choices as $key => $value ) { ?>
 					<label class="checkbox-label">
 						<input type="checkbox" name="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php checked( in_array( esc_attr( $key ), $chkboxValues ), 1 ); ?> class="multi-image-checkbox"/>
 						<img src="<?php echo esc_attr( $value['image'] ); ?>" alt="<?php echo esc_attr( $value['name'] ); ?>" title="<?php echo esc_attr( $value['name'] ); ?>" />
 					</label>
 				<?php	} ?>
 			</div>
  		<?php
  		}
  	}

	/**
	 * Text Radio Button Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	 class Skyrocket_Text_Radio_Button_Custom_Control extends WP_Customize_Control {
 		/**
 		 * The type of control being rendered
 		 */
  		public $type = 'text_radio_button';
 		/**
 		 * Enqueue our scripts and styles
 		 */
  		public function enqueue() {
 			wp_enqueue_style( 'skyrocket_custom_controls_css', trailingslashit( get_template_directory_uri() ) . 'css/customizer.css', array(), '1.0', 'all' );
  		}
 		/**
 		 * Render the control in the customizer
 		 */
  		public function render_content() {
  		?>
 			<div class="text_radio_button_control">
 				<?php if( !empty( $this->label ) ) { ?>
 					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
 				<?php } ?>
 				<?php if( !empty( $this->description ) ) { ?>
 					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
 				<?php } ?>

				<div class="radio-buttons">
					<?php foreach ( $this->choices as $key => $value ) { ?>
	 					<label class="radio-button-label">
	 						<input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php $this->link(); ?> <?php checked( esc_attr( $key ), $this->value() ); ?>/>
	 						<span><?php echo esc_attr( $value ); ?></span>
	 					</label>
	 				<?php	} ?>
				</div>
 			</div>
  		<?php
  		}
  	}

	/**
	 * Image Radio Button Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class Skyrocket_Image_Radio_Button_Custom_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
 		public $type = 'image_radio_button';
		/**
		 * Enqueue our scripts and styles
		 */
 		public function enqueue() {
			wp_enqueue_style( 'skyrocket_custom_controls_css', trailingslashit( get_template_directory_uri() ) . 'css/customizer.css', array(), '1.0', 'all' );
 		}
		/**
		 * Render the control in the customizer
		 */
 		public function render_content() {
 		?>
			<div class="image_radio_button_control">
				<?php if( !empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>

				<?php foreach ( $this->choices as $key => $value ) { ?>
					<label class="radio-button-label">
						<input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php $this->link(); ?> <?php checked( esc_attr( $key ), $this->value() ); ?>/>
						<img src="<?php echo esc_attr( $value['image'] ); ?>" alt="<?php echo esc_attr( $value['name'] ); ?>" title="<?php echo esc_attr( $value['name'] ); ?>" />
					</label>
				<?php	} ?>
			</div>
 		<?php
 		}
 	}

	/**
	 * Single Accordion Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class Skyrocket_Single_Accordion_Custom_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'single_accordion';
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_script( 'skyrocket_custom_controls_js', trailingslashit( get_template_directory_uri() ) . 'js/customizer.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_style( 'skyrocket_custom_controls_css', trailingslashit( get_template_directory_uri() ) . 'css/customizer.css', array(), '1.0', 'all' );
			wp_enqueue_style( 'fontawesome', trailingslashit( get_template_directory_uri() ) . 'css/font-awesome.min.css', array(), '4.6.3', 'all' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
 			$allowed_html = array(
 				'a' => array(
 					'href' => array(),
 					'title' => array(),
 					'class' => array(),
 				),
 				'br' => array(),
 				'em' => array(),
 				'strong' => array(),
 				'i' => array(
 					'class' => array()
 				),
 			);
 		?>
 			<div class="single-accordion-custom-control">
 				<div class="single-accordion-toggle"><?php esc_html_e( $this->label, 'ephemeris' ); ?><span class="accordion-icon-toggle dashicons dashicons-plus"></span></div>
 				<div class="single-accordion customize-control-description">
 					<?php
 						if ( is_array( $this->description ) ) {
 							echo '<ul class="single-accordion-description">';
 					  		foreach ( $this->description as $key => $value ) {
 								echo '<li>' . $key . wp_kses( $value, $allowed_html ) . '</li>';
 							}
 							echo '</ul>';
 						}
 						else {
 							echo wp_kses( $this->description, $allowed_html );
 						}
 				  ?>
 				</div>
 			</div>
 		<?php
 		}
	}

	/**
	 * Simple Notice Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class Skyrocket_Simple_Notice_Custom_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'simple_notice';
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
		?>
			<div class="simple-notice-custom-control">
				<?php if( !empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
				<?php } ?>
			</div>
		<?php
		}
	}

	/**
	 * Slider Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class Skyrocket_Slider_Custom_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'slider_control';
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_script( 'skyrocket_custom_controls_js', trailingslashit( get_template_directory_uri() ) . 'js/customizer.js', array( 'jquery', 'jquery-ui-core' ), '1.0', true );
			wp_enqueue_style( 'skyrocket_custom_controls_css', trailingslashit( get_template_directory_uri() ) . 'css/customizer.css', array(), '1.0', 'all' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
		?>
			<div class="slider-custom-control">
				<span class="customize-control-title"><?php esc_html_e( $this->label, 'ephemeris' ); ?></span><input type="number" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-slider-value" <?php $this->link(); ?> />
				<div class="slider" slider-min-value="<?php echo esc_attr( $this->input_attrs['min'] ); ?>" slider-max-value="<?php echo esc_attr( $this->input_attrs['max'] ); ?>" slider-step-value="<?php echo esc_attr( $this->input_attrs['step'] ); ?>"></div><span class="slider-reset dashicons dashicons-image-rotate" slider-reset-value="<?php echo esc_attr( $this->value() ); ?>"></span>
			</div>
		<?php
		}
	}

	/**
	 * Toggle Switch Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class Skyrocket_Toggle_Switch_Custom_control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'toogle_switch';
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue(){
			wp_enqueue_style( 'skyrocket_custom_controls_css', trailingslashit( get_template_directory_uri() ) . 'css/customizer.css', array(), '1.0', 'all' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content(){
		?>
			<div class="toggle-switch-control">
				<div class="toggle-switch">
					<input type="checkbox" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" class="toggle-switch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?>>
					<label class="toggle-switch-label" for="<?php echo esc_attr($this->id); ?>">
						<span class="toggle-switch-inner"></span>
						<span class="toggle-switch-switch"></span>
					</label>
				</div>
				<span class="customize-control-title"><?php esc_html_e( $this->label, 'ephemeris' ); ?></span>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
			</div>
		<?php
		}
	}

	/**
	 * Sortable Repeater Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class Skyrocket_Sortable_Repeater_Custom_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'sortable_repeater';
		/**
 		 * Button labels
 		 */
		public $button_labels = array();
		/**
		 * Constructor
		 */
		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			parent::__construct( $manager, $id, $args );
			// Merge the passed button labels with our default labels
			$this->button_labels = wp_parse_args( $this->button_labels,
				array(
					'add' => __( 'Add' ),
				)
			);
		}
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_script( 'skyrocket_custom_controls_js', trailingslashit( get_template_directory_uri() ) . 'js/customizer.js', array( 'jquery', 'jquery-ui-core' ), '1.0', true );
			wp_enqueue_style( 'skyrocket_custom_controls_css', trailingslashit( get_template_directory_uri() ) . 'css/customizer.css', array(), '1.0', 'all' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
		?>
	      <div class="sortable_repeater_control">
				<?php if( !empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-sortable-repeater" <?php $this->link(); ?> />
				<div class="sortable">
					<div class="repeater">
						<input type="text" value="" class="repeater-input" placeholder="http://" /><span class="dashicons dashicons-sort"></span><a class="customize-control-sortable-repeater-delete" href="#"><span class="dashicons dashicons-no-alt"></span></a>
					</div>
				</div>
				<button class="button customize-control-sortable-repeater-add" type="button"><?php echo $this->button_labels['add']; ?></button>
			</div>
		<?php
		}
	}

	/**
	 * Googe Font Select Custom Control
	 *
	 * @author Anthony Hortin <http://maddisondesigns.com>
	 * @license http://www.gnu.org/licenses/gpl-2.0.html
	 * @link https://github.com/maddisondesigns
	 */
	class Skyrocket_Google_Font_Select_Custom_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'google_fonts';
		/**
		 * The list of Google Fonts
		 */
		private $fontList = false;
		/**
		 * The saved font values decoded from json
		 */
		private $fontValues = [];
		/**
		 * The index of the saved font within the list of Google fonts
		 */
		private $fontListIndex = 0;
		/**
		 * Get our list of fonts from the json file
		 */
		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			parent::__construct( $manager, $id, $args );
			//Get the list of Google fonts
			$this->fontList = $this->getGoogleFonts();
			// Convert the saved json font data to an array
			$this->fontValues = json_decode( $this->value() );
			// Find the index of our saved font within our list of Google fonts
			$this->fontListIndex = $this->getFontIndex( $this->fontList, $this->fontValues->font );
		}
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_script( 'skyrocket_custom_controls_js', trailingslashit( get_template_directory_uri() ) . 'js/customizer.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_style( 'skyrocket_custom_controls_css', trailingslashit( get_template_directory_uri() ) . 'css/customizer.css', array(), '1.0', 'all' );
		}
		/**
		 * Export our List of Google Fonts to JavaScript
		 */
		public function to_json() {
			parent::to_json();
			$this->json['skyrocketfontslist'] = $this->fontList;
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			if( !empty($this->fontList) ) {
				?>
				<div class="google_fonts_select_control">
					<?php if( !empty( $this->label ) ) { ?>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<?php } ?>
					<?php if( !empty( $this->description ) ) { ?>
						<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
					<?php } ?>
					<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-google-font-selection" <?php $this->link(); ?> />
					<div class="google-fonts">
						<select class="google-fonts-list" control-name="<?php echo esc_attr( $this->id ); ?>">
							<?php
								foreach( $this->fontList as $key => $value ) {
									echo '<option value="' . $value->family . '" ' . selected( $this->fontValues->font, $value->family, false ) . '>' . $value->family . '</option>';
								}
							?>
						</select>
					</div>
					<div class="customize-control-description">Select weight &amp; style for regular text</div>
					<div class="weight-style">
						<select class="google-fonts-regularweight-style">
							<?php
								foreach( $this->fontList[$this->fontListIndex]->variants as $key => $value ) {
									echo '<option value="' . $value . '" ' . selected( $this->fontValues->regularweight, $value, false ) . '>' . $value . '</option>';
								}
							?>
						</select>
					</div>
					<div class="customize-control-description">Select weight for <italic>italic text</italic></div>
					<div class="weight-style">
						<select class="google-fonts-italicweight-style" <?php disabled( in_array( 'italic', $this->fontList[$this->fontListIndex]->variants ), false ); ?>>
							<?php
								$optionCount = 0;
								foreach( $this->fontList[$this->fontListIndex]->variants as $key => $value ) {
									// Only add options that are italic
									if( strpos( $value, 'italic' ) !== false ) {
										echo '<option value="' . $value . '" ' . selected( $this->fontValues->italicweight, $value, false ) . '>' . $value . '</option>';
										$optionCount++;
									}
								}
								if($optionCount == 0) {
									echo '<option value="">Not Available for this font</option>';
								}
							?>
						</select>
					</div>
					<div class="customize-control-description">Select weight for <strong>bold text</strong></div>
					<div class="weight-style">
						<select class="google-fonts-boldweight-style">
							<?php
								$optionCount = 0;
								foreach( $this->fontList[$this->fontListIndex]->variants as $key => $value ) {
									// Only add options that aren't italic
									if( strpos( $value, 'italic' ) === false ) {
										echo '<option value="' . $value . '" ' . selected( $this->fontValues->boldweight, $value, false ) . '>' . $value . '</option>';
										$optionCount++;
									}
								}
								// This should never evaluate as there'll always be at least a 'regular' weight
								if($optionCount == 0) {
									echo '<option value="">Not Available for this font</option>';
								}
							?>
						</select>
					</div>
					<input type="hidden" class="google-fonts-category" value="<?php echo $this->fontValues->category; ?>">
				</div>
				<?php
			}
		}

		/**
		 * Find the index of the saved font in our multidimensional array of Google Fonts
		 */
		public function getFontIndex( $haystack, $needle ) {
			foreach( $haystack as $key => $value ) {
				if( $value->family == $needle ) {
					return $key;
				}
			}
			return false;
		}

		/**
		 * Return the list of Google Fonts from our json file
		 */
		public function getGoogleFonts( $count = 30 ) {
			// Google Fonts json generated from https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key=YOUR-API-KEY
			$fontFile = trailingslashit( get_stylesheet_directory() ) . 'inc/google-fonts-popularity.json';

			$content = json_decode( file_get_contents( $fontFile ) );

			if( $count == 'all' ) {
				return $content->items;
			} else {
				return array_slice( $content->items, 0, $count );
			}
		}
   }

	/**
 	 * Alpha Color Picker Custom Control
 	 *
 	 * @author Braad Martin <http://braadmartin.com>
 	 * @license http://www.gnu.org/licenses/gpl-3.0.html
 	 * @link https://github.com/BraadMartin/components/tree/master/customizer/alpha-color-picker
 	 */
	class Skyrocket_Customize_Alpha_Color_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'alpha-color';
		/**
		 * Add support for palettes to be passed in.
		 *
		 * Supported palette values are true, false, or an array of RGBa and Hex colors.
		 */
		public $palette;
		/**
		 * Add support for showing the opacity value on the slider handle.
		 */
		public $show_opacity;
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue() {
			wp_enqueue_script( 'skyrocket_custom_controls_js', trailingslashit( get_template_directory_uri() ) . 'js/customizer.js', array( 'jquery', 'wp-color-picker' ), '1.0', true );
			wp_enqueue_style( 'skyrocket_custom_controls_css', trailingslashit( get_template_directory_uri() ) . 'css/customizer.css', array( 'wp-color-picker' ), '1.0', 'all' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content() {

			// Process the palette
			if ( is_array( $this->palette ) ) {
				$palette = implode( '|', $this->palette );
			} else {
				// Default to true.
				$palette = ( false === $this->palette || 'false' === $this->palette ) ? 'false' : 'true';
			}

			// Support passing show_opacity as string or boolean. Default to true.
			$show_opacity = ( false === $this->show_opacity || 'false' === $this->show_opacity ) ? 'false' : 'true';

			?>
				<label>
					<?php // Output the label and description if they were passed in.
					if ( isset( $this->label ) && '' !== $this->label ) {
						echo '<span class="customize-control-title">' . sanitize_text_field( $this->label ) . '</span>';
					}
					if ( isset( $this->description ) && '' !== $this->description ) {
						echo '<span class="description customize-control-description">' . sanitize_text_field( $this->description ) . '</span>';
					} ?>
					<input class="alpha-color-control" type="text" data-show-opacity="<?php echo $show_opacity; ?>" data-palette="<?php echo esc_attr( $palette ); ?>" data-default-color="<?php echo esc_attr( $this->settings['default']->default ); ?>" <?php $this->link(); ?>  />
				</label>
			<?php
		}
	}

	/**
	 * URL sanitization function for Customizer Custom Control
	 *
	 * @param  string or array	Input to be sanitized
	 * @return string or array	Sanitized input
	 */
	if ( ! function_exists( 'ephemeris_url_sanitization' ) ) {
		function ephemeris_url_sanitization( $input ) {
			if( is_array( $input ) ) {
				foreach ($input as $key => $value) {
					$input[$key] = esc_url_raw( $value );
				}
			}
			else {
				$input = esc_url_raw( $input );
			}
			return $input;
		}
	}

	/**
	 * Switch sanitization function for Customizer Custom Control
	 *
	 * @param  string		Switch value
	 * @return integer	Sanitized value
	 */
	if ( ! function_exists( 'ephemeris_switch_sanitization' ) ) {
		function ephemeris_switch_sanitization( $input ) {
			if ( true === $input ) {
				return 1;
			} else {
				return 0;
			}
		}
	}

	/**
	 * Integer sanitization function for Customizer Custom Control
	 *
	 * @param  string		Input value to check
	 * @return integer	Returned integer value
	 */
	if ( ! function_exists( 'ephemeris_sanitize_integer' ) ) {
		function ephemeris_sanitize_integer( $input ) {
			if ( is_numeric( $input ) ) {
				return intval( $input );
			} else {
				return 0;
			}
		}
	}

	/**
	 * Text sanitization function for Customizer Custom Control
	 *
	 * @param  string or array	Input to be sanitized
	 * @return string or array	Sanitized input
	 */
	if ( ! function_exists( 'ephemeris_text_sanitization' ) ) {
		function ephemeris_text_sanitization( $input ) {
			if( is_array( $input ) ) {
				foreach ($input as $key => $value) {
					$input[$key] = wp_kses_post( $value );
				}
			}
			else {
				$input = wp_kses_post( $input );
			}
			return $input;
		}
	}

}
