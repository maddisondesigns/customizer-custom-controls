# Customizer Custom Controls #

**Author:** Anthony Hortin  
**Author URI:** https://maddisondesigns.com  
**License:** GNU General Public License v2 or later  
**License URI:** http://www.gnu.org/licenses/gpl-2.0.html  


## Description ##

There are several different types of basic Core Controls built into the Customizer that are ready to use straight-out-of-the-box. These include text, checkbox, textarea, radio, select and dropdown-pages controls. Later versions of WordPress also introduced Color, Media, Image and Cropped Image controls. If none of the basic core controls suit your needs, you can create and add your own custom controls.

This example code shows how to incorporate Customizer functionality into your theme (or plugin), including examples of how to update the Live Preview window. As well as showing the usage of the (built-in) core controls, there are also a number of Custom Controls that have been built that you're welcome to make use of.

If you'd like to learn more about Customizer development, you can check out the links to my Customizer Developer's Guide, at the end of this readme.

## Core Controls ##
Input Control (Text, Email, URL, Number, Hidden, Date)
Checkbox Control  
Select Control  
Radio Control  
Dropdown Pages Control  
Textarea Control  
Color Control  
Media Control  
Image Control  
Cropped Image Control

## Custom Controls ##

### Toggle Switch ###

The Toggle Switch Custom Control is basically just a fancy type of checkbox. It allows for two states, either off or on.

![Toggle Switch](https://maddisondesigns.com/wp-content/uploads/2017/04/ToggleSwitch.jpg "Toggle Switch")

**Usage**  
add_control( $id, $args );

**Parameters**  
**$id** - (string) (required) The id of the Setting associated with this Control. Default: None

**$args** - (array) (required) An associative array containing arguments for the setting. Default: None

**Arguments for $args**  
**label** - Optional. The label that will be displayed. Default: Blank  
**section** - Required. The Section where there control should appear  

**Example**

````
$wp_customize->add_setting( 'sample_toggle_switch',
	array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'skyrocket_switch_sanitization'
	)
);
$wp_customize->add_control( new Skyrocket_Toggle_Switch_Custom_control( $wp_customize, 'sample_toggle_switch',
	array(
		'label' => esc_html__( 'Toggle switch' ),
		'section' => 'sample_custom_controls_section'
	)
) );
````

### Slider ###

The Slider Custom Control allows you to drag a handle across a horizontal bar to increase or decrease a numeric value. The control also has a reset button, allowing you to reset the value back to the default value. The accompanying input field shows you the value of the slider whilst also giving you the ability to manually enter a value as well.

You can specify the minimum and maximum values for the slider as well as the step size, which is the size of each interval between the minimum and maximum values.

![Slider](https://maddisondesigns.com/wp-content/uploads/2017/04/SliderControl.jpg "Slider")

**Usage**  
add_control( $id, $args );

**Parameters**  
**$id** - (string) (required) The id of the Setting associated with this Control. Default: None

**$args** - (array) (required) An associative array containing arguments for the setting. Default: None

**Arguments for $args**  
**label** - Optional. The label that will be displayed Default: Blank  
**section** - Required. The Section where there control should appear  
**input_attrs** - Required. List of custom input attributes for control output.  
  **min** - Required. Minimum value for the slider  
  **max** - Required. Maximum value for the slider  
  **step** - Required. The size of each interval or step the slider takes between the min and max values

**Example**

````
$wp_customize->add_setting( 'sample_slider_control',
	array(
		'default' => 48,
		'transport' => 'postMessage',
		'sanitize_callback' => 'skyrocket_sanitize_integer'
	)
);
$wp_customize->add_control( new Skyrocket_Slider_Custom_Control( $wp_customize, 'sample_slider_control',
	array(
		'label' => esc_html__( 'Slider Control (px)' ),
		'section' => 'sample_custom_controls_section',
		'input_attrs' => array(
			'min' => 10, // Required. Minimum value for the slider
			'max' => 90, // Required. Maximum value for the slider
			'step' => 1, // Required. The size of each interval or step the slider takes between the minimum and maximum values
		),
	)
) );
````

### Sortable Repeater ###

The Sortable Repeater Custom Control allows you to collect values from one or more input fields. On top of that, the fields can be reordered by simply dragging 'n dropping each field. The control provides an icon handle for easy drag 'n drop reordering, a button for deleting a row and a button for adding a new row.

This particular Control has been designed for collecting one or more URL's and will validate the fields as such. It will also automatically add 'https://' to any url if it is missing. If you want to collect other type of data, such as plain text, simply duplicate this control and modify as necessary.

The setting for this control will be saved as a comma delimited string of URL's. To use this setting in your theme, I recommend using the PHP `explode()` function to convert the comma delimited string to an array of strings.

![Sortable Repeater](https://maddisondesigns.com/wp-content/uploads/2017/04/SortableRepeater.jpg "Sortable Repeater")

**Usage**  
add_control( $id, $args );

**Parameters**  
**$id** - (string) (required) The id of the Setting associated with this Control. Default: None

**$args** - (array) (required) An associative array containing arguments for the setting. Default: None

**Arguments for $args**  
**label** - Optional. The label that will be displayed Default: Blank  
**description** - Optional. The description to display under the label. Default: Blank.  
**section** - Required. The Section where there control should appear  
**button_labels** - Optional. Array containing a list of labels for the control  
  **add** - Optional. Button label for add button. Default: Add

**Example**

````
$wp_customize->add_setting( 'sample_sortable_repeater_control',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'skyrocket_url_sanitization'
	)
);
$wp_customize->add_control( new Skyrocket_Sortable_Repeater_Custom_Control( $wp_customize, 'sample_sortable_repeater_control',
	array(
		'label' => __( 'Sortable Repeater' ),
		'description' => esc_html__( 'This is the control description.' ),
		'section' => 'sample_custom_controls_section',
		'button_labels' => array(
			'add' => __( 'Add Row' ), // Optional. Button label for Add button. Default: Add
		)
	)
) );
````

### Image Radio Button ###

The Image Radio Button works the same as an ordinary radio button control, in that you can only choose one item out of a number of items. The difference is that it allows you to display images for each selection choice. This is useful where an image provides a better indicator for the user, than simple text. A common use of this type of control is where a user might select the layout of their site.

When adding your control, you can specify the url for the image to display, the title text to display when hovering the cursor over the image and the value for each item.

Like an ordinary radio button, the setting that gets saved to the database is the value that you specify for each radio button choice

![Image Radio Button](https://maddisondesigns.com/wp-content/uploads/2017/04/ImageRadioButton.png "Image Radio Button")

**Usage**  
add_control( $id, $args );

**Parameters**  
**$id** - (string) (required) The id of the Setting associated with this Control. Default: None

**$args** - (array) (required) An associative array containing arguments for the setting. Default: None

**Arguments for $args**  
**label** - Optional. The label that will be displayed Default: Blank  
**description** - Optional. The description to display under the label. Default: Blank.  
**section** - Required. The Section where there control should appear  
**choices** - Required. List of custom choices.  
  **key** - Required. Data that will be stored for the setting
  **image** - Required. URL for the image to display  
  **name** - Required. Title text to display

**Example**

````
$wp_customize->add_setting( 'sample_image_radio_button',
	array(
		'default' => 'sidebarright',
		'transport' => 'refresh',
		'sanitize_callback' => 'skyrocket_text_sanitization'
	)
);
$wp_customize->add_control( new Skyrocket_Image_Radio_Button_Custom_Control( $wp_customize, 'sample_image_radio_button',
	array(
		'label' => __( 'Image Radio Button Control' ),
		'description' => esc_html__( 'Sample custom control description' ),
		'section' => 'sample_custom_controls_section',
		'choices' => array(
			'sidebarleft' => array(  // Required. Value for this particular radio button choice
				'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-left.png', // Required. URL for the image
				'name' => __( 'Left Sidebar' ) // Required. Title text to display
			),
			'sidebarnone' => array(
				'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-none.png',
				'name' => __( 'No Sidebar' )
			),
			'sidebarright' => array(
				'image' => trailingslashit( get_template_directory_uri() ) . 'images/sidebar-right.png',
				'name' => __( 'Right Sidebar' )
			)
		)
	)
) );
````

### Text Radio Button ###

The Text Radio Button is another type of radio button, and again, works the same as an ordinary radio button control. The Text Radio Button simply displays the choices in a compact row of text.

When adding your control, you specify the text to display for each choice and the setting for each item.

Like an ordinary radio button, the setting that gets saved to the database is the value that you specify for each radio button choice.

![Text Radio Button](https://maddisondesigns.com/wp-content/uploads/2017/04/TextRadioButton.png "Text Radio Button")

**Usage**  
add_control( $id, $args );

**Parameters**  
**$id** - (string) (required) The id of the Setting associated with this Control. Default: None

**$args** - (array) (required) An associative array containing arguments for the setting. Default: None

**Arguments for $args**  
**label** - Optional. The label that will be displayed Default: Blank  
**description** - Optional. The description to display under the label. Default: Blank.  
**section** - Required. The Section where there control should appear  
**choices** - Required. List of custom choices.  
  **key** - Required. Data that will be stored for the setting  
  **value** - Required. Data that is displayed for the radio button choice

**Example**

````
$wp_customize->add_setting( 'sample_text_radio_button',
	array(
		'default' => 'right',
		'transport' => 'refresh',
		'sanitize_callback' => 'skyrocket_text_sanitization'
	)
);
$wp_customize->add_control( new Skyrocket_Text_Radio_Button_Custom_Control( $wp_customize, 'sample_text_radio_button',
	array(
		'label' => __( 'Text Radio Button Control' ),
		'description' => esc_html__( 'Sample custom control description' ),
		'section' => 'sample_custom_controls_section',
		'choices' => array(
			'left' => __( 'Left' ), // Required. Setting for this particular radio button choice and the text to display
			'centered' => __( 'Centered' ), // Required. Setting for this particular radio button choice and the text to display
			'right' => __( 'Right' ) // Required. Setting for this particular radio button choice and the text to display
		)
	)
) );
````

### Image Checkbox ###

The Image Checkbox works the same as an ordinary checkbox control, in that you can select one or more items out of a number of items. The difference is that it allows you to display images for each selection choice. This is useful where an image provides a better indicator for the user, than simple text. A common use of this type of control is where a user might select the weight of a font (e.g. Bold, Italic etc.).

When adding your control, you can specify the url for the image to display, the title text to display when hovering the cursor over the image and the value for each item.

The setting that gets saved to the database is a comma-separated string of values for each of the items that are selected.

![Image Checkbox](https://maddisondesigns.com/wp-content/uploads/2017/04/ImageCheckbox.jpg "Image Checkbox")

**Usage**  
add_control( $id, $args );

**Parameters**  
**$id** - (string) (required) The id of the Setting associated with this Control. Default: None

**$args** - (array) (required) An associative array containing arguments for the setting. Default: None

**Arguments for $args**  
**label** - Optional. The label that will be displayed Default: Blank  
**description** - Optional. The description to display under the label. Default: Blank.  
**section** - Required. The Section where there control should appear  
**choices** - Required. List of custom choices.  
  **key** - Required. Data that will be stored for the setting  
  **image** - Required. URL for the image to display  
  **name** - Required. Title text to display

**Example**

````
$wp_customize->add_setting( 'sample_image_checkbox',
	array(
		'default' => 'stylebold,styleallcaps',
		'transport' => 'refresh',
		'sanitize_callback' => 'skyrocket_text_sanitization'
	)
);
$wp_customize->add_control( new Skyrocket_Image_checkbox_Custom_Control( $wp_customize, 'sample_image_checkbox',
	array(
		'label' => __( 'Image Checkbox Control' ),
		'description' => esc_html__( 'Sample custom control description' ),
		'section' => 'sample_custom_controls_section',
		'choices' => array(
			'stylebold' => array( // Required. Setting for this particular radio button choice
				'image' => trailingslashit( get_template_directory_uri() ) . 'images/Bold.png', // Required. URL for the image
				'name' => __( 'Bold' ) // Required. Title text to display
			),
			'styleitalic' => array(
				'image' => trailingslashit( get_template_directory_uri() ) . 'images/Italic.png',
				'name' => __( 'Italic' )
			),
			'styleallcaps' => array(
				'image' => trailingslashit( get_template_directory_uri() ) . 'images/AllCaps.png',
				'name' => __( 'All Caps' )
			),
			'styleunderline' => array(
				'image' => trailingslashit( get_template_directory_uri() ) . 'images/Underline.png',
				'name' => __( 'Underline' )
			)
		)
	)
) );
````

### Single Accordion ###

The Single Accordion Control allows you to display a large block of text such as instructional information, whilst keeping it hidden or minimised until clicked. When the control is clicked, the content will become visible and when clicked again, the content will hide.

There's no settings saved for this control, it's purely for showing/hiding a block of content.

You can pass it an array of key/values pairs or plain text content (incl. basic html tags `a`, `br`, `em`, `strong`, `i`).

![Single Accordion](https://maddisondesigns.com/wp-content/uploads/2017/04/SingleAccordion.jpg "Single Accordion")

**Usage**  
add_control( $id, $args );

**Parameters**  
**$id** - (string) (required) The id of the Setting associated with this Control. Default: None

**$args** - (array) (required) An associative array containing arguments for the setting. Default: None

**Arguments for $args**  
**label** - Optional. The label that will be displayed Default: Blank  
**description** - Required. The text to hide under the accordion, passed as an array or string  
**section** - Required. The Section where there control should appear

**Example**

````
$sampleIconsList = array(
	'Behance' => __( '<i class="fa fa-behance"></i>', 'ephemeris' ),
	'Bitbucket' => __( '<i class="fa fa-bitbucket"></i>', 'ephemeris' ),
	'CodePen' => __( '<i class="fa fa-codepen"></i>', 'ephemeris' ),
	'DeviantArt' => __( '<i class="fa fa-deviantart"></i>', 'ephemeris' ),
	'Dribbble' => __( '<i class="fa fa-dribbble"></i>', 'ephemeris' ),
	'Etsy' => __( '<i class="fa fa-etsy"></i>', 'ephemeris' ),
	'Facebook' => __( '<i class="fa fa-facebook"></i>', 'ephemeris' ),
	'Flickr' => __( '<i class="fa fa-flickr"></i>', 'ephemeris' ),
	'Foursquare' => __( '<i class="fa fa-foursquare"></i>', 'ephemeris' ),
	'GitHub' => __( '<i class="fa fa-github"></i>', 'ephemeris' ),
);
$wp_customize->add_setting( 'sample_single_accordion',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'skyrocket_text_sanitization'
	)
);
$wp_customize->add_control( new Skyrocket_Single_Accordion_Custom_Control( $wp_customize, 'sample_single_accordion',
	array(
		'label' => __( 'Single Accordion Control' ),
		'description' => $sampleIconsList, // Required. Passing an array of key/values pairs which are displayed in a list
		'section' => 'sample_custom_controls_section'
	)
) );

$wp_customize->add_setting( 'another_sample_single_accordion',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'skyrocket_text_sanitization'
	)
);
$wp_customize->add_control( new Skyrocket_Single_Accordion_Custom_Control( $wp_customize, 'another_sample_single_accordion',
	array(
		'label' => __( 'Another Single Accordion Control' ),
		'description' => 'This is some simple text with an <a href="http://google.com">html link</a> included.',  // Required. Passing some text with some basic html content
		'section' => 'sample_custom_controls_section'
	)
) );
````

### Simple Notice ###

The Simple Notice Control allows you to display a block of text such as instructional information. There's no settings saved for this control, it's purely for displaying a block of content.

The text content can include basic html tags such as `a`, `br`, `em`, `strong`, `i`, `span` and `code`.

![Simple Notice](https://maddisondesigns.com/wp-content/uploads/2017/04/SimpleNotice.png "Simple Notice")

**Usage**  
add_control( $id, $args );

**Parameters**  
**$id** - (string) (required) The id of the Setting associated with this Control. Default: None

**$args** - (array) (required) An associative array containing arguments for the setting. Default: None

**Arguments for $args**  
**label** - Optional. The label that will be displayed Default: Blank  
**description** - Required. The text to display  
**section** - Required. The Section where there control should appear

**Example**

````
$wp_customize->add_setting( 'sample_simple_notice',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'skyrocket_text_sanitization'
	)
);
$wp_customize->add_control( new Skyrocket_Simple_Notice_Custom_control( $wp_customize, 'sample_simple_notice',
	array(
		'label' => __( 'Simple Notice Control' ),
		'description' => __('This Custom Control allows you to display a simple title and description to your users. You can even include <a href="http://google.com" target="_blank">basic html</a>.' ),
		'section' => 'sample_custom_controls_section'
	)
) );
````

### TinyMCE Editor ###

The TinyMCE editor works the same as the standard TinyMCE Editor that you use when creating a Page or Post. The only difference you'll notice is that it has a minimalist toolbar. This is mainly because you're  not likely to need the same full-featured toolbar as you would when creating a Page or Post. It's also due, in part, to the limited screen space available in the Customizer sidebar. Like the standard Page/Post TinyMCE editor, you can add text & links, along with various styles such as bold, italics and a number of other styles.

When adding your control, you can also specify what toolbar icons you would like to display. You can have one toolbar row or two toolbar rows. If you don't specify any toolbars, the default is to display one toolbar with bold, italic, bullet list, number list, align left, align center, align right and link buttons.

The full list of available toolbar buttons is available on the official [TinyMCE website](https://www.tinymce.com/docs/advanced/editor-control-identifiers/). Their [Examples & Demo pages](https://www.tinymce.com/docs/demo/basic-example/) also has a number of examples showing how each of the toolbar buttons would display. It's worth noting that some toolbar buttons require additional [TinyMCE plugins](https://www.tinymce.com/docs/get-started/work-with-plugins/), not all of which are available by default in the WordPress version of TinyMCE.

When sanitzing your setting, you can simply use the core wp_kses_post() function, which will sanitize the content for allowed HTML tags for post content.

The setting that gets saved to the database will be a string with the allowed HTML tags and attributes intact.

**Please note:** The TinyMCE Editor Custom Control will only work in WordPress 4.8 and above as the JavaScript functionality required for its use was only added in WP 4.8.

![Image Checkbox](https://maddisondesigns.com/wp-content/uploads/2017/05/TinyMCE-Editor.jpg "TinyMCE Editor")

**Usage**  
add_control( $id, $args );

**Parameters**  
**$id** - (string) (required) The id of the Setting associated with this Control. Default: None

**$args** - (array) (required) An associative array containing arguments for the setting. Default: None

**Arguments for $args**  
**label** - Optional. The label that will be displayed Default: Blank  
**description** - Optional. The description to display under the label. Default: Blank.  
**section** - Required. The Section where there control should appear  
**input_attrs** - Optional. List of custom choices.  
  **toolbar1** - Optional. String containing a list of toolbar buttons to display on the first toolbar row. Default: 'bold italic bullist numlist alignleft aligncenter alignright link'  
  **toolbar2** - Optional. String containing a list of toolbar buttons to display on the second toolbar row. Default: blank  

**Example**

````
$wp_customize->add_setting( 'sample_tinymce_editor',
	array(
		'default' => '',
		'transport' => 'postMessage',
		'sanitize_callback' => 'wp_kses_post'
	)
);
$wp_customize->add_control( new Skyrocket_TinyMCE_Custom_control( $wp_customize, 'sample_tinymce_editor',
	array(
		'label' => __( 'TinyMCE Control' ),
		'description' => __( 'This is a TinyMCE Editor Custom Control' ),
		'section' => 'sample_custom_controls_section',
		'input_attrs' => array(
			'toolbar1' => 'bold italic bullist numlist alignleft aligncenter alignright link',
			'toolbar2' => 'formatselect outdent indent | blockquote charmap',
		)
	)
) );
````

### Google Font Select ###
One of the issues I've found with a lot of Google Font controls in numerous themes and plugins is that they don't allow for Italic and Bold weights. They'll change the regular text to the chosen font, but any text that you make bold or italic, reverts back to the original font. One of the reasons for this is because they don't specify the necessary italic and bold weights when retrieving the fonts from Google.

The Google Font Control will allow you to select a Google font and also specify the weight for the regular, italic and bold weights. The list of Google Font choices are stored in a json file generated by retrieving the 30 most popular fonts. So as to avoid having to include your own Google Fonts API Key in your theme, you should generate this list of fonts before you add your theme options. You can get the complete list of Google Fonts, sorted by popularity by calling https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key=YOUR-API-KEY (Don't forget to include your own Google Fonts API Key in the appropriate place).

The setting is saved to the database as a json string. The easiest way to use this data in your theme is by using the <code>json_decode()</code> PHP function to convert the json string into an array. From there, it's easy enough to get the Font name, regular font weight, italic weight, bold weight, and the font category which is useful for specifying a fallback font.

![Google Font Select](https://maddisondesigns.com/wp-content/uploads/2017/04/GoogleFontSelect.png "Google Font Select")

**Usage**  
add_control( $id, $args );

**Parameters**  
**$id** - (string) (required) The id of the Setting associated with this Control. Default: None

**$args** - (array) (required) An associative array containing arguments for the setting. Default: None

**Arguments for $args**  
**label** - Optional. The label that will be displayed Default: Blank  
**description** - Required. The text to display  
**section** - Required. The Section where there control should appear

**Example**

````
$wp_customize->add_setting( 'sample_google_font_select',
	array(
	 'default' => '{"font":"Open Sans","regularweight":"regular","italicweight":"italic","boldweight":"700","category":"sans-serif"}',
	)
);
$wp_customize->add_control( new Skyrocket_Google_Font_Select_Custom_Control( $wp_customize, 'sample_google_font_select',
	array(
		'label' => __( 'Google Font Control' ),
		'description' => esc_html__( 'Sample custom control description' ),
		'section' => 'sample_custom_controls_section',
	)
) );
````

### Alpha Color ###

All props for this control go to [Braad Martin](http://braadmartin.com/alpha-color-picker-control-for-the-wordpress-customizer). I've included it here (and also in my sample code) because it's so useful and I think it's a better option than the standard Color Control built into core. You can check out the original post Braad wrote about this control or check it out in his [Github repo](https://github.com/BraadMartin/components/tree/master/customizer/alpha-color-picker).

The Alpha Color Control is very similar to the Color Control built into core. The benefit of this control over the default control, is that it allows you to specify the opacity of the selected colour, which allows you to specify RGBa colours rather than just a solid hex colour.

The setting that gets saved to the database will be an RGBa color value (e.g. rgba(0,158,39,0.8) ) or a plain solid hex color (e.g. #009e27).

![Alpha Color](https://maddisondesigns.com/wp-content/uploads/2017/04/AlphaColor.jpg "Alpha Color")

**Usage**  
add_control( $id, $args );

**Parameters**  
**$id** - (string) (required) The id of the Setting associated with this Control. Default: None

**$args** - (array) (required) An associative array containing arguments for the setting. Default: None

**Arguments for $args**  
**label** - Optional. The label that will be displayed Default: Blank  
**description** - Required. The text to display  
**section** - Required. The Section where there control should appear  
**show_opacity** - Optional. Show or hide the opacity value on the opacity slider handle. Default: true  
**palette** - Optional. Allows you to specify the colours used in the colour palette. Can be set to false to hide the palette. Default: WP color control palette

**Example**

````
$wp_customize->add_setting( 'sample_alpha_color',
	array(
		'default' => 'rgba(209,0,55,0.7)',
		'transport' => 'postMessage'
	)
);
$wp_customize->add_control( new Skyrocket_Customize_Alpha_Color_Control( $wp_customize, 'sample_alpha_color_picker',
	array(
		'label' => __( 'Alpha Color Picker Control' ),
		'description' => esc_html__( 'Sample custom control description' ),
		'section' => 'sample_custom_controls_section',
		'show_opacity' => true, // Optional. Show or hide the opacity value on the opacity slider handle. Default: true
		'palette' => array( // Optional. Select the colours for the colour palette . Default: WP color control palette
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
````

For more details, check out my Customizer Developers Guide:  
[The WordPress Customizer – A Developers Guide (Part 1)](https://maddisondesigns.com/2017/05/the-wordpress-customizer-a-developers-guide-part-1)  
[The WordPress Customizer – A Developers Guide (Part 2)](https://maddisondesigns.com/2017/05/the-wordpress-customizer-a-developers-guide-part-2)
