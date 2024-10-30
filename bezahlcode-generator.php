<?php
/*
Plugin Name: BezahlCode-Generator
Plugin URI: http://www.bezahlcode.de
Description: Dieses Plugin erstellt ein Sidebar-Widget mit welchem BezahlCodes generiert werden koennen
Author: stoeger it GmbH
Version: 2.0
Author URI: http://www.stoeger-it.de
*/

// CSS in header ausgeben lassen
function bezahlcodewidget_styles()  
{  
?>  
<!-- BezahlCode.de-Generator -->  
<script src=https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js></script>
<script src="<?php echo WP_PLUGIN_URL; ?>/bezahlcode-generator/qr.js" type="text/javascript"></script>
<script src="<?php echo WP_PLUGIN_URL; ?>/bezahlcode-generator/dhtmlgoodies.js" type="text/javascript"></script>
<script src="<?php echo WP_PLUGIN_URL; ?>/bezahlcode-generator/bezahlcode.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/bezahlcode-generator/styles.css" media="screen" /> 
<!-- /BezahlCode.de-Generator -->    
<?php
}  

add_action('wp_head', 'bezahlcodewidget_styles', 1);  

// wigdet einhaengen
function widget_sidebar_init() {
	if ( !function_exists('register_sidebar_widget') )
		return;

	function widget_sidebar() {
		// Hier kann man eigenen Code einfuegen
		require_once("der_generator.php");
	}
	
	register_sidebar_widget('BezahlCode-Widget', 'widget_sidebar');
}

add_action('plugins_loaded', 'widget_sidebar_init');

// Admin Menue Einstellungen hinzufuegen
add_action('admin_menu', 'bezahlcode_adminmenu');

function bezahlcode_adminmenu() {

  add_options_page('BezahlCode-Generator Einstellungen', 'BezahlCode-Generator', 'manage_options', 'bezahlcode-generator.php', 'bezahlcode_options');

}

function bezahlcode_options() {

	bezahlcode_settings_page();
}

function bezahlcode_settings_page(){
	//must check that the user has the required capability 
    if (!current_user_can('manage_options'))
    {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }
    
    // variables for the field and option names 
    $opt_name = 'bezahlcode_showlink';
    $hidden_field_name = 'bezahlcode_submit_hidden';
    $data_field_name = 'bezahlcode_showlink';

    // Read in existing option value from database
    $opt_val = get_option( $opt_name );
    
    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val = $_POST[ $data_field_name ];

        // Save the posted value in the database
        update_option( $opt_name, $opt_val );

        // Put an settings updated message on the screen

	?>
	<div class="updated"><p><strong>Einstellungen gespeichert</strong></p></div>
	<?php

    }
		
	?>

	<div class="wrap">
  	<h2>BezahlCode-Generator</h2>
  	Schnell, einfach und sicher bezahlen mit dem BezahlCode!<br />
  	Weitere Informationen zum BezahlCode unter: <a href="http://www.bezahlcode.de" title="BezahlCode - Schnell, einfach und sicher bezahlen" target="_blank">www.bezahlcode.de</a>
	
	<form name="form1" method="post" action="">
	<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
	
	<table class="form-table">
	<tr valign="top">
		<td>Info-Link anzeigen oder ausblenden</td>
		<td>
		  <select name="<?php echo $data_field_name; ?>">
				<option value="visible" <?php if($opt_val == "visible") echo 'selected="selected"'; ?>>Info-Link anzeigen</option>
				<option value="hidden" <?php if($opt_val == "hidden") echo 'selected="selected"'; ?>>Info-Link ausblenden</option>
		  </select>
		</td>
	</tr>
	</table>
	
	<p class="submit">
	<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
	</p>
	
	</form>
	
	</div>
<?php  	
}
?>