<?php
/**
* Theme Options v1.0
*
* Created by Jaye Tan.
* jayetan12@gmail.com
*/

//Internal css and js
add_action('admin_head', 'boilerplate_styles_scripts');

function boilerplate_styles_scripts() { ?>
	<style type="text/css">
		form{
			margin-left: 15px;
			margin-right: 15px;
		}
		div.updated{
			margin: 0px;
			margin-bottom: 10px;
		}
  		.boilerplate-container h2{
			margin: 0;
		    padding: 12px 15px 15px;
		    position: relative;
  		}
  		.js .postbox .hndle{
  			cursor: pointer;
  		}
  		h2.hndle{
  			font-size: 14px;
		    padding: 8px 12px;
		    margin: 0;
		    line-height: 1.4;
  		}
  		.toggle-indicator:before{
  			content: "\f142";
		    display: inline-block;
		    font: 400 20px/1 dashicons;
		    speak: none;
		    -webkit-font-smoothing: antialiased;
		    -moz-osx-font-smoothing: grayscale;
		    text-decoration: none!important;
  		}
  		.open .toggle-indicator:before{
  			content: "\f140";
  		}
	</style>
	<script type="text/javascript">
		jQuery(function($){
			$(".boilerplate-container .hndle").click(function(){
				$(this).next().toggle();
				$(this).parent().toggleClass("open");
			})
		})
	</script>
<?php } 

$boilset = 'boilerplate_settings';

//register settings
function theme_settings_init(){
	global $boilset;
    register_setting( $boilset, $boilset );
}


//add settings page to menu
function add_settings_page() {
	add_menu_page( __( 'Theme Options' ), __( 'Theme Options' ), 'manage_options', 'settings', 'theme_settings_page');
}


//add actions
add_action( 'admin_init', 'theme_settings_init' );
add_action( 'admin_menu', 'add_settings_page' );


//start settings page
function theme_settings_page() {
	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;
	global $boilset;
?>

<div class="wrap">

	<form method="post" action="options.php">

		<?php settings_fields( $boilset ); ?>

		<?php $options = get_option( $boilset ); ?>

		<?php $theme_name = function_exists( 'wp_get_theme' ) ? wp_get_theme() : get_current_theme(); ?>

		<h2><?php printf( __( '%s Theme Options', 'YourTheme' ), ucfirst($theme_name) ); ?></h2>
		<?php

		//show saved options message
		if ( false !== $_REQUEST['settings-updated'] ) : ?>
			<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible"> 
				<p><strong>Options saved.</strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
			</div>

		<?php endif; ?>
		<div class="postbox boilerplate-container">
			<button type="button" class="handlediv button-link" aria-expanded="false"><span class="screen-reader-text">Toggle panel: Information</span><span class="toggle-indicator" aria-hidden="true"></span></button>
			<h2 class="hndle"><span>Header and Footer Scripts</span></h2>
			<div class="inside">
				<table class="form-table">
					<tbody>

						<tr valign="top">
							<th scope="row"><label for="<?php echo $boilset."[header_scripts]"; ?>">Header Scripts</label></th>
							<td>
								<p><textarea name="<?php echo $boilset."[header_scripts]"; ?>" class="large-text" id="<?php echo $boilset."[header_scripts]"; ?>" cols="78" rows="8"><?php echo $options['header_scripts']; ?></textarea></p>
								<p><span class="description">Add Description here.</span></p>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row"><label for="<?php echo $boilset."[footer_scripts]"; ?>">Footer Scripts</label></th>
							<td>
								<p><textarea name="<?php echo $boilset."[footer_scripts]"; ?>" class="large-text" id="<?php echo $boilset."[footer_scripts]"; ?>" cols="78" rows="8"><?php echo $options['footer_scripts']; ?></textarea></p>
								<p><span class="description">Add Description here.</span></p>
							</td>
						</tr>

					</tbody>
				</table>
			</div>		
		</div>

		<p><input name="submit" id="submit" class="button button-primary" value="Save Changes" type="submit"></p>

	</form>

</div><!-- END wrap -->

<?php

}



?>