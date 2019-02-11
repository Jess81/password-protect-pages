<?php
/**
 *
 * @link       https://github.com/Jess81/password-protected-pages
 * @since      1.0.0
 *
 * @package    Password_Protect_Pages
 * @subpackage Password_Protect_Pages/admin
 */

add_action( 'admin_menu', 'ppp_add_admin_menu' );
add_action( 'admin_init', 'ppp_settings_init' );


function ppp_add_admin_menu(  ) { 

	add_submenu_page( 'options-general.php', 'Password Protect Pages', 'Password Protect Pages', 'manage_options', 'password_protect_pages', 'ppp_options_page' );

}


function ppp_settings_init(  ) { 

	register_setting( 'pluginPage', 'ppp_settings' );

	add_settings_section(
		'ppp_pluginPage_section', 
		__( 'Password Protect Pages', 'wordpress' ), 
		'ppp_settings_section_callback', 
		'pluginPage'
	);


	add_settings_field( 
		'ppp_select_field_4', 
		__( 'Settings:', 'wordpress' ), 
		'ppp_select_field_4_render', 
		'pluginPage', 
		'ppp_pluginPage_section' 
	);



	add_settings_field( 
		'ppp_text_field_0', 
		__( 'Page IDs:', 'wordpress' ), 
		'ppp_text_field_0_render', 
		'pluginPage', 
		'ppp_pluginPage_section' 
	);



}


function ppp_text_field_0_render(  ) { 

	$options = get_option( 'ppp_settings' );
	?>
	<input type='text' name='ppp_settings[ppp_text_field_0]' value='<?php echo $options['ppp_text_field_0']; ?>'>
	<?php

}


function ppp_select_field_4_render(  ) { 

	$options = get_option( 'ppp_settings' );
	?>
	<select name='ppp_settings[ppp_select_field_4]'>
		<option value='1' <?php selected( $options['ppp_select_field_4'], 1 ); ?>>Password Protect Some: Enter the pages to be password protected</option>
		<option value='2' <?php selected( $options['ppp_select_field_4'], 2 ); ?>>Password Protect All: enter the pages to be public</option>
	</select>

<?php

}



function ppp_settings_section_callback(  ) { 

	echo __( 'List page IDs, separated by commas.  Example: 15, 47, 390', 'wordpress' );

}


function ppp_options_page(  ) { 

	?>
	<form action='options.php' method='post'>

		<!--h2>Password Protect Pages</h2-->

		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>

	</form>
	<?php

}



?>