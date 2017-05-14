# Customizer Custom Controls #

**Author:** Anthony Hortin  
**Author URI:** https://maddisondesigns.com  
**License:** GNU General Public License v2 or later  
**License URI:** http://www.gnu.org/licenses/gpl-2.0.html  


## Description ##

This is an example of incorporating Customizer functionality into your theme, including examples of how to update the Live Preview window. As well as showing the usage of the (built-in) core controls, there are also a number of Custom Controls.

### Core Controls ###
Input Control (Text, Email, URL, Number, Hidden, Date)
Checkbox Control  
Select Control  
Radio Control  
Dropdown Pages Control  
Textarea Control  
Color Control  

### Custom Controls ###
#### Toggle Switch ####

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
$wp_customize->add_control( new Skyrocket_Toggle_Switch_Custom_control( $wp_customize, 'sample_toggle_switch',
	array(
		'label' => esc_html__( 'Toggle switch' ),
		'section' => 'sample_custom_controls_section'
	)
) );
````

#### Slider ####

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

#### Sortable Repeater ####

The Sortable Repeater Custom Control allows you to collect values from one or more input fields. On top of that, the fields can be reordered by simply dragging 'n dropping each field. The control provides an icon handle for easy drag 'n drop reordering, a button for deleting a row and a button for adding a new row.

This particular Control has been designed for collecting one or more URL's and will validate the fields as such. It will also automatically add 'http://' to any url if it is missing. If you want to collect other type of data, such as plain text, simply duplicate this control and modify as necessary.

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

Image Radio Button  
Text Radio Button  
Image Checkbox  
Single Accordion  
Alpha Color Picker  
Simple Notice  
Google Font Select  

More documentation coming soon!

For more details, check out my Customizer Developers Guide:  
[The WordPress Customizer – A Developers Guide (Part 1)](https://maddisondesigns.com/2017/05/the-wordpress-customizer-a-developers-guide-part-1)  
[The WordPress Customizer – A Developers Guide (Part 2)](https://maddisondesigns.com/2017/05/the-wordpress-customizer-a-developers-guide-part-2) (coming even sooner)
