# Customizer Custom Controls #

**Author:** Anthony Hortin  
**Author URI:** https://maddisondesigns.com  
**License:** GNU General Public License v2 or later  
**License URI:** http://www.gnu.org/licenses/gpl-2.0.html  
**Version:** 1.0.13

## Description ##

There are several different types of basic Core Controls built into the Customizer that are ready to use straight-out-of-the-box. These include text, checkbox, textarea, radio, select and dropdown-pages controls. Later versions of WordPress also introduced Color, Media, Image and Cropped Image controls. If none of the basic core controls suit your needs, you can create and add your own custom controls.

This example code shows how to incorporate Customizer functionality into your theme (or plugin), including examples of how to create Panels, Sections and how to update the Live Preview window. As well as showing the usage of the (built-in) core controls, there are also a number of Custom Controls that have been built that you're welcome to make use of.

The example code in `customizer.php` will create a new Panel in the Customizer called `Header & Navigation` which contains three sections (`Social Icons`, `Contact` & `Search`). It also creates two new Sections. One called `Sample Custom Controls`, which contains examples of all the custom controls I created. The other new Section, `Default Controls`, contains examples of all the core controls that come with WordPress.

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
Date Time Control (WP 4.9+)

## Custom Controls ##
This code includes the following Custom Controls:  
Toggle Switch  
Slider  
Sortable Repeater  
Image Radio Button  
Text Radio Button  
Image Checkbox  
Single Accordion  
Simple Notice  
Dropdown Select2  
Dropdown Posts  
TinyMCE Editor  
Google Font Select  
Alpha Color  
WPColorPicker Alpha Color  
Upsell Section  

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

![Text Radio Button](https://maddisondesigns.com/wp-content/uploads/2017/05/TextRadioButton.png "Text Radio Button")

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
	'Behance' => __( '<i class="fa fa-behance"></i>', 'skyrocket' ),
	'Bitbucket' => __( '<i class="fa fa-bitbucket"></i>', 'skyrocket' ),
	'CodePen' => __( '<i class="fa fa-codepen"></i>', 'skyrocket' ),
	'DeviantArt' => __( '<i class="fa fa-deviantart"></i>', 'skyrocket' ),
	'Dribbble' => __( '<i class="fa fa-dribbble"></i>', 'skyrocket' ),
	'Etsy' => __( '<i class="fa fa-etsy"></i>', 'skyrocket' ),
	'Facebook' => __( '<i class="fa fa-facebook"></i>', 'skyrocket' ),
	'Flickr' => __( '<i class="fa fa-flickr"></i>', 'skyrocket' ),
	'Foursquare' => __( '<i class="fa fa-foursquare"></i>', 'skyrocket' ),
	'GitHub' => __( '<i class="fa fa-github"></i>', 'skyrocket' ),
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

### Dropdown Select2 ###
Select2 is a jQuery based replacement for select boxes. Select2 gives you a customizable select box with support for searching, tagging, remote data sets, infinite scrolling, and many other highly used options.

The Dropdown Select2 Custom Control provides a simple way of implementing a Select2 Dropwdown in the Customizer. One of the main benefits of using this Select2 Dropdown over a regular Dropdown is that it provides a handy input field allowing you to type in and search for the item your looking for. This is really handy when your dropdown list is extremely long and scrolling through the list becomes cumbersome. An example of where you might want to use this over a regular Dropdown is when you have a list of Countries or Timezones. Basically, any Dropdown list that is more than a dozen entries would benefit from using this Select2 Custom Control over a regular Dropdown control.

One of the other benefits of this control is the ability to handle Multi-Select lists. That is, it provides you with the ability to easily select multiple entries in your list, rather than just a single entry, if you so desire. This can be achieved simply by including `'multiselect' => true` in your `input_attrs`.

The Dropdown Select2 Custom Control handles a straight forward list of entries by passing your entries as an array using the `'choices'` parameter. Alternatively, if you want your Dropdown list to show Option Groups (i.e. the ability to group your list into different sections), then you can also pass an array of arrays to `'choices'`.

If you wish to select default values, pass a simple string when using the control to select a single entry. When using the control as a mutli-select, pass an array of strings to select multiple default values.

To santize your controls data, use my `skyrocket_text_sanitization` function or any other function that can sanitize a simple string and also a series of comma delimited strings. It's worth noting that the multiselect dropdown will either save a single string or a series of comma delimited strings, depending on the number of entries selected in the dropdown.

When only a single entry is selected, even when using the multiselect dropdown, then the setting will be saved to the database as a single string. If you are using the multiselect dropdown (i.e. `'multiselect' => true`) and you've selected multiple entries, they will be saved to the database as a series of comma delimited strings.

![Dropdown Select2](https://maddisondesigns.com/wp-content/uploads/2017/05/DropdownSelect2Control.png "Dropdown Select2")

**Usage**  
add_control( $id, $args );

**Parameters**  
**$id** - (string) (required) The id of the Setting associated with this Control. Default: None

**$args** - (array) (required) An associative array containing arguments for the setting. Default: None

**Arguments for $args**  
**label** - Optional. The label that will be displayed Default: Blank  
**description** - Required. The text to display  
**section** - Required. The Section where there control should appear
**input_attrs** - Optional. List of custom choices.  
  **placeholder** - Optional. The Placeholder value to display. Select2 requires a Placeholder value to be set when using the clearall option. Default = 'Please select...'  
  **multiselect** - Optional. Select a single entry from the dropdown or select multiple. Either true or false. Default = false  
**choices** - Required. List of custom choices.  
  **key** - Required. Data that will be stored for the setting  
  **value** - Required. Text to display in the control  

**Example**

````
// Test of Dropdown Select2 Control (single select)
$wp_customize->add_setting( 'sample_dropdown_select2_control_single',
	array(
		'default' => 'vic',
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

// Test of Dropdown Select2 Control (Multi-Select) with Option Groups
$wp_customize->add_setting( 'sample_dropdown_select2_control_multi',
	array(
		'default' => array ( 'Antarctica/McMurdo', 'Australia/Melbourne', 'Australia/Broken_Hill' ),
		'transport' => 'refresh',
		'sanitize_callback' => 'skyrocket_text_sanitization'
	)
);
$wp_customize->add_control( new Skyrocket_Dropdown_Select2_Custom_Control( $wp_customize, 'sample_dropdown_select2_control_multi',
	array(
		'label' => __( 'Dropdown Select2 Control', 'skyrocket' ),
		'description' => esc_html__( 'Sample Dropdown Select2 custom control (Multi-Select)', 'skyrocket' ),
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
````

### Dropdown Posts ###

The Dropdown Posts Custom Control allows you to display a dropdown list of your Posts. You can display all Posts or just a selection by using the `input_attrs` array when adding your control.

This control is extremely flexible. Not only can you display a list of your typical (blog) Posts, but it can actually show any type of Post, such as WooCommerce Products, or even Pages. You can pass an array of Post ID's to include, an array of Post IDs *NOT* to include, how many posts to retrieve, the Post Type (e.g. you could use `product` for WooCommerce products) and a long list of other options. To see the complete list of values you can pass using the `input_attrs` array, see [WP_Query::parse_query()](https://developer.wordpress.org/reference/classes/wp_query/parse_query/) in the WordPress Codex.

The setting that gets saved to the database is a Post ID.

![Dropdown Posts](https://maddisondesigns.com/wp-content/uploads/2018/03/DropdownPostsControl.jpg "Dropdown Posts")

**Usage**  
add_control( $id, $args );

**Parameters**  
**$id** - (string) (required) The id of the Setting associated with this Control. Default: None

**$args** - (array) (required) An associative array containing arguments for the setting. Default: None

**Arguments for $args**  
**label** - Optional. The label that will be displayed Default: Blank  
**description** - Optional. The description to display under the label. Default: Blank.  
**section** - Required. The Section where there control should appear  
**input_attrs** - Optional. List of post options. The options listed below are the most common. See [WP_Query::parse_query()](https://developer.wordpress.org/reference/classes/wp_query/parse_query/) in the WordPress Codex for the complete list.  
  **posts_per_page** - Optional. The number of posts to retrieve. Use -1 to retrieve all posts. Default: 5  
  **orderby** - Optional. Order to sort retrieved posts by. Accepts 'none', 'name', 'author', 'date', 'title', 'modified', 'menu_order', 'parent', 'ID', 'rand' and a number of others. Default: 'date'  
  **order** - Optional.  Designates ascending or descending order of posts. Accepts 'ASC' or 'DESC'. Default: 'DESC'  
  **cat** - Optional. Category ID or comma-separated list of IDs. Default: 0  
  **post__in** - Optional. An array of post IDs to retrieve (sticky posts will be included)  
  **post__not_in** - Optional. An array of post IDs not to retrieve. *Note:* a string of comma- separated IDs will NOT work  
  **post_type** - Optional. A post type slug (string) or array of post type slugs. Default: 'post'  

**Example**

````
$wp_customize->add_setting( 'sample_dropdown_posts_control',
	array(
		'default' => '',
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
````

### TinyMCE Editor ###

The TinyMCE editor works the same as the standard TinyMCE Editor that you use when creating a Page or Post. The only difference you'll notice is that it has a minimalist toolbar. This is mainly because you're  not likely to need the same full-featured toolbar as you would when creating a Page or Post. It's also due, in part, to the limited screen space available in the Customizer sidebar. Like the standard Page/Post TinyMCE editor, you can add text & links, along with various styles such as bold, italics and a number of other styles.

When adding your control, you can also specify what toolbar icons you would like to display. You can have one toolbar row or two toolbar rows. If you don't specify any toolbars, the default is to display one toolbar with bold, italic, bullet list, number list, align left, align center, align right and link buttons.

The full list of available toolbar buttons is available on the official [TinyMCE website](https://www.tinymce.com/docs/advanced/editor-control-identifiers/). Their [Examples & Demo pages](https://www.tinymce.com/docs/demo/basic-example/) also has a number of examples showing how each of the toolbar buttons would display. It's worth noting that some toolbar buttons require additional [TinyMCE plugins](https://www.tinymce.com/docs/get-started/work-with-plugins/), not all of which are available by default in the WordPress version of TinyMCE.

You can also choose to display or hide the Add Media button, enabling you to easily add images into your TinyMCE Control. The Add Media button will be hidden by default.

When sanitizing your setting, you can simply use the core wp_kses_post() function, which will sanitize the content for allowed HTML tags for post content.

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
  **mediaButtons** - Optional. Display or hide the Add Media button. Either true or false. Default: false  

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
			'mediaButtons' => true,
		)
	)
) );
````

### Google Font Select ###
One of the issues I've found with a lot of Google Font controls in numerous themes and plugins is that they don't allow for Italic and Bold weights. They'll change the regular text to the chosen font, but any text that you make bold or italic, reverts back to the original font. One of the reasons for this is because they don't specify the necessary italic and bold weights when retrieving the fonts from Google.

The Google Font Control will allow you to select a Google font and also specify the weight for the regular, italic and bold weights. The list of Google Font choices are stored in a json file generated by calling the Google Webfonts API. So as to avoid having to include your own Google Fonts API Key in your theme, you should generate this list of fonts before you add your theme options. You can get the complete list of Google Fonts, sorted by popularity by calling https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key=YOUR-API-KEY. A complete list of fonts sorted alphabetically can be retrieved by https://www.googleapis.com/webfonts/v1/webfonts?key=YOUR-API-KEY (Don't forget to include your own Google Fonts API Key in the appropriate place).

When defining your control, you can specify the number of fonts to display and the order in which they should be displayed (either alphabetically or by popularity). If your default font, or the currently saved font, is not included in the list of fonts you're displaying, it will automatically be prepended to the start of the list as the default font. As an example, if you specify specify 'Open Sans' as your default font, but only elect to show only the first 10 fonts, sorted alphabetically, then 'Open Sans' will be automatically prepended to the list of fonts shown in the control.

The Font Family dropdown also implements a Select2 control, which adds an input field allowing you to type in and search for the desired font. This makes finding your font easier than having to scroll through the long list of Google Font names.

The setting is saved to the database as a json string. The easiest way to use this data in your theme is by using the <code>json_decode()</code> PHP function to convert the json string into an array. From there, it's easy enough to get the Font name, regular font weight, italic weight, bold weight, and the font category which is useful for specifying a fallback font.

![Google Font Select](https://maddisondesigns.com/wp-content/uploads/2017/05/GoogleFontSelect.png "Google Font Select")

**Usage**  
add_control( $id, $args );

**Parameters**  
**$id** - (string) (required) The id of the Setting associated with this Control. Default: None

**$args** - (array) (required) An associative array containing arguments for the setting. Default: None

**Arguments for $args**  
**label** - Optional. The label that will be displayed Default: Blank  
**description** - Required. The text to display  
**section** - Required. The Section where there control should appear  
**input_attrs** - Optional. List of custom choices.  
  **font_count** - Optional. The number of fonts to display from the json file. Either positive integer or 'all'. Default = 'all'  
  **orderby** - Optional. The font list sort order. Either 'alpha' or 'popular'. Default = 'alpha'  

**Example**

````
$wp_customize->add_setting( 'sample_google_font_select',
	array(
	 'default' => '{"font":"Open Sans","regularweight":"regular","italicweight":"italic","boldweight":"700","category":"sans-serif"}',
	),
	'sanitize_callback' => 'skyrocket_google_font_sanitization'
);
$wp_customize->add_control( new Skyrocket_Google_Font_Select_Custom_Control( $wp_customize, 'sample_google_font_select',
	array(
		'label' => __( 'Google Font Control' ),
		'description' => esc_html__( 'Sample custom control description' ),
		'section' => 'sample_custom_controls_section',
		'input_attrs' => array(
			'font_count' => 'all',
			'orderby' => 'alpha',
		),
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

### WPColorPicker Alpha Color ###

The WPColorPicker Alpha Color is another Custom Color Control that supports Alpha Channel selection (e.g. rgba(0,158,39,0.8) ). This controls uses a modifed version of the WordPress Color Picker script that supports Alpha Channel selection. Although the Customizer Custom Control was created by myself, all props for this modified WPColorPicker script go to [Sergio](https://github.com/kallookoo).

The Alpha Color Control is very similar to the Color Control built into core. The benefit of this control over the default control, is that it allows you to specify the opacity of the selected colour, which allows you to specify RGBa colours rather than just a solid hex colour.

When defining your control, you can specify an array of 8 colour values to use for the palette colours, which are shown as small swatches the bottom of the control. You can specify colours using Hex values, RGB values, or RGBa values. I recommend not mixing Hex/RGB and RGBa colours as the WPColorPicker script has issues handling this. Either use all HEX/RGB values, or all RGBa values.

When defining your control, you can specify whether the Alpha Channel is reset (back to 1) or whether it remains the same value (default is to reset i.e. true). Setting `'resetalpha' => false` will ensure the value in the alpha channel **isn't** reset back to 1 every time one of the palette colours is selected. Setting `'resetalpha' => true` (or just not using this option) will ensure that the alpha channel value **is** reset back to 1 every time one of the palette colours is selected.

The WPColorPicker script has issues when mixing HEX colours and RGBa colours in the palette. If `'resetalpha' => false` and you select an RGBa colour from the palette which has an alpha value less than 1, the correct colour will be selected. However, if you then select an Hex value from the palette, the alpha channel value will remain the same as the previous selection, causing an incorrect colour to be selected.

When specifying all Hex values in the Palette, it's best to set `'resetalpha' => true` (or just don't specify this option as the default value is true). When using all RGBa values in the Palette, it's best to set `'resetalpha' => false`.

The setting that gets saved to the database will be an RGBa color value (e.g. rgba(0,158,39,0.8) ) or a plain solid hex color (e.g. #009e27).

![Alpha Color](https://maddisondesigns.com/wp-content/uploads/2017/05/WPColorPickerAlphaColor.jpg "WPColorPicker Alpha Color")

**Usage**  
add_control( $id, $args );

**Parameters**  
**$id** - (string) (required) The id of the Setting associated with this Control. Default: None

**$args** - (array) (required) An associative array containing arguments for the setting. Default: None

**Arguments for $args**  
**label** - Optional. The label that will be displayed Default: Blank  
**description** - Required. The text to display  
**section** - Required. The Section where there control should appear  
**input_attrs** - Optional. List of custom choices.  
  **resetalpha** - Optional. This will reset the Alpha channel back to 1 every time a new colour is selected from the Palette. Default = 'true'  
  **palette** - Optional. Allows you to specify the 8 colours used in the colour palette. Default: WP color control palette  

**Example 1**

````
$wp_customize->add_setting( 'sample_wpcolorpicker_alpha_color',
	array(
		'default' => 'rgba(209,0,55,0.7)',
		'transport' => 'postMessage',
		'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( new Skyrocket_Alpha_Color_Control( $wp_customize, 'sample_wpcolorpicker_alpha_color',
	array(
		'label' => __( 'Alpha Color Picker Control' ),
		'description' => esc_html__( 'Sample color control with Alpha channel' ),
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
````

**Example 2**

````
$wp_customize->add_setting( 'sample_wpcolorpicker_alpha_color2',
	array(
		'default' => 'rgba(209,0,55,0.7)',
		'transport' => 'postMessage',
		'sanitize_callback' => 'skyrocket_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( new Skyrocket_Alpha_Color_Control( $wp_customize, 'sample_wpcolorpicker_alpha_color2',
	array(
		'label' => __( 'Alpha Color Picker Control' ),
		'description' => esc_html__( 'Sample color control with Alpha channel' ),
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
````

### Upsell Section ###

The Upsell Section is a Custom Section that allows you to provide a link to an external URL, such as a theme website. This section is useful if you're upselling premium themes or plugins.

The Upsell Section is similar to standard core Customizer section except that instead of being able to navigate into the section, it simply provides a link to an external URL. Since this is a Section rather than a Custom Control, you probably want to add this to the same function that defines your other Sections.

When defining your section, you can specify the URL, the text to use for the link as well as the background and text colours for the section. The ability to define the colours allows you to show this section in your own branding colours, as well as making this link more noticeable within the Customizer.

Since this is a Custom Section, rather than a Custom Control, there's no values saved to the database.

![Alpha Color](https://maddisondesigns.com/wp-content/uploads/2017/05/Customizer-Customer-Section.jpg "Upsell Section")

**Usage**  
add_section( $id, $args );

**Parameters**  
**$id** - (string) (required) A unique slug-like string to use as an id. Default: None

**$args** - (array) (required) An associative array containing arguments for the section. Default: None

**Arguments for $args**  
**title** - The visible name of the section  
**priority** - Optional. This controls the order in which this section appears in the Theme Customizer sidebar  
**url** - The external url to link to  
**backgroundcolor** - Optional. The background colour of the section. Default: #fff  
**textcolor** - Optional. The text colour for the title. Default: #555d66  

**Example**

````
$wp_customize->add_section( new Skyrocket_Upsell_Section( $wp_customize, 'upsell_section',
	array(
		'title' => __( 'Premium Addons Available', 'skyrocket' ),
		'url' => 'https://skyrocketthemes.com',
		'backgroundcolor' => '#344860',
		'textcolor' => '#fff',
		'priority' => 0,
	)
) );
````

## Further Reading ##

For more details, check out my Customizer Developers Guide:  
[The WordPress Customizer – A Developers Guide (Part 1)](https://maddisondesigns.com/2017/05/the-wordpress-customizer-a-developers-guide-part-1)  
[The WordPress Customizer – A Developers Guide (Part 2)](https://maddisondesigns.com/2017/05/the-wordpress-customizer-a-developers-guide-part-2)

Download a sample theme showing how to implement these Controls:  
[https://github.com/maddisondesigns/Customizer-Custom-Controls-Sample-Theme](https://github.com/maddisondesigns/Customizer-Custom-Controls-Sample-Theme)

## Changelog ##

= 1.0.13 =
- Don't enqueue the Font Awesome stylesheet within the Skyrocket_Single_Accordion_Custom_Control Control as it's not actually needed.
- Enqueue the Font Awesome stylesheet within functions.php when viewing the Customizer, for showing icons in our sample Single Accordion Control content.
- Added Readme link to a sample theme that shows how to implement these controls.

= 1.0.12 =
- Fixed default value for Multi Select Select2. Default value should be comma delimited string not an array.
- Changed Sanitize Callback function for default WP_Customize_Image_Control control. This control returns a URL string, not an image ID.

= 1.0.11 =
- Added new Upsell section that allows you to provide a link in the Customizer to an external URL. Useful if you're selling premium themes/plugins.

= 1.0.10 =
- Added ability to specify Palette colours in the new Skyrocket_Alpha_Color_Control Custom Control

= 1.0.9 =
- Added new Skyrocket_Alpha_Color_Control Custom Control which uses modified WPColorPicker script

= 1.0.8 =
- Renamed fontawesome stylsheet

= 1.0.7 =
- Update skyrocket_get_social_media() to store output as array rather than string to make it easier for filtering
- Added new filter (skyrocket_social_icons_list) for filtering social media icons list array
- Added new social icons to Customizer Control (Discord, Kickstarter, Patreon, Weibo)
- Updated FontAwesome to v5.8.2

= 1.0.6 =
- Add the ability to show the Add Media button on the TinyMCE Control

= 1.0.5 =
- Added support for including this library in a plugin (as well as a theme). Props @mmcev106

= 1.0.4 =
- Fix typos. Props @lushkant

= 1.0.3 =
- Fix issue with specifying slider step less than one (e.g. 0.5)
- Add new sanitisation function for sanitising slider ranges

= 1.0.2 =
- Update handles when enqueing scripts/styles to use dashes instead of underscores
- Add prefixes to a couple of function names that didn't have a prefix

= 1.0.1 =
- Check if there are any Google Font Controls being used before trying to call Select2

= 1.0 =
- Let's add a changelog and a version number to make it easier to see what's changed. We'll call this v1.0 shall we

= 25 Jun 2018 =
- Update example code and readme documentation
- Setting for multiselect control should be santized the same way as the single select
- Fix issue with Select2 Dropdown not allowing control to be saved when entries are cleared
- Add new clear all option Select2 Dropdown
- Add ability to specify placeholder on Select2 Dropdown

= 17 Jun 2018 =
- Updated text to explain example in more detail
- Add some more readme text to explain which section in the Customizer this example code is relevant to
- Add some more inline comments to explain what the example code includes

= 16 Jun 2018 =
- Fix the textdomain on the sample code
- Increase z-index for select2 controls so dropdown appears correctly
- Fix height on select2 multi-select control
- Fix incorrect textdomains & comments in code

= 5 Apr 2018 =
- Tweaked Readme. Stupid Github requiring two spaces at the end of a line just to get a carriage return. Uugh!

= 2 Apr 2018 =
- Implement a Select2 control for the Font Family dropdown in the Google Font Custom Control
- Added new Dropdown Select2 Custom Control
- Tweaked styles for Select2 Fields
- Changed colour of Text Radio Button Control field when selected to better match other controls and to improve visibility

= 31 Mar 2018 =
- Update Google Font Control to allow ordering by popularity or alphabetically
- Update Google Control to allow showing all fonts or specify just a certain number of fonts

= 16 Mar 2018 =
- Add new Dropdown Posts Custom Control

= 27 Nov 2017 =
- Update readme to include new core Date Time control
- Add new example code for core Date Time control
- Add a new sanitizer for the new Date Time Customizer control
- Let's make input fields the same height as select fields
- Fix position of label and alpha colour customizer control input field

= 21 Nov 2017 =
- Fix weird borders on color controls
- Fix alignment of color input on default control

= 4 Oct 2017 =
- Updated readme

= 29 Sep 2017 =
- Tweak the border style on Customizer input fields to make them more noticeable
- Tweak styles for Simple Notice Control so text isn't as cramped when code tag is used
- Update the Simple Notice Control to allow span and code tags

= 13 Sep 2017 =
- Lets check if the woocommerce class exists instead of checking active_plugins for the plugin folder & file as it will still work if the plugin folder was renamed for some reason

= 9 Sep 2017 =
- Use get_template_directory_uri() when reading Google Fonts JSON file so it doesn't break when using child themes
- Change placeholder text on Repeater control input field to https://
- Automatically add https instead of http since all social networks use ssl

= 21 Aug 2017 =
- Update the example code for the TinyMCE Editor control

= 20 Aug 2017 =
- Added TinyMCE Editor Custom Control

= 18 Jun 2017 =
- Ensure manual slider input values don’t exceed minimum & maximum values
- Fix readme formatting
- Ensure strings are translatable
- Add missing sanitisation callback functions
- Ensure correct sanitisation functions are called
- Add new functions for sanitising integers, RGBa values and the Google Font JSON string
- Add sample code to add search icon to menu
- Update customizer defaults

= 17 May 2017 =
- Updated readme description
- Updated readme with more doco
- Changed the name prefix on all the functions
- Added a default for the Simple Notice Control, for consistency
- Updated readme
- Remove margin from bottom of Radio Button and Single Accordion Controls
- Update Alpha Color Control

= 16 May 2017 =
- Fixed broken markdown for image in readme
- Updated readme documentation
- Update Simple Notice control example to include HTML tags
- Tweak Simple Notice and Single Accordion to only display limited HTML tags
- Update accordion to allow displaying of basic html.
- Don’t force accordion array content to be icons.
- Allow the icon tag to be passed to the control
- Change FA version when enqueing
- Update Font Awesome to v4.7
- Updated readme

= 14 May 2017 =
- Add more content to readme
- Add the ability to override the button labels on the Sortable repeater
- Tweak translation functions on labels & descriptions
- Override button label on Sortable Repeaters
- Change name of default value

= 11 May 2017 =
- Fix readme. Github markdown eh! Talk about crap! Github Markdown really sucks

= 8 May 2017 =
- Added missing sanitisation on strings
- Fixed existing string sanitisation for consistency
- Tidied code

= 6 May 2017 =
- Added core Media, Image and Cropped Image Controls and their associated default settings

= 5 May 2017 =
- Initial commit
