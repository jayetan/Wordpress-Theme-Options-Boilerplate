# WordPress Theme Options Boilerplate.

This is a simple boilerplate for creating theme options for wordpress, This is not a plugin. A working knowledge of CSS, HTML, jQuery, PHP and WordPress functions is required.


## How to use

Download and save the `wp-theme-options.php` file to your theme. Then include it your `functions.php` file:

```php
	require_once('wp-theme-options.php');
```

## Changing fieldname

find and change the value of $boilset on line 56

```php
	$boilset = 'boilerplate_settings';
```

## Adding Fields

To add more fields with postbox copy and paste the boilerplate-container div block then change the input row name
```php
	//sample input name
	<input type="text" name="<?php echo $boilset."[input_field]"; ?>" value="<?php echo $options['input_field']; ?>">
```

### More Example

**Example Text Input:**

```php
// Create sample text input field with postbox
	<div class="postbox boilerplate-container"> <!-- duplicate this block to add more fields with postbox -->
		<button type="button" class="handlediv button-link" aria-expanded="false"><span class="screen-reader-text">Toggle panel: Information</span><span class="toggle-indicator" aria-hidden="true"></span></button>
		<h2 class="hndle"><span>Sample Input Fields</span></h2>
		<div class="inside">
			<table class="form-table">
				<tbody>

					<tr valign="top">
						<th scope="row"><label for="<?php echo $boilset."[input_field]"; ?>">Input Field</label></th>
						<td>
							<p><input type="text" name="<?php echo $boilset."[input_field]"; ?>" value="<?php echo $options['input_field']; ?>"></p>
						</td>
					</tr>

				</tbody>
			</table>
		</div>		
	</div>
```


## Displaying Fields

To get the field values, use the get_option() function where the parameter is the value you provide in the $boilset variable,

```php
	<?php $options = get_option( 'boilerplate_settings' ); ?>
	<?php if($options['header_scripts']) : ?>
		<?php echo $options['header_scripts']; ?>
	<?php endif; ?>
```